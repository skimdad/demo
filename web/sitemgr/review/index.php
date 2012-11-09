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
	# * FILE: /sitemgr/review/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/review";
	$url_base     = "".DEFAULT_URL."/sitemgr";

	extract($_GET);
	extract($_POST);

	//increases frequently actions
	if ($item_type == "listing")
		system_setFreqActions("reviewlisting_manage",'listing');
	elseif ($item_type == "article"){
		if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on") {
			header("Location: ".DEFAULT_URL."/sitemgr/");
			exit;
		}
		system_setFreqActions("reviewarticle_manage",'ARTICLE_FEATURE');
	}
	elseif ($item_type == "promotion"){
		if (PROMOTION_FEATURE != "on" || CUSTOM_PROMOTION_FEATURE != "on") {
			header("Location: ".DEFAULT_URL."/sitemgr/");
			exit;
		}
		system_setFreqActions("reviewpromotion_manage",'PROMOTION_FEATURE');
	}

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	
	if (!$itemObj) {
    	if ($item_type == 'listing') {
    		$itemObj = new Listing($item_id);
    	} else if ($item_type == 'article') {
    	    $itemObj = new Article($item_id);
    	} else if ($item_type == 'promotion') {
    	    $itemObj = new Promotion($item_id);
    	}
    }

	// Page Browsing /////////////////////////////////////////
	if ($item_id) 				 $sql_where[] = " item_type = '$item_type' AND item_id = '$item_id' ";
	if ($item_type && !$item_id) $sql_where[] = " item_type = '$item_type'";

	if ($sql_where)
		$where .= " ".implode(" AND ", $sql_where)." ";

	$pageObj  = new pageBrowsing("Review", $screen, RESULTS_PER_PAGE, "approved, added DESC", "review_title", $letter, $where);
	$reviewsArr = $pageObj->retrievePage("object");

	$paging_url = DEFAULT_URL."/sitemgr/review/index.php?item_type=$item_type&item_id=$item_id".($filter_id ? "&filter_id=1" : '')."&item_screen=$item_screen&item_letter=$item_letter";

	// Letters Menu
	$letters = $pageObj->getString("letters");
	foreach($letters as $each_letter){
		if ($each_letter == "#") {
			$letters_menu .= "<a href=\"$paging_url&letter=no\" ".(($letter == "no") ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
			//$letters_menu .= "<a href=\"$paging_url\" ".((!$letter) ? "class=\"firstLetter\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		} else {
			$letters_menu .= "<a href=\"$paging_url&letter=".$each_letter."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		}
	}
	
	$_GET["review_screen"] = $screen;
	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
?>
<div id="main-right">
<div id="top-content">
	<div id="header-content">
		<h1><?=system_showText(LANG_SITEMGR_REVIEW_MANAGEREVIEWS)?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_review_submenu.php"); ?>

		<br />

		<div id="header-view"> 
			<? 
			if ($item_type=='listing') 
				echo ucfirst(@constant('LANG_SITEMGR_LISTINGREVIEWS'));
			else if ($item_type=='article') 
				echo ucfirst(@constant('LANG_SITEMGR_ARTICLEREVIEWS'));
			else if ($item_type=='promotion') echo ucfirst(@constant('LANG_SITEMGR_PROMOTIONREVIEWS'));
			
			if ($item_id) {
				echo ' - '.($item_type == "promotion" ? $itemObj->getString("name", true) : $itemObj->getString("title", true)); 
			}
            ?>
        </div>

		<br />

		<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

		<? if ($reviewsArr) { ?>
			<? include(INCLUDES_DIR."/tables/table_review.php"); ?>

			<?

			if ($openapprove == "yes"){?>
				<script type="text/javascript">
					showStatusField(<?=$id?>);
					document.getElementById("dropdownDomain").disabled = true;
				</script>
			<? }
			if ($openedit == "yes"){?>
				<script type="text/javascript">
					showReviewField(<?=$id?>);
					document.getElementById("dropdownDomain").disabled = true;
				</script>
			<? } ?>

		<? } else { ?>
			<p class="informationMessage"><?=system_showText(LANG_SITEMGR_REVIEW_NORECORD)?></p>
		<? } ?>

	</div>
</div>
<div id="bottom-content">
	&nbsp;
</div>
</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>