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
	# * FILE: /conf/constants_realestate.inc.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# IMAGE PARAMETERS (keep the ratio) AND OTHERS THEME CONFIGURATIONS
	# ----------------------------------------------------------------------------------------------------

	# LISTING
    define("IMAGE_LISTING_FULL_WIDTH",          650);
    define("IMAGE_LISTING_FULL_HEIGHT",         367);
    define("IMAGE_LISTING_THUMB_WIDTH",         320);
    define("IMAGE_LISTING_THUMB_HEIGHT",        181);
    define("IMAGE_FEATURED_LISTING_WIDTH",      217);
    define("IMAGE_FEATURED_LISTING_HEIGHT",     123);
    # PROMOTION
    define("IMAGE_PROMOTION_FULL_WIDTH",        650);
    define("IMAGE_PROMOTION_FULL_HEIGHT",       367);
    define("IMAGE_PROMOTION_THUMB_WIDTH",       244);
    define("IMAGE_PROMOTION_THUMB_HEIGHT",      138);
    define("IMAGE_PROMOTION_THUMB_BIG_WIDTH",   263);
    define("IMAGE_PROMOTION_THUMB_BIG_HEIGHT",  148);
    define("IMAGE_FEATURED_PROMOTION_WIDTH",    660);
    define("IMAGE_FEATURED_PROMOTION_HEIGHT",   387);
    # EVENT
    define("IMAGE_EVENT_FULL_WIDTH",            650);
    define("IMAGE_EVENT_FULL_HEIGHT",           367);
    define("IMAGE_EVENT_THUMB_WIDTH",           300);
    define("IMAGE_EVENT_THUMB_HEIGHT",          170);
    define("IMAGE_FEATURED_EVENT_WIDTH",        244);
    define("IMAGE_FEATURED_EVENT_HEIGHT",       138);
    # CLASSIFIED
    define("IMAGE_CLASSIFIED_FULL_WIDTH",       650);
    define("IMAGE_CLASSIFIED_FULL_HEIGHT",      367);
    define("IMAGE_CLASSIFIED_THUMB_WIDTH",      300);
    define("IMAGE_CLASSIFIED_THUMB_HEIGHT",     170);
    define("IMAGE_FEATURED_CLASSIFIED_WIDTH",   217);
    define("IMAGE_FEATURED_CLASSIFIED_HEIGHT",  123);
    # ARTICLE
    define("IMAGE_ARTICLE_FULL_WIDTH",          650);
    define("IMAGE_ARTICLE_FULL_HEIGHT",         367);
    define("IMAGE_ARTICLE_THUMB_WIDTH",         300);
    define("IMAGE_ARTICLE_THUMB_HEIGHT",        170);
    define("IMAGE_FEATURED_ARTICLE_WIDTH",      244);
    define("IMAGE_FEATURED_ARTICLE_HEIGHT",     138);
    # BLOG
    define("IMAGE_BLOG_FULL_WIDTH",             650);
    define("IMAGE_BLOG_FULL_HEIGHT",            367);  
    define("IMAGE_BLOG_THUMB_WIDTH_FULL",       318);
    define("IMAGE_BLOG_THUMB_HEIGHT_FULL",      179);
    define("IMAGE_BLOG_THUMB_WIDTH",            152);
    define("IMAGE_BLOG_THUMB_HEIGHT",           86);
    # FRONT PAGE
    define("IMAGE_FRONT_LISTING_WIDTH",         244);
    define("IMAGE_FRONT_LISTING_HEIGHT",        138);
    define("IMAGE_FRONT_LISTING_SPECIAL_WIDTH", 487);
    define("IMAGE_FRONT_LISTING_SPECIAL_HEIGHT",274);
    define("IMAGE_FRONT_PROMOTION_WIDTH",       300);
    define("IMAGE_FRONT_PROMOTION_HEIGHT",      170);
    define("IMAGE_FRONT_EVENT_WIDTH",           217);
    define("IMAGE_FRONT_EVENT_HEIGHT",          123);
    define("IMAGE_FRONT_CLASSIFIED_WIDTH",      217);
    define("IMAGE_FRONT_CLASSIFIED_HEIGHT",     123);
    define("IMAGE_FRONT_ARTICLE_WIDTH",         217);
    define("IMAGE_FRONT_ARTICLE_HEIGHT",        123);
    # DESIGNATION
    define("IMAGE_DESIGNATION_WIDTH",           109);
    define("IMAGE_DESIGNATION_HEIGHT",          23);
    # INVOICE
    define("IMAGE_INVOICE_LOGO_WIDTH",          180);
    define("IMAGE_INVOICE_LOGO_HEIGHT",         70);
    # GALLERY
    define("IMAGE_GALLERY_THUMB_WIDTH",         130);
    define("IMAGE_GALLERY_THUMB_HEIGHT",        74);
    # HEADER
    define("IMAGE_HEADER_WIDTH",                980);
    define("IMAGE_HEADER_HEIGHT",               100);
    # SIDEBAR
    define("SIDEBAR_FEATURED_WIDTH",            73);
    define("SIDEBAR_FEATURED_HEIGHT",           41);
    # PROFILE
    define("PROFILE_IMAGE_WIDTH",               86);
    define("PROFILE_IMAGE_HEIGHT",              86);
    # PACKAGE
    define("IMAGE_PACKAGE_FULL_WIDTH",          260);
    define("IMAGE_PACKAGE_FULL_HEIGHT",         260);
    define("IMAGE_PACKAGE_THUMB_WIDTH",         200);
    define("IMAGE_PACKAGE_THUMB_HEIGHT",        150);
    # SLIDER
    define("IMAGE_SLIDER_WIDTH",                1080);
    define("IMAGE_SLIDER_HEIGHT",               611);
    
    # ----------------------------------------------------------------------------------------------------
	# FANCYBOX SIZES
	# ----------------------------------------------------------------------------------------------------

    # Upload image
    define("FANCYBOX_UPIMAGE_WIDTH",          785);
    define("FANCYBOX_UPIMAGE_HEIGHT",         465);
    
    # Navigation Configuration
    define("FANCYBOX_NAVIGATIONCONFIG_WIDTH",          1040);
    define("FANCYBOX_NAVIGATIONCONFIG_HEIGHT",         490);
    
    # Modules preview (members/sitemgr)
    define("FANCYBOX_ITEM_PREVIEW_WIDTH",     1110);
    define("FANCYBOX_ITEM_PREVIEW_HEIGHT",    440);
    
    # ----------------------------------------------------------------------------------------------------
	# GENERAL SETTINGS
	# ----------------------------------------------------------------------------------------------------

    # LISTING DETAIL CONTACT FORM
    define("LISTING_DETAIL_CONTACT", "off");
    
    # LISTING DETAIL VIDEO
    define("DETAIL_FORCE_VIDEORESIZE", true);
    
    # FACEBOOK COMMENTS WIDTH ON BLOG DETAIL
    define("FB_COMMENTWIDTH_BLOG", 670);
    
    # FACEBOOK COMMENTS WIDTH ON BLOG DETAIL
    define("FB_COMMENTWIDTH_LISTING", 285);
    
    # ADD CLEAR BOTH ON FEATURED ITEMS AND RESULTS
    define("ITEM_RESULTS_CLEAR", true);
    
    # HOME FEATURED REVIEW ON SIDEBAR
    define("FEATURE_REVIEW_SIDEBAR", false);
    
    # FEATURED LOCATIONS ON RESULTS
    define("FEATURED_LOCATIONS_SIDEBAR", true);
    
    # USE NEWEST SLIDER VERSION
    define("SLIDER_USE_NEWEST", false);
    
    # SLIDER - SUMMARY INFO MAX CHARS
    define("SLIDER_MAX_CHARS", 100);
    
    # GALLERY DETAIL - MAX IMAGES
    define("GALLERY_DETAIL_IMAGES", 4);
    
     # FEATURED LISTING - MAX ITEMS
    define("FEATURED_LISTING_MAXITEMS", 6);

    # FEATURED LISTING - SPECIAL ITEMS
    define("FEATURED_LISTING_MAXITEMS_SPECIAL", 6);
    
    # FEATURED EVENT - MAX ITEMS
    define("FEATURED_EVENT_MAXITEMS", 6);
    
    # FEATURED EVENT - SPECIAL ITEMS
    define("FEATURED_EVENT_MAXITEMS_SPECIAL", 6);
    
    # FEATURED CLASSIFIED - MAX ITEMS
    define("FEATURED_CLASSIFIED_MAXITEMS", 6);

    # FEATURED CLASSIFIED - SPECIAL ITEMS
    define("FEATURED_CLASSIFIED_MAXITEMS_SPECIAL", 6);
    
    # FEATURED ARTICLE - SPECIAL ITEMS
    define("FEATURED_ARTICLE_MAXITEMS_SPECIAL", 6);

    # FEATURED ARTICLE - MAX ITEMS
    define("FEATURED_ARTICLE_MAXITEMS", 6);
    
     # USE SUMMARY REVIEWS
    define("LISTING_REVIEW_SUMMARY", true);
    
    # FOOTER CONFIGURATION
    define("THEME_HAS_FOOTER", false);
       
    # SLIDER WITH PRICE
    define("SLIDER_HAS_PRICE", true);
    
    # USE GALLERY SLIDESHOW
    define("USE_GALLERY_PLUGIN", true);
    
    # Detail sidebar - extra fields
    define("EXTRA_FIELDS_SIDEBAR", true);
       
    # Order by dropdown - Add "Order by Price" 
    define("LISTING_ORDERBY_PRICE", true);
       
    # NEW STYLE FOR DEAL INDEX
    define("THEME_FEATURED_DEAL_BIG", true);
    
    # NAVIGATION CONFIGURATION POPUP STYLE
    define("NAVBAR_POPUP_BIG_STYLE", true);
    
    # MODULES CONFIGURATION
    define("CUSTOM_ARTICLE_FEATURE", "off");
    define("CUSTOM_CLASSIFIED_FEATURE", "off");
    define("CUSTOM_EVENT_FEATURE", "off");
    define("CUSTOM_PROMOTION_FEATURE", "off");

    define("FORCE_DISABLE_ARTICLE_FEATURE", "on");
    define("FORCE_DISABLE_CLASSIFIED_FEATURE", "on");
    define("FORCE_DISABLE_EVENT_FEATURE", "on");
    define("FORCE_DISABLE_PROMOTION_FEATURE", "on");

?>