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
	# * FILE: /sitemgr/deal/getMoreResults.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	$url_base = "".DEFAULT_URL."/sitemgr/".PROMOTION_FEATURE_FOLDER."/view";
	$sitemgr = 1;

	if (!isset($screen))
		$screen = 1;
	else
		if ($direction=="next")
			$screen++;
		elseif ($direction=="prev")
			$screen--;
		else
			$screen = $direction;

	#---------------------------------------------------------------------------------------------------

	$searchFor = "facebooked";
	$feature_label = system_showText(string_ucwords(LANG_LABEL_REDEEM_STATISTICS));

	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------

	$url_redirect = "".DEFAULT_URL."/sitemgr/".PROMOTION_FEATURE_FOLDER."/view";
	if ($searchFor) {
		$pageObj = new pageBrowsing("Promotion_Redeem", $screen, $search_limit, "id DESC", false, false, "promotion_id = $promotion_id", "*", false, false, false, SELECTED_DOMAIN_ID);
		$dealsInfo = $pageObj->retrievePage("array");
	}

	$total_records = $pageObj->getString("record_amount");

	# SEE MORE BUTTON  ----------------------------------------------------------------------------------------------
	$seeMoreButton = $pageObj->getPagesButtonsDeal($searchFor, $screen, $search_limit, $total_records, "this.form.submit();", $promotion_id);

	if ($dealsInfo) { ?>
		<? $legend=false; ?>
		<?=$seeMoreButton?>
		<table border="0" cellpadding="0" cellspacing="0" align="center" class="pagingContent">
			<tr><td><?=system_showText(LANG_PAGING_SHOWINGPAGE)?> <strong><?=$pageObj->getString("screen")?></strong> <?=system_showText(LANG_PAGING_PAGEOF)?> <strong><?=$pageObj->getString("pages")?></strong> <?=(intval($pageObj->getString("record_amount")) <= 1 ? system_showText(LANG_PAGING_PAGEOF) : system_showText(LANG_PAGING_PAGE_PLURAL))?></td></tr>
		</table>

		<? include(INCLUDES_DIR."/tables/table_deal.php"); ?>
		<input id="lm_<?=string_strtolower($searchFor)?>" name="limit_multiplier_<?=string_strtolower($searchFor)?>" type="hidden" value="<?=$screen?>" />
	<?
	} ?>
