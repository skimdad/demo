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
	# * FILE: /includes/forms/form_paymentsettings_currency.php
	# ----------------------------------------------------------------------------------------------------

?>
	
	<table id="currency_setting_title" onclick="showSettings(this.id);" class="standard-table">
		<tr>
			<th class="standard-tabletitle">
				<?=LANG_SITEMGR_CURRENCY?>
			</th>
		</tr>
	</table>

	<div id="currency_setting" class="defaultItems">

		<table class="table-form left-table" id="currency_form">

			<tr>
				<td align="right" class="td-form">
					<div class="label-form">* <?=LANG_SITEMGR_CURRENCY_SYMBOL?>:</div>
				</td>
				<td>
					<input class="small-text-box" type="text" name="currency_symbol" value="<?=$currency_symbol?>"/>
				</td>
			</tr>
			<tr>
				<td align="right" class="td-form">
					<div class="label-form">* <?=LANG_SITEMGR_PAYMENT_CURRENCY?>:</div>
				</td>
				<td>
					<input class="small-text-box" type="text" name="payment_currency" value="<?=$payment_currency?>" maxlength="3"/>
				</td>
			</tr>
			
		</table>
		
	</div>