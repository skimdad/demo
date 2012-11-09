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
	# * FILE: /includes/forms/form_classifiedcategory.php
	# ----------------------------------------------------------------------------------------------------
	
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$todo = "n";
	$checkbox_todo = "n";
	$review_todo = "n";

	if (!$_SESSION[SESS_SM_ID]) {
		$dbObj = db_getDBObJect(DEFAULT_DB,true);
		$dbObjSecond = db_getDBObjectByDomainID($_GET["domain_id"],$dbObj);
		$sql = "SELECT * FROM Setting WHERE name LIKE 'todo_%'";
		$result = $dbObjSecond->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			if ($row["value"] == "yes") {
				$todo = "y";
				$checkbox_todo = "y";
			}
		}
		unset($dbObj);
		unset($dbObjSecond);
	}

	if ($todo == "y") { ?>
		<div class="todoItems" style="text-align:center;">
				<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

					<tr>
						<? if ($checkbox_todo == "y") { ?>
							<th style="width: 45px; text-align: center;"><?=system_showText(LANG_SITEMGR_TODO_DONE)?></th>
						<? } ?>
						<th <? if ($checkbox_todo != "y") { echo "colspan=\"2\""; } ?> style="width: 100%"><?=system_showText(LANG_SITEMGR_TODO_ITEMS)?></th>
					</tr>

					<? if (!$_SESSION[SESS_SM_ID]) { ?>

						<?
						setting_get("todo_emailconfig", $todo_emailconfig);
						if ($todo_emailconfig == "yes") {
						?>
						<tr id="todo_emailconfig">
							<td><center><input type="checkbox" name="item_done[]" value="todo_emailconfig" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
							<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/prefs/emailconfig.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_EMAILCONFIG)?></a></td>
						</tr>
						<?
						}
						?>

						<?
						setting_get("todo_approvalconfig", $todo_approvalconfig);
						if ($todo_approvalconfig == "yes") {
						?>
						<tr id="todo_approvalconfig">
							<td><center><input type="checkbox" name="item_done[]" value="todo_approvalconfig" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
							<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/prefs/approvalrequirement.php');" class="link-table"><?=system_showText(LANG_SITEMGR_SETTINGS_CONFIGURE_APPROVAL)?></a></td>
						</tr>
						<?
						}
						?>

						<?
						setting_get("todo_featuredcategory", $featuredcategory);
						if ($featuredcategory == "yes") {
						?>
						<tr id="todo_featuredcategory">
							<td><center><input type="checkbox" name="item_done[]" value="todo_featuredcategory" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
							<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/prefs/featuredcategory.php');" class="link-table"><?=system_showText(LANG_SITEMGR_SETTINGS_CONFIGURE_FEATURED_CATEGORY)?></a></td>
						</tr>
						<?
						}
						?>

						<?
						setting_get("todo_langcenter", $todo_langcenter);
						if ($todo_langcenter == "yes") {
						?>
						<tr id="todo_langcenter">
							<td><center><input type="checkbox" name="item_done[]" value="todo_langcenter" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
							<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/langcenter');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_LANGCENTER)?></a></td>
						</tr>
						<?
						}
						?>

						<?
						setting_get("todo_levels", $todo_levels);
						if ($todo_levels == "yes") {
						?>
						<tr id="todo_levels">
							<td><center><input type="checkbox" name="item_done[]" value="todo_levels" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
							<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/prefs/levels.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_LEVELS)?></a></td>
						</tr>
						<?
						}
						?>

						<?
						setting_get("todo_locations", $todo_locations);
						if ($todo_locations == "yes") {
						?>
						<tr id="todo_locations">
							<td><center><input type="checkbox" name="item_done[]" value="todo_locations" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
							<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/prefs/location.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_LOCATIONS)?></a></td>
						</tr>
						<?
						}
						?>

						<?
						setting_get("todo_seocenter", $todo_seocenter);
						if ($todo_seocenter == "yes") {
							?>
							<tr id="todo_seocenter">
								<td><center><input type="checkbox" name="item_done[]" value="todo_seocenter" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
								<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/seocenter.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SEOCENTER)?></a></td>
							</tr>
							<?
						}
						?>

						<?
						setting_get("todo_listingtemplate", $todo_listingtemplate);
						if ($todo_listingtemplate == "yes" && LISTINGTEMPLATE_FEATURE == "on" && !USING_THEME_TEMPLATE) {
							?>
							<tr id="todo_listingtemplate">
								<td><center><input type="checkbox" name="item_done[]" value="todo_listingtemplate" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
								<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/listingtemplate/');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPTEMPLATES)?></a></td>
							</tr>
							<?
						}
						?>

						<?
						setting_get("todo_pricing", $todo_pricing);
						if ($todo_pricing == "yes") {
							?>
							<tr id="todo_pricing">
								<td><center><input type="checkbox" name="item_done[]" value="todo_pricing" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
								<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/prefs/pricing.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPPRICEINFO)?></a></td>
							</tr>
							<?
						}
						?>

						<?
						setting_get("todo_invoice", $todo_invoice);
						if ($todo_invoice == "yes") {
							?>
							<tr id="todo_invoice">
								<td><center><input type="checkbox" name="item_done[]" value="todo_invoice" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
								<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/prefs/invoice.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPINVOICEINFO)?></a></td>
							</tr>
							<?
						}
						?>

						<?
						setting_get("todo_setting_tax", $todo_setting_tax);
						if ($todo_setting_tax == "yes") {
							?>
							<tr id="todo_setting_tax">
								<td><center><input type="checkbox" name="item_done[]" value="todo_setting_tax" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
								<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/prefs/tax.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETTING_TAX)?></a></td>
							</tr>
							<?
						}
						?>

						<?
						setting_get("todo_email", $todo_email);
						if ($todo_email == "yes") {
							?>
							<tr id="todo_email">
								<td><center><input type="checkbox" name="item_done[]" value="todo_email" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
								<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/prefs/email.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_CONFADMINEMAIL)?></a></td>
							</tr>
							<?
						}
						?>

						<?
						setting_get("todo_emailnotification", $todo_emailnotification);
						if ($todo_emailnotification == "yes") {
							?>
							<tr id="todo_emailnotification">
								<td><center><input type="checkbox" name="item_done[]" value="todo_emailnotification" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
								<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/emailnotifications/index.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPEMAILNOTIF)?></a></td>
							</tr>
							<?
						}
						?>

						<?
						setting_get("todo_sitecontent", $todo_sitecontent);
						if ($todo_sitecontent == "yes") {
							?>
							<tr id="todo_sitecontent">
								<td><center><input type="checkbox" name="item_done[]" value="todo_sitecontent" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
								<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/content/index.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPSITECONTENT)?></a></td>
							</tr>
							<?
						}
						?>

						<?
						setting_get("todo_googleads", $todo_googleads);
						if ($todo_googleads == "yes" && GOOGLE_ADS_ENABLED == "on") {
							?>
							<tr id="todo_googleads">
								<td><center><input type="checkbox" name="item_done[]" value="todo_googleads" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
								<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/googleprefs/googleads.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPGOOGLEADS)?></a></td>
							</tr>
							<?
						}
						?>

						<?
						setting_get("todo_googlemaps", $todo_googlemaps);
						if ($todo_googlemaps == "yes" && GOOGLE_MAPS_ENABLED == "on") {
							?>
							<tr id="todo_googlemaps">
								<td><center><input type="checkbox" name="item_done[]" value="todo_googlemaps" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
								<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/googleprefs/googlemaps.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPGOOGLEMAPS)?></a></td>
							</tr>
							<?
						}
						?>

						<?
						setting_get("todo_googleanalytics", $todo_googleanalytics);
						if ($todo_googleanalytics == "yes" && GOOGLE_ANALYTICS_ENABLED == "on") {
							?>
							<tr id="todo_googleanalytics">
								<td><center><input type="checkbox" name="item_done[]" value="todo_googleanalytics" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
								<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/googleprefs/googleanalytics.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPGOOGLEANALYTICS)?></a></td>
							</tr>
							<?
						}
						?>

						<?
						setting_get("todo_headerlogo", $todo_headerlogo);
						if ($todo_headerlogo == "yes") {
							?>
							<tr id="todo_headerlogo">
								<td><center><input type="checkbox" name="item_done[]" value="todo_headerlogo" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
								<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/content/content_header.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPHEADERLOGO)?></a></td>
							</tr>
							<?
						}
						?>

						<?
						setting_get("todo_noimage", $todo_noimage);
						if ($todo_noimage == "yes") {
							?>
							<tr id="todo_noimage">
								<td><center><input type="checkbox" name="item_done[]" value="todo_noimage" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
								<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/content/content_noimage.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPNOIMAGE)?></a></td>
							</tr>
							<?
						}
						?>

						<?
						setting_get("todo_claim", $todo_claim);
						if ($todo_claim == "yes") {
							?>
							<tr id="todo_claim">
								<td><center><input type="checkbox" name="item_done[]" value="todo_claim" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></center></td>
								<td><a href="javascript:void(0);" onclick="redirect('<?=DEFAULT_URL?>/sitemgr/prefs/claim.php');" class="link-table"><?=system_showText(LANG_SITEMGR_TODO_SETUPCLAIM)?></a></td>
							</tr>
							<?
						}
						?>
					<? } ?>
				</table>
		</div>
		<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE todoDontShow">
			<tr id="dont_show">
				<td style="width: 30px; text-align: right;"><input type="checkbox" value="dont_show" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>',this.value, false, <?=$_GET["domain_id"]?>);" class="inputCheck" /></td>
				<td><a href="javascript:void(0);" onclick="todoConfirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>', 'dont_show_link');"><?=system_showText(LANG_SITEMGR_TODO_DO_NOT_SHOW)?></a></td>
			</tr>
		</table>

