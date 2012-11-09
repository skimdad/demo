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
	# * FILE: /functions/twilio_function.php
	# ----------------------------------------------------------------------------------------------------
	
	/**
	 * Return the link to open the Send to Phone window
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name twilio_PrepareLink
	 * @param string $module
	 * @param integer $module_id
	 * @return string $aux_twilio_link
	 */
	
	function twilio_PrepareLink($module = "listing", $module_id = 0, $ClickToCall = false){
		unset($aux_twilio_link);
		if($ClickToCall){
			$aux_twilio_link = DEFAULT_URL."/popup/popup.php?pop_type=clicktocallpopup&amp;module=".$module."&amp;module_id=".$module_id;
		}else{
			$aux_twilio_link = DEFAULT_URL."/popup/popup.php?pop_type=sendtophonepopup&amp;module=".$module."&amp;module_id=".$module_id;
		}
		return $aux_twilio_link;
	}

	/**
	 * Send a SMS message using Twilio Account.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name twilio_SendSMS
	 * @param string $number
	 * @param string $message
	 * @param string $module
	 * @param integer $code_to_statistic
	 * @param integer $module_id
	 * @return string $return_message
	 */
	
	function twilio_SendSMS($number, $message, $module, $code_to_statistic, $module_id, &$error){
		unset($return_message);

		// Include the PHP TwilioRest library
		require_once(EDIRECTORY_ROOT."/includes/twilioAPI/twilio.php");

		// Instantiate a new Twilio Rest Client
		$client = new TwilioRestClient(TWILIO_API_SID, TWILIO_API_AUTH);

		$message_body = string_substr($message, 0, TWILIO_MAX_CHARACTERS); // The max of characters allowed is 160 

		// Send a new outgoinging SMS by POST'ing to the SMS resource */
		// YYY-YYY-YYYY must be a Twilio validated phone number
		$response = $client->request("/".TWILIO_API_VERSION."/Accounts/".TWILIO_API_SID."/SMS/Messages", 
		"POST", array(
			"To" => $number,
			"From" => TWILIO_API_NUMBER,
			"Body" => $message_body
		));

		if($response->IsError){
			$error = $response->ErrorMessage;
		}else{
			$return_message = "<p class=\"successMessage\">".system_showText(LANG_LABEL_SMS_SENT)."</p>";
			report_newRecord(string_strtolower($module), $module_id, $code_to_statistic);
		}
		
		return $return_message;
	}
	
	/**
	 * Make a phone call using Twilio Account.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name twilio_ClickToCall
	 * @param string $outgoing
	 * @param string $item_number
	 * @param string $item_extension
	 * @param string $module
	 * @param integer $module_id
	 * @param integer $code_to_statistic
	 * @return string $response
	 */
	
	function twilio_ClickToCall($outgoing, $item_number, $item_extension, $module, $module_id, $code_to_statistic){
		
		require_once(EDIRECTORY_ROOT."/includes/twilioAPI/twilio.php");

		/* Twilio REST API version */
		$ApiVersion = TWILIO_API_VERSION;

		/* Set our AccountSid and AuthToken */
		$AccountSid = TWILIO_API_SID; 
		$AuthToken  = TWILIO_API_AUTH;
		
		/* Outgoing Caller ID you have previously validated with Twilio */
		$number = $item_number;
		
		/* Directory location for callback.php file (for use in REST URL)*/
		$url = DEFAULT_URL.'/twilio_code/callback.php?number=' . $number."&EDIR_NAME=".urlencode(EDIRECTORY_TITLE)."&module=".$module."&module_id=".$module_id;

		/* Instantiate a new Twilio Rest Client */
		$client = new TwilioRestClient($AccountSid, $AuthToken);

		/**
		 * Extension
		 */ 
		$aux_array_parameter["From"]	= $number;
		$aux_array_parameter["To"]		= $outgoing;
		$aux_array_parameter["Url"]		= $url;
		
		/**
		 * Don´t work to extension
		 * /
		if($item_extension){
			
			$aux_array_parameter["SendDigits"]		= $item_extension."#";			
			
		}
		 * $response = $client->request("/$ApiVersion/Accounts/$AccountSid/Calls","POST",$aux_array_parameter);
		*/
		
		
		/* make Twilio REST request to initiate outgoing call */
		$response = $client->request("/$ApiVersion/Accounts/$AccountSid/Calls",
		    "POST", array(
		        "From" => $number,
		        "To" => $outgoing,
		        "Url" => $url 
		    ));
		
		if(!$response->IsError){
			
			report_newRecord(string_strtolower($module), $module_id, $code_to_statistic);
			
		}
		
		return $response;
	}
	
	/**
	 * Add a new Caller ID using Twilio Account.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name twilio_AddCalledID
	 * @param string $item_title
	 * @param string $item_number
	 * @param string $extension
	 * @return string $response
	 */
	
	function twilio_AddCalledID($item_title, $item_number, $extension = false){
	
		require_once(EDIRECTORY_ROOT."/includes/twilioAPI/twilio.php");
			
		/* Instantiate a new Twilio Rest Client */
		$client = new TwilioRestClient(TWILIO_API_SID, TWILIO_API_AUTH);

		$url = TWILIO_API_VERSION."/Accounts/".TWILIO_API_SID."/OutgoingCallerIds";
		
		$aux_array_parameters = array();
		$aux_array_parameters["FriendlyName"]	= $item_title;
		$aux_array_parameters["PhoneNumber"]	= $item_number;
		if($extension){
			$aux_array_parameters["Extension"]		= $extension;
			
		}
		
		
		/* make Twilio REST request to initiate outgoing call */
		$response = $client->request($url,"POST", $aux_array_parameters);
    
		return $response;
	}
	
	/**
	 * Check if the Caller ID is validated using Twilio Account.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name twilio_CheckCallerID
	 * @param string $number
	 * @return string $response
	 */
	
	function twilio_CheckCallerID($number){
		
		require_once(EDIRECTORY_ROOT."/includes/twilioAPI/twilio.php");

		/* Instantiate a new Twilio Rest Client */
		$client = new TwilioRestClient(TWILIO_API_SID, TWILIO_API_AUTH);

		$url = TWILIO_API_VERSION."/Accounts/".TWILIO_API_SID."/OutgoingCallerIds";
		
		$aux_array_parameters = array();
		$aux_array_parameters["PhoneNumber"]	= $number;
		
		/* make Twilio REST request to initiate outgoing call */
		$response = $client->request($url,"GET", $aux_array_parameters);
    
		return $response;
	}
	
	/**
	 * Return the phone call reports of a Twilio number.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name twilio_CallerReport
	 * @param string $number
	 * @return string $response
	 */
	
	function twilio_CallerReport($number){
		
		require_once(EDIRECTORY_ROOT."/includes/twilioAPI/twilio.php");

		/* Instantiate a new Twilio Rest Client */
		$client = new TwilioRestClient(TWILIO_API_SID, TWILIO_API_AUTH);

		$url = TWILIO_API_VERSION."/Accounts/".TWILIO_API_SID."/Calls";
		
		$aux_array_parameters = array();
		$aux_array_parameters["From"]		= $number;
		$aux_array_parameters["Status"]		= "completed";				
		$aux_array_parameters["pagesize"]	= 1000;
		
		$response = $client->request($url,"GET", $aux_array_parameters);
    
		return $response;
		
	}
?>