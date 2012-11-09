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
	# * FILE: /members/layout/navbar.php
	# ----------------------------------------------------------------------------------------------------
	$accountObj = new Account(sess_getAccountIdFromSession());
	$has_profile = $accountObj->getString("has_profile");
	$is_sponsor = $accountObj->getString("is_sponsor");
?>

	<script type="text/javascript">

		var interval = 450;
		var navBar_listing = false;
		var navBar_banner = false;
		var navBar_event = false;
		var navBar_classified = false;
		var navBar_article = false;
		var navBar_gallery = false;
		var navBar_promotion = false;
		var navBar_checkout = false;
		var navBar_history = false;
		var navBar_account = false;

		$(document).ready(function(){

			$("#navBar_bt_listing").click(function () {
				controlMenuNavBar ("listing");
			});
			$("#navBar_bt_banner").click(function () {
				controlMenuNavBar ("banner");
			});
			$("#navBar_bt_event").click(function () {
				controlMenuNavBar ("event");
			});
			$("#navBar_bt_classified").click(function () {
				controlMenuNavBar ("classified");
			});
			$("#navBar_bt_article").click(function () {
				controlMenuNavBar ("article");
			});
			$("#navBar_bt_gallery").click(function () {
				controlMenuNavBar ("gallery");
			});
			$("#navBar_bt_promotion").click(function () {
				controlMenuNavBar ("promotion");
			});
			$("#navBar_bt_checkout").click(function () {
				controlMenuNavBar ("checkout");
			});
			$("#navBar_bt_history").click(function () {
				controlMenuNavBar ("history");
			});	
			$("#navBar_bt_account").click(function () {
				controlMenuNavBar ("account");
			});
		});

		function controlMenuNavBar (feature) {
			if (!eval("navBar_"+feature))
				navBar_slideDown (feature);
			else
				navBar_slideUp (feature);
			eval("navBar_"+feature+"= !navBar_"+feature);
		}

		function navBar_slideDown (feature) {
			$("#navBar_bt_"+feature).addClass('navBarActive');
			$("#navBar_submenu_"+feature).slideDown(interval);
		}

		function navBar_slideUp (feature) {
			$("#navBar_bt_"+feature).removeClass('navBarActive');
			$("#navBar_submenu_"+feature).slideUp(interval);
		}

		function controlActiveMenu(feature) {
			eval("navBar_"+feature+"= true");
		}

	</script>

	<?
	$openListing	=	((string_strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_FOLDER)   && !string_strpos($_SERVER["PHP_SELF"], "content"))||(string_strpos($_SERVER["PHP_SELF"], "claim"))||(string_strpos($_SERVER["REQUEST_URI"], "item_type=listing")));
	$openBanner		=	string_strpos($_SERVER["PHP_SELF"], BANNER_FEATURE_FOLDER);
	$openEvent		=	(string_strpos($_SERVER["PHP_SELF"], EVENT_FEATURE_FOLDER)      && !string_strpos($_SERVER["PHP_SELF"], "content"));
	$openClassified =	(string_strpos($_SERVER["PHP_SELF"], CLASSIFIED_FEATURE_FOLDER) && !string_strpos($_SERVER["PHP_SELF"], "content"));
	$openArticle	=	(string_strpos($_SERVER["PHP_SELF"], ARTICLE_FEATURE_FOLDER)    && !string_strpos($_SERVER["PHP_SELF"], "content")||(string_strpos($_SERVER["REQUEST_URI"], "item_type=article")));
	$openPromotion	=	string_strpos($_SERVER["PHP_SELF"], "deal") && !string_strpos($_SERVER["PHP_SELF"], "listing");
	$openCheckout	=   string_strpos($_SERVER["PHP_SELF"], "members/billing");
	$openHistory	=	((string_strpos($_SERVER["PHP_SELF"], "members/transactions") !== false) || (string_strpos($_SERVER["PHP_SELF"], "members/invoices")));

		if ($openListing)     { ?> <script type="text/javascript"> controlActiveMenu('listing')    </script><? } ?>
	<?	if ($openBanner)      { ?> <script type="text/javascript"> controlActiveMenu('banner')     </script><? } ?>
	<?	if ($openEvent)       { ?> <script type="text/javascript"> controlActiveMenu('event')      </script><? } ?>
	<?	if ($openClassified)  { ?> <script type="text/javascript"> controlActiveMenu('classified') </script><? } ?>
	<?	if ($openArticle)     { ?> <script type="text/javascript"> controlActiveMenu('article')     </script><? } ?>
	<?	if ($openPromotion)   { ?> <script type="text/javascript"> controlActiveMenu('promotion')   </script><? } ?>
	<?	if ($openCheckout)    { ?> <script type="text/javascript"> controlActiveMenu('checkout')     </script><? } ?>
	<?	if ($openHistory)     { ?> <script type="text/javascript"> controlActiveMenu('history')   </script><? } ?>

	<?
	/*
	 * Get Sites
	 */
	$domainDropDown = domain_getDropDown(NON_LANG_URL, $_SERVER["REQUEST_URI"], $_SERVER["QUERY_STRING"], SELECTED_DOMAIN_ID);
	?>

	<div class="sidebar">
		<?
		if (!is_numeric($domainDropDown) && (!string_strpos($_SERVER["PHP_SELF"], "login.php")) && (!string_strpos($_SERVER["PHP_SELF"], "resetpassword.php"))){
			?>
			<h2>
				<?=system_showText(LANG_SELECT_DOMAIN);?>
			</h2>
			<?=$domainDropDown?>
		<?
		}
		?>
		<?if ($is_sponsor == 1 || $is_sponsor == 'y') {?>
		<h2><?=system_showText(LANG_MENU_MEMBEROPTIONS);?></h2>

		<div class="memberMenu">

			<h2 id="navBar_bt_listing"><a href="javascript:void(0)"><?=system_showText(LANG_MENU_LISTING);?></a></h2>
			<ul id="navBar_submenu_listing" <? if (!$openListing) {?> style="display:none" <?}?> >
				<li><a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/"><?=system_showText(LANG_MENU_MANAGE);?></a></li>
				<li><a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/listinglevel.php"><?=system_showText(LANG_MENU_ADD);?></a></li>
			</ul>
			<? 
			if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on")
			   	if ( $hasPromotion && system_enableDealForUser(sess_getAccountIdFromSession()) ) {
				?>
				<h2 id="navBar_bt_promotion"><a href="javascript:void(0)"><?=system_showText(LANG_MENU_PROMOTION);?></a></h2>
				<ul id="navBar_submenu_promotion" <? if (!$openPromotion) {?> style="display:none" <?}?> >
				<?/*?>	<li><a href="<?=DEFAULT_URL?>/members/<?=PROMOTION_FEATURE_FOLDER;?>/"><?=system_showText(LANG_MENU_MANAGE);?></a></li> <?*/?>
					<li><a href="<?=DEFAULT_URL?>/members/<?=PROMOTION_FEATURE_FOLDER;?>/index_deal_listing.php"><?=system_showText(LANG_MENU_MANAGE);?></a></li>
					<li><a href="<?=DEFAULT_URL?>/members/<?=PROMOTION_FEATURE_FOLDER;?>/deal.php"><?=system_showText(LANG_MENU_CREATE);?></a></li>
				</ul>
			<? } ?>

			<? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
				<h2 id="navBar_bt_banner"><a href="javascript:void(0)"><?=system_showText(LANG_MENU_BANNER);?></a></h2>
				<ul id="navBar_submenu_banner" <? if (!$openBanner) {?> style="display:none" <?}?> >
					<li><a href="<?=DEFAULT_URL?>/members/<?=BANNER_FEATURE_FOLDER;?>/"><?=system_showText(LANG_MENU_MANAGE);?></a></li>
					<li><a href="<?=DEFAULT_URL?>/members/<?=BANNER_FEATURE_FOLDER;?>/add.php"><?=system_showText(LANG_MENU_ADD);?></a></li>
				</ul>
			<? } ?>

			<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
				<h2 id="navBar_bt_event"><a href="javascript:void(0)"><?=system_showText(LANG_MENU_EVENT);?></a></h2>
				<ul id="navBar_submenu_event" <? if (!$openEvent) {?> style="display:none" <?}?> >
					<li><a href="<?=DEFAULT_URL?>/members/<?=EVENT_FEATURE_FOLDER;?>/"><?=system_showText(LANG_MENU_MANAGE);?></a></li>
					<li><a href="<?=DEFAULT_URL?>/members/<?=EVENT_FEATURE_FOLDER;?>/eventlevel.php"><?=system_showText(LANG_MENU_ADD);?></a></li>
				</ul>
			<? } ?>			

			<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
				<h2 id="navBar_bt_classified"><a href="javascript:void(0)"><?=system_showText(LANG_MENU_CLASSIFIED);?></a></h2>
				<ul id="navBar_submenu_classified" <? if (!$openClassified) {?> style="display:none" <?}?> >
					<li><a href="<?=DEFAULT_URL?>/members/<?=CLASSIFIED_FEATURE_FOLDER;?>/"><?=system_showText(LANG_MENU_MANAGE);?></a></li>
					<li><a href="<?=DEFAULT_URL?>/members/<?=CLASSIFIED_FEATURE_FOLDER;?>/classifiedlevel.php"><?=system_showText(LANG_MENU_ADD);?></a></li>
				</ul>
			<? } ?>

			<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
				<h2 id="navBar_bt_article"><a href="javascript:void(0)"><?=system_showText(LANG_MENU_ARTICLE);?></a></h2>
				<ul id="navBar_submenu_article" <? if (!$openArticle) {?> style="display:none" <?}?> >
					<li><a href="<?=DEFAULT_URL?>/members/<?=ARTICLE_FEATURE_FOLDER;?>/"><?=system_showText(LANG_MENU_MANAGE);?></a></li>
					<li><a href="<?=DEFAULT_URL?>/members/<?=ARTICLE_FEATURE_FOLDER;?>/article.php"><?=system_showText(LANG_MENU_ADD);?></a></li>
				</ul>
			<? } ?>
		</div>

		<? if (PAYMENT_FEATURE == "on") { ?>
			<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on") || (MANUALPAYMENT_FEATURE == "on")) { ?>
				<h2><?=system_showText(LANG_MENU_PAYMENTOPTIONS);?></h2>
				<div class="memberMenu">
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<h2 id="navBar_bt_checkout"><a href="javascript:void(0)"><?=system_showText(LANG_MENU_CHECKOUT);?></a></h2>
						<ul id="navBar_submenu_checkout" <? if (!$openCheckout) {?> style="display:none" <?}?> >
							<li><a href="<?=DEFAULT_URL?>/members/billing/index.php"><?=system_showText(LANG_MENU_MAKEPAYMENT);?></a></li>
						</ul>
					<? } ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on") || (MANUALPAYMENT_FEATURE == "on")) { ?>
						
						<h2 id="navBar_bt_history"><a href="javascript:void(0)"><?=system_showText(LANG_MENU_HISTORY);?></a></h2>						
						
						<ul id="navBar_submenu_history" <? if (!$openHistory) {?> style="display:none" <?}?> >
							<? if ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) { ?>
								<li><a href="<?=DEFAULT_URL?>/members/transactions/index.php"><?=system_showText(LANG_MENU_TRANSACTIONHISTORY);?></a></li>
							<? } ?>
							<? if (INVOICEPAYMENT_FEATURE == "on") { ?>
								<li><a href="<?=DEFAULT_URL?>/members/invoices/index.php"><?=system_showText(LANG_MENU_INVOICEHISTORY);?></a></li>
							<? } ?>
						</ul>
					<? } ?>
				</div>
			<? } ?>
		<? } ?>
		<?php // the following code is added by Debiprasad on 9th August 2012 ?>
		<h2>Other</h2>
		<div class="memberMenu">
			<h2><a href="<?=DEFAULT_URL?>/members/sendsms.php">Send SMS</a></h2>
		</div>
	<!--	<div class="memberMenu">
			<h2><a href="<?=DEFAULT_URL?>/members/backlink.php">Get Certified Logo</a></h2>
		</div>-->
		<? } else { ?>
				<div class="sidebar">
					<h2><?=system_showText(LANG_LABEL_MEMBER_OPTIONS);?></h2>
					<ul class="memberMenu">
						<li><a href="<?=NON_SECURE_URL?>/index.php"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH);?></a></li>
						<? if (SOCIALNETWORK_FEATURE == "off") { ?>
							<li><a href="<?=NON_SECURE_URL?>/advertise.php"><?=system_showText(LANG_LABEL_ADD_NEW_ACCOUNT);?></a></li>
						<? } ?>
					</ul>
				</div>
		<? } ?>

		<? $areaTwitter = "members"; ?>
	</div>