<script type="text/javascript">
	function todoConfirm(msg, value, cancel, domain){
		if (cancel) {
			$("#" + value).find("input[type=checkbox]").attr('checked', false);
			$(".confirmation").remove();
			if(value == "dont_show"){
				$('.todoItems').animate({
					height: 374
				}, 500);
			}
		} else {
			var html;
			var check;
			if (value == "dont_show_link") {
				value = "dont_show";
				check = $("#" + value).find("input[type=checkbox]").attr('checked');
				$("#" + value).find("input[type=checkbox]").attr('checked', !check);
			}

			check = $("#" + value).find("input[type=checkbox]").attr('checked');
			
			$("table").find("input[type=checkbox]").attr('checked', false);
			$(".confirmation").remove();

			if(check){
				$("#" + value).find("input[type=checkbox]").attr('checked', true);
				html =	"<tr class=\"confirmation\">";
				html +=	"	<td colspan=\"2\">";
				html +=	"		<table align=\"center\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\" class=\"standard-innerTable\">";
				html +=	"			<tr>";
				html +=	"				<td>";
				html +=	"					<p class=\"informationMessage\">" + msg + "</p>";
				html +=	"				</td>";
				html +=	"			</tr>";
				html +=	"			<tr>";
				html +=	"				<td>";
				html +=	"					<button type=\"submit\" value=\"Submit\" class=\"input-button-form\" onclick=\"sendTodo('" + value + "', " + domain + ");\"><?=system_showText(LANG_SITEMGR_YES)?></button>";
				html +=	"					<button type=\"reset\"class=\"input-button-form\" onclick=\"todoConfirm('" + msg + "', '" + value + "', true);\"><?=system_showText(LANG_SITEMGR_NO)?></button>";
				html +=	"				</td>";
				html +=	"			</tr>";
				html += "		</table>";
				html +=	"	</td>";
				html +=	"</tr>";

				if($('.todoItems').height() < 374){
					$('.todoItems').animate({
						height: 374
					}, 500);
				}
				if(value == "dont_show"){
					$('.todoItems').animate({
						height: 249
					}, 500, function(){
						$("#" + value).after(html);
					});
				} else {
					$("#" + value).after(html);

					$('html, body, div').animate({
						scrollTop: $(".confirmation").offset().top
					}, 500);
				}
			} else {
				$(".confirmation").remove();
				if(value == "dont_show"){
					$('.todoItems').animate({
						height: 374
					}, 500);
				}
			}
		}
	}

	function sendTodo(value, domain) {
		$.post(DEFAULT_URL + "/includes/code/getstarted.php", {
			setting: value,
			domain: domain
		}, function(ret){
			if(ret == "dont_show"){
				parent.$.fancybox.close();
			} else {
				todoConfirm('', value, true, domain);
				$("#" + value).remove();
				if (ret == 0) {
					$('.todoItems table, .todoDontShow').fadeTo(500, 0, function(){
						$('.wrapper').html("<p class=\"successMessage\"><?=system_showText(LANG_SITEMGR_MSG_GETSTARTED);?></p>");
					});
				}
			}
		})
	}

	function redirect(url){
		self.parent.location = url;
	}
</script>
<?}?>