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
	# * FILE: /functions/sugar_funct.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * API SuggarCRM
	 * @param string $url
	 * @param string $method
	 * @param array $data
	 * @return array
	 */
	function sugar_doRESTCALL($url, $method, $data) {
		ob_start();
		$ch = curl_init();
		$headers = (function_exists('getallheaders'))?getallheaders(): array();
		$_headers = array();
		foreach($headers as $k=>$v){
			$_headers[strtolower($k)] = $v;
		}

		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $_headers);
		//curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0 );
		$post_data = 'method=' . $method . '&input_type=Serialize&response_type=Serialize';
		//$json = getJSONobj();
		//$json = new JSON(JSON_LOOSE_TYPE);
		//$jsonEncodedData = json_encode($data);
		//$post_data = $post_data . "&rest_data=" . $jsonEncodedData;
		$post_data = $post_data . "&rest_data=" . serialize($data);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$result = curl_exec($ch);
		ob_end_flush();

		return unserialize($result);

	}

	function sugar_validate_plugin($domain, $key, $create_key = false){
		
		$key_value = getKey($domain);
		if($key_value){
			if($create_key){
				return $key_value;
			}elseif($key_value == $key){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	/*
	 * Function to login on sugar 
	 */
	function sugar_login(){
		
		/*
		 * Prepare URL to sugar
		 */
		setting_get("sugar_url", $sugar_url);
		
		//$sugar_url.="/service/v2/rest.php";
		//$sugar_url.="/service/v2_1/rest.php";
		$sugar_url.="/service/v3/rest.php";
		//$sugar_url.="/service/v3_1/rest.php";
		//$sugar_url.="/service/v4/rest.php";
		
		setting_get("sugar_user", $sugar_user);
		setting_get("sugar_password", $sugar_password);
		
		/*
		 * Make login
		 */
		
		$result = sugar_doRESTCALL($sugar_url,
							'login',
							array('user_auth'=>array('user_name'=>$sugar_user,
													 'password'=>md5($sugar_password),
													 'version'=>'.01'),
													 'application_name'=> EDIRECTORY_TITLE,
													 'name_value_list' => array(
																			array('name' => 'notifyonsave',
																				  'value' => 'false'
																				 )
																			   )
								)
							);

		if(is_array($result)){
			return $result;
		}else{
			return false;
		}
		
	}
	
	function sugar_getInformationToDirectory($sugar_id, $result){
		
		/**
		 * Get information about opportunity on sugarCRM
		 */
		if($sugar_id && is_array($result) && $result["id"]){
			
			/*
			 * Prepare URL to sugar
			 */
			setting_get("sugar_url", $sugar_url);

			//$sugar_url.="/service/v2/rest.php";
			//$sugar_url.="/service/v2_1/rest.php";
			$sugar_url.="/service/v3/rest.php";
			//$sugar_url.="/service/v3_1/rest.php";
			//$sugar_url.="/service/v4/rest.php";

			$opportunities_fields = array();
			$opportunities_fields[] = "id";
			$opportunities_fields[] = "name";

			$account_fields = array();
			$account_fields[] = "id";
			$account_fields[] = "name";
			$account_fields[] = "email1";
			$account_fields[] = "email2";
			$account_fields[] = "email_opt_out";
			$account_fields[] = "email_id";
			$account_fields[] = "billing_address_street";
			$account_fields[] = "billing_address_city";
			$account_fields[] = "billing_address_state";
			$account_fields[] = "billing_address_country";
			$account_fields[] = "billing_address_postalcode";
			$account_fields[] = "billing_address_street_2";
			$account_fields[] = "phone_fax";
			$account_fields[] = "phone_office";
			$account_fields[] = "website";

			$opportunity_id = $sugar_id;
			$result_modules = sugar_doRESTCALL($sugar_url, "get_entry", array('session'=>$result["id"],
																		 'module_name'=>'Opportunities',
																		 'id'=>$opportunity_id,
																		 'select_fields'=>$opportunities_fields,
																		 'link_name_to_fields_array' => array(array('name' =>'accounts','value' => $account_fields))
				));

			$result_account = sugar_doRESTCALL($sugar_url, "get_entry", array('session'=>$result["id"],
																		 'module_name'=>'Accounts',
																		 'id'=>$result_modules["relationship_list"][0][0]["records"][0]["id"]["value"],
																		 'select_fields'=>$account_fields)
				);

			

			/*
			 * Listing Information
			 */
			unset($return_result);
			$listing_information					= $result_modules["entry_list"][0]["name_value_list"];
			$return_result["listing_id"]			= $listing_information["id"]["value"];
			$return_result["listing_title"]			= $listing_information["name"]["value"];

			/*
			 * Account Information
			 */
			$account_information								= $result_account["entry_list"][0]["name_value_list"];
			$return_result["account_information_suggar_id"]		= $account_information["id"]["value"];
			$return_result["account_information_first_name"]	= substr($account_information["name"]["value"], 0,  strpos($account_information["name"]["value"]," "));
			$return_result["account_information_last_name"]		= substr($account_information["name"]["value"],  strpos($account_information["name"]["value"]," "));
			$return_result["account_information_address1"]		= $account_information["billing_address_street"]["value"];
			$return_result["account_information_address2"]		= $account_information["billing_address_street_2"]["value"];
			$return_result["account_information_country"]		= $account_information["billing_address_country"]["value"];
			$return_result["account_information_state"]			= $account_information["billing_address_state"]["value"];
			$return_result["account_information_city"]			= $account_information["billing_address_city"]["value"];
			$return_result["account_information_zip_code"]		= $account_information["billing_address_postalcode"]["value"];
			$return_result["account_information_phone"]			= $account_information["phone_office"]["value"];
			$return_result["account_information_fax"]			= $account_information["phone_fax"]["value"];
			$return_result["account_information_email"]			= $account_information["email1"]["value"];
			$return_result["account_information_url"]			= $account_information["website"]["value"];

			return $return_result;
		}else{
			return false;
		}
	}
	
	function sugar_prepareCodeToSugar(){
		
		$aux_sugarPath = "";
		
		if (MODREWRITE_FEATURE == "on"){
			$aux_sugarPath = 'sugar/SUGAR_KEY/{$fields.id.value}/';
		} else {
			$aux_sugarPath = 'sugarCRM.php?edirectory_id=SUGAR_KEY&sugar_id={$fields.id.value}';
		}
		
		$aux_sugar_code = '<input title="{$MOD.LBL_EDIRECTORY_ID}" ' .
							'onclick="window.open(\'DEFAULT_URL/'.$aux_sugarPath."\'".', \'WINDOW_NAME\',\'WINDOWS_OPTIONS\');" ' .
							'name="button" ' .
							'value="{$MOD.LBL_EDIRECTORY_ID}" ' .
							'type="button">'."'";
		
		//$aux_language_edirectory = "'LBL_EDIRECTORY' => 'Edirectory Export'";

		/*
		 * Get all domains
		 */	
		$sql = "SELECT id, name, url, subfolder FROM Domain WHERE activation_status = 'A' ORDER BY id";
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$result = $dbMain->query($sql);
		if(mysql_num_rows($result)){
			
			$new_sugar_button = array();
			$new_sugar_language = array();
			while($row = mysql_fetch_assoc($result)){

				/*
				 * Create a key for suggar
				 */
				$sugar_key = sugar_validate_plugin($row["url"], false,true);

				/*
				 * Prepare subfolder to url of domain
				 */
				unset($aux_subfolder); 
				if(strlen($row["subfolder"])){
					if(string_substr($row["subfolder"],0,1) == "/"){
						$aux_subfolder = $row["subfolder"] ;
					}else{
						$aux_subfolder = "/".$row["subfolder"];
					}
				}
	
				/*
				 * Replace code to sugar 
				 */
				unset($sugar_button);
				$sugar_button = str_replace('LBL_EDIRECTORY_ID', 'LBL_EDIRECTORY_'.$row["id"], $aux_sugar_code);
				$sugar_button = str_replace("'DEFAULT_URL", "\'http://".$row["url"].$aux_subfolder, $sugar_button);
				$sugar_button = str_replace('SUGAR_KEY', $sugar_key, $sugar_button);
				$sugar_button = str_replace("'WINDOW_NAME'", "\\'".str_replace(" ", "", $row["name"])."\\'", $sugar_button);
				$sugar_button = str_replace("'WINDOWS_OPTIONS'", "\\'menubar=0,resizable=1,width=1100,height=600,location=0,scrollbars=1,status=1\\'", $sugar_button);
				
				$new_sugar_button["button"][] = $sugar_button;
				$new_sugar_button["language"][] = "'LBL_EDIRECTORY_".$row["id"]."' =>'".$row["name"]."'";
				
				

			}
			
			return $new_sugar_button;

		}else{
			return false;
		}
	}

	function sugar_CreateFiles(){
		/*
		 * Read the model files with buttons
		 */
		$filename = SUGAR_FILE_PATH."/Opportunities/metadata/detailviewdefs.php";
		$handle = fopen ($filename, "r");
		$content = fread ($handle, filesize ($filename));
		
		$filename_lang = SUGAR_FILE_PATH."/Opportunities/language/en_us.lang.php";
		$handle_lang = fopen ($filename_lang, "r");
		$language = fread ($handle_lang, filesize ($filename_lang));
		
		
		/*
		 * Create new Buttons for domains
		 */
		$aux_sugar_buttons = array();
		$aux_sugar_language = array();
		$sugar_buttons = sugar_prepareCodeToSugar();
		
		for($i=0;$i<count($sugar_buttons["button"]);$i++){
			$aux_sugar_buttons[] = "array('customCode'=>'".$sugar_buttons["button"][$i].")";
			$aux_sugar_language[] = $sugar_buttons["language"][$i];
		}
		
		$string_buttons		= implode(",", $aux_sugar_buttons);
		$string_language	= implode(",", $aux_sugar_language);
		
		unset($sugar_buttons);
		$sugar_buttons	= str_replace("EDIRECTORY_BUTTONS", $string_buttons, $content);
		$sugar_language = str_replace("EDIRECTORY_LANGUAGES_LABEL", $string_language, $language);
		
		/*
		 * Write the file with buttons to sugar
		 */
		$filename_plugin = PLUGIN_FILE_PATH."/sugarCRM/Opportunities/metadata/detailviewdefs.php";
		$fp = fopen($filename_plugin, 'w');
		fwrite($fp, $sugar_buttons);
		fclose($fp);
		
		$filename_plugin_language = PLUGIN_FILE_PATH."/sugarCRM/Opportunities/language/en_us.lang.php";
		$fp = fopen($filename_plugin_language, 'w');
		fwrite($fp, $sugar_language);
		fclose($fp);
	}
	
	function sugar_ZipAndDownloadFiles(){
		
		$fileName = EXTRAFILE_DIR."/sugar.zip";
		@unlink($fileName);
		
		$zipObj = new Zip();
		
		$zipObj->setZipFile($fileName);
		
		$filename_plugin_buttons = PLUGIN_FILE_PATH."/sugarCRM/Opportunities/metadata/detailviewdefs.php";
		$file_name_button = "Opportunities/metadata/detailviewdefs.php";
		$fileContents_button = file_get_contents($filename_plugin_buttons);
		$zipObj->addFile($fileContents_button, $file_name_button);
		
		$filename_plugin_language = PLUGIN_FILE_PATH."/sugarCRM/Opportunities/language/en_us.lang.php";
		$file_name_lang = "Opportunities/language/en_us.lang.php";
		$fileContents_language_file = file_get_contents($filename_plugin_language);
		$zipObj->addFile($fileContents_language_file, $file_name_lang);
		
		$filename_plugin_readMe = SUGAR_FILE_PATH."/Sugar_Readme_V1.pdf";
		$file_name_readMe = "Sugar_Readme_V1.pdf";
		$fileContents_readMe_file = file_get_contents($filename_plugin_readMe);
		$zipObj->addFile($fileContents_readMe_file, $file_name_readMe);
		
		$zipObj->finalize();
		$zipObj->sendZip('sugar.zip');
		
		/*
		 * Sending mail with statistics of use
		 */
		exit;
		
	}
	
?>