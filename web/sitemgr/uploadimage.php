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
	# * FILE: /sitemgr/uploadimage.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/uploadimage.php");

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />

		<link href="<?=DEFAULT_URL?>/sitemgr/layout/general_sitemgr.css" rel="stylesheet" type="text/css" />
		<link href="<?=DEFAULT_URL?>/sitemgr/layout/popup.css" rel="stylesheet" type="text/css" media="all" />
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jcrop/js/jquery.Jcrop.js"></script>
		<link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/jcrop/css/jquery.Jcrop.css" type="text/css" />
		
		<?if ($upload_image == "failed") { ?>
			<script language="javascript" type="text/javascript">
				setTimeout(function(){
					 parent.$.fancybox.close();
				}, 1500);

			</script>
		<? } else {
				if (($onlyMainImage) || ($main == "false")){

					if ($uploadImageUpdate == "y"){?>
						<script language="javascript" type="text/javascript">
							parent.loadGallery(<?=$_POST["item_id"]?>,'y','sitemgr','editFe', 'false');
							setTimeout(function(){
								parent.$.fancybox.close();
							}, 1500)
						</script>
					<?}elseif ($uploadImageUpdate == "n") {?>
						<script language="javascript" type="text/javascript">
							parent.loadGallery(<?=$_POST["item_id"]?>, 'y', 'sitemgr', 'n', 'false');
							setTimeout(function(){
								parent.$.fancybox.close();
							}, 1500)
						</script>
					<?}
				} else {

					if (($uploadImageUpdate == "y") || ($uploadImageUpdate == "n")){?>
						<script language="javascript" type="text/javascript">
							parent.loadGallery(<?=$_POST["item_id"]?>,'y','sitemgr', '', 'true');
							setTimeout(function(){
								parent.$.fancybox.close();
							}, 1500)
						</script>
					<?}
			}
		}?>
	</head>
	
	<body  <?=($captions == "y"? "" : "class=\"baseUploadImage\"")?>>
		<h2 class="standardTitle"><?=($captions == "y"? system_showText(LANG_LABEL_EDIT_CAPTIONS) : system_showText(LANG_LABEL_ADDIMAGE))?></h2>

		<?
		$sql = "SELECT COUNT(*) FROM Gallery_Temp WHERE image_default = 'n' AND sess_id = '".$gallery_hash."'";
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$r = $dbObj->query($sql);
		while ($row_aux = mysql_fetch_array($r)) {
			$cont_temp = $row_aux[0];
		}
		if ($galleryid){
			$gallery = new Gallery($galleryid);
			$cont_gal = count($gallery->image);
		}

		if ($photos && $photos >= 0 && ($cont_temp + $cont_gal) >= $photos){
			$return_upload_message .= "<p class=\"errorMessage\">".LANG_YOU_CAN_ADD_MAXOF.$photos.LANG_TO_YOUR_GALLERY."</p>";
		}

		if ($return_upload_message) {
			echo $return_upload_message;
		} else {
			?>
			<form id="uploadimage" name="uploadimage" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="frmEmail" enctype="multipart/form-data" >
				
				<input type="hidden" name="item_type" value="<?=$item_type?>" />
				<input type="hidden" name="main" value="<?=$main?>" />
				<input type="hidden" name="level" value="<?=$level?>" />
				<input type="hidden" name="temp" value="<?=$temp?>" />
				<input type="hidden" name="gallery_item_id" id="gallery_item_id" value="<?=$gallery_item_id?>" />
				<input type="hidden" name="gallery_id" id="gallery_id" value="<?=$gallery_id?>" />
				<input type="hidden" name="image_id" id="image_id" value="<?=$image_id?>" />
				<input type="hidden" name="thumb_id" id="thumb_id" value="<?=$thumb_id?>" />
				<input type="hidden" name="item_id" id="item_id" value="<?=$item_id?>" />
				<input type="hidden" name="captions" id="captions" value="<?=$captions?>" />
				<input type="hidden" name="x1" value="0" id="x1" />
				<input type="hidden" name="y1" value="0" id="y1" />
				<input type="hidden" name="x2" value="<?=$thumbWidthItem?>" id="x2" />
				<input type="hidden" name="y2" value="<?=$thumbHeidhtItem?>" id="y2" />
				<input type="hidden" name="w" value="<?=$thumbWidthItem?>" id="w" />
				<input type="hidden" name="h" value="<?=$thumbHeightItem?>" id="h" />
				<input type="hidden" name="gallery_hash" value="<?=$gallery_hash?>" />
				
				<? include(INCLUDES_DIR."/forms/form_uploadimage.php"); ?>
			</form>
		<? } ?>
	</body>
</html>