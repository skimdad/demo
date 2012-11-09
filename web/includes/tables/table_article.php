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
	# * FILE: /includes/tables/table_article.php
	# ----------------------------------------------------------------------------------------------------

	setting_get('commenting_edir', $commenting_edir);
	setting_get('commenting_fb', $commenting_fb);
	setting_get("review_article_enabled", $review_enabled);

?>
<script type="text/javascript">
	function getValuesBulkArticle(){

		if(document.getElementById('change_no_owner').value == "on"){
			document.getElementById("account_search_bulk").value = "0";
		}else if (document.getElementById("account_search_bulk").value) {
			document.getElementById("account_search_bulk").value = document.getElementById("change_account_id").value;
		}
		
		if (document.getElementById('delete_all').checked){
			document.getElementById("bulkSubmit").value = "Submit";
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','article_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		} else {
			document.getElementById("bulkSubmit").value = "Submit";
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','article_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		}
	}

	function confirmBulk(){
        
        <? if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION == "on") { ?>
            feed = document.article_setting.feed;
            return_categories = document.article_setting.return_categories;
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
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','article_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		} else {
			document.getElementById("bulkSubmit").value = "Submit";
			dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','article_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
		}
	}
</script>

<?
$itemCount = count($articles);

	if(is_numeric($message) && isset($msg_article[$message])) { ?>
	<p class="successMessage"><?=$msg_article[$message]?></p>
<? } elseif (is_numeric($message_gallery) && isset($msg_gallery[$message_gallery])) { ?>
    <p class="successMessage"><?=$msg_gallery[$message_gallery]?></p>
<? } ?>
<?

