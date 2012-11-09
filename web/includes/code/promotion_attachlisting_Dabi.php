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
	# * FILE: /includes/code/promotion_attachlisting.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    if ($_POST["request"] == "ajax" || $_GET["domain_id"]) {
        if($_GET["domain_id"]){
            define("SELECTED_DOMAIN_ID", $_GET["domain_id"]);
        }else{
            define("SELECTED_DOMAIN_ID", $_POST["domain_id"]);
        }
        include("../../conf/loadconfig.inc.php");
    }
    
    // the following code is modified by Debiprasad on 11 Oct. 2012 
    // we will take promotion_id instead of listing_id
    //if($_POST["remove_listing"] && $_POST["listing_id"]){ //Remove Listing Association - Promotion form
    if($_POST["remove_listing"] && $_POST["promotion_id"]){ //Remove Listing Association - Promotion form
        //unset($listingObj);
        //$listingObj = new Listing($_POST["listing_id"]);
        //if ($listingObj->getNumber("promotion_id")){
            $promotionObj = new Promotion($_POST["promotion_id"]);
            if ($promotionObj->cleanup()){
                echo "ok";
            } else {
                echo "error";
            }
        //}
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") { //Associate with Listing - Manage Deals on Members
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $listings_ids = array();
        $sqls = array();
        $errorAttachMessage = "";
        $successAttachMessage = "";
        $i = 1;
        $dealsAllowed = array();
        
        while ($i<=$_POST["total_promotion"]){
            $aux = explode("||",$_POST["promotion_id_".$i]);
            $promotion_id = $aux[0];
            if (is_numeric($aux[1])){
                $listings_ids[] = $aux[1];
                if ($aux[4] < 2)
                	$dealsAllowed[$aux[1]] = 1;
                else
                	$dealsAllowed[$aux[1]] = $aux[4];
            }
            $i++;
        }
        
        $continue = false;
        //$aux_listings_ids = array_unique($listings_ids);
        $listing_id_values = array_count_values($listings_ids);
        $error_orrcured = false;
        
        foreach ($listing_id_values as $listings_id => $count) {
        	if ($dealsAllowed[$listings_id] < $count) {
        		$error_orrcured = true;
        		break;
        	}
        }

        //if (count($aux_listings_ids) != count($listings_ids)){
        if ($error_orrcured) {
            $errorAttachMessage = system_showText(LANG_MSG_REPEATED_LISTINGS);
        } else {
            $successAttachMessage = "success";
            $continue = true;
        }

        if ($continue){
            $i = 1;

            while ($i<=$_POST["total_promotion"]){
                $aux = explode("||",$_POST["promotion_id_".$i]);
                $promotion_id = $aux[0];
                unset($promotionObj);
                $promotionObj = new Promotion($promotion_id);
                $promotionObj->cleanup();
                if (is_numeric($aux[1])){ 
                    $listing_id = $aux[1];
                    $listings_ids[] = $listing_id;
                    unset($listingObj);
                    $listingObj = new Listing($listing_id);
                    
                    switch ($promotion_id) {
	                    case $listingObj->getNumber("promotion_id"):
	                    	$listingObj->setNumber("promotion_id", $promotion_id);
	                    break;
	                    
	                    case $listingObj->getNumber("promotion_id_two"):
	                    	$listingObj->setNumber("promotion_id_two", $promotion_id);  
	                    break;
	                    
	                    case $listingObj->getNumber("promotion_id_three"):
	                    	$listingObj->setNumber("promotion_id_three", $promotion_id);  
	                    break;
	                    
	                    case $listingObj->getNumber("promotion_id_four"):
	                    	$listingObj->setNumber("promotion_id_four", $promotion_id);  
	                    break;
	                    
	                    case $listingObj->getNumber("promotion_id_five"):
	                    	$listingObj->setNumber("promotion_id_five", $promotion_id);  
	                    break;
	                    
	                    default:
		                    if ($listingObj->getNumber("promotion_id") == 0){
		                        $listingObj->setNumber("promotion_id", $promotion_id);  
		                    } else if ($listingObj->getNumber("promotion_id_two") == 0){
		                        $listingObj->setNumber("promotion_id_two", $promotion_id);  
		                    } else if ($listingObj->getNumber("promotion_id_three") == 0){
		                        $listingObj->setNumber("promotion_id_three", $promotion_id);  
		                    } else if ($listingObj->getNumber("promotion_id_four") == 0){
		                        $listingObj->setNumber("promotion_id_four", $promotion_id);  
		                    } else if ($listingObj->getNumber("promotion_id_five") == 0){
		                        $listingObj->setNumber("promotion_id_five", $promotion_id);  
		                    }
                    }
                    
                    
                    $listingObj->save();
                } else {
                    $listing = db_getFromDB("listing", "promotion_id", db_formatNumber($promotion_id), 1, "", "array", SELECTED_DOMAIN_ID, false, "id");
                    if ($listing["id"]){
                        unset($listingObj);
                        $listingObj = new Listing($listing["id"]);
                        $listingObj->removePromotionID();
                    }
                }
                $i++;
            }	
        }

    } elseif ($_GET["q"]) { //Listing auto complete - Promotion form
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

        /**
         * Get level with promotion
         */
        unset($dealLevels);
        $levelObj = new ListingLevel();
        $levels = $levelObj->getValues();
        foreach ($levels as $level) {
            if ($levelObj->getHasPromotion($level) == "y") {
                $dealLevels[] = $level;
            }
        }
        $dealLevels = implode(",", $dealLevels);
        $levelWhere = "AND `level` IN ($dealLevels)";

        // the following query is modified by Debiprasad on 11 August 2012
        $sqlListings = "SELECT `id`, 
                                `title`, 
                                `status`,
                                `account_id` 
                            FROM `Listing_Summary` 
                           WHERE ((`promotion_id` = 0 
                           		  	OR (`promotion_id_two` = 0 AND extra_promotion >= 2) 
                           		  	OR (`promotion_id_three` = 0 AND extra_promotion >= 3) 
                           		  	OR (`promotion_id_four` = 0 AND extra_promotion >= 4) 
                           		  	OR (`promotion_id_five` = 0 AND extra_promotion = 5))
                                  AND `account_id` = ".$_GET["account_id"]." ".$levelWhere ."
                                  AND title LIKE '".$_GET["q"]."%') 
                        ORDER BY `title`";

        unset($arrayAux);
        $arrayAux = array();
        $resListings = $dbObj->query($sqlListings);
        if (mysql_num_rows($resListings)) {

            while ($rowListings = mysql_fetch_assoc($resListings)) {
                echo $rowListings["title"]."|".$rowListings["id"]." \n ";
            }				
        }
    }
?>