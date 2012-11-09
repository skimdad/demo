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
	# * FILE: /includes/code/banner.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	// fixing url field if needed.

	$language_numbers = explode(",", EDIR_LANGUAGENUMBERS);

	if($_POST["destination_url"]) {
		if ((string_strpos($destination_url,"http://")!==false) || (string_strpos($destination_url,"https://")!==false) || (string_strpos($destination_url,"ftp://")!==false)) {
			if (string_strpos($_POST["destination_url"], "http://") === 0) $_POST["destination_url"] = string_substr($_POST["destination_url"], 7);
			if (string_strpos($_POST["destination_url"], "https://") === 0) $_POST["destination_url"] = string_substr($_POST["destination_url"], 8);
			if (string_strpos($_POST["destination_url"], "ftp://") === 0) $_POST["destination_url"] = string_substr($_POST["destination_url"], 6);
		}
	}

	// validating spaces in caption
	$_POST["caption".EDIR_DEFAULT_LANGUAGENUMBER] = preg_replace('/\s\s+/', ' ', $_POST["caption".EDIR_DEFAULT_LANGUAGENUMBER]);

	// Security ////////////////////////////////////////////////////////////////
	if ((sess_isAccountLogged()) && (string_strpos($url_base, "/members"))) { 

		unset($_POST["renewal_date"]); unset($_GET["renewal_date"]); unset($renewal_date);
		unset($_POST["status"]);       unset($_GET["status"]);       unset($status);
		unset($_POST["account_id"]);   unset($_GET["account_id"]);   unset($account_id);

		$_POST["account_id"] = sess_getAccountIdFromSession();

		$id = ($_POST["id"]) ? $_POST["id"] : (($_GET["id"]) ? $_GET["id"] : "");

		if ($id) {

			$bannerObj = new Banner($id);
			$levelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);

			if($_POST["account_id"] != $bannerObj->getNumber("account_id")) {
				header("Location: $url_redirect/index.php");
				exit;
			}

			// code to get banner price - begin
			$bannerLevelObjTmp = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
			$thisTmpPrice = 0;
			if ($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE) {
				$thisTmpPrice = $bannerLevelObjTmp->getPrice($bannerObj->getNumber("type"));
			}
			if ($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION) {
				$thisTmpPrice = $bannerLevelObjTmp->getImpressionPrice($bannerObj->getNumber("type"));
			}
			unset($bannerLevelObjTmp);
			// code to get banner price - end

			##################################################
			// problem was that free banners can NOT CHANGED type.
			if ($thisTmpPrice > 0) {
				// so now if banner is free, member can CHANGED its type.
				if (
						(
							($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION) && 
							($bannerObj->getString("impressions") > 0)
						)
						||
						(
							($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE) && 
							(!$bannerObj->needToCheckOut())
						)
						||
						(($bannerObj) && ($bannerObj->getPrice() <= 0))
					) {

						unset($_POST["type"]); unset($_GET["type"]); unset($type);
						$_POST["type"] = $bannerObj->getNumber("type");

					}
			}
			##################################################

			if (!is_int($_POST["unpaid_impressions"] / $levelObj->getImpressionBlock($_POST["type"]))) {
				unset($_POST["unpaid_impressions"]);
			}
		}

		unset($bannerObj);
		unset($levelObj);

	}
	////////////////////////////////////////////////////////////////////////////

	extract($_POST);
	extract($_GET);

	$noImageUp = false;
	/**
	* Images upload
	****************************************************************************/
	if ($_FILES){

		$uploadObj = new UploadFiles();

		$error_size = 0;
		foreach($_FILES as $key => $file){
			$labelsuffix = str_replace("file", "", $key);

			$types               = array("1" => "GIF", "2" => "JPG", "13" => "SWF", "4" => "SWF", "3" => "PNG");
			$info                = @getimagesize($file["tmp_name"]);
			$extension           = string_strtolower($types[$info[2]]);
			$row_image['type']   = $types[$info[2]];
			$row_image['width']  = $info[0];
			$row_image['height'] = $info[1];

			if (string_strpos($_SERVER["PHP_SELF"],"sitemgr")){
				$row_image['prefix'] = "sitemgr_";
			}else {
				$row_image['prefix'] = $_SESSION[SESS_ACCOUNT_ID]."_";
			}

			if ($_POST["account_id"]){
				$row_image['prefix'] = $_POST["account_id"]."_";
			}

			$imageObj = new Image($row_image);
			$imageObj->Save();

			$file_name = $imageObj->getString("prefix")."photo_".$imageObj->getNumber("id").".".$extension;

			$supported_extensions = array(	"gif"  => "image/gif",
											"jpg"  => "image/jpeg,image/pjpeg",
											"jpeg" => "image/jpeg,image/pjpeg",
											"png"  => "image/png,image/x-png",
											"swf"  => "application/x-shockwave-flash");

			$uploadObj->set("name",$file_name);									// file name.
			$uploadObj->set("type",$file["type"]);								// file type.
			$uploadObj->set("tmp_name",$file["tmp_name"]);						// tmp file name.
			$uploadObj->set("error",$file["error"]);							// file error.
			$uploadObj->set("size",$file["size"]);								// file size.
			$uploadObj->set("fld_name",$key);									// file field name.
			$uploadObj->set("max_file_size", BANNER_UPLOAD_MAX_SIZE_INBYTE);	// banners will have max 400Kb.
			$uploadObj->set("supported_extensions",$supported_extensions);		// Allowed extensions and types for uploaded file.
			$uploadObj->set("randon_name",FALSE);								// Generate a unique name for uploaded file? bool(true/false).
			$uploadObj->set("replace",FALSE);									// Replace existent files or not? bool(true/false).
			$uploadObj->set("file_perm",0444);									// Permission for uploaded file. 0444 (Read only).
			$uploadObj->set("dst_dir",IMAGE_DIR);								// Destination directory for uploaded files.
			$result = $uploadObj->moveFileToDestination();						// $result = bool (true/false). Succeed or not.

			if ($uploadObj->error_type == 2) {
				$error_size = 1;
			}

			if(!$result){ // no image uploaded

				// deleting the image from database because the upload fail.
				$imageObj->Delete();
				unset($imageObj);

			} else { // image uploaded

				$_POST["image_id".$labelsuffix] = $imageObj->getNumber("id");
				$_POST["file".EDIR_DEFAULT_LANGUAGENUMBER] = true; // to form validation work.

				// delete image that will be replaced.
				if($id) {
					$bannerObj = new Banner($id);
					$imageObj  = new Image($bannerObj->getNumber("image_id".$labelsuffix));
					$imageObj->Delete();
				}

				unset($bannerObj);
				unset($imageObj);

			}

			$i++;
		}

	}

	/**
	* Messages
	****************************************************************************
	if($uploadObj && ($uploadObj->getString("succeed_files_track") || $uploadObj->getString("fail_files_track"))){
		foreach($uploadObj->getString("succeed_files_track") as $each_succed){
			$banner = string_ucwords(str_replace("_"," ",$each_succed["field_name"]));
			$message .= system_showText(LANG_UPLOAD_WARNING).": ".$each_succed["msg"]."<br />";
		}
		foreach($uploadObj->getString("fail_files_track") as $each_failure){
			$banner = string_ucwords(str_replace("_"," ",$each_failure["field_name"]));
			$error_message .= system_showText(LANG_UPLOAD_WARNING).": ".$each_failure["msg"]."<br />";
		}
	}

	/**
	* Delete operation
	****************************************************************************/
	if ($operation == "delete" ) {

		//$message .= system_showText(LANG_MSG_BANNER_SUCCESSFULLY_DELETED);
        $message = 0;
        
		$bannerObj = new Banner($id);
		$bannerObj->Delete();
		unset($bannerObj);

		header("Location: ".$url_redirect."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;

	}
    
	/**
	* Insert Operation
	****************************************************************************/
	if ($operation == "add") {

		$_POST["caption".EDIR_DEFAULT_LANGUAGENUMBER] = trim($_POST["caption".EDIR_DEFAULT_LANGUAGENUMBER]);
		if ((validate_form("banner", $_POST, $val_message, '', $error_size)) && is_valid_discount_code($_POST["discount_id"], "banner", $_POST["id"], $val_message, $discount_error_num)) {

			if (($uploadObj->error_type == 0) || ($uploadObj->error_type == 6)) {
				$message = "";
			}
			$error_message .= $val_message."<br />";
			//$message .= system_showText(LANG_MSG_BANNER_SUCCESSFULLY_ADDED);
			$message = 1;

			$emailNotification = true;

			// Saving Banner
			$bannerObj = new Banner($_POST);
			if (string_strpos($url_base, "/sitemgr")) {
				$bannerObj->setDate("renewal_date", $_POST['renewal_date']); // set date of correct format
			}
			if (!$bannerObj->hasImpressions()) {
				$bannerObj->setNumber("unpaid_impressions", 0);
				$bannerObj->setString("unlimited_impressions", "y");
			} else {
				$bannerObj->setString("unlimited_impressions", "n");
			}

			$bannerObj->Save();
			$id = $bannerObj->getString("id");
			$domain	 = new Domain(SELECTED_DOMAIN_ID);
			if ((sess_isAccountLogged()) && (string_strpos($url_base, "/members"))) {
				$domain_url = DEFAULT_URL;
				$domain_url = str_replace($_SERVER["HTTP_HOST"],$domain->getstring("url"),$domain_url);
				$acctId = sess_getAccountIdFromSession();
				$accountObj = new Account($acctId);
				$contactObj = new Contact($acctId);
				setting_get("sitemgr_send_email",$sitemgr_send_email);
				setting_get("sitemgr_email",$sitemgr_email);
				$sitemgr_emails = explode(",",$sitemgr_email);
				setting_get("sitemgr_banner_email",$sitemgr_banner_email);
				$sitemgr_banner_emails = explode(",",$sitemgr_banner_email);
				$sitemgr_msg = "
					<html>
						<head>
							<style>
								.email_style_settings{
									font-size:12px;
									font-family:Verdana, Arial, Sans-Serif;
									color:#000;
								}
							</style>
						</head>
						<body>
							<div class=\"email_style_settings\">
								Site Manager,<br /><br />";
				$sitemgr_msg .= "The ".BANNER_FEATURE_FOLDER." \"".$bannerObj->getString("caption")."\" was created by the administrator \"".system_showAccountUserName($accountObj->getString("username"))."\" and needs to be revised by you.<br /><br />";
				$sitemgr_msg .= "
								<a href=\"".$domain_url."/sitemgr/".BANNER_FEATURE_FOLDER."/view.php?id=".$bannerObj->getNumber("id")."\" target=\"_blank\">".$domain_url."/sitemgr/".BANNER_FEATURE_FOLDER."/view.php?id=".$bannerObj->getNumber("id")."</a><br /><br />
							</div>
						</body>
					</html>";
				$error = false;

				setting_get("new_banner_email", $new_banner_email);

				if ($new_banner_email){ 
                    if ($sitemgr_send_email == "on" && $emailNotification) {
                        if ($sitemgr_emails[0]) {
                            foreach ($sitemgr_emails as $sitemgr_email) {
                                system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(BANNER_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
                            }
                        }
                    }
                    if ($sitemgr_banner_emails[0] && $emailNotification) {
                        foreach ($sitemgr_banner_emails as $sitemgr_banner_email) {
                            system_mail($sitemgr_banner_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(BANNER_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_banner_email>", "text/html", '', '', $error);
                        }
                    }
                }
			}

			if ($_POST["account_id"] > 0) {
				$accountObj = new Account($_POST["account_id"]);
				$contactObj = new Contact($_POST["account_id"]);
				if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_BANNER, $contactObj->getString("lang"))) {
					if(!$sitemgr_email){
						setting_get("sitemgr_email",$sitemgr_email);
						$sitemgr_emails = explode(",",$sitemgr_email);
						setting_get("sitemgr_banner_email",$sitemgr_banner_email);
						
					}

					if($sitemgr_banner_email){
						$sitemgr_email = $sitemgr_banner_email;
					}

					if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
					$subject = $emailNotificationObj->getString("subject");
					$body    = $emailNotificationObj->getString("body");
					$body    = system_replaceEmailVariables($body,$id,'banner');
					$body	 = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $body);
					$subject = system_replaceEmailVariables($subject,$id,'banner');
					$body    = str_replace("DEFAULT_URL", DEFAULT_URL, $body);
					$domain = new Domain(SELECTED_DOMAIN_ID);
					$body	 = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $body);
					$body = html_entity_decode($body);
					$subject = html_entity_decode($subject);
					system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
				}
			}

			$newest = "1";
			
			setting_get("banner_approve_free", $banner_approve_free);
			
			if (!$banner_approve_free && !$bannerObj->needToCheckOut()){
				$bannerObj->setString("status", "A");
				$bannerObj->save();
			}

			unset($bannerObj);

			if (string_strpos($url_base, "/members")) header("Location: ".$url_redirect."/index.php?message=".$message."&newest=".$newest);
			else header("Location: ".$url_redirect."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&newest=".$newest."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;

		} else {

			$imageObj = new Image($_POST["image_id1"]);
			$imageObj->Delete();
			unset($imageObj);
			$imageObj = new Image($_POST["image_id2"]);
			$imageObj->Delete();
			unset($imageObj);
			$imageObj = new Image($_POST["image_id3"]);
			$imageObj->Delete();
			unset($imageObj);
			$imageObj = new Image($_POST["image_id4"]);
			$imageObj->Delete();
			unset($imageObj);
			$imageObj = new Image($_POST["image_id5"]);
			$imageObj->Delete();
			unset($imageObj);
			$imageObj = new Image($_POST["image_id6"]);
			$imageObj->Delete();
			unset($imageObj);
			$imageObj = new Image($_POST["image_id7"]);
			$imageObj->Delete();
			unset($imageObj);

		}

		$error_message .= $val_message."<br />";
		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);

		extract($_POST);
		extract($_GET);

	}

	/**
	* Update Operation
	****************************************************************************/
	if ($operation == "update") {

		$_POST["caption".EDIR_DEFAULT_LANGUAGENUMBER] = trim($_POST["caption".EDIR_DEFAULT_LANGUAGENUMBER]);

		if ((validate_form("banner", $_POST, $val_message, '', $error_size)) && is_valid_discount_code($_POST["discount_id"], "banner", $_POST["id"], $val_message, $discount_error_num)) {

			if (($uploadObj->error_type == 0) || ($uploadObj->error_type == 6)) {
				$message = "";
			}
			$error_message .= $val_message;
			//$message .= system_showText(LANG_MSG_BANNER_SUCCESSFULLY_UPDATED);
            $message = 2;

			$status = new ItemStatus();
			$bannerObj = new Banner($id); // Loading banner info into object
			$last_status = $bannerObj->getString("status");
			
			// Change or not status to Pending and define renew_date
			if (string_strpos($url_base, "/sitemgr")) { 
				$_POST["status"] = $bannerObj->getString("status");

				if (!$result && $_POST["account_id"]!=$bannerObj->account_id){
					$image_idB1 = $bannerObj->getNumber("image_id1");
					$image_idB2 = $bannerObj->getNumber("image_id2");
					$image_idB3 = $bannerObj->getNumber("image_id3");
					$image_idB4 = $bannerObj->getNumber("image_id4");
					$image_idB5 = $bannerObj->getNumber("image_id5");
					$image_idB6 = $bannerObj->getNumber("image_id6");
					$image_idB7 = $bannerObj->getNumber("image_id7");

					foreach ($language_numbers as $i) {
						if (${"image_idB".$i}){

							$imageChange = new Image(${"image_idB".$i});
							if ($imageChange->imageExists()) {
								$oldPrefix = $imageChange->getString("prefix");
								$newPrefix = $_POST["account_id"] ? $_POST["account_id"]."_" : "sitemgr_";

								$img_type = string_strtolower($imageChange->getString("type"));
								$imageChange->setString("prefix",$newPrefix);
								$imageChange->Save();

								$dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
								$imageOld = $dir."/".$oldPrefix."photo_".${"image_idB".$i}.".".$img_type;
								$imageNew = $dir."/".$newPrefix."photo_".${"image_idB".$i}.".".$img_type;
								rename($imageOld, $imageNew);
							}
						}
					}
				}

			} else {
				$bannerStatusObj = new ItemStatus();
				if ($bannerObj->getNumber("type") != $_POST["type"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getNumber("section") != $_POST["section"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getNumber("category_id") != $_POST["category_id"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("target_window") != $_POST["target_window"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }

				if ($bannerObj->getString("caption1") != $_POST["caption1"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("caption2") != $_POST["caption2"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("caption3") != $_POST["caption3"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("caption4") != $_POST["caption4"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("caption5") != $_POST["caption5"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("caption6") != $_POST["caption6"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("caption7") != $_POST["caption7"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }

				if ($bannerObj->getString("discount_id") != $_POST["discount_id"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("destination_protocol") != $_POST["destination_protocol"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("destination_url") != $_POST["destination_url"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("display_url") != $_POST["display_url"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }

				if ($bannerObj->getString("content_line11") != $_POST["content_line11"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line12") != $_POST["content_line12"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line13") != $_POST["content_line13"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line14") != $_POST["content_line14"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line15") != $_POST["content_line15"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line16") != $_POST["content_line16"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line17") != $_POST["content_line17"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }

				if ($bannerObj->getString("content_line21") != $_POST["content_line21"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line22") != $_POST["content_line22"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line23") != $_POST["content_line23"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line24") != $_POST["content_line24"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line25") != $_POST["content_line25"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line26") != $_POST["content_line26"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line27") != $_POST["content_line27"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }

				if ($_POST["image_id1"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($_POST["image_id2"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($_POST["image_id3"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($_POST["image_id4"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($_POST["image_id5"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($_POST["image_id6"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($_POST["image_id7"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
			}

			if (!$bannerObj->hasRenewalDate()) {
				$_POST["renewal_date"] = "0000-00-00";
			}
			if (!$bannerObj->hasImpressions()) {
				$_POST["unpaid_impressions"] = 0;
				$_POST["unlimited_impressions"] = "y";
			} else {
				$_POST["unlimited_impressions"] = "n";
			}

			// member can create a banner free and check out it
			// aftet, renewal date will to some periods or impressions will to some blocks
			// because banner is free, member can change his banner type any time
			// if he change his banner type, he MUST pay for this new banner type (it isnt free anymore)
			// any change in banner type, renewal date and impressions go to like new banner
			// ps: just for the case new banner type
			if ($bannerObj->getNumber("type") != $_POST["type"]) {
				$_POST["renewal_date"] = "00/00/0000";
				$_POST["impressions"] = 0;
			}

			$bannerObj->makeFromRow($_POST); // Loading new info into banner

			if($_POST["type"] < 50) { // Image banners don't have following fields.
				$bannerObj->setString("content_line11","");
				$bannerObj->setString("content_line12","");
				$bannerObj->setString("content_line13","");
				$bannerObj->setString("content_line14","");
				$bannerObj->setString("content_line15","");
				$bannerObj->setString("content_line16","");
				$bannerObj->setString("content_line17","");

				$bannerObj->setString("content_line21","");
				$bannerObj->setString("content_line22","");
				$bannerObj->setString("content_line23","");
				$bannerObj->setString("content_line24","");
				$bannerObj->setString("content_line25","");
				$bannerObj->setString("content_line26","");
				$bannerObj->setString("content_line27","");
			} else { // Text banners don't have images.
				$imageObj = New Image($bannerObj->getNumber("image_id1"));
				$imageObj->Delete();
				$bannerObj->setNumber("image_id1", "0");
				$imageObj = New Image($bannerObj->getNumber("image_id2"));
				$imageObj->Delete();
				$bannerObj->setNumber("image_id2", "0");
				$imageObj = New Image($bannerObj->getNumber("image_id3"));
				$imageObj->Delete();
				$bannerObj->setNumber("image_id3", "0");
				$imageObj = New Image($bannerObj->getNumber("image_id4"));
				$imageObj->Delete();
				$bannerObj->setNumber("image_id4", "0");
				$imageObj = New Image($bannerObj->getNumber("image_id5"));
				$imageObj->Delete();
				$bannerObj->setNumber("image_id5", "0");
				$imageObj = New Image($bannerObj->getNumber("image_id6"));
				$imageObj->Delete();
				$bannerObj->setNumber("image_id6", "0");
				$imageObj = New Image($bannerObj->getNumber("image_id7"));
				$imageObj->Delete();
				$bannerObj->setNumber("image_id7", "0");
			}

			$bannerObj->Save(); // Saving Banner

			if ($_POST["from_advertise"]) {
				$accObj = new Account(sess_getAccountIdFromSession());
				$accObj->changeMemberStatus(true);

				$accDomain = new Account_Domain($accObj->getNumber("id"), SELECTED_DOMAIN_ID);
				$accDomain->Save();
				$accDomain->saveOnDomain($accObj->getNumber("id"), $accObj);
			}

			if ((sess_isAccountLogged() && $changed) && (string_strpos($url_base, "/members"))) {

				$acctId = sess_getAccountIdFromSession();
				$accountObj = new Account($acctId);
				$contactObj = new Contact($acctId);

				setting_get("sitemgr_send_email",$sitemgr_send_email);
				setting_get("sitemgr_email",$sitemgr_email);
				$sitemgr_emails = explode(",",$sitemgr_email);
				setting_get("sitemgr_banner_email",$sitemgr_banner_email);
				$sitemgr_banner_emails = explode(",",$sitemgr_banner_email);

				$sitemgr_msg = "
					<html>
						<head>
							<style>
								.email_style_settings{
									font-size:12px;
									font-family:Verdana, Arial, Sans-Serif;
									color:#000;
								}
							</style>
						</head>
						<body>
							<div class=\"email_style_settings\">
								Site Manager,<br /><br />";
				$sitemgr_msg .= "The ".BANNER_FEATURE_FOLDER." \"".$bannerObj->getString("caption")."\" was changed by the administrator \"".system_showAccountUserName($accountObj->getString("username"))."\" and needs to be revised by you.<br /><br />";
				$sitemgr_msg .= "
								<a href=\"".DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER."/settings.php?id=".$bannerObj->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER."/settings.php?id=".$bannerObj->getNumber("id")."</a><br /><br />
							</div>
						</body>
					</html>";
                $error = false;
				
				setting_get("update_banner_email", $update_banner_email);
				
				if ($update_banner_email){

                    if ($sitemgr_send_email == "on") {
                        if ($sitemgr_emails[0]) {
                            foreach ($sitemgr_emails as $sitemgr_email) {
                                system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(BANNER_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
                            }
                        }
                    }
                    if ($sitemgr_banner_emails[0]) {
                        foreach ($sitemgr_banner_emails as $sitemgr_banner_email) {
                            system_mail($sitemgr_banner_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(BANNER_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_banner_email>", "text/html", '', '', $error);
                        }
                    }
				}

			}
			
			if (string_strpos($url_base, "/members")) {
				setting_get("banner_approve_updated", $banner_approve_updated);
				if ($last_status == "A" && !$bannerObj->needToCheckOut() && !$banner_approve_updated && $process != "signup"){
					$bannerObj->setString("status", "A");
					$bannerObj->save();
				}else if ($process == "signup"){
					$bannerObj->setString("status", $last_status);
					$bannerObj->save();
				}
			}

			unset($bannerObj);

			header("Location: ".$url_redirect."/".(($search_page) ? "search.php" : "index.php")."?process=".$process."&newest=".$newest."&message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;

		}

		$error_message .= $val_message."<br />";

		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);

		extract($_POST);
		extract($_GET);

	}


	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	/**
	* Field values
	****************************************************************************/
	if ($id) {

		$bannerObj    = new Banner($id);
		$banner_types = $bannerObj->GetString("banner_types");

		// Making local vars from banner object.
		$destination_url		= ($_POST["destination_url"])		? $_POST["destination_url"]			: $bannerObj->getString("destination_url");
		$display_url			= ($_POST["display_url"])			? $_POST["display_url"]				: $bannerObj->getString("display_url");
		$destination_protocol	= ($_POST["destination_protocol"])	? $_POST["destination_protocol"]	: $bannerObj->getString("destination_protocol");

		$caption1				= ($_POST["caption1"])				? $_POST["caption1"]				: $bannerObj->getString("caption1");
		$caption2				= ($_POST["caption2"])				? $_POST["caption2"]				: $bannerObj->getString("caption2");
		$caption3				= ($_POST["caption3"])				? $_POST["caption3"]				: $bannerObj->getString("caption3");
		$caption4				= ($_POST["caption4"])				? $_POST["caption4"]				: $bannerObj->getString("caption4");
		$caption5				= ($_POST["caption5"])				? $_POST["caption5"]				: $bannerObj->getString("caption5");
		$caption6				= ($_POST["caption6"])				? $_POST["caption6"]				: $bannerObj->getString("caption6");
		$caption7				= ($_POST["caption7"])				? $_POST["caption7"]				: $bannerObj->getString("caption7");

		$discount_id			= ($_POST["discount_id"])			? $_POST["discount_id"]				: $bannerObj->getString("discount_id");
		$id						= $bannerObj->getString("id");

		$image_id1				= ($_POST["image_id1"])				? $_POST["image_id1"]				: $bannerObj->getNumber("image_id1");
		$image_id2				= ($_POST["image_id2"])				? $_POST["image_id2"]				: $bannerObj->getNumber("image_id2");
		$image_id3				= ($_POST["image_id3"])				? $_POST["image_id3"]				: $bannerObj->getNumber("image_id3");
		$image_id4				= ($_POST["image_id4"])				? $_POST["image_id4"]				: $bannerObj->getNumber("image_id4");
		$image_id5				= ($_POST["image_id5"])				? $_POST["image_id5"]				: $bannerObj->getNumber("image_id5");
		$image_id6				= ($_POST["image_id6"])				? $_POST["image_id6"]				: $bannerObj->getNumber("image_id6");
		$image_id7				= ($_POST["image_id7"])				? $_POST["image_id7"]				: $bannerObj->getNumber("image_id7");

		$type					= ($_POST["type"])					? $_POST["type"]					: $bannerObj->getString("type");
		$section				= ($_POST["section"])				? $_POST["section"]					: $bannerObj->getString("section");
		$account_id				= ($_POST["account_id"])			? $_POST["account_id"]				: $bannerObj->getString("account_id");
		$category_id			= ($_POST["category_id"])			? $_POST["category_id"]				: $bannerObj->getString("category_id");
		$renewal_date			= ($_POST["renewal_date"])			? $_POST["renewal_date"]			: $bannerObj->getDate("renewal_date");
		$target_window			= ($_POST["target_window"])			? $_POST["target_window"]			: $bannerObj->getNumber("target_window");

		$content_line11			= ($_POST["content_line11"])		? $_POST["content_line11"]			: $bannerObj->getNumber("content_line11");
		$content_line12			= ($_POST["content_line12"])		? $_POST["content_line12"]			: $bannerObj->getNumber("content_line12");
		$content_line13			= ($_POST["content_line13"])		? $_POST["content_line13"]			: $bannerObj->getNumber("content_line13");
		$content_line14			= ($_POST["content_line14"])		? $_POST["content_line14"]			: $bannerObj->getNumber("content_line14");
		$content_line15			= ($_POST["content_line15"])		? $_POST["content_line15"]			: $bannerObj->getNumber("content_line15");
		$content_line16			= ($_POST["content_line16"])		? $_POST["content_line16"]			: $bannerObj->getNumber("content_line16");
		$content_line17			= ($_POST["content_line17"])		? $_POST["content_line17"]			: $bannerObj->getNumber("content_line17");

		$content_line21			= ($_POST["content_line21"])		? $_POST["content_line21"]			: $bannerObj->getNumber("content_line21");
		$content_line22			= ($_POST["content_line22"])		? $_POST["content_line22"]			: $bannerObj->getNumber("content_line22");
		$content_line23			= ($_POST["content_line23"])		? $_POST["content_line23"]			: $bannerObj->getNumber("content_line23");
		$content_line24			= ($_POST["content_line24"])		? $_POST["content_line24"]			: $bannerObj->getNumber("content_line24");
		$content_line25			= ($_POST["content_line25"])		? $_POST["content_line25"]			: $bannerObj->getNumber("content_line25");
		$content_line26			= ($_POST["content_line26"])		? $_POST["content_line26"]			: $bannerObj->getNumber("content_line26");
		$content_line27			= ($_POST["content_line27"])		? $_POST["content_line27"]			: $bannerObj->getNumber("content_line27");

		$expiration_setting		= ($_POST["expiration_setting"])	? $_POST["expiration_setting"]		: $bannerObj->getNumber("expiration_setting");
		$unpaid_impressions		= ($_POST["unpaid_impressions"])	? $_POST["unpaid_impressions"]		: (($_POST["type"] == $bannerObj->getNumber("type") || !$_POST["type"]) ? $bannerObj->getNumber("unpaid_impressions") : "0");
		$impressions			= ($_POST["impressions"])			? $_POST["impressions"] 			: $bannerObj->getNumber("impressions");
		$show_type				= ($_POST["show_type"])				? $_POST["show_type"] 				: $bannerObj->getNumber("show_type");
		$script					= ($_POST["script"])				? $_POST["script"] 					: $bannerObj->getString("script");

		unset($bannerObj);

		$thisBannerObject = new Banner($id);

	}

	/**
	* Banner Drop Down
	****************************************************************************/
	$bannerObj = new Banner();
    $bannerLevel = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);

	$nameArray  = array();
	$valueArray = array();

	foreach($bannerObj->banner_types as $each_type => $each_value){

		$bannerLevelObj = new BannerLevel();
        if($bannerLevelObj->getActive($each_value)) {
		    $banner_size = "(".$bannerLevelObj->getWidth($each_value)."px x ".$bannerLevelObj->getHeight($each_value)."px)";

		    $nameArray[]  = string_ucwords($bannerLevel->getDisplayName($each_value))." ".$banner_size;
		    $valueArray[] = $each_value;
        }

	}
    $forceTextForm = false;
    if (count($valueArray) == 1 && $valueArray[0] >= 50){
        $forceTextForm = true;
    }

    $num_languages = count(explode(",", EDIR_LANGUAGENAMES));
	$type = (int)$type==0 ? "1" : $type;
	$banner_script = (string_strpos($url_base, "/sitemgr")) ? "onchange=\"bannerCheckType(this.value,'".DEFAULT_URL."', ".$num_languages.", '".EDIR_LANGUAGENUMBERS."', ".EDIR_DEFAULT_LANGUAGENUMBER.")\"" : "onchange=\"bannerCheckType(this.value,'".DEFAULT_URL."', ".$num_languages.", '".EDIR_LANGUAGENUMBERS."', ".EDIR_DEFAULT_LANGUAGENUMBER."); bannerFillSelect('".DEFAULT_URL."',this.form.unpaid_impressions, this.value,".SELECTED_DOMAIN_ID.")\"";
	$bannerTypeDropDown = html_selectBox("type", $nameArray, $valueArray, $type, $banner_script, "class='input-dd-form-banner'", "-- ".system_showText(LANG_LABEL_SELECT_TYPE)." --");

	unset($bannerObj);

	/**
	* Impressions Drop Down
	****************************************************************************/
	$nameArray  = array();
	$valueArray = array();

	for($i=0; $i < 50; $i++){
		$bannerLevelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
		$type = ($type) ? $type : $bannerLevelObj->getDefaultLevel();
		$nameArray[]  = $bannerLevelObj->getImpressionBlock($type)*$i;
		$valueArray[] = $bannerLevelObj->getImpressionBlock($type)*$i;
	}
	$disabled = (!$expiration_setting || $expiration_setting != BANNER_EXPIRATION_IMPRESSION) ? "disabled=true" : "";
	$bannerImpressionDropDown = html_selectBox("unpaid_impressions", $nameArray, $valueArray, $unpaid_impressions, "id='unpaid_impressions' $disabled", "style=\" width: 120px;\"");

	unset($bannerLevelObj);

	/**
	* Category Drop Down
	****************************************************************************/
	$nameArray  = array();
	$valueArray = array();
	if (!$section || $section == "general") {
		array_push($nameArray, system_showText(LANG_ALLPAGESBUTITEMPAGES));
		$categoryDropDown = html_selectBox("category_id", $nameArray, $valueArray, $category_id, "id=\"category_id\" disabled", "class='input-dd-form-banner' style='width: 350px;'", system_showText(LANG_ALLPAGESBUTITEMPAGES));
	} elseif (!$section || $section == "global") {
		array_push($nameArray, system_showText(LANG_ALLPAGES));
        $categoryDropDown = html_selectBox("category_id", $nameArray, $valueArray, $category_id, "id=\"category_id\" disabled", "class='input-dd-form-banner' style='width: 350px;'", system_showText(LANG_ALLPAGES));
    } else {
		if ($section == "listing") $tableCategory = "listingcategory";
		elseif ($section == "event") $tableCategory = "eventcategory";
		elseif ($section == "classified") $tableCategory = "classifiedcategory";
		elseif ($section == "article") $tableCategory = "articlecategory";

		$categoryScalability = constant(string_strtoupper($section)."CATEGORY_SCALABILITY_OPTIMIZATION");

		$langIndex = language_getIndex(EDIR_LANGUAGE);
		unset($where);
		$where = "category_id = 0 AND lang LIKE '%".EDIR_LANGUAGE."%' AND enabled = 'y'";
		$categories = db_getFromDB($tableCategory, "", "", MAX_SHOW_ALL_CATEGORIES, "title".$langIndex, "object", SELECTED_DOMAIN_ID, false, "*", $where);
		if ($categories) {
			foreach ($categories as $category) {
				if ($category->getString("title".$langIndex) && $category->getString("enabled") == "y") {
					if ($categoryScalability != "on") {
						$valueArray[]  = "";
						$nameArray[]   = "--------------------------------------------------";
					}
					$valueArray[]  = $category->getNumber("id");
					$nameArray[]   = $category->getString("title".$langIndex);
					$where = "category_id = ".$category->getNumber("id")." AND lang LIKE '%".EDIR_LANGUAGE."%' AND enabled = 'y'";
					$subcategories = db_getFromDB($tableCategory, "", "", MAX_SHOW_ALL_CATEGORIES, "title".$langIndex, "object", SELECTED_DOMAIN_ID, false, "*", $where);
					if ($subcategories && $categoryScalability != "on") {
						foreach ($subcategories as $subcategory) {
							if ($subcategory->getString("title".$langIndex) && $subcategory->getString("enabled") == "y") {
								$valueArray[] = $subcategory->getNumber("id");
								$nameArray[]  = "- ".$subcategory->getString("title".$langIndex);
								$where = "category_id = ".$subcategory->getNumber("id")." AND lang LIKE '%".EDIR_LANGUAGE."%' AND enabled = 'y'";
								$subcategories2 = db_getFromDB($tableCategory, "", "", MAX_SHOW_ALL_CATEGORIES, "title".$langIndex, "object", SELECTED_DOMAIN_ID, false, "*", $where);
								if ($subcategories2) {
									foreach ($subcategories2 as $subcategory2) {
										if ($subcategory2->getString("title".$langIndex) && $subcategory2->getString("enabled") == "y") {
											$valueArray[] = $subcategory2->getNumber("id");
											$nameArray[]  = "-- ".$subcategory2->getString("title".$langIndex);
											$where = "category_id = ".$subcategory2->getNumber("id")." AND lang LIKE '%".EDIR_LANGUAGE."%' AND enabled = 'y'";
											$subcategories3 = db_getFromDB($tableCategory, "", "", MAX_SHOW_ALL_CATEGORIES, "title".$langIndex, "object", SELECTED_DOMAIN_ID, false, "*", $where);
											if ($subcategories3) {
												foreach ($subcategories3 as $subcategory3) {
													if ($subcategory3->getString("title".$langIndex) && $subcategory3->getString("enabled") == "y") {
														$valueArray[] = $subcategory3->getNumber("id");
														$nameArray[]  = "--- ".$subcategory3->getString("title".$langIndex);
														$where = "category_id = ".$subcategory3->getNumber("id")." AND lang LIKE '%".EDIR_LANGUAGE."%' AND enabled = 'y'";
														$subcategories4 = db_getFromDB($tableCategory, "", "", MAX_SHOW_ALL_CATEGORIES, "title".$langIndex, "object", SELECTED_DOMAIN_ID, false, "*", $where);
														if ($subcategories4) {
															foreach ($subcategories4 as $subcategory4) {
																if ($subcategory4->getString("title".$langIndex) && $subcategory4->getString("enabled") == "y") {
																	$valueArray[] = $subcategory4->getNumber("id");
																	$nameArray[]  = "---- ".$subcategory4->getString("title".$langIndex);
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		if ($categoryScalability != "on") {
			$valueArray[]  = "";
			$nameArray[]   = "--------------------------------------------------";
		}
		$categoryDropDown = html_selectBox("category_id", $nameArray, $valueArray, $category_id, "id=\"category_id\"", "class='input-dd-form-banner' style='width:350px;'", system_showText(LANG_NONCATEGORYSEARCH));
	}

?>
