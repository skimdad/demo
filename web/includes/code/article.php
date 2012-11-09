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
	# * FILE: /includes/code/article.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	$language_numbers = explode(",", EDIR_LANGUAGENUMBERS);

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		##################################################
		### KEYWORDS
		##################################################
		foreach ($language_numbers as $i) {
			$labelsuffix = $i;
			unset($arr_keywords);
			unset($each_keyword);
			unset($aux_kw);
			unset($new_arr_keywords);
			unset($aux_keywords);
			$arr_keywords = explode("\n", ${"keywords".$labelsuffix});
			foreach ($arr_keywords as $each_keyword) {
				$aux_kw = trim($each_keyword);
				if (string_strlen($aux_kw) > 0) {
					$new_arr_keywords[] = $aux_kw;
				}
			}
			if ($new_arr_keywords) $aux_keywords = implode(" || ", $new_arr_keywords);
			$_POST["keywords".$labelsuffix] = $aux_keywords;
			$_POST["array_keywords".$labelsuffix] = $new_arr_keywords;
		}
		##################################################

		$_POST["title"] = trim($_POST["title"]);

		foreach ($language_numbers as $i) {
			$labelsuffix = $i;
			// strip \r chars provided by Windows, in order to keep character count standard
            if ($_POST["abstract".$labelsuffix]) {
                $_POST["abstract".$labelsuffix] = str_replace("\r", "", $_POST["abstract".$labelsuffix]);
            }
		}

		$_POST["title"] = preg_replace('/\s\s+/', ' ', $_POST["title"]);
		$_POST["friendly_url"] = str_replace(".htm", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = str_replace(".html", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = trim($_POST["friendly_url"]);
		$sqlFriendlyURL = "";
		$sqlFriendlyURL .= " SELECT friendly_url FROM Article WHERE friendly_url = ".db_formatString($_POST["friendly_url"])." ";
		if ($id) $sqlFriendlyURL .= " AND id != $id ";
		$sqlFriendlyURL .= " LIMIT 1 ";
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObjFriendlyURL = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$resultFriendlyURL = $dbObjFriendlyURL->query($sqlFriendlyURL);
		if (mysql_num_rows($resultFriendlyURL) > 0) {
			if ($id) $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.$id;
			else $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.uniqid();
		}
        if (!$id && !$_POST["friendly_url"]) {    
            $_POST["friendly_url"] = uniqid(); 
        } 

		if (validate_form("article", $_POST, $message_article,$_POST["categories"]) && is_valid_discount_code($_POST["discount_id"], "article", $_POST["id"], $message_article, $discount_error_num)) {

			// fixing url field if needed.
			if (trim($_POST["author_url"]) != "") {
				if (string_strpos($_POST["author_url"], "://") !== false) {
					$aux_author_url = explode("://", $_POST["author_url"]);
					$aux_author_url = $aux_author_url[1];
					$_POST["author_url"] = $aux_author_url;
				}
				$_POST["author_url"] = $_POST["author_url_protocol"] . $_POST["author_url"];
			}
            
            // setting seo_description and seo_keyword when member signup for an item
            if ( $members && $process == 'signup' ) {
                
                foreach ($language_numbers as $i) {
					$labelsuffix = $i;
                    (!isset($_POST["seo_abstract".$labelsuffix])) ? ($_POST["seo_abstract".$labelsuffix] = str_replace("\n", " ", $_POST["abstract".$labelsuffix])) : '';
                    (!isset($_POST["seo_keywords".$labelsuffix])) ? ($_POST["seo_keywords".$labelsuffix] = str_replace(" ||", ",", $_POST["keywords".$labelsuffix])) : '';
                    
                }
            }
            
            // removing linebreaks from seo_description
            if ( !$id ) {
            
                foreach ($language_numbers as $i) {
					$labelsuffix = $i;
                    ($_POST["seo_abstract".$labelsuffix] = str_replace("\n", " ", $_POST["seo_abstract".$labelsuffix]));
                }
            } 

			$status = new ItemStatus();
			$article = new Article($id);
			$new_article = false;
			$update_article = false;

			if (!$article->getString("id") || $article->getString("id") == 0){
				$new_article = true;
				$aux_package_id = $_POST["package_id"];
				$_POST["package_id"] = 0;
				
				system_addItemGallery($gallery_hash, $_POST["title"], $galleryIDC, $image_id, $thumb_id);

				$message = 0;
				$article->makeFromRow($_POST);
				$article->setString("status", $status->getDefaultStatus());
				$emailNotification = true;
				$newest = "1";
				
				$article->setDate("renewal_date", "00/00/0000");

				$article->setDate("publication_date", $publication_date);

				if (string_strpos($url_base, "/sitemgr") && $_POST["account_id"]) {
					system_renameGalleryImages($image_id, $thumb_id, $_POST["account_id"], $galleryIDC);
				}

				$_POST["package_id"] = $aux_package_id;

			} else {
				$update_article = true;

				$galleryIDC = $gallery_id;
				system_addItemGallery($gallery_hash, $_POST["title"], $gallery_id, $image_id, $thumb_id);
				$message = 1;
				$emailNotification = false;
				if ($article->getString("status") != $status->getDefaultStatus()) $emailNotification = true;

				//security issue
				unset($_POST["status"]);
				unset($_POST["renewal_date"]);

				if (!$article->hasRenewalDate()) {
					$_POST["renewal_date"] = "0000-00-00";
				}

				if (string_strpos($url_base, "/sitemgr")) {

					$_POST["status"] = $article->getString("status");
					
					if ($article->getNumber("account_id") != $_POST["account_id"] || $_POST["account_id"]) {
						$image_idT = $article->getNumber("image_id");
						$thumb_idT = $article->getNumber("thumb_id");

						system_renameGalleryImages($image_idT, $thumb_idT, $_POST["account_id"], $galleryIDC);
					}
					
				} else {
					$last_status = $article->getString("status");
				}

				$article->makeFromRow($_POST);
				$article->setDate("publication_date", $publication_date);
			}

			if ($image_id) {
				$article->setNumber("image_id",$image_id);
				$article->setNumber("thumb_id",$thumb_id);
			}

			$levelObjTmp = new ArticleLevel(EDIR_DEFAULT_LANGUAGE, true);
			$levelsTmp = $levelObjTmp->getLevelValues();
			if (!in_array($article->getNumber("level"), $levelsTmp)) {
				$article->setNumber("level", $levelObjTmp->getDefaultLevel());
			}

			if (!$_POST["publication_date"]) {
				$_POST["publication_date"] = date(DEFAULT_DATE_FORMAT);
				$article->setDate("publication_date", $_POST["publication_date"]);
			}

			unset($levelObjTmp);
			unset($levelsTmp);

			$article->Save();

			if ($_POST["from_advertise"]) {
				$accObj = new Account(sess_getAccountIdFromSession());
				$accObj->changeMemberStatus(true);

				$accDomain = new Account_Domain($accObj->getNumber("id"), SELECTED_DOMAIN_ID);
				$accDomain->Save();
				$accDomain->saveOnDomain($accObj->getNumber("id"), $accObj);
			}

			//setting gallery
			$article->setGalleries($galleryIDC);

			/**
			*
			* E-mail notify
			*
			***************************************************************************************************/
			$domain = new Domain(SELECTED_DOMAIN_ID);
			if ($article->getNumber("account_id") > 0) {
				if($message == 0) {
					$contactObj = new Contact($article->getNumber("account_id"));
					if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_ARTICLE, $contactObj->getString("lang"))) {
						setting_get("sitemgr_send_email", $sitemgr_send_email);
						setting_get("sitemgr_email", $sitemgr_email);
						$sitemgr_emails = explode(",", $sitemgr_email);
						if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
						$subject = $emailNotificationObj->getString("subject");
						$body    = $emailNotificationObj->getString("body");
						$body = system_replaceEmailVariables($body,$article->getNumber('id'),'article');
						$subject = system_replaceEmailVariables($subject,$article->getNumber('id'),'article');
						$body    = str_replace("DEFAULT_URL", DEFAULT_URL, $body);
						$body	 = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $body);
						$body = html_entity_decode($body);
						$subject = html_entity_decode($subject);
						$error = false;
						system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
					}
				}
			}
			if ($emailNotification) {
				if (!string_strpos($url_base, "/sitemgr")) {
					$domain_url = DEFAULT_URL;
					$domain_url = str_replace($_SERVER["HTTP_HOST"],$domain->getstring("url"),$domain_url);
					setting_get("sitemgr_send_email", $sitemgr_send_email);
					setting_get("sitemgr_email", $sitemgr_email);
					$sitemgr_emails = explode(",", $sitemgr_email);
					setting_get("sitemgr_article_email", $sitemgr_article_email);
					$sitemgr_article_emails = explode(",", $sitemgr_article_email);
					$account = new Account($acctId);
					$sitemgr_msg = "
						<html>
							<head>
								<style>
									.email_style_settings{
										font-size:11px;
										font-family:Verdana, Arial, Sans-Serif;
										color:#000;
									}
								</style>
							</head>
							<body>
								<div class=\"email_style_settings\">
									Site Manager,<br /><br />";
					setting_get("new_article_email", $new_article_email);
					setting_get("update_article_email", $update_article_email);
					$sentUp = 0;
					$sentNew = 0;
									if ($_POST["id"]){
										$sitemgr_msg .= "The ".ARTICLE_FEATURE_FOLDER." \"".$article->getString("title")."\" was changed by the administrator \"".system_showAccountUserName($account->getString("username"))."\" and needs to be revised by you.<br /><br />";
										$link_sitemgrmsg = "<a href=\"".$domain_url."/sitemgr/".ARTICLE_FEATURE_FOLDER."/settings.php?id=".$article->getNumber("id")."\" target=\"_blank\">".$domain_url."/sitemgr/".ARTICLE_FEATURE_FOLDER."/settings.php?id=".$article->getNumber("id")."</a><br /><br />";
										$sentUp = 1;
									}
									else {
										$sitemgr_msg .= "The ".ARTICLE_FEATURE_FOLDER." \"".$article->getString("title")."\" was created by the administrator \"".system_showAccountUserName($account->getString("username"))."\" and needs to be revised by you.<br /><br />";
										$sentNew = 1;
										$link_sitemgrmsg = "<a href=\"".$domain_url."/sitemgr/".ARTICLE_FEATURE_FOLDER."/view.php?id=".$article->getNumber("id")."\" target=\"_blank\">".$domain_url."/sitemgr/".ARTICLE_FEATURE_FOLDER."/view.php?id=".$article->getNumber("id")."</a><br /><br />";
									}
									$sitemgr_msg .= $link_sitemgrmsg
									.EDIRECTORY_TITLE."
								</div>
							</body>
						</html>";
					// sending e-mail to site manager
					$error = false;

					if ($update_article_email && $sentUp==1){ // sending e-mail to site manager if e-mails for updated itens is on
					if ($sitemgr_send_email == "on") {
						if ($sitemgr_emails[0]) {
							foreach ($sitemgr_emails as $sitemgr_email) {
								system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(ARTICLE_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
							}
						}
					}
					if ($sitemgr_article_emails[0]) {
						foreach ($sitemgr_article_emails as $sitemgr_article_email) {
							system_mail($sitemgr_article_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(ARTICLE_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_article_email>", "text/html", '', '', $error);
						}
					}
					}

					if ($new_article_email && $sentNew==1){ // sending e-mail to site manager if e-mails for new itens is on
					if ($sitemgr_send_email == "on") {
						if ($sitemgr_emails[0]) {
							foreach ($sitemgr_emails as $sitemgr_email) {
								system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(ARTICLE_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
							}
						}
					}
					if ($sitemgr_article_emails[0]) {
						foreach ($sitemgr_article_emails as $sitemgr_article_email) {
							system_mail($sitemgr_article_email, "[".EDIRECTORY_TITLE."] ".string_ucwords(ARTICLE_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_article_email>", "text/html", '', '', $error);
						}
					}
					}
				}
			}
			/**************************************************************************************************/

			// setting categories
			$return_categories_array = explode(",", $return_categories);
			$article->setCategories($return_categories_array);

			/*
			 * Check if is bought package
			 */
			if($_POST["using_package"] == "y"){
				/*
				 * Check if exists package
				 */
				$packageObj = new Package();
				$array_package_offers = $packageObj->getPackagesByDomainID(SELECTED_DOMAIN_ID, "article", $article->level);
				$hasPackage = false;
				if ((is_array($array_package_offers)) and (count($array_package_offers)>0) and $array_package_offers[0]) {

					unset($array_info_package);
					$array_info_package["item_type"]		= "article";
					$array_info_package["item_id"]			= $article->getNumber("id");
					$array_info_package["item_name"]		= $article->getString("title");
					$array_info_package["item_friendly_ur"]	= $article->getString("friendly_url");
					$array_info_package["package_id"][0]	= $package_id;
					package_buying_package($array_info_package, false, true);

				}
			}

			if ($new_article){
				setting_get("article_approve_free", $article_approve_free);

				if (!$article_approve_free && !$article->needToCheckOut()){
					$article->setString("status", "A");
					$article->save();
				} 				
			}

			if (string_strpos($url_base, "/members") && $update_article) {
				setting_get("article_approve_updated", $article_approve_updated);
				if ($last_status == "A" && !$article->needToCheckOut() && !$article_approve_updated && $process != "signup"){
					$article->setString("status", "A");
					$article->save();
				} else if ($process == "signup"){
					$article->setString("status", $last_status);
					$article->save();
				}
			}

			header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?process=".$process."&newest=".$newest."&message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));
			exit;

		}

		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);

		extract($_POST);
		extract($_GET);

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
	$gallery_hash = $_POST["gallery_hash"] ? $_POST["gallery_hash"] : "article".($id ? "_$id" : "")."_".uniqid(rand(), true);
	
	if ($id) {

		if (string_strpos($url_base, "/members")) {
			$by_key = array("id", "account_id");
			$by_value = array(db_formatNumber($id), sess_getAccountIdFromSession());
			$article = db_getFromDB("article", $by_key, $by_value, 1, "", "object", SELECTED_DOMAIN_ID);
		} else {
			$article = db_getFromDB("article", "id", db_formatNumber($id), 1, "", "object", SELECTED_DOMAIN_ID);
		}

		if ((sess_getAccountIdFromSession() != $article->getNumber("account_id")) && (!string_strpos($url_base, "/sitemgr"))) {
			header("Location: $url_redirect/index.php?message=".$message."&screen=$screen&letter=$letter");
			exit;
		}

		$article->extract();

		$galleries = db_getFromDBBySQL("gallery", "SELECT gallery_id FROM Gallery_Item WHERE item_id = ".$id." AND item_type = 'article ' ORDER BY id", "array", false, SELECTED_DOMAIN_ID);
		$gallery_id = $galleries[0]["gallery_id"];

		if (!$gallery_id){
			$gallery = new Gallery($id);
			$aux = array("account_id"=>0,"title"=>$title,"entered"=>"NOW()","updated"=>"now()");
			$gallery->makeFromRow($aux);
			$gallery->save();
			$article->setGalleries($gallery->getNumber("id"));
			$gallery_id=$gallery->getNumber("id");
			$sql = "INSERT INTO Gallery_Image (gallery_id,image_id,thumb_id,image_default) VALUES ($gallery_id,".$image_id.",".$thumb_id.",'y')";

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$dbObj->query($sql);
		}

		if (!$message_article){
			$sess_id = $gallery_hash;
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$sql = "DELETE FROM Gallery_Temp WHERE sess_id = '$sess_id'";
			$dbObj->query($sql);
		}

	} else {

		$article = new Article($id);
		$article->makeFromRow($_POST);

		if ($acctId) $account_id = $acctId; else $account_id = $account_id;

		if (!$message_article){
			$sess_id = $gallery_hash;
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$sql = "DELETE FROM Gallery_Temp WHERE sess_id = '$sess_id'";
			$dbObj->query($sql);
		}

	}

	extract($_POST);
	extract($_GET);

	// level
	$levelObj = new ArticleLevel(EDIR_DEFAULT_LANGUAGE, true);
	if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
		$level = $levelObj->getDefaultLevel();
	}
    
    

	// if no publication date, prefill the field within the current date
	if (!$publication_date) {
		$today = date('Y-m-d');		
		$publication_date = format_date ($today);		
	}

	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$categories = "";
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if ($return_categories) {
			$return_categories_array = explode(",", $return_categories);
			foreach ($return_categories_array as $each_category) {
				$categories[] = new ArticleCategory($each_category);
			}
		}
	} else {
		if (!$categories) if ($article) $categories = $article->getCategories();
	}
	if ($categories) {
		for ($i=0; $i<count($categories); $i++) {
			if ($categories[$i]->getString("title".$langIndex)) $arr_category[$i]["name"] = $categories[$i]->getString("title".$langIndex);
			elseif($categories[$i]->getString("title")) $arr_category[$i]["name"] = $categories[$i]->getString("title");
            else $arr_category[$i]["name"] = $categories[$i]->getString("title".EDIR_DEFAULT_LANGUAGENUMBER);
			$arr_category[$i]["value"] = $categories[$i]->getNumber("id");
			$arr_return_categories[] = $categories[$i]->getNumber("id");
		}
		if ($arr_return_categories) $return_categories = implode(",", $arr_return_categories);
		array_multisort($arr_category);
		$feedDropDown = "<select name='feed' id='feed' multiple size='5' style=\"width:500px\">";
		if ($arr_category) foreach ($arr_category as $each_category) {
			$feedDropDown .= "<option value='".$each_category["value"]."'>".$each_category["name"]."</option>";
			$feedAjaxCategory[] = $each_category["value"];
		}
		$feedDropDown .= "</select>";
	} else {
		if ($return_categories) {
			$return_categories_array = explode(",", $return_categories);
			if ($return_categories_array) {
				foreach ($return_categories_array as $each_category) {
					$categories[] = new ArticleCategory($each_category);
				}
			}
		}
		$feedDropDown = "<select name='feed' id='feed' multiple size='5' style=\"width:500px\">";
		if ($categories) {
			foreach ($categories as $category) {
				if ($category->getString("title".$langIndex)) $name = $category->getString("title".$langIndex);
				else $name = $category->getString("title");
				$feedDropDown .= "<option value='".$category->getNumber("id")."'>$name</option>";
				$feedAjaxCategory[] = $category->getNumber("id");
			}
		}
		$feedDropDown .= "</select>";
	}

	##################################################
	### KEYWORDS
	##################################################
	foreach ($language_numbers as $i) {
		$labelsuffix = $i;
		unset($arr_keywords);
		if ($_POST["keywords".$labelsuffix]) {
			$arr_keywords = explode(" || ", $_POST["keywords".$labelsuffix]);
			${"keywords".$labelsuffix} = implode("\n", $arr_keywords);
		} elseif ($article->getString("keywords".$labelsuffix)) {
			$arr_keywords = explode(" || ", $article->getString("keywords".$labelsuffix));
			${"keywords".$labelsuffix} = implode("\n", $arr_keywords);
		}
	}
	##################################################

?>
