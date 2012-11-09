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
	# * FILE: /sitemgr/transactions/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<script type="text/javascript">
	$(document).ready(function(){
		$('#feedback2').colorbox({
			title: '<?=system_showText(LANG_SITEMGR_FEEDBACK)?>',
			iframe:true,
			innerWidth:350,
			innerHeight:400});
	});
</script>

<div id="main-right">
	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_LABEL_SITEMAP);?></h1>
		</div>
	</div>

	<div id="content-content">
    <ul class="sitemapList">

		<li class="standardSubTitle">
			<a class="sitemapSection" href="<?=DEFAULT_URL?>/"><?=system_showText(LANG_SITEMGR_VIEW_SITE);?></a>
		</li>

		<li class="standardSubTitle">
			<a class="sitemapSection" href="<?=DEFAULT_URL?>/sitemgr/manageaccount.php"><?=system_showText(LANG_SITEMGR_MENU_MYACCOUNT);?></a>
		</li>

		<li class="standardSubTitle">
			<a class="sitemapSection" href="<?=DEFAULT_URL?>/sitemgr/logout.php"><?=system_showText(LANG_SITEMGR_MENU_LOGOUT)?></a>
		</li>

		<li class="standardSubTitle">
			<a class="sitemapSection" href="<?=DEFAULT_URL?>/sitemgr"><?=system_showText(LANG_SITEMGR_DASHBOARD);?></a>
		</li>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ACCOUNTS)) { ?>
			<li class="standardSubTitle">
				<div class="sitemapSection">
					<?=system_showText(string_ucwords(LANG_SITEMGR_ACCOUNT_PLURAL));?>
				</div>
				<p class="subt"><?=(SOCIALNETWORK_FEATURE == "on" ? string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_MEMBERACCOUNTS)) : string_ucwords(system_showText(LANG_SITEMGR_SPONSORACCOUNTS)))?> </p>
				<ul>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/account/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/account/account.php"><?=system_showText(LANG_SITEMGR_ADD);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/account/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?> </a></li>
				</ul>
				<p class="subt"><?=system_showText(LANG_SITEMGR_NAVBAR_SITEMGRACCOUNTS);?> </p>
				<ul>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/smaccount/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/smaccount/smaccount.php"><?=system_showText(LANG_SITEMGR_ADD);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/smaccount/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/manageaccount.php"><?=system_showText(LANG_SITEMGR_MENU_MYACCOUNT);?></a></li>
				</ul>
			</li>
		<? } ?>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_DOMAIN)) { ?>
		<li class="standardSubTitle">
			<div class="sitemapSection">
				<?=system_showText(string_ucwords(LANG_SITEMGR_NAVBAR_DOMAIN_PLURAL));?>
			</div>
			<ul>
				<li><a href="<?=DEFAULT_URL?>/sitemgr/domain/index.php"><?=system_showText(string_ucwords(LANG_SITEMGR_MANAGE));?> </a></li>
				<li><a href="<?=DEFAULT_URL?>/sitemgr/domain/domain.php"><?=system_showText(LANG_SITEMGR_ADD);?> </a></li>
			</ul>
		</li>
		<? } ?>

		<li class="standardSubTitle">
			<div class="sitemapSection">
				<?=system_showText(LANG_SITEMGR_SUPPORT);?>
			</div>

			<ul>
				<li><a href="http://www.iConnectedMarketing.com/manual/v7/" target="_blank"><?=system_showText(LANG_SITEMGR_EDIRECTORYMANUAL)?></a></li>
				<li><a id="feedback2" href="<?=DEFAULT_URL?>/sitemgr/feedback.php"><?=system_showText(LANG_SITEMGR_FEEDBACK)?></a></li>
				<li><a href="<?=DEFAULT_URL?>/sitemgr/faq/faq.php?keyword=" target="_blank"><?=system_showText(LANG_SITEMGR_MENU_FAQ)?></a></li>
				<li><a href="<?=DEFAULT_URL?>/sitemgr/sitemap.php"><?=system_showText(LANG_SITEMGR_LABEL_SITEMAP)?></a></li>
				<li><a href="<?=DEFAULT_URL?>/sitemgr/about.php" class="iframe fancy_window_about"><?=system_showText(LANG_SITEMGR_MENU_ABOUT)?></a></li>
			</ul>
		</li>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
			<li class="standardSubTitle">
				<div class="sitemapSection">
					<?=system_showText(LANG_SITEMGR_NAVBAR_LISTING);?>
				</div>
				<ul>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/listinglevel.php"><?=system_showText(LANG_SITEMGR_ADD);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/listingcategs/index.php"><?=system_showText(string_ucwords(LANG_SITEMGR_CATEGORIES));?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=listing"><?=system_showText(string_ucwords(LANG_SITEMGR_REVIEWS));?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/claim"><?=system_showText(string_ucwords(LANG_SITEMGR_CLAIMED));?> </a></li>
                    <? if (LISTINGTEMPLATE_FEATURE == "on" && !USING_THEME_TEMPLATE) { ?>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/listingtemplate/index.php"><?=system_showText(LANG_SITEMGR_MENU_TEMPLATES);?> </a></li>
                    <? } ?>
				</ul>
			</li>
		<? } ?>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BANNERS)) { ?>
			<? if (BANNER_FEATURE == "on") { ?>
				<li class="standardSubTitle">
					<div class="sitemapSection">
						<?=system_showText(string_ucwords(LANG_SITEMGR_BANNER_PLURAL));?>
					</div>
					<ul>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=BANNER_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?> </a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=BANNER_FEATURE_FOLDER;?>/add.php"><?=system_showText(LANG_SITEMGR_ADD);?> </a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=BANNER_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?> </a></li>
					</ul>
				</li>
			<? } ?>
		<? } ?>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_EVENTS)) { ?>
			<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
				<li class="standardSubTitle">
					<div class="sitemapSection">
						<?=system_showText(string_ucwords(LANG_SITEMGR_EVENT_PLURAL));?>
					</div>
					<ul>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?> </a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>>/eventlevel.php"><?=system_showText(LANG_SITEMGR_ADD);?> </a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?> </a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/eventcategs/index.php"><?=system_showText(string_ucwords(LANG_SITEMGR_CATEGORIES));?> </a></li>
					</ul>
				</li>
			<? } ?>
		<? } ?>


		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS)) { ?>
			<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
				<li class="standardSubTitle">
					<div class="sitemapSection">
						<?=system_showText(string_ucwords(LANG_SITEMGR_CLASSIFIED_PLURAL));?>
					</div>
					<ul>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?> </a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/classifiedlevel.php"><?=system_showText(LANG_SITEMGR_ADD);?> </a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?> </a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/classifiedcategs/index.php"><?=system_showText(string_ucwords(LANG_SITEMGR_CATEGORIES));?> </a></li>
					</ul>
				</li>
			<? } ?>
		<? } ?>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES)) { ?>
			<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
				<li class="standardSubTitle">
					<div class="sitemapSection">
						<?=system_showText(string_ucwords(LANG_SITEMGR_ARTICLE_PLURAL));?>
					</div>
					<ul>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?> </a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/article.php"><?=system_showText(LANG_SITEMGR_ADD);?> </a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?> </a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/articlecategs/index.php"><?=system_showText(string_ucwords(LANG_SITEMGR_CATEGORIES));?> </a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=article"><?=system_showText(string_ucwords(LANG_SITEMGR_REVIEWS));?> </a></li>
					</ul>
				</li>
			<? } ?>
		<? } ?>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) {
			if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on") { ?>
				<li class="standardSubTitle">
					<div class="sitemapSection">
						<?=system_showText(LANG_SITEMGR_NAVBAR_PROMOTION);?>
					</div>
					<ul>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=PROMOTION_FEATURE_FOLDER?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?> </a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=PROMOTION_FEATURE_FOLDER?>/deal.php"><?=system_showText(LANG_SITEMGR_ADD);?> </a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=PROMOTION_FEATURE_FOLDER?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?> </a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=promotion"><?=system_showText(string_ucwords(LANG_SITEMGR_REVIEWS));?> </a></li>
					</ul>
				</li>
			<? } ?>
		<? } ?>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BLOG)) {
			if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") { ?>
					<li class="standardSubTitle">
						<div class="sitemapSection">
							<?=system_showText(LANG_MENU_BLOG);?>
						</div>
						<ul>
							<li><a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?> </a></li>
							<li><a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/blog.php"><?=system_showText(LANG_SITEMGR_ADD);?> </a></li>
							<li><a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?> </a></li>
							<li><a href="<?=BLOG_DEFAULT_URL?>/sitemgr/blogcategs/index.php"><?=system_showText(string_ucwords(LANG_SITEMGR_TAGS));?> </a></li>
							<li><a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/comments/index.php"><?=system_showText(string_ucwords(LANG_BLOG_COMMENTS));?> </a></li>
						</ul>
					</li>
				<? } ?>
		<? } ?>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_SITECONTENT)) { ?>
			<li class="standardSubTitle">
				<div class="sitemapSection">
					<?=system_showText(LANG_SITEMGR_MENU_SITECONTENT);?>
				</div>
				<ul>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/content/"><?=system_showText(LANG_SITEMGR_GENERAL);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/content/content_header.php"><?=system_showText(LANG_SITEMGR_HEADER);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/content/content_footer.php"><?=system_showText(LANG_SITEMGR_FOOTER);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/content/content_noimage.php"><?=system_showText(LANG_SITEMGR_CONTENT_DEFAULTIMAGE);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/content/content_icon.php"><?=system_showText(LANG_SITEMGR_CONTENT_ICON);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/content/advertisement.php"><?=system_showText(LANG_SITEMGR_ADVERTISEMENT);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/content/member.php"><?=system_showText(LANG_SITEMGR_MEMBER);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/content/client.php"><?=system_showText(LANG_SITEMGR_MENU_CUSTOM);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/content/listing.php"><?=system_showText(LANG_SITEMGR_LISTING_SING);?> </a></li>
					<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/content/event.php"><?=system_showText(string_ucwords(LANG_SITEMGR_EVENT));?> </a></li>
					<? } ?>
					<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/content/classified.php"><?=system_showText(LANG_SITEMGR_CLASSIFIED_SING);?> </a></li>
					<? } ?>
					<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/content/article.php"><?=system_showText(string_ucwords(LANG_SITEMGR_ARTICLE));?> </a></li>
					<? } ?>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/content/navigation.php"><?=system_showText(LANG_SITEMGR_SETTINGS_MODULES);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/content/slidergo.php"><?=system_showText(LANG_SITEMGR_NAVBAR_SLIDER);?> </a></li>
				</ul>
			</li>
		<? } ?>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_SEOCENTER)) { ?>
			<li class="standardSubTitle">
				<a class="sitemapSection" href="<?=DEFAULT_URL?>/sitemgr/seocenter.php"><?=system_showText(LANG_SITEMGR_SEOCENTER);?> </a>
			</li>
		<? } ?>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PAYMENT)) { ?>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<li class="standardSubTitle">

					<div class="sitemapSection">
						<?=system_showText(LANG_SITEMGR_REVENUECENTER);?>
					</div>

					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on") || (MANUALPAYMENT_FEATURE == "on")) { ?>
						<? if ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) { ?>
							<p class="subt"><?=system_showText(LANG_SITEMGR_TRANSACTION);?></p>
							<ul>
								<li><a href="<?=DEFAULT_URL?>/sitemgr/transactions"><?=system_showText(LANG_SITEMGR_HISTORY);?> </a></li>
								<li><a href="<?=DEFAULT_URL?>/sitemgr/transactions/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?> </a></li>
								<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_IMPORTEXPORT)) { ?>
									<li><a href="<?=DEFAULT_URL?>/sitemgr/export/payment.php?type=online"><?=system_showText(LANG_SITEMGR_MENU_EXPORTPAYMENTRECORDS);?> </a></li>
								<? } ?>
							</ul>
						<? } ?>

						<p class="subt"><?=system_showText(LANG_SITEMGR_INVOICE);?> </p>
						<ul>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/invoices"><?=system_showText(LANG_SITEMGR_HISTORY);?> </a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/invoices/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?> </a></li>
							<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_IMPORTEXPORT)) { ?>
								<li><a href="<?=DEFAULT_URL?>/sitemgr/export/payment.php?type=invoice"><?=system_showText(LANG_SITEMGR_MENU_EXPORTPAYMENTRECORDS);?> </a></li>
							<? } ?>
						</ul>
					<? } ?>

					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<? if (CUSTOM_INVOICE_FEATURE == "on") { ?>
							<p class="subt"><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE);?> </p>
							<ul>
								<li><a href="<?=DEFAULT_URL?>/sitemgr/custominvoices/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?> </a></li>
								<li><a href="<?=DEFAULT_URL?>/sitemgr/custominvoices/custominvoice.php"><?=system_showText(LANG_SITEMGR_ADD);?> </a></li>
								<li><a href="<?=DEFAULT_URL?>/sitemgr/custominvoices/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?> </a></li>
							</ul>
						<? } ?>
					<? } ?>

					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<p class="subt"><?=system_showText(LANG_SITEMGR_PROMOTIONALCODE);?> </p>
						<ul>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/discountcode/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?> </a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/discountcode/discountcode.php"><?=system_showText(LANG_SITEMGR_ADD);?> </a></li>
						</ul>
					<? } ?>
				</li>
			<? } ?>
		<? } ?>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_REPORTS)) { ?>
			<li class="standardSubTitle">
				<div class="sitemapSection">
					<?=system_showText(LANG_SITEMGR_NAVBAR_REPORTS);?>
				</div>
				<ul>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/reports/systemreport.php"><?=system_showText(LANG_SITEMGR_NAVBAR_SYSTEMREPORT);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/reports/statisticreport.php"><?=system_showText(LANG_SITEMGR_NAVBAR_STATISTICREPORT)?></a></li>
				</ul>
			</li>
		<? } ?>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_SETTINGS)) { ?>
			<li class="standardSubTitle">
				<div class="sitemapSection">
					<?=system_showText(LANG_SITEMGR_MENU_SETTINGS);?>
				</div>

				<p class="subt"><?=system_showText(LANG_SITEMGR_GENERAL);?> </p>
				<ul>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/theme.php"><?=system_showText(LANG_SITEMGR_MENU_THEMES);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/foreignaccount.php"><?=system_showText(LANG_SITEMGR_MENU_LOGINOPTIONS);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/faq.php"><?=system_showText(LANG_SITEMGR_FREQUENTLYASKEDQUESTIONS);?> </a></li>


					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/robotsfilter.php"><?=system_showText(LANG_SITEMGR_SETTINGS_ROBOTS);?> </a></li>
					<? if (MAINTENANCE_FEATURE == "on") { ?>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/maintenance.php"><?=system_showText(LANG_SITEMGR_SETTING_MAINTENANCE);?> </a></li>
					<? } ?>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/twittersettings.php"><?=system_showText(LANG_SITEMGR_TWITTER);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/import.php"><?=system_showText(string_ucwords(LANG_SITEMGR_IMPORT));?> </a></li>
					<? if (FEATURED_CATEGORY == "on") { ?>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/featuredcategory.php"><?=string_ucwords(system_showText(LANG_SITEMGR_FEATUREDCATEGORY_PLURAL));?></a></li>
					<? } ?>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/approvalrequirement.php"><?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_APPROVAL));?></a></li>
					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LOCATIONS)) { ?>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/location.php"><?=system_showText(LANG_SITEMGR_SEOCENTER_LABEL_LOCATIONS);?> </a></li>
					<? } ?>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/visitorprofile.php"><?=string_ucwords(system_showText(LANG_SITEMGR_SOCIALNETWORK));?></a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/comments.php"><?=string_ucwords(system_showText(LANG_SITEMGR_COMMENTING_OPTIONS));?></a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/twilio.php"><?=string_ucwords(system_showText(LANG_SITEMGR_TWILIO));?></a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/api.php"><?=system_showText(LANG_SITEMGR_API);?></a></li>
				</ul>

				<p class="subt"><?=system_showText(LANG_SITEMGR_LABEL_EMAIL);?> </p>
				<ul>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/email.php"><?=system_showText(LANG_SITEMGR_SYSTEMEMAIL);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/emailnotifications/"><?=system_showText(LANG_SITEMGR_MENU_EMAILNOTIF);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/emailconfig.php"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_EMAILSENDINGCONFIGURATION);?> </a></li>			
				</ul>

				<p class="subt"><?=system_showText(LANG_SITEMGR_NAVBAR_MODULES);?> </p>
				<ul>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/editorchoice.php"><?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DESIGNATIONS);?></a></li>
					<? if(ABLE_RENAME_LEVEL == "on") { ?>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/levels.php"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_MENULABEL);?></a></li>
					<? }
					if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && $hasPromotion){ ?>
                        <li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/deal.php"><?=string_ucwords(system_showText(LANG_SITEMGR_PROMOTION));?></a></li>
                    <? } ?>
					<? if (CLAIM_FEATURE == "on") { ?>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/claim.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CLAIM_CLAIMS))?></a></li>
                    <li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/modules.php"><?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_MANAGE_MODULES))?></a></li>
				<? } ?>
				</ul>

				<p class="subt"><?=system_showText(LANG_SITEMGR_NAVBAR_GOOGLESETTINGS);?> </p>
				<ul>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/googleprefs/googlemaps.php"><?=system_showText(LANG_SITEMGR_GOOGLEMAPS);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/googleprefs/googleads.php"><?=system_showText(LANG_SITEMGR_GOOGLEADS);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/googleprefs/googleanalytics.php"><?=system_showText(LANG_SITEMGR_GOOGLEANALYTICS);?> </a></li>
				</ul>

				<p class="subt"><?=system_showText(LANG_SITEMGR_PAYMENTSETTINGS);?> </p>
				<ul>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/pricing.php"><?=system_showText(LANG_SITEMGR_SETTINGS_PRICING);?> </a></li>
				<? if (PAYMENTSYSTEM_FEATURE == "on") { ?>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/paymentgateway.php"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_PAYMENTGATEWAY);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/invoice.php"><?=system_showText(LANG_SITEMGR_INVOICE_INVOICEINFORMATION);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/tax.php"><?=system_showText(LANG_SITEMGR_SETTINGS_TAX);?></a></li>
				<? } ?>
				</ul>
			</li>
		<? } ?>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LOCATIONS)) {
				$_locations = explode(",", EDIR_LOCATIONS);
				$firsLevel = $_locations[0]; ?>
				<li class="standardSubTitle">
					<a class="sitemapSection" href="<?=DEFAULT_URL?>/sitemgr/locations/location_<?=$firsLevel?>/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_LOCATIONS));?></a>
				</li>
		<? } ?>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_IMPORTEXPORT)) { ?>
			<li class="standardSubTitle">
				<div class="sitemapSection">
					<?=system_showText(string_ucwords(LANG_SITEMGR_NAVBAR_DATA_MANAGEMENT));?>
				</div>
				<ul>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/import/"><?=system_showText(string_ucwords(LANG_SITEMGR_IMPORT));?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/import/importlog.php"><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTLOG);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/import/settings.php"><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTSETTINGS);?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/export/"><?=ucfirst(system_showText(LANG_SITEMGR_EXPORT));?> </a></li>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/export/payment.php"><?=system_showText(LANG_SITEMGR_MENU_EXPORTPAYMENTRECORDS);?> </a></li>
				</ul>
			</li>
		<? } ?>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LANGUAGECENTER)) { ?>
				<li class="standardSubTitle">
					<a class="sitemapSection" href="<?=DEFAULT_URL?>/sitemgr/langcenter/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_LANGUAGECENTER);?> </a>
				</li>
		<? } ?>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PACKAGES)) { ?>
		<li class="standardSubTitle">
			<div class="sitemapSection">
				<?=system_showText(string_ucwords(LANG_SITEMGR_PACKAGE_PLURAL));?>
			</div>
			<ul>
				<li><a href="<?=DEFAULT_URL?>/sitemgr/package/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
				<li><a href="<?=DEFAULT_URL?>/sitemgr/package/package.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
				<li><a href="<?=DEFAULT_URL?>/sitemgr/package/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
				<li><a href="<?=DEFAULT_URL?>/sitemgr/package/reports.php"><?=system_showText(LANG_SITEMGR_NAVBAR_REPORTS);?></a></li>
			</ul>
		</li>
		<? } ?>
		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PLUGINS)) { ?>
		<li class="standardSubTitle">
			<div class="sitemapSection">
				<?=system_showText(string_ucwords(LANG_SITEMGR_PLUGINS));?>
			</div>
			<ul>
				<? if (SUGARCRM_FEATURE == "on") { ?>
				<li><a href="<?=DEFAULT_URL?>/sitemgr/plugins/index.php?type=0"><?=system_showText(LANG_SITEMGR_NAVBAR_SUGARCRM);?></a></li>
				<? } ?>
				<li><a href="<?=DEFAULT_URL?>/sitemgr/plugins/index.php?type=1"><?=system_showText(LANG_SITEMGR_NAVBAR_WORDPRESS);?></a></li>
			</ul>
		</li>
		<? } ?>

	</ul>
	</div>
</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>