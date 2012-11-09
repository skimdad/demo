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
	# * FILE: /includes/forms/form_paymentsettings_paypal.php
	# ----------------------------------------------------------------------------------------------------
	
?>
	<table id="paypal_setting_title" onclick="showSettings(this.id);" class="standard-table">
		<tr>
			<th class="standard-tabletitle">
				<?=LANG_SITEMGR_SETTINGS_PAYMENT_PAYPAL?>
			</th>
		</tr>
	</table>
	<div id="paypal_setting" class="defaultItems">
		<table class="standard-table left-table">
			<tr>
				<th>
				<? if ($payment_paypalStatus == "on") { ?>
					<input type="checkbox" class="inputCheck" name="payment_paypalStatus" id="paypal" onclick="enableForm('paypal')" checked="checked" />
				<? } else { ?>
					<input type="checkbox" class="inputCheck" name="payment_paypalStatus" id="paypal" onclick="enableForm('paypal')" />
				<? } ?>
				</th>
				<td class="td-form">
					<div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_PAYPALINFORMATION)?></div>
				</td>
			</tr>
		</table>

		<?
		if ($error)
			echo "<p class=\"errorMessage\">&#149;&nbsp;".$msg_error."</p>";
		else if ($success)
			echo "<p class=\"successMessage\">&#149;&nbsp;".$msg_success."</p>";
		unset($error);
		?>

		<? if ($payment_paypalStatus == "on") { ?>
			<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="paypal_form">
		<? } else { ?>
			<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="paypal_form" <?=(${'paypal_form'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
		<? } ?>



		<tr class="tr-form">
			<td align="right" class="td-form">
				<div class="label-form">
					<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_ACCOUNT)?>:
				</div>
			</td>
			<td align="left" class="td-form">
				<input type="text" name="paypal_account" value="<?=htmlspecialchars(stripslashes($paypal_account))?>" class="input-form-adminemail" />
				<span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> test@domain.com </span>
			</td>
		</tr>

		<tr>
			<? if ($payment_paypalStatus == "on") {?>
				<? if ($paypal_recurringCheckbox == "on") { ?>
					<td align="right" class="td-form" id="paypal_recurring">
						<input type="checkbox" name="paypal_recurringCheckbox" id="paypal_recurringCheckbox" onclick="enableRecurringForm('paypal')" checked="checked" class="inputCheck" />
					</td>
				<? } else { ?>
					<td align="right" class="td-form" id="paypal_recurring">
						<input type="checkbox" name="paypal_recurringCheckbox" id="paypal_recurringCheckbox" onclick="enableRecurringForm('paypal')" class="inputCheck" />
					</td>
				<? } ?>
			<? } else { ?>
				<td align="right" class="td-form" id="paypal_recurring" style="display:none;">
					<input type="checkbox" name="paypal_recurringCheckbox" id="paypal_recurringCheckbox" onclick="enableRecurringForm('paypal')" class="inputCheck" />
				</td>
			<? } ?>
			<td align="left">
				<?=system_showText(LANG_SITEMGR_SETTINGS_RECURRING)?>
			</td>
		</tr>
	</table>

		<? if ($paypal_recurringCheckbox == "on") { ?>
			<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="paypalRecurring_form">
		<? } else { ?>
			<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="paypalRecurring_form" <?=(${'paypalRecurring_form'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
		<? } ?>

			<tr class="tr-form">
				<td align="right" class="td-form">
					<div class="label-form">
						<?=system_showText(LANG_SITEMGR_RECURRING_CYCLE)?>:
					</div>
				</td>
				<td align="left" class="td-form">
					<? if ($paypal_recurringCheckbox == "on") { ?>
						<input type="text" name="recurringcycle_paypal" value="<?=$paypal_recurringcycle?>"/>
					<? } else { ?>
						<input type="text" name="recurringcycle_paypal"/>
					<? } ?>
				</td>
			</tr>

			<tr class="tr-form">
				<td align="right" class="td-form">
					<div class="label-form">
						<?=system_showText(LANG_SITEMGR_RECURRING_UNIT)?>:
					</div>
				</td>
				<td align="left" class="td-form">
					<? if ($paypal_recurringCheckbox == "on") {
						if ($paypal_recurringunit == "M") { ?>
							<input type="radio" name="recurringunit_paypal" checked="checked" value="M" class="inputAlign" /><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?>
						<? } else { ?>
							<input type="radio" name="recurringunit_paypal" value="M" class="inputAlign" /><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?>
						<? }
						if ($paypal_recurringunit == "Y") { ?>
							<input type="radio" name="recurringunit_paypal" checked="checked" value="Y" class="inputAlign" /><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?>
						<? } else { ?>
							<input type="radio" name="recurringunit_paypal" value="Y" class="inputAlign" /><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?>
						<? }
					} else { ?>
						<input type="radio" name="recurringunit_paypal" checked="checked" value="M" class="inputAlign" /><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?>
						<input type="radio" name="recurringunit_paypal" value="Y" class="inputAlign" /><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?>
					<? } ?>
				</td>
			</tr>

			<tr class="tr-form">
				<td align="right" class="td-form">
					<div class="label-form">
						<?=system_showText(LANG_SITEMGR_RECURRING_TIMES)?>:
					</div>
				</td>
				<td align="left" class="td-form">
					<? if ($paypal_recurringCheckbox == "on") { ?>
						<input type="text" name="recurringtimes_paypal" value="<?=$paypal_recurringtimes?>"/>
						<span><?=system_showText(LANG_SITEMGR_ZERO_UNLIMITED)?></span>
					<? } else { ?>
						<input type="text" name="recurringtimes_paypal"/>
						<span><?=system_showText(LANG_SITEMGR_ZERO_UNLIMITED)?></span>
					<? } ?>
				</td>
			</tr>
		</table>