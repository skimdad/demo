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
	# * FILE: /sitemgr/prefs/twittersettings.php
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
	# VALIDATING FEATURES
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);	

	//increases frequently actions
	if (!isset($twitter_account)) system_setFreqActions('prefs_twitter','prefstwitter');

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/twitter.php");
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_SETTINGS_TWITTER)?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>		

			<br />
			
			<div class="tip-base">
                <span class="warning" style="text-align: justify; font-size: 11px;"><a href="<?=DEFAULT_URL;?>/sitemgr/faq/faq.php?keyword=<?=urlencode("twitter");?>" target="_blank"><?=system_showText(LANG_SITEMGR_TWITTERTIP)?></a></span>
            </div>
            <br />

			<? if ($message_twitterAPI) { ?>
				<div id="warning" class="<?=$message_style?>">
					<?=$message_twitterAPI?>
				</div>
			<? } ?>
            
            <form name="twitter" id="twitter" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				
				<div class="header-form"><?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_TWITTERSETTINGS)?></div>
				
                <table cellpadding="2" cellspacing="0" border="0" class="table-form" width="100%">

                    <tr class="tr-form">
                        <td align="right" class="td-form">
                            <?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_TWITTERAPIKEY)?>:
                        </td>
                        <td>
                            <input type="text" name="foreignaccount_twitter_apikey" value="<?=$foreignaccount_twitter_apikey?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
                        </td>
                    </tr>
                    <tr class="tr-form">
                        <td align="right" class="td-form">
                            <?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_TWITTERAPISECRET)?>:
                        </td>
                        <td>
                            <input type="text" name="foreignaccount_twitter_apisecret" value="<?=$foreignaccount_twitter_apisecret?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
                        </td>
                    </tr>
				</table>
				
				<br />
				
				<div class="header-form"><?=system_showText(LANG_SITEMGR_SETTINGS_TWITTER_CHECKIN_FEATURE)?></div>

				<table cellpadding="2" cellspacing="0" border="0" class="table-form" width="100%">
					<tr class="tr-form">
                        <td align="right" class="td-form">
                            <?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_TWITTERAPIKEY)?>:
                        </td>
                        <td>
                            <input type="text" name="foreignaccount_twitter_mobile_apikey" value="<?=$foreignaccount_twitter_mobile_apikey?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
							<span><?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_FACEBOOKAPIID_TIP)?></span>
						</td>
                    </tr>
                    <tr class="tr-form">
                        <td align="right" class="td-form">
                            <?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_TWITTERAPISECRET)?>:
                        </td>
                        <td>
                            <input type="text" name="foreignaccount_twitter_mobile_apisecret" value="<?=$foreignaccount_twitter_mobile_apisecret?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
							<span><?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_FACEBOOKAPIID_TIP)?></span>
						</td>
                    </tr>
                </table>
				
				<div class="header-form"><?=system_showText(LANG_SITEMGR_SETTINGS_TWITTER)?></div>
				
				<table cellpadding="2" cellspacing="0" border="0" class="table-form" width="100%">
					<p class="informationMessage">
						<?=system_showText(LANG_SITEMGR_SETTINGS_TWITTER_TIP1)?>
					</p>
					<tr class="tr-form">
                        <td align="right" class="td-form">
                            <?=system_showText(LANG_LABEL_TWITTER_ACCOUNT)?>:
                        </td>
                        <td>
                            <input type="text" name="twitter_account" value="<?=$twitter_account?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
						</td>
                    </tr>
					
					<tr class="tr-form">
                        <td colspan="2" >
                            <center><button type="button" name="Save" value="Save" class="input-button-form" id="buttoncancel"   onclick="document.getElementById('twitter').submit();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button></center>
                        </td>
                    </tr>
					
				</table>
            </form>
		</div>		
	</div>

	<div id="bottom-content">
		&nbsp;
	</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
