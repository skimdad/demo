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
	# * FILE: /profile/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# MAINTENANCE MODE
	# ----------------------------------------------------------------------------------------------------
	verify_maintenanceMode();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	if (SOCIALNETWORK_FEATURE == "off") { exit; }
	if(isset($_GET['oauth_token'])) {
		header('Location: '.DEFAULT_URL.'/profile/edit.php?oauth_token='.$_GET['oauth_token']);
		exit;
	}
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSessionFront();

	# ----------------------------------------------------------------------------------------------------
	# MODE REWRITE
	# ----------------------------------------------------------------------------------------------------
	setting_get('commenting_edir', $commenting_edir);
	setting_get('review_listing_enabled', $review_enabled);
	setting_get('review_article_enabled', $review_article_enabled);
	setting_get('review_promotion_enabled', $review_promotion_enabled);
	include(EDIRECTORY_ROOT."/profile/mod_rewrite.php");

	$aux_module_per_page = "profile$pag_content";
	
	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($_POST["hiddenValue"]) {
			$reviewObj = new Review($_POST["hiddenValue"]);

			$item_type = $reviewObj->getString("item_type");
			$item_id = $reviewObj->getNumber("item_id");

			$reviewObj->Delete();

			$avg = $reviewObj->getRateAvgByItem($item_type, $item_id);
			if (!is_numeric($avg)) $avg = 0;

			if ($item_type == "listing") {
				$listing = new Listing();
				$listing->setAvgReview($avg, $item_id);
			} elseif ($item_type == "article") {
				$articles = new Article();
				$articles->setAvgReview($avg, $item_id);
			} elseif ($item_type == "promotion") {
				$promotions = new Promotion();
				$promotions->setAvgReview($avg, $item_id);
			}

			$message = system_showText(LANG_MSG_REVIEW_SUCCESS_DELETED);
			$message_style = "successMessage";
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Profile Page";
	$sitecontentinfo = $contentObj->retrieveContentInfoByType($sitecontentSection);
	if ($sitecontentinfo) {
		$headertagtitle = $sitecontentinfo["title"];
		$headertagdescription = $sitecontentinfo["description"];
		$headertagkeywords = $sitecontentinfo["keywords"];
		$sitecontent = $sitecontentinfo["content"];
	} else {
		$headertagtitle = "";
		$headertagdescription = "";
		$headertagkeywords = "";
		$sitecontent = "";
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	$headertag_description = $headertagdescription;
	$headertag_keywords = $headertagkeywords;
	$hide_search = true;
	include(system_getFrontendPath("header.php", "layout"));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
	$levelObj = new ListingLevel();

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	if (sess_validateSessionItens("general", "see_profile", true, $id? "": 0)) {
		$info = socialnetwork_retrieveInfoProfile($id);

		include(THEMEFILE_DIR."/".EDIR_THEME."/body/profile_index.php");
	}

	?>
		<script type="text/javascript">
			//<![CDATA[
			function redirect (url) {
				window.location = url;
			}

			function formSubmit(form, module) {
				$('#changePage').val(module);
				form.submit();
			}

			function changePageProfile(url, page, moderewrite) {
				if (moderewrite == "on") redirect(url + "/page/" + page);
				else redirect(url + "&screen=" + page);
			}
			//]]>
		</script>
	<?

	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Profile Page Bottom";
	$sitecontentinfo = $contentObj->retrieveContentInfoByType($sitecontentSection);
	if ($sitecontentinfo) {
		$headertagtitle = $sitecontentinfo["title"];
		$headertagdescription = $sitecontentinfo["description"];
		$headertagkeywords = $sitecontentinfo["keywords"];
		$sitecontent = $sitecontentinfo["content"];
	} else {
		$headertagtitle = "";
		$headertagdescription = "";
		$headertagkeywords = "";
		$sitecontent = "";
	}

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(system_getFrontendPath("footer.php", "layout"));

?>