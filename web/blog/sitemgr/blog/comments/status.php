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
    # * FILE: blog/sitemgr/comments/status.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSMSession();
    permission_hasSMPerm();
	
    extract($_GET);
    extract($_POST);
    
    if ($status == "comment") {

		$commentObj = new Comments($idComment);
        $commentObj->setNumber('approved',1);
        $commentObj->Save();

		$is_reply = $commentObj->getNumber("reply_id");
        if ($is_reply)
			$message = 5;
		else
			$message = 4;
    } 

    if (string_strpos($_SERVER["HTTP_REFERER"], "view.php")) {

		if ($is_reply)
			$response = '?message='.$message.'&reply_id='.$is_reply.'&screen='.$_GET['screen'].'&letter='.$_GET['letter'].'';
		else
			$response .= '?message='.$message.'&post_id='.$_GET['post_id'].'&id='.$_GET['idComment'].'&screen='.$_GET['screen'].'&letter='.$_GET['letter'].'';
        header('Location: ' . BLOG_DEFAULT_URL . '/sitemgr/'.BLOG_FEATURE_FOLDER.'/comments/view.php'.$response);
    } else {
		if ($is_reply)
			$response .= "?message=".$message."&reply_id=".$is_reply."&screen=$screen&letter=$letter&item_letter=$item_letter&item_screen=$item_screen";
		else
			$response .= "?message=".$message."&post_id=".$_GET['post_id']."&screen=$screen&letter=$letter&item_letter=$item_letter&item_screen=$item_screen";
        header("Location: ".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/comments/index.php".$response);
    }
    exit;