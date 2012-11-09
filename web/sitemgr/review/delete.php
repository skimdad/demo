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
	# * FILE: /sitemgr/review/delete.php
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

	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$reviewObj = new Review($id);
	}	else {
		//$message = urlencode(system_showText(LANG_SITEMGR_REVIEW_NOTFOUND));
        $message = 0;
		header("Location: ".DEFAULT_URL."/sitemgr/review/index.php?class=errorMessage&message=".$message."&item_type=$item_type".($filter_id ? "&filter_id=1&item_id=$item_id" : '')."&screen=$screen&letter=$letter&item_letter=$item_letter&item_screen=$item_screen");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$reviewObj = new Review($id);
		$reviewObj->delete();
		
		$avg = $reviewObj->getRateAvgByItem($item_type, $item_id);
		if (!is_numeric($avg)) $avg = 0;
		
		if ($item_type == 'listing') {
			$listing = new Listing();
			$listing->setAvgReview($avg, $item_id);
		} else if ($item_type == 'article') {
			$articles = new Article();
			$articles->setAvgReview($avg, $item_id);
		} else {
			$promotions = new Promotion();
			$promotions->setAvgReview($avg, $item_id);
		}
	
		//$message = urlencode(system_showText(LANG_SITEMGR_REVIEW_SUCCESSDELETED));
        $message = 2;
		header("Location: ".DEFAULT_URL."/sitemgr/review/index.php?message=".$message."&item_type=$item_type".($filter_id ? "&filter_id=1&item_id=$item_id" : '')."&screen=$screen&letter=$letter&item_letter=$item_letter&item_screen=$item_screen");
		exit;
	}

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
		<h1><?=system_showText(LANG_SITEMGR_DELETE)?> <?=string_ucwords(system_showText(LANG_SITEMGR_REVIEW))?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
		
		<div class="baseForm">

		<form name="delete_review" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
			<input type="hidden" name="id"                 value="<?=$id?>" />
			<input type="hidden" name="item_id"            value="<?=$item_id?>" />
			<input type="hidden" name="item_type"          value="<?=$item_type?>" />
			<? if ($filter_id) { ?>
			<input type="hidden" name="filter_id"          value="1" />
			<? } ?>
			<input type="hidden" name="letter"             value="<?=$letter?>" />
			<input type="hidden" name="screen"             value="<?=$screen?>" />
			<input type="hidden" name="item_screen"        value="<?=$item_screen?>" />
			<input type="hidden" name="item_letter"        value="<?=$item_letter?>" />
			<div class="header-form">
				<?=system_showText(LANG_SITEMGR_DELETE)?> <?=string_ucwords(system_showText(LANG_SITEMGR_REVIEW))?> - <?=($reviewObj->getString("review_title")) ? html_entity_decode($reviewObj->getString("review_title")) : "N/A";?> - <?=$reviewObj->getString("rating")?> <?=system_showText(LANG_SITEMGR_REVIEW_STAR_PLURAL)?> 
			</div>
			<p class="informationMessage">
				<?=system_showText(LANG_SITEMGR_REVIEW_DELETEQUESTION)?>
			</p>
			<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
			<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formreviewdeletecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
		</form>
		<form id="formreviewdeletecancel" action="<?=DEFAULT_URL?>/sitemgr/review/index.php" method="get">
			<input type="hidden" name="item_type"        value="<?=$item_type?>" />
			<? if ($filter_id) { ?>
			<input type="hidden" name="filter_id"          value="1" />
			<input type="hidden" name="item_id"            value="<?=$item_id?>" />
			<? } ?>
			<input type="hidden" name="letter"           value="<?=$letter?>" />
			<input type="hidden" name="screen"           value="<?=$screen?>" />
			<input type="hidden" name="item_screen"      value="<?=$item_screen?>" />
			<input type="hidden" name="item_letter"      value="<?=$item_letter?>" />
		</form>
		
		</div>
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
