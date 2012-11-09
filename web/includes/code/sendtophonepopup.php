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
			
			if (empty($error)) {

				$auxObj = new $_POST["module"]($_POST["module_id"]);
				$aux_title = $auxObj->getString("title");

				$locationsToshow = system_retrieveLocationsToShow();
				$locationsParam  = $locationsToshow." z";

				unset($aux_address, $aux_array_address, $aux_message);
				
				$aux_message[] = $aux_title;

				if($auxObj->getString("address")){
					$aux_array_address[] = $auxObj->getString("address");
				}

				if($auxObj->getString("address2")){
					$aux_array_address[] = $auxObj->getString("address2");
				}

				if (is_array($aux_array_address) && $aux_array_address[0]){
					$aux_address = implode(", ",$aux_array_address);
					$aux_message[] = $aux_address;
				}
				
				if ($auxObj->getLocationString($locationsParam, true)){
					$aux_message[] = $auxObj->getLocationString($locationsParam, true);
				}
				
				$levelObj = new ListingLevel();
				if ($levelObj->getDetail($auxObj->getNumber("level")) == "y"){
					$aux_url = $auxObj->getFriendlyURL(true);
					$aux_message[] = $aux_url;
				} else {
					$aux_url = "";
				}
				
				$message = implode(" - ", $aux_message);

				if(string_strlen($message) > TWILIO_MAX_CHARACTERS){
					$message = system_showTruncatedText($aux_title, 20).($aux_url ? " - ".$aux_url : "");	
				}

				$return_message = "";
				$return_message = twilio_SendSMS($_POST["phone"], $message, $_POST["module"], LISTING_REPORT_SMS, $_POST["module_id"], $error);
				
				if ($error == "Number is not a valid phone number"){
					$error = system_showText(LANG_PHONE_INVALID);
				}
			}
		} 			
	}
?>