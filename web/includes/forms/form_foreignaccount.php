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
	# * FILE: /includes/forms/form_foreignaccount.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if ($message_foreignaccount) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_foreignaccount?>
	</div>
<? } ?>

<br />

<table cellpadding="2" cellspacing="0" border="0" class="table-form" width="100%">
	<tr class="tr-form">
    	<th colspan="2"><div class="header-form">OpenID 2.0</div></th>
    </tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<input type="checkbox" name="foreignaccount_openid" id="foreignaccount_openid" value="on" <?=$foreignaccount_openid_checked?>  class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="foreignaccount_openid"><?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_CHECKTHISBOXTOENABLEOPENID);?></label></div>
		</td>
	</tr>
    <tr class="tr-form"><th colspan="2">&nbsp;</th></tr>
    
    <tr class="tr-form">
    	<th colspan="2"><div class="header-form">Facebook</div></th>
    </tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<input type="checkbox" name="foreignaccount_facebook" id="foreignaccount_facebook" value="on" <?=$foreignaccount_facebook_checked?>  class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="foreignaccount_facebook"><?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_CHECKTHISBOXTOENABLEFACEBOOK);?></label></div>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_FACEBOOKAPIID)?>:
		</td>
		<td>
			<input type="text" name="foreignaccount_facebook_apiid" value="<?=$foreignaccount_facebook_apiid?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_FACEBOOKAPISECRET)?>:
		</td>
		<td>
			<input type="text" name="foreignaccount_facebook_apisecret" value="<?=$foreignaccount_facebook_apisecret?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
		</td>
	</tr>
	<tr class="tr-form">
    	<th colspan="2"><div class="header-form">Google</div></th>
    </tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<input type="checkbox" name="foreignaccount_google" id="foreignaccount_google" value="on" <?=$foreignaccount_google_checked?>  class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="foreignaccount_google"><?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_CHECKTHISBOXTOENABLEGOOGLE);?></label></div>
		</td>
	</tr>
    <tr class="tr-form"><th colspan="2">&nbsp;</th></tr>
        
</table>
