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
    # * FILE: /sitemgr/review/index.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # UPDATE REPLY
    # ----------------------------------------------------------------------------------------------------
    
    if(string_strlen(trim($_GET['reply'])) > 0) {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $sql = "UPDATE Review SET response = '".addslashes(trim($_GET['reply']))."' WHERE id = ".db_formatNumber($_GET['idReview']);
        $db->query($sql);
        $message = 3;
        $response = "?class=successMessage&message=$message";
    } else {
        $message = 4;
        $response = "?class=errorMessage&message=$message";
    }
    
    if (string_strpos($_SERVER["HTTP_REFERER"], "view.php")) {
        $response .= '&item_id='.$_GET['item_id'].'&item_type='.$_GET['item_type'].'&id='.$_GET['idReview'].'&screen='.$_GET['screen'].'&letter='.$_GET['letter'].'';
        header('Location: ' . DEFAULT_URL . '/sitemgr/review/view.php'.$response);
    } else {
        $response .= ($_GET['filter_id'] ? '&filter_id=1&item_id='.$_GET['item_id'] : '')."&item_type=".$_GET['item_type']."&screen=".$_GET['screen']."&letter=".$_GET['letter'];
        header('Location: ' . DEFAULT_URL . '/sitemgr/review/index.php'.$response);
    }
?>