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
	# * FILE: /rss/mod_rewrite.php
	# ----------------------------------------------------------------------------------------------------
    
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if ($_GET["qs"]) {
		$fromRSS = false;

		$qs = explode("_", $_GET["qs"]);
        

		if (!in_array("guide", $qs) && !in_array("type", $qs) && !in_array("location", $qs) && (count($qs) == 1)) {

			$_GET["deal"] = $qs[0];

		} elseif ((in_array("guide", $qs) || in_array("type", $qs) || in_array("location", $qs)) && (count($qs) > 1)) {

			$guidepos = array_search("guide", $qs);
			if ($guidepos !== false) $guideposbegin = $guidepos+1;
			$locationpos = array_search("location", $qs);
			if ($locationpos !== false) $locationposbegin = $locationpos+1;
            $typepos = array_search("type", $qs);

			if ($guidepos === false) {
				$locationposend = count($qs)-1;
			} elseif ($locationpos === false) {
				$guideposend = count($qs)-1;
			} else {
				if ($guideposbegin > $locationposbegin) {
					$guideposend = count($qs)-1;
					$locationposend = $guidepos-1;
				} elseif ($locationposbegin > $guideposbegin) {
					$locationposend = count($qs)-1;
					$guideposend = $locationpos-1;
				}
			}

			if ($guidepos !== false) {
				$fromRSS = true;
                $get_urlFull = EDIRECTORY_FOLDER.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "").'/'.PROMOTION_FEATURE_FOLDER.'/guide';
                for ($i=$guideposbegin; $i<=$guideposend; $i++) {
					$get_urlFull .= '/'.$qs[$i];
				}
			}
            
            $_GET ["url_full"] = $get_urlFull;

			$_locations = explode(",", EDIR_LOCATIONS);
			if ($locationpos !== false) {
				for ($i=$locationposbegin; $i<=$locationposend; $i++) {
					if ($i == ($locationposbegin))   $_GET["friendLoc1"] = $qs[$i];
					if ($i == ($locationposbegin+1)) $_GET["friendLoc2"] = $qs[$i];
					if ($i == ($locationposbegin+2)) $_GET["friendLoc3"] = $qs[$i];
					if ($i == ($locationposbegin+3)) $_GET["friendLoc4"] = $qs[$i];
					if ($i == ($locationposbegin+4)) $_GET["friendLoc5"] = $qs[$i];
				}
			}
			unset ($_locations);
            
            if ($typepos !== false) {
                $_GET["template"] = $qs[$typepos+1];
            }

		}

		unset($_GET["qs"], $qs);

	}

    
    
	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(PROMOTION_EDIRECTORY_ROOT."/mod_rewrite.php");

?>
