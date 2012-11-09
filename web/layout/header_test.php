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
	# * FILE: /layout/header.php
	# ----------------------------------------------------------------------------------------------------

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	include(INCLUDES_DIR."/code/headertag.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en">

	<head>
<? 
//wtc


	$gip =include(EDIRECTORY_ROOT."/getGeoIPf.php");
	$gip_a = explode(",", $gip);

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

	if(urldecode($_GET["where"])){
		$gip_a = explode(",", urldecode($_GET["where"]));
	}
	if(urldecode($_GET["keyword"])){
		$headertag_description = urldecode($_GET["keyword"]).', '.$headertag_description;
		$headertag_keywords = urldecode($_GET["keyword"]).', '.$headertag_keywords;
	}


	$gip_a[1]=trim($gip_a[1]);
	$st = array_search($gip_a[1], $st_arr);
	$stname = $gip_a[0]; 
	$_SESSION["s_state"] = $gip_a[1];
	$_SESSION["s_city"] = $gip_a[0];
	$_SESSION["s_kind"] = "";
	if ($_SERVER['REQUEST_URI'] == "/" || $_SERVER['REQUEST_URI'] == "http://dealcloudusa.com/") {
		$_SESSION["s_kind"] = "HOME";
	}
	if (strpos($_SERVER['REQUEST_URI'],"listing/") && !strpos($_SERVER['REQUEST_URI'],"location/") && !strpos($_SERVER['REQUEST_URI'],"results.php")) {
		$_SESSION["s_kind"] = "LISTINGS";
	}
	if (strpos($_SERVER['REQUEST_URI'],"deal/") && !strpos($_SERVER['REQUEST_URI'],"results.php")) {
		$_SESSION["s_kind"] = "DEALS";
	}
	if (strpos($_SERVER['REQUEST_URI'],"event/") && !strpos($_SERVER['REQUEST_URI'],"results.php")) {
		$_SESSION["s_kind"] = "EVENTS";
	}
	if (strpos($_SERVER['REQUEST_URI'],"classified/") && !strpos($_SERVER['REQUEST_URI'],"results.php")) {
		$_SESSION["s_kind"] = "CLASSIFIEDS";
	}

	
	//$headertag_description = $st." ".$headertag_description; 
	if ($st) { $gip_a[1] = $st;}

if (strpos($_SERVER['REQUEST_URI'],"listing/") and !strpos($_SERVER['REQUEST_URI'],"location/")) {
	$headertagdescrip_a = explode(",", $headertag_description);
	$headertagkey_a = explode(",", $headertag_keywords);
	if($headertagdescrip_a[0]){
		$htd = $headertagdescrip_a[0].' '.$gip_a[0].' '.$gip_a[1];
	}
	if($headertagdescrip_a[1]){
		$htd .= ', '.$headertagdescrip_a[1].' '.$gip_a[0].' '.$gip_a[1];
	}
	if($headertagdescrip_a[2]){
		$htd .= ', '.$headertagdescrip_a[2].' '.$gip_a[0].' '.$gip_a[1];
	}
	if($headertagdescrip_a[3]){
		$htd .= ', '.$headertagdescrip_a[3].' '.$gip_a[0].' '.$gip_a[1];
	}

	if($headertagkey_a[0]){
		$htk = $headertagkey_a[0].' '.$gip_a[0].' '.$gip_a[1];
	}
	if($headertagkey_a[1]){
		$htk .= ', '.$headertagkey_a[1].' '.$gip_a[0].' '.$gip_a[1];
	}
	if($headertagkey_a[2]){
		$htk .= ', '.$headertagkey_a[2].' '.$gip_a[0].' '.$gip_a[1];
	}
	if($headertagkey_a[3]){
		$htk .= ', '.$headertagkey_a[3].' '.$gip_a[0].' '.$gip_a[1];
	}


	$headertag_title = str_replace("Search results  in ","",$headertag_title);
	$headertag_title = str_replace("Search results  for ","",$headertag_title);


	//$headertag_description = $gip_a[0].' '.$gip_a[1]." ".$headertag_description;
	$headertag_description = $htd;
	//$headertag_keywords = $gip_a[0].' '.$gip_a[1]." ".$headertag_keywords;
	$headertag_keywords = $htk;

}


//end wtc
?>
		<? $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>


		<title><?=$headertag_title?></title>

		<? $headertag_author = (($headertag_author) ? ($headertag_author) : ("Arca Solutions")); ?>
		<meta name="author" content="<?=$headertag_author?>" />

		<? $headertag_description = (($headertag_description) ? ($headertag_description) : (EDIRECTORY_TITLE)); ?>
		<meta name="description" content="<?=$headertag_description?>" />

		<? $headertag_keywords = (($headertag_keywords) ? ($headertag_keywords) : (EDIRECTORY_TITLE)); ?>
		<meta name="keywords" content="<?=$headertag_keywords?>" />

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />

        <?=system_getFavicon(); ?>

		<?
		/**
		 * SearchMetaTags
		 * /* GOOGLE VERIFICATION * /
		 * /* YAHOO VERIFICATION * /
		 * /* LIVE VERIFICATION * /
		 */
		unset($array_tags);
		$array_tags = array();
		$array_tags[] = "'google'";
		$array_tags[] = "'yahoo'";
		$array_tags[] = "'live'";
		$searchMetaObj = new SearchMetaTag();
		$aux_array_meta_tags = $searchMetaObj->isSetFieldByArray($array_tags);
		if(is_array($aux_array_meta_tags)){
			for($i=0;$i<count($aux_array_meta_tags);$i++){
				echo $aux_array_meta_tags[$i];
			}
		}
		?>

		<meta name="ROBOTS" content="index, follow" />

		<?
		include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		?>
		
		<?=system_getNoImageStyle($cssfile = true);?>
		
		<?
		include(EDIRECTORY_ROOT."/includes/code/script_loader.php");
		?>
        
	</head>

	<body>
		<div id="div_to_share" class="share-box" style="display: none"></div>
             
        <? if (DEMO_MODE) { ?>
            <div class="top-navbar" id="topNavbar-options" style="display:none">
                <div class="top-wrapper">
                    <ul>
                        <li><a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/members/"><?=system_showText(LANG_SPONSOR_AREA);?></a></li>
                        <li id="demo_mode_sitemgr"><a href="<?=((SSL_ENABLED == "on" && FORCE_SITEMGR_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/sitemgr/"><?=system_showText(LANG_SITEMGR_AREA);?></a></li>
                    </ul>
                    <? include(EDIRECTORY_ROOT."/layout/themenavbar.php");?>
                </div>
            </div>

            <div class="top-button">
                <div class="top-open">
                    <a href="javascript: void(0);" onclick="controlTopnavbar();"><?=system_showText(LANG_LABEL_OPTIONS);?></a>
                </div>
            </div>
        <? } ?>
        
        <? include(system_getFrontendPath("IE6alert.php", "layout"));  ?>
        
		<? include(system_getFrontendPath("usernavbar.php", "layout"));  ?>
        
		<div id="header-wrapper">
            	
			<div id="header">
		
				<h1 class="logo">
					<a id="logo-link" href="<?=NON_SECURE_URL?>/index.php" target="_parent" title="<?=EDIRECTORY_TITLE?>" <?=system_getHeaderLogo();?>>
						<?=EDIRECTORY_TITLE?>
					</a>
				</h1>

				<? include(EDIRECTORY_ROOT."/frontend/banner_top.php"); ?>
                
				<? if (string_strpos($_SERVER['PHP_SELF'], "faq.php") === false){
					if(!$hide_search){
						include(EDIRECTORY_ROOT."/searchfront_test.php");
					}
				} ?>
			
			</div>
			
		</div>
		
		<div id="navbar-wrapper">
		
			<ul id="navbar">
				<?
				// CUSTOMIZED NAVBAR
				$navbarType = 'header';
				$add_new_id_to_validade = true;
				
				include(INCLUDES_DIR.'/code/navbar.php');
				?>
			</ul>
			
		</div>
		
		<div class="content-wrapper">