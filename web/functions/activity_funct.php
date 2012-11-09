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
	# * FILE: /functions/activity_funct.php
	# ----------------------------------------------------------------------------------------------------


    /**
	 * Save new active record
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.	
     * @param integer $domain_id
     * @param integer $account_id
     * @param real $payment_amount
     * @param string $action
     * @param string $item_type
     * @param string $item_title
     */
    function activity_newActivity($domain_id = 0, $account_id = 0, $payment_amount = 0, $action = "", $item_type = "", $item_title = "") {

        $db = db_getDBObject(DEFAULT_DB, true);
		$item_title = str_replace("'","",$item_title);
        $sql = "INSERT INTO Recent_Activity (domain_id, account_id, payment_amount, action, item_type, item_title, date) VALUES ($domain_id, $account_id, $payment_amount, '$action', '$item_type', '$item_title', NOW())";
		$db->query($sql);
       
    }

	/**
	 * Retrieve newest activities
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
     * @param array $activities
     * @return string $text

     */
	function activity_retrieveText($activities){

		$text = "<ul>";

		foreach($activities as $active){
			switch ($active["action"]){

				case 'login':		$domain = new Domain($active["domain_id"]);
									$domain_status = $domain->getString("status");
									if ($domain_status == "A"){
										$contact = new Contact($active["account_id"]);
										if ($contact->getNumber("account_id")!=0){
											$link = "<a href=\"".DEFAULT_URL."/sitemgr/account/view.php?id=".$active["account_id"]."\" title=\"".$contact->getString("first_name")." ".$contact->getString("last_name")."\">".$contact->getString("first_name")." ".$contact->getString("last_name")."</a>";
											$text .= "<li><p>";
											$text .= $domain->getString("name")."</b>"." - ".$link." ".LANG_SITEMGR_LOGGED_IN;
											$text .= "</p></li>";
										}
									}
									break;

				case 'payment':		$domain = new Domain($active["domain_id"]);
									$domain_status = $domain->getString("status");
									if ($domain_status == "A"){
										$contact = new Contact($active["account_id"]);
										if ($contact->getNumber("account_id")!=0){
											$link = "<a href=\"".DEFAULT_URL."/sitemgr/account/view.php?id=".$active["account_id"]."\" title=\"".$contact->getString("first_name")." ".$contact->getString("last_name")."\">".$contact->getString("first_name")." ".$contact->getString("last_name")."</a>";
											$text .= "<li><p>";
											$text .= $domain->getString("name")."</b>"." - ".CURRENCY_SYMBOL.$active["payment_amount"]." ".LANG_SITEMGR_PAID_BY." ".$link;
											$text .= "</p></li>";
										}
									}
									break;

				case 'newaccount':	$domain = new Domain($active["domain_id"]);
									$domain_status = $domain->getString("status");
									if ($domain_status == "A"){
										$contact = new Contact($active["account_id"]);
										if ($contact->getNumber("account_id")!=0){
											$link = "<a href=\"".DEFAULT_URL."/sitemgr/account/view.php?id=".$active["account_id"]."\" title=\"".$contact->getString("first_name")." ".$contact->getString("last_name")."\">".$contact->getString("first_name")." ".$contact->getString("last_name")."</a>";
											$text .= "<li><p>";
											$text .= $domain->getString("name")."</b>"." - ".$link." ".LANG_SITEMGR_CREATED_ACCOUNT;
											$text .= "</p></li>";
										}
									}
									break;
								
				case 'newitem':		$domain = new Domain($active["domain_id"]);
									$domain_status = $domain->getString("status");
									if ($domain_status == "A"){
										$contact = new Contact($active["account_id"]);
										if ($contact->getNumber("account_id")!=0){
											$link = "<a href=\"".DEFAULT_URL."/sitemgr/account/view.php?id=".$active["account_id"]."\" title=\"".$contact->getString("first_name")." ".$contact->getString("last_name")."\">".$contact->getString("first_name")." ".$contact->getString("last_name")."</a>";
											$item_type = $active["item_type"];
											$itemtype = "";
											switch ($item_type){

												case "listing":		$itemtype = LANG_SITEMGR_LISTING;
																	break;
												case 'event':		$itemtype = LANG_SITEMGR_EVENT;
																	break;
												case 'classified':	$itemtype = LANG_SITEMGR_CLASSIFIED;
																	break;
												case 'article':		$itemtype = LANG_SITEMGR_ARTICLE;
																	break;
												case 'banner':		$itemtype = LANG_SITEMGR_BANNER;
																	break;
											}

											$item_title = $active["item_title"];
											$text .= "<li><p>";
											$text .= $domain->getString("name")."</strong>"." - ".$link." ".LANG_SITEMGR_CREATED." ".$itemtype." \"".$item_title."\"";
											$text .= "</p></li>";
										}
									}
									break;

			}
		}
		$text .= "</ul>";
		return $text;
	}

	/**
	 * Retrieve newest activities
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
     * @param integer $max
     * @return string $activities_text

     */
	function activity_retrieveActivities($max = 10){

		$activities = array();
		$db = db_getDBObject(DEFAULT_DB, true);
		$sql = "SELECT id, domain_id, account_id, payment_amount, action, item_type, item_title FROM Recent_Activity ORDER BY id DESC LIMIT $max";
		$result = $db->query($sql);
		$i = 0;
		while ($row = mysql_fetch_assoc($result)){
			$activities[$i]["domain_id"] = $row["domain_id"];
			$activities[$i]["account_id"] = $row["account_id"];
			$activities[$i]["payment_amount"] = $row["payment_amount"];
			$activities[$i]["action"] = $row["action"];
			$activities[$i]["item_type"] = $row["item_type"];
			$activities[$i]["item_title"] = htmlspecialchars($row["item_title"]);
			$i++;
		}

		$activities_text = activity_retrieveText($activities);

		return $activities_text;
	}

     /**
	 * Save new to approved record
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
     * @param integer $domain_id
     * @param integer $item_id
     * @param string $item_type
     * @param string $item_title
     * @param string $review_title
     */
    function activity_newToApproved($domain_id = 0, $item_id = 0, $item_type = "", $item_title = "", $content = "", $assoc_item = 0, $rate = 0, $reply_id = 0) {

        $db = db_getDBObject(DEFAULT_DB, true);
		$item_title = str_replace("'","",$item_title);
		$content = str_replace("'","",$content);
        $sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title, content, assoc_item, rate, reply_id) VALUES ($domain_id, $item_id, '$item_type', '$item_title', '$content', $assoc_item, $rate, $reply_id)";

		$db->query($sql);

    }

	/**
	 * Delete approved records
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
     * @param integer $domain_id
     * @param integer $item_id
     * @param string $item_type
     */
	function activity_deleteRecord($domain_id = 0, $item_id = 0, $item_type = ""){
		$db = db_getDBObject(DEFAULT_DB, true);
		$sql = "DELETE FROM To_Approved WHERE domain_id = $domain_id AND item_id = $item_id AND item_type = '$item_type'";
		$db->query($sql);
	}

	/**
	 * Update to approved records
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
     * @param integer $domain_id
     * @param integer $item_id
     * @param string $newtitle
     * @param string $item
     * @param string $item_type
     */
	function activity_updateRecord($domain_id = 0, $item_id = 0, $newtitle = "", $item = "", $item_type = "", $rate = 0){
		$db = db_getDBObject(DEFAULT_DB, true);
		if ($item == "item") $item .="_title";
		$sql = "UPDATE To_Approved SET ".$item." = $newtitle, `rate` = $rate WHERE domain_id = $domain_id AND item_id = $item_id AND item_type = '$item_type'";
		$db->query($sql);
	}


	/**
	 * Retrieve to be approved items
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
     * @param array $toapproved
     * @return string $text

     */
	function activity_retrieveTextToApproved($toapproved){

		$text = "<ul>";
		$i = 0;
		foreach($toapproved as $approve){

			$domain = new Domain($approve["domain_id"]);
			$domain_status = $domain->getString("status");

			if ($approve["item_type"] == "review_listing" || $approve["item_type"] == "review_promotion"){
				$permission = "SITEMGR_PERMISSION_LISTINGS";
			} else if($approve["item_type"] == "review_article"){
				$permission = "SITEMGR_PERMISSION_ARTICLES";
			} else if($approve["item_type"] == "blog_comment"){
				$permission = "SITEMGR_PERMISSION_BLOG";
			} else {
				$permission = "SITEMGR_PERMISSION_".string_strtoupper($approve["item_type"]."s");
			}

			if (($domain_status == "A") && (permission_hasSMPermSection(constant($permission))) ){
				($i % 2 == 0) ? $color = "#EDEDED" : $color = "#F7F7F7";
				$item_id = $approve["item_id"];

				if (string_strpos($approve["item_type"], "review") !== false){ //link to view item is different for reviews
					$review_id = $item_id;
					$item_id = $approve["assoc_item"];

					$linkViewURI = "/sitemgr/".$approve["item_folder"]."/view.php?id=".$item_id;
					$linkViewQSTRING = "id=".$item_id;
					$linkViewItem = "<a class=\"left\" href=\"javascript: void(0);\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkViewURI."','".$linkViewQSTRING."','false', 'true')\" title=\"".$approve["item_title"]."\">".system_showTruncatedText($approve["item_title"], 45)."</a>";

				} else if (string_strpos($approve["item_type"], "blog") !== false) {
					$comment_id = $item_id;
					$item_id = $approve["assoc_item"];

					$linkViewURI = "/".BLOG_FEATURE_FOLDER."/sitemgr/".BLOG_FEATURE_FOLDER."/view.php?id=".$item_id;
					$linkViewQSTRING = "id=".$item_id;
					$linkViewItem = "<a class=\"left\" href=\"javascript: void(0);\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkViewURI."','".$linkViewQSTRING."','false', 'true')\" title=\"".$approve["item_title"]."\">".system_showTruncatedText($approve["item_title"], 45)."</a>";
				} else{
					$linkViewURI = "/sitemgr/".$approve["item_folder"]."/view.php?id=".$item_id;
					$linkViewQSTRING = "id=".$item_id;
					$linkViewItem = "<a class=\"left\" href=\"javascript: void(0);\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkViewURI."','".$linkViewQSTRING."','false', 'true')\" title=\"".$approve["item_title"]."\">".system_showTruncatedText($approve["item_title"], 45)."</a>";
				}

				$text .= "<li style=\"background: $color;\">";
				//$text .= "<b>".$domain->getString("name")."</b>"." - ".$linkViewItem;
				$text .= "<div>";
				$text .= $linkViewItem;
				$rate_stars = "";
				if ($approve["content"] && string_strpos($approve["item_type"], "review") !== false){ //for reviews
					$rate_avg = htmlspecialchars($approve["rate"]);
					$rate_avg = (isset($rate_avg) && $rate_avg != 0) ? round($rate_avg, 2) : system_showText(LANG_NA);

					$rate_stars .= "<span class=\"ratingStar right\">";
					for ($x=0 ; $x < 5 ;$x++) {
						if (round($rate_avg) > $x) $rate_stars .= "<img src='".DEFAULT_URL."/images/img_rateMiniStarOn.png' alt='Star On' />";
						else $rate_stars .= "<img src='".DEFAULT_URL."/images/img_rateMiniStarOff.png' alt='Star Off' />";
					}
					$rate_stars .= "</span>";
					$approve["content"] = str_replace("<br />", "", $approve["content"]);
					$linkViewReviewURI = "/sitemgr/review/view.php?item_id=".$item_id."&item_type=".str_replace("review_","",$approve["item_type"])."&id=".$review_id;
					$linkViewReviewQSTRING = "item_id=".$item_id."&item_type=".str_replace("review_","",$approve["item_type"])."&id=".$review_id;
					$linkViewReview = "<span class=\"left\"><a href=\"javascript: void(0);\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkViewReviewURI."','".$linkViewReviewQSTRING."','false', 'true')\" title=\"".$approve["content"]."\">".system_showTruncatedText($approve["content"], 38)."</a></span>";

					$linkApproveURI = "/sitemgr/review/index.php?item_type=".str_replace("review_","",$approve["item_type"])."&id=".$review_id."&openapprove=yes";
					$linkApproveQSTRING = "item_type=".str_replace("review_","",$approve["item_type"])."&openapprove=yes";
					$linkApproveItem = "<span class=\"right\"><a href=\"javascript: void(0);\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkApproveURI."','".$linkApproveQSTRING."','false', 'true')\" title=\"".LANG_SITEMGR_APPROVE."\">".LANG_SITEMGR_APPROVE."</a>";

					$linkEditURI = "/sitemgr/review/index.php?item_type=".str_replace("review_","",$approve["item_type"])."&id=".$review_id."&openedit=yes";
					$linkEditQSTRING = "item_type=".str_replace("review_","",$approve["item_type"])."&openedit=yes";
					$linkEditItem = "<a href=\"javascript: void(0);\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkEditURI."','".$linkEditQSTRING."','false', 'true')\" title=\"".LANG_SITEMGR_EDIT."\">".LANG_SITEMGR_EDIT."</a></span>";

					$text .= $rate_stars."</div><div>".$linkViewReview.$linkApproveItem." / ".$linkEditItem."</div>";
				} else if ($approve["content"] && string_strpos($approve["item_type"], "blog") !== false){ //for comments

					$approve["content"] = str_replace("<br />", "", $approve["content"]);
					$linkViewReviewURI = "/".BLOG_FEATURE_FOLDER."/sitemgr/".BLOG_FEATURE_FOLDER."/comments/view.php?post_id=".$item_id."&id=".$comment_id;
					$linkViewReviewQSTRING = "post_id=".$item_id."&id=".$comment_id;
					$linkViewReview = "<span class=\"left\"><a href=\"javascript: void(0);\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkViewReviewURI."','".$linkViewReviewQSTRING."','false', 'true')\" title=\"".$approve["content"]."\">".system_showTruncatedText($approve["content"], 38)."</a></span>";
					if ($approve["reply_id"]){
						$str_reply = "reply_id=".$approve["reply_id"]."&";
					} else{
						$str_reply = "";
					}
					$linkApproveURI = "/".BLOG_FEATURE_FOLDER."/sitemgr/".BLOG_FEATURE_FOLDER."/comments/index.php?".$str_reply."id=".$comment_id."&openapprove=yes";
					$linkApproveQSTRING = "openapprove=yes";
					$linkApproveItem = "<span class=\"right\"><a href=\"javascript: void(0);\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkApproveURI."','".$linkApproveQSTRING."','false', 'true')\" title=\"".LANG_SITEMGR_APPROVE."\">".LANG_SITEMGR_APPROVE."</a></span>";

					$text .= "</div><div>".$linkViewReview.$linkApproveItem."</div>";
				} else { //for other items
					$linkApproveURI = "/sitemgr/".$approve["item_folder"]."/settings.php?id=".$item_id;
					$linkApproveQSTRING = "id=".$item_id;
					$linkApproveItem = "<span class=\"right\"><a href=\"javascript: void(0);\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkApproveURI."','".$linkApproveQSTRING."','false', 'true')\" title=\"".LANG_SITEMGR_APPROVE."\">".LANG_SITEMGR_APPROVE."</a>";

					if ($approve["item_type"] == "banner"){
						$action = "edit.php";
					} else {
						$action = $approve["item_type"].".php";
					}

					$linkEditURI = "/sitemgr/".$approve["item_folder"]."/".$action."?id=".$item_id;
					$linkEditQSTRING = "id=".$item_id;
					$linkEditItem = "<a href=\"javascript: void(0);\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkEditURI."','".$linkEditQSTRING."','false', 'true')\" title=\"".LANG_SITEMGR_EDIT."\">".LANG_SITEMGR_EDIT."</a></span>";

					$text .= $linkApproveItem." / ".$linkEditItem."</div>";
				}
				$text .= "</li>";
				$i++;
			}
		}
		$text .= "</ul>";
		return $text;
	}


	/**
	 * Retrieve to be approved
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
     * @param integer $max
     * @return string $approved_text

     */
	function activity_retrieveToApproved($max = 5){

		$toapproved = array();
		$db = db_getDBObject(DEFAULT_DB, true);
		$sql = "SELECT id, domain_id, item_id, item_type, item_title, content, assoc_item, rate, reply_id FROM To_Approved ORDER BY id DESC LIMIT $max";
		$result = $db->query($sql);
		$i = 0;
		while ($row = mysql_fetch_assoc($result)){
			$toapproved[$i]["domain_id"] = $row["domain_id"];
			$toapproved[$i]["item_id"] = $row["item_id"];
			$toapproved[$i]["item_type"] = $row["item_type"];
			$item_folder = string_strtoupper($row["item_type"]);
			if (string_strpos($row["item_type"], "review_") !== false) {
				$item_folder = string_strtoupper(str_replace("review_", "", $row["item_type"]));
			} else if (string_strpos($row["item_type"], "_comment") !== false) {
				$item_folder = string_strtoupper(str_replace("_comment", "", $row["item_type"]));
			}
			$toapproved[$i]["item_folder"] = constant($item_folder."_FEATURE_FOLDER");;
			$toapproved[$i]["item_title"] = htmlspecialchars($row["item_title"]);
			$toapproved[$i]["content"] = $row["content"];
			$toapproved[$i]["assoc_item"] = $row["assoc_item"];
			$toapproved[$i]["rate"] = $row["rate"];
			$toapproved[$i]["reply_id"] = $row["reply_id"];
			$i++;
		}

		$toapproved_text = activity_retrieveTextToApproved($toapproved);

		return $toapproved_text;
	}

?>