<? //include("./conf/loadconfig.inc.php");

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	
	if($_GET["fnct"] && $_GET["fnct"] == "categories"){
		echo system_advancedSearch_getCategories($_GET["type"], $_GET["template_id"]);	
	}



function system_advancedSearch_getCategories($type = "listing", $template_id = false){
		
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		if ($type == "promotion"){
			$type = "listing";
		}
		$item_category_scalability = constant(strtoupper($type)."CATEGORY_SCALABILITY_OPTIMIZATION");
		$table = ucfirst($type)."Category";
		$table_type = $type."category";
			
		/**
		 * Fields to get categories
		 */
		$fields = array();
		$fields[] = "id";
		$fields[] = "title$langIndex";


		if ($template_id && $type == "listing") {
			$listingtemplate = new ListingTemplate($template_id);
			if ($listingtemplate && $listingtemplate->getNumber("id") && is_numeric($listingtemplate->getNumber("id")) && ($listingtemplate->getNumber("id")>0)) {
				$templatecategories = $listingtemplate->getCategories();
			}
			if ($templatecategories) {
				foreach ($templatecategories as $templatecategory) {
					$arraycategories[] = $templatecategory->getNumber("id");
				}
				$sql_categories = "SELECT id, title$langIndex FROM ListingCategory WHERE category_id = 0 AND id IN (".(implode(",", $arraycategories)).") AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND enabled = 'y' ORDER BY title$langIndex LIMIT ".MAX_SHOW_ALL_CATEGORIES;

			} else {
				$sql_categories = "SELECT id, title$langIndex FROM ListingCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND enabled = 'y' ORDER BY title$langIndex LIMIT ".MAX_SHOW_ALL_CATEGORIES;
			}
		} else {
			$sql_categories = "SELECT id, title$langIndex FROM $table WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND enabled = 'y' ORDER BY title$langIndex LIMIT ".MAX_SHOW_ALL_CATEGORIES;

		}
		if ($sql_categories) {
			$categories = db_getFromDBXML($table, false, false, false, false, $fields, $sql_categories);
			$xml_categories = simplexml_load_string($categories);
			if(count($xml_categories->item) > 0) {
				for($i=0;$i<count($xml_categories->item);$i++){
					$category = array();
					foreach($xml_categories->item[$i]->children() as $key => $value){			
						$category[$key] = $value;
					}
					if (count($category > 0)) {
						if ($item_category_scalability != "on") {
							$valueArray[] = "";
							$nameArray[]  = "---------------------------";
						}
						$valueArray[] = $category["id"];
						$nameArray[] = $category["title".$langIndex];

						if ($item_category_scalability != "on") {
							$sql_subcategories = "SELECT id, title$langIndex FROM $table WHERE category_id = ".$category["id"]." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND title$langIndex <> '' AND enabled = 'y' ORDER BY title$langIndex LIMIT ".MAX_SHOW_ALL_CATEGORIES;
							$subcategories = db_getFromDBXML($table, false, false, false, false, $fields, $sql_subcategories);
							$xml_subcategories = simplexml_load_string($subcategories);
							if ($subcategories) {
								if(count($xml_subcategories->item) > 0) {
									for($j=0;$j<count($xml_subcategories->item);$j++){
										$subcategory = array();
										foreach($xml_subcategories->item[$j]->children() as $key => $value) {
											$subcategory[$key] = $value;
										}
										if (count($subcategory > 0)) {
											$valueArray[] = $subcategory["id"];
											$nameArray[] = " &raquo; ".$subcategory["title".$langIndex];
										}
									}
								}
							}
						}
					}
				}
			}
		}
		
		if ($item_category_scalability != "on") {
			$valueArray[] = "";
			$nameArray[] = "---------------------------";
		}

		$categoryDD = html_selectBoxCat("category_id", $nameArray, $valueArray, "", "", "", system_showText(LANG_SEARCH_LABELCBCATEGORY), $type);	
		return $categoryDD;
		
	}
	
