
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
    if (strpos($uri, '?') > 0) {
        $uri = substr($uri, 0, strpos($uri, '?'));
    }
    $segments = explode("/", trim($uri, "/"));
    //print_r($segments);
    if ($item_index == NULL) {

        return $segments;
    } else {
        if (isset($segments[$item_index])) {
            return $segments[$item_index];
        } else {
            return FALSE;
        }
    }
}

function showErrorMsg($error_msg) {
    echo '<div class="txt_block txt_center">' . $error_msg . '</div>';
}

function showNotFoundPage() {
    //header( 'HTTP/1.1 404 Not Found');
    header('Location: http://www.dealcloudusa.com/mobi/error.html');
    exit();
}

$base_url = "http://" . $_SERVER["HTTP_HOST"] . '/';
$mobile_base_url = $base_url . 'mobi/';


/* * ********************************************************************* */
/* * **********************************process**************************** */
/* * ********************************************************************* */


include("../conf/loadconfig.inc.php");








$listing_id = getUriSegments(2);
$listing = new Listing($listing_id);
if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
    showNotFoundPage();
}



//check if mobile page is enabled  or not
include("../classes/class_MobileApplication.php");
 include(EDIRECTORY_ROOT . "/classes/class_MobileApplication_Settings.php");
$mobileAppObj = new MobileApplication($listing_id);
$is_mobile_app_enabled = $mobileAppObj->isMobileAppEnabled();
if ($is_mobile_app_enabled) {
    $enabled_mobile_pages = $mobileAppObj->getEnabledMobilePages();


    //add inner pages names to enable_mobile_pages 
    $all_allowed_pages = array_merge(array('promotion_detail', 'event_detail', 'classified_detail', 'login', 'mydeal', 'redeem', 'popuptest'), $enabled_mobile_pages);

    $page_to_load = getUriSegments(3);
    $is_empty_page_request = empty($page_to_load);



    //prepare main page if splash or home
    if ($is_empty_page_request && in_array('splash', $all_allowed_pages)) {
        $page_to_load = 'splash';
    } else if (($is_empty_page_request || $page_to_load == 'splash') && !in_array('splash', $all_allowed_pages)) {
        $page_to_load = 'home';
    } else if ((!$is_empty_page_request && in_array($page_to_load, $all_allowed_pages)) || $page_to_load == 'home') {
        
    } else {
        showNotFoundPage();
    }



    /*     * ****************************************************************** */
    /*     * ******************authontiaction********************************* */
    /*     * ****************************************************************** */
    $not_public = array('mydeal', 'redeem');
    if (in_array($page_to_load, $not_public) && !sess_getAccountIdFromSession()) {
        header('location:' . DEFAULT_URL . '/mobi/index.php/' . $listing->id . '/login?redirecturl=' . urlencode( DEFAULT_URL . $_SERVER['REQUEST_URI']));
    }
    /*     * ******************************************************************* */

    /*     * ******************************************************************* */
    /*     * *********************prep page title******************************* */
    /*     * ******************************************************************* */
    $page_title = '';
    if (in_array($page_to_load, $enabled_mobile_pages)) {
        $page_title = $mobileAppObj->{$page_to_load . '_title'};
    } elseif ($page_to_load == 'mydeal') {
        $page_title = 'My Deals';
    } elseif ($page_to_load == 'login') {
        $page_title = "Login";
    }

    /*     * ******************************************************************* */



    //load the requested page
    
    $load_content_only = FALSE;
    if($_GET['is_popup']){
         $load_content_only = TRUE;
    }
    if($_GET['redirecturl'] && strpos($_GET['redirecturl'],'is_popup')){
        
        $load_content_only = TRUE;
    }
    
    
    if (!$load_content_only) {
        include('includes/header.php');
    }
    include('includes/' . $page_to_load . '.php');
    if (!$load_content_only) {
        include('includes/footer.php');
    }
} else {
    showNotFoundPage();
}
?>