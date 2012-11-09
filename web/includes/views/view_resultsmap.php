<?php
    if($searchResults) {

        /* create objects */
        $googleMap = new GoogleMap();
        $googleSettingObj = new GoogleSettings(GOOGLE_MAPS_SETTING, $_SERVER["HTTP_HOST"]);
        
        /* key for demodirectory.com */
		if (DEMO_LIVE_MODE) {
			$googleMapsKey = GOOGLE_MAPS_APP_DEMO;
		} else {
            $googleMapsKey = ($googleSettingObj->getString("value"));
        }

        /* settings */
        $googleMap->setDivName("resultsMap");
        $googleMap->setCssClass("googleBase");
        $googleMap->setGoogleMapKey($googleMapsKey);

		$cont=0;
        /* address */
		$numberPromotionResult=0;

        foreach($searchResults as $eachResult) {
			$cont++;
			$article=0;

			if (is_object($eachResult)) {
				$auxListing = new Listing();
				$auxClassified = new Classified();
				$auxEvent = new Event();
				$auxArticle = new Article();
				$auxPromotion = new Promotion();

				$aux = $eachResult->data_in_array;

				if ($eachResult instanceof $auxListing){
					$url_detail=LISTING_DEFAULT_URL;
					$item_typeMap="listing";
				}elseif ($eachResult instanceof $auxClassified){
					$url_detail=CLASSIFIED_DEFAULT_URL;
					$item_typeMap="classified";
					$levelObj = new ClassifiedLevel();
				}elseif ($eachResult instanceof $auxEvent){
					$url_detail=EVENT_DEFAULT_URL;
					$item_typeMap="event";
					$levelObj = new EventLevel();
				}elseif ($eachResult instanceof $auxArticle){
					$article=1;
					$item_typeMap="article";
					$levelObj = new ArticleLevel();
				}elseif ($eachResult instanceof $auxPromotion){
					$url_detail=PROMOTION_DEFAULT_URL;
					$numberPromotionResult++;
					$item_typeMap="listing";
				}
			} else if (is_array($eachResult)) {
				$aux = $eachResult;
				if ($item_type == "listing") {
					$url_detail=LISTING_DEFAULT_URL;
					$item_typeMap="listing";
				} else if ($item_type == "promotion") {
					$url_detail=PROMOTION_DEFAULT_URL;
					$numberPromotionResult++;
					$item_typeMap="listing";
				} else if ($item_type == "classified") {
					$url_detail=CLASSIFIED_DEFAULT_URL;
					$item_typeMap="classified";
				} else if ($item_type == "event") {
					$url_detail=EVENT_DEFAULT_URL;
					$item_typeMap="event";
				} else {
					$article=1;
					$item_typeMap="article";
				}
			}

            if($item_type == 'promotion'){
                $promotionTemp = new Promotion($aux['promotion_id']);
                $aux["friendly_url"] = $promotionTemp->getString("friendly_url");
            }

			if (($item_type!="listing" && $item_typeMap!="article")){
				$aux["location_1_title"] = $eachResult->getLocationString("1", true);
				$aux["location_3_title"] = $eachResult->getLocationString("3", true);
				$aux["location_4_title"] = $eachResult->getLocationString("4", true);
			}

			if ($article==0){
				if ($aux["latitude"] && $aux["longitude"]) {
					$item_level = htmlspecialchars($aux["level"]);
					$html = '';
					if(string_strlen(trim(htmlspecialchars($aux["title"]))) > 0) {

						$html  = '<div>';

						unset($arrImage);
						$arrImage["id"] = htmlspecialchars($aux["thumb_id"]);
						$arrImage["type"] = htmlspecialchars($aux["thumb_type"]);
						$arrImage["width"] = htmlspecialchars($aux["thumb_width"]);
						$arrImage["height"] = htmlspecialchars($aux["thumb_height"]);

						$image = new Image($arrImage);
						if ($image->imageExists()) {
							$html .=  "<img style='float:left; margin-right:15px;' width='". (IMAGE_LISTING_THUMB_WIDTH - 25) ."' heigth='". (IMAGE_LISTING_THUMB_HEIGHT - 25) ."'  src='" . IMAGE_URL . "/".$image->getString('prefix')."photo_". $image->getNumber('id') ."." . string_strtolower($image->getString('type')) . "' />";
						}

                        if($promotions) {
                            $html .= '<strong>'.$promotionTitle[htmlspecialchars($aux["id"])].'</strong><br />';
                            $html .= '<i>'.system_showText(LANG_PROMOTION_OFFEREDBY).' '.htmlspecialchars($aux["title"]).'</i><br />';
                        } else {
                            $html .= '<strong>'.htmlspecialchars($aux["title"]).'</strong><br />';
                        }
                        
						$html .= str_replace('"', '', str_replace("'", "", htmlspecialchars($aux["address"])));
						( htmlspecialchars($aux["address"]) && (htmlspecialchars($aux["location_4_title"]) || htmlspecialchars($aux["location_3_title"])) ) ? $html .= ', ' : '';
						$html .= str_replace('"', '', str_replace("'", "", htmlspecialchars($aux["location_4_title"])));
						( htmlspecialchars($aux["location_4_title"]) ) ? $html .= ', ' : '';
						$html .= str_replace('"', '', str_replace("'", "", htmlspecialchars($aux["location_3_title"])));
						(htmlspecialchars($aux["zip_code"])) ? $html .= '<br />' : '';
						$html .= str_replace('"', '', str_replace("'", "", htmlspecialchars($aux["zip_code"])));

						if (!$profile_review) {

                            if(string_strpos($_SERVER["PHP_SELF"], PROMOTION_FEATURE_NAME  . '/') > 0){
								if (MODREWRITE_FEATURE == "on") {
									$html .= "<br /><br /><a href='#" . htmlspecialchars($aux["friendly_url"]) ."'>".system_showText(LANG_VIEWSUMMARY)."</a>";
									$html .= " | <a href='" . PROMOTION_DEFAULT_URL    . "/" . htmlspecialchars($aux["friendly_url"]) .".html'>".system_showText(LANG_VIEWDETAIL)."</a>";
								} else {
									$html .= "<br /><br /><a href='#" . htmlspecialchars($aux["friendly_url"]) ."'>".system_showText(LANG_VIEWSUMMARY)."</a>";
									$html .= " | <a href='" . PROMOTION_DEFAULT_URL    . '/detail.php?id=' . htmlspecialchars($aux["promotion_id"]) ."'>".system_showText(LANG_VIEWDETAIL)."</a>";
								}
                            }else $html .= "<br /><br /><a href='#" . htmlspecialchars($aux["friendly_url"]) ."'>".system_showText(LANG_VIEWSUMMARY)."</a>";


                        } else {
							$html .= "<br /><br />";

						}
						
                        if(($levelObj&&$levelObj->getDetail(htmlspecialchars($aux["level"])) == 'y') && ((string_strpos($_SERVER["PHP_SELF"], "deal/") == false))) {
                            if (MODREWRITE_FEATURE == "on") {
                                if(string_strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_NAME     . '/') > 0) { $html .= " | <a href='" . LISTING_DEFAULT_URL       . "/" . htmlspecialchars($aux["friendly_url"]) .".html'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                                else if(string_strpos($_SERVER["PHP_SELF"], EVENT_FEATURE_NAME       . '/') > 0) { $html .= " | <a href='" . EVENT_DEFAULT_URL         . "/" . htmlspecialchars($aux["friendly_url"]) .".html'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                                else if(string_strpos($_SERVER["PHP_SELF"], CLASSIFIED_FEATURE_NAME  . '/') > 0) { $html .= " | <a href='" . CLASSIFIED_DEFAULT_URL    . "/" . htmlspecialchars($aux["friendly_url"]) .".html'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                                else { $html .= " | <a href='".$url_detail."/".htmlspecialchars($aux["friendly_url"]).".html'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                            } else {
                                if(string_strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_NAME     . '/') > 0) { $html .= " | <a href='" . LISTING_DEFAULT_URL       . '/detail.php?id=' . htmlspecialchars($aux["id"]) ."'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                                else if(string_strpos($_SERVER["PHP_SELF"], EVENT_FEATURE_NAME       . '/') > 0) { $html .= " | <a href='" . EVENT_DEFAULT_URL         . '/detail.php?id=' . htmlspecialchars($aux["id"]) ."'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                                else if(string_strpos($_SERVER["PHP_SELF"], CLASSIFIED_FEATURE_NAME  . '/') > 0) { $html .= " | <a href='" . CLASSIFIED_DEFAULT_URL    . '/detail.php?id=' . htmlspecialchars($aux["id"]) ."'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                                else { $html .= " | <a href='".$url_detail.'/detail.php?id='.htmlspecialchars($aux["id"])."'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                            }
                        }

						$html .= '</div>';

					}

                    if ($profile_review) {
                        $html = str_replace("|", "", $html);
                    }
                    $aux["maptuning"] = $aux["latitude"].",".$aux["longitude"];

					$googleMap->addAddress(htmlspecialchars($aux["address"]),
										   "",
										   htmlspecialchars($aux["location_1_title"]),
										   htmlspecialchars($aux["location_3_title"]),
										   htmlspecialchars($aux["location_4_title"]),
										   htmlspecialchars($aux["zip_code"]),
										   htmlspecialchars($aux["maptuning"]), /* maptuning */
										   "", /* map_zoom */
										   $html,$item_level,$item_typeMap
										  );
				}
			}
        }

        /* google map code */
        echo $googleMap->getMapCodev3();
    }
?>