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
	# * FILE: /includes/views/view_checkin.php
	# ----------------------------------------------------------------------------------------------------
	$item_checkin = "";

	if (!$tPreview) {
		if (is_array($listing)) {
			$aux = $listing;
		} else if (is_object($listing)) {
			$aux = $listing->data_in_array;
		} else if ($_GET["id"]){
			unset($auxListingObj);
			$auxListingObj = new Listing($_GET["id"]);
			$aux = $listing->data_in_array;
		}

		$item_default_url = LISTING_DEFAULT_URL;
	}

	###################################################################
	######################     CHEKIN    #############################
	###################################################################
    $listingLevelObj = new ListingLevel();
	if($aux["id"] || $tPreview){
		if ($tPreview) {
			if ($listingLevelObj->getDetail($levelValue) == "y"){
				$checkin_amount = 5;
			} else {
				$checkin_amount = 0;
			}
		} else {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			$sql = "SELECT * FROM CheckIn WHERE item_id = ".htmlspecialchars($aux["id"])." AND quick_tip IS NOT NULL AND quick_tip != ''";

			$r = $db->query($sql);
			$checkin_amount = mysql_num_rows($r);
		}

		unset($aux_item_checkin);
		if ($user) {

			$checkin_str = $checkin_amount == 1 ? system_showText(LANG_CHECKINCOUNT) : system_showText(LANG_CHECKINCOUNT_PLURAL);

			if (mysql_num_rows($r) > 0) {

				if (MODREWRITE_FEATURE == "on") {
					$checkinsLink = $item_default_url."/checkins/".htmlspecialchars($aux["friendly_url"]);
				} else {
					$checkinsLink = $item_default_url."/commentsCheckin.php?item_type=".$item_type."&item_id=".htmlspecialchars($aux["id"]);
				}

				$aux_item_checkin .= "<a href='".$checkinsLink."'>".$checkin_amount." " . $checkin_str . "</a>";

			}

		} else {

			$plural = $checkin_amount == 1 ? false : true;
			if ($checkin_amount > 0) {
				$aux_item_checkin .= "<a href='javascript:void(0);' style=\"cursor:default\">" . $checkin_amount . " " . system_showText(($plural ? LANG_CHECKINCOUNT_PLURAL : LANG_CHECKINCOUNT)) . "</a>";
			}
		}

		if(string_strlen($aux_item_checkin) > 0){
			$item_checkin .= $aux_item_checkin;
		}
		
	}

	###################################################################
	###################################################################
	###################################################################

	unset($aux);
?>
