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
	# * FILE: /members/listing/backlinks.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
//wtc
	$blogo = '<img alt="dealcloudusa.com" border="0" width="210" height="200" src ="http://www.dealcloudusa.com/images/uscb.png"/>'; 
	$btxt = '';
	$sql = "SELECT MIN( category_root_id ) category_root_id, title1, Listing.level FROM `Listing` INNER JOIN `Listing_Category` ON `Listing_Category`.listing_id = Listing.id INNER JOIN ListingCategory ON ListingCategory.id = category_root_id WHERE Listing.id = ".$_GET["id"]."";
	$dbObj = db_getDBObject();
	$result = $dbObj->query($sql);
	if (mysql_numrows($result)) {
		$row = mysql_fetch_array($result);
		$catlink = $row["title1"];
		if($row["level"] == 70) {$blogo = ''; $btxt = 'Deal Cloud USA Member'; }
		//$backlinkcode = '<p>You are entitled for a free SEO for your listing by placing this backlink code at your website.</p><a href="http://www.dealcloudusa.com/listing/guide/'.str_replace(" ","-",$catlink).'"><img alt="dealcloudusa.com" border="0" width="210" height="200" src ="http://www.dealcloudusa.com/images/'.$blogo.'"/></a>';	
		$backlinkcode = 'You are entitled for a free SEO for your listing by placing our backlink code at your website. (click this link to get the code) '.'http://www.dealcloudusa.com/members/listing/backlinks.php?id='.$_GET["id"].'&screen=&letter=';	
		//$backlinkcode = htmlspecialchars($backlinkcode);
		$_SESSION['backlinkcode'] = $backlinkcode;
	} else {
		$catlink = "You have no listing";	
	}

//end wtc
	
	if (BACKLINK_FEATURE == "off") {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/index.php");
		exit;
	}

    # ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER;
    $errorPage = "$url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "")."";
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS;
	$members = 1;
	
    if ($id) {
		$level = new ListingLevel();
		$listing = new Listing($id);
		if ($acctId != $listing->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
			exit;
		}
		$listingHasBacklink = $level->getBacklink($listing->getNumber("level"));
		if ((!$listingHasBacklink) || ($listingHasBacklink != "y")) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER."/index.php?screen=$screen&letter=$letter");
		exit;
	}
	
    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/backlinks.php");

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

        <h2><?=system_showText(LANG_LISTING);?> - <?=string_ucwords(system_showText(LANG_LABEL_BACKLINK))?></h2>
        
        <div class="package">

            <form name="backlinks" id="backlinks" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"]);?>">
                
                <input type="hidden" name="id" value="<?=$id?>" />
                <input type="hidden" id="backlinkValid" name="backlinkValid" value="0" />
                
                <? include(EDIRECTORY_ROOT."/includes/forms/form_backlinks.php")?>
            </form>

        </div>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>