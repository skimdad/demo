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
	# * FILE: /includes/forms/form_paymentsettings_linkpointsettings.php
	# ----------------------------------------------------------------------------------------------------
	
?>
	
	<table class="standard-table left-table">
		<tr><th colspan="2"><div class="divisor"></div><th/></tr>
		<tr>
			<th>
				<? if ($payment_linkpointStatus == "on") { ?>
					<input class="inputCheck" type="checkbox" name="payment_linkpointStatus" id="linkpoint" onclick="enableForm('linkpoint')" checked="checked" />
				<? } else { ?>
					<input class="inputCheck" type="checkbox" name="payment_linkpointStatus" id="linkpoint" onclick="enableForm('linkpoint')"/>
				<? } ?>
			</th>
			<td class="td-form">
				<div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LINKPOINTINFORMATION)?></div>
			</td>
		</tr>
		<tr id="linkpoint_message" <?=(${'linkpoint_message'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?>>
			<td class="td-form" colspan="2">
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LINKPOINTINFORMATION_WARNING)?>
				</p>
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
	
	<? if ($payment_linkpointStatus == "on") { ?>
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="linkpoint_form">
	<? } else { ?>
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="linkpoint_form" <?=(${'linkpoint_form'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
	<? } ?>
			
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_CONFIGFILE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="linkpoint_configfile" value="<?=htmlspecialchars( stripslashes($linkpoint_configfile) )?>" class="input-form-adminemail" />
            <span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> 1234567890 </span>
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_KEYFILE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="linkpoint_keyfile" value="<?=htmlspecialchars( stripslashes($linkpoint_keyfile) )?>" class="input-form-adminemail" />
            <span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> 1234567890.pem </span>
		</td>
	</tr>
	
	<tr>
	
	<? if ($payment_linkpointStatus == "on") {?>
			<? if ($linkpoint_recurringCheckbox == "on") {?>
				<td align="right" class="td-form" id="linkpoint_recurring">
					<input type="checkbox" name="linkpoint_recurringCheckbox" id="linkpoint_recurringCheckbox" onclick="enableRecurringForm('linkpoint')" checked="checked" class="inputCheck" />
				</td>
			<? } else { ?>
				<td align="right" class="td-form" id="linkpoint_recurring">
					<input type="checkbox" name="linkpoint_recurringCheckbox" id="linkpoint_recurringCheckbox" onclick="enableRecurringForm('linkpoint')" class="inputCheck" />
				</td>
			<? } ?>
		<? } else { ?>
			<td align="right" class="td-form" id="linkpoint_recurring" style="display:none;">
				<input type="checkbox" name="linkpoint_recurringCheckbox" id="linkpoint_recurringCheckbox" onclick="enableRecurringForm('linkpoint')" class="inputCheck" />
			</td>
		<? } ?>
		<td align="left">
			<?=system_showText(LANG_SITEMGR_SETTINGS_RECURRING)?>
		</td>
	</tr>
</table>
	
	<? if ($linkpoint_recurringCheckbox == "on") { ?>
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="linkpointRecurring_form">
	<? } else { ?>
		<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="linkpointRecurring_form" <?=(${'linkpointRecurring_form'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
	<? } ?>
	
		<tr class="tr-form">
			<td align="right" class="td-form">
				<div class="label-form">
					<?=system_showText(LANG_SITEMGR_RECURRING_TYPE)?>:
				</div>
			</td>
			<td align="left" class="td-form" style="width: 400px;">
				<? if ($linkpoint_recurringCheckbox == "on") { 
					if ($linkpoint_recurringtype == "1M") { ?>
						<input type="radio" name="recurringtype_linkpoint" checked="checked" value="1M" class="inputAlign" />1 <?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?>
					<? } else { ?>
						<input type="radio" name="recurringtype_linkpoint" value="1M" class="inputAlign" />1 <?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?>
					<? } 
					if ($linkpoint_recurringtype == "1Y") { ?>
						<input type="radio" name="recurringtype_linkpoint" checked="checked" value="1Y" class="inputAlign" />1 <?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?>
					<? } else { ?>
						<input type="radio" name="recurringtype_linkpoint" value="1Y" class="inputAlign" />1 <?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?>
					<? } 
				} else { ?>
					<input type="radio" name="recurringtype_linkpoint" checked="checked" value="1M" class="inputAlign" />1 <?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?>
					<input type="radio" name="recurringtype_linkpoint" value="1Y" class="inputAlign" />1 <?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?>
				<? } ?>
			</td>
		</tr>	
	</table>		