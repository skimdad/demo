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
	# * FILE: /includes/forms/form_paymentsettings_paymentgateway.php
	# ----------------------------------------------------------------------------------------------------

?>
	<table id="payment_setting_title" onclick="showSettings(this.id);" class="standard-table">
		<tr>
			<th class="standard-tabletitle">
				<?=LANG_SITEMGR_SETTINGS_PAYMENT_INVOICEMANUAL?>
			</th>
		</tr>
	</table>

	<div id="payment_setting" class="defaultItems">
		<table class="standard-table left-table">
			<tr class="tr-form">
				<th>
					<? if ($invoice_payment == "on") { ?>
						<input type="checkbox" name="invoice_payment" checked="checked" class="inputCheck" />
					<? } else { ?>
						<input type="checkbox" name="invoice_payment" class="inputCheck" />
					<? } ?>
				</th>
				<td class="td-form">
					<div class="label-form"><?=system_showText(LANG_SITEMGR_INVOICE_PAYMENT)?></div>
				</td>
			</tr>
			<tr>
				<th>
					<? if ($manual_payment == "on") { ?>
						<input type="checkbox" name="manual_payment" checked="checked" class="inputCheck" />
					<? } else { ?>
						<input type="checkbox" name="manual_payment" class="inputCheck" />
					<? } ?>
				</th>
				<td class="td-form">
					<div class="label-form"><?=system_showText(LANG_SITEMGR_MANUAL_PAYMENT)?></div>
				</td>
			</tr>
		</table>
	</div>