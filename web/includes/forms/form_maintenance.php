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
	# * FILE: /includes/forms/form_foreignaccount.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="header-form">
	<?=system_showText(LANG_SITEMGR_SETTING_MAINTENANCE)?>
</div>

<? if ($message_maintenanceMode) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_maintenanceMode?>
	</div>
<? } ?>

<br />

<table cellpadding="2" cellspacing="0" border="0" class="table-form" width="100%">
	<tr>
		<td colspan="2">
			<div class="tip-base">
				<span class="warning" style="text-align: justify; font-size: 11px;"><a href="<?=DEFAULT_URL;?>/sitemgr/faq/faq.php?keyword=<?=urlencode("maintenance");?>" target="_blank"><?=system_showText(LANG_SITEMGR_MAINTENANCETIP)?></a></span>
			</div>
		</td>
	</tr>
	<tr class="tr-form">
		<input type="hidden" name="maintenance_mode" id="maintenance_mode" value="<?=$maintenance_mode?>" maxlength="3" />
	</tr>
</table>
