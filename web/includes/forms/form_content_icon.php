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
	# * FILE: /includes/forms/form_content_icon.php
	# ----------------------------------------------------------------------------------------------------

    setting_get("last_favicon_id", $last_favicon_id);

    if (!$last_favicon_id){
        setting_new("last_favicon_id", "1");
        $last_favicon_id = "1";
    } 

?>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_CONTENT_ICON)?> <span>(16px x 16px) (ICO)</span></th>
	</tr>
	<tr>
		<th  class="alignTop">
			<?=system_showText(LANG_LABEL_SOURCE)?>:
		</th>
		<td><input type="file" name="favicon_file" size="50" /><span><?=system_showText(LANG_SITEMGR_ICONTIP)?></span></td>
	</tr>
	<? if (file_exists(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/content_files/favicon_".$last_favicon_id.".ico")) { ?>
	<tr>
		<th><input type="checkbox" class="standard-table-putradio" name="remove_icon" value="1" style="width:auto;border:0;" /></th>
		<td><?=system_showText(LANG_SITEMGR_CONTENT_CHECKBOX_REMOVEICON)?></td>
	</tr>
    <? } ?>
</table>