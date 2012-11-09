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
    # * FILE: /sitemgr/review/status.php
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
	$domain = new Domain(SELECTED_DOMAIN_ID);
    if ($status == "review") {
        
        #--------------------------------------------------------------------------------
        # REVIEW
        #--------------------------------------------------------------------------------
        $reviewObj = new Review($idReview);
        $reviewObj->setNumber('approved',1);
        $reviewObj->Save();

		$avg = $reviewObj->getRateAvgByItem($item_type, $item_id);
        if (!is_numeric($avg)) $avg = 0;
		if ($item_type == 'listing') {
			$listing = new Listing();
			$listing->setAvgReview($avg, $item_id);
		} else if ($item_type == 'article') {
			$articles = new Article();
			$articles->setAvgReview($avg, $item_id);
		} else {
			$promotions = new Promotion();
			$promotions->setAvgReview($avg, $item_id);
		}
		
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
        
    }
    
    if ($status == "reply") {
        
        #--------------------------------------------------------------------------------
        # REPLY
        #--------------------------------------------------------------------------------
        $replyObj = new Review($idReview);
        $replyObj->setNumber('responseapproved',1);
        $replyObj->Save();
        
        /* send e-mail to owner */
        if($replyObj->getString('item_type') == 'listing') {
            $itemObj = new Listing($replyObj->getNumber('item_id'));
            $contactObj = new Contact($itemObj->getNumber("account_id"));
            if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REPLY, $contactObj->getString("lang"))) {
                setting_get("sitemgr_send_email", $sitemgr_send_email);
                setting_get("sitemgr_email", $sitemgr_email);
                $sitemgr_emails = explode(",", $sitemgr_email);
                if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
                $subject   = $emailNotificationObj->getString("subject");
                $body      = $emailNotificationObj->getString("body");
                $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'listing');
				$body	   = str_replace($_SERVER["HTTP_HOST"],$domain->getString("url"), $body);
                $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'listing');
                $body      = html_entity_decode($body);
                $subject   = html_entity_decode($subject);
                system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
            }
        }
        /* */
        
        /* send e-mail to owner */
        if($replyObj->getString('item_type') == 'article') {
            $itemObj = new Article($replyObj->getNumber('item_id'));
            $contactObj = new Contact($itemObj->getNumber("account_id"));
            if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REPLY, $contactObj->getString("lang"))) {
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
        if($replyObj->getString('item_type') == 'promotion') {
            $itemObj = new Promotion($replyObj->getNumber('item_id'));
            $contactObj = new Contact($itemObj->getNumber("account_id"));
            if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REPLY, $contactObj->getString("lang"))) {
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
        
        $message = 7;
        
    }
    
    if ($status == "both") {
        
        $reviewObj = new Review($idReview);
        $reviewObj->setNumber('responseapproved',1);
        $reviewObj->setNumber('approved',1);
        $reviewObj->Save();
        
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
        
        /* send e-mail to owner */
        if($reviewObj->getString('item_type') == 'listing') {
            $itemObj = new Listing($reviewObj->getNumber('item_id'));
            $contactObj = new Contact($itemObj->getNumber("account_id"));
            if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REPLY, $contactObj->getString("lang"))) {
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
            if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REPLY, $contactObj->getString("lang"))) {
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
            if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REPLY, $contactObj->getString("lang"))) {
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
    
        $message = 8;
    }
    
    if (string_strpos($_SERVER["HTTP_REFERER"], "view.php")) {
        $response .= '?message='.$message.'&item_id='.$_GET['item_id'].'&item_type='.$_GET['item_type'].'&id='.$_GET['idReview'].'&screen='.$_GET['screen'].'&letter='.$_GET['letter'].'';
        header('Location: ' . DEFAULT_URL . '/sitemgr/review/view.php'.$response);
    } else {
        $response .= "?message=".$message."&item_type=$item_type".($filter_id ? "&filter_id=1&item_id=$item_id" : '')."&screen=$screen&letter=$letter&item_letter=$item_letter&item_screen=$item_screen";
        header("Location: ".DEFAULT_URL."/sitemgr/review/index.php".$response);
    }
    exit;