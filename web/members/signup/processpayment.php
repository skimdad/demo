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
	# * FILE: /members/signup/processpayment.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (CREDITCARDPAYMENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$url_redirect = "".DEFAULT_URL."/members/signup";
	$url_base = "".DEFAULT_URL."/members";
	$members = 1;
	$is_listing = false;
	
	$listingPaid = db_getFromDB("listing", "account_id", $acctId, "1");

	if ($listingPaid->getNumber("id")){
		$is_listing = true;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$process = "signup";
	include(INCLUDES_DIR."/code/billing_".$payment_method.".php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");
    
?>

	<div class="extendedContent">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
		
		<ul class="standardStep">
			<li class="standardStepAD"><?=system_showText(LANG_LABEL_EASY_AND_FAST);?> <span><?=system_showText(LANG_THREESTEPS)?> &raquo;</span></li>
			<li class="stepDone"><span>1</span>&nbsp;<?=system_showText(LANG_LABEL_ORDER)?></li>
			<li class="stepActived"><span>2</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
			<li><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CONFIGURATION)?></li>
		</ul>

	</div>

	<div class="extendedContent">

		<h2><?=system_showText(LANG_LABEL_PAYMENTSTATUS);?></h2>

		<?
		if ($payment_success == "y") {
			$contentObj = new Content("", EDIR_LANGUAGE);
			$content = $contentObj->retrieveContentByType("Transaction");
			if ($content) {
				echo "<div class=\"dynamicContent\">".$content."</div>";
			}
		}
		?>

		<?
		if ($payment_message) { 
			echo $payment_message;
		}
		?>

		<?
		if ($payment_success == "y") {

			$listingPaid = db_getFromDB("listing", "account_id", $acctId, "1", "title", "array", false, true);
			if ($listingPaid) {
				$next = DEFAULT_URL."/members/".LISTING_FEATURE_FOLDER."/listing.php?id=".$listingPaid["id"]."&process=signup";		
			}

			$eventPaid = db_getFromDB("event", "account_id", $acctId, "1", "title", "array", false, true);
			if ($eventPaid) {
				$next = DEFAULT_URL."/members/".EVENT_FEATURE_FOLDER."/event.php?id=".$eventPaid["id"]."&process=signup";
			}
			
			$langIndex = language_getIndex(EDIR_LANGUAGE);
			$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
			$endExpr = ")";

			if (count($arrLangs) > 1) {
				$fields .= "*, IF (`caption".$langIndex."` != '', `caption".$langIndex."`, ";
				foreach ($arrLangs as $lang) {
					if ($langIndex != $lang) {
						$fields .= "IF (`caption".$lang."` != '', `caption".$lang."`, ";
						$endExpr .= ")";
					}
				}

				$fields .= "''".$endExpr." AS `caption`";
				} else {
				$fields = "*, `caption".$langIndex."` AS `caption`";
			}

			$bannerPaid = db_getFromDB("banner", "account_id", $acctId, "1", "caption", "array", false, true, $fields);
			if ($bannerPaid) {
				$next = DEFAULT_URL."/members/".BANNER_FEATURE_FOLDER."/edit.php?id=".$bannerPaid["id"]."&process=signup";
			}

			$classifiedPaid = db_getFromDB("classified", "account_id", $acctId, "1", "title", "array", false, true);
			if ($classifiedPaid) {
				$next = DEFAULT_URL."/members/".CLASSIFIED_FEATURE_FOLDER."/classified.php?id=".$classifiedPaid["id"]."&process=signup";
			}

			$articlePaid = db_getFromDB("article", "account_id", $acctId, "1", "title", "array", false, true);
			if ($articlePaid) {
				$next = DEFAULT_URL."/members/".ARTICLE_FEATURE_FOLDER."/article.php?id=".$articlePaid["id"]."&process=signup";
			}

			?>

			<p class="informationMessage">
				<?=system_showText(LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP);?><br />
				<?=system_showText(LANG_MSG_IF_IT_DOES_NOT_WORK);?> <a href="<?=$next?>"><?=system_showText(LANG_LABEL_CLICK_HERE);?></a>.
			</p>

			<script language="javascript" type="text/javascript">
				window.setTimeout("window.location='<?=$next?>'", 10000);
			</script>

			<?
			$contentObj = new Content("", EDIR_LANGUAGE);
			$content = $contentObj->retrieveContentByType("Transaction Bottom");
			if ($content) {
				echo "<div class=\"dynamicContent\">".$content."</div>";
			}
			?>

		<? } ?>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
