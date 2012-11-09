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
	# * FILE: /includes/code/clicktocallpopup.php
	# ----------------------------------------------------------------------------------------------------

	if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["module"] && $_POST["module_id"]) {
			
		/*
		 * Working just for Listing
		 */
		if($_POST["module"] == "Listing"){
			
			$error = "";
			if (!$_POST["phone"]){
				$error .= system_showText(LANG_PHONE_REQUIRED);
			}
			
			$_GET["module"]		= $_POST["module"];
			$_GET["module_id"]	= $_POST["module_id"];
			
			if (empty($error)) {

				$auxObj = new $_POST["module"]($_POST["module_id"]);

				/**
				 * Get the number to do a call
				 */
				$item_PhoneNumber	= $auxObj->getString("clicktocall_number");
				if($auxObj->getString("clicktocall_extension")){
					$item_Extension		= $auxObj->getString("clicktocall_extension");
				}else{
					$item_Extension		= false;
				}
				
				$response = twilio_ClickToCall($_POST["phone"], $item_PhoneNumber, $item_Extension, $_POST["module"], $_POST["module_id"], LISTING_REPORT_CLICKTOCALL);				
				
				if ($response->IsError) {
					$error = constant("LANG_TWILIO_ERROR_".$response->ResponseXml->RestException->Code);
				} else { ?>
					<? $return_message = LANG_TWILIO_CALLING."...";					
				}
			}
		}		
	}
?>