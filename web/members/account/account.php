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
	# * FILE: /members/account/account.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if (SOCIALNETWORK_FEATURE == "on") {
		include(EDIRECTORY_ROOT."/includes/code/profile.php");
	}

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);
	setting_get('commenting_edir', $commenting_edir);
	setting_get('review_listing_enabled', $review_enabled);
	setting_get('review_article_enabled', $review_article_enabled);
	setting_get('review_promotion_enabled', $review_promotion_enabled);

	// required because of the cookie var
	$username = "";

	// Default CSS class for message box
	$message_style = "errorMessage";

	# ----------------------------------------------------------------------------------------------------
	# Unlink Facebook
	# ----------------------------------------------------------------------------------------------------
	if (isset($_GET['signoffFacebook'])){
		$facebookMessage = system_showText(LANG_LABEL_FB_ACT_DISC).'.';

		$accountObj = new Account(sess_getAccountIdFromSession());
		$accountObj->setString("facebook_username", "");
		$accountObj->setString("foreignaccount", "n");
		$accountObj->setString("foreignaccount_done", "n");
		$accountObj->setString("foreignaccount_auth", "");
		$accountObj->Save();


		$profileObj = new Profile(sess_getAccountIdFromSession());
		$profileObj->setString("facebook_uid","");
		$profileObj->setString("usefacebooklocation","0");
		$profileObj->Save();

		$fbpost_checked = '';

	}
	
	$expire = 60*60*24*30*12;
	setcookie("fb_attachOption", "facebook_import", time() + $expire, EDIRECTORY_FOLDER? EDIRECTORY_FOLDER: "/");

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($_POST["hiddenValue"]) {
			$reviewObj = new Review($_POST["hiddenValue"]);
			$reviewObj->Delete();
			header("Location: ".DEFAULT_URL."/members/account/account.php?type=".$_POST["type"]."&id=".sess_getAccountIdFromSession()."&scrren=".$_POST["screen"]."");
			exit;
		}

		$validate_demodirectoryDotCom = true;
		if (DEMO_LIVE_MODE) {
			$validate_demodirectoryDotCom = validate_demodirectoryDotCom($_POST["username"], $message_demoDotCom);
		}

		if ($validate_demodirectoryDotCom) {
			if (SOCIALNETWORK_FEATURE == "off") {
				$_POST["publish_contact"] = 'n';
			} else {
				if ($_POST['publish_contact'] == "on") {
					$_POST["publish_contact"] = 'y';
				} else {
					$_POST["publish_contact"] = 'n';
				}
			}
            $_POST['use_lang'] = ($_POST['use_lang'] ? 'y' : 'n');
            $_POST['notify_traffic_listing'] = ($_POST['notify_traffic_listing'] ? 'y' : 'n');

			if ((string_strlen($_POST["password"]))||(string_strlen($_POST["retype_password"]))) {
				$validate_membercurrentpassword = validate_memberCurrentPassword($_POST, sess_getAccountIdFromSession(), $message_member);
			} else {
				$validate_membercurrentpassword = true;
			}

			if ($validate_demodirectoryDotCom) {
				if ((string_strlen($_POST["password"]))||(string_strlen($_POST["retype_password"]))) {
					$validate_membercurrentpassword = validate_memberCurrentPassword($_POST, sess_getAccountIdFromSession(), $message_member);
				} else {
					$validate_membercurrentpassword = true;
				}

				$account = new Account($account_id);
				$validate_account = validate_MEMBERS_account($_POST, $message_account);
				$validate_contact = validate_form("contact", $_POST, $message_contact);
			}

			if ($validate_demodirectoryDotCom && $validate_membercurrentpassword && $validate_account && $validate_contact && !$message_profile) {
				$account = new Account($account_id);
				if ($account->getString("foreignaccount") == "y") {
					$account->setString("foreignaccount_done", "y");
					$account->save();
				}
				if ($_POST["password"]) {
					$account->setString("password", $_POST["password"]);
					$account->updatePassword();
				}
				
				$account->setString("notify_traffic_listing", $_POST['notify_traffic_listing']);
				
				$account->setString("publish_contact", $_POST["publish_contact"]);
				$account->Save();

				$contact = new Contact($_POST);
				$contact->Save();

				$accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
				$accDomain->Save();
				$accDomain->saveOnDomain($account->getNumber("id"), $account, $contact);

				$message = system_showText(LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED);
				$message_style = "successMessage";
			} else {
				$message = "";
				$message_style = "";
			}
		} else {
			$message = "";
			$message_style = "";
		}

	    // removing slashes added if required
	    $_POST = format_magicQuotes($_POST);
	    $_GET  = format_magicQuotes($_GET);

		extract($_GET);
	    extract($_POST);
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if (sess_getAccountIdFromSession()) {
		$account = new Account(sess_getAccountIdFromSession());
		$account->extract();
		$contact = new Contact(sess_getAccountIdFromSession());
		$contact->extract();
	} else {
		header("Location: ".DEFAULT_URL."/members/index.php");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>

	<div class="content">

		<? if (($account->getString("foreignaccount") == "y") && ($account->getString("foreignaccount_done") == "n")) { ?>
			<p class="warningMessage"><?=system_showText(LANG_MSG_FOREIGNACCOUNTWARNING);?></p>
			<? $type = "tab_2"; ?>
		<? } ?>

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? if (SOCIALNETWORK_FEATURE == "on") { ?>
			<h2><?=system_showText(LANG_LABEL_ACCOUNT_INFORMATION)?></h2>
		<? } else { ?>
			<h2><?=system_showText(LANG_LABEL_ACCOUNT_AND_CONTACT_INFO)?></h2>
		<? } ?>
		<?
		$contentObj = new Content("", EDIR_LANGUAGE);
		$content = $contentObj->retrieveContentByType("Manage Account");
		if ($content) {
			echo "<blockquote>";
				echo "<div class=\"dynamicContent\">".$content."</div>";
			echo "</blockquote>";
		}
		?>

		<? if($message){ ?>
			<p class="<?=$message_style?>"><?=$message?></p>
		<? } ?>

		<? if ((string_strlen(trim($message_demoDotCom))>0)) { ?>
			<p class="errorMessage">
				<? if (string_strlen(trim($message_demoDotCom))>0) { ?>
					<?=$message_demoDotCom?>
				<? } ?>
			</p>
		<? } ?>

		<table cellpadding="0" cellspacing="0" border="0" class="standard-table tabsTable">
			<tr>
				<th class="tabsBase">
					<ul class="tabs">
						<? if (SOCIALNETWORK_FEATURE == "on") { ?>
						<li id="tab_1" class="<?=($type== "tab_1" || !$type)? "tabActived" : ""?>">
							<a href="<?=DEFAULT_URL;?>/members/account/account.php?type=tab_1&id=<?=sess_getAccountIdFromSession();?>"><?=system_showText(LANG_LABEL_PERSONAL_PAGE)?></a>
						</li>
						<? } ?>
						<li id="tab_2"  class="<?=$type == "tab_2" || SOCIALNETWORK_FEATURE == "off" ? "tabActived" : ""?>">
							<a href="<?=DEFAULT_URL;?>/members/account/account.php?type=tab_2&id=<?=sess_getAccountIdFromSession();?>"><?=system_showText(LANG_LABEL_ACCOUNT_SETTINGS)?></a>
						</li>
						<? if(($review_enabled == "on" || $review_article_enabled == "on" || $review_promotion_enabled == "on") && $commenting_edir) { ?>
							<li id="tab_3">
								<a href="<?=DEFAULT_URL;?>/members/account/reviews.php"><?=system_showText(LANG_REVIEW_PLURAL)?></a>
							</li>
						<? } ?>
						<li id="tab_4">
							<a href="<?=DEFAULT_URL;?>/members/account/quicklists.php"><?=system_showText(LANG_LABEL_FAVORITES)?></a>
						</li>
						<li id="tab_5">
							<a href="<?=DEFAULT_URL;?>/members/account/deals.php"><?=system_showText(LANG_LABEL_ACCOUNT_DEALS)?></a>
						</li>
					</ul>
				</th>
			</tr>
		</table>

		<form name="account" id="account" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" enctype="multipart/form-data">
			<input type="hidden" name="type" id="type" value="<?=$type? $type: "tab_1";?>" />
			<input type="hidden" name="account_id" value="<?=$account_id?>" />
			<? $noteditusername = true; ?>
			<? $noteditagree    = true; ?>
			<div id="profile_info" style="<?=($type == 'tab_2' || SOCIALNETWORK_FEATURE == "off")? '' : 'display:none'?>">
				<? if ((string_strlen(trim($message_member))>0) ||(string_strlen(trim($message_account))>0) ||(string_strlen(trim($message_contact))>0) ) { ?>
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
				<? $memberssection   = true; ?>	
					
				<? include(INCLUDES_DIR."/forms/form_account.php"); ?>
				<? include(INCLUDES_DIR."/forms/form_contact.php"); ?>

				<div class="baseButtons floatButtons">
					<p class="standardButton">
						<button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
					</p>
				</div>

				<div class="baseButtons floatButtons noPadding">
					<p class="standardButton">
						<button type="submit" value="Cancel" onclick="redirect('<?=DEFAULT_URL?>/members/');"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
					</p>
				</div>
			</div>
			<? if (SOCIALNETWORK_FEATURE == "on") { ?>
				<div id="personal_pageinfo" style="<?=($type=='tab_1'||!$type)?'':'display:none'?>">
					<? if (string_strlen(trim($message_profile))>0) { ?>
						<p class="errorMessage">
						<?=$message_profile?>
						</p>
					<? } ?>
					<? include(INCLUDES_DIR."/forms/form_profile.php"); ?>

					<div class="baseButtons floatButtons" id="btnSubmit" style="<?=$has_profile == 'n'? "display: none;": "";?>">
						<p class="standardButton">
							<button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
						</p>
					</div>

					<div class="baseButtons floatButtons noPadding" id="btnCancel" style="<?=$has_profile == 'n'? "display: none;": "";?>">
						<p class="standardButton">
							<button type="reset" value="Cancel" onclick="redirect('<?=DEFAULT_URL?>/members/');"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
						</p>
					</div>
				</div>
			<? } ?>
		</form>
		<?
		$contentObj = new Content("", EDIR_LANGUAGE);
		$content = $contentObj->retrieveContentByType("Manage Account Bottom");
		if ($content) {
			echo "<blockquote>";
				echo "<div class=\"dynamicContent\">".$content."</div>";
			echo "</blockquote>";
		}
		?>

	</div>

	<script language="javascript" type="text/javascript">

		function redirect (url) {
			window.location = url;
		}

		function showTabs(tab) {
			$('#type').val(tab);
			if (tab == 'tab_1') {
				$('#tab_1').addClass('tabActived');
				$('#tab_2').removeClass('tabActived');
				$('#profile_info').css('display', 'none');
				$('#personal_pageinfo').css('display', '');
			} else if (tab == 'tab_2') {
				$('#tab_1').removeClass('tabActived');
				$('#tab_2').addClass('tabActived');
				$('#profile_info').css('display', '');
				$('#personal_pageinfo').css('display', 'none');
			}
		}

		function formSubmit(form, module) {
			$('#changePage').val(module);
			form.submit();
		}

	</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>

