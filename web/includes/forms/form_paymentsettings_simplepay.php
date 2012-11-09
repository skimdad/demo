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
	# * FILE: /includes/forms/form_paymentsettings_simplepay.php
	# ----------------------------------------------------------------------------------------------------

?>
	<table id="simplepay_setting_title" onclick="showSettings(this.id);" class="standard-table">
		<tr>
			<th class="standard-tabletitle">
				<?=LANG_SITEMGR_SETTINGS_PAYMENT_SIMPLEPAY?>
			</th>
		</tr>
	</table>

	<div id="simplepay_setting" class="defaultItems">
		<table class="standard-table left-table">
			<tr>
				<th>
				<? if ($payment_simplepayStatus == "on") { ?>
					<input type="checkbox" class="inputCheck" name="payment_simplepayStatus" id="simplepay" onclick="enableForm('simplepay')" checked="checked"/>
				<? } else { ?>
					<input type="checkbox" class="inputCheck" name="payment_simplepayStatus" id="simplepay" onclick="enableForm('simplepay')"/>
				<? } ?>
				</th>
				<td class="td-form">
					<div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_SIMPLEPAYINFORMATION)?></div>
				</td>
			</tr>
		</table>

		<? if ($payment_simplepayStatus == "on") { ?>
			<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="simplepay_form" />
		<? } else { ?>
			<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="simplepay_form" <?=(${'simplepay_form'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
		<? } ?>

			<tr class="tr-form">
				<td align="right" class="td-form">
					<div class="label-form">
						<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_ACCESSKEY)?>:
					</div>
				</td>
				<td align="left" class="td-form">
					<input type="text" name="simplepay_accesskey" value="<?=htmlspecialchars( stripslashes($simplepay_accesskey) )?>" class="input-form-adminemail" />
					<span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> 12AB34CD56EF78GH90IJ </span>
				</td>
			</tr>

			<tr class="tr-form">
				<td align="right" class="td-form">
					<div class="label-form">
						<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_SECRETKEY)?>:
					</div>
				</td>
				<td align="left" class="td-form">
					<input type="text" name="simplepay_secretkey" value="<?=htmlspecialchars( stripslashes($simplepay_secretkey) )?>" class="input-form-adminemail" />
					<span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> 12Ab+34Cd+56Ef+78Gh+90Ij+12Ab+34Cd+56Ef+ </span>
				</td>
			</tr>

			<tr>
				<? if ($payment_simplepayStatus == "on") { ?>
					<? if ($simplepay_recurringCheckbox == "on") { ?>
						<td align="right" class="td-form" id="simplepay_recurring">
							<input type="checkbox" name="simplepay_recurringCheckbox" id="simplepay_recurringCheckbox" onclick="enableRecurringForm('simplepay')" checked="checked" class="inputCheck" />
						</td>
					<? } else { ?>
						<td align="right" class="td-form" id="simplepay_recurring">
							<input type="checkbox" name="simplepay_recurringCheckbox" id="simplepay_recurringCheckbox" onclick="enableRecurringForm('simplepay')" class="inputCheck" />
						</td>
					<? } ?>
				<? } else { ?>
					<td align="right" class="td-form" id="simplepay_recurring" style="display:none">
						<input type="checkbox" name="simplepay_recurringCheckbox" id="simplepay_recurringCheckbox" onclick="enableRecurringForm('simplepay')" class="inputCheck" />
					</td>
				<? } ?>
				<td align="left">
					<?=system_showText(LANG_SITEMGR_SETTINGS_RECURRING)?>
				</td>
			</tr>
		</table>

		<? if ($simplepay_recurringCheckbox == "on") { ?>
			<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="simplepayRecurring_form">
		<? } else { ?>
			<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="simplepayRecurring_form" <?=(${'simplepayRecurring_form'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
		<? } ?>
			<tr class="tr-form">
				<td align="right" class="td-form">
					<div class="label-form">
						<?=system_showText(LANG_SITEMGR_RECURRING_CYCLE)?>:
					</div>
				</td>

				<td align="left" class="td-form">
					<? if ($simplepay_recurringCheckbox == "on") { ?>
						<input type="text" name="recurringcycle_simplepay" value="<?=$simplepay_recurringcycle?>"/>
					<? } else { ?>
						<input type="text" name="recurringcycle_simplepay"/>
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
				<? if ($simplepay_recurringCheckbox == "on") {
					if ($simplepay_recurringunit == "month") { ?>
						<input type="radio" name="recurringunit_simplepay" checked="checked" value="month" class="inputAlign" />
						<?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?>
					<? } else { ?>
						<input type="radio" name="recurringunit_simplepay" value="month" class="inputAlign" />
						<?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?>
					<? }
					if ($simplepay_recurringunit == "year") { ?>
						<input type="radio" name="recurringunit_simplepay" checked="checked" value="year" class="inputAlign" />
						<?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?>
					<? } else { ?>
						<input type="radio" name="recurringunit_simplepay"  value="year" class="inputAlign" />
						<?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?>
					<? }
				} else { ?>
					<input type="radio" name="recurringunit_simplepay" checked="checked" value="month" class="inputAlign" />
					<?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?>
					<input type="radio" name="recurringunit_simplepay"  value="year" class="inputAlign" />
					<?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?>
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
					<? if ($simplepay_recurringCheckbox == "on") { ?>
						<input type="text" name="recurringtimes_simplepay" value="<?=$simplepay_recurringtimes?>"/>
						<span>*<?=system_showText(LANG_SITEMGR_ZERO_UNLIMITED)?></span>
					<? } else { ?>
						<input type="text" name="recurringtimes_simplepay"/>
						<span>*<?=system_showText(LANG_SITEMGR_ZERO_UNLIMITED)?></span>
					<? } ?>
				</td>
			</tr>
		</table>
	</div>