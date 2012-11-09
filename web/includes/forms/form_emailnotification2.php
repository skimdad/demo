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
	# * FILE: /includes/forms/form_emailnotification2.php
	# ----------------------------------------------------------------------------------------------------

?>

	<script>
		function JS_Back() {
			document.emailnotifications.nav_page.value = 0;
			document.emailnotifications.submit();
		}
	</script>

	<input type="hidden" name="lang" value="<?=$lang?>" />
	<input type="hidden" name="content_type" value="<?=$content_type?>" />
	<input type="hidden" name="bcc" value="<?=$bcc?>" />
	<input type="hidden" name="subject" value="<?=$subject?>" />
	<input type="hidden" name="body" value="<?=$body?>" />
	<? if ($id == 36){
	
		foreach ($levelValue as $value) { ?>
	
		<input type="hidden" name="email_traffic_listing_<?=$value?>" value="<?=${"email_traffic_listing_".$value}?>">
		
		<? }
		
	} ?>
	<?
	if ($deactivate) {
		echo "<input type=\"hidden\" name=\"deactivate\" value=\"1\" >\n";
	} else {
		echo "<input type=\"hidden\" name=\"deactivate\" value=\"\" >\n";
	}
	?>

	<?

	$style_1 = "style='font-family: Verdana, Arial, Sans-Serif;font-size: 8pt;color: #3B4B5B;text-align: left;'";
	$style_2 = "style='font-family: Verdana, Arial, Sans-Serif;font-size: 10pt;color: #000000;text-align: left;'";

	if ($content_type == "text/plain") {
		$body = str_replace("&quot;", "\"", $body);
		$body = "<div class=\"email-content\" $style_2>".nl2br(htmlspecialchars($body))."</div>";
	}

	setting_get("sitemgr_email",$sitemgr_email);
	list($sitemgr_emails) = explode(",",$sitemgr_email);

	customtext_get("payment_tax_label", $payment_tax_label, $_POST["lang"]);
	$domain = new Domain(SELECTED_DOMAIN_ID);

	//body message
	
	$body = str_replace("ACCOUNT_NAME", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_NAME), $body);
	$body = str_replace("LISTING_TITLE", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_LISTING_TITLE), $body);
	$body = str_replace("EVENT_TITLE", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_EVENT_TITLE), $body);
	$body = str_replace("BANNER_TITLE", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_BANNER_TITLE), $body);
	$body = str_replace("CLASSIFIED_TITLE", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_CLASSIFIED_TITLE), $body);
	$body = str_replace("ARTICLE_TITLE", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ARTICLE_TITLE), $body);
	$body = str_replace("LISTING_RENEWAL_DATE", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_LISTING_RENEWAL_DATE), $body);
	$body = str_replace("ACCOUNT_USERNAME", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_USERNAME), $body);
	$body = str_replace("ACCOUNT_PASSWORD", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_PASSWORD), $body);
	$body = str_replace("ACCOUNT_LOGIN_INFORMATION", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_LOGIN_INFORMATION), $body);
	$body = str_replace("ACCOUNT_NUMBER", "xxx", $body);
	$body = str_replace("KEY_ACCOUNT", "<a href=\"".DEFAULT_URL."/members/login.php?key=7wjw84w93iussdiwsieosw\" class=\"email_style_settings\">".DEFAULT_URL."/members/login.php?key=7wjw84w93iussdiwsieosw</a>", $body);
	$body = str_replace("CUSTOM_INVOICE_AMOUNT", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_CUSTOMINVOICE_AMOUNT), $body);
	$body = str_replace("CUSTOM_INVOICE_TAX", "+ ".$payment_tax_label, $body);

	$body = str_replace("SITEMGR_EMAIL", $sitemgr_email, $body);
	$body = str_replace("EDIRECTORY_TITLE", EDIRECTORY_TITLE, $body);
	$body = str_replace("EDIRECTORY_TITLE", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_EDIRECTORYTITLE), $body);
	$body = str_replace("DIRECTORY_TITLE", EDIRECTORY_TITLE, $body);
	$body = str_replace("DEFAULT_URL", DEFAULT_URL, $body);
	$body = str_replace($_SERVER["HTTP_HOST"], $domain->getString("url"), $body);
	$body = str_replace("DAYS_INTERVAL", $days, $body);

	$body = str_replace("ITEM_TITLE", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ITEM_TITLE), $body);
	$body = str_replace("ITEM_URL", DEFAULT_URL."/item/title.html", $body);
	
	if ($id == 36){
		/*
		 * Prepare table with stats to listing
		 */    
		$data_email = retrieveListingReport(0);
		$table = report_PrepareListingStatsReviewToEmail($data_email, 0, "listing");
		$body = str_replace("[TABLE_STATS]", $table, $body);

	}

	//subject message
	$subject = str_replace("ACCOUNT_NAME", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_NAME), $subject);
	$subject = str_replace("LISTING_TITLE", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_LISTING_TITLE), $subject);
	$subject = str_replace("EVENT_TITLE", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_EVENT_TITLE), $subject);
	$subject = str_replace("BANNER_TITLE", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_BANNER_TITLE), $subject);
	$subject = str_replace("CLASSIFIED_TITLE", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_CLASSIFIED_TITLE), $subject);
	$subject = str_replace("ARTICLE_TITLE", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ARTICLE_TITLE), $subject);
	$subject = str_replace("LISTING_RENEWAL_DATE", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_LISTING_RENEWAL_DATE), $subject);
	$subject = str_replace("ACCOUNT_USERNAME", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_USERNAME), $subject);
	$subject = str_replace("ACCOUNT_PASSWORD", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_PASSWORD), $subject);

	$subject = str_replace("SITEMGR_EMAIL", $sitemgr_email, $subject);
	$subject = str_replace("EDIRECTORY_TITLE", EDIRECTORY_TITLE, $subject);
	$subject = str_replace("EDIRECTORY_TITLE",system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_EDIRECTORYTITLE), $subject);
	$subject = str_replace("DIRECTORY_TITLE", EDIRECTORY_TITLE, $subject);
	$subject = str_replace("DEFAULT_URL", DEFAULT_URL, $subject);
	$subject = str_replace("DAYS_INTERVAL", $days, $subject);
	$subject = str_replace($_SERVER["HTTP_HOST"], $domain->getString("url"), $subject);
	$subject = str_replace("ITEM_TITLE", system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ITEM_TITLE), $subject);
	$subject = str_replace("ITEM_URL", DEFAULT_URL."/item/title.html", $subject);

	$from = $sitemgr_email;
	$to = system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_EMAIL);
        
	?>

	<input type="hidden" name="clang" value="<?=$clang;?>" />
	<table cellpadding="0" cellspacing="2">
	<tr><td><span <?=$style_1?>><?=system_showText(LANG_SITEMGR_LABEL_FROM)?>: </span></td><td><span <?=$style_2?>><?=$from?></span></td></tr>
	<tr><td><span <?=$style_1?>><?=system_showText(LANG_SITEMGR_LABEL_TO)?>:   </span></td><td><span <?=$style_2?>><?=$to?></span></td></tr>
	<tr><td><span <?=$style_1?>><?=system_showText(LANG_SITEMGR_LABEL_BCC)?>:  </span></td><td><span <?=$style_2?>><?=$bcc?></span></td></tr>
	<tr><td><span <?=$style_1?>><?=system_showText(LANG_SITEMGR_LABEL_SUBJECT)?>:  </span></td><td><span <?=$style_2?>><?=$subject?></span></td></tr>
	<tr><td colspan="2"><div style="overflow:auto; width: 510px; margin: 10px auto 0 auto; border: 1px solid #EEE;"><?=$body?></div></td></tr>
	</table>
