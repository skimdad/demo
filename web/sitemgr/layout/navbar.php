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
	# * FILE: /sitemgr/layout/navbar.php
	# ----------------------------------------------------------------------------------------------------

?>
	<script type="text/javascript">

		// JQUERY 1.3.1 / DROP DOWN NAVBAR FUNCTION
		var TopenMS=0;
		var TchangeMS=0;

		function mainmenuNavBar(){
			$(" #leftMainNav ul:first ").css({display: "none"});
			$(" #leftMainNav .topLink").hoverIntent(function(){

				$("#ul_listing").css('top', -($("#ul_listing").height()/2)+17);
				$("#ul_banner").css('top', -($("#ul_banner").height()/2)+17);
				$("#ul_event").css('top', -($("#ul_event").height()/2)+17);
				$("#ul_classified").css('top', -($("#ul_classified").height()/2)+17);
				$("#ul_article").css('top', -($("#ul_article").height()/2)+17);
				$("#ul_deal").css('top', -($("#ul_deal").height()/2)+17);
				$("#ul_blog").css('top', -($("#ul_blog").height()/2)+17);
				$("#ul_content").css('top', -($("#ul_content").height()/2)+17);
				$("#ul_revenue").css('top', -($("#ul_revenue").height()/2)+17);
				$("#ul_reports").css('top', -($("#ul_reports").height()/2)+17);
				$("#ul_settings").css('top', -($("#ul_settings").height()/1)+150);
				$("#ul_data").css('top', -($("#ul_data").height()/2)+17);
				$("#ul_package").css('top', -($("#ul_package").height()/1)+50);
				$("#ul_plugin").css('top', -($("#ul_plugin").height()/1)+20);

				$(this).find('a').addClass("borderDown");
				$(this).find('ul:first').css({visibility: "visible", display: "none"}).fadeIn(200);
				//fix ie6 z-index bug
				if ($.browser.msie && $.browser.version == 6){
					$(this).find('ul:first').bgiframe();
				}
			},function(){
				$(this).find('ul:first').css({visibility: "hidden"});
				$(this).find('a').removeClass("borderDown");
				
			});
		}

		$(document).ready(function(){
			mainmenuNavBar();
		});

		function addClassNavBar(item) {
			$("#privateMenu_"+item).addClass('submenu_active');
		}

		function addClassMainHorizontalMenuNavBar(item) {
			$("#"+item).addClass('header-topMainNavbarActive');
		}

		function showDropdownSearch(){
			if (TopenMS==0){
				$("#divSearch").slideDown('slow');
				$('#linkSearch').text('' + showText(LANG_JS_CLOSE) + '');
				TchangeMS=1;
			} else {
				$("#divSearch").slideUp('slow');
				$('#linkSearch').text("<?=system_showText(LANG_SITEMGR_ADVOPTIONS)?>");
				TchangeMS=0;
			}

			if (TchangeMS==1){
				TopenMS=1;
			} else {
				TopenMS=0;
			}
		}

	</script>

	<?
	setting_get("wp_enabled", $wp_enabled);
	$openListing		=	((string_strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_FOLDER)   && !string_strpos($_SERVER["PHP_SELF"], "content")  && !string_strpos($_SERVER["PHP_SELF"], "export"))||((string_strpos($_SERVER["PHP_SELF"], "claim")) && !string_strpos($_SERVER["PHP_SELF"], "prefs"))||(string_strpos($_SERVER["REQUEST_URI"], "item_type=listing")));
	$openBanner			=	(string_strpos($_SERVER["PHP_SELF"], BANNER_FEATURE_FOLDER));
	$openEvent			=	(string_strpos($_SERVER["PHP_SELF"], EVENT_FEATURE_FOLDER)      && !string_strpos($_SERVER["PHP_SELF"], "content"));
	$openClassified		=	(string_strpos($_SERVER["PHP_SELF"], CLASSIFIED_FEATURE_FOLDER) && !string_strpos($_SERVER["PHP_SELF"], "content"));
	$openArticle		=	(string_strpos($_SERVER["PHP_SELF"], ARTICLE_FEATURE_FOLDER)    && !string_strpos($_SERVER["PHP_SELF"], "content")||(string_strpos($_SERVER["REQUEST_URI"], "item_type=article")));
	$openPromotion		=	((string_strpos($_SERVER["PHP_SELF"], PROMOTION_FEATURE_FOLDER) || string_strpos($_SERVER["REQUEST_URI"], "item_type=promotion")) && (!string_strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_FOLDER) && !string_strpos($_SERVER["PHP_SELF"], "prefs")));
	$openBlog			=	(string_strpos($_SERVER["PHP_SELF"], BLOG_FEATURE_FOLDER) && !string_strpos($_SERVER["PHP_SELF"], "postcomments"));
	$openSiteContent	=	(string_strpos($_SERVER["PHP_SELF"], "content"));
	$openSeo			=   (string_strpos($_SERVER["PHP_SELF"], "seocenter"));
	$openRevenue		=	(string_strpos($_SERVER["PHP_SELF"], "transactions") || string_strpos($_SERVER["PHP_SELF"], "invoices") || string_strpos($_SERVER["PHP_SELF"], "custominvoices") || string_strpos($_SERVER["PHP_SELF"], "discountcode"));
	$openReports		=   (string_strpos($_SERVER["PHP_SELF"], "reports"));
	$openSettings		=	(string_strpos($_SERVER["PHP_SELF"], "prefs") || string_strpos($_SERVER["PHP_SELF"], "emailnotifications"));
	$openLocations		=	(string_strpos($_SERVER["PHP_SELF"], "locations"));
	$openData			=	((string_strpos($_SERVER["PHP_SELF"], "import") || string_strpos($_SERVER["PHP_SELF"], "export")) && !string_strpos($_SERVER["PHP_SELF"], "prefs"));
	$openLang			=	(string_strpos($_SERVER["PHP_SELF"], "langcenter"));
	$openPackage		=	(string_strpos($_SERVER["PHP_SELF"], "package"));
	$openplugin			=	(string_strpos($_SERVER["PHP_SELF"], "plugin"));
	?>

	<div id="main-left">

		<?
		/*
		 * This var $domainDropDown is created on /sitemgr/layout/header.php
		 */
		if (!is_numeric($domainDropDown) && (!string_strpos($_SERVER["PHP_SELF"], "login.php")) && (!string_strpos($_SERVER["PHP_SELF"], "resetpassword.php"))){
			?>
			<div class="chooseDomainDropDown">
				<?="<p>".system_showText(LANG_SITEMGR_SELECT_DOMAIN).":</p>";?>
				<?=$domainDropDown;?>
				<span class="clear"></span>
			</div>
			<?
		}

		?>
		<div id="content-navbar">
			<div class="navBar">
				<ul class="leftNavMain" id="leftMainNav">
					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
					<li class="listing topLink listing_">
						<a id="link_listing" <?=($openListing ? "class=\"borderDownSelected\"" : "");?> href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_LISTING);?></a>
						<ul id="ul_listing" style="right: 0px; visibility: hidden;" class="left-topMainNavbar-sub" id="navBar_submenu_listing">
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/listinglevel.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/listingcategs/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORIES));?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=listing"><?=string_ucwords(system_showText(LANG_SITEMGR_REVIEWS));?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/claim/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CLAIMED));?></a></li>
                            <? if (LISTINGTEMPLATE_FEATURE == "on" && !USING_THEME_TEMPLATE) { ?>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/listingtemplate/index.php"><?=system_showText(LANG_SITEMGR_MENU_TEMPLATES);?></a></li>
                            <? } ?>
						</ul>
					</li>
					<?	} ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BANNERS) && BANNER_FEATURE == "on") { ?>
					<li class="listing topLink banner_">
						<a id="link_banner" <?=($openBanner ? "class=\"borderDownSelected\"" : "");?> <?=(CUSTOM_BANNER_FEATURE != "on" ? "title=\"".system_showText(LANG_SITEMGR_MODULE_OFF)."\"" : "")?> href="<?=DEFAULT_URL?>/sitemgr/<?=BANNER_FEATURE_FOLDER;?>/index.php"><span <?=(CUSTOM_BANNER_FEATURE != "on" ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_NAVBAR_BANNER);?></span></a>
						<ul id="ul_banner" style="right: 0px; visibility: hidden;" class="left-topMainNavbar-sub" id="navBar_submenu_banner" <? if (!$openBanner) {?> style="display:none" <?}?> >
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=BANNER_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=BANNER_FEATURE_FOLDER;?>/add.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=BANNER_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
						</ul>
					</li>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_EVENTS) && EVENT_FEATURE == "on" && FORCE_DISABLE_EVENT_FEATURE != "on") { ?>
					<li class="listing topLink event_">
						<a  id="link_event" <?=($openEvent ? "class=\"borderDownSelected\"" : "");?> <?=(CUSTOM_EVENT_FEATURE != "on" ? "title=\"".system_showText(LANG_SITEMGR_MODULE_OFF)."\"" : "")?> href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>/index.php"><span <?=(CUSTOM_EVENT_FEATURE != "on" ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_NAVBAR_EVENT);?></span></a>
						<ul id="ul_event" style="right: 0px; visibility: hidden;" class="left-topMainNavbar-sub" id="navBar_submenu_event" <? if (!$openEvent) {?> style="display:none" <?}?> >
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>/eventlevel.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/eventcategs/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORIES));?></a></li>
						</ul>
					</li>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS) && CLASSIFIED_FEATURE == "on" && FORCE_DISABLE_CLASSIFIED_FEATURE != "on") { ?>
					<li class="listing topLink classified_">
						<a  id="link_classified" <?=($openClassified ? "class=\"borderDownSelected\"" : "");?> <?=(CUSTOM_CLASSIFIED_FEATURE != "on" ? "title=\"".system_showText(LANG_SITEMGR_MODULE_OFF)."\"" : "")?> href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/index.php"><span <?=(CUSTOM_CLASSIFIED_FEATURE != "on" ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_NAVBAR_CLASSIFIED);?></span></a>
						<ul id="ul_classified" style="right: 0px; visibility: hidden;" class="left-topMainNavbar-sub" id="navBar_submenu_classified" <? if (!$openClassified) {?> style="display:none" <?}?> >
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/classifiedlevel.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/classifiedcategs/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORIES));?></a></li>
						</ul>
					</li>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES) && ARTICLE_FEATURE == "on" && FORCE_DISABLE_ARTICLE_FEATURE != "on") { ?>
					<li class="listing topLink article_">
						<a  id="link_article" <?=($openArticle ? "class=\"borderDownSelected\"" : "");?> <?=(CUSTOM_ARTICLE_FEATURE != "on" ? "title=\"".system_showText(LANG_SITEMGR_MODULE_OFF)."\"" : "")?> href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/index.php"><span <?=(CUSTOM_ARTICLE_FEATURE != "on" ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_NAVBAR_ARTICLE);?></span></a>
						<ul id="ul_article" style="right: 0px; visibility: hidden;" class="left-topMainNavbar-sub" id="navBar_submenu_article" <? if (!$openArticle) {?> style="display:none" <?}?> >
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/article.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/articlecategs/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORIES));?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=article"><?=string_ucwords(system_showText(LANG_SITEMGR_REVIEWS));?></a></li>
						</ul>
					</li>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS) && PROMOTION_FEATURE == "on" && $hasPromotion && FORCE_DISABLE_PROMOTION_FEATURE != "on") { ?>
					<li class="listing topLink deal_">
						<a  id="link_deal" <?=($openPromotion ? "class=\"borderDownSelected\"" : "");?> <?=(CUSTOM_PROMOTION_FEATURE != "on" ? "title=\"".system_showText(LANG_SITEMGR_MODULE_OFF)."\"" : "")?> href="<?=DEFAULT_URL?>/sitemgr/<?=PROMOTION_FEATURE_FOLDER?>/index.php"><span <?=(CUSTOM_PROMOTION_FEATURE != "on" ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_NAVBAR_PROMOTION);?></span></a>
						<ul id="ul_deal" style="right: 0px; visibility: hidden;" class="left-topMainNavbar-sub" id="navBar_submenu_promotion" <? if (!$openPromotion) {?> style="display:none" <?}?> >
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=PROMOTION_FEATURE_FOLDER?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=PROMOTION_FEATURE_FOLDER?>/deal.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/<?=PROMOTION_FEATURE_FOLDER?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=promotion"><?=string_ucwords(system_showText(LANG_SITEMGR_REVIEWS));?></a></li>
						 </ul>
					</li>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BLOG) && BLOG_FEATURE == "on") { ?>
					<li class="listing topLink blog_">
						<a  id="link_blog" <?=($openBlog ? "class=\"borderDownSelected\"" : "");?> <?=(CUSTOM_BLOG_FEATURE != "on" ? "title=\"".system_showText(LANG_SITEMGR_MODULE_OFF)."\"" : "")?> href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/index.php"><span <?=(CUSTOM_BLOG_FEATURE != "on" ? "class=\"module_off\"" : "")?>><?=system_showText(LANG_SITEMGR_BLOG_SING);?></span></a>
						<ul id="ul_blog" style="right: 0px; visibility: hidden;" class="left-topMainNavbar-sub" id="navBar_submenu_blog" <? if (!$openBlog || $settingBlog) {?> style="display:none" <?}?> >
							<li><a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
							<? if (!$wp_enabled){ ?>
							<li><a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/blog.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
							<? } ?>
							<li><a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
							<li><a href="<?=BLOG_DEFAULT_URL?>/sitemgr/blogcategs/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_TAGS));?></a></li>
							<li><a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/comments/index.php"><?=string_ucwords(system_showText(LANG_BLOG_COMMENTS));?></a></li>
						</ul>
					</li>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_SITECONTENT)) { ?>
					<li class="listing topLink sitecontent_">
						<a id="link_content" <?=($openSiteContent ? "class=\"borderDownSelected\"" : "");?> href="<?=DEFAULT_URL?>/sitemgr/content/index.php"><?=system_showText(LANG_SITEMGR_MENU_SITECONTENT);?></a>
						<ul id="ul_content" style="right: 0px; visibility: hidden;" class="left-topMainNavbar-sub" id="navBar_submenu_siteContent" <? if (!$openSiteContent) {?> style="display:none" <?}?> >
							<li><a href="<?=DEFAULT_URL?>/sitemgr/content/index.php"><?=system_showText(LANG_SITEMGR_GENERAL);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/content/advertisement.php"><?=system_showText(LANG_SITEMGR_ADVERTISEMENT);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/content/member.php"><?=system_showText(LANG_SITEMGR_MEMBER);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/content/client.php"><?=system_showText(LANG_SITEMGR_MENU_CUSTOM);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/content/listing.php"><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING));?></a></li>
							<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
								<li><a href="<?=DEFAULT_URL?>/sitemgr/content/event.php"><?=string_ucwords(system_showText(LANG_SITEMGR_EVENT));?></a></li>
							<?}?>
							<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
								<li><a href="<?=DEFAULT_URL?>/sitemgr/content/classified.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CLASSIFIED));?></a></li>
							<?}?>
							<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
								<li><a href="<?=DEFAULT_URL?>/sitemgr/content/article.php"><?=string_ucwords(system_showText(LANG_SITEMGR_ARTICLE));?></a></li>
							<?}?>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/content/navigation.php"><?=system_showText(LANG_SITEMGR_SETTINGS_MODULES);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/content/content_slider.php"><?=system_showText(LANG_SITEMGR_NAVBAR_SLIDER);?></a></li>
						</ul>
					</li>
					<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_SEOCENTER)) { ?>
					<li class="listing topLink"><a <?=($openSeo ? "class=\"noBorder borderDownSelected\"" : "class=\"noBorder\"");?> href="<?=DEFAULT_URL?>/sitemgr/seocenter.php"><?=system_showText(LANG_SITEMGR_NAVBAR_SEOCENTER)?></a></li>
				<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PAYMENT)) { ?>
					<li class="listing topLink revenue_">
						<a  id="link_revenue" <?=($openRevenue ? "class=\"borderDownSelected\"" : "");?> id="MHMrevenuecenter" href="javascript:void(0);"><?=system_showText(LANG_SITEMGR_REVENUECENTER);?></a>
						<ul id="ul_revenue" style="visibility: hidden;" class="left-topMainNavbar-sub left-topMainNavbar-subTwoColumn" id="navBar_submenu_revenue">
							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on") || (MANUALPAYMENT_FEATURE == "on")) { ?>
								<? if ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) { ?>
									<li class="topMainNavbarTitle">
										<p><?=system_showText(LANG_SITEMGR_TRANSACTION);?></p>
										<ul>
											<li><a href="<?=DEFAULT_URL?>/sitemgr/transactions/"><?=system_showText(LANG_SITEMGR_HISTORY);?></a></li>
											<li><a href="<?=DEFAULT_URL?>/sitemgr/transactions/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
											<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_IMPORTEXPORT)) { ?>
												<li><a href="<?=DEFAULT_URL?>/sitemgr/export/payment.php?type=online"><?=system_showText(LANG_SITEMGR_MENU_EXPORTPAYMENTRECORDS);?></a></li>
											<? } ?>
										</ul>
									</li>
								<? } ?>
								<? if (INVOICEPAYMENT_FEATURE == "on") { ?>
								<li class="topMainNavbarTitle">
									<p><?=string_ucwords(system_showText(LANG_SITEMGR_INVOICE));?></p>
									<ul>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/invoices/"><?=system_showText(LANG_SITEMGR_HISTORY);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/invoices/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
										<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_IMPORTEXPORT)) { ?>
											<li><a href="<?=DEFAULT_URL?>/sitemgr/export/payment.php?type=invoice"><?=system_showText(LANG_SITEMGR_MENU_EXPORTPAYMENTRECORDS);?></a></li>
										<? } ?>
									</ul>
								</li>
								<? } ?>

							<? } ?>

							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<? if (CUSTOM_INVOICE_FEATURE == "on") { ?>
									<li class="topMainNavbarTitle">
									<p><?=string_ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE));?></p>
										<ul>
											<li><a href="<?=DEFAULT_URL?>/sitemgr/custominvoices/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
											<li><a href="<?=DEFAULT_URL?>/sitemgr/custominvoices/custominvoice.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
											<li><a href="<?=DEFAULT_URL?>/sitemgr/custominvoices/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
										</ul>
									</li>
									<? if (INVOICEPAYMENT_FEATURE != "on") { ?>
										<li class="topMainNavbarHR">
										</li>
									<? } ?>
								<? } ?>
							<? } ?>

							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<li class="topMainNavbarTitle">
									<p><?=system_showText(LANG_SITEMGR_PROMOTIONALCODE);?></p>
										<ul>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/discountcode/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/discountcode/discountcode.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
									</ul>
								</li>
							<? } ?>


						</ul>
					</li>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_REPORTS)) { ?>
					<li class="listing topLink reports_">
						<a  id="link_reports" <?=($openReports ? "class=\"borderDownSelected\"" : "");?> id="MHMreports" href="javascript:void(0);"><?=system_showText(LANG_SITEMGR_NAVBAR_REPORTS);?></a>
						<ul id="ul_reports" style="right: 0px; visibility: hidden;" class="left-topMainNavbar-sub" id="">
							<li><a href="<?=DEFAULT_URL?>/sitemgr/reports/systemreport.php"><?=system_showText(LANG_SITEMGR_NAVBAR_SYSTEMREPORT);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/reports/statisticreport.php"><?=system_showText(LANG_SITEMGR_NAVBAR_STATISTICREPORT);?></a></li>
						</ul>
					</li>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_SETTINGS)) { ?>
					<li class="listing topLink settings_">
						<a  id="link_settings" <?=($openSettings ? "class=\"borderDownSelected\"" : "");?> id="MHMsettings" href="javascript:void(0);"><?=system_showText(LANG_SITEMGR_MENU_SETTINGS);?></a>
							<ul id="ul_settings" style="visibility: hidden;" class="left-topMainNavbar-sub left-topMainNavbar-subThreeColumn" id="">
								<li class="topMainNavbarTitle">
									<p><?=system_showText(LANG_SITEMGR_GENERAL);?></p>
									<ul>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/theme.php"><?=system_showText(LANG_SITEMGR_MENU_THEMES);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/foreignaccount.php"><?=system_showText(LANG_SITEMGR_MENU_LOGINOPTIONS);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/faq.php"><?=system_showText(LANG_SITEMGR_FREQUENTLYASKEDQUESTIONS);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/robotsfilter.php"><?=system_showText(LANG_SITEMGR_SETTINGS_ROBOTS);?></a></li>
										<? if (MAINTENANCE_FEATURE == "on") { ?>
											<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/maintenance.php"><?=system_showText(LANG_SITEMGR_SETTING_MAINTENANCE);?></a></li>
										<? } ?>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/twittersettings.php"><?=system_showText(LANG_SITEMGR_TWITTER);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/import.php"><?=string_ucwords(system_showText(LANG_SITEMGR_IMPORT));?></a></li>
										<? if (FEATURED_CATEGORY == "on") { ?>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/featuredcategory.php"><?=string_ucwords(system_showText(LANG_SITEMGR_FEATUREDCATEGORY_PLURAL));?></a></li>
										<? } ?>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/approvalrequirement.php"><?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_APPROVAL));?></a></li>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/location.php"><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_LOCATIONS));?></a></li>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/visitorprofile.php"><?=string_ucwords(system_showText(LANG_SITEMGR_SOCIALNETWORK));?></a></li>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/comments.php"><?=string_ucwords(system_showText(LANG_SITEMGR_COMMENTING_OPTIONS));?></a></li>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/twilio.php"><?=string_ucwords(system_showText(LANG_SITEMGR_TWILIO));?></a></li>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/api.php"><?=system_showText(LANG_SITEMGR_API);?></a></li>
									</ul>
								</li>
								<li class="topMainNavbarTitle">
									<p><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL);?></p>
									<ul>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/email.php"><?=system_showText(LANG_SITEMGR_SYSTEMEMAIL);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/emailnotifications/"><?=system_showText(LANG_SITEMGR_MENU_EMAILNOTIF);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/emailconfig.php"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_EMAILSENDINGCONFIGURATION);?></a></li>
									</ul>
								</li>

								<li class="topMainNavbarTitle">
									<p><?=system_showText(LANG_SITEMGR_NAVBAR_MODULES);?></p>
									<ul>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/editorchoice.php"><?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DESIGNATIONS);?></a></li>
										<? if(ABLE_RENAME_LEVEL == "on") { ?>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/levels.php"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_MENULABEL);?></a></li>
										<? }?>
										<? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && $hasPromotion) { ?>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/deal.php"><?=string_ucwords(system_showText(LANG_SITEMGR_PROMOTION_PLURAL));?></a></li>
										<? } ?>
										<? if (CLAIM_FEATURE == "on") { ?>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/claim.php"><?=string_ucwords(system_showText(LANG_SITEMGR_CLAIM_CLAIMS))?></a></li>
										<? } ?>
                                        <li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/modules.php"><?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_MANAGE_MODULES))?></a></li>
									</ul>
								</li>
								<li class="topMainNavbarTitle">
									<p><?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_GOOGLE);?></p>
									<ul>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/googleprefs/googlemaps.php"><?=system_showText(LANG_SITEMGR_GOOGLEMAPS);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/googleprefs/googleads.php"><?=system_showText(LANG_SITEMGR_GOOGLEADS);?></a></li>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/googleprefs/googleanalytics.php"><?=system_showText(LANG_SITEMGR_GOOGLEANALYTICS);?></a></li>
									</ul>
								</li>

								<li class="topMainNavbarTitle">
									<p><?=system_showText(LANG_SITEMGR_PAYMENTSETTINGS);?></p>
									<ul>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/pricing.php"><?=system_showText(LANG_SITEMGR_SETTINGS_PRICING);?></a></li>
										<? if (PAYMENTSYSTEM_FEATURE == "on") { ?>
											<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/paymentgateway.php"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_PAYMENTGATEWAY);?></a></li>
											<? if (INVOICEPAYMENT_FEATURE == "on") { ?>
												<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/invoice.php"><?=system_showText(LANG_SITEMGR_INVOICEINFORMATION);?></a></li>
											<?}?>
										<? } ?>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/prefs/tax.php"><?=system_showText(LANG_SITEMGR_SETTINGS_TAX);?></a></li>
									</ul>
								</li>
								
								<li class="topMainNavbarTitle">
									<p>Mobile Application</p>
									<ul>
										<li><a href="<?=DEFAULT_URL?>/sitemgr/listing/mobileappsettings.php">General</a></li>										
                                                                                <li><a href="<?=DEFAULT_URL?>/sitemgr/listing/MobileApp.php?id=-1">Default Values</a></li>

									</ul>
								</li>
							</ul>
					</li>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LOCATIONS)) {
						$_locations = explode(",", EDIR_LOCATIONS);
						$firsLevel = $_locations[0];
						?>
						<li class="listing topLink locations_">
							<a <?=($openLocations ? "class=\"noBorder borderDownSelected\"" : "class=\"noBorder\"");?> href="<?=DEFAULT_URL?>/sitemgr/locations/location_<?=$firsLevel?>/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_LOCATIONS));?></a>
						</li>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_IMPORTEXPORT)) { ?>
					<li class="listing topLink data_">
						<a id="link_data" <?=($openData ? "class=\"borderDownSelected\"" : "");?> href="javascript:void(0);"><?=system_showText(LANG_SITEMGR_NAVBAR_DATA_MANAGEMENT);?></a>
						<ul id="ul_data" style="right: 0px; visibility: hidden;" class="left-topMainNavbar-sub" id="navBar_submenu_data" >
							<li><a href="<?=DEFAULT_URL?>/sitemgr/import/index.php"><?=ucfirst(system_showText(LANG_SITEMGR_IMPORT));?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/import/importlog.php"><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTLOG);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/import/settings.php"><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTSETTINGS);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/export/index.php"><?=ucfirst(system_showText(LANG_SITEMGR_EXPORT));?></a></li>
							<li><a href="<?=DEFAULT_URL?>/sitemgr/export/payment.php"><?=system_showText(LANG_SITEMGR_MENU_EXPORTPAYMENTRECORDS);?></a></li>
						</ul>
					</li>
					<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LANGUAGECENTER)) { ?>
					<li class="listing topLink lang_">
						<a <?=($openLang ? "class=\"noBorder borderDownSelected\"" : "class=\"noBorder\"");?> href="<?=DEFAULT_URL?>/sitemgr/langcenter/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_LANGUAGECENTER);?></a>
					</li>
				<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PACKAGES)) { ?>
				<li class="listing topLink package_">
					<a  id="link_package" <?=($openPackage ? "class=\"borderDownSelected\"" : "");?> href="<?=DEFAULT_URL?>/sitemgr/package/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_PACKAGE_PLURAL));?></a>
					<ul id="ul_package" style="visibility: hidden;" class="left-topMainNavbar-sub" id="navBar_submenu_package" <? if (!$openPackage) {?> style="display:none" <?}?> >
						<li><a href="<?=DEFAULT_URL?>/sitemgr/package/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/package/package.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/package/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/package/reports.php"><?=system_showText(LANG_SITEMGR_NAVBAR_REPORTS);?></a></li>
					</ul>
				</li>
				<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PLUGINS)) { ?>
				<li class="listing topLink package_">
					<a  id="link_plugin" <?=($openplugin ? "class=\"borderDownSelected\"" : "");?> href="<?=DEFAULT_URL?>/sitemgr/plugins/index.php"><?=string_ucwords(system_showText(LANG_SITEMGR_PLUGINS));?></a>
					<ul id="ul_plugin" style="visibility: hidden;" class="left-topMainNavbar-sub" id="navBar_submenu_plugin" <? if (!$openplugin) {?> style="display:none" <?}?> >
						<li><a href="<?=DEFAULT_URL?>/sitemgr/plugins/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
						<? if (SUGARCRM_FEATURE == "on") { ?>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/plugins/index.php?type=0"><?=system_showText(LANG_SITEMGR_NAVBAR_SUGARCRM);?></a></li>
						<? } ?>
						<li><a href="<?=DEFAULT_URL?>/sitemgr/plugins/index.php?type=1"><?=system_showText(LANG_SITEMGR_NAVBAR_WORDPRESS);?></a></li>
					</ul>
				</li>
				<? } ?>

			</ul>
			</div>
			<? if (DEMO_MODE) { ?>
				<br /><p class="optionsNote">* Optional Package</p>
			<? } ?>
		</div>

		<div id="bottom-navbar">&nbsp;</div>
	</div>