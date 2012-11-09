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
	# * FILE: /listing/detail.php
	# ----------------------------------------------------------------------------------------------------
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	session_start();
	
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	sess_validateSessionFront();

	# ----------------------------------------------------------------------------------------------------
	# MAINTENANCE MODE
	# ----------------------------------------------------------------------------------------------------
	verify_maintenanceMode();
	
	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(LISTING_EDIRECTORY_ROOT."/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$message_style = "errorMessage";

		if ($_POST["id"]) $listing = new Listing($_POST["id"]);

		$to = system_denyInjections($to);
		$subject = trim(system_denyInjections($subject));
		$body = trim(system_denyInjections($body, true));
		$error = "";
		if (!$name) $error .= system_showText(LANG_MSG_CONTACT_ENTER_NAME)."<br />";
		if (!validate_email($to)) $error .= system_showText(LANG_MSG_CONTACT_ENTER_VALID_EMAIL)."<br />";
		if (!validate_email($from)) $error .= system_showText(LANG_MSG_CONTACT_ENTER_VALID_EMAIL)."<br />";
		if (!$body) $error .= system_showText(LANG_MSG_CONTACT_TYPE_MESSAGE)."<br />";

		if (md5($_POST["captchatext"]) != $_SESSION["captchakey"]) {
			$error .= system_showText(LANG_MSG_CONTACT_TYPE_CODE)."<br />";
		}

		if (empty($error)) {

			if (empty($subject)) $subject = LANG_LISTING_CONTACTSUBJECT_ISNULL_1." ".$listing->getString("title")." ".LANG_LISTING_CONTACTSUBJECT_ISNULL_2." ".EDIRECTORY_TITLE;

			$body = str_replace("<br />", "", $body);
			
			$body = ucfirst(system_showText(LANG_FROM)).": ".$name."\n\n".system_showText(LANG_LABEL_EMAIL).": ".$from."\n\n".system_showText(LANG_LABEL_MESSAGE).": ".$body;
			
			$subject = stripslashes(html_entity_decode($subject));
			$body 	 = stripslashes($body);

			$subject = "[".system_showText(LANG_CONTACTPRESUBJECT)." ".EDIRECTORY_TITLE."] ".$subject;

			$return = system_mail($to, htmlspecialchars_decode($subject), $body, $from, 'text/plain', '', '', $error);

			if ($return) {
				$error = system_showText(LANG_CONTACTMSGSUCCESS);
				$message_style = "successMessage";
			}	else {
				$error = system_showText(LANG_CONTACTMSGFAILED).($error ? '<br />'.$error : '')."<br />";
			}

			if ($return) {
				report_newRecord("listing", $_POST["id"], LISTING_REPORT_EMAIL_SENT);
				unset($from, $subject, $body, $name);
			}

		}
	}

	# ----------------------------------------------------------------------------------------------------
	# LISTING
	# ----------------------------------------------------------------------------------------------------
	if (($_GET["id"]) || ($_POST["id"])) { 
		$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
		$listing = new Listing($id);

		$levelObj = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
		unset($listingMsg);
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			$listingMsg = system_showText(LANG_MSG_NOTFOUND);
		} elseif ($listing->getString("status") != "A") {
			$listingMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		} elseif ($levelObj->getDetail($listing->getNumber("level")) != "y" && $levelObj->getActive($listing->getNumber("level")) == 'y') {
			$listingMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		} else {

			report_newRecord("listing", $id, LISTING_REPORT_DETAIL_VIEW);
		
			$listing->setNumberViews($id);
		}
						
	} else {
		header("Location: ".LISTING_DEFAULT_URL."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# REVIEWS
	# ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where[] = " item_type = 'listing' AND item_id = ".db_formatNumber($id)." ";
	if (true) $sql_where[] = " review IS NOT NULL AND review != '' ";
	if (true) $sql_where[] = " approved = '1' ";
	if ($sql_where) $sqlwhere .= " ".implode(" AND ", $sql_where)." ";
	$pageObj  = new pageBrowsing("Review", $screen, 3, "added DESC", "", "", $sqlwhere);
	$reviewsArr = $pageObj->retrievePage("object");

	# ----------------------------------------------------------------------------------------------------
	# CHECK INS
	# ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where2[] = " item_id = ".db_formatNumber($id)." ";
	if (true) $sql_where2[] = " quick_tip IS NOT NULL AND quick_tip != '' ";
	if ($sql_where2) $sqlwhere2 .= " ".implode(" AND ", $sql_where2)." ";
	$pageObj  = new pageBrowsing("CheckIn", $screen, 3, "added DESC", "", "", $sqlwhere2);
	$checkinsArr = $pageObj->retrievePage("object");
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	if (($listing->getNumber("id")) && ($listing->getNumber("id") > 0)) {
		$listCategs = $listing->getCategories(false,false,false,true,true);
		if ($listCategs) {
			foreach ($listCategs as $listCateg) {
				$category_id[] = $listCateg->getNumber("id");
			}
		}
	}
	$_POST["category_id"] = $category_id;
	$banner_section = "listing";
	$headertag_title = (($listing->getString("seo_title"))?($listing->getString("seo_title")):($listing->getString("title")));
	$headertag_description = (($listing->getStringLang(EDIR_LANGUAGE, "seo_description"))?($listing->getStringLang(EDIR_LANGUAGE, "seo_description")):($listing->getStringLang(EDIR_LANGUAGE, "description")));
	$headertag_keywords = (($listing->getStringLang(EDIR_LANGUAGE, "seo_keywords"))?($listing->getStringLang(EDIR_LANGUAGE, "seo_keywords")):(str_replace(" || ", ", ", $listing->getStringLang(EDIR_LANGUAGE, "keywords"))));
	include(system_getFrontendPath("header.php", "layout"));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
	
	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	include(THEMEFILE_DIR."/".EDIR_THEME."/body/listing_detail.php");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "listing";
	include(system_getFrontendPath("footer.php", "layout"));

?>
