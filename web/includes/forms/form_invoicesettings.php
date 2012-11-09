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
	# * FILE: /includes/forms/form_invoicesettings.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="header-form">
	<?=system_showText(LANG_SITEMGR_INVOICE_MODIFYINVOICESTATUS)?> - <?=$invoiceObj->getString("id")?>
</div>
<? if ($message_invoicesettings) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_invoicesettings?>
	</div>
<? } ?>
<table cellpadding="2" cellspacing="0" class="table-form table-form-margin">
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_STATUS)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<?=$statusDropDown?>
		</td>
	</tr>
</table>