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
	# * FILE: /advertise.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSessionFront();
	
	# ----------------------------------------------------------------------------------------------------
	# MAINTENANCE MODE
	# ----------------------------------------------------------------------------------------------------
	verify_maintenanceMode();
	
	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Advertise with Us";
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
	include(system_getFrontendPath("header.php", "layout"));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
	
	setting_get('commenting_edir', $commenting_edir);
	setting_get("review_listing_enabled", $review_enabled);
	customtext_get("payment_tax_label", $payment_tax_label);
	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);

	$levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
	
	$locationsToShow = explode (",", EDIR_LOCATIONS);
	$locationsToShow = array_reverse ($locationsToShow);
	foreach ($locationsToShow as $locationToShow) {
		$reviewer_location .= system_showText(constant("LANG_LABEL_".constant("LOCATION".$locationToShow."_SYSTEM"))).", ";
	}
	$reviewer_location = string_substr("$reviewer_location", 0, -2);
	unset($locationsToShow);
	
	$arrReviewAux["review_title"] = system_showText(LANG_LABEL_ADVERTISE_REVIEW_TITLE);
	$arrReviewAux["reviewer_name"] = system_showText(LANG_LABEL_ADVERTISE_VISITOR);
    $arrReviewAux["reviewer_location"] = $reviewer_location;
    $arrReviewAux["added"] = date("Y-m-d")." ".date("H:m:s");
    $arrReviewAux["approved"] = "1";
	$arrReviewAux["review"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica formas.";
	
    $arrReviewAux["rating"] = "1";
    $arrReviewAux["response"] = "Lorem ipsum dolor sit amet, consectetur. Pellentesque luctus enim ac diam tortor.";
    $arrReviewAux["responseapproved"] = "1";
	$reviewsArr[] = new Review($arrReviewAux);
	
	$arrReviewAux["rating"] = "3";
    $arrReviewAux["response"] = "";
    $arrReviewAux["responseapproved"] = "0";
	$reviewsArr[] = new Review($arrReviewAux);
	
	$arrReviewAux["rating"] = "5";
	$reviewsArr[] = new Review($arrReviewAux);
	unset($arrReviewAux);
	
	unset($activeTab);
	if (isset($_GET["event"]) && EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") $activeTab = "event";
	elseif (isset($_GET["banner"]) && BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") $activeTab = "banner";
	elseif (isset($_GET["classified"]) && CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") $activeTab = "classified";
	elseif (isset($_GET["article"]) && ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") $activeTab = "article";
	elseif (isset($_GET["listing"])) $activeTab = "listing";
	else  $activeTab = "listing";
	?>
	
	<script type="text/javascript">

		function showTab (type) {
			var activeTab = "#tab_" + type;
			var activeTabContent = "#content_" + type;
			
			$("ul.tabs li").removeClass("active"); //Remove any "active" class
			$(activeTab).addClass("active"); //Add "active" class to selected tab
			$(".tab-content").hide(); //Hide all tab content
			$(activeTabContent).fadeIn(); //Fade in the active content
		}
        
        function showTabLevels (module, level) {
			var activeTab = "#tab" + module + "Level_" + level;
			var activeTabContent = "#content" + module + "Level_" + level;

			$("ul.tabsLevels"+module+" li").removeClass("active"); //Remove any "active" class
			$(activeTab).addClass("active"); //Add "active" class to selected tab
			$(".level"+module).hide(); //Hide all tab content
			$(activeTabContent).fadeIn(); //Fade in the active content
		}
		
	</script>
	
	<div class="content content-full">
		
		<?
		if ($sitecontent) {
			echo "<div class=\"content-custom\">".$sitecontent."</div>";
		}
		?>

		 <ul class="tabs">
			 <li id="tab_listing" <?=$activeTab == "listing"? "class=\"active\"": "";?> onclick="showTab('listing');"><a href="javascript:void(0);"><?=system_showText(LANG_LISTING_OPTIONS)?></a></li>
	
			<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
				<li id="tab_event" <?=$activeTab == "event"? "class=\"active\"": "";?> onclick="showTab('event');"><a href="javascript:void(0);"><?=system_showText(LANG_EVENT_OPTIONS)?></a></li>
			<? } ?>
	
			<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
				<li id="tab_classified" <?=$activeTab == "classified"? "class=\"active\"": "";?> onclick="showTab('classified');"><a href="javascript:void(0);"><?=system_showText(LANG_CLASSIFIED_OPTIONS)?></a></li>
			<? } ?>
	
			<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
				<li id="tab_article" <?=$activeTab == "article"? "class=\"active\"": "";?> onclick="showTab('article');"><a href="javascript:void(0);"><?=system_showText(LANG_ARTICLE_OPTIONS)?></a></li>
			<? } ?>
			
			<? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
				<li id="tab_banner" <?=$activeTab == "banner"? "class=\"active\"": "";?> onclick="showTab('banner');"><a href="javascript:void(0);"><?=system_showText(LANG_BANNER_OPTIONS)?></a></li>
			<? } ?>
		</ul>
		

		<div class="content-main">
		
			<div class="tab-container">
			
				<div id="content_listing" class="tab-content" <?=$activeTab == "listing"? "style=\"\"": "style=\"display: none;\"";?>>
					<? include(EDIRECTORY_ROOT."/signup_listing.php"); ?>
				</div>
			
				<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
					<div id="content_event" class="tab-content" <?=$activeTab == "event"? "style=\"\"": "style=\"display: none;\"";?>>
						<? include(EDIRECTORY_ROOT."/signup_event.php"); ?>
					</div>
				<? } ?>
			
				<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
					<div id="content_classified" class="tab-content" <?=$activeTab == "classified"? "style=\"\"": "style=\"display: none;\"";?>>
						<? include(EDIRECTORY_ROOT."/signup_classified.php"); ?>
					</div>
				<? } ?>
			
				<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
					<div id="content_article" class="tab-content" <?=$activeTab == "article"? "style=\"\"": "style=\"display: none;\"";?>>
						<? include(EDIRECTORY_ROOT."/signup_article.php"); ?>
					</div>
				<? } ?>
			
				<? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
					<div id="content_banner" class="tab-content" <?=$activeTab == "banner"? "style=\"\"": "style=\"display: none;\"";?>>
						<? include(EDIRECTORY_ROOT."/signup_banner.php"); ?>
					</div>
				<? } ?>
		
			</div>
			
		</div>
		
		<?
		$contentObj = new Content("", EDIR_LANGUAGE);
		$content = $contentObj->retrieveContentByType("Advertise with Us Bottom");
		if ($content) {
			echo "<div class=\"content-custom\">".$content."</div>";
		}
		?>
		
		<? include(system_getFrontendPath("banner_bottom.php")); ?>
	
	</div>
	
	<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(system_getFrontendPath("footer.php", "layout"));
	?>
