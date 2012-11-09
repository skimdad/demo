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
	# * FILE: /includes/tables/table_content_special.php
	# ----------------------------------------------------------------------------------------------------
?>

<table border="0" cellspacing="0" cellpadding="0" class="standard-table">
	<tr>
		<th class="standard-tabletitle"><?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT_SPECIALCONTENTS))?></th>
	</tr>
</table>

<table class="table-subtitle-table">
	<tr class="tr-subtitle-table">
		<td class="td-subtitle-table">
			<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" border="0" />
		</td>
		<td class="td-subtitle-table">
			<font class="font-subtitle-table">
				<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>
			</font>
		</td>
		<td>&nbsp;</td>
		<td class="td-subtitle-table">
			<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" />
		</td>
		<td class="td-subtitle-table">
			<font class="font-subtitle-table">
				<?=system_showText(LANG_SITEMGR_EDIT)?>
			</font>
		</td>
		<td>&nbsp;</td>
		<td class="td-subtitle-table">
			<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" />
		</td>
		<td class="td-subtitle-table">
			<font class="font-subtitle-table">
				<?=system_showText(LANG_SITEMGR_DELETE)?>
			</font>
		</td>
	</tr>
</table>

<table class="table-table">
	<tr class="th-table">
		<td class="td-th-table">
			<?=system_showText(LANG_SITEMGR_LABEL_NAME)?>
		</td>
		<td class="td-th-table" style="width: 60px;"><?=system_showText(LANG_LABEL_OPTIONS)?></td>
	</tr>
	<tr class="tr-table">
		<td class="td-table">
			<a href="<?=DEFAULT_URL?>/sitemgr/content/content_header.php" class="link-table"><?=system_showText(LANG_SITEMGR_HEADER)?></a>
		</td>
		<td class="td-table">
			<a href="<?=DEFAULT_URL?>/sitemgr/content/content_header.php" class="link-table">
				<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
			</a>
			<a href="<?=DEFAULT_URL?>/sitemgr/content/content_header.php" class="link-table">
				<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
			</a>
			<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
		</td>
	</tr>
	<tr class="tr-table">
		<td class="td-table">
			<a href="<?=DEFAULT_URL?>/sitemgr/content/content_footer.php" class="link-table"><?=system_showText(LANG_SITEMGR_FOOTER)?></a>
		</td>
		<td class="td-table">
			<img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
			<a href="<?=DEFAULT_URL?>/sitemgr/content/content_footer.php" class="link-table">
				<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
			</a>
			<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
		</td>
	</tr>
	<tr class="tr-table">
		<td class="td-table">
			<a href="<?=DEFAULT_URL?>/sitemgr/content/content_noimage.php" class="link-table"><?=system_showText(LANG_SITEMGR_CONTENT_DEFAULTIMAGE)?> </a> <span class="itemNote"></span>
		</td>
		<td class="td-table">
			<img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
			<a href="<?=DEFAULT_URL?>/sitemgr/content/content_noimage.php" class="link-table">
				<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
			</a>
			<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
		</td>
	</tr>
    <tr class="tr-table">
		<td class="td-table">
			<a href="<?=DEFAULT_URL?>/sitemgr/content/content_icon.php" class="link-table"><?=system_showText(LANG_SITEMGR_CONTENT_ICON)?> </a> <span class="itemNote"></span>
		</td>
		<td class="td-table">
			<img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
			<a href="<?=DEFAULT_URL?>/sitemgr/content/content_icon.php" class="link-table">
				<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
			</a>
			<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
		</td>
	</tr>
</table>
