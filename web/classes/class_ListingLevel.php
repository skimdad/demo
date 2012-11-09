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
	# * FILE: /classes/class_ListingLevel.php
	# ----------------------------------------------------------------------------------------------------

	class ListingLevel {

		##################################################
		# PRIVATE
		##################################################

		var $default;
		var $value;
        var $name;
		var $detail;
		var $images;
		var $has_promotion;
		//TODO: MavenCrew
		var $has_mobile_application;
        var $has_review;
        var $has_sms;
        var $has_call;
        var $backlink;
		var $price;
		var $free_category;
		var $category_price;
		var $free_deal;
		var $extra_deal_price;		
		var $content;
		var $lang;
        var $active;

		function ListingLevel($lang = EDIR_DEFAULT_LANGUAGE, $listAll = false, $domain_id = false) {
			$this->lang = $lang;
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id) {
				$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
			} else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
            
			unset($dbMain);
            
            $sql = "";
            
            if (!defined("ALL_LISTINGLEVEL_INFORMATION") || !defined("ACTIVE_LISTINGLEVEL_INFORMATION")) {
               $sql = "SELECT * FROM ListingLevel WHERE theme = ".db_formatString(EDIR_THEME ? EDIR_THEME : "default")." ORDER BY value DESC";
            }
            
            if ($sql != "") {
                $result = $dbObj->query($sql);
                unset($listingLevelAux);
                unset($listingLevelAuxAll);
                $i = 0;
                $j = 0;
                while ($row = mysql_fetch_assoc($result)) {
                    foreach ($row as $key => $value) {
                        if ($row["active"] == "y"){
                            if ($key == "defaultlevel" && $value == "y") $listingLevelAuxAll[$j]["default"] = $row["value"];
                            $listingLevelAuxAll[$j][$key] = $value;
                            
                        } 
                        if ($key == "defaultlevel" && $value == "y") $listingLevelAux[$i]["default"] = $row["value"];
                        $listingLevelAux[$i][$key] = $value; 
                    }
                    $i++;
                    $j++;
                }
            }

            if (is_array($listingLevelAux)) {
                if (!defined("ALL_LISTINGLEVEL_INFORMATION")) {
                    define("ALL_LISTINGLEVEL_INFORMATION", serialize($listingLevelAux));
                }
            }
            
            if (is_array($listingLevelAuxAll)) {
                if (!defined("ACTIVE_LISTINGLEVEL_INFORMATION")) {
                    define("ACTIVE_LISTINGLEVEL_INFORMATION", serialize($listingLevelAuxAll));
                }
            }

            if ($listAll) {
                $listingLevelAux = unserialize(ALL_LISTINGLEVEL_INFORMATION);
            } else {
                $listingLevelAux = unserialize(ACTIVE_LISTINGLEVEL_INFORMATION);
            }

            if (is_array($listingLevelAux)) {
                foreach ($listingLevelAux as $listingLevel) {
                    if ($listingLevel["defaultlevel"] == "y") $this->default = $listingLevel["value"];
                    $this->value[] = $listingLevel["value"];
                    $this->name[] = $listingLevel["name"];
                    $this->detail[] = $listingLevel["detail"];
                    $this->images[] = $listingLevel["images"];
                    $this->has_promotion[] = $listingLevel["has_promotion"];
                    //TODO: MavenCrew
                    $this->has_mobile_application[] = $listingLevel["has_mobile_application"];
                    $this->has_review[] = $listingLevel["has_review"];
                    $this->has_sms[] = $listingLevel["has_sms"];
                    $this->has_call[] = $listingLevel["has_call"];
                    $this->backlink[] = $listingLevel["backlink"];
                    $this->price[] = $listingLevel["price"];
                    $this->free_category[] = $listingLevel["free_category"];
                    $this->category_price[] = $listingLevel["category_price"];
                    $this->free_deal[] = $listingLevel["free_deal"];
                    $this->extra_deal_price[] = $listingLevel["extra_deal_price"];
                    $this->active[] = $listingLevel["active"];

                }
            }
		}

		function getValues() {
			return $this->value;
		}

		function getNames() {
			return $this->name;
		}

		function union($key, $value) {
			for ($i=0; $i<count($key); $i++) {
				$aux[$key[$i]] = $value[$i];
			}
			return $aux;
		}

		function getValueName() {
			return $this->union($this->getValues(), $this->getNames());
		}

		function getDefault() {
            $activeArray =  array_filter($this->union($this->value, $this->active), 'validateActive');
            if(array_key_exists($this->default, $activeArray)) {
                return $this->default;
            } else {
                krsort($activeArray);
                $newActiveArray = array_keys($activeArray);
                return $newActiveArray[0];
            }
		}

		function getName($value) {
			if (is_numeric($value)){
				$value_name = $this->getValueName();
				return $value_name[$value];
			}
		}

		##################################################
		# PRIVATE
		##################################################

		##################################################
		# PUBLIC
		##################################################

		function getLevel($value) {
			if ($this->getName($value)) return $this->getName($value);
			else return $this->getLevel($this->getDefaultLevel());
		}

		function getDetail($value) {
			$detailArray = $this->union($this->value, $this->detail);
			if (isset($detailArray[$value])) return $detailArray[$value];
			else return $detailArray[$this->default];
		}
        
        function getBacklink($value) {
			$backlinkArray = $this->union($this->value, $this->backlink);
			if (isset($backlinkArray[$value])) return $backlinkArray[$value];
			else return $backlinkArray[$this->default];
		}

		function getImages($value) {
			$imagesArray = $this->union($this->value, $this->images);
			if (isset($imagesArray[$value])) return $imagesArray[$value];
			else return $imagesArray[$this->default];
		}

		function getHasPromotion($value) {
			$haspromotionArray = $this->union($this->value, $this->has_promotion);
			if (isset($haspromotionArray[$value])) return $haspromotionArray[$value];
			else return $haspromotionArray[$this->default];
		}
        
		//TODO: MavenCrew - HasMobileApp
		function getHasMobileApp($value){
			$hasmobileAppArray = $this->union($this->value, $this->has_mobile_application);
			if (isset($hasmobileAppArray[$value])) return $hasmobileAppArray[$value];
			else return $hasmobileAppArray[$this->default];
		}
		
        function getHasReview($value) {
			$hasreviewArray = $this->union($this->value, $this->has_review);
			if (isset($hasreviewArray[$value])) return $hasreviewArray[$value];
			else return $hasreviewArray[$this->default];
		}
		
		function getHasSms($value) {
			$hassmsArray = $this->union($this->value, $this->has_sms);
			if (isset($hassmsArray[$value])) return $hassmsArray[$value];
			else return $hassmsArray[$this->default];
		}
		
		function getHasCall($value) {
			$hascallArray = $this->union($this->value, $this->has_call);
			if (isset($hascallArray[$value])) return $hascallArray[$value];
			else return $hascallArray[$this->default];
		}

		function getPrice($value) {
			$priceArray = $this->union($this->value, $this->price);
			if (isset($priceArray[$value])) return $priceArray[$value];
			else return $priceArray[$this->default];
		}

		function getFreeCategory($value) {
			$freeCategoryArray = $this->union($this->value, $this->free_category);
			if (isset($freeCategoryArray[$value])) return $freeCategoryArray[$value];
			else return $freeCategoryArray[$this->default];
		}

		function getCategoryPrice($value) {
			$categoryPriceArray = $this->union($this->value, $this->category_price);
			if (isset($categoryPriceArray[$value])) return $categoryPriceArray[$value];
			else return $categoryPriceArray[$this->default];
		}

		function getFreeDeal($value) {
			$freeDealArray = $this->union($this->value, $this->free_deal);
			if (isset($freeDealArray[$value])) return $freeDealArray[$value];
			else return $freeDealArray[$this->default];
		}

		function getExtraDealPrice($value) {
			$extraDealPriceArray = $this->union($this->value, $this->extra_deal_price);
			if (isset($extraDealPriceArray[$value])) return $extraDealPriceArray[$value];
			else return $extraDealPriceArray[$this->default];
		}
		
		
		function getContent($value) {
			
			$contentArray = $this->union($this->value, $this->content);
			
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}

			unset($dbMain);
			$sql   = "SELECT content FROM ListingLevel_Lang WHERE value='$value' AND lang='$this->lang' AND theme = ".db_formatString(EDIR_THEME ? EDIR_THEME : "default")."";
			$result = $dbObj->query($sql);
			if (mysql_numrows($result)) {
				return mysql_result($result, 0, "content");
			} else {
				return "";
			}
				
			if (isset($contentArray[$value])) return $contentArray[$value];
			else return $contentArray[$this->default];
			
		}

		function getDefaultLevel() {
			return $this->getDefault();
		}

		function getLevelValues() {
			return $this->getValues();
		}

		function getLevelNames() {
			return $this->getNames();
		}

		function showLevel($value) {            
			if ($this->getName($value)) return string_ucwords($this->getName($value));
            else return string_ucwords($this->getLevel($this->getDefaultLevel()));
		}

		function showLevelNames() {
			$names = $this->getNames();
			foreach ($names as $name) {
				$array[] = string_ucwords($name);
			}
			return $array;
		}

        function getActive($value) {
            $activeArray = $this->union($this->value, $this->active);
            return $activeArray[$value];
        }
        
        function getLevelActive($value) {
            if ($this->getActive($value) == 'y') return $value;
            else return $this->getDefaultLevel();
        }
        
        function getLevelOrdering($value) {
            switch ( $value ) {
                case 10:
                    return system_showText(LANG_SITEMGR_FIRST);
                    break;
                case 30:
                    return system_showText(LANG_SITEMGR_SECOND);
                    break;
                case 50:
                    return system_showText(LANG_SITEMGR_THIRD);
                    break;
                case 70:
                    return system_showText(LANG_SITEMGR_FOURTH);
                    break;
            }
        }
		
		function convertTableToArray(){
			$array_fields = get_object_vars($this);
			
			unset($level_values);
			for($i=0;$i<count($array_fields["value"]);$i++){
				$level_values[] = $array_fields["value"][$i];
				
			}
			
			if(count($level_values) && is_array($array_fields)){
				$aux_new_array_fields = array();
				foreach($array_fields as $key => $value){
					if(is_array($value)){
						for($i=0;$i<count($level_values);$i++){
							$aux_new_array_fields[$key][$level_values[$i]] = $value[$i];
						}
					}

				}
				
				return $aux_new_array_fields;
				
			}else{
				return false;
			}

		}
        
        function updateValues($name, $active, $has_promotion, $has_review, $has_sms, $has_call, $has_mobile_application, $backlink, $levelValue){
            
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            
            $sql = "UPDATE ListingLevel SET name = '".$name."', active = '".$active."', has_promotion = '".$has_promotion."', has_review = '".$has_review."', has_sms = '".$has_sms."', has_call = '".$has_call."', has_mobile_application = '".$has_mobile_application."', backlink = '".$backlink."' WHERE value = ".$levelValue." AND theme = '".(EDIR_THEME ? EDIR_THEME : "default")."'";
            $dbObj->query($sql);
            
        }
        
        function updatePricing($field, $fieldValue, $level){
            
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            
            $sql = "UPDATE ListingLevel SET $field = ".$fieldValue." WHERE value = ".$level." AND theme = '".(EDIR_THEME ? EDIR_THEME : "default")."'";

            $dbObj->query($sql);
        }

		##################################################
		# PUBLIC
		##################################################

	}
	
	

?>
