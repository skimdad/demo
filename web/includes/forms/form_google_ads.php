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
	# * FILE: /includes/forms/form_google_ads.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="header-form"><?=string_ucwords(system_showText(LANG_SITEMGR_GOOGLEADS))?></div>

<? if ($message_googleads) { ?>
	<div id="warning" class="<?=$message_style?>"><?=$message_googleads?></div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form">

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=string_ucwords(system_showText(LANG_SITEMGR_GOOGLEADS_CLIENT))?>
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="google_ad_client" value="<?=$google_ad_client?>" maxlength="255" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> /><br /><span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> pub-0107044813308700</span>
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=string_ucwords(system_showText(LANG_SITEMGR_GOOGLEADS_CLIENTOPTION))?>
			</div>
		</td>
		<td align="left" class="td-form">
			
		<table border="0" cellpadding="0" cellspacing="0" style="width: auto; margin: 0;">
			<tr>
				<td><input type="radio" name="google_ad_status" value="on" <?=($google_ad_status=="on") ? "checked" : ""?> class="inputRadio" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> /></td>
				<td><?=string_ucwords(system_showText(LANG_SITEMGR_ON))?></td>
				<td><input type="radio" name="google_ad_status" value="off" <?=($google_ad_status=="off") ? "checked" : ""?> class="inputRadio" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> /></td>
				<td><?=string_ucwords(system_showText(LANG_SITEMGR_OFF))?></td>
			</tr>			
		</table>
			
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_TYPE))?>:
			</div>
		</td>
		<td align="left" class="td-form">
			
		<table border="0" cellpadding="0" cellspacing="0" style="width: auto; margin: 0;">
			<tr>
				<td><input type="radio" name="google_ad_type" value="text" <?=($google_ad_type=="text") ? "checked" : ""?> class="inputRadio" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> /></td>
				<td><?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_TEXT))?></td>
				<td><input type="radio" name="google_ad_type" value="image" <?=($google_ad_type=="image") ? "checked" : ""?> class="inputRadio" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> /></td>
				<td><?=string_ucwords(system_showText(LANG_SITEMGR_IMAGE))?></td>
				<td><input type="radio" name="google_ad_type" value="text_image" <?=($google_ad_type=="text_image") ? "checked" : ""?> class="inputRadio" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> /></td>
				<td><?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_TEXT))?> & <?=string_ucwords(system_showText(LANG_SITEMGR_IMAGE))?></td>
			</tr>			
		</table>
			
		</td>
	</tr>
	
</table>