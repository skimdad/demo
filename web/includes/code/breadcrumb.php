<?

	/* ==================================================================*\
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
	\*================================================================== */

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/breadcrumb.php
	# ----------------------------------------------------------------------------------------------------

	$lang_order = language_getIndex(EDIR_LANGUAGE);

	$queryString = $_SERVER["REQUEST_URI"];
	if (string_substr($queryString, 1, 2) == EDIR_LANGUAGEABBREVIATION) {
		$queryString = string_substr($queryString, 3, string_strlen($queryString));
	}

	$type_array = explode("/", $queryString);
	$sub_folder = 0;

	if (EDIRECTORY_FOLDER != '') {
		$sub_folder = string_substr(EDIRECTORY_FOLDER, 1);
		$countAux = string_substr_count($sub_folder, "/");
		$count = 0;
		if (REDIRECT_EDIR_LANGUAGE){
			$count = 3;
		} else {
			$count = 2;
		}
		$type = $type_array[$count + $countAux];

		$aux1 = explode("/", NON_LANG_URL . "/" . LISTING_FEATURE_FOLDER);
		$aux2 = explode("/", NON_LANG_URL . "/" . EVENT_FEATURE_FOLDER);
		$aux3 = explode("/", NON_LANG_URL . "/" . ARTICLE_FEATURE_FOLDER);
		$aux4 = explode("/", NON_LANG_URL . "/" . CLASSIFIED_FEATURE_FOLDER);
		$aux5 = explode("/", NON_LANG_URL . "/" . PROMOTION_FEATURE_FOLDER);

		if ((!strcmp($type, LISTING_FEATURE_FOLDER)) || (!strcmp($type, $aux1[3 + $countAux]))) {
			if (strcmp(LISTING_FEATURE_FOLDER, $aux1[3 + $countAux])) {
				$type = 'listing';
			} elseif (!strcmp($type, LISTING_FEATURE_FOLDER)) {
				$type = 'listing';
			}
		} elseif ((!strcmp($type, EVENT_FEATURE_FOLDER)) || (!strcmp($type, $aux2[3 + $countAux]))) {
			if (strcmp(EVENT_FEATURE_FOLDER, $aux2[3 + $countAux])) {
				$type = 'event';
			} elseif (!strcmp($type, EVENT_FEATURE_FOLDER)) {
				$type = 'event';
			}
		} elseif ((!strcmp($type, ARTICLE_FEATURE_FOLDER)) || (!strcmp($type, $aux3[3 + $countAux]))) {
			if (strcmp(ARTICLE_FEATURE_FOLDER, $aux3[3 + $countAux])) {
				$type = 'article';
			} elseif (!strcmp($type, ARTICLE_FEATURE_FOLDER)) {
				$type = 'article';
			}
		} elseif ((!strcmp($type, CLASSIFIED_FEATURE_FOLDER)) || (!strcmp($type, $aux4[3 + $countAux]))) {

			if (strcmp(CLASSIFIED_FEATURE_FOLDER, $aux4[3 + $countAux])) {
				$type = 'classified';
			} elseif (!strcmp($type, CLASSIFIED_FEATURE_FOLDER)) {
				$type = 'classified';
			}
		} elseif ((!strcmp($type, PROMOTION_FEATURE_FOLDER)) || (!strcmp($type, $aux5[3 + $countAux]))) {

			if (strcmp(PROMOTION_FEATURE_FOLDER, $aux5[3 + $countAux])) {
				$type = 'promotion';
			} elseif (!strcmp($type, PROMOTION_FEATURE_FOLDER)) {
				$type = 'promotion';
			}
		}

		$page = $type_array[3 + $countAux];
	} else {
		$type = $type_array[1];

		$aux1 = explode("/", NON_LANG_URL . "/" . LISTING_FEATURE_FOLDER);
		$aux2 = explode("/", NON_LANG_URL . "/" . EVENT_FEATURE_FOLDER);
		$aux3 = explode("/", NON_LANG_URL . "/" . ARTICLE_FEATURE_FOLDER);
		$aux4 = explode("/", NON_LANG_URL . "/" . CLASSIFIED_FEATURE_FOLDER);
		$aux5 = explode("/", NON_LANG_URL . "/" . PROMOTION_FEATURE_FOLDER);

		if (strcmp(LISTING_FEATURE_FOLDER, $aux1[3])) {
			$type = 'listing';
		} elseif (!strcmp($type, LISTING_FEATURE_FOLDER)) {
			$type = 'listing';
		} elseif (strcmp(EVENT_FEATURE_FOLDER, $aux2[3])) {
			$type = 'event';
		} elseif (!strcmp($type, EVENT_FEATURE_FOLDER)) {
			$type = 'event';
		} elseif (strcmp(ARTICLE_FEATURE_FOLDER, $aux3[3])) {
			$type = 'article';
		} elseif (!strcmp($type, ARTICLE_FEATURE_FOLDER)) {
			$type = 'article';
		} elseif (strcmp(CLASSIFIED_FEATURE_FOLDER, $aux4[3])) {
			$type = 'classified';
		} elseif (!strcmp($type, CLASSIFIED_FEATURE_FOLDER)) {
			$type = 'classified';
		} elseif (strcmp(PROMOTION_FEATURE_FOLDER, $aux5[3])) {
			$type = 'promotion';
		} elseif (!strcmp($type, PROMOTION_FEATURE_FOLDER)) {
			$type = 'promotion';
		}

		$page = $type_array[2];
	}

	if ($_SERVER["REQUEST_METHOD"] == "GET") {

		extract($_GET);
		
		/**
		 * @categories
		 */
		if ($_GET["category_id"] && !$section) {
			$section = "category";
			$item_id = $category_id;
			if ($type == "promotion")
				$typeObj = "ListingCategory";
			else
				$typeObj = ucfirst($type) . "Category";
			$category = new $typeObj($item_id);
			$lang_cat = "title" . $lang_order;
			$category_name = $category->$lang_cat;
			$category_url = "/$type/results.php?category_id=$item_id";
		}

		/**
		 * @locations
		 */
		if (!$section && ($location_1 || $location_2 || $location_3 || $location_4 || $location_5 || $dist)) {
			$section = "location";
			$item_id = array();
			$location_name = array();
			$location_url = "/$type/results.php?qr=";

			$_locations = explode(",", EDIR_LOCATIONS);
			$locations_default = explode(",", EDIR_DEFAULT_LOCATIONSHOW);
			$j = 0;
			foreach ($_locations as $_location) {

				if ($location_1 && $_location == 1)
					$id = $location_1;
				elseif ($location_2 && $_location == 2)
					$id = $location_2;
				elseif ($location_3 && $_location == 3)
					$id = $location_3;
				elseif ($location_4 && $_location == 4)
					$id = $location_4;
				elseif ($location_5 && $_location == 5)
					$id = $location_5;
				$j++;
				if ($id) {
					$class = "Location" . $_location;
					$locationObj = new $class($id);
					$item_id[] = $id;
					$location_name[] = $locationObj->name;
					$location_url .= "&location_" . $_location . "=$id";
				}
				unset($id);
			}
		}

		if ($page == "alllocations.php")
			$section = "alllocations";
		if ($page == "allcategories.php")
			$section = "allcategories";
		if ($page == "alltemplates.php")
			$section = "alltemplates";
		if (($type == '') || (string_strpos($type, ".php") != ''))
			$section = "home";
	}
	if (($sitecontentSection == "Error Page") || ($type == '') || (string_strpos($type, ".php") != ''))
		$section = "home";
    # ----------------------------------------------------------------------------------------------------