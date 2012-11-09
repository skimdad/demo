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
	# * FILE: /includes/tables/table_listing.php
	# ----------------------------------------------------------------------------------------------------

	setting_get('commenting_edir', $commenting_edir);
	setting_get('commenting_fb', $commenting_fb);
	setting_get("review_listing_enabled", $review_enabled);
?>
<script type="text/javascript">
	function getValuesBulkListing(){

		if(document.getElementById('change_no_owner').value == "on"){
			document.getElementById("account_search_bulk").value = "0";
		}else if (document.getElementById("change_account_id")) {
			document.getElementById("account_search_bulk").value = document.getElementById("change_account_id").value;
		}
		
		if (document.getElementById("level_bulk").value) {
			document.getElementById("level_bulk").value = document.getElementById("level").value;
		}
		
		if (document.getElementById('delete_all').checked){
			document.getElementById("bulkSubmit").value = "Submit";
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','listing_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		} else {
			document.getElementById("bulkSubmit").value = "Submit";
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','listing_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		}
	}

	function confirmBulk(){
    
        <? if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") { ?>
            feed = document.listing_setting.feed;
            return_categories = document.listing_setting.return_categories;
            if(return_categories.value.length > 0) return_categories.value="";

            for (i=0;i<feed.length;i++) {
                if (!isNaN(feed.options[i].value)) {
                    if(return_categories.value.length > 0)
                    return_categories.value = return_categories.value + "," + feed.options[i].value;
                    else
                return_categories.value = return_categories.value + feed.options[i].value;
                }
            }   
        <? } ?>
    
		if (document.getElementById('delete_all').checked){
			document.getElementById("bulkSubmit").value = "Submit";
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','listing_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		} else {
			document.getElementById("bulkSubmit").value = "Submit";
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','listing_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		}
	}
</script>
<?
$level = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
$levelvalues = $level->getLevelValues();

$itemCount = count($listings);
?>

<? if(is_numeric($messageBacklink) && isset($msg_listing[$messageBacklink])) { ?>
    <p class="<?=$messageBacklink == 10 ? "successMessage" : "errorMessage"?>"><?=$msg_listing[$messageBacklink]?></p>
<? } ?>

<? if(is_numeric($message) && isset($msg_listing[$message])) { ?>
    <p class="successMessage"><?=$msg_listing[$message]?></p>
<? } elseif (is_numeric($message_gallery) && isset($msg_gallery[$message_gallery])) { ?>
    <p class="successMessage"><?=$msg_gallery[$message_gallery]?></p>
<? } elseif (is_numeric($message_maptunning) && isset($msg_maptunning[$message_maptunning])) { ?>
    <p class="successMessage"><?=$msg_maptunning[$message_maptunning]?></p>
<? } ?>

<?
if ($extramessage_promotion && PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on") {
	echo "<p class=\"informationMessage\">".system_showText(LANG_LISTING_CLICK_PROMOTION_BELOW)." <em>".system_showText(LANG_LISTING_PROMOTION_ICON)."</em> <img src=\"".DEFAULT_URL."/images/icon_promo.gif\" border=\"0\" /> ".system_showText(LANG_LISTING_IFYOUWISHADDPROMOTION)."</p>";
}
?>

<?

if (is_numeric($error_message)) {
	echo "<p class=\"errorMessage\">".$msg_bulkupdate[$error_message]."</p>";
} elseif ($error_msg) {
	echo "<p class=\"errorMessage\">".$error_msg."</p>";
} elseif ($msg == "success") {
	echo "<p class=\"successMessage\">".LANG_MSG_LISTING_SUCCESSFULLY_UPDATE."</p>";
} elseif ($msg == "successdel") {
	echo "<p class=\"successMessage\">".LANG_MSG_LISTING_SUCCESSFULLY_DELETE."</p>";
}
unset($msg);

