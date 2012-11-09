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
	# * FILE: /includes/forms/form_content_header.php
	# ----------------------------------------------------------------------------------------------------
//	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
//	header("Cache-Control: no-store, no-cache, must-revalidate");
//	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//	header("Cache-Control: post-check=0, pre-check=0", FALSE);
//	header("Pragma: no-cache");
?>

<?include(EDIRECTORY_ROOT."/includes/code/thumbnail.php");?>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_CONTENT_HEADERLOGO)?>&nbsp;<span>(JPG, GIF <?=system_showText(LANG_OR);?> PNG)</span></th>
	</tr>
	<tr>
		<th colspan="2" class="widthAuto">
			<div class="tip-base">
				<span class="warning" style="text-align: justify;"><a href="<?=DEFAULT_URL;?>/sitemgr/faq/faq.php?keyword=<?=urlencode("header logo");?>" target="_blank"><?=system_showText(LANG_SITEMGR_HEADERLOGOTIP)?></a></span>
			</div>
		</th>
	</tr>
	<tr>
		<th class="alignTop" rowspan="2"><?=system_showText(LANG_SITEMGR_LABEL_IMAGESOURCE)?>:</th>
		<td>
		    <input type="hidden" name="logo[]" id="logo" value="1">
			<input type="file" id="image1" name="header_image" size="50" onchange="UploadImage('header',1);" class="inputExplode" /><span class="mgHeaderSubtitle"><?=system_showText(LANG_SITEMGR_MSGMAXFILESIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></span>
			<?//Crop Tool Inputs?>
	        <input type="hidden" name="x1" id="x1">
	        <input type="hidden" name="y1" id="y1">
	        <input type="hidden" name="x21" id="x21">
	        <input type="hidden" name="y21" id="y21">
	        <input type="hidden" name="w1" id="w1">
	        <input type="hidden" name="h1" id="h1">
	        <input type="hidden" name="image_width1" id="image_width1">
	        <input type="hidden" name="image_height1" id="image_height1">
	        <input type="hidden" name="image_type1" id="image_type1">
        </td>
	</tr>
	<tr>
		<td>
			<? 
			if (file_exists(EDIRECTORY_ROOT.IMAGE_HEADER_PATH)) {
				$headerlogo_path = IMAGE_HEADER_PATH;
			} else {
				$headerlogo_path = "/images/content/img_logo.gif";
			}
			
			$headerlogo_width  = 0;
			$headerlogo_height = 0;
			$headerlogo_info = @getimagesize(EDIRECTORY_ROOT."/".$headerlogo_path);
			if (count($headerlogo_info)) {
				$width  = $headerlogo_info[0];
				$height = $headerlogo_info[1];
			} else {
				$width  = IMAGE_HEADER_WIDTH;
				$height = IMAGE_HEADER_HEIGHT;
			}
			image_getNewDimension((IMAGE_HEADER_WIDTH/2), (IMAGE_HEADER_HEIGHT/2), $width, $height, $headerlogo_width, $headerlogo_height);
			?>
			<img src="<?=DEFAULT_URL.$headerlogo_path?>" width="<?=$headerlogo_width?>" height="<?=$headerlogo_height?>" border="0" />
		</td>
	</tr>
	<tr>
		<th><input type="checkbox" class="standard-table-putradio" name="restore_image" value="1" style="width:auto;border:0;" /></th>
		<td><?=system_showText(LANG_SITEMGR_CONTENT_CHECKBOX_RESTOREDEFAULTIMAGE)?></td>
	</tr>
</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_CONTENT_RSSLOGO)?>&nbsp;<span class="mgHeaderSubtitle">( <?=RSS_LOGO_WIDTH?>px x <?=RSS_LOGO_HEIGHT?>px ) (JPG, GIF <?=system_showText(LANG_OR);?> PNG)</span></th>
	</tr>
	<tr>
		<th class="alignTop" rowspan="2"><?=system_showText(LANG_SITEMGR_LABEL_IMAGESOURCE)?>:</th>
		<td>
			<input type="hidden" name="logo[]" id="logo" value="2">
			<input type="file" id="image2" name="rss_logo" size="50" onchange="UploadImage('header',2);" class="inputExplode" /><span class="mgHeaderSubtitle"><?=system_showText(LANG_SITEMGR_MSGMAXFILESIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></span>
			<?//Crop Tool Inputs?>
	        <input type="hidden" name="x2" id="x2">
	        <input type="hidden" name="y2" id="y2">
	        <input type="hidden" name="x22" id="x22">
	        <input type="hidden" name="y22" id="y22">
	        <input type="hidden" name="w2" id="w2">
	        <input type="hidden" name="h2" id="h2">
	        <input type="hidden" name="image_width2" id="image_width2">
	        <input type="hidden" name="image_height2" id="image_height2">
	        <input type="hidden" name="image_type2" id="image_type2">
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<? 
			if (file_exists(EDIRECTORY_ROOT.RSS_LOGO_PATH)) {
				$rsslogo_path = RSS_LOGO_PATH;
			} else {
				$rsslogo_path = "/images/content/img_logo.gif";
			}
			
			$rsslogo_width  = 0;
			$rsslogo_height = 0;
			$rsslogo_info = @getimagesize(EDIRECTORY_ROOT."/".$rsslogo_path);
			if (count($rsslogo_info)) {
				$width  = $rsslogo_info[0];
				$height = $rsslogo_info[1];
			} else {
				$width  = RSS_LOGO_WIDTH;
				$height = RSS_LOGO_HEIGHT;
			}
			image_getNewDimension((RSS_LOGO_WIDTH/2), (RSS_LOGO_HEIGHT/2), $width, $height, $rsslogo_width, $rsslogo_height);
			?>
			<img src="<?=DEFAULT_URL.$rsslogo_path?>" width="<?=$rsslogo_width?>" height="<?=$rsslogo_height?>" border="0" />
		</td>
	</tr>
	<tr>
		<th><input type="checkbox" class="standard-table-putradio" name="restore_logo_rrs" value="1" style="width:auto;border:0;" /></th>
		<td><?=system_showText(LANG_SITEMGR_CONTENT_CHECKBOX_RESTOREDEFAULTLOGO)?></td>
	</tr>
</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
    <tr>
        <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_CONTENT_MOBILELOGO)?>&nbsp;<span>( <?=MOBILE_LOGO_WIDTH?>px x <?=MOBILE_LOGO_HEIGHT?>px ) (JPG, GIF <?=system_showText(LANG_OR);?> PNG)</span></th>
    </tr>
    <tr>
        <th class="alignTop" rowspan="2"><?=system_showText(LANG_SITEMGR_LABEL_IMAGESOURCE)?>:</th>
        <td>
        	<input type="hidden" name="logo[]" id="logo" value="3">
        	<input type="file" id="image3" name="mobile_logo" size="50" onchange="UploadImage('header',3);" class="inputExplode" /><span class="mgHeaderSubtitle"><?=system_showText(LANG_SITEMGR_MSGMAXFILESIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></span>
        	<?//Crop Tool Inputs?>
	        <input type="hidden" name="x3" id="x3">
	        <input type="hidden" name="y3" id="y3">
	        <input type="hidden" name="x23" id="x23">
	        <input type="hidden" name="y23" id="y23">
	        <input type="hidden" name="w3" id="w3">
	        <input type="hidden" name="h3" id="h3">
	        <input type="hidden" name="image_width3" id="image_width3">
	        <input type="hidden" name="image_height3" id="image_height3">
	        <input type="hidden" name="image_type3" id="image_type3">
    	</td>
    </tr>
    <tr>
        <td colspan="2">
            <?
            if (file_exists(EDIRECTORY_ROOT.MOBILE_LOGO_PATH)) {
                $mobilelogo_path = MOBILE_LOGO_PATH;
            } else {
                $mobilelogo_path = "/images/content/img_logo_mobile.gif";
            }
            
            $mobilelogo_width  = 0;
            $mobilelogo_height = 0;
            $mobilelogo_info = @getimagesize(EDIRECTORY_ROOT."/".$mobilelogo_path);
            if (count($mobilelogo_info)) {
                $width  = $mobilelogo_info[0];
                $height = $mobilelogo_info[1];
            } else {
                $width  = MOBILE_LOGO_WIDTH;
                $height = MOBILE_LOGO_HEIGHT;
            }
            image_getNewDimension(MOBILE_LOGO_WIDTH, MOBILE_LOGO_HEIGHT, $width, $height, $mobilelogo_width, $mobilelogo_height);
            ?>
            <img src="<?=DEFAULT_URL.$mobilelogo_path?>" width="<?=$mobilelogo_width?>" height="<?=$mobilelogo_height?>" border="0" />
        </td>
    </tr>
    <tr>
        <th><input type="checkbox" class="standard-table-putradio" name="restore_logo_mobile" value="1" style="width:auto;border:0;" /></th>
        <td><?=system_showText(LANG_SITEMGR_CONTENT_CHECKBOX_RESTOREDEFAULTLOGO)?></td>
    </tr>
</table>

<table class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_CONTENT_SEOCENTER)?></th>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LANGUAGE)?>:</th>
		<td>
		<?=language_writeComboLang('clang', $clang, 'changeComboLang(this.value)'); ?>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_TITLE)?>:</th>
		<td><input type="text" name="header_title" value="<?=$header_title?>" maxlength="255" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_AUTHOR)?>:</th>
		<td><input type="text" name="header_author" value="<?=$header_author?>" maxlength="255" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_METADESCRIPTION)?>:<br /><br /></th>
		<td><input type="text" name="header_description" value="<?=$header_description?>" maxlength="255" /><br /><?=system_showText(LANG_SITEMGR_CONTENT_METADESCRIPTION_EG)?></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_METAKEYWORDS)?>:<br /><br /></th>
		<td><input type="text" name="header_keywords" value="<?=$header_keywords?>" maxlength="255" /><br /><?=system_showText(LANG_SITEMGR_CONTENT_METAKEYWORDS_EG)?></td>
	</tr>
</table>