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
	# * FILE: /functions/cache_funct.php
	# ----------------------------------------------------------------------------------------------------

	/**
	* Write output debug messages to CACHE FULL verbose file
	* @copyright Copyright 2011 Arca Solutions, Inc.
	* @author Arca Solutions, Inc.
	* @name void cachefull_verbose(string $text)
	* @param string $text
	* @return void
	*/     
	function cachefull_verbose($text) {

		if (CACHE_FULL_VERBOSE_MODE == "on") {
	
			$cacheVerboseHandler = @fopen(CACHE_FULL_VERBOSE_FILE, "a+");
			@fwrite ($cacheVerboseHandler, date('r') . " >> " . $text . "\r\n");
			@fclose($cacheVerboseHandler);				
		}			
	}
	
	/**
	* Post-processor to cache files. Used to have always-fresh some content boxes, even using cache.
	* @copyright Copyright 2011 Arca Solutions, Inc.
	* @author Arca Solutions, Inc.
	* @name string cachefull_postprocessing(string $marker, string $cachedContent)
	* @param string $marker - receive name of marker, all content between two of this marker will be replaced on cached file
	* @param string $cachedContent - content cached, saved on disk, ready to be thrown to user
	* @return string $cachedContent
	*/     	
	function cachefull_postprocessing($marker, $cachedContent)
	{
		cachefull_verbose("Post-processing marker [$marker]: Looking for...");

		if (strpos ($cachedContent, "<!--{$marker}-->") !== false)
		{		
			cachefull_verbose("Post-processing marker [$marker]: Found, making changes...");
			
			ob_start();	
				
			switch ($marker)
			{
				case "cachemarkerUserNavbar":
                    include(system_getFrontendPath("usernavbar.php", "layout"));
				break;
				
				case "cachemarkerFeaturedListing":
					include(system_getFrontendPath("featured_listing.php"));
				break;
			
				case "cachemarkerFeaturedListing2":
					include(LISTING_EDIRECTORY_ROOT."/featured.php");
				break;
			
				case "cachemarkerFeaturedDeal":
					include(system_getFrontendPath("featured_promotion.php"));
				break;
			
				case "cachemarkerFeaturedDeal2":
					include(PROMOTION_EDIRECTORY_ROOT."/featured.php");
				break;
			
				case "cachemarkerSpecialDeal":
					include(PROMOTION_EDIRECTORY_ROOT."/special_deal.php");
				break;
			
				case "cachemarkerFeaturedClassified":
					include(system_getFrontendPath("featured_classified.php"));
				break;
			
				case "cachemarkerFeaturedClassified2":
					include(CLASSIFIED_EDIRECTORY_ROOT."/featured.php");
				break;
			
				case "cachemarkerFeaturedEvent":
					include(system_getFrontendPath("featured_event.php"));
				break;
			
				case "cachemarkerFeaturedEvent2":
					include(EVENT_EDIRECTORY_ROOT."/featured.php");
				break;
			
				case "cachemarkerFeaturedArticle":
                    include(system_getFrontendPath("featured_article.php"));
				break;
			
				case "cachemarkerFeaturedArticle2":
					include(ARTICLE_EDIRECTORY_ROOT."/featured.php");
				break;
            
                case "cachemarkerBannerTop":
					include(system_getFrontendPath("banner_top.php"));
				break;
			
				case "cachemarkerBannerBottom":
					include(system_getFrontendPath("banner_bottom.php"));
				break;
			
				case "cachemarkerBannerFeatured":
					include(system_getFrontendPath("banner_featured.php"));
				break;
			
				case "cachemarkerBannerLinks":
					include(system_getFrontendPath("banner_sponsoredlinks.php"));
				break;
            
                case "cachemarkerIE6":
                    include(system_getFrontendPath("IE6alert.php", "layout"));
				break;
			
			}
		
			$freshNewContent = ob_get_contents();
			ob_end_clean();		

			$regexPattern = "/<!--{$marker}-->.*<!--{$marker}-->/s";
			$cachedContent = preg_replace($regexPattern, $marker, $cachedContent);
			
			$cachedContent = str_replace($marker, $freshNewContent, $cachedContent);
				
			cachefull_verbose("Post-processing marker [$marker]: Changed.");		
		}
		else
		{
			cachefull_verbose("Post-processing marker [$marker]: Not found.");
		}
		
		return $cachedContent;
	}	

	/**
	* Throw a cached file content if there is one for this $_SERVER['REQUEST_URI'],
	*    killing output, or deviate stdout and let system to generate the content, so footer can grab it to write a cache file
	* @copyright Copyright 2011 Arca Solutions, Inc.
	* @author Arca Solutions, Inc.
	* @name void cachefull_header(void)
	* @return void
	*/    	
	function cachefull_header ()
	{
		if (cachefull_abletorun())
		{
			$booleanCacheForLoggedMembers = (CACHE_FULL_FOR_LOGGED_MEMBERS == "on") ? true : false; 
			if (!sess_getAccountIdFromSession() > 0 || $booleanCacheForLoggedMembers)
			{
				if (@file_exists (CACHE_FULL_UPDATETOKEN))
				{
					cachefull_verbose("Cache token found at [".CACHE_FULL_UPDATETOKEN."], cleaning up...");
					cachefull_cleanup();
				}
				else
				{
					$cacheFileSuffix = (@file_exists (CACHE_FULL_FILE_PATH . ".gz")) ? ".gz" : NULL;
			
					cachefull_verbose("Looking for cachefile [" . CACHE_FULL_FILE_PATH . $cacheFileSuffix . "] to URL [{$_SERVER['REQUEST_URI']}]...");
			
					if (@function_exists("readgzfile") && CACHE_FULL_ZLIB_COMPRESSION_IF_AVAILABLE == "on")
					{
						ob_start();				
						@readgzfile(CACHE_FULL_FILE_PATH . $cacheFileSuffix);
						$cachedContent = ob_get_clean();				
						$cacheFileSize = strlen($cachedContent);
					}
					else
					{
						cachefull_verbose("Function readgzfile not found, trying fopen...");
					
						if (! is_null ($cacheFileSuffix))
						{
							cachefull_verbose("Panic: Gzipped cached file, and function readgzfile does not exist...");
							cachefull_cleanup();
							
							//cancelling output, nothing to do
							exit;			
						}
						else
						{
							$cacheFileSize = @filesize(CACHE_FULL_FILE_PATH . $cacheFileSuffix);
							$cacheFileHandler = @fread("CACHE_FULL_FILE_PATH . $cacheFileSuffix", $cacheFileSize);					
						}
					}				
		
	
					if($cacheFileSize)
					{		
						cachefull_verbose("Cache file ok with [$cacheFileSize] bytes, moving on...");
					
						//this file will look for cache marks on var $cachedContent and replace it for proper codes
						if (CACHE_FULL_ALWAYS_FRESH_FEATURED_LISTING == "on"){
							$cachedContent = cachefull_postprocessing("cachemarkerFeaturedListing", $cachedContent);
							$cachedContent = cachefull_postprocessing("cachemarkerFeaturedListing2", $cachedContent);
						}

						if (CACHE_FULL_ALWAYS_FRESH_FEATURED_DEAL == "on"){
							$cachedContent = cachefull_postprocessing("cachemarkerFeaturedDeal", $cachedContent);
							$cachedContent = cachefull_postprocessing("cachemarkerSpecialDeal", $cachedContent);
							$cachedContent = cachefull_postprocessing("cachemarkerFeaturedDeal2", $cachedContent);
						}
						
						if (CACHE_FULL_ALWAYS_FRESH_FEATURED_CLASSIFIED == "on"){
							$cachedContent = cachefull_postprocessing("cachemarkerFeaturedClassified", $cachedContent);
							$cachedContent = cachefull_postprocessing("cachemarkerFeaturedClassified2", $cachedContent);
						}

						if (CACHE_FULL_ALWAYS_FRESH_FEATURED_EVENT == "on"){
							$cachedContent = cachefull_postprocessing("cachemarkerFeaturedEvent", $cachedContent);
							$cachedContent = cachefull_postprocessing("cachemarkerFeaturedEvent2", $cachedContent);
						}

						if (CACHE_FULL_ALWAYS_FRESH_FEATURED_ARTICLE == "on"){
							$cachedContent = cachefull_postprocessing("cachemarkerFeaturedArticle", $cachedContent);
							$cachedContent = cachefull_postprocessing("cachemarkerFeaturedArticle2", $cachedContent);
						}

						if (BANNER_FEATURE == "on"){
							$cachedContent = cachefull_postprocessing("cachemarkerBannerTop", $cachedContent);
							$cachedContent = cachefull_postprocessing("cachemarkerBannerBottom", $cachedContent);
							$cachedContent = cachefull_postprocessing("cachemarkerBannerFeatured", $cachedContent);
							$cachedContent = cachefull_postprocessing("cachemarkerBannerLinks", $cachedContent);
						}
						
						if (CACHE_FULL_FOR_LOGGED_MEMBERS == "on"){
							$cachedContent = cachefull_postprocessing("cachemarkerUserNavbar", $cachedContent);
						}
                        
                        $cachedContent = cachefull_postprocessing("cachemarkerIE6", $cachedContent);

						if (CACHE_FULL_INCLUDE_CACHE_COMMENT_AT_PAGE == "on")
							$cachedContent .= "<!-- eDirectory cache loaded -->";					
				
						if (strpos ($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false)
						{
							cachefull_verbose("Browser does accept HTTP_ENCODING gzip, compressing again...");
							header('Content-Encoding: gzip');
							header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
							$cachedContent = gzencode ($cachedContent);
						}						
						
						cachefull_verbose("Throwing in cached content, and closing output pipe...");		
						echo $cachedContent;
						exit;
					}

				}			
				ob_start();
			}

		}		
		else
		{
			cachefull_verbose ("Cache not able to run, trying to figure out why...");
			
			if (CACHE_FULL_FEATURE == "off")
			{
				cachefull_verbose("Cache disabled.");
				
				if (CACHE_FULL_REMOVE_FILES_WHEN_DISABLED == "on")	
				{
					cachefull_verbose ("Cleaning files because constant CACHE_FULL_REMOVE_FILES_WHEN_DISABLED == on");
					cachefull_cleanup();
				}
			}
			else
			{
				cachefull_verbose("Cache enabled.");
				
				if (@is_writable (CACHE_FULL_DIR))
				{
					cachefull_verbose("CACHE_FULL_DIR [".CACHE_FULL_DIR."] is writable.");
					
					if ( @file_exists(CACHE_FULL_UPDATETOKEN) && @is_writable(CACHE_FULL_UPDATETOKEN) )
					{
						cachefull_verbose("CACHE_FULL_UPDATETOKEN [".CACHE_FULL_UPDATETOKEN."] and is writable.");
					}
					else
					{
						if ( @file_exists(CACHE_FULL_UPDATETOKEN) )
						{
							cachefull_verbose("CACHE_FULL_UPDATETOKEN [".CACHE_FULL_UPDATETOKEN."] exists, but it's not writable.");						
						}
					}
				}
				else
				{
					cachefull_verbose("CACHE_FULL_DIR [".CACHE_FULL_DIR."] not writable.");
				}
			}
		}	
	}
	
	/**
	* Function cachefull_footer will get all ready to user content, write a cache file with it and throw to stdout after
	* @copyright Copyright 2011 Arca Solutions, Inc.
	* @author Arca Solutions, Inc.
	* @name void cachefull_footer(void)
	* @return void
	*/ 	
	function cachefull_footer()
	{
		if (cachefull_abletorun())
		{
			$booleanCacheForLoggedMembers = (CACHE_FULL_FOR_LOGGED_MEMBERS == "on") ? true : false; 
			if (!sess_getAccountIdFromSession() > 0 || $booleanCacheForLoggedMembers)
			{
				cachefull_verbose("Generating new cache to URL [{$_SERVER['REQUEST_URI']}] ...");

				$freshContentToCache = ob_get_contents();
                $auxfreshContentToCache = $freshContentToCache;
				ob_end_clean();	

				if (@function_exists("gzencode") && (@function_exists("readgzfile"))  && CACHE_FULL_ZLIB_COMPRESSION_IF_AVAILABLE == "on")
				{
					cachefull_verbose("Functions gzencode and readgzfile ok, moving on using compression...");

					$freshContentToCache = gzencode ($freshContentToCache);
					$cacheFileSuffix = ".gz";

					if (strpos ($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false)
						header('Content-Encoding: gzip');
				}

				if (CACHE_FULL_INCLUDE_CACHE_COMMENT_AT_PAGE == "on")
					$freshContentToCache .= "\r\n\r\n<!-- eDirectory cache generated at " . date('r') . "-->";

				$cacheFileHandler = fopen(CACHE_FULL_FILE_PATH . $cacheFileSuffix, "w+"); 

				if (fwrite ($cacheFileHandler, $freshContentToCache))				
					cachefull_verbose("Cache saved successfully to file [".CACHE_FULL_FILE_PATH . $cacheFileSuffix."].");
				else
					cachefull_verbose("Cache fail saving file [".CACHE_FULL_FILE_PATH . $cacheFileSuffix."].");
				
                if (is_ie(true)){
                    echo $auxfreshContentToCache;
                } else {
                    echo $freshContentToCache;
                }
				
				//ob_end_clean();	
			}			
		}	
	}
	
	/**
	* This function will create a cachetoken file on disk if query sent has some update to database
	* @copyright Copyright 2011 Arca Solutions, Inc.
	* @author Arca Solutions, Inc.
	* @name void cachefull_mysqlupdater(string $query)
	* @return void
	*/ 		
	function cachefull_mysqlupdater($query)
	{
		$query = string_strtolower($query);
		if (cachefull_abletorun())
		{
			//saving resources, need to check once only
			if (! @file_exists (CACHE_FULL_UPDATETOKEN))
			{
				//looking to the query to see it's changing the content to expire the cache				
				if 	
				(	
				    ( (stripos ($query, "insert") === 0) || (stripos ($query, "update") === 0) )
				    
				    &&
				    
				    (
					(
					    	(strpos($query, "report_") === false)
					    && 	(strpos($query, "smaccount") === false)
					  //  && 	(strpos($query, "setting") === false)
					  //  && 	(strpos($query, "account") === false)
					    && 	(strpos($query, "frequently_actions") === false)
					    && 	(strpos($query, "recent_activity") === false)
					    && 	(strpos($query, "registration") === false)
					    && 	(strpos($query, " set number_views") === false)
					    && 	(strpos($query, "update listingcategory set active_listing =") === false)
					)
							
					|| (strpos($query, "setting_google") !== false)   				
				    )						    					    
				)
				{

					cachefull_verbose("Creating cacheToken at [" . CACHE_FULL_UPDATETOKEN . "] by user [{$_ENV['USER']}]");
					
					//creating token to expire cache				
					$cacheUpdateToken = @fopen (CACHE_FULL_UPDATETOKEN, "w+");
					@fclose ($cacheUpdateToken);

					cachefull_verbose("Logging expiration query [" . substr($query,0,50) . "...] to file [".CACHE_FULL_LOG_EXPIRATION_QUERIES_FILE."]");
					
					if (CACHE_FULL_LOG_EXPIRATION_QUERIES == "on")
					{
						
						$cacheExpirationQueriesHandler = @fopen(CACHE_FULL_LOG_EXPIRATION_QUERIES_FILE, "a+");
						@fwrite ($cacheExpirationQueriesHandler, date('r') . " >> Expirated by query [{$query}]\r\n----------------------------------------------\r\n");
						@fclose($cacheExpirationQueriesHandler);
					}				
				}
			}
	
			//need to adjust cache expiring token perms, in the case it was created by visitor or root@cronjob
			@chmod (CACHE_FULL_UPDATETOKEN, 0777);
			# ----------------------------------------------------------------------------------------------------	
	
		}
	}
	
	/**
	* This function will create a cachetoken file on disk
	* @copyright Copyright 2011 Arca Solutions, Inc.
	* @author Arca Solutions, Inc.
	* @name void cachefull_forceExpiration()
	* @return void
	*/
	function cachefull_forceExpiration(){
		cachefull_verbose("Creating cacheToken at [" . CACHE_FULL_UPDATETOKEN . "] by user [{$_ENV['USER']}]");
					
		//creating token to expire cache				
		$cacheUpdateToken = @fopen (CACHE_FULL_UPDATETOKEN, "w+");
		@fclose ($cacheUpdateToken);

		cachefull_verbose("Logging expiration");

	}
	
	/**
	* This function will clean up CACHE_FULL_DIR directory 
	* @copyright Copyright 2011 Arca Solutions, Inc.
	* @author Arca Solutions, Inc.
	* @name void cachefull_cleanup(void)
	* @return void
	*/ 	
	function cachefull_cleanup()
	{
		cachefull_verbose("Starting cleanup at directory [" . CACHE_FULL_DIR . "]");
		
		$cacheRelativeDirectoryHandler = @opendir (CACHE_FULL_DIR);
		while ($cacheFiles = readdir ($cacheRelativeDirectoryHandler))
		{
			if ($cacheFiles != '.' && $cacheFiles != '..')
			{
				if (@unlink(CACHE_FULL_DIR . "/" . $cacheFiles))
				{
					cachefull_verbose("Success deleting file [" . CACHE_FULL_DIR . "/" . $cacheFiles . "]");
				}
				else
				{
					cachefull_verbose("Error deleting file [" . CACHE_FULL_DIR . "/" . $cacheFiles . "]");
				}
			}
		}
		@closedir ($cacheRelativeDirectoryHandler);
		
		cachefull_verbose("Vanishing out CACHE_FULL_UPDATETOKEN [" . CACHE_FULL_UPDATETOKEN . "]");
		@unlink (CACHE_FULL_UPDATETOKEN);	
	}
	
	/**
	* This function will test the requisites, and tell another functions cache is able to run or not
	* @copyright Copyright 2011 Arca Solutions, Inc.
	* @author Arca Solutions, Inc.
	* @name void cachefull_abletorun(void)
	* @return void
	*/ 		
	function cachefull_abletorun()
	{

		if (
			CACHE_FULL_FEATURE == "on"
			
			&& @is_writable (CACHE_FULL_DIR)
			
			&& (
				( @file_exists(CACHE_FULL_UPDATETOKEN) && @is_writable(CACHE_FULL_UPDATETOKEN) )
				
				|| (! @file_exists(CACHE_FULL_UPDATETOKEN))
			)
		)
		
			return true;
		else
			return false;
			
	}
	
	/**
	 * This function check if the query is related with some cache file
	 *  @author Arca Solutions, Inc.
	 * 	@param string query
	 * 	@since July, 28, 2011
	 */
	function cachepartial_mysqlupdater($query)
	{
		$query = string_strtolower($query);
		//looking to the query to see it's changing the content to expire the cache				
		if((stripos ($query, "insert") === 0) || (stripos ($query, "update") === 0))
		{
			if ( strpos($query, 'category') !== false )
			{
				cachepartial_removecache('index_sidebar_categories');
			}
			elseif ( strpos($query, 'review') !== false )
			{
				cachepartial_removecache('index_sidebar_reviews');
			}
			
			if ( strpos($query, 'listingcategory') !== false || strpos($query, 'listing_category') !== false )
			{
				cachepartial_removecache('listing_index_categories', 'ListingCategory_results_(.*)', 'promotion_results_(.*)');
			}
			elseif ( strpos($query, 'articlecategory') !== false )
			{
				cachepartial_removecache('article_index_categories', 'ArticleCategory_results_(.*)');
			}
			elseif ( strpos($query, 'classifiedcategory') !== false )
			{
				cachepartial_removecache('classified_index_categories', 'ClassifiedCategory_results_(.*)');
			}
			elseif ( strpos($query, 'eventcategory') !== false )
			{
				cachepartial_removecache('event_index_categories', 'EventCategory_results_(.*)');
			}
			elseif ( strpos($query, 'location_') !== false )
			{
				cachepartial_removecache("sidebar_location_listing");
				
				if (EVENT_FEATURE == "on"){
					cachepartial_removecache("sidebar_location_event");
				}
				
				if (CLASSIFIED_FEATURE == "on"){
					cachepartial_removecache("sidebar_location_classified");
				}
				
				if (PROMOTION_FEATURE == "on"){
					cachepartial_removecache("sidebar_location_deal");
				}
			}
			elseif ( strpos($query, 'review') !== false )
			{
				if ( strpos($query, 'article') !== false )
				{
					cachepartial_removecache('article_index_categories');
				}
				else
				{
					cachepartial_removecache('listing_index_categories', 'promotion_index_categories');
				}
			}
		}
	}
	
	/**
	 * Function to remove cache files
	 * 	@desc Function to remove cache files
	 *  @author Arca Solutions, Inc.
	 * 	@param string file - unlimited
	 * 	@since July, 28, 2011
	 */
	function cachepartial_removecache()
	{
		$files = func_get_args();
		
		if(is_array($files))
		{
			foreach($files as $file)
			{
				if( strpos($file, '(.*)') === false )
				{
					$edirLanguages = explode(",", EDIR_LANGUAGES);
                    foreach($edirLanguages as $lang){
                        $_file = CACHE_PARTIAL_DIR.rtrim($file, '.php').'_'.$lang.'.php';

                        if ( @file_exists($_file) )
                        {
                            @unlink($_file);
                        }
                    }
				}
				else
				{
					$cacheRelativeDirectoryHandler = @opendir (CACHE_PARTIAL_DIR);
					while ($cacheFiles = readdir ($cacheRelativeDirectoryHandler))
					{
						if
						(
							($cacheFiles != '.' && $cacheFiles != '..')
							&& preg_match('/'.$file.'/', $cacheFiles)
						)
						{
							$_file = CACHE_PARTIAL_DIR.rtrim($cacheFiles, '.php').'.php';
							@unlink($_file);
						}
					}
					@closedir ($cacheRelativeDirectoryHandler);
				}
			}
		}
	}
?>