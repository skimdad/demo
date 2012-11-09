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
	# * FILE: /conf/load_wtc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE STRING FUNCTIONS TO BE USED IN ALL OTHER FILES
	# ----------------------------------------------------------------------------------------------------$st_arr=array(

	$st_arr=array(
	'AK'=>'Alaska',
	'AL'=>'Alabama',
	'AR'=>'Arkansas',
	'AZ'=>'Arizona',
	'CA'=>'California',
	'CO'=>'Colorado',
	'CT'=>'Connecticut',
	'DC'=>'District Of Columbia',
	'DE'=>'Delaware',
	'FL'=>'Florida',
	'GA'=>'Georgia',
	'HI'=>'Hawaii',
	'IA'=>'Iowa',
	'ID'=>'Idaho',
	'IL'=>'Illinois',
	'IN'=>'Indiana',
	'KS'=>'Kansas',
	'KY'=>'Kentucky',
	'LA'=>'Louisiana',
	'MA'=>'Massachusetts',
	'MD'=>'Maryland',
	'ME'=>'Maine',
	'MI'=>'Michigan',
	'MN'=>'Minnesota',
	'MO'=>'Missouri',
	'MS'=>'Mississippi',
	'MT'=>'Montana',
	'NC'=>'North Carolina',
	'ND'=>'North Dakota',
	'NE'=>'Nebraska',
	'NH'=>'New Hampshire',
	'NJ'=>'New Jersey',
	'NM'=>'New Mexico',
	'NV'=>'Nevada',
	'NY'=>'New York',
	'OH'=>'Ohio',
	'OK'=>'Oklahoma',
	'OR'=>'Oregon',
	'PA'=>'Pennsylvania',
	'RI'=>'Rhode Island',
	'SC'=>'South Carolina',
	'SD'=>'South Dakota',
	'TN'=>'Tennessee',
	'TX'=>'Texas',
	'UT'=>'Utah',
	'VA'=>'Virginia',
	'VT'=>'Vermont',
	'WA'=>'Washington',
	'WI'=>'Wisconsin',
	'WV'=>'West Virginia',
	'WY'=>'Wyoming'
	);

//htmlencde($_SERVER['SCRIPT_FILENAME']);

