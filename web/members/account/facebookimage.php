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
	# * FILE: /members/account/facebookimage.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------

	$dbObj = db_getDBObject(DEFAULT_DB, true);
	$sql = " SELECT facebook_uid FROM Profile WHERE account_id = ".$_GET["id"];
	$result = $dbObj->query($sql);

	$row = mysql_fetch_assoc($result); 
	$uid = $row["facebook_uid"];

	$imgURL = "http://graph.facebook.com/".$uid."/picture?type=large";

	$ch = curl_init($imgURL);
	curl_setopt($ch, CURLOPT_URL, $imgURL);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	curl_setopt($ch, CURLOPT_REFERER, $ref);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);

	$data = curl_exec($ch);

	curl_close($ch);
	$filename = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/tmp/temp.".time();

	$fp = fopen($filename, "w+");
	fwrite($fp, $data);
	fclose($fp);

	$info = getimagesize($filename);

	@unlink($filename);
	image_getNewDimension(100, 100, $info[0], $info[1], $newWidth, $newHeight);
	
	echo $imgURL."[FBIMG]".$newWidth."[FBIMG]".$newHeight;
?>