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
	# * FILE: /includes/tables/table_account.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if (is_numeric($message) && isset($msg_account[$message])) { ?>
	<table border="0" width="95%" cellpadding="1" cellspacing="0" class="table-subtitle-table" >
		<tr class="tr-subtitle-table">
			<td align="center">
				<p class="successMessage"><?=$msg_account[$message]?></p>
			</td>
		</tr>
	</table>
<? } ?>

<? if ((!isset($legend))||($legend)) { ?>
	<table class="table-subtitle-table">
		<tr class="tr-subtitle-table">
			<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/bt_view.gif" alt="view" border="0" />
			</td>
			<td class="td-subtitle-table">
				<font class="font-subtitle-table">
					<?=system_showText(LANG_SITEMGR_VIEW)?>
				</font>
			</td>
			<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="edit" border="0" />
			</td>
			<td class="td-subtitle-table">
				<font class="font-subtitle-table">
					<?=system_showText(LANG_SITEMGR_EDIT)?>
				</font>
			</td>
			<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" alt="delete" border="0" />
			</td>
			<td class="td-subtitle-table">
				<font class="font-subtitle-table">
					<?=system_showText(LANG_SITEMGR_DELETE)?>
				</font>
			</td>
		</tr>
	</table>
<? } ?>

<table class="table-table">
	<tr class="th-table">
		<td class="td-th-table" style="width: 450px;">
			<?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>
		</td>
		<td class="td-th-table">
			<?=system_showText(LANG_SITEMGR_LASTLOGIN)?>
		</td>
		<? if (SOCIALNETWORK_FEATURE == "on") { ?>
			<td class="td-th-table">
				<?=system_showText(LANG_SITEMGR_LABEL_SECTION)?>
			</td>
		<? } ?>
		<td class="td-th-table" style="width: 6%;"><?=system_showText(LANG_LABEL_OPTIONS)?></td>
	</tr>
	<? foreach($accounts as $account) { ?>
		<? $id = $account->getNumber("id"); ?>
		<tr class="tr-table">
			<td class="td-table">
				<a href="<?=DEFAULT_URL?>/sitemgr/account/view.php?id=<?=$account->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table" title="<?=$account->getString("username")?>">
					<?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 50);?>
				</a>
			</td>
			<td class="td-table" nowrap>
				<? if ($account->getNumber("lastlogin") != 0) {
					$lastLogin_field = format_date($account->getNumber("lastlogin"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($account->getNumber("lastlogin"));
				} else $lastLogin_field = system_showText(LANG_SITEMGR_ACCOUNT_NEWACCOUNT); ?>
				<span title="<?=$lastLogin_field?>" style="cursor:default"><?=$lastLogin_field;?></span>
			</td>
			<? if (SOCIALNETWORK_FEATURE == "on") { ?>
				<td class="td-table" nowrap>
					<? if ($account->getString("is_sponsor") == "y") { ?>
						<?=system_showText(LANG_SITEMGR_SECTION_SPONSOR);?>
					<? } else if ($account->getString("is_sponsor") == "n" && $account->getString("has_profile") == "y") { ?>
						<?=system_showText(LANG_SITEMGR_LABEL_MEMBER);?>
					<? } ?>
				</td>
			<? } ?>
			<td class="td-table" nowrap>

				<a href="<?=DEFAULT_URL?>/sitemgr/account/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_view.gif" alt="<?=string_strtolower(system_showText(LANG_SITEMGR_VIEW))?>" title="<?=string_strtolower(system_showText(LANG_SITEMGR_VIEW))?>" border="0" />
				</a>

				<a href="<?=DEFAULT_URL?>/sitemgr/account/account.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
				</a>

				<? if (!DEMO_LIVE_MODE || ($account->getString("username") != "demo@demodirectory.com")) { ?>
					<a href="<?=DEFAULT_URL?>/sitemgr/account/delete.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" alt="<?=string_strtolower(system_showText(LANG_SITEMGR_DELETE))?>" title="<?=string_strtolower(system_showText(LANG_SITEMGR_DELETE))?>" border="0" />
					</a>
				<? } ?>

			</td>
		</tr>
	<? } ?>
</table>
<? if ((!isset($legend))||($legend)) { ?>
	<table class="table-subtitle-table">
		<tr class="tr-subtitle-table">
			<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/bt_view.gif" alt="view" border="0" />
			</td>
			<td class="td-subtitle-table">
				<font class="font-subtitle-table">
					<?=system_showText(LANG_SITEMGR_VIEW)?>
				</font>
			</td>
			<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="edit" border="0" />
			</td>
			<td class="td-subtitle-table">
				<font class="font-subtitle-table">
					<?=system_showText(LANG_SITEMGR_EDIT)?>
				</font>
			</td>
			<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" alt="delete" border="0" />
			</td>
			<td class="td-subtitle-table">
				<font class="font-subtitle-table">
					<?=system_showText(LANG_SITEMGR_DELETE)?>
				</font>
			</td>
		</tr>
	</table>
<? } ?>
