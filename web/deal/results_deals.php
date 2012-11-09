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
	# * FILE: /deal/results_events.php
	# ----------------------------------------------------------------------------------------------------
	?><h2 style="margin-left:-15px;"><span><?=system_showText(LANG_FEATURED_PROMOTION);?></span></h2> <?
	if($show_results){

		if (!$promotions) {

			if ($search_lock) {?>
				<p class="errorMessage">
					<?=system_showText(LANG_MSG_LEASTONEPARAMETER)?>
				</p>
				<?
			} else {
				$db = db_getDBObject();
				if ($db->getRowCount("Promotion") > 0) { ?>
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
                    /*
					if ($keyword) {
						?>
						<p class="informationMessage">
							<?=system_showText(LANG_MSG_USE_SPECIFIC_KEYWORD);?>
						</p>
						<?
					}
                     * 
                     */
				} else {
					?>
					<p class="informationMessage">
						<?=system_showText(LANG_MSG_NOPROMOTIONS);?>
					</p>
					<?
				}
			}
		} elseif ($promotions){
			
			$mapNumber = 0;
			$count = 10;
	
			foreach ($promotions as $promotion) {
				
				$listingObj = new Listing();
				$listings = $listingObj->retrieveListingsbyPromotion_id($promotion->getNumber("id"));

				if ($listings) {
					if ($listings[0]->getString("latitude") && $listings[0]->getString("longitude")){
						$mapNumber++;
					}
				}
				
				include(INCLUDES_DIR."/views/view_promotion_summary.php");
				$count--;
			}
		}
	}
?>