if ((!string_strpos($_SERVER["PHP_SELF"], "sitemgr/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))){?>
	<? if (string_strpos($url_base, "/sitemgr")) { ?>
		<table class="bulkTable" border="0" cellpadding="2" cellspacing="2" >
			<tr>
				<td><a class="bulkUpdate" href="javascript:void(0)" onclick="showBulkUpdate( <?=RESULTS_PER_PAGE?>, 'listing', '<?=system_showText(LANG_SITEMGR_CLOSE_BULK);?>', '<?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>')" id="open_bulk"><?=system_showText(LANG_SITEMGR_BULK_UPDATE);?></a></td>
			</tr>
		</table>
	<? } ?>
	
	<?
	if (string_strpos($_SERVER["PHP_SELF"], "/sitemgr/listing/search") !== false) {
		$actionBulk = system_getFormAction($_SERVER["REQUEST_URI"]);
	} else {
		$actionBulk = system_getFormAction($_SERVER["PHP_SELF"]);
	}
	?>
	
	<form name="listing_setting" id="listing_setting" action="<?=$actionBulk?>" method="post">
		<input type="hidden" name="account_search_bulk" id="account_search_bulk" value="" />
		<input type="hidden" name="level_bulk" id="level_bulk" value="" />
		<input type="hidden" name="bulkSubmit" id="bulkSubmit" value="" />
		<div id="table_bulk" style="display: none">
			<? include(INCLUDES_DIR."/tables/table_bulkupdate.php");
			if (string_strpos($_SERVER["PHP_SELF"], "search.php") == true) { ?>
				<button type="button" id="bulkSubmit" name="bulkSubmit" value="Submit" class="input-button-form" onclick="javascript:getValuesBulkListing();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
			<? } else { ?>
				<button type="button" name="bulkSubmit" value="Submit" class="input-button-form" onclick="javascript:confirmBulk();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
			<? } ?>
		</div>
		<div id="idlist"></div>
	</form>
		<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

		<div id="bulk_check" style="display:none">
			<table class="bulkTable" border="0" cellpadding="2" cellspacing="2">
				<tr>
					<th><input type="checkbox" id="check_all" name="check_all" onclick="checkAll('listing', document.getElementById('check_all'), false, <?=$itemCount;?>); removeCategoryDropDown('listing', '<?=DEFAULT_URL?>');" /></th>
					<td><a class="CheckUncheck" href="javascript:void(0);" onclick="checkAll('listing', document.getElementById('check_all'), true, <?=$itemCount;?>); removeCategoryDropDown('listing', '<?=DEFAULT_URL?>');"><?=system_showText(LANG_CHECK_UNCHECK_ALL);?></a></td>
				</tr>
			</table>
		</div>
<?}?>

<? if ((!isset($legend))||($legend)) { ?>
	<ul class="standard-iconDESCRIPTION">
		<?
		foreach ($levelvalues as $levelvalue) {
			if ($level->getActive($levelvalue) == 'y') {
				?><li style="background: url(<?=DEFAULT_URL?>/images/img_<?=$levelvalue?>.gif) no-repeat 0 50%; padding-left: 35px;"><?=$level->showLevel($levelvalue)?></li><?
			}
			if ( $level->getHasPromotion($levelvalue) == 'y' ) $hasPromotion = true;
			if ( $level->getHasMobileApp($levelvalue) == 'y' ) $hasMobileApp = true;
		}
		?>
	</ul>
	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
		<li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT);?></li>

		<?
			if ( PROMOTION_FEATURE == 'on' && CUSTOM_PROMOTION_FEATURE == "on" )
			if ( $hasPromotion ) {
		?>
			<li class="promotion-icon"><?=system_showText(LANG_PROMOTION_FEATURE_NAME);?></li>
		<? } ?>
		<li class="traffic-icon"><?=system_showText(LANG_TRAFFIC_REPORTS);?></li>
		<li class="map-icon"><?=system_showText(LANG_LABEL_MAP_TUNING);?></li>
		<li class="seo-icon"><?=system_showText(LANG_LABEL_SEO_TUNING);?></li>
		<? if (($review_enabled == "on" && $commenting_edir) || string_strpos($url_base, "/sitemgr")) { ?>
			<li class="rating-icon"><?=system_showText(LANG_REVIEW);?></li>
		<? } ?>
	</ul>

	<ul class="standard-iconDESCRIPTION">
		<? if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on") { ?>
			<li class="call-icon"><?=system_showText(LANG_LABEL_CLICKTOCALL);?></li>
		<? } ?>
		<? if ($commenting_fb == "on") { ?>
			<li class="facebook-icon"><?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS);?></li>
		<? } ?>
        <? if (BACKLINK_FEATURE == "on"){ ?> 
            <li class="backlink-icon"><?=system_showText(LANG_LABEL_BACKLINK);?></li>
        <? } ?>
		<? if (string_strpos($url_base, "/sitemgr")) { ?>
			<? if ( PAYMENTSYSTEM_FEATURE == "on" ) { ?>
				<li class="unpaid-icon"><?=system_showText(LANG_LABEL_UNPAID);?></li>
				<li class="unpaid-icon-off"><?=system_showText(LANG_LABEL_PAID);?></li>
				<li class="transaction-icon"><?=system_showText(LANG_LABEL_TRANSACTION);?></li>
			<? } ?>
			<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
		<? } ?>
	</ul>