$myip = '115.186.162.219##';
if ($_SERVER['REMOTE_ADDR'] == $myip){
htmlencde($_SERVER['SCRIPT_FILENAME'],1);
htmlencde($_SERVER['REQUEST_URI'],1);
htmlencde($_SERVER[''],1);
htmlencde("load.php s_zip at start = ".$_SESSION["s_zip"],1);
htmlencde("load.php s_city at start = ".$_SESSION["s_city"],1);
htmlencde("load.php s_state at start = ".$_SESSION["s_state"],1);

htmlencde("load.php KEYBOX at start = ".$_GET["keyword"],1);
htmlencde("load.php ZIPBOX at start = ".$_GET["zip"],1);
htmlencde("load.php WHEREBOX at start = ".$_GET["where"],1);	
}

	$debug = false;
	/* if ($GET['sessid'] <> $_SESSION["s_sessid"] && false) {
		$sessid = md5(uniqid(rand(), true));
		$GET['sessid'] = $sessid;
		$_SESSION["s_sessid"] =  $sessid;
		resetSession();
	} else {
		 $sessid = $GET['sessid'];
	} */
	
	if (strlen($_GET['where']) ==5 && is_numeric($_GET['where']) && !strpos($_SERVER['REQUEST_URI'],"article/")) {
		$_GET['zip'] = $_GET['where'];
		$_GET['where'] = "";
	}
	if (strlen($_GET['zip']) ==5 && is_numeric($_GET['zip'])) {
		 $tmpwhere = $_GET['where'];
		 $_GET['where'] = "";
	}
	if (!$_GET['zip']){
		unset($_SESSION["s_zip"]);
	}
	//GET Location by Zip
		if(isset($_GET['zip']) && $_GET['zip'] != "") {
			$dbObj = db_getDBObject();
			$sql="SELECT * FROM `zip` WHERE Zipcode = '".$_GET['zip']."' limit 1";
			$resultzip = $dbObj->query($sql);
			$row = mysql_fetch_assoc($resultzip);
			if ($row) {
				$gip_a[0] = $row['City'];
				$gip_a[1] = $st_arr[$row['State']];
				$gip_a[2] = "United States";
			} else {
				$gip_a[0] = "";
				$gip_a[1] = "";
				$gip_a[2] = "";		
			}
			$_SESSION["s_zip"] = $_GET["zip"];
			unset($dbObj);
		} else { //GET Zip by Location

			if ($_SESSION["s_zip"] == ""){ //($_SESSION["s_city"]=="" && $_SESSION["s_state"]=="" && $_SESSION["s_zip"]=="") {
				$gip =include(EDIRECTORY_ROOT."/getGeoIPf.php");
				$gip_a = explode(",", $gip);
			} else {
				$gip_a = array($_SESSION["s_city"],$_SESSION["s_state"],$_SESSION["s_country"]);
			}

			if ($debug) {
			$gip = explode(",", "ROCHESTER, New York, United States");
			$tmpwhere = "ROCHESTER, New+York, United+States";
			$_GET['where'] = $tmpwhere;
			 $where = $tmpwhere;
			}
			
			if(urldecode($_GET["where"]) && $_GET["where"] != ""){
				$gip_a = explode(",", urldecode($_GET["where"])); 
				if ($gip_a[0]=="United States") { 
					$gip_a[0] = $gip_a[2]; $gip_a[2] = "United States"; 
				}
			}		
			$gip_a[1]=trim($gip_a[1]);
			$st = array_search($gip_a[1], $st_arr);	
		
			$dbObj = db_getDBObject();
			$sql="SELECT Zipcode FROM `zip` WHERE State = '".$st."' AND City = '".$gip_a[0]."'";
			$resultzip = $dbObj->query($sql);
			$row = mysql_fetch_assoc($resultzip);
			if ($row) {
				$_SESSION["s_zip"] = $row['Zipcode'];
				$_GET['zip'] = $_SESSION["s_zip"];
				$_GET['where'] = "";
			} else {
				$where = $tmpwhere;
			}
			unset($dbObj);
	}


	if ($gip_a[2]!="") $_SESSION["s_country"] = trim($gip_a[2]);
	if ($gip_a[1]!="") $_SESSION["s_state"] = trim($gip_a[1]);
	if ($gip_a[0]!="") $_SESSION["s_city"] = trim($gip_a[0]);

	if ($_SESSION["s_zip"] != "" && $_GET['where'] != ""){
		 $tmpwhere = $_GET['where'];
		 $_GET['where'] = "";
	}

	

	if ($_GET['dist']) $dist = $_GET['dist'];
	
	 if ($_SESSION["s_city"]!="" && $_SESSION["s_state"]!="" ) {
		$tmpwhere = $_SESSION["s_city"].", ".$_SESSION["s_state"].", ".$_SESSION["s_country"];
		//$_GET['where'] = $where;
	} else {
		;//$where = "";
	} 

	if ($_GET['keyword']){
		 $_SESSION["s_keyword"] = $_GET['keyword'];
		 $keyword = $_GET['keyword'];
	} else {
		$_SESSION["s_keyword"] = $_SESSION["s_keyword"];
	}
	
	if ($_SESSION["s_reset"]){
		resetSession();
	}
	if ($_SESSION["s_firstvist"] && $_SESSION["s_zip"] != "") {
		$_SESSION["s_firstvist"] = false;
		header("Location: http://www.dealcloudusa.com/deal/results.php?keyword=&where=".str_replace(" ","+",$tmpwhere)."&match=allwords&advsearch=yes&category_id=&dist=100&zip=".$_SESSION["s_zip"]."&sessid=".$sessid);
		exit;
	}
	
if ($_SERVER['REMOTE_ADDR'] == $myip){
htmlencde("load.php s_zip at end = ".$_SESSION["s_zip"],1);
htmlencde("load.php s_city at end = ".$_SESSION["s_city"],1);
htmlencde("load.php s_state at end = ".$_SESSION["s_state"],1);	
htmlencde("load.php KEYBOX at end = ".$_GET["keyword"],1);
htmlencde("load.php WHEREBOX at end = ".$_GET["where"],1);	
htmlencde("load.php ZIPBOX at end = ".$_GET["zip"],1);
}

function resetSession(){
	global $where;
	$_SESSION["s_reset"]=false;
	$_SESSION["s_zip"] = "";
	$_SESSION["s_city"] = "";
	$_SESSION["s_state"] = "";
	$_SESSION["s_keyword"] = "";
	$_SESSION["s_where"] = "";
	$_SESSION["s_sessid"] = "";
	$_GET["keyword"] = "";
	$_GET["where"] = "";
	$_GET["zip"] = "";
	$_GET["dist"] = "";
	$tmpwhere="";
	$where="";
}

?>