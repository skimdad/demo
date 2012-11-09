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
	# * FILE: /sitemgr/claim/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/claim";
	$url_base     = "".DEFAULT_URL."/sitemgr";

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$errorPage = DEFAULT_URL."/sitemgr/claim/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "");
	if ($id) {
		$claim = new Claim($id);
		if ((!$claim->getNumber("id")) || ($claim->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
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
			<h1><?=ucfirst  (system_showText(LANG_SITEMGR_CLAIM))?> - <?=system_showText(LANG_SITEMGR_DETAIL)?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_claim_submenu.php"); ?>

			<br />

			<div id="header-view"><?=system_showText(LANG_SITEMGR_VIEW)?> <?=string_ucwords(system_showText(LANG_SITEMGR_CLAIM))?> - <?=$claim->getString("listing_title")?></div>

			<br />

			<table border="0" cellpadding="2" cellspacing="2" class="standard-table">
				<tr>
					<th><?=system_showText(LANG_SITEMGR_STATUS)?>:</th>
					<td><?=@system_showText(constant("LANG_SITEMGR_CLAIM_STATUS_".string_strtoupper($claim->getString("status"))))?></td>
				</tr>
				<tr>
					<th><?=string_ucwords(system_showText(LANG_SITEMGR_ACCOUNT))?>:</th>
					<td>
						<?
						if ($claim->getNumber("account_id")) {
							echo "<a href=\"".$url_base."/account/view.php?id=".$claim->getNumber("account_id")."\" class=\"link-table\">";
						}
						echo system_showAccountUserName($claim->getString("username"));
						if ($claim->getNumber("account_id")) {
							echo "</a>";
						}
						?>
					</td>
				</tr>
				<tr>
					<th><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING))?>:</th>
					<td>
						<?
						if ($claim->getNumber("listing_id")) {
							echo "<a href=\"".$url_base."/".LISTING_FEATURE_FOLDER."/view.php?id=".$claim->getNumber("listing_id")."\" class=\"link-table\">";
						}
						echo $claim->getString("listing_title");
						if ($claim->getNumber("listing_id")) {
							echo "</a>";
						}
						?>
					</td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_SITEMGR_IMPORT_DATETIME)?>:</th>
					<td><?=format_date($claim->getString("date_time"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($claim->getNumber("date_time"));?></td>
				</tr>
			</table>

			<?
			if ($claim->getNumber("account_id")) {
				$account = new Account($claim->getNumber("account_id"));
				$contact = new Contact($claim->getNumber("account_id"));
				?><br /><div id="header-view"><?=system_showText(LANG_SITEMGR_ACCOUNT_TITLEACCOUNTCONTACT)?></div><?
				?><div style="text-align:left; padding-left:20px"><?
					include(INCLUDES_DIR."/views/view_account.php");
				?></div><?
				?><div style="text-align:left; padding-left:20px"><?
					include(INCLUDES_DIR."/views/view_contact.php");
				?></div><?
			}
			?>

			<?
			if ($claim->getNumber("listing_id")) {
				$level = new ListingLevel();
				$listing = new Listing($claim->getNumber("listing_id"));
				?><br /><div id="header-view"><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING))?> <?=system_showText(LANG_SITEMGR_INFORMATION)?></div><br /><?
				?><a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/preview.php?id=<?=$listing->getNumber("id")?>" class="standardLINK iframe fancy_window_preview"><?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW)?> <?=system_showText(LANG_SITEMGR_LISTING)?></a><?
			}
			?>

			<br />

			<div id="header-view"><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING))?> - <?=system_showText(LANG_SITEMGR_INFORMATION)?></div>

			<br />

			<table class="view-claim-table">
				<tr>
					<th class="empty-cell-claim">&nbsp;</th>
					<th><?=system_showText(LANG_SITEMGR_OLD)?></th>
					<th><?=system_showText(LANG_SITEMGR_NEW)?></th>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING))?> <?=system_showText(LANG_SITEMGR_TITLE)?>:</td>
					<td><?="&nbsp;".$claim->getString("old_title");?></td>
					<td <? if ($claim->getString("old_title") != $claim->getString("new_title")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$claim->getString("new_title");?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_FRIENDLYURL)?>:</td>
					<td><?="&nbsp;".string_substr($claim->getString("old_friendly_url"), 0, 40);?></td>
					<td <? if ($claim->getString("old_friendly_url") != $claim->getString("new_friendly_url")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".string_substr($claim->getString("new_friendly_url"), 0, 40);?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</td>
					<td><?="&nbsp;".$claim->getString("old_email");?></td>
					<td <? if ($claim->getString("old_email") != $claim->getString("new_email")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$claim->getString("new_email");?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_URL)?>:</td>
					<td><?="&nbsp;".string_substr($claim->getString("old_url"), 0, 40);?></td>
					<td <? if ($claim->getString("old_url") != $claim->getString("new_url")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".string_substr($claim->getString("new_url"), 0, 40);?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_PHONE)?>:</td>
					<td><?="&nbsp;".$claim->getString("old_phone");?></td>
					<td <? if ($claim->getString("old_phone") != $claim->getString("new_phone")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$claim->getString("new_phone");?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_FAX)?>:</td>
					<td><?="&nbsp;".$claim->getString("old_fax");?></td>
					<td <? if ($claim->getString("old_fax") != $claim->getString("new_fax")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$claim->getString("new_fax");?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_ADDRESS)?>:</td>
					<td><?="&nbsp;".$claim->getString("old_address");?></td>
					<td <? if ($claim->getString("old_address") != $claim->getString("new_address")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$claim->getString("new_address");?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LABEL_ADDRESS2)?>:</td>
					<td><?="&nbsp;".$claim->getString("old_address2");?></td>
					<td <? if ($claim->getString("old_address2") != $claim->getString("new_address2")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$claim->getString("new_address2");?>
					</td>
				</tr>

				<?
				$_locations = explode(",", EDIR_LOCATIONS);
				foreach ($_locations as $_location_level) {
					?>
					<tr>
						<td class="claim-listing-label"><?=system_showText((constant("LANG_SITEMGR_LABEL_".constant("LOCATION".$_location_level."_SYSTEM"))))?>:</td>
						<td>
							<?
							$location_array = db_getFromDB('location'.$_location_level, 'id', $claim->getString("old_location_".$_location_level), 1, '', 'array');
							echo $location_array['name'];							
							?>
						</td>
						<td <? if ($claim->getString("old_location_".$_location_level) != $claim->getString("new_location_".$_location_level)) echo "class=\"new-claim-info\""; ?>>
							<?
							$location_array = db_getFromDB('location'.$_location_level, 'id', $claim->getString("new_location_".$_location_level), 1, '', 'array');
							echo $location_array['name'];
							?>
						</td>
					</tr>
					<?
				}
				?>				
				<tr>
					<td class="claim-listing-label"><?=string_ucwords(ZIPCODE_LABEL)?>:</td>
					<td><?="&nbsp;".$claim->getString("old_zip_code");?></td>
					<td <? if ($claim->getString("old_zip_code") != $claim->getString("new_zip_code")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$claim->getString("new_zip_code");?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_TEMPLATE)?>:</td>
					<? $oldlistingtemplate = new ListingTemplate($claim->getString("old_listingtemplate_id")); ?>
					<? $newlistingtemplate = new ListingTemplate($claim->getString("new_listingtemplate_id")); ?>
					<td><?="&nbsp;".$oldlistingtemplate->getString("title");?></td>
					<td <? if ($claim->getString("old_listingtemplate_id") != $claim->getString("new_listingtemplate_id")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$newlistingtemplate->getString("title");?>
					</td>
				</tr>
				<tr>
					<td class="claim-listing-label"><?=system_showText(LANG_SITEMGR_LEVEL)?>:</td>
					<? $level = new ListingLevel(); ?>
					<td><?="&nbsp;".$level->showLevel($claim->getString("old_level"));?></td>
					<td <? if ($claim->getString("old_level") != $claim->getString("new_level")) echo "class=\"new-claim-info\""; ?>>
						<?="&nbsp;".$level->showLevel($claim->getString("new_level"));?>
					</td>
				</tr>
			</table>

			<br />

			<table style="margin: 0 auto 0 auto;">
				<tr>
					<td>
						<? if ($claim->canApprove()) { ?>
							<button type="button" name="submit_button" class="input-button-form" onclick="window.location='<?=$url_redirect?>/approve.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&".addslashes($url_search_params) : "")?>'" style="width: 200px;"><?=system_showText(LANG_SITEMGR_CLAIM_APPROVETHIS)?></button>
						<? } ?>
					</td>
					<td>
						<? if ($claim->canDeny()) { ?>
							<button type="button" name="submit_button"class="input-button-form" onclick="window.location='<?=$url_redirect?>/deny.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&".addslashes($url_search_params) : "")?>';" style="width: 200px;"><?=system_showText(LANG_SITEMGR_CLAIM_DENYTHIS)?></button>
						<? } ?>
					</td>
				</tr>
			</table>
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
