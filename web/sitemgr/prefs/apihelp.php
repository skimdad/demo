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
	# * FILE: /sitemgr/prefs/apihelp.php
	# ----------------------------------------------------------------------------------------------------

    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
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
	# DEFAULT
	# ----------------------------------------------------------------------------------------------------
	$defaultVAR = array	(
		0	=>	array("variable" => "* key",          "description" => system_showText(LANG_SITEMGR_API_VAR_KEY)),
		1	=>	array("variable" => "* module",       "description" => system_showText(LANG_SITEMGR_API_VAR_MODULE)),
		2	=>	array("variable" => "* keyword",      "description" => system_showText(LANG_SITEMGR_API_VAR_KEYWORD)),
		3	=>	array("variable" => "where",        "description" => system_showText(LANG_SITEMGR_API_VAR_WHERE)),
		4	=>	array("variable" => "lang",         "description" => system_showText(LANG_SITEMGR_API_VAR_LANG)),
		5	=>	array("variable" => "screen",		"description" => system_showText(LANG_SITEMGR_API_VAR_SCREEN)),
		6	=>	array("variable" => "letter",		"description" => system_showText(LANG_SITEMGR_API_VAR_LETTER))
	);

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
				margin-top: 10px;
				background: #FBFBFB;
				border: 1px solid #E9E9E9;
			}
			.default_text_settings th
			{
				text-align: right;
				vertical-align: top;
                width: 80px;
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
            
            .informationMessage
            {
                font-family: Arial, Verdana, sans-serif; 
                font-size: 11px; 
                line-height: 18px; 
                text-align: left; 
                margin: 10px 20px 10px 20px; 
                padding: 15px 15px 15px 45px !important;
                -moz-border-radius:6px; 
                -webkit-border-radius:6px; 
                border-radius:6px;
                display: block;
                background:#DAEFFB url(../../images/icon-message-info.gif) no-repeat 15px 18px; 
                border:1px solid #8FBFDA; 
                clear: both; 
                color:#0B3249;
            }
		</style>

	</head>

	<body>

		<div>
			<div class="default_text">
				<?=system_showText(LANG_SITEMGR_API_HELP_USEPARAMETERS)?>
			</div>
			<div class="default_title">
				<?=system_showText(LANG_SITEMGR_API_HELP_PARAMETERSDESCRIPTION)?>
			</div>
		</div>
		<div>
			<table border="0" cellpadding="2" cellspacing="2" class="default_text_settings">
			<? if ($defaultVAR) { ?>
				<? foreach ($defaultVAR as $var) { ?>
					<tr>
						<th><?=$var["variable"]?></th>
						<td><?=$var["description"]?></td>
					</tr>
				<? } ?>
			<? } ?>
			</table>
            <p class="informationMessage">* <?=system_showText(LANG_LABEL_REQUIRED_FIELD)?>.</p>
		</div>
	</body>

	</html>