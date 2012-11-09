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
	# * FILE: /frontend/socialnetwork/add_account.php
	# ----------------------------------------------------------------------------------------------------

	$formloginaction = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/members/login.php?destiny=".EDIRECTORY_FOLDER."/".SOCIALNETWORK_FEATURE_NAME."/";

	unset($loginTypes, $openIDEnabled, $facebookEnabled, $googleEnabled);
	
	setting_get("foreignaccount_openid", $foreignaccount_openid);
	if ($foreignaccount_openid == "on") {
		$openIDEnabled		= true;
	}
	
	setting_get("foreignaccount_google", $foreignaccount_google);
	if ($foreignaccount_google == "on") {
		$googleEnabled		= true;
	}
	
	if (FACEBOOK_APP_ENABLED == "on") {
		$facebookEnabled	= true;
	}
	
	$loginTypes							.= "formDirectoryUser,";
	if ($openIDEnabled)		$loginTypes	.= "formOpenIDUser,";
	if ($googleEnabled)		$loginTypes	.= "formGoogleUser,";
	if ($facebookEnabled)	$loginTypes	.= "formFacebookUser,";
	$loginTypes							= string_substr($loginTypes, 0, -1);
	
	if ((string_strlen(trim($message_member))>0) ||(string_strlen(trim($message_account))>0) ||(string_strlen(trim($message_contact))>0) ) { ?>
		<p class="errorMessage">
			<? if (string_strlen(trim($message_member))>0) { ?>
				<?=$message_member?>
			<? } ?>
			<? if ((string_strlen(trim($message_member))>0) && (string_strlen(trim($message_account))>0)) { ?>
				<br />
			<? } ?>
			<? if (string_strlen(trim($message_account))>0) { ?>
				<?=$message_account?>
			<? } ?>
			<? if (string_strlen(trim($message_contact))>0) { ?>
				<?=$message_contact?>
			<? } ?>
		</p>
	<? } ?>
		
	<? if (FACEBOOK_APP_ENABLED == "on" || $openIDEnabled == "on" || $googleEnabled == "on"){ ?>
		
	<table border="0" cellpadding="2" cellspacing="0" class="standard-table noMargin">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_PROFILE_OPTIONS)?></th>
		</tr>
		<tr>
			<th class="radioChooseLevel"><input type="radio" name="usertype" value="newuser" checked="checked" onclick="javascript:switchFormUserDisplay('formDirectoryUser');" /></th>
			<td><?=system_showText(LANG_PROFILE_OPTIONS1)?></td>
		</tr>

		<? if ($openIDEnabled) { ?>
			<tr>
				<th class="radioChooseLevel"><input type="radio" name="usertype" value="openiduser" <? if ($usertype == "openiduser") echo "checked=\"checked\""; ?> onclick="javascript:switchFormUserDisplay('formOpenIDUser');" /></th>
				<td><?=system_showText(LANG_PROFILE_OPTIONS2)?></td>
			</tr>
		<? } ?>

		<? if ($facebookEnabled) { ?>
			<tr>
				<th class="radioChooseLevel"><input type="radio" name="usertype" value="facebookuser" <? if ($usertype == "facebookuser") echo "checked=\"checked\""; ?> onclick="javascript:switchFormUserDisplay('formFacebookUser');" /></th>
				<td><?=system_showText(LANG_PROFILE_OPTIONS3)?></td>
			</tr>
		<? } ?>
			
		<? if ($googleEnabled) { ?>
			<tr>
				<th class="radioChooseLevel"><input type="radio" name="usertype" value="googleuser" <? if ($usertype == "googleuser") echo "checked=\"checked\""; ?> onclick="javascript:switchFormUserDisplay('formGoogleUser');" /></th>
				<td><?=system_showText(LANG_PROFILE_OPTIONS4)?></td>
			</tr>
		<? } ?>

		<? if ($openIDEnabled) { ?>
			<tr>
				<td colspan="2">
                    <div id="formOpenIDUser" class="<? if ($usertype == "openiduser") echo "isVisible"; else echo "isHidden"; ?>">
    
                        <form class="form" name="formOpenID" method="post" action="<?=$formloginaction;?>">
    
                            <input type="hidden" name="userform" value="openid" />
    
                            <? include(INCLUDES_DIR."/forms/form_openidlogin.php"); ?>
    
                        </form>
    
                    </div>
				</td>
			</tr>
		<? } ?>

		<? if ($facebookEnabled) { ?>
			<tr>
				<td colspan="2">

					<div id="formFacebookUser" class="<? if ($usertype == "facebookuser") echo "isVisible"; else echo "isHidden"; ?>">
						<? $urlRedirect = "?destiny=".urlencode(DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/"); ?>
						<? include(INCLUDES_DIR."/forms/form_facebooklogin.php"); ?>
					</div>

				</td>
			</tr>
		<? } ?>
			
		<? if ($googleEnabled) { ?>
			<tr>
				<td colspan="2">
                    <div id="formGoogleUser" class="<? if ($usertype == "googleuser") echo "isVisible"; else echo "isHidden"; ?>">
						<? $urlRedirect = "&destiny=".urlencode(DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/"); ?>
						<? include(INCLUDES_DIR."/forms/form_googlelogin.php"); ?>    
                    </div>
				</td>
			</tr>
		<? } ?>
	</table>
		
	<? } ?>
		
	<div id="formDirectoryUser" class="<? if ((!$usertype) || ($usertype == "newuser")) echo "isVisible"; else echo "isHidden"; ?>">
		
		<form class="" name="add_account" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
		<?
			$profileAdd = true;
			include(EDIRECTORY_ROOT."/includes/forms/form_account.php");
			include(EDIRECTORY_ROOT."/includes/forms/form_contact.php");
		?>
			<br class="clear" />
			<div class="btAdd">
				<p class="standardButton">
					<button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
				</p>
				<p class="standardButton">
					<button type="reset" onclick="window.location = '<?=DEFAULT_URL."/";?>'"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
				</p>
			</div>
		</form>
		
	</div>
		
	<script language="javascript" type="text/javascript">
		<!--
		function switchFormUserDisplay(user) {
			var loginOptions = ("<?=$loginTypes;?>").split(',');
			for (var i = 0; i < loginOptions.length; i++) {
				$('#' + loginOptions[i]).removeClass('isVisible');
				$('#' + loginOptions[i]).addClass('isHidden');
			}

			$('#' + user).removeClass('isHidden');
			$('#' + user).addClass('isVisible');
		}
		//-->
	</script>
