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
	# * FILE: /sitemgr/review/approve.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	extract($_GET);
	extract($_POST);
	
	if (!$id) {
        $message = 0;
		header("Location: ".DEFAULT_URL."/sitemgr/review/index.php?class=errorMessage&message=".$message."&item_type=$item_type".($filter_id ? "&filter_id=1&item_id=$item_id" : '')."&screen=$screen&letter=$letter&item_letter=$item_letter&item_screen=$item_screen");
		exit;
	}

	$reviewObj = new Review($id);
	$reviewObj->setNumber('approved',1);
	$reviewObj->Save();
	$domain = new Domain(SELECTED_DOMAIN_ID);
   
    /* send e-mail to owner */
    if($reviewObj->getString('item_type') == 'listing') {

        $itemObj = new Listing($reviewObj->getNumber('item_id'));
        $contactObj = new Contact($itemObj->getNumber("account_id"));
        if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REVIEW, $contactObj->getString("lang"))) {
            setting_get("sitemgr_send_email", $sitemgr_send_email);
            setting_get("sitemgr_email", $sitemgr_email);
            $sitemgr_emails = explode(",", $sitemgr_email);
            if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
            $subject   = $emailNotificationObj->getString("subject");
            $body      = $emailNotificationObj->getString("body");
            $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'listing');
			$body      = str_replace($_SERVER["HTTP_HOST"],$domain->getString("url"), $body);
            $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'listing');
            $body      = html_entity_decode($body);
            $subject   = html_entity_decode($subject);
            system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
        }
    }
    /* */
    
    /* send e-mail to owner */
    if($reviewObj->getString('item_type') == 'article') {
        $itemObj = new Article($reviewObj->getNumber('item_id'));
        $contactObj = new Contact($itemObj->getNumber("account_id"));
        if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REVIEW, $contactObj->getString("lang"))) {
            setting_get("sitemgr_send_email", $sitemgr_send_email);
            setting_get("sitemgr_email", $sitemgr_email);
            $sitemgr_emails = explode(",", $sitemgr_email);
            if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
            $subject   = $emailNotificationObj->getString("subject");
            $body      = $emailNotificationObj->getString("body");
            $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'article');
			$body      = str_replace($_SERVER["HTTP_HOST"],$domain->getString("url"), $body);
            $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'article');
            $body      = html_entity_decode($body);
            $subject   = html_entity_decode($subject);
            system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
        }
    }


    /* send e-mail to owner */
    if($reviewObj->getString('item_type') == 'promotion') {
        $itemObj = new Promotion($reviewObj->getNumber('item_id'));
        $contactObj = new Contact($itemObj->getNumber("account_id"));
        if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REVIEW, $contactObj->getString("lang"))) {
            setting_get("sitemgr_send_email", $sitemgr_send_email);
            setting_get("sitemgr_email", $sitemgr_email);
            $sitemgr_emails = explode(",", $sitemgr_email);
            if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
            $subject   = $emailNotificationObj->getString("subject");
            $body      = $emailNotificationObj->getString("body");
            $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'promotion');
			$body      = str_replace($_SERVER["HTTP_HOST"],$domain->getString("url"), $body);
            $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'promotion');
            $body      = html_entity_decode($body);
            $subject   = html_entity_decode($subject);
            system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
        }
    }

    $message = 1;
    
	header("Location: ".DEFAULT_URL."/sitemgr/review/index.php?message=".$message."&item_type=$item_type".($filter_id ? "&filter_id=1&item_id=$item_id" : '')."&screen=$screen&letter=$letter&item_letter=$item_letter&item_screen=$item_screen");
	exit;