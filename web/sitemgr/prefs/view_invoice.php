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
	# * FILE: /sitemgr/prefs/view_invoice.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# * CODE
	# ----------------------------------------------------------------------------------------------------  
	$arrayContact = array("first_name"=>system_showText(LANG_SITEMGR_LABEL_FIRSTNAME),"last_name"=>system_showText(LANG_SITEMGR_LABEL_LASTNAME),"company"=>system_showText(LANG_SITEMGR_LABEL_COMPANY),"address"=>system_showText(LANG_SITEMGR_LABEL_ADDRESS),"city"=>system_showText(LANG_SITEMGR_LABEL_CITY),"state"=>system_showText(LANG_SITEMGR_LABEL_STATE),"zip"=>system_showText(ZIPCODE_LABEL));
	$contactObj = new Contact($arrayContact);
	$arrayInvoice = array("date"=>date("Y-m-d"),"expire_date"=>date("Y-m-d",mktime(0,0,0,date("m"),date("d"),(date("Y")+1))),"id"=>"0");
	$invoiceObj = new Invoice($arrayInvoice);
	$item_example = true;
	include(INCLUDES_DIR."/views/view_invoice.php");

?>
