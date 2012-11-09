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
	# * FILE: /classified/featured.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on") { exit; }
	
	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedClassified2-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	//$numberOfClassifieds = FEATURED_CLASSIFIED_MAXITEMS;
	$numberOfClassifieds = 24;
	$lastItemStyle = 0;
	//$specialItem = FEATURED_CLASSIFIED_MAXITEMS_SPECIAL;
	$specialItem = 24;

    $level = implode(",", system_getLevelDetail("ClassifiedLevel"));

    if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontClassifiedSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." (Classified.level IN (".$level.")) ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ORDER BY `random_number` LIMIT ".$numberOfClassifieds."";
		$highlight_classifieds = db_getFromDBBySQL("classified", $sql);
	}

	if ($highlight_classifieds) {
		$top_featured_classified = "";
		$featured_classified = "";
		?>
		
		<h2>
			<span><?=system_showText(LANG_FEATURED_CLASSIFIED)?></span>
			<?
			if (CLASSIFIED_SCALABILITY_OPTIMIZATION != "on"){
				$seeAllText = system_showText(LANG_LABEL_VIEW_ALL_CLASSIFIEDS);
				$seeAllTextLink = (MODREWRITE_FEATURE == "on" ? CLASSIFIED_DEFAULT_URL."/search/empty/where/empty" : CLASSIFIED_DEFAULT_URL."/results.php"); ?>
			
			<? } ?>
		</h2>
		
		<div class="featured featured-classified">

			<?
			$user = true;
			$count = 0;
			$countSpecialItem = 0;
			$ids_report_lote = "";
			foreach ($highlight_classifieds as $classified) {
				
				$ids_report_lote .= $classified->getString("id").",";

				if (MODREWRITE_FEATURE == "on") {
					$detailLink = "".CLASSIFIED_DEFAULT_URL."/".$classified->getString("friendly_url").".html";
				} else {
					$detailLink = "".CLASSIFIED_DEFAULT_URL."/detail.php?id=".$classified->getNumber("id")."";
				}

				$lastItemStyle++;
			
				if($countSpecialItem<$specialItem){
					
					if($countSpecialItem==0){
						echo "<div class=\"left\" style=\"width: 700px;\">";
					}
					
					/* if(($lastItemStyle%2) && ($lastItemStyle!=1) && !ITEM_RESULTS_CLEAR){
						echo "<br class=\"clear\" />";
					} */

					echo "<div class=\"featured-item featured-item-special\">";
					
					echo "<div class=\"image\">";

					$imageObj = new Image($classified->getNumber("thumb_id"));
					if ($imageObj->imageExists()) {
						echo "<a href=\"".$detailLink."\" class=\"image\">";
						echo $imageObj->getTag(true, IMAGE_FEATURED_CLASSIFIED_WIDTH, IMAGE_FEATURED_CLASSIFIED_HEIGHT, $classified->getString("title"), true);
						echo "</a>";
					} else {
						echo "<a href=\"".$detailLink."\" class=\"image\">";
						echo "<span class=\"no-image\"></span>";
						echo "</a>";
					}

					echo "</div>";

					echo "<h3><a href=\"".$detailLink."\">".$classified->getString("title", true)."</a></h3>";

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

					echo "</div>";
                    if(($lastItemStyle%4 == 0) && ($lastItemStyle>3) && !ITEM_RESULTS_CLEAR){
						echo "<br class=\"clear\" />";
					}
                    if(!(($lastItemStyle-4)%4) && ITEM_RESULTS_CLEAR){
                        echo "<br class=\"clear\" />";
                    }
					
					if($countSpecialItem==($specialItem-1) || (count($highlight_classifieds) == $countSpecialItem +1)){
						echo "</div>";
					}
					
					$countSpecialItem++;

				} else {
					
					if($lastItemStyle==$numberOfClassifieds){
						$itemStyle = "last";
					}elseif($lastItemStyle==($specialItem+1)){
						$itemStyle = "first";
					}else{
						$itemStyle = "";
					}

					echo "<div class=\"featured-item ".$itemStyle."\">";

					echo "<h3><a href=\"".$detailLink."\">".$classified->getString("title", true)."</a></h3>";

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

					echo "</div>"; 
				}

			}
			$ids_report_lote = string_substr($ids_report_lote, 0, -1);
			report_newRecord("classified", $ids_report_lote, CLASSIFIED_REPORT_SUMMARY_VIEW, true);
			
		echo "</div>";
		?> <h2><a class="view-more" href="<?=$seeAllTextLink?>"><?="VIEW ALL CLASSIFIED. . .";?></a></h2> <?
	}
	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedClassified2-->