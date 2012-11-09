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
	# * FILE: /includes/tables/table_notifications.php
	# ----------------------------------------------------------------------------------------------------
?>

<table class="table-subtitle-table">
	<tr class="tr-subtitle-table">
		
		
		<td class="td-subtitle-table">
			<img src="<?=DEFAULT_URL?>/images/icon_check.gif" alt="<?=string_strtolower(system_showText(LANG_SITEMGR_ACTIVATED))?>" title="<?=string_strtolower(system_showText(LANG_SITEMGR_ACTIVATED))?>" border="0" />
		</td>
		<td class="td-subtitle-table">
			<font class="font-subtitle-table">
				<?=string_ucwords(system_showText(LANG_SITEMGR_ACTIVATED))?>
			</font>
		</td>
		
		<td class="td-subtitle-table">
			<img src="<?=DEFAULT_URL?>/images/icon_uncheck.gif" alt="<?=string_strtolower(system_showText(LANG_SITEMGR_DEACTIVATED))?>" title="<?=string_strtolower(system_showText(LANG_SITEMGR_DEACTIVATED))?>" border="0" />
		</td>
		<td class="td-subtitle-table">
			<font class="font-subtitle-table">
				<?=string_ucwords(system_showText(LANG_SITEMGR_DEACTIVATED))?>
			</font>
		</td>
		<td class="td-subtitle-table">
			<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
		</td>
		<td class="td-subtitle-table">
			<font class="font-subtitle-table">
				<?=string_ucwords(system_showText(LANG_SITEMGR_EDIT))?>
			</font>
		</td>
	</tr>
</table>

<? if ($message) { ?>
    <table border="0" width="95%" cellpadding="1" cellspacing="0" class="table-subtitle-table" >
        <tr class="tr-subtitle-table">
            <td align="center">
                <p class="successMessage"><?=$message?></p>
            </td>
        </tr>
    </table>
<? } ?>

<table class="table-table">
	<tr class="th-table">
		<td class="td-th-table" width="100%">
			<?=system_showText(LANG_SITEMGR_LABEL_NAME)?>
		</td>
		<td class="td-th-table" nowrap>
			<?=system_showText(LANG_SITEMGR_LABEL_ENABLED)?>
		</td>
		<td class="td-th-table" nowrap>
			<?=system_showText(LANG_SITEMGR_LABEL_TYPE)?>
		</td>
		<td class="td-th-table" nowrap>
			<?=system_showText(LANG_SITEMGR_STATUS)?>
		</td>
		<td class="td-th-table" nowrap>
			<?=system_showText(LANG_SITEMGR_LASTUPDATE)?>
		</td>
		<td class="td-th-table" nowrap>
			<?=system_showText(LANG_LABEL_OPTIONS)?>
		</td>
	</tr>
	<?
	if($emails) {
		foreach($emails as $email) { 
			$id = $email->getNumber("id"); 
	?>
		
		<tr class="tr-table">			
			
			<td class="td-table">
				<a href="email.php?id=<?=$id?>" class="link-table">
					<?=system_showText(@constant("LANG_SITEMGR_EMAILNOTIF_TYPE_".$id))?>
				</a>
			</td>
			
			<td class="td-table" style="text-align:center">
				<a href="<?=$url_redirect?>/index.php?id=<?=$email->getString("id")?>&deactive=<?=$email->getString("deactivate")?>"><img src="<?=DEFAULT_URL?>/images/<?=$email->getString('deactivate') == '0' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($email->getString('deactivate') == '0' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" title="<?=($email->getString('deactivate') == '0' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" /></a>            
			</td>
			
			<td class="td-table">
				<?=!$email->getNumber("days") ? system_showText(LANG_SITEMGR_SYSTEMNOTIFICATION) : system_showText(LANG_SITEMGR_RENEWALREMINDER)?>
			</td>
			
			<td class="td-table">
				<?=!$email->getNumber("deactivate") ? system_showText(LANG_SITEMGR_ACTIVE) : system_showText(LANG_SITEMGR_DISABLED) ?>
			</td>
			
			<td class="td-table">
			<?
				if($email->getNumber("updated") == 0) {
					echo system_showText(LANG_SITEMGR_NOTUPDATED);
				} else {
					echo format_date($email->getNumber("updated"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($email->getNumber("updated"));
				}
			?>
			</td>
			<td class="td-table">
				<a href="email.php?id=<?=$id?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
				</a>
			</td>
		</tr>
	<? 
		}
	} ?>
</table>
