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
	# * FILE: /members/login.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DOMAIN COOKIE VALIDATION
	# ----------------------------------------------------------------------------------------------------
	if (!$_COOKIE["automatic_login_members"] || $_COOKIE["automatic_login_members"] == "false") {
		$resetDomainSession = true;
	}
	
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------

	$members_section = true;

	/*if ($_GET["np"]) {
		$message_login = system_showText(LANG_MSG_NO_PERMISSION)."<br />";
		$message_login .= "<a href=\"".DEFAULT_URL."/advertise.php\">".system_showText(LANG_DOYOUWANT_ADVERTISEWITHUS)."</a> ";
		if (SOCIALNETWORK_FEATURE == "on") {
			$message_login .= system_showText(LANG_OR)." <a href=\"".SOCIALNETWORK_URL."\">".system_showText(LANG_MSG_GO_PROFILE)."</a>";
		}
	}*/
 
     ###############################################redirect url
	/*$_GET = format_magicQuotes($_GET);
	$_POST = format_magicQuotes($_POST);
	$destiny = $_GET["destiny"] ? $_GET["destiny"] : $_POST["destiny"];
	$destiny = urldecode($destiny);
	if ($destiny) {
		$destiny = system_denyInjections($destiny);
		if (string_strpos($destiny, "://") !== false) {
			if (string_strpos($destiny, $_SERVER["HTTP_HOST"]) === false) {
				$destiny = "";
			}
		}
	}*/
	##################################################protect from bad injections
	/*if ($_SERVER["QUERY_STRING"]) {
		if (string_strpos($_SERVER["QUERY_STRING"], "query=") !== false) {
			$query = string_substr($_SERVER["QUERY_STRING"], string_strpos($_SERVER["QUERY_STRING"], "query=")+6);
		} else {
			$query = $_GET["query"] ? $_GET["query"] : $_POST["query"];
			$query = urldecode($query);
		}
	} else {
		$query = $_GET["query"] ? $_GET["query"] : $_POST["query"];
		$query = urldecode($query);
	}
	if ($query) {
		$query = system_denyInjections($query);
	}*/

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
/*
	if ($_POST["userform"] == "currentuser" && ($_POST["claim"] || $_POST["advertise"])) {
		if ($destiny) {
			$url = $destiny;
			if ($query) $url .= "?".$query;
		} else {
			$url = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL != "on") ? SECURE_URL : DEFAULT_URL)."/mobi/index.php/$listing->id";
		}
		$accountObj = new Account($_POST["acc"]);
		$accountObj->changeMemberStatus(true);

		$accDomain = new Account_Domain($accountObj->getNumber("id"), SELECTED_DOMAIN_ID);
		$accDomain->Save();
		$accDomain->saveOnDomain($accountObj->getNumber("id"), $accountObj);

		$host = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));

		setcookie($host."_DOMAIN_ID_MEMBERS", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
		setcookie($host."_DOMAIN_ID", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
		unset($_SESSION[$host."_DOMAIN_ID_MEMBERS"], $_SESSION[$host."_DOMAIN_ID"]);

		header("Location: ".$url);
		exit;
	}*/ /*else if ($_POST["userform"] == "openid") {

		setcookie("openidurl", $_POST["openidurl"], time()+60*60*24*30, "".EDIRECTORY_FOLDER.(MODREWRITE_FEATURE == "on" ? "/".EDIR_LANGUAGEABBREVIATION : "")."/members");

		if ($destiny) {
			$url = $destiny;
			if ($query) $url .= "?".$query;
		} else {
			$url = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)."/mobi/index.php/$listing->id/";
		}

		setcookie("userform", $_POST["userform"], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

		$accountObject = db_getFromDB("account", "username", db_formatString("openid::http://".$_POST["openidurl"]));

		if ($accountObject->getNumber("id")) {
			$accountObject->setForeignAccountRedirect($url);

			if ($accountObject->getString("foreignaccount") == "y") {
				$accountObject->setString("foreignaccount_done", "y");
				$accountObject->save();
			}
		} else {
			$_SESSION["ACCOUNT_REDIRECT"] = $url;
		}

		$identity = $_POST["openidurl"];
		$trust_root = DEFAULT_URL;
		if ($_POST["advertise"]) {
			$return_to = DEFAULT_URL."/members/openidauth.php?advertise=yes";
		} else if ($_POST["claim"]) {
			$return_to = DEFAULT_URL."/members/openidauth.php?claim=yes";
		} else {
			$return_to = DEFAULT_URL."/members/openidauth.php";
		}
		$required_fields = array('email', 'fullname');
		$optional_fields = array('dob', 'gender', 'postcode', 'country', 'language', 'timezone');
		$openid = new AuthOpenID($identity, $trust_root, $return_to, $required_fields, $optional_fields);
		try {
			$openid->requestAuth();
		} catch (Exception $ex) {
			$authmessage = system_showText(LANG_MSG_OPENID_SERVER);
		}

	} else {*/

		if () {
            echo '<script>alert("jhgfgh");</script>';
			sess_registerAccountInSession($_POST["username"]);
			setcookie("username_members", $_POST["username"], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

			setcookie("uid", sess_getAccountIdFromSession(), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

			$AccountObj = db_getFromDB("account", "username", db_formatString($_POST["username"]));
			if ($_POST["automatic_login"]) {
				setcookie("automatic_login_members", "true", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
				$_POST["password"] = string_strtolower(PASSWORD_ENCRYPTION) == "on" ? md5($_POST["password"]) : $_POST["password"];
				$aux = md5(MEMBERS_LOGIN_PAGE.trim($_POST["username"]).$_POST["password"]);
				setcookie("complementary_info_members", $aux, time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

				$AccountObj->Save();
				
			} else {
				setcookie("automatic_login_members", "false", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			}

			if ($destiny) {
				$url = $destiny;
				if ($query) $url .= "?".$query;
			} else {
				$url = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)."/mobi/index.php/$listing->id";
			}

			setcookie("userform", "directory", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			$_POST["userform"] = "directory";


			$profileObj = new Profile(sess_getAccountIdFromSession());
			$profileObj->setNumber("account_id", sess_getAccountIdFromSession());
			$profileObj->Save();

			$accountObj = new Account(sess_getAccountIdFromSession());
			if ($_POST["advertise"] || $_POST["claim"]) {
				$accountObj->changeMemberStatus(true);
			}

			$accDomain = new Account_Domain($accountObj->getNumber("id"), SELECTED_DOMAIN_ID);
			$accDomain->Save();
			$accDomain->saveOnDomain($accountObj->getNumber("id"), $accountObj, false, $profileObj);

			if ((string_strpos($_SERVER["HTTP_REFERER"], "members") === false || string_strpos($_SERVER["HTTP_REFERER"], "members/login.php")) && !$_POST["advertise"] && !$_POST["claim"]) {
				if (($AccountObj->getString("is_sponsor") == "y" || SOCIALNETWORK_FEATURE == "off") && (string_strpos($url, "profile") === false)) {
					$url = DEFAULT_URL."/mobi/index.php/$listing->id";
				} else {
					if (SOCIALNETWORK_FEATURE == "off"){
						$url = DEFAULT_URL."/mobi/index.php/$listing->id/";
					} else {
						$url = SOCIALNETWORK_URL."/";
					}
				}
			}

			$host = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));

			setcookie($host."_DOMAIN_ID_MEMBERS", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			setcookie($host."_DOMAIN_ID", "", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
			unset($_SESSION[$host."_DOMAIN_ID_MEMBERS"], $_SESSION[$host."_DOMAIN_ID"]);

			if ($_GET['userperm'] == true) {
				$_x_http_refer = $_SESSION["HTTP_REFER"];
				unset($_SESSION["HTTP_REFER"]);
				
				if ($_x_http_refer) {
					$redirectUrl = system_getAccountRedirect($_x_http_refer);
					header("Location: ".$redirectUrl);
				} else {
					$redirectUrl = system_getAccountRedirect($_SERVER["HTTP_REFERER"]);
					header("Location: ".$redirectUrl);
				}
				
			} else {
				$redirectUrl = system_getAccountRedirect($url);
				header("Location: ".$redirectUrl);
			}
			exit;

		}

	/*}*/

	$userform = $_POST["userform"];
	$username = $_POST["username"];
	$openidurl = $_POST["openidurl"];

	$message_login = $authmessage;

} elseif ($_GET["openiderror"]) {

	$openiderror = $_GET["openiderror"];
	if ($openiderror) {
		if ($openiderror == "server") {
			$message_login = system_showText(LANG_MSG_OPENID_SERVER);
		} elseif ($openiderror == "cancel") {
			$message_login = system_showText(LANG_MSG_OPENID_CANCEL);
		} elseif ($openiderror == "invalid") {
			$message_login = system_showText(LANG_MSG_OPENID_INVALID);
		} else {
			$message_login = system_showText(LANG_MSG_OPENID_ERROR);
		}
	}

	$userform = $_COOKIE["userform"];
	$username = $_COOKIE["username_members"];
	$openidurl = $_COOKIE["openidurl"];

} elseif ($_GET["facebookerror"]) {

	$facebookerror = $_GET["facebookerror"];

	setcookie("userform", "facebook", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

	$message_login = $facebookerror;

	$userform = "facebook";
	$username = $_COOKIE["username_members"];

} elseif ($_GET["googleerror"]) {

	$googleerror = $_GET["googleerror"];
	
	if ($googleerror){;

		if ($googleerror == "cancel"){
			$message_login = system_showText(LANG_MSG_GOOGLE_CANCEL);
		} else {
			$message_login = system_showText(LANG_MSG_OPENID_ERROR);
		} 
	}

	setcookie("userform", "google", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");
	$userform = "google";

} elseif ($_GET["key"]) {

	$forgotPasswordObj = new forgotPassword($_GET["key"]);

	if ($forgotPasswordObj->getString("unique_key") && ($forgotPasswordObj->getString("section") == "members")) {

		$accountObj = new Account($forgotPasswordObj->getString("account_id"));

		if ($accountObj->getNumber("id")) {

			sess_registerAccountInSession($accountObj->getString("username"));
			setcookie("username_members", $accountObj->getString("username"), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

			$redirectUrl = system_getAccountRedirect(((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)."/members/resetpassword.php?key=".$_GET["key"]);
			header("Location: ".$redirectUrl);
			exit;

		} else {
			$message_login = system_showText(LANG_MSG_WRONG_ACCOUNT);
		}

	} else {
		$message_login = system_showText(LANG_MSG_WRONG_KEY);
	}

} else {

	$userform = $_COOKIE["userform"];
	$username = $_COOKIE["username_members"];
	if ($_COOKIE["automatic_login_members"] == "true") $checked = "checked";
	else $checked = "";
	$openidurl = $_COOKIE["openidurl"];

}

setting_get("foreignaccount_openid", $foreignaccount_openid);
setting_get("foreignaccount_google", $foreignaccount_google);

if (!$userform) {
	$userform = "directory";
} else {
	if ($userform == "openid" && !$foreignaccount_openid) {
		$userform = "directory";
	}
	
	if ($userform == "google" && !$foreignaccount_google) {
		$userform = "directory";
	}
	
	if ($userform == "facebook" && FACEBOOK_APP_ENABLED != "on") {
		$userform = "directory";
	}
}

setcookie("userform", $userform, time()+60*60*24*30, "".EDIRECTORY_FOLDER."/");

# ----------------------------------------------------------------------------------------------------
# HEADER
# ----------------------------------------------------------------------------------------------------
//include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

?>

	<div class="sidebar">
		<h2><?=system_showText(LANG_LABEL_MEMBER_OPTIONS);?></h2>
		<ul class="memberMenu">
			<li><a href="<?=NON_SECURE_URL?>/index.php"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH);?></a></li>
			<? if (SOCIALNETWORK_FEATURE == "off") { ?>
	<li><a href="<?=NON_SECURE_URL?>/advertise.php"><?=system_showText(LANG_LABEL_ADD_NEW_ACCOUNT);?></a></li>
			<? } ?>
		</ul>
	</div>

	<div class="content">

		<h2><?=system_showText(EDIRECTORY_TITLE." ".LANG_LABEL_LOGIN)?></h2>

		<? if ($foreignaccount_openid == "on" || $foreignaccount_google == "on" || FACEBOOK_APP_ENABLED == "on") { ?>
	<div class="complementaryInfo loginOptions">
	<a href="javascript:void(0);" onclick="switchUserForm('directory');"><?=system_showText(LANG_LOGINDIRECTORYUSER);?></a>
				<? if ($foreignaccount_openid == "on") { ?>
	| <a href="javascript:void(0);" onclick="switchUserForm('openid');"><?=system_showText(LANG_LOGINOPENIDUSER);?></a>
				<? } ?>
				<? if (FACEBOOK_APP_ENABLED == "on") { ?>
	| <a href="javascript:void(0);" onclick="switchUserForm('facebook');"><?=system_showText(LANG_LOGINFACEBOOKUSER);?></a>
				<? } ?>
				<? if ($foreignaccount_google == "on") { ?>
	| <a href="javascript:void(0);" onclick="switchUserForm('google');"><?=system_showText(LANG_LOGINGOOGLEUSER);?></a>
				<? } ?>
</div>
            <?
            //FACEBOOK FORM LOGIN
            $divIdFB="facebookuser";
            ?>
<input type="hidden" id="randomId" name="randomId" value="<?=$randomId?$randomId:''?>"/>
			<?
		}
		?>

		<div id="directoryuser" class="<?=$userform == "directory"? "isVisible": "isHidden"; ?>">

			<form name="formDirectory" method="post" action="<?=MEMBERS_LOGIN_PAGE;?>">

				<input type="hidden" name="userform" value="directory" />

				<? include(INCLUDES_DIR."/forms/form_login.php"); ?>

				<p class="loginComplementaryInfo">
					<? if (DEMO_MODE) { ?> <strong><?=system_showText(LANG_LABEL_TESTPASSWORD)?>:</strong> abc123 | <? } ?>
					<? if(system_checkEmail(SYSTEM_FORGOTTEN_PASS, EDIR_LANGUAGE)) { ?>
	<a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)?>/members/forgot.php" class="linkLogin"><?=system_showText(LANG_MSG_FORGOT_YOUR_PASSWORD)?></a>
					<? } ?>
				</p>

			</form>

		</div>

		<? if ($foreignaccount_openid == "on") { ?>

	<div id="openiduser" class="<?=$userform == "openid"? "isVisible": "isHidden"; ?>">

	<form name="formOpenID" method="post" action="<?=MEMBERS_LOGIN_PAGE;?>">

	<input type="hidden" name="userform" value="openid" />

					<? include(INCLUDES_DIR."/forms/form_openidlogin.php"); ?>

<p class="loginComplementaryInfo">
<a rel="nofollow" href="http://www.openid.net/" target="_blank" class="linkLogin"><?=system_showText(LANG_MSG_WHATISOPENID);?></a>
</p>

</form>

</div>

		<? } ?>

		<? if (FACEBOOK_APP_ENABLED == "on") { ?>
	
	<div id="facebookuser" class="<?=$userform == "facebook"? "isVisible": "isHidden"; ?>">

				<? $urlRedirect = "?destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/"); ?>
				<? include(INCLUDES_DIR."/forms/form_facebooklogin.php"); ?>

<p class="loginComplementaryInfo">
<a rel="nofollow" href="http://www.facebook.com/" target="_blank" class="linkLogin"><?=system_showText(LANG_MSG_WHATISFACEBOOK);?></a>
</p>

</div>

		<? } ?>
			
		<? if ($foreignaccount_google == "on") { ?>
	
	<div id="googleuser" class="<?=$userform == "google"? "isVisible": "isHidden"; ?>">
	
				<? $urlRedirect = "&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/"); ?>
				<? include(INCLUDES_DIR."/forms/form_googlelogin.php"); ?>

<p class="loginComplementaryInfo">
<a rel="nofollow" href="http://www.google.com/" target="_blank" class="linkLogin"><?=system_showText(LANG_MSG_WHATISGOOGLE);?></a>
</p>

</div>

		<? } ?>

		<p class="loginComplementaryInfo"><?=system_showText(LANG_MSG_NOT_A_MEMBER)?> <a href="<?=NON_SECURE_URL?>/advertise.php" class="linkLogin"><b><?= ucfirst(system_showText(LANG_LABEL_CLICK_HERE))?></b></a> <?=system_showText(LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM)?> <?=EDIRECTORY_TITLE?>.</p>

		<script language="JavaScript" type="text/javascript">
			<!--
			function switchUserForm(formlogin) {
				if (formlogin == "directory") {
					if (document.getElementById("directoryuser")) document.getElementById("directoryuser").className = "isVisible";
					if (document.getElementById("openiduser")) document.getElementById("openiduser").className = "isHidden";
					if (document.getElementById("facebookuser")) document.getElementById("facebookuser").className = "isHidden";
					if (document.getElementById("googleuser")) document.getElementById("googleuser").className = "isHidden";
					if (document.formDirectory.username) {
						if (document.formDirectory.username.value) {
							document.formDirectory.password.focus();
						} else {
							document.formDirectory.username.focus();
						}
					} else {
						document.formDirectory.username.focus();
					}
				} else if (formlogin == "openid") {
					if (document.getElementById("directoryuser")) document.getElementById("directoryuser").className = "isHidden";
					if (document.getElementById("openiduser")) document.getElementById("openiduser").className = "isVisible";
					if (document.getElementById("facebookuser")) document.getElementById("facebookuser").className = "isHidden";
					if (document.getElementById("googleuser")) document.getElementById("googleuser").className = "isHidden";
					if (document.formOpenID) document.formOpenID.openidurl.focus();
				} else if (formlogin == "facebook") {
					if (document.getElementById("directoryuser")) document.getElementById("directoryuser").className = "isHidden";
					if (document.getElementById("openiduser")) document.getElementById("openiduser").className = "isHidden";
					if (document.getElementById("facebookuser")) document.getElementById("facebookuser").className = "isVisible";
					if (document.getElementById("googleuser")) document.getElementById("googleuser").className = "isHidden";
				} else if (formlogin == "google") {
					if (document.getElementById("directoryuser")) document.getElementById("directoryuser").className = "isHidden";
					if (document.getElementById("openiduser")) document.getElementById("openiduser").className = "isHidden";
					if (document.getElementById("facebookuser")) document.getElementById("facebookuser").className = "isHidden";
					if (document.getElementById("googleuser")) document.getElementById("googleuser").className = "isVisible";
				}
			}
			//-->
		</script>

	</div>

<?
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
//include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
