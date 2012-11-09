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
/* 	
	if ($_SESSION["s_city"]=="" && $_SESSION["s_state"]=="" && $_SESSION["s_zip"]=="") {
		$gip =include(EDIRECTORY_ROOT."/getGeoIPf.php");
		$gip_a = explode(",", $gip);
	} else {
		$gip_a = array($_SESSION["s_city"],$_SESSION["s_state"],$_SESSION["s_country"]);
	}


	if(urldecode($_GET["where"]) && $_GET["where"] != ""){
		$gip_a = explode(",", urldecode($_GET["where"])); 
		if ($gip_a[0]=="United States") { 
			$gip_a[0] = $gip_a[2]; $gip_a[2] = "United States"; 
		}
	}		


	$gip_a[1]=trim($gip_a[1]);
	$st = array_search($gip_a[1], $st_arr);

	//GET Zip by Location
 	if ((!isset($_SESSION["s_zip"]) || $_SESSION["s_zip"] == "") && $gip_a[0] !=""){
		$dbObj = db_getDBObject();
		$sql="SELECT Zipcode FROM `zip` WHERE State = '".$st."' AND City = '".$gip_a[0]."'";
		$resultzip = $dbObj->query($sql);htmlencde($sql,1);
		$row = mysql_fetch_assoc($resultzip);
		$_SESSION["s_zip"] = $row['Zipcode'];
		unset($dbObj);
	}  
	//GET Location by Zip
	if($_GET['zip'] != '') {
		$dbObj = db_getDBObject();
		$sql="SELECT * FROM `zip` WHERE Zipcode = '".$_SESSION["s_zip"]."' limit 1";
		$resultzip = $dbObj->query($sql);htmlencde($sql,1);
		$row = mysql_fetch_assoc($resultzip);
		if ($row) {
			$gip_a[0] = $row['City'];
			$gip_a[1] = $st_arr[$row['State']];
			$gip_a[2] = "United States";
		}
		//$_GET["zip"] = $_SESSION["s_zip"];
		unset($dbObj);
	}

	if ($gip_a[2]!="") $_SESSION["s_country"] = trim($gip_a[2]);
	if ($gip_a[1]!="") $_SESSION["s_state"] = trim($gip_a[1]);
	if ($gip_a[0]!="") $_SESSION["s_city"] = trim($gip_a[0]);

 */
	include_once(EDIRECTORY_ROOT."/conf/load_wtc.php");
	//if ($tmpwhere) $_GET['where'] = $tmpwhere; // sets back where after search
	$_SESSION["s_kind"] = "";
	if ($_SERVER['REQUEST_URI'] == "/" || substr($_SERVER['REQUEST_URI'],1,6) == "result" || strpos($_SERVER['REQUEST_URI'],"home_results.php")) {
		$_SESSION["s_kind"] = "HOME";
	}
	if (strpos($_SERVER['REQUEST_URI'],"listing/") && !strpos($_SERVER['REQUEST_URI'],"home_results.php")){// && !strpos($_SERVER['REQUEST_URI'],"location/") && !strpos($_SERVER['REQUEST_URI'],"results.php")) {
		$_SESSION["s_kind"] = "LISTINGS";
	}
	if (strpos($_SERVER['REQUEST_URI'],"deal/") ){//&& !strpos($_SERVER['REQUEST_URI'],"results.php")) {
		$_SESSION["s_kind"] = "DEALS";
	}
	if (strpos($_SERVER['REQUEST_URI'],"event/")){// && !strpos($_SERVER['REQUEST_URI'],"results.php")) {
		$_SESSION["s_kind"] = "EVENTS";
	}
	if (strpos($_SERVER['REQUEST_URI'],"classified/")){// && !strpos($_SERVER['REQUEST_URI'],"results.php")) {
		$_SESSION["s_kind"] = "CLASSIFIEDS";
	}
	if (strpos($_SERVER['REQUEST_URI'],"article/")){// && !strpos($_SERVER['REQUEST_URI'],"results.php")) {
		$_SESSION["s_kind"] = "ARTICLES";
	}
	if (strpos($_SERVER['REQUEST_URI'],"blog/") ){//&& !strpos($_SERVER['REQUEST_URI'],"results.php")) {
		$_SESSION["s_kind"] = "BLOGS";
	}	
	//$headertag_description = $st." ".$headertag_description; 
	
	if(urldecode($_GET["keyword"])){
		$headertag_description = urldecode($_GET["keyword"]).', '.$headertag_description;
		$headertag_keywords = urldecode($_GET["keyword"]).', '.$headertag_keywords;
	}
if (strpos($_SERVER['REQUEST_URI'],"listing/") && !strpos($_SERVER['REQUEST_URI'],"location/")) {
	if ($st) { $gip_a[1] = $st;}
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

		<? $headertag_author = (($headertag_author) ? ($headertag_author) : ("iConnectedMarketing")); ?>
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
					if(!$hide_search && false){
						include(EDIRECTORY_ROOT."/searchfront.php");
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