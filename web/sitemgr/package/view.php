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
	# * FILE: /sitemgr/package/view.php
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

	$url_redirect = "".DEFAULT_URL."/sitemgr/package";
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$errorPage = DEFAULT_URL."/sitemgr/package/index.php?message=".$message."&screen=$screen&letter=$letter";
	if ($id) {
		$package = new Package($id);
		if ((!$package->getNumber("id")) || ($package->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}

		/*
		 * Get items of package
		 */
		unset($packageItemObj);
		$packageItemObj = new PackageItems();

		$array_package_items = $packageItemObj->getItemsByPackageId($id);
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		if(is_array($array_package_items)){
			unset($aux_package_items_domains,$aux_package_items_values);
			for($i=0;$i<count($array_package_items);$i++){
				$aux_package_items_domains[] = $array_package_items[$i]["domain_id"];
				$aux_package_items_values[$array_package_items[$i]["domain_id"]] = $array_package_items[$i]["price"];
				$aux_offer_item = $array_package_items[$i]["module"];
				$aux_offer_item_level = $array_package_items[$i]["level"];
				${"content".$langIndex} = $array_package_items[$i]["content".$langIndex];
				$price = $array_package_items[$i]["price"];
			}
		}

	} else {
		header("Location: ".$errorPage);
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
			<h1><?=system_showText(LANG_SITEMGR_PACKAGE_SING)?> - <?=system_showText(LANG_SITEMGR_DETAIL)?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
				<? if($package->getString("id") == 0){ ?>
					<p class="errorMessage"><?=system_showText(LANG_SITEMGR_PACKAGE_MIGHTBEDELETED)?></p>
				<? } else { ?>

					<? include(INCLUDES_DIR."/tables/table_package_submenu.php"); ?>

					<br />
					<div id="header-view" title="<?=$package->getString("title")?>"><?=system_showText(LANG_SITEMGR_MANAGE)?> <?=system_showText(LANG_SITEMGR_PACKAGE_SING)?> - <?=$package->getString("title", true, 35);?></div>

					<ul class="list-view columnListView">

						<li><a href="<?=DEFAULT_URL?>/sitemgr/package/package.php?id=<?=$package->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"><?=system_showText(LANG_SITEMGR_EDIT)?> <?=ucfirst(system_showText(LANG_SITEMGR_INFORMATION))?></a></li>
						<li>
							<a href="<?=DEFAULT_URL?>/sitemgr/package/settings.php?id=<?=$package->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"> <?=system_showText(LANG_SITEMGR_PACKAGE_SING)?> <?=system_showText(LANG_SITEMGR_MENU_SETTINGS)?></a>
						</li>
						<li>
							<a href="<?=DEFAULT_URL?>/sitemgr/package/delete.php?id=<?=$package->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"><?=system_showText(LANG_SITEMGR_DELETE)?> <?=system_showText(LANG_SITEMGR_PACKAGE_SING)?></a>
						</li>
					</ul>

					<ul class="list-view columnListView secondaryListView">
						<li><strong><?=system_showText(LANG_SITEMGR_LASTUPDATED)?>:</strong> <span class="label-field-account"><?=format_date($package->getNumber("updated"),DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($package->getNumber("updated"))?></span></li>
						<li><strong><?=system_showText(LANG_SITEMGR_DATECREATED)?>:</strong> <span class="label-field-account"><?=format_date($package->getNumber("entered"),DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($package->getNumber("entered"))?></span></li>
					</ul>

					<br class="clear" />

					<div id="header-view"><?=system_showText(LANG_SITEMGR_PACKAGE_SING)?> <?=system_showText(LANG_SITEMGR_PREVIEW)?></div>
					<div style="text-align:left; padding-left:20px">
						<? include(INCLUDES_DIR."/views/view_package.php"); ?>
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
