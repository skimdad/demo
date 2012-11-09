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
	# * FILE: /sitemgr/deal/view_paging.php
	# ----------------------------------------------------------------------------------------------------

	?>

<script type="text/javascript">

	function pageResults(url, feature, message, direction, promotion_id) {

		url = "getMoreResults.php?"+url+"&searchFor="+feature+"&promotion_id="+promotion_id+"&direction="+direction+"&screen="+$("#lm_"+feature).val();
		var xmlhttp;
		try {
			xmlhttp = new XMLHttpRequest();
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					xmlhttp = false;
				}
			}
		}
		if (xmlhttp) {
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 1) {
					document.getElementById("dinamic_"+feature).innerHTML="<div style=\"height:238px; padding-top:160px; font-family: trebuchet MS, arial; font-weight: bold; font-size: 14px; \"><p style=\"text-align: center;\">"+message+"</p></div>";
				}
				if (xmlhttp.readyState == 4) {
					if (xmlhttp.status == 200) {
						document.getElementById("dinamic_"+feature).innerHTML=xmlhttp.responseText;
					}
				}
			}
			xmlhttp.open("GET", url, true);
			xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=iso-8859-1")
			xmlhttp.send(null);
		}
	}

</script>

<div>
	<?
	$no_regs = true;

	$features_array = array();

	array_push($features_array, "facebooked");
	array_push($features_array, "twittered");
	array_push($features_array, "nofacebook");

	$search_limit = RESULTS_PER_PAGE;
	$limit_multiplier = 1;

	$feature = "facebooked";
	$msgdiv = system_showText(LANG_LABEL_REDEEM_STATISTICS);

	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------

	$url_redirect = DEFAULT_URL."/sitemgr/".PROMOTION_FEATURE_FOLDER."/view.php?id=$id";

	$pageObj = new pageBrowsing("Promotion_Redeem", $screen, $search_limit, "id DESC", "false", false, "promotion_id = $id", "*", false, false, false, SELECTED_DOMAIN_ID);
	$dealsInfo = $pageObj->retrievePage("array");

	$total_records = $pageObj->getString("record_amount");

	if ($no_regs) $no_regs = false;

	# SEE MORE BUTTON  ----------------------------------------------------------------------------------------------
	$seeMoreButton = $pageObj->getPagesButtonsDeal($feature, 1, $search_limit, $total_records, "this.form.submit();", $id);

	?>
	<div id="content-content">
		<div class="default-margin">
			<?if (string_strpos($_SERVER["PHP_SELF"], "/members") !== false){?>

				<h2 class="standardSubTitle" >
					<?=$msgdiv?>
				</h2>

			<? } else { ?>

			<div id="header-view">
				<?=$msgdiv?>
			</div>
			<? } ?>

			<table  border="0" cellpadding="0" cellspacing="0" align="center" class="pagingContent">
				<tr><td><?=(intval($total_records) != 1 ? system_showText(LANG_PAGING_FOUND_PLURAL) : system_showText(LANG_PAGING_FOUND))?> <b><?=$total_records?></b> <?=(($total_records!=1)?(system_showText(LANG_PAGING_RECORD_PLURAL)):(system_showText(LANG_PAGING_RECORD)))?></td></tr>
			</table>
			<div id="dinamic_<?=$feature?>"> <?
				if ($dealsInfo) { ?>
					<? if ($total_records >= $search_limit) { ?>
						<table border="0" cellpadding="0" cellspacing="0" align="center" class="pagingContent">
							<tr>
								<td>
									<?=$seeMoreButton?>
								</td>
							</tr>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" align="center" class="pagingContent">
							<tr>
								<td>
									<?=system_showText(LANG_PAGING_SHOWINGPAGE)?> <strong><?=$pageObj->getString("screen")?></strong> <?=system_showText(LANG_PAGING_PAGEOF)?> <strong><?=$pageObj->getString("pages")?></strong> <?=(intval($pageObj->getString("record_amount")) <= 1 ? system_showText(LANG_PAGING_PAGEOF) : system_showText(LANG_PAGING_PAGE_PLURAL))?>
								</td>
							</tr>
						</table>

					<? } ?>
					<? include(INCLUDES_DIR."/tables/table_deal.php"); ?>
					<input id="lm_<?=string_strtolower($feature)?>" name="limit_multiplier_<?=string_strtolower($feature)?>" type="hidden" value="<?=$limit_multiplier?>" />
					<?
				} else { ?>
					<p class="informationMessage">
						<?=system_showText(LANG_DEAL_NO_RECORD)?>
					</p>
				<? } ?>
			</div>
		</div>
	</div>
	<div id="bottom-content">&nbsp;</div>

</div>