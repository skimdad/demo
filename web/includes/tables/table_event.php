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
	# * FILE: /includes/tables/table_event.php
	# ----------------------------------------------------------------------------------------------------

?>

<script type="text/javascript">
	function getValuesBulkEvent(){

		if(document.getElementById('change_no_owner').value == "on"){
			document.getElementById("account_search_bulk").value = "0";
		}else if (document.getElementById("account_search_bulk").value) {
			document.getElementById("account_search_bulk").value = document.getElementById("change_account_id").value;
		}

		if (document.getElementById("level_bulk").value) {
			document.getElementById("level_bulk").value = document.getElementById("level").value;
		}

		if (document.getElementById('delete_all').checked){
			document.getElementById("bulkSubmit").value = "Submit";
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','event_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		} else {
			document.getElementById("bulkSubmit").value = "Submit";
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','event_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		}
	}

	function confirmBulk(){
        
        <? if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION == "on") { ?>
            feed = document.event_setting.feed;
            return_categories = document.event_setting.return_categories;
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
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','event_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		} else {
			document.getElementById("bulkSubmit").value = "Submit";
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','event_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		}
	}
</script>

<?
$level = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
$levelvalues = $level->getLevelValues();

$itemCount = count($events);
?>

<? if(is_numeric($message) && isset($msg_event[$message])) { ?>
    <p class="successMessage"><?=$msg_event[$message]?></p>
<? } elseif (is_numeric($message_gallery) && isset($msg_gallery[$message_gallery])) { ?>
    <p class="successMessage"><?=$msg_gallery[$message_gallery]?></p>
<? } elseif (is_numeric($message_maptunning) && isset($msg_maptunning[$message_maptunning])) { ?>
    <p class="successMessage"><?=$msg_maptunning[$message_maptunning]?></p>
<? } ?>

<?
if (is_numeric($error_message)) { 
	echo "<p class=\"errorMessage\">".$msg_bulkupdate[$error_message]."</p>";
} elseif ($error_msg) {
	echo "<p class=\"errorMessage\">".$error_msg."</p>";
} elseif ($msg == "success") {
	echo "<p class=\"successMessage\">".LANG_MSG_EVENT_SUCCESSFULLY_UPDATE."</p>";
} elseif ($msg == "successdel") {
	echo "<p class=\"successMessage\">".LANG_MSG_EVENT_SUCCESSFULLY_DELETE."</p>";
}
unset($msg);
if ((!string_strpos($_SERVER["PHP_SELF"], "sitemgr/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))){?>

<? if (string_strpos($url_base, "/sitemgr")) { ?>
	<table class="bulkTable" border="0" cellpadding="2" cellspacing="2" >
		<tr>
			<td><a class="bulkUpdate" href="javascript:void(0)" onclick="showBulkUpdate(<?=RESULTS_PER_PAGE?>, 'event', '<?=system_showText(LANG_SITEMGR_CLOSE_BULK);?>', '<?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>')" id="open_bulk"><?=system_showText(LANG_SITEMGR_BULK_UPDATE);?></a></td>
		</tr>
	</table>
<? } ?>
	
<?
if (string_strpos($_SERVER["PHP_SELF"], "/sitemgr/event/search") !== false) {
	$actionBulk = system_getFormAction($_SERVER["REQUEST_URI"]);
} else {
	$actionBulk = system_getFormAction($_SERVER["PHP_SELF"]);
}
?>

<form name="event_setting" id="event_setting" action="<?=$actionBulk?>" method="post">
	<input type="hidden" name="account_search_bulk" id="account_search_bulk" value="" />
	<input type="hidden" name="level_bulk" id="level_bulk" value="" />
	<input type="hidden" name="bulkSubmit" id="bulkSubmit" value="" />
	<div id="table_bulk" style="display: none">
		<? include(INCLUDES_DIR."/tables/table_bulkupdate.php");
		if (string_strpos($_SERVER["PHP_SELF"], "search.php") == true) { ?>
		<button type="button" name="bulkSubmit" value="Submit" class="input-button-form" onclick="javascript:getValuesBulkEvent();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
	<? } else { ?>
		<button type="button" name="bulkSubmit" value="Submit" class="input-button-form" onclick="javascript:confirmBulk();" ><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
	<? } ?>
	</div>
	<div id="idlist"></div>
</form>

	<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
	
	<div class="bulkTable" id="bulk_check" style="display:none">
		<table border="0" cellpadding="2" cellspacing="2">
			<tr>
				<th><input type="checkbox" id="check_all" name="check_all" onclick="checkAll('event', document.getElementById('check_all'), false, <?=$itemCount;?>); removeCategoryDropDown('event', '<?=DEFAULT_URL?>');" /></th>
				<td><a class="CheckUncheck" href="javascript:void(0);" onclick="checkAll('event', document.getElementById('check_all'), true, <?=$itemCount;?>); removeCategoryDropDown('event', '<?=DEFAULT_URL?>');"><?=system_showText(LANG_CHECK_UNCHECK_ALL);?></a></td>
			</tr>
		</table>
	</div>
<?}?>

<? if ((!isset($legend))||($legend)) { ?>
	<ul class="standard-iconDESCRIPTION">
		<?
		foreach ($levelvalues as $levelvalue) {
			if ($level->getActive($levelvalue) == 'y') {
				?><li style="background: url(<?=DEFAULT_URL?>/images/img_even_<?=$levelvalue?>.gif) no-repeat 0 50%; padding-left: 35px;"><?=$level->showLevel($levelvalue)?></li><?
			}
		}
		?>
	</ul>

	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW)?></li>
		<li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT)?></li>
		<li class="traffic-icon"><?=system_showText(LANG_TRAFFIC_REPORTS)?></li>
		<li class="map-icon"><?=system_showText(LANG_LABEL_MAP_TUNING)?></li>
		<li class="seo-icon"><?=system_showText(LANG_LABEL_SEO_TUNING);?></li>
		<? if (string_strpos($url_base, "/sitemgr") && PAYMENTSYSTEM_FEATURE == "on") { ?>
			<li class="unpaid-icon"><?=system_showText(LANG_LABEL_UNPAID)?></li>
			<li class="unpaid-icon-off"><?=system_showText(LANG_LABEL_PAID);?></li>
			<li class="transaction-icon"><?=system_showText(LANG_LABEL_TRANSACTION)?></li>
		<? } ?>
		<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE)?></li>
	</ul>

