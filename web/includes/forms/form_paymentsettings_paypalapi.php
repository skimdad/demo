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
	# * FILE: /includes/forms/form_paymentsettings_paypalapi.php
	# ----------------------------------------------------------------------------------------------------
?>
	
	<table class="standard-table left-table">
		<tr><th colspan="2"><div class="divisor"></div><th/></tr>
		<tr>
			<th>	
				<? if ($payment_paypalapiStatus == "on") { ?>
					<input type="checkbox" class="inputCheck" name="payment_paypalapiStatus" id="paypalapi" onclick="enableForm('paypalapi')" checked="checked" />
				<? } else { ?>
					<input type="checkbox" class="inputCheck" name="payment_paypalapiStatus" id="paypalapi" onclick="enableForm('paypalapi')"/>
				<? } ?>	
			</th>
			<td class="td-form">
				<div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_PAYPALAPIINFORMATION)?></div>
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
	
	<? if ($payment_paypalapiStatus == "on") { ?>
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="paypalapi_form">
	<? } else { ?>
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="paypalapi_form" <?=(${'paypalapi_form'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
	<? } ?>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_USERNAME)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="paypalapi_username" value="<?=htmlspecialchars( stripslashes($paypalapi_username) )?>" class="input-form-adminemail" />
            <span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> business_api.domain.com </span>
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_PASSWORD)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="paypalapi_password" value="<?=htmlspecialchars( stripcslashes($paypalapi_password) )?>" class="input-form-adminemail" />
            <span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> 12AB34CD56EF78GH </span>
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_SIGNATURE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="paypalapi_signature" value="<?=htmlspecialchars($paypalapi_signature)?>" class="input-form-adminemail" />
            <span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> 12aB34cD56eF78gH90iJ12aB34cD56eF78gH90iJ12aB34cD56eF78gH </span>
		</td>
	</tr>
	
	</table>
</div>