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
	
	// the file is created by Debiprasad on 9th August 2012

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /members/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$account = new Account(sess_getAccountIdFromSession());
	$has_profile = $account->getString("has_profile");
	$is_sponsor = $account->getString("is_sponsor");

	if ($is_sponsor == 'n') {
		if (!empty($_SESSION[SM_LOGGEDIN])) {
			header("Location: ".DEFAULT_URL."/members/account/account.php");
			exit;
		}
	}

	$contact = db_getFromDB("contact", "account_id", db_formatNumber($account->getNumber("id")), "1");

	if ($_GET["enable"] == "true") {
		$account->changeProfileStatus(true);
		header("Location: ".DEFAULT_URL."/members/index.php?success=1&type=1");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	/*
	 * Preparing to get all items of all domains of account
	 */
	unset($accountObj);
	$accountObj = new Account_Domain();
	$array_domains = $accountObj->getAll(sess_getAccountIdFromSession());
	
	unset($array_tables);
	$array_tables[] = "Listing";
	$array_tables[] = "Banner";
	$array_tables[] = "Event";
	$array_tables[] = "Classified";
	$array_tables[] = "Article";
	

	$array_account_items = array();
	$j = 0;
	for($i=0;$i<count($array_domains);$i++){

		unset($domainObj, $array_items);
		$domainObj = new Domain($array_domains[$i]);

		/*
		 * Get Items
		 */
		$array_items = $accountObj->getAllItemsByAccountID(sess_getAccountIdFromSession(),$array_domains[$i],$array_tables);
		if(is_array($array_items)){
			$array_account_items[$j]["domain_id"]    = $array_domains[$i];
			$array_account_items[$j]["domain_title"] = $domainObj->getString("name");
			$array_account_items[$j]["domain_url"]   = $domainObj->getString("url");
			$array_account_items[$j]["items"]		 = $array_items;
			$j++;
		}
	}

	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>
	<script language="javascript" type="text/javascript">

		function enableProfile() {
			var is_sponsor = '<?=$is_sponsor?>';
			var success = '<?=$_GET["success"]?>';
			var type = '<?=$_GET["type"]?>';
			if (success == 1 && type == 1) {
				showTabs('tab_2');
			} else if (is_sponsor == 1 || is_sponsor == 'y') {
				$('#tab_1').css('display', '');
				$('#member_options').css('display', '');
				showTabs('tab_1');
			} else {
				$('#tab_1').css('display', 'none');
				$('#member_options').css('display', 'none');
				showTabs('tab_2');
			}
		}

		function showTabs(type) {
			if (type == 'tab_1') {
				$('#tab_2').removeClass("tabActived");
				$('#tab_1').addClass("tabActived");
				$('#member_options').css('display', '');
				$('#member_profile').css('display', 'none');
			} else {
				$('#tab_1').removeClass("tabActived");
				$('#tab_2').addClass("tabActived");
				$('#member_profile').css('display', '');
				$('#member_options').css('display', 'none');
			}
		}
	</script>

	<div class="content">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
		
		<?php
			if (isset($_POST['sms_message'])) {
				require_once('lib/sms_api.php');

				$si = new SmsInterface (false, false);
				$si->addMessage ($_POST["sms_phone"], $_POST["sms_message"]);
			
				if (!$si->connect ($_POST["sms_username"], $_POST["sms_password"], true, false))
				    $error_message = "Failed. Could not contact server.";				
				else if (!$si->sendMessages ()) {
				    $error_message = "Failed. Could not send message to server.";
				    if ($si->getResponseMessage () !== NULL)
					$error_message .= " Reason: " . $si->getResponseMessage () . ".";
				} else
				    $success_message = 'Message sent to <strong>' . $_POST["sms_phone"] . '</strong>';
			}
		?>
		
		<h2>Send SMS</h2>
		<?php
			if ($success_message) {
				?><p class="successMessage"><?php echo $success_message; ?></p><?php
			}
			if ($error_message) {
				?><p class="errorMessage"><?php echo $error_message; ?></p><?php
			}
		?>
		<form method="post">
			<table class="standard-table">
				<tr>
					<td>Username:</td>
					<td><input type="text" name="sms_username" size="10"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="sms_password"></td>
				</tr>
				<tr>
					<td>Phone number:</td>
					<td><input type="text" name="sms_phone" size="13"></td>
				</tr>
				<tr>
					<td>Message:</td>
					<td><textarea name="sms_message" maxlength="160" rows="3" cols="50"></textarea></td>
				</tr>
			</table>
			<div class="baseButtons">
				<p class="standardButton">
					<button type="submit">Send</button>
				</p>
			</div>
		</form>
		<script type="text/javascript">
			enableProfile();
		</script>
	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>