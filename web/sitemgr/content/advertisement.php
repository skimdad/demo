<?php

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
	# * FILE: /sitemgr/content/advertisement.php
	# ----------------------------------------------------------------------------------------------------
	
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	//increases frequently actions
	if (!isset($message)) system_setFreqActions("content_advertisement", "content");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
	
?>
<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT_MANAGECONTENT))?> - <?=ucfirst(system_showText(LANG_SITEMGR_ADVERTISEMENT))?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">
		
			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_content_submenu.php"); ?>
		
					
			<?

			$pageObj  = new pageBrowsing("Content", $screen, 999, "id", "id", $letter, "section = 'advertise_general'");
			$contents = $pageObj->retrievePage();
			
			if (count($contents)) {
			?>
			
			<br />
			<table class="table-table">
				<tr class="th-table">
					<td class="td-th-table"><?=ucfirst(system_showText(LANG_SITEMGR_ADVERTISEMENT))?></td>
					<td class="td-th-table" style="width:60px;"><?=system_showText(LANG_LABEL_OPTIONS)?></td>
				</tr>
				<?
				foreach ($contents as $content) {
					$id = $content->getNumber("id");
				?>
				<tr class="tr-table">
					<td class="td-table">
						<a href="content.php?id=<?=$id?>" class="link-table">
							<?=$content->getString("type")?>
						</a>
					</td>
					<td class="td-table">
						<? if ((string_strpos($content->type, "Bottom") === false) && (string_strpos($content->type,"Packages") === false )) { ?>
						<a href="content.php?id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
						</a>
						<? } else { ?>
						<img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
						<? } ?>
						<a href="content.php?id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=system_showText(LANG_SITEMGR_EDIT)?>" title="<?=system_showText(LANG_SITEMGR_EDIT)?>" border="0" />
						</a>
						<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
					</td>
				</tr>
				<?
				}
                
			}
			?>
			
			<?
			# ----------------------------------------------------------------------------------------------------
			# LISTING ADVERTISE
			# ----------------------------------------------------------------------------------------------------
			
			$pageObj  = new pageBrowsing("Content", $screen, 999, "id", "id", $letter, "section = 'advertise_listing'$where");
			$contents = $pageObj->retrievePage();
			
			$listinglevelObj = new ListingLevel();
			$listinglevelValue = $listinglevelObj->getValues();

			if (count($contents) || count($listinglevelValue)) {

				foreach ($contents as $content) {
					$id = $content->getNumber("id");
				?>
		        <tr class="tr-table">
					<td class="td-table">
						<a href="content.php?id=<?=$id?>" class="link-table">
							<?=$content->getString("type")?>
						</a>
					</td>
					<td class="td-table">
						<img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
						<a href="content.php?id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=system_showText(LANG_SITEMGR_EDIT)?>" title="<?=system_showText(LANG_SITEMGR_EDIT)?>" border="0" />
						</a>
						<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
					</td>
				</tr>
				<?
				}
				?>
			
			<? } ?>
			
			<?
			# ----------------------------------------------------------------------------------------------------
			# EVENT ADVERTISE
			# ----------------------------------------------------------------------------------------------------
			
			if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
			
			$pageObj  = new pageBrowsing("Content", $screen, 999, "id", "id", $letter, "section = 'advertise_event'$where");
			$contents = $pageObj->retrievePage();
			
			$eventlevelObj = new EventLevel();
			$eventlevelValue = $eventlevelObj->getValues();
			
			if (count($contents) || count($eventlevelValue)) {

				foreach ($contents as $content) {
					$id = $content->getNumber("id");
				?>
		        <tr class="tr-table">
					<td class="td-table">
						<a href="content.php?id=<?=$id?>" class="link-table">
							<?=$content->getString("type")?>
						</a>
					</td>
					<td class="td-table">
						<? if ($section == "client"){ ?>
						<a href="custom.php?id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
						</a>
						<? } else { ?>
							<? if ((($content->getString("section") == "general") || (string_strpos($content->type, "Advertisement") === false)) 
							&& (string_strpos($content->type, "Bottom") === false) && ($content->getString("section") != "member")) { ?>
								<a href="content.php?id=<?=$id?>" class="link-table">
									<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
								</a>
							<? } else { ?>
								<img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
							<? } ?>
						<? } ?>
						<a href="content.php?id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=system_showText(LANG_SITEMGR_EDIT)?>" title="<?=system_showText(LANG_SITEMGR_EDIT)?>" border="0" />
						</a>
						<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
					</td>
				</tr>
				<?
				}
				?>
				
			<? } } ?>
			
			<?
			# ----------------------------------------------------------------------------------------------------
			# CLASSIFIED ADVERTISE
			# ----------------------------------------------------------------------------------------------------
			
			if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
			
			$pageObj  = new pageBrowsing("Content", $screen, 999, "id", "id", $letter, "section = 'advertise_classified'$where");
			$contents = $pageObj->retrievePage();
			
			$classifiedlevelObj = new ClassifiedLevel();
			$classifiedlevelValue = $classifiedlevelObj->getValues();
			
			if (count($contents) || count($classifiedlevelValue)) {

				foreach ($contents as $content) {
					$id = $content->getNumber("id");
				?>
		        <tr class="tr-table">
					<td class="td-table">
						<a href="content.php?id=<?=$id?>" class="link-table">
							<?=$content->getString("type")?>
						</a>
					</td>
					<td class="td-table">
						<? if ($section == "client"){ ?>
						<a href="custom.php?id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
						</a>
						<? } else { ?>
							<? if ((($content->getString("section") == "general") || (string_strpos($content->type, "Advertisement") === false)) 
							&& (string_strpos($content->type, "Bottom") === false) && ($content->getString("section") != "member")) { ?>
								<a href="content.php?id=<?=$id?>" class="link-table">
									<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
								</a>
							<? } else { ?>
								<img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
							<? } ?>
						<? } ?>
						<a href="content.php?id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=system_showText(LANG_SITEMGR_EDIT)?>" title="<?=system_showText(LANG_SITEMGR_EDIT)?>" border="0" />
						</a>
						<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
					</td>
				</tr>
				<?
				}
				?>
				
			<? } } ?>
			
			<?
			# ----------------------------------------------------------------------------------------------------
			# ARTICLE ADVERTISE
			# ----------------------------------------------------------------------------------------------------
			
			if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
			
			$pageObj  = new pageBrowsing("Content", $screen, 999, "id", "id", $letter, "section = 'advertise_article'$where");
			$contents = $pageObj->retrievePage();
			
			$articlelevelObj = new ArticleLevel();
			$articlelevelValue = $articlelevelObj->getValues();
			
			if (count($contents) || count($articlelevelValue)) {

				foreach ($contents as $content) {
					$id = $content->getNumber("id");
				?>
		        <tr class="tr-table">
					<td class="td-table">
						<a href="content.php?id=<?=$id?>" class="link-table">
							<?=$content->getString("type")?>
						</a>
					</td>
					<td class="td-table">
						<? if ($section == "client"){ ?>
						<a href="custom.php?id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
						</a>
						<? } else { ?>
							<? if ((($content->getString("section") == "general") || (string_strpos($content->type, "Advertisement") === false)) 
							&& (string_strpos($content->type, "Bottom") === false) && ($content->getString("section") != "member")) { ?>
								<a href="content.php?id=<?=$id?>" class="link-table">
									<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
								</a>
							<? } else { ?>
								<img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
							<? } ?>
						<? } ?>
						<a href="content.php?id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=system_showText(LANG_SITEMGR_EDIT)?>" title="<?=system_showText(LANG_SITEMGR_EDIT)?>" border="0" />
						</a>
						<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
					</td>
				</tr>
				<?
				}
				?>
				
			<? } } ?>
				
			<?
			# ----------------------------------------------------------------------------------------------------
			# BANNER ADVERTISE
			# ----------------------------------------------------------------------------------------------------
			
			if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {
			
			$pageObj  = new pageBrowsing("Content", $screen, 999, "id", "id", $letter, "section = 'advertise_banner'$where");
			$contents = $pageObj->retrievePage();
			
			$bannerlevelObj = new BannerLevel();
			$bannerlevelValue = $bannerlevelObj->getValues();

			if (count($contents) || count($bannerlevelValue)) {

				foreach ($contents as $content) {
					$id = $content->getNumber("id");
				?>
		        <tr class="tr-table">
					<td class="td-table">
						<a href="content.php?id=<?=$id?>" class="link-table">
							<?=$content->getString("type")?>
						</a>
					</td>
					<td class="td-table">
						<? if ($section == "client"){ ?>
						<a href="custom.php?id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
						</a>
						<? } else { ?>
							<? if ((($content->getString("section") == "general") || (string_strpos($content->type, "Advertisement") === false)) 
							&& (string_strpos($content->type, "Bottom") === false) && ($content->getString("section") != "member")) { ?>
								<a href="content.php?id=<?=$id?>" class="link-table">
									<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
								</a>
							<? } else { ?>
								<img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
							<? } ?>
						<? } ?>
						<a href="content.php?id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=system_showText(LANG_SITEMGR_EDIT)?>" title="<?=system_showText(LANG_SITEMGR_EDIT)?>" border="0" />
						</a>
						<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
					</td>
				</tr>
				
				<?
				}
				?>
			
            <? } } ?> 
			</table>
			<table class="table-subtitle-table">
				<tr class="tr-subtitle-table">
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>
						</font>
					</td>
					<td>&nbsp;</td>
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_EDIT)?>
						</font>
					</td>
					<td>&nbsp;</td>
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_DELETE)?>
						</font>
					</td>
				</tr>
			</table>
            	
            <?
            #---------------------------------------------------------
            # Advertise Images
            #---------------------------------------------------------
            ?>
            
            <?// Listing ?>
            <table class="table-table">
                <tr class="th-table">
                    <td class="td-th-table"><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING))?></td>
                    <td class="td-th-table" style="width: 60px;"><?=system_showText(LANG_LABEL_OPTIONS)?></td>
                </tr>
                <?
                foreach ($listinglevelValue as $value) {
                ?>
                <tr class="tr-table">
                    <td class="td-table">
                        <a href="<?=DEFAULT_URL?>/sitemgr/content/contentlevel.php?section=listing&value=<?=$value?>" class="link-table">
                            <?=$listinglevelObj->showLevel($value)?>
                        </a>
                    </td>
                    <td class="td-table">
                        <img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
                        <a href="<?=DEFAULT_URL?>/sitemgr/content/contentlevel.php?section=listing&value=<?=$value?>" class="link-table">
                            <img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=system_showText(LANG_SITEMGR_EDIT)?>" title="<?=system_showText(LANG_SITEMGR_EDIT)?>" border="0" />
                        </a>
                        <img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
                    </td>
                </tr>
                <?
                }
                ?>
            </table>
			<table class="table-subtitle-table">
				<tr class="tr-subtitle-table">
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>
						</font>
					</td>
					<td>&nbsp;</td>
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_EDIT)?>
						</font>
					</td>
					<td>&nbsp;</td>
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_DELETE)?>
						</font>
					</td>
				</tr>
			</table>
            
            <?// Event 
            if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
            ?>
	            <table class="table-table">
	               <tr class="th-table">
	                        <td class="td-th-table"><?=string_ucwords(system_showText(LANG_SITEMGR_EVENT_SING))?></td>
	                        <td class="td-th-table" style="width: 60px;"><?=system_showText(LANG_LABEL_OPTIONS)?></td>
	                    </tr>
	                    <?
	                    foreach ($eventlevelValue as $value) {
	                    ?>
	                    <tr class="tr-table">
	                        <td class="td-table">
	                            <a href="<?=DEFAULT_URL?>/sitemgr/content/contentlevel.php?section=event&value=<?=$value?>" class="link-table">
	                                <?=$eventlevelObj->showLevel($value)?>
	                            </a>
	                        </td>
	                        <td class="td-table">
	                            <img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
	                            <a href="<?=DEFAULT_URL?>/sitemgr/content/contentlevel.php?section=event&value=<?=$value?>" class="link-table">
	                                <img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=system_showText(LANG_SITEMGR_EDIT)?>" title="<?=system_showText(LANG_SITEMGR_EDIT)?>" border="0" />
	                            </a>
	                            <img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
	                        </td>
	                    </tr>
	                    <?
	                    }
	                    ?>
	            </table>
				<table class="table-subtitle-table">
				<tr class="tr-subtitle-table">
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>
						</font>
					</td>
					<td>&nbsp;</td>
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_EDIT)?>
						</font>
					</td>
					<td>&nbsp;</td>
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_DELETE)?>
						</font>
					</td>
				</tr>
			</table>
	        <? } ?>
            
            <?// Classified 
            if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
            ?>
	            <table class="table-table">
	                <tr class="th-table">
	                        <td class="td-th-table"><?=string_ucwords(system_showText(LANG_SITEMGR_CLASSIFIED))?></td>
	                        <td class="td-th-table" style="width: 60px;"><?=system_showText(LANG_LABEL_OPTIONS)?></td>
	                    </tr>
	                    <?
	                    foreach ($classifiedlevelValue as $value) {
	                    ?>
	                    <tr class="tr-table">
	                        <td class="td-table">
	                            <a href="<?=DEFAULT_URL?>/sitemgr/content/contentlevel.php?section=classified&value=<?=$value?>" class="link-table">
	                                <?=$classifiedlevelObj->showLevel($value)?>
	                            </a>
	                        </td>
	                        <td class="td-table">
	                            <img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
	                            <a href="<?=DEFAULT_URL?>/sitemgr/content/contentlevel.php?section=classified&value=<?=$value?>" class="link-table">
	                                <img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=system_showText(LANG_SITEMGR_EDIT)?>" title="<?=system_showText(LANG_SITEMGR_EDIT)?>" border="0" />
	                            </a>
	                            <img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
	                        </td>
	                    </tr>
	                    <?
	                    }
	                    ?>
	            </table>
				<table class="table-subtitle-table">
				<tr class="tr-subtitle-table">
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>
						</font>
					</td>
					<td>&nbsp;</td>
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_EDIT)?>
						</font>
					</td>
					<td>&nbsp;</td>
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_DELETE)?>
						</font>
					</td>
				</tr>
			</table>
	        <? } ?>
            
            <?// Article 
            if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
            ?>
	            <table class="table-table">
	                <tr class="th-table">
	                        <td class="td-th-table"><?=string_ucwords(system_showText(LANG_SITEMGR_ARTICLE))?></td>
	                        <td class="td-th-table" style="width: 60px;"><?=system_showText(LANG_LABEL_OPTIONS)?></td>
	                    </tr>
	                    <?
	                    foreach ($articlelevelValue as $value) {
	                    ?>
	                    <tr class="tr-table">
	                        <td class="td-table">
	                            <a href="<?=DEFAULT_URL?>/sitemgr/content/contentlevel.php?section=article&value=<?=$value?>" class="link-table">
	                                <?=$articlelevelObj->showLevel($value)?>
	                            </a>
	                        </td>
	                        <td class="td-table">
	                            <img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
	                            <a href="<?=DEFAULT_URL?>/sitemgr/content/contentlevel.php?section=article&value=<?=$value?>" class="link-table">
	                                <img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=system_showText(LANG_SITEMGR_EDIT)?>" title="<?=system_showText(LANG_SITEMGR_EDIT)?>" border="0" />
	                            </a>
	                            <img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
	                        </td>
	                    </tr>
	                    <?
	                    }
	                    ?>
	            </table>
				<table class="table-subtitle-table">
				<tr class="tr-subtitle-table">
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>
						</font>
					</td>
					<td>&nbsp;</td>
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_EDIT)?>
						</font>
					</td>
					<td>&nbsp;</td>
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_DELETE)?>
						</font>
					</td>
				</tr>
			</table>
	        <? } ?>
            
            <?// Banner 
            if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {
            ?>
	            <table class="table-table">
	                <tr class="th-table">
	                        <td class="td-th-table"><?=string_ucwords(system_showText(LANG_SITEMGR_BANNER))?></td>
	                        <td class="td-th-table" style="width: 60px;"><?=system_showText(LANG_LABEL_OPTIONS)?></td>
	                    </tr>
	                    <?
	                    foreach ($bannerlevelValue as $value) {
	                    ?>
	                    <tr class="tr-table">
	                        <td class="td-table">
	                            <a href="<?=DEFAULT_URL?>/sitemgr/content/contentlevel.php?section=banner&value=<?=$value?>" class="link-table">
	                                <?=$bannerlevelObj->showLevel($value)?>
	                            </a>
	                        </td>
	                        <td class="td-table">
	                            <img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
	                            <a href="<?=DEFAULT_URL?>/sitemgr/content/contentlevel.php?section=banner&value=<?=$value?>" class="link-table">
	                                <img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=system_showText(LANG_SITEMGR_EDIT)?>" title="<?=system_showText(LANG_SITEMGR_EDIT)?>" border="0" />
	                            </a>
	                            <img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
	                        </td>
	                    </tr>
	                    <?
	                    }
	                    ?>
	            </table>
				<table class="table-subtitle-table">
				<tr class="tr-subtitle-table">
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>
						</font>
					</td>
					<td>&nbsp;</td>
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_EDIT)?>
						</font>
					</td>
					<td>&nbsp;</td>
					<td class="td-subtitle-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" />
					</td>
					<td class="td-subtitle-table">
						<font class="font-subtitle-table">
							<?=system_showText(LANG_SITEMGR_DELETE)?>
						</font>
					</td>
				</tr>
			</table>
	        <? } ?>
			
		</div>
		
		</div>

	<div id="bottom-content">&nbsp;</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
