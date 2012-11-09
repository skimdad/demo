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
	# * FILE: /includes/views/view_listing.php
	# ----------------------------------------------------------------------------------------------------

	require_once(EDIRECTORY_ROOT."/sitemgr/registration.php");
	require_once(EDIRECTORY_ROOT."/includes/code/checkregistration.php");

	$templateCSSDetail = "";
	$templateCSSTitle = "";
	$templateCSSLabel = "";
	$templateCSSText = "";
	
	if (is_array($bronze_listing) && !$is_object) {
		$is_object = false;
		$aux = $bronze_listing;
	} else if (is_object($bronze_listing)) {
		$is_object = true;
		$aux = $bronze_listing->data_in_array;
	} else {
		$is_object = true;
		$aux = $bronze_listing;
	}

	if ($bronze_listing_viewtype == "detail") {
		$template_file_name = INCLUDES_DIR."/views/view_listing_".$bronze_listing_viewtype."_code_0.php";
		$template_file_name_theme = INCLUDES_DIR."/views/view_listing_".$bronze_listing_viewtype."_code_0_".EDIR_THEME.".php";
	} else {
		$template_file_name = INCLUDES_DIR."/views/view_listing_".$bronze_listing_viewtype."_code_bronze.php";
		$template_file_name_theme = INCLUDES_DIR."/views/view_listing_".$bronze_listing_viewtype."_code_".EDIR_THEME.".php";
	}
	
	if ($EDIR_isregisteredBin) {
		
		if (htmlspecialchars($aux["listingtemplate_id"]) > 0) {

			if ($is_object) {
				$bronze_listing_template = new ListingTemplate($aux["listingtemplate_id"]);
			} else {
				unset($arrTemplate);
				$arrTemplate["id"] = htmlspecialchars($aux["listingtemplate_id"]);
				$arrTemplate["layout_id"] = htmlspecialchars($aux["template_layout_id"]);
				$arrTemplate["title"] = htmlspecialchars($aux["template_title"]);
				$arrTemplate["friendly_url"] = htmlspecialchars($aux["template_friendly_url"]);
				$arrTemplate["status"] = htmlspecialchars($aux["template_status"]);
				$arrTemplate["price"] = htmlspecialchars($aux["template_price"]);
				
				$bronze_listing_template = new ListingTemplate($arrTemplate);
			}

			if ((($bronze_listing_template) && ($bronze_listing_template->getNumber("id") > 0) && ($bronze_listing_template->getString("status") == "enabled")) || ($preview) ) {

				if ($bronze_listing_viewtype == "detail") {
                    
                    if (USING_THEME_TEMPLATE && THEME_TEMPLATE_ID){
                        $templateLayoutID = "0";
                    } else {
                        $templateLayoutID = $bronze_listing_template->getNumber("layout_id");
                    }
                    
                    $template_file_name = INCLUDES_DIR."/views/view_listing_".$bronze_listing_viewtype."_code_".$templateLayoutID.".php";
                    $template_file_name_theme = INCLUDES_DIR."/views/view_listing_".$bronze_listing_viewtype."_code_".$templateLayoutID."_".EDIR_THEME.".php";

					if (file_exists($template_file_name) || file_exists($template_file_name_theme)) {
						$templateExtraFields = "";
						$template_fields = $bronze_listing_template->getListingTemplateFields();
						if ($template_fields!==false) {
							foreach ($template_fields as $row) {
                                if (string_strpos($row["label"], "LANG_LABEL") !== false){
                                    $row["label"] = @constant($row["label"]);
                                }
								$var_name = strtolower('_'.preg_replace('/[^0-9a-zA-Z]/i', '', $row["label"]));
								$$var_name = htmlspecialchars($aux[$row["field"]]);
								if (strpos($row["field"], "custom_checkbox") !== false) {
									if ($$var_name == "y") $templateExtraFields .= "\t<p><strong>".$row["label"]."</strong>: ".system_showText(LANG_YES)."</p>\n";
									else $templateExtraFields .= "\t<p><strong>".$row["label"]."</strong>: ".system_showText(LANG_NO)."</p>\n";
								} elseif (strpos($row["field"], "custom_dropdown") !== false) {
									if ($$var_name) $templateExtraFields .= "\t<p><strong>".$row["label"]."</strong>: ".nl2br($$var_name)."</p>\n";
								} elseif (strpos($row["field"], "custom_text") !== false) {
									if ($$var_name) $templateExtraFields .= "\t<p><strong>".$row["label"]."</strong>: ".nl2br($$var_name)."</p>\n";
								} elseif (strpos($row["field"], "custom_short_desc") !== false) {
									if ($$var_name) $templateExtraFields .= "\t<p><strong>".$row["label"]."</strong>: ".nl2br($$var_name)."</p>\n";
								} elseif (strpos($row["field"], "custom_long_desc") !== false) {
									if ($$var_name) $templateExtraFields .= "\t<p><strong>".$row["label"]."</strong>: ".nl2br($$var_name)."</p>\n";
								}
							}
						}
                        
                        if (!file_exists($template_file_name_theme) && $template_fields) {
							$templateExtraFields = "<h2 class=\"detailTitle\">".system_showText(LANG_EXTRA_FIELDS)."</h2>".$templateExtraFields;
						}

					}

				}

			}

		}
		
	}

    if (file_exists($template_file_name_theme)){
       include($template_file_name_theme); 
    } else {
        include($template_file_name);
    }
    
	unset($aux);

?>