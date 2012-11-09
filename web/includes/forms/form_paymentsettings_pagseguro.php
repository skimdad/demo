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
	# * FILE: /includes/forms/form_paymentsettings_pagseguro.php
	# ----------------------------------------------------------------------------------------------------

?>
	<table id="pagseguro_setting_title" onclick="showSettings(this.id);" class="standard-table">
		<tr>
			<th class="standard-tabletitle">
				<img title="" src=""/>
				<?=LANG_SITEMGR_SETTINGS_PAYMENT_PAGSEGURO?>
			</th>
		</tr>
	</table>

	<div id="pagseguro_setting">
		<table class="table-form table-form-paymentgateway">
            <tr>
                <td colspan="2">
                    <div class="tip-base">
                        <span class="warning" style="text-align: justify; font-size: 11px;"><a href="<?=DEFAULT_URL;?>/sitemgr/faq/faq.php?keyword=<?=urlencode("pagseguro");?>" target="_blank"><?=system_showText(LANG_SITEMGR_PAGSEGUROTIP)?></a></span>
                    </div>
                </td>
            </tr>
			<tr class="tr-form">
				<td class="td-form">
				<? if ($payment_pagseguroStatus == "on") { ?>
					<input type="checkbox" class="inputCheck" name="payment_pagseguroStatus" id="pagseguro" onclick="enableForm('pagseguro')" checked="checked"/>
				<? } else { ?>
					<input type="checkbox" class="inputCheck" name="payment_pagseguroStatus" id="pagseguro" onclick="enableForm('pagseguro')"/>
				<? } ?>
				</td>
				<td>
					<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_PAGSEGUROINFORMATION)?>
				</td>
			</tr>
		</table>

		<? if ($payment_pagseguroStatus == "on") { ?>
			<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="pagseguro_form" />
		<? } else { ?>
			<table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="pagseguro_form" <?=(${'pagseguro_form'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
		<? } ?>

			<tr class="tr-form">
				<td align="right" class="td-form">
					<div class="label-form">
						<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_ACCOUNT)?>:
					</div>
				</td>
				<td align="left" class="td-form">
					<input type="text" name="pagseguro_email" value="<?=htmlspecialchars( stripslashes($pagseguro_email) )?>" class="input-form-adminemail" />
					<span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> test@domain.com </span>
				</td>
			</tr>

			<tr class="tr-form">
				<td align="right" class="td-form">
					<div class="label-form">
						<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_PAGSEGUROTOKEN)?>:
					</div>
				</td>
				<td align="left" class="td-form">
					<input type="text" name="pagseguro_token" value="<?=htmlspecialchars( stripslashes($pagseguro_token) )?>" class="input-form-adminemail" />
					<span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> 0123456789abcdef0123456789abcdef </span>
				</td>
			</tr>

		</table>
     
	</div>