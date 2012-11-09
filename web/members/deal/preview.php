<?	/*==================================================================*\
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
	# * FILE: /members/deal/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	$promoLevelListing = new ListingLevel();
	$levels_all = $promoLevelListing->getLevelValues();
	foreach ($levels_all as $level_each) {
		if ( $promoLevelListing->getHasPromotion($level_each) == 'y' ) $hasPromotion = true;
	}
	if ( PROMOTION_FEATURE != 'on' || CUSTOM_PROMOTION_FEATURE != "on" ) exit;
	elseif ( !$hasPromotion ) exit;
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	
	if (!system_enableDealForUser($acctId)){
		exit; 	
	}

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$error = false;

	if ($id) {
		$promotion = new Promotion($id);
		if ((!$promotion->getNumber("id")) || ($promotion->getNumber("id") <= 0)) {
			$error = true;
		}
		if (sess_getAccountIdFromSession() != $promotion->getNumber("account_id")) {
			$error = true;
		}
	} else {
		$error = true;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<? if (sess_getAccountIdFromSession()) {
					$dbObjWelcome = db_getDBObJect(DEFAULT_DB, true);
					$sqlWelcome = "SELECT first_name, last_name FROM Contact WHERE account_id = ".sess_getAccountIdFromSession();
					$resultWelcome = $dbObjWelcome->query($sqlWelcome);
					$contactWelcome = mysql_fetch_assoc($resultWelcome);
		} ?>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<title><?=( ($contactWelcome) ? $contactWelcome["first_name"]." ".$contactWelcome["last_name"].", " : "" ) . system_showText(LANG_MSG_WELCOME) . " - " . system_showText(LANG_PROMOTION_PREVIEW);?></title>
		<?
		include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		?>
		<?=system_getNoImageStyle($cssfile = true);?>
	</head>
	<body class="previewmember">

		<?
		if (!$error) { ?>
		
			<div class="level level-preview">

				<div class="level-summary">	

					<p class="preview-desc"><?=system_showText(LANG_LABEL_SUMMARY_PAGE);?></p>

					<?
					$type = "summary";
					setting_get('commenting_edir', $commenting_edir);
					setting_get("review_promotion_enabled", $review_enabled);
					include(INCLUDES_DIR."/views/view_promotion_summary.php");
					?>

				</div>

				<div class="level-detail">

					<p class="preview-desc"><?=system_showText(LANG_LABEL_DETAIL_PAGE);?></p>

					<div class="content">
						<? include(INCLUDES_DIR."/views/view_promotion_detail.php"); ?>
					</div>

					<div class="sidebar">
						<? include(PROMOTION_EDIRECTORY_ROOT."/detail_listing.php"); ?>
						<? include(PROMOTION_EDIRECTORY_ROOT."/detail_reviews.php"); ?>
						<? include(PROMOTION_EDIRECTORY_ROOT."/deal_code.php"); ?>
					</div>

				</div>
			</div>

	<? } else { ?>
		<p class="errorMessage"><?=system_showText(LANG_MSG_NOTFOUND);?></p>
	<?}
		?>   
	</body>
</html>