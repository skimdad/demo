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
	# * FILE: /includes/code/content_footer.php
	# ----------------------------------------------------------------------------------------------------

	extract($_POST);
	extract($_GET);
	
	if (($_SERVER['REQUEST_METHOD'] == "POST") && (!DEMO_LIVE_MODE)) {
		/* setting copyright */
		if (!customtext_set("footer_copyright", $copyright, $clang)) {
			if (!customtext_new("footer_copyright", $copyright, $clang)) {
				$error = true;
				$actions = "";
			}
		}
		
		// fixing facebook url field if needed.
		if (trim($setting_facebook_link) != "") {
			if (string_strpos($setting_facebook_link, "://") !== false) {
				$aux_fb_url = explode("://", $setting_facebook_link);
				$aux_fb_url = $aux_fb_url[1];
				$setting_facebook_link = $aux_fb_url;
			}
			$setting_facebook_link = $url_protocol_FB . $setting_facebook_link;
		}
		
		/*
		 * Link to facebook profile
		 */
		if(!setting_set("setting_facebook_link", $setting_facebook_link)) {
			if(!setting_new("setting_facebook_link", $setting_facebook_link)) {
				$error = true;
			}
		}
		
		// fixing linkedin url field if needed.
		if (trim($setting_linkedin_link) != "") {
			if (string_strpos($setting_linkedin_link, "://") !== false) {
				$aux_lk_url = explode("://", $setting_linkedin_link);
				$aux_lk_url = $aux_lk_url[1];
				$setting_linkedin_link = $aux_lk_url;
			}
			$setting_linkedin_link = $url_protocol_LK . $setting_linkedin_link;
		}
		
		/*
		 * Link to Linkedin profile
		 */
		if(!setting_set("setting_linkedin_link", $setting_linkedin_link)) {
			if(!setting_new("setting_linkedin_link", $setting_linkedin_link)) {
				$error = true;
			}
		}
		
		if (!$error) {
			if (CACHE_PARTIAL_FEATURE == "on"){
				cachepartial_removecache('footer');
			}
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_CONTENT_FOOTER_SUCCESS);
		} else {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
		}
		if($actions) {
			$message_footer .= implode("<br />", $actions);
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	/**
	* Field values
	*/
	customtext_get("footer_copyright", $copyright, $clang);
	setting_get("setting_linkedin_link", $setting_linkedin_link);
	setting_get("setting_facebook_link", $setting_facebook_link);

	$dropdownFB_protocol = html_protocolDropdown($setting_facebook_link, "url_protocol_FB" ,false, $protocolFB_replace);
	$dropdownLK_protocol = html_protocolDropdown($setting_linkedin_link, "url_protocol_LK",false, $protocolLK_replace);

?>