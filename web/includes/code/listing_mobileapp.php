<?

/* ==================================================================*\
  ######################################################################
  #   created by mavencrew                                             #
  ######################################################################
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/code/listing_mobileapp.php
# ----------------------------------------------------------------------------------------------------

function emptyPragraph($txt) {
    $txt = trim($txt, '<p>');
    $txt = trim($txt, '</p>');
    $txt = str_replace('&nbsp;', '', $txt);
    $txt = str_replace(' ', '', $txt);
    return empty($txt);
}

$mobile_screens = array('home',
    'splash',
    'promotion',
    'events',
    'classified',
    'special_announ', 'share', 'reviews', 'map', 'contactus', 'about');
$screen_has_emptydata = array('promotion', 'events', 'classified', 'reviews');

$errorPage = "$url_redirect/" . (($search_page) ? "search.php" : "index.php") . "?message=" . $message . "&screen=$screen&letter=$letter" . (($url_search_params) ? "&$url_search_params" : "") . "";
$level = new ListingLevel();
if ($id != -1) {
    if ($id) {
        $listing = new Listing($id);
        if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
            header("Location: " . $errorPage);
            exit;
        }
        if ((sess_getAccountIdFromSession() != $listing->getNumber("account_id")) && (!string_strpos($url_base, "/sitemgr"))) {
            header("Location: " . $errorPage);
            exit;
        }
        $listingHasMobileApp = $level->getHasMobileApp($listing->getNumber("level"));
        if ((!$listingHasMobileApp) || ($listingHasMobileApp != "y")) {
            header("Location: " . $errorPage);
            exit;
        }
        $account_id = $listing->getNumber("account_id");
    } else {
        header("Location: " . $errorPage);
        exit;
    }
} else {
    $listing = new Listing();
    $listing->id = -1;
    $listing->title = 'Defaults';
}



$mobileAppObj = new MobileApplication($id);
$defaultObj = new MobileApplication(-1);

# ----------------------------------------------------------------------------------------------------
# SUBMIT
# ----------------------------------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //trim all posts
    foreach ($_POST as $key => $val)
        $_POST[$key] = trim($val);


    if (empty($_GET['screen'])) {

        $mobileAppObj->enablePages(
                $_POST['is_enabled'], $_POST['splash_enabled'], $_POST['promotion_enabled'], $_POST['events_enabled'], $_POST['classified_enabled'], $_POST['special_announ_enabled'], $_POST['share_enabled'], $_POST['reviews_enabled'], $_POST['map_enabled'], $_POST['contactus_enabled'], $_POST['about_enabled'], $_POST['listing_id'], $file_name_to_save,
                (empty($_POST['bg_color'])) ? $defaultObj->bg_color : $_POST['bg_color'],
                (empty($_POST['show_inner_title'])) ? $defaultObj->show_inner_title : $_POST['show_inner_title']
        );
    } else if ($_GET['screen'] == 'splash') {
        $splash_title = empty($_POST['splash_title']) ? $defaultObj->splash_title : $_POST['splash_title'];
        $splash_title_or_logo = empty($_POST['splash_title_or_logo']) ? $defaultObj->splash_title_or_logo : $_POST['splash_title_or_logo'];

        
        if (get_magic_quotes_gpc()) {
            $splash_title = stripslashes($splash_title);
            $splash_title = mysql_real_escape_string($splash_title);
        } else {
            $splash_title = mysql_real_escape_string($splash_title);
        }

        if (empty($file_name_to_save))
            $file_name_to_save = $mobileAppObj->splash_extra_image;
        if (get_magic_quotes_gpc()) {
            $file_name_to_save = stripslashes($file_name_to_save);
            $file_name_to_save = mysql_real_escape_string($file_name_to_save);
        } else {
            $file_name_to_save = mysql_real_escape_string($file_name_to_save);
        }

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $sql = "UPDATE MobileApplication SET splash_title = '{$splash_title}', splash_title_or_logo = '{$splash_title_or_logo}'
				          , splash_extra_image = '{$file_name_to_save}' WHERE listing_id = {$id}";


        $dbObj->query($sql);
    } else if ($_GET['screen'] == 'home') {
        $home_title = empty($_POST['home_title']) ? $defaultObj->home_title : $_POST['home_title'];
        if (get_magic_quotes_gpc()) {
            $home_title = stripslashes($home_title);
            $home_title = mysql_real_escape_string($home_title);
        } else {
            $home_title = mysql_real_escape_string($home_title);
        }

        if (empty($file_name_to_save))
            $file_name_to_save = $mobileAppObj->logo_image;

        if (get_magic_quotes_gpc()) {
            $file_name_to_save = stripslashes($file_name_to_save);
            $file_name_to_save = mysql_real_escape_string($file_name_to_save);
        } else {
            $file_name_to_save = mysql_real_escape_string($file_name_to_save);
        }
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $sql = "UPDATE MobileApplication SET home_title = '{$home_title}',
				          logo_image = '{$file_name_to_save}' WHERE listing_id = {$id}";


        $dbObj->query($sql);



        //save logo image
    } else if ($_GET['screen'] == 'special_announ') {
        $special_announ_title = $_POST['special_announ_title'];
        $special_announ_title = empty($_POST['special_announ_title']) ? $defaultObj->special_announ_title : $_POST['special_announ_title'];
        if (get_magic_quotes_gpc()) {
            $special_announ_title = stripslashes($special_announ_title);
            $special_announ_title = mysql_real_escape_string($special_announ_title);
        } else {
            $special_announ_title = mysql_real_escape_string($special_announ_title);
        }
        $special_announ_content = emptyPragraph($_POST['special_announ_content']) ? $defaultObj->special_announ_content : $_POST['special_announ_content'];
        if (get_magic_quotes_gpc()) {
            $special_announ_content = stripslashes($special_announ_content);
            $special_announ_content = mysql_real_escape_string($special_announ_content);
        } else {
            $special_announ_content = mysql_real_escape_string($special_announ_content);
        }
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $sql = "UPDATE MobileApplication SET special_announ_title = '{$special_announ_title}',
				          special_announ_content = '{$special_announ_content}' WHERE listing_id = {$id}";

        $dbObj->query($sql);
    } else if (!empty($_GET['screen']) && in_array($_GET['screen'], $screen_has_emptydata)) {
        $title = $_POST["{$_GET['screen']}_title"];
        $title = empty($title) ? $defaultObj->{$_GET['screen'] . '_title'} : $title;
        if (get_magic_quotes_gpc()) {
            $title = stripslashes($title);
            $title = mysql_real_escape_string($title);
        } else {
            $title = mysql_real_escape_string($title);
        }
        $no_data = $_POST['txt_' . $_GET['screen'] . '_no_data'];
        $no_data = emptyPragraph($no_data) ? $defaultObj->{$_GET['screen'] . '_no_data'} : $no_data;
        if (get_magic_quotes_gpc()) {
            $no_data = stripslashes($no_data);
            $no_data = mysql_real_escape_string($no_data);
        } else {
            $no_data = mysql_real_escape_string($no_data);
        }
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $sql = "UPDATE MobileApplication SET {$_GET['screen']}_title = '{$title}',{$_GET['screen']}_no_data = '{$no_data}' WHERE listing_id = {$id}";


        $dbObj->query($sql);
    } else if (!empty($_GET['screen'])) {
        $title = $_POST["{$_GET['screen']}_title"];
        $title = empty($title) ? $defaultObj->{$_GET['screen'] . '_title'} : $title;

        if (get_magic_quotes_gpc()) {
            $title = stripslashes($title);
            $title = mysql_real_escape_string($title);
        } else {
            $title = mysql_real_escape_string($title);
        }

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $sql = "UPDATE MobileApplication SET {$_GET['screen']}_title = '{$title}' WHERE listing_id = {$id}";


        $dbObj->query($sql);
    }
}
$mobileAppObj = new MobileApplication($id);

# ----------------------------------------------------------------------------------------------------
# FORMS DEFINES
# ----------------------------------------------------------------------------------------------------
$listing->extract();

/**
 * Get promotion information 
 */
/* if($promotion_id){
  unset($promotionObj);
  $promotionObj = new Promotion($promotion_id);
  $promotion_name = $promotionObj->getString("name");
  } */
?>