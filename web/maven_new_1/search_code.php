<?

/* ==================================================================*\
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
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /layout/header.php
# ----------------------------------------------------------------------------------------------------



$gip = include(EDIRECTORY_ROOT . "/getGeoIPf.php");
$gip_a = explode(",", $gip);

$st_arr = array(
    'AK' => 'Alaska',
    'AL' => 'Alabama',
    'AR' => 'Arkansas',
    'AZ' => 'Arizona',
    'CA' => 'California',
    'CO' => 'Colorado',
    'CT' => 'Connecticut',
    'DC' => 'District Of Columbia',
    'DE' => 'Delaware',
    'FL' => 'Florida',
    'GA' => 'Georgia',
    'HI' => 'Hawaii',
    'IA' => 'Iowa',
    'ID' => 'Idaho',
    'IL' => 'Illinois',
    'IN' => 'Indiana',
    'KS' => 'Kansas',
    'KY' => 'Kentucky',
    'LA' => 'Louisiana',
    'MA' => 'Massachusetts',
    'MD' => 'Maryland',
    'ME' => 'Maine',
    'MI' => 'Michigan',
    'MN' => 'Minnesota',
    'MO' => 'Missouri',
    'MS' => 'Mississippi',
    'MT' => 'Montana',
    'NC' => 'North Carolina',
    'ND' => 'North Dakota',
    'NE' => 'Nebraska',
    'NH' => 'New Hampshire',
    'NJ' => 'New Jersey',
    'NM' => 'New Mexico',
    'NV' => 'Nevada',
    'NY' => 'New York',
    'OH' => 'Ohio',
    'OK' => 'Oklahoma',
    'OR' => 'Oregon',
    'PA' => 'Pennsylvania',
    'RI' => 'Rhode Island',
    'SC' => 'South Carolina',
    'SD' => 'South Dakota',
    'TN' => 'Tennessee',
    'TX' => 'Texas',
    'UT' => 'Utah',
    'VA' => 'Virginia',
    'VT' => 'Vermont',
    'WA' => 'Washington',
    'WI' => 'Wisconsin',
    'WV' => 'West Virginia',
    'WY' => 'Wyoming'
);

if (urldecode($_GET["where"])) {
    $gip_a = explode(",", urldecode($_GET["where"]));
}
if (urldecode($_GET["keyword"])) {
    $headertag_description = urldecode($_GET["keyword"]) . ', ' . $headertag_description;
    $headertag_keywords = urldecode($_GET["keyword"]) . ', ' . $headertag_keywords;
}


$gip_a[1] = trim($gip_a[1]);
$st = array_search($gip_a[1], $st_arr);
$stname = $gip_a[0];
$_SESSION["s_state"] = $gip_a[1];
$_SESSION["s_city"] = $gip_a[0];
$_SESSION["s_kind"] = "";
if ($_SERVER['REQUEST_URI'] == "/" || $_SERVER['REQUEST_URI'] == DEFAULT_URL) {
    $_SESSION["s_kind"] = "HOME";
}
if (strpos($_SERVER['REQUEST_URI'], "listing/") && !strpos($_SERVER['REQUEST_URI'], "location/") && !strpos($_SERVER['REQUEST_URI'], "results.php")) {
    $_SESSION["s_kind"] = "LISTINGS";
}
if (strpos($_SERVER['REQUEST_URI'], "deal/") && !strpos($_SERVER['REQUEST_URI'], "results.php")) {
    $_SESSION["s_kind"] = "DEALS";
}
if (strpos($_SERVER['REQUEST_URI'], "event/") && !strpos($_SERVER['REQUEST_URI'], "results.php")) {
    $_SESSION["s_kind"] = "EVENTS";
}
if (strpos($_SERVER['REQUEST_URI'], "classified/") && !strpos($_SERVER['REQUEST_URI'], "results.php")) {
    $_SESSION["s_kind"] = "CLASSIFIEDS";
}


//$headertag_description = $st." ".$headertag_description; 
if ($st) {
    $gip_a[1] = $st;
}

if (strpos($_SERVER['REQUEST_URI'], "listing/") and !strpos($_SERVER['REQUEST_URI'], "location/")) {
    $headertagdescrip_a = explode(",", $headertag_description);
    $headertagkey_a = explode(",", $headertag_keywords);
    if ($headertagdescrip_a[0]) {
        $htd = $headertagdescrip_a[0] . ' ' . $gip_a[0] . ' ' . $gip_a[1];
    }
    if ($headertagdescrip_a[1]) {
        $htd .= ', ' . $headertagdescrip_a[1] . ' ' . $gip_a[0] . ' ' . $gip_a[1];
    }
    if ($headertagdescrip_a[2]) {
        $htd .= ', ' . $headertagdescrip_a[2] . ' ' . $gip_a[0] . ' ' . $gip_a[1];
    }
    if ($headertagdescrip_a[3]) {
        $htd .= ', ' . $headertagdescrip_a[3] . ' ' . $gip_a[0] . ' ' . $gip_a[1];
    }

    if ($headertagkey_a[0]) {
        $htk = $headertagkey_a[0] . ' ' . $gip_a[0] . ' ' . $gip_a[1];
    }
    if ($headertagkey_a[1]) {
        $htk .= ', ' . $headertagkey_a[1] . ' ' . $gip_a[0] . ' ' . $gip_a[1];
    }
    if ($headertagkey_a[2]) {
        $htk .= ', ' . $headertagkey_a[2] . ' ' . $gip_a[0] . ' ' . $gip_a[1];
    }
    if ($headertagkey_a[3]) {
        $htk .= ', ' . $headertagkey_a[3] . ' ' . $gip_a[0] . ' ' . $gip_a[1];
    }


    $headertag_title = str_replace("Search results  in ", "", $headertag_title);
    $headertag_title = str_replace("Search results  for ", "", $headertag_title);


    //$headertag_description = $gip_a[0].' '.$gip_a[1]." ".$headertag_description;
    $headertag_description = $htd;
    //$headertag_keywords = $gip_a[0].' '.$gip_a[1]." ".$headertag_keywords;
    $headertag_keywords = $htk;
}


//end wtc
?>
		