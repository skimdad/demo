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
	$acctId = sess_getAccountIdFromSession();

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
	<?
	$sql = "SELECT title1 from ListingCategory where ID  = (SELECT MIN(category_root_id)category_root_id FROM `Listing` INNER Join `Listing_Category` ON `Listing_Category`.listing_id = Listing.id where account_id = ".$acctId.")";
	$dbObj = db_getDBObject();
	$result = $dbObj->query($sql);
	if (mysql_numrows($result)) {
		$row = mysql_fetch_array($result);
		$catlink = $row["title1"];
		//$backlinkurl = '<a class="logoLink" style="background-image: url(''http://www.dealcloudusa.com/images/uscb.png'')" title="dealcloudusa.com" herf="http://www.dealcloudusa.com/listing/guide/'.$row["title1"].'"></a>';
	} else {
		$catlink = "You have no listing";	
	}
	?>
	
		<h2>Get Certified Backlink for your page/website</h2>
		<form method="post">
			<table class="standard-table">
				<tr>
					<td>Backlink code:</td>
					<td><textarea name="backlinkcode" maxlength="160" rows="4" cols="50"><a href="http://www.dealcloudusa.com/listing/guide/<? echo str_replace(" ","-",$catlink); ?>"><img alt="dealcloudusa.com" border="0" width="210" height="200" src ="http://www.dealcloudusa.com/images/uscb.png"/></a></textarea></td>
				</tr>
				<tr> <td></td><td>Copy and paste above code to get USCCB logo on your website.</td></tr>
			</table>
		</form>
				<a href="http://www.dealcloudusa.com/listing/guide/<? echo str_replace(" ","-",$catlink); ?>"><img alt="dealcloudusa.com" border="0" width="210" height="200" src ="http://www.dealcloudusa.com/images/uscb.png"/></a>
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