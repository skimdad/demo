
<?php 

    /*
	//helper functions
	*/
	
	/*
	//url://www.dealscloud.com/mobi/index.php/{$id}/{$page_to_load}
    //split uri segments
	*/
	$isMobileApp_MOBI = TRUE;
	
	function getUriSegments($item_index = NULL) {
		$uri = $_SERVER['REQUEST_URI'];
		 
		$segments = explode("/", trim($uri,"/"));
		//print_r($segments);
		if($item_index == NULL) {
			
			return $segments;
	    }else {
		      if(isset($segments[$item_index])) {
				 return $segments[$item_index];
			  } 
			  else {
				 return FALSE;
			  }
			 
		}
	}
	
	
	function showNotFoundPage(){
		header( 'HTTP/1.1 404 Not Found');
		exit();
	}
	
	$base_url = 'http://www.dealcloudusa.com/';
	$mobile_base_url = $base_url.'mobi/';
	
	/************************************************************************/
	/************************************process*****************************/
	/************************************************************************/
	
	
	include("../conf/loadconfig.inc.php");
	
	$listing_id = getUriSegments(2);
	$listing = new Listing($listing_id);
	if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
		   showNotFoundPage();
    }
	
	
	//check if mobile page is enabled  or not
	include("../classes/class_MobileApplication.php");
	$mobileAppObj = new MobileApplication($listing_id);
	$is_mobile_app_enabled = $mobileAppObj->isMobileAppEnabled();
	if($is_mobile_app_enabled){
	    $enabled_mobile_pages = $mobileAppObj->getEnabledMobilePages();
		
		
		//add inner pages names to enable_mobile_pages 
		$all_allowed_pages = array_merge( array('promotion_detail','event_detail','classified_detail'),$enabled_mobile_pages);
		
		$page_to_load = getUriSegments(3);
		$is_empty_page_request = empty($page_to_load);
		
		
		
		//prepare main page if splash or home
	    if($is_empty_page_request && in_array('splash',$all_allowed_pages)){
			$page_to_load = 'splash';
		}
		else if(($is_empty_page_request|| $page_to_load == 'splash') && !in_array('splash',$all_allowed_pages)){
			$page_to_load = 'home';
		}	
        else if((!$is_empty_page_request && in_array($page_to_load,$all_allowed_pages)) || $page_to_load == 'home'){
			
		}
		else{
			showNotFoundPage();
        }		
		
		//load the requested page
		include('includes/header.php');
		include('includes/'.$page_to_load.'.php');
		include('includes/footer.php');
		

	}
	else{
		showNotFoundPage();
	}
	
	

	
	
	
	
	




?>