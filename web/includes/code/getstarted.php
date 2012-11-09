<?

	/*!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==*\
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
	\*!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/validate_querystring.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);

	if ($_SERVER['REQUEST_METHOD'] == "POST" && $setting) {
		if($setting == "dont_show"){
			$dbObj = db_getDBObJect(DEFAULT_DB,true);
			$dbObjSecond = db_getDBObjectByDomainID($domain, $dbObj);
			$sql = "SELECT * FROM Setting WHERE name LIKE 'todo_%' AND `value` = 'yes'";
			$result = $dbObjSecond->query($sql);

			while($row = mysql_fetch_array($result)){
				$sql = "UPDATE Setting set `value` = 'no' WHERE `name` = '".$row["name"]."'";
				$dbObjSecond->query($sql);
			}
			echo $setting;
		} else {
			$dbObj = db_getDBObJect(DEFAULT_DB,true);
			$dbObjSecond = db_getDBObjectByDomainID($domain,$dbObj);

			$sql = "UPDATE Setting set `value` = 'no' WHERE `name` = '$setting'";
			$result = $dbObjSecond->query($sql);

			$sql = "SELECT * FROM Setting WHERE name LIKE 'todo_%' AND `value` = 'yes'";
			$numRows = $dbObjSecond->numRowsQuery($sql);
			echo $numRows;
		}
	}
?>
