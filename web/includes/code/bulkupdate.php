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
	# * FILE: /includes/code/bulkupdate.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	/*
	 * Need to check if $bulkSubmit is equal to "Submit" or LANG_SITEMGR_SUBMIT to fix an IE7
	 */
	if ($_SERVER['REQUEST_METHOD'] == "POST" && ($hiddenValue == "Submit" || $bulkSubmit == "Submit" || $bulkSubmit == LANG_SITEMGR_SUBMIT)) {
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

		if (string_strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_FOLDER)) {
			$typeName = "Listing";
		} elseif (string_strpos($_SERVER["PHP_SELF"], CLASSIFIED_FEATURE_FOLDER)) {
			$typeName = "Classified";
		} elseif (string_strpos($_SERVER["PHP_SELF"], EVENT_FEATURE_FOLDER)) {
			$typeName = "Event";
		} elseif (string_strpos($_SERVER["PHP_SELF"], ARTICLE_FEATURE_FOLDER)) {
			$typeName = "Article";
		} elseif (string_strpos($_SERVER["PHP_SELF"], BANNER_FEATURE_FOLDER)) {
			$typeName = "Banner";
		}  elseif (string_strpos($_SERVER["PHP_SELF"], PROMOTION_FEATURE_FOLDER)) {
			$typeName = "Promotion";
		}
		$ids = $_POST[string_strtolower($typeName)."_id"];
		$error_message = "";
        
        $checkCategScalability = false;
        $itemCategScalability = false;
        if ($typeName == "Listing" || $typeName == "Event" || $typeName == "Classified" || $typeName == "Article"){
            $checkCategScalability = true;
            if (constant(strtoupper($typeName)."CATEGORY_SCALABILITY_OPTIMIZATION") == "on"){
               $itemCategScalability = true; 
            }
        }

		if ($ids) {
			if ($delete_all == "on") {

				if ($typeName == "Listing") {

					foreach ($ids as $id) {

						$sql = "SELECT gallery_id FROM Gallery_Item WHERE item_id=".$id;
						$row = mysql_fetch_array($dbObj->query($sql));
						$gallery_id = $row["gallery_id"];
						$gallery = new Gallery($gallery_id);
						$gallery->delete();
						$listing = new Listing($id);
						$listing->delete();

					}

				} elseif ($typeName == "Classified" || $typeName == "Event" || $typeName == "Article" || $typeName == "Banner" || $typeName == "Promotion") {

					foreach ($ids as $id) {

						$typeObj = new $typeName($id);
						$typeObj->delete();

					}
				}
				$success_delete = true;

			} else {

				if (!$change_section && !$change_section && !$add_category_id && $typeName == "Banner" && !$change_no_owner && !$change_account_id && !$status && !$level && !$change_renewaldate && !$add_category_id) {
					$error_message = 1;
				} else if (!$change_no_owner && !$change_account_id && !$status && !$level && !$change_renewaldate && !$add_category_id && !$return_categories && !$removecategory && $typeName != "Banner") {
					$error_message = 1;
				} else if ($change_section != "general" && $change_section != "global" && !$add_category_id && $change_section) {
					$error_message = 3;
				} else {

					if ($typeName != "Promotion" && $typeName != "Banner") {
						$flag = false;
						foreach ($ids as $id) {
							$typeObj = new $typeName($id);
							$new_categories = array();
							$categories_ids = $typeObj->getCategories(false,false,$id,true,false,true);
							if ($removecategory) {
								if ($categories_ids) {
									foreach ($categories_ids as $category_id) {

										if($typeName == "Listing"){
											if ($removecategory != $category_id["id"]) {
												array_push($new_categories, $category_id["id"]);
											}
										}else{
											if ($removecategory != $category_id->getNumber("id")) {
												array_push($new_categories, $category_id->getNumber("id"));
											}
										}
										
									}
								}

							} else {
								if ($categories_ids) {
									foreach ($categories_ids as $category_id) {
										if($typeName == "Listing"){
											array_push($new_categories, $category_id["id"]);
										}else{
											array_push($new_categories, $category_id->getNumber("id"));
										}
									}
								}
							}

                            if ($checkCategScalability && $itemCategScalability){
                                $return_categories_array = explode(",", $return_categories);
                                foreach($return_categories_array as $newCateg){
                                    array_push($new_categories, $newCateg);
                                }
                            } else {
                                if ($add_category_id) {
                                    array_push($new_categories, $add_category_id);
                                }
                            }
							
							$array_categories = array();
							for ($i = 0; $i < count($new_categories); $i++) {
								array_push($array_categories,$new_categories[$i]);
							}
							$array_categories = array_unique($array_categories);
							$number_categories = count($array_categories);
							if ($typeName == "Listing") {
								if ($number_categories == 0 && $removecategory) {
									$error_message1 .= $typeObj->title."<br />";
									$flag = true;
								}
								if ($number_categories > LISTING_MAX_CATEGORY_ALLOWED) {
									$error_message2 .= $typeObj->title."<br />";
									$flag = true;
								}
							} else {
								if ($number_categories > MAX_CATEGORY_ALLOWED) {
									$error_message2 .= $typeObj->title."<br />";
									$flag = true;
								}
							}

						}
					}

					if ($flag == false) {
						foreach ($ids as $id) {

							$typeObj = new $typeName($id);

							if ($change_no_owner == "on") {

								if ($typeObj->getNumber("account_id") != 0) {

									if ($typeName == "Listing"){
                                        if ($typeObj->getNumber("promotion_id") > 0){
                                            $typeObj->removePromotionID();
                                        }
                                    }

									if ($typeName != "Banner" && $typeName != "Promotion"){
										
										$image_idT = $typeObj->getNumber("image_id");
										$thumb_idT = $typeObj->getNumber("thumb_id");
										$galleryArray = $typeObj->getGalleries();
										system_renameGalleryImages($image_idT, $thumb_idT, 0, $galleryArray[0]);
										
									}else {
										$image_idB0 = $typeObj->getNumber("image_id");
										$image_idB1 = $typeObj->getNumber("image_id1");
										$image_idB2 = $typeObj->getNumber("image_id2");
										$image_idB3 = $typeObj->getNumber("image_id3");
										$image_idB4 = $typeObj->getNumber("image_id4");

										for ($i=0; $i<5; $i++){

											if (${"image_idB".$i}){

												$imageChange = new Image(${"image_idB".$i});

												$oldPrefix = $imageChange->getString("prefix");
												$newPrefix = "sitemgr_";

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

								$typeObj->setNumber("account_id", 0);

							} else if ($change_account_id) {

								if ($typeObj->getNumber("account_id") != $change_account_id) {
                                    
                                    if ($typeName == "Listing"){
                                        if ($typeObj->getNumber("promotion_id") > 0){
                                            $typeObj->removePromotionID();
                                        }
                                    }

									if ($typeName != "Banner" && $typeName != "Promotion"){
										
										$image_idT = $typeObj->getNumber("image_id");
										$thumb_idT = $typeObj->getNumber("thumb_id");
										$galleryArray = $typeObj->getGalleries();
										system_renameGalleryImages($image_idT, $thumb_idT, $change_account_id, $galleryArray[0]);
										
									}else {
										$image_idB0 = $typeObj->getNumber("image_id");
										$image_idB1 = $typeObj->getNumber("image_id1");
										$image_idB2 = $typeObj->getNumber("image_id2");
										$image_idB3 = $typeObj->getNumber("image_id3");
										$image_idB4 = $typeObj->getNumber("image_id4");

										for ($i=0; $i<5; $i++){

											if (${"image_idB".$i}){

												$imageChange = new Image(${"image_idB".$i});

												$oldPrefix = $imageChange->getString("prefix");
												$newPrefix = $change_account_id."_";

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

								$typeObj->setNumber("account_id", $change_account_id);
							}

							if ($typeName != "Promotion") {
								if ($status) {
									$typeObj->setString("status", $status);
								}
								if ($typeName != "Article" && $typeName != "Banner") {
									if ($level) {
										$typeObj->setNumber("level", $level);
									}
								} else if ($typeName == "Banner") {
									if ($level) {
										$typeObj->setNumber("type", $level);
									}
								}
								if ($typeName != "Banner") {
									//-- CATEGORIES
									unset($new_categories);
									$new_categories = array();
									$categories_ids = $typeObj->getCategories(false,false,$id,true,false,true);

									if ($removecategory) {
										if ($categories_ids) {
											foreach ($categories_ids as $category_id) {
												if($typeName == "Listing"){
													if ($removecategory != $category_id["id"]) {
														array_push($new_categories, $category_id["id"]);
													}
												}else{
													if ($removecategory != $category_id->getNumber("id")) {
														array_push($new_categories, $category_id->getNumber("id"));

													}
												}
												
											}
										}

									} else {
										if ($categories_ids) {
											foreach ($categories_ids as $category_id) {
												if($typeName == "Listing"){
													array_push($new_categories, $category_id["id"]);
												}else{
													array_push($new_categories, $category_id->getNumber("id"));
												}
											}
										}
									}

                                    if ($checkCategScalability && $itemCategScalability){
                                        $return_categories_array = explode(",", $return_categories);
                                        foreach($return_categories_array as $newCateg){
                                            array_push($new_categories, $newCateg);
                                        }
                                    } else {
                                        if ($add_category_id) {
                                            array_push($new_categories, $add_category_id);
                                        }
                                    }

									$array_categories = array();
									for ($i = 0; $i < count($new_categories); $i++) {
										array_push($array_categories,$new_categories[$i]);
									}
									$array_categories = array_unique($array_categories);
									$number_categories = count($array_categories);
									$typeObj->setCategories($array_categories);
	
								} elseif ($typeName == "Banner") {

									if ($change_section == "general" || $change_section == "global") {
										$add_category_id = 0;
									}
									if ($add_category_id) {
										$typeObj->setNumber("category_id", $add_category_id);
									}

									if ($change_section)
										$typeObj->setString("section", $change_section);
								}
							}

							if ($change_renewaldate) {
								$typeObj->setDate("renewal_date", $change_renewaldate);
							}

							if (!$error_message || !$error_message1 || !$error_message2) {
								$typeObj->Save();
							}

						}
					}

				}

			}


			if (string_strpos($_SERVER["PHP_SELF"], "search.php")) {


				if ($error_message1) {
					$error_msg = LANG_SITEMGR_NO_UPDATE."<br />&#149;&nbsp;".LANG_SITEMGR_LISTING_ERROR_MINIMUM_CATEGORIES."<br />".$error_message1;
				}
				if ($error_message2) {
					if ($error_message1) {
						$error_msg .= "<br />&#149;&nbsp;".LANG_SITEMGR_LISTING_ERROR_MINIMUM_CATEGORIES."<br />".$error_message2;
					} else {
						$error_msg = LANG_SITEMGR_NO_UPDATE."<br />&#149;&nbsp;".constant("LANG_SITEMGR_".string_strtoupper($typeName)."_ERROR_MAXIMUM_CATEGORIES")."<br />".$error_message2;
					}
				}

				if ($error_message || $error_msg) {

					unset($msg);
					unset($message);
					
				} else {
					if ($success_delete) {
						$msg="successdel";
					} else {
						$msg="success";
					}
				}
						
			} elseif (string_strpos($_SERVER["PHP_SELF"], "index.php")){

				if ($error_message1) {
					$error_msg = LANG_SITEMGR_NO_UPDATE."<br />&#149;&nbsp;".LANG_SITEMGR_LISTING_ERROR_MINIMUM_CATEGORIES."<br />".$error_message1;
				}
				if ($error_message2) {

					if ($error_message1) {
						$error_msg .= "<br />&#149;&nbsp;".LANG_SITEMGR_LISTING_ERROR_MINIMUM_CATEGORIES."<br />".$error_message2;
					} else {
						$error_msg = LANG_SITEMGR_NO_UPDATE."<br />&#149;&nbsp;".constant("LANG_SITEMGR_".string_strtoupper($typeName)."_ERROR_MAXIMUM_CATEGORIES")."<br />".$error_message2;
					}
				}

				if ($error_message || $error_msg) {

					unset($msg);
					unset($message);
					
				} else {
					if ($typeName == "Promotion") $typeName = PROMOTION_FEATURE_FOLDER;
					if ($success_delete) {
						header("Location: ".DEFAULT_URL."/sitemgr/".string_strtolower($typeName)."/index.php?msg=successdel&letter=$letter&screen=$screen");
					} else {
						
						header("Location: ".DEFAULT_URL."/sitemgr/".string_strtolower($typeName)."/index.php?msg=success&letter=$letter&screen=$screen");
					}
					exit;
				}

			}

		} else {
			if ($bulkSubmit) {
				if ($delete_all) {
					$error_message = 2;
				} else if (!$change_section && !$change_section && !$add_category_id && $typeName == "Banner" && !$change_no_owner && !$change_account_id && !$status && !$level && !$change_renewaldate && !$add_category_id) {
					$error_message = 4;
				} else if (!$change_no_owner && !$change_account_id && !$status && !$level && !$change_renewaldate && !$add_category_id && !$return_categories && !$removecategory && $typeName != "Banner") {
					$error_message = 4;
				} else {
					$error_message = 2;
				}
			} else {
				if ($search_submit) {
					if ($delete_all) {
						$error_message = 2;
					} else if ($change_section || $change_section || $add_category_id || $change_no_owner || $change_account_id || $status || $level || $change_renewaldate || $add_category_id) {
						$error_message = 2;
					} else {
						$error_message = 4;
					}
				}
			}
		}
	}
?>