<? } ?>

	<form name="item_table">
		<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

		<tr>
			<th style="width: auto;"><?=system_showText(LANG_LISTING_TITLE);?></th>
			<th style="width: 40px;"><?=system_showText(LANG_LABEL_LEVEL);?></th>
			<? if (string_strpos($url_base, "/sitemgr")) { ?>
				<th style="width: 90px;"><?=system_showText(LANG_LABEL_ACCOUNT);?></th>
			<? } else { ?>
				<th style="width: 70px;"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
			<? } ?>
			<th style="width: 100px;"><?=system_showText(LANG_LABEL_STATUS);?></th>
			<? if (string_strpos($url_base, "/sitemgr")) { ?>
				<th style="width: 22%;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
			<? } else { ?>
				<th style="width: 25%;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
			<? } ?>
		</tr>

		<?
		$hascharge = false;
		$hastocheckout = false;
		$cont = 0;

		if ($listings) foreach ($listings as $listing) {
			$listing = new Listing($listing->getNumber("id"));
			$cont++;
			$id = $listing->getNumber("id");
			$listingImages = $level->getImages($listing->getNumber("level"));
			$listingHasPromotion = $level->getHasPromotion($listing->getNumber("level"));
			$listingHasMobileApp = $level->getHasMobileApp($listing->getNumber("level"));
			$listingHasClickToCall = $level->getHasCall($listing->getNumber("level"));
			$listingHasDetail = $level->getDetail($listing->getNumber("level"));
			$listingHasBacklink = $level->getBacklink($listing->getNumber("level"));
			if ($listing->needToCheckOut()) {
				if ($listing->getPrice() > 0) $hascharge = true;
				$hastocheckout = true;
			}

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

			// ---------------- //

			$sql = "SELECT payment_log_id FROM Payment_Listing_Log WHERE listing_id = $id ORDER BY renewal_date DESC LIMIT 1";
			$r = $db->query($sql);
			$aux_transaction_data = mysql_fetch_assoc($r);

			if($aux_transaction_data) {
				$sql = "SELECT id,transaction_datetime FROM Payment_Log WHERE id = {$aux_transaction_data["payment_log_id"]}";
				$r = $db->query($sql);
				$transaction_data = mysql_fetch_assoc($r);
			} else {
				unset($transaction_data);
			}

			// ---------------- //

			$sql = "SELECT IL.invoice_id,IL.listing_id,I.id,I.status,I.payment_date FROM Invoice I,Invoice_Listing IL WHERE IL.listing_id = $id AND I.status = 'R' AND I.id = IL.invoice_id ORDER BY I.payment_date DESC LIMIT 1";
			$r = $db->query($sql);
			$invoice_data = mysql_fetch_assoc($r);

			// ---------------- //

			list($t_month,$t_day,$t_year)     = explode("/",format_date($transaction_data["transaction_datetime"],DEFAULT_DATE_FORMAT,"datetime"));
			list($i_month,$i_day,$i_year)     = explode("/",format_date($invoice_data["payment_date"],DEFAULT_DATE_FORMAT,"datetime"));
			list($t_hour,$t_minute,$t_second) = explode(":",format_date($transaction_data["transaction_datetime"],"H:i:s","datetime"));
			list($i_hour,$i_minute,$i_second) = explode(":",format_date($invoice_data["payment_date"],"H:i:s","datetime"));

			$t_ts_date = mktime((int)$t_hour,(int)$t_minute,(int)$t_second,(int)$t_month,(int)$t_day,(int)$t_year);
			$i_ts_date = mktime((int)$i_hour,(int)$i_minute,(int)$i_second,(int)$i_month,(int)$i_day,(int)$i_year);

			if (PAYMENT_FEATURE == "on") {
				if (((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) && (INVOICEPAYMENT_FEATURE == "on")) {
					if($t_ts_date < $i_ts_date){
						if($invoice_data["id"]) $history_lnk = DEFAULT_URL."/sitemgr/invoices/view.php?id=".$invoice_data["id"];
						else unset($history_lnk);
					} else {
						if($transaction_data["id"]) $history_lnk = DEFAULT_URL."/sitemgr/transactions/view.php?id=".$transaction_data["id"];
						else unset($history_lnk);
					}
				} elseif ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) {
					if($transaction_data["id"]) $history_lnk = DEFAULT_URL."/sitemgr/transactions/view.php?id=".$transaction_data["id"];
					else unset($history_lnk);
				} elseif (INVOICEPAYMENT_FEATURE == "on") {
					if($invoice_data["id"]) $history_lnk = DEFAULT_URL."/sitemgr/invoices/view.php?id=".$invoice_data["id"];
					else unset($history_lnk);
				} else {
					unset($history_lnk);
				}
			} else {
				unset($history_lnk);
			}

			// ---------------- //

			$mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS);

			?>

			<tr>
				<td>
					<input type="checkbox" id="listing_id<?=$cont?>" name="item_check[]" value="<?=$id?>" class="inputCheck" style="display:none" onclick="removeCategoryDropDown('listing', '<?=DEFAULT_URL?>');"/>
					<a title="<?=$listing->getString("title");?>" href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<?=$listing->getString("title", true, 40);?>
					</a>
				</td>
				<td>
					<?
					$level = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
					$levelValues = $level->getLevelValues();
					$levelDefault = $level->getLevel($level->getDefaultLevel());
					$activeLevels = array();
					foreach ($levelValues as $levelValue) {
						if ($level->getActive($levelValue) == 'y') {
							$activeLevels[] = $levelValue;
						}
					}
					if (in_array($listing->getNumber("level"), $activeLevels)) $imgName = "img_".$listing->getNumber("level").".gif";
					else $imgName = "img_".$level->getDefaultLevel().".gif";
					?>
					<a href="<?=$url_redirect?>/listinglevel.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table"><img src="<?=DEFAULT_URL?>/images/<?=$imgName?>" alt="<?=(in_array($listing->getNumber("level"), $activeLevels)) ? $level->showLevel($listing->getNumber("level")) : string_ucwords($levelDefault)?>" title="<?=(in_array($listing->getNumber("level"), $activeLevels)) ? $level->showLevel($listing->getNumber("level")) : string_ucwords($levelDefault)?>" border="0" /></a>
				</td>
				<td>
					<? if (string_strpos($url_base, "/sitemgr")) { ?>
						<? if ($listing->getNumber("account_id")) {
							$account = db_getFromDB("account", "id", db_formatNumber($listing->getNumber("account_id")));
							?>
							<a title="<?=system_showAccountUserName($account->getString("username"))?>" href="<?=$url_base?>/account/view.php?id=<?=$listing->getNumber("account_id")?>" class="link-table">
								<?=$account->getString("username", true, 15);?>
							</a>
						<? } else { ?>
							<span title="<?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?>" style="cursor:default">
								<em><?=system_showTruncatedText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER, 15);?></em>
							</span>
						<? } ?>
					<? } else { ?>
						<?
						if ($listing->hasRenewalDate()) {
							$renewal_date = format_date($listing->getString("renewal_date"));
							if ($renewal_date) $date_field = $renewal_date;
							else $date_field = system_showText(LANG_LABEL_NEW);
						} else {
							$date_field = "---";
						}
						?>
						<span title="<?=$date_field?>" style="cursor:default"><?=$date_field;?></span>
					<? } ?>
				</td>
				<td>
					<?
					$changeStatus = true;
					$status = new ItemStatus();
					if ((!(string_strpos($url_base, "/sitemgr")))&&(($listing->getString("status")=="P")||($listing->getString("status")=="E")))
						$changeStatus = false; ?>
					<a title="<?=$status->getStatus($listing->getString("status"))?>" <? if ($changeStatus) { ?> href="<?=$url_redirect?>/settings.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" <? } else { ?> href="javascript:void(0);" style="cursor:default" <? } ?>  class="link-table"><?=$status->getStatusWithStyle($listing->getString("status"));?></a>
				</td>
				<td nowrap="nowrap">
					<?
					if (string_strpos($url_base, "/sitemgr") && PAYMENTSYSTEM_FEATURE == "on") {
						if ($listing->needToCheckOut()) {
							echo "<img src=\"".DEFAULT_URL."/images/icon_unpaid.gif\" border=\"0\" alt=\"".system_showText(LANG_MSG_UNPAID_ITEM)."\" title=\"".system_showText(LANG_MSG_UNPAID_ITEM)."\" />";
						} else {
							echo "<img src=\"".DEFAULT_URL."/images/icon_unpaid_off.gif\" border=\"0\" alt=\"".system_showText(LANG_MSG_NO_CHECKOUT_NEEDED)."\" title=\"".system_showText(LANG_MSG_NO_CHECKOUT_NEEDED)."\" />";
						}
					}
					?>
					<a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING)?>" />
					</a>

					<a href="<?=$url_redirect?>/listing.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_LISTING)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_LISTING)?>" />
					</a>

					<?
						if ( PROMOTION_FEATURE == 'on' && CUSTOM_PROMOTION_FEATURE == "on" )
						if ( $hasPromotion ) {
					?>
						<?if ($listingHasPromotion == "y") { ?>
							<a href="<?=$url_redirect?>/deal.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
								<img src="<?=DEFAULT_URL?>/images/icon_promo.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_CHANGE_PROMOTION);?>" title="<?=system_showText(LANG_MSG_CLICK_TO_CHANGE_PROMOTION);?>" />
							</a>
						<? } else { ?>
							<img src="<?=DEFAULT_URL?>/images/icon_promo_off.gif" border="0" alt="<?=ucfirst(LANG_MSG_PROMOTION_NOT_AVAILABLE);?>" title="<?=ucfirst(LANG_MSG_PROMOTION_NOT_AVAILABLE);?>" />
						<? } ?>
					<? } ?>

					<a href="<?=$url_redirect?>/report.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_traffic.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS)?>" />
					</a>

					<? if ((GOOGLE_MAPS_ENABLED == "on") && ($mapObj->getString("value") == "on") && (($listing->getString("address")) || ($listing->getNumber("location_3")) || ($listing->getNumber("location_4")  || ($listing->getString("latitude") && $listing->getString("longitude"))))) { ?>
						<a href="<?=$url_redirect?>/maptuning.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/icon_map.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING)?>" />
						</a>
					<? } else { ?>
						<img src="<?=DEFAULT_URL?>/images/icon_map_off.gif" border="0" alt="<?=system_showText(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING)?>" title="<?=system_showText(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING)?>" />
					<? } ?>

					<a href="<?=$url_redirect?>/seocenter.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_seo.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_SEOCENTER)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_SEOCENTER)?>" />
					</a>

					<?
					if (($review_enabled == "on" && $commenting_edir) || string_strpos($url_base, "/sitemgr")) {
						$dbMain = db_getDBObject(DEFAULT_DB, true);
						$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
						$sql ="SELECT * FROM Review WHERE item_type = 'listing' AND item_id = '".$listing->getString("id")."' LIMIT 1";
						$r = $db->query($sql);
						if(mysql_affected_rows() > 0) {
							?>
							<a href="<?=$url_base?>/review/index.php?item_type=listing&item_id=<?=$id?>&filter_id=1&item_screen=<?=$screen?>&item_letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
								<img src="<?=DEFAULT_URL?>/images/img_rateMiniStarOn.png" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS);?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS);?>" />
							</a>
							<?
						} else {
							?><img src="<?=DEFAULT_URL?>/images/img_rateMiniStarOff.png" border="0" alt="<?=system_showText(LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE);?>" title="<?=system_showText(LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE);?>" /><?
						}
					}
					?>
						
					<? if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on") { ?>
						<?if ($listingHasClickToCall == "y") { ?>
							<a href="<?=$url_redirect?>/clicktocall.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
								<img src="<?=DEFAULT_URL?>/images/icon-call-phone-small.gif" border="0" alt="<?=system_showText(LANG_LABEL_CLICKTOCALL)?>" title="<?=system_showText(LANG_LABEL_CLICKTOCALL)?>" />
							</a>
						<? } else { ?>
								<img src="<?=DEFAULT_URL?>/images/icon-call-phone-small-off.gif" border="0" alt="<?=ucfirst(LANG_MSG_CLICKTOCALL_NOT_AVAILABLE);?>" title="<?=ucfirst(LANG_MSG_CLICKTOCALL_NOT_AVAILABLE);?>" />
						<? } ?>
					<? } ?>
							
					<? if ($commenting_fb == "on") { ?>
						<? if ($listingHasDetail == "y") { ?>
						<a href="<?=$url_redirect?>/facebook.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/icon-facebook-comments.gif" border="0" alt="<?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS)?>" title="<?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS)?>" />
						</a>
						<? } else { ?>
							<img src="<?=DEFAULT_URL?>/images/icon-facebook-comments-off.gif" border="0" alt="<?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS_NOT_AVAILABLE)?>" title="<?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS_NOT_AVAILABLE)?>" />
						<? } ?>
					<? } ?>
                            
                    <? if (BACKLINK_FEATURE == "on"){ ?>
                            <? if ($listingHasBacklink == "y") { ?>
                                <a href="<?=$url_redirect?>/backlinks.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
                                    <img src="<?=DEFAULT_URL?>/images/icon-backlink.gif" border="0" alt="<?=system_showText(LANG_LABEL_BACKLINK)?>" title="<?=system_showText(LANG_LABEL_BACKLINK)?>" />
                                </a>
                            <? } else { ?>
                                <img src="<?=DEFAULT_URL?>/images/icon-backlink-off.gif" border="0" alt="<?=ucfirst(LANG_MSG_BACKLINK_NOT_AVAILABLE);?>" title="<?=ucfirst(LANG_MSG_BACKLINK_NOT_AVAILABLE);?>" />
                            <? } ?>
                    <? } ?>        
						
					<? if ( PAYMENTSYSTEM_FEATURE == "on" ) { ?>

						<? if($history_lnk && string_strpos($url_base, "/sitemgr")) { ?>
							<a href="<?=$history_lnk?>" class="link-table">
								<img src="<?=DEFAULT_URL?>/images/icon_coin.gif" border="0" alt="<?=system_showText(LANG_HISTORY_FOR_THIS_LISTING)?>" title="<?=system_showText(LANG_HISTORY_FOR_THIS_LISTING)?>" />
							</a>
						<? } elseif(string_strpos($url_base, "/sitemgr")) { ?>
							<img src="<?=DEFAULT_URL?>/images/icon_coin_off.gif" border="0" alt="<?=system_showText(LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING)?>" title="<?=system_showText(LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING)?>" />
						<? } ?>

					<? } ?>
                    
					<?  //TODO: MavenCrew - show mobile app icon and translation
						if ( MobileApp_FEATURE == 'on')
						if ( $hasMobileApp ) {
					?>
						<?if ($listingHasMobileApp == "y") { ?>
							<a href="<?=$url_redirect?>/MobileApp.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
								<img src="<?=DEFAULT_URL?>/images/icon_mobile.png" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_CHANGE_PROMOTION);?>" title="<?=system_showText(LANG_MSG_CLICK_TO_CHANGE_PROMOTION);?>" />
							</a>
						<? } else { ?>
							<img src="<?=DEFAULT_URL?>/images/icon_mobile_off.png" border="0" alt="<?=ucfirst(LANG_MSG_PROMOTION_NOT_AVAILABLE);?>" title="<?=ucfirst(LANG_MSG_PROMOTION_NOT_AVAILABLE);?>" />
						<? } ?>
					<? } ?>
					
					<? if (string_strpos($url_base, "/sitemgr")) { ?>
						<a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_LISTING)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_LISTING)?>" />
						</a>
					<? } ?>

				</td>
			</tr>

			<?
			}
		?>

	</table>
	</form>

