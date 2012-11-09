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
	# * FILE: /members/sitemap.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$accObj = new Account($acctId);
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>

	<div class="content">
             
		<h2><?=system_showText(LANG_MENU_SITEMAP);?></h2>
			 
		<ul class="sitemapList">

			<li class="standardSubTitle">
				<a class="sitemapSection" href="<?=DEFAULT_URL?>/members"><?=system_showText(LANG_MENU_HOME);?></a>
			</li>			

			<li class="standardSubTitle">
				<a class="sitemapSection" href="<?=DEFAULT_URL?>/members/help.php"><?=system_showText(LANG_BUTTON_HELP);?></a>
			</li>

			<li class="standardSubTitle">
				<a class="sitemapSection" href="<?=NON_SECURE_URL?>/index.php"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH)?></a>
			</li>

			<li class="standardSubTitle">
				<a target="_blank" class="sitemapSection" href="<?=DEFAULT_URL?>/members/faq.php"><?=system_showText(LANG_MENU_FAQ);?></a>
			</li>

			<li class="standardSubTitle">
				<a class="sitemapSection" href="<?=DEFAULT_URL?>/members/logout.php"><?=system_showText(LANG_BUTTON_LOGOUT);?></a>
			</li>

			<li class="standardSubTitle">
				<div class="sitemagSection">
					<?=system_showText(LANG_LABEL_ACCOUNT);?>
				</div>
				<ul>
					<? if (SOCIALNETWORK_FEATURE == "on") { ?>
					<li><a href="<?=DEFAULT_URL?>/members/account/account.php?type=tab_1&id=<?=sess_getAccountIdFromSession();?>"><?=system_showText(LANG_LABEL_PERSONAL_PAGE);?></a></li>
					<? } ?>
					<li><a href="<?=DEFAULT_URL?>/members/account/account.php?type=tab_2&id=<?=sess_getAccountIdFromSession();?>"><?=system_showText(LANG_LABEL_ACCOUNT_SETTINGS);?></a></li>
					<li><a href="<?=DEFAULT_URL?>/members/account/reviews.php"><?=system_showText(LANG_REVIEW_PLURAL);?></a></li>
					<li><a href="<?=DEFAULT_URL?>/members/account/quicklists.php"><?=system_showText(LANG_LABEL_FAVORITES);?></a></li>
				</ul>
			</li>

			<? if ($accObj->getString('is_sponsor') == 'y') { ?>
				<li class="standardSubTitle">
					<div class="sitemagSection">
						<?=system_showText(LANG_MENU_LISTING);?>
					</div>
					<ul>
                        <li><a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/listinglevel.php"><?=system_showText(LANG_MENU_ADDLISTING);?></a></li>
                        <li><a href="<?=DEFAULT_URL?>/members/<?=LISTING_FEATURE_FOLDER;?>/"><?=system_showText(LANG_MENU_MANAGELISTING);?></a></li>
					</ul>
				</li>
				<?
				if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on")
					if ( $hasPromotion && system_enableDealForUser(sess_getAccountIdFromSession())) {
				?>
					<li class="standardSubTitle">
						<div class="sitemagSection">
							<?=system_showText(LANG_MENU_PROMOTION);?>
						</div>
						<ul>
						 <li><a href="<?=DEFAULT_URL?>/members/<?=PROMOTION_FEATURE_FOLDER;?>/deal.php"><?=system_showText(LANG_MENU_ADDPROMOTION);?></a></li>
						 <li><a href="<?=DEFAULT_URL?>/members/<?=PROMOTION_FEATURE_FOLDER;?>/"><?=system_showText(LANG_MENU_MANAGEPROMOTION);?></a></li>
						</ul>
					</li>
				<? } ?>

				<? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
					<li class="standardSubTitle">
						<div class="sitemagSection">
							<?=system_showText(LANG_MENU_BANNER);?>
						</div>
						<ul>
						 <li><a href="<?=DEFAULT_URL?>/members/<?=BANNER_FEATURE_FOLDER;?>/add.php"><?=system_showText(LANG_MENU_ADDBANNER);?></a></li>
						 <li><a href="<?=DEFAULT_URL?>/members/<?=BANNER_FEATURE_FOLDER;?>/"><?=system_showText(LANG_MENU_MANAGEBANNER);?></a></li>
						</ul>
					</li>
				<? } ?>

				<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
					<li class="standardSubTitle">
						<div class="sitemagSection">
							<?=string_ucwords(system_showText(LANG_EVENT_PLURAL));?>
						</div>
						<ul>
						 <li><a href="<?=DEFAULT_URL?>/members/<?=EVENT_FEATURE_FOLDER;?>/eventlevel.php"><?=system_showText(LANG_MENU_ADDEVENT);?></a></li>
						 <li><a href="<?=DEFAULT_URL?>/members/<?=EVENT_FEATURE_FOLDER;?>/"><?=system_showText(LANG_MENU_MANAGEEVENT);?></a></li>
						</ul>
					</li>
				<? } ?>

				<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
					<li class="standardSubTitle">
						<div class="sitemagSection">
							<?=system_showText(LANG_MENU_CLASSIFIED);?>
						</div>
						<ul>
						 <li><a href="<?=DEFAULT_URL?>/members/<?=CLASSIFIED_FEATURE_FOLDER;?>/classifiedlevel.php"><?=system_showText(LANG_MENU_ADDCLASSIFIED);?></a></li>
						 <li><a href="<?=DEFAULT_URL?>/members/<?=CLASSIFIED_FEATURE_FOLDER;?>/"><?=system_showText(LANG_MENU_MANAGECLASSIFIED);?></a></li>
						</ul>
					</li>
				<? } ?>


				<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
					<li class="standardSubTitle">
						<div class="sitemagSection">
							<?=system_showText(LANG_MENU_ARTICLE);?>
						</div>
						<ul>
						 <li><a href="<?=DEFAULT_URL?>/members/<?=ARTICLE_FEATURE_FOLDER;?>/article.php"><?=system_showText(LANG_MENU_ADDARTICLE);?></a></li>
						 <li><a href="<?=DEFAULT_URL?>/members/<?=ARTICLE_FEATURE_FOLDER;?>/"><?=system_showText(LANG_MENU_MANAGEARTICLE);?></a></li>
						</ul>
					</li>
				<? } ?>

				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on") || (MANUALPAYMENT_FEATURE == "on")) { ?>
						<li class="standardSubTitle">
							<div class="sitemagSection">
								<?=system_showText(LANG_MENU_CHECKOUT);?>
							</div>
							<ul>
							 <li><a href="<?=DEFAULT_URL?>/members/billing/index.php"><?=system_showText(LANG_MENU_MAKEPAYMENT);?></a></li>
							</ul>
						</li>
					<? } ?>
				<? } ?>

				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on") || (MANUALPAYMENT_FEATURE == "on")) { ?>
						<li class="standardSubTitle">
							<div class="sitemagSection">
								<?=system_showText(LANG_MENU_HISTORY);?>
							</div>
							<ul>
							<? if ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) { ?>
								<li><a href="<?=DEFAULT_URL?>/members/transactions/index.php"><?=system_showText(LANG_MENU_TRANSACTIONHISTORY);?></a></li>
							<? } ?>
							<? if (INVOICEPAYMENT_FEATURE == "on") { ?>
								<li><a href="<?=DEFAULT_URL?>/members/invoices/index.php"><?=system_showText(LANG_MENU_INVOICEHISTORY);?></a></li>
							<? } ?>
							</ul>
						</li>
					<? } ?>
				<? } ?>
			<? } ?>

		</ul>
				

	</div> 

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
