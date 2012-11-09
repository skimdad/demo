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
	# * FILE: /twitter_updates.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");
	
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	header("Accept-Encoding: gzip, deflate");
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check", FALSE);
	header("Pragma: no-cache");

	if ($_GET['posts']>0) {
		
		$xml_twitter = '';
		$xml_twitter = twitter_getPublicTimeline($_GET["user"], EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/tmp', TWITTER_CACHE_TIME);
		
		$twitter_status = @simplexml_load_string($xml_twitter);
		
		if ($twitter_status!==false) {
			$i = 0;
			foreach ($twitter_status->status as $status) {
				if ($i >= 3) break;
				$date = strtotime($status->created_at);
				$twitter_updates[$date]['url']    = 'http://twitter.com/'.$_GET["user"];
				$twitter_updates[$date]['text']   = twitter_makeLinksClickable($status->text);
				$twitter_updates[$date]['date']   = twitter_agoTime($status->created_at);
				$twitter_updates[$date]['id']	  = $status->id;

				$i++;
			}
		}
		if(is_array($twitter_updates)){
			ksort($twitter_updates);
		
			$twitter_updates = array_reverse(array_slice($twitter_updates, -1*$_GET['posts']));

  			if (count($twitter_updates)>0) {

				foreach ($twitter_updates as $tweet) {

					echo "<li style='display: list-item;'>";
					echo "<span>";
					echo $tweet['text'];
					echo "</span>";
					echo "<a href='".$tweet["url"]."/statuses/".$tweet["id"]."'>";
					echo $tweet['date'];
					echo "</a>";
					echo "</li>";

				}
			}
		}
	}
?>