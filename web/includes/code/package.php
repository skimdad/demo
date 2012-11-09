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
	# * FILE: /includes/code/package.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$_POST["title"] = trim($_POST["title"]);
		$_POST["title"] = preg_replace('/\s\s+/', ' ', $_POST["title"]);

		if (validate_form("package", $_POST, $message_package) && ($upload_image != "failed")) {

			$upload_image = "no image";

			if($_POST["id"]){
				unset($packageObj);
				$packageObj = new Package($_POST["id"]);
				$packageItemObj = new PackageItems("",$_POST["id"]);
				$image_id = $packageObj->getNumber("image_id");
				$thumb_id = $packageObj->getNumber("thumb_id");
				$status = $packageObj->getString("status");

				$message = 1;
			} else {
				unset($packageObj);
				$packageObj = new Package();
				$packageItemObj = new PackageItems();
				$image_id = 0;
				$thumb_id = 0;
				$status = "";
				$message = 0;
			}

			//Clean Image
			if ($remove_image) {
				if ($idm = $packageObj->getNumber("image_id")) {
					$image = new Image($idm);
					if ($image) $image->Delete();
				}
				if ($idm = $packageObj->getNumber("thumb_id")) {
					$image = new Image($idm);
					if ($image) $image->Delete();
				}
			}

			// Image Crop
            if ($_POST["image_type"] != "") {

                // TYPES
                //1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order),
                //9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
                $user_id = $_COOKIE["PHPSESSID"];
                $dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
                $files = glob("$dir/_0_".$user_id."_*.*");
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

				if (string_strpos($_SERVER["PHP_SELF"],"sitemgr")){
					$auxPrefix = "sitemgr_";
				}else {
					$auxPrefix = $_SESSION[SESS_ACCOUNT_ID]."_";
				}

				if ($_POST["account_id"]){
					$auxPrefix = $_POST["account_id"]."_";
				}
                //removing image files
                foreach($files as $file) unlink($file);
                if ((file_exists($_FILES['image']['tmp_name']) || file_exists($crop_image)) && (!$crop_submit)) {
                    $imageArray = image_uploadForItem((($crop_image) ? $crop_image : $_FILES['image']['tmp_name']), $auxPrefix, IMAGE_PACKAGE_FULL_WIDTH, IMAGE_PACKAGE_FULL_HEIGHT, IMAGE_PACKAGE_THUMB_WIDTH, IMAGE_PACKAGE_THUMB_HEIGHT);
                    if ($imageArray["success"]) {
                        $upload_image = "success";
                        $remove_image = false;
                    }else $upload_image = "failed";
                }
            }

			  if ($upload_image != "failed" && !$crop_submit) {

				/*
				 * Saving package
				 */
				$packageObj->setString("title",$_POST["title"]);
				$packageObj->setNumber("parent_domain",$_POST["offer_domain_id"]);

				/*
				 * Prepare vars to save
				 */
				unset($aux_ordered_item);

				//$statusObj = new ItemStatus();
				if($_POST["ordered_item"]){
					$aux_ordered_item = explode("_",$_POST["ordered_item"]);

					if(is_array($aux_ordered_item)){
						$packageObj->setString("module",$aux_ordered_item[0]);
						$packageObj->setNumber("level",$aux_ordered_item[1]);
					}

				}

				$packageObj->setString("status", $status ? $status : "S");
				$packageObj->setString("show_info", $_POST["show_info"]);
				$packageObj->setString("content1", $_POST["content1"]);
				$packageObj->setString("content2", $_POST["content2"]);
				$packageObj->setString("content3", $_POST["content3"]);
				$packageObj->setString("content4", $_POST["content4"]);
				$packageObj->setString("content5", $_POST["content5"]);
				$packageObj->setString("content6", $_POST["content6"]);
				$packageObj->setString("content7", $_POST["content7"]);

				if ($upload_image == "success") {
					$packageObj->updateImage($imageArray);
				}

				if ($remove_image) {
					$packageObj->setNumber("image_id", 0);
					$packageObj->setNumber("thumb_id", 0);
				}

				$packageObj->Save();

				/*
				 * When sitemgr edit items of package the old items are deleted and generate a log on PackateItemsLOG
				 * table on Main DB
				 */
				if (sess_getSMIdFromSession()){
					$smAccountObj = new SMAccount(sess_getSMIdFromSession());
					$aux_SMAccount = $smAccountObj->getString("name")." (".$smAccountObj->getString("username").")";
				} else {
					setting_get("sitemgr_username",$sitemgr_email);
					$aux_SMAccount = "Sitemgr"." (".$sitemgr_email.")";
				}

				/*
				 * Save items of package
				 */
				if($_POST["offer_item"] && $_POST["offer_item"] != "custom_package"){
					$aux_offer_item = explode("_",$_POST["offer_item"]);	

					for($i=0;$i<count($_POST["packageItem_domain_id"]);$i++){
						$aux_posted_items[$i]["domain_id"] = $_POST["packageItem_domain_id"][$i];
						$aux_posted_items[$i]["module"]	   = $aux_offer_item[0];
						$aux_posted_items[$i]["level"]	   = $aux_offer_item[1];
						$aux_posted_items[$i]["price"]	   = $_POST["value_domain_".$_POST["packageItem_domain_id"][$i]];
					}

					if(!domain_saveLogForPackageItems($packageObj->getNumber("id"),$aux_posted_items,$aux_SMAccount)){
						$message = 3;
					}
					/****************************************************************************************************/

					for($i=0;$i<count($_POST["packageItem_domain_id"]);$i++){
						unset($packageItemObj);
						unset($array_PackItems);

						$array_PackItems["package_id"] = $packageObj->getNumber("id");
						$array_PackItems["domain_id"] = $_POST["packageItem_domain_id"][$i];
						$array_PackItems["module"] = $aux_offer_item[0];
						$array_PackItems["level"] = $aux_offer_item[1];
						$array_PackItems["price"] = $_POST["value_domain_".$_POST["packageItem_domain_id"][$i]];
						
						$packageItemObj = new PackageItems($array_PackItems);

						$packageItemObj->Save();
					}

				} else if ($_POST["offer_item"] == "custom_package"){

					unset($packageItemObj);
					unset($array_PackItems);
					
					$aux_posted_items[0]["domain_id"] = 0;
					$aux_posted_items[0]["module"] = "custom_package";
					$aux_posted_items[0]["level"] = 0;
					$aux_posted_items[0]["price"] = $_POST["price"];

					if(!domain_saveLogForPackageItems($packageObj->getNumber("id"),$aux_posted_items,$aux_SMAccount)){
						$message = 3;
					}

					$array_PackItems["package_id"] = $packageObj->getNumber("id");
					$array_PackItems["domain_id"] = 0;
					$array_PackItems["module"] = "custom_package";
					$array_PackItems["level"] = 0;
					$array_PackItems["price"] = $_POST["price"];

					$packageItemObj = new PackageItems($array_PackItems);

					$packageItemObj->Save();

				}

				

				/*
				 * Return to manage page
				 */
				header("Location: ".(($search_page) ? "search.php" : "index.php")."?process=".$process."&newest=".$newest."&message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));
				exit;
			} else if ($upload_image == "failed") $message_package .= system_showText(LANG_MSG_INVALID_IMAGE_TYPE);
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];

	if ($id) {

		/*
		 * Create object to edit
		 */
		unset($packageObj,$title,$parent_domain,$ordered_item);
		$packageObj = new Package($id);

		$title = $packageObj->getString("title");
		$parent_domain = $packageObj->getNumber("parent_domain");
		$ordered_item = $packageObj->getString("module")."_".$packageObj->getNumber("level");
		$show_info = $packageObj->getString("show_info");

		$content1 = $packageObj->getNumber("content1");
		$content2 = $packageObj->getNumber("content2");
		$content3 = $packageObj->getNumber("content3");
		$content4 = $packageObj->getNumber("content4");
		$content5 = $packageObj->getNumber("content5");
		$content6 = $packageObj->getNumber("content6");
		$content7 = $packageObj->getNumber("content7");
		$image_id = $packageObj->getNumber("image_id");
		$thumb_id = $packageObj->getNumber("thumb_id");

		/*
		 * Get items of package
		 */
		unset($packageItemObj);
		$packageItemObj = new PackageItems();

		$array_package_items = $packageItemObj->getItemsByPackageId($id);

		if(is_array($array_package_items)){
			if ($array_package_items[0]["level"])
				$offer_item = $array_package_items[0]["module"]."_".$array_package_items[0]["level"];
			else
				$offer_item = $array_package_items[0]["module"];
			$price = $array_package_items[0]["price"];
	
			unset($aux_package_items_domains,$aux_package_items_values);
			for($i=0;$i<count($array_package_items);$i++){
				$aux_package_items_domains[] = $array_package_items[$i]["domain_id"];
				$aux_package_items_values[$array_package_items[$i]["domain_id"]] = $array_package_items[$i]["price"];

			}
		}
		
	} else {
		$aux_package_items_domains = $_POST["packageItem_domain_id"];

	}


	/*
	 * Get items and levels of domain
	 */
	unset($array_option_id_actual);
	$array_dropdown_module_level_actual = domain_DropDownModuleDomain();

	/*
	 * Use this array to get common items in domains
	 */
	for($i=0;$i<count($array_dropdown_module_level_actual);$i++){
		$array_option_id_actual[] = $array_dropdown_module_level_actual[$i]["option_id"];
	}

	/*
	 * Get common items and levels of all domains
	 */
	$aux_domainObj = new Domain();
	$array_fields[] = "id";
	$array_fields[] = "name";
	$array_domains = $aux_domainObj->getAllDomains($array_fields, 'A');
	
	/*
	 * Get all items of domain
	 */
	$array_commom_domain = domain_CommonModuleLevel($array_domains,$array_option_id_actual,true);
	
?>