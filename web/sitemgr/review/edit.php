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
	# * FILE: /sitemgr/review/edit.php
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

	extract($_POST);
	extract($_GET);

	$queryString = "item_type=$item_type".($filter_id ? "&filter_id=1&item_id=$item_id" : '')."&screen=$screen&letter=$letter&item_screen=$item_screen&item_letter=$item_letter";
	$url_redirect = "".DEFAULT_URL."/sitemgr/review/index.php?".$queryString;
	$url_base     = "".DEFAULT_URL."/sitemgr";

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/review.php");

	$reviewObj = new Review($id);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>
<script language="javascript">

function setDisplayRatingLevel(level) {
  for(i = 1; i <= 5; i++) {
    var starImg = "img_rate_star_off.gif";
    if( i <= level ) {
      starImg = "img_rate_star_on.gif";
    }
    var imgName = 'star'+i;
    document.images[imgName].src="<?=DEFAULT_URL?>/images/content/"+starImg;
  }
}

function resetRatingLevel() {
  setDisplayRatingLevel(document.rate_form.rating.value);
}

function setRatingLevel(level) {
  document.rate_form.rating.value = level;
}
</script>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_REVIEW_EDITREVIEW)?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_review_submenu.php"); ?>

			<br />

			<form name="rate_form" action="<?=$_SERVER["PHP_SELF"].($_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '')?>" method="post">
			<input type="hidden" name="id" value="<?=$id?>" />
				<span class="informationMessage"><?=system_showText(LANG_SITEMGR_REVIEW_IPADDED)?></span>
				<? 
				$reviewObj->extract();
				include(INCLUDES_DIR."/forms/form_review_sitemgr.php"); 
				?>
				<table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto 0 auto;" align="center">
					<tr>
						<td><button type="submit" name="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button></td>
					</tr>
				</table>
			</form>
	
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