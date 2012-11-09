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
	# * FILE: /includes/code/export.php
	# ----------------------------------------------------------------------------------------------------
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		extract($_POST);

        if ($ajax_action){ //charset fix
            header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
            header("Accept-Encoding: gzip, deflate");
            header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check", FALSE);
            header("Pragma: no-cache");
        }

		if ($ajax_action == "generate_data") {
			$exportFilePath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/export_files";
			if (!is_dir($exportFilePath)) {
				echo "error";
				exit;
			}
			
			if (defined(string_strtoupper($item_type)."_LIMIT")) {
				$_POST["item_limit"] = constant(string_strtoupper($item_type)."_LIMIT");
			} else {
				$_POST["item_limit"] = 10000;
			}
			
			if ($_POST["item_type"] == "Listing") {
				$_POST["fields_excluded"] = "image_id, thumb_id, promotion_id, discount_id, video_snippet, custom_checkbox0, custom_checkbox1, custom_checkbox2, custom_checkbox3, custom_checkbox4, custom_checkbox5, custom_checkbox6, custom_checkbox7, custom_checkbox8, custom_checkbox9, custom_dropdown0, custom_dropdown1, custom_dropdown2, custom_dropdown3, custom_dropdown4, custom_dropdown5, custom_dropdown6, custom_dropdown7, custom_dropdown8, custom_dropdown9, custom_text0, custom_text1, custom_text2, custom_text3, custom_text4, custom_text5, custom_text6, custom_text7, custom_text8, custom_text9, custom_short_desc0, custom_short_desc1, custom_short_desc2, custom_short_desc3, custom_short_desc4, custom_short_desc5, custom_short_desc6, custom_short_desc7, custom_short_desc8, custom_short_desc9, custom_long_desc0, custom_long_desc1, custom_long_desc2, custom_long_desc3, custom_long_desc4, custom_long_desc5, custom_long_desc6, custom_long_desc7, custom_long_desc8, custom_long_desc9, listingtemplate_id, importID";
			} else if ($_POST["item_type"] == "Account") {
				$_POST["fields_excluded"] = "account_id, updated, entered, password, importID, complementary_info";
			} else if ($_POST["item_type"] == "Banner") {
				$_POST["fields_excluded"] = "image_id, discount_id, target_window, expiration_setting";
			} else if ($_POST["item_type"] == "Event" || $_POST["item_type"] == "Classified" || $_POST["item_type"] == "Article") {
				$_POST["fields_excluded"] = "discount_id, image_id, thumb_id";
			} else {
				$_POST["fields_excluded"] = "";
			}

			$_POST["export_from"] = "browser";

			$exportObj = new Export($_POST);
			echo $exportObj->execute();
		} else if ($ajax_action == "schedule_export") {
			$exportFilePath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/export_files";
			if (!is_dir($exportFilePath)) {
				echo 2;
				exit;
			}
			
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			
			$sqlExport = "SELECT finished FROM Control_Export_Listing WHERE type = 'csv - data' AND domain_id = $domain_id";

			$resExport = $dbMain->query($sqlExport);
			$rowExport = mysql_fetch_assoc($resExport);
			if($rowExport["finished"] == "Y"){
				$sqlUpdate =	"UPDATE Control_Export_Listing SET
									last_run_date = NOW(),
									scheduled = 'Y',
									running_cron = 'N',
									finished = 'N',
									filename = '$file_name',
									total_listing_exported = 0,
									last_listing_id = 0
								WHERE type = 'csv - data' AND domain_id = $domain_id";
				$dbMain->query($sqlUpdate);
				
				if ($dbMain->mysql_error) $return = 2;
				else if (mysql_affected_rows($dbMain->link_id)) $return = 0;
			} else {
				$return = 1;
			}
			echo $return;
		} else if ($ajax_action == "check_progress") {
			$fileName = "export_".str_replace(".zip", "", $file_name).".progress";
			$filePath = EDIRECTORY_ROOT."/custom/domain_$domain_id/export_files/$fileName";
			if (file_exists($filePath)) {
				if (!$handle = fopen($filePath, "r")) {
					$return = "error";
				} else {
					$progress = fgets($handle);
					if (!fclose($handle)) {
						$return = "error";
					} else {
						$last_progress = str_replace("%", "", $last_progress);
						if ($progress < $last_progress) $progress = $last_progress;
						$return = "progress - ".$progress;

					}
				}
			} else {
				$return = "waiting";
			}
			echo $return;
		}
		exit;
	} else if (isset($_GET["download"]) && $_GET["download"]) {
		$exportFilePath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/export_files";
		$fileName = $exportFilePath."/".$_GET["download"];

		$zipObj = new Zip();
		if ($_GET["action"] != "cron") $_GET["action"] = false;
		if ($zipObj->loadZipFromFile($fileName, $_GET["action"])) {
			$zipObj->sendZip($_GET["download"]);
		}
		exit;
	}
	
	$exportFilePath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/export_files";
	$errorExportFolder = false;
	if (!is_dir($exportFilePath)) $errorExportFolder = true;
	
	/**
	 * Form Defines
	 * Category and Locations DropDown
	 */

	//CATEGORY PROCESS
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
	$endExpr = ")";

	if (count($arrLangs) > 1) {
		$fields = "id, IF (`title".$langIndex."` != '', `title".$langIndex."`, ";
		foreach ($arrLangs as $lang) {
			if ($langIndex != $lang) {
				$fields .= "IF (`title".$lang."` != '', `title".$lang."`, ";
				$endExpr .= ")";
			}
		}

		$fields .= "''".$endExpr." AS `title`";
	} else {
		$fields = "`id`, `title".$langIndex."` AS `title`";
	}
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$categories = db_getFromDB("listingcategory", "category_id", 0, "all", "title", "object", SELECTED_DOMAIN_ID, false, $fields);
	if ($categories) {
		foreach ($categories as $category) {
			$valueArray[] = "";
			$nameArray[] = "---------------------------";
			$valueArray[] = $category->getNumber("id");
			if ($category->getString("title".$langIndex)) $nameArray[] = $category->getString("title".$langIndex);
			else $nameArray[] = $category->getString("title");
			$subcategories = db_getFromDB("listingcategory", "category_id", $category->getNumber("id"), "all", "title", "object", SELECTED_DOMAIN_ID, false, $fields);
			if ($subcategories) {
				foreach ($subcategories as $subcategory) {
					$valueArray[] = $subcategory->getNumber("id");
					if ($subcategory->getString("title".$langIndex)) $nameArray[] = "&nbsp;&nbsp;&nbsp;".$subcategory->getString("title".$langIndex);
					else $nameArray[] = "&nbsp;&nbsp;&nbsp;".$subcategory->getString("title");
				}
			}
		}
	}
	$valueArray[] = "";
	$nameArray[] = "---------------------------";
	$categoryDropDown = html_selectBox("category_id", $nameArray, $valueArray, $category_id, "", "class='input-dd-form-emailgenerate'", system_showText(LANG_LABEL_SELECT_CATEGORY));
	unset($valueArray);
	unset($nameArray);

	//LOCATION PROCESS
	$_locations = explode(",", EDIR_LOCATIONS);
	$_location_level = $_locations[0];

	$objLocationLabel = "Location".$_location_level;
	${"Location".$_location_level} = new $objLocationLabel;

	${"locations".$_location_level} = ${"Location".$_location_level}->retrieveAllLocation();

	function build_location_tree($_locations, $_location_level, $_location_father_level_id, &$valueArray, &$nameArray) {
		system_retrieveLocationRelationship ($_locations, $_location_level, $_location_father_level, $_location_child_level, $valueArray, $nameArray);
		$objLocationLabel = "Location".$_location_level;
		${"Location".$_location_level} = new $objLocationLabel;		
		${"Location".$_location_level}->SetString("location_".$_location_father_level, $_location_father_level_id);
		${"locations".$_location_level} = ${"Location".$_location_level}->retrieveLocationByLocation($_location_father_level);		
		if (${"locations".$_location_level}) {
			foreach (${"locations".$_location_level} as $each_location) {
				$numSpaces = array_search($_location_level, $_locations);				
				$strSpaces = "";
				if ($numSpaces)
					for ($j=0; $j<=$numSpaces; $j++)
						$strSpaces .= "&nbsp;&nbsp;.&nbsp;";

				$valueArray[] = "location_".$_location_level.":{$each_location["id"]}";
				$nameArray[] = $strSpaces.$each_location["name"];
				if ($_location_child_level)
					build_location_tree ($_locations, $_location_child_level, $each_location['id'], $valueArray, $nameArray);
			}
		}
	}

	if (${"locations".$_location_level}) {
		foreach (${"locations".$_location_level} as $each_location) {
			$valueArray[] = "";
			$nameArray[] = "---------------------------";
			$valueArray[] = "location_".$_location_level.":{$each_location["id"]}";
			$nameArray[] = "&nbsp;".$each_location["name"];

			system_retrieveLocationRelationship ($_locations, $_location_level, $_location_father_level, $_location_child_level, $valueArray, $nameArray);
			if ($_location_child_level)
				build_location_tree ($_locations, $_location_child_level, $each_location['id'], $valueArray, $nameArray);
		}		
	}

	$locationDropDown = html_selectBox("location", $nameArray, $valueArray, $location, "", "class='input-dd-form-emailgenerate'", system_showText(LANG_LABEL_SELECT_LOCATION));
	unset($valueArray);
	unset($nameArray);

	/**
	 * Form Defines
	 * Scheduled Listing Export
	 */
	$dbMain = db_getDBObject(DEFAULT_DB, true);
	$sqlExport = "SELECT finished, filename FROM Control_Export_Listing WHERE domain_id = ".SELECTED_DOMAIN_ID." AND type= 'csv - data'";
	$resExport = $dbMain->query($sqlExport);
	if(mysql_num_rows($resExport)){
		$export = mysql_fetch_assoc($resExport);
	}

	if($export["finished"] == "N" && LISTING_SCALABILITY_OPTIMIZATION == "on"){
		$exportFile = $export["filename"];
	}else{
		$exportFile = md5(uniqid(rand(), true)).".zip";
		if(LISTING_SCALABILITY_OPTIMIZATION == "on"){
			$exportedFileName = $export["filename"];
			$exportedFilePath = $exportFilePath."/".$exportedFileName;
			if (!$exportedFileName || !file_exists($exportedFilePath)) {
				$exportedFileName = "";
				$exportedFilePath = "";
			}
		}
	}
?>