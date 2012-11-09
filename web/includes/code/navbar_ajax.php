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
    # * FILE: /includes/code/navbar_ajax.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");

    extract($_POST);

	/**
	 * SAVE ORDER, FORCE SAVING
	 */
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $action && !DEMO_LIVE_MODE) {

		if (CACHE_PARTIAL_FEATURE == "on"){
			cachepartial_removecache('footer');
		}
		
		if (CACHE_FULL_FEATURE == "on"){
			cachefull_forceExpiration();
		}

		$hidenavBar = true;

		include(INCLUDES_DIR.'/code/navbar.php');

		if ($action == 'restoreNavbar'){
			$hidenavBar = true;
			$navBarStructure = $buildArray;
			if ($navbarType == 'header'){
				$XML_file = NAVBAR_TEXTFILE_FILE_HEADER.'';
			}else{
				$XML_file = NAVBAR_TEXTFILE_FILE_FOOTER.'';
			 }

			 $_SESSION["restoreNavbar"] = $navbarType;

			saveNavBarSequence($XML_file, $buildArray, $navbarType, $selected_domain_id);
			system_navbarReturn("OK");
			//die("OK");
		}

		/**
		 * SAVES ITEMS DETAILS
		 */
		if ($action == 'checkItem'){
			if (!$navbarType) $navbarType = 'header';
			$_POST[${"name_".$_POST["lang_id"]}] = strip_tags($_POST[${"name_".$_POST["lang_id"]}]);
			$_POST["link"] = strip_tags($_POST["link"]);
			if (validate_form('navbarItem', $_POST, $error)){
                // FIND NEW ID HERE
                if ($li_id == 'no_id'){
                        $characters = array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z");
                        $pos1 = rand(0, count($characters));
						$pos2 = rand(0,count($characters));
						$pos3 = rand(0,count($characters));
                        $li_id = $characters[$pos1].$characters[$pos2].$characters[$pos3].rand(3,3);
                }
				system_navbarReturn("OK:{$li_id}");
			} else {
				system_navbarReturn("ERROR: ".$error);
			}
		}

		/**
		 * SAVES ORDER OF NAVBAR
		 */
		include(EDIRECTORY_ROOT.'/custom/domain_'.$selected_domain_id.'/lang/language.inc.php');
	 	if ($action=='saveOrder'){

	 		$array_edir_languagenames = explode(",", $edir_languagenames);
			$num_languagesAux = count($array_edir_languagenames);

			// open up language sequence
			$langObj = new Lang();
			$languages = $langObj->getAll();
			$num_languages = count($languages);

	 		$neworderArr = explode('|',$order);
	 		$newlinkArr = explode('|',$links);
	 		$newtargetArr = explode('|',$targets);
	 		$itemsArr = explode('|',$items);

	 		$newnameArr = explode('|',$names);
			$checkEmptyLink = false;
			$checkEmptyName = false;
			$checkRepeatedLinks = false;

			for ($j=0; $j<(count($newlinkArr)-1); $j++){
				if(!$newlinkArr[$j]){
					$checkEmptyLink = true;
					break;
				}
			}

			$arrayLinksAux0 = $newlinkArr;

			for ($j=0; $j<count($arrayLinksAux0); $j++){
				if (string_strpos($arrayLinksAux0[$j],"http://") === false){
					$arrayLinksAux0[$j] = "http://".$arrayLinksAux0[$j];
				}
				$arrayLinksAux0[$j] = str_replace("/", "", $arrayLinksAux0[$j]);
				$arrayLinksAux0[$j] = str_replace("index.php", "", $arrayLinksAux0[$j]);
			}

			$arrayLinksAux = array_unique($arrayLinksAux0);

			if (count($newlinkArr) != count($arrayLinksAux)){
				$checkRepeatedLinks = true;
			}

			for ($i=0; $i<count($newnameArr)-1; $i++){
				$allNamesAux = explode(',',$newnameArr[$i]);
				for ($j = 0; $j < $num_languagesAux; $j++){
					if (!trim($allNamesAux[$j])) {
						$checkEmptyName = true;
						break;
					}
				}
			}

	 		$newareasArr = explode('|',$areas);

			$buildArray = loadNavBarSequence($XML_file,$selected_domain_id);

			$num_Numberlanguages = explode(",", $edir_languagenumbers);

			$i = 0;
			// BUILD MATCH TREE
			foreach ($navBarSequenceArray[$navbarType] as $itemToCheck){
				extract($itemToCheck);
				for ($e=1; $e <= $num_languages; $e++) {
					$varNametoCap = "name_{$num_Numberlanguages[$e-1]}";
					$findInArray[$link][$e] = $$varNametoCap;
				}
			}

			$checkAux = false;

            // SOME TIMES item FIELD COMES EMPTY = NAVBAR CONSTRUCTION WILL RESET IT IF EMPTY
            $temporaryCounterForNoItemValue=1;

			foreach ($neworderArr as $orderByli_id){
				if ($orderByli_id){
					// FIND ARRAY POS

					$pos = ($orderByli_id < 2 ? $orderByli_id : $orderByli_id - 2);
					$foundedInfo = $buildArray[$pos];

					// REWRITE INFO
					$allNames = explode(',',$newnameArr[$i]);

					for ($X = 1; $X <= $num_languages; $X++) {

					   $varName = "name_{$num_Numberlanguages[$X-1]}";
					   if ($allNames[($X-1)]){
							$foundedInfo[$varName] = $allNames[($X-1)];
					   } else {
						   // search tree

						   $linkToSearch = $foundedInfo['link'];

						   if ($findInArray[$linkToSearch."/"])
							   $foundedInfo[$varName] = $findInArray[$linkToSearch.'/'][$X];
						   if ($findInArray[$linkToSearch])
							   $foundedInfo[$varName] = $findInArray[$linkToSearch][$X];
					   }

					   if (!$foundedInfo[$varName])
						   $foundedInfo[$varName] = "Unlabeled";
					}

					if (string_strpos($newlinkArr[$i],"http://") === false){
						$newlinkArr[$i] = "http://".$newlinkArr[$i];
					}

					$foundedInfo['link'] = $newlinkArr[$i];
					$foundedInfo['target'] = $newtargetArr[$i];
					$foundedInfo['item'] = $itemsArr[$i]?$itemsArr[$i]:$temporaryCounterForNoItemValue++;
					if ($newareasArr[$i] != 'undefined')
						$foundedInfo['area'] = $newareasArr[$i];
					else $foundedInfo['area'] = 1;
					// RE-BUILD
					$buildArray2[] = $foundedInfo;
					$i++;
				}
			}
	 	}

        if ($buildArray2 && !$checkRepeatedLinks && !$checkEmptyLink && !$checkEmptyName){
			try {
				saveNavBarSequence($XML_file,$buildArray2,$navbarType,$selected_domain_id);
			} catch (Exception $e) {
				system_navbarReturn('ERROR:'.  $e->getMessage());
			}
			system_navbarReturn("OK");
	 	} else if ($checkEmptyLink || $checkEmptyName){
			system_navbarReturn('ERROR: empty');
		} else if ($checkRepeatedLinks){
			system_navbarReturn('ERROR: repeated');
		}	else {
			system_navbarReturn('ERROR: empty navbar');
		}

	 } else {
		 system_navbarReturn('ERROR:no post / no action / not demo live mode');
	 }
?>