<?php


class GoogleShorterLink {
	
	var $api_url = 'https://www.googleapis.com/urlshortener/v1/url';
	var $url;
	var $google_api_key;
	var $shorted_url;
	
	public static $setting_item_name = 'google_api_key';
	
	function  GoogleShorterLink($url){
		$this->url = $url;
		$this->getApiKey();
	}
	
	function getApiKey() {
		if(!class_exists('GoogleSettings'))
		{
			include(EDIRECTORY_ROOT.'/classes/class_GoogleSettings.php');
		}
		$googleSettingObj = new GoogleSettings();
		$googleSettingObj->getByItemName(GoogleShorterLink::$setting_item_name);
		$this->google_api_key = $googleSettingObj->name;
                
	}
	
	
	function prepApiUrl() {
		return $this->api_url . '?key=' . $this->google_api_key;	
	}
	
	function shorten() {
		if(function_exists('curl_init')){
			
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$this->api_url);
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode(array("longUrl"=>$this->url)));
			curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type: application/json"));
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			$results = curl_exec($ch);
			$results = json_decode($results);
			if(isset($results->id)){
				return $results->id;
			}
			return FALSE;
		} 
		else {
			return FALSE;
		}
		
	}
}
?>