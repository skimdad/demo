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

		<?
		if ($is_sponsor == "y") {
			?>
			<h2><?=LANG_SITE_ITEMS?></h2>
			<?
		} else if ($has_profile == "y") {
			?>
			<h2><?=system_showText(LANG_MSG_WELCOME2);?></h2>
			<?
		}

		$contentObj = new Content("", EDIR_LANGUAGE);
		$content = $contentObj->retrieveContentByType("Sponsor Home");
		if ($content) {
			echo "<blockquote>";
				echo "<div class=\"dynamicContent\">".$content."</div>";
			echo "</blockquote>";
		}
		
		if ($_GET["success"] == 1) { ?>
			<p class="successMessage">
				<?=system_showText(LANG_MSG_PROFILE_ENABLED);?>
			</p>
			<?
		}
		
		/*
		 * Show all items by account
		 */
		if (count($array_account_items) > 0){
			for($i=0;$i<count($array_account_items);$i++){
				?>

				<div class="domainItems">
					<h2 class="domainItemsTitle">
						<?=$array_account_items[$i]["domain_title"];?>
					</h2>

						<?

						for($j=0;$j<count($array_account_items[$i]["items"]);$j++){

							/*
							 * Prepare module name
							 */
							unset($aux_module_name);
							if($array_account_items[$i]["items"][$j]["table"] == "Listing"){
								$aux_module_name = string_ucwords(LANG_LISTING_FEATURE_NAME);
							}elseif($array_account_items[$i]["items"][$j]["table"] == "Event"){
								$aux_module_name = string_ucwords(LANG_EVENT_FEATURE_NAME);
							}elseif($array_account_items[$i]["items"][$j]["table"] == "Classified"){
								$aux_module_name = string_ucwords(LANG_CLASSIFIED_FEATURE_NAME);
							}elseif($array_account_items[$i]["items"][$j]["table"] == "Article"){
								$aux_module_name = string_ucwords(LANG_ARTICLE_FEATURE_NAME);
							}elseif($array_account_items[$i]["items"][$j]["table"] == "Banner"){
								$aux_module_name = string_ucwords(LANG_BANNER_FEATURE_NAME);
							}


							for($k=0;$k<count($array_account_items[$i]["items"][$j]["items"]);$k++){
								unset($item_link);
								$item_link = "/".string_strtolower($array_account_items[$i]["items"][$j]["table"])."/".string_strtolower(($array_account_items[$i]["items"][$j]["table"] == "Banner" ? "edit" : $array_account_items[$i]["items"][$j]["table"])).".php?id=".$array_account_items[$i]["items"][$j]["items"][$k]["id"];
								?>
								<div class="domainItemsList">
									<div class="itemName">

										<a href="javascript:void(0)" onclick="changeDomainInfo(<?=$array_account_items[$i]["domain_id"];?>,'<?=DEFAULT_URL?>/members','<?=$item_link?>','?id=<?=$array_account_items[$i]["items"][$j]["items"][$k]["id"]?>',true)">
											<?
											if($array_account_items[$i]["items"][$j]["table"] == "Banner"){
												echo $array_account_items[$i]["items"][$j]["items"][$k]["caption"];
											}else{
												echo $array_account_items[$i]["items"][$j]["items"][$k]["title"];
											}
											?>
										</a>
									</div>
									<div class="moduleName"><?=($array_account_items[$i]["items"][$j]["items"][$k]["level_name"] != "article" ? $aux_module_name." ".string_ucwords($array_account_items[$i]["items"][$j]["items"][$k]["level_name"]) : $aux_module_name)?></div>
									<div class="statusName"><?=$array_account_items[$i]["items"][$j]["items"][$k]["status"]?></div>
									<div class="itemCheckOut">
										<?
										if($array_account_items[$i]["items"][$j]["items"][$k]["NeedToCheckout"]){
											unset($link_to_pay);
											$link_to_pay = "/billing/index.php";
											?>
											<a href="javascript:void(0)" onclick="changeDomainInfo(<?=$array_account_items[$i]["domain_id"];?>,'<?=DEFAULT_URL?>/members','<?=$link_to_pay?>','',true)">
												<?=system_showText(LANG_MENU_MAKEPAYMENT)?>
											</a>
											<?
										}
										?>
									</div>
								</div>

								<?
							}
						}
						?>
				</div>
				<?
			}
		} else {
			echo "<p class=\"informationMessage\">".system_showText(LANG_MSG_NO_ITEMS_FOUND)."</p>";
		}
		
		$contentObj = new Content("", EDIR_LANGUAGE);
		$content = $contentObj->retrieveContentByType("Sponsor Home Bottom");
		if ($content) {
			echo "<blockquote>";
				echo "<div class=\"dynamicContent\">".$content."</div>";
			echo "</blockquote>";
		}
		?>
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