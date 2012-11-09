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
	# * FILE: /members/layout/header.php
	# ----------------------------------------------------------------------------------------------------

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	include(INCLUDES_DIR."/code/headertag.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en">

	<head>
	
		<?
		$promoLevelListing = new ListingLevel();
		$levels_all = $promoLevelListing->getLevelValues();
		foreach ($levels_all as $level_each) {
			if ( $promoLevelListing->getHasPromotion($level_each) == 'y' ) $hasPromotion = true;
		}
		?>
	
		<? if (sess_getAccountIdFromSession()) {
					$dbObjWelcome = db_getDBObJect(DEFAULT_DB,true);
					$sqlWelcome = "SELECT C.first_name, C.last_name, A.has_profile, P.friendly_url, P.nickname FROM Contact C
										   LEFT JOIN Account A ON (C.account_id = A.id)
										   LEFT JOIN Profile P ON (P.account_id = A.id)
										   WHERE A.id = ".sess_getAccountIdFromSession();
					$resultWelcome = $dbObjWelcome->query($sqlWelcome);
					$contactWelcome = mysql_fetch_assoc($resultWelcome);
		} ?>

		<? $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>
		<? if (SOCIALNETWORK_FEATURE == "on" && $contactWelcome["has_profile"] == "y") { ?>
			<title><?=( ($contactWelcome) ? $contactWelcome["nickname"].", " : "" ) . system_showText(LANG_MSG_WELCOME) . " - " . $headertag_title?></title>
		<? } else { ?>
			<title><?=( ($contactWelcome) ? $contactWelcome["first_name"]." ".$contactWelcome["last_name"].", " : "" ) . system_showText(LANG_MSG_WELCOME) . " - " . $headertag_title?></title>
		<? } ?>

		<? $headertag_author = (($headertag_author) ? ($headertag_author) : ("Arca Solutions")); ?>
		<meta name="author" content="<?=$headertag_author?>" />

		<? $headertag_description = (($headertag_description) ? ($headertag_description) : (EDIRECTORY_TITLE)); ?>
		<meta name="description" content="<?=$headertag_description?>" />

		<? $headertag_keywords = (($headertag_keywords) ? ($headertag_keywords) : (EDIRECTORY_TITLE)); ?>
		<meta name="keywords" content="<?=$headertag_keywords?>" />

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />

		<meta name="ROBOTS" content="noindex, nofollow" />
		
		<?
		/* MEMBERS AREA WITH THEME STYLE */
		include(THEMEFILE_DIR."/".EDIR_THEME_MEMBERS."/".EDIR_THEME_MEMBERS.".php");
		?>
			
		<?=system_getNoImageStyle($cssfile = true);?>
        
        <?=system_getFavicon();?>
        
        <? /* JQUERY FANCYBOX STYLE*/?>
        <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="all" />
		<? /* JQUERY COLORBOX STYLE */ ?>
        <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/colorbox/colorbox.css" type="text/css" media="all" />
		<? /* JQUERY Jcrop STYLE */ ?>
        <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/jcrop/css/jquery.Jcrop.css" type="text/css" />
        <? /* JQUERY UI SMOOTHNESS STYLE */?>
        <link type="text/css" href="<?=DEFAULT_URL?>/scripts/jquery/jquery_ui/css/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
		<? /* JQUERY AUTO COMPLETE STYLE */ ?>
		<link type="text/css" href="<?=DEFAULT_URL?>/scripts/jquery/jquery.autocomplete.css" rel="stylesheet" media="all" />
        
        <script type="text/javascript">
        <!-- 
		DEFAULT_URL = "<?=DEFAULT_URL?>";  
		-->
		</script>
        
        <script type="text/javascript" src="<?=language_getFilePath(EDIR_LANGUAGE, true);?>"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/float_layer.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/location.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jcrop/js/jquery.Jcrop.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/fancybox/jquery.fancybox-1.3.4.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.colorbox.js"></script>
        <? /* JQUERY UI */ ?>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery_ui/js/jquery-ui-1.7.2.custom.min.js"></script>
		<? /* JQUERY COOKIE PLUGIN */?>
        <script src="<?=DEFAULT_URL?>/scripts/jquery/jquery.cookie.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/domain.js"></script>
		<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/socialbookmarking.js"></script>
        <script src="<?=DEFAULT_URL?>/scripts/jquery/jquery.autocomplete.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.textareaCounter.plugin.js"></script>
		<script src="<?=DEFAULT_URL?>/scripts/contactclick.js" language="javascript" type="text/javascript"></script>

		<script type="text/javascript">
            $(document).ready(function(){
                $("a.fancy_window").fancybox({
                    'hideOnContentClick'	: false,
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'frameWidth'			: 560,
                    'frameHeight'			: 550
                });
                
                $("a.fancy_window_categPath").fancybox({
                    'hideOnContentClick'	: false,
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 300,
                    'height'                : 100
                });
                
                $("a.fancy_window_preview").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : <?=FANCYBOX_ITEM_PREVIEW_WIDTH?>,
                    'height'                : <?=FANCYBOX_ITEM_PREVIEW_HEIGHT?>
                });
                
                $("a.fancy_window_preview_small").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 800,
                    'height'                : 400
                });
                
                 $("a.fancy_window_preview_banner").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 800,
                    'height'                : 210
                });
                
                $("a.fancy_window_custom").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 620,
                    'height'                : 370
                });
                
                $("a.fancy_window_invoice").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 680,
                    'height'                : 480
                });
                
                $("a.fancy_window_terms").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 650,
                    'height'                : 500
                });
                
                $("a.fancy_window_twilio_reports").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 645,
                    'height'                : 400
                });
                
                $("a.fancy_window_tofriend").fancybox({
                    'overlayShow'     : true,
                    'overlayOpacity'  : 0.75,
                    'width'           : <?=FANCYBOX_TOFRIEND_WIDTH?>,
                    'height'          : <?=FANCYBOX_TOFRIEND_HEIGHT?>,
                    'autoDimensions'  : false
                });
                
                 $("a.fancy_window_review").fancybox({
                    'overlayShow'     : true,
                    'overlayOpacity'  : 0.75,
                    'width'           : <?=FANCYBOX_REVIEW_WIDTH?>,
                    'height'          : <?=FANCYBOX_REVIEW_HEIGHT?>,
                    'autoDimensions'  : false
                });
                
                $("a.fancy_window_twilio").fancybox({
                    'overlayShow'     : true,
                    'overlayOpacity'  : 0.75,
                    'width'           : <?=FANCYBOX_TWILIO_WIDTH?>,
                    'height'          : <?=FANCYBOX_TWILIO_HEIGHT?>,
                    'autoDimensions'  : false
                });
            });
            
		</script>
		
		<? /*DO NOT REMOVE THIS */ ?>
		
		<style type="text/css">

		div.floatLayer {width: 200px; position: absolute; /*top: 0; left: 0;*/ visibility: hidden; background-color: #FCFCFC; border: 2px solid #EEE; height:auto; padding: 5px; z-index: 999;}

			div.floatLayer * {margin: 0; padding: 0;}

				div.floatLayer h3 {font: bold 12px Verdana, Arial, Helvetica, sans-serif; color: #003F7E; text-align: left; padding:3px 0 3px 0;}

				div.floatLayer p {font: normal 10px Verdana, Arial, Helvetica, sans-serif; color: #000; text-align: left; margin: 0; padding: 3px 0 3px 0;}

		</style>
		
		<? include(EDIRECTORY_ROOT."/includes/code/ie6pngfix.php"); ?>
	</head>

	<body class="body">
		<div id="div_to_share" class="share-box" style="display: none"></div>
        
        <? if (is_ie(true)) { ?>
			<div class="browserMessage">
            	<div class="wrapper">
					<?=system_showText(LANG_IE6_WARNING);?>
                </div>
            </div>
		<? } ?>
		
		<?
		/** Float Layer *******************************************************************/
		include(INCLUDES_DIR."/views/view_float_layer.php");

		system_increaseVisit(db_formatString(getenv("REMOTE_ADDR")));
		/**********************************************************************************/
		?>
        
        <? 
        if (!MEMBERS_ALIGN_CENTER) {
            include(MEMBERS_EDIRECTORY_ROOT."/layout/usernavbar.php");
        } 
        ?>
        
        <div id="header-wrapper">
		
			<div id="header">
		
				<h1 class="logo">
					<a id="logo-link" href="<?=NON_SECURE_URL?>/members/index.php" target="_parent" title="<?=EDIRECTORY_TITLE?>" <?=system_getHeaderLogo();?>>
						<?=EDIRECTORY_TITLE?>
					</a>
				</h1>
                
                <? 
                if (MEMBERS_ALIGN_CENTER) {
                    include(MEMBERS_EDIRECTORY_ROOT."/layout/usernavbar.php");
                } 
                ?>
                
			</div>
			
		</div>
        
        <? if (sess_getAccountIdFromSession()) { ?>
        
            <div id="navbar-wrapper">
                
                <? /* NAVBAR WRAP FOR FLUID WIDTH LAYOUT NAVBAR*/ ?>
                <ul id="navbar">
                
					<?
                    $accObj = new Account(sess_getAccountIdFromSession());
                    if ((string_strpos($_SERVER["PHP_SELF"], "members/signup") === false) && (string_strpos($_SERVER["PHP_SELF"], "members/claim") === false) && $accObj->getString("is_sponsor") == "y") {
                        ?>
                        
                    	<li <?=((string_strpos($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"], $_SERVER["SERVER_NAME"].EDIRECTORY_FOLDER."/members/index.php") !== false) ? "class=\"menuActived\"" : "")?>><a href="<?=DEFAULT_URL?>/members/"><?=system_showText(LANG_BUTTON_HOME)?></a></li>
    
                    	<li <?=((string_strpos($_SERVER["PHP_SELF"], "/members/account/account.php") !== false || 
								string_strpos($_SERVER["PHP_SELF"], "/members/account/reviews.php") !== false || 
								string_strpos($_SERVER["PHP_SELF"], "/members/account/quicklists.php") !== false || 
								string_strpos($_SERVER["PHP_SELF"], "/members/account/deals.php") !== false) ? "class=\"menuActived\"" : "")?>><a href="<?=DEFAULT_URL?>/members/account/account.php?id=<?=sess_getAccountIdFromSession()?>"><?=system_showText(LANG_BUTTON_MANAGE_ACCOUNT)?></a></li>
    
                    	<li <?=((string_strpos($_SERVER["PHP_SELF"], "/members/help.php") !== false) ? "class=\"menuActived\"" : "")?>><a href="<?=DEFAULT_URL?>/members/help.php"><?=system_showText(LANG_BUTTON_HELP)?></a></li>
                        
                    	<li <?=((string_strpos($_SERVER["PHP_SELF"], "/members/sitemap.php") !== false) ? "class=\"menuActived\"" : "")?>><a href="<?=DEFAULT_URL?>/members/sitemap.php"><?=system_showText(LANG_MENU_SITEMAP);?></a></li>
                        
            		<? } ?>
				
                </ul>
                
            </div>
		
		<? } ?>

		<div class="content-wrapper">
            
            <? if (MEMBERS_ALIGN_CENTER){ ?>
                <div class="content-center">
            <? } ?>

				<?if (string_strpos($_SERVER["PHP_SELF"], "claim") === false && string_strpos($_SERVER["PHP_SELF"], "resetpassword") === false && string_strpos($_SERVER["PHP_SELF"], "forgot") === false && string_strpos($_SERVER["PHP_SELF"], "facebook") === false && string_strpos($_SERVER["PHP_SELF"], "/add") === false){?>
					<p class="breadcrumb">
						<?
						$aux_breadcrumb = domain_BreadCrumb();
						echo $aux_breadcrumb;
						?>
					</p>
				<?}?>