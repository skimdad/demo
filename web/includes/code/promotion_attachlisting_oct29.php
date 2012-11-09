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

     

    if($_POST["remove_listing"] && $_POST["listing_id"]){ //Remove Listing Association - Promotion form

        unset($listingObj);

        $listingObj = new Listing($_POST["listing_id"]);

        if ($listingObj->getNumber("promotion_id")){

            $promotionObj = new Promotion($listingObj->getNumber("promotion_id"));

            if ($promotionObj->cleanup()){

                echo "ok";

            } else {

                echo "error";

            }

        }

    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") { //Associate with Listing - Manage Deals on Members

        $dbMain = db_getDBObject(DEFAULT_DB, true);

        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

        $listings_ids = array();

        $sqls = array();

        $errorAttachMessage = "";

        $successAttachMessage = "";

        $i = 1;

        

        while ($i<=$_POST["total_promotion"]){

            $aux = explode("||",$_POST["promotion_id_".$i]);

            $promotion_id = $aux[0];

            if (is_numeric($aux[1])){

                $listings_ids[] = $aux[1];

            }

            $i++;

        }

        

        $continue = false;

        $aux_listings_ids = array_unique($listings_ids);



        if (count($aux_listings_ids) != count($listings_ids)){

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

                    $listingObj->setNumber("promotion_id", $promotion_id);

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



		$act_id = ($_GET["account_id"]==0) ? "" : " AND `account_id` = ".$_GET["account_id"];
        echo $sqlListings = "SELECT `id`, 

                                `title`, 

                                `status`,

                                `account_id` 

                            FROM `Listing_Summary` 

                           WHERE (`promotion_id` = 0 ".$act_id." ".$levelWhere."

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