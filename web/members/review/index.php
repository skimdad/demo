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
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	$url_redirect = "".DEFAULT_URL."/members/review";
	$url_base     = "".DEFAULT_URL."/members";

	extract($_GET);
	extract($_POST);
	
	if (!$item_type) $item_type = 'listing';
	
	setting_get('commenting_edir', $commenting_edir);
	
    if ($item_type == 'listing') {
    	$itemObj = new Listing($item_id);
    	$tableName  = 'Listing';
		setting_get("review_listing_enabled", $review_enabled);
		$urlAux = DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER;
    } else if ($item_type == 'article') {
    	$itemObj = new Article($item_id);
    	$tableName  = 'Article';
		setting_get("review_article_enabled", $review_enabled);
		$urlAux = DEFAULT_URL."/members/".ARTICLE_FEATURE_FOLDER;
    } else if ($item_type == 'promotion') {
    	$itemObj = new Promotion($item_id);
    	$tableName  = 'Promotion';
		setting_get("review_promotion_enabled", $review_enabled);
		$urlAux = DEFAULT_URL."/members/".PROMOTION_FEATURE_FOLDER;
    }
	
	if ($review_enabled != "on" || !$commenting_edir){
		header("Location: ".$urlAux);
	}

	// Page Browsing /////////////////////////////////////////   
	$where .= " Review.item_type = '$item_type' AND Review.item_id = '$item_id' AND Review.item_id = $tableName.id AND $tableName.account_id = '$acctId' ";
	

	$pageObj = new pageBrowsing("Review, $tableName", $screen, 10, "approved, added DESC", "review_title", $letter, $where, "Review.*");
	$reviewsArrTmp = $pageObj->retrievePage("array");
	if ($reviewsArrTmp) foreach ($reviewsArrTmp as $each_reviewsArrTmp) {
		$reviewsArr[] = new Review($each_reviewsArrTmp["id"]);
	}

	$paging_url = DEFAULT_URL."/members/review/index.php?item_id=$item_id&item_screen=$item_screen&item_letter=$item_letter";

	// Letters Menu
	$letters = $pageObj->getString("letters");
	foreach ($letters as $each_letter) {
		if ($each_letter == "#") {
			$letters_menu .= "<a href=\"$paging_url&letter=no\" ".(($letter == "no") ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
			//$letters_menu .= "<a href=\"$paging_url\" ".((!$letter) ? "class=\"firstLetter\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		} else {
			$letters_menu .= "<a href=\"$paging_url&letter=".$each_letter."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		}
	}

	$_GET["review_screen"] = $screen;
	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_PAGING_GOTOPAGE).": ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");
?>

			<div class="content">

				<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<h2>
					<?=system_showText(LANG_REVIEW_PLURAL)?>
					<? if ($reviewsArrTmp) { ?>
						<? if ($item_id) { ?> - 
							<?
							if ($item_type == 'listing') {
								$itemObj = new Listing($item_id); 
							} else if ($item_type == 'article') {
							    $itemObj = new Article($item_id);
							} else if ($item_type == 'promotion') {
							    $itemObj = new Promotion($item_id);
							}
							?>
							<?=($item_type == "promotion" ? $itemObj->getString("name", true) : $itemObj->getString("title", true))?>
						<? } ?>
					<? } ?>
				</h2>

				<ul class="list-view">
					<li class="list-back"><a href="javascript:history.back(-1);"><?=system_showText(LANG_LABEL_BACK);?></a></li>
				</ul>

				<?
				if ($reviewsArrTmp) {
					include(INCLUDES_DIR."/tables/table_review.php");
				} else {
					echo "<p class=\"informationMessage\">".system_showText(LANG_MSG_NO_RESULTS_FOUND)."</p>";
				}
				?>

			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>