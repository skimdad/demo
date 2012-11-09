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
	# * FILE: /includes/code/comments.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);	
	
	// Default CSS class for message
	$message_style = "successMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		
		if (!$edir_op && !$fb_op){
			$error = true;
			$actions[] =  "&#149;&nbsp;".system_showText(LANG_SITEMGR_COMMENTING_ERROR1);
		} else {
			if ($edir_op){
				if(!setting_set("commenting_edir", "on")) {
					if(!setting_new("commenting_edir", "on")) {
						$error = true;
					}
				}
			} else {
				if(!setting_set("commenting_edir", "")) {
					if(!setting_new("commenting_edir", "")) {
						$error = true;
					}
				}
			}
			if ($fb_op) {
				if(!setting_set("commenting_fb", "on")) {
					if(!setting_new("commenting_fb", "on")) {
						$error = true;
					}
				}
			} else {
				if(!setting_set("commenting_fb", "")) {
					if(!setting_new("commenting_fb", "")) {
						$error = true;
					}
				}
			}
		}
		
		if ($fb_op){
			if ($foreignaccount_facebook_apiid){
				if (is_numeric($foreignaccount_facebook_apiid)){
					if(!setting_set("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid)) {
						if(!setting_new("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid)) {
							$error = true;
						}
					}
				} else {
					$error = true;
					$actions[] =  "&#149;&nbsp;".system_showText(LANG_SITEMGR_COMMENTING_ERROR5);
				}
			} else {
				$error = true;
				$actions[] =  "&#149;&nbsp;".system_showText(LANG_SITEMGR_COMMENTING_ERROR6);
			}
			
			if ($fb_user_id){
				if (is_numeric($fb_user_id)){
					if(!setting_set("commenting_fb_user_id", $fb_user_id)) {
						if(!setting_new("commenting_fb_user_id", $fb_user_id)) {
							$error = true;
						}
					}
				} else {
					$error = true;
					$actions[] =  "&#149;&nbsp;".system_showText(LANG_SITEMGR_COMMENTING_ERROR2);
				}
			} else {
				$error = true;
				$actions[] =  "&#149;&nbsp;".system_showText(LANG_SITEMGR_COMMENTING_ERROR4);
			}
		
			if (is_numeric($fb_number_comments) || !$fb_number_comments){
				if(!setting_set("commenting_fb_number_comments", $fb_number_comments)) {
					if(!setting_new("commenting_fb_number_comments", $fb_number_comments)) {
						$error = true;
					}
				}
			} else {
				$error = true;
				$actions[] =  "&#149;&nbsp;".system_showText(LANG_SITEMGR_COMMENTING_ERROR3);
			}
		}
		
		//Review options
		if ($edir_op){
			if(!setting_set("review_listing_enabled", $review_listing_enabled))
				if(!setting_new("review_listing_enabled", $review_listing_enabled))
					$error = true;

			if(!setting_set("review_article_enabled", $review_article_enabled))
				if(!setting_new("review_article_enabled", $review_article_enabled))
					$error = true;


			if(!setting_set("review_promotion_enabled", $review_promotion_enabled))
				if(!setting_new("review_promotion_enabled", $review_promotion_enabled))
					$error = true;
				
			if(!setting_set("review_blog_enabled", $review_blog_enabled))
				if(!setting_new("review_blog_enabled", $review_blog_enabled))
					$error = true;

			if(!setting_set("review_approve", $review_approve))
				if(!setting_new("review_approve", $review_approve))
					$error = true;

			if(!setting_set("review_manditory", $review_manditory))
				if(!setting_new("review_manditory", $review_manditory))
					$error = true;
		}
		//
		
		if (!$error) {
			$actions[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_COMMENTING_INFORMATIONWASCHANGED);
		} else {
			$message_style = "errorMessage";
		}
		
		if($actions) {
			$message_commenting .= implode("<br />", $actions);
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	
	//Edir comments/reviews options
	setting_get("review_listing_enabled", $review_listing_enabled);
	if ($review_listing_enabled) $review_listing_enabled_checked = "checked";

	setting_get("review_article_enabled", $review_article_enabled);
	if ($review_article_enabled) $review_article_enabled_checked = "checked";

	setting_get("review_promotion_enabled", $review_promotion_enabled);
	if ($review_promotion_enabled) $review_promotion_enabled_checked = "checked";
	
	setting_get("review_blog_enabled", $review_blog_enabled);
	if ($review_blog_enabled) $review_blog_enabled_checked = "checked";

	setting_get("review_approve", $review_approve);
	if ($review_approve) $review_approve_checked = "checked";

	setting_get("review_manditory", $review_manditory);
	if ($review_manditory) $review_manditory_checked = "checked";
	
	//Facebook options
	if (!$lastOption) $lastOption = "edir";
	if (!$commenting_edir) setting_get("commenting_edir", $commenting_edir);
	if (!$commenting_fb) setting_get("commenting_fb", $commenting_fb);
	if (!$fb_number_comments) setting_get("commenting_fb_number_comments", $fb_number_comments);
	if (!$foreignaccount_facebook_apiid) setting_get("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid);
	if (!$fb_user_id) setting_get("commenting_fb_user_id", $fb_user_id);
	
	if ($_GET["user_id"]) {
		$fb_user_id = $_GET["user_id"];
		$lastOption = "fb";
	}
?>