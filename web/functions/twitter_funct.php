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
	# * FILE: /functions/twitter_function.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * Returns the public timeline of the user in XML format or and error code
	 * if an error occur
	 *
	 * @param string $user
	 * @param string $cache_dir
	 * @param integer $cache_time Time in seconds
	 * @return string XML response style
	 */
	function twitter_getPublicTimeline($user='', $cache_dir='/tmp', $cache_time = TWITTER_CACHE_TIME) {
		if ($cache_dir != '') {
			$cache_file = $cache_dir . '/twittercache_' . md5($user);
			$timedif = @(time() - filemtime($cache_file));
			if ((file_exists($cache_file)) and ($timedif < $cache_time)) {
				// cached file is fresh enough, return cached array
				$result = unserialize(join('', file($cache_file)));
				if(string_strlen($result) == 0){
					$result = twitter_getUncachedPublicTimeline($user);
					if(string_strpos($result, "Error:") === false){
						if ($f = fopen($cache_file, 'w')){
							$serialized = serialize($result);
							fwrite ($f, $serialized, strlen($serialized));
							fclose($f);
						}
					}	
				}
			} else {

				// cached file is too old, create new
				$result = twitter_getUncachedPublicTimeline($user);

				if(!$result || string_strpos($result, "Error:")){
					$result = unserialize(join('', file($cache_file)));
				}else{
					$serialized = serialize($result);
					if(string_strpos($result, "Error:") === false){
						if (($f = fopen($cache_file, 'w')) && string_strlen($result)) {
							fwrite ($f, $serialized, strlen($serialized));
							fclose($f);
						}
					}else{
						if(file_exists($cache_file)){
							$result = unserialize(join('', file($cache_file)));
						}
					}
				}
			}

		}
		// If CACHE DISABLED >> load and parse the file directly
		else {

			$result = twitter_getUncachedPublicTimeline($user);
		}

		//echo $result;

		return $result;
	}

	function twitter_getUncachedPublicTimeline ($user) {

		$curl_conn = curl_init();
		curl_setopt($curl_conn, CURLOPT_URL, 'http://api.twitter.com/1/statuses/user_timeline.xml?id='.$user); //URL to connect to
		//curl_setopt($curl_conn, CURLOPT_POST, 1); //Use GET method
		curl_setopt($curl_conn, CURLOPT_SSL_VERIFYPEER, false); //Do not check SSL certificate (but use SSL)
		curl_setopt($curl_conn, CURLOPT_RETURNTRANSFER, 1); //Return the result as string

		// Result from querying URL. Will parse as xml
		$output = curl_exec($curl_conn);

		// close cURL resource
		$responseInfo=curl_getinfo($curl_conn);
		curl_close($curl_conn);

		if(intval($responseInfo['http_code'])==200) {
			// Display the response from Twitter
			return $output;
		}else {
			// Something went wrong
			return "Error: " . $responseInfo['http_code'].$output;
		}
	}

	/**
	 * Returns the content sent via parameter $text with all occurences of #tags,
	 * @usernames and texts like http://, ftp://, www. changed to HTML clickable
	 * links
	 *
	 * @param <type> $text
	 * @return <type>
	 */
	function twitter_makeLinksClickable($text) {
		// mentions
		$text= preg_replace("/@(\w+)/", '<a target="_blank" href="http://www.twitter.com/$1">@$1</a>', $text);

		// tags
		$text= preg_replace("/\#(\w+)/", '<a target="_blank" href="http://search.twitter.com/search?q=$1">#$1</a>',$text);

		// ftp and http links
		$text= preg_replace("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a target=\"_blank\" href=\"$3\" >$3</a>", $text);
		$text= preg_replace("/(^|[\n ])([\w]*?)((www|ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a target=\"_blank\" href=\"http://$3\" >$3</a>", $text);

		// email
		//$text= preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"mailto:$2@$3\">$2@$3</a>", $text);

		return $text;
	}

	/**
	 * Return the difference between the parameter and now in a twitter-like format
	 *
	 * @param string $date
	 * @return string
	 */
	function twitter_agoTime($date) {
		if(empty($date)) {
			//return "No date provided";
			return "";
		}

		$periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		$lengths         = array("60",     "60",     "24",   "7",   "4.35", "12",    "10");

		$now             = time();
		$unix_date       = strtotime($date);

		// check validity of date
		if(empty($unix_date)) {
			//return "Bad date";
			return "";
		}

		// is it future date or past date
		if($now > $unix_date) {
			$difference     = $now - $unix_date;
			$tense         = "ago";

		} else {
			$difference     = $unix_date - $now;
			$tense         = "from now";
		}

		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
			$difference /= $lengths[$j];
		}

		$difference = round($difference);

		if($difference != 1) {
			$periods[$j].= "s";
		}

		return "{$difference} $periods[$j] {$tense}";
	}
?>