function getCategories() {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			$sql = "SELECT cat_id FROM ListingTemplate WHERE id = $this->id";
			$r = $dbObj->query($sql);
			while ($row = mysql_fetch_array($r)) {
				if ($row["cat_id"]) {
					$cat_id = explode(",", $row["cat_id"]);
					foreach ($cat_id as $catid) {
						$categories[] = new ListingCategory($catid);
					}
				}
			}
			return $categories;
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


function html_selectBoxCat($name, $nameArray, $valueArray, $selected, $code="", $class="", $emptyValue="", $local="") {
		
		$htmlStr = "\n<select class=\"select\" name=\"$name\" id=\"$name\" $code $class >\n";
		if(!empty($emptyValue)) {
			$htmlStr .= "<option value=\"\">$emptyValue</option>\n";
		}
		$count = count($nameArray);
		for($i = 0; $i < $count; $i++) {
			$sel = "";
			if (($selected == $valueArray[$i]) && ($selected != "")) {
				$sel = "selected=\"selected\"";
			}
			$dbObj = db_getDBObJect();
			if ($local == "" || $local == "listing") {
				$sql = "SELECT id, category_id FROM ListingCategory WHERE id = '$valueArray[$i]'";
			} else {
				if ($local == "event") {
					$sql = "SELECT id, category_id FROM EventCategory WHERE id = '$valueArray[$i]'";
				}
				if ($local == "classified") {
					$sql = "SELECT id, category_id FROM ClassifiedCategory WHERE id = '$valueArray[$i]'";
				}
				if ($local == "article") {
					$sql = "SELECT id, category_id FROM ArticleCategory WHERE id = '$valueArray[$i]'";
				}
			}
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			$id = $row["id"];
			$category_id = $row["category_id"];
			if (($id) || ($category_id)) {
				if ($category_id == 0){
					//category
					if (string_strlen($nameArray[$i]) > 99 ) {
						$label_1 = string_substr($nameArray[$i], 0, 99);
						$label_2 = string_substr($nameArray[$i], 99, string_strlen($nameArray[$i]));
						$htmlStr .= "<option value=\"".$valueArray[$i]."\" class=\"searchCategory\" $sel>".$label_1."</option>\n";
						$htmlStr .= "<option value=\"".$valueArray[$i]."\" class=\"searchCategory\" $sel>".$label_2."</option>\n";
					} else {
						$label = $nameArray[$i];
						$htmlStr .= "<option value=\"".$valueArray[$i]."\" class=\"searchCategory\" $sel>".$label."</option>\n";
					}
				} else {
					//sub-category
					if (string_strlen($nameArray[$i]) > 99 ) {
						$label_1 = string_substr($nameArray[$i], 0, 99);
						$label_2 = string_substr($nameArray[$i], 99, string_strlen($nameArray[$i]));
						$htmlStr .= "<option value=\"".$valueArray[$i]."\" class=\"searchSubcategory\" $sel>".$label_1."</option>\n";
						$htmlStr .= "<option value=\"".$valueArray[$i]."\" class=\"searchSubcategory\" $sel>".$label_2."</option>\n";
					} else {
						$label = $nameArray[$i];
						$htmlStr .= "<option value=\"".$valueArray[$i]."\" class=\"searchSubcategory\" $sel>".$label."</option>\n";
					}
					
				}
			} else {
				//separator
				$htmlStr .= "<option value=\"".$valueArray[$i]."\" class=\"searchSeparator\" $sel>&nbsp;</option>\n";
			}
		}
		$htmlStr .= "</select>\n";
		return $htmlStr;
	}

	/*
	* @name:   function html_numSelectBox
	* @since:  10/28/2005
	* @param:  array $options_array (all dropdown attributes. There is no limit for number of elements)
	* @param:  numeric $start (first sequence's #)
	* @param:  numeric $end (last sequence's #)
	* @param:  numeric $inc (increments - default:1 )
	* @param:  string $emptySelection (text to show when no item is selected)
	* @param:  numeric $zeroFill
	* @return: string "html select tag"
	*
	* The advantage of use this function is you dont need to give an arrya of values. 
	* You just need the 1st and the last numbers.
	* If $zeroFill is 0 (zero), no fill is done. Otherwise, if it is > 0, the given number is the number of positions that will be filled with left side zeros.
	*
	* This is an example for $options_array:
	* $options_array = array(
	*	'name' => 'my_number', 
	*	'class' => 'css_select',
	*	'style' => 'width:auto;',
	*	'tabindex' => '2',
	*	'onChange' => 'document.frmX.submit();',
	*	'selected' => '10',
	*	'emptyLabel' => '- Select -',
	*	'emptyValue' => '#'
	* );
	* 
	* All attributes are placed in the "select open" tag (<select>), except:
	* - "selected","emptySelection".
	*/
	function html_numSelectBox($options_array, $start, $end, $inc=1, $emptySelection="", $zeroFill=0) {
		$options = "";
		$htmlStr = "";
		foreach ($options_array as $key=>$value) {
			if ($key != "selected")
				$options .= "$key=\"$value\" ";
		}
		$htmlStr = "\n<select $options>\n";
		if(!empty($emptySelection)) {
			$htmlStr .= "<option value=\"\">$emptySelection</option>\n";
		}
		$zero = str_repeat("0", $zeroFill);
		for($i = $start; $i <= $end; $i+=$inc) {
			$j = string_substr($zero.$i, -$zeroFill);
			$sel = ($options_array["selected"] == $j) ? "selected=\"selected\"" : "";
			$htmlStr .= "<option value=\"$j\" $sel>$j</option>\n";
		}
		$htmlStr .= "</select>\n";
		return $htmlStr;
	}

	function html_locationSelectBox($type, $locations, $location_id="") {

		$l_name = "location_".$type;
		$l_label = constant("LANG_LABEL_SELECT_".constant("LOCATION".$type."_SYSTEM"));
		
		?>
		<select style="font: 8pt/18px Verdana, Arial, Helvetica, sans-serif" name="<?=$l_name?>" id="select_location<?=$type?>" class="" onchange="formLocations_submit(<?=$type?>, this.form)">
			<option value=""> -- <?=system_showText($l_label)?> -- </option>
			<?
			if ($locations) foreach ($locations as $location) {
				$selected = ($location_id == $location["id"]) ? "selected" : "";
				?><option <?=$selected?> value="<?=$location["id"]?>"><?=$location["name"]?></option><?
				unset($selected);
				}?>
		</select>
		<?
	}
	?>


