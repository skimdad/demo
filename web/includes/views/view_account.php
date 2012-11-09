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
	# * FILE: /includes/views/view_account.php
	# ----------------------------------------------------------------------------------------------------

?>

<table cellpadding="2" cellspacing="0" class="table-account">
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account" title="<?=$account->getString("username")?>">
				<?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 35);?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_LASTUPDATED)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?=format_date($account->getNumber("updated"), DEFAULT_DATE_FORMAT)." - ".format_getTimeString($account->getNumber("updated"))?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_DATECREATED)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?=format_date($account->getNumber("entered"), DEFAULT_DATE_FORMAT)." - ".format_getTimeString($account->getNumber("entered"))?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_LASTLOGIN)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?
				if ($account->getNumber("lastlogin") != 0) {
					echo format_dateFromDB($account->getNumber("lastlogin"), DEFAULT_DATE_FORMAT)." - ".format_getTimeString($account->getNumber("lastlogin"));
				} else echo system_showText(LANG_SITEMGR_ACCOUNT_NEWACCOUNT);
				?>
			</span>
		</td>
	</tr>
	<? if (SOCIALNETWORK_FEATURE == "on") { ?>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_SECTION)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?
				if ($account->getString("is_sponsor") == "y") {
					echo system_showText(LANG_SITEMGR_SECTION_SPONSOR);
				} else if ($account->getString("is_sponsor") == "n" && $account->getString("has_profile") == "y") {
					echo system_showText(LANG_SITEMGR_LABEL_MEMBER);
				}
				?>
			</span>
		</td>
	</tr>
	<? } ?>

	<?
	$account_domain = new Account_Domain();
	$array_domains = $account_domain->getAll($id);
	if (count($array_domains) > 1){

	?>

	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_DOMAIN_PLURAL)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?
				$str_domains = "";
				foreach($array_domains as $domain){
					$domain = new Domain($domain);
					$str_domains .= $domain->getString("name")."<br /> ";
				}
				//$str_domains = string_substr($str_domains,0,-2);
				echo $str_domains;
				?>
			</span>
		</td>
	</tr>
	<?}?>
</table>
