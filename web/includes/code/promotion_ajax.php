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
    # * FILE: /includes/code/promotion_ajax.php
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

    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

    if($_GET["q"]){
        $sqlPromotions = "SELECT `id`, 
                                `name`
                            FROM `Promotion` 
                            WHERE (
                                    `listing_id` = 0
                                    AND `account_id` = ".$_GET["account_id"]."
                                    AND name like '".$_GET["q"]."%'
                                    AND end_date >= DATE_FORMAT(NOW(), '%Y-%m-%d')
                                  )
                        ORDER BY `name`";

        $resPromotions = $dbObj->query($sqlPromotions);
        if (mysql_num_rows($resPromotions)) {

            while ($rowPromotions = mysql_fetch_assoc($resPromotions)) {
                echo $rowPromotions["name"]."|".$rowPromotions["id"]." \n ";
            }				
        }
    }
         
?>