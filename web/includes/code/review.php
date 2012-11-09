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
	# * FILE: /includes/code/review.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if (!$item_type && !$item_id) {
		header("location: ".DEFAULT_URL."/index.php");
		exit;
	}
	if ($item_type == "listing") {
		$itemObj = new Listing($item_id);
		$item_name = $itemObj->getString("title");
	} else if ($item_type == "promotion"){
		$itemObj = new Promotion($item_id);
		$item_name = $itemObj->getString("name");
	}else if ($item_type == "article") {
		$itemObj = new Article($item_id);
		$item_name = $itemObj->getString("title");
	}

	$rating_stars = "";

	$hostReview = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));
	$host_cookieReview = str_replace(".", "_", $hostReview);


	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$success_review = false;	
	
	if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["submit"]) {

		setting_get("review_manditory", $review_manditory);
		setting_get("review_approve", $review_approve);

		if ($_COOKIE[$host_cookieReview."review"]) {
			$cookie_value = $_COOKIE[$host_cookieReview."review"];
			$cookie_arr   = explode(":",$_COOKIE[$host_cookieReview."review"]);
		}

		if (!string_strpos($url_base, "/sitemgr")) {

			$allowed = true;

			if (!$_POST["rating"]) {
				$message_review = system_showText(LANG_MSG_REVIEW_SELECTRATING);
				$allowed = false;
			} elseif ($_POST["rating"] > 5 ) {
				$message_review = system_showText(LANG_MSG_REVIEW_FRAUD_SELECTRATING);
				$allowed = false;
			} elseif (!trim($_POST["review"]) || !trim($_POST["review_title"])) {
				$message_review = system_showText(LANG_MSG_REVIEW_COMMENTREQUIRED);
				$allowed = false;
			}

			if ($review_manditory == "on") {
				if (!trim($_POST["reviewer_name"]) || !trim($_POST["reviewer_email"])) {
					$message_review = system_showText(LANG_MSG_REVIEW_NAMEEMAILREQUIRED);
					$allowed = false;
				}
			}

			if ($_POST["reviewer_email"] && !validate_email($_POST["reviewer_email"])) {
				$message_review = system_showText(LANG_MSG_REVIEW_TYPEVALIDEMAIL);
				$allowed = false;
			}

			if (md5($_POST["captchatext"]) != $_SESSION["captchakey"]) {
				$message_review = system_showText(LANG_MSG_CONTACT_TYPE_CODE);
				$allowed = false;
			}

			if ($cookie_arr) {
				foreach ($cookie_arr as $eah_cookie_value) {
					if ($item_id == $eah_cookie_value) {
						$message_review = system_showText(LANG_MSG_REVIEW_YOUALREADYGIVENOPINION);
						$allowed = false;
					}
				}
			}

			$reviewObj = new Review();
			$denied_ips = $reviewObj->getDeniedIpsByItem($item_type, $itemObj->getString("id"));
			if ($denied_ips) {
				foreach ($denied_ips as $each_ip) {
					if ($_SERVER["REMOTE_ADDR"] == $each_ip) {
						$message_review = system_showText(LANG_MSG_REVIEW_YOUALREADYGIVENOPINION);
						$allowed = false;
					}
				}
			}

		} else {
			$allowed = true;
		}

		for ($i = 1; $i < 6; $i++) {
			$img  = "<img "; 
			$img .= ($i <= $rating) ? "src=\"".DEFAULT_URL."/images/content/img_rate_star_on.gif\" alt=\"Star On\"" : "src=\"".DEFAULT_URL."/images/content/img_rate_star_off.gif\" alt=\"Star Off\"";
			$img .= "onclick=\"setRatingLevel($i)\"";
			$img .= "onmouseout=\"resetRatingLevel()\"";
			$img .= "onmouseover=\"setDisplayRatingLevel($i)\"";
			$img .= "name=\"star$i\" />";
			$rating_stars .= $img;
		}

		if ($allowed) {

			if (!string_strpos($url_base, "/sitemgr")) {		
				$_POST["ip"] = $_SERVER["REMOTE_ADDR"];
				$reviewObj = new Review($_POST);
				
				if ($review_approve != "on") {
					$reviewObj->setNumber("approved", 1);
				}
				$reviewObj->Save();
				if ($review_approve != "on") {
					$avg = $reviewObj->getRateAvgByItem($item_type, $item_id);
					if (!is_numeric($avg)) $avg = 0;
					if ($item_type == 'listing') {
						$listing = new Listing();
						$listing->setAvgReview($avg, $item_id);
					} else if ($item_type == 'promotion'){
						$promotion = new Promotion();
						$promotion->setAvgReview($avg, $item_id);
					}else {
						$articles = new Article();
						$articles->setAvgReview($avg, $item_id);
					}
				}
			} else {				
				$reviewObj = new Review($id);
				if ($review_approve != "on") {
					$reviewObj->setNumber("approved", 1);
					if ($item_type == 'listing') {
						$listing = new Listing();
						$listing->setAvgReview($avg, $item_id);
					} else if ($item_type == 'promotion'){
						$promotion = new Promotion();
						$promotion->setAvgReview($avg, $item_id);
					} else {
						$articles = new Article();
						$articles->setAvgReview($avg, $item_id);
					}
				}
				$reviewObj->setString("rating", $rating);
				$reviewObj->setString("review_title", $review_title);
				$reviewObj->setString("review", $review);
				$reviewObj->setString("reviewer_name", $reviewer_name);
				$reviewObj->setString("reviewer_email", $reviewer_email);
				$reviewObj->setString("reviewer_location", $reviewer_location);
				$reviewObj->Save();
				//header ("Location: ".$url_redirect);
				exit;
			}

			$reviewObj = new Review($reviewObj->getString("id"));

			$value = ($cookie_value) ? $cookie_value.":".$item_id : $item_id;

			setcookie($host_cookieReview."review", "$value", time()-3600, "".EDIRECTORY_FOLDER."/");
			setcookie($host_cookieReview."review", "$value", time()+60*60*24*30*120, "".EDIRECTORY_FOLDER."/");

			if ($reviewObj->getString("review")) {

				setting_get("sitemgr_send_email",$sitemgr_send_email);
				setting_get("sitemgr_email",$sitemgr_email);
				$sitemgr_emails = explode(",",$sitemgr_email);
				setting_get("sitemgr_rate_email",$sitemgr_rate_email);
				$sitemgr_rate_emails = explode(",",$sitemgr_rate_email);
				if ( ! $reviewObj->getString("reviewer_email") ) $reviewObj->setString("reviewer_email", "anonimous"); 

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
								."\"".$item_name."\" has a new review - ".$reviewObj->getString("rating")." stars <br />"
								.$reviewObj->getString("reviewer_name")." (".$reviewObj->getString("reviewer_email").") from ".$reviewObj->getString("reviewer_location")." wrote: <br />"
								.$reviewObj->getString("review_title")."<br />"
								.$reviewObj->getString("review")."<br />"
								.format_date($reviewObj->getString("added"), DEFAULT_DATE_FORMAT." H:i:s", "datetime")."<br /><br />"
								."Click on the link below to go to the review administration :<br />"
								."<a href=\"".DEFAULT_URL."/sitemgr/review/view.php?id=".$reviewObj->getString("id")."\" target=\"_blank\">".DEFAULT_URL."/sitemgr/review/view.php?id=".$reviewObj->getString("id")."</a><br /><br />"
							."</div>
						</body>
					</html>";
                $error = false;
				if ($sitemgr_send_email == "on") {
					if ($sitemgr_emails[0]) {
						foreach ($sitemgr_emails as $sitemgr_email) {
							system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] Rate Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
						}
					}
					if ($sitemgr_rate_emails[0]) {
						foreach ($sitemgr_rate_emails as $sitemgr_rate_email) {
							system_mail($sitemgr_rate_email, "[".EDIRECTORY_TITLE."] Rate Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_rate_email>", "text/html", '', '', $error);
						}
					}
				}
				
                
                /* send e-mail to listing owner */
                if($reviewObj->getString('item_type') == 'listing') {
                    $contactObj = new Contact($itemObj->getNumber('account_id'));
                    if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_REVIEW, $contactObj->getString("lang"))) {
                        setting_get("sitemgr_send_email", $sitemgr_send_email);
                        setting_get("sitemgr_email", $sitemgr_email);
                        $sitemgr_emails = explode(",", $sitemgr_email);
                        if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
                        $subject   = $emailNotificationObj->getString("subject");
                        $body      = $emailNotificationObj->getString("body");
                        $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'listing');
                        $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'listing');
                        $body      = html_entity_decode($body);
                        $subject   = html_entity_decode($subject);
                        $error = false;
                        system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
                    }
                }
                
                /* send e-mail to article owner */
                if($reviewObj->getString('item_type') == 'article') {
                    $contactObj = new Contact($itemObj->getNumber('account_id'));
                    if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_REVIEW, $contactObj->getString("lang"))) {
                        setting_get("sitemgr_send_email", $sitemgr_send_email);
                        setting_get("sitemgr_email", $sitemgr_email);
                        $sitemgr_emails = explode(",", $sitemgr_email);
                        if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
                        $subject   = $emailNotificationObj->getString("subject");
                        $body      = $emailNotificationObj->getString("body");
                        $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'article');
                        $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'article');
                        $body      = html_entity_decode($body);
                        $subject   = html_entity_decode($subject);
                        system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
                    }
                }
                 /* send e-mail to promotion owner */
                if($reviewObj->getString('item_type') == 'promotion') {
                    $contactObj = new Contact($itemObj->getNumber('account_id'));
                    if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_REVIEW, $contactObj->getString("lang"))) {
                        setting_get("sitemgr_send_email", $sitemgr_send_email);
                        setting_get("sitemgr_email", $sitemgr_email);
                        $sitemgr_emails = explode(",", $sitemgr_email);
                        if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
                        $subject   = $emailNotificationObj->getString("subject");
                        $body      = $emailNotificationObj->getString("body");
                        $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'promotion');
                        $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'promotion');
                        $body      = html_entity_decode($body);
                        $subject   = html_entity_decode($subject);
                        system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
                    }
                }

                /* */
                
                if(!$review_approve == 'on') {
                    /* send e-mail to listing owner */
                    if($reviewObj->getString('item_type') == 'listing') {
                        $contactObj = new Contact($itemObj->getNumber('account_id'));
                        if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REVIEW, $contactObj->getString("lang"))) {
                            setting_get("sitemgr_send_email", $sitemgr_send_email);
                            setting_get("sitemgr_email", $sitemgr_email);
                            $sitemgr_emails = explode(",", $sitemgr_email);
                            if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
                            $subject   = $emailNotificationObj->getString("subject");
                            $body      = $emailNotificationObj->getString("body");
                            $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'listing');
                            $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'listing');
                            $body      = html_entity_decode($body);
                            $subject   = html_entity_decode($subject);
                            system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
                        }
                    }
                    
                    /* send e-mail to article owner */
                    if($reviewObj->getString('item_type') == 'article') {
                        $contactObj = new Contact($itemObj->getNumber('account_id'));
                        if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REVIEW, $contactObj->getString("lang"))) {
                            setting_get("sitemgr_send_email", $sitemgr_send_email);
                            setting_get("sitemgr_email", $sitemgr_email);
                            $sitemgr_emails = explode(",", $sitemgr_email);
                            if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
                            $subject   = $emailNotificationObj->getString("subject");
                            $body      = $emailNotificationObj->getString("body");
                            $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'article');
                            $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'article');
                            $body      = html_entity_decode($body);
                            $subject   = html_entity_decode($subject);
                            system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
                        }
                    }
                    /* send e-mail to promotion owner */
                    if($reviewObj->getString('item_type') == 'promotion') {
                        $contactObj = new Contact($itemObj->getNumber('account_id'));
                        if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REVIEW, $contactObj->getString("lang"))) {
                            setting_get("sitemgr_send_email", $sitemgr_send_email);
                            setting_get("sitemgr_email", $sitemgr_email);
                            $sitemgr_emails = explode(",", $sitemgr_email);
                            if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
                            $subject   = $emailNotificationObj->getString("subject");
                            $body      = $emailNotificationObj->getString("body");
                            $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'promotion');
                            $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'promotion');
                            $body      = html_entity_decode($body);
                            $subject   = html_entity_decode($subject);
                            system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
                        }
                    }

                    /* */
                }

            }

			$message_review = system_showText(LANG_MSG_REVIEW_THANKSFEEDBACK);

			if ($review_approve == "on") {
				$message_review .= " ".system_showText(LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL);
			}

			$success_review = true;

		}

	} 
		$socialObj = new SettingSocialNetwork($item_type."_rate");
		$status = $socialObj->getString('value');
		if ($status == "yes" || sess_getAccountIdFromSession()) {
			$id = sess_getAccountIdFromSession();
			$reviewerAcc = new Account($id);
			$reviewerInfo = new Contact($id);
			$reviewerProfile = new Profile($id);
		}
		
	# ----------------------------------------------------------------------------------------------------
	# FORM DEFINES
	# ----------------------------------------------------------------------------------------------------

	$_POST = format_magicQuotes($_POST);
	$_GET  = format_magicQuotes($_GET);
	extract($_POST);
	extract($_GET);

?>