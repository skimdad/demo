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
# ****************************************************************************************************
# MODULES
# NOTE: Do not alter this area of the code manually.
# Any changes will require eDirectory to be activated again.
# P.S.: you can turn off it any time.
# ****************************************************************************************************
define(EVENT_FEATURE, "on");
define(BANNER_FEATURE, "on");
define(CLASSIFIED_FEATURE, "on");
define(ARTICLE_FEATURE, "on");
define(PROMOTION_FEATURE, "on");
define(BLOG_FEATURE, "on");
define(ZIPCODE_PROXIMITY, "on");
# ****************************************************************************************************
# FEATURES
# NOTE: Do not alter this area of the code manually.
# Any changes will require eDirectory to be activated again.
# P.S.: you can turn off it any time.
# ****************************************************************************************************
define(MODREWRITE_FEATURE, "on");
define(CUSTOM_INVOICE_FEATURE, "on");
define(CLAIM_FEATURE, "on");
define(LISTINGTEMPLATE_FEATURE, "on");
define(MOBILE_FEATURE, "on");
define(MULTILANGUAGE_FEATURE, "on");
define(MAINTENANCE_FEATURE, "on");
# ****************************************************************************************************
# EXTRA FEATURES
# NOTE: Do not alter this area of the code manually.
# Any changes will require eDirectory to be activated again.
# P.S.: you can turn off it any time.
# ****************************************************************************************************
// MODREWRITE_FEATURE must be on
define(SITEMAP_FEATURE, "on");
# ****************************************************************************************************
# CUSTOMIZATIONS
# NOTE: Do not alter this area of the code manually.
# Any changes will require eDirectory to be activated again.
# ****************************************************************************************************
define(BRANDED_PRINT, "off");
# ****************************************************************************************************
# PAYMENT SYSTEM FEATURE
# NOTE: Do not alter this area of the code manually.
# Any changes will require eDirectory to be activated again.
# P.S.: you can turn off it any time.
# ****************************************************************************************************
define(PAYMENTSYSTEM_FEATURE, "on");
# ----------------------------------------------------------------------------------------------------
# EDIRECTORY TITLE
# ----------------------------------------------------------------------------------------------------
define(EDIRECTORY_TITLE, "dealcloudusa.com");
# ----------------------------------------------------------------------------------------------------
# GEO IP CONFIGURATION
# ----------------------------------------------------------------------------------------------------
define(GEOIP_FEATURE, "on");
# ----------------------------------------------------------------------------------------------------
# SHOW BANNER MODE
# NOTE: This flag is only to the front view
# ----------------------------------------------------------------------------------------------------
define(SHOW_INACTIVE_BANNER, "off");
# ----------------------------------------------------------------------------------------------------
# REDIRECT USERS TO THEY LANGUAGE URL
# NOTE: This flag is only to the front and sponsor view when the user log in the site
# ----------------------------------------------------------------------------------------------------
define(REDIRECT_USER_BYLANG, "on");
# ----------------------------------------------------------------------------------------------------
# CACHE SETTINGS
# ----------------------------------------------------------------------------------------------------
//wtc
define(CACHE_FULL_FEATURE, "off"); 
define(CACHE_FULL_ZLIB_COMPRESSION_IF_AVAILABLE, "off"); 
//wtc end
define(CACHE_FULL_VERBOSE_MODE, "off"); 
define(CACHE_FULL_LOG_EXPIRATION_QUERIES, "off"); 
define(CACHE_FULL_INCLUDE_CACHE_COMMENT_AT_PAGE, "off");
define(CACHE_FULL_FOR_LOGGED_MEMBERS, "off");
define(CACHE_FULL_REMOVE_FILES_WHEN_DISABLED, "on");
# ----------------------------------------------------------------------------------------------------
# CACHE FULL FEATURE CONTENT SETTINGS
# ----------------------------------------------------------------------------------------------------
define(CACHE_FULL_ALWAYS_FRESH_FEATURED_LISTING, "on");
define(CACHE_FULL_ALWAYS_FRESH_FEATURED_DEAL, "on");
define(CACHE_FULL_ALWAYS_FRESH_FEATURED_CLASSIFIED, "on");
define(CACHE_FULL_ALWAYS_FRESH_FEATURED_EVENT, "on");
define(CACHE_FULL_ALWAYS_FRESH_FEATURED_ARTICLE, "on");
# ----------------------------------------------------------------------------------------------------
# CACHE PARTIAL SETTINGS
# ----------------------------------------------------------------------------------------------------
define(CACHE_PARTIAL_FEATURE, "off");
# ----------------------------------------------------------------------------------------------------
# FRONT SEARCH
# ----------------------------------------------------------------------------------------------------
define(SEARCH_FORCE_BOOLEANMODE, "on");
# ----------------------------------------------------------------------------------------------------
# GALLERY IMAGES
# - Turn on this constant to remove the crop for wide images.
# - Remember to turn off the constant RESIZE_IMAGES_UPGRADE in conf/constants.inc.php.
# - ATTENTION! The thumb preview in the upload window will not be shown when this constant is turned on.
# ----------------------------------------------------------------------------------------------------
define(GALLERY_FREE_RATIO, "off");
?>
