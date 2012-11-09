<?php
// Coded by Mike Rogers (http://www.fullondesign.co.uk/) 1st October 2010.
 
	function shorten($url, $qr=NULL){
	
	$api_url = 'https://www.googleapis.com/urlshortener/v1/url';
	$key = 'AIzaSyDh_11PpCYT-L7ZtrC6Nv_u6hTzimxKsjw';
	echo '<script>alert("'."before curl".'")</script>';
		if(function_exists('curl_init')){
		echo '<script>alert("'."after curl check".'")</script>';
			
			
			$api_url = $api_url .'?key='. $key; 
			
			$ch = curl_init();
			
			
			
			
			      curl_setopt($ch,CURLOPT_URL,$api_url);
                  curl_setopt($ch,CURLOPT_POST,1);
                   curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode(array("longUrl"=>$url)));
                   curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type: application/json"));
    
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			
			
			
			
			
			$results = curl_exec($ch);
			
			$headerInfo = curl_getinfo($ch);
			curl_close($ch);
			$results = json_decode($results);
			
			echo '<pre>';var_dump($results);echo '</pre>';
			exit();
			if ($headerInfo['http_code'] === 201){ // HTTP Code 201 = Created
				
				 
				if(isset($results->short_url)){
					$qr = !is_null($qr)?'.qr':'';
					
					return $results->short_url.$qr;
			 	}
				return FALSE;
			}
		return FALSE;
	
	}
	 echo '<script>alert("'."error curl".'")</script>';
     //trigger_error("cURL required to shorten URLs.", E_USER_WARNING); // Show the user a neat error.
	 return FALSE;
}


?>