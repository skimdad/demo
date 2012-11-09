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
							$sql .= " AND ((end_date >= DATE_FORMAT(NOW(), '%Y-%m-%d') AND recurring = 'N') OR (recurring = 'Y' AND repeat_event = 'N' AND until_date >= DATE_FORMAT(NOW(), '%Y-%m-%d')) OR (recurring = 'Y' AND repeat_event = 'Y'))";
						} else if ($table == "Article"){
							$sql .= " AND (publication_date <= DATE_FORMAT(NOW(), '%Y-%m-%d'))";
						}

						$result = $dbObj->query($sql);
						if (mysql_num_rows($result) > 0) {
							if ($row = mysql_fetch_assoc($result)) {
								${"active_".$item} = $row["active".$item];
							}
						}

						if ($action == "inc") $sql = "UPDATE ".$table."Category SET active_".$item." = (active_".$item." + ".${"active_".$item}.") WHERE id = ".$categoryid;
						elseif ($action == "dec") $sql = "UPDATE ".$table."Category SET active_".$item." = (active_".$item." - ".${"active_".$item}.") WHERE id = ".$categoryid;
						else $sql = "UPDATE ".$table."Category SET active_".$item." = ".${"active_".$item}." WHERE id = ".$categoryid;

						$dbObj->query($sql);

					}

				}

			}
		}

	}

	function system_showBanner($banner_type = false, $banner_category_id = false, $banner_section = "general", $banner_amount = "1") {

		if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {

			$dbObj = db_getDBObject();
			if (SHOW_INACTIVE_BANNER != "on") $wActive = " AND `active` = 'y' ";
			$sql = "SELECT value FROM BannerLevel WHERE name = ".db_formatString(str_replace("_", " ", string_strtolower($banner_type)))." AND theme = '".EDIR_THEME."' $wActive LIMIT 1";

			$result = $dbObj->query($sql);
			if ($result) $row = mysql_fetch_assoc($result);
			if ($row["value"]) $banner_type = $row["value"];
			else $banner_type = false;

			$bannerObj = new Banner();

			$info = $bannerObj->randomRetrieve($banner_type, $banner_category_id, $banner_section, $banner_amount);

			$banner = $bannerObj->makeBanner($info);

			for ($i=0; $i < count($info); $i++) {
				if ($info[$i]["expiration_setting"] == BANNER_EXPIRATION_IMPRESSION && $info[$i]["impressions"] > 0) {
					$sql = "UPDATE Banner SET impressions = impressions - 1 WHERE id = '".$info[$i]["id"]."'";
					$result = $dbObj->query($sql);
				}
				report_newRecord("banner", $info[$i]["id"], BANNER_REPORT_VIEW);
			}

		}

		return $banner;

	}

	function system_getHeaderLogo($sitemgr = false) {
		$headerlogo = "";

		if (file_exists(EDIRECTORY_ROOT.IMAGE_HEADER_PATH)) {
			$headerlogo = "style=\"background-image: url('".DEFAULT_URL.IMAGE_HEADER_PATH."')\"";
		} else {
			if ($sitemgr) {
				$headerlogo = "style=\"background-image: url('".DEFAULT_URL."/sitemgr/images/logo.png')\"";
			}
		}
		return $headerlogo;
	}

	function system_getHeaderMobileLogo() {
		$headerlogo = "";
		if (file_exists(EDIRECTORY_ROOT.MOBILE_LOGO_PATH)) {
			$headerlogo_path = MOBILE_LOGO_PATH;
		} else {
			$headerlogo_path = "/images/content/img_logo_mobile.gif";
		}
		$headerlogo = $headerlogo_path;
		return $headerlogo;
	}

	function system_getNoImageStyle($cssfile = false) {
		$noimagestyle = "";
		if ($cssfile) {
			if (file_exists(EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_CSSEXT)) {
				$noimagestyle = "<link href=\"".DEFAULT_URL.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_CSSEXT."\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />";
			} else {
				$noimagestyle = "<link href=\"".DEFAULT_URL."/layout/general_noimage.css\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />";
			}
		} else {
			if (file_exists(EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_IMGEXT)) {
				$noimagestyle = "background-image: url('".DEFAULT_URL.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_IMGEXT."')";
			} else {
				$noimagestyle = "background: #FFF url('".DEFAULT_URL."/images/bg_noimage.gif') 45% 50% no-repeat;";
			}
		}
		return $noimagestyle;
	}
    
    function system_getFavicon(){
        $favicon = "";

        setting_get("last_favicon_id", $last_favicon_id);

        if (!$last_favicon_id){
            setting_new("last_favicon_id", "1");
            $last_favicon_id = "1";
        }

        if (file_exists(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/content_files/favicon_".$last_favicon_id.".ico")) {
            $favicon = "<link rel=\"Shortcut icon\" href=\"".DEFAULT_URL."/custom/domain_".SELECTED_DOMAIN_ID."/content_files/favicon_".$last_favicon_id.".ico\" type=\"image/x-icon\"/>";
        } else {
            if (BRANDED_PRINT == "on") { 
                $favicon ="<link rel=\"shortcut icon\" href=\"".DEFAULT_URL."/favicon.ico\" type=\"image/x-icon\"/>";
            }
        }
        
        return $favicon;
    }

	// ARRAY TO NAME-VALUE PAIRS
	function system_array2nvp($array, $separator = "&") {
		foreach ($array as $name=>$value) {
			$arrayNVP[] = $name."=".$value;
		}
		$nvpString = implode($separator, $arrayNVP);
		return $nvpString;
	}

	function system_getVideoSnippetCode($video_snippet, $video_snippet_width, $video_snippet_height, $forceResize = DETAIL_FORCE_VIDEORESIZE) {
		// the following code is modified by Debiprasad Sahoo (Indibits) on 19 July 2012
		// check whether the video snippet code is an url and if it's an url, then create video embed code
		$http_position = strpos($video_snippet, 'http');
		if ($http_position === 0) {
			// create video embed code
			// get the video ID from url
			$video_id_position = strpos($video_snippet, '?v=');
			if ($video_id_position === false)
				$video_id_position = strpos($video_snippet, '&v=');
			
			$video_id_substring = substr($video_snippet, ($video_id_position + 3));
			
			$video_id_length = strpos($video_id_substring, '&');
			
			if ($video_id_length === false)
				$video_id = $video_id_substring;
			else
				$video_id = substr($video_id_substring, 0, $video_id_length);
				
			$video_snippet = '<iframe width="' . $video_snippet_width . '" height="' . $video_snippet_height 
						   . '" src="http://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
		}

		$video_resize = false;

		$prefix_video_snippet = "";
		$suffix_video_snippet = $video_snippet;

		while (($pos = string_strpos($suffix_video_snippet, "width")) !== false) {

			$prefix_video_snippet .= string_substr($suffix_video_snippet, 0, $pos);
			$suffix_video_snippet = string_substr($suffix_video_snippet, $pos);

			if (($pos = string_strpos($suffix_video_snippet, ">")) !== false) {

				$lookingfornumber = $suffix_video_snippet;
				while (!is_numeric($lookingfornumber[0])) {
					$lookingfornumber = string_substr($lookingfornumber, 1);
				}

				$widthnumber = "";
				while (is_numeric($lookingfornumber[0])) {
					$widthnumber .= $lookingfornumber[0];
					$lookingfornumber = string_substr($lookingfornumber, 1);
				}

				if ($widthnumber > $video_snippet_width || $forceResize) {
					$video_resize = true;
				}

				$prefix_video_snippet .= string_substr($suffix_video_snippet, 0, $pos);
				$suffix_video_snippet = string_substr($suffix_video_snippet, $pos);

			}

		}

		$prefix_video_snippet = "";
		$suffix_video_snippet = $video_snippet;

		while (($pos = string_strpos($suffix_video_snippet, "height")) !== false) {

			$prefix_video_snippet .= string_substr($suffix_video_snippet, 0, $pos);
			$suffix_video_snippet = string_substr($suffix_video_snippet, $pos);

			if (($pos = string_strpos($suffix_video_snippet, ">")) !== false) {

				$lookingfornumber = $suffix_video_snippet;
				while (!is_numeric($lookingfornumber[0])) {
					$lookingfornumber = string_substr($lookingfornumber, 1);
				}

				$heightnumber = "";
				while (is_numeric($lookingfornumber[0])) {
					$heightnumber .= $lookingfornumber[0];
					$lookingfornumber = string_substr($lookingfornumber, 1);
				}

				if ($heightnumber > $video_snippet_height || $forceResize) {
					$video_resize = true;
				}

				$prefix_video_snippet .= string_substr($suffix_video_snippet, 0, $pos);
				$suffix_video_snippet = string_substr($suffix_video_snippet, $pos);

			}

		}

		$prefix_video_snippet = "";
		$suffix_video_snippet = $video_snippet;

		if ($video_resize) {
			while ((($pos = string_strpos($suffix_video_snippet, "width")) !== false) || (($pos = string_strpos($suffix_video_snippet, "height")) !== false)) {
				$prefix_video_snippet .= string_substr($suffix_video_snippet, 0, $pos);
				$prefix_video_snippet .= " style=\"width: ".$video_snippet_width."px; height: ".$video_snippet_height."px;\" ";
				$suffix_video_snippet = string_substr($suffix_video_snippet, $pos);
				if (($pos = string_strpos($suffix_video_snippet, ">")) !== false) {
					$prefix_video_snippet .= string_substr($suffix_video_snippet, 0, $pos);
					$suffix_video_snippet = string_substr($suffix_video_snippet, $pos);
				}
			}
		}

		$video_snippet_code = $prefix_video_snippet.$suffix_video_snippet;
        
        if (string_strpos($video_snippet_code, "<iframe") !== false && string_strpos($video_snippet_code, "wmode") === false){ //new Youtube code (iframe) - need to insert "wmode" parameter, otherwise all popups will shown under the video

            $prefix_video_snippet = "";
            $suffix_video_snippet = $video_snippet_code;
            $video_url = "";
            
            // The Regular Expression filter to find the video URL
            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

            // The Text you want to filter for urls
            $text = $suffix_video_snippet;

            // Check if there is a url in the text
            if(preg_match($reg_exUrl, $text, $url)) {
                $video_url = str_replace("'", "", $url[0]);
                $video_url = str_replace("\"", "", $video_url);
                $pos = string_strpos($suffix_video_snippet, $video_url);
                $prefix_video_snippet .= string_substr($suffix_video_snippet, 0, $pos);
                $suffix_video_snippet = string_substr($suffix_video_snippet, $pos+string_strlen($video_url));
                
                if (string_strpos($video_url, "?") !== false){
                    $video_snippet_code = $prefix_video_snippet.$video_url."&wmode=transparent".$suffix_video_snippet;
                } else {
                    $video_snippet_code = $prefix_video_snippet.$video_url."?wmode=transparent".$suffix_video_snippet;
                }
            }
            
        } elseif (string_strpos($video_snippet_code, "<object") !== false && string_strpos($video_snippet_code, "wmode=") === false){ //old Youtube code (object) - need to insert "wmode" parameter, otherwise all popups will shown under the video
            $video_snippet_code = str_replace("<embed ", "<embed wmode='transparent' ", $video_snippet_code);
        }

		return $video_snippet_code;

	}

	function system_getURLSearchParams($array) {
		$url_search_params = "";
		$array_search_params = array();
		if ($array) {
			if (count($array) > 0) {
				foreach ($array as $name=>$value) {
					$pos = string_strpos($name, "search_");
					if (($pos !== false) && ($pos == 0)) {
						if ($value) {
							$array_search_params[] = $name."=".urlencode($value);
						}
					}
				}
			}
		}
		if ($array_search_params) {
			if (count($array_search_params) > 0) {
				$url_search_params = implode("&", $array_search_params);
			}
		}
		return $url_search_params;
	}



	function system_getFormInputSearchParams($array) {
		$url_search_params = "";
		$array_search_params = array();
		if ($array) {
			if (count($array) > 0) {
				foreach ($array as $name=>$value) {
					$pos = string_strpos($name, "search_");
					if (($pos !== false) && ($pos == 0)) {
						if ($value) {
							$array_search_params[] = "<input type=\"hidden\" name=\"".$name."\" value=\"".$value."\" />";
						}
					}
				}
			}
		}
		if ($array_search_params) {
			if (count($array_search_params) > 0) {
				$url_search_params = implode("\n", $array_search_params);
			}
		}
		return $url_search_params;
	}
	
	function system_getFormInputHiddenParams($array, $except = "") {
		$exceptArray = explode(",", $except);
		$url_hidden_params = "";
		$array_hidden_params = array();
		if ($array) {
			if (count($array) > 0) {
				foreach ($array as $name=>$value) {
					if ($value && (!in_array($name, $exceptArray))) {
						$array_hidden_params[] = "<input type=\"hidden\" name=\"".$name."\" value=\"".$value."\" />";
					}
					
				}
			}
		}
		if ($array_hidden_params) {
			if (count($array_hidden_params) > 0) {
				$url_hidden_params = implode("\n", $array_hidden_params);
			}
		}
		return $url_hidden_params;
	}

	function system_denyInjections($var, $text = false) {
		
		$var = strip_tags($var);
		$var_aux = urlencode($var);
        if ($text) {
            $var = htmlspecialchars_decode($var);
            $var = nl2br($var);
		} elseif ((string_strpos($var_aux, "%0") !== false) || (string_strpos($var_aux, "%1") !== false)){
			    $var = "";
		}
		
		return $var;
	}

	function system_showFrontGallery($galleries = 0, $level = 0, $user = false, $imagesToShow = GALLERY_DETAIL_IMAGES, $type = "listing", $lang=EDIR_LANGUAGE, $tPreview = false) {
       
        if ($tPreview) {
			$gallery_code_final = "	<ul>";
			$gallery_code_final .= "	<li>";
			$gallery_code_final .= "		<span class=\"no-image\" style=\"cursor: default;\">";
			$gallery_code_final .= "		</span>";
			$gallery_code_final .= "	</li>";
			$gallery_code_final .= "	<li>";
			$gallery_code_final .= "		<span class=\"no-image\" style=\"cursor: default;\">";
			$gallery_code_final .= "		</span>";
			$gallery_code_final .= "	</li>";
			$gallery_code_final .= "	<li class=\"pd-0\">";
			$gallery_code_final .= "		<span class=\"no-image\" style=\"cursor: default;\">";
			$gallery_code_final .= "		</span>";
			$gallery_code_final .= "	</li>";
			$gallery_code_final .= "</ul>";
			$gallery_code_final .= "<p class=\"caption\">";
			$gallery_code_final .= "	<a href=\"javascript:void(0);\" style=\"cursor: default;\">".system_showText(LANG_GALLERYCLICKHERE)."</a> ";
			$gallery_code_final .= "	".system_showText(LANG_GALLERYSLIDESHOWTEXT);
			$gallery_code_final .= "</p>";
		} else {
			$langIndex = language_getIndex($lang);

			$gallery_code_final = "";

			if (count($galleries)>0) {

				if ($type=="listing") $item_max_gallery = LISTING_MAX_GALLERY;
				elseif ($type=="event") $item_max_gallery = EVENT_MAX_GALLERY;
				elseif ($type=="classified") $item_max_gallery = CLASSIFIED_MAX_GALLERY;
				elseif ($type=="article") $item_max_gallery = ARTICLE_MAX_GALLERY;
				else return "";

				while (count($galleries) > $item_max_gallery) {
					array_pop($galleries);
				}

				foreach ($galleries as $each_gallery) {

					$gallery_code = "";

					$galleryObj = new Gallery($each_gallery);

					if ($galleryObj->getNumber("id") && $galleryObj->image && count($galleryObj->image) > 0) {

						if ($type=="listing") $galleryLevel = new ListingLevel();
						elseif ($type=="event") $galleryLevel = new EventLevel();
						elseif ($type=="classified") $galleryLevel = new ClassifiedLevel();
						elseif ($type=="article") $galleryLevel = new ArticleLevel();
						else return "";

						$maxImages = $galleryLevel->getImages($level);

						if (($maxImages) && (($maxImages > 0) || ($maxImages == -1))) {

							$totalImages = ($maxImages >= count($galleryObj->image)) ? count($galleryObj->image) : $maxImages;
							if ($maxImages == -1) $totalImages = count($galleryObj->image);

							$gallery_code .= "<ul>";

							$number_of_images = 0;

							$i = 0;
							for ($imgInd = 0; $imgInd < $totalImages; $imgInd++) {

								$presentImg = $galleryObj->image[$imgInd];

								$imageObj = new Image($presentImg["image_id"]);
								$imageThumbObj = new Image($presentImg["thumb_id"]);

								$slideshowpopup = "javascript:void(0);";
								$slideshowpopupc = "javascript:void(0);";
								$slideshowstyle = "style=\"cursor:default;\"";
								if ($user){
									$slideshowpopup = DEFAULT_URL."/popup/popup.php?pop_type=slideshow&amp;gallery_id=".$each_gallery."&amp;".$type."_level=".$level."&amp;image_id=".$presentImg["image_id"];
									$slideshowpopupc = DEFAULT_URL."/popup/popup.php?pop_type=slideshow&amp;gallery_id=".$each_gallery."&amp;".$type."_level=".$level;
									$slideshowstyle = "";
								}

								if ($imageObj->imageExists() && $imageThumbObj->imageExists()) {

									if ($number_of_images < $imagesToShow) {

										$gallery_code .= "<li ".(($imgInd == ($imagesToShow - 1)) ? ("class=\"pd-0\"") : ("")).">";
										$gallery_code .= "<a href=\"".$slideshowpopup."\" $slideshowstyle class=\"iframe fancy_window_gallery\">";
										$gallery_code .= $imageThumbObj->getTag(true, IMAGE_GALLERY_THUMB_WIDTH, IMAGE_GALLERY_THUMB_HEIGHT, $presentImg["thumb_caption".$langIndex], true);
										$wrapWidth = (IMAGE_GALLERY_THUMB_WIDTH/5); // each character have a width of 5px
										$gallery_code .= "</a>";
										$gallery_code .= "</li>";

									}

									$number_of_images++;

									$i++;

								}

							}

							$gallery_code .= "</ul>";

							$gallery_code .= "<p class=\"caption\"><a href=\"".$slideshowpopupc."\" $slideshowstyle class=\"iframe fancy_window_gallery\">".system_showText(LANG_GALLERYCLICKHERE)."</a> ".system_showText(LANG_GALLERYSLIDESHOWTEXT)."</p>";
							
						}

						unset($galleryLevel);
						unset($galleryObj);

						if ($number_of_images==0) $gallery_code = "";

					}

					$gallery_code_final .= $gallery_code;

				}

			}
		}

		return $gallery_code_final;

	}
    
    function system_showFrontGalleryPlugin($galleries = 0, $level = 0, $user = false, $imagesToShow = GALLERY_DETAIL_IMAGES, $type = "listing", $lang=EDIR_LANGUAGE, $tPreview = false, &$onlyMain = false) {
        
        if ($tPreview) {
            
            if ($type=="listing") $galleryLevel = new ListingLevel();
            elseif ($type=="event") $galleryLevel = new EventLevel();
            elseif ($type=="classified") $galleryLevel = new ClassifiedLevel();
            elseif ($type=="article") $galleryLevel = new ArticleLevel();
            else return "";
            
            $maxImages = $galleryLevel->getImages($level);
            $totalImages = ($maxImages >= 4) ? 4 : $maxImages;

            if ($maxImages && (($maxImages > 0) || ($maxImages == -1))){
                $gallery_code_final .= "<ul class=\"ad-thumb-list\">";
                for ($imgInd = 0; $imgInd < $totalImages; $imgInd++) {
                    $gallery_code_final .= "	<li>";
                    $gallery_code_final .= "		<span class=\"no-image\" style=\"cursor: default;\">";
                    $gallery_code_final .= "		</span>";
                    $gallery_code_final .= "	</li>";
                }
                $gallery_code_final .= "</ul>";
            }
		} else {
			$langIndex = language_getIndex($lang);

			$gallery_code_final = "";
			$gallery_code_final .= system_addGalleryScript();

			if (count($galleries)>0) {

				foreach ($galleries as $each_gallery) {

					$gallery_code = "";

					$galleryObjAux = new Gallery($each_gallery); //Gallery without the main image
					$galleryObj = new Gallery($each_gallery, SELECTED_DOMAIN_ID, true);
                    
                    if ($type=="listing") $galleryLevel = new ListingLevel();
                    elseif ($type=="event") $galleryLevel = new EventLevel();
                    elseif ($type=="classified") $galleryLevel = new ClassifiedLevel();
                    elseif ($type=="article") $galleryLevel = new ArticleLevel();
                    else return "";
                    
                    $maxImages = $galleryLevel->getImages($level);

                    if ($galleryObjAux->getNumber("id") && $galleryObjAux->image && count($galleryObjAux->image) > 0 && $maxImages && (($maxImages > 0) || ($maxImages == -1))){
                        $useGallery = true;
                    } else {
                        $useGallery = false;
                        $gallery_code_final = "";
                        $onlyMain = true;
                    }
                    
					if ($galleryObj->getNumber("id") && $galleryObj->image && count($galleryObj->image) > 0 && $useGallery) {

                        $hasMainImage = false;
                        for ($imgInd = 0; $imgInd < count($galleryObj->image); $imgInd++) {
                            if ($galleryObj->image[$imgInd]["image_default"] == "y"){
                               $hasMainImage = true;
                               break;
                            }                           
                        }

						if (($maxImages) && (($maxImages > 0) || ($maxImages == -1))) {

							$totalImages = ($maxImages >= count($galleryObj->image)) ? count($galleryObj->image) : $maxImages;
                            
                            if ($hasMainImage){
                                $totalImages++;
                            }
                            
							if ($maxImages == -1) $totalImages = count($galleryObj->image);

							$gallery_code .= "<div class=\"ad-image-wrapper image-shadow\">
                                              </div>
                                              <!---<div class=\"ad-controls\">
                                              </div>-->
                                              <div class=\"ad-nav\">
                                                <div class=\"ad-thumbs gallery\">
                                                    <ul class=\"ad-thumb-list\">";

							$number_of_images = 0;

							$i = 0;
							for ($imgInd = 0; $imgInd < $totalImages; $imgInd++) {

								$presentImg = $galleryObj->image[$imgInd];

								$imageObj = new Image($presentImg["image_id"]);
								$imageThumbObj = new Image($presentImg["thumb_id"]);

								if ($imageObj->imageExists() && $imageThumbObj->imageExists()) {

                                    $gallery_code .= "<li>";
                                    $gallery_code .= "<a href=\"".$imageObj->getPath()."\">";
                                    $gallery_code .= $imageThumbObj->getTag(true, IMAGE_GALLERY_THUMB_WIDTH, IMAGE_GALLERY_THUMB_HEIGHT, $presentImg["thumb_caption".$langIndex], true, $presentImg["image_caption".$langIndex]);
                                    $gallery_code .= "</a>";
                                    $gallery_code .= "</li>";

									$number_of_images++;

									$i++;

								}

							}

							$gallery_code .= "</ul></div></div>";

							
						}

						unset($galleryLevel);
						unset($galleryObj);

						if ($number_of_images==0) $gallery_code = "";

					}

					$gallery_code_final .= $gallery_code;

				}

			}
		}
        if (!$gallery_code && !$tPreview) $gallery_code_final = "";
		return $gallery_code_final;
    }
    
    function system_addGalleryScript(){
        $script = "";
        $script .= "<script type=\"text/javascript\">
                        //<![CDATA[
                            $(function() {
                            galleries = $('.ad-gallery').adGallery({
                                loader_image: '".DEFAULT_URL."/images/img_loading.gif"."',
                                width: ".IMAGE_LISTING_FULL_WIDTH.",
                                height: ".IMAGE_LISTING_FULL_HEIGHT.",
                                display_next_and_prev: false
                            });
                            });
                        //]]>
                    </script>";
        return $script;
    }

	function system_highlightFirstWord($word, $amount=1) {
		if ($amount <= 1) {
			if (($pos = string_strpos($word, " ")) !== false) {
				return "<span>".string_substr($word, 0, $pos)."</span>".string_substr($word, $pos);
			} else {
				return $word;
			}
		} else {
			$words = explode(" ", $word);
			if (count($words) >= 2) {
				if ($amount <= count($words)) {
					$words[$amount-1] = $words[$amount-1]."</span>";
				} else {
					$words[count($words)-1] = $words[count($words)-1]."</span>";
				}
				return "<span>".implode(" ", $words);
			} else {
				return $word;
			}
		}
	}

	function system_highlightLastWord($word, $amount=1) {
		if ($amount <= 1) {
			if (($pos = string_strrpos($word, " ")) !== false) {
				return string_substr($word, 0, $pos+1)."<span>".string_substr($word, $pos+1)."</span>";
			} else {
				return $word;
			}
		} else {
			$words = explode(" ", $word);
			if (count($words) >= 2) {
				if ($amount <= count($words)) {
					$words[count($words)-$amount] = "<span>".$words[count($words)-$amount];
				} else {
					$words[0] = "<span>".$words[0];
				}
				return implode(" ", $words)."</span>";
			} else {
				return $word;
			}
		}
	}

	function system_highlightWords($word) {
		return "<span>".$word."</span>";
	}

	function system_showText($text) {
		return $text;
	}

	function system_showDate($format_str, $time=false) {
		if (!string_strlen(trim($format_str))) return false;
		if (!$time) $time = mktime(date('H'),date('i'),date('s'),date('n'),date('j'),date('Y'));
		$allow_datechars = array('d','D','j','l','N','S','w','z','W','F','m','M','n','t','L','o','Y','y','a','A','B','g','G','h','H','i','s','u','e','I','O','P','T','Z','c','r','U','\\');
		$month_names = explode(",", LANG_DATE_MONTHS);
		$weekday_names = explode(",", LANG_DATE_WEEKDAYS);
		$aux_format_str = $format_str;
		$buffer = "";
		for ($i=0; $i<string_strlen($aux_format_str); $i++) {
			if (in_array($aux_format_str[$i], $allow_datechars)) {
				//d -> Day of the month, 2 digits with leading zeros.
				if ($aux_format_str[$i] == "d") { $buffer .= date("d", $time); }
				//D -> A textual representation of a day, three letters.
				if ($aux_format_str[$i] == "D") { $buffer .= string_substr($weekday_names[date("j", $time)-1], 0, 3); }
				//j -> Day of the month without leading zeros.
				if ($aux_format_str[$i] == "j") { $buffer .= date("j", $time); }
				//l -> A full textual representation of the day of the week.
				if ($aux_format_str[$i] == "l") { $buffer .= $weekday_names[date("j", $time)-1]; }
				//N -> ISO-8601 numeric representation of the day of the week.
				if ($aux_format_str[$i] == "N") { $buffer .= date("N", $time); }
				//S -> English ordinal suffix for the day of the month, 2 characters.
				if ($aux_format_str[$i] == "S") { $buffer .= date("S", $time); }
				//w -> Numeric representation of the day of the week.
				if ($aux_format_str[$i] == "w") { $buffer .= date("w", $time); }
				//z -> The day of the year (starting from 0).
				if ($aux_format_str[$i] == "z") { $buffer .= date("z", $time); }
				//W -> ISO-8601 week number of year, weeks starting on Monday.
				if ($aux_format_str[$i] == "W") { $buffer .= date("W", $time); }
				//F -> A full textual representation of a month, such as January or March.
				if ($aux_format_str[$i] == "F") { $buffer .= string_ucwords($month_names[date("n", $time)-1]); }
				//m -> Numeric representation of a month, with leading zeros.
				if ($aux_format_str[$i] == "m") { $buffer .= date("m", $time); }
				//M -> A short textual representation of a month, three letters.
				if ($aux_format_str[$i] == "M") { $buffer .= date("M", $time); }
				//n -> Numeric representation of a month, without leading zeros.
				if ($aux_format_str[$i] == "n") { $buffer .= date("n", $time); }
				//t -> Number of days in the given month.
				if ($aux_format_str[$i] == "t") { $buffer .= date("t", $time); }
				//L -> Whether it's a leap year.
				if ($aux_format_str[$i] == "L") { $buffer .= date("L", $time); }
				//o -> ISO-8601 year number. This has the same value as Y, except that if the ISO week number (W) belongs to the previous or next year, that year is used instead.
				if ($aux_format_str[$i] == "o") { $buffer .= date("o", $time); }
				//Y -> A full numeric representation of a year, 4 digits.
				if ($aux_format_str[$i] == "Y") { $buffer .= date("Y", $time); }
				//y -> A two digit representation of a year.
				if ($aux_format_str[$i] == "y") { $buffer .= date("y", $time); }
				//a -> Lowercase Ante meridiem and Post meridiem.
				if ($aux_format_str[$i] == "a") { $buffer .= date("a", $time); }
				//A -> Uppercase Ante meridiem and Post meridiem.
				if ($aux_format_str[$i] == "A") { $buffer .= date("A", $time); }
				//B -> Swatch Internet time.
				if ($aux_format_str[$i] == "B") { $buffer .= date("B", $time); }
				//g -> 12-hour format of an hour without leading zeros.
				if ($aux_format_str[$i] == "g") { $buffer .= date("g", $time); }
				//G -> 24-hour format of an hour without leading zeros.
				if ($aux_format_str[$i] == "G") { $buffer .= date("G", $time); }
				//h -> 12-hour format of an hour with leading zeros.
				if ($aux_format_str[$i] == "h") { $buffer .= date("h", $time); }
				//H -> 24-hour format of an hour with leading zeros.
				if ($aux_format_str[$i] == "H") { $buffer .= date("H", $time); }
				//i -> Minutes with leading zeros.
				if ($aux_format_str[$i] == "i") { $buffer .= date("i", $time); }
				//s -> Seconds, with leading zeros.
				if ($aux_format_str[$i] == "s") { $buffer .= date("s", $time); }
				//u -> Microseconds.
				if ($aux_format_str[$i] == "u") { $buffer .= date("u", $time); }
				//e -> Timezone identifier.
				if ($aux_format_str[$i] == "e") { $buffer .= date("e", $time); }
				//I -> Whether or not the date is in daylight saving time.
				if ($aux_format_str[$i] == "I") { $buffer .= date("I", $time); }
				//O -> Difference to Greenwich time (GMT) in hours.
				if ($aux_format_str[$i] == "O") { $buffer .= date("O", $time); }
				//P -> Difference to Greenwich time (GMT) with colon between hours and minutes.
				if ($aux_format_str[$i] == "P") { $buffer .= date("P", $time); }
				//T -> Timezone abbreviation.
				if ($aux_format_str[$i] == "T") { $buffer .= date("T", $time); }
				//Z -> Timezone offset in seconds. The offset for timezones west of UTC is always negative, and for those east of UTC is always positive.
				if ($aux_format_str[$i] == "Z") { $buffer .= date("Z", $time); }
				//c -> ISO 8601 date.
				if ($aux_format_str[$i] == "c") { $buffer .= date("c", $time); }
				//r -> RFC 2822 formatted date.
				if ($aux_format_str[$i] == "r") { $buffer .= date("r", $time); }
				//U -> Seconds since the Unix Epoch (January 1 1970 00:00:00 GMT).
				if ($aux_format_str[$i] == "U") { $buffer .= date("U", $time); }
				//\ -> escape.
				if ($aux_format_str[$i] == "\\") {
					$i++;
					$buffer .= $aux_format_str[$i];
				}
			} else {
				$buffer .= $aux_format_str[$i];
			}
		}
		return $buffer;
	}

	function system_itemRelatedCategories($item_id, $item_type, $user, $have_data = false, $data = false) {

		$return = "";
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		$lang = EDIR_LANGUAGE;
		$dbObj_main = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObj_main);

		if ($have_data) {

			if ($item_type == "deal" ){
				$itemObj = new Listing($data);
			}else if ($item_type == "listing"){
				$itemObj = new Listing($data);
			}elseif ($item_type == "event"){
				 $itemObj = new Event($data);

			}elseif ($item_type == "classified"){
				$itemObj = new Classified($data);
			}elseif ($item_type == "article"){
			 	$itemObj = new Article($data);
			}
		} else {
			/*
			 * Perform optimization
			 *
			if ($item_type == "listing") $itemObj = new Listing($item_id);
			else
			 */

			if ($item_type == "event") $itemObj = new Event($item_id);
			elseif ($item_type == "classified") $itemObj = new Classified($item_id);
			elseif ($item_type == "article") $itemObj = new Article($item_id);
		}


		if(($item_type == "listing" || $item_type=='deal') && $item_id){

			$listingObj = new Listing();
			$categories = $listingObj->getCategories($have_data, $data, $item_id);

			for($i=0;$i<count($categories);$i++){
				if ($categories[$i]["title".$langIndex] && $categories[$i]["enabled"] == "y" && string_strpos($categories[$i]["lang"], EDIR_LANGUAGE) !== false) {
                    if ($item_type=='listing')
                        $urlToModule=LISTING_DEFAULT_URL;
                    else if ($item_type=='deal')
                        $urlToModule=PROMOTION_DEFAULT_URL;
					if ($user) {
						if (MODREWRITE_FEATURE != "on") {
							$categoriesString[] = "<a href=\"".$urlToModule."/results.php?category_id=".$categories[$i]["id"]."\">".format_getString($categories[$i]["title".$langIndex])."</a>";
						} else {
							$categoriesString[] = "<a href=\"".$urlToModule."/guide/".$categories[$i]["friendly_url".$langIndex]."\">".format_getString($categories[$i]["title".$langIndex])."</a>";
						}
					} else {
						$categoriesString[] = "<a href=\"javascript:void(0);\" style=\"cursor:default\">".format_getString($categories[$i]["title".$langIndex])."</a>";
					}
				}
			}

			if ($categoriesString) {
				$return = system_showText(LANG_SEARCHRESULTS_CATEGORY)." ".implode(", ", $categoriesString);
			}

		}elseif ($itemObj && $itemObj->getNumber("id") && ($itemObj->getNumber("id")>0)) {

			$categories = $itemObj->getCategories($have_data, $data);
			if ($categories) {
				foreach ($categories as $category) {
					$treePath = getTreePath($category->getNumber("id"), $item_type);
					$treePath = string_substr($treePath, 1);
					if (string_strpos($treePath, ",") !== false) $mainCategoryID = string_substr($treePath, 0, string_strpos($treePath, ","));
					else $mainCategoryID = $treePath;
					if ($mainCategoryID) {
						$query = "SELECT * FROM ".string_ucwords($item_type)."Category WHERE id = ".$mainCategoryID;
						$result = $db->query($query);
						if (mysql_num_rows($result) > 0) {
							while ($row = mysql_fetch_assoc($result)) {
								$lang_result = $row["lang"];
								$mainCategoryID = $row;
							}
						}
						$array_langs = explode(",", $lang_result);
						if (in_array($lang, $array_langs)) {
							$mainCategoriesID[] = $mainCategoryID;
						}
					//$mainCategoriesID[] = $mainCategoryID;
					}
				}

				if ($mainCategoriesID) {
					$mainCategoriesID = array_unique($mainCategoriesID);
					foreach ($mainCategoriesID as $mainCategoryID) {
						if ($item_type == "listing" || $item_type=='deal') {
							$mainCategoryObj = new ListingCategory($mainCategoryID);
							if ($mainCategoryObj->getString("title".$langIndex) && $mainCategoryObj->getString("enabled") == "y") {
                                if ($item_type=='listing')
                                    $urlToModule=LISTING_DEFAULT_URL;
                                else if ($item_type=='deal')
                                    $urlToModule=PROMOTION_DEFAULT_URL;
								if ($user) {
									if (MODREWRITE_FEATURE != "on") {
										$categoriesString[] = "<a href=\"".$urlToModule."/results.php?category_id=".$mainCategoryObj->getNumber("id")."\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
									} else {
										$categoriesString[] = "<a href=\"".$urlToModule."/guide/".$mainCategoryObj->getString("friendly_url".$langIndex)."\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
									}
								} else {
									$categoriesString[] = "<a href=\"javascript:void(0);\" style=\"cursor:default\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
								}
							}
						} elseif ($item_type == "event") {
							$mainCategoryObj = new EventCategory($mainCategoryID);
							if ($mainCategoryObj->getString("title".$langIndex) && $mainCategoryObj->getString("enabled") == "y") {
								if ($user) {
									if (MODREWRITE_FEATURE != "on") {
										$categoriesString[] = "<a href=\"".EVENT_DEFAULT_URL."/results.php?category_id=".$mainCategoryObj->getNumber("id")."\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
									} else {
										$categoriesString[] = "<a href=\"".EVENT_DEFAULT_URL."/guide/".$mainCategoryObj->getString("friendly_url".$langIndex)."\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
									}
								} else {
									$categoriesString[] = "<a href=\"javascript:void(0);\" style=\"cursor:default\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
								}
							}
						} elseif ($item_type == "classified") {
							$mainCategoryObj = new ClassifiedCategory($mainCategoryID);
							if ($mainCategoryObj->getString("title".$langIndex) && $mainCategoryObj->getString("enabled") == "y") {
								$categoryName = $mainCategoryObj->getString("title".$langIndex, true,50);
								if ($user) {
									if (MODREWRITE_FEATURE != "on") {
										$categoriesString[] = "<a href=\"".CLASSIFIED_DEFAULT_URL."/results.php?category_id=".$mainCategoryObj->getNumber("id")."\" title=\"".$mainCategoryObj->getString("title".$langIndex)."\">".$categoryName."</a>";
									} else {
										$categoriesString[] = "<a href=\"".CLASSIFIED_DEFAULT_URL."/guide/".$mainCategoryObj->getString("friendly_url".$langIndex)."\" title=\"".$mainCategoryObj->getString("title".$langIndex)."\">".$categoryName."</a>";
									}
								} else {
									$categoriesString[] = "<a href=\"javascript:void(0);\" style=\"cursor:default\">".$categoryName."</a>";
								}
							}
						} elseif ($item_type == "article") {
							$mainCategoryObj = new ArticleCategory($mainCategoryID);
							if ($mainCategoryObj->getString("title".$langIndex) && $mainCategoryObj->getString("enabled") == "y") {
								if ($user) {
									if (MODREWRITE_FEATURE != "on") {
										$categoriesString[] = "<a href=\"".ARTICLE_DEFAULT_URL."/results.php?category_id=".$mainCategoryObj->getNumber("id")."\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
									} else {
										$categoriesString[] = "<a href=\"".ARTICLE_DEFAULT_URL."/guide/".$mainCategoryObj->getString("friendly_url".$langIndex)."\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
									}
								} else {
									$categoriesString[] = "<a href=\"javascript:void(0);\" style=\"cursor:default\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
								}
							}
						}
					}
					if ($categoriesString) {
						$return = system_showText(LANG_SEARCHRESULTS_CATEGORY)." ".implode(", ", $categoriesString);
					}
				}
			}

		}

		return $return;
	}

    function system_accentOff($str) {

        $accents = array(
                        "A" => "/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/",
                        "a" => "/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/",
                        "C" => "/&Ccedil;/",
                        "c" => "/&ccedil;/",
                        "E" => "/&Egrave;|&Eacute;|&Ecirc;|&Euml;/",
                        "e" => "/&egrave;|&eacute;|&ecirc;|&euml;/",
                        "I" => "/&Igrave;|&Iacute;|&Icirc;|&Iuml;/",
                        "i" => "/&igrave;|&iacute;|&icirc;|&iuml;/",
                        "N" => "/&Ntilde;/",
                        "n" => "/&ntilde;/",
                        "O" => "/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/",
                        "o" => "/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/",
                        "U" => "/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/",
                        "u" => "/&ugrave;|&uacute;|&ucirc;|&uuml;/",
                        "Y" => "/&Yacute;/",
                        "y" => "/&yacute;|&yuml;/",
                        "a." => "/&ordf;/",
                        "o." => "/&ordm;/"
                        );

        return preg_replace(array_values($accents), array_keys($accents), string_htmlentities($str));
    }

	function system_showAccountUserName($username) {
		if (($pos = string_strpos($username, "::")) !== false) {
			$username = string_substr($username, $pos+2);
		}
		return $username;
	}

	function system_registerForeignAccount($authArray, $accountType, $attach_account = false, $email_notification = SYSTEM_NEW_PROFILE) {

		unset($foreignAccount);

		if (!$authArray) return false;
		if (!is_array($authArray)) return false;
		if (!$accountType) return false;

		unset($auth);

		if ($accountType == "openid") {
			if (!$authArray["openid_identity"]) return false;
			if ((string_strpos($authArray["openid_identity"], "http://") === false) && (string_strpos($authArray["openid_identity"], "https://") === false)) return false;
			$foreignAccount["username"] = $accountType."::".$authArray["openid_identity"];
			$openidURL = $authArray["openid_identity"];
			foreach($authArray as $key=>$value) {
				$auth[] = $key."=".$value;
				if ($key == "openid_sreg_email") {
					if ($value) {
						$foreignAccount["email"] = $value;
						$foreignAccount["foreignaccount_done"] = "y";
					}
				} elseif ($key == "openid_sreg_fullname") {
					if ($value) {
						if (string_strpos($value, " ") !== false) {
							$foreignAccount["first_name"] = string_substr($value, 0, string_strpos($value, " "));
							$foreignAccount["last_name"] = string_substr($value, string_strrpos($value, " ")+1);
						} else {
							$foreignAccount["last_name"] = $value;
						}
					}
				}
			}
		} elseif ($accountType == "facebook") {
			$thisusername = $authArray["first_name"].$authArray["last_name"];
			$thisusername = preg_replace('/[^0-9a-zA-Z]/i', '', $thisusername);
			$thisusername = string_strtolower($thisusername);
			$foreignAccount["facebook_username"] = $accountType."::".$thisusername."_".$authArray["uid"];

			if (!$attach_account){
				$foreignAccount["username"] = $accountType."::".$thisusername."_".$authArray["uid"];
				$foreignAccount["first_name"] = $authArray["first_name"];
				$foreignAccount["last_name"] = $authArray["last_name"];
			} else{
				/*
				 * Get account_id to update
				 */
				unset($accountObj);
				$accountObj = new Account($authArray["account_id"]);
				$foreignAccount["username"] = $accountObj->getNumber("username");

				/*
				 * Prepare $foreignAccount with edirectory information
				 */
				foreach ($accountObj as $key => $value) {
					$foreignAccount[$key] = $value;
				}

				unset($contactObj);
				$foreignAccount["facebook_username"] = $accountType."::".$thisusername."_".$authArray["uid"];

				$facebookUID = $authArray["uid"];

				$contactObj = new Contact($accountObj->getNumber("id"));
				foreach ($contactObj as $key => $value) {
					$foreignAccount[$key] = $value;
				}

				/*
				 * Check if needs do update on eDirectory account
				 */
				if($authArray["facebook_action"] == "facebook_import"){
					$foreignAccount["first_name"] = $authArray["first_name"];
					$foreignAccount["last_name"] = $authArray["last_name"];
				}

				$auxFirstName = $authArray["first_name"]; 
				$auxLastName = $authArray["last_name"]; 

				$foreignAccount["foreignaccount_done"] = "y";
			}

			foreach($authArray as $key=>$value) {
				$auth[] = $key."=".$value;
			}
		} elseif ($accountType == "google") {
			$foreignAccount["username"] = $accountType."::".$authArray["email"];
			$foreignAccount["first_name"] = $authArray["first_name"];
			$foreignAccount["last_name"] = $authArray["last_name"];
			foreach($authArray as $key=>$value) {
				$auth[] = $key."=".$value;
			}
		}

		$foreignAccount["foreignaccount"] = "y";
		$foreignAccount["foreignaccount_auth"] = implode(" || ", $auth);

		if ($accountType == "facebook"){
			$sql = "SELECT account_id FROM Profile WHERE facebook_uid = ".$authArray["uid"];

			$db = db_getDBObject(DEFAULT_DB, true);
			$result = $db->query($sql);

			if (mysql_num_rows($result)>0){
				$account = db_getFromDB("account", "facebook_username", db_formatString($foreignAccount["username"]));
			} else {
				$account = db_getFromDB("account", "username", db_formatString($foreignAccount["username"]));
			}

		} else {
			$account = db_getFromDB("account", "username", db_formatString($foreignAccount["username"]));
		}

		if (!($account->getNumber("id"))) {

			$info = image_getImageSizeByURL($authArray["picture"]);

			image_getNewDimension(100, 100, $info[0], $info[1], $newWidth, $newHeight);

			$account = new Account($foreignAccount);
			if ($authArray["email"]) $account->setString("foreignaccount_done", "y");
			$account->save();
			$account->setForeignAccountAuth($foreignAccount["foreignaccount_auth"]);
			
			$contact = new Contact($foreignAccount);
			$contact->setNumber("account_id", $account->getNumber("id"));
			if ($authArray["email"])
				$contact->setString("email", $authArray["email"]);
			$contact->setString("lang", $authArray["language"] ? $authArray["language"] : EDIR_DEFAULT_LANGUAGE);
			$contact->setString("use_lang", "y");
			$contact->save();
			
			$profile = new Profile();
			####################################################################################################
			####################################################################################################
			####################################################################################################
			# E-mail notify
			setting_get("sitemgr_send_email",$sitemgr_send_email);
			setting_get("sitemgr_email",$sitemgr_email);
			$sitemgr_emails = explode(",",$sitemgr_email);
			setting_get("sitemgr_account_email",$sitemgr_account_email);
			$sitemgr_account_emails = explode(",",$sitemgr_account_email);
			// sending e-mail to user //////////////////////////////////////////////////////////////////////////
			if ($emailNotificationObj = system_checkEmail($email_notification, $contact->getString("lang"))) {
				$subject = $emailNotificationObj->getString("subject");
				$body = $emailNotificationObj->getString("body");
				if ($accountType == "openid") $login_info = trim(system_findTranslationFor("LANG_LABEL_OPENIDURL", $emailNotificationObj->getString("lang"))).": ".$openidURL;
				if ($accountType == "facebook") $login_info = string_ucwords(system_showText(LANG_LABEL_FACEBOOK_ACCT)).": ".$contact->getString("email");
				if ($accountType == "google") $login_info = string_ucwords(system_showText(LANG_LABEL_GOOGLE_ACCT)).": ".$contact->getString("email");
				$body = str_replace("ACCOUNT_LOGIN_INFORMATION",$login_info,$body);

				$body = system_replaceEmailVariables($body, $account->getNumber("id"), 'account');
				$subject = system_replaceEmailVariables($subject, $account->getNumber("id"), 'account');
				$body = html_entity_decode($body);
				$subject = html_entity_decode($subject);
				system_mail($contact->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
			}
			////////////////////////////////////////////////////////////////////////////////////////////////////
			// site manager warning message /////////////////////////////////////
			$sitemgr_msg = "
				<html>
					<head>
						<style>
							.email_style_settings{
								font-size:12px;
								font-family:Verdana, Arial, Sans-Serif;
								color:#000;
							}
						</style>
					</head>
					<body>
						<div class=\"email_style_settings\">
							Site Manager,<br /><br />
							A new account was created in ".EDIRECTORY_TITLE.".<br />
							Please review the account information below:<br /><br />";
							$sitemgr_msg .= "<b>Username: </b>".system_showAccountUserName($account->getString("username"))."<br />";
							$sitemgr_msg .= "<b>First Name: </b>".$contact->getString("first_name")."<br />";
							$sitemgr_msg .= "<b>Last Name: </b>".$contact->getString("last_name")."<br />";
							$sitemgr_msg .= "<b>Company: </b>".$contact->getString("company")."<br />";
							$sitemgr_msg .= "<b>Address: </b>".$contact->getString("address")." ".$contact->getString("address2")."<br />";
							$sitemgr_msg .= "<b>City: </b>".$contact->getString("city")."<br />";
							$sitemgr_msg .= "<b>State: </b>".$contact->getString("state")."<br />";
							$sitemgr_msg .= "<b>".string_ucwords(ZIPCODE_LABEL).": </b>".$contact->getString("zip")."<br />";
							$sitemgr_msg .= "<b>Phone: </b>".$contact->getString("phone")."<br />";
							$sitemgr_msg .= "<b>Fax: </b>".$contact->getString("fax")."<br />";
							$sitemgr_msg .= "<b>Email: </b>".$contact->getString("email")."<br />";
							$sitemgr_msg .= "<b>URL: </b>".$contact->getString("url")."<br />";
							$sitemgr_msg .="<br /><a href=\"".DEFAULT_URL."/sitemgr/account/view.php?id=".$account->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/sitemgr/account/view.php?id=".$account->getNumber("id")."</a><br /><br />
						</div>
					</body>
				</html>";
			if ($sitemgr_send_email == "on") {
				if ($sitemgr_emails[0]) {
					foreach ($sitemgr_emails as $sitemgr_email) {
						system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] Account Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
					}
				}
			}
			if ($sitemgr_account_emails[0]) {
				foreach ($sitemgr_account_emails as $sitemgr_account_email) {
					system_mail($sitemgr_account_email, "[".EDIRECTORY_TITLE."] Account Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_account_email>", "text/html", '', '', $error);
				}
			}
			////////////////////////////////////////////////////////////////////
			####################################################################################################
			####################################################################################################
			####################################################################################################

		} else {
			$contact = new Contact($account->getNumber("id"));
			$profile = new Profile($account->getNumber("id"));

			if ($profile->getNumber("account_id") && $attach_account) {
				$foreignAccount["id"] = $account->getNumber("id");
				$info = image_getImageSizeByURL($authArray["picture"]);
				image_getNewDimension(100, 100, $info[0], $info[1], $newWidth, $newHeight);
				$account = new Account($foreignAccount);
				$account->save();
				$account->setForeignAccountAuth($foreignAccount["foreignaccount_auth"], $auxFirstName, $auxLastName);
				$contact = new Contact($foreignAccount);
				$contact->setNumber("account_id", $account->getNumber("id"));
				$contact->save();
			}
		}
		
		/*
		 * Update Account and Contact tables
		 */
		
		$profile->setNumber("account_id", $account->getNumber("id"));
		$profile->setString("facebook_uid", $authArray["uid"]);
		if (!$attach_account || ($attach_account && $authArray["facebook_action"] == "facebook_import")){
			$profile->setString("nickname", $authArray["nickname"] ? $authArray["nickname"] : $contact->getString("first_name")." ".$contact->getString("last_name"));
			$profile->setString("birth_city", $authArray["home_town"]);
			$profile->setString("favorite_books", $authArray["favorite_books"]);
			$profile->setString("favorite_movies", $authArray["favorite_movies"]);
			$profile->setString("favorite_musics", $authArray["favorite_musics"]);
			$profile->setString("personal_message", $authArray["personal_message"]);
			$profile->setString("favorite_sports", $authArray["favorite_sports"]);
			$profile->setDate("birth_date", $authArray["birthday_date"]);
			$profile->setString("facebook_image", $authArray["picture"]);
			$profile->setNumber("facebook_image_width", $newWidth ? $newWidth : 100);
			$profile->setNumber("facebook_image_height", $newHeight ? $newHeight : 100);
			$profile->setString("location", $authArray["location"]);
		}
		$profile->Save();

		$accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
		$accDomain->Save();
		$accDomain->saveOnDomain($account->getNumber("id"), $account, $contact, $profile);

		if ($account->getNumber("id")) {
			if ($account_type == "facebook"){
				sess_registerAccountInSession($account->getString("facebook_username"), true);
			} else {
				sess_registerAccountInSession($account->getString("username"));
			}
			return true;
		}

		return false;

	}

    function system_addTinyMCE($lang, $mode, $theme, $field_name, $textRows, $textCols, $width, $content, $include_script = true) {
        ?>

        <!-- TinyMCE -->
        <?
        if ( $include_script ) { ?>
            <script type="text/javascript" src="<?=NON_LANG_URL?>/includes/tiny_mce/tiny_mce_src.js"></script> <?
        } ?>
        <script type="text/javascript">
            // Default skin
			var inlinePopUps = "inlinepopups,";
			if ($.browser.msie && $.browser.version == 9){
				inlinePopUps = "";
			}
            tinyMCE.init({
                // General options
                mode : "<?=$mode?>",
                elements : "<?=$field_name?>",
                theme : "<?=$theme?>",
                width: "<?=$width?>",
                plugins : "imagemanager,safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras," + inlinePopUps + "template,autosave",
//                language : '<?=$lang?>',
                language : 'en',
				extended_valid_elements : "iframe[src|width|height|name|align]",
                // Theme options
                theme_advanced_buttons1 : "formatselect,fontselect,fontsizeselect,|,undo,redo,|,bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,|,cut,copy,paste,pasteword,|,link,unlink,",
                theme_advanced_buttons2 : "anchor,image,media,emotions,tablecontrols,bullist,numlist,|,print,fullscreen,|,attribs,code,styleprops,preview,|,forecolor,backcolor",
                theme_advanced_buttons3 : "",
                theme_advanced_buttons4 : "",
                theme_advanced_buttons5 : "",

                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_resizing : false,
                convert_urls : false
            });

        </script>
        <!-- /TinyMCE -->
        <textarea id="<?=$field_name?>" name="<?=$field_name?>" rows="<?=$textRows?>" cols="<?=$textCols?>" style="width: 80%"><?=$content?></textarea>
        <?
    }

    function  system_displayTinyMCE($txId) {

    	$return_editor = "
    	<!-- TinyMCE -->
    	<script type=\"text/javascript\">

    		//tinyMCE.execCommand('mceRemoveControl', false, '$txId-1');
    		//tinyMCE.execCommand('mceFocus', false, '$txId');
    		tinyMCE.execCommand('mceAddControl', false, '$txId');

    	</script>
    	<!-- /TinyMCE -->";
    	echo $return_editor;
	}
	
	function system_getLastWeek(){

		$week = date('W');
		$year = date('Y');

		$lastweek = $week-1;

		if ($lastweek==0){
			$week = 52;
			$year--;
		}

		$lastweek = sprintf("%02d", $lastweek);
		for ($i=1; $i <= 7; $i++){
			$arrdays[] = strtotime("$year". "W$lastweek"."$i");
		}
		return $arrdays;

	}

	function system_getRevenue() {
		//$one_year_ago = date("Y-m-d H:i:s", strtotime("-1 years"));
		$one_month_ago = date("Y-m-d H:i:s", strtotime("-1 months"));
		$one_week_ago = date("Y-m-d H:i:s", strtotime("-1 weeks"));

		$dbObj = db_getDBObJect(DEFAULT_DB,true);
		$dbObjSecond = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID,$dbObj);
		
		/*
		 * Calculate last year revenue
		 */

