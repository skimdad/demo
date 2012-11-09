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
	# * FILE: /blog/includes/views/view_comment_detail.php
	# ----------------------------------------------------------------------------------------------------

	$item_reviewcomment = "";

	$itemObj = new Post($commentArr[$i]["post_id"]);
	$itemId = $commentArr[$i]["id"];
	$account = db_getFromDB("account", "id", db_formatNumber($commentArr[$i]["member_id"]), "1");
	if (SOCIALNETWORK_FEATURE == "on") {
		$profileObj = new Profile($commentArr[$i]["member_id"]);
	}else{
		$contact = db_getFromDB("contact", "account_id", db_formatNumber($commentArr[$i]["member_id"]), "1");
	}
	$item_reviewcomment .= "<div class=\"comment ".$className."\" id=\"cmm_$itemId\">";

	if (SOCIALNETWORK_FEATURE == "on") {
		 if ($commentArr[$i]["member_id"] && $account->getString("has_profile") == "y") {
			$item_reviewcomment .= "<div class=\"image\">";
			$item_reviewcomment .= socialnetwork_writeLink($commentArr[$i]["member_id"], "profile", "general_see_profile", $profileObj->getNumber("image_id"),false,false,false,$user);
			$item_reviewcomment .= "</div>";
		 } else {
			$item_reviewcomment .= "<span class=\"image no-image\"></span>";
		 }
		 if ($commentArr[$i]["member_id"]){
			$userName = socialnetwork_writeLink($commentArr[$i]["member_id"], "profile", "general_see_profile",false,false,false,false,$user);
		 } else {
			 $userName = $commentArr[$i]["member_name"];
		 }
	}else {
		$userName = $contact->first_name." ".$contact->last_name;
	}

	$commentObjDetail = new Comments($commentArr[$i]["id"]);
	$item_reviewcomment .= "<p>";
	$item_reviewcomment .= $userName;
	$item_reviewcomment .= " - ".format_date($commentArr[$i]["added"], DEFAULT_DATE_FORMAT, "datetime")." - ".$commentObjDetail->getTimeString();
	if (sess_getAccountIdFromSession()) {
		$item_reviewcomment .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a class=\"reply-comment\" href=\"javascript:void(0);\" id=\"liRId_$itemId\" onclick=\"showhideFormReply('".$itemId."', true,'".LANG_MSG_REPLYTHISCOMMENT."');\">".system_showText(LANG_MSG_REPLYTHISCOMMENT)."</a>";
	}
	$item_reviewcomment .= "</p>";
	$item_reviewcomment .= "<p>".((nl2br($commentArr[$i]["description"])) ? ($commentArr[$i]["description"]) : system_showText(LANG_NA))."</p>";
	
	unset($commentObjDetail);
	$sql = "SELECT * FROM Comments WHERE reply_id = $itemId  AND approved = 1";
	$result = $dbObj->query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		if (SOCIALNETWORK_FEATURE == "on") {
			$profileObj = new Profile($row["member_id"]);
		}else{
			$contact = db_getFromDB("contact", "account_id", db_formatNumber($row["member_id"]), "1");
		}
		
		$item_reviewcomment .= "<div class=\"reply\">";

		if (SOCIALNETWORK_FEATURE == "on") {
			if ($commentArr[$i]["member_id"] && $account->getString("has_profile") == "y") {
				$item_reviewcomment .= "<div class=\"image\">";
				$item_reviewcomment .= socialnetwork_writeLink($row["member_id"], "profile", "general_see_profile", $profileObj->getNumber("image_id"),false,false,false,$user);
				$item_reviewcomment .= "</div>";
			 } else {
				$item_reviewcomment .= "<span class=\"image no-image\"></span>";
			 }
			if ($row["member_id"]){
				$userName = socialnetwork_writeLink($row["member_id"], "profile", "general_see_profile",false,false,false,false,$user);
			} else {
				$userName = $row["member_name"];
			}
		}else {
			$userName .= $contact->first_name." ".$contact->last_name." ";
		}
		$replyObjDetail = new Comments($row["id"]);
		$item_reviewcomment .= "<p>";
		$item_reviewcomment .= $userName;
		$item_reviewcomment .= " - ".format_date($row["added"], DEFAULT_DATE_FORMAT, "datetime")." - ".$replyObjDetail->getTimeString();
		$item_reviewcomment .= "</p>";
		$item_reviewcomment .= "<p>".((nl2br($row["description"])) ? nl2br($row["description"]) : system_showText(LANG_NA))."</p>";

		
		$item_reviewcomment .= "</div>";
	}
	//$item_reviewcomment .= "<div id=\"reply_$itemId\">";
	
	$item_reviewcomment .= "</div>";
	

?>