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
	# * FILE: /frontend/slider.php
	# ----------------------------------------------------------------------------------------------------
	
	/*
	* Get content of database
	*/
	$labelsuffix = language_getIndex(EDIR_LANGUAGE);

	$dbObj = db_getDBObject();
	if (!isset($_SESSION["s_kind"]) || !isset($_SESSION["s_state"]) || !isset($_SESSION["s_city"]))  {
		$sql = "SELECT * FROM Slider WHERE image_id > 0 AND slider_kind = 'HOME' AND slider_loc3 = 'DEFAULT' AND slider_loc4 = 'DEFAULT' ORDER BY slide_order LIMIT ".TOTAL_SLIDER_ITEMS;
	} else {
		$where_clause = " AND slider_kind = '".$_SESSION["s_kind"]."'"; 
		$where_clause .= " AND slider_loc3 = '".$_SESSION["s_state"]."'";
		$where_clause .= " AND slider_loc4 = '".$_SESSION["s_city"]."'";
		$sql = "SELECT * FROM Slider WHERE image_id > 0 ".$where_clause." ORDER BY slide_order LIMIT ".TOTAL_SLIDER_ITEMS;
	}

	$result_slider = $dbObj->query($sql);
	setting_get($_SESSION["s_kind"], $slider_feature);
	if (mysql_num_rows($result_slider) < 1 && $slider_feature == "ON"){
		$where_clause = " AND slider_kind = '".$_SESSION["s_kind"]."'"; 
		$where_clause .= " AND slider_loc3 = 'DEFAULT'";
		$where_clause .= " AND slider_loc4 =  'DEFAULT'";
		$sql = "SELECT * FROM Slider WHERE image_id > 0 ".$where_clause." ORDER BY slide_order LIMIT ".TOTAL_SLIDER_ITEMS;		
		$result_slider = $dbObj->query($sql);	
	}	

	if (mysql_num_rows($result_slider) > 0 && $slider_feature == "ON"){
		$i = 0;
		$array_slider = array();
		while ($row = mysql_fetch_assoc($result_slider)) {

			/**
			 * Get image path
			 */
			if($row["image_id"] && $row["title"]){
				$imageObj = new Image($row["image_id"]);
				if ($imageObj->imageExists()) {
					$array_slider[$i]["image_tag"] = $imageObj->getTag(true, IMAGE_SLIDER_WIDTH, IMAGE_SLIDER_HEIGHT, $row["title_text".$labelsuffix], true, $row["alternative_text".$labelsuffix]);
				} else {
					$array_slider[$i]["image_tag"] = "<span class=\"no-image no-image-slider\"></span>";
				}

				$array_slider[$i]["link"]			= $row["link".$labelsuffix];
				$array_slider[$i]["title"]			= $row["title"];
				$array_slider[$i]["description"]	= $row["summary".$labelsuffix];
				$i++;
			}
		}
		
		/*
		* Prepare variable to start javascript to slider
		*/
		if (mysql_num_rows($result_slider) > 1){
			$aux_script_slider = "$(\"#slider\").easySlider({
											auto: true,
											continuous: true,
											numeric: true
										});";
			$js_fileLoader = system_scriptColectorOnReady($aux_script_slider, $js_fileLoader, true);				
		}
	}
	
	if (is_array($array_slider)){ ?>	
		<div class="content-top content-top-slider">
			<div id="slider">
				<ul>
					<? 
					for($i=0;$i<count($array_slider);$i++){ ?>
					<li>
						<div class="slider-item">
							<div class="left">
								<? if ($array_slider[$i]["link"]) { ?>
									<a href="http://<?=str_replace("http://","",$array_slider[$i]["link"])?>">
								<? }
								echo $array_slider[$i]["image_tag"];
								if ($array_slider[$i]["link"]){ ?>
									</a>
								<? } ?>
							</div>	
							<div class="right">
								<h2>
									<? if ($array_slider[$i]["link"]) { ?>
										<a href="http://<?=str_replace("http://","",$array_slider[$i]["link"])?>">
									<? }
									echo string_htmlentities($array_slider[$i]["title"]);
									if($array_slider[$i]["link"]){ ?>
										</a>
									<? } ?>
								</h2>
								<p><?=string_htmlentities($array_slider[$i]["description"]);?></p>
							</div>
						</div>
					</li>
					<? } ?>
				</ul>
			</div>
		</div>
	<? } ?>