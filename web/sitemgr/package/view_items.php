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
	# * FILE: /sitemgr/package/view_items.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { header("Location:".DEFAULT_URL."/sitemgr");exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) { header("Location:".DEFAULT_URL."/sitemgr");exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/package";
	$url_base = "".DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------	

	$packageItems = false;

	if (!$items && !$items_price) { exit; }

	$package = new Package($id);

	$packageItems = true;

	$packagePaymentItems = $items;
	$packagePaymentPrices = $items_price;

	$packagePaymentItems = explode("\n", $packagePaymentItems);
	$packagePaymentPrices = explode("\n", $packagePaymentPrices);

	$str_price = "";
	foreach($packagePaymentPrices as $price){
		$str_price .= CURRENCY_SYMBOL." ".format_money($price)."<br />";
	}


	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

?>

<html>

	<head>

		<? $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>
		<title><?=system_showText(LANG_SITEMGR_HOME_WELCOME) . " - " . $headertag_title?></title>

		<? $headertag_author = (($headertag_author) ? ($headertag_author) : ("Arca Solutions")); ?>
		<meta name="author" content="<?=$headertag_author?>" />

		<? $headertag_description = (($headertag_description) ? ($headertag_description) : (EDIRECTORY_TITLE)); ?>
		<meta name="description" content="<?=$headertag_description?>" />

		<? $headertag_keywords = (($headertag_keywords) ? ($headertag_keywords) : (EDIRECTORY_TITLE)); ?>
		<meta name="keywords" content="<?=$headertag_keywords?>" />

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />

		<meta name="ROBOTS" content="index, follow" />

		<link href="<?=DEFAULT_URL?>/sitemgr/layout/general_sitemgr.css" rel="stylesheet" type="text/css" />

		<style type="text/css" media="all"> 

			/* CSS DIFFERENCES - GLOBAL DEFINITIONS */

			body { margin-top: 10px; background-color: #FFFFFF; text-align: center; } 

			.link-table:link,
			.link-table:active,
			.link-table:visited,
			.link-table:hover
			{
				font: normal 10px Verdana, Arial, Helvetica, sans-serif;
				color: #3B4B5B;
				text-align: left;
				text-decoration: none;
			}

			.link-table:hover
			{
				text-decoration: underline;
			}
			
			h1 {font: normal 18px Arial, Helvetica, sans-serif; color: #000; text-align: left; padding: 0 15px 15px 15px;}
			
			h2 {font: bold 12px Verdana, Arial, Verdana, Helvetica, sans-serif Arial, Helvetica, sans-serif; text-align: left; color: #003F7E; padding-bottom: 10px; padding-left: 8px; margin: 0 5px 0 20px; background: #FFF; border: 0; border-bottom: 1px solid #EEE; margin-bottom:10px;}
			
			ul.basePreviewNavbar{height: 30px; padding: 0; margin: 0 0 10px 0; background: #FBFBFB; border: 1px solid #EEE;}
			
				ul.basePreviewNavbar li{list-style: none; float: right;}
				
				ul.basePreviewNavbar li a:link,
				ul.basePreviewNavbar li a:active,
				ul.basePreviewNavbar li a:visited,
				ul.basePreviewNavbar li a:hover{background: url("../../images/icon_delete.gif") 94% 50% no-repeat; font: normal 10px Arial, Helvetica, sans-serif; color: #000; display: block; padding: 8px 30px 8px 10px; border: 0;}
				
					ul.basePreviewNavbar li a:hover{color: #9B350C;}

		</style>

	</head>

	<body>

	<? if($packagePaymentItems){ ?>

		<h1><?=string_ucwords(system_showText(LANG_SITEMGR_PACKAGE_SING))?> <?=system_showText(LANG_SITEMGR_TITLE)?>: <?=$package->getString("title");?></h1>

		<h2><?=string_ucwords(system_showText(LANG_SITEMGR_PACKAGE_SING))?> <?=system_showText(LANG_SITEMGR_ITEMS)?></h2>

		<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
			<tr>
				<th><?=system_showText(LANG_SITEMGR_LABEL_DESCRIPTION)?></th>
				<th style="width:70px;"><?=system_showText(LANG_SITEMGR_LABEL_PRICE)?></th>
			</tr>
			<?
			if ($packagePaymentItems && $packagePaymentPrices) {
				foreach ($packagePaymentItems as $key => $each_item) {
				?>
					<tr>
						<td><?=$each_item?></td>
						<? if ($key != 0) { ?>
						<td><?=$str_price?></td>
						<? } ?>
					</tr>
				<?
				}
			}
			?>
		</table>

	<? } else { ?>
			<p class="informationMessage"><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_NOITEMSFOUND)?></p>
	<? } ?>

	</body>

</html>