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
	# * FILE: /members/account/deals.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);
	$levelObj = new ListingLevel();
	setting_get('commenting_edir', $commenting_edir);
	setting_get('review_listing_enabled', $review_enabled);
	setting_get('review_article_enabled', $review_article_enabled);
	setting_get('review_promotion_enabled', $review_promotion_enabled);

	// required because of the cookie var
	$username = "";

	// Default CSS class for message box
	$message_style = "errorMessage";

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

		<? if (SOCIALNETWORK_FEATURE == "on") { ?>
			<h2><?=system_showText(LANG_LABEL_ACCOUNT_INFORMATION)?></h2>
		<? } else { ?>
			<h2><?=system_showText(LANG_LABEL_ACCOUNT_AND_CONTACT_INFO)?></h2>
		<? } ?>

		<?

		$contentObj = new Content("", EDIR_LANGUAGE);
		$content = $contentObj->retrieveContentByType("Manage Account");
		if ($content) {
			echo "<blockquote>";
				echo "<div class=\"dynamicContent\">".$content."</div>";
			echo "</blockquote>";
		}
		?>

		<? if($message){ ?>
			<p class="<?=$message_style?>"><?=$message?></p>
		<? } ?>

		
		<table cellpadding="0" cellspacing="0" border="0" class="standard-table tabsTable">
			<tr>
				<th class="tabsBase">
					<ul class="tabs">
						<? if (SOCIALNETWORK_FEATURE == "on") { ?>
						<li id="tab_1">
							<a href="<?=DEFAULT_URL;?>/members/account/account.php?type=tab_1"><?=system_showText(LANG_LABEL_PERSONAL_PAGE)?></a>
						</li>
						<? } ?>
						<li id="tab_2">
							<a href="<?=DEFAULT_URL;?>/members/account/account.php?type=tab_2"><?=system_showText(LANG_LABEL_ACCOUNT_SETTINGS)?></a>
						</li>
						<? if (($review_enabled == "on" || $review_article_enabled == "on" || $review_promotion_enabled) && $commenting_edir) { ?>
							<li id="tab_3">
								<a href="<?=DEFAULT_URL;?>/members/account/reviews.php"><?=system_showText(LANG_REVIEW_PLURAL)?></a>
							</li>
						<? } ?>
						<li id="tab_4">
							<a href="<?=DEFAULT_URL;?>/members/account/quicklists.php"><?=system_showText(LANG_LABEL_QUICKLIST)?></a>
						</li>
						<li id="tab_5" class="tabActived">
							<a href="<?=DEFAULT_URL;?>/members/account/deals.php"><?=system_showText(LANG_LABEL_ACCOUNT_DEALS)?></a>
						</li>
					</ul>
				</th>
			</tr>
		</table>

		<form name="quicklist" id="quicklist" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
			<input type="hidden" name="hiddenValue" value="" />
			<input type="hidden" id="changePage" name="changePage" />
			<? $members = true; ?>
			<div id="user_quicklists">
                <? include(system_getFrontendPath("socialnetwork/dealscontent.php")); ?>
			</div>
		</form>
		<?
		$contentObj = new Content("", EDIR_LANGUAGE);
		$content = $contentObj->retrieveContentByType("Manage Account Bottom");
		if ($content) {
			echo "<blockquote>";
				echo "<div class=\"dynamicContent\">".$content."</div>";
			echo "</blockquote>";
		}
		?>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>

<script language="javascript" type="text/javascript">

	function redirect (url) {
		window.location = url;
	}

	function formSubmit(form, module) {
		$('#changePage').val(module);
		form.submit();
	}
</script>