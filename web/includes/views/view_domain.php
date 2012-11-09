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
	# * FILE: /includes/views/view_domain.php
	# ----------------------------------------------------------------------------------------------------

?>

<table cellpadding="2" cellspacing="0" class="table-account">
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=string_ucwords(system_showText(LANG_SITEMGR_DOMAIN_NAME))?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account" title="<?=$domain->getString("name")?>">
				<?=$domain->getString("name");?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=string_ucwords(system_showText(LANG_SITEMGR_DOMAIN_URL))?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account" title="<?=$domain->getString("url")?>">
				<?=$domain->getString("url");?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=string_ucwords(system_showText(LANG_SITEMGR_DOMAIN_SERVER_INFO))?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?
					$domain_host = $domain->getString("database_host").($domain->getString("database_port")? " : ".$domain->getString("database_port"): "");
				?>
				<?=$domain_host;?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=string_ucwords(system_showText(LANG_SITEMGR_DATECREATED))?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account" title="<?=$domain->getDate("created")?>">
				<?=$domain->getDate("created");?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=string_ucwords(system_showText(LANG_SITEMGR_DOMAIN_ACTIVATION))?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?
					$domain->changeActivationStatus();
					$itemStatus = new ItemStatus();
					echo $itemStatus->getStatusWithStyle($domain->getString("activation_status"));
					unset($itemStatus);
				?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=string_ucwords(system_showText(LANG_SITEMGR_DOMAIN_CREATED_BY))?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<?
				if ($domain->getNumber("smaccount_id")) {
					$SMAccountObj = new SMAccount($domain->getNumber("smaccount_id"));
					$username = $SMAccountObj->getString("username");
				} else {
					setting_get("sitemgr_username", $username);
				}
			?>
			<span class="label-field-account" title="<?=$username;?>">
				<?=$username;?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=string_ucwords(system_showText(LANG_SITEMGR_ARTICLE))?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?=$domain->getString("article_feature");?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=string_ucwords(system_showText(LANG_SITEMGR_BANNER))?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?=$domain->getString("banner_feature");?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=string_ucwords(system_showText(LANG_SITEMGR_CLASSIFIED))?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?=$domain->getString("classified_feature");?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=string_ucwords(system_showText(LANG_SITEMGR_EVENT))?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?=$domain->getString("event_feature");?>
			</span>
		</td>
	</tr>
</table>