<? } ?>

<form name="item_table">
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

		<tr>
			<th  style="width:auto;"><?=system_showText(LANG_EVENT_TITLE)?></th>
			<th style="width: 40px;"><?=system_showText(LANG_LABEL_LEVEL)?></th>
			<th style="width: 94px;"><?=system_showText(LANG_LABEL_START_DATE)?></th>
			<th style="width: 90px;">
				<? if (string_strpos($url_base, "/sitemgr")) { ?>
					<?=system_showText(LANG_LABEL_ACCOUNT)?>
				<? } else { ?>
					<?=system_showText(LANG_LABEL_RENEWAL)?>
				<? } ?>
			</th>
			<th style="width: 100px;"><?=system_showText(LANG_LABEL_STATUS);?></th>
			<? if (string_strpos($url_base, "/sitemgr")) { ?>
				<th style="width: 145px;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
			<? } else { ?>
				<th style="width: 115px;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
			<? } ?>
		</tr>

		<?
		$hascharge = false;
		$hastocheckout = false;
		$cont = 0;
		if ($events) foreach ($events as $event) {
			$cont++;
			$id = $event->getNumber("id");
			$eventImages = $level->getImages($event->getNumber("level"));
			if ($event->needToCheckOut()) {
				if ($event->getPrice() > 0) $hascharge = true;
				$hastocheckout = true;
			}

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

			// ---------------- //

			$sql = "SELECT payment_log_id FROM Payment_Event_Log WHERE event_id = $id ORDER BY renewal_date DESC LIMIT 1";
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

			$sql = "SELECT IE.invoice_id,IE.event_id,I.id,I.status,I.payment_date FROM Invoice I,Invoice_Event IE WHERE IE.event_id = $id AND I.status = 'R' AND I.id = IE.invoice_id ORDER BY I.payment_date DESC LIMIT 1";
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
					<input type="checkbox" id="event_id<?=$cont?>" name="item_check[]" value="<?=$id?>" class="inputCheck" style="display:none" onclick="removeCategoryDropDown('event', '<?=DEFAULT_URL?>');"/>
					<a title="<?=$event->getString("title");?>" href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<? if (string_strpos($url_base, "/sitemgr")) { ?>
							<?= $event->getString("title", true, 40); ?>
						<? } else { ?>
							<?= $event->getString("title", true, 22); ?>
						<? } ?>
					</a>
				</td>
				<td>
					<?
					$level = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
					$levelValues = $level->getLevelValues();
					$levelDefault = $level->getLevel($level->getDefaultLevel());
					$activeLevels = array();
					foreach ($levelValues as $levelValue) {
						if ($level->getActive($levelValue) == 'y') {
							$activeLevels[] = $levelValue;
						}
					}
					if (in_array($event->getNumber("level"), $activeLevels)) $imgName = "img_even_".$event->getNumber("level").".gif";
					else $imgName = "img_even_".$level->getDefaultLevel().".gif";
					?>
					<a href="<?=$url_redirect?>/eventlevel.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table"><img src="<?=DEFAULT_URL?>/images/<?=$imgName?>" alt="<?=(in_array($event->getNumber("level"), $activeLevels)) ? $level->showLevel($event->getNumber("level")) : string_ucwords($levelDefault)?>" title="<?=(in_array($event->getNumber("level"), $activeLevels)) ? $level->showLevel($event->getNumber("level")) : string_ucwords($levelDefault)?>" border="0" /></a>
				</td>
				
				<td><span title="<?=$eventDate?>" style="cursor:default"><?=$event->getDate("start_date");?></span></td>
				<td>
					<? if (string_strpos($url_base, "/sitemgr")) { ?>
						<? if ($event->getNumber("account_id")) {
							$account = db_getFromDB("account", "id", db_formatNumber($event->getNumber("account_id")));
							?>
							<a title="<?=system_showAccountUserName($account->getString("username"));?>" href="<?=$url_base?>/account/view.php?id=<?=$event->getNumber("account_id")?>" class="link-table">
								<?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 15);?>
							</a>
						<? } else { ?>
							<span title="<?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?>" style="cursor:default">
								<em><?=system_showTruncatedText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER, 15);?></em>
							</span>
						<? } ?>
					<? } else { ?>
						<?
						if ($event->hasRenewalDate()) {
							$renewal_date = format_date($event->getString("renewal_date"));
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
					if ((!(string_strpos($url_base, "/sitemgr")))&&(($event->getString("status")=="P")||($event->getString("status")=="E")))
						$changeStatus = false; ?>

					<a title="<?=$status->getStatus($event->getString("status"))?>" <? if ($changeStatus) { ?> href="<?=$url_redirect?>/settings.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" <? } else { ?> href="javascript:void(0)" style="cursor:default" <? } ?> class="link-table">
						<?
						echo $status->getStatusWithStyle($event->getString("status"));
						?>
					</a>

				</td>
				<td>
					<?
						if (string_strpos($url_base, "/sitemgr") && PAYMENTSYSTEM_FEATURE == "on") {
							if ($event->needToCheckOut()) {
								echo "<img src=\"".DEFAULT_URL."/images/icon_unpaid.gif\" border=\"0\" alt=\"".system_showText(LANG_MSG_UNPAID_ITEM)."\" title=\"".system_showText(LANG_MSG_UNPAID_ITEM)."\" />";
							} else {
								echo "<img src=\"".DEFAULT_URL."/images/icon_unpaid_off.gif\" border=\"0\" alt=\"".system_showText(LANG_MSG_NO_CHECKOUT_NEEDED)."\" title=\"".system_showText(LANG_MSG_NO_CHECKOUT_NEEDED)."\" />";
							}
						}
						?>

					<a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT)?>" />
					</a>

					<a href="<?=$url_redirect?>/event.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_EVENT)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_EVENT)?>" />
					</a>

					<a href="<?=$url_redirect?>/report.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_traffic.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS)?>" />
					</a>

					<? if ((GOOGLE_MAPS_ENABLED == "on") && ($mapObj->getString("value") == "on") && (($event->getString("address")) || ($event->getNumber("location_3")) || ($event->getNumber("location_4"))  || ($event->getString("latitude") && $event->getString("longitude")))) { ?>
						<a href="<?=$url_redirect?>/maptuning.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/icon_map.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT)?>" />
						</a>
					<? } else { ?>
						<img src="<?=DEFAULT_URL?>/images/icon_map_off.gif" border="0" alt="<?=system_showText(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT)?>" title="<?=system_showText(LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT)?>" />
					<? } ?>

					<a href="<?=$url_redirect?>/seocenter.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_seo.gif" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_SEOCENTER)?>" border="0" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_SEOCENTER)?>" />
					</a>

					<? if ( PAYMENTSYSTEM_FEATURE == "on" ) { ?>

						<? if($history_lnk && string_strpos($url_base, "/sitemgr")) { ?>
							<a href="<?=$history_lnk?>" class="link-table">
								<img src="<?=DEFAULT_URL?>/images/icon_coin.gif" border="0" alt="<?=system_showText(LANG_HISTORY_FOR_THIS_EVENT)?>" title="<?=system_showText(LANG_HISTORY_FOR_THIS_EVENT)?>" />
							</a>
						<? } elseif(string_strpos($url_base, "/sitemgr")) { ?>
							<img src="<?=DEFAULT_URL?>/images/icon_coin_off.gif" border="0" alt="<?=system_showText(LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT)?>" title="<?=system_showText(LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT)?>" />
						<? } ?>

					<? } ?>

					<a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" alt="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_EVENT)?>" border="0" title="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_EVENT)?>" />
					</a>

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
				?><li style="background: url(<?=DEFAULT_URL?>/images/img_even_<?=$levelvalue?>.gif) no-repeat 0 50%; padding-left: 35px;"><?=$level->showLevel($levelvalue)?></li><?
			}
		}
		?>
	</ul>

	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW)?></li>
		<li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT)?></li>
		<li class="traffic-icon"><?=system_showText(LANG_TRAFFIC_REPORTS)?></li>
		<li class="map-icon"><?=system_showText(LANG_LABEL_MAP_TUNING)?></li>
		<li class="seo-icon"><?=system_showText(LANG_LABEL_SEO_TUNING);?></li>
		<? if (string_strpos($url_base, "/sitemgr") && PAYMENTSYSTEM_FEATURE == "on") { ?>
			<li class="unpaid-icon"><?=system_showText(LANG_LABEL_UNPAID)?></li>
			<li class="unpaid-icon-off"><?=system_showText(LANG_LABEL_PAID);?></li>
			<li class="transaction-icon"><?=system_showText(LANG_LABEL_TRANSACTION)?></li>
		<? } ?>
		<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE)?></li>
	</ul>
	
<? } ?>