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
	# * FILE: /sitemgr/account/account.php
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

	// required because of the cookie var
	$username = "";	

	extract($_GET);
	extract($_POST);

	//increases frequently actions
	if (!isset($account_id)) system_setFreqActions('account_add','account');
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if (($password == '0' && string_strlen($password) < 4)) {
			$message_account = system_showText(LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS)." ".PASSWORD_MIN_LEN." ".system_showText(LANG_LABEL_CHARACTERES).".";
		} else {
			
			$_POST['notify_traffic_listing'] = ($_POST['notify_traffic_listing'] ? 'y' : 'n');

			if ($account_id) {
				
				$account = new Account($account_id);

				if ($password) $message_account = validate_password($password, "", false);
				$validate_contact = validate_form("contact", $_POST, $message_contact);

				if (!$message_account && $validate_contact) {
					if ($_POST['password']) {
						$account->setString("password", $_POST['password']);
						$account->updatePassword();
					}
					
					$account->setString("notify_traffic_listing", $_POST['notify_traffic_listing']);
					
					$_POST['use_lang'] = ($_POST['use_lang'] ? 'y' : 'n');
					
					$contact = new Contact($_POST);
					$contact->Save();
					$account->Save();

					$profileObj = new Profile($account_id);
					$profileObj->setNumber("account_id", $account_id);
					if (!$profileObj->getString("nickname")) {
						$profileObj->setString("nickname", $_POST["first_name"]." ".$_POST["last_name"]);
					}
					$profileObj->Save();

					switch ($account_option) {
						case "is_sponsor": {
							$account->changeMemberStatus(true);
							$account->changeProfileStatus(true);
							break;
						}
						case "is_member": {
							$account->changeMemberStatus(false);
							$account->changeProfileStatus(true);
							break;
						}
					}

					$accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
					$accDomain->Save();
					$accDomain->saveOnDomain($account->getNumber("id"), $account, $contact, $profileObj);
					
					if ($_POST["account_option"] == "is_sponsor") {
						$enType = SYSTEM_SPONSOR_ACCOUNT_UPDATE;
					} else {
						$enType = SYSTEM_VISITOR_ACCOUNT_UPDATE;
					}

					if ($_POST['password'] && system_checkEmail($enType, $contact->getString("lang"))) {
						system_sendPassword($enType, $_POST['email'], $_POST['username'], $_POST['password'], $_POST['first_name']." ".$_POST['last_name'], $contact->getString("lang"));
					}

					//$message = system_showText(LANG_SITEMGR_ACCOUNT_SUCCESSUPDATED);
					$message = 0;
					header("Location: ".DEFAULT_URL."/sitemgr/account/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
					exit;
				}

			} else {

				$validate_account = validate_SM_account($_POST, $message_account);
				$validate_contact = validate_form("contact", $_POST, $message_contact);
				if ($validate_account && $validate_contact) {
					$account = new Account($_POST);
					$account->save();
					$contact = new Contact($_POST);
					$contact->setNumber("account_id", $account->getNumber("id"));
					$contact->save();
					$profile = new Profile($account->getNumber("id"));
					$profile->setNumber("account_id", $account->getNumber("id"));
					if (!$profile->getString("nickname")) {
						$profile->setString("nickname", $_POST["first_name"]." ".$_POST["last_name"]);
					}
					$profile->Save();

					switch ($account_option) {
						case "is_sponsor": {
							$account->changeMemberStatus(true);
							$account->changeProfileStatus(true);
							break;
						}
						case "is_sponsor": {
							$account->changeMemberStatus(false);
							$account->changeProfileStatus(true);
							break;
						}
					}

					$accDomain = new Account_Domain($account->getNumber("id"), SELECTED_DOMAIN_ID);
					$accDomain->Save();
					$accDomain->saveOnDomain($account->getNumber("id"), $account, $contact, $profile);

					if ($_POST["account_option"] == "is_sponsor") {
						$enType = SYSTEM_SPONSOR_ACCOUNT_CREATE;
					} else {
						$enType = SYSTEM_VISITOR_ACCOUNT_CREATE;
					}

					if (system_checkEmail($enType, $contact->getString("lang"))) {
						system_sendPassword($enType, $_POST['email'], $_POST['username'], $_POST['password'], $_POST['first_name']." ".$_POST['last_name'], $contact->getString("lang"));
					}

					$message = 1;
					header("Location: ".DEFAULT_URL."/sitemgr/account/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&newest=1"."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
					exit;
				}

			}
		}
		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);
		extract($_POST);
		extract($_GET);
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if ($_GET['id']) {
		$account = new Account($_GET["id"]);
		$account->extract();
		$has_items = $account->getAccountItems();
		$contact = new Contact($_GET["id"]);
		$contact->extract();
		if ($account->getString("is_sponsor") == "y") {
			$enType = SYSTEM_SPONSOR_ACCOUNT_CREATE;
		} else {
			$enType = SYSTEM_VISITOR_ACCOUNT_CREATE;
		}
		$notification = system_checkEmail($enType, $contact->getString("lang"));
	} else {
		$notification = system_checkEmail(SYSTEM_SPONSOR_ACCOUNT_CREATE, EDIR_DEFAULT_LANGUAGE);
		$has_items = false;
	}

	if ($has_items) {
		$pStyle = "disabled";
		$pMessage = "<span>(".system_showText(LANG_LABEL_MSG_PROFILE_STATUS).")</span>";
	} else {
		$pStyle = "";
		$pMessage = "";
	}

	if ($is_sponsor == "y") {
		$cSponsor = "checked";
		$cMember = "";
	} else if ($is_sponsor == "n" && $has_profile == "y") {
		$cSponsor = "";
		$cMember = "checked";
	} else {
		$cSponsor = "checked";
		$cMember = "";
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

<script language="javascript" type="text/javascript">
    function enableStats() {
       if ($("#account_option_visitor").attr("checked") == false){
           $("#notify_traffic_listing").attr("disabled", false);
       } else {
           $("#notify_traffic_listing").attr("disabled", true);
       }
    }
    
    $(document).ready(function(){
        enableStats();
    });
</script>

<div id="main-right">
	<div id="top-content">
		<div id="header-content">
			<?
			if($id || $account_id) 
				$prefix = system_showText(LANG_SITEMGR_EDIT);
			else 
				$prefix = system_showText(LANG_SITEMGR_ADD);
			?>
			<h1><?=$prefix?> <?=system_showText(LANG_SITEMGR_ACCOUNT_TITLEACCOUNTCONTACT)?></h1>
		</div>
	</div>
	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_account_submenu.php"); ?>
			
			<div class="baseForm">

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

			<form name="account" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" style="margin:0; padding:0">
				<input type="hidden" name="account_id" value="<?=$account_id?>" />

				<? if ($id || $account_id) $noteditusername = true; ?>
				<? $noteditpassword  = true; ?>
				<? $noteditagree     = true; ?>
				<? if (!($id || $account_id)) $autopw = true; ?>
				<? $sitemgrsection   = true; ?>

				<? include(INCLUDES_DIR."/forms/form_account.php"); ?>
				<? include(INCLUDES_DIR."/forms/form_contact.php"); ?>

				<? if (SOCIALNETWORK_FEATURE == "on") { ?>
					<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
						<tr>
							<th><input type="radio" name="account_option" id="account_option_sponsor" value="is_sponsor" onclick="enableStats();" <?=$cSponsor;?>/></th>
							<td><?=system_showText(LANG_SITEMGR_SN_ENABLE_SPONSOR_SECTION);?></td>
						</tr>
						<tr>
							<th><input type="radio" name="account_option" id="account_option_visitor" value="is_member" onclick="enableStats();" <?=$cMember;?> <?=$pStyle?>/></th>
							<td><?=system_showText(LANG_SITEMGR_SN_ENABLE_MEMBER_SECTION);?>&nbsp;&nbsp;&nbsp;<?=$pMessage;?></td>
						</tr>
					</table>
				<? } else { ?>
					<input type="hidden" name="account_option" value="is_sponsor" />
				<? } ?>

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formaccountcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>
			<form id="formaccountcancel" action="<?=DEFAULT_URL?>/sitemgr/account/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
			</form>
			
			</div>

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