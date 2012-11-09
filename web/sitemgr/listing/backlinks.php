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
	# * FILE: /sitemgr/listing/backlinks.php
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
    
    if (BACKLINK_FEATURE == "off") {
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/index.php");
		exit;
	}
    
    # ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/".LISTING_FEATURE_FOLDER;
    $url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS;
	$sitemgr = 1;
    
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
	$errorPage = "$url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."";

    if ($id) {
		$level = new ListingLevel();
		$listing = new Listing($id);
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/".LISTING_FEATURE_FOLDER."/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
		$listingHasBacklink = $level->getBacklink($listing->getNumber("level"));
		if ((!$listingHasBacklink) || ($listingHasBacklink != "y")) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
		exit;
	}
    
    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/backlinks.php");
    
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
			<h1><?=string_ucwords(system_showText(LANG_LABEL_BACKLINK))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>

			<div class="baseForm">

				<form name="backlinks" id="backlinks" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					
                    <input type="hidden" name="id" value="<?=$id?>" />
                    <input type="hidden" name="backlinkValid" value="1" />
                    <input type="hidden" name="sitemgr" value="1" />
                    
                    <?
                    if ($message_backlink) {
                        echo "<p class=\"errorMessage\">";
                            echo $message_backlink;
                        echo "</p>";
                    }
                    ?>
                    
                    <table cellpadding="0" cellspacing="0" border="0" class="standard-table noMargin">
                        
                        <tr>
                            <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LISTING_SING);?> <?=string_ucwords(system_showText(LANG_LABEL_BACKLINK))?> - <?=$listing->getString("title")?></th>
                        </tr>
                        <tr>
                            <th><input type="checkbox" name="backlink" value="1" class="inputCheck" <?=$backlinkCheck || $backlink ? "checked" : ""?>/></th>
                            <td><?=system_showText(LANG_MSG_CLICK_TO_REMOVE_BACKLINK);?></td>
                        </tr>
                        <tr>
                            <th class="wrap">
                                <?=system_showText(LANG_LABEL_BACKLINK_URL);?>:
                            </th>
                            <td>
                                <input type="text" name="backlink_url" id="backlink_url" value="<?=$backlink_url?>" maxlength="255" />
                                <span><?=system_showText(LANG_LABEL_BACKLINK_URL_TIP);?></span>
                            </td>
                        </tr>
                        
                    </table>
                    
                    <br />

					<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

					<button type="button" name="cancel" value="Cancel" class="input-button-form" onclick="document.getElementById('formbacklinkcancel').submit();">
						<?=system_showText(LANG_BUTTON_CANCEL)?>
					</button>
				</form>
				<form id="formbacklinkcancel" action="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS;?>/<?=LISTING_FEATURE_FOLDER;?>/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
					<input type="hidden" name="letter" value="<?=$letter?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />

				</form>

			</div>
		</div>
	</div>

	<div id="bottom-content">

	</div>

</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>