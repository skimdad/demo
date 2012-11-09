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
	# * FILE: /functions/language_funct.php
	# ----------------------------------------------------------------------------------------------------

	function language_writeComboLang($name = 'lang', $default_value = EDIR_DEFAULT_LANGUAGE, $onChange = '', $block = false) {

		$languages = explode(',', EDIR_LANGUAGES);
		$languagenames = explode(',', EDIR_LANGUAGENAMES);

		if (count($languages) > 1) {

			$onChange_value = ($onChange != '') ? ("onchange=\"$onChange\"") : '';
			$block_value    = ($block) ? ("disabled=\"disabled\"") : ('');
			$name_value     = ($block) ? ($name.'_disabled') : ($name);

			$buffer_comboLang = "<select name=\"$name_value\" id=\"$name_value\" $onChange_value $block_value >\n";
			for ($i=0;$i<count($languages);$i++) {
				$language = $languages[$i];
				$languagename = $languagenames[$i];
				$selected = "";
				if ($default_value == $language) {
					$selected = " selected=\"selected\"";
				}
				$buffer_comboLang .= "\t<option value=\"$language\"$selected>$languagename</option>\n";
			}
			$buffer_comboLang .= "</select>\n";

			if ($block) {
				$buffer_comboLang .= "<input type=\"hidden\" name=\"$name\" value=\"$default_value\" />\n";
			}

		} else {

			$buffer_comboLang = "<input type=\"hidden\" name=\"lang\" value=\"$languages[0]\" />\n";
			$buffer_comboLang .= "<span style=\"text-align:left;font-weight:bold;font-size:12px;\">$languagenames[0]</span>\n";

		}

		return $buffer_comboLang;

	}

	function language_langOptions($lang) {
		$languages = explode(',', EDIR_LANGUAGES);
		$languagenames = explode(',', EDIR_LANGUAGENAMES);
		$return = "";
		if (count($languages) > 1) {
			$return .= "<select name=\"lang\">";
			for ($i=0; $i<count($languages); $i++) {
				$language = $languages[$i];
				$languagename = $languagenames[$i];
				$selected = "";
				if ($language == $lang) $selected = "selected=\"selected\"";
				$return .= "<option value=\"$language\" $selected>$languagename</option>";
			}
			$return .= "</select>";
		} else {
			$return .= "<input type=\"hidden\" name=\"lang\" value=\"".$languages[0]."\" />\n";
			$return .= "<span style=\"font-weight: bold; font-size: 12px;\">".$languagenames[0]."</span>\n";
		}
		return $return;
	}

	function language_getIndex($lang) {
		$return = "";
		$languages = explode(',', EDIR_LANGUAGES);
		$language_numbers = explode(",", EDIR_LANGUAGENUMBERS);
		foreach ($language_numbers as $k=>$i) {
			if ($languages[$k] == $lang) {
				$return = $i;
			}
		}
		return $return;
	}
    
	/*
	 * Function to create a constant with table of language Information
	 */
	function language_constants(){
		if(defined('LANGUAGE_INFORMATION')) return false;
		unset($langObj,$array_languages);

		$langObj = new Lang();
		$array_languages = $langObj->convertTableToArray();

		if(is_array($array_languages)){
			define("LANGUAGE_INFORMATION", serialize($array_languages));
		}

	}

	/*
	 * Function to get information about language
	 */
	function language_getLanguageInformation($index){

		if(!defined('LANGUAGE_INFORMATION')){
			language_constants();
		}

		$aux_language_information = unserialize(LANGUAGE_INFORMATION);
		$array_language_information = $aux_language_information[$index];

		if(is_array($array_language_information)){
			return $array_language_information;
		}else{
			return false;
		}

	}
    
    function language_getFilePath($lang = EDIR_LANGUAGE, $script = false, $relative = false, $blog = false, $sitemgr = false, $domain_id = SELECTED_DOMAIN_ID){
        
        if ($script){
            $ext = "js";
        } else {
            $ext = "php";
        }
        
        if ($blog){
            $rootPath = BLOG_EDIRECTORY_ROOT; 
        } else {
            $rootPath = EDIRECTORY_ROOT; 
        }
        
        $path = "";
        
        if (file_exists($rootPath."/custom/domain_".$domain_id."/lang/".$lang.($sitemgr ? "_sitemgr" : "").".".$ext)){
            if ($script){
                if ($relative){
                    $path = "/custom/domain_".$domain_id."/lang/".$lang.".".$ext;
                } else {
                    $path = DEFAULT_URL."/custom/domain_".$domain_id."/lang/".$lang.".".$ext;
                }
            } else {
                $path = $rootPath."/custom/domain_".$domain_id."/lang/".$lang.($sitemgr ? "_sitemgr" : "").".".$ext;
            }
        } else {
            if ($script){
                if ($relative){
                    $path = "/lang/".$lang.".".$ext;
                } else {
                    $path = DEFAULT_URL."/lang/".$lang.".".$ext;
                }
            } else {
                $path = $rootPath."/lang/".$lang.($sitemgr ? "_sitemgr" : "").".".$ext;
            }
        }
        
        return $path;
    }
?>