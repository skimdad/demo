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
if ($_GET['where'] != ''){
		list($city, $state, $country) = explode(",", $_GET['where']);
		if ($city != '')
		$sql ='SELECT Zipcode FROM `zip` where `City` = "'.$city.'" order by zipcode limit 1';
		elseif ($city == '' && $state != '')
			$sql ='SELECT Zipcode FROM `zip` where `City` = "'.$city.'" order by zipcode limit 1';
		elseif ($city == '' && $state != '' && $country != '')
			$sql ='SELECT Zipcode FROM `zip` where `City` = "'.$country.'" order by zipcode limit 1';
    $value = mysql_fetch_object(mysql_query($sql));
	if ($value->Zipcode != ''){
			echo $value->Zipcode;
	}
}
else
exit();
?>