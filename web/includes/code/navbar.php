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
	# * FILE: /includes/code/navbar.php
	# ----------------------------------------------------------------------------------------------------

	############################################################################
	#	NAVBAR MODULE NAMES
	############################################################################
	if ($_REQUEST['selected_domain_id'])
		$selected_domain_id = $_REQUEST['selected_domain_id'];
	else $selected_domain_id = SELECTED_DOMAIN_ID;

	$domainObj = new Domain($selected_domain_id);
	$domainURL = "http://".$domainObj->getString('url').EDIRECTORY_FOLDER;

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR SEQUENCE TEXT FILE
	# ----------------------------------------------------------------------------------------------------
	define("NAVBAR_TEXTFILE_FILE_HEADER", EDIRECTORY_ROOT."/custom/domain_".$selected_domain_id."/navigation/navbar_header.xml");
	define("NAVBAR_TEXTFILE_FILE_FOOTER", EDIRECTORY_ROOT."/custom/domain_".$selected_domain_id."/navigation/navbar_footer.xml");

	$liid = 0;
	// DEFAULT STRUCTURE WHEN NOTHING IS CUSTOMIZED
	$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
	$num_languages = count(explode(",", EDIR_LANGUAGENAMES));

	############################################################################
	# PREPARE ARRAY WITH OPTION TO HEADER
	############################################################################
	$aux_header = array(
					array(
						'area'=>1,
						'item'=>'index',
						'li_id'=>'navbar'.$liid++,
						'link'=>$domainURL.'/',
						'target'=>'self',
						'name_1'=>"Home",
						'name_2'=>"Home",
						'name_3'=>"Inicio",
						'name_4'=>"Accueil",
						'name_5'=>"Home",
						'name_6'=>"Home",
						'name_7'=>"Ana Sayfa"

					),
					array(
						'area'=>1,
						'item'=> LISTING_FEATURE_FOLDER,
						'li_id'=>'navbar'.$liid++,
						'link'=>$domainURL.'/'.LISTING_FEATURE_FOLDER.'/',
						'target'=>'self',
						'name_1'=>"Listings",
						'name_2'=>"Empresas",
						'name_3'=>"Listados",
						'name_4'=>"Listes",
						'name_5'=>"Listings",
						'name_6'=>"Einträge",
						'name_7'=>"Listeler"
					)
	) ;


	if($domainObj->getString("event_feature") == "on"){
		array_push($aux_header, array(
				'area'=>1,
				'item'=>EVENT_FEATURE_FOLDER,
				'li_id'=>'navbar'.$liid++,
				'link'=>$domainURL.'/'.EVENT_FEATURE_FOLDER.'/',
				'target'=>'self',
				'name_1'=>"Events",
				'name_2'=>"Eventos",
				'name_3'=>"Eventos",
				'name_4'=>"Événements",
				'name_5'=>"Eventi",
				'name_6'=>"Ereignisse",
				'name_7'=>"Aktiviteler"
			));
	}

	if($domainObj->getString("classified_feature") == "on"){
		array_push($aux_header, array(
				'area'=>1,
				'item'=> CLASSIFIED_FEATURE_FOLDER,
				'li_id'=>'navbar'.$liid++,
				'link'=>$domainURL.'/'.CLASSIFIED_FEATURE_FOLDER.'/',
				'target'=>'self',
				'name_1'=>"Classifieds",
				'name_2'=>"Classificados",
				'name_3'=>"Clasificados",
				'name_4'=>"Annonces",
				'name_5'=>"Annunci",
				'name_6'=>"Anzeigen",
				'name_7'=>"İlanlar"
			));
	}


	if($domainObj->getString("article_feature") == "on"){
		array_push($aux_header, array(
				'area'=>1,
				'item'=> ARTICLE_FEATURE_FOLDER,
				'li_id'=>'navbar'.$liid++,
				'link'=>$domainURL.'/'.ARTICLE_FEATURE_FOLDER.'/',
				'target'=>'self',
				'name_1'=>"Articles",
				'name_2'=>"Artigos",
				'name_3'=>"Artículos",
				'name_4'=>"Articles",
				'name_5'=>"Articoli",
				'name_6'=>"Artikel",
				'name_7'=>"Makaleler"
			));
	}

	if (CUSTOM_HAS_PROMOTION == "on") {
		$hasPromotion = true;
	}

	if(PROMOTION_FEATURE == 'on' && $hasPromotion){
		array_push($aux_header, array(
					'area'=>1,
					'item'=> PROMOTION_FEATURE_FOLDER,
					'li_id'=>'navbar'.$liid++,
					'link'=>$domainURL.'/'.PROMOTION_FEATURE_FOLDER.'/',
					'target'=>'self',
					'name_1'=>"Deals",
					'name_2'=>"Ofertas",
					'name_3'=>"Ofertas",
					'name_4'=>"Offres",
					'name_5'=>"Offerte",
					'name_6'=>"Angebote",
					'name_7'=>"Teklifler"
				));
	}

	if(BLOG_FEATURE == "on"){
		array_push($aux_header, array(
					'area'=>1,
					'item'=> BLOG_FEATURE_FOLDER,
					'li_id'=>'navbar'.$liid++,
					'link'=>$domainURL.'/'.BLOG_FEATURE_FOLDER.'/',
					'target'=>'self',
					'name_1'=>"Blog",
					'name_2'=>"Blog",
					'name_3'=>"Blog",
					'name_4'=>"Blog",
					'name_5'=>"Blog",
					'name_6'=>"Blog",
					'name_7'=>"Blog"
				));
	}

	array_push($aux_header, array(
				'area'=>1,
				'item'=>'advertise',
				'li_id'=>'navbar'.$liid++,
				'link'=>$domainURL.'/advertise.php',
				'target'=>'self',
				'name_1'=>"Advertise With Us",
				'name_2'=>"Anuncie Aqui",
				'name_3'=>"Anunciate",
				'name_4'=>"Publicité",
				'name_5'=>"Fai pubblicità con noi",
				'name_6'=>"Werbung",
				'name_7'=>"İlan Verin"
			));

	array_push($aux_header, array(
				'area'=>1,
				'item'=>'contactus',
				'li_id'=>'navbar'.$liid++,
				'link'=>$domainURL.'/contactus.php',
				'target'=>'self',
				'name_1'=>"Contact Us",
				'name_2'=>"Contato",
				'name_3'=>"Contáctenos",
				'name_4'=>"Contacter",
				'name_5'=>"Contattaci",
				'name_6'=>"Kontakt",
				'name_7'=>"Bize Ulaşın"
			));
	############################################################################

	$array_languagesNavbar = explode(",", EDIR_LANGUAGES);

	$langObj = new Lang();

	foreach($array_languagesNavbar as $langNavbar){

		$j = 0;
		$i = $langObj->returnLangId($langNavbar);
		$aux_header[$j]["name_$i"] = system_findTranslationFor("LANG_MENU_HOME",$langNavbar);
		$j++;

		if ($langNavbar != "en_us"){
			$aux_header[$j]["name_$i"] = string_ucwords(system_findTranslationFor("LANG_MENU_LISTING",$langNavbar));
			$j++;

			if($domainObj->getString("event_feature") == "on"){
				$aux_header[$j]["name_$i"] = string_ucwords(system_findTranslationFor("LANG_MENU_EVENT",$langNavbar));
				$j++;
			}

			if($domainObj->getString("classified_feature") == "on"){
				$aux_header[$j]["name_$i"] = string_ucwords(system_findTranslationFor("LANG_MENU_CLASSIFIED",$langNavbar));
				$j++;
			}

			if($domainObj->getString("article_feature") == "on"){
				$aux_header[$j]["name_$i"] = string_ucwords(system_findTranslationFor("LANG_MENU_ARTICLE",$langNavbar));
				$j++;
			}

			if(PROMOTION_FEATURE == 'on' && $hasPromotion){
				$aux_header[$j]["name_$i"] = string_ucwords(system_findTranslationFor("LANG_MENU_PROMOTION",$langNavbar));
				$j++;
			}

			if(BLOG_FEATURE == "on"){
				$aux_header[$j]["name_$i"] = string_ucwords(system_findTranslationFor("LANG_MENU_BLOG",$langNavbar,true));
				$j++;
			}

			$aux_header[$j]["name_$i"] = system_findTranslationFor("LANG_MENU_ADVERTISE",$langNavbar);
			$j++;

			$aux_header[$j]["name_$i"] = system_findTranslationFor("LANG_MENU_CONTACT",$langNavbar);
			$j++;

		} else {
			$aux_header[$j]["name_$i"] = string_ucwords(LISTING_FEATURE_NAME_PLURAL);
			$j++;

			if($domainObj->getString("event_feature") == "on"){
				$aux_header[$j]["name_$i"] = string_ucwords(EVENT_FEATURE_NAME_PLURAL);
				$j++;
			}

			if($domainObj->getString("classified_feature") == "on"){
				$aux_header[$j]["name_$i"] = string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL);
				$j++;
			}

			if($domainObj->getString("article_feature") == "on"){
				$aux_header[$j]["name_$i"] = string_ucwords(ARTICLE_FEATURE_NAME_PLURAL);
				$j++;
			}

			if(PROMOTION_FEATURE == 'on' && $hasPromotion){
				$aux_header[$j]["name_$i"] = string_ucwords(PROMOTION_FEATURE_NAME_PLURAL);
				$j++;
			}

			if(BLOG_FEATURE == "on"){
				$aux_header[$j]["name_$i"] = string_ucwords(system_findTranslationFor("LANG_MENU_BLOG",$langNavbar,true));
				$j++;
			}

			$aux_header[$j]["name_$i"] = system_findTranslationFor("LANG_MENU_ADVERTISE",$langNavbar);
			$j++;

			$aux_header[$j]["name_$i"] = system_findTranslationFor("LANG_MENU_CONTACT",$langNavbar);
			$j++;
		}
	}

	############################################################################
	# PREPARE ARRAY WITH ITEMS TO FOOTER
	############################################################################
	$aux_footer = array(
				array(
					'area'=>1,
					'item'=>'index',
					'li_id'=>'FM1_'.$liid++,
					'link'=>$domainURL.'/index.php',
					'target'=>'self',
					'name_1'=>"Home",
					'name_2'=>"Home",
					'name_3'=>"Inicio",
					'name_4'=>"Accueil",
					'name_5'=>"Home",
					'name_6'=>"Home",
					'name_7'=>"Ana Sayfa"
				),
				array(
					'area'=>1,
					'item'=>'advertise',
					'li_id'=>'FM1_'.$liid++,
					'link'=>$domainURL.'/advertise.php',
					'target'=>'self',
					'name_1'=>"Advertise With Us",
					'name_2'=>"Anuncie Aqui",
					'name_3'=>"Anunciate",
					'name_4'=>"Publicité",
					'name_5'=>"Fai pubblicità con noi",
					'name_6'=>"Werbung",
					'name_7'=>"Ilan Verin"
				),
				array(
					'area'=>1,
					'item'=>'faq',
					'li_id'=>'FM1_'.$liid++,
					'link'=>$domainURL.'/faq.php',
					'target'=>'self',
					'name_1'=>"FAQ",
					'name_2'=>"FAQ",
					'name_3'=>"Preguntas",
					'name_4'=>"Questions",
					'name_5'=>"FAQ",
					'name_6'=>"FAQ",
					'name_7'=>"SSS"
				),
				array(
					'area'=>1,
					'item'=>'sitemap',
					'li_id'=>'FM1_'.$liid++,
					'link'=>$domainURL.'/sitemap.php',
					'target'=>'self',
					'name_1'=>"Sitemap",
					'name_2'=>"Mapa do Site",
					'name_3'=>"Mapa del sitio",
					'name_4'=>"Plan du site",
					'name_5'=>"Mappa del sito",
					'name_6'=>"Sitemap",
					'name_7'=>"Site haritası"
				),
				array(
					'area'=>1,
					'item'=>'contactus',
					'li_id'=>'FM1'.$liid++,
					'link'=>$domainURL.'/contactus.php',
					'target'=>'self',
					'name_1'=>"Contact Us",
					'name_2'=>"Contato",
					'name_3'=>"Contáctenos",
					'name_4'=>"Contacter",
					'name_5'=>"Contattaci",
					'name_6'=>"Kontakt",
					'name_7'=>"Bize Ulaşın"
				),
				array(
					'area'=>2,
					'item'=> LISTING_FEATURE_FOLDER,
					'li_id'=>'FM2_'.$liid++,
					'link'=>$domainURL.'/'.LISTING_FEATURE_FOLDER.'/',
					'target'=>'self',
					'name_1'=>"Listings",
					'name_2'=>"Empresas",
					'name_3'=>"Listados",
					'name_4'=>"Listes",
					'name_5'=>"Listings",
					'name_6'=>"Einträge",
					'name_7'=>"Listeler"
				)
	);


	if($domainObj->getString("event_feature") == "on"){

		array_push($aux_footer, array(
				'area'=>2,
				'item'=> EVENT_FEATURE_FOLDER,
				'li_id'=>'FM2_'.$liid++,
				'link'=>$domainURL.'/'.EVENT_FEATURE_FOLDER.'/',
				'target'=>'self',
				'name_1'=>"Events",
				'name_2'=>"Eventos",
				'name_3'=>"Eventos",
				'name_4'=>"Événements",
				'name_5'=>"Eventi",
				'name_6'=>"Ereignisse",
				'name_7'=>"Aktiviteler"
			));
	}

	if($domainObj->getString("classified_feature") == "on"){
		array_push($aux_footer, array(
				'area'=>2,
				'item'=> CLASSIFIED_FEATURE_FOLDER,
				'li_id'=>'FM2_'.$liid++,
				'link'=>$domainURL.'/'.CLASSIFIED_FEATURE_FOLDER.'/',
				'target'=>'self',
				'name_1'=>"Classifieds",
				'name_2'=>"Classificados",
				'name_3'=>"Clasificados",
				'name_4'=>"Annonces",
				'name_5'=>"Annunci",
				'name_6'=>"Anzeigen",
				'name_7'=>"İlanlar"
			));
	}

	if($domainObj->getString("article_feature") == "on"){
		array_push($aux_footer, array(
				'area'=>2,
				'item'=> ARTICLE_FEATURE_FOLDER,
				'li_id'=>'FM2_'.$liid++,
				'link'=>$domainURL.'/'.ARTICLE_FEATURE_FOLDER.'/',
				'target'=>'self',
				'name_1'=>"Articles",
				'name_2'=>"Artigos",
				'name_3'=>"Artículos",
				'name_4'=>"Articoli",
				'name_5'=>"Article",
				'name_6'=>"Artikel",
				'name_7'=>"Makaleler"
			));
	}

	if(PROMOTION_FEATURE == 'on' && $hasPromotion){
		array_push($aux_footer, array(
					'area'=>2,
					'item'=> PROMOTION_FEATURE_FOLDER,
					'li_id'=>'FM2_'.$liid++,
					'link'=>$domainURL.'/'.PROMOTION_FEATURE_FOLDER.'/',
					'target'=>'self',
					'name_1'=>"Deals",
					'name_2'=>"Ofertas",
					'name_3'=>"Ofertas",
					'name_4'=>"Offres",
					'name_5'=>"Offerte",
					'name_6'=>"Angebote",
					'name_7'=>"Teklifler"
				));
	}

	if(BLOG_FEATURE == 'on'){
		array_push($aux_footer, array(
					'area'=>2,
					'item'=> BLOG_FEATURE_FOLDER,
					'li_id'=>'FM2_'.$liid++,
					'link'=>$domainURL.'/'.BLOG_FEATURE_FOLDER.'/',
					'target'=>'self',
					'name_1'=>"Blog",
					'name_2'=>"Blog",
					'name_3'=>"Blog",
					'name_4'=>"Blog",
					'name_5'=>"Blog",
					'name_6'=>"Blog",
					'name_7'=>"Blog"
				));
	}

	foreach($array_languagesNavbar as $langNavbar){

		$j = 0;
		$i = $langObj->returnLangId($langNavbar);

		$aux_footer[$j]["name_$i"] = system_findTranslationFor("LANG_MENU_HOME",$langNavbar);
		$j++;

		$aux_footer[$j]["name_$i"] = system_findTranslationFor("LANG_MENU_ADVERTISE",$langNavbar);
		$j++;

		$aux_footer[$j]["name_$i"] = system_findTranslationFor("LANG_MENU_FAQ",$langNavbar);
		$j++;

		$aux_footer[$j]["name_$i"] = system_findTranslationFor("LANG_MENU_SITEMAP",$langNavbar);
		$j++;

		$aux_footer[$j]["name_$i"] = system_findTranslationFor("LANG_MENU_CONTACT",$langNavbar);
		$j++;

		if ($langNavbar != "en_us"){
			$aux_footer[$j]["name_$i"] = string_ucwords(system_findTranslationFor("LANG_MENU_LISTING",$langNavbar));
			$j++;

			if($domainObj->getString("event_feature") == "on"){
				$aux_footer[$j]["name_$i"] = string_ucwords(system_findTranslationFor("LANG_MENU_EVENT",$langNavbar));
				$j++;
			}

			if($domainObj->getString("classified_feature") == "on"){
				$aux_footer[$j]["name_$i"] = string_ucwords(system_findTranslationFor("LANG_MENU_CLASSIFIED",$langNavbar));
				$j++;
			}

			if($domainObj->getString("article_feature") == "on"){
				$aux_footer[$j]["name_$i"] = string_ucwords(system_findTranslationFor("LANG_MENU_ARTICLE",$langNavbar));
				$j++;
			}

			if(PROMOTION_FEATURE == 'on' && $hasPromotion){
				$aux_footer[$j]["name_$i"] = string_ucwords(system_findTranslationFor("LANG_MENU_PROMOTION",$langNavbar));
				$j++;
			}

			if(BLOG_FEATURE == "on"){
				$aux_footer[$j]["name_$i"] = string_ucwords(system_findTranslationFor("LANG_MENU_BLOG",$langNavbar,true));
				$j++;
			}

		} else {
			$aux_footer[$j]["name_$i"] = string_ucwords(LISTING_FEATURE_NAME_PLURAL);
			$j++;

			if($domainObj->getString("event_feature") == "on"){
				$aux_footer[$j]["name_$i"] = string_ucwords(EVENT_FEATURE_NAME_PLURAL);
				$j++;
			}

			if($domainObj->getString("classified_feature") == "on"){
				$aux_footer[$j]["name_$i"] = string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL);
				$j++;
			}

			if($domainObj->getString("article_feature") == "on"){
				$aux_footer[$j]["name_$i"] = string_ucwords(ARTICLE_FEATURE_NAME_PLURAL);
				$j++;
			}

			if(PROMOTION_FEATURE == 'on' && $hasPromotion){
				$aux_footer[$j]["name_$i"] = string_ucwords(PROMOTION_FEATURE_NAME_PLURAL);
				$j++;
			}

			if(BLOG_FEATURE == "on"){
				$aux_footer[$j]["name_$i"] = string_ucwords(system_findTranslationFor("LANG_MENU_BLOG",$langNavbar,true));
				$j++;
			}

		}
	}

	$navBarSequenceArray= array('header'=>$aux_header,'footer'=>$aux_footer);

	if (!$navbarType)
		$navbarType = 'header';
	$str_languages = explode(",", EDIR_LANGUAGES);
	$totalFromThisArray = count($navBarSequenceArray[$navbarType]);
	if ($num_languages){
		for ($item=0;$item<$totalFromThisArray;$item++){
			for ($i=1;$i<$num_languages;$i++) {
				$auxLang = $langObj->returnLangId($str_languages[$i-1]);
				$varName="name_{$auxLang}";
				$navBarSequenceArray[$navbarType][$item][$varName]=$navBarSequenceArray[$navbarType][$item]["name_{$auxLang}"];
			}
		}
	}

	$buildArray = $navBarSequenceArray[$navbarType];

	// STARTS A NEW NAVBAR FILE
	if ($navbarType == 'header'){
		$XML_file = NAVBAR_TEXTFILE_FILE_HEADER.'';
	}else{
	 	$XML_file = NAVBAR_TEXTFILE_FILE_FOOTER.'';
	 }

	$createNewFile = false;
	if (!file_exists($XML_file)){
		$createNewFile = true;
	} else{
		$navBarStructure = loadNavBarSequence($XML_file,$selected_domain_id);
		if (!$navBarStructure) {
			$createNewFile = true;
		} else if (!is_array($navBarStructure)) {
			$createNewFile = true;
		}
	}


	/**
	 * CREATING NEW FILE
	 */
	if ($createNewFile){
		if (!saveNavBarSequence($XML_file,$buildArray,$navbarType,$selected_domain_id))
			$navBarStructure = $buildArray;
	}

	/**
	 * $navBarStructure is ready
	 */

	if (!$hidenavBar){

		$navBarStructure = loadNavBarSequence($XML_file,$selected_domain_id);

		if ($browsebylocation|| $browsebycategory || $modRewrited)
			$urlITEMS = explode("/",$_SERVER['REQUEST_URI']);

		$urlITEMSaux = explode("/",$_SERVER['REQUEST_URI']);

		$uniqueLink = 1;
        $stopSearchingClasses = false;
		if (!isset($allLanguages)){ //$allLanguages was defined in layout/langnavbar.php
			$langObj = new Lang();
			$allLanguages = $langObj->getAll();
		}
		
		/*
		 * Get default language to prepare navigation
		 */
		$auxLangDefault = explode("_", EDIR_DEFAULT_LANGUAGE);
		$auxLangDefault = $auxLangDefault[0];

		foreach ($navBarStructure as $itemName=>$itemValues){
			$uniqueLink++;
			// FOOTER AREA
			if (!$filterArea)
				$filterArea = 1;

			extract($itemValues);
            
            if(preg_match('/(www.)/', $_SERVER['SERVER_NAME']) && !string_strpos("www.",$link)) {
                $link = str_replace('http://','http://www.',$link);
            }

			if ($filterArea == $area){

				$showit = true;
				$class = '';
				if ($removeLinks)
					$link = 'javascript:void(0);';

				$serverPort = $serverPort = ":".$_SERVER["SERVER_PORT"];
				if (string_strpos(DEFAULT_URL, $serverPort) === false) {
					$serverPort = "";
				}
				$currentPage = "http://".$_SERVER["SERVER_NAME"].$serverPort.$_SERVER["PHP_SELF"];
				$currentPageUNIndexed = str_replace('/index.php','/',$currentPage);
				$currentPageUNResults = str_replace('/results.php','/',$currentPage);

				if ($showit){

					// FIND CURRENT LANGUAGE: EDIR_LANGUAGE
					$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
					$num_languages = count(explode(",", EDIR_LANGUAGENAMES));

					for ($i=1; $i <= $num_languages; $i++) {
						// FIND CURRENT NAME

						foreach ($allLanguages as $orderInfo){
							if($orderInfo['id'] == EDIR_LANGUAGE){
								$idLang = $orderInfo['id_number'];
								$varName = "name_{$idLang}";
		 						$showName = ($$varName);
								$showName = str_replace("[PIPE]", "|", $showName);
								$showName = str_replace("[AMP]", "&", $showName);
								$showName = str_replace("[COMMA]", ",", $showName);
		 					}
						}
					}

					if (CUSTOM_HAS_PROMOTION == "on"){
						$hasPromotion = true;
					}

					$showItem = true;

					if($auxLangDefault != EDIR_LANGUAGEABBREVIATION){
						$link = str_replace("EDIR_LANGUAGEABBREVIATION", EDIR_LANGUAGEABBREVIATION, $link);
					}else{
						$link = str_replace("/EDIR_LANGUAGEABBREVIATION", "", $link);
					}
                    
                    /**
                     * CLASS ACTIVED
                     */
                    if (!$stopSearchingClasses){
						/*
						 * Prepare link to check
						 */						
						unset($actual_url);
						unset($aux_link);
						unset($aux_default_url);
						unset($aux_request_uri);

						$aux_default_url = DEFAULT_URL;
						$aux_request_uri = string_substr($_SERVER["REQUEST_URI"], 3, string_strlen($_SERVER["REQUEST_URI"]));

						if(string_strpos($link,"//www.") === false && string_strpos($aux_default_url,"//www.") !== false){
							$aux_link = str_replace("//www.","//",$aux_default_url);
						} else {
							$aux_link = $aux_default_url;
						}
						$aux_link = str_replace(EDIRECTORY_FOLDER,"",$aux_link);
						$indexFolder = count(explode("/", EDIRECTORY_FOLDER));
						if (REDIRECT_EDIR_LANGUAGE){
							$indexFolder++;
						}
						if (string_strpos($_SERVER["PHP_SELF"], "/content") !== false) {
							if ($_GET["content"]) {
								$linkContent = NON_LANG_URL."/content/".$_GET["content"].".html";
							}
						}
                        
                        if (EDIR_LANGUAGEABBREVIATION){
                            $aux_default_url = str_replace(EDIR_LANGUAGEABBREVIATION, "", $aux_default_url);
                        }
                        
                        $auxRequestURI = str_replace($aux_default_url, "", $link);
                        if (REDIRECT_EDIR_LANGUAGE){
                            $auxRequestURI = "/".EDIR_LANGUAGEABBREVIATION."/".$auxRequestURI;
                        }
                        if (EDIRECTORY_FOLDER) {
                            $auxRequestURI = EDIRECTORY_FOLDER.($auxRequestURI[0] == "/" ? $auxRequestURI : "/".$auxRequestURI);
                        }

                        if ($auxRequestURI == $_SERVER["REQUEST_URI"]){ 
                            $class= " class=\"menuActived\" ";
                        }
                        
                        $skeep = false;
                        foreach ($navBarStructure as $itemNameAux=>$itemValuesAux){
                            if (string_strpos($itemValuesAux["link"], str_replace(EDIR_LANGUAGEABBREVIATION."/", "", $_SERVER["REQUEST_URI"])) !== false){
                                $skeep = true;
                            }
                        }

                        if (!$skeep){
                            if ($link == $currentPage || $link == $currentPageUNIndexed || $link == $currentPageUNResults || $link == $aux_link.$aux_request_uri || $link == $linkContent || strpos($_SERVER['REQUEST_URI'],"home_results.php"))
                                $class= " class=\"menuActived\" ";

                            if ((string_strpos($_SERVER["PHP_SELF"], "/".string_strtolower(str_replace($_SERVER["PHP_SELF"], "", $link))) !== false) || string_strpos($_SERVER["PHP_SELF"], "/".string_strtolower(string_substr(str_replace($_SERVER["PHP_SELF"], "", $link),0,-1))) !== false){
                                 $class= " class=\"menuActived\" ";
                            }

                            if ($item == LISTING_FEATURE_FOLDER && $urlITEMSaux[$indexFolder] == LISTING_FEATURE_FOLDER && string_strpos($_SERVER["PHP_SELF"], "/".LISTING_FEATURE_FOLDER) !== false && !strpos($_SERVER['REQUEST_URI'],"home_results.php")){
                                $class= " class=\"menuActived\" ";
                            }

                            if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
                                if ($item == EVENT_FEATURE_FOLDER && $urlITEMSaux[$indexFolder] == EVENT_FEATURE_FOLDER && string_strpos($_SERVER["PHP_SELF"], "/".EVENT_FEATURE_FOLDER) !== false){
                                    $class= " class=\"menuActived\" ";
                                }
                            }

                            if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
                                if ($item == CLASSIFIED_FEATURE_FOLDER && $urlITEMSaux[$indexFolder] == CLASSIFIED_FEATURE_FOLDER && string_strpos($_SERVER["PHP_SELF"], "/".CLASSIFIED_FEATURE_FOLDER) !== false){
                                    $class= " class=\"menuActived\" ";
                                }
                            }

                            if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
                                if ($item == ARTICLE_FEATURE_FOLDER && $urlITEMSaux[$indexFolder] == ARTICLE_FEATURE_FOLDER && string_strpos($_SERVER["PHP_SELF"], "/".ARTICLE_FEATURE_FOLDER) !== false){
                                    $class= " class=\"menuActived\" ";
                                }
                            }

                            if (PROMOTION_FEATURE == "on" && $hasPromotion && CUSTOM_PROMOTION_FEATURE == "on") {
                                if ($item == PROMOTION_FEATURE_FOLDER && $urlITEMSaux[$indexFolder] == PROMOTION_FEATURE_FOLDER && string_strpos($_SERVER["PHP_SELF"], "/".PROMOTION_FEATURE_FOLDER) !== false){
                                    $class= " class=\"menuActived\" ";
                                }
                            }

                            if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") {
                                if ($item == BLOG_FEATURE_FOLDER && $urlITEMSaux[$indexFolder] == BLOG_FEATURE_FOLDER && string_strpos($_SERVER["PHP_SELF"], "/".BLOG_FEATURE_FOLDER) !== false){
                                    $class= " class=\"menuActived\" ";
                                }
                            }
                        }
                    }

					if ($item == EVENT_FEATURE_FOLDER){
						if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on"){
							$showItem = false;
						}
					}

					if ($item == CLASSIFIED_FEATURE_FOLDER){
						if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on"){
							$showItem = false;
						}
					}

					if ($item == ARTICLE_FEATURE_FOLDER){
						if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on"){
							$showItem = false;
						}
					}

					if ($item == PROMOTION_FEATURE_FOLDER){
						if (PROMOTION_FEATURE != "on" || CUSTOM_HAS_PROMOTION != "on" || CUSTOM_PROMOTION_FEATURE != "on"){
							$showItem = false;
						}
					}

					if ($item == BLOG_FEATURE_FOLDER){
						if (BLOG_FEATURE != "on" || CUSTOM_BLOG_FEATURE != "on"){
							$showItem = false;
						}
					}

					if ($showItem){
						if (EDIR_LANG_URL){
							$link = str_replace(NON_LANG_URL, DEFAULT_URL, $link);
						}
						
						if($sitemgr || $showName){
						
							?> 
							<li id="<?=($add_new_id_to_validade ? "nav_".$navbarType."_".$uniqueLink : $uniqueLink)?>" <?=$class?> <?=$aditionalProperty?$aditionalProperty:''?> <? if ($sitemgr){?> item="<?=$item?>" li_id="<?=$uniqueLink?>" class="<?=$uniqueLink?>" link="<?=$itemValues['link']?>" link_target="<?=$itemValues['target']?>" area="<?=$itemValues['area']?>" <?
								$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
								$num_languages = count(explode(",", EDIR_LANGUAGENAMES));
								for ($i=1;$i<=$num_languages;$i++) {
								$auxLang = $langObj->returnLangId($str_languages[$i-1]);
								$varName = "name_{$auxLang}";

							?> name_<?=$auxLang?>="<?echo $$varName ?>"<? } ?><? } ?>>											
							<a class="<?=$uniqueLink?>" href="<?=$link?>" target="_<?=$itemValues['target'] ? $itemValues['target'] : "self"?>"><?=($showName ? $showName : LANG_SITEMGR_EMPTY)?></a><?
   	                                     // aditional Edit Code buttons
   	                                     if($adicionalEditCode){
   	                                         $adicionalEditCode2=$adicionalEditCode;
   	                                             $adicionalEditCode2=str_replace('||REMOVE_ID||',$uniqueLink,$adicionalEditCode2);
   	                                             echo $adicionalEditCode2;	

                                         }

                                        ?></li> <?
	                       if ($class){
    	                       $stopSearchingClasses = true;
        	               }
						}
                    }
				}
			}
		}
	}
?>