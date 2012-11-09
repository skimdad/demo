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
    # * FILE: /sitemgr/prefs/tax.php
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
	if (!isset($message)) system_setFreqActions('prefs_tax','prefstax');

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    extract($_POST);
    extract($_GET);

	$dbMain = db_getDBObject(DEFAULT_DB, true);
	$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
	$sqlLang = " SELECT id FROM Lang WHERE lang_default = 'y'";
	$resLang = $dbObj->Query($sqlLang);
	$rowLang = mysql_fetch_assoc($resLang);
	$edir_default_language = $rowLang["id"];
	unset($dbObj);
	unset($sqlLang);
	unset($resLang);
	unset($rowLang);

	$edir_languages = EDIR_LANGUAGES;
	$edir_languagenames = EDIR_LANGUAGENAMES;
	$languages = explode(",", $edir_languages);
	$languagenames = explode(",", $edir_languagenames);

	# ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if ($payment_tax_status == "on") {
			if (!${"payment_tax_label_".$edir_default_language}) {
				$error = true;
				$message = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSG_MAINLANGUAGE_REQUIRED)."<br />";
			}

			$payment_tax_value = str_replace(",",".",$payment_tax_value);

			$len = string_strlen($payment_tax_value);
			if ($payment_tax_value[$len-1]==".")
				$payment_tax_value .= "0";

			if (!$payment_tax_value && $payment_tax_value != 0) {
				$error = true;
				$message .= "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSG_VALUE_REQUIRED)."<br />";
			} else {
				if (!is_numeric($payment_tax_value)) {
					$error = true;
					$message .= "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSG_VALUE_MUST_BE_NUMERIC)."<br />";
				} else if ($payment_tax_value <= 0) {
					$error = true;
					$message .= "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSG_MIN_VALUE)."<br />";
				}
			}
		}

		if ($error) {
			$messageStyle = "errorMessage";
		} else  {
			if (setting_get("payment_tax_status", $aux)) {
				setting_set("payment_tax_status", $payment_tax_status);
			} else {
				setting_new("payment_tax_status", $payment_tax_status);
			}

			if (setting_get("payment_tax_value", $aux)) {
				setting_set("payment_tax_value", $payment_tax_value);
			} else {
				setting_new("payment_tax_value", $payment_tax_value);
			}

			for ($i = 0; $i < count($languages); $i++) {
				if (!${"payment_tax_label_".$languages[$i]}) {
					if (customtext_get("payment_tax_label", $aux, $languages[$i])) {
						customtext_set("payment_tax_label", ${"payment_tax_label_".$edir_default_language}, $languages[$i]);
					} else {
						customtext_new("payment_tax_label", ${"payment_tax_label_".$edir_default_language}, $languages[$i]);
					}
					${"payment_tax_label_".$languages[$i]} = ${"payment_tax_label_".$edir_default_language};
				} else {
					if (customtext_get("payment_tax_label", $aux, $languages[$i])) {
						customtext_set("payment_tax_label", ${"payment_tax_label_".$languages[$i]}, $languages[$i]);
					} else {
						customtext_new("payment_tax_label", ${"payment_tax_label_".$languages[$i]}, $languages[$i]);
					}
				}
			}
			$message = "&nbsp;".system_showText(LANG_SITEMGR_MSG_TAX_CHANGED);
			$messageStyle = "successMessage";
		}
	} else {
		setting_get("payment_tax_status", $payment_tax_status);
		setting_get("payment_tax_value", $payment_tax_value);

		for ($i = 0; $i < count($languages); $i++) {
			customtext_get("payment_tax_label", ${"payment_tax_label_".$languages[$i]}, $languages[$i]);
		}
		
		$language_label = $edir_default_language;
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

	<div id="main-right">

		<div id="top-content">
			<div id="header-content">
				<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_TAX))?></h1>
			</div>
		</div>

		<div id="content-content">

			<div class="default-margin">

				<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>

				<br />

				<form name="tax_configuration" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					<? include(INCLUDES_DIR."/forms/form_tax.php"); ?>
				</form>

			</div>

		</div>

	</div>

	<script type="text/javascript">
		function changeLanguageForm (lang) {
			var language;
			<? for ($i = 0; $i < count($languages); $i++) { ?>
				language = '<?=$languages[$i];?>';
				if (language == lang) {
					$('#tax_label_' + language).css('display', '');
				} else {
					$('#tax_label_' + language).css('display', 'none');
				}
			<? } ?>
		}
	</script>

<?
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>