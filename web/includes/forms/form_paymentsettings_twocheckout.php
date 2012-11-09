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
	# * FILE: /includes/forms/form_paymentsettings_twocheckout.php
	# ----------------------------------------------------------------------------------------------------
	
?>

	<table id="creditcard_setting_title" onclick="showSettings(this.id);" class="standard-table">
		<tr>
			<th class="standard-tabletitle">
				<?=LANG_SITEMGR_SETTINGS_PAYMENT_CREDITCARD?>
			</th>
		</tr>
	</table>

	<div id="creditcard_setting" class="defaultItems">

	<table class="standard-table left-table">
		<tr>
			<th>
				<? if ($payment_twocheckoutStatus == "on") { ?>
					<input type="checkbox" class="inputCheck" name="payment_twocheckoutStatus" id="twocheckout" onclick="enableForm('twocheckout')" checked="checked" />
				<? } else { ?>	
					<input type="checkbox" class="inputCheck" name="payment_twocheckoutStatus" id="twocheckout" onclick="enableForm('twocheckout')"/>
				<? } ?>
			</th>
			<td class="td-form">
				<div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_TWOCHECKOUTINFORMATION)?></div>
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
	
	<? if ($payment_twocheckoutStatus == "on") { ?>
			<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="twocheckout_form" />
	<? } else { ?>
			<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="twocheckout_form" <?=(${'twocheckout_form'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
	<? } ?>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_LOGIN)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="twocheckout_login" value="<?=htmlspecialchars( stripslashes($twocheckout_login) )?>" class="input-form-adminemail" />
            <span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> 1234567 </span>
		</td>
	</tr>
	
	</table>