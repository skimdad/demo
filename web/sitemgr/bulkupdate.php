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
	# * FILE: /sitemgr/bulkupdate.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");
	
	extract($_GET);
	unset($arrayNameRC);
	unset($arrayValueRC);
	$arrayNameRC  = array();
	$arrayValueRC = array();

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	header("Accept-Encoding: gzip, deflate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check", FALSE);
    header("Pragma: no-cache");
	
	if ($delete == "true") {

		$removeCatDropDown = "<select disabled id=\"removecategory\" name=\"removecategory\"  class='input-dd-form-listing'><option>-- ".LANG_LABEL_SELECT_CATEGORY." --</option></select>";
		
	} else if ($ids) {
		
		$dbObjNew = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObjNew);
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		$array_Ids = explode(",", $ids);
		
		if ($type != "banner") {
			$type = ucfirst($type);
			if($type == "Listing"){
				$sql = "select category_id,listing_id from Listing_Category where listing_id in (".$ids.") order by listing_id";

				$idsT = explode(",",$ids);
				$catEmpty = false;
				foreach ($idsT as $idT){
					$sqlT = "SELECT category_id,listing_id FROM Listing_Category WHERE listing_id = $idT ORDER BY listing_id";
					$resultT = $dbObj->query($sqlT);
					$rowT = mysql_fetch_assoc($resultT);
					if (!$rowT) $catEmpty = true;
				}

			}else{

				$sql = "SELECT cat_1_id, cat_2_id, cat_3_id, cat_4_id, cat_5_id"
				  ." FROM $type"
				  ." WHERE id IN (".$ids.") ";

				$idsT = explode(",",$ids);
				$catEmpty = false;
				foreach ($idsT as $idT){
					$sqlT = "SELECT cat_1_id, cat_2_id, cat_3_id, cat_4_id, cat_5_id"
						." FROM $type"
						." WHERE id = $idT";
					$resultT = $dbObj->query($sqlT);
					$rowT = mysql_fetch_assoc($resultT);
					if (!$rowT) $catEmpty = true;
				}
			}
			
			$result = $dbObj->query($sql);
			$i = 0;
			
			if($type == "Listing"){
				unset($aux_array_categories);
				$aux_array_categories = array();
				$aux_listing_id = 0;
				while($row = mysql_fetch_assoc($result)){
					if($aux_listing_id != $row["listing_id"]){

						$aux_listing_id = $row["listing_id"];
						if(count($aux_array_categories) > 0){
							$array_category[$i] = $aux_array_categories;
							$i++;
							unset($aux_array_categories);
							$aux_array_categories = array();
						}
						
					}
					
					$aux_array_categories[] = $row["category_id"];
					
				}

				/**
				 * Get categories for last Listing_Id
				 */
				$array_category[$i] = $aux_array_categories;
			}else{
			
				while ($row = mysql_fetch_assoc($result)) {
					$array_category[$i] = $row;
					$i++;
				}
			}
			$length = count($array_category);

			if ($length == 1) {
				$array_categories =  $array_category[0];
			} elseif ($length != 0) {

				for ($i = 0; $i < $length; $i++) {
					$str .= "\$array_category[$i], ";
				}

				$str = string_substr($str, 0, -2);

				eval("\$array_categories = array_intersect($str);");
			}

			$strCatId = "";
			for ($i = 1; $i <= MAX_CATEGORY_ALLOWED; $i++) {
				if($type == "Listing"){
					if ($array_categories[$i-1]) {
						if ($array_categories[$i-1] != "0") {
							$strCatId .= $array_categories[$i-1].", ";
						}
					}
				}else{

					if ($array_categories['cat_'.$i.'_id']) {
						if ($array_categories['cat_'.$i.'_id'] != "0") {
							$strCatId .= $array_categories['cat_'.$i.'_id'].", ";
						}
					}
				}
			}
			
			$no_category = false;
			if ($strCatId) {
				$strCatId = string_substr($strCatId, 0, string_strlen($strCatId)-2);

				$sql = "SELECT id, title$langIndex"
					  ." FROM ".$type."Category"
					  ." WHERE id IN (".$strCatId.") ";

				$result = $dbObj->query($sql);

				while ($row = mysql_fetch_assoc($result)) {
					$arrayNameRC[] = $row["title$langIndex"];
					$arrayValueRC[] = $row["id"];
				}
				if (count($arrayNameRC)) {
					$array[] = "--------------------------------------------------";
					$arrayNameRC = array_merge($array, $arrayNameRC);
					$arrayValueRC = array_merge($array, $arrayValueRC);
				}

			} else if (!$strCatId && count($array_Ids) == 1) {
				$no_category = true;
			}
		}
		
		
		$removeCatDropDown = html_selectBox("removecategory", $arrayNameRC, $arrayValueRC, "", "", "class='input-dd-form-listing'", "-- ".system_showText(LANG_LABEL_SELECT_CATEGORY)." --");
		if ($no_category) {
			$removeCatDropDown = LANG_SITEMGR_NO_CATEGORY;
		} elseif (!$arrayValueRC || $catEmpty) {
			$removeCatDropDown = LANG_SITEMGR_NO_CATEGORY_IN_COMMON;
		}
	}
	echo $removeCatDropDown;