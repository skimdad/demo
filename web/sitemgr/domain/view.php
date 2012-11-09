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
	# * FILE: /sitemgr/domain/view.php
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

	$url_redirect = "".DEFAULT_URL."/sitemgr/domain";
	$url_base = "".DEFAULT_URL."/sitemgr";

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$domain = new Domain($id);
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/domain/".(($search_page) ? "search.php" : "index.php")."?screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
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
		<h1><?=string_ucwords(system_showText(LANG_SITEMGR_VIEW_DOMAIN))?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

	<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
	<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
	<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

	<? if($domain->getString("id") == 0){ ?>

		<p class="errorMessage"><?=system_showText(LANG_SITEMGR_DOMAIN_MIGHTBEDELETED)?></p>

	<? } else { ?>

		<? include(INCLUDES_DIR."/tables/table_domain_submenu.php"); ?>

		<br />
		
		<div id="header-view"><?=system_showText(LANG_SITEMGR_MANAGE);?> <?=string_ucwords(system_showText(LANG_SITEMGR_DOMAIN));?>: <?=$domain->getString("name");?></div>
		<div>
			<ul class="list-view">
				<li>
					<?
						$domainUrl = "http://".$domain->getString("url").EDIRECTORY_FOLDER;
					?>
					<a href="<?=$domainUrl;?>" class="link-view" target="_blank">
						<?=system_showText(LANG_SITEMGR_VISIT_THIS_DOMAIN);?>
					</a>
				</li>
				<? if (($domain->getNumber("id") != SELECTED_DOMAIN_ID) && ($domain->getString("url") != $_SERVER["HTTP_HOST"]) && (!sess_getSMIdFromSession())) { ?>
					<li>
						<a href="<?=DEFAULT_URL?>/sitemgr/domain/delete.php?id=<?=$domain->getNumber("id")?>" class="link-view">
							<?=system_showText(LANG_SITEMGR_DELETE)?> <?=string_ucwords(system_showText(LANG_SITEMGR_DOMAIN))?>
						</a>
					</li>
				<? } ?>
			</ul>
		</div>

		<div id="header-view">
			<?=string_ucwords(system_showText(LANG_SITEMGR_DOMAIN))?>
		</div>

		<div style="text-align:left; padding-left:20px">
			<? include(INCLUDES_DIR."/views/view_domain.php"); ?>
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
