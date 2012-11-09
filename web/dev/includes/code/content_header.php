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
	# * FILE: /includes/code/content_header.php
	# ----------------------------------------------------------------------------------------------------
	
	extract($_POST);
	extract($_GET);
	
	if (($_SERVER['REQUEST_METHOD'] == "POST") && (!DEMO_LIVE_MODE)) {
		
		// Image Crop
		if (($submit_button) && (!DEMO_LIVE_MODE)) {


			foreach($_POST["logo"] as $k => $logo){
				$i = $k + 1; 

				if ( $_POST["image_type$i"] ) {

					// TYPES
					//1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order), 
					//9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
					$user_id = $_COOKIE["PHPSESSID"];
					$dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files/";
					$files = glob("$dir/_".$k."_".$user_id."_*.*"); 
					switch ($_POST["image_type$i"]) {
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

					$dst_r = ImageCreateTrueColor( $_POST["w$i"], $_POST["h$i"] );

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
											$_POST["x$i"],
											$_POST["y$i"],
											$_POST["w$i"],
											$_POST["h$i"],
											$_POST["w$i"],
											$_POST["h$i"]
										  );
						} else {
							//better quality
							imagecopyresampled( $dst_r,
											$img_r,
											0,
											0,
											$_POST["x$i"],
											$_POST["y$i"],
											$_POST["w$i"],
											$_POST["h$i"],
											$_POST["w$i"],
											$_POST["h$i"]
										  );
						}
						
						
					}

					${"crop_image".$k} = $dir."crop_image$k.$img_type"; 
					if ($img_type == 'gif'){
						imagegif($dst_r, ${"crop_image".$k});
					}elseif ($img_type == 'jpeg'){
						imagejpeg($dst_r, ${"crop_image".$k});
					}elseif ($img_type == 'png'){
						imagepng($dst_r, ${"crop_image".$k});
					}

					//removing image files
					//foreach($files as $file) unlink($file);

				}
			}
		}
    
		if (($submit_button || $last_crop) && (!DEMO_LIVE_MODE)) {
			/* setting title */
			if (!customtext_set("header_title", $header_title, $clang)) {
				if (!customtext_new("header_title", $header_title, $clang)) {
					$error = true;
					$actions = "";
				}
			}

			/* setting author */
			if (!customtext_set("header_author", $header_author, $clang)) {
				if (!customtext_new("header_author", $header_author, $clang)) {
					$error = true;
					$actions = "";
				}
			}

			/* setting description */
			if (!customtext_set("header_description", $header_description, $clang)) {
				if (!customtext_new("header_description", $header_description, $clang)) {
					$error = true;
				}
			}

			/* setting keywords */
			if (!customtext_set("header_keywords", $header_keywords, $clang)) {
				if (!customtext_new("header_keywords", $header_keywords, $clang)) {
					$error = true;
				}
			}

			if ($error) {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
			}

			/* header image file */
			if ( $restore_image || $crop_image0 ) {
				$filename = EDIRECTORY_ROOT.IMAGE_HEADER_PATH;
				$image_upload = image_uploadForHeader($filename, $crop_image0, $restore_image);
				if (!$image_upload["success"]) {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_ALERTUPLOADIMAGE1);
					$error = true;
				}
			}

			/* rss logo file */
			if ( $restore_logo_rrs || $crop_image1 ) {
				$filename = EDIRECTORY_ROOT.RSS_LOGO_PATH;
				$image_upload = image_uploadForRss($filename, $crop_image1, $restore_logo_rrs);
				if (!$image_upload["success"]) {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_ALERTUPLOADIMAGE1);
					$error = true;
				}
			}

			/* mobile logo file */
			if ( $restore_logo_mobile || $crop_image2 ) {
				$filename = EDIRECTORY_ROOT.MOBILE_LOGO_PATH;
				$image_upload = image_uploadForMobile($filename, $crop_image2, $restore_logo_mobile);
				if (!$image_upload["success"]) {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_ALERTUPLOADIMAGE1);
					$error = true;
				}
			}

			/* sitemgr logo file */
			if ( $restore_logo_sitemgr || $crop_image3 ) {
				$filename = EDIRECTORY_ROOT.SITEMGR_LOGO_PATH;
				$image_upload = image_uploadForSitemgr($filename, $crop_image3, $restore_logo_sitemgr);
				if (!$image_upload["success"]) {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_ALERTUPLOADIMAGE1);
					$error = true;
				}
			}

			if($actions) {
				$message_header .= implode("<br />", $actions);
			} else {
				$message_header  = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_CONTENT_HEADER_SUCCESS);
			}

		}
	}
	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	/**
	* Field values
	*/

	customtext_get("header_title", $header_title, $clang);

	customtext_get("header_author", $header_author, $clang);

	customtext_get("header_description", $header_description, $clang);

	customtext_get("header_keywords", $header_keywords, $clang);

?>