<? if ((!isset($legend))||($legend)) { ?>
	<ul class="standard-iconDESCRIPTION">
		<?
		foreach ($levelvalues as $levelvalue) {
			if ($level->getActive($levelvalue) == 'y') {
				?><li style="background: url(<?=DEFAULT_URL?>/images/img_<?=$levelvalue?>.gif) no-repeat 0 50%; padding-left: 35px;"><?=$level->showLevel($levelvalue)?></li><?
			}
			if ( $level->getHasPromotion($levelvalue) == 'y' ) $hasPromotion = true;
		}
		?>
	</ul>
	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
		<li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT);?></li>
		<?
			if ( PROMOTION_FEATURE == 'on' && CUSTOM_PROMOTION_FEATURE == "on" )
			if ( $hasPromotion ) {
		?>
			<li class="promotion-icon"><?=system_showText(LANG_PROMOTION_FEATURE_NAME);?></li>
		<? } ?>
		<li class="traffic-icon"><?=system_showText(LANG_TRAFFIC_REPORTS);?></li>
		<li class="map-icon"><?=system_showText(LANG_LABEL_MAP_TUNING);?></li>
		<li class="seo-icon"><?=system_showText(LANG_LABEL_SEO_TUNING);?></li>
		<? if (($review_enabled == "on" && $commenting_edir) || string_strpos($url_base, "/sitemgr")) { ?>
			<li class="rating-icon"><?=system_showText(LANG_REVIEW);?></li>
		<? } ?>
	</ul>

	<ul class="standard-iconDESCRIPTION">
		<? if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on") { ?>
			<li class="call-icon"><?=system_showText(LANG_LABEL_CLICKTOCALL);?></li>
		<? } ?>
		<? if ($commenting_fb == "on") { ?>
			<li class="facebook-icon"><?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS);?></li>
		<? } ?>
        <? if (BACKLINK_FEATURE == "on"){ ?> 
            <li class="backlink-icon"><?=system_showText(LANG_LABEL_BACKLINK);?></li>
        <? } ?>    
		<? if (string_strpos($url_base, "/sitemgr")) { ?>
			<? if ( PAYMENTSYSTEM_FEATURE == "on" ) { ?>
				<li class="unpaid-icon"><?=system_showText(LANG_LABEL_UNPAID);?></li>
				<li class="unpaid-icon-off"><?=system_showText(LANG_LABEL_PAID);?></li>
				<li class="transaction-icon"><?=system_showText(LANG_LABEL_TRANSACTION);?></li>
			<? } ?>
			<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
		<? } ?>
	</ul>
<? } ?>