if (is_numeric($error_message)) {
	echo "<p class=\"errorMessage\">".$msg_bulkupdate[$error_message]."</p>";
} elseif ($error_msg) {
	echo "<p class=\"errorMessage\">".$error_msg."</p>";
} elseif ($msg == "success") {
	echo "<p class=\"successMessage\">".LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATE."</p>";
} elseif ($msg == "successdel") {
	echo "<p class=\"successMessage\">".LANG_MSG_ARTICLE_SUCCESSFULLY_DELETE."</p>";
}
unset($msg);
if ((!string_strpos($_SERVER["PHP_SELF"], "sitemgr/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))){?>

<? if (string_strpos($url_base, "/sitemgr")) { ?>
	<table class="bulkTable" border="0" cellpadding="2" cellspacing="2" >
		<tr>
			<td><a class="bulkUpdate" href="javascript:void(0)" onclick="showBulkUpdate( <?=RESULTS_PER_PAGE?>, 'article', '<?=system_showText(LANG_SITEMGR_CLOSE_BULK);?>', '<?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>')" id="open_bulk"><?=system_showText(LANG_SITEMGR_BULK_UPDATE);?></a></td>
		</tr>
	</table>
<? } ?>
	
<?
if (string_strpos($_SERVER["PHP_SELF"], "/sitemgr/article/search") !== false) {
	$actionBulk = system_getFormAction($_SERVER["REQUEST_URI"]);
} else {
	$actionBulk = system_getFormAction($_SERVER["PHP_SELF"]);
}
?>

<form name="article_setting" id="article_setting" action="<?=$actionBulk?>" method="post">

	<input type="hidden" name="account_search_bulk" id="account_search_bulk" value="" />
	<input type="hidden" name="bulkSubmit" id="bulkSubmit" value="" />
	
	<div id="table_bulk" style="display: none">
		<? include(INCLUDES_DIR."/tables/table_bulkupdate.php"); ?>
		<?
		if (string_strpos($_SERVER["PHP_SELF"], "search.php") == true) { ?>
			<button type="button" name="bulkSubmit" value="Submit" class="input-button-form" onclick="javascript:getValuesBulkArticle();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
				<th><input type="checkbox" id="check_all" name="check_all" onclick="checkAll('article', document.getElementById('check_all'), false, <?=$itemCount?>); removeCategoryDropDown('article', '<?=DEFAULT_URL?>');" /></th>
				<td><a class="CheckUncheck" href="javascript:void(0);" onclick="checkAll('article', document.getElementById('check_all'), true, <?=$itemCount?>); removeCategoryDropDown('article', '<?=DEFAULT_URL?>');"><?=system_showText(LANG_CHECK_UNCHECK_ALL);?></a></td>
			</tr>
		</table>
	</div>
<?}?>

<? if ((!isset($legend))||($legend)) { ?>
	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
		<li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT);?></li>
		<li class="traffic-icon"><?=system_showText(LANG_TRAFFIC_REPORTS);?></li>
		<li class="seo-icon"><?=system_showText(LANG_LABEL_SEO_TUNING);?></li>
		<? if (($review_enabled == "on" && $commenting_edir) || string_strpos($url_base, "/sitemgr")) { ?>
			<li class="rating-icon"><?=system_showText(LANG_REVIEW);?></li>
		<? } ?>
	</ul>
	
	<ul class="standard-iconDESCRIPTION">
		<? if (string_strpos($url_base, "/sitemgr") && PAYMENTSYSTEM_FEATURE == "on") { ?>
			<li class="unpaid-icon"><?=system_showText(LANG_LABEL_UNPAID);?></li>
			<li class="unpaid-icon-off"><?=system_showText(LANG_LABEL_PAID);?></li>
			<li class="transaction-icon"><?=system_showText(LANG_LABEL_TRANSACTION);?></li>
		<? } ?>
		<? if ($commenting_fb == "on") { ?>
			<li class="facebook-icon"><?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS);?></li>
		<? } ?>
		<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
	</ul>
<? } ?>

<form name="item_table">
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

		<tr>
			<th style="width: auto;"><?=system_showText(LANG_ARTICLE_TITLE);?></th>
			<? if (string_strpos($url_base, "/sitemgr")) { ?>
				<th style="width: 15%"><?=system_showText(LANG_LABEL_ACCOUNT);?></th>
			<? } else { ?>
				<th style="width: 70px;"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
			<? } ?>
			<th style="width: 100px;"><?=system_showText(LANG_LABEL_STATUS);?></th>
			<? if (string_strpos($url_base, "/sitemgr")) { ?>
				<th style="width: 18%;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
			<? } else { ?>
				<th style="width: 15%;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
			<? } ?>
		</tr>

		<?
		$hascharge = false;
		$hastocheckout = false;
		$cont = 0;
		if ($articles) foreach ($articles as $article) {
			$cont++;
			$id = $article->getNumber("id");
			$level = new ArticleLevel(EDIR_DEFAULT_LANGUAGE, true);
			$articleImages = $level->getImages($article->getNumber("level"));
			if ($article->needToCheckOut()) {
				if ($article->getPrice() > 0)  $hascharge = true;
				$hastocheckout = true;
			}

			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

			// ---------------- //

			$sql = "SELECT payment_log_id FROM Payment_Article_Log WHERE article_id = $id ORDER BY renewal_date DESC LIMIT 1";
			$r = $db->query($sql);
			$aux_transaction_data = mysql_fetch_assoc($r);

			if($aux_transaction_data) {
				$sql = "SELECT id, transaction_datetime FROM Payment_Log WHERE id = {$aux_transaction_data["payment_log_id"]}";
				$r = $db->query($sql);
				$transaction_data = mysql_fetch_assoc($r);
			} else {
				unset($transaction_data);
			}

			// ---------------- //

			$sql = "SELECT IA.invoice_id, IA.article_id, I.id, I.status, I.payment_date FROM Invoice I, Invoice_Article IA WHERE IA.article_id = $id AND I.status = 'R' AND I.id = IA.invoice_id ORDER BY I.payment_date DESC LIMIT 1";
			$r = $db->query($sql);
			$invoice_data = mysql_fetch_assoc($r);

			// ---------------- //

			list($t_month,$t_day,$t_year)     = explode("/",format_date($transaction_data["transaction_datetime"], DEFAULT_DATE_FORMAT, "datetime"));
			list($i_month,$i_day,$i_year)     = explode("/",format_date($invoice_data["payment_date"], DEFAULT_DATE_FORMAT,"datetime"));
			list($t_hour,$t_minute,$t_second) = explode(":",format_date($transaction_data["transaction_datetime"], "H:i:s", "datetime"));
			list($i_hour,$i_minute,$i_second) = explode(":",format_date($invoice_data["payment_date"], "H:i:s", "datetime"));

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
					<input type="checkbox" id="article_id<?=$cont?>" name="item_check[]" value="<?=$id?>" class="inputCheck" style="display:none" onclick="removeCategoryDropDown('article', '<?=DEFAULT_URL?>');"/>
					<a title="<?=$article->getString("title");?>" href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<?= $article->getString("title", true, 50); ?>
					</a>
				</td>
				<td>
					<? if (string_strpos($url_base, "/sitemgr")) { ?>
						<? if ($article->getNumber("account_id")) {
							$account = db_getFromDB("account", "id", db_formatNumber($article->getNumber("account_id")));
							?>
							<a title="<?=system_showAccountUserName($account->getString("username"))?>" href="<?=$url_base?>/account/view.php?id=<?=$article->getNumber("account_id")?>" class="link-table">
								<?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 20);?>
							</a>
						<? } else { ?>
							<span title="<?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?>" style="cursor:default">
								<em><?=system_showTruncatedText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER, 15);?></em>
							</span>
						<? } ?>
					<? } else { ?>
						<?
						if ($article->hasRenewalDate()) {
							$renewal_date = format_date($article->getString("renewal_date"));
							if ($renewal_date) $renewal_field = $renewal_date;
							else $renewal_field = system_showText(LANG_LABEL_NEW);
						} else {
							$renewal_field = "---";
						}
						?>
						<span title="<?=$renewal_field?>" style="cursor:default"><?=$renewal_field;?></span>
					<? } ?>
				</td>
				<td>
					<?
					$changeStatus = true;
					$status = new ItemStatus();
					if ((!(string_strpos($url_base, "/sitemgr")))&&(($article->getString("status")=="P")||($article->getString("status")=="E")))
						$changeStatus = false; ?>
					<a title="<?=$status->getStatus($article->getString("status"));?>" <? if ($changeStatus) { ?> href="<?=$url_redirect?>/settings.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" <? } else { ?> href="javascript:void(0)" style="cursor:default" <? } ?> class="link-table"><?  echo $status->getStatusWithStyle($article->getString("status")); ?></a>
				</td>
				<td nowrap>

					<?
					if (string_strpos($url_base, "/sitemgr") && PAYMENTSYSTEM_FEATURE == "on") {
						if ($article->needToCheckOut()) {
							echo "<img src=\"".DEFAULT_URL."/images/icon_unpaid.gif\" border=\"0\" alt=\"".system_showText(LANG_MSG_UNPAID_ITEM)."\" title=\"".system_showText(LANG_MSG_UNPAID_ITEM)."\" />";
						} else {
							echo "<img src=\"".DEFAULT_URL."/images/icon_unpaid_off.gif\" border=\"0\" alt=\"".system_showText(LANG_MSG_NO_CHECKOUT_NEEDED)."\" title=\"".system_showText(LANG_MSG_NO_CHECKOUT_NEEDED)."\" />";
						}
					}
					?>
					<a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE)?>" />
					</a>

					<a href="<?=$url_redirect?>/article.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE)?>" />
					</a>

					<a href="<?=$url_redirect?>/report.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_traffic.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS)?>" />
					</a>

					<a href="<?=$url_redirect?>/seocenter.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_seo.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_SEOCENTER)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_SEOCENTER)?>" />
					</a>

					<?
					
					if (($review_enabled == "on" && $commenting_edir) || string_strpos($url_base, "/sitemgr")) {
						$dbMain = db_getDBObject(DEFAULT_DB, true);
						$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
						$sql ="SELECT * FROM Review WHERE item_type = 'article' AND item_id = '".$article->getString("id")."' LIMIT 1";
						$r = $db->query($sql);
						if(mysql_affected_rows() > 0) {
							?>
							<a href="<?=$url_base?>/review/index.php?item_type=article&item_id=<?=$id?>&filter_id=1&item_screen=<?=$screen?>&item_letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
								<img src="<?=DEFAULT_URL?>/images/img_rateMiniStarOn.png" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS);?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS);?>" />
							</a>
							<?
						} else {
							?><img src="<?=DEFAULT_URL?>/images/img_rateMiniStarOff.png" border="0" alt="<?=system_showText(LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE);?>" title="<?=system_showText(LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE);?>" /><?
						}
					}
					?>

					<? if ( PAYMENTSYSTEM_FEATURE == "on" ) { ?>

						<? if($history_lnk && string_strpos($url_base, "/sitemgr")) { ?>
							<a href="<?=$history_lnk?>" class="link-table">
								<img src="<?=DEFAULT_URL?>/images/icon_coin.gif" border="0" alt="<?=system_showText(LANG_HISTORY_FOR_THIS_ARTICLE)?>" title="<?=system_showText(LANG_HISTORY_FOR_THIS_ARTICLE)?>" />
							</a>
						<? } elseif(string_strpos($url_base, "/sitemgr")) { ?>
							<img src="<?=DEFAULT_URL?>/images/icon_coin_off.gif" border="0" alt="<?=system_showText(LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE)?>" title="<?=system_showText(LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE)?>" />
						<? } ?>

					<? } ?>
							
					<? if ($commenting_fb == "on") { ?>
						<a href="<?=$url_redirect?>/facebook.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/icon-facebook-comments.gif" border="0" alt="<?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS)?>" title="<?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS)?>" />
						</a>
					<? } ?>

					<a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE)?>" />
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
		<li class="seo-icon"><?=system_showText(LANG_LABEL_SEO_TUNING);?></li>
		<? if (($review_enabled == "on" && $commenting_edir) || string_strpos($url_base, "/sitemgr")) { ?>
			<li class="rating-icon"><?=system_showText(LANG_REVIEW);?></li>
		<? } ?>
	</ul>
	
	<ul class="standard-iconDESCRIPTION">
		<? if (string_strpos($url_base, "/sitemgr") && PAYMENTSYSTEM_FEATURE == "on") { ?>
			<li class="unpaid-icon"><?=system_showText(LANG_LABEL_UNPAID);?></li>
			<li class="unpaid-icon-off"><?=system_showText(LANG_LABEL_PAID);?></li>
			<li class="transaction-icon"><?=system_showText(LANG_LABEL_TRANSACTION);?></li>
		<? } ?>
		<? if ($commenting_fb == "on") { ?>
			<li class="facebook-icon"><?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS);?></li>
		<? } ?>
		<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
	</ul>
	
<? } ?>