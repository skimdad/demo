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
	# * FILE: /frontend/featured_classified.php
	# ----------------------------------------------------------------------------------------------------
	
	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedClassified-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$numberOfCols = 12;
	$lastItemStyle = 0;

	$level = implode(",", system_getLevelDetail("ClassifiedLevel"));

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontClassifiedSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." (Classified.level IN (".$level.")) ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ORDER BY `random_number` LIMIT ".$numberOfCols."";
		$front_featured_classifieds = db_getFromDBBySQL("classified", $sql);
	}

	if ($front_featured_classifieds) {
		$seeAllText = system_showText(LANG_LABEL_VIEW_ALL_CLASSIFIEDS);

		?>
		
		<h2>
			<span><?=system_showText(LANG_FEATURED_CLASSIFIED);?></span>
		</h2>
		
		<div class="featured featured-classified">
			<?
			
			$first_front_featured_classifieds = true;
			$ids_report_lote = "";
			foreach ($front_featured_classifieds as $classified) {
				
				$lastItemStyle++;

				$ids_report_lote .= $classified->getString("id").",";

				if (MODREWRITE_FEATURE == "on") {
					$detailLink = "".CLASSIFIED_DEFAULT_URL."/".$classified->getString("friendly_url").".html";
				} else {
					$detailLink = "".CLASSIFIED_DEFAULT_URL."/detail.php?id=".$classified->getNumber("id")."";
				}

				echo "<div class=\"featured-item ".(($lastItemStyle==$numberOfCols) ? ("pd-0") : (""))."\">";

				$imageObj = new Image($classified->getNumber("thumb_id"));
				if ($imageObj->imageExists()) {
					echo "<a href=\"".$detailLink."\" class=\"image\">";
					echo $imageObj->getTag(true, IMAGE_FRONT_CLASSIFIED_WIDTH, IMAGE_FRONT_CLASSIFIED_HEIGHT, $classified->getString("title"), true);
					echo "</a>";
				} else {
					echo "<a href=\"".$detailLink."\" class=\"image\">";
					echo "<span class=\"no-image\"></span>";
					echo "</a>";
				}
				
				echo "<h3><a href=\"".$detailLink."\" title=\"".$classified->getString("title")."\">".$classified->getString("title", true, false)."</a></h3>";

                if(CLASSIFIED_SCALABILITY_OPTIMIZATION == "on"){
                    $classified_moreInfo = "<a href=\"javascript: void(0);\" onclick=\"showCategory(".htmlspecialchars($classified->getNumber("id")).", 'classified', ".(true).", ".$classified->getNumber("account_id").", ".(true).");\" \>".system_showText(LANG_VIEWCATEGORY)."</a>";
                    echo "<p id=\"showCategory_classified".$classified->getNumber("id")."\">$classified_moreInfo</p>";
                    
                } else {
                
                    echo "<p>";
                    echo system_itemRelatedCategories($classified->getNumber("id"), "classified", true);
                    $name = socialnetwork_writeLink($classified->getNumber("account_id"), "profile", "general_see_profile");
                    if ($name) {
                        echo " ".system_showText(LANG_BY)." ".$name." ";
                    }
                    echo "</p>";
                }

				echo "</div>\n\n";

			}
			$ids_report_lote = string_substr($ids_report_lote, 0, -1);
			report_newRecord("classified", $ids_report_lote, CLASSIFIED_REPORT_SUMMARY_VIEW, true);

			?>
		</div>
		<h2><a class="view-more" href="<?=CLASSIFIED_DEFAULT_URL?>"><?=$seeAllText;?></a></h2>
		<?
		
		# ----------------------------------------------------------------------------------------------------
		# VALIDATE FEATURE
		# ----------------------------------------------------------------------------------------------------

	}
}

// Preparing markers to full cache
?>
<!--cachemarkerFeaturedClassified-->
