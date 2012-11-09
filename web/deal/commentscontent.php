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
	# * FILE: /deal/commentscontent.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

?>
	<? if (sess_validateSessionItens("promotion", "see_comments")) { ?>
		<? if ($error_message) { ?>
			<?="<p class=\"errorMessage\">".$error_message."</p>";?>
		<? } else { ?>

			<h2><?=system_showText(LANG_REVIEWSOF)?> <?=$promotionObj->getString("name")?></h2>

			<?
			
			$rotateEach=2;
			$impressionNumber=0;
			$iscommentContent = true;
			$promotion = $promotionObj;

			$user = true;
			include(INCLUDES_DIR."/views/view_promotion_summary.php");
			
			$iscommentContent = false;
                        
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
			?>

		<? } ?>
	<? } ?>