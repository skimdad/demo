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
	# * FILE: /twilio/callback.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	if($_GET["module"] && $_GET["module_id"]){
		
		/**
		 * Create object to get information to message
		 */
		$module_name = string_ucwords($_GET["module"]);
		$auxObj = new $module_name($_GET["module_id"]);
		$aux_title = $auxObj->getString("title");
		$aux_phone = $auxObj->getString("clicktocall_number");
		
		setting_get("twilio_clicktocall_message", $twilio_clicktocall_message);
		$twilio_clicktocall_message = str_replace("[ITEM_TITLE]", $aux_title, $twilio_clicktocall_message);		
		
		header("content-type: text/xml");
		echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		?>
		<Response>
			<Say voice="man"><?=$twilio_clicktocall_message?>.</Say>
			<Dial><?php echo $_REQUEST['number']?></Dial>
		</Response>
		<?
	}
	?>
