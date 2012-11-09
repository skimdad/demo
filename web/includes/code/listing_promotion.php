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
    # * FILE: /includes/code/listing_promotion.php
    # ----------------------------------------------------------------------------------------------------

    $errorPage = "$url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."";
    $level = new ListingLevel();

    if ($id) {
        $listing = new Listing($id);
        if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
            header("Location: ".$errorPage);
            exit;
        }
        if ((sess_getAccountIdFromSession() != $listing->getNumber("account_id")) && (!string_strpos($url_base, "/sitemgr"))) {
            header("Location: ".$errorPage);
            exit;
        }
        $listingHasPromotion = $level->getHasPromotion($listing->getNumber("level"));
        if ((!$listingHasPromotion) || ($listingHasPromotion != "y")) {
            header("Location: ".$errorPage);
            exit;
        }
        $account_id = $listing->getNumber("account_id");
    } else {
        header("Location: ".$errorPage);
        exit;
    }

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        if ($_POST["promotion_id"] >= 0) {

            $listing->setNumber("promotion_id", $_POST["promotion_id"]);
            $listing->Save();
            
            $message = 6;

            header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
            exit;

        }
    }

    # ----------------------------------------------------------------------------------------------------
    # FORMS DEFINES
    # ----------------------------------------------------------------------------------------------------
    $listing->extract();

    /**
     * Get promotion information 
     */
    if($promotion_id){
        unset($promotionObj);
        $promotionObj = new Promotion($promotion_id);
        $promotion_name = $promotionObj->getString("name");
    }

?>