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
	# * FILE: /sitemgr/prefs/paymentgateway.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	
	if (PAYMENTSYSTEM_FEATURE != "on") { exit; }
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/paymentgateway.php");
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
	
	
?>

<script type="text/javascript">
	<!--
	function formSubmit(item) {
		document.forms['paymentgateway'].elements['itemedit'].value = item;
		action = document.forms['paymentgateway'].action;
		action = action.split("#");
		action = action.join("");
		document.forms['paymentgateway'].action = action+"#"+item;
		document.forms['paymentgateway'].submit();
		return true;
	}
	
	function enableForm(type) {
		if (jQuery('#'+type).attr('checked') != '') {
			if (type == "linkpoint") {
				jQuery('#linkpoint_message').css('display', '');
				jQuery('#linkpoint_recurring').css('display', '');
			} else if (type == "simplepay") {
				jQuery('#simplepay_recurring').css('display', '');
			} else if (type == "paypal") {
				jQuery('#paypal_recurring').css('display', '');
			} else if (type == "authorize") {
				jQuery('#authorize_recurring').css('display', '');
			} 
			jQuery('#'+type+'_form').css('display', '');
		} else {
			if (type == "linkpoint") {
				jQuery('#linkpoint_message').css('display', 'none');
				jQuery('#linkpoint_recurring').css('display', 'none');
				jQuery('#linkpointRecurring_form').css('display', 'none');
				document.getElementById('linkpoint_recurringCheckbox').checked = false;
			} else if (type == "simplepay") {
				jQuery('#simplepay_recurring').css('display', 'none');
				jQuery('#simplepayRecurring_form').css('display', 'none');
				document.getElementById('simplepay_recurringCheckbox').checked = false;
			} else if (type == "paypal") {
				jQuery('#paypal_recurring').css('display', 'none');
				jQuery('#paypalRecurring_form').css('display', 'none');
				document.getElementById('paypal_recurringCheckbox').checked = false;
			} else if (type == "authorize") {
				jQuery('#authorize_recurring').css('display', 'none');
				jQuery('#authorizeRecurring_form').css('display', 'none');
				document.getElementById('authorize_recurringCheckbox').checked = false;
			} 
			jQuery('#'+type+'_form').css('display', 'none');
		}
	}
	
	function enableRecurringForm(type) {
		if (jQuery('#'+type+'_recurringCheckbox').attr('checked') != '') {
			jQuery('#'+type+'Recurring_form').css('display', '');
		} else {
			jQuery('#'+type+'Recurring_form').css('display', 'none');
		}
	}
	-->
