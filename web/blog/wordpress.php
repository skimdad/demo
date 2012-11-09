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
	# * FILE: /sitemgr/plugins/wordpress_plugin_ajax.php
	# ----------------------------------------------------------------------------------------------------
	
	include("../conf/loadconfig.inc.php");
	
	setting_get("wordpress_key", $wordpress_key);
	
	/*
	 * Preparing Array with content to save on eDirectory
	 */
	
	$wp_fields	= (unserialize($_POST["fields"]));
    //Use the line below if the wordpress server is sending the information with quotes
	//$wp_fields	= (unserialize(stripslashes($_POST["fields"])));
	$wp_key = $wp_fields["key"];
	
	if (!$wp_key){
		echo "Empty WordPress key.";
	} elseif ($wordpress_key != $wp_key) {
		echo "Invalid WordPress key.";
	} else {
	
		unset($aux_objectObj);
		if($wp_fields["type"] == "category"){
			$aux_objectObj = new BlogCategory();
		}elseif($wp_fields["type"] == "posts"){
			$aux_objectObj = new Post();
		}elseif($wp_fields["type"] == "delete_post"){
			$postObj = new Post();
			$postObj->deleteWPPost($wp_fields);
		}elseif($wp_fields["type"] == "trash_post"){
			$postObj = new Post();
			$postObj->TrashedWPPost($wp_fields);
		}elseif($wp_fields["type"] == "untrash_post"){
			$postObj = new Post();
			$postObj->UntrashedWPPost($wp_fields);
		}elseif($wp_fields["type"] == "delete_category"){
			$postObj = new BlogCategory();
			$postObj->deleteWPCategory($wp_fields);
		}elseif($wp_fields["type"] == "comments"){
			$aux_objectObj = new Comments();
		}elseif($wp_fields["type"] == "delete_comment"){
			$postObj = new Comments();
			$postObj->deleteWPComment($wp_fields);
		}elseif($wp_fields["type"] == "trash_comment"){
			$postObj = new Comments();
			$postObj->TrashedWPComment($wp_fields);
		}elseif($wp_fields["type"] == "untrash_comment"){
			$postObj = new Comments();
			$postObj->UntrashedWPComment($wp_fields);
		}

		if(is_object($aux_objectObj)){
			$aux_objectObj->SaveWPToEdir($wp_fields);
		}
		
		echo "Ok";
	
	}
?>
