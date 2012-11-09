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
	# * FILE: /includes/tables/table_banner.php
	# ----------------------------------------------------------------------------------------------------

?>

<script type="text/javascript">
	function getValuesBulkBanner(){

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
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','banner_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		} else {
			document.getElementById("bulkSubmit").value = "Submit";
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','banner_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		}
	}

	function confirmBulk(){
		if (document.getElementById('delete_all').checked){
			document.getElementById("bulkSubmit").value = "Submit";
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','banner_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		} else {
			document.getElementById("bulkSubmit").value = "Submit";
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','banner_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		}
	}
</script>
<?

$levelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
unset($levelStatus);
foreach ($levelObj->value as $k => $value) {
	$levelStatus[$value] = $levelObj->active[$k];
}
unset($levelObj);

$itemCount = count($banners);

	if(is_numeric($message) && isset($msg_banner[$message])) { ?>
	<p class="successMessage"><?=$msg_banner[$message]?></p>
<? } ?>
<?

if (is_numeric($error_message)) {
	echo "<p class=\"errorMessage\">".$msg_bulkupdate[$error_message]."</p>";
} elseif ($error_msg) {
	echo "<p class=\"errorMessage\">".$error_msg."</p>";
} elseif ($msg == "success") {
	echo "<p class=\"successMessage\">".LANG_MSG_BANNER_SUCCESSFULLY_UPDATE."</p>";
} elseif ($msg == "successdel") {
	echo "<p class=\"successMessage\">".LANG_MSG_BANNER_SUCCESSFULLY_DELETE."</p>";
}
unset($msg);
if ((!string_strpos($_SERVER["PHP_SELF"], "sitemgr/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))){?>

<? if (string_strpos($url_base, "/sitemgr")) { ?>
	<table class="bulkTable" border="0" cellpadding="2" cellspacing="2" >
		<tr>
			<td><a class="bulkUpdate" href="javascript:void(0)" onclick="showBulkUpdate(<?=RESULTS_PER_PAGE?>, 'banner', '<?=system_showText(LANG_SITEMGR_CLOSE_BULK);?>', '<?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>')" id="open_bulk"><?=system_showText(LANG_SITEMGR_BULK_UPDATE);?></a></td>
		</tr>
	</table>
<? } ?>
	
<?
if (string_strpos($_SERVER["PHP_SELF"], "/sitemgr/banner/search") !== false) {
	$actionBulk = system_getFormAction($_SERVER["REQUEST_URI"]);
} else {
	$actionBulk = system_getFormAction($_SERVER["PHP_SELF"]);
}
?>
	
<form name="banner_setting" id="banner_setting" action="<?=$actionBulk?>" method="post">

	<input type="hidden" name="account_search_bulk" id="account_search_bulk" value="" />
	<input type="hidden" name="level_bulk" id="level_bulk" value="" />
	<input type="hidden" name="bulkSubmit" id="bulkSubmit" value="" />
	<div id="table_bulk" style="display: none">
		<? include(INCLUDES_DIR."/tables/table_bulkupdate.php");
		if (string_strpos($_SERVER["PHP_SELF"], "search.php") == true) { ?>
				<button type="button" name="bulkSubmit" value="Submit" class="input-button-form" onclick="javascript:getValuesBulkBanner();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
				<th><input type="checkbox" id="check_all" name="check_all" onclick="checkAll('banner', document.getElementById('check_all'), false, <?=$itemCount;?>);" /></th>
				<td><a class="CheckUncheck" href="javascript:void(0);" onclick="checkAll('banner', document.getElementById('check_all'), true, <?=$itemCount;?>); "><?=system_showText(LANG_CHECK_UNCHECK_ALL);?></a></td>
			</tr>
		</table>
	</div>
<?}?>

<? if ((!isset($legend))||($legend)) { ?>
	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
		<li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT);?></li>
		<li class="traffic-icon"><?=system_showText(LANG_TRAFFIC_REPORTS);?></li>
		<? if (string_strpos($url_redirect, "/sitemgr") && PAYMENTSYSTEM_FEATURE == "on") { ?>
			<li class="unpaid-icon"><?=system_showText(LANG_LABEL_UNPAID);?></li>
			<li class="unpaid-icon-off"><?=system_showText(LANG_LABEL_PAID);?></li>
			<li class="transaction-icon"><?=system_showText(LANG_LABEL_TRANSACTION);?></li>
		<? } ?>
		<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
	</ul>
<? } ?>
    
<form name="item_table">
	<table class="standard-tableTOPBLUE">

		<tr>
			<th style="width:auto;"><?=system_showText(LANG_LABEL_CAPTION)?></th>
			<? if (string_strpos($url_redirect, "/sitemgr")) { ?>
				<th style="width: 90px;"><?=system_showText(LANG_LABEL_TYPE)?></th>
			<? } else { ?>
				<th style="width: 120px;"><?=system_showText(LANG_LABEL_TYPE)?></th>
			<? } ?>
			<th style="width: 100px;"><?=system_showText(LANG_LABEL_STATUS);?></th>
			<? if (string_strpos($url_redirect, "/sitemgr")) { ?><th style="width: 90px;"><?=system_showText(LANG_LABEL_ACCOUNT);?></th><? } ?>
			<th style="width: 62px;"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
			<th style="width: 70px;"><?=system_showText(LANG_LABEL_IMPRESSIONS)?></th>
			<? if (string_strpos($url_redirect, "/sitemgr")) { ?>
				<th style="width: 100px;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
			<? } else { ?>
				<th style="width: 70px;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
			<? } ?>
		</tr>

		<?
		$hascharge = false;
		$hastocheckout = false;
		$cont = 0;
		if ($banners) foreach ($banners as $each_banner) {
			$cont++;
			$bannerObj = new Banner($each_banner);
			if ($bannerObj->needToCheckOut() && ($bannerObj->getString("unpaid_impressions") > 0 || $bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE)) {
				if ($bannerObj->getPrice() > 0 && ($bannerObj->getString("unpaid_impressions") > 0 || $bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE)) $hascharge = true;
				$hastocheckout = true;
			}

			$id = $bannerObj->getNumber("id");

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

			// ---------------- //

			$sql = "SELECT payment_log_id FROM Payment_Banner_Log WHERE banner_id = $id ORDER BY renewal_date DESC LIMIT 1";
			$r   = $db->query($sql);
			$aux_transaction_data = mysql_fetch_assoc($r);

			if($aux_transaction_data) {
				$sql = "SELECT id,transaction_datetime FROM Payment_Log WHERE id = {$aux_transaction_data["payment_log_id"]}";
				$r = $db->query($sql);
				$transaction_data = mysql_fetch_assoc($r);
			} else {
				unset($transaction_data);
			}

			// ---------------- //

			$sql = "SELECT IB.invoice_id, IB.banner_id, I.id, I.status, I.payment_date FROM Invoice I, Invoice_Banner IB WHERE IB.banner_id = $id AND I.status = 'R' AND I.id = IB.invoice_id ORDER BY I.payment_date DESC LIMIT 1";
			$r   = $db->query($sql);
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

			?>
			<tr>
				<td>
					<input type="checkbox" id="banner_id<?=$cont?>" name="item_check[]" value="<?=$id?>" class="inputCheck" style="display:none" onclick="removeCategoryDropDown('banner', '<?=DEFAULT_URL?>');"/>
					<a title="<?=$bannerObj->getString("caption")?>" href="<?=$url_redirect?>/view.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<? if (string_strpos($url_redirect, "/sitemgr")) { ?>
							<?=$bannerObj->getString("caption", true, 30);?>
						<? } else { ?>
							<?=$bannerObj->getString("caption", true, 40);?>
						<? } ?>
					</a>
				</td>
				<td>
					<a title="<?=$bannerObj->retrieveHumanReadableType($bannerObj->GetString("type"));?>" href="<?=$url_redirect?>/view.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<?
						echo $bannerObj->retrieveHumanReadableType($bannerObj->GetString("type"));
						if ($levelStatus[$bannerObj->GetString("type")] == "n") echo " (".LANG_BANNER_DISABLED.")";
					?>
					</a>
				</td>
				<td>
					<?
					$changeStatus = true;
					$status = new ItemStatus();
					if ((!(string_strpos($url_redirect, "/sitemgr")))&&(($bannerObj->GetString("status")=="P")||($bannerObj->GetString("status")=="E")))
						$changeStatus = false; ?>
					<a title="<?=$status->getStatus($bannerObj->GetString("status"))?>" <? if ($changeStatus) { ?> href="<?=$url_redirect?>/settings.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" <? } else { ?> href="javascript:void(0)" style="cursor:default" <? } ?> class="link-table">
						<?
							echo $status->getStatusWithStyle($bannerObj->GetString("status"));
						?>
					</a>
				</td>
				<? if (string_strpos($url_redirect, "/sitemgr")) { ?>
				<td>
					<? if ($bannerObj->GetString("account_id")) {
						$account = db_getFromDB("account", "id", db_formatNumber($bannerObj->GetString("account_id")));
						?>
						<a title="<?=system_showAccountUserName($account->getString("username"))?>" href="<?=DEFAULT_URL?>/sitemgr/account/view.php?id=<?=$bannerObj->GetString("account_id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
							<?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 15);?>
						</a>
					<? } else { ?>
						<span title="<?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?>" style="cursor:default">
							<em><?=system_showTruncatedText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER, 15);?></em>
						</span>
					<? } ?>
				</td>
				<? } ?>
				<td>
					<?
					if ($bannerObj->getString("expiration_setting") != BANNER_EXPIRATION_RENEWAL_DATE) {
						$renewal_field = system_showText(LANG_LABEL_UNLIMITED);
					} else {
						if ($bannerObj->hasRenewalDate()) {
							if ($bannerObj->getDate("renewal_date") == "00/00/0000") {
								$renewal_field = system_showText(LANG_LABEL_NEW);
							} else {
								$renewal_field = $bannerObj->getDate("renewal_date");
							}
						} else {
							$renewal_field = "---";
						}
					}
					?>
					<span title="<?=$renewal_field?>" style="cursor:default"><?=$renewal_field;?></span>
				</td>
				<td>
					<?
					if ($bannerObj->getString("expiration_setting") != BANNER_EXPIRATION_IMPRESSION) {
						$impressions_field = system_showText(LANG_LABEL_UNLIMITED);
					} else {
						if ($bannerObj->hasImpressions()) {
							$impressions_field = $bannerObj->getString("impressions");
						} else {
							$impressions_field = "---";
						}
					}
					?>
					<span title="<?=$impressions_field?>" style="cursor:default"><?=$impressions_field;?></span>
				</td>
				<td>
					<?
						if (string_strpos($url_redirect, "/sitemgr") && PAYMENTSYSTEM_FEATURE == "on") {
							if ($bannerObj->needToCheckOut()) {
								echo "<img src=\"".DEFAULT_URL."/images/icon_unpaid.gif\" border=\"0\" alt=\"".system_showText(LANG_MSG_UNPAID_ITEM)."\" title=\"".system_showText(LANG_MSG_UNPAID_ITEM)."\" />";
							} else {
								echo "<img src=\"".DEFAULT_URL."/images/icon_unpaid_off.gif\" border=\"0\" alt=\"".system_showText(LANG_MSG_NO_CHECKOUT_NEEDED)."\" title=\"".system_showText(LANG_MSG_NO_CHECKOUT_NEEDED)."\" />";
							}
						}
						?>
					<a href="<?=$url_redirect?>/view.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER)?>" />
					</a>

					<a href="<?=$url_redirect?>/edit.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_BANNER)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_BANNER)?>" />
					</a>

					<a href="<?=$url_redirect?>/report.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_traffic.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS)?>" />
					</a>

					<? if ( PAYMENTSYSTEM_FEATURE == "on" ) { ?>

						<? if($history_lnk && string_strpos($url_redirect, "/sitemgr")) { ?>
							<a href="<?=$history_lnk?>" class="link-table">
								<img src="<?=DEFAULT_URL?>/images/icon_coin.gif" border="0" alt="<?=system_showText(LANG_HISTORY_FOR_THIS_BANNER)?>" title="<?=system_showText(LANG_HISTORY_FOR_THIS_BANNER)?>" />
							</a>
						<? } elseif(string_strpos($url_redirect, "/sitemgr")) { ?>
							<img src="<?=DEFAULT_URL?>/images/icon_coin_off.gif" border="0" alt="<?=system_showText(LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER)?>" title="<?=system_showText(LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER)?>" />
						<? } ?>

					<? } ?>

					<a href="<?=$url_redirect?>/delete.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_BANNER)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_BANNER)?>" />
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
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
		<li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT);?></li>
		<li class="traffic-icon"><?=system_showText(LANG_TRAFFIC_REPORTS);?></li>
		<? if (string_strpos($url_redirect, "/sitemgr") && PAYMENTSYSTEM_FEATURE == "on") { ?>
			<li class="unpaid-icon"><?=system_showText(LANG_LABEL_UNPAID);?></li>
			<li class="unpaid-icon-off"><?=system_showText(LANG_LABEL_PAID);?></li>
			<li class="transaction-icon"><?=system_showText(LANG_LABEL_TRANSACTION);?></li>
		<? } ?>
		<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
	</ul>
<? } ?>
	
