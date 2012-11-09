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
	# * FILE: /sitemgr/content/navigation_popup.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	header("Accept-Encoding: gzip, deflate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check", FALSE);
    header("Pragma: no-cache");
	
    extract($_GET);
	
    if (!$navbarType){
        $navbarType = "header";
	}

	include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
    
    include(EDIRECTORY_ROOT."/includes/code/ie6pngfix.php");
    
	?>

	<link type="text/css" href="<?=DEFAULT_URL?>/sitemgr/layout/navigation_configuration.css" rel="stylesheet" />
	
	<? /*Loading the New Version of jQuery and UI just to work fine in IE9*/ ?>
	<link type="text/css" href="<?=DEFAULT_URL?>/scripts/jquery/jquery.1.5.2/jquery.ui.css" rel="stylesheet" />
	<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.1.5.2/jquery.js"></script>
	<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.1.5.2/jquery.ui.js"></script>

	<?
	
	$adicionalEditCode = "<ul class=\"aditionalItemOptions\" style=\"display:none;\">
			<li class=\"editItem\">
				<a href=\"javascript:void(0);\">&nbsp;</a>
			</li>
			<li class=\"delItem\">
				<a href=\"javascript:void(0);\" removeid=\"||REMOVE_ID||\">&nbsp;</a>
			</li>
		</ul>";
	$removeLinks = true;
	$aditionalProperty = " hoverEffect=\"true\" ";
	$sitemgr = true;

	// HEADER
	if ($navbarType == "header"){ ?>
	
	<div class="modal-wrapper">
	
		<div class="wrapper wrapperModules <?=NAVBAR_POPUP_BIG_STYLE ? "wrapperModulesBig" : ""?>">

			<div class="header-form left">
				<?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_TIPS1)?>
			</div>
			
			<div class="right-holder">
			
				<div id="restorearea">
					<a class="link-action" href="javascript:void(0)" id="restoreNavbar"><?=system_showText(LANG_SITEMGR_MENUCONFIG_RESTORENAVBAR)?></a>
				</div>
				
				<div id="addarea">
					<a class="link-action" href="javascript:void(0);" id="addButton"><?=system_showText(LANG_SITEMGR_MENUCONFIG_ADDNEW)?></a>
				</div>
				
			</div>

			<div class="holder holderFixes <?=NAVBAR_POPUP_BIG_STYLE ? "holderBig" : ""?>">
				
				<div class="body">
					
					<div id="header-wrapper">
		
						<div id="header">
					
							<h1 class="logo">
								<a id="logo-link" href="javascript:void(0);" style="cursor:default;" title="<?=EDIRECTORY_TITLE?>">
									<?=EDIRECTORY_TITLE?>
								</a>
							</h1>
						
						</div>
						
					</div>
					
					<div id="navbar-wrapper" class="navBarEditArea">
					
						<ul id="navbar">
							<?
							// CUSTOMIZED NAVBAR					
							include(INCLUDES_DIR.'/code/navbar.php');
							?>
						</ul>
						
					</div>

				</div>
				
			</div>
				
		</div>
		
	</div>

	<? } 
	
	// FOOTER
	if ($navbarType == "footer" && THEME_HAS_FOOTER){ ?>
	
	<div class="modal-wrapper modal-wrapper-footer">

		<div class="wrapper wrapperModules <?=NAVBAR_POPUP_BIG_STYLE ? "wrapperModulesBig" : ""?>">

			<div class="header-form left">
				<?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_TIPS1)?>
			</div>
			
			<div class="right-holder">
			
				<div id="restorearea">
					<a class="link-action" href="javascript:void(0)" id="restoreNavbar"><?=system_showText(LANG_SITEMGR_MENUCONFIG_RESTORENAVBAR)?></a>
				</div>

				<div id="addarea">
					<a class="link-action" href="javascript:void(0);" id="addButton"><?=system_showText(LANG_SITEMGR_MENUCONFIG_ADDNEW)?></a>
				</div>  
				  
			</div>
			
			<div class="holder holderFixes <?=NAVBAR_POPUP_BIG_STYLE ? "holderBig" : ""?>"> 

				<div id="footer-wrapper">

					<div id="footer" class="footerEditArea">
		
						<div class="left navBarEditArea">
							<h3>
								<span><?=system_showText(LANG_FOOTER_CONTACT)?></span>
								<?
								if($setting_linkedin_link){
									?>
									<a class="link linkedin" href="<?=$setting_linkedin_link?>" target="_blank" title="<?=system_showText(LANG_ALT_LINKEDIN)?>">Linked In</a>
									<?
								}
								if($setting_facebook_link){
									?>
									<a class="link facebook" href="<?=$setting_facebook_link?>" target="_blank" title="<?=system_showText(LANG_ALT_FACEBOOK)?>">Facebook</a>
									<?
								}
								?>
							</h3>
							<ul id="FM1" class="navFooter navbar-footer">
								<?   
								$navbarType = "footer";
								$filterArea = 1;
								include(INCLUDES_DIR."/code/navbar.php"); 
								?>
							</ul>
						</div>
						
						<div class="left navBarEditArea">
							<h3><?=system_showText(LANG_LINKS)?></h3>
							<ul id="FM2" class="secondaryNavFooter navbar-footer">
								<?   
								$filterArea = 2;
								include(INCLUDES_DIR."/code/navbar.php"); 
								?>
							</ul>							
						</div>
						
						<div class="right">
							<?
								customtext_get("footer_copyright", $footer_copyright, EDIR_LANGUAGE);
								if (!$footer_copyright) {
									$footer = "Copyright &copy; ".date("Y")." Arca Solutions, Inc. <br />All Rights Reserved.";
								} else {
									$footer = $footer_copyright;
								}
							?>
							
							<? if (BRANDED_PRINT == "on") { ?>
								<h5 class="powered-by">Powered by <a href="javascript:void(0);" style="cursor:default;" target="_blank">iconnectedmarketing.com</a>.</h5>
							<? } ?>
							<p class="copyright">
								<?=$footer?>
							</p>
							<p class="w3c">
								W3C / 
								<a href="javascript:void(0);" style="cursor:default;" target="_blank">CSS</a> / 
								<a href="javascript:void(0);" style="cursor:default;" target="_blank">XHTML</a>
							</p>
						</div>
						
					</div>
		
				</div>

			</div>

		</div>
		
	</div>

	<? } ?>
	
	<div class="modal-wrapper">

		<div class="wrapper wrapperModules <?=NAVBAR_POPUP_BIG_STYLE ? "wrapperModulesBig" : ""?>">
	
			<div id="messageAfterAction" style="display:none"></div>
			
			<div id="tools" style="display:none">
	
				<form id="navBarItemForm" method="post" action="<?=DEFAULT_URL."/includes/code/navbar_ajax.php"?>">
	
					<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
						<tr>
							<th><?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_LABEL)?>:</th>
							<td style=" background: #EBEBEB;">
	
								<?
								
								$str_languages = explode(",", EDIR_LANGUAGES);
								$langObj = new Lang();
								$allLang = $langObj->getAll();
								
								foreach ($allLang as $lang) {
									if ($lang["lang_enabled"] == "y") {
										$auxLang = $lang["id_number"]; ?>
										<input type="textbox" id="name_<?=$auxLang?>" name="name_<?=$auxLang?>" value="" class="itemForm nameNlanguage" <? if ($auxLang>1){?> style="display:none" <? } ?> />
								<? }
								} ?>
							</td>
						</tr>
	
						<tr>
							<th>&nbsp;</th>
							<td class="tabsLang">
								<?
								
								$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
								$num_languages = count(explode(",", EDIR_LANGUAGENAMES));
								$labelsuffix = "";
								$str_languages = explode(",", EDIR_LANGUAGES);
								$langObj = new Lang();
								$allLang = $langObj->getAll();
								
								?>
								
								<ul>
									<? $i = 0;
									foreach ($allLang as $lang) {
										if ($lang["lang_enabled"] == "y" && $array_edir_languagenames[$i]) {
										$auxLang = $lang["id_number"];
										?>
										<li lang_id="<?=$auxLang?>" id="tab_summary_<?=$auxLang?>" <? if ($auxLang==1){   ?> class="tabActived" <? } ?> >
											<a href="javascript:void(0)" onclick="showLangFields('summary', 'detail', 'keywords', '<?=$auxLang?>', '<?=$num_languages?>')">
												<?=$array_edir_languagenames[$i]?>
											</a>
										</li>
									<? $i++;
										}
									} ?>
								</ul>
							</td>
						</tr>
						
						<tr>
							<th><?=system_showText(LANG_SITEMGR_LABEL_URL)?>:</th>
                            <td>
                                <input type="textbox" id="link" name="link" value="" class="itemForm" />
                                <input type="hidden" id="li_id" name="li_id" value="" />
                                <input type="hidden" id="item" name="item" value=""  />
                                <span><?=system_showText(LANG_SITEMGR_NAVBAR_TIP);?></span>
                            </td>
						</tr>
                        
						<tr>
							<th><?=system_showText(LANG_OPENNEWWINDOW);?>:</th>
							<td>
								<input type="radio" id="target_self" name="target_window" value="self" class="inputCheck"  /><?=system_showText(LANG_NO);?>
								<input type="radio" id="target_blank" name="target_window" value="blank" class="inputCheck"  /><?=system_showText(LANG_YES);?>
							</td>
						</tr>
						
						<tr>
							<th>&nbsp;</th>
							<th class="links">
								<img src="<?=DEFAULT_URL?>/images/img_loading.gif" id="moduleLoading" style="display:none" alt=""/>
								<a href="javascript:void(0)" id="module"  ><?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_USEMODULEURL)?></a>
								<img src="<?=DEFAULT_URL?>/images/img_loading.gif" id="sitecontentLoading" style="display:none" alt="" />
								<a href="javascript:void(0)" id="sitecontent"  style="margin-left:20px"  ><?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_USECUSTOMURL)?></a>
							</th>
						</tr>
						
						<tr id="warningMsg" style="display:none">
							<td colspan="5">
								<p class="errorMessage"></p>
							</td>
						</tr>
	
					</table>
	
				</form>
	
			</div>
	
			<div id="tools_saveadd">
				
				<div class="right-holder">
				
					<div id="closebuttonarea">
						<a class="link-action" href="javascript:void(0);" id="updateItemDetail"><?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSE)?></a>
					</div>
				
					<div id="cancelarea" style="display:none">
						<a class="link-action" href="javascript:void(0);" id="cancelButton"><?=system_showText(LANG_SITEMGR_CANCEL)?></a>
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
	<?
	$domain = new Domain(SELECTED_DOMAIN_ID);
	?>
	
	<a href="javascript:void(0);" id="saveButton" style="display:none"></a>
	<textarea id="adicionalEditCode" style="display:none"><?=htmlspecialchars_decode($adicionalEditCode)?></textarea>
	<input type="hidden" id="navbarType" value="<?=$navbarType?>" />
	<input type="hidden" id="num_languages" value="<?=$num_languages?>" />
	<input type="hidden" id="default_url" value="<?=DEFAULT_URL?>" />
	<input type="hidden" id="default_url_domain" value="<?="http://".$domain->getString("url");?>" />
	<input type="hidden" id="deleteNewItemQuestion" value="<?=system_showText(LANG_SITEMGR_MENUCONFIG_DELETENEWITEM)?>" />
	<input type="hidden" id="LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSE" value="<?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSE)?>" />
	<input type="hidden" id="LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSEITEM" value="<?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSEITEM)?>" />
	<input type="hidden" id="LANG_SITEMGR_MENUCONFIG_RESTORENAVBAR" value="<?=system_showText(LANG_SITEMGR_MENUCONFIG_RESTORENAVBAR)?>" />
	<input type="hidden" id="NAVBAR_SAVED_MESSAGE1" value="<?=system_showText(NAVBAR_SAVED_MESSAGE1)?>" />
	<input type="hidden" id="NAVBAR_SAVED_MESSAGE2" value="<?=system_showText(NAVBAR_SAVED_MESSAGE2)?>" />
	<input type="hidden" id="NAVBAR_SAVED_MESSAGE3" value="<?=system_showText(NAVBAR_SAVED_MESSAGE3)?>" />
	<input type="hidden" id="NAVBAR_SAVED_MESSAGE4" value="<?=system_showText(NAVBAR_SAVED_MESSAGE4)?>" />
	<input type="hidden" id="NAVBAR_SAVED_MESSAGE5" value="<?=system_showText(NAVBAR_SAVED_MESSAGE5)?>" />
	<input type="hidden" id="NAVBAR_SAVED_MESSAGE6" value="<?=system_showText(NAVBAR_SAVED_MESSAGE6)?>" />
	<input type="hidden" id="selected_domain_id" value="<?=SELECTED_DOMAIN_ID?>" />
	<input type="hidden" id="DEMO_LIVE_MODE" value="<?=DEMO_LIVE_MODE?>" />
	<input type="hidden" id="LANG_SITEMGR_DEMO_LIVE_MODE" value="<?=system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2);?>" />
	<input type="hidden" id="EDIR_THEME" value="<?=EDIR_THEME;?>" />
	<input type="hidden" id="ip" value="<?=$_SERVER["REMOTE_ADDR"];?>" />
	<?

	$langObj = new Lang();
	$langOrder = $langObj->getAll();
	$posNameVar = 0;
	foreach ($langOrder as $orderInfo)
		if($orderInfo["id"] == EDIR_LANGUAGE)
			$language_id = $orderInfo["id_number"];

		?>
	<input type="hidden" id="language_id" value="<?=$language_id?>" />
	 <? foreach ($langOrder as $orderInfo) { ?>
		<input type="hidden" id="newitem_<?=($orderInfo["id_number"])?>" value="<?=trim(system_findTranslationFor("LANG_SITEMGR_MENUCONFIG_NEWITEM",$orderInfo["id"]))?>" />
	<? } ?>
		
	<?

	$num_languages = count(explode(",", EDIR_LANGUAGENAMES));
	$num_Numberlanguages = explode(",", EDIR_LANGUAGENUMBERS);

	?>

	 <script type="text/javascript">
	<!--
	var ARRAY_LANG = new Array(<?count($num_Numberlanguages)?>);
	var DEFAULT_URL = "<?=DEFAULT_URL?>";
	var ARRAY_CANCEL = new Array(8); //total languages + 1

	NUMBER_LANGUAGES = "<?=$num_languages?>";
	<? for ($i=0; $i < count($str_languages); $i++) {?>
		ARRAY_LANG[<?=$i?>] = "<?=$num_Numberlanguages[$i]?>"
	<? } ?>
	-->

	</script>

	<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/navbar.js"></script>