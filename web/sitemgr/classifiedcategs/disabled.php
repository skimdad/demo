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
	# * FILE: /sitemgr/classifiedcategs/disabled.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") {
		header("Location: ".DEFAULT_URL."/sitemgr/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	//permission_hasSMPerm();
	if (!permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS)){
			header("Location: ".DEFAULT_URL."/sitemgr/");
			exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	//increases frequently actions
	if (!isset($message)) system_setFreqActions('classifiedcateg_disabled','CLASSIFIED_FEATURE');

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
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL))?> - <?=system_showText(LANG_SITEMGR_DISABLED_CATEGORIES)?> </h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			<?if (CUSTOM_CLASSIFIED_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>
			<? include(INCLUDES_DIR."/tables/table_category_submenu.php"); ?>


			<br />

			<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/categoriesdisabledtree.js"></script>
			<div id="classified_disabledCategoryTree">
				<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
					<tr>
						<th colspan="2" class="standard-tabletitle">
							<?=system_showText(LANG_SITEMGR_DISABLED_CATEGORIES)?>
						</th>
					</tr>
					<input type="hidden" name="return_categories" value="" />
					<tr>
						<td colspan="2" class="treeView">
							<ul id="classified_categorytree_id_0" class="categoryTreeview">&nbsp;</ul>
						</td>
					</tr>
				</table>
			</div>
			<? } ?>
		</div>
	</div>

	<div id="bottom-content">&nbsp;</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>


<script type="text/javascript">	
		$(document).ready(function(){
			showDisabledCategories('classified_', 'ClassifiedCategory','<?=DEFAULT_URL;?>','<?=SELECTED_DOMAIN_ID;?>');
		});
</script>
