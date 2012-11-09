<?php

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
	# * FILE: /includes/code/blogcategory.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($_POST["title".EDIR_DEFAULT_LANGUAGENUMBER]) {
		$_POST["title".EDIR_DEFAULT_LANGUAGENUMBER] = trim($_POST["title".EDIR_DEFAULT_LANGUAGENUMBER]);
		$_POST["title".EDIR_DEFAULT_LANGUAGENUMBER] = preg_replace('/\s\s+/', ' ', $_POST["title".EDIR_DEFAULT_LANGUAGENUMBER]);
	}
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
		if ($_POST["seo_description".EDIR_DEFAULT_LANGUAGENUMBER]) $_POST["seo_description".EDIR_DEFAULT_LANGUAGENUMBER] = str_replace('"', '', $_POST["seo_description".EDIR_DEFAULT_LANGUAGENUMBER]);
        if ($_POST["seo_keywords".EDIR_DEFAULT_LANGUAGENUMBER]) $_POST["seo_keywords".EDIR_DEFAULT_LANGUAGENUMBER] = str_replace('"', '', $_POST["seo_keywords".EDIR_DEFAULT_LANGUAGENUMBER]);
        
        if ($_POST["languages"]) $_POST["lang"] = implode(",", $_POST["languages"]);
		
		if (validate_formBlog("blogcategory", $_POST, $message_tag)) {
			if ($_POST["lang"]){
                $_POST["lang"] = EDIR_DEFAULT_LANGUAGE.",".$_POST["lang"];
            } else {
                $_POST["lang"] = EDIR_DEFAULT_LANGUAGE;
            }
			$_POST["featured"] = "y";
			
			$category = new BlogCategory($id);
			$category->makeFromRow($_POST);
			if (string_strlen($keywords1)=="") $category->setString("keywords1", "");
			if (string_strlen($keywords2)=="") $category->setString("keywords2", "");
			if (string_strlen($keywords3)=="") $category->setString("keywords3", "");
			if (string_strlen($keywords4)=="") $category->setString("keywords4", "");
			if (string_strlen($keywords5)=="") $category->setString("keywords5", "");
			if (string_strlen($keywords6)=="") $category->setString("keywords6", "");
			if (string_strlen($keywords7)=="") $category->setString("keywords7", "");

			//$category->Save();
		
			$category->setNumber("level", $category->getLevel($category->id));
			$category->Save();

			//Updating items fulltext fields
			if (BLOGCATEGORY_SCALABILITY_OPTIMIZATION != 'on' && BLOG_SCALABILITY_OPTIMIZATION != 'on') {
			   $category->updateFullTextItems();
			}

			if ($_POST["category_id"]) { 
                    if ($_POST["id"]) { 
                        $message = 2; 
                        if ($_POST["clickToDisable"]) 
                            $langMessage = 6; 
                    } else { 
                        $message = 3; 
                        if ($_POST["clickToDisable"]) 
                            $langMessage = 6; 
                    } 
                } else { 
                    if ($_POST["id"]) { 
                        $message = 4; 
                        if ($_POST["clickToDisable"]) 
                            $langMessage = 7; 
                    } else { 
                        $message = 5; 
                        if ($_POST["clickToDisable"]) 
                            $langMessage = 7; 
                    } 
                }

			header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&langmessage=".$langMessage."&category_id=".$category_id."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));
			exit;

		}

		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET = format_magicQuotes($_GET);
		extract($_POST);
		extract($_GET);

	} 

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$category = db_getFromDB_Blog("blogcategory", "id", $id, 1, "", "object", SELECTED_DOMAIN_ID);
		$category->extract();
		$languages = explode(",", $category->lang);
		$featured = "y";
	}

	extract($_POST);
	extract($_GET);
?>