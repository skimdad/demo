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
	# * FILE: /classes/class_PromotionPrice.php
	# ----------------------------------------------------------------------------------------------------

	class PromotionPrice {

		##################################################
		# PRIVATE
		##################################################

		var $price;
		var $extra_promotions;

		function PromotionPrice($domain_id = false) {
			
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id) {
				$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
			} else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
            
			unset($dbMain);
            
		    $sql = "SELECT * FROM PromotionPricing ORDER BY extra_promotion";
            
            if ($sql != "") {
                $result = $dbObj->query($sql);
                $price_array = array();

                while ($row = mysql_fetch_assoc($result)) {
                	$price_array[$row['extra_promotion']] = $row['price'];
                }
            }
            $this->price = $price_array;
            $this->extra_promotions = array('2' => 'Second', '3' => 'Third', '4' => 'Fourth', '5' => 'Fifth');
		}

		function updatePricing($extra_promotion, $price){
            
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            
            $sql = "UPDATE PromotionPricing SET price = ".$price." WHERE extra_promotion = ".$extra_promotion;
            $dbObj->query($sql);
        }
		
	}