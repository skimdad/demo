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
	# * FILE: /claim.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# MAINTENANCE MODE
	# ----------------------------------------------------------------------------------------------------
	verify_maintenanceMode();
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSessionFront();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
	include(LISTING_EDIRECTORY_ROOT."/mod_rewrite.php");
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }

	if (!$claimlistingid) {
		header("Location: ".LISTING_DEFAULT_URL."/");
		exit;
	}
	$listingObject = new Listing($claimlistingid);
	if (!$listingObject->getNumber("id") || ($listingObject->getNumber("id") <= 0)) {
		header("Location: ".LISTING_DEFAULT_URL."/");
		exit;
	}
	if ($listingObject->getNumber("account_id")) {
		header("Location: ".LISTING_DEFAULT_URL."/");
		exit;
	}
	if ($listingObject->getString("claim_disable") != "n") {
		header("Location: ".LISTING_DEFAULT_URL."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if (($_SERVER['REQUEST_METHOD'] == "POST")) { 
		$request_method_seckey = "post";
		include(EDIRECTORY_ROOT."/includes/code/seckey.php");

		$validate_account = validate_addAccount($_POST, $message_account);
		$validate_contact = validate_form("contact", $_POST, $message_contact);

		if ($boolean_seckey && $validate_account && $validate_contact) {

			$account = new Account($_POST);
			$account->save();

			if ($_POST["claim"]) {
				$account->changeMemberStatus(true);
			}

			$contact = new Contact($_POST);
			$contact->setNumber("account_id", $account->getNumber("id"));
			$contact->save();

			$profileObj = new Profile(sess_getAccountIdFromSession());
			$profileObj->setNumber("account_id", $account->getNumber("id"));
			if (!$profileObj->getString("nickname")) {
				$profileObj->setString("nickname", $_POST["first_name"]." ".$_POST["last_name"]);
			}
			$profileObj->Save();

			$accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
			$accDomain->Save();
			$accDomain->saveOnDomain($account->getNumber("id"), $account, $contact, $profileObj);

			/**************************************************************************************************/
			/*                                                                                                */
			/* E-mail notify                                                                                  */
			/*                                                                                                */
			/**************************************************************************************************/
			setting_get("sitemgr_send_email",$sitemgr_send_email);
			setting_get("sitemgr_email",$sitemgr_email);
			$sitemgr_emails = explode(",",$sitemgr_email);
			if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
			setting_get("sitemgr_account_email",$sitemgr_account_email);
			$sitemgr_account_emails = explode(",",$sitemgr_account_email);

			// sending e-mail to user //////////////////////////////////////////////////////////////////////////
			if ($emailNotificationObj = system_checkEmail(SYSTEM_CLAIM_SIGNUP, $contact->getString("lang"))) {
				$subject = $emailNotificationObj->getString("subject");
				$body = $emailNotificationObj->getString("body");
				$body = str_replace("ACCOUNT_NAME",$contact->getString("first_name").' '.$contact->getString("last_name"),$body);
				$login_info = trim(system_findTranslationFor("LANG_LABEL_USERNAME", $emailNotificationObj->getString("lang"))).": ".$_POST["username"];
				$login_info .= ($emailNotificationObj->getString("content_type") == "text/html"? "<br />": "\n");
				$login_info .= trim(system_findTranslationFor("LANG_LABEL_PASSWORD", $emailNotificationObj->getString("lang"))).": ".$_POST["password"];
				$body = str_replace("ACCOUNT_LOGIN_INFORMATION",$login_info,$body);
				$body = system_replaceEmailVariables($body, $listingObject->getNumber('id'), 'listing');
				$subject = system_replaceEmailVariables($subject, $listingObject->getNumber('id'), 'listing');
				$body = html_entity_decode($body);
				$subject = html_entity_decode($subject);
				$error = false;
				system_mail($contact->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
			}
			////////////////////////////////////////////////////////////////////////////////////////////////////

			sess_registerAccountInSession($account->getString("username"));
			setcookie("username_members", $account->getString("username"), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

			header("Location: ".DEFAULT_URL."/members/claim/getlisting.php?claimlistingid=".$claimlistingid);
			exit;

		} else {
			// removing slashes added if required
			$_POST = format_magicQuotes($_POST);
			$_GET  = format_magicQuotes($_GET);
			extract($_POST);
			extract($_GET);
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = (($listingObject->getString("seo_title"))?($listingObject->getString("seo_title")):($listingObject->getString("title")))." - ".system_showText(LANG_LISTING_CLAIMTHIS);
	$headertag_description = (($listingObject->getStringLang(EDIR_LANGUAGE, "seo_description"))?($listingObject->getStringLang(EDIR_LANGUAGE, "seo_description")):($listingObject->getStringLang(EDIR_LANGUAGE, "description")));
	$headertag_keywords = (($listingObject->getStringLang(EDIR_LANGUAGE, "seo_keywords"))?($listingObject->getStringLang(EDIR_LANGUAGE, "seo_keywords")):(str_replace(" || ", ", ", $listingObject->getStringLang(EDIR_LANGUAGE, "keywords"))));
	include(system_getFrontendPath("header.php", "layout"));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
	
	unset($loginTypes, $openIDEnabled, $facebookEnabled, $googleEnabled, $cUserEnabled);
	
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
	
	if (sess_isAccountLogged() && SOCIALNETWORK_FEATURE == "on") {
		$cUserEnabled		= true;
	}	
	
	$loginTypes							.= "formNewUser,";
	$loginTypes							.= "formDirectoryUser,";
	if ($openIDEnabled)		$loginTypes	.= "formOpenIDUser,";
	if ($googleEnabled)		$loginTypes	.= "formGoogleUser,";
	if ($facebookEnabled)	$loginTypes	.= "formFacebookUser,";
	if ($cUserEnabled)		$loginTypes	.= "formCurrentUser,";
	$loginTypes							= string_substr($loginTypes, 0, -1);
?>

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

<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkusername.js"></script>

    <ul class="standardStep">
        <li class="standardStepAD"><?=system_showText(LANG_EASYANDFAST)?> <span><?=system_showText(LANG_THREESTEPS)?> &raquo;</span></li>
        <li class="stepActived"><span>1</span>&nbsp;<?=system_showText(LANG_ACCOUNTSIGNUP)?></li>
        <li><span>2</span>&nbsp;<?=system_showText(LANG_LISTINGUPDATE)?></li>
        <li><span>3</span>&nbsp;<?=system_showText(LANG_CHECKOUT)?></li>
    </ul>
		
    <p>&nbsp;</p>
		
    <div class="content content-full">

        <div class="content-main">

            <h2><?=system_showText(LANG_LISTING_CLAIMTHIS)?></h2>

            <div class="extendedContent contentBorder">
                <?
                $listing = $listingObject;
                $levelObj = new ListingLevel();

                /**
                 * This variable is used on view_listing_summary.php
                 */
                if (TWILIO_APP_ENABLED == "on"){
                    if (TWILIO_APP_ENABLED_SMS == "on"){
                        $levelsWithSendPhone = system_retrieveLevelsWithInfoEnabled("has_sms");
                    }else{
                        $levelsWithSendPhone = false;
                    }
                    if (TWILIO_APP_ENABLED_CALL == "on"){
                        $levelsWithClicktoCall = system_retrieveLevelsWithInfoEnabled("has_call");
                    }else{
                        $levelsWithClicktoCall = false;
                    }
                }else{
                    $levelsWithSendPhone = false;
                    $levelsWithClicktoCall = false;
                }

                include(INCLUDES_DIR."/views/view_listing_summary.php");
                unset($listing, $levelObj);
                ?>
            </div>

            <table border="0" cellpadding="0" cellspacing="0" class="orderTable">
                <tr>
                    <td class="orderTopdetail"><h2 class="standardSubTitle"><?=system_showText(LANG_ALREADYHAVEACCOUNT)?></h2></td>
                </tr>
                <tr>
                    <td class="orderUserTable paddingUserTable claimUserTable">

                        <table align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <th class="radioChooseLevel"><input type="radio" name="usertype" value="newuser" checked="checked" onclick="javascript:switchFormUserDisplay('formNewUser');" /></th>
                                <td class="warning"><strong><?=system_showText(LANG_ACCOUNTNEWUSER)?></strong></td>
                            </tr>

                            <tr>
                                <th class="radioChooseLevel"><input type="radio" name="usertype" value="directoryuser" <? if ($usertype == "directoryuser") echo "checked=\"checked\""; ?> onclick="javascript:switchFormUserDisplay('formDirectoryUser');" /></th>
                                <td><?=system_showText(LANG_ACCOUNTDIRECTORYUSER)?></td>
                            </tr>

                            <? if ($openIDEnabled) { ?>
                                <tr>
                                    <th class="radioChooseLevel"><input type="radio" name="usertype" value="openiduser" <? if ($usertype == "openiduser") echo "checked=\"checked\""; ?> onclick="javascript:switchFormUserDisplay('formOpenIDUser');" /></th>
                                    <td><?=system_showText(LANG_ACCOUNTOPENIDUSER)?></td>
                                </tr>
                            <? } ?>

                            <? if ($facebookEnabled) { ?>
                                <tr>
                                    <th class="radioChooseLevel"><input type="radio" name="usertype" value="facebookuser" <? if ($usertype == "facebookuser") echo "checked=\"checked\""; ?> onclick="javascript:switchFormUserDisplay('formFacebookUser');" /></th>
                                    <td><?=system_showText(LANG_ACCOUNTFACEBOOKUSER)?></td>
                                </tr>
                            <? } ?>

                            <? if ($googleEnabled) { ?>
                                <tr>
                                    <th class="radioChooseLevel"><input type="radio" name="usertype" value="googleuser" <? if ($usertype == "googleuser") echo "checked=\"checked\""; ?> onclick="javascript:switchFormUserDisplay('formGoogleUser');" /></th>
                                    <td><?=system_showText(LANG_ACCOUNTGOOGLEUSER)?></td>
                                </tr>
                            <? } ?>

                            <? if ($cUserEnabled) { ?>
                                <? $usertype = "currentuser";?>
                                <tr>
                                    <th class="radioChooseLevel"><input type="radio" name="usertype" value="currentuser" checked onclick="javascript:switchFormUserDisplay('formCurrentUser');" /></th>
                                    <td><?=system_showText(LANG_MSG_USE_LOGGED_ACCOUNT)?></td>
                                </tr>
                            <? } ?>

                            <tr>
                                <td colspan="2">
                                    <div id="formDirectoryUser" class="<? if ($usertype == "directoryuser") echo "isVisible"; else echo "isHidden"; ?>">
                                        <form name="formDirectory" method="post" action="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL);?>/members/login.php?destiny=<?=EDIRECTORY_FOLDER?>/members/claim/getlisting.php&amp;query=claimlistingid=<?=$claimlistingid?>">
                                            <input type="hidden" name="userform" value="directory" />
                                            <input type="hidden" name="claim" value="yes" />
                                            <?
                                            $members_section = true;
                                            $automatically = false;
                                            include(INCLUDES_DIR."/forms/form_login.php");
                                            ?>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <? if ($openIDEnabled) { ?>
                                <tr>
                                    <td colspan="2">
                                        <div id="formOpenIDUser" class="<? if ($usertype == "openiduser") echo "isVisible"; else echo "isHidden"; ?>">
                                            <form name="formOpenID" method="post" action="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL);?>/members/login.php?destiny=<?=EDIRECTORY_FOLDER?>/members/claim/getlisting.php&amp;query=claimlistingid=<?=$claimlistingid?>">
                                                <input type="hidden" name="userform" value="openid" />
                                                <input type="hidden" name="claim" value="yes" />
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
                                            <? $urlRedirect = "?claim=yes&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid); ?>
                                            <? include(INCLUDES_DIR."/forms/form_facebooklogin.php"); ?>
                                        </div>
                                    </td>
                                </tr>
                            <? } ?>

                            <? if ($googleEnabled) { ?>
                                <tr>
                                    <td colspan="2">
                                        <div id="formGoogleUser" class="<? if ($usertype == "googleuser") echo "isVisible"; else echo "isHidden"; ?>">
                                            <? $urlRedirect = "&claim=yes&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid); ?>
                                            <? include(INCLUDES_DIR."/forms/form_googlelogin.php"); ?>
                                        </div>
                                    </td>
                                </tr>
                            <? } ?>

                            <? if ($cUserEnabled) { ?>
                                <tr>
                                    <td colspan="2">
                                        <div id="formCurrentUser" class="<? if ($usertype == "currentuser") echo "isVisible"; else echo "isHidden"; ?>">
                                            <form name="formCurrentUser" method="post" action="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL);?>/members/login.php?destiny=<?=EDIRECTORY_FOLDER?>/members/claim/getlisting.php&amp;query=claimlistingid=<?=$claimlistingid?>">
                                                <input type="hidden" name="userform" value="currentuser" />
                                                <input type="hidden" name="claim" value="yes" />
                                                <input type="hidden" name="acc" value="<?=sess_getAccountIdFromSession()?>" />

                                                <h2 class="standardTitle">
                                                <?
                                                    if (sess_getAccountIdFromSession()) {
                                                        $sqlWelcome = "SELECT C.first_name, C.last_name, A.has_profile, P.friendly_url, P.nickname FROM Contact C
                                                            LEFT JOIN Account A ON (C.account_id = A.id)
                                                            LEFT JOIN Profile P ON (P.account_id = A.id)
                                                            WHERE A.id = ".sess_getAccountIdFromSession();
                                                        $resultWelcome = $dbObjWelcome->query($sqlWelcome);
                                                        $contactWelcome = mysql_fetch_assoc($resultWelcome);

                                                        if ($contactWelcome["has_profile"] == "y") {
                                                            echo $contactWelcome["nickname"];
                                                        } else {
                                                            echo $contactWelcome["first_name"]." ".$contactWelcome["last_name"];
                                                        }
                                                    }
                                                ?>
                                                </h2>
                                                <br />
                                                <p class="standardButton" style="margin-right:5px; float:left">
                                                <button type="submit">
                                                    <?=system_showText(LANG_BUTTON_NEXT)?>
                                                </button>
                                                </p>
                                                <p style="float:left; margin-top:5px">
                                                <?=system_showText(LANG_OR)?>
                                                <a href="<?=SOCIALNETWORK_URL?>/logout.php?claim=true">
                                                    <?=system_showText(LANG_BUTTON_LOGOUT)?>
                                                </a>
                                                </p>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <? } ?>
                        </table>

                    </td>
                </tr>
            </table>

            <div id="formNewUser" class="<? if ((!$usertype) || ($usertype == "newuser")) echo "isVisible"; else echo "isHidden"; ?>">

                <form name="signup_claim" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="standardForm">

                    <input type="hidden" name="ieBugFix" value="1" />

                    <input type="hidden" name="claim" value="true" />
                    <input type="hidden" name="claimlistingid" id="claimlistingid" value="<?=$claimlistingid?>" />

                    <script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkpasswordstrength.js"></script>

                    <table align="center" border="0" cellpadding="2" cellspacing="2" class="standardSIGNUPTable">
                        <tr>
                            <th colspan="2" class="SIGNUPTable-title"><h2 class="standardSubTitle"><?=system_showText(LANG_ACCOUNTINFO)?> <span><?=system_showText(LANG_ACCOUNTINFOMSG)?></span></h2></th>
                        </tr>
                        <? if ($message_account) { ?>
                        <tr>
                            <td colspan="2"><p class="errorMessage"><?=$message_account?></p></td>
                        </tr>
                        <? } ?>
                        <tr>
                            <th>* <?=system_showText(LANG_LABEL_USERNAME)?>:</th>
                            <td>
                                <input type="text" name="username" value="<?=$username?>" maxlength="<?=USERNAME_MAX_LEN?>" class="input-form-account" onblur="checkUsername(this.value, '<?=DEFAULT_URL;?>', 'members');populateField(this.value,'email');"/>
                                <span><?=system_showText(LANG_USERNAME_MSG1)." ".USERNAME_MIN_LEN." ".system_showText(LANG_USERNAME_MSG2)." ".USERNAME_MAX_LEN." ".system_showText(LANG_USERNAME_MSG3)?></span>
                                <div id="checkUsername">&nbsp;</div>
                            </td>
                        </tr>
                        <tr>
                            <th>* <?=system_showText(LANG_LABEL_PASSWORD)?>:</th>
                            <td>
                                <input type="password" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" class="input-form-account" <?if (PASSWORD_STRENGTH=='on') echo "onkeyup=\"checkPasswordStrength(this.value, '<?=EDIRECTORY_FOLDER;?>')\"";?> />

                                <?if (PASSWORD_STRENGTH=='on'){?>
                                <div class="checkPasswordStrength">
                                    <span><?=system_showText(LANG_LABEL_PASSWORDSTRENGTH);?>:</span>
                                    <div id="checkPasswordStrength" class="strengthNoPassword">&nbsp;</div>
                                </div>
                                <?}?>
                                <span><?=system_showText(LANG_PASSWORD_MSG1)." ".PASSWORD_MIN_LEN." ".system_showText(LANG_PASSWORD_MSG2)." ".PASSWORD_MAX_LEN." ".system_showText(LANG_PASSWORD_MSG3)?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>* <?=system_showText(LANG_LABEL_RETYPEPASSWORD)?>:</th>
                            <td><input type="password" name="retype_password" class="input-form-account" /></td>
                        </tr>
                        <tr>
                            <th><input type="checkbox" name="agree_tou" value="1" <?=($agree_tou) ? "checked" : ""?> class="inputRadio" /></th>
                            <td>* <a href="<?=DEFAULT_URL?>/popup/popup.php?pop_type=terms" class="iframe fancy_window_terms"><?=system_showText(LANG_IGREETERMS)?></a></td>
                        </tr>
                        <tr>
                            <th colspan="2" class="SIGNUPTable-title"><h2 class="standardSubTitle"><?=system_showText(LANG_CONTACTINFO)?> <span><?=system_showText(LANG_CONTACTINFO_MSG)?></span></h2></th>
                        </tr>
                        <? if ($message_contact) { ?>
                        <tr>
                            <td colspan="2"><p class="errorMessage"><?=$message_contact?></p></td>
                        </tr>
                        <? } ?>
                        <?
                        $langObj = new Lang();
                        $languages = $langObj->getCountEnabledLang();
                        if ($languages > 1) {
                            ?>
                            <tr>
                                <th>* <?=system_showText(LANG_LABEL_LANGUAGE);?>:</th>
                                <td>
                                    <?=language_langOptions($lang);?>
                                    <span><?=system_showText(LANG_LABEL_LANGUAGETIP)?></span>
                                </td>
                            </tr>
                        <? } else echo "<input type=\"hidden\" name=\"lang\" value=\"".$langObj->getDefault()."\" />\n"; ?>
                        <tr>
                            <th>* <?=system_showText(LANG_LABEL_FIRSTNAME)?>:</th>
                            <td><input type="text" name="first_name" value="<?=$first_name?>" /></td>
                        </tr>
                        <tr>
                            <th>* <?=system_showText(LANG_LABEL_LASTNAME)?>:</th>
                            <td><input type="text" name="last_name" value="<?=$last_name?>" /></td>
                        </tr>
                        <tr>
                            <th><?=system_showText(LANG_LABEL_COMPANY)?>:</th>
                            <td><input type="text" name="company" value="<?=$company?>" /></td>
                        </tr>
                        <tr>
                            <th valign="top"><?=system_showText(LANG_LABEL_ADDRESS)?>:</th>
                            <td><input type="text" name="address" value="<?=$address?>" maxlength="50" /></td>
                        </tr>
                        <tr>
                            <th><?=system_showText(LANG_LABEL_ADDRESSOPTIONAL)?>:</th>
                            <td><input type="text" name="address2" value="<?=$address2?>" maxlength="50" /></td>
                        </tr>
                        <tr>
                            <th><?=system_showText(LANG_LABEL_CITY)?>:</th>
                            <td><input type="text" name="city" value="<?=$city?>" /></td>
                        </tr>
                        <tr>
                            <th><?=system_showText(LANG_LABEL_STATE)?>:</th>
                            <td><input type="text" name="state" value="<?=$state?>" /></td>
                        </tr>
                        <tr>
                            <th><?=string_ucwords(ZIPCODE_LABEL)?>:</th>
                            <td><input type="text" name="zip" value="<?=$zip?>" /></td>
                        </tr>
                        <tr>
                            <th><?=system_showText(LANG_LABEL_COUNTRY)?>:</th>
                            <td><input type="text" name="country" value="<?=$country?>" /></td>
                        </tr>
                        <tr>
                            <th><?=system_showText(LANG_LABEL_PHONE)?>:</th>
                            <td><input type="text" name="phone" value="<?=$phone?>" /></td>
                        </tr>
                        <tr>
                            <th>* <?=system_showText(LANG_LABEL_EMAIL)?>:</th>
                            <td><input type="text" id="email" name="email" value="<?=$email?>" /></td>
                        </tr>
                    </table>

                    <? include(EDIRECTORY_ROOT."/includes/code/seckey.php"); ?>

                    <input type="hidden" name="ieBugFix" value="1" />

                    <div>
                        <p class="standardButton claimButton">
                            <button type="submit" name="next" value="<?=system_showText(LANG_LISTING_CLAIMTHIS)?>"><?=system_showText(LANG_LISTING_CLAIMTHIS)?></button>
                        </p>
                    </div>

                </form>

            </div>

        </div>

        <? include(system_getFrontendPath("banner_bottom.php")); ?>

    </div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(system_getFrontendPath("footer.php", "layout"));
?>