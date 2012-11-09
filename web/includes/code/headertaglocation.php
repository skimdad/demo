<?php

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
	# * FILE: /includes/code/headertaglocation.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	unset($getMetaTag);
	$getMetaTag = true;
	$locationObjHeaderTag = false;

	if ($location_5)
		$locationObjHeaderTag = new Location5($location_5);
	elseif ($location_4)
		$locationObjHeaderTag = new Location4($location_4);
	elseif ($location_3)
		$locationObjHeaderTag = new Location3($location_3);
	elseif ($location_2)
		$locationObjHeaderTag = new Location2($location_2);
	elseif ($location_1)
		$locationObjHeaderTag = new Location1($location_1);	

	if ($locationObjHeaderTag) {
		if ($locationObjHeaderTag->getString("seo_description"))
			$headertag_description = $locationObjHeaderTag->getString("seo_description");
		if ($locationObjHeaderTag->getString("seo_keywords"))
			$headertag_keywords = $locationObjHeaderTag->getString("seo_keywords");		
	}
	unset($locationObjHeaderTag);
?>
