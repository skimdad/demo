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
	# * FILE: /includes/code/profile.php
	# ----------------------------------------------------------------------------------------------------

	if ($_POST["ajax"]) {
		# ----------------------------------------------------------------------------------------------------
		# LOAD CONFIG
		# ----------------------------------------------------------------------------------------------------
		include("../../conf/loadconfig.inc.php");
	}
	$validate_demodirectoryDotCom = true;
	if (DEMO_LIVE_MODE) {
		$validate_demodirectoryDotCom = validate_demodirectoryDotCom($_POST["username"], $message_demoDotCom);
	}

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($validate_demodirectoryDotCom) {
			if ($_POST["ajax"]) {
				
				if ($_POST['has_profile'] == "on" || $_POST['has_profile'] == "true") {
					$has_profile = true;
				} else {
					$has_profile = false;
				}

				$accObj = new Account();
				$accObj->setNumber("id", $_POST["account_id"]);
				$accObj->changeProfileStatus($has_profile);

				$accDomain = new Account_Domain($accObj->getNumber("id"), SELECTED_DOMAIN_ID);
				$accDomain->Save();
				$accDomain->saveOnDomain($accObj->getNumber("id"), $accObj);
			}

			extract($_POST);

			//Clean Image
			if ($remove_image) {
				if ($idm = $_POST["image_id"]) {
					$image = new Image($idm, true);
					if ($image) $image->Delete();
				}

				$_POST["image_id"] = 0;
				$_POST["facebook_image"] = "";
				$_POST["facebook_image_height"] = 0;
				$_POST["facebook_image_width"] = 0;
			}

			// Image Crop
			if ($_POST["image_type"] != "") {
				// TYPES
				//1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
				$user_id = $_COOKIE["PHPSESSID"];
//				$dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
				$dir = PROFILE_IMAGE_DIR;
				$files = glob("$dir/_0_".$user_id."_*.*");

				if ($files[0]) {

					switch ($_POST["image_type"]) {
						case 1:
							$img_type = 'gif';
							$img_r = imagecreatefromgif($files[0]);
						break;
						case 2:
							$img_type = 'jpeg';
							$img_r = imagecreatefromjpeg($files[0]);
						break;
						case 3:
							$img_type = 'png';
							$img_r = imagecreatefrompng($files[0]);
						break;
					}

					$dst_r = ImageCreateTrueColor($_POST['w'], $_POST['h']);

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
							imagecopyresized($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $_POST['w'], $_POST['h'], $_POST['w'], $_POST['h']);
			
						} else {
							//better quality
							imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $_POST['w'], $_POST['h'], $_POST['w'], $_POST['h']);
						}
						
					}

					$crop_image = $dir."/crop_image.$img_type";
					if ($img_type == 'gif') {
						imagegif($dst_r, $crop_image);
					} elseif ($img_type == 'jpeg') {
						imagejpeg($dst_r, $crop_image);
					} elseif ($img_type == 'png') {
						imagepng($dst_r, $crop_image);
					}

					//removing image files
					foreach ($files as $file) unlink($file);

					if ((file_exists($_FILES['image']['tmp_name']) || file_exists($crop_image)) && (!$crop_submit)) {
						$imageArray = image_uploadForItem((($crop_image) ? $crop_image : $_FILES['image']['tmp_name']), $_POST["account_id"]."_", 200, 200, "", "", true);
						if ($imageArray["success"]) {
							$_POST["facebook_image"] = "";
							$_POST["facebook_image_height"] = 0;
							$_POST["facebook_image_width"] = 0;
							$upload_image = "success";
							$remove_image = false;
							$_POST["image_id"] = $imageArray["image_id"];
						} else $upload_image = "failed";
					}
				}
			}

			if(!$crop_submit) {
				$accObj = new Account($_POST["account_id"]);
				$profileObj = new Profile($_POST["account_id"]);

				if (($accObj->getString("foreignaccount") == "y") && ($accObj->getString("foreignaccount_done") == "n")) {
					$_POST["nickname"] = $_POST["first_name"]." ".$_POST["last_name"];

					if ($_POST["facebook_image"]) {
						$_POST["image_id"] = "";
					}

					$profileObj->makeFromRow($_POST);
					$profileObj->Save();

					$accDomain = new Account_Domain($profileObj->getNumber("account_id"), SELECTED_DOMAIN_ID);
					$accDomain->Save();
					$accDomain->saveOnDomain($profileObj->getNumber("account_id"), false, false, $profileObj);
				} else {
					if ($_POST["facebook_image"]) {
						$_POST["image_id"] = "";
					}

					if(!preg_match(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) {
						$message_profile = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_INVALID_CHARS)."<br />";
						$error = 1;
					}

					if (!trim($_POST["nickname"])) {
						$message_profile .= "&#149;&nbsp;".system_showText(LANG_MSG_NICKANAME_REQUIRED)."<br />";
						$error = 1;
					}

					if($profileObj->fUrl_Exists($_POST["friendly_url"])) {
						$message_profile .= "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_URL_IN_USE);
						$error = 1;
					}

					if(!$error){
						$profileObj->makeFromRow($_POST);
						$profileObj->Save();

						$accDomain = new Account_Domain($profileObj->getNumber("account_id"), SELECTED_DOMAIN_ID);
						$accDomain->Save();
						$accDomain->saveOnDomain($profileObj->getNumber("account_id"), false, false, $profileObj);

						$message = system_showText(LANG_MSG_PROFILE_SUCCESSFULLY_UPDATED);
						$message_style = "successMessage";

						$profileObj = new Profile($account_id);
						$profileObj->extract();
					}
				}
			}
		}
	} else {
		if (string_strpos($_SERVER["PHP_SELF"], "/profile/") !== false && $_GET["tab"] != "tab_2") {
			$accObj = new Account(sess_getAccountIdFromSession());
			if (($accObj->getString("foreignaccount") == "y") && ($accObj->getString("foreignaccount_done") == "n")) {
				header("Location: ".SOCIALNETWORK_URL."/edit.php?tab=tab_2");
				exit;
			}
		}

		$profileObj = new Profile(sess_getAccountIdFromSession());
		$profileObj->extract();
	}

	if($tw_oauth_token && $tw_oauth_token_secret && $tw_screen_name) {
		$twitterInfo = true;
	}

	setting_get("foreignaccount_twitter_apikey", $foreignaccount_twitter_apikey);
	setting_get("foreignaccount_twitter_apisecret", $foreignaccount_twitter_apisecret);
	if ($foreignaccount_twitter_apikey && $foreignaccount_twitter_apisecret) {
		$twitterSupport = true;
		$EpiTwitter = new EpiTwitter($foreignaccount_twitter_apikey, $foreignaccount_twitter_apisecret);
	}

	if ($tw_post)$twpost_checked = "checked=\"checked\"";

	if ($_GET["twitter"]) {
		if ($_GET["twitter"] == "success") $twitterMessage = system_showText(LANG_LABEL_TW_SIGNTW_CONN);
		else if ($_GET["twitter"] == "fail") $twitterMessage = system_showText(LANG_LABEL_TW_SIGNTW);
		else if ($_GET["twitter"] == "alreadyused") $twitterMessage = system_showText(LANG_TW_ALREADY_LINKED);
	}

	if ($_GET["signofftwitter"] == "success") $twitterMessage = system_showText(LANG_LABEL_TW_ACT_DISC).'.';

?>
