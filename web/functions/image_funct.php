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
	# * FILE: /functions/image_funct.php
	# ----------------------------------------------------------------------------------------------------

	function image_getNewDimension($maxW, $maxH, $oldW, $oldH, &$newW, &$newH) {
		if (($oldW <= $maxW) && ($oldH <= $maxH)) { // without resize
			$newW = $oldW;
			$newH = $oldH;
		} else { // with resize
			if (($maxW / $oldW) <= ($maxH / $oldH)) { // resize from width
				$newW = $oldW * ($maxW / $oldW);
				$newH = $oldH * ($maxW / $oldW);
			} elseif (($maxW / $oldW) > ($maxH / $oldH)) { // resize from height
				$newW = $oldW * ($maxH / $oldH);
				$newH = $oldH * ($maxH / $oldH);
			}
		}
	}

	function image_upload_check($tmp_name) {
		$types = array("1" => "GIF", "2" => "JPG", "3" => "PNG");
		$image_temp          = $tmp_name;
		$info                = @getimagesize($image_temp);
		$row_image           = array();
		$row_image["type"]   = $types[$info[2]];
		if ( in_array($types[$info[2]], array("JPG", "GIF", "PNG")) ) {
			return true;
		}
		return false;
	}

	function image_upload($tmp_name, $maxWidth, $maxHeight, $prefix, $force_main = false, $resize = true) {

		if ($force_main) {
			$_image_dir = PROFILE_IMAGE_DIR;
		} else {
			$_image_dir = IMAGE_DIR;
		}

		$types               = array("1" => "GIF", "2" => "JPG", "3" => "PNG");
		$image_temp          = $tmp_name;
		$info                = @getimagesize($image_temp);
		$row_image["type"]   = $types[$info[2]];
		$row_image["width"]  = $info[0];
		$row_image["height"] = $info[1];
		$row_image["prefix"] = $prefix;

		if ( ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF") || ($types[$info[2]] == "PNG") ) {

			$unique_id = md5(uniqid(rand(), true));

			if ($row_image["type"] == "GIF") $new_name = $unique_id.".gif";
			if ($row_image["type"] == "JPG") $new_name = $unique_id.".jpg";
			if ($row_image["type"] == "PNG") $new_name = $unique_id.".png";

			@rename($image_temp, TMP_FOLDER."/$new_name");

			if ($resize){ 
				image_getNewDimension($maxWidth, $maxHeight, $row_image["width"], $row_image["height"], $newWidth, $newHeight);
			} else {
				$newWidth = $row_image["width"];
				$newHeight = $row_image["height"];
			}
			
			$thumb = new ThumbGenerator();
			$thumb->set("thumbWidth", $newWidth);
			$thumb->set("thumbHeight", $newHeight);
			$thumb->set("destination_path", $image_temp);
			$thumb->makeThumb(TMP_FOLDER."/$new_name");

			//if ($row_image["type"] == "GIF") $extension = "gif";
			//if ($row_image["type"] == "JPG") $extension = "jpg";
			//if ($row_image["type"] == "PNG") $extension = "png";

			$extension = string_strtolower($types[$info[2]]);
			$info = getimagesize($image_temp);

			$row_image["type"] = $types[$info[2]];
			$row_image["width"] = $info[0];
			$row_image["height"] = $info[1];
			$row_image["prefix"] = $prefix;

			$imageObj = new Image($row_image, $force_main);
			$imageObj->save();

			copy($image_temp, $_image_dir."/".$imageObj->getString("prefix")."photo_".$imageObj->getNumber("id").".$extension");
			@unlink($image_temp);

			if ($new_name){
				@unlink(TMP_FOLDER."/".$new_name);
			}

			return $imageObj;

		} else {
			@unlink($image_temp);
			return;
		}

	}
    
	function image_uploadForItem($tmp_name, $prefix, $fullwidth, $fullheight, $thumbwidth="", $thumbheight="", $force_main = false) {

		$types             = array("1" => "GIF", "2" => "JPG", "3" => "PNG");
		$info              = getimagesize($tmp_name);
		$row_image["type"] = $types[$info[2]];

		if ( ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF") || ($types[$info[2]] == "PNG") ) {

			copy($tmp_name, TMP_FOLDER."/thumb_".string_substr(strrchr($tmp_name, "/"), 1));

			$imageObj = image_upload($tmp_name, $fullwidth, $fullheight, $prefix, $force_main);
			$imageObj->save();

			if ($thumbwidth && $thumbwidth) {
				$thumbObj = image_upload(TMP_FOLDER."/thumb_".string_substr(strrchr($tmp_name, "/") ,1), $thumbwidth, $thumbheight, $prefix, $force_main);
				$thumbObj->save();
			}

			$array["success"] = true;
			$array["image_id"] = $imageObj->id;
			if ($thumbwidth && $thumbwidth) {
				$array["thumb_id"] = $thumbObj->id;
			}

		} else {
			unlink($tmp_name);
			$array["success"] = false;
			$array["image_id"] = 0;
			$array["thumb_id"] = 0;
		}

		return $array;

	}
	
	function image_uploadBadges($tmp_name, $prefix, $fullwidth, $fullheight, $force_main = false) {

		$types             = array("1" => "GIF", "2" => "JPG", "3" => "PNG");
		$info              = getimagesize($tmp_name);
		$row_image["type"] = $types[$info[2]];

		if ( ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF") || ($types[$info[2]] == "PNG") ) {

			copy($tmp_name, TMP_FOLDER."/thumb_".string_substr(strrchr($tmp_name, "/"), 1));

			$imageObj = image_upload($tmp_name, $fullwidth, $fullheight, $prefix, $force_main);
			$imageObj->save();

			$array["success"] = true;
			$array["image_id"] = $imageObj->id;

		} else {
			unlink($tmp_name);
			$array["success"] = false;
			$array["image_id"] = 0;
		}

		return $array;

	}

	function image_uploadForHeader($filename, $tmp_name, $restore) {

		if($restore) {
			/* removing existing file */
			if (file_exists($filename)) {
				@unlink($filename);
			}

			$array["success"] = true;
		} else {
			$types             = array("1" => "GIF", "2" => "JPG", "3" => "PNG");
			//if ($tmp_name){
			$info              = getimagesize($tmp_name);
			$row_image["type"] = $types[$info[2]];

			if (($info && ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF") || ($types[$info[2]] == "PNG"))) {

				/* not restoring, add a new */
				if (!$restore) {
					//@move_uploaded_file($tmp_name, $filename);
					@copy($tmp_name, $filename);
					@unlink($tmp_name);
				}

				$array["success"] = true;

			} else {
				if ($tmp_name) {
					unlink($tmp_name);
				}
				$array["success"] = false;
			}
		}
		return $array;

	}

	function image_uploadForRss($filename, $tmp_name, $restore_logo_rrs) {

		if ($restore_logo_rrs) {
			/* removing existing file */
			if (file_exists($filename)) {
				@unlink($filename);
			}

			$array["success"] = true;
		} else {
			$types             = array("1" => "GIF", "2" => "JPG", "3" => "PNG");
			$info              = getimagesize($tmp_name);
			$row_image["type"] = $types[$info[2]];

			if (($info && ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF") || ($types[$info[2]] == "PNG"))) {

				/* not restoring, add a new */
				if (!$restore_logo_rrs) {
					//@move_uploaded_file($tmp_name, $filename);
					@copy($tmp_name, $filename);
					@unlink($tmp_name);
				}

				$array["success"] = true;

			} else {

				if ($tmp_name) {
					unlink($tmp_name);
				}
				$array["success"] = false;

			}
		}

		return $array;

	}

    function image_uploadForMobile($filename, $tmp_name, $restore_logo_mobile) {

		if($restore_logo_mobile) {
			/* removing existing file */
            if (file_exists($filename)) {
                @unlink($filename);
            }
			$array["success"] = true;
		} else {
			$types             = array("1" => "GIF", "2" => "JPG", "3" => "PNG");
			$info              = getimagesize($tmp_name);
			$row_image["type"] = $types[$info[2]];

			if (($info && ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF") || ($types[$info[2]] == "PNG"))) {

				/* not restoring, add a new */
				if (!$restore_logo_mobile) {
					//@move_uploaded_file($tmp_name, $filename);
					@copy($tmp_name, $filename);
					@unlink($tmp_name);
				}

				$array["success"] = true;

			} else {

				if ($tmp_name) {
					unlink($tmp_name);
				}
				$array["success"] = false;

			}
		}
        return $array;

    }

	function image_uploadForSitemgr($filename, $tmp_name, $restore_logo_sitemgr) {

		if($restore_logo_sitemgr) {
			/* removing existing file */
            if (file_exists($filename)) {
                @unlink($filename);
            }
			$array["success"] = true;
		} else {
			$types             = array("1" => "GIF", "2" => "JPG", "3" => "PNG");
			$info              = getimagesize($tmp_name);
			$row_image["type"] = $types[$info[2]];

			if (($info && ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF") || ($types[$info[2]] == "PNG"))) {

				/* not restoring, add a new */
				if (!$restore_logo_sitemgr) {
					//@move_uploaded_file($tmp_name, $filename);
					@copy($tmp_name, $filename);
					@unlink($tmp_name);
				}

				$array["success"] = true;

			} else {

				if ($tmp_name) {
					@unlink($tmp_name);
				}
				$array["success"] = false;

			}
		}
        return $array;

    }

	function image_uploadForNoImage($filename, $tmp_name, $restore) {

		if ($restore){

		/* removing existing file */
			if (file_exists($filename)) {
				@unlink($filename);
				@unlink(EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_CSSEXT);
			}
			$array["success"] = true;
		}else{

		$types             = array("1" => "GIF", "2" => "JPG", "3" => "PNG");
		$info              = getimagesize($tmp_name);
		$row_image["type"] = $types[$info[2]];



		if (($info && ($types[$info[2]] == "JPG") || ($types[$info[2]] == "GIF") || ($types[$info[2]] == "PNG"))) {

			/* not restoring, add a new */
			if (!$restore) {
				//@move_uploaded_file($tmp_name, $filename);
				@copy($tmp_name, $filename);
				@unlink($tmp_name);
				$handle = fopen(EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_CSSEXT, "w");
				fwrite($handle, ".no-image{\n\t".system_getNoImageStyle()." !important;\n}");
				fclose($handle);
			}

			$array["success"] = true;

		} else {
			if ($tmp_name) {
				unlink($tmp_name);
			}
			$array["success"] = false;
		}

		}

		return $array;

	}

	function image_getHeight($image) {
		$size = getimagesize($image);
		$height = $size[1];
		return $height;
	}
	function image_getWidth($image) {
		$size = getimagesize($image);
		$width = $size[0];
		return $width;
	}

	function image_getMdc($a,$b) { // this function is used to calculate the aspect ratio for crop
		if ($b == 0) return $a;
		return image_getMdc($b, $a % $b);
	}

	function image_getImageSizeByURL($url){
		if($url){

			$agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)";
			$ref = DEFAULT_URL.$_SERVER["PHP_SELF"];

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_USERAGENT, $agent);
			curl_setopt($ch, CURLOPT_REFERER, $ref);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);

			$data = curl_exec($ch);

			curl_close($ch);
			$filename = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/tmp/temp.".time();

			$fp = fopen($filename, "w+");
			fwrite($fp, $data);
			fclose($fp);

			$info = getimagesize($filename);

			@unlink($filename);
			return $info;
		}else{
			return false;
		}
	}

?>