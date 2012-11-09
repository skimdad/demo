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
	# * FILE: /sitemgr/account/view.php
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

	$url_redirect = "".DEFAULT_URL."/sitemgr/account";
	$url_base = "".DEFAULT_URL."/sitemgr";

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$account = new Account($id);
		$contact = db_getFromDB("contact", "account_id", db_formatNumber($id));
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/account/".(($search_page) ? "search.php" : "index.php")."?screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
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
		<h1><?=(SOCIALNETWORK_FEATURE == "on" ? string_ucwords(system_showText(LANG_SITEMGR_VIEW_MEMBERACCOUNTS)) : string_ucwords(system_showText(LANG_SITEMGR_VIEW_SPONSORACCOUNTS)))?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

	<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
	<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
	<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

	<? if($account->getString("id") == 0){ ?>

		<p class="errorMessage"><?=system_showText(LANG_SITEMGR_ACCOUNT_MIGHTBEDELETED)?></p>

	<? } else { ?>

		<? include(INCLUDES_DIR."/tables/table_account_submenu.php"); ?>

		<script language="javascript" type="text/javascript">
			function accountLogin(action) {
				var url = "";
				if (action == 'profile' || action == 'edit_profile') {
					url = "<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)?>/members/sitemgraccess.php?account=<?=$account->getString("username")?>&action=" + action;
				} else {
					url = "<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)?>/members/sitemgraccess.php?account=<?=$account->getString("username")?>";
				}
				membersection = window.open(url, "member_section");
				membersection.focus();
			}
		</script>

		<br />

		<div id="header-view"><?=system_showText(LANG_SITEMGR_MANAGE)?> <?=string_ucwords(system_showText(LANG_SITEMGR_ACCOUNT))?></div>

		<div>
			<ul class="list-view">
				<li>
					<a href="<?=DEFAULT_URL?>/sitemgr/account/account.php?id=<?=$account->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
						<?=system_showText(LANG_SITEMGR_EDIT)?> <?=system_showText(LANG_SITEMGR_ACCOUNT_TITLEACCOUNTCONTACT)?>
					</a>
				</li>
				<? if (SOCIALNETWORK_FEATURE == "on") { ?>
				<li>
					<? if ($account->getString("has_profile") == 'y') { ?>
						<a href="javascript:accountLogin('profile');" class="link-view">
							<?=system_showText(LANG_SITEMGR_VIEW_USER_PROFILE)?>
						</a>
					<? } else {
						echo system_showText(LANG_SITEMGR_PROFILE_DISABLED);
					} ?>
				</li>
				<? } ?>
				<li>
					<a href="<?=DEFAULT_URL?>/sitemgr/account/delete.php?id=<?=$account->getNumber("id")?>" class="link-view">
						<?=system_showText(LANG_SITEMGR_DELETE)?> <?=string_ucwords(system_showText(LANG_SITEMGR_ACCOUNT))?>
					</a>
				</li>
				<li>
					<a href="javascript:accountLogin(<?=($account->getString("is_sponsor") == 'n' ? "'edit_profile'" : "")?>);" class="link-view"><?=system_showText(LANG_SITEMGR_LOGIN)?></a> <?=system_showText(LANG_SITEMGR_INTOTHISACCOUNT)?>
				</li>
				<li>
					<a href="<?=DEFAULT_URL?>/sitemgr/account/forgot.php?id=<?=$id?>" class="link-view">
						<?=system_showText(LANG_SITEMGR_ACCOUNT_FORGOTEMAILLINK)?>
					</a>
				</li>
			</ul>
		</div>

		<div id="header-view">
			<?=string_ucwords(system_showText(LANG_SITEMGR_ACCOUNT))?>
		</div>

		<div style="text-align:left; padding-left:20px">
			<? include(INCLUDES_DIR."/views/view_account.php"); ?>
		</div>

		<div id="header-view">
			<?=system_showText(LANG_SITEMGR_CONTACT)?>
		</div>

		<div style="text-align:left; padding-left:20px">
			<? include(INCLUDES_DIR."/views/view_contact.php"); ?>
		</div>

		<? if ($account->getString("is_sponsor") == 'y') { ?>
			<div id="header-view">
				<?=ucfirst(system_showText(LANG_SITEMGR_ITEMS))?>
			</div>

			<? include(INCLUDES_DIR."/tables/table_account_items.php"); ?>
		<? } ?>

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
