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
	# * FILE: /includes/forms/form_paymentsettings_itransactsettings.php
	# ----------------------------------------------------------------------------------------------------
		
?>	
	
	<table class="standard-table left-table">
		<tr><th colspan="2"><div class="divisor"></div><th/></tr>
		<tr>
			<th>
				<? if ($payment_itransactStatus == "on") { ?>
					<input type="checkbox" class="inputCheck" name="payment_itransactStatus" id="itransact" onclick="enableForm('itransact')" checked="checked" />
				<? } else { ?>
					<input type="checkbox" class="inputCheck" name="payment_itransactStatus" id="itransact" onclick="enableForm('itransact')"/>
				<? } ?>	
			</th>
			<td class="td-form">
				<div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_ITRANSACTINFORMATION)?></div>
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
	
	<? if ($payment_itransactStatus == "on") { ?>
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="itransact_form" />
	<? } else { ?>	
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="itransact_form" <?=(${'itransact_form'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
	<? } ?>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_VENDORID)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="itransact_vendorid" value="<?=htmlspecialchars( stripslashes($itransact_vendorid) )?>" class="input-form-adminemail" />
            <span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> 12345 </span>
		</td>
	</tr>
	
	</table>