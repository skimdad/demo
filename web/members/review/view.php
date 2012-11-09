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
	# * FILE: /sitemgr/review/view.php
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
	$url_base = "".DEFAULT_URL."/members";

	extract($_POST);
	extract($_GET);

	$reviewObj  = new Review($id);
	$item_id = $reviewObj->getNumber('item_id');
	
	if ($reviewObj->getString('item_type') == 'listing') {
		$itemObj = new Listing($item_id);
		$item_type = 'listing';
	} else if ($reviewObj->getString('item_type') == 'article') {
	    $itemObj = new Article($item_id);
	    $item_type = 'article';
	} else if ($reviewObj->getString('item_type') == 'promotion') {
	    $itemObj = new Promotion($item_id);
	    $item_type = 'promotion';
	}
	
	
	if ($itemObj->getNumber("account_id") != $acctId) {
		header("Location: ".$url_base."/$item_type/index.php");
		exit;
	}

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

				<h2><?=system_showText(LANG_REVIEW_DETAIL)?></h2>

				<ul class="list-view">
					<li class="list-back"><a href="javascript:history.back(-1);" class="link-view"><?=system_showText(LANG_LABEL_BACK);?></a></li>
				</ul>

				<h2 class="standardSubTitle"><?=system_showText(LANG_REVIEW_PREVIEW)?></h2>

				<? 
				$reviewObj->extract();
				$show_item = true;
				$user 	   = false;
				include(INCLUDES_DIR."/views/view_review_detail.php");
				echo $item_reviewcomment;
				?>

			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
