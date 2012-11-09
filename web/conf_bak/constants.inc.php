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
	# * FILE: /conf/constants.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# FLAGS - on/off
	# ----------------------------------------------------------------------------------------------------
	if (file_exists(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/conf/constants.inc.php")) {
		include(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/conf/constants.inc.php");
	} else {
		# ****************************************************************************************************
		# MODULES
		# NOTE: Do not alter this area of the code manually.
		# Any changes will require eDirectory to be activated again.
		# P.S.: you can turn off it any time.
		# ****************************************************************************************************
		define("EVENT_FEATURE",         "on");
		define("BANNER_FEATURE",        "on");
		define("CLASSIFIED_FEATURE",    "on");
		define("ARTICLE_FEATURE",       "on");
		define("PROMOTION_FEATURE",     "on");
		define("BLOG_FEATURE",          "on");
		define("ZIPCODE_PROXIMITY",     "on");

		# ****************************************************************************************************
		# FEATURES
		# NOTE: Do not alter this area of the code manually.
		# Any changes will require eDirectory to be activated again.
		# P.S.: you can turn off it any time.
		# ****************************************************************************************************
		define("MODREWRITE_FEATURE",        "on");
		define("CUSTOM_INVOICE_FEATURE",    "on");
		define("CLAIM_FEATURE",             "on");
		define("LISTINGTEMPLATE_FEATURE",   "on");
		define("MOBILE_FEATURE",            "on");
		define("MULTILANGUAGE_FEATURE",     "on");
		define("MAINTENANCE_FEATURE",       "on");

		# ****************************************************************************************************
		# EXTRA FEATURES
		# NOTE: Do not alter this area of the code manually.
		# Any changes will require eDirectory to be activated again.
		# P.S.: you can turn off it any time.
		# ****************************************************************************************************
		// MODREWRITE_FEATURE must be on
		define("SITEMAP_FEATURE", "on");

		# ****************************************************************************************************
		# CUSTOMIZATIONS
		# NOTE: Do not alter this area of the code manually.
		# Any changes will require eDirectory to be activated again.
		# ****************************************************************************************************
		define("BRANDED_PRINT", "off");

		# ****************************************************************************************************
		# PAYMENT SYSTEM FEATURE
		# NOTE: Do not alter this area of the code manually.
		# Any changes will require eDirectory to be activated again.
		# P.S.: you can turn off it any time.
		# ****************************************************************************************************
		define("PAYMENTSYSTEM_FEATURE", "on");
		
		# ----------------------------------------------------------------------------------------------------
		# EDIRECTORY TITLE
		# ----------------------------------------------------------------------------------------------------
		define("EDIRECTORY_TITLE", "dealcloudusa.com");
		
		# ----------------------------------------------------------------------------------------------------
		# GEO IP CONFIGURATION
		# ----------------------------------------------------------------------------------------------------
		define("GEOIP_FEATURE", "on");

		# ----------------------------------------------------------------------------------------------------
		# SHOW BANNER MODE
		# NOTE: This flag is only to the front view
		# ----------------------------------------------------------------------------------------------------
		define("SHOW_INACTIVE_BANNER", "off");
		
		# ----------------------------------------------------------------------------------------------------
		# REDIRECT USERS TO THEY LANGUAGE URL
		# NOTE: This flag is only to the front and sponsor view when the user log in the site
		# ----------------------------------------------------------------------------------------------------
		define("REDIRECT_USER_BYLANG", "on");
        
        # ----------------------------------------------------------------------------------------------------
        # CACHE SETTINGS
        # ----------------------------------------------------------------------------------------------------
        define("CACHE_FULL_FEATURE", "off"); 
        define("CACHE_FULL_ZLIB_COMPRESSION_IF_AVAILABLE", "off"); 
        define("CACHE_FULL_VERBOSE_MODE", "off"); 
        define("CACHE_FULL_LOG_EXPIRATION_QUERIES", "off"); 
        define("CACHE_FULL_INCLUDE_CACHE_COMMENT_AT_PAGE", "off");
        define("CACHE_FULL_FOR_LOGGED_MEMBERS", "off");
        define("CACHE_FULL_REMOVE_FILES_WHEN_DISABLED", "off");
        
        # ----------------------------------------------------------------------------------------------------
        # CACHE FULL FEATURE CONTENT SETTINGS
        # ----------------------------------------------------------------------------------------------------
        define("CACHE_FULL_ALWAYS_FRESH_FEATURED_LISTING", "on");
        define("CACHE_FULL_ALWAYS_FRESH_FEATURED_DEAL", "on");
        define("CACHE_FULL_ALWAYS_FRESH_FEATURED_CLASSIFIED", "on");
        define("CACHE_FULL_ALWAYS_FRESH_FEATURED_EVENT", "on");
        define("CACHE_FULL_ALWAYS_FRESH_FEATURED_ARTICLE", "on");
        
        # ----------------------------------------------------------------------------------------------------
        # CACHE PARTIAL SETTINGS
        # ----------------------------------------------------------------------------------------------------
        define("CACHE_PARTIAL_FEATURE", "on");
        
        # ----------------------------------------------------------------------------------------------------
        # FRONT SEARCH
        # ----------------------------------------------------------------------------------------------------
        define("SEARCH_FORCE_BOOLEANMODE", "on");
        
        # ----------------------------------------------------------------------------------------------------
        # GALLERY IMAGES
        # - Turn on this constant to remove the crop for wide images.
        # - Remember to turn off the constant RESIZE_IMAGES_UPGRADE in conf/constants.inc.php.
        # - ATTENTION! The thumb preview in the upload window will not be shown when this constant is turned on.
        # ----------------------------------------------------------------------------------------------------
        define("GALLERY_FREE_RATIO", "off");
	}
    
    define("SITMGR_FEEDBACK_EMAIL", "feedback@edirectory.com");

	if (file_exists(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/socialnetwork/socialnetwork.inc.php")) {
		include(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/socialnetwork/socialnetwork.inc.php");
	} else {
		define("SOCIALNETWORK_FEATURE", "on");
	}

	# ****************************************************************************************************
	# PASSWORD ENCRYPTION (DEFAULT ON)
	# ****************************************************************************************************
	define("PASSWORD_ENCRYPTION", "on");
	# ****************************************************************************************************
	# ANTIALIASED (DEFAULT OFF)
	# ****************************************************************************************************
	define("FORCE_ANTIALIASED_IMAGES", "off");
	# ****************************************************************************************************
	# SOCIAL BOOKMARKING (DEFAULT ON)
	# ****************************************************************************************************
	define("SOCIAL_BOOKMARKING", "on");
	# ****************************************************************************************************
	# RENAME ITEM LEVEL (DEFAULT ON)
	# ****************************************************************************************************
	define("ABLE_RENAME_LEVEL", "on");
	# ****************************************************************************************************
	# SUGARCRM FEATURE
	# ****************************************************************************************************
	if (DEMO_LIVE_MODE){ 
		define("SUGARCRM_FEATURE", "on"); //DON'T CHANGE THIS! Always enabled in demodirectory.com
	} else {
		define("SUGARCRM_FEATURE", "off");
	}
    # ****************************************************************************************************
	# GOOGLE MAPS KEY FOR DEMODIRECTORY.COM
	# ****************************************************************************************************
    define("GOOGLE_MAPS_APP_DEMO", "AIzaSyDM5pcvIu56ezCjKvI8VC0hR3BlduzBXYA");
    
	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY VERSION
	# NOTE: Do not alter this area of the code manually.
	# Any changes will require eDirectory to be activated again.
	# ----------------------------------------------------------------------------------------------------
	define("VERSION", "v.9.3.00");

	# ----------------------------------------------------------------------------------------------------
	# ITEM CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_FEATURE_FOLDER",		"listing");
	define("LISTING_FEATURE_NAME",			"listing");
	define("LISTING_FEATURE_NAME_PLURAL",	LISTING_FEATURE_NAME."s");
	define("LISTING_EDIRECTORY_ROOT",		EDIRECTORY_ROOT."/".LISTING_FEATURE_FOLDER);
	define("LISTING_DEFAULT_URL",			NON_SECURE_URL."/".LISTING_FEATURE_FOLDER);

	define("PROMOTION_FEATURE_FOLDER",		"deal");
	define("PROMOTION_FEATURE_NAME",		"deal");
	define("PROMOTION_FEATURE_NAME_PLURAL",	PROMOTION_FEATURE_NAME."s");
	define("PROMOTION_EDIRECTORY_ROOT",		EDIRECTORY_ROOT."/".PROMOTION_FEATURE_FOLDER);
	define("PROMOTION_DEFAULT_URL",			NON_SECURE_URL."/".PROMOTION_FEATURE_FOLDER);

	define("EVENT_FEATURE_FOLDER",			"event");
	define("EVENT_FEATURE_NAME",			"event");
	define("EVENT_FEATURE_NAME_PLURAL",		EVENT_FEATURE_NAME."s");
	define("EVENT_EDIRECTORY_ROOT",			EDIRECTORY_ROOT."/".EVENT_FEATURE_FOLDER);
	define("EVENT_DEFAULT_URL",				NON_SECURE_URL."/".EVENT_FEATURE_FOLDER);

	define("CLASSIFIED_FEATURE_FOLDER",		"classified");
	define("CLASSIFIED_FEATURE_NAME",		"classified");
	define("CLASSIFIED_FEATURE_NAME_PLURAL",CLASSIFIED_FEATURE_NAME."s");
	define("CLASSIFIED_EDIRECTORY_ROOT",	EDIRECTORY_ROOT."/".CLASSIFIED_FEATURE_FOLDER);
	define("CLASSIFIED_DEFAULT_URL",		NON_SECURE_URL."/".CLASSIFIED_FEATURE_FOLDER);

	define("ARTICLE_FEATURE_FOLDER",		"article");
	define("ARTICLE_FEATURE_NAME",			"article");
	define("ARTICLE_FEATURE_NAME_PLURAL",	ARTICLE_FEATURE_NAME."s");
	define("ARTICLE_EDIRECTORY_ROOT",		EDIRECTORY_ROOT."/".ARTICLE_FEATURE_FOLDER);
	define("ARTICLE_DEFAULT_URL",			NON_SECURE_URL."/".ARTICLE_FEATURE_FOLDER);

	define("BLOG_FEATURE_FOLDER",			"blog");
	define("BLOG_FEATURE_NAME",				"blog");
	define("BLOG_EDIRECTORY_ROOT",			EDIRECTORY_ROOT."/".BLOG_FEATURE_FOLDER);
	define("BLOG_DEFAULT_URL",				NON_SECURE_URL."/".BLOG_FEATURE_FOLDER);

	define("BANNER_FEATURE_FOLDER",			"banner");
	define("BANNER_FEATURE_NAME",			"banner");
	define("BANNER_FEATURE_NAME_PLURAL",	BANNER_FEATURE_NAME."s");

	define("SOCIALNETWORK_FEATURE_NAME",	"profile");
	define("SOCIALNETWORK_ROOT",			EDIRECTORY_ROOT."/".SOCIALNETWORK_FEATURE_NAME);
	define("SOCIALNETWORK_URL",				NON_SECURE_URL."/".SOCIALNETWORK_FEATURE_NAME);

	# ----------------------------------------------------------------------------------------------------
	# PACKAGE SETTINGS
	# ----------------------------------------------------------------------------------------------------
	define("MAX_PACKAGE_DOMAIN", 1);
	
	# ----------------------------------------------------------------------------------------------------
	# BLOG CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("BLOG_WITH_WORDPRESS", "off");
	
	# ----------------------------------------------------------------------------------------------------
	# BACKLINK CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("BACKLINK_FEATURE", "on");
	
	# ----------------------------------------------------------------------------------------------------
	# BACKLINK CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("MobileApp_FEATURE", "on");
	
	# ----------------------------------------------------------------------------------------------------
	# GOOGLE+ BUTTON FIX FOR INTERNET EXPLORER 8
	#
	# Turn on this flag if you want the google+ button work for IE8. Note that once this constant is on, all the detail pages will to not be validated at w3c.
	# ----------------------------------------------------------------------------------------------------
	define("GOOGLEPLUS_ON_IE8", "off");
	
	# ----------------------------------------------------------------------------------------------------
	# DISCOUNT CODE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("DISCOUNTCODE_LABEL", "promotional code"); // layout works for: "discount code" and "promotional code" (available to any label)

	# ----------------------------------------------------------------------------------------------------
	# ZIPCODE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("ZIPCODE_US", "on"); // on/off
	define("ZIPCODE_CA", "off"); // on/off
	define("ZIPCODE_UK", "off"); // on/off
	define("ZIPCODE_AU", "off"); // on/off

	# ----------------------------------------------------------------------------------------------------
	# FRIENDLY URL CONSTANTS
	# IMPORTANT - PAY ATTENTION
	# Any changes here need to be done in all .htaccess (modrewrite)
	# ----------------------------------------------------------------------------------------------------
	define("FRIENDLYURL_SEPARATOR",         "-");
	define("FRIENDLYURL_VALIDCHARS",        "a-zA-Z0-9");
	define("FRIENDLYURL_REGULAREXPRESSION", "/^[".FRIENDLYURL_VALIDCHARS.FRIENDLYURL_SEPARATOR."]{1,}/");

	# ----------------------------------------------------------------------------------------------------
	# DIRECTORY ALIAS DEFINITIONS
	# ----------------------------------------------------------------------------------------------------
	define("MEMBERS_ALIAS", "members");
	define("SITEMGR_ALIAS", "sitemgr");

	# ----------------------------------------------------------------------------------------------------
	# DIRECTORY PATH DEFINITIONS
	# ----------------------------------------------------------------------------------------------------
	define("MEMBERS_EDIRECTORY_ROOT",   EDIRECTORY_ROOT."/".MEMBERS_ALIAS);
	define("SM_EDIRECTORY_ROOT",        EDIRECTORY_ROOT."/".SITEMGR_ALIAS);

	# ----------------------------------------------------------------------------------------------------
	# SITE MANAGER CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("SM_LOGIN_PAGE",     DEFAULT_URL."/sitemgr/login.php");
	define("SM_LOGOUT_PAGE",    DEFAULT_URL."/sitemgr/logout.php");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("MEMBERS_LOGIN_PAGE",    DEFAULT_URL."/members/login.php");
	define("MEMBERS_LOGOUT_PAGE",   DEFAULT_URL."/members/logout.php");

	# ----------------------------------------------------------------------------------------------------
	# UPLOAD CONSTANTS
	# ----------------------------------------------------------------------------------------------------.
	define("UPLOAD_MAX_SIZE",               "1.5"); //in MB
	define("BANNER_UPLOAD_MAX_SIZE",        "400"); //in KB
	define("BANNER_UPLOAD_MAX_SIZE_INBYTE", "409600"); //in BYTES
	define("SLIDER_UPLOAD_MAX_SIZE_INBYTE", "409600"); //in BYTES

	# ----------------------------------------------------------------------------------------------------
	# IMAGE FOLDER CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("IMAGE_RELATIVE_PATH",   "/custom/domain_".SELECTED_DOMAIN_ID."/image_files");
	define("IMAGE_DIR",             EDIRECTORY_ROOT.IMAGE_RELATIVE_PATH);
	define("IMAGE_URL",             DEFAULT_URL.IMAGE_RELATIVE_PATH);

	define("PROFILE_IMAGE_RELATIVE_PATH",   "/custom/profile");
	define("PROFILE_IMAGE_DIR",             EDIRECTORY_ROOT.PROFILE_IMAGE_RELATIVE_PATH);
	define("PROFILE_IMAGE_URL",             DEFAULT_URL.PROFILE_IMAGE_RELATIVE_PATH);

	# ----------------------------------------------------------------------------------------------------
	# EXTRA FILES CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("EXTRAFILE_RELATIVE_PATH",   "/custom/domain_".SELECTED_DOMAIN_ID."/extra_files");
	define("EXTRAFILE_DIR",             EDIRECTORY_ROOT.EXTRAFILE_RELATIVE_PATH);
	define("EXTRAFILE_URL",             DEFAULT_URL.EXTRAFILE_RELATIVE_PATH);

	# ----------------------------------------------------------------------------------------------------
	# TEMPLATE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("TEMPLATE_LAYOUTIDS",        "0,1,2,3");
	define("TEMPLATE_LAYOUTNAMES",      "Default,Double Column - Content Left,Double Column - Content Right,Slim");
	define("TEMPLATE_LAYOUTSAMPLES",    "templatesample_default.gif,templatesample_1.gif,templatesample_2.gif,templatesample_3.gif");

	# ----------------------------------------------------------------------------------------------------
	# CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("CLASSES_DIR",   EDIRECTORY_ROOT."/classes");
	define("INCLUDES_DIR",  EDIRECTORY_ROOT."/includes");
	define("FUNCTIONS_DIR", EDIRECTORY_ROOT."/functions");

	# ----------------------------------------------------------------------------------------------------
	# EXPIRE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("DEFAULT_LISTING_DAYS_TO_EXPIRE",    60);
	define("DEFAULT_EVENT_DAYS_TO_EXPIRE",      60);
	define("DEFAULT_CLASSIFIED_DAYS_TO_EXPIRE", 10);
	define("DEFAULT_ARTICLE_DAYS_TO_EXPIRE",    60);

	# ----------------------------------------------------------------------------------------------------
	# LAST TWEETS COUNT
	# ----------------------------------------------------------------------------------------------------
	define("MAX_TWEETS_FRONT",      2);
	define("MAX_TWEETS_MEMBERS",    5);

	# ----------------------------------------------------------------------------------------------------
	# KEYWORD CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("MAX_KEYWORDS", 10);

	# ----------------------------------------------------------------------------------------------------
	# CATEGORY CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("MAX_CATEGORY_ALLOWED",              5); // Max 5 relationship (All modules except Listing)
	define("LISTING_MAX_CATEGORY_ALLOWED",      5); // Put the limit that you want of categories to listings
	define("SHOW_CATEGORY_COUNT",               "on");
	define("CATEGORY_LEVEL_AMOUNT",             5); // Max 5 Levels (All modules except Listing)
	define("LISTING_CATEGORY_LEVEL_AMOUNT",     5); // Put the max of levels that you want to categories of listings
	define("FEATURED_CATEGORY",                 "on");
	define("FEATUREDCATEGORY_LEVEL_AMOUNT",     CATEGORY_LEVEL_AMOUNT > LISTING_CATEGORY_LEVEL_AMOUNT ? CATEGORY_LEVEL_AMOUNT: LISTING_CATEGORY_LEVEL_AMOUNT); // Max Levels (All modules)
	define("MAX_SHOW_ALL_CATEGORIES",           1000); // Max of categories to show in all categories page
	define("MAX_DEALS_ALLOWED",              5); // Max 5 Deals per account
	# ----------------------------------------------------------------------------------------------------
	# IMAGE PARAMETERS (keep the ratio) AND OTHERS THEME CONFIGURATIONS
	# ----------------------------------------------------------------------------------------------------
	if (file_exists(EDIRECTORY_ROOT."/conf/constants_".EDIR_THEME.".inc.php")) {
        include(EDIRECTORY_ROOT."/conf/constants_".EDIR_THEME.".inc.php");
    } else {
        # LISTING
        define("IMAGE_LISTING_FULL_WIDTH",          318);
        define("IMAGE_LISTING_FULL_HEIGHT",         179);
        define("IMAGE_LISTING_THUMB_WIDTH",         152);
        define("IMAGE_LISTING_THUMB_HEIGHT",        86);
        define("IMAGE_FEATURED_LISTING_WIDTH",      152);
        define("IMAGE_FEATURED_LISTING_HEIGHT",     86);
        # PROMOTION
        define("IMAGE_PROMOTION_FULL_WIDTH",        318);
        define("IMAGE_PROMOTION_FULL_HEIGHT",       179);
        define("IMAGE_PROMOTION_THUMB_WIDTH",       152);
        define("IMAGE_PROMOTION_THUMB_HEIGHT",      86);
        define("IMAGE_PROMOTION_THUMB_BIG_WIDTH",   152);
        define("IMAGE_PROMOTION_THUMB_BIG_HEIGHT",  86);
        define("IMAGE_FEATURED_PROMOTION_WIDTH",    362);
        define("IMAGE_FEATURED_PROMOTION_HEIGHT",   204);
        # EVENT
        define("IMAGE_EVENT_FULL_WIDTH",            318);
        define("IMAGE_EVENT_FULL_HEIGHT",           179);
        define("IMAGE_EVENT_THUMB_WIDTH",           152);
        define("IMAGE_EVENT_THUMB_HEIGHT",          86);
        define("IMAGE_FEATURED_EVENT_WIDTH",        152);
        define("IMAGE_FEATURED_EVENT_HEIGHT",       86);
        # CLASSIFIED
        define("IMAGE_CLASSIFIED_FULL_WIDTH",       318);
        define("IMAGE_CLASSIFIED_FULL_HEIGHT",      179);
        define("IMAGE_CLASSIFIED_THUMB_WIDTH",      152);
        define("IMAGE_CLASSIFIED_THUMB_HEIGHT",     86);
        define("IMAGE_FEATURED_CLASSIFIED_WIDTH",   152);
        define("IMAGE_FEATURED_CLASSIFIED_HEIGHT",  86);
        # ARTICLE
        define("IMAGE_ARTICLE_FULL_WIDTH",          318);
        define("IMAGE_ARTICLE_FULL_HEIGHT",         179);
        define("IMAGE_ARTICLE_THUMB_WIDTH",         152);
        define("IMAGE_ARTICLE_THUMB_HEIGHT",        86);
        define("IMAGE_FEATURED_ARTICLE_WIDTH",      152);
        define("IMAGE_FEATURED_ARTICLE_HEIGHT",     86);
        # BLOG
        define("IMAGE_BLOG_FULL_WIDTH",             318);
        define("IMAGE_BLOG_FULL_HEIGHT",            179);
        define("IMAGE_BLOG_THUMB_WIDTH_FULL",       318);
        define("IMAGE_BLOG_THUMB_HEIGHT_FULL",      179);
        define("IMAGE_BLOG_THUMB_WIDTH",            152);
        define("IMAGE_BLOG_THUMB_HEIGHT",           86);
        # FRONT PAGE
        define("IMAGE_FRONT_LISTING_WIDTH",         152);
        define("IMAGE_FRONT_LISTING_HEIGHT",        86);
        define("IMAGE_FRONT_PROMOTION_WIDTH",       152);
        define("IMAGE_FRONT_PROMOTION_HEIGHT",      86);
        define("IMAGE_FRONT_EVENT_WIDTH",           152);
        define("IMAGE_FRONT_EVENT_HEIGHT",          86);
        define("IMAGE_FRONT_CLASSIFIED_WIDTH",      152);
        define("IMAGE_FRONT_CLASSIFIED_HEIGHT",     86);
        define("IMAGE_FRONT_ARTICLE_WIDTH",         152);
        define("IMAGE_FRONT_ARTICLE_HEIGHT",        86);
        # DESIGNATION
        define("IMAGE_DESIGNATION_WIDTH",           109);
        define("IMAGE_DESIGNATION_HEIGHT",          23);
        # INVOICE
        define("IMAGE_INVOICE_LOGO_WIDTH",          180);
        define("IMAGE_INVOICE_LOGO_HEIGHT",         70);
        # GALLERY
        define("IMAGE_GALLERY_THUMB_WIDTH",         92);
        define("IMAGE_GALLERY_THUMB_HEIGHT",        52);
        # HEADER
        define("IMAGE_HEADER_WIDTH",                980);
        define("IMAGE_HEADER_HEIGHT",               100);
        # SIDEBAR
        define("SIDEBAR_FEATURED_WIDTH",            73);
        define("SIDEBAR_FEATURED_HEIGHT",           41);
        # PROFILE
        define("PROFILE_IMAGE_WIDTH",               50);
        define("PROFILE_IMAGE_HEIGHT",              50);
        # PACKAGE
        define("IMAGE_PACKAGE_FULL_WIDTH",          260);
        define("IMAGE_PACKAGE_FULL_HEIGHT",         260);
        define("IMAGE_PACKAGE_THUMB_WIDTH",         200);
        define("IMAGE_PACKAGE_THUMB_HEIGHT",        150);
        # SLIDER
        define("IMAGE_SLIDER_WIDTH",                440);
        define("IMAGE_SLIDER_HEIGHT",               248);
        
        # ----------------------------------------------------------------------------------------------------
        # GENERAL SETTINGS
        # ----------------------------------------------------------------------------------------------------
        
        # LISTING DETAIL CONTACT FORM
        define("LISTING_DETAIL_CONTACT", "on");
        
        # LISTING DETAIL VIDEO
        define("DETAIL_FORCE_VIDEORESIZE", false);
        
        # FACEBOOK COMMENTS WIDTH ON BLOG DETAIL
        define("FB_COMMENTWIDTH_BLOG", 680);
        
        # FACEBOOK COMMENTS WIDTH ON BLOG DETAIL
        define("FB_COMMENTWIDTH_LISTING", 245);
        
        # ADD CLEAR BOTH ON FEATURED ITEMS AND RESULTS
        define("ITEM_RESULTS_CLEAR", false);
        
        # HOME FEATURED REVIEW ON SIDEBAR
        define("FEATURE_REVIEW_SIDEBAR", true);
        
        # FEATURED LOCATIONS ON RESULTS
        define("FEATURED_LOCATIONS_SIDEBAR", false);
        
        # USE NEWEST SLIDER VERSION
        define("SLIDER_USE_NEWEST", true);
        
        # SLIDER - SUMMARY INFO MAX CHARS
        define("SLIDER_MAX_CHARS", 250);
        
        # GALLERY DETAIL - MAX IMAGES
        define("GALLERY_DETAIL_IMAGES", 3);
        
        # FEATURED LISTING - MAX ITEMS
        define("FEATURED_LISTING_MAXITEMS", 10);
        
        # FEATURED LISTING - SPECIAL ITEMS
        define("FEATURED_LISTING_MAXITEMS_SPECIAL", 24);
        
        # FEATURED EVENT - MAX ITEMS
        define("FEATURED_EVENT_MAXITEMS", 10);
        
        # FEATURED EVENT - SPECIAL ITEMS
        define("FEATURED_EVENT_MAXITEMS_SPECIAL", 4);
        
        # FEATURED CLASSIFIED - MAX ITEMS
        define("FEATURED_CLASSIFIED_MAXITEMS", 10);
        
        # FEATURED CLASSIFIED - SPECIAL ITEMS
        define("FEATURED_CLASSIFIED_MAXITEMS_SPECIAL", 4);
        
        # FEATURED ARTICLE - SPECIAL ITEMS
        define("FEATURED_ARTICLE_MAXITEMS_SPECIAL", 10);

        # FEATURED ARTICLE - MAX ITEMS
        define("FEATURED_ARTICLE_MAXITEMS", 4);
        
        # USE SUMMARY REVIEWS
        define("LISTING_REVIEW_SUMMARY", false);
        
        # FOOTER CONFIGURATION
        define("THEME_HAS_FOOTER", true);
               
        # SLIDER WITH PRICE
        define("SLIDER_HAS_PRICE", false);
        
        # USE GALLERY SLIDESHOW
        define("USE_GALLERY_PLUGIN", false);
        
        # Detail sidebar - extra fields
        define("EXTRA_FIELDS_SIDEBAR", false);
        
        # Order by dropdown - Add "Order by Price" 
        define("LISTING_ORDERBY_PRICE", false);
               
        # NEW STYLE FOR DEAL INDEX
        define("THEME_FEATURED_DEAL_BIG", false);
        
        # NAVIGATION CONFIGURATION POPUP STYLE
        define("NAVBAR_POPUP_BIG_STYLE", false);
    }
    
     # Use div to align content on members
    define("MEMBERS_ALIGN_CENTER", (EDIR_THEME_MEMBERS == "realestate" ? true : false));
	
	# RESIZE IMAGES AFTER UPGRADE
	# on - all images will be stretched to fit the new dimensions
	# off - all images will keep the same size, but the layout can be affected
	define("RESIZE_IMAGES_UPGRADE", "on");
	
	# TURN ON THIS CONSTANT FOR UPGRADED PROJECTS. IT WILL FIX THE BADGES IMAGES
	define("IS_UPGRADE", "off");
	
	if(strpos($_SERVER["PHP_SELF"],"members") === false){
		define("IMAGE_HEADER_PATH",   "/custom/domain_".SELECTED_DOMAIN_ID."/content_files/img_logo.png");
	}else{
		define("IMAGE_HEADER_PATH",   "/custom/domain_".URL_DOMAIN_ID."/content_files/img_logo.png");
	}
	
	# ----------------------------------------------------------------------------------------------------
	# NOIMAGE
	# ----------------------------------------------------------------------------------------------------
	define("NOIMAGE_PATH",      "/custom/domain_".SELECTED_DOMAIN_ID."/content_files");
	define("NOIMAGE_NAME",      "noimage");
	define("NOIMAGE_IMGEXT",    "gif");
	define("NOIMAGE_CSSEXT",    "css");

	# ----------------------------------------------------------------------------------------------------
	# MAX GALLERY ALLOWED
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_MAX_GALLERY",    1);
	define("EVENT_MAX_GALLERY",      1);
	define("CLASSIFIED_MAX_GALLERY", 1);
	define("ARTICLE_MAX_GALLERY",    1);
    
    # ----------------------------------------------------------------------------------------------------
	# FANCYBOX SIZES
	# ----------------------------------------------------------------------------------------------------
    # Upload image
    if (!defined("FANCYBOX_UPIMAGE_WIDTH") && !defined("FANCYBOX_UPIMAGE_HEIGHT")){
        define("FANCYBOX_UPIMAGE_WIDTH",          725);
        define("FANCYBOX_UPIMAGE_HEIGHT",         445);
    }
    
    # Navigation Configuration
    if (!defined("FANCYBOX_NAVIGATIONCONFIG_WIDTH") && !defined("FANCYBOX_NAVIGATIONCONFIG_HEIGHT")){
        define("FANCYBOX_NAVIGATIONCONFIG_WIDTH",          1020);
        define("FANCYBOX_NAVIGATIONCONFIG_HEIGHT",         490);
    }

    # Delete image
    define("FANCYBOX_DELIMAGE_WIDTH",         300);
    define("FANCYBOX_DELIMAGE_HEIGHT",        200);

    # Login box
    define("FANCYBOX_LOGIN_WIDTH",            250);
    define("FANCYBOX_LOGIN_HEIGHT",           342);

    # Email to friend / send email box
    define("FANCYBOX_TOFRIEND_WIDTH",         580);
    define("FANCYBOX_TOFRIEND_HEIGHT",        520);

    # Front gallery box
    define("FANCYBOX_GALLERY_WIDTH",          600);
    define("FANCYBOX_GALLERY_HEIGHT",         400);

    # Send to phone and Click to call boxes
    define("FANCYBOX_TWILIO_WIDTH",           330);
    define("FANCYBOX_TWILIO_HEIGHT",          335);

    # Deal redeem box
    define("FANCYBOX_DEAL_WIDTH",             650);
    define("FANCYBOX_DEAL_HEIGHT",            400);

    # Review box
    define("FANCYBOX_REVIEW_WIDTH",           600);
    define("FANCYBOX_REVIEW_HEIGHT",          600);
    
    # Modules preview (members/sitemgr)
    if (!defined("FANCYBOX_ITEM_PREVIEW_WIDTH") && !defined("FANCYBOX_ITEM_PREVIEW_HEIGHT")){
        define("FANCYBOX_ITEM_PREVIEW_WIDTH",     990);
        define("FANCYBOX_ITEM_PREVIEW_HEIGHT",    440);
    }

	# ----------------------------------------------------------------------------------------------------
	# REPORTS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_REPORT_SUMMARY_VIEW",       1);
	define("LISTING_REPORT_DETAIL_VIEW",        2);
	define("LISTING_REPORT_CLICK_THRU",         3);
	define("LISTING_REPORT_EMAIL_SENT",         4);
	define("LISTING_REPORT_PHONE_VIEW",         5);
	define("LISTING_REPORT_FAX_VIEW",           6);
	define("LISTING_REPORT_SMS",                7);
	define("LISTING_REPORT_CLICKTOCALL",        8);
	define("BANNER_REPORT_CLICK_THRU",          1);
	define("BANNER_REPORT_VIEW",                2);
	define("ARTICLE_REPORT_SUMMARY_VIEW",       1);
	define("ARTICLE_REPORT_DETAIL_VIEW",        2);
	define("EVENT_REPORT_SUMMARY_VIEW",         1);
	define("EVENT_REPORT_DETAIL_VIEW",          2);
	define("CLASSIFIED_REPORT_SUMMARY_VIEW",    1);
	define("CLASSIFIED_REPORT_DETAIL_VIEW",     2);
	define("POST_REPORT_SUMMARY_VIEW",          1);
	define("POST_REPORT_DETAIL_VIEW",			2);
	define("REPORT_DAYS_SHOW",                  20);

	# ----------------------------------------------------------------------------------------------------
	# BANNER CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("BANNER_EXPIRATION_IMPRESSION",   1);
	define("BANNER_EXPIRATION_RENEWAL_DATE", 2);

	# ----------------------------------------------------------------------------------------------------
	# USER ATRIBUTES
	# ----------------------------------------------------------------------------------------------------
	define("USERNAME_MAX_LEN", 80); // don't forget to verify the field in DB
	define("USERNAME_MIN_LEN",  4);
	define("PASSWORD_MAX_LEN", 50); // don't forget to verify the field in DB
	define("PASSWORD_MIN_LEN",  4);

	# ----------------------------------------------------------------------------------------------------
	# EMAIL NOTIFICATIONS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("RENEWAL_30",                            1);
	define("RENEWAL_15",                            2);
	define("RENEWAL_7",                             3);
	define("RENEWAL_1",                             4);
	define("SYSTEM_SPONSOR_ACCOUNT_CREATE",         5);
	define("SYSTEM_SPONSOR_ACCOUNT_UPDATE",         6);
	define("SYSTEM_VISITOR_ACCOUNT_CREATE",         7);
	define("SYSTEM_VISITOR_ACCOUNT_UPDATE",         8);
	define("SYSTEM_FORGOTTEN_PASS",                 9);
	define("SYSTEM_NEW_LISTING",                    10);
	define("SYSTEM_NEW_EVENT",                      11);
	define("SYSTEM_NEW_BANNER",                     12);
	define("SYSTEM_NEW_CLASSIFIED",                 13);
	define("SYSTEM_NEW_ARTICLE",                    14);
	define("SYSTEM_NEW_CUSTOMINVOICE",              15);
	define("SYSTEM_ACTIVE_LISTING",                 16);
	define("SYSTEM_ACTIVE_EVENT",                   17);
	define("SYSTEM_ACTIVE_BANNER",                  18);
	define("SYSTEM_ACTIVE_CLASSIFIED",              19);
	define("SYSTEM_ACTIVE_ARTICLE",                 20);
	define("SYSTEM_EMAIL_TOFRIEND",                 21);
	define("SYSTEM_LISTING_SIGNUP",                 22);
	define("SYSTEM_EVENT_SIGNUP",                   23);
	define("SYSTEM_BANNER_SIGNUP",                  24);
	define("SYSTEM_CLASSIFIED_SIGNUP",              25);
	define("SYSTEM_ARTICLE_SIGNUP",                 26);
	define("SYSTEM_CLAIM_SIGNUP",                   27);
	define("SYSTEM_CLAIM_AUTOMATICALLY_APPROVED",   28);
	define("SYSTEM_CLAIM_APPROVED",                 29);
	define("SYSTEM_CLAIM_DENIED",                   30);
	define("SYSTEM_APPROVE_REPLY",                  31);
	define("SYSTEM_APPROVE_REVIEW",                 32);
	define("SYSTEM_NEW_REVIEW",                     33);
	define("SYSTEM_INVOICE_NOTIFICATION",           34);
	define("SYSTEM_NEW_PROFILE",					35);
	define("SYSTEM_EMAIL_TRAFFIC",					36);

	# ----------------------------------------------------------------------------------------------------
	# EXPORTS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_LIMIT",             10000);
	define("ACCOUNT_LIMIT",             10000);
	define("CLASSIFIED_LIMIT",          10000);
	define("EVENT_LIMIT",               10000);
	define("ARTICLE_LIMIT",             10000);
	define("BANNER_LIMIT",              10000);
	define("INVOICE_LIMIT",             10000);
	define("PAYMENT_LIMIT",             10000);
	define("DEFAULT_EXPORT_EXTENSION",  "xls");
	define("DEFAULT_EXPORT_ZIPPED",     "y");

	# ----------------------------------------------------------------------------------------------------
	# CUSTOM INVOICE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("CUSTOM_INVOICE_ITEMS_NUMBER", 10);

	# ----------------------------------------------------------------------------------------------------
	# RSS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("RSS_LOGO_WIDTH",    300);
	define("RSS_LOGO_HEIGHT",   130);
	define("RSS_LOGO_PATH",     "/custom/domain_".SELECTED_DOMAIN_ID."/content_files/img_logo_rss.png");

	# ----------------------------------------------------------------------------------------------------
	# MOBILE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("MOBILE_LOGO_WIDTH",     200);
	define("MOBILE_LOGO_HEIGHT",    85);
	define("MOBILE_LOGO_PATH",      "/custom/domain_".SELECTED_DOMAIN_ID."/content_files/img_logo_mobile.png");

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("SITEMGR_LOGO_WIDTH",    253);
	define("SITEMGR_LOGO_HEIGHT",   97);
	define("SITEMGR_LOGO_PATH",     "/custom/domain_".SELECTED_DOMAIN_ID."/content_files/img_logo_sitemgr.png");

	# ----------------------------------------------------------------------------------------------------
	# IMPORT FOLDER
	# ----------------------------------------------------------------------------------------------------
	define("IMPORT_FOLDER_RELATIVE_PATH",   "/custom/domain_".SELECTED_DOMAIN_ID."/import_files");
	define("IMPORT_FOLDER",                 EDIRECTORY_ROOT.IMPORT_FOLDER_RELATIVE_PATH);
	define("IMPORT_URL",                    DEFAULT_URL.IMPORT_FOLDER_RELATIVE_PATH);
	
	# ----------------------------------------------------------------------------------------------------
	# IMPORT SETTINGS
	# ----------------------------------------------------------------------------------------------------
	define("MAX_MB_FILE_SIZE_ALLOWED",  5);
	define("MAX_IMPORT_LINES",          100000);
	
	# ----------------------------------------------------------------------------------------------------
	# GOOGLE SETTINGS CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("GOOGLE_ADS_SETTING",                1);
	define("GOOGLE_MAPS_SETTING",               2);
	define("GOOGLE_ANALYTICS_SETTING",          3);
	define("GOOGLE_ANALYTICS_FRONT_SETTING",    4);
	define("GOOGLE_ANALYTICS_MEMBERS_SETTING",  5);
	define("GOOGLE_ANALYTICS_SITEMGR_SETTING",  6);
	define("GOOGLE_ADS_CHANNEL_SETTING",        7);
	define("GOOGLE_ADS_STATUS",                 8);
	define("GOOGLE_MAPS_STATUS",                9);
	define("GOOGLE_ADS_TYPE",                   10);
	define("GOOGLE_MAPS_IMAGE_WIDTH",           50);
	define("GOOGLE_MAPS_IMAGE_HEIGHT",          50);
	define("GOOGLE_MAPS_DEBUG",                 "off");

	# ----------------------------------------------------------------------------------------------------
	# LOCATION CONSTANTS
	# ----------------------------------------------------------------------------------------------------
    define("LOCATION1_LABEL",   "country");
    define("LOCATION2_LABEL",   "region");
    define("LOCATION3_LABEL",   "state");
    define("LOCATION4_LABEL",   "city");
    define("LOCATION5_LABEL",   "neighborhood");

    define("FEATURED_LOCATION1",            "on");
	define("FEATURED_LOCATION2",            "on");
	define("FEATURED_LOCATION3",            "on");
	define("FEATURED_LOCATION4",            "on");
	define("FEATURED_LOCATION5",            "on");
	define("FEATURED_LOCATION",             "on");
	define("FEATUREDLOCATION_LEVEL_AMOUNT", 5);
       
	# ----------------------------------------------------------------------------------------------------
	# AUTOCOMPLETE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("AUTOCOMPLETE_MAXITENS",     25);
	define("AUTOCOMPLETE_MINCHARS",     3);
	define("AUTOCOMPLETE_KEYWORD_URL",  DEFAULT_URL.'/autocomplete_keyword.php');
	define("AUTOCOMPLETE_LOCATION_URL", DEFAULT_URL.'/autocomplete_location.php');

	# ----------------------------------------------------------------------------------------------------
	# URL PROTOCOL
	# ----------------------------------------------------------------------------------------------------
	define("URL_PROTOCOL", "http,https,ftp");

	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY CHARSET
	# ----------------------------------------------------------------------------------------------------
	define("EDIR_CHARSET", "UTF-8");

	# ----------------------------------------------------------------------------------------------------
	# SITEMAP CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("SITEMAP_MAXURL",                "20000");
	define("SITEMAP_HASLISTINGLOCATION",    "y");
	define("SITEMAP_HASLISTINGCATEGORY",    "y");
	define("SITEMAP_HASLISTINGDETAIL",      "y");
	define("SITEMAP_HASPROMOTIONLOCATION",  "y");
	define("SITEMAP_HASPROMOTIONCATEGORY",  "y");
	define("SITEMAP_HASEVENTLOCATION",      "y");
	define("SITEMAP_HASEVENTCATEGORY",      "y");
	define("SITEMAP_HASEVENTDETAIL",        "y");
	define("SITEMAP_HASCLASSIFIEDLOCATION", "y");
	define("SITEMAP_HASCLASSIFIEDCATEGORY", "y");
	define("SITEMAP_HASCLASSIFIEDDETAIL",   "y");
	define("SITEMAP_HASARTICLECATEGORY",    "y");
	define("SITEMAP_HASARTICLEDETAIL",      "y");
	define("SITEMAP_HASARTICLENEWS",        "y");
	define("SITEMAP_HASBLOGCATEGORY",       "y");
	define("SITEMAP_HASBLOGDETAIL",         "y");
	define("SITEMAP_HASCONTENT",            "y");

	# ----------------------------------------------------------------------------------------------------
	# FAIL LOGIN
	# ----------------------------------------------------------------------------------------------------
	define("FAILLOGIN_MAXFAIL",     "4"); // FAILLOGIN_MAXFAIL + 1 = block account
	define("FAILLOGIN_TIMEBLOCK",   "60"); // minutes

	# ----------------------------------------------------------------------------------------------------
	# PASSWORD STRENGTH
	# ----------------------------------------------------------------------------------------------------
	define("PASSWORD_STRENGTH", "off"); //for members accts.

	# ----------------------------------------------------------------------------------------------------
	# BLOG CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define("BLOG_MAX_CHARACTERS",           700);
	define("BLOG_CLASSES_DIR",              BLOG_EDIRECTORY_ROOT."/classes");
	define("BLOG_INCLUDES_DIR",             BLOG_EDIRECTORY_ROOT."/includes");
	define("BLOG_LANG_DIR",                 BLOG_EDIRECTORY_ROOT."/lang");
	define("BLOG_FUNCTIONS_DIR",            BLOG_EDIRECTORY_ROOT."/functions");
	define("BLOG_AUTOCOMPLETE_KEYWORD_URL", BLOG_DEFAULT_URL.'/autocomplete_keyword.php');

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR / MEMBERS SEARCH
	# ----------------------------------------------------------------------------------------------------
	define("RESULTS_PER_PAGE", 50);

	# ----------------------------------------------------------------------------------------------------
	# CUSTOM FOLDER PERMISSION
	# ----------------------------------------------------------------------------------------------------
	define("PERMISSION_CUSTOM_FOLDER", "0755");

	# ----------------------------------------------------------------------------------------------------
	# LOADING WEB PERFORMANCE
    # Some server don't support gzip
	# ----------------------------------------------------------------------------------------------------
	define("WEBLOADING_PERFORMANCE", "on");
	
	# ----------------------------------------------------------------------------------------------------
	# Settings with path of files to plugins/api
	# ----------------------------------------------------------------------------------------------------
	define("SUGAR_FILE_PATH",       EDIRECTORY_ROOT."/custom/sugar_files");
	define("WORDPRESS_FILE_PATH",   EDIRECTORY_ROOT."/custom/wordpress_files");
	define("PLUGIN_FILE_PATH",      EDIRECTORY_ROOT."/custom/plugin");
    define("EDIRAPI_FILE_PATH",     EDIRECTORY_ROOT."/custom/api_files");
	
	# ----------------------------------------------------------------------------------------------------
	# Settings to Slider
	# ----------------------------------------------------------------------------------------------------
	define("TOTAL_SLIDER_ITEMS",    10);
	
	# ----------------------------------------------------------------------------------------------------
	# Settings to Twilio
	# ----------------------------------------------------------------------------------------------------
	define("TWILIO_MAX_CHARACTERS", 160);
	define("TWILIO_API_VERSION",    "2010-04-01");
	
	# ----------------------------------------------------------------------------------------------------
	# Settings to Twitter
	# ----------------------------------------------------------------------------------------------------
	define("TWITTER_CACHE_TIME", 300); //cache time in seconds
	
	# ----------------------------------------------------------------------------------------------------
	# Scalability info - suggestions to turn on the module scalability when the total items is higher than the following numbers
	# ----------------------------------------------------------------------------------------------------
	define("LISTING_SCALABILITY_NUMBER",            100000);
	define("PROMOTION_SCALABILITY_NUMBER",          50000);
	define("EVENT_SCALABILITY_NUMBER",              100000);
	define("BANNER_SCALABILITY_NUMBER",             50000);
	define("CLASSIFIED_SCALABILITY_NUMBER",         100000);
	define("ARTICLE_SCALABILITY_NUMBER",            100000);
	define("LISTINGCATEGORY_SCALABILITY_NUMBER",    20);
	define("EVENTCATEGORY_SCALABILITY_NUMBER",      20);
	define("CLASSIFIEDCATEGORY_SCALABILITY_NUMBER", 20);
	define("ARTICLECATEGORY_SCALABILITY_NUMBER",    20);
    
    # ----------------------------------------------------------------------------------------------------
    # CACHE SETTINGS
    # ----------------------------------------------------------------------------------------------------
    define("CACHE_FULL_DIR", EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/cache_full");
    define("CACHE_FULL_FILE_NAME", md5((($_SERVER["REQUEST_URI"] == "/") ? "/index.php" : $_SERVER["REQUEST_URI"])).".html");
    define("CACHE_FULL_FILE_PATH", CACHE_FULL_DIR."/".CACHE_FULL_FILE_NAME);
    define("CACHE_FULL_UPDATETOKEN", EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/cacheUpdateToken/cacheUpdateToken");
    define("CACHE_FULL_VERBOSE_FILE", EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/cacheVerbose/cacheVerbose"); 
    define("CACHE_FULL_LOG_EXPIRATION_QUERIES_FILE", EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/cacheExpirationQueries/cacheExpirationQueries");
    
    # ----------------------------------------------------------------------------------------------------
    # CACHE PARTIAL SETTINGS
    # ----------------------------------------------------------------------------------------------------
    define("CACHE_PARTIAL_DIR", EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/cache_partial/");
    
    # ----------------------------------------------------------------------------------------------------
    # EDIRECTORY API
    # ----------------------------------------------------------------------------------------------------
    define("API_USE_JSON", false);
    
    # ----------------------------------------------------------------------------------------------------
    # SAVE JPEG IMAGES AS PNG
    # ----------------------------------------------------------------------------------------------------
    define("IMAGE_SAVE_JPG_AS_PNG", true);
?>
