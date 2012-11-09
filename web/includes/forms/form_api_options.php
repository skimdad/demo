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
	# * FILE: /includes/forms/form_api_options.php
	# ----------------------------------------------------------------------------------------------------

?>

<br />

<div class="header-form">
	<?=system_showText(LANG_SITEMGR_NAVBAR_OPTIONS)?>
</div>

<? if ($message_api_options) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_api_options?>
	</div>
<? } ?>

<?
$helpLink = "<a href=\"apihelp.php\" class=\"iframe fancy_window\">";
$helpLabel = system_showText(LANG_SITEMGR_API_TIP5); 
$helpLabel = str_replace("[OPENLINK]", $helpLink, $helpLabel);
$helpLabel = str_replace("[CLOSELINK]", "</a>", $helpLabel);

$downloadLink = "<a href=\"javascript: void(0);\" onclick=\"download_doc();\">";
$downloadLabel = system_showText(LANG_SITEMGR_API_TIP9); 
$downloadLabel = str_replace("[OPENLINK]", $downloadLink, $downloadLabel);
$downloadLabel = str_replace("[CLOSELINK]", "</a>", $downloadLabel);
?>

<div class="tip-base">
    <h1><?=system_showText(LANG_SITEMGR_API_TIP1)?></h1><br />
    <p style="text-align: justify;"><?=system_showText(LANG_SITEMGR_API_TIP2)?></p><br />
    <span class="warning" style="text-align: justify;">1) <?=system_showText(LANG_SITEMGR_API_TIP3)?></span>
    <span class="warning" >2) <?=system_showText(LANG_SITEMGR_API_TIP4)?><br /><?=system_showText(DEFAULT_URL."/API/api.php?key=[".LANG_SITEMGR_API_TIP6."]&module=[".LANG_SITEMGR_API_TIP7."]&keyword=[".LANG_SITEMGR_API_TIP8."]")?></span>
    <br />
    <p style="text-align: justify;"><?=$helpLabel?><br /><?=$downloadLabel?></p><br />
</div>

<br />

<table cellpadding="2" cellspacing="0" border="0" class="table-form">
	<tr class="tr-form">
		<td align="right" class="td-form">
			<input type="checkbox" name="edirectory_api_enabled" value="on" <?=$edirectory_api_enabled_checked?> class="inputCheck" onclick="setNewKey();" />
		</td>
		<td>
			<div class="label-form" align="left"><?=system_showText(LANG_SITEMGR_SETTINGS_API_ENABLE)?></div>
		</td>
	</tr>
	<tr class="tr-form">
		<th align="right">
			<?=system_showText(LANG_SITEMGR_SETTINGS_APIKEY)?>
		</th>
		<td>
			<input type="text" name="edirectory_api_key_disabled" id="edirectory_api_key_disabled" value="<?=$edirectory_api_key?>" readonly maxlength="50" />
            <input type="hidden" name="edirectory_api_key" id="edirectory_api_key" value="<?=$edirectory_api_key?>" />
            <input type="hidden" id="new_key" name="edirectory_api_key_new" value="<?=$edirectory_api_key_new?>" />
		</td>
	</tr>
</table>