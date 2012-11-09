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
	# * FILE: /frontend/socialnetwork/page_tabs.php
	# ----------------------------------------------------------------------------------------------------

	if ($_GET['id']) {
		$account = $_GET['id'];
	} else {
		$account = sess_getAccountIdFromSession();
	}
	
	$account = new Account($account);
	unset($tabs);
	
	if (string_strpos($_SERVER["PHP_SELF"], "edit.php") == true) {
		
		if ($message) { ?>
			<p class="<?=$message_style?>"><?=$message?></p>
	<? } 
	
		if ((string_strlen(trim($message_demoDotCom))>0)) { ?>
			<p class="errorMessage">
				<? if (string_strlen(trim($message_demoDotCom))>0) { ?>
					<?=$message_demoDotCom?>
				<? } ?>
			</p>
	<? } 
	
		if (($account->getString("foreignaccount") == "y") && ($account->getString("foreignaccount_done") == "n")) { ?>
			<p class="warningMessage"><?=system_showText(LANG_MSG_FOREIGNACCOUNTWARNING);?></p>
	<? } ?>


	<ul class="profile-tabs">
		<li id="tab_1" class="<?=($tab == "tab_1" || !$tab) ? "active" : ""?>">
			<a href="<?=SOCIALNETWORK_URL?>/edit.php?tab=tab_1"><?=system_showText(LANG_LABEL_PERSONAL_PAGE)?></a>
		</li>
		<li id="tab_2" class="<?=($tab == "tab_2") ? "active" : ""?>">
			<a href="<?=SOCIALNETWORK_URL?>/edit.php?tab=tab_2"><?=system_showText(LANG_LABEL_ACCOUNT_SETTINGS)?></a>
		</li>
		<? $tabs = "tab_1,tab_2"; ?>
	</ul>
			
			
<? } else { ?>
			
	
	<ul class="profile-tabs">
		<?
			if (MODREWRITE_FEATURE == "on") {
				$reviewUrl = SOCIALNETWORK_URL."/".$info["friendly_url"];
				$favoriteUrl = SOCIALNETWORK_URL."/".$info["friendly_url"]."/favorites";
				$dealsUrl = SOCIALNETWORK_URL."/".$info["friendly_url"]."/deals";
			} else {
				$reviewUrl = SOCIALNETWORK_URL."/index.php?id=".$id;
				$favoriteUrl = SOCIALNETWORK_URL."/index.php?id=".$id."&c=favorites";
				$dealsUrl = SOCIALNETWORK_URL."/index.php?id=".$id."&c=deals";
			}
		?>
		<? if (($review_enabled == "on" || $review_article_enabled == "on" || $review_promotion_enabled == "on") && $commenting_edir) { ?>
			<li id="tab_1" class="<?=$pag_content == "reviews" ? "active": ""?>">
				<a href="<?=$reviewUrl;?>"><?=system_showText(LANG_REVIEW_PLURAL)?></a>
			</li>
		<? } ?>
		<li id="tab_2" class="<?=$pag_content == "favorites" ? "active": ""?>">
			<a href="<?=$favoriteUrl;?>"><?=system_showText(LANG_LABEL_FAVORITES)?></a>
		</li>
        <? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on") { ?>
		<li id="tab_3" class="<?=$pag_content == "deals" ? "active": ""?>">
			<a href="<?=$dealsUrl;?>"><?=system_showText(LANG_LABEL_ACCOUNT_DEALS)?></a>
		</li>
        <? } ?>
		<? $tabs = "tab_1,tab_2,tab_3"; ?>
	</ul>

<? } ?>

<script language="javascript" type="text/javascript">
	//<![CDATA[
	function showTabsContent(type, save) {
		var tabs = '<?=$tabs;?>';
		var aTabs = tabs.split(',');

		if (save) {
			$('#tab').attr('value', type);
		}

		for (var i = 0; i < aTabs.length; i++) {
			if (type == aTabs[i]) {
				$('#' + type).addClass('active');
				$("#cont_" + type).css('display', '');
			} else {
				$('#' + aTabs[i]).removeClass('active');
				$("#cont_" + aTabs[i]).css('display', 'none');
			}
		}
	}

<? /* if (string_strpos($_SERVER["PHP_SELF"], "edit.php") == true) { ?>
	$(document).ready(function(){
		var tGet = '<?=$_GET["tab"]?>';
		var tPost = '<?=$_POST["tab"]?>';
		if (tGet == 'tab_1' || tGet == 'tab_2') {
			var tab = tGet;
		} else if (tPost == 'tab_1' || tPost == 'tab_2') {
			var tab = tPost;
		} else {
			var tab = 'tab_1';
		}
       
		showTabsContent(tab);
	});
<? } */?>
	//]]>
</script>