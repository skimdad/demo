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
	# * FILE: /includes/forms/form_content_noimage.php
	# ----------------------------------------------------------------------------------------------------

	if (file_exists(EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_IMGEXT)) {
		$hasNoImage = true;
	} else {
		$hasNoImage = false;
	}
?>

<?include(EDIRECTORY_ROOT."/includes/code/thumbnail.php");?>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_CONTENT_DEFAULTIMAGE)?> <span> (JPG, GIF <?=system_showText(LANG_OR);?> PNG)</span></th>
	</tr>
	<tr>
		<th  <?=($hasNoImage ? "class=\"alignTop\" rowspan=\"2\"" : "")?>>
			<?=system_showText(LANG_SITEMGR_LABEL_IMAGESOURCE)?>:
		</th>
		<td><input type="file" id="image" name="noimage_image" size="50" onchange="UploadImage('noimage');" class="inputExplode" /><span><?=system_showText(LANG_SITEMGR_MSGMAXFILESIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></span></td>
		<?//Crop Tool Inputs?>
        <input type="hidden" name="x" id="x">
        <input type="hidden" name="y" id="y">
        <input type="hidden" name="x2" id="x2">
        <input type="hidden" name="y2" id="y2">
        <input type="hidden" name="w" id="w">
        <input type="hidden" name="h" id="h">
        <input type="hidden" name="image_width" id="image_width">
        <input type="hidden" name="image_height" id="image_height">
        <input type="hidden" name="image_type" id="image_type">
        <input type="hidden" name="crop_submit" id="crop_submit">
	</tr>
	
	<? if (file_exists(EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_IMGEXT)) { ?>
	<tr>
		<td>
			<span class="no-image"></span>			
		</td>
	</tr>
	<? } ?>
	
	<tr>
		<th><input type="checkbox" class="standard-table-putradio" name="restore_image" value="1" style="width:auto;border:0;" /></th>
		<td><?=system_showText(LANG_SITEMGR_CONTENT_CHECKBOX_RESTORENOIMAGE)?></td>
	</tr>


</table>