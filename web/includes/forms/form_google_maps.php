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
	# * FILE: /includes/forms/form_google_maps.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="header-form"><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLEMAPS))?></div>

<? if ($message_googlemaps) { ?>
	<div id="warning" class="<?=$message_style?>"><?=$message_googlemaps?></div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form">
    <tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=string_ucwords(system_showText(LANG_SITEMGR_GOOGLEMAPS_KEY))?>
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="google_maps_key" value="<?=$google_maps_key?>" style="width: 400px;" maxlength="255" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> /><br /><span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> ABQIAAAApsu_yVy ... PoWjn3yp6vDxlSg</span>
		</td>
    </tr>
    <tr class="tr-form">
        <td align="right" class="td-form">
            <div class="label-form">
                <?=string_ucwords(system_showText(LANG_SITEMGR_GOOGLEMAPS))?>:
            </div>
        </td>
        <td align="left" class="td-form">
            
            <table border="0" cellpadding="0" cellspacing="0" style="width: auto; margin: 0;">
                <tr>
                    <td><input type="radio" name="google_maps_status" value="on" <?=($googleStatus->getString("value") == "on") ? "checked" : ""?> class="inputRadio" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> /></td>
                    <td><?=string_ucwords(system_showText(LANG_SITEMGR_ON))?></td>
                    <td><input type="radio" name="google_maps_status" value="off" <?=($googleStatus->getString("value") == "off") ? "checked" : ""?> class="inputRadio" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> /></td>
                    <td><?=string_ucwords(system_showText(LANG_SITEMGR_OFF))?></td>
                </tr>            
            </table>
            
        </td>
	</tr>
</table>