</script>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_PAYMENTGATEWAY))?></h1>
		</div>
	</div>
	
	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>		
			
			<br />
			
			<p class="informationMessage">* <?=system_showText(LANG_LABEL_REQUIRED_FIELD)?></p>

			<?
			# ----------------------------------------------------------------------------------------------------
			# MESSAGES
			# ----------------------------------------------------------------------------------------------------

			$msg_success = system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_INFORMATIONWASCHANGED);
			if ($arrayError){
				$arrayError = explode(",", $arrayError);
				unset($msg_error);
				for ($i = 0; $i < count($arrayError); $i++) {
					if ($arrayError[$i] == "7") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_CYCLE_IS_REQUIRED_ON_SIMPLEPAY_RECURRING);
					} elseif ($arrayError[$i] == "8") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_NEGATIVE_NUMBER_NOT_ALLOWED_FOR_CYCLE_IN_SIMPLEPAY_RECURRING);
					} elseif ($arrayError[$i] == "9") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_LETTERS_AND_SPECIAL_CHARS_ARE_NOT_ALLOWED_FOR_CYCLE_IN_SIMPLEPAY_RECURRING);
					} elseif ($arrayError[$i] == "10") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_NEGATIVE_NUMBER_NOT_ALLOWED_FOR_TIMES_IN_SIMPLEPAY_RECURRING);
					} elseif ($arrayError[$i] == "11") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_LETTERS_AND_SPECIAL_CHARS_ARE_NOT_ALLOWED_FOR_TIMES_IN_SIMPLEPAY_RECURRING);
					} elseif ($arrayError[$i] == "12") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_CYCLE_IS_REQUIRED_ON_PAYPAL_RECURRING);
					} elseif ($arrayError[$i] == "13") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_NEGATIVE_NUMBER_NOT_ALLOWED_FOR_CYCLE_IN_PAYPAL_RECURRING);
					} elseif ($arrayError[$i] == "14") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_LETTERS_AND_SPECIAL_CHARS_ARE_NOT_ALLOWED_FOR_CYCLE_IN_PAYPAL_RECURRING);
					} elseif ($arrayError[$i] == "15") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_NEGATIVE_NUMBER_NOT_ALLOWED_FOR_TIMES_IN_PAYPAL_RECURRING);
					} elseif ($arrayError[$i] == "16") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_LETTERS_AND_SPECIAL_CHARS_ARE_NOT_ALLOWED_FOR_TIMES_IN_PAYPAL_RECURRING);
					} elseif ($arrayError[$i] == "error_simplepay" || $arrayError[$i] == "error_paypal" || $arrayError[$i] == "error_paypalapi" || 
							  $arrayError[$i] == "error_payflow" || $arrayError[$i] == "error_twocheckout" || $arrayError[$i] == "error_psigate" ||
							  $arrayError[$i] == "error_worldpay" || $arrayError[$i] == "error_itransact" || $arrayError[$i] == "error_linkpoint" || 
							  $arrayError[$i] == "error_authorize" || $arrayError[$i] == "error_pagseguro") {
						$msg_error[] = system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
					} elseif ($arrayError[$i] == "2") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_LISTING_RENEWAL_PERIOD_IS_REQUIRED);
					} elseif ($arrayError[$i] == "3") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_EVENT_RENEWAL_PERIOD_IS_REQUIRED);
					} elseif ($arrayError[$i] == "4") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_BANNER_RENEWAL_PERIOD_IS_REQUIRED);
					} elseif ($arrayError[$i] == "5") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_CLASSIFIED_RENEWAL_PERIOD_IS_REQUIRED);
					} elseif ($arrayError[$i] == "6") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_ARTICLE_RENEWAL_PERIOD_IS_REQUIRED);
					} elseif ($arrayError[$i] == "1") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_CURRENCY_SYMBOL_IS_REQUIRED);
					} elseif ($arrayError[$i] == "18") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAYMENT_CURRENCY_IS_REQUIRED);
					} elseif ($arrayError[$i] == "19") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAYMENT_CURRENCY_MUST_CONTAIN_THREE_CHARS);
					} elseif ($arrayError[$i] == "20") {
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAYMENT_CURRENCY_MUST_BE_ONLY_LETTERS);
					} elseif ($arrayError[$i] == "17"){
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_IF_RECURRING_CHOOSEN_RENEWAL_PERIODS_MUST_BE_THE_SAME);
					} elseif ($arrayError[$i] == "21"){
						$msg_error[] = "&#149;&nbsp;".system_showText(LANG_MSG_CURRENCY_PAGSEGURO);
					}
				}
				echo "<p class=\"errorMessage\">".implode("<br />", $msg_error)."</p>";
			} else if ($success_payment){
				echo "<p class=\"successMessage\">&#149;&nbsp;".$msg_success."</p>";
			} else {
				//increases frequently actions
				system_setFreqActions('prefs_paymentgateway','PAYMENTSYSTEM_FEATURE');
			}
			
			unset($arrayError);
			?>

			<form id="paymentgateway" name="paymentgateway" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="default-form">
				
				<? include(INCLUDES_DIR."/forms/form_paymentsettings.php"); ?>
				<input type="hidden" name="itemedit" value="" />
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						</td>
					</tr>
				</table>
			</form>

		</div>

	</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>