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
	# * FILE: /sitemgr/domain/index.php
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

	$url_redirect = "".DEFAULT_URL."/sitemgr/domain";
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	extract($_GET);
	extract($_POST);

	//increases frequently actions
	if (!isset($message)) system_setFreqActions('domain_manage','domain');

	# ----------------------------------------------------------------------------------------------------
	# SUPORT EMAIL
	# ----------------------------------------------------------------------------------------------------
	if (is_numeric($_GET["domain_id"]) && $_GET["domain_id"] > 0) {

		setting_get("sitemgr_email",$sitemgr_email);
		$support_email = EDIR_SUPPORT_EMAIL;

		$domainObj = new Domain($_GET["domain_id"]);
		if ($domainObj->getNumber("id") != 0 && $domainObj->getString("status") == "P") {
			$support_msg = "
				<html>
					<head>
						<style>
							.email_style_settings{
								font-size:12px;
								font-family:Verdana, Arial, Sans-Serif;
								color:#000;
							}
						</style>
					</head>
					<body>
						<div class=\"email_style_settings\">
							Support Team,<br /><br />
							A new domain was created in ".DEFAULT_URL.".<br /><br />";
							$support_msg .= "<b>Domain Name: </b>".$domainObj->getString("name")."<br />";
							$support_msg .= "<b>Domain URL: </b>".$domainObj->getString("url")."<br />";
							$support_msg .= "<b>Database Host: </b>".$domainObj->getString("database_host")."<br />";
							if ($domainObj->getString("database_port")) {
								$support_msg .= "<b>Database Port: </b>".$domainObj->getString("database_port")."<br />";
							}
							$support_msg .= "<b>Database Username: </b>".$domainObj->getString("database_username")."<br />";
							$support_msg .= "<b>Database Password: </b>".$domainObj->getString("database_password")."<br />";
							$support_msg .= "<b>Database Name: </b>".$domainObj->getString("database_name")."<br />";
							$support_msg .= "<b>Article Feature: </b>".$domainObj->getString("article_feature")."<br />";
							$support_msg .= "<b>Banner Feature: </b>".$domainObj->getString("banner_feature")."<br />";
							$support_msg .= "<b>Classified Feature: </b>".$domainObj->getString("classified_feature")."<br />";
							$support_msg .= "<b>Event Feature: </b>".$domainObj->getString("event_feature")."<br />";
							$support_msg .= "<br /><br />";
							$support_msg .= "Please, schedule the server settings so the new domain start work. <br /><br />
							Regards,<br />
							The ".EDIRECTORY_TITLE." team<br /><br />
						</div>
					</body>
				</html>";
			system_mail($support_email, "[".EDIRECTORY_TITLE."] New Domain Created", $support_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
			$domainObj->ActiveDomain();
			unset($domainObj);
		}
	}

	// Page Browsing /////////////////////////////////////////
	unset($pageObj);
	$pageObj  = new pageBrowsing("Domain", $screen, RESULTS_PER_PAGE, "name", "name", $letter, "status='A'", "*", false, false, true);

	$domains = $pageObj->retrievePage();


	$paging_url = DEFAULT_URL."/sitemgr/domain/index.php";

	// Letters Menu
	$letters = $pageObj->getString("letters");
	foreach ($letters as $each_letter) {
		if ($each_letter == "#") {
			$letters_menu .= "<a href=\"$paging_url?letter=no\" ".(($letter == "no") ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
			//$letters_menu .= "<a href=\"$paging_url\" ".((!$letter) ? "class=\"firstLetter\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		} else {
			$letters_menu .= "<a href=\"$paging_url?letter=".$each_letter."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		}
	}

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

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
				<h1><?=string_ucwords(system_showText(LANG_SITEMGR_DOMAIN_PLURAL))?></h1>
			</div>
		</div>
		<div id="content-content">
			<div class="default-margin">

				<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<? include(INCLUDES_DIR."/tables/table_domain_submenu.php"); ?>
				<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_DOMAIN_TIP);?>&nbsp;<br />
					<a href="http://edirectory.com/orders/" title="eDirectory Order" target="_blank">
						<?=system_showText(LANG_SITEMGR_DOMAIN_TIPLINK);?>
					</a><br />
					<a href="<?=DEFAULT_URL;?>/sitemgr/faq/faq.php?keyword=<?=urlencode("create a new site");?>" target="_blank">
						<?=system_showText(LANG_SITEMGR_DOMAIN_TIPFAQ);?>
					</a>
				</p>

				<? if ($domains) { ?>
					<? include(INCLUDES_DIR."/tables/table_domain.php"); ?>
				<? } else { ?>
					<p class="informationMessage">
						<?=system_showText(LANG_SITEMGR_DOMAIN_NORECORDS)?>
					</p>
				<? } ?>
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