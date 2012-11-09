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
	# * FILE: /autocomplete_location.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");
    
    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$input = string_strtolower(trim(utf8_decode($_GET["q"])));
	$limit = $_GET['limit'] ? db_formatNumber($_GET['limit']) : AUTOCOMPLETE_MAXITENS;
	
	if($input){

		$_locations = explode(",", EDIR_LOCATIONS);
		$aux = count($_locations);
		$cont = 0;
		foreach($_locations as $_locationLevel){
			if ($cont==$aux-2)
				$firstLoc = $_locationLevel;
			if ($cont==$aux-1)
				$secLoc = $_locationLevel;
			$cont++;
		}

		$_locations = explode (',', EDIR_LOCATIONS);

        $_locations_reverse = array_reverse($_locations);
        if ($_locations_reverse){
        	foreach ($_locations_reverse as $each_location){
                $locationToConcat[] = 'loc_'.$each_location.'.name';
        	}
        }
            	

        $sql =	'select ';

		if (count($_locations)>1) {
			$sql .= 'concat_ws(", ",'.implode(',',$locationToConcat).') as name,';
			foreach ($_locations as $each_location) {
				$sql .= 'loc_'.$each_location.'.id as id'.$each_location;
				if ($each_location!=$_locations[count($_locations)-1])
					$sql .= ',';
			}
		}
		else {
			$sql .= 'loc_'.$_locations[0].'.name as name ';
		}

		$sql .= ' from Location_'.$_locations[0].' loc_'.$_locations[0];

		if (count($_locations)>1) {
			for ($i=1; $i<=(count($_locations)-1); $i++) {
				system_retrieveLocationRelationship($_locations, $_locations[$i], $_location_father_level, $_location_child_level);
				$sql .= ' left outer join Location_'.$_locations[$i].' loc_'.$_locations[$i].' on loc_'.$_locations[$i].'.location_'.$_location_father_level.' = loc_'.$_location_father_level.'.id ';
			}
			$sql .= ' having (name like "%'.$input.'%") ';
		} else {
			$sql .= ' where name like "%'.$input.'%"';
		}

		$sql .= ' order by name LIMIT '.$limit;

		
		$locations = db_getFromDBBySQL('location'.$_locations[0], $sql, 'array');

		$aResults = array();
		foreach ($locations as $locate)
		{
			$aResults[] = ($locate["name"]) . '|' . $locate["id"];
		}
		$aResults = array_unique($aResults);
		echo implode("\n", $aResults);
	}