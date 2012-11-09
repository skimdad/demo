<?php

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
	# * FILE: /sitemgr/prefs/comments.php
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
	
	//increases frequently actions
	if (!isset($message_commenting)) system_setFreqActions('prefs_commenting','commenting');
	
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/comments.php");
	
	if (FACEBOOK_APP_ENABLED == "on") {
		Facebook::getFBInstance($facebook);
		
		$returnUrl = DEFAULT_URL."/sitemgr/prefs/comments.php";
		$urlRedirect = "&action=check_session&type=fb_comments&destiny=".urlencode($returnUrl);
		$checkLink = $facebook->getLoginStatusUrl(
			array (
				"ok_session"	=> FACEBOOK_REDIRECT_URI."?fb_session=ok".$urlRedirect, 
				"no_session"	=> FACEBOOK_REDIRECT_URI."?fb_session=no_session".$urlRedirect, 
				"no_user"		=> FACEBOOK_REDIRECT_URI."?fb_session=no_user".$urlRedirect
			)
		);
	}
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
	
	?>
    
	<div id="main-right" class="dashboard-main-right">

        <div id="content-content-home">
    
            <div class="default-margin">
    
                <? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
                <? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
                <? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<form name="commentingOptions" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="lastOption" id="lastOption" value="<?=$lastOption?>">
					<div class="noMargin">
						<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_COMMENTING_OPTIONS);?></h1>
						<? if ($message_commenting) { ?>
							<div id="warning" class="<?=$message_style?>"><?=$message_commenting?></div>
						<? } ?>
						<p><?=system_showText(LANG_SITEMGR_COMMENTING_TIP1);?></p>

						<ul id="main_ul" class="form-tab">
							<li class="tab-edirectory" onclick="changeTabs('tab_edir')" style="cursor:pointer">&nbsp;</li>
							<li class="tab-facebook" onclick="changeTabs('tab_fb')" style="cursor:pointer">&nbsp;</li>
						</ul>

						<? /* eDirectory Tab */?>
						<div id="tab_edir" class="form-tab-content" <?=($lastOption != "edir" ? "style=\"display:none\"" : "")?>>
							<p class="description"><?=system_showText(LANG_SITEMGR_COMMENTING_TIP2);?></p>

							<h4>
								<span class="left"><?=system_showText(LANG_SITEMGR_OPTIONS);?></span>
								<span class="right"><input type="checkbox" id="check_edir" name="edir_op" <?=($commenting_edir ? "checked=checked" : "");?> onclick="changeOption('edir', this);"/> <?=system_showText(LANG_SITEMGR_USE_THIS_SYSTEM);?></span>    
							</h4>
							
							<fieldset>
								<input type="checkbox" name="review_listing_enabled" id="review_listing_enabled" value="on" <?=$review_listing_enabled_checked?>  class="inputCheck" <?=($commenting_edir ? "" : "disabled");?> onclick="reviewOptions(this, 'listing');" />
								<p><?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_CHECKTHISBOXTOENABLE_LISTING)?></p>
							</fieldset>
							
							<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on"){ ?>
							
								<fieldset>
									<input type="checkbox" name="review_article_enabled" id="review_article_enabled" value="on" <?=$review_article_enabled_checked?>  class="inputCheck" <?=($commenting_edir ? "" : "disabled");?> onclick="reviewOptions(this, 'article');" />
									<p><?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_CHECKTHISBOXTOENABLE_ARTICLE)?></p>
								</fieldset>
							
							<? } ?>
							
							<? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on"){ ?>
							
								<fieldset>
									<input type="checkbox" name="review_promotion_enabled" id="review_promotion_enabled" value="on" <?=$review_promotion_enabled_checked?>  class="inputCheck" <?=($commenting_edir ? "" : "disabled");?> onclick="reviewOptions(this, 'promotion');" />
									<p><?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_CHECKTHISBOXTOENABLE_PROMOTION)?></p>
								</fieldset>
								
							<? } ?>
							
							<? if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on"){ ?>
							
								<fieldset>
									<input type="checkbox" name="review_blog_enabled" id="review_blog_enabled" value="on" <?=$review_blog_enabled_checked?>  class="inputCheck" <?=($commenting_edir ? "" : "disabled");?> onclick="reviewOptions(this, 'blog');" />
									<p><?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_CHECKTHISBOXTOENABLE_BLOG)?></p>
								</fieldset>
								
							<? } ?>
							
							<fieldset>
								<input type="checkbox" name="review_approve" id="review_approve" value="on" <?=$review_approve_checked?> class="inputCheck" <?=($commenting_edir ? "" : "disabled");?> />
								<p><?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_SITEMGRMUSTAPPROVE)?></p>
							</fieldset>
							
							<fieldset>
								<input type="checkbox" name="review_manditory" id="review_manditory" value="on" <?=$review_manditory_checked?> class="inputCheck" <?=($commenting_edir ? "" : "disabled");?> />
								<p><?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_MUSTFILLNAMEANDEMAIL)?></p>
							</fieldset>
							
                            <button class="input-button-form" value="Submit" type="submit" name="commenting">
                                <?=system_showText(LANG_SITEMGR_SAVE);?>
                            </button>
						</div>

						<? /* Facebook Tab */ ?>
						<div id="tab_fb" class="form-tab-content facebook-active" <?=($lastOption != "fb" ? "style=\"display:none\"" : "")?>>
							<p class="description"><?=system_showText(LANG_SITEMGR_COMMENTING_TIP3);?></p>

							<h4>
								<span class="left"><?=system_showText(LANG_SITEMGR_OPTIONS);?></span>
								<span class="right"><input type="checkbox" id="check_fb" name="fb_op" <?=($commenting_fb ? "checked=checked" : "");?> onclick="changeOption('fb', this);"/> <?=system_showText(LANG_SITEMGR_USE_THIS_SYSTEM);?></span>    
							</h4>

							<fieldset>
								<p>* <?=system_showText(LANG_FACEBOOK_APP_ID);?>:</p>
								<input type="text" id="fb_appID" name="foreignaccount_facebook_apiid" value="<?=$foreignaccount_facebook_apiid?>" <?=($commenting_fb ? "" : "disabled");?>/>
								<span><?=system_showText(LANG_SITEMGR_COMMENTING_TIP4)?></span>
							</fieldset>
							
							<fieldset>
								<p>* <?=system_showText(LANG_FACEBOOK_USER_ID);?>:</p>
								<input type="text" id="fb_userID" name="fb_user_id" value="<?=$fb_user_id?>" <?=($commenting_fb ? "" : "disabled");?>/>
								<span><a href="<?=$checkLink?>"><?=system_showText(LANG_SITEMGR_COMMENTING_TIP6)?></a></span>
							</fieldset>
							
							<fieldset>
								<p><?=system_showText(LANG_FACEBOOK_NUMBER_COMMENTS);?></p>
								<input type="text" id="fb_number_comments" name="fb_number_comments" value="<?=$fb_number_comments?>" <?=($commenting_fb ? "" : "disabled");?>/>
								<span><?=system_showText(LANG_SITEMGR_COMMENTING_TIP5);?></span>
							</fieldset>
							
							<button class="input-button-form" value="Submit" type="submit" name="commenting">
								<?=system_showText(LANG_SITEMGR_SAVE);?>
							</button>
						</div>
					</div>
				</form>
            </div>
        </div>

		<div id="bottom-content-home">&nbsp;</div>

	</div>

	<br clear="all" />
	
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>

	<script language="javascript" type="text/javascript">
		
		changeTabs('<?=$lastOption == "edir" ? "tab_edir" : "tab_fb";?>');
		
		function changeTabs(op){
			$('#'+op).css('display', '');
			if (op == "tab_fb"){
				$('#main_ul').addClass('facebook-active');
				$('#tab_edir').css('display', 'none');
				$('#lastOption').attr("value", "fb");
			} else {
				$('#main_ul').removeClass('facebook-active');
				$('#tab_fb').css('display', 'none');
				$('#lastOption').attr("value", "edir");
			}
		}
		
		function changeOption(op, obj){
			if (op == 'fb'){
				if (obj.checked){
					$('#fb_appID').attr("disabled", false);
					$('#fb_userID').attr("disabled", false);
					$('#fb_number_comments').attr("disabled", false);
				} else {
					$('#fb_appID').attr("disabled", true);
					$('#fb_userID').attr("disabled", true);
					$('#fb_number_comments').attr("disabled", true);
				}
				$('#lastOption').attr("value", "fb");
			} else if(op == 'edir'){
				$('#lastOption').attr("value", "edir");
				if (obj.checked){
					$('#review_listing_enabled').attr("disabled", false);
					$('#review_article_enabled').attr("disabled", false);
					$('#review_promotion_enabled').attr("disabled", false);
					$('#review_blog_enabled').attr("disabled", false);
					$('#review_approve').attr("disabled", false);
					$('#review_manditory').attr("disabled", false);
				} else {
					$('#review_listing_enabled').attr("disabled", true);
					$('#review_article_enabled').attr("disabled", true);
					$('#review_promotion_enabled').attr("disabled", true);
					$('#review_blog_enabled').attr("disabled", true);
					$('#review_approve').attr("disabled", true);
					$('#review_manditory').attr("disabled", true);
				}
			}
		}
		
		function reviewOptions(obj, type){
			
			var options = [];
			var checked = false;
			options = "listing,article,promotion,blog".split(",");
			
			for (i=0; i<options.length; i++) {
				if ($('#review_'+options[i]+'_enabled').attr("checked")){
					checked = true;
					break;
				}
			}
			
			if (!checked){
				$('#check_edir').attr("checked", false);
				$('#review_listing_enabled').attr("disabled", true);
				$('#review_article_enabled').attr("disabled", true);
				$('#review_promotion_enabled').attr("disabled", true);
				$('#review_blog_enabled').attr("disabled", true);
				$('#review_approve').attr("disabled", true);
				$('#review_manditory').attr("disabled", true);
			}

		}
	</script>