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
	# * FILE: /includes/tables/table_smaccount.php
	# ----------------------------------------------------------------------------------------------------

if (is_numeric($message) && isset($msg_account[$message])) { ?>
	<table border="0" width="95%" cellpadding="1" cellspacing="0" class="table-subtitle-table" >
		<tr class="tr-subtitle-table">
			<td align="center">
				<p class="successMessage"><?=$msg_account[$message]?></p>
			</td>
		</tr>
	</table>
<? } ?>

<? if ((!isset($legend))||($legend)) { ?>

	<table class="table-subtitle-table" cellspacing="5">
			<tr class="tr-subtitle-table">
				<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/icon_check.gif" alt="<?=(system_showText(LANG_SITEMGR_ACTIVATED))?>" title="<?=(system_showText(LANG_SITEMGR_ACTIVATED))?>" border="0" />
			</td>
			<td class="td-subtitle-table">
				<font class="font-subtitle-table">
					<?=string_ucwords(system_showText(LANG_SITEMGR_ACTIVATED))?>
				</font>
			</td>

			<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/icon_uncheck.gif" alt="<?=(system_showText(LANG_SITEMGR_DEACTIVATED))?>" title="<?=(system_showText(LANG_SITEMGR_DEACTIVATED))?>" border="0" />
			</td>
			<td class="td-subtitle-table">
				<font class="font-subtitle-table">
					<?=string_ucwords(system_showText(LANG_SITEMGR_DEACTIVATED))?>
				</font>
			</td>
			<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/bt_view.gif" alt="<?=system_showText(LANG_SITEMGR_VIEW)?>" title="<?=system_showText(LANG_SITEMGR_VIEW)?>" border="0" />
			</td>
			<td class="td-subtitle-table">
				<font class="font-subtitle-table">
					<?=system_showText(LANG_SITEMGR_VIEW)?>
				</font>
			</td>
			<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=system_showText(LANG_SITEMGR_EDIT)?>" title="<?=system_showText(LANG_SITEMGR_EDIT)?>" border="0" />
			</td>
			<td class="td-subtitle-table">
				<font class="font-subtitle-table">
					<?=system_showText(LANG_SITEMGR_EDIT)?>
				</font>
			</td>
			<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
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
		<td class="td-th-table">
			<?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>
		</td>
		<td class="td-th-table">
			<?=system_showText(LANG_SITEMGR_LABEL_NAME)?>
		</td>
		<td class="td-th-table">
			<?=system_showText(LANG_SITEMGR_LABEL_CREATED)?>
		</td>
		<td class="td-th-table">
			<?=system_showText(LANG_SITEMGR_LABEL_ENABLED);?>
		</td>
		<td class="td-th-table" style="width: 6%;"><?=system_showText(LANG_LABEL_OPTIONS)?></td>
	</tr>
	<? $i = 0;
		foreach($smaccounts as $smaccount) { ?>
		<? 
		$i++;
		$id = $smaccount->getNumber("id"); ?>
		<tr class="tr-table">
			<td class="td-table">
				<a href="<?=DEFAULT_URL?>/sitemgr/smaccount/view.php?id=<?=$smaccount->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table" title="<?=$smaccount->getString("username")?>">
					<?=system_showTruncatedText(system_showAccountUserName($smaccount->getString("username")), 50);?>
				</a>
			</td>
			<td class="td-table" nowrap>
				<a href="<?=DEFAULT_URL?>/sitemgr/smaccount/view.php?id=<?=$smaccount->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table" title="<?=$smaccount->getString("name")?>">
					<?=system_showTruncatedText(system_showAccountUserName($smaccount->getString("name")), 50);?>
				</a>
			</td>
			<td class="td-table" nowrap>
				<?(($smaccount->getString("entered") != "0000-00-00 00:00:00") ? $created_field = (format_date($smaccount->getString("entered"), DEFAULT_DATE_FORMAT, "datetime"))." - ".format_getTimeString($smaccount->getString("entered")) : $created_field = "---")?>
				<a href="<?=DEFAULT_URL?>/sitemgr/smaccount/view.php?id=<?=$smaccount->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table" title="<?=$created_field?>">
					<?=$created_field?>
				</a>
			</td>
			<td id="tableSmaccount_rowId_<?=$i?>">
				<? if ($smaccount->getNumber("id") != $_SESSION[SESS_SM_ID]) { ?>
				<a href="javascript:void(0);" onclick="javascript:updateSMAccount(<?=$smaccount->getNumber("id")?>,'<?=$smaccount->getString('active')?>',<?=$i?>)">
					<img src="<?=DEFAULT_URL?>/images/<?=$smaccount->getString('active') == 'y' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($smaccount->getString('active') == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" title="<?=($smaccount->getString('active') == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" />
				</a>
				<? } else { ?>
					<img src="<?=DEFAULT_URL?>/images/<?=$smaccount->getString('active') == 'y' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($smaccount->getString('active') == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" title="<?=($smaccount->getString('active') == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" />
				<? } ?>
			</td>
			<td class="td-table" nowrap>

				<a href="<?=DEFAULT_URL?>/sitemgr/smaccount/view.php?id=<?=$smaccount->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_view.gif" alt="<?=system_showText(LANG_SITEMGR_VIEW)?>" title="<?=system_showText(LANG_SITEMGR_VIEW)?>" border="0" />
				</a>

				<a href="<?=DEFAULT_URL?>/sitemgr/smaccount/smaccount.php?id=<?=$smaccount->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=system_showText(LANG_SITEMGR_EDIT)?>" title="<?=system_showText(LANG_SITEMGR_EDIT)?>" border="0" />
				</a>

				<? if ($smaccount->getNumber("id") == $_SESSION[SESS_SM_ID]) { ?>
					<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
				<? } else { ?>
					<a href="<?=DEFAULT_URL?>/sitemgr/smaccount/delete.php?id=<?=$smaccount->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
					</a>
				<? } ?>

			</td>
		</tr>
	<? } ?>
</table>

<? if ((!isset($legend))||($legend)) { ?>

	<table class="table-subtitle-table" cellspacing="5">
		<tr class="tr-subtitle-table">
			<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/icon_check.gif" alt="<?=(system_showText(LANG_SITEMGR_ACTIVATED))?>" title="<?=(system_showText(LANG_SITEMGR_ACTIVATED))?>" border="0" />
			</td>
			<td class="td-subtitle-table">
				<font class="font-subtitle-table">
					<?=string_ucwords(system_showText(LANG_SITEMGR_ACTIVATED))?>
				</font>
			</td>

			<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/icon_uncheck.gif" alt="<?=(system_showText(LANG_SITEMGR_DEACTIVATED))?>" title="<?=(system_showText(LANG_SITEMGR_DEACTIVATED))?>" border="0" />
			</td>
			<td class="td-subtitle-table">
				<font class="font-subtitle-table">
					<?=string_ucwords(system_showText(LANG_SITEMGR_DEACTIVATED))?>
				</font>
			</td>
			<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/bt_view.gif" alt="<?=system_showText(LANG_SITEMGR_VIEW)?>" title="<?=system_showText(LANG_SITEMGR_VIEW)?>" border="0" />
			</td>
			<td class="td-subtitle-table">
				<font class="font-subtitle-table">
					<?=system_showText(LANG_SITEMGR_VIEW)?>
				</font>
			</td>
			<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=system_showText(LANG_SITEMGR_EDIT)?>" title="<?=system_showText(LANG_SITEMGR_EDIT)?>" border="0" />
			</td>
			<td class="td-subtitle-table">
				<font class="font-subtitle-table">
					<?=system_showText(LANG_SITEMGR_EDIT)?>
				</font>
			</td>
			<td class="td-subtitle-table">
				<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
			</td>
			<td class="td-subtitle-table">
				<font class="font-subtitle-table">
					<?=system_showText(LANG_SITEMGR_DELETE)?>
				</font>
			</td>
		</tr>
	</table>
<? } ?>
