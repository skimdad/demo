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
	# * FILE: /listing/comments.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

?>
	<? if (sess_validateSessionItens("listing", "see_comments")) { ?>
		<? if ($error_message) { ?>
			<?="<p class=\"errorMessage\">".$error_message."</p>";?>
		<? } else { ?>

			<h2><?=system_showText(LANG_REVIEWSOF)?> <?=$listingObj->getString("title")?></h2>

			<?
			$levelObj = new ListingLevel();
			$listing = $listingObj;
			$user = true;
            
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
            
			include(INCLUDES_DIR . "/views/view_listing_summary.php");
			
			unset($listing);

			include(system_getFrontendPath("results_filter.php"));
			include(system_getFrontendPath("results_pagination.php"));

			if ($reviewsArr) {
				
				$totalReviewsPage = count($reviewsArr);
				
				echo "<div class=\"featured featured-review featured-review-detail\">";
				foreach ($reviewsArr as $each_rate) {
					if ($each_rate->getString("review")) {
						$each_rate->extract();
						include(INCLUDES_DIR."/views/view_review_detail.php");
						echo $item_reviewcomment;
					}
				}
				echo "</div>";
			} else {
				echo "<p class=\"informationMessage\">".system_showText(LANG_REVIEW_NORECORD)."</p>";
			}

			unset($user);
		 }
			
	 } ?>