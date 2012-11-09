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
	# * FILE: /functions/domain_funct.php
	# ----------------------------------------------------------------------------------------------------


    /**
	 * Return the number of active domain
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.	
     * @param object $db
     */
    function domain_returnTotal($db=false) {

        if (!$db){
            $db = db_getDBObject(DEFAULT_DB, true);
        }
        $sql = "SELECT count(id) as total FROM Domain WHERE status = 'A'";
        $result = $db->query($sql);
        $row = mysql_fetch_assoc($result);
        return (int)$row['total'];
    }

    /**
	 * Function to verify is one record already exists on second DB
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name domain_returnIfExistReg()
	 * @param integer $id
     * @param string $table
     * @param object $db
     */
	function domain_returnIfExistReg($id, $table, $db) {

        $sql = "SELECT id FROM ".$table." WHERE id = ".$id." LIMIT 1";
        $result = $db->query($sql);
        if (mysql_num_rows($result) > 0){
            return true;
        }else{
        	return false;	
        }        
	}

    /**
     * Return a dropdown containing all domains or, case exists only one domain, the domain id.
     * If the params are feeded, a post automatically is made for the option chosen.
     * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name domain_getDropDown()
	 * @param string $http_host
     * @param string $request_uri
     * @param integer $domain_id
     */
	function domain_getDropDown ($http_host = false, $request_uri = false, $query_string = false , $domain_id = false) {
		$http_host = str_replace(EDIRECTORY_FOLDER, "", $http_host);
       	$dbObj = db_getDBObject(DEFAULT_DB, true);
        $sql = "SELECT id, name, url FROM Domain WHERE status = 'A'";
		domain_checkDropDown();

		$sql .= " ORDER BY name";
        $result = $dbObj->query($sql);
        unset($dropDown);
        
        if (mysql_num_rows($result) > 1) {
            $dropDown .= "<select name=\"domain_id\" id=\"dropdownDomain\" ";
            if ($http_host && $request_uri){
            	$dropDown .= "onchange=\"changeDomainInfo(this.value, '".$http_host."', '".$request_uri."','".$query_string."','".(sess_getAccountIdFromSession()? "true" : "false")."');\"";
            }
            if (domain_checkDropDown()) $dropDown .= " disabled";
            $dropDown .= ">\n";

            while ($row = mysql_fetch_assoc($result)) {
                $aux = "";
                if ($domain_id) {
                     if ($domain_id == $row["id"] || $http_host == $row["url"]){
                     	 $aux = "selected=\"selected\"";
                     }
                } else {
                    if (SELECTED_DOMAIN_ID == $row["id"]){
                       $aux = "selected=\"selected\"";
                    }
                }
                $dropDown .= "<option value=\"".$row["id"]."\" $aux >".system_showTruncatedText($row["name"], 30)."</option>\n";
            }
            $dropDown .= "</select>\n";
            $return = $dropDown;
        } else {
            $row = mysql_fetch_assoc($result);
            $return = (int)$row['id'];
        }
        return $return;
    }

	/**
	 * Use this to verify if the domain dropdown must be disabled or not according to URL
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 7.8.00
	 * @package Classes
	 * @name domain_checkDropDown
	 * @access Public
	 * @return boolean
	 */
	function domain_checkDropDown(){

		$array_modules[] = "Listing";
		$array_modules[] = "Banner";
		$array_modules[] = "Event";
		$array_modules[] = "Classified";
		$array_modules[] = "Article";
		$array_modules[] = "Coupon";
		$array_modules[] = "Blog";
		$array_modules[] = "Category";
		$array_modules[] = "CustomInvoice";
		$array_modules[] = "Faq";
		$array_modules[] = "Pay";
		$array_modules[] = "Email";

		$openPMsmaccount = string_strpos($_SERVER["PHP_SELF"], "/smaccount/");
		$openPMsitemgrSearch = string_strpos($_SERVER["PHP_SELF"], "sitemgr/search.php");
		$openPMmembersPackage = string_strpos($_SERVER["PHP_SELF"], "order_package.php");

		$openPMview = string_strpos($_SERVER["PHP_SELF"], "/view") || (string_strpos($_SERVER["PHP_SELF"], "/report.php")) || (string_strpos($_SERVER["PHP_SELF"], "/index.php") && string_strpos($_SERVER["REQUEST_URI"], "?category_id"));
		$openPMedit = (isset($_GET["id"]) && $_GET["id"]!="") && !$openPMview && (!string_strpos($_SERVER["PHP_SELF"], "/report.php") && (!string_strpos($_SERVER["PHP_SELF"], "search")) && (!string_strpos($_SERVER["PHP_SELF"], "index")));
		string_strpos($_SERVER["PHP_SELF"], "/account/") ? $openPMview = false : "";
		string_strpos($_SERVER["PHP_SELF"], "/account/") ? $openPMedit = false : "";
		$openPMaddCustomInvoice = string_strpos($_SERVER["PHP_SELF"], "/custominvoice.php");
		$openPMaddPay = string_strpos($_SERVER["PHP_SELF"], "/pay.php");
		$openPMaddFaq = string_strpos($_SERVER["PHP_SELF"], "/faq.php");
		$openPMaddEmail = string_strpos($_SERVER["PHP_SELF"], "/email.php");
		$openPMaddType = string_strpos($_SERVER["PHP_SELF"], "/template.php");
		$openPMaddPackage = string_strpos($_SERVER["PHP_SELF"], "/package.php");
		$openPMPayment = string_strpos($_SERVER["PHP_SELF"], "/processpayment.php");
		$openPMPCustomPage = string_strpos($_SERVER["PHP_SELF"], "/custom.php");

		$openPMaddListing = (((string_strpos($_SERVER["PHP_SELF"], "listinglevel"))&&(!string_strpos($_SERVER["REQUEST_URI"], "?id")))||((string_strpos($_SERVER["PHP_SELF"], "listing.php"))&&(!string_strpos($_SERVER["REQUEST_URI"], "?id"))&&(!string_strpos($_SERVER["PHP_SELF"], "content")))&&!(isset($_GET["id"])&& $_GET["id"]!=""));
		$openPMaddBanner = string_strpos($_SERVER["PHP_SELF"], "add")&&!(isset($_GET["id"])&& $_GET["id"]!="");
		$openPMaddEvent = (((string_strpos($_SERVER["PHP_SELF"], "eventlevel"))&&(!string_strpos($_SERVER["REQUEST_URI"], "?id")))||((string_strpos($_SERVER["PHP_SELF"], "event.php"))&&(!string_strpos($_SERVER["REQUEST_URI"], "?id"))&&(!string_strpos($_SERVER["PHP_SELF"], "content")))&&!(isset($_GET["id"])&& $_GET["id"]!=""));
		$openPMaddClassified = (((string_strpos($_SERVER["PHP_SELF"], "classifiedlevel"))&&(!string_strpos($_SERVER["REQUEST_URI"], "?id")))||((string_strpos($_SERVER["PHP_SELF"], "classified.php"))&&(!string_strpos($_SERVER["REQUEST_URI"], "?id"))&&(!string_strpos($_SERVER["PHP_SELF"], "content")))&&!(isset($_GET["id"])&& $_GET["id"]!=""));
		$openPMaddArticle = ((string_strpos($_SERVER["PHP_SELF"], "articlelevel"))||((string_strpos($_SERVER["PHP_SELF"], "article.php"))&&(!string_strpos($_SERVER["REQUEST_URI"], "?id"))&&(!string_strpos($_SERVER["PHP_SELF"], "content")))&&!(isset($_GET["id"])&& $_GET["id"]!=""));
		$openPMaddCoupon = ((string_strpos($_SERVER["PHP_SELF"], "deal.php"))&&(!string_strpos($_SERVER["PHP_SELF"], "prefs/deal.php"))&&(!string_strpos($_SERVER["REQUEST_URI"], "?id")))&&!(isset($_GET["id"])&& $_GET["id"]!="");
		$openPMaddBlog = (((string_strpos($_SERVER["PHP_SELF"], "blog.php"))&&(!string_strpos($_SERVER["REQUEST_URI"], "?id")))&&!(isset($_GET["id"])&& $_GET["id"]!=""));
		$openPMaddCategory = (string_strpos($_SERVER["PHP_SELF"], "/category.php")&&!$openPMeditCategory&&(!string_strpos($_SERVER["PHP_SELF"], "review")));

		foreach ($array_modules as $module){
			if ((${"openPMadd".$module}) || ($openPMview) || ($openPMedit) || ($openPMsmaccount) || ($openPMsitemgrSearch) || ($openPMaddType) || $openPMaddPackage || $openPMPayment || $openPMPCustomPage || $openPMmembersPackage) {
				return true;
			}
		}

	}

	/**
	 * Use this to verify if a URL is valid
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 7.8.00
	 * @package Classes
	 * @name domain_validateDomainUrl
	 * @access Public
	 * @param varchar $url
	 * @return boolean
	 */
	function domain_validateDomainUrl ($url) {
		$url = str_replace("http://", "", $url);
		$url = str_replace("https://", "", $url);
		$url = str_replace("www.", "", $url);
		$pattern = "/^([[:alnum:]]|\-){1,}\.([[:alnum:]]|\-){1,}(\.[[:alnum:]]{1,}){0,}$/";
		if (preg_match($pattern, $url)) {
			return true;
		} else {
			return false;
		}
	}

	function domain_validateNavbarUrl ($url) {
		$pattern = "/^(http(s)?:\/\/)?(www\.)?[-a-z0-9+]{1,}\.[-a-z0-9+]{1,}(\.[-a-z0-9+]{1,})?(\.[a-z0-9]{2,4})?(:[0-9]{1,})?(\/[-a-z-A-Z0-9+&@#\/%?=~_|!:,.;]*)?$/i";
		//$pattern = "|^(http(s)?://)?[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
		if (preg_match($pattern, $url)) {
			return true;
		} else {
			return false;
		}
	}


	/*
	 * Function to get percentage to chart
	 */
	function domain_PercentageChart($values){
		unset($array_values,$total,$return_values);
		$array_values = explode(",", $values);
		/*
		 * Get total
		 */
		for($i=0;$i<count($array_values);$i++){
			$total += $array_values[$i];
		}

		for($i=0;$i<count($array_values);$i++){
			$return_values[] = round((100*$array_values[$i])/$total,2)."%";
		}

		if(count($return_values) > 0){
			return implode("|", $return_values);
		}else{
			return false;
		}
	}

	/*
	 * Function to get all information to dashboard for domains
	 */
	function domain_getDashboardInfo($domain_id = false){

		unset($dashboardInfo);
		$dashboardInfo = array();
		$db_main = db_getDBObject(DEFAULT_DB,true);
		$totalvisits = false;
		if ($domain_id){
			$totalvisits = true;
			$sql = "SELECT Dash.`domain_id`, SUM(Dash.`number_listings`) as number_listings, SUM(Dash.`number_content`) as number_content, SUM(Dash.`revenue`) as revenue FROM `Dashboard` AS Dash LEFT JOIN `Domain` AS D ON (Dash.`domain_id` = D.`id`) WHERE D.`status` = 'A' ORDER BY D.`name`";
		} else {
			$sql = "SELECT Dash.`domain_id`, Dash.`number_listings`, Dash.`number_content`, Dash.`revenue` FROM `Dashboard` AS Dash LEFT JOIN `Domain` AS D ON (Dash.`domain_id` = D.`id`) WHERE D.`status` = 'A' ORDER BY D.`name`";
		}
		$result = $db_main->query($sql);
		$i = 0;
		while($row = mysql_fetch_assoc($result)){
			$domain = new Domain($row["domain_id"]);

			$dashboardInfo[$i]["domain_name"]		= $domain->getString("name");
			$dashboardInfo[$i]["domain_id"]			= $row["domain_id"];
			$dashboardInfo[$i]["number_listings"]	= $row["number_listings"];
			$dashboardInfo[$i]["number_content"]	= $row["number_content"];
			$dashboardInfo[$i]["visits"]			= system_getMonthVisits($row["domain_id"], $totalvisits);
			$dashboardInfo[$i]["revenue"]			= $row["revenue"];
			$dashboardInfo[$i]["total"]				= $row["number_listings"] + $row["number_content"] + system_getMonthVisits($row["domain_id"]) + $row["revenue"];
			$i++;
		}
		return $dashboardInfo;

	}

	/**
	 * Use this to verify if the domain dropdown must be disabled or not according to URL
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 7.8.00
	 * @package Classes
	 * @name domain_updateDashboard
	 * @param int $item
	 * @access Public
	 */
	function domain_updateDashboard($item = "", $action = "", $value = 0, $domain_id = SELECTED_DOMAIN_ID){
		$db = db_getDBObject(DEFAULT_DB, true);
		if ($item == "revenue"){
			$sql = "UPDATE Dashboard SET $item = ($item + $value) WHERE domain_id = ".$domain_id;
		}else{
			if ($action == "inc"){
				$sql = "UPDATE Dashboard SET $item = ($item + 1) WHERE domain_id = ".$domain_id;
			} else {
				$sql = "UPDATE Dashboard SET $item = ($item - 1) WHERE domain_id = ".$domain_id;
			}
		}
		$db->query($sql);

	}


	function domain_ColorChart(&$color,$degree = 20){

		$red	= string_substr($color, 0, 2);
		$green	= string_substr($color, 2, 2);
		$blue	= string_substr($color, 4, 2);

		/*
		 * Hexadecimal
		 */
		$red_hex = hexdec($red);
		$green_hex = hexdec($green);
		$blue_hex = hexdec($blue);

		$color1[] = $red_hex;
		$color1[] = $green_hex;
		$color1[] = $blue_hex;

		for ( $x = 0; $x < 3; $x++ ){
            if ( ( $color1[$x] + $degree ) < 256 ){
                if ( ( $color1[$x] + $degree ) > -1 ){
                    $color1[$x] += $degree;
                } else {
                    $color1[$x] = 0;
                }
            } else {
                $color1[$x] = 255;
            }
        }
		unset($new_color);
		for($i=0;$i<count($color1);$i++){
			$new_color .= (strlen(dechex($color1[$i])) == 1 ? dechex($color1[$i]).dechex($color1[$i]) : dechex($color1[$i]));
		}
		$color = $new_color;
		
	}

	function domain_calculatePercentage($value, $total){
		if ($total!=0)
			return (($value*100)/$total);
		else return 0;

	}

	function domain_getPieChart($number_domains, $div_id, $array_names, $array_values, $array_colors, $width, $height, $percentage = true, $defaultcolor = "#FCFCFC", $gnumber){

		$str_color = "";
		$percentage ? $pieSliceText = "percentage" : $pieSliceText = "none";

		$total = array_sum($array_values);

		$script = "";

		$script .=	"<script type=\"text/javascript\">";
		$script .= "google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});";
		$script .= "google.setOnLoadCallback(drawChart".$gnumber.");";
		$script .= "function drawChart".$gnumber."() {";
		$script .= "	var data = new google.visualization.DataTable();";
		$script .= "	data.addColumn('string', '".system_showText(LANG_SITEMGR_DOMAIN_SING)."');";
		$script .= "	data.addColumn('number', '".system_showText(LANG_SITEMGR_REPORT_STATISTICCHART)."');";
		$script .= "	data.addRows(".$number_domains.");";
		for ($i = 0; $i < $number_domains; $i++){
			$script .= "	data.setValue(".$i.", 0, \"$array_names[$i]\");";
			$script .= "	data.setValue(".$i.", 1, $array_values[$i]);";
			if ($total!=0){
				//if (domain_calculatePercentage($array_values[$i], $total)>=0.1) { //use color only if the item is representative on graphic
					$str_color .= "'#$array_colors[$i]',";
				//}
			} else {
				$str_color .= "'#$array_colors[$i]',";
			}
		}
		
		$str_color = string_substr($str_color, 0, -1);
		$script .= "	var chart = new google.visualization.PieChart(document.getElementById('".$div_id."'));";
		$script .= "	chart.draw(data, {colors:[$str_color], width: $width, height: $height, legend: 'none', is3D: false, pieSliceText: '$pieSliceText', backgroundColor: '$defaultcolor', fontSize: 10});";
		$script .= "}";

		$script .= "</script>";

		return $script;
	}



	function domain_getLevelInfo($array_fields,$table_name,$domain_id = false){

		if($domain_id){
			$db_main = db_getDBObject(DEFAULT_DB,true);
			$db		 = db_getDBObjectByDomainID($domain_id, $db_main);
		}else{
			$db  = db_getDBObject();
		}

		$sql	= "SELECT ".(is_array($array_fields) ? implode(",", $array_fields) : $array_fields).", '".$table_name."' AS table_name FROM ".$table_name." WHERE theme = ".db_formatString(EDIR_THEME ? EDIR_THEME : "default")." AND active = 'y' ORDER BY value".($table_name != "BannerLevel" ? " DESC" : "");
		$result = $db->query($sql);
		if(mysql_num_rows($result)){
			unset($array_levels);
			while($row = mysql_fetch_assoc($result)){
				$array_levels[] = $row;
			}
			if(count($array_levels) > 0){
				return $array_levels;
			}else{
				return false;
			}
		} else {
			return false;
		}
	}


	function domain_getModulesEnabledByDomain($domain_id = false,$use_banner = false){
		/*
		 * Check constants
		 */
		unset($array_module_level);
		$array_fields[] = "value";
		$array_fields[] = "name";

		if($domain_id){
			unset($domainObj);
			$domainObj = new Domain($domain_id);
			$aux_domain_event_feature		= $domainObj->getString("event_feature");
			$aux_domain_banner_feature		= $domainObj->getString("banner_feature");
			$aux_domain_classified_feature	= $domainObj->getString("classified_feature");
			$aux_domain_article_feature		= $domainObj->getString("article_feature");


			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$dbObjCat = db_getDBObjectByDomainID($domain_id, $dbMain);

			$sql = "SELECT value from Setting WHERE name LIKE 'custom_event_feature'";
			$result = $dbObjCat->query($sql);
			$row = mysql_fetch_assoc($result);
			$aux_domain_custom_event_feature = $row['value'];

			$sql = "SELECT value from Setting WHERE name LIKE 'custom_classified_feature'";
			$result = $dbObjCat->query($sql);
			$row = mysql_fetch_assoc($result);
			$aux_domain_custom_classified_feature = $row['value'];

			$sql = "SELECT value from Setting WHERE name LIKE 'custom_article_feature'";
			$result = $dbObjCat->query($sql);
			$row = mysql_fetch_assoc($result);
			$aux_domain_custom_article_feature = $row['value'];

			$sql = "SELECT value from Setting WHERE name LIKE 'custom_banner_feature'";
			$result = $dbObjCat->query($sql);
			$row = mysql_fetch_assoc($result);
			$aux_domain_custom_banner_feature = $row['value'];

            @include(EDIRECTORY_ROOT.'/custom/domain_'.$domain_id.'/theme/theme.inc.php');
            
            if ($edir_theme == "realestate"){
                $aux_domain_custom_article_feature = "off";
                $aux_domain_custom_classified_feature = "off";
                $aux_domain_custom_event_feature = "off";
            }
            unset($edir_theme);


		} else {
			$aux_domain_event_feature				= EVENT_FEATURE;
			$aux_domain_banner_feature				= BANNER_FEATURE;
			$aux_domain_classified_feature			= CLASSIFIED_FEATURE;
			$aux_domain_article_feature				= ARTICLE_FEATURE;

			$aux_domain_custom_event_feature		= CUSTOM_EVENT_FEATURE;
			$aux_domain_custom_banner_feature		= CUSTOM_BANNER_FEATURE;
			$aux_domain_custom_classified_feature	= CUSTOM_CLASSIFIED_FEATURE;
			$aux_domain_custom_article_feature		= CUSTOM_ARTICLE_FEATURE;
		
		}

		if($aux_domain_event_feature == "on" && $aux_domain_custom_event_feature == "on"){
			/*
			 * Get Levels
			 */
			$array_module_level[LANG_SITEMGR_EVENT] = domain_getLevelInfo($array_fields,"EventLevel",$domain_id);
			
		}

		if($use_banner && $aux_domain_banner_feature == "on" && $aux_domain_custom_banner_feature == "on"){
			/*
			 * Get Levels
			 */
			$array_module_level[LANG_SITEMGR_BANNER] = domain_getLevelInfo($array_fields,"BannerLevel",$domain_id);
		}

		if($aux_domain_classified_feature == "on" && $aux_domain_custom_classified_feature == "on"){
			/*
			 * Get Levels
			 */
			$array_module_level[LANG_SITEMGR_CLASSIFIED] = domain_getLevelInfo($array_fields,"ClassifiedLevel",$domain_id);
		}

		if($aux_domain_article_feature == "on" && $aux_domain_custom_article_feature == "on"){
			/*
			 * Get Levels
			 */
			$array_module_level[LANG_SITEMGR_ARTICLE] = domain_getLevelInfo($array_fields,"ArticleLevel",$domain_id);
		}

		
		/*
		 * Get Levels to Listing
		 */
		$array_module_level[LANG_SITEMGR_LISTING] = domain_getLevelInfo($array_fields,"ListingLevel",$domain_id);
		

		if($array_module_level){
			return $array_module_level;
		}else{
			return false;
		}
		

	}


	function domain_DropDownModuleDomain($domain_id=false,$array_options=false,$use_banner=false){

		unset($array_modules_level,$array_dropdown_items);

		$array_modules_level = domain_getModulesEnabledByDomain($domain_id,$use_banner);

		$j = 0;

		unset($aux_compare_domains);
		
		foreach ($array_modules_level as $key => $value) {
			
			for($i=0;$i<count($value);$i++){

				/*
				 * Get type of item
				 */
				unset($aux_key);
				if($value[$i]["table_name"] == "EventLevel"){
					$aux_key = "event";
				}elseif($value[$i]["table_name"] == "ArticleLevel"){
					$aux_key = "article";
				}elseif($value[$i]["table_name"] == "BannerLevel" && $use_banner){
					$aux_key = "banner";
				}elseif($value[$i]["table_name"] == "ClassifiedLevel"){
					$aux_key = "classified";
				}elseif($value[$i]["table_name"] == "ListingLevel"){
					$aux_key = "listing";
				}


				if($aux_compare_domains){
					echo $aux_key."_".$value[$i]["value"]."<br />";
					if(in_array($aux_key."_".$value[$i]["value"], $array_options)){
						$array_dropdown_items[$j]["label"]  = ucfirst($key).($value[$i]["table_name"] == "ArticleLevel" ? "" :" - ".ucfirst($value[$i]["name"]));
						$array_dropdown_items[$j]["option_id"] = $aux_key."_".$value[$i]["value"];
					}
				}else{
					$array_dropdown_items[$j]["label"]  = ucfirst($key).($value[$i]["table_name"] == "ArticleLevel" ? "" :" - ".ucfirst($value[$i]["name"]));
					$array_dropdown_items[$j]["option_id"] = $aux_key."_".$value[$i]["value"];
				}
				
				$j++;
			}
			
		}
		if(count($array_dropdown_items) > 0){
			return $array_dropdown_items;
		}else{
			return false;
		}

	}


	function domain_CommonModuleLevel($array_domains,$array_options,$use_banner = false){
	
		$str = "";
		if(is_array($array_domains)){
			unset($domain_options);
			$domain_options = array();
			for($i=0;$i<count($array_domains);$i++){
				if(array_key_exists("id", $array_domains[$i])){
					unset($aux_array_options,$array_options_diff, $array_aux);

					/*
					 * Get options of module and level that exists on $array_options
					 */

					$aux_array_options  = domain_DropDownModuleDomain($array_domains[$i]["id"],$array_options, $use_banner);

					for ($j=0; $j<count($aux_array_options); $j++){
						${"array_aux_".$i}[] = $aux_array_options[$j]["option_id"];
					}
					/*
					 * Add items that doesn't exist on $domain_options
					 */
//					$array_options_diff = array_diff($aux_array_options, $domain_options);
//					if(is_array($array_options_diff) && count($array_options_diff)){
//						$domain_options = array_merge($domain_options,$array_options_diff);
//					}

					$str .= "\$array_aux_{$i}, ";
				}
			}
			if (count($array_domains)>1){
			$str = string_substr($str, 0, -2);
			eval("\$array_common = array_intersect($str);");

			$i=0;
			foreach($array_common as $info){
				if (string_strpos($info, "listing") !== false){
					$domain_options[$i]["option_id"] = $info;
					$level = explode("_",$info);
					$levelObj = new ListingLevel();
					$domain_options[$i]["label"] = LANG_LISTING_FEATURE_NAME." - ".ucfirst($levelObj->getName($level[1]));
				}

				if (string_strpos($info, "event") !== false){
					$domain_options[$i]["option_id"] = $info;
					$level = explode("_",$info);
					$levelObj = new EventLevel();
					$domain_options[$i]["label"] = LANG_EVENT_FEATURE_NAME." - ".ucfirst($levelObj->getName($level[1]));
				}

				if (string_strpos($info, "article") !== false){
					$domain_options[$i]["option_id"] = $info;
					$level = explode("_",$info);
					$levelObj = new ArticleLevel();
					$domain_options[$i]["label"] = LANG_ARTICLE_FEATURE_NAME;
				}

				if (string_strpos($info, "classified") !== false){
					$domain_options[$i]["option_id"] = $info;
					$level = explode("_",$info);
					$levelObj = new ClassifiedLevel();
					$domain_options[$i]["label"] = LANG_CLASSIFIED_FEATURE_NAME." - ".ucfirst($levelObj->getName($level[1]));
				}

				if ((string_strpos($info, "banner") !== false) && $use_banner){
					$domain_options[$i]["option_id"] = $info;
					$level = explode("_",$info);
					$levelObj = new BannerLevel();
					$domain_options[$i]["label"] = LANG_BANNER_FEATURE_NAME." - ".ucfirst($levelObj->getName($level[1]));
				}
				$i++;
			}
			} else {
				$domain_options = $aux_array_options;
			}
			if(is_array($domain_options)){
				
				if(is_array($domain_options)){
					return $domain_options;
				}else{
					return false;
				}
				
			}
			
		}
	}


	function domain_saveLogForPackageItems($package_id, $posted_items, $SMAccount){
		if($package_id && $posted_items && $SMAccount){
			
			/*
			 * Get old items of package
			 */
			unset($packageItemObj);
			$packageItemObj = new PackageItems();
			$array_items = $packageItemObj->getItemsByPackageId($package_id);
			
			if(is_array($array_items)){
				unset($array_old_items);
				for($i=0;$i<count($array_items);$i++){
					$array_old_items[] = "Module: ".$array_items[$i]["module"]." Level: ".($array_items[$i]["level"] ? $array_items[$i]["level"] : "No level")." Price: ".$array_items[$i]["price"]." For Domain: ".($array_items[$i]["domain_id"] ? $array_items[$i]["domain_id"] : "All");
				}
				$old_items = implode(" || ",$array_old_items);
			}else{
				$old_items = "";
			}
			
			/*
			 * Get posted items
			 */
			if(is_array($posted_items)){
				unset($array_new_items);
				for($i=0;$i<count($posted_items);$i++){
					$array_new_items[] = "Module: ".$posted_items[$i]["module"]." Level: ".($posted_items[$i]["level"] ? $posted_items[$i]["level"] : "No level")." Price: ".$posted_items[$i]["price"]." For Domain: ".($posted_items[$i]["domain_id"] ? $posted_items[$i]["domain_id"] : "All");
				}
				$new_items = implode(" || ",$array_new_items);
			}else{
				$new_items = $posted_items;
			}

			/*
			 * Save log
			 */
			$dbMain = db_getDBObject(DEFAULT_DB,true);
			$sql = "INSERT INTO PackageItemsLOG (package_id,old_items,new_items,updated,smaccount) VALUES (".$package_id.",'".$old_items."','".$new_items."',NOW(),'".$SMAccount."')";
			$dbMain->query($sql);

			/*
			 * Delete items of this package
			 */
			if($packageItemObj->DeleteItemsByPackageID($package_id)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function domain_numberPackages($constantFile = false, $module, $level){
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$sql = "SELECT id FROM Package WHERE parent_domain = ".SELECTED_DOMAIN_ID." AND module = '".$module."' AND level ='".$level."' AND status = 'A'";
		$r = $dbMain->query($sql);
		$lines = mysql_num_rows($r);
		return $lines;
	}



	function domain_findConstants($word, $domain, $constantFile = false){
		if (!$domain || !$word) {
			return false;
		}

		if (!$constantFile) $constantFile = EDIRECTORY_ROOT."/custom/domain_$domain/conf/constants.inc.php";

		if (file_exists($constantFile)){
			$fp = fopen($constantFile, 'r');
			if ($fp && filesize($constantFile)){
				$phptext = file_get_contents($constantFile);
				$startPos=string_strpos($phptext,$word);

				$text1=string_substr($phptext,$startPos,string_strlen($phptext));

				$text2=string_substr($text1,0,string_strpos($text1,");"));
				$text2=str_replace("'",'',$text2);
				$text2=str_replace('"','',$text2);
				$text2ARR=explode(',',$text2);
				return trim($text2ARR[1]);
			} else{
				return false;
			}
		} else {
			return false;
		}

	}

	function domain_SaveAccountInfoDomain($aux_account, $object){
		if(is_numeric(str_replace("'","",$object->domain_id))){
			$accDomain = new Account_Domain($aux_account, str_replace("'","",$object->domain_id));
		}else{
			$accDomain = new Account_Domain($aux_account, SELECTED_DOMAIN_ID);
		}
		$accDomain->Save();
		$accDomain->saveOnDomain($aux_account, $object);
	}


	function domain_BreadCrumb() {

		unset($array_path);

		if (!string_strpos($_SERVER["SCRIPT_FILENAME"], "login.php")
		    && !string_strpos($_SERVER["SCRIPT_FILENAME"], "signup")) {

			$path = string_substr($_SERVER["REQUEST_URI"], string_strpos($_SERVER["REQUEST_URI"], "/members/") + 9);

			$aux_array_functions = array(
				system_showText(LANG_LABEL_EDIT),
				system_showText(LANG_MENU_MANAGE),
				system_showText(LANG_MENU_CREATE),
				system_showText(LANG_LABEL_VIEW),
				system_showText(LANG_MENU_FAQ),
				system_showText(LANG_BUTTON_HELP),
				system_showText(LANG_MENU_SITEMAP),
				system_showText(LANG_LABEL_DELETE),
				system_showText(LANG_LABEL_PAY),
				system_showText(LANG_LABEL_STATUS),
				system_showText(LANG_LABEL_TRAFFIC));
			$array_path = explode("/", $path);

			$breadcrumb = array();
			if (count($array_path) > 0) {
				for ($i = 0; $i < count($array_path); $i++) {
					// View
					if (string_strpos($array_path[$i], "view.php") !== false || string_strpos($array_path[$i], "report.php") !== false || string_strpos($array_path[$i], "reviews.php") !== false || string_strpos($array_path[$i], "quicklists.php") !== false || string_strpos($array_path[$i], "deals.php") !== false) {
						$breadcrumb[] = $aux_array_functions[3];
					}
					// Delete
					elseif (string_strpos($array_path[$i], "delete.php") !== false) {
						$breadcrumb[] = $aux_array_functions[7];
					}
					// Edit
					elseif (   (   string_strpos($array_path[$i], "id=") !== false
					            || string_strpos($array_path[$i], "account.php") !== false)
					        && (string_strpos($array_path[$i], "order_package.php") === false ) && (string_strpos($array_path[$i], "template_id=") === false ) && (string_strpos($array_path[$i], "listing_id=") === false ) && (string_strpos($_SERVER["PHP_SELF"], "review") === false ) ) {
						$breadcrumb[] = $aux_array_functions[0];
					}
					// Manage
					elseif (string_strpos($array_path[$i], "index.php") !== false) {
						$breadcrumb[] = $aux_array_functions[1];
					}
					// FAQ
					elseif (string_strpos($array_path[$i], "faq.php") !== false) {
						$breadcrumb[] = $aux_array_functions[4];
					}
					// Help
					elseif (string_strpos($array_path[$i], "help.php") !== false) {
						$breadcrumb[] = $aux_array_functions[5];
					}
					// Sitemap
					elseif (string_strpos($array_path[$i], "sitemap.php") !== false) {
						$breadcrumb[] = $aux_array_functions[6];
					}
					// Pay
					elseif (string_strpos($array_path[$i], "pay.php") !== false) {
						$breadcrumb[] = $aux_array_functions[8];
					}
					// Transaction Status
					elseif (string_strpos($array_path[$i], "processpayment.php") !== false) {
						$breadcrumb[] = $aux_array_functions[9];
					}
					// Add
					elseif (string_strpos($array_path[$i], ".php")) {
						$breadcrumb[] = $aux_array_functions[2];
					}
					// ...
					else {

						if ($array_path[$i] == LISTING_FEATURE_FOLDER){
							$breadcrumb[] = system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);
						} else if ($array_path[$i] == PROMOTION_FEATURE_FOLDER) {
							$breadcrumb[] = system_showText(LANG_PROMOTION_FEATURE_NAME_PLURAL);
						} else if ($array_path[$i] == BANNER_FEATURE_FOLDER){
							$breadcrumb[] = system_showText(LANG_BANNER_FEATURE_NAME_PLURAL);
						} else if ($array_path[$i] == EVENT_FEATURE_FOLDER){
							$breadcrumb[] = system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);
						} else if ($array_path[$i] == CLASSIFIED_FEATURE_FOLDER){
							$breadcrumb[] = system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL);
						} else if ($array_path[$i] == ARTICLE_FEATURE_FOLDER){
							$breadcrumb[] = system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL);
						} else if ($array_path[$i] == "billing"){
							$breadcrumb[] = system_showText(LANG_LABEL_PAYMENT);
						} else if ($array_path[$i] == "transactions"){
							$breadcrumb[] = system_showText(LANG_MENU_TRANSACTIONHISTORY);
						} else if ($array_path[$i] == "invoices"){
							$breadcrumb[] = system_showText(LANG_MENU_INVOICEHISTORY);
						} else if ($array_path[$i] == "account"){
							$breadcrumb[] = system_showText(LANG_BUTTON_MANAGE_ACCOUNT);
						} else if ($array_path[$i] == "review"){
							$breadcrumb[] = system_showText(LANG_REVIEW_PLURAL);
						}else {
							$breadcrumb[] = string_ucwords($array_path[$i]);
						}
					}
				}
			}

			// Manage *
			if (count($breadcrumb) > 0) {
				if (!in_array($breadcrumb[count($breadcrumb) - 1], $aux_array_functions)) {
					if (trim($breadcrumb[count($breadcrumb) - 1]) == "")
						$breadcrumb[count($breadcrumb) - 1] = $aux_array_functions[1];
					else
						$breadcrumb[] = $aux_array_functions[1];
				}
			}

			/**
			 * Get Domain name
			 */
			unset($domainObj);
			$domainObj = new Domain(SELECTED_DOMAIN_ID);

			$aux_link = DEFAULT_URL . "/members/";

			$aux_breadcrumb = "<a href='" . $aux_link . "'>" . system_showText(LANG_BUTTON_HOME) . "</a> / ";
			$aux_breadcrumb .= "<a href='" . $aux_link . "'>" . $domainObj->getString("name") . "</a> " . (count($breadcrumb) >= 1 ? " / " : "");

			for ($i = 0; $i < count($breadcrumb); $i++) {
				if ($i == (count($breadcrumb) - 1)) {
					$aux_breadcrumb .= $breadcrumb[$i];
				} else {

					if ($breadcrumb[$i] == LANG_LISTING_FEATURE_NAME_PLURAL){
						$aux_link .= LISTING_FEATURE_FOLDER . "/";
					} else if ($breadcrumb[$i] == LANG_PROMOTION_FEATURE_NAME_PLURAL) {
						$aux_link .= PROMOTION_FEATURE_FOLDER . "/";
					} else if ($breadcrumb[$i] == LANG_BANNER_FEATURE_NAME_PLURAL){
						$aux_link .= BANNER_FEATURE_FOLDER . "/";
					} else if ($breadcrumb[$i] == LANG_EVENT_FEATURE_NAME_PLURAL){
						$aux_link .= EVENT_FEATURE_FOLDER . "/";
					} else if ($breadcrumb[$i] == LANG_CLASSIFIED_FEATURE_NAME_PLURAL){
						$aux_link .= CLASSIFIED_FEATURE_FOLDER . "/";
					} else if ($breadcrumb[$i] == LANG_ARTICLE_FEATURE_NAME_PLURAL){
						$aux_link .= ARTICLE_FEATURE_FOLDER . "/";
					} else if ($breadcrumb[$i] == LANG_LABEL_PAYMENT){
						$aux_link .= "billing" . "/";
					} else if ($breadcrumb[$i] == LANG_MENU_TRANSACTIONHISTORY){
						$aux_link .= "transactions" . "/";
					} else if ($breadcrumb[$i] == LANG_MENU_INVOICEHISTORY){
						$aux_link .= "invoices" . "/";
					} else if ($breadcrumb[$i] == LANG_BUTTON_MANAGE_ACCOUNT){
						$aux_link .= "account" . "/account.php";
					} else if ($breadcrumb[$i] == LANG_REVIEW_PLURAL){
						$aux_link .= "review" . "/index.php?".$_SERVER["QUERY_STRING"];
					} else {
						$aux_link .= string_strtolower($breadcrumb[$i]) . "/";
					}

					//$aux_link .= string_strtolower($breadcrumb[$i]) . "/";
					$aux_breadcrumb .= "<a href='" . $aux_link . "'>" . $breadcrumb[$i] . "</a> / ";
				}
			}

			return $aux_breadcrumb;
		}
	}

	function domain_getDomainList($http_host = false , $domain_id = false) {
		$http_host	= str_replace(EDIRECTORY_FOLDER, "", $http_host);
       	$dbObj		= db_getDBObject(DEFAULT_DB, true);
        $sql = "SELECT id, name, url FROM Domain WHERE status = 'A'";
		domain_checkDropDown();

		$sql .= " ORDER BY name";
        $result = $dbObj->query($sql);
        unset($dropDown);

		unset($array_domains);
        if (mysql_num_rows($result) > 1) {
			
            $array_domains = array();
			$i = 0;
			while ($row = mysql_fetch_assoc($result)) {
				unset($aux);
				if($domain_id){
					if($domain_id == $row["id"] || $http_host == $row["url"]){
						$aux = true;
					}
				}else{
					if(SELECTED_DOMAIN_ID == $row["id"]){
						$aux = true;
					}

				}
				$array_domains[$i]["domain_title"]    = system_showTruncatedText($row["name"], 30);
				$array_domains[$i]["domain_id"]       = $row["id"];
				$array_domains[$i]["domain_selected"] = $aux;
				$i++;
			}

			return $array_domains;
			/*

			$dropDown .= "<select name=\"domain_id\" id=\"dropdownDomain\" ";
            if ($http_host && $request_uri){
            	$dropDown .= "onchange=\"changeDomainInfo(this.value, '".$http_host."', '".$request_uri."','".$query_string."','".(sess_getAccountIdFromSession()? "true" : "false")."');\"";
            }
            if (domain_checkDropDown()) $dropDown .= " disabled";
            $dropDown .= ">\n";

            while ($row = mysql_fetch_assoc($result)) {
                $aux = "";
                if ($domain_id) {
                     if ($domain_id == $row["id"] || $http_host == $row["url"]){
                     	 $aux = "selected";
                     }
                } else {
                    if (SELECTED_DOMAIN_ID == $row["id"]){
                        $aux = "selected";
                    }
                }
                $dropDown .= "<option value=\"".$row["id"]."\" $aux >".system_showTruncatedText($row["name"], 30)."</option>\n";
            }
            $dropDown .= "</select>\n";
            $return = $dropDown;
			 *
			 */
        } else {
            $row = mysql_fetch_assoc($result);
            $return = (int)$row['id'];
        }
        return $return;
    }
?>