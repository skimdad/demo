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
	# * FILE: /includes/tables/table_domain.php
	# ----------------------------------------------------------------------------------------------------

	$itemCount = count($domains);
?>

<? if(is_numeric($message) && isset($msg_domain[$message])) { ?>
    <p class="successMessage"><?=$msg_domain[$message]?></p>
<? }


if ($error_msg) {
	echo "<p class=\"errorMessage\">".$error_msg."</p>";
} elseif ($msg == "success") {
	echo "<p class=\"successMessage\">".LANG_MSG_DOMAIN_SUCCESSFULLY_UPDATE."</p>";
} elseif ($msg == "successdel") {
	echo "<p class=\"successMessage\">".LANG_MSG_DOMAIN_SUCCESSFULLY_DELETE."</p>";
}
unset($msg);

if ((!isset($legend))||($legend)) { ?>
	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
		<? if (!sess_getSMIdFromSession()) { ?>
			<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
		<? } ?>
	</ul>
<? } ?>

	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

		<tr>
			<th style="width: auto;"><?=string_ucwords(system_showText(LANG_DOMAIN_NAME));?></th>
			<th style="width: auto;"><?=system_showText(LANG_SITEMGR_DOMAIN_URL);?></th>
			<th style="width: auto;"><?=string_ucwords(system_showText(LANG_SITEMGR_DATECREATED));?></th>
			<th style="width: auto;"><?=string_ucwords(system_showText(LANG_SITEMGR_DOMAIN_CREATED_BY));?></th>
			<th style="width: auto;"><?=string_ucwords(system_showText(LANG_SITEMGR_DOMAIN_ACTIVATION));?></th>
			<th style="width: auto;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
		</tr>

		<?
		$hascharge = false;
		$hastocheckout = false;
		$cont = 0;

		if ($domains) foreach ($domains as $domain) {
			$cont++;
			$id = $domain->getNumber("id");
			$url = $domain->getString("url");
			$domain->changeActivationStatus();
			$itemStatus = new ItemStatus();
			?>

			<tr>
				<td>
					<a title="<?=$domain->getString("name");?>" href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<?=$domain->getString("name", true, 80);?>
					</a>
				</td>
				<td>
					<span title="<?=$domain->getString("url");?>"><?=$domain->getString("url", true, 80);?></span>
				</td>
				<td>
					<?=$domain->getDate("created");?>
				</td>
				<td>
					<?
						if ($domain->getNumber("smaccount_id")) {
							$smaObj = new SMAccount($domain->getNumber("smaccount_id"));
							$sitemgr_username = $smaObj->getString("username");
						} else {
							setting_get("sitemgr_username", $sitemgr_username);
						}
					?>
					<span title="<?=$sitemgr_username?>"><?=system_showTruncatedText($sitemgr_username, 50);?></span>
				</td>
				<td><?=$itemStatus->getStatusWithStyle($domain->getString("activation_status"));?></td>
				<td nowrap="nowrap">
					<a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_DOMAIN)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_DOMAIN)?>" />
					</a>


					<? if (!sess_getSMIdFromSession()) { ?>
						<? if ((SELECTED_DOMAIN_ID == $id) || ($url == $_SERVER["HTTP_HOST"])) { ?>
							<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
						<? } else { ?>
							<a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
								<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_DOMAIN)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_DOMAIN)?>" />
							</a>
						<? } ?>
					<? } ?>
				</td>
			</tr>
		<? } ?>
	</table>

<? if ((!isset($legend))||($legend)) { ?>
	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
		<? if (!sess_getSMIdFromSession()) { ?>
			<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
		<? } ?>
	</ul>
<? } ?>