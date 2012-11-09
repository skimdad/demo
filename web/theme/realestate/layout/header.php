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
	# * FILE: /theme/realestate/layout/header.php
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

		<? $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>
		<title><?=$headertag_title?></title>

		<? $headertag_author = (($headertag_author) ? ($headertag_author) : ("Arca Solutions")); ?>
		<meta name="author" content="<?=$headertag_author?>" />

		<? $headertag_description = (($headertag_description) ? ($headertag_description) : (EDIRECTORY_TITLE)); ?>
		<meta name="description" content="<?=$headertag_description?>" />

		<? $headertag_keywords = (($headertag_keywords) ? ($headertag_keywords) : (EDIRECTORY_TITLE)); ?>
		<meta name="keywords" content="<?=$headertag_keywords?>" />

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
        
        <?=system_getFavicon();?>

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
        
		<? include(system_getFrontendPath("IE6alert.php", "layout"));  ?>
        
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
        <? } ?>
        
		<div id="header-wrapper">
        
            <? if (DEMO_MODE) { ?>
                <div class="top-button">
                    <div class="top-open">
                        <a href="javascript: void(0);" onclick="controlTopnavbar();"><?=system_showText(LANG_LABEL_OPTIONS);?></a>
                    </div>
                </div>
            <? } ?>
		
			<div id="header">
		
				<h1 class="logo">
					<a id="logo-link" href="<?=NON_SECURE_URL?>/index.php" target="_parent" title="<?=EDIRECTORY_TITLE?>" <?=system_getHeaderLogo();?>>
						<?=EDIRECTORY_TITLE?>
					</a>
				</h1>
				
				<? 
                $hideInfo = true; 
                include(system_getFrontendPath("usernavbar.php", "layout")); 
                ?>
			
			</div>
			
		</div>
		
        <div class="slider-wrapper">
            <div id="navbar-wrapper">
                <ul id="navbar">
                    <?
                    // CUSTOMIZED NAVBAR
                    $navbarType = "header";
                    $add_new_id_to_validade = true;
                    
                    include(INCLUDES_DIR."/code/navbar.php");
                    ?>
                </ul>
            </div>
            
            
            <? 
            
            if ($_SERVER["PHP_SELF"] == "/index.php"){ //load Slider only on the home page
                include(system_getFrontendPath("slider.php"));              
            }
            ?>

        </div>
		
		<div class="content-wrapper">