//		$sql = "SELECT SUM(transaction_amount) AS total FROM Payment_Log WHERE transaction_status in ('Completed', 'Approved', 'Accepted', 'Success', 'SIMPLEPAYSUCCESS', 'Y') AND transaction_datetime > '".$one_year_ago."'";
//		$result = $dbObjSecond->query($sql);
//		if (mysql_num_rows($result) > 0) {
//			$row = mysql_fetch_assoc($result);
//			$total_payment_year = $row['total'];
//		}
//		$sql = "SELECT SUM(amount) AS total FROM Invoice WHERE status = 'R' AND payment_date > '".$one_year_ago."'";
//		$result = $dbObjSecond->query($sql);
//		if (mysql_num_rows($result) > 0) {
//			$row = mysql_fetch_assoc($result);
//			$total_invoice_year = $row['total'];
//		}
//		$total_year = $total_payment_year + $total_invoice_year;
		
		/*
		 * Calculate last month revenue
		 */

		$sql = "SELECT SUM(transaction_amount) AS total FROM Payment_Log WHERE transaction_status in ('Completed', 'Approved', 'Accepted', 'Success', 'SIMPLEPAYSUCCESS', 'Y') AND transaction_datetime > '".$one_month_ago."'";
		$result = $dbObjSecond->query($sql);
		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_assoc($result);
			$total_payment_month = $row['total'];
		}
		$sql = "SELECT SUM(amount) AS total FROM Invoice WHERE status = 'R' AND payment_date > '".$one_month_ago."'";
		$result = $dbObjSecond->query($sql);
		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_assoc($result);
			$total_invoice_month = $row['total'];
		}
		$total_month = $total_payment_month + $total_invoice_month;
		
		/*
		 * Calculate last week revenue
		 */

		$sql = "SELECT SUM(transaction_amount) AS total FROM Payment_Log WHERE transaction_status in ('Completed', 'Approved', 'Accepted', 'Success', 'SIMPLEPAYSUCCESS', 'Y') AND transaction_datetime > '".$one_week_ago."'";
		$result = $dbObjSecond->query($sql);
		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_assoc($result);
			$total_payment_week = $row['total'];
		}
		$sql = "SELECT SUM(amount) AS total FROM Invoice WHERE status = 'R' AND payment_date > '".$one_week_ago."'";
		$result = $dbObjSecond->query($sql);
		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_assoc($result);
			$total_invoice_week = $row['total'];
		}
		$total_week = $total_payment_week + $total_invoice_week;
		
		//$array_revenue["year"] = format_money($total_year);
		$array_revenue["month"] = format_money($total_month);
		$array_revenue["week"] = format_money($total_week);
		
		return $array_revenue;
    }

	function system_freqActions_returnLabelLink($session, &$label, &$link) {

		if ($session=="listing_manage") {
			$label = LANG_SITEMGR_NAVBAR_LISTING." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/index.php";
		}elseif ($session=="listing_add") {
			$label = LANG_SITEMGR_NAVBAR_LISTING." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/listinglevel.php";
		}elseif ($session=="listing_search") {
			$label = LANG_SITEMGR_NAVBAR_LISTING." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/search.php";
		}elseif ($session=="listingcateg_manage") {
			$label = LANG_SITEMGR_NAVBAR_LISTING." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/listingcategs/index.php";
		}elseif ($session=="listingcateg_add") {
			$label = LANG_SITEMGR_NAVBAR_LISTING." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/listingcategs/category.php";
		}elseif ($session=="listing_featuredcateg") {
			$label = LANG_SITEMGR_NAVBAR_LISTING." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_FEATUREDCATEGORY_PLURAL;
			$link = DEFAULT_URL."/sitemgr/listingcategs/featured.php";
		}elseif ($session=="listingcateg_disabled") {
			$label = LANG_SITEMGR_NAVBAR_LISTING." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_DISABLED2;
			$link = DEFAULT_URL."/sitemgr/listingcategs/disabled.php";
		}elseif ($session=="reviewlisting_manage") {
			$label = LANG_SITEMGR_NAVBAR_LISTING." &rsaquo; ".LANG_SITEMGR_REVIEWS." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/review/index.php?item_type=listing";
		}elseif ($session=="claimlisting_manage") {
			$label = LANG_SITEMGR_NAVBAR_LISTING." &rsaquo; ".LANG_SITEMGR_CLAIMED." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/claim/";
		}elseif ($session=="claimlisting_search") {
			$label = LANG_SITEMGR_NAVBAR_LISTING." &rsaquo; ".LANG_SITEMGR_CLAIMED." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = DEFAULT_URL."/sitemgr/claim/search.php";
		}elseif ($session=="listingtemplate_manage") {
			$label = LANG_SITEMGR_NAVBAR_LISTING." &rsaquo; ".LANG_SITEMGR_MENU_TEMPLATES." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/listingtemplate/index.php";
		}elseif ($session=="listingtemplate_add") {
			$label = LANG_SITEMGR_NAVBAR_LISTING." &rsaquo; ".LANG_SITEMGR_MENU_TEMPLATES." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/listingtemplate/template.php";
		}elseif ($session=="listingtemplate_search") {
			$label = LANG_SITEMGR_NAVBAR_LISTING." &rsaquo; ".LANG_SITEMGR_MENU_TEMPLATES." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = DEFAULT_URL."/sitemgr/listingtemplate/search.php";
		}elseif ($session=="banner_manage") {
			$label = LANG_SITEMGR_NAVBAR_BANNER." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER."/index.php";
		}elseif ($session=="banner_add") {
			$label = LANG_SITEMGR_NAVBAR_BANNER." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER."/add.php";
		}elseif ($session=="banner_search") {
			$label = LANG_SITEMGR_NAVBAR_BANNER." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER."/search.php";
		}elseif ($session=="event_manage") {
			$label = LANG_SITEMGR_NAVBAR_EVENT." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/".EVENT_FEATURE_FOLDER."/index.php";
		}elseif ($session=="event_add") {
			$label = LANG_SITEMGR_NAVBAR_EVENT." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/".EVENT_FEATURE_FOLDER."/eventlevel.php";
		}elseif ($session=="event_search") {
			$label = LANG_SITEMGR_NAVBAR_EVENT." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = DEFAULT_URL."/sitemgr/".EVENT_FEATURE_FOLDER."/search.php";
		}elseif ($session=="eventcateg_manage") {
			$label = LANG_SITEMGR_NAVBAR_EVENT." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/eventcategs/index.php";
		}elseif ($session=="eventcateg_add") {
			$label = LANG_SITEMGR_NAVBAR_EVENT." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/eventcategs/category.php";
		}elseif ($session=="event_featuredcateg") {
			$label = LANG_SITEMGR_NAVBAR_EVENT." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_FEATUREDCATEGORY_PLURAL;
			$link = DEFAULT_URL."/sitemgr/eventcategs/featured.php";
		}elseif ($session=="eventcateg_disabled") {
			$label = LANG_SITEMGR_NAVBAR_EVENT." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_DISABLED2;
			$link = DEFAULT_URL."/sitemgr/eventcategs/disabled.php";
		}elseif ($session=="classified_manage") {
			$label = LANG_SITEMGR_NAVBAR_CLASSIFIED." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/".CLASSIFIED_FEATURE_FOLDER."/index.php";
		}elseif ($session=="classified_add") {
			$label = LANG_SITEMGR_NAVBAR_CLASSIFIED." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/".CLASSIFIED_FEATURE_FOLDER."/classifiedlevel.php";
		}elseif ($session=="classified_search") {
			$label = LANG_SITEMGR_NAVBAR_CLASSIFIED." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = DEFAULT_URL."/sitemgr/".CLASSIFIED_FEATURE_FOLDER."/search.php";
		}elseif ($session=="classifiedcateg_manage") {
			$label = LANG_SITEMGR_NAVBAR_CLASSIFIED." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/classifiedcategs/index.php";
		}elseif ($session=="classifiedcateg_add") {
			$label = LANG_SITEMGR_NAVBAR_CLASSIFIED." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/classifiedcategs/category.php";
		}elseif ($session=="classified_featuredcateg") {
			$label = LANG_SITEMGR_NAVBAR_CLASSIFIED." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_FEATUREDCATEGORY_PLURAL;
			$link = DEFAULT_URL."/sitemgr/classifiedcategs/featured.php";
		}elseif ($session=="classifiedcateg_disabled") {
			$label = LANG_SITEMGR_NAVBAR_CLASSIFIED." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_DISABLED2;
			$link = DEFAULT_URL."/sitemgr/classifiedcategs/disabled.php";
		}elseif ($session=="article_manage") {
			$label = LANG_SITEMGR_NAVBAR_ARTICLE." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/".ARTICLE_FEATURE_FOLDER."/index.php";
		}elseif ($session=="article_add") {
			$label = LANG_SITEMGR_NAVBAR_ARTICLE." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/".ARTICLE_FEATURE_FOLDER."/article.php";
		}elseif ($session=="article_search") {
			$label = LANG_SITEMGR_NAVBAR_ARTICLE." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = DEFAULT_URL."/sitemgr/".ARTICLE_FEATURE_FOLDER."/search.php";
		}elseif ($session=="articlecateg_manage") {
			$label = LANG_SITEMGR_NAVBAR_ARTICLE." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/articlecategs/index.php";
		}elseif ($session=="articlecateg_add") {
			$label = LANG_SITEMGR_NAVBAR_ARTICLE." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/articlecategs/category.php";
		}elseif ($session=="article_featuredcateg") {
			$label = LANG_SITEMGR_NAVBAR_ARTICLE." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_FEATUREDCATEGORY_PLURAL;
			$link = DEFAULT_URL."/sitemgr/articlecategs/featured.php";
		}elseif ($session=="articlecateg_disabled") {
			$label = LANG_SITEMGR_NAVBAR_ARTICLE." &rsaquo; ".LANG_SITEMGR_CATEGORIES." &rsaquo; ".LANG_SITEMGR_DISABLED2;
			$link = DEFAULT_URL."/sitemgr/articlecategs/disabled.php";
		}elseif ($session=="reviewarticle_manage") {
			$label = LANG_SITEMGR_NAVBAR_ARTICLE." &rsaquo; ".LANG_SITEMGR_REVIEWS." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/review/index.php?item_type=article";
		}elseif ($session=="reviewpromotion_manage") {
			$label = LANG_SITEMGR_NAVBAR_PROMOTION." &rsaquo; ".LANG_SITEMGR_REVIEWS." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/review/index.php?item_type=promotion";
		}elseif ($session=="promotion_manage") {
			$label = LANG_SITEMGR_NAVBAR_PROMOTION." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/coupon/index.php";
		}elseif ($session=="promotion_add") {
			$label = LANG_SITEMGR_NAVBAR_PROMOTION." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/".PROMOTION_FEATURE_FOLDER."/deal.php";
		}elseif ($session=="promotion_search") {
			$label = LANG_SITEMGR_NAVBAR_PROMOTION." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = DEFAULT_URL."/sitemgr/coupon/search.php";
		}elseif ($session=="content_general") {
			$label = LANG_SITEMGR_MENU_SITECONTENT." &rsaquo; ".LANG_SITEMGR_MENU_GENERAL;
			$link = DEFAULT_URL."/sitemgr/content/";
		}elseif ($session=="content_navigation") {
			$label = LANG_SITEMGR_MENU_SITECONTENT." &rsaquo; ".LANG_SITEMGR_SETTINGS_MODULES;
			$link = DEFAULT_URL."/sitemgr/content/navigation.php";
		}elseif ($session=="content_header") {
			$label = LANG_SITEMGR_MENU_SITECONTENT." &rsaquo; ".LANG_SITEMGR_MENU_GENERAL." &rsaquo; ".LANG_SITEMGR_HEADER;
			$link = DEFAULT_URL."/sitemgr/content/content_header.php";
		}elseif ($session=="content_footer") {
			$label = LANG_SITEMGR_MENU_SITECONTENT." &rsaquo; ".LANG_SITEMGR_MENU_GENERAL." &rsaquo; ".LANG_SITEMGR_FOOTER;
			$link = DEFAULT_URL."/sitemgr/content/content_footer.php";
		}elseif ($session=="content_noimage") {
			$label = LANG_SITEMGR_MENU_SITECONTENT." &rsaquo; ".LANG_SITEMGR_MENU_GENERAL." &rsaquo; ".LANG_SITEMGR_CONTENT_DEFAULTIMAGE;
			$link = DEFAULT_URL."/sitemgr/content/content_noimage.php";
		}elseif ($session=="content_icon") {
			$label = LANG_SITEMGR_MENU_SITECONTENT." &rsaquo; ".LANG_SITEMGR_MENU_GENERAL." &rsaquo; ".LANG_SITEMGR_CONTENT_ICON;
			$link = DEFAULT_URL."/sitemgr/content/content_icon.php";
		}elseif ($session=="content_advertisement") {
			$label = LANG_SITEMGR_MENU_SITECONTENT." &rsaquo; ".LANG_SITEMGR_ADVERTISEMENT;
			$link = DEFAULT_URL."/sitemgr/content/advertisement.php";
		}elseif ($session=="content_member") {
			$label = LANG_SITEMGR_MENU_SITECONTENT." &rsaquo; ".LANG_SITEMGR_MEMBER;
			$link = DEFAULT_URL."/sitemgr/content/member.php";
		}elseif ($session=="content_custom") {
			$label = LANG_SITEMGR_MENU_SITECONTENT." &rsaquo; ".LANG_SITEMGR_MENU_CUSTOM;
			$link = DEFAULT_URL."/sitemgr/content/client.php";
		}elseif ($session=="content_listing") {
			$label = LANG_SITEMGR_MENU_SITECONTENT." &rsaquo; ".LANG_SITEMGR_LISTING;
			$link = DEFAULT_URL."/sitemgr/content/listing.php";
		}elseif ($session=="content_event") {
			$label = LANG_SITEMGR_MENU_SITECONTENT." &rsaquo; ".LANG_SITEMGR_EVENT;
			$link = DEFAULT_URL."/sitemgr/content/event.php";
		}elseif ($session=="content_classified") {
			$label = LANG_SITEMGR_MENU_SITECONTENT." &rsaquo; ".LANG_SITEMGR_CLASSIFIED;
			$link = DEFAULT_URL."/sitemgr/content/classified.php";
		}elseif ($session=="content_article") {
			$label = LANG_SITEMGR_MENU_SITECONTENT." &rsaquo; ".LANG_SITEMGR_ARTICLE;
			$link = DEFAULT_URL."/sitemgr/content/article.php";
		}elseif ($session=="seocenter_manage") {
			$label = LANG_SITEMGR_NAVBAR_SEOCENTER;
			$link = DEFAULT_URL."/sitemgr/seocenter.php";
		}elseif ($session=="account_manage") {
			$label = LANG_SITEMGR_NAVBAR_MEMBERACCOUNTS." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/account/index.php";
		}elseif ($session=="account_add") {
			$label = LANG_SITEMGR_NAVBAR_MEMBERACCOUNTS." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/account/account.php";
		}elseif ($session=="account_search") {
			$label =LANG_SITEMGR_NAVBAR_MEMBERACCOUNTS." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = DEFAULT_URL."/sitemgr/account/search.php";
		}elseif ($session=="smaccount_manage") {
			$label = LANG_SITEMGR_NAVBAR_SITEMGRACCOUNTS." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/smaccount/index.php";
		}elseif ($session=="smaccount_add") {
			$label = LANG_SITEMGR_NAVBAR_SITEMGRACCOUNTS." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/smaccount/smaccount.php";
		}elseif ($session=="smaccount_search") {
			$label = LANG_SITEMGR_NAVBAR_SITEMGRACCOUNTS." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = DEFAULT_URL."/sitemgr/smaccount/search.php";
		}elseif ($session=="location1_manage") {
			$label = constant("LANG_SITEMGR_NAVBAR_".LOCATION1_SYSTEM_PLURAL)." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/locations/location_1/index.php";
		}elseif ($session=="location1_add") {
			$label = constant("LANG_SITEMGR_NAVBAR_".LOCATION1_SYSTEM_PLURAL)." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/locations/location_1/location_1.php?operation=add";
		}elseif ($session=="location1_featured") {
			$label = constant("LANG_SITEMGR_NAVBAR_".LOCATION1_SYSTEM_PLURAL)." &rsaquo; ".LANG_SITEMGR_LABEL_FEATURED;
			$link = DEFAULT_URL."/sitemgr/locations/location_1/featured.php";
		}elseif ($session=="location2_manage") {
			$label = constant("LANG_SITEMGR_NAVBAR_".LOCATION2_SYSTEM_PLURAL)." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/locations/location_2/index.php";
		}elseif ($session=="location2_add") {
			$label = constant("LANG_SITEMGR_NAVBAR_".LOCATION2_SYSTEM_PLURAL)." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/locations/location_2/location_2.php?operation=add";
		}elseif ($session=="location2_featured") {
			$label = constant("LANG_SITEMGR_NAVBAR_".LOCATION2_SYSTEM_PLURAL)." &rsaquo; ".LANG_SITEMGR_LABEL_FEATURED;
			$link = DEFAULT_URL."/sitemgr/locations/location_2/featured.php";
		}elseif ($session=="location3_manage") {
			$label = constant("LANG_SITEMGR_NAVBAR_".LOCATION3_SYSTEM_PLURAL)." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/locations/location_3/index.php";
		}elseif ($session=="location3_add") {
			$label = constant("LANG_SITEMGR_NAVBAR_".LOCATION3_SYSTEM_PLURAL)." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/locations/location_3/location_3.php?operation=add";
		}elseif ($session=="location3_featured") {
			$label = constant("LANG_SITEMGR_NAVBAR_".LOCATION3_SYSTEM_PLURAL)." &rsaquo; ".LANG_SITEMGR_LABEL_FEATURED;
			$link = DEFAULT_URL."/sitemgr/locations/location_3/featured.php";
		}elseif ($session=="location4_manage") {
			$label = constant("LANG_SITEMGR_NAVBAR_".LOCATION4_SYSTEM_PLURAL)." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/locations/location_4/index.php";
		}elseif ($session=="location4_add") {
			$label = constant("LANG_SITEMGR_NAVBAR_".LOCATION4_SYSTEM_PLURAL)." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/locations/location_4/location_4.php?operation=add";
		}elseif ($session=="location4_featured") {
			$label = constant("LANG_SITEMGR_NAVBAR_".LOCATION4_SYSTEM_PLURAL)." &rsaquo; ".LANG_SITEMGR_LABEL_FEATURED;
			$link = DEFAULT_URL."/sitemgr/locations/location_4/featured.php";
		}elseif ($session=="location5_manage") {
			$label = constant("LANG_SITEMGR_NAVBAR_".LOCATION5_SYSTEM_PLURAL)." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/locations/location_5/index.php";
		}elseif ($session=="location5_add") {
			$label = constant("LANG_SITEMGR_NAVBAR_".LOCATION5_SYSTEM_PLURAL)." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/locations/location_5/location_5.php?operation=add";
		}elseif ($session=="location5_featured") {
			$label = constant("LANG_SITEMGR_NAVBAR_".LOCATION5_SYSTEM_PLURAL)." &rsaquo; ".LANG_SITEMGR_LABEL_FEATURED;
			$link = DEFAULT_URL."/sitemgr/locations/location_5/featured.php";
		}elseif ($session=="import_home") {
			$label = LANG_SITEMGR_NAVBAR_DATA_MANAGEMENT." &rsaquo; ".LANG_SITEMGR_IMPORT;
			$link = DEFAULT_URL."/sitemgr/import/";
		}elseif ($session=="import_log") {
			$label = LANG_SITEMGR_NAVBAR_DATA_MANAGEMENT." &rsaquo; ".LANG_SITEMGR_IMPORT." &rsaquo; ".LANG_SITEMGR_LOG;
			$link = DEFAULT_URL."/sitemgr/import/importlog.php";
		}elseif ($session=="export_data") {
			$label = LANG_SITEMGR_NAVBAR_DATA_MANAGEMENT." &rsaquo; ".LANG_SITEMGR_EXPORT." &rsaquo; ".LANG_SITEMGR_DATA;
			$link = DEFAULT_URL."/sitemgr/export/";
		}elseif ($session=="export_paymentrecords") {
			$label = LANG_SITEMGR_NAVBAR_DATA_MANAGEMENT." &rsaquo; ".LANG_SITEMGR_EXPORT." &rsaquo; ".LANG_SITEMGR_EXPORT_PAYMENTRECORDS;
			$link = DEFAULT_URL."/sitemgr/export/payment";
		}elseif ($session=="transaction_history") {
			$label = LANG_SITEMGR_TRANSACTION." &rsaquo; ".LANG_SITEMGR_HISTORY;
			$link = DEFAULT_URL."/sitemgr/transactions/";
		}elseif ($session=="transaction_search") {
			$label = LANG_SITEMGR_TRANSACTION." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = DEFAULT_URL."/sitemgr/transactions/search.php";
		}elseif ($session=="invoice_history") {
			$label = LANG_SITEMGR_INVOICE." &rsaquo; ".LANG_SITEMGR_HISTORY;
			$link = DEFAULT_URL."/sitemgr/invoices/";
		}elseif ($session=="invoice_search") {
			$label = LANG_SITEMGR_INVOICE." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = DEFAULT_URL."/sitemgr/invoices/search.php";
		}elseif ($session=="custominvoice_manage") {
			$label = LANG_SITEMGR_CUSTOMINVOICE." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/custominvoices/index.php";
		}elseif ($session=="custominvoice_add") {
			$label = LANG_SITEMGR_CUSTOMINVOICE." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/custominvoices/custominvoice.php";
		}elseif ($session=="custominvoice_search") {
			$label = LANG_SITEMGR_CUSTOMINVOICE." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = DEFAULT_URL."/sitemgr/custominvoices/search.php";
		}elseif ($session=="prefs_pricing") {
			$label = LANG_SITEMGR_PAYMENTSETTINGS." &rsaquo; ".LANG_SITEMGR_SETTINGS_PRICING;
			$link = DEFAULT_URL."/sitemgr/prefs/pricing.php";
		}elseif ($session=="prefs_paymentgateway") {
			$label = LANG_SITEMGR_PAYMENTSETTINGS." &rsaquo; ".LANG_SITEMGR_SETTINGS_PAYMENT_PAYMENTGATEWAY;
			$link = DEFAULT_URL."/sitemgr/prefs/paymentgateway.php";
		}elseif ($session=="prefs_invoiceinformation") {
			$label = LANG_SITEMGR_PAYMENTSETTINGS." &rsaquo; ".LANG_SITEMGR_INVOICEINFORMATION;
			$link = DEFAULT_URL."/sitemgr/prefs/invoice.php";
		}elseif ($session=="discountcode_manage") {
			$label = LANG_SITEMGR_PROMOTIONALCODE." &rsaquo; ".LANG_SITEMGR_MANAGE;;
			$link = DEFAULT_URL."/sitemgr/discountcode/index.php";
		}elseif ($session=="discountcode_add") {
			$label = LANG_SITEMGR_PROMOTIONALCODE." &rsaquo; ".LANG_SITEMGR_ADD;;
			$link = DEFAULT_URL."/sitemgr/discountcode/discountcode.php";
		}elseif ($session=="report_system") {
			$label = LANG_SITEMGR_NAVBAR_REPORTS." &rsaquo; ".LANG_SITEMGR_NAVBAR_SYSTEMREPORT;
			$link = DEFAULT_URL."/sitemgr/reports/systemreport.php";
		}elseif ($session=="report_statistic") {
			$label = LANG_SITEMGR_NAVBAR_REPORTS." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = DEFAULT_URL."/sitemgr/reports/statisticreport.php";
		}elseif ($session=="prefs_theme") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_MENU_THEMES;
			$link = DEFAULT_URL."/sitemgr/prefs/theme.php";
		}elseif ($session=="prefs_signinoptions") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_MENU_LOGINOPTIONS;
			$link = DEFAULT_URL."/sitemgr/prefs/foreignaccount.php";
		}elseif ($session=="prefs_langcenter") {
			$label = LANG_SITEMGR_NAVBAR_LANGUAGECENTER;
			$link = DEFAULT_URL."/sitemgr/langcenter/index.php";
		}elseif ($session=="prefs_faq") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_FREQUENTLYASKEDQUESTIONS;
			$link = DEFAULT_URL."/sitemgr/prefs/faq.php";
		}elseif ($session=="prefs_faqadd") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_FREQUENTLYASKEDQUESTIONS." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/prefs/faqadd.php";
		}elseif ($session=="prefs_commenting") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_COMMENTING_OPTIONS;
			$link = DEFAULT_URL."/sitemgr/prefs/comments.php";
		}elseif ($session=="prefs_robotsfilter") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_SETTINGS_ROBOTS;
			$link = DEFAULT_URL."/sitemgr/prefs/robotsfilter.php";
		}elseif ($session=="prefs_tax") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_SETTINGS_TAX;
			$link = DEFAULT_URL."/sitemgr/prefs/tax.php";
		}elseif ($session=="prefs_maintenancemode") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_SETTING_MAINTENANCE;
			$link = DEFAULT_URL."/sitemgr/prefs/maintenance.php";
		}elseif ($session=="prefs_twitter") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_TWITTER;
			$link = DEFAULT_URL."/sitemgr/prefs/twittersettings.php";
		}elseif ($session=="prefs_import") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_IMPORT;
			$link = DEFAULT_URL."/sitemgr/prefs/import.php";
		}elseif ($session=="prefs_featuredcategory") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_FEATUREDCATEGORY_PLURAL;
			$link = DEFAULT_URL."/sitemgr/prefs/featuredcategory.php";
		}elseif ($session=="prefs_aprovalrequirement") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_SETTINGS_APPROVAL;
			$link = DEFAULT_URL."/sitemgr/prefs/approvalrequirement.php";
		}elseif ($session=="prefs_locations") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_NAVBAR_LOCATIONS;
			$link = DEFAULT_URL."/sitemgr/prefs/location.php";
		}elseif ($session=="prefs_googlemaps") {
			$label = LANG_SITEMGR_NAVBAR_GOOGLESETTINGS." &rsaquo; ".LANG_SITEMGR_GOOGLEMAPS;
			$link = DEFAULT_URL."/sitemgr/googleprefs/googlemaps.php";
		}elseif ($session=="prefs_googleads") {
			$label = LANG_SITEMGR_NAVBAR_GOOGLESETTINGS." &rsaquo; ".LANG_SITEMGR_GOOGLEADS;
			$link = DEFAULT_URL."/sitemgr/googleprefs/googleads.php";
		}elseif ($session=="prefs_googleanalytics") {
			$label = LANG_SITEMGR_NAVBAR_GOOGLESETTINGS." &rsaquo; ".LANG_SITEMGR_GOOGLEANALYTICS;
			$link = DEFAULT_URL."/sitemgr/googleprefs/googleanalytics.php";
		}elseif ($session=="prefs_systememail") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_SYSTEMEMAIL;
			$link = DEFAULT_URL."/sitemgr/prefs/email.php";
		}elseif ($session=="prefs_emailnotific") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ". LANG_SITEMGR_MENU_EMAILNOTIF;
			$link = DEFAULT_URL."/sitemgr/emailnotifications/";
		}elseif ($session=="prefs_emailsendconf") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_SETTINGS_EMAILCONF_EMAILSENDINGCONFIGURATION;
			$link = DEFAULT_URL."/sitemgr/prefs/emailconfig.php";
		}elseif ($session=="prefs_designation") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_SETTINGS_EDITORCHOICE_DESIGNATIONS;
			$link = DEFAULT_URL."/sitemgr/prefs/editorchoice.php";
		}elseif ($session=="prefs_managelevel") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_SETTINGS_LEVELS_MENULABEL;
			$link = DEFAULT_URL."/sitemgr/prefs/levels.php";
		}elseif ($session=="prefs_promotion") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_PROMOTION;
			$link = DEFAULT_URL."/sitemgr/prefs/deal.php";
		}elseif ($session=="prefs_claim") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_CLAIM_CLAIMS;
			$link = DEFAULT_URL."/sitemgr/prefs/claim.php";
		}elseif ($session=="prefs_api") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_API;
			$link = DEFAULT_URL."/sitemgr/prefs/api.php";
		}elseif ($session=="prefs_modules") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_SETTINGS_MANAGE_MODULES;
			$link = DEFAULT_URL."/sitemgr/prefs/modules.php";
		}elseif ($session=="post_add") {
			$label = LANG_MENU_BLOG." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/blog.php";
		}elseif ($session=="blog_manage") {
			$label = LANG_MENU_BLOG." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/index.php";
		}elseif ($session=="post_search") {
			$label = LANG_MENU_BLOG." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/search.php";
		}elseif ($session=="blogcateg_manage") {
			$label = LANG_MENU_BLOG." &rsaquo; ".LANG_TAGS." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = BLOG_DEFAULT_URL."/sitemgr/blogcategs/index.php";
		}elseif ($session=="blogcateg_add") {
			$label = LANG_MENU_BLOG." &rsaquo; ".LANG_TAGS." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = BLOG_DEFAULT_URL."/sitemgr/blogcategs/category.php";
		}elseif ($session=="comments_blog") {
			$label = LANG_MENU_BLOG." &rsaquo; ".LANG_BLOG_COMMENTS." &rsaquo; ".LANG_SITEMGR_MANAGE;;
			$link = BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/comments/index.php";
		}elseif ($session=="prefs_socialnetwork") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_SOCIALNETWORK;
			$link = DEFAULT_URL."/sitemgr/prefs/visitorprofile.php";
		}elseif ($session=="prefs_twilio") {
			$label = LANG_SITEMGR_MENU_SETTINGS." &rsaquo; ".LANG_SITEMGR_TWILIO;
			$link = DEFAULT_URL."/sitemgr/prefs/twilio.php";
		}elseif ($session=="domain_manage") {
			$label = LANG_SITEMGR_DOMAIN_PLURAL." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/domain/index.php";
		}elseif ($session=="domain_add") {
			$label = LANG_SITEMGR_DOMAIN_PLURAL." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/domain/domain.php";
		}elseif ($session=="package_add") {
			$label = LANG_SITEMGR_PACKAGE_PLURAL." &rsaquo; ".LANG_SITEMGR_ADD;
			$link = DEFAULT_URL."/sitemgr/package/package.php";
		}elseif ($session=="package_manage") {
			$label = LANG_SITEMGR_PACKAGE_PLURAL." &rsaquo; ".LANG_SITEMGR_MANAGE;
			$link = DEFAULT_URL."/sitemgr/package/index.php";
		}elseif ($session=="package_search") {
			$label = LANG_SITEMGR_PACKAGE_PLURAL." &rsaquo; ".LANG_SITEMGR_SEARCH;
			$link = DEFAULT_URL."/sitemgr/package/search.php";
		}elseif ($session=="package_reports") {
			$label = LANG_SITEMGR_PACKAGE_PLURAL." &rsaquo; ".LANG_SITEMGR_NAVBAR_REPORTS;
			$link = DEFAULT_URL."/sitemgr/package/reports.php";
		}elseif ($session=="sugar") {
			$label = LANG_SITEMGR_PLUGINS." &rsaquo; ".LANG_SITEMGR_NAVBAR_SUGARCRM;
			$link = DEFAULT_URL."/sitemgr/plugins/index.php";
		}elseif ($session=="wordpress") {
			$label = LANG_SITEMGR_PLUGINS." &rsaquo; ".LANG_SITEMGR_NAVBAR_WORDPRESS;
			$link = DEFAULT_URL."/sitemgr/plugins/index.php?type=1";
		}else{
			$label = $session;
			$link = "#";
		}
		//$label=string_ucwords($label); in some servers this function with mb_string doesn't work
		$label=ucwords($label);
	}

	function system_setFreqActions($session,$module) {
		$smaccount_id = sess_getSMIdFromSession();
		if (!$smaccount_id) $smaccount_id = 0;
		$sql = "SELECT rate FROM Frequently_Actions WHERE smaccount_id = ".$smaccount_id." AND session = '".$session."' AND `domain_id` = ".SELECTED_DOMAIN_ID;
		$db = db_getDBObject(DEFAULT_DB, true);
		$r = mysql_fetch_assoc($db->query($sql));
		$rate = $r['rate'];

		if ($rate)
			$sql = "UPDATE Frequently_Actions SET rate = ".($rate+1).", module = '".$module."' WHERE smaccount_id = ".$smaccount_id." AND session = '".$session."' AND `domain_id` = ".SELECTED_DOMAIN_ID;
		else
			$sql = "INSERT INTO Frequently_Actions (smaccount_id, domain_id, session, rate,module) VALUES (".$smaccount_id.", ".SELECTED_DOMAIN_ID.", '".$session."', 1,'".$module."')";
		$db->query($sql);
	}

	function getModuleUrl() {
		$ItemPath = "";
		if (string_strpos($_SERVER["HTTP_REFERER"], str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL)) !== false) {
			$ItemPath = str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL)."/";
		} elseif (string_strpos($_SERVER["HTTP_REFERER"], str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL)) !== false) {
			$ItemPath = str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL)."/";
		}

		return string_substr($ItemPath, 1, -1);
	}

	function system_showFreqActionsList() {
		$smaccount_id = sess_getSMIdFromSession();
		if (!$smaccount_id) $smaccount_id = 0;
		$sql = "SELECT rate, session, module FROM Frequently_Actions WHERE smaccount_id = ".$smaccount_id." AND `domain_id` = ".SELECTED_DOMAIN_ID." ORDER BY rate DESC LIMIT 10";
		$db = db_getDBObject(DEFAULT_DB, true);
		$r = $db->query($sql);
		if (mysql_num_rows($r)) { ?>
			<div class="recentActions"><ul>
				<h1><?=system_showText(LANG_SITEMGR_FREQUENTACTIONS)?></h1><?
				while ($row = mysql_fetch_assoc($r)) {
					if (string_strpos($row["module"],"_FEATURE")){
                        $customConstant = (defined("CUSTOM_".$row["module"]) ? constant("CUSTOM_".$row["module"]) : "on");
						if (constant($row["module"])== "on" && $customConstant == "on"){
							system_freqActions_returnLabelLink($row["session"], $label, $link);
							echo  '<li><a href="'.$link.'">'.$label.'</a></li>';
						}
					}else {
						system_freqActions_returnLabelLink($row["session"], $label, $link);
						echo  '<li><a href="'.$link.'">'.$label.'</a></li>';
					}
				} ?>
			</ul></div><?
		}
	}

	function system_changeFeaturedAtribute($table, $ids, $featured="y") {
		if (isset($table) && isset($ids)) {
			$sql = "UPDATE ".$table." SET featured='".$featured."' WHERE id in (".$ids.")";
			$dbMain = db_getDBObject(DEFAULT_DB,true);
			$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID,$dbMain);
			$db->query($sql);
		}
	}

	function system_changeAtributeById($table, $atribute, $ids, $value = '', $domain_id = 1) {
		if (isset($table) && isset($ids) && isset($atribute)) {
			$sql = "UPDATE ".$table." SET ".$atribute."='".$value."' WHERE id in (".$ids.")";
			$dbMain = db_getDBObJect(DEFAULT_DB,true);
			$db = db_getDBObjectByDomainID($domain_id,$dbMain);
			$db->query($sql);
		}
	}

	function system_retrieveLocationRelationship ($_locations, $_location_level, &$_location_father_level, &$_location_child_level) {
		$location_key = array_search ($_location_level, $_locations);
		if ($location_key!==false) {
			if ($location_key==0) $_location_father_level = false; else $_location_father_level = $_locations[$location_key-1];
			if ($location_key==(count($_locations)-1)) $_location_child_level = false; else $_location_child_level = $_locations[$location_key+1];
		}
	}

	function system_buildLocationNodeParams($array, $limit_level=false, &$retrieveLastLocationName=false) {
		$_link_params = false;
		if ($array) {
			if (count($array) > 0) {
				ksort($array);
				foreach ($array as $name=>$value) {
					$pos = string_strpos($name, "location_");
					if (($pos !== false) && ($pos == 0)) {
						if ($value) {
							if (!$limit_level)
								$_link_params .= $name."=".$value."&";
							else {
								$current_level = string_substr($name, -1);
								if ($current_level<$limit_level) {
									$_link_params .= $name."=".$value."&";
									if ($retrieveLastLocationName) {
										$_locations = explode(",", EDIR_LOCATIONS);
										system_retrieveLocationRelationship ($_locations, $current_level, $_location_father_level, $_location_child_level);
										//if ($_location_child_level==$limit_level) {
											$locationInfo = db_getFromDB('location'.$current_level, 'id', $value, 1, '', 'array');
											$retrieveLastLocationName = $locationInfo['name'];
										//}
									}
								}
							}
						}
					}
				}
				$_link_params = string_substr($_link_params, 0, -1);
			}
		}
		return $_link_params;
	}

	function system_buildLocationBreadCrumb($_locations, $array, $limit_level, $redirect = "index.php", $extraInfo=false) {
		// showing link to location root
		if ($limit_level != $_locations[0]) {
			?><a href="<?=DEFAULT_URL?>/sitemgr/locations/location_<?=$_locations[0]?>/index.php"><?
		}
		echo system_showText(LANG_SITEMGR_NAVBAR_LOCATIONS);
		if ($limit_level != $_locations[0]) {
			?></a> &raquo;<?
		}
		$_link_params = false;

		// filling the gaps of the url path ///////////////
		if ((is_array($array)) and (count($array) > 0)) {
			$aux_max_level = 1;
			foreach ($array as $name=>$value) {
				$pos = string_strpos($name, "location_");
				if ($pos !== false) {
					$current_level = string_substr($name, -1);
					if (($current_level > $aux_max_level) and (in_array($current_level, $_locations)))
						$aux_max_level = $current_level;
				}
			}

			if ($array["location_".$aux_max_level] > 0) {
				$aux_location_path = db_getFromDB("location".($aux_max_level), "id", $array["location_".$aux_max_level], 1, "", "array");

				foreach ($aux_location_path as $name=>$value) {
					$pos = string_strpos($name, "location_");
					if (($pos !== false) and ($value>0)) {
						if (in_array(string_substr($name, -1), $_locations))
							$array[$name] = $value;
					}
				}
			}

			// calculating the real limit level _ according to the path available
			$aux_location_father_level = false;
			$aux_location_child_level = false;
			system_retrieveLocationRelationship ($_locations, $aux_max_level, $aux_location_father_level, $aux_location_child_level);
			$limit_level = $aux_location_child_level;

			ksort($array);
		}
		///////////////////////////////////////////////////

		$aux_array_breadcrumb = array();
		if ($array) {
			if (count($array) > 0) {
				foreach ($array as $name=>$value) {
					$pos = string_strpos($name, "location_");
					if (($pos !== false) && ($pos == 0)) {
						if ($value) {
							$current_level = string_substr($name, -1);
							system_retrieveLocationRelationship ($_locations, $current_level, $_location_father_level, $_location_child_level);
							if ($_location_father_level) {
								$locationName = true;
								$nodeParams = system_buildLocationNodeParams($array, $current_level, $locationName);
								if ($locationName === true)
									$aux_array_breadcrumb[] = LANG_NA."&raquo;";
								else
									$aux_array_breadcrumb[] = "<a href=\"".DEFAULT_URL."/sitemgr/locations/location_".$current_level."/".$redirect."?".$nodeParams."\">".$locationName."</a>&raquo;";
							}
							if ($_location_child_level == $limit_level) {
								$locationInfo = db_getFromDB('location'.$current_level, 'id', $value, 1, '', 'array');
								$aux_array_breadcrumb[] = $locationInfo['name'];
							}
						}
						else {
							$aux_array_breadcrumb[] = LANG_NA;
						}
					}
				}
			}
		}
		if (count($aux_array_breadcrumb) > 0)
			echo implode('&nbsp;', $aux_array_breadcrumb);

		return $_link_params;
	}

	function system_retrieveLocationLinkBackLevel($locationLevel, $locationSession, $_location_node_params, $operation) {
		$url = "".DEFAULT_URL."/sitemgr/locations/location_".$locationLevel."/";
		if ($locationSession == "manage") $url .= "index.php"; else
		if ($locationSession == "add") $url .= "location_".$locationLevel.".php"; else
		if ($locationSession == "featured") $url .= "featured.php";
		$url .= ($_location_node_params?"?".$_location_node_params:"");
		if ($_location_node_params && $operation)
			$url .= "&";
		elseif (!$_location_node_params && $operation)
			$url .= "?";
		return $url;
	}

	function system_retrieveLocationsInfo (&$nonDefaultLocInfo, &$defaultLocInfo) {

		$defaultLoc      = explode(",", EDIR_DEFAULT_LOCATIONS);
		$defaultLocIds   = explode(",", EDIR_DEFAULT_LOCATIONIDS);
		$defaultLocNames = explode(",", EDIR_DEFAULT_LOCATIONNAMES);
		$defaultLocShow  = explode(",", EDIR_DEFAULT_LOCATIONSHOW);
		$locations       = explode(",", EDIR_LOCATIONS);

		//retrieve all non default location
		$locations = array_diff($locations, $defaultLoc);

		$nonDefaultLocInfo = "";
		foreach ($locations as $location)
			$nonDefaultLocInfo[] = $location;

		//retrieve arrays with default locations info
		$i=0;
		$defaultLocInfo = "";
		foreach ($defaultLoc as $location) {
			$defaultLocInfo[$i]['type'] = $location;
			$defaultLocInfo[$i]['id']   = $defaultLocIds[$i];
			$defaultLocInfo[$i]['name'] = $defaultLocNames[$i];
			$defaultLocInfo[$i]['show'] = $defaultLocShow[$i];
			$i++;
		}
	}

	function system_retrieveLocationsToShow($type="string") {
		$locations = explode(",", EDIR_LOCATIONS);
		if (EDIR_DEFAULT_LOCATIONS) {
			$defaultLocShow = explode(",", EDIR_DEFAULT_LOCATIONSHOW);
			for ($i=0; $i<count($defaultLocShow); $i++)
				if ($defaultLocShow[$i]=='n')
					unset ($locations[$i]);
		}
		if ($type=="string") {
			$locations = array_reverse ($locations);
			$return = implode(", ", $locations);
		} elseif ($type=="array") {
			$return = $locations;
		}
		return $return;
	}

	function system_retrieveLastDefaultLevel (&$last_default_level, &$last_default_id) {
		$last_default_level = false;
		$last_default_id = false;
		if (EDIR_DEFAULT_LOCATIONS) {
			$defaultLoc      = explode(",", EDIR_DEFAULT_LOCATIONS);
			$defaultLocIds   = explode(",", EDIR_DEFAULT_LOCATIONIDS);
			$last_default_level = array_pop($defaultLoc);
			$last_default_id = array_pop($defaultLocIds);
		}
	}

	function system_retrieveNonActivableLocations($domain_id = false) {
		$return = "";
		$dbMain = db_getDBObJect(DEFAULT_DB,true);
		$db = db_getDBObjectByDomainID($domain_id,$dbMain);
		$locations = explode(",", EDIR_LOCATIONS);
		$non_used_locations = array(1,2,3,4,5);
		$non_used_locations = array_diff($non_used_locations, $locations);
		$last_actived_location = array_pop($locations);
		$locations_to_check = array();
		foreach($non_used_locations as $each_non_used_locations)
			if( $each_non_used_locations < $last_actived_location )
				array_push($locations_to_check, $each_non_used_locations);

		if ($locations_to_check) {
			foreach ($locations_to_check as $each_location_to_check) {
				$found=false;
				$sql = "SELECT count(id) AS total FROM Listing WHERE location_".$each_location_to_check." = 0 ";
				$r = $db->query($sql);
				$row=mysql_fetch_assoc($r);
				if ($row['total'])
					$return[] = $each_location_to_check;
				else {
					$sql = "SELECT count(id) AS total FROM Classified WHERE location_".$each_location_to_check." = 0 ";
					$r = $db->query($sql);
					$row=mysql_fetch_assoc($r);
					if ($row['total'])
						$return[] = $each_location_to_check;
					else {
						$sql = "SELECT count(id) AS total FROM Event WHERE location_".$each_location_to_check." = 0 ";
						$r = $db->query($sql);
						$row=mysql_fetch_assoc($r);
						if ($row['total'])
							$return[] = $each_location_to_check;
					}
				}
			}
		}
		if ($return)
			$return = implode (",", $return);
		return $return;
	}

	function system_getURLLocationParams($array) {
		$url_params = "";
		$array_params = array();
		if ($array) {
			if (count($array) > 0) {
				foreach ($array as $name=>$value) {
					$pos = (string_strpos($name, "location_")!==false);
					if ($pos !== false) {
						if ($value) {
							$array_params[] = $name."=".$value;
						}
					}
				}
			}
		}
		if ($array_params) {
			if (count($array_params) > 0) {
				$url_params = implode("&", $array_params);
			}
		}
		return $url_params;
	}

	/*
	 * Function to count Listings in all levels of category
	 */
	function system_countListingCategoryHierarchy($root_id){

		$db = db_getDBObject();
		unset($listingCategoryObj);
		$listingCategoryObj = new ListingCategory($root_id);
		$sql = "select ListingCategory.id
				  from ListingCategory
				 where root_id= ".$root_id." and
				       ListingCategory.left >= ".$listingCategoryObj->getNumber("left")." and
				       ListingCategory.right <= ".$listingCategoryObj->getNumber("right")."
			  order by ListingCategory.left";

		$result = $db->query($sql);
		if(mysql_num_rows($result) > 0){
			while($row = mysql_fetch_assoc($result)){

				/*
				 * Get id of categories
				 */
				unset($aux_listingCategoryObj);
				$aux_listingCategoryObj = new ListingCategory($row["id"]);

				$sql_categories_ids = "select id from ListingCategory listingcategory
														where listingcategory.root_id = ".$aux_listingCategoryObj->root_id." and
															  listingcategory.left >= ".$aux_listingCategoryObj->left." and
															  listingcategory.right <= ".$aux_listingCategoryObj->right;

				$result_categories_ids = $db->query($sql_categories_ids);
				if(mysql_num_rows($result_categories_ids) > 0){

					/*
					 * Get ids of categories
					 */
					unset($aux_categories_ids);
					$aux_categories_ids = array();
					while($row_categories_ids = mysql_fetch_assoc($result_categories_ids)){
						$aux_categories_ids[] = $row_categories_ids["id"];
					}


					$sql_count = "select count(distinct(listing_category.listing_id)) as activelisting
									from Listing_Category listing_category
									inner join Listing listing on listing.id = listing_category.listing_id
									where category_id in (".implode(",",$aux_categories_ids).") AND listing.status = 'A' ";

					$result_count = $db->query($sql_count);
					if (mysql_num_rows($result_count) > 0) {
						if ($row_update = mysql_fetch_assoc($result_count)) {
							$active_listing = $row_update["activelisting"];
							$sql_update = "UPDATE ListingCategory SET active_listing = ".$active_listing." WHERE id = ".$row["id"];
							$db->query($sql_update);
						}
					}

				}

			}
		}
	}

    /*
     * Return an array with listing levels which have certain information enabled, like review, click to call and sms.
     */
    function system_retrieveLevelsWithInfoEnabled($info) {

		$array_call_levels = system_getListingLevelInformation($info);
        
		unset($return);
		foreach($array_call_levels as $key => $value){
			if($value == "y"){
				$return[] = $key;
			}
		}
		
		if(is_array($return)){
			return $return;
		}else{
			return false;
		}
		
    }

	function system_getLastDay($month = '', $year = '') {
	   if (empty($month)) {
	      $month = date('m');
	   }
	   if (empty($year)) {
	      $year = date('Y');
	   }
	   $result = strtotime("{$year}-{$month}-01");
	   $result = strtotime('-1 second', strtotime('+1 month', $result));
	   return date('Y-m-d', $result);
	}


	/*
	 * Function to make zip Files
	 */
	function system_zipFiles($zip_filename,$files,&$error){
		if (class_exists(ZipArchive)){
			$zip = new ZipArchive();

			if ($zip->open($zip_filename, ZIPARCHIVE::CREATE)!==TRUE) {
				$array_error[] = "cannot open <$zip_filename>";
			}

			if($files){
				if(is_array($files)){
					for($i=0;$i<count($files);$i++){
						$zip->addFile($files[$i]);
					}
				}else{
					$zip->addFile($files);
				}
			}else{
				$array_error[] = "Files parameter is empty";

			}
			$zip->close();

			if(count($array_error)){
				$error =  implode("<br />", $array_error);
				return false;
			}else{
				return true;
			}
		} else return false;

	}

	function system_showTruncatedText($text, $length, $extraChar = "...", $isClass = false) {
		unset($return);
		unset($tLen);
		unset($ecLen);
		$text = html_entity_decode($text);
		$tLen = string_strlen($text);
		if ($tLen > $length) {
			$ecLen = string_strlen($extraChar);
			$return = string_substr($text, 0, ($length - $ecLen)).$extraChar;
		} else {
			$return = $text;
		}
		return !$isClass? htmlspecialchars($return): $return;
	}

	/**
	 * <code
	 *		//Get the Time Stamp from a date and time
	 *		system_getTimeStamp($date, $time);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name system_getTimeStamp
	 * @access Public
	 * @param date $date
	 * @param time $time
	 * @return timestamp $timestamp
	 */
	function system_getTimeStamp($date, $time = false) {
		if (DEFAULT_DATE_FORMAT == "m/d/Y") {
			/*
			 * Explode the date into $month, $day and $year variables
			 */
			list ($month, $day, $year)= explode("/", $date);
		} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
			/*
			 * Explode the date into $day, $month and $year variables
			 */
			list ($day, $month, $year)= explode("/", $date);
		}

		if ($time) {
			/*
			 * Explode the time into $hour, $minute and $second variables
			 */
			list($hour, $minute, $second) = explode(":", $time);
		} else {
			/*
			 * Create the $hour, $minute and $second variables with 0
			 */
			$hour = 0;
			$minute = 0;
			$second = 0;
		}
		/*
		 * Create the Time Stamp from Date and Time
		 */
		$timestamp = mktime((int)$hour, (int)$minute, (int)$second, (int)$month, (int)$day, (int)$year);
		return $timestamp;
	}

	/**
	 * <code>
	 *		//Get the number of days of a determined month
	 *		system_getMonthNumDays($date);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name system_getMonthNumDays
	 * @access Public
	 * @param date $date
	 * @return integer $daysInMonth
	 */
	function system_getMonthNumDays($date) {
		if (DEFAULT_DATE_FORMAT == "m/d/Y") {
			/*
			 * Explode the date into $month, $day and $year variables
			 */
			list ($month, $day, $year)= explode("/", $date);
		} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
			/*
			 * Explode the date into $day, $month and $year variables
			 */
			list ($day, $month, $year)= explode("/", $date);
		}

		/*
		 * Using date funciton with "t" param to return the number of days in a month
		 */
		$daysInMonth = date("t", mktime(0, 0, 0, (int)$month, 1, (int)$year));
		return $daysInMonth;
	}

	/**
	 * <code>
	 *		//Get the difference in days beteween two dates
	 *		system_getDiffDays($timestamp_start, $timestamp_end);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name system_getDiffDays
	 * @access Public
	 * @param timestamp $timestamp_start
	 * @param timestamp $timestamp_end
	 * @return integer $numberOfDays
	 */
	function system_getDiffDays($timestamp_start, $timestamp_end) {
		/*
		 * Calculing the $diffdays with ($timestamp_start - $timestamp_end) / (60*60+24)
		 * $timestamp_start = Timestamp generated from start date
		 * $timestamp_end = Timestamp generated from end date
		 * (60*60*24) = Calculated Timestamp from a day
		 */
		$diffdays = ($timestamp_start - $timestamp_end) / (60*60*24);

		/*
		 * Get the absolute value from $diffdays
		 */
		$diffdays = abs($diffdays);

		/*
		 * Round the $diffdays
		 */
		$numberOfDays = floor($diffdays);
		return $numberOfDays;
	}

	/**
	 * <code>
	 *		//Get the week number from a date
	 *		system_getNumberWeek($date);
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name system_getNumberWeek
	 * @access Public
	 * @param date $date
	 * @return integer $weekNumber
	 */
	function system_getNumberWeek($date) {
		if (DEFAULT_DATE_FORMAT == "m/d/Y") {
			/*
			 * Explode the date into $month, $day and $year variables
			 */
			list ($month, $day, $year)= explode("/", $date);
		} elseif (DEFAULT_DATE_FORMAT == "d/m/Y"){
			/*
			 * Explode the date into $day, $month and $year variables
			 */
			list ($day, $month, $year)= explode("/", $date);
		}

		/*
		 * Create the Time Stamp from Date
		 */
		$timestamp = mktime(0, 0, 0, (int)$month, (int)$day, (int)$year);

		/*
		 * Using date funciton with "W" param to return the week number of a timestamp
		 */
		$number = date("W", $timestamp);

		/*
		 * To fix a possible php bug
		 */
		if ($month == 1) {
			/*
			 * if month == 1 (January) and week number > 4, need to force the week number to be 0
			 */
			if ($number > 4) $number = 0;
		} else if ($month == 12) {
			/*
			 * if month == 12 (December) and week number < 4, need to force the week number to be the last week number of the year
			 */
			if ($number < 4) {
				$timestamp = mktime(0, 0, 0, (int)$month, (int)$day-7, (int)$year);
				$number = date("W", $timestamp) + 1;
			}
		}

		$weekNumber = $number + 1;
		return $weekNumber;
	}

	function system_checkDay($days) {
		$daysweek = explode(",",$days);
		$weekday_names = explode(",", LANG_DATE_WEEKDAYS);
		$weekend = false;
		$businessday = false;

		if ((count($daysweek)==2) && ($daysweek[0]=="1" && $daysweek[1]=="7")){ //weekends
			return LANG_EVERY2." ".LANG_EVENT_WEEKEND;
		}elseif ((count($daysweek)==5) && ($daysweek[0]=="2" && $daysweek[1]=="3" && $daysweek[2]=="4" && $daysweek[3]=="5" && $daysweek[4]=="6")){ //business days
			$str_date = LANG_EVERY2." ".system_showText(LANG_EVENT_BUSINESSDAY);
			return $str_date;
		}elseif (count($daysweek)==7){ //every day
			return LANG_EVERY2." ".LANG_DAY;
		}else { //other cases
			$str_date = "";
			for ($i=0;$i<count($daysweek);$i++){
				$str_date .= ucfirst($weekday_names[$daysweek[$i]-1]);
				if ($daysweek[$i+2]){
					$str_date .=", ";
				} else {
					$str_date .=" ".LANG_AND." ";
				}
			}
			$len = string_strlen(LANG_AND);
			$str_date = string_substr($str_date,0,-1-$len);

			return LANG_EVERY." ".$str_date;
		}
	}

	function system_getRecurringWeeks($weekdays){
		$array_weekdays = explode(",",$weekdays);
		$aux = 0;
		if (count($array_weekdays)==0){
			$aux = $array_weekdays[0];
			if ($aux == 1)   	$str = system_showText(LANG_FIRST_2);
			elseif($aux == 2)	$str = system_showText(LANG_SECOND_2);
			elseif($aux == 3)	$str = system_showText(LANG_THIRD_2);
			elseif($aux == 4)	$str = system_showText(LANG_FOURTH_2);
			elseif($aux == 5)   $str = system_showText(LANG_LAST);
			return $str;
		}else {
			$str_date = "";
			$weekday_names = explode(",", LANG_DATE_WEEKDAYS);
			if (count($array_weekdays)==5){
				return false;
			} else {
			for ($i=0;$i<count($array_weekdays);$i++){
				$aux = $array_weekdays[$i];
				if ($aux == 1)   	$str = system_showText(LANG_FIRST_2);
				elseif($aux == 2)	$str = system_showText(LANG_SECOND_2);
				elseif($aux == 3)	$str = system_showText(LANG_THIRD_2);
				elseif($aux == 4)	$str = system_showText(LANG_FOURTH_2);
				elseif($aux == 5)   $str = system_showText(LANG_LAST);
				$str_date .= $str;
				if ($array_weekdays[$i+2]){
					$str_date .=", ";
				} else {
					$str_date .=" ".LANG_AND." ";
				}
			}
			$len = string_strlen(LANG_AND);
			$str_date = string_substr($str_date,0,-1-$len);

			return $str_date;
			}


		}

	}

    /**
	 * Return the action (sql choice) to be done on Save methods
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name system_retrieveSaveAction()
	 * @param integer $id
     * @param string $table
     * @param object $db
     */
    function system_retrieveSaveAction($id, $table, $db) {
    	if($id && $table && $db){
	        $action = "insert";
	        if ($id) {
	            $action = "update";
	            if(FORCE_SECOND)
	                if(!domain_returnIfExistReg($id, $table,$db))
	                    $action = "insertId";
	        }
	        return $action;
    	}else{
    		return false;
    	}
    }

	/**
	 * Return the permission from a determined file or folder
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name system_checkPerm()
	 * @param varchar $src
     * @return integer $permission
     */
	function system_checkPerm ($src) {
		$permission = string_substr(decoct(fileperms($src)), 1);
		return $permission;
	}

 	/**
	 * Parse XML file to array
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name objectsIntoArray()
	 * @param array $arrObjData
	 * @param array $arrSkipIndices
     * @return array
     */
 	function objectsIntoArray($arrObjData, $arrSkipIndices = array())
	{
    	$arrData = array();

    	// if input is object, convert into array
    	if (is_object($arrObjData)) {
    	    $arrObjData = get_object_vars($arrObjData);
    	}

    	if (is_array($arrObjData)) {
      	  foreach ($arrObjData as $index => $value) {
         	   if (is_object($value) || is_array($value)) {
                $value = objectsIntoArray($value, $arrSkipIndices); // recursive call
         	   }
           	 if (in_array($index, $arrSkipIndices)) {
           	     continue;
           	 }
           	 $arrData[$index] = $value;
        	}
   	 	}
   	 	return $arrData;
	}

	/**
	 * Saves navbar sequence to XML file
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name saveNavBarSequence()
	 * @param string $XML_file
	 * @param array $buildArray
	 * @param string $navbarType
     * @return boolean
     */
	function saveNavBarSequence($XML_file,$buildArray,$navbarType='header',$selected_domain_id){
		$fileContent=array();
		@unlink($XML_file);
		$fp = fopen($XML_file, 'w+');

		if ($fp){
			$fileContent[]='<?xml version="1.0" encoding="UTF-8"?>';
			$fileContent[]="<{$navbarType}>";
			foreach ($buildArray as $itemName=>$itemValue){
				foreach ($itemValue as $item=>$value){
					$fileContent[]=("<{$item}>".trim($value)."</{$item}>");
				}
            }
            
			$fileContent[]="</{$navbarType}>";
			$fileContent=implode("\n",$fileContent);
			fwrite($fp,($fileContent));
			fclose($fp);
			return true;
		} else throw new Exception('Can not open: '.$XML_file.' for writining');
	}


	/**
	 * load navbar sequence from XML file
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name loadNavBarSequence()
	 * @param string $XML_file
     * @return array
     */
	function loadNavBarSequence($XML_file, $selected_domain_id){

		$num_languages = count(explode(",", EDIR_LANGUAGENAMES));
		$str_languages = explode(",", EDIR_LANGUAGES);
        unset($edir_default_language);
        unset($edir_languages);
        unset($edir_languagenames);
        unset($edir_languagenumber);

		$langObj = new Lang();

        $reWriteXMLFile=false;
		$fp = fopen($XML_file, 'r');
		if ($fp && filesize($XML_file)){
			/**
			* READ FILE AND BUILD UP STRUCTURE AS ARRAY
			*/
			fclose ($fp);
			$xmlStr = file_get_contents($XML_file);
			$xmlObj = simplexml_load_string($xmlStr);
			$textFileContent = objectsIntoArray($xmlObj);

			$arrPos = 0;
			for ($counter = 0; $counter<count($textFileContent['item']); $counter++){
				
				unset($new_link);
				
				
				if (count($textFileContent['item'])>1){
					
					$new_link = $textFileContent['link'][$counter];
					$target = $textFileContent['target'][$counter];
					
					$newtextFileContent[$arrPos] = array(
							'item'=>$textFileContent['item'][$counter],
							'li_id'=>$textFileContent['li_id'][$counter],
							'link'=>$new_link,
							'target'=>$target,
							'area'=>$textFileContent['area'][$counter]
					);

				} else {

					$new_link = $textFileContent['link'];
					$target = $textFileContent['target'][$counter];

					$newtextFileContent[$arrPos] = array(
							'item'=>$textFileContent['item'],
							'li_id'=>$textFileContent['li_id'],
							'link'=>$new_link,
							'target'=>$target,
							'area'=>$textFileContent['area']
					);
				}


                
				for ($i=1; $i<=$num_languages; $i++) {
                    $language_id=$langObj->returnLangId($str_languages[$i-1]);
					$varName = "name_$language_id";
					if (count($textFileContent['item'])>1){
						$textToShow = str_replace("_AMPERSAND_","&",($textFileContent[$varName][$counter]));
                        $textToShow = str_replace("_PIPE_","|",$textToShow);

					} else {
						$textToShow = str_replace("_AMPERSAND_","&",($textFileContent[$varName]));
                        $textToShow = str_replace("_PIPE_","|",$textToShow);
					}

                    // MAYBE SOME LANGUAGE WAS ACTVATED AND THERE IS NO ENTRY ON XML FILE
                    if (!trim($textToShow)){
                        $reWriteXMLFile=true;
                        //Grab first array that has some text to add to this empty field
                        if (!$hasAtLeastLanguageOnPos){
                            for ($x=0;$x<=count($textFileContent);$x++){
                                if (trim($textFileContent['name_'.$x][$i])){
                                    if (!$hasAtLeastLanguageOnPos){
                                        $hasAtLeastLanguageOnPos=$x;
                                        $reWriteXMLFile=true;
                                    }
                                }
                            }
                        }
                        $nameThatExists="name_$hasAtLeastLanguageOnPos";
                        $textToShow= str_replace("_AMPERSAND_","&",$textFileContent[$nameThatExists][$counter]);
                        $textToShow= str_replace("_PIPE_","|",$textToShow);
                        

                        

                    }
					$newtextFileContent[$arrPos][$varName] = str_replace("_AMPERSAND_","&",$textToShow);
                    $newtextFileContent[$arrPos][$varName] = str_replace("_PIPE_","|",$newtextFileContent[$arrPos][$varName]);
                    
                    /*
                     * Fix when the name of link is empty
                     */
                    $aux_varName = $newtextFileContent[$arrPos][$varName];
                    if(is_array($aux_varName)){
                    	$newtextFileContent[$arrPos][$varName] = "";
                    } 
                                           
				}
				$arrPos++;
			}
			$navBarStructure = $newtextFileContent;
			@fclose ($fp);
		}
        // some languages has no the name configured yet on domains that its not activated. Rewrite XML to not show empty menu items
        if($reWriteXMLFile){
            if (string_strpos($XML_file, "navbar_header.xml"))
                $navbarType='header';
            else $navbarType='footer';
            saveNavBarSequence($XML_file,$navBarStructure,$navbarType='header',$selected_domain_id);
        }
		return $navBarStructure;
	}

	function system_findTranslationFor($word, $language, $blog = false){
		if (!$language || !$word) {
			return false;
		}
		if ($blog){
			$languageFile = BLOG_EDIRECTORY_ROOT."/lang/$language".".php";
		} else {
			$languageFile = EDIRECTORY_ROOT."/lang/$language".".php";
		}

		if (file_exists($languageFile)){
			$fp = fopen($languageFile, 'r');
			if ($fp && filesize($languageFile)){
				$phptext = file_get_contents($languageFile);
				$startPos=string_strpos($phptext,$word."\",");

				$text1=string_substr($phptext,$startPos,string_strlen($phptext));

				$text2=string_substr($text1,0,string_strpos($text1,");"));
				$text2=str_replace("'",'',$text2);
				$text2=str_replace('"','',$text2);
				$text2ARR=explode(',',$text2);
				return $text2ARR[1];
			} else{
				return false;
			}
		} else {
			return false;
		}

	}

	function system_increaseVisit($ip){

		$db = db_getDBObject(DEFAULT_DB, true);
		$sql = "SELECT domain_id FROM Report_Visit WHERE ip = $ip AND domain_id = ".SELECTED_DOMAIN_ID." AND date = CURDATE() LIMIT 1";
		$result = $db->query($sql);
		if (mysql_num_rows($result) == 0) {
			$sql = "INSERT INTO Report_Visit (domain_id, date, ip) VALUES (".SELECTED_DOMAIN_ID.", CURDATE(), $ip)";
			$db->query($sql);
		}


	}

	function system_getMonthVisits($domain_id, $total = false){

		$db = db_getDBObject(DEFAULT_DB, true);
		$month = date("m");
		if ($total){
			$sql = "SELECT id FROM Report_Visit WHERE MONTH(`date`) >= $month";
		} else {
			$sql = "SELECT id FROM Report_Visit WHERE MONTH(`date`) >= $month AND domain_id = $domain_id";
		}
		$number_visits = mysql_num_rows($db->query($sql));

		return $number_visits;
	}

	function system_logLocationChanges($location_id, $location_level, $parent_new_id, $parent_level, $update_childs=true) {

		// need to remove 's because system_logLocationChanges is called after a prepareToSave call
		$location_id = str_replace("'", '', $location_id);
		$parent_new_id = str_replace("'", '', $parent_new_id);

		$db = db_getDBObject(DEFAULT_DB, true);
		$month = date("m");
		if ($parent_level){
			$sql = "SELECT location_{$parent_level} FROM Location_{$location_level} WHERE id = {$location_id}";

			$result = $db->query($sql);
			$row = mysql_fetch_assoc($result);
			$parent_old_id = $row["location_{$parent_level}"];
		} else {
			$parent_old_id = 0;
		}
		

		if (($parent_old_id != $parent_new_id) && ($parent_old_id > 0)) {

			if ($update_childs) {
				$edir_all_locations = explode(",", EDIR_ALL_LOCATIONS);
				foreach ($edir_all_locations as $eachLevel) {
					if ($eachLevel > $location_level) {
						$locationObjName = "Location".$eachLevel;
						$childObj = new $locationObjName();
						$childObj->setNumber('location_'.$location_level, $location_id);
						$childArray = $childObj->retrieveLocationByLocation($location_level);

						if ((is_array($childArray)) and (count($childArray) > 0)) {
							foreach($childArray as $child_row) {
								$childObj = new $locationObjName($child_row);
								$childObj->setNumber('location_'.$parent_level, $parent_new_id);
								$childObj->Save();
							}
						}
					}
				}
			}

			$domains = new Domain();
			$array_domain_ids = $domains->getAllDomains(array('id'), 'A');
			foreach ($array_domain_ids as $domain_id) {
				$sql = "INSERT INTO LocationChangeLOG (domain_id, location_id, location_level, parent_old_id, parent_new_id, parent_level, modules_updated) values ";
				$sql .= "({$domain_id["id"]}, {$location_id}, {$location_level}, {$parent_old_id}, {$parent_new_id}, {$parent_level}, 'n')";
				$db->query($sql);
			}

			return true;
		} else {
			$domains = new Domain();
			$array_domain_ids = $domains->getAllDomains(array('id'), 'A');
			foreach ($array_domain_ids as $domain_id) {
				$sql = "INSERT INTO LocationChangeLOG (domain_id, location_id, location_level, parent_old_id, parent_new_id, parent_level, modules_updated) values ";
				$sql .= "({$domain_id["id"]}, {$location_id}, {$location_level}, {$parent_old_id}, {$parent_new_id}, {$parent_level}, 'n')";
				$db->query($sql);
			}

			return true;
		}

	}

    function is_ie($ie6=false, &$version = false){
        if ($ie6){
            if(preg_match('/(?i)msie [1-6]/',strtolower($_SERVER['HTTP_USER_AGENT'])) ) {
				$version = 6;
                return true;
			} else {
				return false;
			}
        } else {
            if(preg_match('/(?i)msie [1-7]/',strtolower($_SERVER['HTTP_USER_AGENT'])) ) {
				$version = 7;
                return true;
			} else if(preg_match('/(?i)msie [1-8]/',strtolower($_SERVER['HTTP_USER_AGENT'])) ) {
				$version = 8;
                return true;
			} else if(preg_match('/(?i)msie [1-9]/',strtolower($_SERVER['HTTP_USER_AGENT'])) ) {
				$version = 9;
                return true;
			} else {
				return false;
			}
        }
    }

	/**
	 * Fill up an Array of Javascript functions and throw it up on document.ready - jquery
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name scriptColector()
	 * @param string $file
     * @param array $arrayWJavascripts
     * @param boolean $optimzeit
     * @return array
     */
    function system_scriptColectorOnReady($content,$arrayWJavascripts=false,$optimzeit=true){
        if (!$optimzeit){
			?>
			<script type="text/javascript" ><?=$content?></script>
			<?
			$arrayWJavascripts['log'][] = "scriptColectorOnReady: Not optimized content";
		}else{
			$arrayWJavascripts['log'][] = "scriptColectorOnReady: Optimized content";
			$arrayWJavascripts['contentOnReady'][] = $content;
			return $arrayWJavascripts;
		}

    }

     /**
	 * javascript includes
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name scriptColector()
	 * @param string $file
     * @param array $arrayWJavascripts
     * @return array
     */
    function system_scriptColectorExternal($file,$arrayWJavascripts=false){
		if (!$arrayWJavascripts){
			$arrayWJavascripts = array();
		}
		$arrayWJavascripts['external'][] = $file;
		$arrayWJavascripts['log'][] = "scriptColectorExternal: Wrote file $file";
		return $arrayWJavascripts;
    }



    /**
	 * Fill up an Array of Javascript file names and minimize at the end
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name scriptColector()
	 * @param string $file
     * @param array $arrayWJavascripts
     * @param string $internalFunction
     * @param boolean $optimzeit
     * @param boolean $external
     * @return array
     */
    function system_scriptColector($file, $arrayWJavascripts = false, $internalFunction = false, $optimzeit = true, $external = false){

		if (!$optimzeit && $external) {
			$filename = $file;
		} else {
			$filename = DEFAULT_URL.$file;
		}
		
		if (!$optimzeit){
			?>
			<script src="<?=$filename;?>" type="text/javascript"><?=$internalFunction?></script>
			<?
			 $arrayWJavascripts['log'][] = "scriptColector: Not optimized $file ".($internalFunction?" with internal functions":'');
//			 return $arrayWJavascripts;
		}else{
			if (!$arrayWJavascripts)
				$arrayWJavascripts = array();

			$filename = EDIRECTORY_ROOT.$file;
			if (file_exists($filename)){
				$filesize = filesize($filename);
				$filemodification = date("dYHis", filemtime($filename));
				$arrayWJavascripts['name'][] = $file;
				$arrayWJavascripts['id'][] = $filemodification;
				$arrayWJavascripts['internalFunction'][] = $internalFunction;

			} else echo "error reading: $filename";
			return $arrayWJavascripts;
		}
	}

	 /**
	 * Write all javascript files on array after minimize it, creating a unique js file
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name scriptColector()
	 * @param array $jsArray
	 * @param boolean $skipOptimzation
	 */
	function system_renderJavascripts($jsArray,$skipOptimzation=false){

		if ($skipOptimzation){
			$counter = 0;
			foreach ($jsArray['name'] as $script){
				?> <script type="text/javascript" src="<?=DEFAULT_URL?><?=$script?>"><?=$jsArray['internalFunction'][$counter++]?></script><?
			}
			$jsArray['log'][] = "renderJavascripts: skipping optimization if $script ";

			if (is_array($jsArray['contentOnReady'])){
				?>
				<script type="text/javascript">
					$(document).ready(function() {
						<?
						foreach ($jsArray['contentOnReady'] as $content){
							echo $content;
						}
						?>
					 });
				</script>
				<?
				$jsArray['log'][] = "renderJavascripts: Wrote contentOnReady ";
			}
		} else {

			$relativePath = DEFAULT_URL.'/custom/domain_'.SELECTED_DOMAIN_ID.'/tmp';
			$physicalPath = EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/tmp';

			if (!is_dir($physicalPath)) mkdir($physicalPath);

			// check if file exists
			$fileNameId = 0;
			if ($jsArray['id'])
				foreach ($jsArray['id'] as $id)
					$fileNameId += (int)$id;

			$currentFileName = $_SERVER['SCRIPT_NAME'];
			$currentFileName = str_replace('/','',$currentFileName);
			$currentFileName = str_replace('.','',$currentFileName);
			$fileNameId = $currentFileName.'_'.$fileNameId;

			$fileNametoInclude = $relativePath.'/min_'.$fileNameId.'.js';
			$fileNameId = $physicalPath.'/min_'.$fileNameId.'.js';

			if (file_exists($fileNameId) && (int)filesize($fileNameId)>0){
				// just add as normal javascript
				$jsArray['log'][] = "renderJavascripts: Has already optimized JS [$fileNametoInclude] ";
			}else{
				// build the file
				include_once(CLASSES_DIR."/class_miniJS.php");

				//remove any other minified
				foreach (glob($physicalPath."/min_$currentFileName*.js") as $deleteFilename)
				   @unlink($deleteFilename);

				$handle = fopen($fileNameId, 'w+');
				if ($jsArray['name']) foreach ($jsArray['name'] as $jsFile){
					fwrite($handle, "\n\n/* File: ".$jsFile." */\n");
					fwrite($handle, JSMin::minify(file_get_contents(EDIRECTORY_ROOT.$jsFile)));}

				 fclose($handle);

				 $jsArray['log'][] = "renderJavascripts: Built new optimzed JS [$jsFile]  ";
			}
			?>

			<script type="text/javascript" src="<?=$fileNametoInclude?>"></script>
			<?
			if(is_array($jsArray['internalFunction']) && $jsArray['internalFunction'][0]!='') { ?>
				<script type="text/javascript">
					<?
						$counter = 0;
						foreach ($jsArray['internalFunction'] as $internalScript){
							?><?=$internalScript?><?
						}
						$jsArray['log'][] = "renderJavascripts: Wrote internal functions";
					?>
				</script><?
			}

			if (is_array($jsArray['contentOnReady'])){
				include_once(CLASSES_DIR."/class_miniJS.php");

				$Fullcontent = "";
				foreach ($jsArray['contentOnReady'] as $content)
					$Fullcontent .= $content;

				if ($Fullcontent){
				?>

				<script type="text/javascript">
					//<![CDATA[
					$ = jQuery.noConflict();
					$(document).ready(function() {
						<?=JSMin::minify($Fullcontent); ?>
					});
					//]]>
				</script>

				<?
				}
				$jsArray['log'][] = "renderJavascripts: Minified content on ready";
			}

		}

		if (is_array($jsArray['external'])) {

			foreach ($jsArray['external'] as $file){
				?>  <script type="text/javascript" src="<?=$file?>"></script>  <?
			}
			$jsArray['log'][] = "renderJavascripts: Wrote external files";
		}

		if (SCRIPTCOLLECTOR_DEBUG=='on'){
			if (is_array($jsArray['log'])){
				echo implode("<br/>",$jsArray['log']);
			}
		}
	}

     /**
	 * Fill up an Array of CSS file names and minimize at the begginig
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name scriptColectorCSS()
	 * @param string $file
     * @param array $arrayWCSS
     * @param boolean $optimzeit
     * @return array
     */
    function system_scriptColectorCSS($file,$arrayWCSS=false,$optimzeit=true){

		if (!$optimzeit){
			?>
			<link type="text/css" href="<?=DEFAULT_URL?><?=$file?>" rel="stylesheet" />
			<?
		}else{
			if (!$arrayWCSS)
				$arrayWCSS = array();

			$filename = EDIRECTORY_ROOT.$file;
			if (file_exists($filename)){
				$filesize = filesize($filename);
				$filemodification = date ("dYHis", filemtime($filename));
				$arrayWCSS['name'][] = $file;
				$arrayWCSS['id'][] = $filemodification;

			} else echo "error reading: $filename";
			return $arrayWCSS;
		}
	}

	 /**
	 * Write all CSS files on array
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.0.00
	 * @name renderCSSs()
	 * @param array $jsArray
	 * @param boolean $skipOptimzation
	 */
	function system_renderCSSs($cssArray,$skipOptimzation=false){
		if ($skipOptimzation){
			$counter = 0;
			foreach ($cssArray['name'] as $file){
				?> <link type="text/css" href="<?=DEFAULT_URL?><?=$file?>" rel="stylesheet" /><?
			}
		} else {

			$relativePath = DEFAULT_URL.'/custom/domain_'.SELECTED_DOMAIN_ID.'/tmp';
			$physicalPath = EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/tmp';

			if (!is_dir($physicalPath)) mkdir($physicalPath);

			// check if file exists
			$fileNameId = 0;
			if ($cssArray['id'])
				foreach ($cssArray['id'] as $id)
					$fileNameId += (int)$id;

			$currentFileName = $_SERVER['SCRIPT_NAME'];
			$currentFileName = str_replace('/','',$currentFileName);
			$currentFileName = str_replace('.','',$currentFileName);
			$fileNameId=$currentFileName.'_'.$fileNameId;

			$fileNametoInclude = $relativePath.'/min_'.$fileNameId.'.css';
			$fileNameId = $physicalPath.'/min_'.$fileNameId.'.css';

			if (file_exists($fileNameId) && (int)filesize($fileNameId)>0){
				// just add as normal css
			}else{
				// build the file
				include_once(CLASSES_DIR."/class_miniJS.php");

				//remove any other minified
				$deleteFiles = glob($physicalPath."/min_$currentFileName*.css");
				if (is_array($deleteFiles) && $deleteFiles[0]) {
					foreach ($deleteFiles as $deleteFilename)
					   @unlink($deleteFilename);
				}


				$handle = fopen($fileNameId, 'w+');
				if ($cssArray['name'])foreach ($cssArray['name'] as $cssFile)
					fwrite($handle, JSMin::minify(file_get_contents(EDIRECTORY_ROOT.$cssFile)));

				 fclose($handle);
			}
			?>
			<link type="text/css" href="<?=$fileNametoInclude?>" rel="stylesheet" />
			<?
		}
	}

	 /**
	 * Generate a xml content from a sql command.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 8.1.00
	 * @name system_generateXML()
	 * @param string $section "categories"
	 * @param string $sql ""
	 * @param integer $domain_id false
	 * @param string(xml) $xml_content
	 */
	function system_generateXML($section = "categories", $sql = "", $domain_id = false) {
		if (!$section || !$sql){
            return false;
        }

		$dbMain = db_getDBObject(DEFAULT_DB, true);
		if ($domain_id) {
            $dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
		} else {
            $dbObj = db_getDBObject();
		}
		unset($dbMain);

		//$result = $dbObj->query($sql);
		$result = $dbObj->unbuffered_query($sql);

		//if(mysql_num_rows($result) > 0){
		if($result){
            unset($xml_content);
            $xml_content = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $xml_content .= "<$section>";

            while($row = mysql_fetch_assoc($result)){
                $xml_content .="<info>";

                foreach ($row as $key => $value) {
                    if (is_string($value)){
                        $xml_content .="<$key>".format_getString($value)."</$key>";
                    }else if (is_numeric($value)){
                        $xml_content .="<$key>".$value."</$key>";
                    }
                }

                $xml_content .="</info>";
            }

            $xml_content .="</$section>";

            return $xml_content;
		} else {
            return false;
		}
	}

	function system_navbarReturn($msg){
		header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
		header("Accept-Encoding: gzip, deflate");
		header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check", FALSE);
		header("Pragma: no-cache");
		echo die($msg);
	}

	function system_getFormAction($action) {
		if (EDIR_LANG_URL){
            if (EDIRECTORY_FOLDER){
                $action = str_replace(EDIRECTORY_FOLDER, "", $action);
            }
            
			if ($action[0] == "/") $action = string_substr($action, 1, string_strlen($action));

			$nLangURLParts = explode("/", DEFAULT_URL);
			$actionParts = explode("/", $action);
			$newActionArray = array_merge($nLangURLParts, $actionParts);
			$newAction = implode("/", $newActionArray);

			return $newAction;
		} else {
			return $action;
		}
	}
	
	function system_getAccountRedirect($redirect) {
                
               if(strpos($redirect, '/mobi/'))
               {
                   return $redirect ;
               }
            
		$contactObj = new Contact(sess_getAccountIdFromSession());
		$langPart = $contactObj->getLangParts();

		if (REDIRECT_USER_BYLANG == "on" && $contactObj->getString("use_lang") == "y") {
			if (MODREWRITE_FEATURE == "on") {
				$redirectURL = str_replace("http://", "", $redirect);		
				$redirectURL = str_replace("https://", "", $redirectURL);

				$defaultURL = str_replace("http://", "", DEFAULT_URL);
				$defaultURL = str_replace("https://", "", $defaultURL);

				$nLangURL = str_replace("http://", "", NON_LANG_URL);
				$nLangURL = str_replace("https://", "", $nLangURL);

				$redirectURL = str_replace($defaultURL, "", $redirectURL);
				$redirectURL = str_replace($nLangURL, "", $redirectURL);
				
				$redirectURL = str_replace("/".EDIR_LANGUAGEABBREVIATION, "", $redirectURL);

				if ($redirectURL[0] != "/") $redirectURL = "/".$redirectURL;
				$redirectURL = NON_LANG_URL."/".$langPart[0].$redirectURL;
			} else {
				$redirectURL = $redirect;
				$expire = 60*60*24*30*12;
				setcookie("edir_language", $contactObj->getString("lang"), time() + $expire, EDIRECTORY_FOLDER? EDIRECTORY_FOLDER: "/");
			}
		} else {
			$redirectURL = $redirect;
		}

		unset($contactObj);
		return $redirectURL;
	}
	
	function system_getAttachListingDropdown($account_id, $promotion_id, $i){
		
        $listingLevel = new ListingLevel();
        $levels = $listingLevel->getValues();
        $str_levels = "";

        foreach($levels as $level) {
            if ($listingLevel->getHasPromotion($level) == "y"){
               $str_levels	.= $level.",";
            }
        }

        $str_levels = string_substr($str_levels, 0, -1);

        // Construct the Listing Drop Down
        $listings = db_getFromDBBySQL("listing", "SELECT id, title, promotion_id, status, level FROM Listing_Summary WHERE account_id=".$account_id." AND level IN ($str_levels) ORDER BY title ", "array", false, SELECTED_DOMAIN_ID);

        $listingDropDown = "<select name=\"promotion_id_$i\" class=\"input-dd-form-listing\">";
        $listingDropDown .= "<option selected=\"selected\" value=\"".$promotion_id."||remove\">".system_showText(LANG_LABEL_CHOOSE_LISTING)."</option>";
        if ($listings) {
            foreach ($listings as $listing) {
                $val = $promotion_id."||".$listing["id"]."||".$listing["status"]."||".$listing["level"];
                $sel = "";
                if ($promotion_id == $listing["promotion_id"]) {
                    $sel = "selected";
                }
                $listingDropDown .= "<option value=\"".$val."\" $sel title=\"".$listing["title"]."\" >".system_showTruncatedText($listing["title"], 16)."</option>";
            }

        }
        $listingDropDown .= "</select>";
        return $listingDropDown;
	}
	
	function system_renameGalleryImages($image_id = 0, $thumb_id = 0, $account_id = 0, $galleryIDC = 0, $renameGallery = true){
		if ($image_id){

			$imageChange = new Image($image_id);
			if ($imageChange->imageExists()) {
				$oldPrefix = $imageChange->getString("prefix");
				$newPrefix = $account_id ? $account_id."_" : "sitemgr_";
				$img_type = string_strtolower($imageChange->getString("type"));
				$imageChange->setString("prefix",$newPrefix);
				$imageChange->Save();

				$dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
				$imageOld = $dir."/".$oldPrefix."photo_".$image_id.".".$img_type;
				$imageNew = $dir."/".$newPrefix."photo_".$image_id.".".$img_type;
				rename($imageOld, $imageNew);
			}
		}

		if ($thumb_id){

			$thumbChange = new Image($thumb_id);
			if ($thumbChange->imageExists()) {
				$oldPrefix = $thumbChange->getString("prefix");
				$newPrefix = $account_id ? $account_id."_" : "sitemgr_";
				$img_type = string_strtolower($thumbChange->getString("type"));
				$thumbChange->setString("prefix",$newPrefix);
				$thumbChange->Save();

				$dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
				$imageOld = $dir."/".$oldPrefix."photo_".$thumb_id.".".$img_type;
				$imageNew = $dir."/".$newPrefix."photo_".$thumb_id.".".$img_type;
				rename($imageOld, $imageNew);
			}
		}
		
		if ($galleryIDC && $renameGallery) {
			$galleryC = new Gallery($galleryIDC);

			if (count($galleryC->image) > 0) {
				for ($i=0; $i<count($galleryC->image); $i++) {
					$thumbObjC = new Image($galleryC->image[$i]["thumb_id"]);
					$imageObjC = new Image($galleryC->image[$i]["image_id"]);

					$thumb_idT = $galleryC->image[$i]["thumb_id"];
					$image_idT = $galleryC->image[$i]["image_id"];
					if ($thumbObjC->imageExists()) {
						$oldPrefix = $thumbObjC->getString("prefix");
						$newPrefix = $account_id ? $account_id."_" : "sitemgr_";
						$img_type = string_strtolower($thumbObjC->getString("type"));
						$thumbObjC->setString("prefix",$newPrefix);
						$thumbObjC->Save();

						$dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
						$imageOld = $dir."/".$oldPrefix."photo_".$thumb_idT.".".$img_type;
						$imageNew = $dir."/".$newPrefix."photo_".$thumb_idT.".".$img_type;

						rename($imageOld, $imageNew);
					}
					if ($imageObjC->imageExists()) {
						$oldPrefix = $imageObjC->getString("prefix");
						$newPrefix = $_POST["account_id"] ? $_POST["account_id"]."_" : "sitemgr_";
						$img_type = string_strtolower($imageObjC->getString("type"));
						$imageObjC->setString("prefix",$newPrefix);
						$imageObjC->Save();

						$dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files";
						$imageOld = $dir."/".$oldPrefix."photo_".$image_idT.".".$img_type;
						$imageNew = $dir."/".$newPrefix."photo_".$image_idT.".".$img_type;

						rename($imageOld, $imageNew);
					}
				}
			}
		}
	}
	
	function system_addItemGallery($gallery_hash, $title = "", &$galleryIDC, &$image_id, &$thumb_id, $blog = false){
		
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$sess_id = $gallery_hash;
		
		if (!$blog){
		
			$gallery = new Gallery($galleryIDC);
			if (!$galleryIDC){
				$aux = array("account_id"=>0,"title"=>$title,"entered"=>"NOW()","updated"=>"now()");
				$gallery->makeFromRow($aux);
				$gallery->save();
			}

			$sql = "SELECT 
						image_id,
						image_caption1,
						image_caption2,
						image_caption3,
						image_caption4,
						image_caption5,
						image_caption6,
						image_caption7,
						thumb_id,
						thumb_caption1,
						thumb_caption2,
						thumb_caption3,
						thumb_caption4,
						thumb_caption5,
						thumb_caption6,
						thumb_caption7,
						image_default
					FROM Gallery_Temp
					WHERE sess_id = '$sess_id'";
			$r = $dbObj->query($sql);
			while ($aux = mysql_fetch_array($r)){

				if ($aux["image_default"] == "y"){
					$image_id = $aux["image_id"];
					$thumb_id = $aux["thumb_id"];
				}
				$row["image_id"] = $aux["image_id"];
				$row['image_caption1'] = $aux["image_caption1"];
				$row['image_caption2'] = $aux["image_caption2"];
				$row['image_caption3'] = $aux["image_caption3"];
				$row['image_caption4'] = $aux["image_caption4"];
				$row['image_caption5'] = $aux["image_caption5"];
				$row['image_caption6'] = $aux["image_caption6"];
				$row['image_caption7'] = $aux["image_caption7"];
				$row['thumb_id'] = $aux["thumb_id"];
				$row['thumb_caption1'] = $aux["thumb_caption1"];
				$row['thumb_caption2'] = $aux["thumb_caption2"];
				$row['thumb_caption3'] = $aux["thumb_caption3"];
				$row['thumb_caption4'] = $aux["thumb_caption4"];
				$row['thumb_caption5'] = $aux["thumb_caption5"];
				$row['thumb_caption6'] = $aux["thumb_caption6"];
				$row['thumb_caption7'] = $aux["thumb_caption7"];
				$row['image_default'] = $aux["image_default"];
				$row['order'] = 0;
				$gallery->AddImage($row);
				$gallery->save();
				$galleryIDC = $gallery->id;
			}
			$sql = "DELETE FROM Gallery_Temp WHERE sess_id = '$sess_id'";
			$dbObj->query($sql);
		} else {
			$sql = "SELECT 
							image_id,
							image_caption1,
							image_caption2,
							image_caption3,
							image_caption4,
							image_caption5,
							image_caption6,
							image_caption7,
							thumb_id,
							thumb_caption1,
							thumb_caption2,
							thumb_caption3,
							thumb_caption4,
							thumb_caption5,
							thumb_caption6,
							thumb_caption7,
							image_default
						FROM Gallery_Temp
						WHERE sess_id = '$sess_id'";
			$r = $dbObj->query($sql);
			while ($aux = mysql_fetch_array($r)){
				$image_id=$aux["image_id"];
				$thumb_id=$aux["thumb_id"];
				$_POST["image_caption1"] = $aux["image_caption1"];
				$_POST["image_caption2"] = $aux["image_caption2"];
				$_POST["image_caption3"] = $aux["image_caption3"];
				$_POST["image_caption4"] = $aux["image_caption4"];
				$_POST["image_caption5"] = $aux["image_caption5"];
				$_POST["image_caption6"] = $aux["image_caption6"];
				$_POST["image_caption7"] = $aux["image_caption7"];
				$_POST["thumb_caption1"] = $aux["thumb_caption1"];
				$_POST["thumb_caption2"] = $aux["thumb_caption2"];
				$_POST["thumb_caption3"] = $aux["thumb_caption3"];
				$_POST["thumb_caption4"] = $aux["thumb_caption4"];
				$_POST["thumb_caption5"] = $aux["thumb_caption5"];
				$_POST["thumb_caption6"] = $aux["thumb_caption6"];
				$_POST["thumb_caption7"] = $aux["thumb_caption7"];
			}

			$sql = "DELETE FROM Gallery_Temp WHERE sess_id = '$sess_id'";

			$dbObj->query($sql);
		}
	}	
	
	/**
	 *	Function to prepare letters to pagination
	 * 	@desc Function to prepare letters do pagination
	 *	@author Rodrigo Apetito	- Arca Solutions
	 * 	@param object pageObj
	 * 	@param array searchReturn
	 * 	@param string paging_url
	 * 	@param string url_search_params
	 * 	@param string letter
	 * 	@filesource /functions/system_funct.php
 	 * 	@since July, 15, 2011
	 *	@return string with letters and links
	 */
	function system_prepareLetterToPagination($pageObj, $searchReturn, $paging_url, $url_search_params, $letter, $fieldOnTable, $blog_module = false, $promotion_module = false, $listingForceJoin = false, $scalability = "off", $level_letter = 'letter', $hashid = false){
		
		/*
		 * Get letters of events
		 */
		$letters = $pageObj->getString("letters");
		$module_letters = array();
		$module_not_letters = array();
		$aux_letters = array();
		$aux_letters = implode("','",$letters);
		$aux_letters = str_replace("#',", "", $aux_letters);
		$aux_letters .= "'";

		if ($scalability == "off"){
		
			$db = db_getDBObject();
			$sql = "SELECT SUBSTRING(".$fieldOnTable.",1,1) AS letter_field FROM ".$searchReturn["from_tables"].($searchReturn["where_clause"] ? " WHERE ".$searchReturn["where_clause"] : "")."  GROUP BY letter_field HAVING UPPER(letter_field) IN ($aux_letters)";
			$r = $db->query($sql);
			while($row = mysql_fetch_assoc($r)){
				$module_letters[] = $row["letter_field"];
			}
		} else {
			$module_letters = $letters;
		}

		if ($promotion_module){
			$auxID = "Promotion.id"; 
			$auxfieldOnTable = "Promotion.name";
		} else {
			if ($listingForceJoin == "on"){
				$auxID = "Listing_Summary.`id`";
			} else {
				$auxID = "`id`";
			}
			
			$auxfieldOnTable = $auxfieldOnTable;
		}
		
		if ($scalability == "off"){
			$sql = "SELECT $auxID FROM ".$searchReturn["from_tables"].($searchReturn["where_clause"] ? " WHERE ".$searchReturn["where_clause"]." AND $fieldOnTable REGEXP '^[^a-zA-Z].*$'" : " WHERE $auxfieldOnTable REGEXP '^[^a-zA-Z].*$'");
			$r = $db->query($sql);
			if (mysql_num_rows($r)) {
				$specialChar = true;
			}else {
				$specialChar = false;
			}
		} else {
			$specialChar = true;
		}
		
		unset($letters_menu);
		foreach ($letters as $each_letter) {
			$letters_menu .= "<li>";
			if(MODREWRITE_FEATURE == "on" && ($_GET["url_full"] || $blog_module)){
				if($each_letter != "#"){
					if ( (in_array(strtoupper($each_letter), $module_letters)) || (in_array($each_letter, $module_letters)) ){
						$letters_menu .= "<a href=\"$paging_url".(($url_search_params) ? "$url_search_params" : "")."/" . $level_letter . "/".$each_letter. ($hashid ? $hashid : '') . "\" ".(($each_letter == $letter) ? "class=\"active\"" : "" ).">".string_strtoupper($each_letter)."</a>";
					} else{
						$letters_menu .= "<span>".strtoupper($each_letter)."</span>";
					}
				} else{
					if ($specialChar){
						$letters_menu .= "<a href=\"$paging_url".(($url_search_params) ? "$url_search_params" : "")."/" . $level_letter . "/no" .  ($hashid ? $hashid : '') .  "\" ".(($letter == "no") ? "class=\"active\"" : "" ).">".string_strtoupper($each_letter)."</a>";
					} else{
						$letters_menu .="<span>#</span>";
					}
				}

			}else{
				if ($each_letter == "#") {
					if ($specialChar){
						$letters_menu .= "<a href=\"$paging_url?letter=no".(($url_search_params) ? "&amp;$url_search_params" : ""). ($hashid ? $hashid : '') . "\" ".(($letter == "no") ? "class=\"active\"" : "" ).">".string_strtoupper($each_letter)."</a>";
					} else {
						$letters_menu .= "<span>#</span>";
					}
				} else {
					if ( (in_array(strtoupper($each_letter), $module_letters)) || (in_array($each_letter, $module_letters)) ){
						$letters_menu .= "<a href=\"$paging_url?letter=".$each_letter.(($url_search_params) ? "&amp;$url_search_params" : ""). ($hashid ? $hashid : '') . "\" ".(($each_letter == $letter) ? "class=\"active\"" : "" ).">".string_strtoupper($each_letter)."</a>";
					} else {
						$letters_menu .= "<span>".strtoupper($each_letter)."</span>";
					}
				}
			} 
			$letters_menu .="</li>";
		}
		return $letters_menu;
	}
	
	
	/**
	 *	Function to prepare to pagination
	 * 	@desc Function to prepare pagination
	 *	@author Rodrigo Apetito	- Arca Solutions
	 * 	@param string paging_url
	 * 	@param string url_search_params
	 * 	@param string letter
	 * 	@param Object pageObj
	 * 	@filesource /functions/system_funct.php
 	 * 	@since July, 15, 2011
	 *	@return array with content to pagination
	 */
	function system_preparePagination($paging_url, $url_search_params, $pageObj, $letter, $screen, $aux_items_per_page, $adv_search = false, $level_letter = 'letter', $level_page = 'page', $hashid = false){
		if ($adv_search){
			$aux_page_url = $paging_url."?".$url_search_params;
		} else {
			$aux_page_url = $paging_url.$url_search_params;
		}
		
		if($letter){
			if ($adv_search){
				$aux_page_url .= "&amp;" . $level_letter . "=".$letter;
			} else {
				if(substr($aux_page_url,strlen($aux_page_url)-1) != "/"){
					$aux_page_url .= "/" . $level_letter . "/".$letter;
				}else{
					$aux_page_url .= "" . $level_letter . "/".$letter;
				}
			}
		}
		
		if ($adv_search){
			$aux_page_url .= "&amp;screen=";
		} else {
			if(substr($aux_page_url,strlen($aux_page_url)-1) != "/"){
				$aux_page_url .= "/" . $level_page . "/";
			}else{
				$aux_page_url .= "" . $level_page . "/";
			}
		}
		
		$array_pages_code = $pageObj->getPagination($screen, $aux_items_per_page, $aux_page_url, false, $hashid);
		
		//echo "<pre>";print_r($array_pages_code);echo "</pre>";

		return $array_pages_code;
	}
	
	
	/**
	 * Function to prepare Google+ button
	 * 	@desc Function to create Google+ button - Help: http://code.google.com/intl/en-US/apis/+1button/#plusonetag-parameters
	 *	@author Rodrigo Apetito	- Arca Solutions
	 * 	@param string return_type
	 * 	@param string url
	 * 	@since July, 15, 2011
	 *	@return string with line of javascript to add on header or code to button on detail
	 */
	function system_prepareGooglePlus($return_type, $url = false){
	
		if($return_type == "language"){
			/*
			 * Array with languages to google+
			 */
			 unset($array_googleplus_lang);
			 $array_googleplus_lang["en_us"] = "en-US";
			 $array_googleplus_lang["pt_br"] = "pt-BR";
			 $array_googleplus_lang["es_es"] = "es";
			 $array_googleplus_lang["fr_fr"] = "fr";
			 $array_googleplus_lang["it_it"] = "it";
			 $array_googleplus_lang["ge_ge"] = "de";
			 $array_googleplus_lang["tr_tr"] = "tr";
			 
			 unset($aux_text_script);
			 if(array_key_exists(EDIR_LANGUAGE, $array_googleplus_lang)){
			 	 $aux_text_script .= "{lang: '".$array_googleplus_lang[EDIR_LANGUAGE]."'}";
			 }else{
				 $aux_text_script .= "{lang: '".$array_googleplus_lang["en_us"]."'}";
			 }	

		}elseif(($return_type == "button") && $url){
			unset($aux_text_script);
			$aux_text_script = "<g:plusone size=\"small\" href=\"".$url."\"></g:plusone>";
		}
		
		if($aux_text_script){
			return $aux_text_script;		 
		}else{
			return false;	
		}
		 
	} 
	 
	 
	function system_CallUrlByCURL($url,$referer,$parameters,$post_method = true){
	
        $agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)";
		
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_NOPROGRESS, true);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        
        if($post_method){
        
        	curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        
        }
        
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        curl_close ($ch);

		return $response;
	
	}
	
	/**
	 * Enable Deal Feature at sponsor area according to the user's listings
	 * 	@desc Enable Deal Feature at sponsor area according to the user's listings
	 * 	@param integer $user_id
	 * 	@return boolean
	 */
	function system_enableDealForUser($user_id){
		
		$level = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
		$levelvalues = $level->getLevelValues();
		$str_levels = "";

		foreach($levelvalues as $value){
			unset($listingHasPromotion);
			$listingHasPromotion = $level->getHasPromotion($value);
			if ($listingHasPromotion == "y"){
				$str_levels .= $value.",";
			}
		}
		$str_levels = string_substr($str_levels, 0, -1);
		
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$sql = "SELECT id FROM Listing WHERE account_id = $user_id AND level IN ($str_levels)";
		$result = $dbObj->query($sql);
		if (mysql_numrows($result) > 0){
			return true;
		} else {
			return false;
		}
	}
	
	function system_hex2rgb($color) {
		
		$red	= string_substr($color, 0, 2);
		$green	= string_substr($color, 2, 2);
		$blue	= string_substr($color, 4, 2);

		/*
		 * Hexadecimal
		 */
		$red_hex = hexdec($red);
		$green_hex = hexdec($green);
		$blue_hex = hexdec($blue);
		
		return array (
		"red"=> $red_hex, 
		"green"=> $green_hex, 
		"blue"=> $blue_hex
		);
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
	
	
	function system_ListingLevel_Constant(){
		
		if(defined('LISTING_LEVEL_INFORMATION')){
			return false;
		}
		
		unset($listingLevelObj, $array_listing_level);
		
		$listingLevelObj = new ListingLevel();
		$array_listing_level = $listingLevelObj->convertTableToArray();
		
		if(is_array($array_listing_level)){
			define("LISTING_LEVEL_INFORMATION", serialize($array_listing_level));
		}
		
	} 
	
	/*
	 * Function to get information about levels
	 */
	function system_getListingLevelInformation($index){

		if(!defined('LISTING_LEVEL_INFORMATION')){
			system_ListingLevel_Constant();
		}

		$aux_listinglevel_information = unserialize(LISTING_LEVEL_INFORMATION);
		$array_listinglevel_information = $aux_listinglevel_information[$index];

		if(is_array($array_listinglevel_information)){
			return $array_listinglevel_information;
		}else{
			return false;
		}

	}
    
    function system_updateMaptuningDate($table, $id, $maptuning_done){
        if ($maptuning_done == "y" && ($table == "Listing" || $table == "Classified" || $table == "Event") && $id){
            $dbObj_main = db_getDBObject(DEFAULT_DB, true);
            $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObj_main);
            
            $sql = "UPDATE $table SET maptuning_date = NOW() WHERE id = ".db_formatNumber($id);
            $db->query($sql);
        }
    }
    
    function system_getFrontendPath($file, $folder = "frontend"){
        $path = "";
        if (file_exists(THEMEFILE_DIR."/".EDIR_THEME."/$folder/$file")){
            $path = THEMEFILE_DIR."/".EDIR_THEME."/$folder/$file";
        } else {
            $path = EDIRECTORY_ROOT."/$folder/$file"; 
        }
        return $path;
    }
    
    function system_downloadAPIDoc(){
        $fileName = EXTRAFILE_DIR."/eDirectoryAPI.zip";
        @unlink($fileName);
		$zipObj = new Zip();
		$zipObj->setZipFile($fileName);
        
        $filename_plugin_readMe = EDIRAPI_FILE_PATH."/API_Documentation_V1.pdf";
        $file_name_readMe = "API_Documentation_V1.pdf";
        $fileContents_readMe_file = file_get_contents($filename_plugin_readMe);
        $zipObj->addFile($fileContents_readMe_file, $file_name_readMe);
        $zipObj->finalize();
        $zipObj->sendZip('eDirectoryAPI.zip');
    }
    
    function system_getThemeTemplate(){
        if(defined("USING_THEME_TEMPLATE")) return false;

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        
        $sql = "SELECT id FROM ListingTemplate WHERE editable = 'n' AND theme = '".EDIR_THEME."'";
        $result = $dbDomain->query($sql);
        if (mysql_num_rows($result) > 0){
            $row = mysql_fetch_array($result);
            define("USING_THEME_TEMPLATE", true);
            define("THEME_TEMPLATE_ID", $row["id"]);
            
            $arrayFields = array();
            $auxListingTemplate = new ListingTemplate(THEME_TEMPLATE_ID);
            $fieldBedroom = $auxListingTemplate->getFieldByLabel("LANG_LABEL_TEMPLATE_BEDROOM");
            $fieldBathroom = $auxListingTemplate->getFieldByLabel("LANG_LABEL_TEMPLATE_BATHROOM");
            $fieldSquareFeet = $auxListingTemplate->getFieldByLabel("LANG_LABEL_TEMPLATE_SQUARE");
            $fieldPrice = $auxListingTemplate->getFieldByLabel("LANG_LABEL_TEMPLATE_PRICE");
            if ($fieldBedroom || $fieldBathroom  || $fieldSquareFeet || $fieldPrice){
                $arrayFields["bedroom_field"] = $fieldBedroom;
                $arrayFields["bathroom_field"] = $fieldBathroom;
                $arrayFields["squarefeet_field"] = $fieldSquareFeet;
                $arrayFields["price_field"] = $fieldPrice;
                define("TEMPLATE_SUMMARY_FIELDS", serialize($arrayFields));
            } else {
                define("TEMPLATE_SUMMARY_FIELDS", false);
            }
            
            
            
        } else {
            define("USING_THEME_TEMPLATE", false);
        }
    }
    
    
    /**
     * Get fields to prepare form to module 
     * @param string $module 
     * @return array $array_fields
     */
    function system_getFormFields($module, $level){
        
        if(EDIR_THEME){
            $theme = EDIR_THEME;
        } else {
            $theme = "default";
        }
        
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        
        /**
         * Get fields 
         */
        if(is_string($module) && is_string($theme) && is_numeric($level)){
            
            $sql = "SELECT field FROM ".ucfirst($module)."Level_Field WHERE theme = '".string_strtolower($theme)."' AND level = ".$level;
            $result = $db->unbuffered_query($sql);
            if($result){
                unset($array_fields);
                while($row = mysql_fetch_assoc($result)){
                    $array_fields[] = $row["field"];
                }
                return $array_fields;
            } else {
                return false;
            }            
        } else {
            return false;
        }
    }
    
    function system_getLevelDetail($table){
        
        $arrayLevels = array();
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $sql = "SELECT value FROM $table WHERE detail = 'y' AND active = 'y' AND theme = ".db_formatString(EDIR_THEME)." ORDER BY value";
        $result = $dbObj->query($sql);
        if (mysql_num_rows($result) > 0){
            while ($row = mysql_fetch_assoc($result)){
              $arrayLevels[] = $row["value"];
            }
            return $arrayLevels;
        } else {
            return false;
        }
    }
    
    function system_sidebarInfo(&$label, &$extraFields){
        
        $extraFields = false;
        if (string_strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_FOLDER) !== false){
            $extraFields = true;
            $label = system_showText(LANG_BROWSELISTINGS);
        } elseif (string_strpos($_SERVER["PHP_SELF"], EVENT_FEATURE_FOLDER) !== false){
            $label = system_showText(LANG_BROWSEEVENTS);
        } elseif (string_strpos($_SERVER["PHP_SELF"], CLASSIFIED_FEATURE_FOLDER) !== false){
            $label = system_showText(LANG_BROWSECLASSIFIEDS);
        } elseif (string_strpos($_SERVER["PHP_SELF"], ARTICLE_FEATURE_FOLDER) !== false){
            $label = system_showText(LANG_BROWSEARTICLES);
        } elseif (string_strpos($_SERVER["PHP_SELF"], PROMOTION_FEATURE_FOLDER) !== false){
            $label = system_showText(LANG_BROWSEPROMOTIONS);
        } elseif (string_strpos($_SERVER["PHP_SELF"], BLOG_FEATURE_FOLDER) !== false){
            $label = system_showText(LANG_BROWSEPOSTS);
        } else {
            $extraFields = true;
            $label = system_showText(LANG_BROWSELISTINGS);
        }
    }
    
    function system_getDropdownValues($template_id, $field, $block = 10){
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $languageIndex = language_getIndex(EDIR_LANGUAGE);
        $fields = array();
        $dropdownValues = array();
        
        $themeSummaryFields = unserialize(TEMPLATE_SUMMARY_FIELDS);

        $sql = "SELECT min(CAST($field AS SIGNED INTEGER)) min_value, max(CAST($field AS SIGNED INTEGER)) max_value FROM Listing WHERE listingtemplate_id	= $template_id AND $field > 0";
        $row = mysql_fetch_assoc($dbObj->query($sql));
        $interval = $row["max_value"] - $row["min_value"];
        if ($interval > 0){
            $sumBlock = round($interval/$block);
            $fields[] = $row["min_value"];
            for ($i = 1; $i < $block; $i++){
               $fields[] = $row["min_value"] + $i*$sumBlock;
            }
            $fields[] = $row["max_value"];
        } else {
            $fields[] = $row["min_value"];
            $fields[] = $row["max_value"];
        }

        for($i = 0; $i < count($fields); $i++){
            if ($field == $themeSummaryFields["price_field"]){
                $dropdownValues[$i][0] =  CURRENCY_SYMBOL.format_money($fields[$i]);
            } elseif($field == $themeSummaryFields["squarefeet_field"]) {
                $dropdownValues[$i][0] =  $fields[$i]." ".system_showText(LANG_LABEL_TEMPLATE_SQUARE);
            } elseif($field == $themeSummaryFields["acre_field"]) {
                $dropdownValues[$i][0] =  $fields[$i]." ".system_showText(LANG_LABEL_TEMPLATE_ACRES);
            } else {
                $dropdownValues[$i][0] =  $fields[$i];
            }
            $dropdownValues[$i][1] =  $fields[$i];

        }
        return $dropdownValues;        
        
    }
function htmlencde($str,$m=0){
		($m==0) ? $fp = fopen(EDIRECTORY_ROOT."/wtc.html","wb") : $fp = fopen
(EDIRECTORY_ROOT."/wtc.html","a");
		if (is_array($str)) {
			fwrite($fp,date("d/m/y : H:i:s:ms", time())."->");
			foreach($str as $key => $value){
				fwrite($fp,$value."\t");
			}
		} else {
			fwrite($fp,date("d/m/y : H:i:s", time())."->".$str."<br/>");
		}
		fclose($fp);}
?>