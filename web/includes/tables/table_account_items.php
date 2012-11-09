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
	# * FILE: /includes/tables/table_account_items.php
	# ----------------------------------------------------------------------------------------------------
	$error = 1;

	$sql = "SELECT * FROM Listing WHERE account_id = $id ORDER BY entered DESC";
	$dbMain = db_getDBObject(DEFAULT_DB, true);
	$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
	$r = $db->query($sql);

	if ($r && mysql_num_rows($r)>0) {

		$error = 0;
		$level = new ListingLevel();
		$status = new ItemStatus();
		?>

		<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

			<tr>
				<th colspan="3"><span class="viewAllItems"><?=((mysql_num_rows($r)>5) ? "<a href='".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/search.php?search_account_id=".$id."&search_submit=Search'>".ucfirst(system_showText(LANG_SITEMGR_MORE))." ".string_ucwords(system_showText(LANG_SITEMGR_LISTING_PLURAL))." &raquo;</a>" : "")?></span><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING_PLURAL));?></th>
			</tr>

			<tr>
				<td width="60%"><strong><?=system_showText(LANG_SITEMGR_TITLE)?></strong></td>
				<td width="20%"><strong><?=system_showText(LANG_SITEMGR_LEVEL)?></strong></td>
				<td width="20%"><strong><?=system_showText(LANG_SITEMGR_STATUS)?></strong></td>
			</tr>

			<?
			$count = 0;
			while (($listing = mysql_fetch_assoc($r)) && ($count<5)) {
				$count++;
				$listing_level = string_ucwords($level->getLevel($listing["level"]));
				$listing_link = DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER."/view.php?id=".$listing["id"];
				?>
				<tr>
					<td><a href="<?=$listing_link?>" title="<?=$listing["title"]?>"><?=( string_strlen($listing["title"]) > 70 ) ? ( string_substr($listing["title"],0,67)."..." ) : ( $listing["title"] )?></a></td>
					<td><?=$listing_level?></td>
					<td><?=$status->getStatusWithStyle($listing["status"])?></td>
				</tr>
				<?
			}
			?>

		</table>

		<?
	}
	?>

	<?
	if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {

		$sql = "SELECT * FROM Event WHERE account_id = $id ORDER BY entered DESC";
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$r = $db->query($sql);

		if ($r && mysql_num_rows($r)>0) {

			$error = 0;
			$level = new EventLevel();
			$status = new ItemStatus();
			?>

			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

				<tr>
					<th colspan="3"><span class="viewAllItems"><?=((mysql_num_rows($r)>5) ? "<a href='".DEFAULT_URL."/sitemgr/".EVENT_FEATURE_FOLDER."/search.php?search_account_id=".$id."&search_submit=Search'>".ucfirst(system_showText(LANG_SITEMGR_MORE))." ".system_showText(LANG_SITEMGR_NAVBAR_EVENT)." &raquo;</a>" : "")?></span><?=system_showText(LANG_SITEMGR_NAVBAR_EVENT)?></th>
				</tr>

				<tr>
					<td width="60%"><strong><?=system_showText(LANG_SITEMGR_TITLE)?></strong></td>
					<td width="20%"><strong><?=system_showText(LANG_SITEMGR_LEVEL)?></strong></td>
					<td width="20%"><strong><?=system_showText(LANG_SITEMGR_STATUS)?></strong></td>
				</tr>

				<?
				$count = 0;
				while (($event = mysql_fetch_assoc($r)) && ($count<5)) {
					$count++;
					$event_level = string_ucwords($level->getLevel($event["level"]));
					$event_link = DEFAULT_URL."/sitemgr/".EVENT_FEATURE_FOLDER."/view.php?id=".$event["id"];
					?>
					<tr>
						<td><a href="<?=$event_link?>" title="<?=$event["title"]?>"><?=( string_strlen($event["title"]) > 70 ) ? ( string_substr($event["title"],0,67)."..." ) : ( $event["title"] )?></a></td>
						<td><?=$event_level?></td>
						<td><?=$status->getStatusWithStyle($event["status"])?></td>
					</tr>
					<?
				}
				?>

			</table>

			<?
		}
	}
	?>

	<?
	if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {
		
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
		$endExpr = ")";
		
		if (count($arrLangs) > 1) {
			$fields = "id, type, status, ";
			$fields .= "IF (`caption".$langIndex."` != '', `caption".$langIndex."`, ";
			$letterField = "IF (`caption".$langIndex."` != '', `caption".$langIndex."`, ";
			foreach ($arrLangs as $lang) {
				if ($langIndex != $lang) {
					$fields .= "IF (`caption".$lang."` != '', `caption".$lang."`, ";
					$letterField .= "IF (`caption".$lang."` != '', `caption".$lang."`, ";
					$endExpr .= ")";
				}
			}

			$fields .= "''".$endExpr." AS `caption`";
			$letterField .= "''".$endExpr."";
		} else {
			$fields = "id, type, status, `caption".$langIndex."` AS `caption`";
			$letterField = "`caption".$langIndex."`";
		}

		$sql = "SELECT $fields FROM Banner WHERE account_id = $id ORDER BY entered DESC";

		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$r = $db->query($sql);

		if ($r && mysql_num_rows($r)>0) {

			$error = 0;
			$level = new BannerLevel();
			$status = new ItemStatus();
			?>

			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

				<tr>
					<th colspan="3"><span class="viewAllItems"><?=((mysql_num_rows($r)>5) ? "<a href='".DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER."/search.php?search_account_id=".$id."&search_submit=Search'>".ucfirst(system_showText(LANG_SITEMGR_MORE))." ".string_ucwords(system_showText(LANG_SITEMGR_BANNER_PLURAL))." &raquo;</a>" : "")?></span><?=string_ucwords(system_showText(LANG_SITEMGR_BANNER_PLURAL));?></th>
				</tr>

				<tr>
					<td width="60%"><strong><?=system_showText(LANG_SITEMGR_LABEL_CAPTION)?></strong></td>
					<td width="20%"><strong><?=system_showText(LANG_SITEMGR_LABEL_TYPE)?></strong></td>
					<td width="20%"><strong><?=system_showText(LANG_SITEMGR_STATUS)?></strong></td>
				</tr>

				<?
				$count = 0;
				$bannerObj = new Banner();
				while (($banner = mysql_fetch_assoc($r)) && ($count<5)) {
					$count++;
					$banner_link = DEFAULT_URL."/sitemgr/".BANNER_FEATURE_FOLDER."/view.php?id=".$banner["id"];
					?>
					<tr>
						<td>
							<a href="<?=$banner_link?>" title="<?=$banner["caption"]?>">
								<?
								if (string_strlen($banner["caption"]) > 20) {
									if (string_strpos($banner["caption"], " ") > 0) {
										echo $banner["caption"];
									} else {
										echo string_substr($banner["caption"], 0, 20)."...";
									}
								} else {
									echo $banner["caption"];
								}
								?>
							</a>
						</td>
						<td><?=$bannerObj->retrieveHumanReadableType($banner["type"]);?></td>
						<td><?=$status->getStatusWithStyle($banner["status"]);?></td>
					</tr>
					<?
				}
				?>

			</table>

			<?
		}
	}
	?>

	<?
	if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {

		$sql = "SELECT * FROM Classified WHERE account_id = $id ORDER BY entered DESC";
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$r = $db->query($sql);

		if ($r && mysql_num_rows($r)>0) {

			$error = 0;
			$level = new ClassifiedLevel();
			$status = new ItemStatus();
	?>

			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

				<tr>
					<th colspan="3"><span class="viewAllItems"><?=((mysql_num_rows($r)>5) ? "<a href='".DEFAULT_URL."/sitemgr/".CLASSIFIED_FEATURE_FOLDER."/search.php?search_account_id=".$id."&search_submit=Search'>".ucfirst(system_showText(LANG_SITEMGR_MORE))." ".string_ucwords(system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL))." &raquo;</a>" : "")?></span><?=string_ucwords(system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL));?></th>
				</tr>

				<tr>
					<td width="60%"><strong><?=system_showText(LANG_SITEMGR_TITLE)?></strong></td>
					<td width="20%"><strong><?=system_showText(LANG_SITEMGR_LEVEL)?></strong></td>
					<td width="20%"><strong><?=system_showText(LANG_SITEMGR_STATUS)?></strong></td>
				</tr>

				<?
				$count = 0;
				while (($classified = mysql_fetch_assoc($r)) && ($count<5)) {
					$count++;
					$classified_link = DEFAULT_URL."/sitemgr/".CLASSIFIED_FEATURE_FOLDER."/view.php?id=".$classified["id"];
					?>
					<tr>
						<td><a href="<?=$classified_link?>" title="<?=$classified["title"]?>"><?=( string_strlen($classified["title"]) > 70 ) ? ( string_substr($classified["title"],0,67)."..." ) : ( $classified["title"] )?></a></td>
						<td><?=$level->getLevel($classified["level"])?></td>
						<td><?=$status->getStatusWithStyle($classified["status"])?></td>
					</tr>
					<?
				}
				?>

			</table>

			<?
		}
	}
	?>

	<?
	if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {

		$sql = "SELECT * FROM Article WHERE account_id = $id ORDER BY entered DESC";
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$r = $db->query($sql);

		if ($r && mysql_num_rows($r)>0) {

			$error = 0;
			$status = new ItemStatus();
			?>

			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

				<tr>
					<th colspan="3"><span class="viewAllItems"><?=((mysql_num_rows($r)>5) ? "<a href='".DEFAULT_URL."/sitemgr/".ARTICLE_FEATURE_FOLDER."/search.php?search_account_id=".$id."&search_submit=Search'>".ucfirst(system_showText(LANG_SITEMGR_MORE))." ".string_ucwords(system_showText(LANG_SITEMGR_ARTICLE_PLURAL))." &raquo;</a>" : "")?></span><?=string_ucwords(system_showText(LANG_SITEMGR_ARTICLE_PLURAL))?></th>
				</tr>

				<tr>
					<td width="80%"><strong><?=system_showText(LANG_SITEMGR_TITLE)?></strong></td>
					<td width="20%"><strong><?=system_showText(LANG_SITEMGR_STATUS)?></strong></td>
				</tr>

				<?
				$count = 0;
				while (($article = mysql_fetch_assoc($r)) && ($count<5)) {
					$count++;
					$article_link = DEFAULT_URL."/sitemgr/".ARTICLE_FEATURE_FOLDER."/view.php?id=".$article["id"];
					?>
					<tr>
						<td><a href="<?=$article_link?>" title="<?=$article["title"]?>"><?=( string_strlen($article["title"]) > 70 ) ? ( string_substr($article["title"],0,67)."..." ) : ( $article["title"] )?></a></td>
						<td><?=$status->getStatusWithStyle($article["status"])?></td>
					</tr>
					<?
				}
				?>

			</table>

			<?
		}
	}
	?>

	<?
	if(PAYMENT_FEATURE == "on") {
		if (CREDITCARDPAYMENT_FEATURE == "on" || MANUALPAYMENT_FEATURE == "on") {
			if (CUSTOM_INVOICE_FEATURE == "on") {

				$sql = "SELECT * FROM CustomInvoice WHERE account_id = $id ORDER BY id DESC";
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				$r = $db->query($sql);

				if ($r && mysql_num_rows($r)>0) {
					$error = 0;
					?>

					<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

						<tr>
							<th colspan="4"><span class="viewAllItems"><?=((mysql_num_rows($r)>5) ? "<a href='".DEFAULT_URL."/sitemgr/custominvoices/search.php?search_account_id=".$id."&search_submit=Search'>".ucfirst(system_showText(LANG_SITEMGR_MORE))." ".string_ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE_PLURAL))." &raquo;</a>" : "")?></span><?=string_ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE_PLURAL))?></th>
						</tr>

						<tr>
							<td width="40%"><strong><?=system_showText(LANG_SITEMGR_LABEL_INVOICETITLE)?></strong></td>
							<td width="20%"><strong><?=system_showText(LANG_SITEMGR_DATE)?></strong></td>
							<td width="20%"><strong><?=system_showText(LANG_SITEMGR_STATUS)?></strong></td>
							<td width="20%"><strong><?=system_showText(LANG_SITEMGR_LABEL_AMOUNT)?></strong></td>
						</tr>

						<?
						$count = 0;
						while (($custom_invoice = mysql_fetch_assoc($r)) && ($count<5)) {
							$count++;
							$custom_invoice_link = DEFAULT_URL."/sitemgr/custominvoices/view.php?id=".$custom_invoice["id"];
							?>
							<tr>
								<td><a href="<?=$custom_invoice_link?>" title="<?=$custom_invoice["title"]?>"><?=( string_strlen($custom_invoice["title"]) > 70 ) ? ( string_substr($custom_invoice["title"],0,67)."..." ) : ( $custom_invoice["title"] )?></a></td>
								<td><?=format_date($custom_invoice["date"])?></td>
								<td><?=($custom_invoice["paid"] == "y" ? "<span class=\"status-active\">".system_showText(LANG_SITEMGR_CUSTOMINVOICE_PAID)."</span>" : ($custom_invoice["sent"] == "y" ? "<span class=\"status-deactive\">".system_showText(LANG_SITEMGR_CUSTOMINVOICE_SENT)."</span>" : "<span class=\"status-pending\">".system_showText(LANG_SITEMGR_CUSTOMINVOICE_NOTSENT)."</span>"))?></td>
								<td><?=$custom_invoice["amount"]?></td>
							</tr>
							<?
						}
						?>

					</table>

					<?
				}

			}
		}
	}
	?>

	<?
		if ($error) {
			$aDomainObj = new Account_Domain();
			$allDomains = $aDomainObj->getAll($id);

			$hasItems = false;
			if ($allDomains) {
				foreach ($allDomains as $domain) {
					unset($dObj, $auxDbDomain);
					$auxDbDomain = db_getDBObjectByDomainID($domain, $dbMain);

					$sql = "SELECT COUNT(`id`) AS `Total` FROM `Listing` WHERE `account_id` = $id";
					$res = $auxDbDomain->Query($sql);
					$row = mysql_fetch_assoc($res);
					if ($row["Total"]) {
						$dObj = new Domain($domain);
						$hasItems[$domain]["domain_name"] = $dObj->getString("name");
						$hasItems[$domain]["domain_id"] = $domain;
						$hasItems[$domain]["status"] = true;
					}

					if (!$hasItems[$domain]["status"] && domain_findConstants("EVENT_FEATURE", $domain) == "on") {
						$sql = "SELECT COUNT(`id`) AS `Total` FROM `Event` WHERE `account_id` = $id";
						$res = $auxDbDomain->Query($sql);
						$row = mysql_fetch_assoc($res);
						if ($row["Total"]) {
							$dObj = new Domain($domain);
							$hasItems[$domain]["domain_name"] = $dObj->getString("name");
							$hasItems[$domain]["domain_id"] = $domain;
							$hasItems[$domain]["status"] = true;
						}
					}

					if (!$hasItems[$domain]["status"] && domain_findConstants("CLASSIFIED_FEATURE", $domain) == "on") {
						$sql = "SELECT COUNT(`id`) AS `Total` FROM `Classified` WHERE `account_id` = $id";
						$res = $auxDbDomain->Query($sql);
						$row = mysql_fetch_assoc($res);
						if ($row["Total"]) {
							$dObj = new Domain($domain);
							$hasItems[$domain]["domain_name"] = $dObj->getString("name");
							$hasItems[$domain]["domain_id"] = $domain;
							$hasItems[$domain]["status"] = true;
						}
					}

					if (!$hasItems[$domain]["status"] && domain_findConstants("BANNER_FEATURE", $domain) == "on") {
						$sql = "SELECT COUNT(`id`) AS `Total` FROM `Banner` WHERE `account_id` = $id";
						$res = $auxDbDomain->Query($sql);
						$row = mysql_fetch_assoc($res);
						if ($row["Total"]) {
							$dObj = new Domain($domain);
							$hasItems[$domain]["domain_name"] = $dObj->getString("name");
							$hasItems[$domain]["domain_id"] = $domain;
							$hasItems[$domain]["status"] = true;
						}
					}

					if (!$hasItems[$domain]["status"] && domain_findConstants("ARTICLE_FEATURE", $domain) == "on") {
						$sql = "SELECT COUNT(`id`) AS `Total` FROM `Article` WHERE `account_id` = $id";
						$res = $auxDbDomain->Query($sql);
						$row = mysql_fetch_assoc($res);
						if ($row["Total"]) {
							$dObj = new Domain($domain);
							$hasItems[$domain]["domain_name"] = $dObj->getString("name");
							$hasItems[$domain]["domain_id"] = $domain;
							$hasItems[$domain]["status"] = true;
						}
					}

					if(!$hasItems[$domain]["status"] && domain_findConstants("PAYMENT_FEATURE", $domain) == "on") {
						if (domain_findConstants("CREDITCARDPAYMENT_FEATURE", $domain) == "on" || domain_findConstants("MANUALPAYMENT_FEATURE", $domain) == "on") {
							if (domain_findConstants("CUSTOM_INVOICE_FEATURE", $domain) == "on") {
								$sql = "SELECT COUNT(`id`) AS `Total` FROM `CustomInvoice` WHERE `account_id` = $id";
								$res = $auxDbDomain->Query($sql);
								$row = mysql_fetch_assoc($res);
								if ($row["Total"]) {
									$dObj = new Domain($domain);
									$hasItems[$domain]["domain_name"] = $dObj->getString("name");
									$hasItems[$domain]["domain_id"] = $domain;
									$hasItems[$domain]["status"] = true;
								}
							}
						}
					}
				}
			}
		}

		if ($hasItems) {
			$error = 0;
			$msgItems = system_showText(LANG_SITEMGR_MSG_ACCOUNT_ITEMS1)." ";
			$_http_host = str_replace(EDIRECTORY_FOLDER, "", DEFAULT_URL);
			unset($arrDomains, $lastDomain);
			$i = 1;
			foreach ($hasItems as $items) {
				if (count($hasItems) >= 2 && $i == count($hasItems)) {
					$lastDomain = "<a href=\"javascript:void(0);\" onclick=\"changeDomainInfo(".$items["domain_id"].", '".$_http_host."', '".$_SERVER["REQUEST_URI"]."','".$_SERVER["QUERY_STRING"]."','".(sess_getAccountIdFromSession()? "true" : "false")."');\">".$items["domain_name"]."</a>";
				} else {
					$arrDomains[] = "<a href=\"javascript:void(0);\" onclick=\"changeDomainInfo(".$items["domain_id"].", '".$_http_host."', '".$_SERVER["REQUEST_URI"]."','".$_SERVER["QUERY_STRING"]."','".(sess_getAccountIdFromSession()? "true" : "false")."');\">".$items["domain_name"]."</a>";
				}
				$i++;
			}
			$msgItems .= implode(", ", $arrDomains).($lastDomain ? " ".system_showText(LANG_SITEMGR_AND)." ".$lastDomain : "");
			$msgItems .= ". ".system_showText(LANG_SITEMGR_MSG_ACCOUNT_ITEMS2);
		}
	?>

	<? if ($msgItems) { ?>
		<p class="informationMessage"><?=$msgItems?></p>
	<? } ?>

	<? if ($error) { ?>
		<p class="informationMessage"><?=system_showText(LANG_SITEMGR_ACCOUNT_THEREARENOITEMS)?></p>
	<? } ?>
