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
	# * FILE: /includes/forms/form_paymentsettings_payflowsettings.php
	# ----------------------------------------------------------------------------------------------------	
?>
	
	<table class="standard-table left-table">
		<tr><th colspan="2"><div class="divisor"></div><th/></tr>
		<tr>
			<th>
				<? if ($payment_payflowStatus == "on") { ?>
					<input class="inputCheck" type="checkbox" name="payment_payflowStatus" id="payflow" onclick="enableForm('payflow')" checked="checked" />
				<? } else { ?>
					<input class="inputCheck" type="checkbox" name="payment_payflowStatus" id="payflow" onclick="enableForm('payflow')"/>
				<? } ?>	
			</th>
			<td class="td-form">
				<div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_PAYFLOWINFORMATION)?></div>
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
	
	<? if ($payment_payflowStatus == "on") { ?>
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="payflow_form" />
	<? } else { ?>
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="payflow_form" <?=(${'payflow_form'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
	<? } ?>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_LOGIN)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="payflow_login" value="<?=htmlspecialchars( stripslashes($payflow_login) )?>" class="input-form-adminemail" />
            <span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> testPFL </span>
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_PARTNER)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="payflow_partner" value="<?=htmlspecialchars( stripcslashes($payflow_partner) )?>" class="input-form-adminemail" />
            <span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> partner </span>
		</td>
	</tr>
	
	</table>