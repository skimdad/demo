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
	# * FILE: /includes/tables/table_content.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if ($contents) { ?>

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
			<td class="td-th-table">
				<?=system_showText(LANG_SITEMGR_LASTUPDATED)?>
			</td>
			<td class="td-th-table" style="width: 60px;"><?=system_showText(LANG_LABEL_OPTIONS)?></td>
		</tr>

		<?
		foreach($contents as $content) {
			$id = $content->getNumber("id");
			if ( $id == 68 ) {
				if ( MODREWRITE_FEATURE == 'off' ) continue;
				elseif ( SITEMAP_FEATURE == 'off' ) continue;
			}
		?>

			<tr class="tr-table">
				<td class="td-table">
					<? if ($section == "client"){ ?>
						<a href="custom.php?id=<?=$id?>" class="link-table">
							<?=$content->getString("type")?>
						</a>
					<? } else { ?>
						<a href="content.php?id=<?=$id?>" class="link-table">
							<?=$content->getString("type")?>
						</a>
					<? } ?>
				</td>
				<td class="td-table">
					<?
					if ($content->getNumber("updated") == 0) {
						echo system_showText(LANG_SITEMGR_NOTUPDATED);
					} else {
						echo format_date($content->getNumber("updated"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($content->getNumber("updated"));
					}
					?>
				</td>
				<td class="td-table">
					<? if ($section == "client"){ ?>
						<a href="custom.php?id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
						</a>
					<? } else { ?>
						<? if ((($content->getString("section") == "general") || (string_strpos($content->type, "Advertisement") === false)) 
						&& (string_strpos($content->type, "Bottom") === false) && ($content->getString("section") != "member")) { ?>
							<a href="content.php?id=<?=$id?>" class="link-table">
								<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
							</a>
						<? } else { ?>
							<img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
						<? } ?>
					<? } ?>
					<? if ($section == "client"){ ?>
						<a href="custom.php?id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
						</a>
					<? } else { ?>
						<a href="content.php?id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
						</a>
					<? } ?>
					<? if ($content->getString("section") == "client") { ?>
						<a href="delete.php?id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
						</a>
					<? } else { ?>
						<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
					<? } ?>
				</td>
			</tr>

			<?
		}
		?>

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
	

<? } ?>
