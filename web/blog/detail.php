<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /detail/detail.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSessionFront();

	# ----------------------------------------------------------------------------------------------------
	# MAINTENANCE MODE
	# ----------------------------------------------------------------------------------------------------
	verify_maintenanceMode();
	
	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BLOG_FEATURE != "on" || CUSTOM_BLOG_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(BLOG_EDIRECTORY_ROOT."/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	setting_get("review_approve", $post_comment_approve);

	$sucess_message = "";
	if ($_GET["success"] == "comment") {
		if ($post_comment_approve == "on") {
			$success_approve_message = LANG_MSG_COMMENT_SENT_TO_APPROVE;
		} else {
			$success_message = LANG_MSG_COMMENT_SUCCESSFULLY_POSTED;
		}
	} else if ($_GET["success"] == "reply") {
		if ($post_comment_approve == "on") {
			$success_approve_message = LANG_MSG_REPLY_SENT_TO_APPROVE;
		} else {
			$success_message = LANG_MSG_REPLY_SUCCESSFULLY_POSTED;
		}
	}
	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		extract($_POST);
		$comment_email = trim($comment_email);
		$comment_email = system_denyInjections($comment_email);
		$comment_website = system_denyInjections($comment_website);
		$comment = system_denyInjections($comment, true);
		$comment = stripslashes($comment);
		$error_comment = "";

		if (!validate_email($comment_email)) $error_comment .= system_showText(LANG_COMMENT_EMPTY_EMAIL)."<br />";
		if (!$comment) $error_comment .= system_showText(LANG_COMMENT_EMPTY)."<br />";
		if ( md5($captchatext) != $_SESSION["captchakey"] ) {
			$error_comment .= system_showText(LANG_MSG_CONTACT_TYPE_CODE)."<br />";
		}
		
		if ($reply_id == 0) {
			if (empty($error_comment)) {

				$postid = $_GET["id"] ? $_GET["id"] : $_POST["id"];

				$commentObj = new Comments();
				$commentObj->setNumber("post_id", $id);
				$commentObj->setNumber("reply_id", 0);
				$member_id = sess_getAccountIdFromSession();
				$commentObj->setNumber("member_id",$member_id);
				$commentObj->setString("description", $comment);
				$commentObj->setString("name", $comment_name);
				$commentObj->setString("email", $comment_email);
				if (!$post_comment_approve) {
					$commentObj->setString("approved", 1);
				}
				if ($comment_website)
					$commentObj->setString("website", $comment_website);
				$commentObj->Save();

				$postObj = new Post($id);
				$commentObj = new Comments($commentObj->getString("id"));
				
				# send email to sitegmr
				$sitemgr_msg = "
				<html>
					<head>
						<style>
							.email_style_settings{
								font-size:12px;
								font-family:Verdana, Arial, Sans-Serif;
								color:#000;
							}
						</style>
					</head>
					<body>
						<div class=\"email_style_settings\">
							Site Manager,<br /><br />"
							."\"".$postObj->getString("title")."\" has a new comment <br /><br />"
							.$comment_name." (".$comment_email.") wrote: <br /><br />"
							.$comment."<br />"
							."<br /> on ".format_date($commentObj->getString("added"), DEFAULT_DATE_FORMAT." H:i:s", "datetime")."<br /><br />"
							."Click on the link below to go to the comment administration :<br />"
							."<a href=\"".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/comments/view.php?post_id=".$postid."&id=".$commentObj->getString("id")."\" target=\"_blank\">".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/comments/view.php?post_id=".$postid."&id=".$commentObj->getString("id")."</a><br /><br />"
						."</div>
					</body>
				</html>";
				setting_get("sitemgr_email", $sitemgr_email);
				setting_get("sitemgr_blog_email", $sitemgr_blog_email);
                $sitemgr_emails = explode(",", $sitemgr_email);
				if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
				$subject   = "Comment";
				$comment      = system_replaceEmailVariables_Blog($comment, $id, 'post');
				$comment      = html_entity_decode($comment);
				system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] Comment Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", "", "", $error);
				if ($sitemgr_blog_email)
					system_mail($sitemgr_blog_email, "[".EDIRECTORY_TITLE."] Comment Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", "", "", $error);

				header("Location: ".BLOG_DEFAULT_URL."/detail.php?id=$id&success=comment");
				exit;
			} else {
				$message_comment = true;
			}
		} else {
			if (empty($error_comment)) {

				$postid = $_GET["id"] ? $_GET["id"] : $_POST["id"];

				$commentObj = new Comments();
				$commentObj->setNumber("post_id", $id);
				$commentObj->setNumber("reply_id", $reply_id);
				$member_id = sess_getAccountIdFromSession();
				$commentObj->setNumber("member_id",$member_id);
				$commentObj->setString("description", $comment);
				$commentObj->setString("name", $comment_name);
				$commentObj->setString("email", $comment_email);
				if (!$post_comment_approve) {
					$commentObj->setString("approved", 1);
				}
				if ($comment_website)
					$commentObj->setString("website", $comment_website);
				$commentObj->Save();

				$postObj = new Post($id);
				$commentObj = new Comments($commentObj->getString("id"));

				# send email to sitegmr
				$sitemgr_msg = "
				<html>
					<head>
						<style>
							.email_style_settings{
								font-size:12px;
								font-family:Verdana, Arial, Sans-Serif;
								color:#000;
							}
						</style>
					</head>
					<body>
						<div class=\"email_style_settings\">
							Site Manager,<br /><br />"
							."\"".$postObj->getString("title")."\" has a new comment <br /><br />"
							.$comment_name." (".$comment_email.") wrote: <br /><br />"
							.$comment."<br />"
							."<br /> on ".format_date($commentObj->getString("added"), DEFAULT_DATE_FORMAT." H:i:s", "datetime")."<br /><br />"
							."Click on the link below to go to the comment administration :<br />"
							."<a href=\"".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/comments/view.php?post_id=".$postid."&id=".$commentObj->getString("id")."\" target=\"_blank\">".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/comments/view.phppost_id=".$postid."&id=".$commentObj->getString("id")."</a><br /><br />"
						."</div>
					</body>
				</html>";
				setting_get("sitemgr_email", $sitemgr_email);
				setting_get("sitemgr_blog_email", $sitemgr_blog_email);
                $sitemgr_emails = explode(",", $sitemgr_email);
				if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
				$subject   = "Comment";
				$comment      = system_replaceEmailVariables_Blog($comment, $id, 'post');
				$comment      = html_entity_decode($comment);
				system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] Comment Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", "", "", $error);
				if ($sitemgr_blog_email)
					system_mail($sitemgr_blog_email, "[".EDIRECTORY_TITLE."] Comment Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", "", "", $error);
				
				header("Location: ".BLOG_DEFAULT_URL."/detail.php?id=$id&success=reply");
				exit;
			} else {
				$message_comment = true;
			}
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# BLOG
	# ----------------------------------------------------------------------------------------------------
	if (($_GET["id"]) || ($_POST["id"])) {
		$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
		$post = new Post($id);
		unset($postMsg);
		if ((!$post->getNumber("id")) || ($post->getNumber("id") <= 0)) {
			$postMsg = system_showText(LANG_MSG_NOTFOUND);
		} elseif ($post->getString("status") != "A") {
			$postMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		} elseif ($post->getString("publication_date") > date("Y-m-d")) {
			$postMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		} 
		report_newRecord("post", $id, POST_REPORT_DETAIL_VIEW);
		$post->setNumberViews($id);
		
	} else {
		header("Location: ".BLOG_DEFAULT_URL."/");
		exit;
	}
	
	# ----------------------------------------------------------------------------------------------------
	# COMMENTS
	# ----------------------------------------------------------------------------------------------------
	
	$dbObj = db_getDBObJect();
	$sql_comment = " SELECT * FROM Comments WHERE post_id = $id AND reply_id = 0 AND approved = 1";
	$sql_comment .= " ORDER BY `added` DESC ";
	$result = $dbObj->query($sql_comment);
	while ($row = mysql_fetch_assoc($result)) {
		$commentArr[] = $row;
	}
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	if (($post->getNumber("id")) && ($post->getNumber("id") > 0)) {
		$postCategs = $post->getCategories($post->getNumber("id"));
		if ($postCategs) {
			foreach ($postCategs as $postCateg) {
				$category_id[] = $postCateg->getNumber("id");
			}
		}
	}
	$_POST["category_id"] = $category_id;
	//$banner_section = "general";
	$headertag_title = (($post->getString("seo_title"))?($post->getString("seo_title")):($post->getString("title")));
	$headertag_description = (($post->getString("seo_title"))?($post->getString("seo_title")):($post->getString("title")));
	$headertag_keywords = (($post->getStringLang(EDIR_LANGUAGE, "seo_keywords"))?($post->getStringLang(EDIR_LANGUAGE, "seo_keywords")):(str_replace(" || ", ", ", $post->getStringLang(EDIR_LANGUAGE, "keywords"))));
	include(system_getFrontendPath("header.php", "layout"));
	?>

	<script src="<?=BLOG_DEFAULT_URL?>/scripts/blog.js" language="javascript" type="text/javascript"></script>

	<?

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
	
	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	include(THEMEFILE_DIR."/".EDIR_THEME."/body/blog_detail.php");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "post";
	include(system_getFrontendPath("footer.php", "layout"));

?>
