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
	# * FILE: /theme/realestate/frontend/slider.php
	# ----------------------------------------------------------------------------------------------------
	
	/*
	* Get content of database
	*/
	$labelsuffix = language_getIndex(EDIR_LANGUAGE);

	$dbObj = db_getDBObject();
	$sql = "SELECT * FROM Slider WHERE image_id > 0 ORDER BY slide_order LIMIT 5";
	$result_slider = $dbObj->query($sql);

	setting_get("slider_feature", $slider_feature);
    
    $hasSlider = false;
	
	if (mysql_num_rows($result_slider) > 0 && $slider_feature == "on"){
        
        $hasSlider = true;
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
                    $array_slider[$i]["link"]			= $row["link".$labelsuffix];
                    $array_slider[$i]["title"]			= $row["title"];
                    $array_slider[$i]["price"]			= $row["price"];
                    $array_slider[$i]["description"]	= $row["summary".$labelsuffix];
                    $array_slider[$i]["image_url"]	= $imageObj->IMAGE_URL."/".$imageObj->prefix."photo_".$imageObj->id.".".string_strtolower($imageObj->type);
                    $i++;
				}
			}
		}
                
       /*
		* Prepare variable to start javascript to slider
		*/
		if (mysql_num_rows($result_slider) > 1){
			$aux_script_slider = "$(\".slider-content\").easySlider({
                                                    loop: true,
                                                    orientation: 'fade', 
                                                    autoplayDuration: 3000,
                                                    autogeneratePagination: false,
                                                    restartDuration: 4500,
                                                    nextId: 'next',
                                                    prevId: 'prev',
                                                    pauseable: true
                                            });";
			$js_fileLoader = system_scriptColectorOnReady($aux_script_slider, $js_fileLoader, true);				
		}
                
	} 
        
    if (is_array($array_slider) && $slider_feature == "on"){ ?>
        <div class="slider-info"></div>
        
        <div class="slider-content">
            
            <ul>
                
            <? for($i=0;$i<count($array_slider);$i++){ ?>
                <li>
                    <div class="slider-content-full" style="background:url('<?=$array_slider[$i]["image_url"]?>');">
                        <div class="slider-content-box">
                            <div class="slider-info-content">
                                <? if ($array_slider[$i]["link"]) { ?>
                                <p class="button-read">
                                    <a href="http://<?=str_replace("http://","",$array_slider[$i]["link"])?>"><?=system_showText(LANG_READMORE)?></a>
                                </p>
                                <? } ?>
                                
                                <? if ($array_slider[$i]["price"] != "0.00" && $array_slider[$i]["price"]) { ?>
                                    <div class="slider-price">
                                        <p><?=CURRENCY_SYMBOL." ".$array_slider[$i]["price"]?></p>
                                    </div>
                                <? } ?>

                                <div class="slider-title">
                                    <h2><?=string_htmlentities($array_slider[$i]["title"]);?></h2>
                                    <p><?=system_showTruncatedText(string_htmlentities($array_slider[$i]["description"]), SLIDER_MAX_CHARS, "");?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                
            <? } ?>
            </ul>
            
        </div>
    <? } ?>