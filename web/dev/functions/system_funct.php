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
	# * FILE: /functions/system_funct.php
	# ----------------------------------------------------------------------------------------------------

	function system_showPre($array, $label="") {
		echo "<pre>$label: ";
		var_dump($array);
		echo "</pre>";
	}

	function system_mail($to, $subject, $message, $from, $content_type="text/plain", $cc="", $bcc="", &$error) {
		$eDirMailerObj = new EDirMailer($to, $subject, $message, $from);
		$eDirMailerObj->SMTPKeepAlive = true;
		if ($content_type) $eDirMailerObj->setContentType($content_type);
		if ($cc) $eDirMailerObj->setCC($cc);
		if ($bcc) $eDirMailerObj->setBCC($bcc);
		if (!$eDirMailerObj->send()) {
			$error = $eDirMailerObj->msgerror;
			return false;
		}
		return true;
	}

	function system_generatePassword() {
		$string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		srand((double)microtime()*1000000);
		for ($i=0; $i < 8; $i++) {
			$num   = rand() % string_strlen($string);
			$tmp   = string_substr($string, $num, 1);
			$pass .= $tmp;
		}
		return $pass;
	}

	function system_generateFileName() {
		$string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		srand((double)microtime()*1000000);
		for ($i=0; $i < 20; $i++) {
			$num = rand() % string_strlen($string);
			$tmp = string_substr($string, $num, 1);
			$name .= $tmp;
		}
		return $name;
	}

	function system_sendPassword($id, $emailTO, $username, $password, $name, $lang) {

		if ($emailNotificationObj = system_checkEmail($id, $lang)) {

			setting_get("sitemgr_email", $sitemgr_email);
			$sitemgr_emails = explode(",", $sitemgr_email);

			if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];

			$subject = $emailNotificationObj->getString("subject");
			$body    = $emailNotificationObj->getString("body");

			$subject = str_replace("ACCOUNT_NAME",     $name,            $subject);
			$subject = str_replace("ACCOUNT_USERNAME", $username,        $subject);
			$subject = str_replace("ACCOUNT_PASSWORD", $password,        $subject);
			$subject = str_replace("DEFAULT_URL",      DEFAULT_URL,      $subject);
			$subject = str_replace("SITEMGR_EMAIL",    $sitemgr_email,   $subject);
			$subject = str_replace("EDIRECTORY_TITLE", EDIRECTORY_TITLE, $subject);

			$body    = str_replace("ACCOUNT_NAME",     $name,            $body);
			$body    = str_replace("ACCOUNT_USERNAME", $username,        $body);
			$body    = str_replace("ACCOUNT_PASSWORD", $password,        $body);
			$body    = str_replace("DEFAULT_URL",      DEFAULT_URL,      $body);
			$body    = str_replace("SITEMGR_EMAIL",    $sitemgr_email,   $body);
			$body    = str_replace("EDIRECTORY_TITLE", EDIRECTORY_TITLE, $body);

			$body = html_entity_decode($body);
			$subject = html_entity_decode($subject);

			$error = false;
			system_mail($emailTO, $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);

		}

	}

	/**
	* Verify if email is Enabled or Disabled
	********************************************************************/
	function system_checkEmail($id, $lang) {
		if ($lang) $email = new EmailNotification($id, $lang);
		else $email = new EmailNotification($id);
		if ($email->getString("deactivate")) {
			return false;
		} else {
			return $email;
		}
	}

	/**
	* Replace the variables in the email body
	********************************************************************/
	function system_replaceEmailVariables($body,$id,$item="listing") {

		switch ($item) {
			case 'banner': $obj = new Banner($id); break;
			case 'classified': $obj = new Classified($id); break;
			case 'article': $obj = new Article($id); break;
			case 'event': $obj = new Event($id); break;
			case 'listing': $obj = new Listing($id); break;
			case 'promotion': $obj = new Promotion($id); break;
			case 'account': $acc = new Account($id);
		}

		if (!isset($acc)) $acc = new Account($obj->getNumber('account_id'));
		$acc_cont = new Contact($acc->getNumber('id'));

		setting_get("sitemgr_email", $sitemgr_email);
		$sitemgr_emails = explode(",", $sitemgr_email);

		if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];

		$body = str_replace("ACCOUNT_NAME",$acc_cont->getString('first_name').' '.$acc_cont->getString('last_name'),$body);
		$body = str_replace("ACCOUNT_USERNAME",$acc->getString('username'),$body);
		$body = str_replace("ACCOUNT_PASSWORD",$acc->getString('username'),$body);

		switch ($item) {
			case 'banner':
				$body = str_replace(array("ITEM_TITLE", "BANNER_TITLE"), $obj->getString('caption'), $body);
			break;
			case 'classified':
                $levelObj = new ClassifiedLevel();
                if ($levelObj->getDetail($obj->getString('level')) == "y") {
				    if (MODREWRITE_FEATURE == "on") { $detailLink = "".CLASSIFIED_DEFAULT_URL."/".$obj->getString("friendly_url").".html"; } else { $detailLink = "".CLASSIFIED_DEFAULT_URL."/detail.php?id=".$obj->getNumber("id"); }
                } else {
                    $detailLink = CLASSIFIED_DEFAULT_URL."/results.php?id=".$obj->getString("id");
                }
				$body = str_replace(array("ITEM_TITLE", "CLASSIFIED_TITLE"), $obj->getString('title'), $body);
			break;
			case 'article':
				if (MODREWRITE_FEATURE == "on") { $detailLink = "".ARTICLE_DEFAULT_URL."/".$obj->getString("friendly_url").".html"; } else { $detailLink = "".ARTICLE_DEFAULT_URL."/detail.php?id=".$obj->getNumber("id"); }
				$body = str_replace(array("ITEM_TITLE", "ARTICLE_TITLE"), $obj->getString('title'), $body);
			break;
			case 'event':
                $levelObj = new EventLevel();
                if ($levelObj->getDetail($obj->getString('level')) == "y") {
				    if (MODREWRITE_FEATURE == "on") { $detailLink = "".EVENT_DEFAULT_URL."/".$obj->getString("friendly_url").".html"; } else { $detailLink = "".EVENT_DEFAULT_URL."/detail.php?id=".$obj->getNumber("id"); }
                } else {
                    $detailLink = EVENT_DEFAULT_URL."/results.php?id=".$obj->getString("id");
                }
				$body = str_replace(array("ITEM_TITLE", "EVENT_TITLE"), $obj->getString('title'), $body);
			break;
			case 'listing':
                $levelObj = new ListingLevel();
                if ($levelObj->getDetail($obj->getString('level')) == "y") {
				    if (MODREWRITE_FEATURE == "on") { $detailLink = "".LISTING_DEFAULT_URL."/".$obj->getString("friendly_url").".html"; } else { $detailLink = "".LISTING_DEFAULT_URL."/detail.php?id=".$obj->getNumber("id"); }
                } else {
                    $detailLink = LISTING_DEFAULT_URL."/results.php?id=".$obj->getString("id");
                }
				$body = str_replace(array("ITEM_TITLE", "LISTING_TITLE"), $obj->getString('title'), $body);
			break;
			case 'promotion':
				$detailLink = "".PROMOTION_DEFAULT_URL."/results.php?id=".$obj->getNumber("id");
				$body = str_replace(array("ITEM_TITLE"), $obj->getString('name'), $body);
			break;
		}

		if (isset($detailLink)) $body = str_replace("ITEM_URL", $detailLink, $body);

		$body = str_replace("ITEM_TYPE", $item, $body);

		$body = str_replace("ARTICLE_DEFAULT_URL",ARTICLE_DEFAULT_URL,$body);
		$body = str_replace("CLASSIFIED_DEFAULT_URL",CLASSIFIED_DEFAULT_URL,$body);
		$body = str_replace("EVENT_DEFAULT_URL",EVENT_DEFAULT_URL,$body);
		$body = str_replace("LISTING_DEFAULT_URL",LISTING_DEFAULT_URL,$body);

		$body = str_replace("EDIRECTORY_TITLE",EDIRECTORY_TITLE,$body);
		$body = str_replace("SITEMGR_EMAIL",$sitemgr_email,$body);
		$body = str_replace("DEFAULT_URL",DEFAULT_URL,$body);

		return $body;

	}

	function endKey($array){
		end($array);
		return key($array);
	}

	/**
	* This function is used by system_generateCategoryTreeRecursiveSort to help on the category ordering.
	********************************************************************/
	function system_generateCategoryTreeRecursiveSort($dad_id, $item, &$new_arr, &$ordered){
		for($j=0; $j < count($new_arr); $j++){
			if($new_arr[$j]["dad"] == $dad_id){
				$x = count($ordered);
				$ordered[$x]["id"] = $new_arr[$j]["id"];
				$ordered[$x]["dad"] = $new_arr[$j]["dad"];
				$ordered[$x]["title1"] = $new_arr[$j]["title1"];
				$ordered[$x]["title2"] = $new_arr[$j]["title2"];
				$ordered[$x]["title3"] = $new_arr[$j]["title3"];
				$ordered[$x]["title4"] = $new_arr[$j]["title4"];
				$ordered[$x]["title5"] = $new_arr[$j]["title5"];
				$ordered[$x]["title6"] = $new_arr[$j]["title6"];
				$ordered[$x]["title7"] = $new_arr[$j]["title7"];
				$ordered[$x]["active_".$item] = $new_arr[$j]["active_".$item];
				$ordered[$x++]["level"] = $new_arr[$j]["level"];
				system_generateCategoryTreeRecursiveSort($new_arr[$j]["id"], $item, $new_arr, $ordered);
			}
		}
	}

	/**
	* This function is used to generate a category tree based on 2 terms which are arrays.
	* It is also using styles from this project.
	* The first array contains the selected categories
	* The second array is generated by method getFullPath in Category class
	********************************************************************/
	function system_generateCategoryTree($categories_obj_arr, $arr_full_path, $item, $user=false, $lang=EDIR_LANGUAGE) {

		$item_aux = "";
		if ($item == "promotion") {
			$item_aux = $item;
			$item = "listing";
		}

		$x=0; $y=0;

		for ($i=0; $i < count($arr_full_path); $i++) {

			for ($j=0; $j < count($arr_full_path[$i]); $j++) {

				if ($arr_full_path[$i][$j]["dad"] == 0) {

					$repeated = false;

					if ($dad_arr) {
						foreach ($dad_arr as $each_dad) {
							if ($each_dad["id"] == $arr_full_path[$i][$j]["id"]) {
								$repeated = true;
							}
						}
					}

					if (!$repeated) {

						if (string_strpos($arr_full_path[$i][$j]["lang"], EDIR_LANGUAGE) !== false && $arr_full_path[$i][$j]["enabled"] == "y") {
							$dad_arr[$y]["id"] = $arr_full_path[$i][$j]["id"];
							$dad_arr[$y]["dad"] = $arr_full_path[$i][$j]["dad"];
							$dad_arr[$y]["title1"] = $arr_full_path[$i][$j]["title1"];
							$dad_arr[$y]["title2"] = $arr_full_path[$i][$j]["title2"];
							$dad_arr[$y]["title3"] = $arr_full_path[$i][$j]["title3"];
							$dad_arr[$y]["title4"] = $arr_full_path[$i][$j]["title4"];
							$dad_arr[$y]["title5"] = $arr_full_path[$i][$j]["title5"];
							$dad_arr[$y]["title6"] = $arr_full_path[$i][$j]["title6"];
							$dad_arr[$y]["title7"] = $arr_full_path[$i][$j]["title7"];
							$dad_arr[$y]["active_".$item] = $arr_full_path[$i][$j]["active_".$item];
							$dad_arr[$y++]["level"] = $arr_full_path[$i][$j]["level"];
						}
					}

				} else {

					$repeated = false;

					if ($new_arr) {
						foreach ($new_arr as $each_cat) {
							if ($each_cat["id"] == $arr_full_path[$i][$j]["id"]) {
								$repeated = true;
							}
						}
					}

					if (!$repeated) {

						if (string_strpos($arr_full_path[$i][$j]["lang"], EDIR_LANGUAGE) !== false && $arr_full_path[$i][$j]["enabled"] == "y") {
							$new_arr[$x]["id"] = $arr_full_path[$i][$j]["id"];
							$new_arr[$x]["dad"] = $arr_full_path[$i][$j]["dad"];
							$new_arr[$x]["title1"] = $arr_full_path[$i][$j]["title1"];
							$new_arr[$x]["title2"] = $arr_full_path[$i][$j]["title2"];
							$new_arr[$x]["title3"] = $arr_full_path[$i][$j]["title3"];
							$new_arr[$x]["title4"] = $arr_full_path[$i][$j]["title4"];
							$new_arr[$x]["title5"] = $arr_full_path[$i][$j]["title5"];
							$new_arr[$x]["title6"] = $arr_full_path[$i][$j]["title6"];
							$new_arr[$x]["title7"] = $arr_full_path[$i][$j]["title7"];
							$new_arr[$x]["active_".$item] = $arr_full_path[$i][$j]["active_".$item];
							$new_arr[$x++]["level"] = $arr_full_path[$i][$j]["level"];
						}
					}

				}

			}

		}

		for ($i=0; $i < count($dad_arr); $i++) {

			$x = count($ordered);

			$ordered[$x]["id"] = $dad_arr[$i]["id"];
			$ordered[$x]["dad"] = $dad_arr[$i]["dad"];
			$ordered[$x]["title1"] = $dad_arr[$i]["title1"];
			$ordered[$x]["title2"] = $dad_arr[$i]["title2"];
			$ordered[$x]["title3"] = $dad_arr[$i]["title3"];
			$ordered[$x]["title4"] = $dad_arr[$i]["title4"];
			$ordered[$x]["title5"] = $dad_arr[$i]["title5"];
			$ordered[$x]["title6"] = $dad_arr[$i]["title6"];
			$ordered[$x]["title7"] = $dad_arr[$i]["title7"];
			$ordered[$x]["active_".$item] = $dad_arr[$i]["active_".$item];
			$ordered[$x++]["level"] = $dad_arr[$i]["level"];

			$dad_id = $dad_arr[$i]["id"];

			system_generateCategoryTreeRecursiveSort($dad_id, $item, $new_arr, $ordered);

		}

		$langIndex = language_getIndex(EDIR_LANGUAGE);

		for ($i=0; $i < count($ordered); $i++) {

			if ($item == "listing") $catObj = new ListingCategory($ordered[$i]["id"]);
			elseif ($item == "event") $catObj = new EventCategory($ordered[$i]["id"]);
			elseif ($item == "classified") $catObj = new ClassifiedCategory($ordered[$i]["id"]);
			elseif ($item == "article") $catObj = new ArticleCategory($ordered[$i]["id"]);
			$path_elem_arr = $catObj->getFullPath();

			if (MODREWRITE_FEATURE == "on") {
				if ($item_aux) $href = "".constant(string_strtoupper($item_aux)."_DEFAULT_URL")."/guide";
				else $href = "".constant(string_strtoupper($item)."_DEFAULT_URL")."/guide";
			} else {
				if ($item_aux) $href = "".constant(string_strtoupper($item_aux)."_DEFAULT_URL")."/results.php?category_id=";
				else $href = "".constant(string_strtoupper($item)."_DEFAULT_URL")."/results.php?category_id=";
			}

			if (MODREWRITE_FEATURE == "on") {
				if ($path_elem_arr) {
					foreach ($path_elem_arr as $each_category_node) {
						$href .= "/".$each_category_node["friendly_url".$langIndex];
					}
				}
			} else {
				if ($path_elem_arr) {
					foreach ($path_elem_arr as $each_category_node) {
						$thiscategoryid = $each_category_node["id"];
					}
					$href .= $thiscategoryid;
				}
			}

			if ($user) {
				$linked_titles[] = "<li class=\"level-".$ordered[$i]["level"]."\"><a href=\"".$href."\">".string_htmlentities($ordered[$i]["title".$langIndex]).((($item == "listing") && (!$item_aux) && (SHOW_CATEGORY_COUNT=="on"))?(" <span>(".$ordered[$i]["active_".$item].")</span>"):(""))."</a></li>";
			} else {
				$linked_titles[] = "<li class=\"level-".$ordered[$i]["level"]."\"><a href=\"javascript: void(0);\" style=\"cursor:default\">".string_htmlentities($ordered[$i]["title".$langIndex]).((($item == "listing") && (!$item_aux) && (SHOW_CATEGORY_COUNT=="on"))?(" <span>(".$ordered[$i]["active_".$item].")</span>"):(""))."</a></li>";
			}

		}

		if(is_array($linked_titles)){
			$category_tree = "<ul class=\"list list-category\">".implode("", $linked_titles)."</ul>";
			return($category_tree);
		}else{
			return false;
		}


	}

	function system_generateAjaxAccountSearch($acct_search_table_title = LANG_SITEMGR_ACCOUNTSEARCH_SELECT_DEFAULT, $acct_search_field_name = "account_id", $acct_search_field_value = false, $acct_search_required_mark = false, $acct_search_form_width = "100%", $acct_search_cell_width = "105px", $custom = 0, $extra = false){

		if ($extra){
			$extraId = 2;
		} else {
			$extraId = "";
		}
		system_showTruncatedText($acct_search_field_value, 10);
		$form_html = "
				<div id=\"table_accounts_search$extraId\" style=\"display: none; width: ".$acct_search_form_width."\" class=\"table_accounts_search\">

					<input type=\"hidden\" name=\"acct_search_field_name$extraId\" id=\"acct_search_field_name$extraId\" value=\"".$acct_search_field_name."\" />

					<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"searchAccount\">
						<tr>
							<th colspan=\"2\" class=\"searchAccountTitleAccount\">".$acct_search_table_title."</span></th>
						</tr>
						<tr>
							<th>".system_showText(LANG_SITEMGR_LABEL_COMPANY).": </th>
							<td>
								<input type=\"text\" id=\"acct_search_company$extraId\" style=\"width:250px\" name=\"acct_search_company$extraId\" value=\"\" OnKeyPress=\"if(event.keyCode == 13) { searchAccount(this.form, '".DEFAULT_URL."', $custom, ".($extraId ? $extraId : "0")."); }\" />
							</td>
						</tr>
						<tr>
							<th class=\"first_line\" style=\"padding-top: 10px\">".system_showText(LANG_SITEMGR_LABEL_USERNAME).": </th>
							<td style=\"padding-top: 10px\">
								<input type=\"text\" id=\"acct_search_username$extraId\" style=\"width:250px\" name=\"acct_search_username$extraId\" value=\"\" OnKeyPress=\"if(event.keyCode == 13) { searchAccount(this.form, '".DEFAULT_URL."', $custom, ".($extraId ? $extraId : "0")."); }\" />
							</td>
						</tr>
						<tr>
							<td colspan=\"2\" style=\"text-align: center; padding-bottom: 5px;\">
								<input style=\"width:80px\" class=\"input-button-form\" type=\"button\" name=\"acct_search_btn$extraId\" id=\"acct_search_btn$extraId\" value=\"".system_showText(LANG_SITEMGR_SEARCH)."\" onclick=\"searchAccount(this.form, '".DEFAULT_URL."', $custom, ".($extraId ? $extraId : "0").");\" />
								<input style=\"width:80px\" class=\"input-button-form\" type=\"button\" name=\"acct_reset_btn$extraId\" id=\"acct_reset_btn$extraId\" value=\"".system_showText(LANG_SITEMGR_CLEAR)."\" onclick=\"resetSearchAccount(".($extraId ? $extraId : "0").");\" />
								<input style=\"width:80px\" class=\"input-button-form\" type=\"button\" name=\"acct_cancel_btn$extraId\" id=\"acct_reset_btn$extraId\" value=\"".system_showText(LANG_SITEMGR_CANCEL)."\" onclick=\"cancelSearchAccount(".($extraId ? $extraId : "0").");\" />
								<input style=\"width:80px\" class=\"input-button-form\" type=\"button\" name=\"acct_empty_btn$extraId\" id=\"acct_empty_btn$extraId\" value=\"".system_showText(LANG_SITEMGR_ACCOUNTSEARCH_EMPTY)."\" onclick=\"emptySearchAccount(".($extraId ? $extraId : "0").");\" />
							</td>
						</tr>
                      	<tr>
							<td colspan=\"2\" style=\"padding: 0 10px 10px 10px;\">
								".(SOCIALNETWORK_FEATURE == 'on'?"<p class=\"informationMessage\">".system_showText(LANG_SITEMGR_MSG_YOUCANONLYSELECTSPONSO)."</p>":"")."
                                <div id=\"accounts_search$extraId\" class=\"div-accounts_search-form-listing accounts_search\"></div>
								<div id=\"accounts_search_loading$extraId\" class=\"div-accounts_search_loading-form-listing accounts_search_loading\">".system_showText(LANG_SITEMGR_WAITLOADING)."</div>
							</td>
						</tr>
					</table>

				</div>

				<div id=\"table_accounts$extraId\" class=\"table_accounts\">

					<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"standard-table\">
						<tr>
							<th style=\"width: ".$acct_search_cell_width.";\">".((!$acct_search_required_mark) ? "" : "*")." ".system_showText(LANG_SITEMGR_LABEL_ACCOUNT).":</th>
							<td id=\"selected_account$extraId\" class\"selected_account\">";
		if($acct_search_field_value) {
			$accountObj = new Account($acct_search_field_value);
			$contactObj = new Contact($acct_search_field_value);
			$account = $accountObj->getString("username", true);
			$form_html .= "			<a style=\"vertical-align: top\" href='javascript:changeAccount(".($extraId ? $extraId : "0").")'><strong>".system_showAccountUserName($account)."</strong></a>";
			$form_html .= "			<input type=\"hidden\" id=\"".$acct_search_field_name."\" name=\"".$acct_search_field_name."\" value=\"".$acct_search_field_value."\" />";
		} else {
			$form_html .= "			<a style=\"vertical-align: middle\" href='javascript:changeAccount(".($extraId ? $extraId : "0").")' id=\"change_account_search$extraId\"><strong>".system_showText(LANG_SITEMGR_ACCOUNTSEARCH_CLICKHERE)."</strong></a>";
		}
		$form_html .= "
							</td>
						</tr>
					</table>

				</div>";

		return $form_html;
	}

	function getTreePath($catID, $section) {
		$strRet = "";
		$dbObj = db_getDBObject();
		if ($section == "listing") $sql = "SELECT category_id FROM ListingCategory WHERE id = ".$catID."";
		else $sql = "SELECT category_id FROM ".string_ucwords($section)."Category WHERE id = ".$catID."";
		$result = $dbObj->query($sql);
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_assoc($result)) {
				$strRet .= getTreePath($row["category_id"], $section);
			}
		}
		if ($catID) $strRet .= ",".$catID;
		return $strRet;
	}

	function getSubTree($catID, $section) {
		$strRet = "";
		$dbObj = db_getDBObject();
		if ($section == "listing") $sql = "SELECT id FROM ListingCategory WHERE category_id = ".db_formatNumber($catID)."";
		else $sql = "SELECT id FROM ".string_ucwords($section)."Category WHERE category_id = ".db_formatNumber($catID)."";
		$result = $dbObj->query($sql);
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_assoc($result)) {
				$strRet .= getSubTree($row["id"], $section);
			}
		}
		$strRet .= ",".$catID;
		return $strRet;
	}

	function system_getListingStatus($force_count = false,$domain_id = SELECTED_DOMAIN_ID) {

		$status = array();

		$dbObj = db_getDBObJect(DEFAULT_DB,true);
		$dbObjSecond = db_getDBObjectByDomainID($domain_id,$dbObj);

		if (LISTING_SCALABILITY_OPTIMIZATION == "on" && !$force_count) {

			$sql = "SELECT * FROM ItemStatistic WHERE name LIKE 'l_%'";
			$r = $dbObjSecond->query($sql);
			if ($r) {
				while ($row = mysql_fetch_assoc($r)) {
					if ($row["value"] > 0) {
						$status[$row["name"]] = $row["value"];
					} else {
						$status[$row["name"]] = $row["value"];
					}
				}
			}

		} else {

			$sql = "SELECT COUNT(id) AS total FROM Listing_Summary WHERE status = ".db_formatString("P")."";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["l_pending"] = (int)$row["total"];

			if (!$force_count) {
				$sql = "SELECT COUNT(id) AS total FROM Listing_Summary WHERE renewal_date > NOW() AND renewal_date <= DATE_ADD(NOW(), INTERVAL ".DEFAULT_LISTING_DAYS_TO_EXPIRE." DAY)";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["l_expiring"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total FROM Listing_Summary WHERE status = ".db_formatString("E")."";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["l_expired"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total FROM Listing_Summary WHERE status = ".db_formatString("A")."";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["l_active"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total FROM Listing_Summary WHERE status = ".db_formatString("S")."";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["l_suspended"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total from Listing_Summary WHERE entered >= '".date("Y-m-d", mktime(0, 0, 0, date("m")-1 , date("d"), date("Y")))."'";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["l_added30"] = (int)$row["total"];
			}
		}

		unset($dbObj);
		unset($dbObjSecond);

		return $status;

	}

	function system_getEventStatus($force_count = false) {

		$status = array();

		$dbObj = db_getDBObJect(DEFAULT_DB,true);
		$dbObjSecond = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID,$dbObj);

		if (EVENT_SCALABILITY_OPTIMIZATION == "on" && !$force_count) {

			$sql = "SELECT * FROM ItemStatistic WHERE name LIKE 'e_%'";
			$r = $dbObjSecond->query($sql);
			if ($r) {
				while ($row = mysql_fetch_assoc($r)) {
					if ($row["value"] > 0) {
						$status[$row["name"]] = $row["value"];
					} else {
						$status[$row["name"]] = $row["value"];//
					}
				}
			}
		} else {

			$sql = "SELECT COUNT(id) AS total FROM Event WHERE status = ".db_formatString("P")."";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["e_pending"] = (int)$row["total"];

			if (!$force_count) {
				$sql = "SELECT COUNT(id) AS total FROM Event WHERE renewal_date > NOW() AND renewal_date <= DATE_ADD(NOW(), INTERVAL ".DEFAULT_EVENT_DAYS_TO_EXPIRE." DAY)";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["e_expiring"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total FROM Event WHERE status = ".db_formatString("E")."";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["e_expired"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total FROM Event WHERE status = ".db_formatString("A")."";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["e_active"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total FROM Event WHERE status = ".db_formatString("S")."";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["e_suspended"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total from Event WHERE entered >= '".date("Y-m-d", mktime(0, 0, 0, date("m")-1 , date("d"), date("Y")))."'";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["e_added30"] = (int)$row["total"];
			}

		}

		unset($dbObj);
		unset($dbObjSecond);

		return $status;

	}

	function system_getBannerStatus($force_count = false) {

		$status = array();

		$dbObj = db_getDBObJect(DEFAULT_DB,true);
		$dbObjSecond = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID,$dbObj);

		if (BANNER_SCALABILITY_OPTIMIZATION == "on" && !$force_count) {

			$sql = "SELECT * FROM ItemStatistic WHERE name LIKE 'b_%'";
			$r = $dbObjSecond->query($sql);
			if ($r) {
				while ($row = mysql_fetch_assoc($r)) {
					if ($row["value"] > 0) {
						$status[$row["name"]] = $row["value"];
					} else {
						$status[$row["name"]] = $row["value"];
					}
				}
			}

		} else {

			$sql = "SELECT COUNT(id) AS total FROM Banner WHERE status = ".db_formatString("P")."";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["b_pending"] = (int)$row["total"];

			if (!$force_count) {
				$sql = "SELECT COUNT(id) AS total FROM Banner WHERE status = ".db_formatString("E")."";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["b_expired"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total FROM Banner WHERE status = ".db_formatString("A")."";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["b_active"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total FROM Banner WHERE status = ".db_formatString("S")."";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["b_suspended"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total from Banner WHERE entered >= '".date("Y-m-d", mktime(0, 0, 0, date("m")-1 , date("d"), date("Y")))."'";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["b_added30"] = (int)$row["total"];
			}

		}

		unset($dbObj);
		unset($dbObjSecond);

		return $status;

	}

	function system_getClassifiedStatus($force_count = false) {

		$status = array();

		$dbObj = db_getDBObJect(DEFAULT_DB,true);
		$dbObjSecond = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID,$dbObj);

		if (CLASSIFIED_SCALABILITY_OPTIMIZATION == "on" && !$force_count) {

			$sql = "SELECT * FROM ItemStatistic WHERE name LIKE 'c_%'";
			$r = $dbObjSecond->query($sql);
			if ($r) {
				while ($row = mysql_fetch_assoc($r)) {
					if ($row["value"] > 0) {
						$status[$row["name"]] = $row["value"];
					} else {
						$status[$row["name"]] = $row["value"];
					}
				}
			}

		} else {

			$sql = "SELECT COUNT(id) AS total FROM Classified WHERE status = ".db_formatString("P")."";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["c_pending"] = (int)$row["total"];

			if (!$force_count) {
				$sql = "SELECT COUNT(id) AS total FROM Classified WHERE renewal_date > NOW() AND renewal_date <= DATE_ADD(NOW(), INTERVAL ".DEFAULT_CLASSIFIED_DAYS_TO_EXPIRE." DAY)";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["c_expiring"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total FROM Classified WHERE status = ".db_formatString("E")."";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["c_expired"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total FROM Classified WHERE status = ".db_formatString("A")."";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["c_active"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total FROM Classified WHERE status = ".db_formatString("S")."";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["c_suspended"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total from Classified WHERE entered >= '".date("Y-m-d", mktime(0, 0, 0, date("m")-1 , date("d"), date("Y")))."'";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["c_added30"] = (int)$row["total"];
			}
		}

		unset($dbObj);
		unset($dbObjSecond);

		return $status;

	}

	function system_getArticleStatus($force_count = false) {

		$status = array();

		$dbObj = db_getDBObJect();
		$dbObjSecond = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID,$dbObj);

		if (ARTICLE_SCALABILITY_OPTIMIZATION == "on" && !$force_count) {

			$sql = "SELECT * FROM ItemStatistic WHERE name LIKE 'a_%'";
			$r = $dbObjSecond->query($sql);
			if ($r) {
				while ($row = mysql_fetch_assoc($r)) {
					if ($row["value"] > 0) {
						$status[$row["name"]] = $row["value"];
					} else {
						$status[$row["name"]] = $row["value"];
					}
				}
			}

		} else {

			$sql = "SELECT COUNT(id) AS total FROM Article WHERE status = ".db_formatString("P")."";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["a_pending"] = (int)$row["total"];

			if (!$force_count) {
				$sql = "SELECT COUNT(id) AS total FROM Article WHERE renewal_date > NOW() AND renewal_date <= DATE_ADD(NOW(), INTERVAL ".DEFAULT_ARTICLE_DAYS_TO_EXPIRE." DAY)";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["a_expiring"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total FROM Article WHERE status = ".db_formatString("E")."";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["a_expired"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total FROM Article WHERE status = ".db_formatString("A")."";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["a_active"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total FROM Article WHERE status = ".db_formatString("S")."";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["a_suspended"] = (int)$row["total"];

				$sql = "SELECT COUNT(id) AS total from Article WHERE entered >= '".date("Y-m-d", mktime(0, 0, 0, date("m")-1 , date("d"), date("Y")))."'";
				$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
				$status["a_added30"] = (int)$row["total"];
			}
		}

		unset($dbObj);
		unset($dbObjSecond);

		return $status;

	}

	function system_getStatus($force_count = false, $domain_id = SELECTED_DOMAIN_ID) {

		$status = array();

		$dbObj = db_getDBObJect(DEFAULT_DB,true);
		$dbObjSecond = db_getDBObjectByDomainID($domain_id,$dbObj);

		// LISTING
		unset($status_aux);
		$status_aux = system_getListingStatus($force_count,$domain_id);
		foreach ($status_aux as $name=>$value) {
			$status[$name] = $value;
		}

		// EVENT
		if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
			unset($status_aux);
			$status_aux = system_getEventStatus($force_count);
			foreach ($status_aux as $name=>$value) {
				$status[$name] = $value;
			}
		}

		// BANNER
		if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {
			unset($status_aux);
			$status_aux = system_getBannerStatus($force_count);
			foreach ($status_aux as $name=>$value) {
				$status[$name] = $value;
			}
		}

		// CLASSIFIED
		if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
			unset($status_aux);
			$status_aux = system_getClassifiedStatus($force_count);
			foreach ($status_aux as $name=>$value) {
				$status[$name] = $value;
			}
		}

		// ARTICLE
		if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
			unset($status_aux);
			$status_aux = system_getArticleStatus($force_count);
			foreach ($status_aux as $name=>$value) {
				$status[$name] = $value;
			}
		}

		// LISTING REVIEW
		$sql = "SELECT COUNT(*) AS total FROM Review WHERE approved = '0' AND item_type = 'listing'";
		$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
		$status["lr_pending"] = (int)$row["total"];

		// PROMOTION REVIEW
		if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on") {
			$sql = "SELECT COUNT(*) AS total FROM Review WHERE approved = '0'  AND item_type = 'promotion'";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["pr_pending"] = (int)$row["total"];
		}

		// ARTICLE REVIEW
		if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
			$sql = "SELECT COUNT(*) AS total FROM Review WHERE approved = '0'  AND item_type = 'article'";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["ar_pending"] = (int)$row["total"];
		}

		// COMMENT & REPLY
		if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") {
			$sql = "SELECT COUNT(*) AS total FROM Comments WHERE approved = '0'";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["cr_pending"] = (int)$row["total"];
		}

		if (!$force_count) {
			// MONEY
			$sql = "SELECT COUNT(*) AS total, SUM(transaction_amount) AS amount from Payment_Log WHERE transaction_datetime >= '".date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-30, date("Y")))."'";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["payment_amount"] = (float)$row["amount"];

			// INVOICE
			$sql = "SELECT COUNT(*) AS total, SUM(amount) AS amount FROM Invoice WHERE status = 'R' AND payment_date >= '".date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-30, date("Y")))."'";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["invoice_amount"] = (float)$row["amount"];

			$sql = "SELECT COUNT(*) AS total from Invoice WHERE status = ".db_formatString("P")."";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["i_pending"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Invoice WHERE expire_date > NOW() AND expire_date <= DATE_ADD(NOW(), INTERVAL 5 DAY) AND status = 'P'";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["i_expiring"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total from Invoice WHERE status = ".db_formatString("E")."";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["i_expired"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total from Invoice WHERE status = ".db_formatString("R")."";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["i_received"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total from Invoice WHERE status = ".db_formatString("S")."";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["i_suspended"] = (int)$row["total"];
		}

		// CUSTOM INVOICE
		if (PAYMENT_FEATURE == "on") {
			if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
				if (CUSTOM_INVOICE_FEATURE == "on") {
					$sql = "SELECT COUNT(*) AS total From CustomInvoice WHERE paid ='y'";
					$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
					$status["custominvoice_paid"] = (int)$row["total"];

					$sql = "SELECT COUNT(*) AS total From CustomInvoice WHERE paid !='y' AND sent!='y' AND completed='y'";
					$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
					$status["custominvoice_pending"] = (int)$row["total"];

					$sql = "SELECT COUNT(*) AS total From CustomInvoice WHERE paid !='y' AND sent='y' AND completed='y'";
					$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
					$status["custominvoice_sent"] = (int)$row["total"];
				}
			}
		}

		// CLAIM
		if (CLAIM_FEATURE) {
			$sql = "SELECT COUNT(*) AS total FROM Claim WHERE status = ".db_formatString("complete")." AND account_id > 0 AND listing_id > 0";
			$r = $dbObjSecond->query($sql); $row = mysql_fetch_assoc($r);
			$status["claim_complete"] = (int)$row["total"];
		}

		unset($dbObj);
		unset($dbObjSecond);

		return $status;

	}

	function system_countActiveListingByCategory($listingID = "", $category_id = false, $domain_id = false) {
		if (is_numeric($category_id) && $category_id > 0) {
			$listingCatObj = new ListingCategory();
			$listingCatObj->countActiveListingByCategory($category_id, $domain_id);
		} else {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id) {
				$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
			} else {
				if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}
				unset($dbMain);
			}

			if (is_numeric($listingID) && $listingID > 0) {
				$sqlCat = "	SELECT LC.`root_id` AS `category_id`
							FROM `ListingCategory` LC
							LEFT JOIN `Listing_Category` L_C ON (L_C.`category_id` = LC.`id`)
							WHERE L_C.`listing_id` = $listingID";
			} else {
				$sqlCat = "SELECT `id` AS `category_id` FROM `ListingCategory` WHERE `category_id` = 0";
			}
			$resCat = $dbObj->Query($sqlCat);
			if (mysql_num_rows($resCat) > 0) {
				$listingCatObj = new ListingCategory();
				while ($rowCat = mysql_fetch_assoc($resCat)) {
					$listingCatObj->countActiveListingByCategory($rowCat["category_id"], $domain_id);
				}
			}
		}
	}

	function system_countActiveItemByCategory($item, $id = "", $action = "", $category_id = false, $domain_id = false) {

		$dbMain = db_getDBObject(DEFAULT_DB, true);
		if ($domain_id) {
			$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
		} else {
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
		}

		if ($item == "post") {

			if (($id) && (is_numeric($id)) && ($id > 0)) {
				$sql = "SELECT blogcat_id FROM Post_Item WHERE post_id = $id";
				$result = $dbObj->Query($sql);

				while ($row = mysql_fetch_assoc($result)) {
					$category_id[] = $row["blogcat_id"];
				}
				$category_id = array_unique($category_id);
			} else {
				$sql = "SELECT id FROM BlogCategory ORDER BY id";
				$result = $dbObj->query($sql);
				if (mysql_num_rows($result) > 0) {
					while ($row = mysql_fetch_assoc($result)) {
						$category_id[] = $row["id"];
					}
				}
			}

			if ($category_id) {

				foreach ($category_id as $categoryid) {

					if ($categoryid > 0) {

						$sql = "";
						$sql .= " SELECT ";
						$sql .= " COUNT(0) AS activepost";
						$sql .= " FROM ";
						$sql .= " Post_Item";
						if (!$id || !is_numeric($id) || $id <= 0) {
							$sql .= " LEFT JOIN Post ON ( Post_Item.post_id = Post.id )";
						}
						$sql .= " WHERE ";

						$sql .= " blogcat_id = $categoryid";

						if (($id) && (is_numeric($id)) && ($id > 0)) $sql .= " AND post_id = ".$id." ";
						else $sql .= " AND Post.status = 'A' ";

						$result = $dbObj->query($sql);
						if (mysql_num_rows($result) > 0) {
							if ($row = mysql_fetch_assoc($result)) {
								$active_post = $row["activepost"];
							}
						}

						if ($action == "inc") $sql = "UPDATE BlogCategory SET active_post = (active_post + ".$active_post.") WHERE id = ".$categoryid;
						elseif ($action == "dec") $sql = "UPDATE BlogCategory SET active_post = (active_post - ".$active_post.") WHERE id = ".$categoryid;
						else $sql = "UPDATE BlogCategory SET active_post = ".$active_post." WHERE id = ".$categoryid;

						$dbObj->query($sql);

					}

				}
			}

		} else {

			$table = ucfirst($item);

			if (($id) && (is_numeric($id)) && ($id > 0)) {
				$sql = "SELECT cat_1_id, parcat_1_level1_id, parcat_1_level2_id, parcat_1_level3_id, parcat_1_level4_id, cat_2_id, parcat_2_level1_id, parcat_2_level2_id, parcat_2_level3_id, parcat_2_level4_id, cat_3_id, parcat_3_level1_id, parcat_3_level2_id, parcat_3_level3_id, parcat_3_level4_id, cat_4_id, parcat_4_level1_id, parcat_4_level2_id, parcat_4_level3_id, parcat_4_level4_id, cat_5_id, parcat_5_level1_id, parcat_5_level2_id, parcat_5_level3_id, parcat_5_level4_id FROM ".$table." WHERE id = ".$id;
				$result = $dbObj->query($sql);
				if (mysql_num_rows($result) > 0) {
					$row = mysql_fetch_assoc($result);
					$category_id[] = $row["cat_1_id"];
					$category_id[] = $row["parcat_1_level1_id"];
					$category_id[] = $row["parcat_1_level2_id"];
					$category_id[] = $row["parcat_1_level3_id"];
					$category_id[] = $row["parcat_1_level4_id"];
					$category_id[] = $row["cat_2_id"];
					$category_id[] = $row["parcat_2_level1_id"];
					$category_id[] = $row["parcat_2_level2_id"];
					$category_id[] = $row["parcat_2_level3_id"];
					$category_id[] = $row["parcat_2_level4_id"];
					$category_id[] = $row["cat_3_id"];
					$category_id[] = $row["parcat_3_level1_id"];
					$category_id[] = $row["parcat_3_level2_id"];
					$category_id[] = $row["parcat_3_level3_id"];
					$category_id[] = $row["parcat_3_level4_id"];
					$category_id[] = $row["cat_4_id"];
					$category_id[] = $row["parcat_4_level1_id"];
					$category_id[] = $row["parcat_4_level2_id"];
					$category_id[] = $row["parcat_4_level3_id"];
					$category_id[] = $row["parcat_4_level4_id"];
					$category_id[] = $row["cat_5_id"];
					$category_id[] = $row["parcat_5_level1_id"];
					$category_id[] = $row["parcat_5_level2_id"];
					$category_id[] = $row["parcat_5_level3_id"];
					$category_id[] = $row["parcat_5_level4_id"];
					$category_id = array_unique($category_id);
				}
			} elseif (!$category_id) {
				$sql = "SELECT id FROM ".$table."Category ORDER BY id";
				$result = $dbObj->query($sql);
				if (mysql_num_rows($result) > 0) {
					while ($row = mysql_fetch_assoc($result)) {
						$category_id[] = $row["id"];
					}
				}
			}

			if ($category_id) {

				foreach ($category_id as $categoryid) {

					if ($categoryid > 0) {

						$sql = "";
						$sql .= " SELECT ";
						$sql .= " COUNT(DISTINCT(id)) AS active".$item;
						$sql .= " FROM ";
						$sql .= " ".$table;
						$sql .= " WHERE ";

						$sql .= " (cat_1_id = '".$categoryid."' OR parcat_1_level1_id = '".$categoryid."' OR parcat_1_level2_id = '".$categoryid."' OR parcat_1_level3_id = '".$categoryid."' OR parcat_1_level4_id = '".$categoryid."' OR cat_2_id = '".$categoryid."' OR parcat_2_level1_id = '".$categoryid."' OR parcat_2_level2_id = '".$categoryid."' OR parcat_2_level3_id = '".$categoryid."' OR parcat_2_level4_id = '".$categoryid."' OR cat_3_id = '".$categoryid."' OR parcat_3_level1_id = '".$categoryid."' OR parcat_3_level2_id = '".$categoryid."' OR parcat_3_level3_id = '".$categoryid."' OR parcat_3_level4_id = '".$categoryid."' OR cat_4_id = '".$categoryid."' OR parcat_4_level1_id = '".$categoryid."' OR parcat_4_level2_id = '".$categoryid."' OR parcat_4_level3_id = '".$categoryid."' OR parcat_4_level4_id = '".$categoryid."' OR cat_5_id = '".$categoryid."' OR parcat_5_level1_id = '".$categoryid."' OR parcat_5_level2_id = '".$categoryid."' OR parcat_5_level3_id = '".$categoryid."' OR parcat_5_level4_id = '".$categoryid."') ";

						if (($id) && (is_numeric($id)) && ($id > 0)) $sql .= " AND id = ".$id." ";
						else $sql .= " AND status = 'A' ";

						if ($table == "Event"){
							$sql .= " AND ((end_date >= DATE_FORMAT(NOW(), '%Y-%m-%d') AND rec