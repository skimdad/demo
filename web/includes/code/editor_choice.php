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
	# * FILE: /includes/code/editor_choice.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$message_editorchoice = "";
	$message_error_editorchoice = "";

	if ($_POST["editorchoice"] == "Submit") {
		foreach ($_POST['name'] as $k => $name) {
			$i = $k+1;
			if (($name && (!$_POST["image_type$i"] && !$_POST['image'][$k])) || (!$name && ($_POST["image_type$i"] || $_POST['image'][$k]))) {
				$message_error_editorchoice .= "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_MSGERROR_REQUIREDTOFINISHUPDATE1)." ".($k+1)." ".system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_MSGERROR_REQUIREDTOFINISHUPDATE2)."<br />";
			}
		}
		if ((!$message_editorchoice) && (!$message_error_editorchoice)) {
			$user_id = $_COOKIE["PHPSESSID"];
			$dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
			foreach ($_POST['name'] as $k => $name) {
				$i = $k+1;
				unset($editorChoiceObj);
				$editorChoiceObj = new EditorChoice($_POST['choice'][$k]);
				if ($name) {
					$files = glob("$dir/_".$k."_".$user_id."_*.*");
					if ($files[0]){
						$posI = string_strpos($files[0], "_".$k);
						$posF = string_strpos($files[0], "_".$k."_");
						$len = string_strlen($files[0]);
						$pref_file = string_substr($files[0], $posI + 1, $len);
						$pref_file = $pref_file{0};
						if ($k == $pref_file) {
							if ($_POST["image_type$i"]) {
								// TYPES
								//1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
								switch ($_POST["image_type$i"]) {
									case 1:
										${"img_type".$i} = 'gif';
										$img_r = imagecreatefromgif($files[0]);
									break;
									case 2:
										${"img_type".$i} = 'jpeg';
										$img_r = imagecreatefromjpeg($files[0]);
									break;
									case 3:
										${"img_type".$i} = 'png';
										$img_r = imagecreatefrompng($files[0]);
									break;
								}
								$dst_r = ImageCreateTrueColor($_POST["w$i"], $_POST["h$i"]);
								if ($img_r) {
									
									if(${"img_type".$i} == "png" || ${"img_type".$i} == "gif"){
										imagealphablending($dst_r, false);
										imagesavealpha($dst_r,true);
										$transparent = imagecolorallocatealpha( $dst_r, 255, 255, 255, 127 );
										imagefill( $dst_r, 0, 0, $transparent ); 
										imagecolortransparent( $dst_r, $transparent);
									}
									
									if (${"img_type".$i} == "gif"){
										imagecopyresized($dst_r, $img_r, 0, 0, $_POST["x$i"], $_POST["y$i"], $_POST["w$i"], $_POST["h$i"], $_POST["w$i"], $_POST["h$i"]);
									} else {
										imagecopyresampled($dst_r, $img_r, 0, 0, $_POST["x$i"], $_POST["y$i"], $_POST["w$i"], $_POST["h$i"], $_POST["w$i"], $_POST["h$i"]);
									}
									
								}
								${"imgW".$i} = $_POST["w$i"];
								${"imgH".$i} = $_POST["h$i"];
								${"crop_image".$i} = $dir."/crop_image$i.${"img_type".$i}";
								if (${"img_type".$i} == 'gif') {
									imagegif($dst_r, ${"crop_image".$i});
									${"img_type".$i} = 'GIF';
								} elseif (${"img_type".$i} == 'jpeg') {
									imagejpeg($dst_r, ${"crop_image".$i});
									${"img_type".$i} = 'JPG';
								} elseif (${"img_type".$i} == 'png') {
									imagepng($dst_r, ${"crop_image".$i});
									${"img_type".$i} = 'PNG';
								}
							}
							if (${"crop_image".$i}) {
								
								unset($imageArray);
								$imageArray = image_uploadBadges(${"crop_image".$i}, "sitemgr_", IMAGE_DESIGNATION_WIDTH, IMAGE_DESIGNATION_HEIGHT);
								if ($imageArray["success"]) {
									unset($imageObj);
									if ($editorChoiceObj->image_id) {
										$imageObj = new Image($editorChoiceObj->image_id);
										if ($imageObj) $imageObj->Delete();
									}
									unset($imageObj);
									$editorChoiceObj->image_id = $imageArray["image_id"];
								}
							}
						}
					}
					$editorChoiceObj->name = $name;
					$editorChoiceObj->available = ($_POST["available_$k"]) ? "1" : "0";
					$editorChoiceObj->save();
					unset($editorChoiceObj);
					$name=str_replace("\\","",$name);
					$message_editorchoice .= "&#149;&nbsp; ".system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_FILE)." ".($name).": ".system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DESIGNATIONWASUPDATED)."<br />";
				}
			}
            $files = glob("$dir/_*_".$user_id."_*.*");
			if ($files){
				foreach ($files as $file)
					unlink($file);
			}
		}
	}
?>