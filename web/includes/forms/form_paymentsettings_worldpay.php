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
	# * FILE: /includes/forms/form_paymentsettings_worldpay.php
	# ----------------------------------------------------------------------------------------------------
	
?>
	
	<table class="standard-table left-table">
		<tr><th colspan="2"><div class="divisor"></div><th/></tr>
		<tr>
			<th>
				<? if ($payment_worldpayStatus == "on") { ?>
					<input type="checkbox" class="inputCheck" name="payment_worldpayStatus" id="worldpay" onclick="enableForm('worldpay')" checked="checked" />
				<? } else { ?>
					<input type="checkbox" class="inputCheck" name="payment_worldpayStatus" id="worldpay" onclick="enableForm('worldpay')"/>
				<? }?>
			</th>
			<td class="td-form">
				<div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_WORLDPAYINFORMATION)?></div>
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
	
	<? if ($payment_worldpayStatus == "on") { ?>
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="worldpay_form" />
	<? } else { ?>	
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="worldpay_form" <?=(${'worldpay_form'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
	<? } ?>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_INSTALATIONID)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="worldpay_instid" value="<?=htmlspecialchars( stripslashes($worldpay_instid) )?>" class="input-form-adminemail" />
            <span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> 123456 </span>
		</td>
	</tr>
	
	</table>
</div>