<?

	/*==================================================================*\
	######################################################################
	#   created by mavencrew                                             #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_MobileApplication.php
	# ----------------------------------------------------------------------------------------------------

class MobileApplication {

	##################################################
	# PRIVATE
	##################################################

	var $id;
	var $listing_id;
	var $is_enabled;
	var $promotion_title;
	var $promotion_enabled;
	var $promotion_no_data;
	var $events_title;
	var $events_enabled;
	var $events_no_data;
	var $classified_title;
	var $classified_enabled;
	var $classified_no_data;
	var $special_announ_title;
	var $special_announ_enabled;
	var $special_announ_no_data;
	var $share_title;
	var $share_enabled;
	var $reviews_title;
	var $reviews_enabled;
	var $reviews_no_data;
	var $map_title;
	var $map_enabled;
	var $contactus_title;
	var $contactus_enabled;
	var $about_title;
	var $about_enabled;
	var $splash_title;
	var $splash_enabled;
	var $splash_extra_image;
	var $home_title;
	var $logo_image;
	var $bg_color;
	var $special_announ_content;
	var $data_in_array;
	var $fav_icon_img;
        
        var $splash_title_or_logo;
        var $show_inner_title;
       
        

	function MobileApplication($listing_id ='') {
              //  $this->default_obj = new MobileApplication(-1);
		if (is_numeric($listing_id) && ($listing_id)) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$db = db_getDBObject();
			}
			unset($dbMain);
			$sql = "SELECT * FROM MobileApplication WHERE listing_id = ".$listing_id;
			$row = mysql_fetch_array($db->query($sql));

			//$this->old_account_id = $row["account_id"];
			
			if($row == FALSE)
			{
                            
                            
                            $columns_nams = '  is_enabled, promotion_title, promotion_enabled, promotion_no_data, events_title, events_enabled, events_no_data, classified_title, classified_enabled, classified_no_data, special_announ_title, special_announ_enabled, special_announ_no_data, share_title, share_enabled, reviews_title, reviews_enabled, reviews_no_data, map_title, map_enabled, contactus_title, contactus_enabled, about_title, about_enabled, splash_title, splash_enabled, splash_extra_image, home_title, logo_image, bg_color, special_announ_content, fav_icon_img,splash_title_or_logo,show_inner_title ';
				
                             $sql2 = "INSERT INTO  MobileApplication (listing_id, {$columns_nams}) SELECT {$listing_id},{$columns_nams}  FROM  MobileApplication WHERE listing_id = -1";
                            // $sql2 = ' INSERT INTO  MobileApplication SELECT * FROM  MobileApplication WHERE listing_id = -1';
		            //echo $sql2;
                             //exit();
                             $db->query($sql2);
                            
			}

			$this->makeFromRow($row);
		}
		else {
			$this->makeFromRow('');
		}
	}
        
        
        
       
        
        
	
	function isMobileAppEnabled($listing_id = ''){
		if (is_numeric($listing_id) && ($listing_id)){
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			
			
			//1. check if there is already a settings for the listing or not
			$sql = "SELECT id,is_enabled FROM MobileApplication WHERE listing_id = ".$listing_id;
			$row = mysql_fetch_array($dbObj->query($sql));
			
			
			if($row != FALSE){
				if($row['is_enabled'] == 'y'){
					return TRUE;
				}
				else{
					return FALSE; 
				}
			}
			else{
				return FALSE;
			}
		} 
		else {
			if($this->is_enabled == 'y' && !empty($this->id)){
				return TRUE;
			}
			else{
				return FALSE; 
			}
		}
		
	}
	
	function getEnabledMobilePages(){
		$enabled_page = array();
		if($this->isMobileAppEnabled()){
			if($this->promotion_enabled == 'y'){
				array_push($enabled_page,'promotion');
			}
			if($this->events_enabled == 'y'){
				array_push($enabled_page,'events');
			}
			if($this->classified_enabled == 'y'){
				array_push($enabled_page,'classified');
			}
			if($this->special_announ_enabled == 'y'){
				array_push($enabled_page,'special_announ');
			}
			if($this->share_enabled == 'y'){
				array_push($enabled_page,'share');
			}
			if($this->reviews_enabled == 'y'){
				array_push($enabled_page,'reviews');
			}
			if($this->contactus_enabled == 'y'){
				array_push($enabled_page,'map');
			}
			if($this->contactus_enabled == 'y'){
				array_push($enabled_page,'contactus');
			}
			if($this->about_enabled == 'y'){
				array_push($enabled_page,'about');
			}
			if($this->splash_enabled == 'y'){
				array_push($enabled_page,'splash');
			}
			
		}
		return $enabled_page;
	}
	
	//converts row to an object and if values empty set the object fields withh the default values
	function makeFromRow($row='') {
                
                 
                 
		$this->id = ($row["id"])	? $row["id"]	: 0;
		$this->listing_id = ($row["listing_id"])	? $row["listing_id"]	: 0;
		$this->is_enabled = ($row["is_enabled"])	? $row["is_enabled"]	: 'y';
		$this->promotion_title = ($row["promotion_title"])	? $row["promotion_title"]	: 'promotion_title';
		$this->promotion_enabled = ($row["promotion_enabled"])	? $row["promotion_enabled"]	: 'y';
		$this->promotion_no_data = ($row["promotion_no_data"])	? $row["promotion_no_data"]	: '';
		$this->events_title = ($row["events_title"])	? $row["events_title"]	: "Events";
		$this->events_enabled = ($row["events_enabled"])	? $row["events_enabled"]	: 'y';
		$this->events_no_data = ($row["events_no_data"])	? $row["events_no_data"]	: '';
		$this->classified_title = ($row["classified_title"])	? $row["classified_title"]	: 'Classified';
		$this->classified_enabled = ($row["classified_enabled"])	? $row["classified_enabled"]	: 'y';
		$this->classified_no_data = ($row["classified_no_data"])	? $row["classified_no_data"]	: '';
		$this->special_announ_title = ($row["special_announ_title"])	? $row["special_announ_title"]	: 'Special Announcements';
		$this->special_announ_enabled = ($row["special_announ_enabled"])	? $row["special_announ_enabled"]	: 'y';
		$this->special_announ_no_data = ($row["special_announ_no_data"])	? $row["special_announ_no_data"]	: '';
		$this->share_title = ($row["share_title"])	? $row["share_title"]	: 'hare with Friends';
		$this->share_enabled = ($row["share_enabled"])	? $row["share_enabled"]	: 'y';
		$this->reviews_title = ($row["reviews_title"])	? $row["reviews_title"]	: 'Reviews';
		$this->reviews_enabled = ($row["reviews_enabled"])	? $row["reviews_enabled"]	: 'y';
		$this->reviews_no_data = ($row["reviews_no_data"])	? $row["reviews_no_data"]	: '';
		$this->map_title = ($row["map_title"])	? $row["map_title"]	: 'Map';
		$this->map_enabled = ($row["map_enabled"])	? $row["map_enabled"]	: 'y';
		$this->contactus_title = ($row["contactus_title"])	? $row["contactus_title"]	: 'Contact Us';
		$this->contactus_enabled = ($row["contactus_enabled"])	? $row["contactus_enabled"]	: 'y';
		$this->about_title = ($row["about_title"])	? $row["about_title"]	: 'About Us';
		$this->about_enabled = ($row["about_enabled"])	? $row["about_enabled"]	: 'y';
		$this->splash_title = ($row["splash_title"])	? $row["splash_title"]	: 'Splash Page';
		$this->splash_enabled = ($row["splash_enabled"])	? $row["splash_enabled"]	: 'y';
		$this->splash_extra_image = ($row["splash_extra_image"])	? $row["splash_extra_image"]	: '';
		$this->home_title = ($row["home_title"])	? $row["home_title"]	: 'Home';
		$this->logo_image = ($row["logo_image"])	? $row["logo_image"]	: '';
		$this->bg_color = ($row["bg_color"])	? $row["bg_color"]	: 'FFFFFF';
		$this->special_announ_content = ($row["special_announ_content"])	? $row["special_announ_content"]	: '';
		$this->fav_icon_img = ($row["fav_icon_img"])	? $row["fav_icon_img"]	: '';
                $this->show_inner_title = ($row["show_inner_title"])	? $row["show_inner_title"]	: '';
                $this->splash_title_or_logo = ($row["splash_title_or_logo"])	? $row["splash_title_or_logo"]	: '';

        
		$this->data_in_array = $row; 
		
	}
	
	function enablePages( 
		$is_enabled,
                $splash_enabled,
		$promotion_enabled,
		$events_enabled,
		$classified_enabled,
		$special_announ_enabled,
		$share_enabled,
		$reviews_enabled,
		$map_enabled,
		$contactus_enabled,
		$about_enabled,
		$listing_id,
		$fav_icon_img,
		$bg_color,
                $show_inner_title
		){
		
		
		
		
		
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		
		
		//1. check if there is already a settings for the listing or not
		$sql = "SELECT * FROM MobileApplication WHERE listing_id = ".$listing_id;
		$row = mysql_fetch_array($dbObj->query($sql));
		
		
		if($row != FALSE){
			if(empty($fav_icon_img)) $fav_icon_img = $row['fav_icon_img'];
			$sql = "UPDATE MobileApplication SET is_enabled = '{$is_enabled}',
				          promotion_enabled = '{$promotion_enabled}', events_enabled = '{$events_enabled}',
						  classified_enabled = '{$classified_enabled}',	
                                                  splash_enabled = '{$splash_enabled}',

						  special_announ_enabled = '{$special_announ_enabled}',
						  share_enabled = '{$share_enabled}',
						  reviews_enabled = '{$reviews_enabled}',
						  map_enabled = '{$map_enabled}',
						  contactus_enabled = '{$contactus_enabled}',
						  fav_icon_img = '{$fav_icon_img}',
						  bg_color = '{$bg_color}',
                                                  show_inner_title = '{$show_inner_title}',    
						  about_enabled = '{$about_enabled}' WHERE listing_id = '{$listing_id}'";
		}
		else{
			$sql = "INSERT INTO  MobileApplication".
				" (is_enabled,fav_icon_img,bg_color,show_inner_title,promotion_enabled,events_enabled,classified_enabled,special_announ_enabled,share_enabled,reviews_enabled,map_enabled,contactus_enabled,about_enabled, listing_id) ".
				" VALUES('".$is_enabled.
				"', '".$fav_icon_img.
				"', '".$bg_color.
                                "', '".$show_inner_title.
				"', '".$promotion_enabled.
				"', '".$events_enabled.
				"', '".$classified_enabled.
				"', '".$special_announ_enabled.
				"', '".$share_enabled.
				"', '".$reviews_enabled.
				"', '".$map_enabled.
				"', '".$contactus_enabled.
				"', '".$about_enabled.
				"', '".$listing_id.
				"') ";
		}
		
		
		$dbObj->query($sql);
		
	}
	
	
	
	
	
}?>
