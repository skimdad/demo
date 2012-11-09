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
	# * FILE: /includes/code/content_noimage.php
	# ----------------------------------------------------------------------------------------------------

	extract($_POST);
	extract($_GET);

	$success = false;

	if ($restore_image){

		$crop_image=1;
	}

	// Image Crop
    if (($_POST["image_type"]) && (!DEMO_LIVE_MODE)) {

        // TYPES
        //1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order),
        //9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
        $user_id = $_COOKIE["PHPSESSID"];
        $dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files/";
        $files = glob("$dir/_0_".$user_id."_*.*");

		if ($files[0] != '') {
			switch ($_POST["image_type"]) {
				case 1:
					$img_type='gif';
					$img_r = imagecreatefromgif( $files[0] );
					break;
				case 2:
					$img_type='jpeg';
					$img_r = imagecreatefromjpeg( $files[0] );
					break;
				case 3:
					$img_type='png';
					$img_r = imagecreatefrompng( $files[0] );
					break;
			}

			$dst_r = ImageCreateTrueColor( $_POST['w'], $_POST['h'] );

			if ($img_r) {
				
				if($img_type == "png" || $img_type == "gif"){
					imagealphablending($dst_r, false);
					imagesavealpha($dst_r,true);
					$transparent = imagecolorallocatealpha( $dst_r, 255, 255, 255, 127 );
					imagefill( $dst_r, 0, 0, $transparent ); 
					imagecolortransparent( $dst_r, $transparent);
				}
				
				if ($img_type == "gif"){ //use imagecopyresized for gif to keep the transparency. The functions imagecopyresized and imagecopyresampled works in the same way with the exception that the resized image generated through imagecopyresampled is smoothed so that it is still visible.
					//low quality
					imagecopyresized( $dst_r,
									$img_r,
									0,
									0,
									$_POST["x"],
									$_POST["y"],
									$_POST["w"],
									$_POST["h"],
									$_POST["w"],
									$_POST["h"]
								  );
				} else {
					//better quality
					imagecopyresampled( $dst_r,
									$img_r,
									0,
									0,
									$_POST["x"],
									$_POST["y"],
									$_POST["w"],
									$_POST["h"],
									$_POST["w"],
									$_POST["h"]
								  );
				}
			}

			$crop_image = $dir."crop_image.$img_type";
			if ($img_type == 'gif') imagegif($dst_r, $crop_image);
			elseif ($img_type == 'jpeg') imagejpeg($dst_r, $crop_image);
			elseif ($img_type == 'png') imagepng($dst_r, $crop_image);

			//removing image files
			foreach($files as $file) unlink($file);
		}
    }

	if ($crop_image) {

		/* noimage image file */
		if ($crop_image || $restore_image) {
			$filename = EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_IMGEXT;

			$image_upload = image_uploadForNoImage($filename, $crop_image, $restore_image);
			if (!$image_upload["success"]) {
				$error = true;
			}
		}

		if (!$error) {
			$success = true;
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_CONTENT_NOIMAGE_SUCCESS);
		} else {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
		}

		if($actions) {
			$message_noimage .= implode("<br />", $actions);
		}

	}

?>