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
	# * FILE: /functions/maintenance_funct.php
	# ----------------------------------------------------------------------------------------------------
	
	function verify_maintenanceMode(){
		$name = "maintenance_mode";
		$value = "";
		if (setting_get($name, $value)) {
			if ($value == 'on'){
				header('Location: '.DEFAULT_URL.'/maintenancepage.php');
			}
		}
	}
?>