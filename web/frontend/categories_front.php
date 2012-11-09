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
	# * FILE: /frontend/categories_front.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

    include(EDIRECTORY_ROOT."/includes/code/category_front.php");

    if ($showCategoriesAccordion){

        //LISTING CATEGORIES
        $sideBarStr .= "<h2>".system_showText(LANG_BROWSEBYCATEGORY)."</h2>
                            <ul id=\"accordion\">";

        if (is_string($categories_listing)) {

            $sideBarStr .="     <li class=\"accordion-item\">
                                    <h3><a href=\"javascript: void(0);\">".system_showText(LANG_LISTING_FEATURE_NAME_PLURAL)."</a></h3>
                                    <ul class=\"list current\">";

            $xml_categories = simplexml_load_string($categories_listing);
            if(count($xml_categories->info) > 0) {
                for($i=0;$i<count($xml_categories->info);$i++){
                    unset($categories_listing);
                    foreach($xml_categories->info[$i]->children() as $key => $value){
                        $categories_listing[$key] = $value;
                    }
                    if($categories_listing){
                        if (MODREWRITE_FEATURE == "on") {
                            $categoryLink = LISTING_DEFAULT_URL."/guide/".$categories_listing["friendly_url".$langIndex];
                        } else {
                            $categoryLink = LISTING_DEFAULT_URL."/results.php?category_id=".$categories_listing["id"];
                        }

                        $sideBarStr .="     <li><a href=\"".$categoryLink."\">".string_htmlentities($categories_listing["title".$langIndex])."</a>";

                        if(SHOW_CATEGORY_COUNT == "on"){
                            $sideBarStr .="     <span>(".$categories_listing["active_listing"].")</span>";    
                        }

                        $sideBarStr .="     </li>";

                    }
                }
            }
            if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
                $sideBarStr .= "        <li><a class=\"see-all\" href=\"".LISTING_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_LISTING_VIEWALLCATEGORIES)."</a></li>";
            }
            $sideBarStr .="			</ul>
                                </li>";
        }

        //EVENT CATEGORIES
        if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {

            if ($categories_event) {
                $sideBarStr .=" <li>
                                    <h3><a href=\"javascript: void(0);\">".system_showText(LANG_EVENT_FEATURE_NAME_PLURAL)."</a></h3>
                                    <ul class=\"list\">";

                for ($i=0; $i<count($categories_event); $i++) {
                    if (MODREWRITE_FEATURE == "on") {
                        $categoryLink = EVENT_DEFAULT_URL."/guide/".$categories_event[$i]["friendly_url".$langIndex];
                    } else {
                     $categoryLink = EVENT_DEFAULT_URL."/results.php?category_id=".$categories_event[$i]["id"];
                    }

                    $sideBarStr .="     <li><a href=\"".$categoryLink."\">".string_htmlentities($categories_event[$i]["title".$langIndex])."</a>";
                    if (SHOW_CATEGORY_COUNT == "on"){
                        $sideBarStr .="     <span>(".$categories_event[$i]["active_event"].")</span>";
                    }
                    $sideBarStr .="     </li>";
                }
                if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
                    $sideBarStr .="     <li><a class=\"see-all\" href=\"".EVENT_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_EVENT_VIEWALLCATEGORIES)."</a></li>";
                }
                $sideBarStr .="     </ul>
                                </li>";
            }
        }

        //CLASSIFIED CATEGORIES
        if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
            if ($categories_classified) {
                $sideBarStr .= " <li>
                                    <h3><a href=\"javascript: void(0);\">".system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL)."</a></h3>
                                    <ul class=\"list\">";

                for ($i=0; $i<count($categories_classified); $i++) {
                    if (MODREWRITE_FEATURE == "on") {
                        $categoryLink = CLASSIFIED_DEFAULT_URL."/guide/".$categories_classified[$i]["friendly_url".$langIndex];
                    } else {
                        $categoryLink = CLASSIFIED_DEFAULT_URL."/results.php?category_id=".$categories_classified[$i]["id"];
                    }

                    $sideBarStr .="     <li><a href=\"".$categoryLink."\">".string_htmlentities($categories_classified[$i]["title".$langIndex])."</a>";
                    if (SHOW_CATEGORY_COUNT == "on"){
                        $sideBarStr .="     <span>(".$categories_classified[$i]["active_classified"].")</span>";
                    } 
                    $sideBarStr .=" </li>";
                }	
                if (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
                    $sideBarStr .=" <li><a class=\"see-all\" href=\"".CLASSIFIED_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_CLASSIFIED_VIEWALLCATEGORIES)."</a></li>";
                }
                $sideBarStr .="     </ul>
                                </li>";
            }
        }

        //ARTICLE CATEGORIES
        if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {

            if ($categories_article) {

                $sideBarStr .=" <li>
                                    <h3><a href=\"javascript: void(0);\">".system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL)."</a></h3>
                                    <ul class=\"list\">";

                for ($i=0; $i<count($categories_article); $i++) {
                    if (MODREWRITE_FEATURE == "on") {
                        $categoryLink = ARTICLE_DEFAULT_URL."/guide/".$categories_article[$i]["friendly_url".$langIndex];
                    } else {
                        $categoryLink = ARTICLE_DEFAULT_URL."/results.php?category_id=".$categories_article[$i]["id"];
                    }

                    $sideBarStr .="     <li><a href=\"".$categoryLink."\">".string_htmlentities($categories_article[$i]["title".$langIndex])."</a>";
                    if (SHOW_CATEGORY_COUNT == "on"){
                        $sideBarStr .="     <span>(".$categories_article[$i]["active_article"].")</span>";
                    }
                    $sideBarStr .="     </li>";
                }
                if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION == "on") {
                    $sideBarStr .="     <li><a class=\"see-all\" href=\"".ARTICLE_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_ARTICLE_VIEWALLCATEGORIES)."</a></li>";
                }
                $sideBarStr .="     </ul>
                                </li>";
            }
        }

        //DEAL CATEGORIES
        if (CUSTOM_HAS_PROMOTION == "on" && PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on"){

            if (is_string($categories_deal)) {

                $sideBarStr .=" <li>
                                    <h3><a href=\"javascript: void(0);\">".system_showText(LANG_PROMOTION_FEATURE_NAME_PLURAL)."</a></h3>
                                    <ul class=\"list\">";

                $xml_categories = simplexml_load_string($categories_deal);
                if(count($xml_categories->info) > 0) {
                    for($i=0;$i<count($xml_categories->info);$i++){
                        unset($categories_deal);
                        foreach($xml_categories->info[$i]->children() as $key => $value){
                            $categories_deal[$key] = $value;
                        }
                        if($categories_deal){

                            if (MODREWRITE_FEATURE == "on") {
                                $categoryLink = PROMOTION_DEFAULT_URL."/guide/".$categories_deal["friendly_url".$langIndex];
                            } else {
                                $categoryLink = PROMOTION_DEFAULT_URL."/results.php?category_id=".$categories_deal["id"];
                            }

                            $sideBarStr .= " <li><a href=\"".$categoryLink."\">".string_htmlentities($categories_deal["title".$langIndex])."</a></li>";

                        }
                    }
                    if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
                        $sideBarStr .= "    <li><a class=\"see-all\" href=\"".PROMOTION_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_PROMOTION_VIEWALLCATEGORIES)."</a></li>";
                    }
                }
                $sideBarStr .="     </ul>
                                </li>";
            }
        }

        $sideBarStr .="	</ul>";
    }
		
?>