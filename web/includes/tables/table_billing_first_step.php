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
	# * FILE: /includes/tables/table_billing_first_step.php
	# ----------------------------------------------------------------------------------------------------

	if ((!$bill_info["listings"]) && (!$bill_info["events"]) && (!$bill_info["banners"]) && (!$bill_info["classifieds"]) && (!$bill_info["articles"]) && (!$bill_info["custominvoices"])) {
		echo "<p class=\"informationMessage\">".system_showText(LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT)."</p>";
	} else {

?>

		<script>

			function toggleAll(obj, lnk){

				var value = obj.checked;
				var trElements = document.getElementsByTagName('tr');

				if(lnk == true){
					if(value == true){
						obj.checked = false;
						value = false;
					} else {
						obj.checked = true;
						value = true;
					}
				}

				for(i=0; i < trElements.length ; i++){
					for(j=0; j < trElements.item(i).childNodes.length; j++){
						if(trElements.item(i).childNodes[j].firstChild) {
							if(trElements.item(i).childNodes[j].firstChild.id == "listing_id[]"){
								if(value == true) {
									trElements.item(i).childNodes[j].firstChild.checked = true;
									trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.className = 'bg-tablebilling-active';
									for(x=0; x < trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes.length; x++) {
										if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild){
											if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.name == "discountlisting_id[]"){
												trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.disabled= false;
											}
										}
									}
								} else {
									trElements.item(i).childNodes[j].firstChild.checked = false;
									trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.className = 'bg-tablebilling-inactive';
									for(x=0; x < trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes.length; x++) {
										if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild){
											if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.name == "discountlisting_id[]"){
												trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.disabled= true;
											}
										}
									}
								}
							}
							if(trElements.item(i).childNodes[j].firstChild.id == "event_id[]"){
								if(value == true) {
									trElements.item(i).childNodes[j].firstChild.checked = true;
									trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.className = 'bg-tablebilling-active';
									for(x=0; x < trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes.length; x++) {
										if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild){
											if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.name == "discountevent_id[]"){
												trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.disabled= false;
											}
										}
									}
								} else {
									trElements.item(i).childNodes[j].firstChild.checked = false;
									trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.className = 'bg-tablebilling-inactive';
									for(x=0; x < trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes.length; x++) {
										if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild){
											if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.name == "discountevent_id[]"){
												trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.disabled= true;
											}
										}
									}
								}
							}
							if(trElements.item(i).childNodes[j].firstChild.id == "banner_id[]"){
								if(value == true) {
									trElements.item(i).childNodes[j].firstChild.checked = true;
									trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.className = 'bg-tablebilling-active';
									for(x=0; x < trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes.length; x++) {
										if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild){
											if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.name == "discountbanner_id[]"){
												trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.disabled= false;
											}
										}
									}
								} else {
									trElements.item(i).childNodes[j].firstChild.checked = false;
									trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.className = 'bg-tablebilling-inactive';
									for(x=0; x < trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes.length; x++) {
										if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild){
											if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.name == "discountbanner_id[]"){
												trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.disabled= true;
											}
										}
									}
								}
							}
							if(trElements.item(i).childNodes[j].firstChild.id == "classified_id[]"){
								if(value == true) {
									trElements.item(i).childNodes[j].firstChild.checked = true;
									trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.className = 'bg-tablebilling-active';
									for(x=0; x < trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes.length; x++) {
										if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild){
											if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.name == "discountclassified_id[]"){
												trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.disabled= false;
											}
										}
									}
								} else {
									trElements.item(i).childNodes[j].firstChild.checked = false;
									trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.className = 'bg-tablebilling-inactive';
									for(x=0; x < trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes.length; x++) {
										if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild){
											if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.name == "discountclassified_id[]"){
												trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.disabled= true;
											}
										}
									}
								}
							}
							if(trElements.item(i).childNodes[j].firstChild.id == "article_id[]"){
								if(value == true) {
									trElements.item(i).childNodes[j].firstChild.checked = true;
									trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.className = 'bg-tablebilling-active';
									for(x=0; x < trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes.length; x++) {
										if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild){
											if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.name == "discountarticle_id[]"){
												trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.disabled= false;
											}
										}
									}
								} else {
									trElements.item(i).childNodes[j].firstChild.checked = false;
									trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.className = 'bg-tablebilling-inactive';
									for(x=0; x < trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes.length; x++) {
										if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild){
											if(trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.name == "discountarticle_id[]"){
												trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.childNodes[x].firstChild.disabled= true;
											}
										}
									}
								}
							}
							if(trElements.item(i).childNodes[j].firstChild.id == "custom_invoice_id[]"){
								if(value == true) {
									trElements.item(i).childNodes[j].firstChild.checked = true;
									trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.className = 'bg-tablebilling-active';
								} else {
									trElements.item(i).childNodes[j].firstChild.checked = false;
									trElements.item(i).childNodes[j].firstChild.parentNode.parentNode.className = 'bg-tablebilling-inactive';
								}
							}
						}
					}
				}
			}

			function toggleLinebyChkBox(obj){
				if (obj.checked == true){
					obj.parentNode.parentNode.className = 'bg-tablebilling-active';
					for(x=0; x < obj.parentNode.parentNode.childNodes.length; x++){
						if(obj.parentNode.parentNode.childNodes[x].firstChild){
							if ((obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountlisting_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountevent_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountbanner_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountclassified_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountarticle_id[]")) {
								obj.parentNode.parentNode.childNodes[x].firstChild.disabled= false;
							}
						}
					}
				} else {
					obj.parentNode.parentNode.className = 'bg-tablebilling-inactive';
					for(x=0; x < obj.parentNode.parentNode.childNodes.length; x++){
						if(obj.parentNode.parentNode.childNodes[x].firstChild){
							if ((obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountlisting_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountevent_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountbanner_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountclassified_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountarticle_id[]")) {
								obj.parentNode.parentNode.childNodes[x].firstChild.disabled= true;
							}
						}
					}
				}
			}

			function toggleLine(obj){
				for(i=0; i < obj.childNodes.length; i++){
					if(obj.childNodes[i].firstChild) {
						if(obj.childNodes[i].firstChild.id == "listing_id[]") {
							if(obj.childNodes[i].firstChild.checked == true) {
								obj.className = 'bg-tablebilling-inactive';
								obj.childNodes[i].firstChild.checked = false;
								for(x=0; x < obj.childNodes.length; x++){
									if(obj.childNodes[x].firstChild){
										if(obj.childNodes[x].firstChild.name == "discountlisting_id[]"){
											obj.childNodes[x].firstChild.disabled= true;
										}
									}
								}
							} else {
								obj.childNodes[i].firstChild.checked = true;
								obj.className = 'bg-tablebilling-active';
								for(x=0; x < obj.childNodes.length; x++){
									if(obj.childNodes[x].firstChild){
										if(obj.childNodes[x].firstChild.name == "discountlisting_id[]"){
											obj.childNodes[x].firstChild.disabled= false;
										}
									}
								}
							}
						}
						if(obj.childNodes[i].firstChild.id == "event_id[]") {
							if(obj.childNodes[i].firstChild.checked == true) {
								obj.className = 'bg-tablebilling-inactive';
								obj.childNodes[i].firstChild.checked = false;
								for(x=0; x < obj.childNodes.length; x++){
									if(obj.childNodes[x].firstChild){
										if(obj.childNodes[x].firstChild.name == "discountevent_id[]"){
											obj.childNodes[x].firstChild.disabled= true;
										}
									}
								}
							} else {
								obj.childNodes[i].firstChild.checked = true;
								obj.className = 'bg-tablebilling-active';
								for(x=0; x < obj.childNodes.length; x++){
									if(obj.childNodes[x].firstChild){
										if(obj.childNodes[x].firstChild.name == "discountevent_id[]"){
											obj.childNodes[x].firstChild.disabled= false;
										}
									}
								}
							}
						}
						if(obj.childNodes[i].firstChild.id == "banner_id[]") {
							if(obj.childNodes[i].firstChild.checked == true) {
								obj.className = 'bg-tablebilling-inactive';
								obj.childNodes[i].firstChild.checked = false;
								for(x=0; x < obj.childNodes.length; x++){
									if(obj.childNodes[x].firstChild){
										if(obj.childNodes[x].firstChild.name == "discountbanner_id[]"){
											obj.childNodes[x].firstChild.disabled= true;
										}
									}
								}
							} else {
								obj.childNodes[i].firstChild.checked = true;
								obj.className = 'bg-tablebilling-active';
								for(x=0; x < obj.childNodes.length; x++){
									if(obj.childNodes[x].firstChild){
										if(obj.childNodes[x].firstChild.name == "discountbanner_id[]"){
											obj.childNodes[x].firstChild.disabled= false;
										}
									}
								}
							}
						}
						if(obj.childNodes[i].firstChild.id == "classified_id[]") {
							if(obj.childNodes[i].firstChild.checked == true) {
								obj.className = 'bg-tablebilling-inactive';
								obj.childNodes[i].firstChild.checked = false;
								for(x=0; x < obj.childNodes.length; x++){
									if(obj.childNodes[x].firstChild){
										if(obj.childNodes[x].firstChild.name == "discountclassified_id[]"){
											obj.childNodes[x].firstChild.disabled= true;
										}
									}
								}
							} else {
								obj.childNodes[i].firstChild.checked = true;
								obj.className = 'bg-tablebilling-active';
								for(x=0; x < obj.childNodes.length; x++){
									if(obj.childNodes[x].firstChild){
										if(obj.childNodes[x].firstChild.name == "discountclassified_id[]"){
											obj.childNodes[x].firstChild.disabled= false;
										}
									}
								}
							}
						}
						if(obj.childNodes[i].firstChild.id == "article_id[]") {
							if(obj.childNodes[i].firstChild.checked == true) {
								obj.className = 'bg-tablebilling-inactive';
								obj.childNodes[i].firstChild.checked = false;
								for(x=0; x < obj.childNodes.length; x++){
									if(obj.childNodes[x].firstChild){
										if(obj.childNodes[x].firstChild.name == "discountarticle_id[]"){
											obj.childNodes[x].firstChild.disabled= true;
										}
									}
								}
							} else {
								obj.childNodes[i].firstChild.checked = true;
								obj.className = 'bg-tablebilling-active';
								for(x=0; x < obj.childNodes.length; x++){
									if(obj.childNodes[x].firstChild){
										if(obj.childNodes[x].firstChild.name == "discountarticle_id[]"){
											obj.childNodes[x].firstChild.disabled= false;
										}
									}
								}
							}
						}
						if(obj.childNodes[i].firstChild.id == "custom_invoice_id[]") {
							if(obj.childNodes[i].firstChild.checked == true) {
								obj.className = 'bg-tablebilling-inactive';
								obj.childNodes[i].firstChild.checked = false;
							} else {
								obj.childNodes[i].firstChild.checked = true;
								obj.className = 'bg-tablebilling-active';
							}
						}
					}
				}
			}

		</script>
		
		<table border="0" cellpadding="2" cellspacing="2" class="standard-table tableTOPBLUECheck">
			<tr>
				<th><input type="checkbox" id="toggle_all" name="toggle_all" onclick="toggleAll(this)" /></th>
				<td><a onclick="toggleAll(document.getElementById('toggle_all'), true)"><?=system_showText(LANG_CHECK_UNCHECK_ALL);?></a></td>
			</tr>
		</table>

		<?

		if ($bill_info["listings"]) {
			?>

			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
				<tr>
					<th width="30"><?=system_showText(LANG_LABEL_PAY);?></th>
					<th><?=system_showText(LANG_LISTING_NAME);?></th>
					<th width="110"><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
					<th width="100"><?=system_showText(LANG_LABEL_LEVEL);?></th>
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<th width="140"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
						<? } ?>
					<? } ?>
					<th width="70"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
				</tr>
				<?
				foreach($bill_info["listings"] as $id => $info){
					$renewal_date_style = ($info["needtocheckout"] == "y") ? "color: #CC0000" : "";
					$checked = ($info["needtocheckout"] == "y") ? "checked" : "";
					?>
					<tr class="<?=(($checked) ? ("bg-tablebilling-active"): ("bg-tablebilling-inactive"))?>">
						<td><input type="checkbox" id="listing_id[]" name="listing_id[]" value="<?=$id?>" <?=$checked?> onclick="toggleLinebyChkBox(this)" class="inputCheck" /></td>
						<td style="text-align: left; cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=system_showTruncatedText($info["title"], 25);?><?=($info["listingtemplate"]?"<span class=\"itemNote\">(".$info["listingtemplate"].")</span>":"");?></td>
						<td style="cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=$info["extra_category_amount"]?></td>
						<td style="cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=string_ucwords($info["level"])?></td>
						<? if (PAYMENT_FEATURE == "on") { ?>
							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<td style="cursor: pointer; <?=$renewal_date_style?>"><input type="text" name="discountlisting_id[]" value="<?=$info["discount_id"]?>" <? if(!$checked) echo "disabled";?> style="width:60px;font-size:10px" />
							<? } ?>
						<? } ?>
						<td style="cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=(($info["renewal_date"] == "0000-00-00") ? system_showText(LANG_LABEL_NEW) : format_date($info["renewal_date"]))?></td>
					</tr>
					<?
				}
				?>
			</table>

			<?
		} else {
			if ($overlisting_msg) {
				echo "<p class=\"informationMessage\">".$overlisting_msg."</p>";
			}
		}

		if ($bill_info["events"]) {
			?>

			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
				<tr>
					<th width="30"><?=system_showText(LANG_LABEL_PAY);?></th>
					<th><?=system_showText(LANG_EVENT_NAME);?></th>
					<th width="100"><?=system_showText(LANG_LABEL_LEVEL);?></th>
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<th width="140"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
						<? } ?>
					<? } ?>
					<th width="70"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
				</tr>
				<?
				foreach($bill_info["events"] as $id => $info){
					$renewal_date_style = ($info["needtocheckout"] == "y") ? "color: #CC0000" : "";
					$checked = ($info["needtocheckout"] == "y") ? "checked" : "";
					?>
					<tr class="<?=(($checked) ? ("bg-tablebilling-active"): ("bg-tablebilling-inactive"))?>">
						<td><input type="checkbox" id="event_id[]" name="event_id[]" value="<?=$id?>" <?=$checked?> onclick="toggleLinebyChkBox(this)" class="inputCheck" /></td>
						<td style="text-align: left; cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=system_showTruncatedText($info["title"], 40);?></td>
						<td style="cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=string_ucwords($info["level"])?></td>
						<? if (PAYMENT_FEATURE == "on") { ?>
							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<td style="cursor: pointer; <?=$renewal_date_style?>"><input type="text" name="discountevent_id[]" value="<?=$info["discount_id"]?>" <? if(!$checked) echo "disabled";?> style="width:60px;font-size:10px" />
							<? } ?>
						<? } ?>
						<td style="cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=(($info["renewal_date"] == "0000-00-00") ? system_showText(LANG_LABEL_NEW) : format_date($info["renewal_date"]))?></td>
					</tr>
					<?
				}
				?>
			</table>

			<?
		} else {
			if ($overevent_msg) {
				echo "<p class=\"informationMessage\">".$overevent_msg."</p>";
			}
		}

		if ($bill_info["banners"]) {
			?>

			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
				<tr>
					<th width="30"><?=system_showText(LANG_LABEL_PAY);?></th>
					<th><?=system_showText(LANG_BANNER_NAME);?></th>
					<th width="100"><?=system_showText(LANG_LABEL_IMPRESSIONS)?></th>
					<th width="100"><?=system_showText(LANG_LABEL_LEVEL);?></th>
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<th width="140"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
						<? } ?>
					<? } ?>
					<th width="70"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
				</tr>
				<?
				foreach($bill_info["banners"] as $id => $info){
					$renewal_date_style = ($info["needtocheckout"] == "y") ? "color: #CC0000" : "";
					$checked = ($info["needtocheckout"] == "y") ? "checked" : "";
					?>
					<tr class="<?=(($checked) ? ("bg-tablebilling-active"): ("bg-tablebilling-inactive"))?>">
						<td><input type="checkbox" id="banner_id[]" name="banner_id[]" value="<?=$id?>" <?=$checked?> onclick="toggleLinebyChkBox(this)" class="inputCheck" /></td>
						<td style="text-align: left; cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=system_showTruncatedText($info["caption"], 30);?></td>
						<td style="cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=(($info["expiration_setting"] != BANNER_EXPIRATION_IMPRESSION) ? system_showText(LANG_LABEL_UNLIMITED) : $info["unpaid_impressions"])?></td>
						<td style="cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=string_ucwords($info["level"])?></td>
						<? if (PAYMENT_FEATURE == "on") { ?>
							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<td style="cursor: pointer; <?=$renewal_date_style?>"><input type="text" name="discountbanner_id[]" value="<?=$info["discount_id"]?>" <? if(!$checked) echo "disabled";?> style="width:60px;font-size:10px" />
							<? } ?>
						<? } ?>
						<td style="cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=(($info["expiration_setting"] != BANNER_EXPIRATION_RENEWAL_DATE) ? system_showText(LANG_LABEL_UNLIMITED) : (($info["renewal_date"] == "0000-00-00") ? system_showText(LANG_LABEL_NEW) : format_date($info["renewal_date"])))?></td>
					</tr>
					<?
				}
				?>
			</table>

			<?
		} else {
			if ($overbanner_msg) {
				echo "<p class=\"informationMessage\">".$overbanner_msg."</p>";
			}
		}

		if ($bill_info["classifieds"]) {
			?>

			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
				<tr>
					<th width="30"><?=system_showText(LANG_LABEL_PAY);?></th>
					<th><?=system_showText(LANG_CLASSIFIED_NAME);?></th>
					<th width="100"><?=system_showText(LANG_LABEL_LEVEL);?></th>
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<th width="140"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
						<? } ?>
					<? } ?>
					<th width="70"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
				</tr>
				<?
				foreach($bill_info["classifieds"] as $id => $info){
					$renewal_date_style = ($info["needtocheckout"] == "y") ? "color: #CC0000" : "";
					$checked = ($info["needtocheckout"] == "y") ? "checked" : "";
					?>
					<tr class="<?=(($checked) ? ("bg-tablebilling-active"): ("bg-tablebilling-inactive"))?>">
						<td><input type="checkbox" id="classified_id[]" name="classified_id[]" value="<?=$id?>" <?=$checked?> onclick="toggleLinebyChkBox(this)" class="inputCheck" /></td>
						<td style="text-align: left; cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=system_showTruncatedText($info["title"], 40);?></td>
						<td style="cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=string_ucwords($info["level"])?></td>
						<? if (PAYMENT_FEATURE == "on") { ?>
							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<td style="cursor: pointer; <?=$renewal_date_style?>"><input type="text" name="discountclassified_id[]" value="<?=$info["discount_id"]?>" <? if(!$checked) echo "disabled";?> style="width:60px;font-size:10px" />
							<? } ?>
						<? } ?>
						<td style="cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=(($info["renewal_date"] == "0000-00-00") ? system_showText(LANG_LABEL_NEW) : format_date($info["renewal_date"]))?></td>
					</tr>
					<?
				}
				?>
			</table>

			<?
		} else {
			if ($overclassified_msg) {
				echo "<p class=\"informationMessage\">".$overclassified_msg."</p>";
			}
		}

		if ($bill_info["articles"]) {
			?>

			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
				<tr>
					<th width="30"><?=system_showText(LANG_LABEL_PAY);?></th>
					<th><?=system_showText(LANG_ARTICLE_NAME);?></th>
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<th width="140"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
						<? } ?>
					<? } ?>
					<th width="70"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
				</tr>
				<?
				foreach($bill_info["articles"] as $id => $info){
					$renewal_date_style = ($info["needtocheckout"] == "y") ? "color: #CC0000" : "";
					$checked = ($info["needtocheckout"] == "y") ? "checked" : "";
					?>
					<tr class="<?=(($checked) ? ("bg-tablebilling-active"): ("bg-tablebilling-inactive"))?>">
						<td><input type="checkbox" id="article_id[]" name="article_id[]" value="<?=$id?>" <?=$checked?> onclick="toggleLinebyChkBox(this)" class="inputCheck" /></td>
						<td style="text-align: left; cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=system_showTruncatedText($info["title"], 50);?></td>
						<? if (PAYMENT_FEATURE == "on") { ?>
							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<td style="cursor: pointer; <?=$renewal_date_style?>"><input type="text" name="discountarticle_id[]" value="<?=$info["discount_id"]?>" <? if(!$checked) echo "disabled";?> style="width:60px;font-size:10px" />
							<? } ?>
						<? } ?>
						<td style="cursor: pointer; <?=$renewal_date_style?>" onclick="toggleLine(this.parentNode)"><?=(($info["renewal_date"] == "0000-00-00") ? system_showText(LANG_LABEL_NEW) : format_date($info["renewal_date"]))?></td>
					</tr>
					<?
				}
				?>
			</table>

			<?
		} else {
			if ($overarticle_msg) {
				echo "<p class=\"informationMessage\">".$overarticle_msg."</p>";
			}
		}

		if ($bill_info["custominvoices"]) {
			?>
			<table border="0" cellpadding="2" cellspacing="2" class="standard-table">
				<tr>
					<th class="standard-tabletitle"><?=system_showText(LANG_MSG_PAY_OUTSTANDING_INVOICES);?></th>
				</tr>
			</table>

			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
				<tr>
					<th width="30"><?=system_showText(LANG_LABEL_PAY);?></th>
					<th><?=system_showText(LANG_LABEL_TITLE);?></th>
					<th width="100"><?=system_showText(LANG_LABEL_ITEMS);?></th>
					<th width="140"><?=system_showText(LANG_LABEL_AMOUNT);?></th>
					<th width="70"><?=system_showText(LANG_LABEL_DATE);?></th>
				</tr>
				<?
				
				/* all checked by default */
				$checked = true;
				
				foreach($bill_info["custominvoices"] as $id => $info){
				?>
					<tr class="<?=(($checked) ? ("bg-tablebilling-active"): ("bg-tablebilling-inactive"))?>">
						<td><input type="checkbox" id="custom_invoice_id[]" name="custom_invoice_id[]" value="<?=$id?>" checked="checked" onclick="toggleLinebyChkBox(this)" class="inputCheck" /></td>
						<td style="text-align: left; cursor: pointer;" onclick="toggleLine(this.parentNode)"><?=$info["title"]?></td>
						<td><a href="<?=DEFAULT_URL?>/popup/popup.php?pop_type=custominvoice_items&id=<?=$info["id"]?>" class="link-table iframe fancy_window_custom" style="text-decoration: underline;"><?=ucfirst(system_showText(LANG_VIEWITEMS))?></a></td>
						<td style="cursor: pointer;" onclick="toggleLine(this.parentNode)"><?=$info["subtotal"]?></td>
						<td style="cursor: pointer;" onclick="toggleLine(this.parentNode)"><?=format_date($info["date"])?></td>
					</tr>
					<?
				}
				?>
			</table>
			<?
		}

		include(INCLUDES_DIR."/forms/form_paymentmethod.php");

		?>

		<br />
        <div class="baseButtons">
			<p class="standardButton">
				<input type="hidden" name="second_step" id="second_step" value="1" style="display: none" />
				<button type="submit"><?=system_showText(LANG_BUTTON_NEXT)?></button>
			</p>
        </div>

		<?

	}

?>
