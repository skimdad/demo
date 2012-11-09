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
    # * FILE: /sitemgr/review/review.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # UPDATE REVIEW
    # ----------------------------------------------------------------------------------------------------
    
    if(string_strlen(trim($_GET["rating_".$_GET['idReview']])) > 0) {
		/*
		 * Get object name from item_type (listing, article, etc)
		 */
		$objName = string_strtolower($_GET["item_type"]);
		$objName = ucfirst($objName);
		/*
		 * Make a instance of Review object to save the changes and get AVG by item
		 */
		$reviewObj = new Review($_GET['idReview']);
		$reviewObj->setNumber("rating", $_GET["rating_".$_GET['idReview']]);
		$reviewObj->Save();
		$avg = $reviewObj->getRateAvgByItem($_GET["item_type"], $reviewObj->getNumber("item_id"));
        if (!is_numeric($avg)) $avg = 0;
		/*
		 * Updating the item AVG_REVIEW
		 */
		$itemObj = new $objName();
		$itemObj->setAvgReview($avg, $reviewObj->getNumber("item_id"));
    }
    
    if ($_GET["idReview"]) {
		$reviewObj = new Review($_GET['idReview']);
		$reviewObj->setString("reviewer_name", $_GET['reviewer_name']);
		$reviewObj->setString("reviewer_email", $_GET['reviewer_email']);
		$reviewObj->setString("reviewer_location", $_GET['reviewer_location']);
		$reviewObj->setString("review_title", $_GET['review_title']);
		$reviewObj->setString("review", $_GET['review']);
		$reviewObj->Save();

		$message = 5;
    } else $message = 6;
    
    $response = "?class=successMessage&message=$message";
    
    if (string_strpos($_SERVER["HTTP_REFERER"], "view.php")) {
        $response .= '&item_id='.$_GET['item_id'].'&item_type='.$_GET['item_type'].'&id='.$_GET['idReview'].'&screen='.$_GET['screen'].'&letter='.$_GET['letter'].'';
        header('Location: ' . DEFAULT_URL . '/sitemgr/review/view.php'.$response);
    } else {
        $response .= ($_GET['filter_id'] ? '&filter_id=1&item_id='.$_GET['item_id'] : '')."&item_type=".$_GET['item_type']."&screen=".$_GET['screen']."&letter=".$_GET['letter'];
        header('Location: ' . DEFAULT_URL . '/sitemgr/review/index.php'.$response);
    }

?>