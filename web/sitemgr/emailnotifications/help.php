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
	# * FILE: /sitemgr/emailnotifications/help.php
	# ----------------------------------------------------------------------------------------------------
    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	setting_get("payment_tax_status", $payment_tax_status);
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# DEFAULT
	# ----------------------------------------------------------------------------------------------------

	/*
	 * Please update the "last_var_number" in comment blick.
	 * last_var_number: 23
	 */
	$defaultVAR = array	(
		0	=>	array("variable" => "ACCOUNT_NAME",					"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_NAME_HELP)),
		1	=>	array("variable" => "ACCOUNT_USERNAME",				"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_USERNAME_HELP)),
		2	=>	array("variable" => "ACCOUNT_PASSWORD",				"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_PASSWORD_HELP)),
		22	=>	array("variable" => "ACCOUNT_LOGIN_INFORMATION",	"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_LOGIN_INFORMATION_HELP)),
		3	=>	array("variable" => "KEY_ACCOUNT",					"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_KEY_ACCOUNT_HELP)),
		4	=>	array("variable" => "DEFAULT_URL",					"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_DEFAULTURL_HELP)." (\"".DEFAULT_URL."\")."),
		5	=>	array("variable" => "SITEMGR_EMAIL",				"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_SITEMGR_EMAIL_HELP)),
		6	=>	array("variable" => "EDIRECTORY_TITLE",				"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_EDIRECTORY_TITLE_HELP)." (".EDIRECTORY_TITLE.")."),
		7	=>	array("variable" => "LISTING_TITLE",				"description" => system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_LISTING_TITLE)."\")."),
		8	=>	array("variable" => "EVENT_TITLE",					"description" => system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_EVENT_TITLE)."\")."),
		9	=>	array("variable" => "BANNER_TITLE",					"description" => system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_BANNER_TITLE)."\")."),
		10	=>	array("variable" => "CLASSIFIED_TITLE",				"description" => system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_CLASSIFIED_TITLE)."\")."),
		11	=>	array("variable" => "ARTICLE_TITLE",				"description" => system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ARTICLE_TITLE)."\")."),
		12	=>	array("variable" => "LISTING_RENEWAL_DATE",			"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_LISTING_RENEWAL_DATE_HELP)),
		13	=>	array("variable" => "DAYS_INTERVAL",				"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_DAYS_INTERVAL)),
		14	=>	array("variable" => "CUSTOM_INVOICE_AMOUNT",		"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_CUSTOM_INVOICE_AMOUNT)),
		15	=>	array("variable" => "ITEM_TITLE",					"description" => system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ITEM_TITLE)."\")."),
		16	=>	array("variable" => "ITEM_URL",						"description" => DEFAULT_URL."/item/title.html"),
		17	=>	array("variable" => "CUSTOM_INVOICE_TAX",			"description" => system_showText(LANG_SITEMGR_SETTINGS_TAX_LABEL)),
		18	=>	array("variable" => "ARTICLE_DEFAULT_URL",			"description" => ARTICLE_DEFAULT_URL),
		19	=>	array("variable" => "CLASSIFIED_DEFAULT_URL",		"description" => CLASSIFIED_DEFAULT_URL),
		20	=>	array("variable" => "EVENT_DEFAULT_URL",			"description" => EVENT_DEFAULT_URL),
		21	=>	array("variable" => "LISTING_DEFAULT_URL",			"description" => LISTING_DEFAULT_URL),
		22	=>	array("variable" => "TABLE_STATS",					"description" => LANG_SITEMGR_EMAILNOTIFICATION_VAR_TABLE_STATS)
	);

	# ----------------------------------------------------------------------------------------------------
	# TABLE CONTENT
	# ----------------------------------------------------------------------------------------------------

	if($_REQUEST['id']){

		$id = $_REQUEST['id'];

		if ($id < 5) {

			$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6], $defaultVAR[12], $defaultVAR[13]);

		} elseif ($id == 5 || $id == 7) {

			$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[2], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6]);

		} elseif ($id == 9) {

			$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[3], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6]);

		} elseif ($id < 10) {

			$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6]);

		} elseif ($id == 15) {
			if ($payment_tax_status == "on") {
				$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6], $defaultVAR[14], $defaultVAR[17]);
			} else {
				$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6], $defaultVAR[14]);
			}

		} elseif ($id < 21) {

			$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6]);
			switch ($id) {
				case 16: {
					array_push($variables, $defaultVAR[21]);
					break;
				}
				case 17: {
					array_push($variables, $defaultVAR[20]);
					break;
				}
				case 19: {
					array_push($variables, $defaultVAR[19]);
					break;
				}
				case 20: {
					array_push($variables, $defaultVAR[18]);
					break;
				}
			}

		} elseif ($id == 21) {

			$variables = array($defaultVAR[6], $defaultVAR[15], $defaultVAR[16]);

		} elseif ($id <= 26) {

			$variables = array($defaultVAR[0], $defaultVAR[22], $defaultVAR[4], $defaultVAR[6]);

		} else if ($id == 27) {

			$variables = array($defaultVAR[0], $defaultVAR[22], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6]);

		} else if ($id == 35){

			$variables = array($defaultVAR[0], $defaultVAR[22], $defaultVAR[4], $defaultVAR[6]);

		} else if ($id == 36){
			
			$variables = array($defaultVAR[0], $defaultVAR[7], $defaultVAR[22], $defaultVAR[4], $defaultVAR[6], $defaultVAR[5]);
			
		} else {
			$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6]);
		}

	}

?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	
    <head>
    
    	<title><?=system_showText(LANG_SITEMGR_HOME_WELCOME)?></title>

        <meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
        
		<style type="text/css">
			body
			{
				position: relative;
			}
			div
			{
				width: auto;
				margin: 0px;
				padding: 0px;
			}
			.default_title
			{
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 10pt;
				font-weight: bold;
				color: #003365;
				clear: both;
				width: 500px;
				padding: 10px;
			}
			.default_text_settings 
			{
				font-family: Verdana, Arial, Sans-Serif;
				font-size: 8pt;
				color: #3B4B5B;
				text-align: justify;
				margin-top: 10px;
				background: #FBFBFB;
				border: 1px solid #E9E9E9;
			}
			.default_text_settings th
			{
				text-align: right;
				vertical-align: top;
			}
			.default_text
			{
				font-family: Verdana, Arial, Sans-Serif;
				font-size: 8pt;
				color: #3B4B5B;
				text-align: justify;
				float: left;
				width: 450px;
			}
			.default_button 
			{
				float: right;
			}
		</style>

	</head>

	<body>

		<div>
			<div class="default_text">
				<?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_HELP_USEVARIABLES)?>
			</div>
			<div class="default_title">
				<?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_HELP_VARIABLESDESCRIPTION)?>
			</div>
		</div>
		<div>
			<table border="0" cellpadding="2" cellspacing="2" class="default_text_settings">
			<? if ($variables) { ?>
				<? foreach ($variables as $var) { ?>
					<tr>
						<th><?=$var["variable"]?></th>
						<td><?=$var["description"]?></td>
					</tr>
				<? } ?>
			<? } ?>
			</table>
		</div>
	</body>

	</html>
