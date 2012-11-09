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
	# * FILE: /members/event/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on") {
		header("Location: ".DEFAULT_URL."/members/");
		exit; 
	}

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$url_redirect = "".DEFAULT_URL."/members/".EVENT_FEATURE_FOLDER;
	$url_base     = "".DEFAULT_URL."/members";

	extract($_GET);
	extract($_POST);

	// Page Browsing /////////////////////////////////////////
	
	$sql_where[] = " account_id = $acctId ";
	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

	$pageObj = new pageBrowsing("Event", $screen, RESULTS_PER_PAGE, (($_GET["newest"])?("id DESC"):("level, title")),"title", $letter, $where);
	$events = $pageObj->retrievePage();

	$paging_url = DEFAULT_URL."/members/".EVENT_FEATURE_FOLDER."/index.php";

	// Letters Menu
	$letters = $pageObj->getString("letters");
	foreach ($letters as $each_letter) {
		if ($each_letter == "#") {
			$letters_menu .= "<a href=\"$paging_url?letter=no\" ".(($letter == "no") ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
			//$letters_menu .= "<a href=\"$paging_url\" ".((!$letter) ? "class=\"firstLetter\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		} else {
			$letters_menu .= "<a href=\"$paging_url?letter=".$each_letter."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		}
	}

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_PAGING_GOTOPAGE).": ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>

			<div class="content">

				<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<h2><?=system_showText(LANG_MENU_MANAGEEVENT);?></h2>
				
				<?
				$contentObj = new Content("", EDIR_LANGUAGE);
				$content = $contentObj->retrieveContentByType("Manage Events");
				if ($content) {
					echo "<blockquote>";
						echo "<div class=\"dynamicContent\">".$content."</div>";
					echo "</blockquote>";
				}
				?>

				<? if ($events) { ?>

					<? $hascharge = false; ?>
					<? $hastocheckout = false; ?>

					<? include(INCLUDES_DIR."/tables/table_event.php"); ?>

					<? if (!($process == "signup")) { ?>

						<? if ($hastocheckout) { ?>
							<? if ($hascharge) { ?>
								<? if ((PAYMENT_FEATURE == "on") && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>

									<table width="50%" style="margin: 0 auto 0 auto;">
										<tr>
											<td width="50%">
												<table align="center" border="0" cellpadding="0" cellspacing="0" class="warningBOX">
													<tr>
														<th><a href="<?=DEFAULT_URL?>/members/billing/index.php" class="warningBOXcontent"><?=system_showText(LANG_MSG_CONTINUE_TO_PAY_EVENT)?></a></th>
														<td><a href="<?=DEFAULT_URL?>/members/billing/index.php"><img src="<?=DEFAULT_URL?>/images/img_GREENarrow.gif" alt="&raquo;" width="39" height="45" /></a></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>

									<table align="center" border="0" cellpadding="0" cellspacing="0" class="warningBOXtext">
										<tr>
											<th><img src="<?=DEFAULT_URL?>/images/icon_atention.gif" width="16" height="14" alt="Atention Icon" /></th>
											<td><?=system_showText(LANG_MSG_EVENTS_ARE_ACTIVATED_BY);?> <strong><?=system_showText(LANG_LABEL_SITE_MANAGER)?></strong> <?=system_showText(LANG_MSG_ONLY_PROCCESS_COMPLETE)?></td>
										</tr>
									</table>

								<? } ?>
							<? } ?>
						<? } ?>

					<? } ?>

				<? } else { ?>
					<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
					<p class="informationMessage"><?=system_showText(LANG_NO_EVENTS_IN_THE_SYSTEM)?></p>
				<? } ?>

				<?
				$contentObj = new Content("", EDIR_LANGUAGE);
				$content = $contentObj->retrieveContentByType("Manage Events Bottom");
				if ($content) {
					echo "<blockquote>";
						echo "<div class=\"dynamicContent\">".$content."</div>";
					echo "</blockquote>";
				}
				?>

			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
