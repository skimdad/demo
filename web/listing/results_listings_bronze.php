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
	# * FILE: /listing/results_listings.php
	# ----------------------------------------------------------------------------------------------------

	/*if (!$bronze_listings) {

		if ($search_lock) {
			?>
			<p class="errorMessage">
				<?=system_showText(LANG_MSG_LEASTONEPARAMETER)?>
			</p>
			<?
		} else {
			$db = db_getDBObject();
			if ($db->getRowCount("Listing_Summary") > 0) { ?>
				<div class="resultsMessage">
					<?//=system_showText(LANG_MSG_NORESULTS);?>
					<?//=system_showText(LANG_MSG_TRYAGAIN);?>
                    
                    <?
                    unset($aux_lang_msg_noresults);                        
                    $aux_lang_msg_noresults = str_replace("[EDIR_LINK_SEARCH_ERROR]",DEFAULT_URL."/contactus.php", LANG_SEARCH_NORESULTS);
                    echo $aux_lang_msg_noresults;
                    ?>
				</div>
				<?
			} else {
				?>
				<p class="informationMessage">
					<?=system_showText(LANG_MSG_NOLISTINGS);?>
				</p>
				<?

			}
		}
	} else*/ if ($bronze_listings) {

		$levelObj = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
		$locationManager = new LocationManager();
		$count = 10;
		$ids_report_lote = "";
		
		/**
		 * This variable is used on view_listing_summary.php
		 */
		if (TWILIO_APP_ENABLED == "on"){
			if (TWILIO_APP_ENABLED_SMS == "on"){
				$levelsWithSendPhone = system_retrieveLevelsWithInfoEnabled("has_sms");
			}else{
				$levelsWithSendPhone = false;
			}
			if (TWILIO_APP_ENABLED_CALL == "on"){
				$levelsWithClicktoCall = system_retrieveLevelsWithInfoEnabled("has_call");
			}else{
				$levelsWithClicktoCall = false;
			}
		}else{
			$levelsWithSendPhone = false;
			$levelsWithClicktoCall = false;
		}
		
		$bronze_listing_count = 0;
		
		foreach ($bronze_listings as $bronze_listing) {
			$ids_report_lote .= $bronze_listing["id"].",";
			include(INCLUDES_DIR."/views/view_listing_summary_bronze.php");

            if ($count%2 && ($count != 10) && ITEM_RESULTS_CLEAR){
                echo "<br class=\"clear\" />";
            }
			$count--;
			$bronze_listing_count++;
            
		}
		$ids_report_lote = string_substr($ids_report_lote, 0, -1);$rvw_str = ($rvw_str) ? $rvw_str.",".$ids_report_lote :$ids_report_lote;
		report_newRecord("listing", $ids_report_lote, LISTING_REPORT_SUMMARY_VIEW, true);
	}
