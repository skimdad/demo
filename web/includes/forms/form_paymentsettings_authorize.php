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
	# * FILE: /includes/forms/form_paymentsettings_authorizesettings.php
	# ----------------------------------------------------------------------------------------------------
	
?>

	<table class="standard-table left-table">
		<tr><th colspan="2"><div class="divisor"></div><th/></tr>
		<tr>
			<th>
				<? if ($payment_authorizeStatus == "on") { ?>
					<input type="checkbox" class="inputCheck" name="payment_authorizeStatus" id="authorize" onclick="enableForm('authorize')" checked="checked"/>
				<? } else { ?>
					<input type="checkbox" class="inputCheck" name="payment_authorizeStatus" id="authorize" onclick="enableForm('authorize')"/>
				<? } ?>
			</th>
			<td class="td-form">
				<div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_AUTHORIZEINFORMATION)?></div>
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
	
	<? if ($payment_authorizeStatus == "on") { ?>
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="authorize_form">
	<? } else { ?>
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="authorize_form" <?=(${'authorize_form'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
	<? } ?>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_LOGIN)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="authorize_login" value="<?=htmlspecialchars( stripslashes($authorize_login) )?>" class="input-form-adminemail" />
            <span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> test1234 </span>
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_TRANSACTIONKEY)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="authorize_txnkey" value="<?=htmlspecialchars( stripslashes($authorize_txnkey) )?>" class="input-form-adminemail" />
            <span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> 12aB34cD56eF78gH </span>
		</td>
	</tr>
	
	<tr>
	<? if ($payment_authorizeStatus == "on") {?>
		<? if ($authorize_recurringCheckbox == "on") {?>
			<td align="right" class="td-form" id="authorize_recurring">
				<input type="checkbox" name="authorize_recurringCheckbox" id="authorize_recurringCheckbox" onclick="enableRecurringForm('authorize')" checked="checked" class="inputCheck" />
			</td>
		<? } else { ?>
			<td align="right" class="td-form" id="authorize_recurring">
				<input type="checkbox" name="authorize_recurringCheckbox" id="authorize_recurringCheckbox" onclick="enableRecurringForm('authorize')" class="inputCheck" />
			</td>
		<? } ?>
	<? } else { ?>
		<td align="right" class="td-form" id="authorize_recurring" style="display:none;">
			<input type="checkbox" name="authorize_recurringCheckbox" id="authorize_recurringCheckbox" onclick="enableRecurringForm('authorize')" class="inputCheck" />
		</td>
	<? } ?>
		<td align="left">
			<?=system_showText(LANG_SITEMGR_SETTINGS_RECURRING)?>
		</td>
	</tr>
</table>

	
	<? if ($authorize_recurringCheckbox == "on") { ?>
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="authorizeRecurring_form">
	<? } else { ?>
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="authorizeRecurring_form" <?=(${'authorizeRecurring_form'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
	<? } ?>

		<tr class="tr-form">
			<td align="right" class="td-form">
				<div class="label-form">
					<?=system_showText(LANG_SITEMGR_RECURRING_PERIOD." (".LANG_SITEMGR_REPORT_LABEL_MONTH.")")?>:
				</div>
			</td>
			<td align="left" class="td-form" style="width: 400px;">
				<? if ($authorize_recurringCheckbox == "on") { 
					if ($authorize_recurringlength == "1") { ?>
						<input type="radio" name="recurringlength_authorize" checked="checked" value="1" class="inputAlign"/>1
					<? } else { ?>
						<input type="radio" name="recurringlength_authorize" value="1" class="inputAlign"/>1
					<? } 
					if ($authorize_recurringlength == "12") { ?>
						<input type="radio" name="recurringlength_authorize" checked="checked" value="12" class="inputAlign"/>12
					<? } else { ?>
						<input type="radio" name="recurringlength_authorize"  value="12" class="inputAlign"/>12
					<? } 
				} else { ?>
					<input type="radio" name="recurringlength_authorize" checked="checked" value="1" class="inputAlign"/>1
					<input type="radio" name="recurringlength_authorize"  value="12" class="inputAlign"/>12
				<? } ?>
			</td>
		</tr>
	</table>

	
	
	