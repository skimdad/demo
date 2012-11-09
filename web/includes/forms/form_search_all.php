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
	# * FILE: /includes/forms/form_search_all.php
	# ----------------------------------------------------------------------------------------------------


?>


	<select name="searchFor" id="QS_searchFor">
		<option value="All"><?=system_showText(string_ucwords(LANG_SITEMGR_ALL))?></option>

		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
			<option value="listing" <?=($searchFor == "listing" ? "selected" : "")?>><?=system_showText(string_ucwords(LANG_SITEMGR_LISTING_PLURAL))?></option>
		<? } ?>
		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BANNERS)) { ?>
				<? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
					<option value="banner"><?=system_showText(string_ucwords(LANG_SITEMGR_BANNER_PLURAL))?></option>
			<? } ?>
		<? } ?>
		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_EVENTS)) { ?>
			<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
				?>
				<option value="event"><?=system_showText(string_ucwords(LANG_SITEMGR_NAVBAR_EVENT))?></option>
			<? } ?>
		<? } ?>
		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS)) { ?>
				<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
					<option value="classified"><?=system_showText(string_ucwords(LANG_SITEMGR_CLASSIFIED_PLURAL))?></option>
			<? } ?>
		<? } ?>
		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES)) { ?>
				<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
					<option value="article"><?=system_showText(string_ucwords(LANG_SITEMGR_ARTICLE_PLURAL))?></option>
			<? } ?>
		<? } ?>
		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
			<? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on") { ?>
				<option value="promotion"><?=system_showText(string_ucwords(LANG_SITEMGR_PROMOTION_PLURAL))?></option>
			<? } ?>
		<? } ?>
        <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BLOG)) { ?>
				<? if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") { ?>
                <option value="blog"><?=system_showText(string_ucwords(LANG_SITEMGR_POST_BLOG_PLURAL))?> (<?=system_showText(string_ucwords(LANG_SITEMGR_BLOG))?>)</option>
				<? } ?>
		<? } ?>
		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ACCOUNTS)) { ?>
			<option value="account"><?=(SOCIALNETWORK_FEATURE == "on" ? string_ucwords(system_showText(LANG_SITEMGR_LABEL_SPONSOR)) : string_ucwords(system_showText(LANG_SITEMGR_MEMBERS)))?></option>
			<option value="smaccount"><?=system_showText(LANG_SITEMGR_NAVBAR_SITEMGRACCOUNTS)?></option>
		<? } ?>
		<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PAYMENT)) { ?>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on") || (MANUALPAYMENT_FEATURE == "on")) { ?>
					<? if ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) { ?>
						<option value="transaction"><?=system_showText(LANG_SITEMGR_TRANSACTIONS)?></option>
					<? } ?>
					<? if (INVOICEPAYMENT_FEATURE == "on") { ?>
						<option value="invoice"><?=string_ucwords(system_showText(LANG_SITEMGR_INVOICE_PLURAL))?></option>
					<? } ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<? if (CUSTOM_INVOICE_FEATURE == "on") { ?>
							<option value="custominvoice"><?=string_ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE_PLURAL))?></option>
						<? } ?>
					<? } ?>
				<? } ?>
			<? } ?>
		<? } ?>

	</select>


	