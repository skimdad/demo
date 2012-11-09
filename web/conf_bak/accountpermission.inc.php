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
	# * FILE: /conf/accountpermission.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR PERMISSION SECTION AMOUNT
	# ----------------------------------------------------------------------------------------------------
	define("SITEMGR_PERMISSION_SECTION", 22);

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR PERMISSION ID
	# ----------------------------------------------------------------------------------------------------
	define("SITEMGR_PERMISSION_SITECONTENT", 1);
	define("SITEMGR_PERMISSION_EMAILNOTIFICATIONS", 2);
	define("SITEMGR_PERMISSION_SETTINGS", 4);
	define("SITEMGR_PERMISSION_GOOGLESETTINGS", 8);
	define("SITEMGR_PERMISSION_LOCATIONS", 16);
	define("SITEMGR_PERMISSION_CATEGORIES", 32);
	define("SITEMGR_PERMISSION_ACCOUNTS", 64);
	define("SITEMGR_PERMISSION_PAYMENT", 128);
	define("SITEMGR_PERMISSION_IMPORTEXPORT", 256);
	define("SITEMGR_PERMISSION_ARTICLES", 512);
	define("SITEMGR_PERMISSION_BANNERS", 1024);
	define("SITEMGR_PERMISSION_CLASSIFIEDS", 2048);
	define("SITEMGR_PERMISSION_EVENTS", 4096);
	define("SITEMGR_PERMISSION_GALLERIES", 8192);
	define("SITEMGR_PERMISSION_LISTINGS", 16384);
	define("SITEMGR_PERMISSION_SEOCENTER", 32768);
	define("SITEMGR_PERMISSION_REPORTS", 65536);
	define("SITEMGR_PERMISSION_LANGUAGECENTER", 131072);
	define("SITEMGR_PERMISSION_BLOG", 262144);
	define("SITEMGR_PERMISSION_DOMAIN", 524288);
	define("SITEMGR_PERMISSION_PACKAGES", 1048576);
	define("SITEMGR_PERMISSION_PLUGINS", 2097152);
	
	
	# ----------------------------------------------------------------------------------------------------
	# SITEMGR PERMISSION (ID,LABEL_SECTION,FOLDERS)
	# ----------------------------------------------------------------------------------------------------
	define("SITEMGR_PERMISSION_0", SITEMGR_PERMISSION_SITECONTENT.",".string_ucwords(system_showText(LANG_SITEMGR_MENU_SITECONTENT)).",content");
	define("SITEMGR_PERMISSION_1", SITEMGR_PERMISSION_EMAILNOTIFICATIONS.",".string_ucwords(system_showText(LANG_SITEMGR_MENU_EMAILNOTIF)).",emailnotifications");
	define("SITEMGR_PERMISSION_2", SITEMGR_PERMISSION_SETTINGS.",".string_ucwords(system_showText(LANG_SITEMGR_MENU_SETTINGS)).",prefs, googleprefs, emailnotifications");
	define("SITEMGR_PERMISSION_3", SITEMGR_PERMISSION_GOOGLESETTINGS.",".string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLESETTINGS)).",googleprefs");
	define("SITEMGR_PERMISSION_4", SITEMGR_PERMISSION_LOCATIONS.",".string_ucwords(system_showText(LANG_SITEMGR_SEOCENTER_LABEL_LOCATIONS)).",locations");
	define("SITEMGR_PERMISSION_5", SITEMGR_PERMISSION_CATEGORIES.",".string_ucwords(system_showText(LANG_SITEMGR_CATEGORIES)).",articlecategs,classifiedcategs,eventcategs,listingcategs");
	define("SITEMGR_PERMISSION_6", SITEMGR_PERMISSION_ACCOUNTS.",".string_ucwords(system_showText(LANG_SITEMGR_ACCOUNT_PLURAL)).",account,smaccount");
	define("SITEMGR_PERMISSION_7", SITEMGR_PERMISSION_PAYMENT.",".string_ucwords(system_showText(LANG_SITEMGR_REVENUECENTER)).",transactions,invoices,custominvoices,discountcode");
	define("SITEMGR_PERMISSION_8", SITEMGR_PERMISSION_IMPORTEXPORT.",".string_ucwords(system_showText(LANG_SITEMGR_DATA)).",import,export");
	define("SITEMGR_PERMISSION_9", SITEMGR_PERMISSION_ARTICLES.",".string_ucwords(system_showText(LANG_SITEMGR_ARTICLE_PLURAL)).",article,review");
	define("SITEMGR_PERMISSION_10", SITEMGR_PERMISSION_BANNERS.",".string_ucwords(system_showText(LANG_SITEMGR_BANNER_PLURAL)).",banner");
	define("SITEMGR_PERMISSION_11", SITEMGR_PERMISSION_CLASSIFIEDS.",".string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_CLASSIFIED)).",classified");
	define("SITEMGR_PERMISSION_12", SITEMGR_PERMISSION_EVENTS.",".string_ucwords(system_showText(LANG_SITEMGR_EVENT_PLURAL)).",event");
	define("SITEMGR_PERMISSION_13", SITEMGR_PERMISSION_GALLERIES.",".string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_GALLERY)).",gallery");
	define("SITEMGR_PERMISSION_14", SITEMGR_PERMISSION_LISTINGS.",".string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_LISTING)).",listing,deal,claim,listingtemplate,review");
	define("SITEMGR_PERMISSION_15", SITEMGR_PERMISSION_SEOCENTER.",".string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_SEOCENTER)).",seocenter");
	define("SITEMGR_PERMISSION_16", SITEMGR_PERMISSION_REPORTS.",".string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_REPORTS)).",reports");
	define("SITEMGR_PERMISSION_17", SITEMGR_PERMISSION_LANGUAGECENTER.",".string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_LANGUAGECENTER)).",langcenter");
	define("SITEMGR_PERMISSION_18", SITEMGR_PERMISSION_BLOG.",".string_ucwords(system_showText(LANG_SITEMGR_BLOG)).",blog,blogcategs");
	define("SITEMGR_PERMISSION_19", SITEMGR_PERMISSION_DOMAIN.",".string_ucwords(system_showText(LANG_SITEMGR_DOMAIN_PLURAL)).",domain");
	define("SITEMGR_PERMISSION_20", SITEMGR_PERMISSION_PACKAGES.",".string_ucwords(system_showText(LANG_SITEMGR_PACKAGE_PLURAL)).",package");
	define("SITEMGR_PERMISSION_21", SITEMGR_PERMISSION_PLUGINS.",".string_ucwords(system_showText(LANG_SITEMGR_PLUGINS)).",plugins");

?>