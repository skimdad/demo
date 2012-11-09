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
	# * FILE: /includes/code/uploadimage.php
	# ----------------------------------------------------------------------------------------------------

	extract($_POST);
	extract($_GET);

	session_start(); //Do not remove this

	if (!isset($_SESSION['random_key'])){
		$_SESSION['random_key'] = uniqid(($_COOKIE["PHPSESSID"]).strtotime(date('Y-m-d H:i:s')));
	}

	$upload_dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";				// The directory for the images to be saved in
	$upload_path = $upload_dir."/";																	// The path to where the image will be saved
	$large_image_prefix = "resize_";																// The prefix name to large image
	$large_image_name = $large_image_prefix.$_SESSION['random_key'];								// New name of the large image (append the timestamp to the filename)
	$large_image_location = $upload_path.$large_image_name;											// Path to the image folder

	if ($item_type == "listing"){
		$thumbWidthItem = IMAGE_LISTING_THUMB_WIDTH;
		$thumbHeightItem = IMAGE_LISTING_THUMB_HEIGHT;
	}elseif($item_type == "classified"){
		$thumbWidthItem = IMAGE_CLASSIFIED_THUMB_WIDTH;
		$thumbHeightItem = IMAGE_CLASSIFIED_THUMB_HEIGHT;	
	}elseif($item_type == "article"){
		$thumbWidthItem = IMAGE_ARTICLE_THUMB_WIDTH;
		$thumbHeightItem = IMAGE_ARTICLE_THUMB_HEIGHT;	
	}elseif($item_type == "event"){
		$thumbWidthItem = IMAGE_EVENT_THUMB_WIDTH;
		$thumbHeightItem = IMAGE_EVENT_THUMB_HEIGHT;
	}elseif($item_type == "post"){
		$thumbWidthItem = IMAGE_BLOG_THUMB_WIDTH;
		$thumbHeightItem = IMAGE_BLOG_THUMB_HEIGHT;
	}

    if ($item_type != "article" && $item_type != "post"){
        //Get fields according to level
        unset($array_fields);
        $array_fields = system_getFormFields(ucfirst($item_type), $level);

        //Gallery and main image
        $item_typeLevel = $item_type."Level";
        $levelObj = new $item_typeLevel();
        $levelMaxImages = $levelObj->getImages($level);
        $onlyMainImage = false;
        if (is_array($array_fields) && in_array("main_image", $array_fields) && $levelMaxImages == 0){ //level with only one main image, no gallery
           $onlyMainImage = true;
        }
    } else {
       $onlyMainImage = false; 
    }

	$imageWidthItem = IMAGE_SLIDER_WIDTH;
	$imageHeightItem = IMAGE_SLIDER_HEIGHT;

	if ($_POST["uploadThumb"] == "yes") { //upload image
		// Only one of these image types should be allowed for upload
		$allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/gif'=>"gif",'image/x-png'=>"png",'image/png'=>"png");
		$allowed_image_ext = array_unique($allowed_image_types); // do not change this
		$image_ext = "";

		foreach ($allowed_image_ext as $mime_type => $ext) {
			$image_ext .= string_strtoupper($ext)." / ";
		}
		$image_ext = string_substr($image_ext,0,string_strlen($image_ext)-2);

		unset($_SESSION['random_key']);
		$_SESSION['random_key'] = uniqid(($_COOKIE["PHPSESSID"]).strtotime(date('Y-m-d H:i:s')));
		
		//Image Locations
		$large_image_name = $large_image_prefix.$_SESSION['random_key'];
		$large_image_location = $upload_path.$large_image_name;
		$dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
		$files = glob("$dir/resize_".$_SESSION['random_key'].".*");
		
		//removing image files
		if ($files)
			foreach ($files as $file) unlink($file);

		//Get the file information
		$userfile_tmp = $_FILES['image']['tmp_name'];
		$userfile_size = $_FILES['image']['size'];
		$userfile_type = $_FILES['image']['type'];
		$filename = basename($_FILES['image']['name']);
		$file_ext = string_strtolower(string_substr($filename, string_strrpos($filename, '.') + 1));
		
		$maxImageSize = "0000000";
		$maxImageSize = string_substr($maxImageSize, string_strlen((UPLOAD_MAX_SIZE * 10) + 1));
		$maxImageSize = ((UPLOAD_MAX_SIZE * 10) + 1)."00000";

		list($imagewidth, $imageheight, $imageType) = getimagesize($userfile_tmp);
		$auxfile_ext = image_type_to_mime_type($imageType);
		$auxextArray = explode("/",$auxfile_ext);

		$file_ext = $auxextArray[1];
		if ($file_ext == "jpeg") $file_ext = "jpg";
		
		//Only process if the file is a JPG, GIF or PNG and below the allowed limit
		if((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {

			foreach ($allowed_image_types as $mime_type => $ext) {
				//loop through the specified image types and if they match the extension then break out
				//everything is ok so go and check file size
				if($file_ext == $ext && $userfile_type == $mime_type){
					$error = "";
					break;
				}else{
					$error = "<p class=\"errorMessage\">".LANG_ONLY." <strong>".$image_ext."</strong>".LANG_IMAGES_ACCEPETED."</p>";
				}
			}
			//check if the file size is above the allowed limit
			if ($userfile_size > $maxImageSize) {
				$error .= "<p class=\"errorMessage\">".LANG_IMAGE_MUST_BE.UPLOAD_MAX_SIZE."MB</p>";
			}

		}else{
			$error = "<p class=\"errorMessage\">".LANG_SELECT_IMAGE."</p>";
		}
		//Everything is ok, so we can upload the image.
		if (string_strlen($error) == 0){

			if (isset($_FILES['image']['name'])){
				//this file could now has an unknown file extension (we hope it's one of the ones set above!)
				$large_image_location = $large_image_location.".".$file_ext;

				//put the file ext in the session so we know what file to look for once its uploaded
				$_SESSION['user_file_ext'] = ".".$file_ext;
				move_uploaded_file($userfile_tmp, $large_image_location);
				chmod($large_image_location, 0777);
				$width = image_getWidth($large_image_location);
				$height = image_getHeight($large_image_location);
				
				echo '<script>alert("hager aly")</script>';
			}
			//Refresh the page to show the new uploaded image
            
            if (EDIRECTORY_FOLDER){
                $urlRedirect = EDIRECTORY_FOLDER.(EDIR_LANG_URL ? "/".EDIR_LANGUAGEABBREVIATION : "").str_replace(EDIRECTORY_FOLDER, "", $_SERVER["PHP_SELF"]);
            } else {
                $urlRedirect = (EDIR_LANG_URL ? "/".EDIR_LANGUAGEABBREVIATION : "").$_SERVER["PHP_SELF"];
            }
            
			header("Location: ".$urlRedirect."?domain_id=".$_POST["domain_id"]."&gallery_hash=".$_POST["gallery_hash"]."&captions=n&temp=".$_POST["temp"]."&newwidth=$width&newheight=$height&upload=y&gallery_item_id=".$_POST["gallery_item_id"]."&gallery_id=".$_POST["gallery_id"]."&image_id=".$_POST["image_id"]."&thumb_id=".$_POST["thumb_id"]."&item_id=".$_POST["item_id"]."&item_type=".$_POST["item_type"]."&level=".$_POST["level"]."&main=".$_POST["main"]."&pop_type=uploadimage");
			exit();
		}
	}elseif ($_SERVER["REQUEST_METHOD"] == "POST") { //crop and submit form

		$dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
		$files = glob("$dir/resize_".$_SESSION['random_key'].".*");

		if ($files[0]){
			$info = getimagesize($files[0]);
			$type = $info['mime'];

			switch ($type) {
				case 'image/gif':	$img_type = 'gif';
									$img_r = imagecreatefromgif($files[0]);
									break;

				case 'image/jpeg':	$img_type = 'jpeg';
									$img_r = imagecreatefromjpeg($files[0]);
									break;

				case 'image/x-png':	$img_type = 'png';
									$img_r = imagecreatefrompng($files[0]);
									break;

				case 'image/png':	$img_type = 'png';
									$img_r = imagecreatefrompng($files[0]);
									break;
			}

			$dst_r = imagecreatetruecolor( $_POST['w'], $_POST['h'] );

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
									$_POST['x1'],
									$_POST['y1'],
									$_POST['w'],
									$_POST['h'],
									$_POST['w'],
									$_POST['h']
								  );
				} else {
					//better quality
					imagecopyresampled( $dst_r,
									$img_r,
									0,
									0,
									$_POST['x1'],
									$_POST['y1'],
									$_POST['w'],
									$_POST['h'],
									$_POST['w'],
									$_POST['h']
								  );
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

			if (string_strpos($_SERVER["PHP_SELF"],"sitemgr")){
				$auxPrefix = "sitemgr_";
			}else {
				$auxPrefix = $_SESSION[SESS_ACCOUNT_ID]."_";
			}

			//removing image files
			foreach($files as $file) unlink($file);
			if ((file_exists($_FILES['image']['tmp_name']) || file_exists($crop_image)) && (!$crop_submit)) {
				$imageArray = image_uploadForItem((($crop_image) ? $crop_image : $_FILES['image']['tmp_name']), $auxPrefix, $imageWidthItem, $imageHeightItem, $thumbWidthItem, $thumbHeightItem);
				if ($imageArray["success"]) {
					$upload_image = "success";
					$remove_image = false;
				}else $upload_image = "failed";
			}
		}

		if($upload_image == "failed"){ // error or no image uploaded
			$return_upload_message .= "<p class=\"errorMessage\">".LANG_MSGERROR_ERRORUPLOADINGIMAGE.($error ? '<br />'.$error : '')."</p>";
		} else { // image uploaded or captions changed
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$sess_id = $_POST["gallery_hash"];

			if ($imageArray["image_id"]){ // image uploaded

				$sqlCount = "SELECT COUNT(image_id) AS total FROM Gallery_Temp WHERE sess_id = ".db_formatString($sess_id);
				$resultCount = $dbObj->query($sqlCount);
				$row = mysql_fetch_assoc($resultCount);
				
				if ($_POST["item_id"]){
					
					$str_item_type = ucfirst($_POST["item_type"]);
					
					if ($str_item_type == "Listing" || $str_item_type == "Event" || $str_item_type == "Classified" || $str_item_type == "Article"){
						$itemObj = new $str_item_type($_POST["item_id"]);
						$gal_id = $itemObj->getGalleries();

						if ($itemObj->getNumber("image_id")){
							$total_images = 1;
						} else {
							$gal = new Gallery($gal_id[0]);
							$total_images = count($gal->image);
						}
					} else {
						$total_images = $row["total"];
					}

				} else {
					$total_images = $row["total"];
				}
				
				$sql = "INSERT INTO Gallery_Temp (
						image_id,
						image_caption1,
						image_caption2,
						image_caption3,
						image_caption4,
						image_caption5, 
						image_caption6, 
						image_caption7, 
						thumb_id,
						thumb_caption1,
						thumb_caption2,
						thumb_caption3,
						thumb_caption4,
						thumb_caption5,
						thumb_caption6,
						thumb_caption7,
						image_default,
						sess_id
					)";
				if (($onlyMainImage) || ($total_images <= 0 && $row["total"] <= 0))
					$_POST["setasdefault"] = "y";

				$sql .= "VALUES (
							".$imageArray["image_id"].",
							'".addslashes($_POST["image_caption1"])."',
							'".addslashes($_POST["image_caption2"])."',
							'".addslashes($_POST["image_caption3"])."',
							'".addslashes($_POST["image_caption4"])."',
							'".addslashes($_POST["image_caption5"])."',
							'".addslashes($_POST["image_caption6"])."',
							'".addslashes($_POST["image_caption7"])."',
							".addslashes($imageArray["thumb_id"]).",
							'".addslashes($_POST["thumb_caption1"])."',
							'".addslashes($_POST["thumb_caption2"])."',
							'".addslashes($_POST["thumb_caption3"])."',
							'".addslashes($_POST["thumb_caption4"])."',
							'".addslashes($_POST["thumb_caption5"])."',
							'".addslashes($_POST["thumb_caption6"])."',
							'".addslashes($_POST["thumb_caption7"])."',
							'".(($_POST["setasdefault"]) ? "y":"n")."',
							'".$sess_id."'
						)";
				$dbObj->query($sql);
				
				$uploadImageUpdate = "n";
				
			} else { //captions changed

				if ($_POST["temp"]){
					$postImageCaption1 = addslashes($_POST["image_caption1"]);
					$postImageCaption2 = addslashes($_POST["image_caption2"]);
					$postImageCaption3 = addslashes($_POST["image_caption3"]);
					$postImageCaption4 = addslashes($_POST["image_caption4"]);
					$postImageCaption5 = addslashes($_POST["image_caption5"]);
					$postImageCaption6 = addslashes($_POST["image_caption6"]);
					$postImageCaption7 = addslashes($_POST["image_caption7"]);
					$postThumbCaption1 = addslashes($_POST["thumb_caption1"]);
					$postThumbCaption2 = addslashes($_POST["thumb_caption2"]);
					$postThumbCaption3 = addslashes($_POST["thumb_caption3"]);
					$postThumbCaption4 = addslashes($_POST["thumb_caption4"]);
					$postThumbCaption5 = addslashes($_POST["thumb_caption5"]);
					$postThumbCaption6 = addslashes($_POST["thumb_caption6"]);
					$postThumbCaption7 = addslashes($_POST["thumb_caption7"]);

					$sql = "UPDATE Gallery_Temp SET
						image_caption1 = \"$postImageCaption1\",
						image_caption2 = \"$postImageCaption2\",
						image_caption3 = \"$postImageCaption3\",
						image_caption4 = \"$postImageCaption4\",
						image_caption5 = \"$postImageCaption5\",
						image_caption6 = \"$postImageCaption6\",
						image_caption7 = \"$postImageCaption7\",
						thumb_caption1 = \"$postThumbCaption1\",
						thumb_caption2 = \"$postThumbCaption2\",
						thumb_caption3 = \"$postThumbCaption3\",
						thumb_caption4 = \"$postThumbCaption4\",
						thumb_caption5 = \"$postThumbCaption5\",
						thumb_caption6 = \"$postThumbCaption6\",
						thumb_caption7 = \"$postThumbCaption7\"
					WHERE image_id=".$_POST["image_id"];
					$dbObj->query($sql);
					
				} else {
					if ($_POST["gallery_id"]){
						$postImageCaption1 = addslashes($_POST["image_caption1"]);
						$postImageCaption2 = addslashes($_POST["image_caption2"]);
						$postImageCaption3 = addslashes($_POST["image_caption3"]);
						$postImageCaption4 = addslashes($_POST["image_caption4"]);
						$postImageCaption5 = addslashes($_POST["image_caption5"]);
						$postImageCaption6 = addslashes($_POST["image_caption6"]);
						$postImageCaption7 = addslashes($_POST["image_caption7"]);
						$postThumbCaption1 = addslashes($_POST["thumb_caption1"]);
						$postThumbCaption2 = addslashes($_POST["thumb_caption2"]);
						$postThumbCaption3 = addslashes($_POST["thumb_caption3"]);
						$postThumbCaption4 = addslashes($_POST["thumb_caption4"]);
						$postThumbCaption5 = addslashes($_POST["thumb_caption5"]);
						$postThumbCaption6 = addslashes($_POST["thumb_caption6"]);
						$postThumbCaption7 = addslashes($_POST["thumb_caption7"]);

						$sql = "UPDATE Gallery_Image SET
							image_caption1 = \"$postImageCaption1\",
							image_caption2 = \"$postImageCaption2\",
							image_caption3 = \"$postImageCaption3\",
							image_caption4 = \"$postImageCaption4\",
							image_caption5 = \"$postImageCaption5\",
							image_caption6 = \"$postImageCaption6\",
							image_caption7 = \"$postImageCaption7\",
							thumb_caption1 = \"$postThumbCaption1\",
							thumb_caption2 = \"$postThumbCaption2\",
							thumb_caption3 = \"$postThumbCaption3\",
							thumb_caption4 = \"$postThumbCaption4\",
							thumb_caption5 = \"$postThumbCaption5\",
							thumb_caption6 = \"$postThumbCaption6\",
							thumb_caption7 = \"$postThumbCaption7\"
						WHERE image_id=".$_POST["image_id"];
						$dbObj->query($sql);
						
					} else {
						
						$postImageCaption1 = addslashes($_POST["image_caption1"]);
						$postImageCaption2 = addslashes($_POST["image_caption2"]);
						$postImageCaption3 = addslashes($_POST["image_caption3"]);
						$postImageCaption4 = addslashes($_POST["image_caption4"]);
						$postImageCaption5 = addslashes($_POST["image_caption5"]);
						$postImageCaption6 = addslashes($_POST["image_caption6"]);
						$postImageCaption7 = addslashes($_POST["image_caption7"]);
						$postThumbCaption1 = addslashes($_POST["thumb_caption1"]);
						$postThumbCaption2 = addslashes($_POST["thumb_caption2"]);
						$postThumbCaption3 = addslashes($_POST["thumb_caption3"]);
						$postThumbCaption4 = addslashes($_POST["thumb_caption4"]);
						$postThumbCaption5 = addslashes($_POST["thumb_caption5"]);
						$postThumbCaption6 = addslashes($_POST["thumb_caption6"]);
						$postThumbCaption7 = addslashes($_POST["thumb_caption7"]);

						if ($item_type == "post"){
							
							$sql = "UPDATE Post SET image_caption1 = \"$postImageCaption1\", 
													image_caption2 = \"$postImageCaption2\",
													image_caption3 =\"$postImageCaption3\",
													image_caption4 =\"$postImageCaption4\",
													image_caption5 =\"$postImageCaption5\",
													image_caption6 =\"$postImageCaption6\",
													image_caption7 =\"$postImageCaption7\",
													thumb_caption1 = \"$postThumbCaption1\",
													thumb_caption2 = \"$postThumbCaption2\",
													thumb_caption3 = \"$postThumbCaption3\",
													thumb_caption4 = \"$postThumbCaption4\",
													thumb_caption5 = \"$postThumbCaption5\",
													thumb_caption6 = \"$postThumbCaption6\",
													thumb_caption7 = \"$postThumbCaption7\"
									WHERE image_id=".$_POST["image_id"];							
							
						} else {
						
							$sql = "UPDATE Gallery_Image SET
								image_caption1 = \"$postImageCaption1\",
								image_caption2 = \"$postImageCaption2\",
								image_caption3 = \"$postImageCaption3\",
								image_caption4 = \"$postImageCaption4\",
								image_caption5 = \"$postImageCaption5\",
								image_caption6 = \"$postImageCaption6\",
								image_caption7 = \"$postImageCaption7\",
								thumb_caption1 = \"$postThumbCaption1\",
								thumb_caption2 = \"$postThumbCaption2\",
								thumb_caption3 = \"$postThumbCaption3\",
								thumb_caption4 = \"$postThumbCaption4\",
								thumb_caption5 = \"$postThumbCaption5\",
								thumb_caption6 = \"$postThumbCaption6\",
								thumb_caption7 = \"$postThumbCaption7\"
							WHERE image_id=".$_POST["image_id"];
						
						}
						
						$dbObj->query($sql);
							
					}
				}
				$uploadImageUpdate = "y";
			}
			
			$return_upload_message .= "<p class=\"successMessage\">".($imageArray["image_id"] > 0 ? system_showText(LANG_IMAGE_SUCCESSFULLY_UPLOADED) : system_showText(LANG_IMAGE_SUCCESSFULLY_UPDATED))."</p>";

			
		}
		
		unset($_SESSION['random_key']);
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	if ($gallery_id) {

		$gallery = new Gallery($gallery_id);

		for($i=0;$i<count($gallery->image);$i++) {
			if ($gallery->image[$i]["image_id"] == $image_id) {
				$gallery_item_id=$gallery->image[$i]["id"];
				$newI = $i;
				$i = count($gallery->image);
			}
		}

		$thumb_id = $gallery->image[$newI]["thumb_id"];
		$image_caption1 = $gallery->image[$newI]["image_caption1"];
		$image_caption2 = $gallery->image[$newI]["image_caption2"];
		$image_caption3 = $gallery->image[$newI]["image_caption3"];
		$image_caption4 = $gallery->image[$newI]["image_caption4"];
		$image_caption5 = $gallery->image[$newI]["image_caption5"];
		$image_caption6 = $gallery->image[$newI]["image_caption6"];
		$image_caption7 = $gallery->image[$newI]["image_caption7"];
		$thumb_caption1 = $gallery->image[$newI]["thumb_caption1"];
		$thumb_caption2 = $gallery->image[$newI]["thumb_caption2"];
		$thumb_caption3 = $gallery->image[$newI]["thumb_caption3"];
		$thumb_caption4 = $gallery->image[$newI]["thumb_caption4"];
		$thumb_caption5 = $gallery->image[$newI]["thumb_caption5"];
		$thumb_caption6 = $gallery->image[$newI]["thumb_caption6"];
		$thumb_caption7 = $gallery->image[$newI]["thumb_caption7"];
	}else {
		if ($image_id){
			if ($item_type == "post"){
				$post = new Post($item_id);
				$image_caption1 = $post->getString("image_caption1", false);
				$image_caption2 = $post->getString("image_caption2", false);
				$image_caption3 = $post->getString("image_caption3", false);
				$image_caption4 = $post->getString("image_caption4", false);
				$image_caption5 = $post->getString("image_caption5", false);
				$image_caption6 = $post->getString("image_caption6", false);
				$image_caption7 = $post->getString("image_caption7", false);
				$thumb_caption1 = $post->getString("thumb_caption1", false);
				$thumb_caption2 = $post->getString("thumb_caption2", false);
				$thumb_caption3 = $post->getString("thumb_caption3", false);
				$thumb_caption4 = $post->getString("thumb_caption4", false);
				$thumb_caption5 = $post->getString("thumb_caption5", false);
				$thumb_caption6 = $post->getString("thumb_caption6", false);
				$thumb_caption7 = $post->getString("thumb_caption7", false);
			} else {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				$sql = "SELECT * FROM Gallery_Image WHERE image_id='$image_id'";
				$r = $dbObj->query($sql);
				while ($row_aux = mysql_fetch_array($r)) {
					$image_caption1 = $row_aux["image_caption1"];
					$image_caption2 = $row_aux["image_caption2"];
					$image_caption3 = $row_aux["image_caption3"];
					$image_caption4 = $row_aux["image_caption4"];
					$image_caption5 = $row_aux["image_caption5"];
					$image_caption6 = $row_aux["image_caption6"];
					$image_caption7 = $row_aux["image_caption7"];
					$thumb_caption1 = $row_aux["thumb_caption1"];
					$thumb_caption2 = $row_aux["thumb_caption2"];
					$thumb_caption3 = $row_aux["thumb_caption3"];
					$thumb_caption4 = $row_aux["thumb_caption4"];
					$thumb_caption5 = $row_aux["thumb_caption5"];
					$thumb_caption6 = $row_aux["thumb_caption6"];
					$thumb_caption7 = $row_aux["thumb_caption7"];
				}
				$sql = "SELECT COUNT(0) AS row_amount FROM Gallery_Image WHERE image_id='$image_id'";
				$row = mysql_fetch_array($dbObj->query($sql));
				if ($row["row_amount"] == 0) {
					$sql = "SELECT gallery_id FROM Gallery_Item WHERE item_id='$item_id' AND item_type='$item_type'";
					$row = mysql_fetch_array($dbObj->query($sql));
					$row["gallery_id"];
					if ($row["gallery_id"]) {
						if ($thumb_id){
							$sql = "INSERT INTO Gallery_Image (
										gallery_id,
										image_id,
										image_caption1,
										image_caption2,
										image_caption3,
										image_caption4,
										image_caption5,
										image_caption6,
										image_caption7,
										thumb_id,
										thumb_caption1,
										thumb_caption2,
										thumb_caption3,
										thumb_caption4,
										thumb_caption5,
										thumb_caption6,
										thumb_caption7,
										image_default
									) VALUES (
										".$row["gallery_id"].",
										$image_id,
										'',
										'',
										'',
										'',
										'',
										'',
										'',
										$thumb_id,
										'',
										'',
										'',
										'',
										'',
										'',
										'',
										'y'
									)";
							$dbObj->query($sql);
						}
					}
				}
			}
		}
	}
	if ($temp == "y") {
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$sql = "SELECT * FROM Gallery_Temp WHERE image_id='$image_id'";
		$r = $dbObj->query($sql);
		$row = mysql_fetch_array($r);

		$thumb_id = $row["thumb_id"];
		$image_caption1 = $row["image_caption1"];
		$image_caption2 = $row["image_caption2"];
		$image_caption3 = $row["image_caption3"];
		$image_caption4 = $row["image_caption4"];
		$image_caption5 = $row["image_caption5"];
		$image_caption6 = $row["image_caption6"];
		$image_caption7 = $row["image_caption7"];
		$thumb_caption1 = $row["thumb_caption1"];
		$thumb_caption2 = $row["thumb_caption2"];
		$thumb_caption3 = $row["thumb_caption3"];
		$thumb_caption4 = $row["thumb_caption4"];
		$thumb_caption5 = $row["thumb_caption5"];
		$thumb_caption6 = $row["thumb_caption6"];
		$thumb_caption7 = $row["thumb_caption7"];
	}
?>