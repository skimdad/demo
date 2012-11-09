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
	# * FILE: /sitemgr/layout/header.php
	# ----------------------------------------------------------------------------------------------------

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	header("Accept-Encoding: gzip, deflate");
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check", FALSE);
	header("Pragma: no-cache");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>

		<?
		$promoLevelListing = new ListingLevel();
		$levels_all = $promoLevelListing->getLevelValues();

		if ($levels_all){
			foreach ($levels_all as $level_each) {
				if ( $promoLevelListing->getHasPromotion($level_each) == 'y' ) $hasPromotion = true;
			}
		}
		customtext_get("header_title", $headertag_title, EDIR_LANGUAGE);
		$headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE));
		?>

		<title><?= ((string_strpos($_SERVER["PHP_SELF"], "registration.php")) ? '' : system_showText(LANG_SITEMGR_HOME_WELCOME). " - ") . $headertag_title?></title>

		<meta name="author" content="iConnectedMarketing.com" />

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />

		<meta name="ROBOTS" content="noindex, nofollow" />

		<? if ($facebookScript) {
			echo Facebook::getMetaTags("admins", FACEBOOK_USER_ID);
			echo Facebook::getMetaTags("app_id", FACEBOOK_API_ID);
		} ?>

		<?=system_getNoImageStyle($cssfile = true);?>
        
        <?=system_getFavicon();?>

        <? /* JQUERY FANCYBOX STYLE*/?>
        <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="all" />
		<? /* JQUERY COLORBOX STYLE */?>
        <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/colorbox/colorbox.css" type="text/css" media="all" />
		<? /* JQUERY Jcrop STYLE */?>
        <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/jcrop/css/jquery.Jcrop.css" type="text/css" />
        <? /* GENERAL STYLE */?>
        <link href="<?=DEFAULT_URL?>/sitemgr/layout/general_sitemgr.css" rel="stylesheet" type="text/css" />
		<? /* LOGIN & FORGOT STYLE*/?>
		<? if ((string_strpos($_SERVER["PHP_SELF"], "/login.php") !== false) || (string_strpos($_SERVER["PHP_SELF"], "/sitemgr/forgot.php") !== false)) { ?>
			<link href="<?=DEFAULT_URL?>/sitemgr/layout/login.css" rel="stylesheet" type="text/css" />
		<? } ?>
        <? /* JQUERY UI SMOOTHNESS STYLE */?>
        <link type="text/css" href="<?=DEFAULT_URL?>/scripts/jquery/jquery_ui/css/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
		<? /* JQUERY AUTO COMPLETE STYLE  */?>
		<link type="text/css" href="<?=DEFAULT_URL?>/scripts/jquery/jquery.autocomplete.css" rel="stylesheet" media="all" />

        <script type="text/javascript">
		<!--
		DEFAULT_URL = "<?=DEFAULT_URL?>";
		-->
		</script>

        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>
		<script type="text/javascript" src="<?=language_getFilePath(EDIR_LANGUAGE, true);?>"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/location.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/ajax-search.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jcrop/js/jquery.Jcrop.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/fancybox/jquery.fancybox-1.3.4.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.colorbox.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery_ui/js/jquery-ui-1.7.2.custom.min.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.autocomplete.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.textareaCounter.plugin.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.hoverIntent.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.cookie.min.js"></script>
		<? if (is_ie(true)) { ?>
        <!--fix ie6 z-index bug -->
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/bgiframe/jquery.bgiframe.js"></script>
        <? } ?>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/bulkupdate.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/domain.js"></script>
		
		<? if (string_strpos($_SERVER["PHP_SELF"], "colorscheme") !== false){ ?>
		
			<link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/colorpicker/css/colorpicker.css" type="text/css" />
			<link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/colorpicker/css/layout.css" type="text/css" />

			<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/colorpicker/colorpicker.js"></script>
			<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/colorpicker/eye.js"></script>
			<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/colorpicker/utils.js"></script>
			<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/colorpicker/layout.js?ver=1.0.2"></script>

		<? } ?>
			
		<script type="text/javascript" charset="utf-8">
			$(function() {
				$('#userAgent').html(navigator.userAgent);
			});
		</script>
		<!-- endfix ie6 z-index bug-->

		<? //Clear Searchs ?>
		<script type="text/javascript">
			var show = false;

			function searchResetSitemgr(form) {
				tot = form.elements.length;
				for (i=0;i<tot;i++) {
					if (form.elements[i].type == 'text') {
						form.elements[i].value = "";
					} else if (form.elements[i].type == 'checkbox' || form.elements[i].type == 'radio') {
						form.elements[i].checked = false;
					} else if (form.elements[i].type == 'select-one') {
						form.elements[i].selectedIndex = 0;
					}
				}
			}

			function validateQuickSearch() {
				if ($('#QS_searchFor').val() == 'All') {
					if (($('#QS_keywords').val() == '')||($('#QS_keywords').val() == "<?=string_ucwords(system_showText(LANG_SITEMGR_SEARCH))?>")) {
                        fancy_alert('<?=system_showText(LANG_SITEMGR_SEARCH_FIELDS_EMPTY);?>', 'errorMessage', false, 450, 100, false);
                        return false;
					}
				}
				return true;
			}
			
			function mainmenu(){
				$(" #topMainNav ul:first ").css({display: "none"});
				$(" #topMainNav .topMenu").hoverIntent(function(){
					if($(this).hasClass('accounts')){
						$(this).find('ul:first').css("right", "0px");
					} else if($(this).hasClass('domains')){
						$(this).find('ul:first').css("right", "0px");
					} else if($(this).hasClass('support')){
						$(this).find('ul:first').css("right", "0px");
					}

					$(this).find('a').addClass("header-topMainNavbar-Active");
					$(this).find('ul:first').css({visibility: "visible", display: "none"}).fadeIn(200);
					//fix ie6 z-index bug
					if ($.browser.msie && $.browser.version == 6){
						$(this).find('ul:first').bgiframe();
					}
				},function(){
					$(this).find('ul:first').css({visibility: "hidden"});
					$(this).find('a').removeClass("header-topMainNavbar-Active");
				});
			}

			$(document).ready(function(){
				mainmenu();
			});
			
			function addClass (item) {
				$("#privateMenu_"+item).addClass('submenu_active');
			}

			function addClassMainHorizontalMenu (item) {
				$("#"+item).addClass('header-topMainNavbarActive');
			}

			$(document).ready(function(){
				$("#QS_keywords").focus(function() {
					$("#QS_keywords").attr('value', '');
				});

				$("#QS_keywords").blur(function() {
					if (!$("#QS_keywords").val())
						$("#QS_keywords").attr('value', '<?=string_ucwords(system_showText(LANG_SITEMGR_SEARCH))?>');
				});

				$("#searchLink").click(function () {
					if (show == false) {
						$("#searchAll").fadeIn('slow');
						show = true;
					} else {
						$("#searchAll").fadeOut('slow');
						show = false;
					}

				});
              
                $("a.fancy_window").fancybox({
                    'hideOnContentClick'	: false,
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'frameWidth'			: 560,
                    'frameHeight'			: 550
                });
                
                $("a.fancy_window_about").fancybox({
                    'hideOnContentClick'	: false,
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 595,
                    'height'                : 570,
                    'autoDimensions': false,
                    'autoScale': false
                });
                
                $("a.fancy_window_small").fancybox({
                    'hideOnContentClick'	: false,
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 550,
                    'height'                : 150
                });
                
                $("a.fancy_window_categPath").fancybox({
                    'hideOnContentClick'	: false,
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 300,
                    'height'                : 100
                });
                              
                $("a.fancy_window_import").fancybox({
                    'modal'                 : true,
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 970,
                    'height'                : 550
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
                
                 $("a.fancy_window_navigation").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : <?=FANCYBOX_NAVIGATIONCONFIG_WIDTH?>,
                    'height'                : <?=FANCYBOX_NAVIGATIONCONFIG_HEIGHT?>
                });
                
                $("a.fancy_window_auto").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'autoDimensions'        : true
                });
                
                $("a.fancy_window_getStarted").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 645,
                    'height'                : 430
                });
               
			});
		</script>
        
        <? include(EDIRECTORY_ROOT."/includes/code/ie6pngfix.php"); ?>
	</head>

	<body>

	<?
	/** Float Layer *******************************************************************/
	$lang_layer = 1;
	$sitemgr = true;
	include(INCLUDES_DIR."/views/view_float_layer.php");
	/**********************************************************************************/

	/*
	 * Get Domains
	 */
	$domainDropDown = domain_getDropDown(NON_LANG_URL, $_SERVER["REQUEST_URI"], $_SERVER["QUERY_STRING"], SELECTED_DOMAIN_ID);
	?>
    <? if (is_ie(true)) { ?>
        <div class="browserMessage">
            <div class="wrapper">
				<?=system_showText(LANG_IE6_WARNING);?>
            </div>
        </div>
    <? } ?>
    
    <div class="site-content">
        
		<div class="wrapper">

			<div class="header">

			<div class="header-backdrop">

				<div class="header-box">

					<div class="logo">
						<a href="<?=DEFAULT_URL?>/sitemgr/index.php" class="logoLink" target="_parent" title="<?=EDIRECTORY_TITLE?>" <?=system_getHeaderLogo(true);?>>
							<?="eDirectory"?>
						</a>
					</div>

		                <? if (string_strpos($_SERVER["PHP_SELF"], "registration.php") === false) { ?>
		                    <? if ($_SESSION[SM_LOGGEDIN] == true) { ?>
		                    <ul class="headerNav">
                            		<li class="headerNavTitle"><h2><?=system_showText(LANG_SITEMGR_OPTIONS);?></h2></li>
									<li><a href="<?=NON_SECURE_URL?>/"><?=system_showText(LANG_SITEMGR_VIEW_SITE)?></a></li>
		                            <li><a href="<?=DEFAULT_URL?>/sitemgr/manageaccount.php"><?=system_showText(LANG_SITEMGR_MENU_MYACCOUNT)?></a></li>
		                            <li><a href="<?=DEFAULT_URL?>/sitemgr/logout.php"><?=system_showText(LANG_SITEMGR_MENU_LOGOUT)?></a></li>
		                    </ul>
		                    <? } ?>
		                <? } ?>

						<? if (string_strpos($_SERVER["PHP_SELF"], "registration.php") === false) {
							$edir_languages = explode(",", EDIR_LANGUAGES);
							if ((count($edir_languages)>1) || (sess_isSitemgrLogged())) {
		                    	?>
		                        <div class="topNavbar">
		                    	<?
		                    }
		                } ?>

			                <? include(EDIRECTORY_ROOT."/layout/langnavbar.php"); ?>

							<? if (string_strpos($_SERVER["PHP_SELF"], "registration.php") === false) {

								$edir_languages = explode(",", EDIR_LANGUAGES);
								if ((count($edir_languages)>1) || (sess_isSitemgrLogged())) {

							?>
							</div>
						<?}}?>
                        
                        <? if (!$_SESSION[SM_LOGGEDIN]) { ?>
                        	<h1 class="standardTitle"><?=string_ucwords(system_showText(LANG_SITEMGR_SITE_SIGNIN))?></h1>
						<? } ?>
                        
                        <? if ($_SESSION[SM_LOGGEDIN] && string_strpos($_SERVER["PHP_SELF"], "registration.php") === false) { ?>
                        	<h1 class="standardTitle"><?=LANG_SITEMGR_MANAGEMENT?></h1>
						<? } ?>
					</div>

				</div>

              	<div class="header-nav">
                	<div class="header-nav-box">
    
                          <script type="text/javascript">
                              $(document).ready(function(){
                                  $('#feedback').colorbox({
                                      title: '<?=system_showText(LANG_SITEMGR_FEEDBACK)?>',
                                      iframe:true,
                                      innerWidth:400,
                                      innerHeight:450});
                              });
    
                              function searchSubmit () {
                                if (validateQuickSearch()) {
                                    document.getElementById('formSearchHome').submit();
                                }
                              }
							  
							  $("#all-languages-button").hover(function() {
									$('.all-languages').slideDown('slow');
										}, function() {
									$('.all-languages').slideUp('slow');
								});
                          </script>
    
                          <? if (sess_isSitemgrLogged() && (string_strpos($_SERVER["PHP_SELF"], "registration.php") === false)) { ?>

                          <ul class="header-topMainNavbar" id="topMainNav">
    
                              <li class="dashboard topMenu">
                                  <a id="MHMdashboard" href="<?=DEFAULT_URL?>/sitemgr/"><?=system_showText(LANG_SITEMGR_DASHBOARD);?></a>
                              </li>
    
    
                              <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ACCOUNTS)) { ?>
                              <li class="accounts topMenu">
                                  <a id="MHMaccounts" href="javascript:void(0);"><?=system_showText(LANG_SITEMGR_NAVBAR_ACCOUNTS)?></a>
                                  <ul style="visibility: hidden;" class="header-topMainNavbar-sub header-topMainNavbar-subTwoColumn">
                                      <li class="topMainNavbarTitle">
                                          <p><?=(SOCIALNETWORK_FEATURE == "on" ? system_showText(LANG_SITEMGR_LABEL_SPONSOR) : system_showText(LANG_SITEMGR_SPONSORACCOUNTS));?></p>
                                          <ul>
											<li><a href="<?=DEFAULT_URL?>/sitemgr/account/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
											<li><a href="<?=DEFAULT_URL?>/sitemgr/account/account.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
											<li><a href="<?=DEFAULT_URL?>/sitemgr/account/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
                                          </ul>
                                      </li>
    
                                      <li class="topMainNavbarTitle">
                                          <p><?=system_showText(LANG_SITEMGR_NAVBAR_SITEMGRACCOUNTS);?></p>
                                          <ul>
                                              <li><a href="<?=DEFAULT_URL?>/sitemgr/smaccount/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
                                              <li><a href="<?=DEFAULT_URL?>/sitemgr/smaccount/smaccount.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
                                              <li><a href="<?=DEFAULT_URL?>/sitemgr/smaccount/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
                                              <li><a href="<?=DEFAULT_URL?>/sitemgr/manageaccount.php"><?=system_showText(LANG_SITEMGR_MENU_MYACCOUNT)?></a></li>
                                          </ul>
                                      </li>
                                  </ul>
                              </li>
                          <? } ?>

							  <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_DOMAIN)) { ?>
                                  <li class="domains topMenu"><a id="MHMdomains" href="javascript:void(0);"><?=system_showText(LANG_SITEMGR_NAVBAR_DOMAIN_PLURAL);?></a>
                                      <ul style="visibility: hidden;" class="header-topMainNavbar-sub">
                                          <li><a href="<?=DEFAULT_URL?>/sitemgr/domain/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
                                          <li><a href="<?=DEFAULT_URL?>/sitemgr/domain/domain.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
                                      </ul>
                                  </li>
                              <? } ?>

                              <li class="support topMenu"><a id="MHMsuport" href="javascript:void(0);"><?=system_showText(LANG_SITEMGR_SUPPORT)?></a>
                                  <ul style="visibility: hidden;" class="header-topMainNavbar-sub">
                                      <li><a href="http://www.edirectory.com/manual/" target="_blank"><?=system_showText(LANG_SITEMGR_EDIRECTORYMANUAL)?></a></li>
                                      <li><a id="feedback" href="<?=DEFAULT_URL?>/sitemgr/feedback.php"><?=system_showText(LANG_SITEMGR_FEEDBACK)?></a></li>
                                      <li><a href="<?=DEFAULT_URL?>/sitemgr/faq/faq.php"><?=system_showText(LANG_SITEMGR_MENU_FAQ)?></a></li>
                                      <li><a href="<?=DEFAULT_URL?>/sitemgr/sitemap.php"><?=system_showText(LANG_SITEMGR_LABEL_SITEMAP)?></a></li>
                                      <li><a href="<?=DEFAULT_URL?>/sitemgr/about.php" class="fancy_window_about"><?=system_showText(LANG_SITEMGR_MENU_ABOUT)?></a></li>
                                  </ul>
                              </li>
                          </ul>
    
                          <? } ?>

						  <?
                          $activeMenuAccounts = false;
                          $activeMenuDomains = false;
                          $activeMenuSuport = false;
                          $activeMenuDasboard = (string_strpos($_SERVER["PHP_SELF"], "sitemgr/index.php") || string_strpos($_SERVER["PHP_SELF"], "sitemgr/dashboard.php"));
    
                          if (string_strpos($_SERVER["PHP_SELF"], "sitemgr/account")) $activeMenuAccounts = true;
                          elseif (string_strpos($_SERVER["PHP_SELF"], "sitemgr/account/account.php")) $activeMenuAccounts = true;
                          elseif (string_strpos($_SERVER["PHP_SELF"], "sitemgr/account/search.php")) $activeMenuAccounts = true;
                          elseif (string_strpos($_SERVER["PHP_SELF"], "sitemgr/smaccount")) $activeMenuAccounts = true;
                          elseif (string_strpos($_SERVER["PHP_SELF"], "sitemgr/smaccount/smaccount.php")) $activeMenuAccounts = true;
                          elseif (string_strpos($_SERVER["PHP_SELF"], "sitemgr/smaccount/search.php")) $activeMenuAccounts = true;
                          elseif (string_strpos($_SERVER["PHP_SELF"], "sitemgr/manageaccount.php")) $activeMenuAccounts = true;
    
                          elseif (string_strpos($_SERVER["PHP_SELF"], "sitemgr/domain")) $activeMenuDomains = true;
                          elseif (string_strpos($_SERVER["PHP_SELF"], "sitemgr/domain/domain.php")) $activeMenuDomains = true;
    
                          elseif (string_strpos($_SERVER["PHP_SELF"], "faq/faq.php")) $activeMenuSuport = true;
                          elseif (string_strpos($_SERVER["PHP_SELF"], "sitemgr/sitemap.php")) $activeMenuSuport = true;
                          ?>
    
                          <? if ($activeMenuDasboard) { ?> <script type="text/javascript"> addClassMainHorizontalMenu('MHMdashboard'); </script><? } ?>
                          <? if ($activeMenuAccounts) { ?> <script type="text/javascript"> addClassMainHorizontalMenu('MHMaccounts'); </script><? } ?>
                          <? if ($activeMenuDomains) { ?> <script type="text/javascript"> addClassMainHorizontalMenu('MHMdomains'); </script><? } ?>
                          <? if ($activeMenuSuport) { ?> <script type="text/javascript"> addClassMainHorizontalMenu('MHMsuport'); </script><? } ?>
    
                          <?
                          $url_header = $_SERVER["PHP_SELF"];
                          $url_header = string_substr ($url_header, string_strlen ($url_header)-18, 18 );
                          ?>
                	</div>
            	</div>
			</div>
            
			<span class="clear"></span>
            
			<div class="content">
