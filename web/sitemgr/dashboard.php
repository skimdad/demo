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
	# * FILE: /sitemgr/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------

	$domainObj = new Domain(SELECTED_DOMAIN_ID);
	setting_get("default_url", $default_url);
	if ($domainObj->getString("url") !== $default_url) {
		$default_url = $domainObj->getString("url");
		if (!setting_set("default_url", $default_url)) setting_new("default_url", $default_url);
	}
	if (!setting_set("edir_default_language", EDIR_DEFAULT_LANGUAGE)) setting_new("edir_default_language", EDIR_DEFAULT_LANGUAGE);
	if (!setting_set("edir_languages", EDIR_LANGUAGES)) setting_new("edir_languages", EDIR_LANGUAGES);
	if (!setting_set("edir_languagenames", EDIR_LANGUAGENAMES)) setting_new("edir_languagenames", EDIR_LANGUAGENAMES);
	if (!setting_set("edir_language", EDIR_LANGUAGE)) setting_new("edir_language", EDIR_LANGUAGE);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");


	$label_more = system_showText(LANG_SITEMGR_MORE);

	$dbObj = db_getDBObJect(DEFAULT_DB,true);
	$dbObjSecond = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID,$dbObj);
	$sql = "SELECT * FROM Setting WHERE name LIKE 'todo_%' AND `value` = 'yes'";
	$result = $dbObjSecond->query($sql);
	$showGetStarted = mysql_num_rows($result);
	unset($dbObj, $dbObjSecond);
	if (!DEMO_LIVE_MODE && !$_SESSION[SESS_SM_ID]) {
		$showGetStartedDemo = "on";
	} else {
		$showGetStartedDemo = "off";
	}
?>

<script type="text/javascript">

	var feature = 0;
	var slide_list = true;
	var showGetStarted = '<?=$showGetStarted?>';
	var showGetStartedDemo = '<?=$showGetStartedDemo?>';
	var eDirAct = true;

	$(document).ready(function(){

		$("#btMoreListing").click(function () {
			if (slide_list)	controlListRightNow("Listing", "more");
		});
		$("#btMoreBanner").click(function () {
			if (slide_list)	controlListRightNow("Banner", "more");
		});
		$("#btMoreEvent").click(function () {
			if (slide_list)	controlListRightNow("Event", "more");
		});
		$("#btMoreClassified").click(function () {
			if (slide_list)	controlListRightNow("Classified", "more");
		});
		$("#btMoreArticle").click(function () {
			if (slide_list)	controlListRightNow("Article", "more");
		});
		$("#btMoreCustomInvoice").click(function () {
			if (slide_list)	controlListRightNow("CustomInvoice", "more");
		});
		$("#btHideListing").click(function () {
			if (slide_list)	controlListRightNow("Listing", "hide");
		});
		$("#btHideBanner").click(function () {
			if (slide_list)	controlListRightNow("Banner", "hide");
		});
		$("#btHideEvent").click(function () {
			if (slide_list)	controlListRightNow("Event", "hide");
		});
		$("#btHideClassified").click(function () {
			if (slide_list)	controlListRightNow("Classified", "hide");
		});
		$("#btHideArticle").click(function () {
			if (slide_list)	controlListRightNow("Article", "hide");
		});
		$("#btHideCustomInvoice").click(function () {
			if (slide_list)	controlListRightNow("CustomInvoice", "hide");
		});
	});

	function controlListRightNow(newFeature, action) {
		slide_list = false
		if (action == "more") {
			if (feature) {
				$("#more"+feature).slideUp("slow");
				$("#btHide"+feature).fadeOut("slow", function() {
					$("#btMore"+feature).fadeIn("slow");
				});
			}
			$("#more"+newFeature).slideDown("slow");
			$("#btMore"+newFeature).fadeOut("slow", function () {
				$("#btHide"+newFeature).fadeIn("slow", function(){
					feature = newFeature;
					slide_list=true;
				});
			});
		} else if (action == "hide") {
			feature = 0;
			$("#more"+newFeature).slideUp("slow");
			$("#btHide"+newFeature).fadeOut("slow", function() {
				$("#btMore"+newFeature).fadeIn("slow", function() {
					slide_list=true;
				});
			});
		}
	}
	
	function changeRevenue(type, value){

		$("#rev_label").html("<?=CURRENCY_SYMBOL?>"+value);

		if (type == "month") {
			$("#rev_month").css("font-weight", "bold");
			$("#rev_week").css("font-weight", "");
		} else {
			$("#rev_month").css("font-weight", "");
			$("#rev_week").css("font-weight", "bold");
		}
	
	}
</script>



<div id="main-right" class="dashboard-main-right">

	<div class="dashboard-right-sidebar">
    	<div class="add-new-domain">
        	<p>
                <a href=<?=DEFAULT_URL."/sitemgr/domain/domain.php"?>>
                    <?=system_ShowText(LANG_SITEMGR_ADD_DOMAIN);?>
                </a>
            </p>
        </div>
    
		<? 
        $url_header = $_SERVER["PHP_SELF"];
        $url_header = substr ($url_header, strlen ($url_header)-18, 18 );
        if ((sess_isSitemgrLogged()) && (strcmp($url_header,"/sitemgr/index.php")) && (strpos($_SERVER["PHP_SELF"], "registration.php") === false)) { ?>
            <div class="searchHeader searchRightCompress" id="searchAll">
                <form name="formSearch" id="formSearchHome" method="get" action="<?=DEFAULT_URL."/sitemgr/search.php"?>">
                    <input type="text" value="<?=LANG_SITEMGR_SEARCH?>" name="keywords" id="QS_keywords" onFocus="value=''" />
                    <br class="clear" />
                    <p class="searchButtonLeft">
                        <a href="javascript:searchSubmit();"><?=system_ShowText(LANG_SITEMGR_GO)?></a>
                    </p>
                    <br class="clear" />
                    <div id="divSearch" class="hidden">
                        <? include(INCLUDES_DIR."/forms/form_search_all.php"); ?>
                    </div>
                    <p class="link"><a id="linkSearch" onclick="showDropdownSearch()" href="javascript:void(0);"><?=LANG_SITEMGR_ADVOPTIONS?></a></p>
                </form>
            </div>
            <span class="clear"></span>
        <? } ?>
        
        <div class="sidebar-dashboard">
            <? $revenue = system_getRevenue();?>
			<div class="revenueHome">
				<h3 id="rev_label"><?=CURRENCY_SYMBOL.$revenue["month"];?></h3>
				<p class="complementaryInfo">
					<span><?=system_showText(LANG_SITEMGR_REVENUE);?></span> 
					<?=system_showText(LANG_LAST);?> <label id="rev_week" style="cursor: pointer;" onclick="changeRevenue('week','<?=$revenue["week"]?>')"><?=system_showText(LANG_WEEK)?></label> | <label id="rev_month" style="cursor: pointer; font-weight: bold;" onclick="changeRevenue('month','<?=$revenue["month"]?>')"><?=system_showText(ucfirst(LANG_MONTH))?>
				</p>
			</div>
        </div>
    </div>

	<div id="content-content-home">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<?
            $status = system_getStatus(true);
            include(INCLUDES_DIR."/code/todo.php"); 

            unset($status);
            $status = system_getStatus();
			?>

            <div class="rightNow">
				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS) || permission_hasSMPermSection(SITEMGR_PERMISSION_BANNERS) || permission_hasSMPermSection(SITEMGR_PERMISSION_EVENTS) || permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS) || permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES) || permission_hasSMPermSection(SITEMGR_PERMISSION_PAYMENT)){ ?>
                    <h1><?=system_showText(LANG_SITEMGR_ON_THE_SITE);?> - <?=system_showText(LANG_SITEMGR_RIGHT_NOW);?></h1>
				<? } ?>
                
				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) {
                    
					if (LISTING_SCALABILITY_OPTIMIZATION == "on") {
						$about = LANG_SITEMGR_LABEL_ABOUT;
					} else {
						$about = "";
					}
                ?>

				<p><span><?=$about." ".$status["l_active"]?> <?=($status["l_active"] == 1 ? system_showText(LANG_SITEMGR_LISTING) : system_showText(LANG_SITEMGR_LISTING_PLURAL) )?></span> <?=$status["l_active"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_ACTIVE): system_showText(LANG_SITEMGR_OVERVIEW_ACTIVE_PLURAL);?> <a id="btMoreListing" href="javascript:void(0);">(<?=$label_more?>)</a><a id="btHideListing" href="javascript:void(0);" style="display: none"><?=system_showText(LANG_SITEMGR_HIDE);?></a></p>
					<div id="moreListing" style="display:none">
						<p><span><?=$about." ".$status["l_pending"]?> <?=($status["l_pending"] == 1 ? system_showText(LANG_SITEMGR_LISTING) : system_showText(LANG_SITEMGR_LISTING_PLURAL) )?></span> <?=system_showText(LANG_SITEMGR_OVERVIEW_WATINGAPROVAL)?> </p>
						<p><span><?=$about." ".$status["l_expired"]?> <?=($status["l_expired"] == 1 ? system_showText(LANG_SITEMGR_LISTING) : system_showText(LANG_SITEMGR_LISTING_PLURAL) )?></span> <?=$status["l_expired"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_EXPIRED): system_showText(LANG_SITEMGR_OVERVIEW_EXPIRED_PLURAL);?></p>
						<p><span><?=$about." ".$status["l_expiring"]?> <?=($status["l_expiring"] == 1 ? system_showText(LANG_SITEMGR_LISTING) : system_showText(LANG_SITEMGR_LISTING_PLURAL) )?></span> <?=$status["l_expiring"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING1): system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING1_PLURAL);?> <?=DEFAULT_LISTING_DAYS_TO_EXPIRE?> <?=system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING2)?> </p>
						<p><span><?=$about." ".$status["l_suspended"]?> <?=($status["l_suspended"] == 1 ? system_showText(LANG_SITEMGR_LISTING) : system_showText(LANG_SITEMGR_LISTING_PLURAL) )?></span> <?=$status["l_suspended"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_SUSPENDED): system_showText(LANG_SITEMGR_OVERVIEW_SUSPENDED_PLURAL);?> </p>
						<p><span><?=$about." ".$status["l_added30"]?> <?=($status["l_added30"] == 1 ? system_showText(LANG_SITEMGR_LISTING) : system_showText(LANG_SITEMGR_LISTING_PLURAL) )?></span> <?=$status["l_added30"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS1): system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS1_PLURAL);?> 30 <?=system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS2)?> </p>
					</div>
				<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BANNERS)) { ?>
                    
                    <?
                    if (BANNER_SCALABILITY_OPTIMIZATION == "on") {
						$about = LANG_SITEMGR_LABEL_ABOUT;
					} else {
						$about = "";
					}
                    ?>

					<? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
						<p><span><?=$about." ".$status["b_active"]?> <?=($status["b_active"] == 1 ? system_showText(LANG_SITEMGR_BANNER) : system_showText(LANG_SITEMGR_BANNER_PLURAL) )?></span> <?=$status["b_active"] == 1?  system_showText(LANG_SITEMGR_OVERVIEW_ACTIVE): system_showText(LANG_SITEMGR_OVERVIEW_ACTIVE_PLURAL);?> <a id="btMoreBanner" href="javascript:void(0);">(<?=$label_more?>)</a><a id="btHideBanner" href="javascript:void(0);" style="display: none"><?=system_showText(LANG_SITEMGR_HIDE);?></a></p>
						<div id="moreBanner" style="display:none">
							<p><span><?=$about." ".$status["b_pending"]?> <?=($status["b_pending"] == 1 ? system_showText(LANG_SITEMGR_BANNER) : system_showText(LANG_SITEMGR_BANNER_PLURAL) )?></span> <?=system_showText(LANG_SITEMGR_OVERVIEW_WATINGAPROVAL)?> </p>
							<p><span><?=$about." ".$status["b_expired"]?> <?=($status["b_expired"] == 1 ? system_showText(LANG_SITEMGR_BANNER) : system_showText(LANG_SITEMGR_BANNER_PLURAL) )?></span> <?=$status["b_expired"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_EXPIRED): system_showText(LANG_SITEMGR_OVERVIEW_EXPIRED_PLURAL);?> </p>
							<p><span><?=$about." ".$status["b_suspended"]?> <?=($status["b_suspended"] == 1 ? system_showText(LANG_SITEMGR_BANNER) : system_showText(LANG_SITEMGR_BANNER_PLURAL) )?></span> <?=$status["b_suspended"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_SUSPENDED): system_showText(LANG_SITEMGR_OVERVIEW_SUSPENDED_PLURAL);?> </p>
							<p><span><?=$about." ".$status["b_added30"]?> <?=($status["b_added30"] == 1 ? system_showText(LANG_SITEMGR_BANNER) : system_showText(LANG_SITEMGR_BANNER_PLURAL) )?></span> <?=$status["b_added30"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS1): system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS1_PLURAL);?> 30 <?=system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS2)?> </p>
						</div>
					<? } ?>
				<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_EVENTS)) { ?>

					<? 
                    if (EVENT_SCALABILITY_OPTIMIZATION == "on") {
						$about = LANG_SITEMGR_LABEL_ABOUT;
					} else {
						$about = "";
					}
                    ?>

					<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
						<p><span><?=$about." ".$status["e_active"]?> <?=($status["e_active"] == 1 ? system_showText(LANG_SITEMGR_EVENT) : system_showText(LANG_SITEMGR_EVENT_PLURAL) )?></span> <?=$status["e_active"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_ACTIVE): system_showText(LANG_SITEMGR_OVERVIEW_ACTIVE_PLURAL);?> <a id="btMoreEvent" href="javascript:void(0);">(<?=$label_more?>)</a><a id="btHideEvent" href="javascript:void(0);" style="display: none"><?=system_showText(LANG_SITEMGR_HIDE);?></a></p>
						<div id="moreEvent" style="display:none">
							<p><span><?=$about." ".$status["e_pending"]?> <?=($status["e_pending"] == 1 ? system_showText(LANG_SITEMGR_EVENT) : system_showText(LANG_SITEMGR_EVENT_PLURAL) )?></span> <?=system_showText(LANG_SITEMGR_OVERVIEW_WATINGAPROVAL)?> </p>
							<p><span><?=$about." ".$status["e_expired"]?> <?=($status["e_expired"] == 1 ? system_showText(LANG_SITEMGR_EVENT) : system_showText(LANG_SITEMGR_EVENT_PLURAL) )?></span> <?=$status["e_expired"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_EXPIRED): system_showText(LANG_SITEMGR_OVERVIEW_EXPIRED_PLURAL);?></p>
							<p><span><?=$about." ".$status["e_expiring"]?> <?=($status["e_expiring"] == 1 ? system_showText(LANG_SITEMGR_EVENT) : system_showText(LANG_SITEMGR_EVENT_PLURAL) )?></span> <?=$status["e_expiring"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING1): system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING1_PLURAL);?> <?=DEFAULT_EVENT_DAYS_TO_EXPIRE?> <?=system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING2)?> </p>
							<p><span><?=$about." ".$status["e_suspended"]?> <?=($status["e_suspended"] == 1 ? system_showText(LANG_SITEMGR_EVENT) : system_showText(LANG_SITEMGR_EVENT_PLURAL) )?></span> <?=$status["e_suspended"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_SUSPENDED): system_showText(LANG_SITEMGR_OVERVIEW_SUSPENDED_PLURAL);?> </p>
							<p><span><?=$about." ".$status["e_added30"]?> <?=($status["e_added30"] == 1 ? system_showText(LANG_SITEMGR_EVENT) : system_showText(LANG_SITEMGR_EVENT_PLURAL) )?></span> <?=$status["e_added30"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS1): system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS1_PLURAL);?> 30 <?=system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS2)?> </p>
						</div>
					<? } ?>
				<? } ?>


				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS)) { ?>

					<? 
                    if (CLASSIFIED_SCALABILITY_OPTIMIZATION == "on") {
						$about = LANG_SITEMGR_LABEL_ABOUT;
					} else {
						$about = "";
					}
                    ?>

					<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
						<p><span><?=$about." ".$status["c_active"]?> <?=($status["c_active"]==1? system_showText(LANG_SITEMGR_CLASSIFIED) : system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL) )?></span> <?=$status["c_active"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_ACTIVE): system_showText(LANG_SITEMGR_OVERVIEW_ACTIVE_PLURAL);?> <a id="btMoreClassified" href="javascript:void(0);">(<?=$label_more?>)</a><a id="btHideClassified" href="javascript:void(0);" style="display: none"><?=system_showText(LANG_SITEMGR_HIDE);?></a></p>
						<div id="moreClassified" style="display:none">
							<p><span><?=$about." ".$status["c_pending"]?> <?=($status["c_pending"] == 1 ? system_showText(LANG_SITEMGR_CLASSIFIED) : system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL) )?></span> <?=system_showText(LANG_SITEMGR_OVERVIEW_WATINGAPROVAL)?> </p>
							<p><span><?=$about." ".$status["c_expired"]?> <?=($status["c_expired"] == 1 ? system_showText(LANG_SITEMGR_CLASSIFIED) : system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL) )?></span> <?=$status["c_expired"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_EXPIRED): system_showText(LANG_SITEMGR_OVERVIEW_EXPIRED_PLURAL);?></p>
							<p><span><?=$about." ".$status["c_expiring"]?> <?=($status["c_expiring"] == 1 ? system_showText(LANG_SITEMGR_CLASSIFIED) : system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL) )?></span> <?=$status["c_expiring"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING1): system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING1_PLURAL);?> <?=DEFAULT_CLASSIFIED_DAYS_TO_EXPIRE?> <?=system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING2)?> </p>
							<p><span><?=$about." ".$status["c_suspended"]?> <?=($status["c_suspended"] == 1 ? system_showText(LANG_SITEMGR_CLASSIFIED) : system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL) )?></span> <?=$status["c_suspended"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_SUSPENDED): system_showText(LANG_SITEMGR_OVERVIEW_SUSPENDED_PLURAL);?> </p>
							<p><span><?=$about." ".$status["c_added30"]?> <?=($status["c_added30"] == 1 ? system_showText(LANG_SITEMGR_CLASSIFIED) : system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL) )?></span> <?=$status["c_added30"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS1): system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS1_PLURAL);?> 30 <?=system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS2)?> </p>
						</div>
					<? } ?>
				<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES)) { ?>

					<? 
                    if (ARTICLE_SCALABILITY_OPTIMIZATION == "on") {
						$about = LANG_SITEMGR_LABEL_ABOUT;
					} else {
						$about = "";
					}
                    ?>

					<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
						<p><span><?=$about." ".$status["a_active"]?> <?=($status["a_active"] == 1 ? system_showText(LANG_SITEMGR_ARTICLE) : system_showText(LANG_SITEMGR_ARTICLE_PLURAL) )?></span> <?=$status["a_active"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_ACTIVE): system_showText(LANG_SITEMGR_OVERVIEW_ACTIVE_PLURAL);?> <a id="btMoreArticle" href="javascript:void(0);">(<?=$label_more?>)</a><a id="btHideArticle" href="javascript:void(0);" style="display: none"><?=system_showText(LANG_SITEMGR_HIDE);?></a></p>
						<div id="moreArticle" style="display:none">
							<p><span><?=$about." ".$status["a_pending"]?> <?=($status["a_pending"] == 1 ? system_showText(LANG_SITEMGR_ARTICLE) : system_showText(LANG_SITEMGR_ARTICLE_PLURAL) )?></span> <?=system_showText(LANG_SITEMGR_OVERVIEW_WATINGAPROVAL)?> </p>
							<p><span><?=$about." ".$status["a_expired"]?> <?=($status["a_expired"] == 1 ? system_showText(LANG_SITEMGR_ARTICLE) : system_showText(LANG_SITEMGR_ARTICLE_PLURAL) )?></span> <?=$status["a_expired"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_EXPIRED): system_showText(LANG_SITEMGR_OVERVIEW_EXPIRED_PLURAL);?></p>
							<p><span><?=$about." ".$status["a_expiring"]?> <?=($status["a_expiring"] == 1 ? system_showText(LANG_SITEMGR_ARTICLE) : system_showText(LANG_SITEMGR_ARTICLE_PLURAL) )?></span> <?=$status["a_expiring"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING1): system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING1_PLURAL);?> <?=DEFAULT_ARTICLE_DAYS_TO_EXPIRE?> <?=system_showText(LANG_SITEMGR_OVERVIEW_EXPIRING2)?> </p>
							<p><span><?=$about." ".$status["a_suspended"]?> <?=($status["a_suspended"] == 1 ? system_showText(LANG_SITEMGR_ARTICLE) : system_showText(LANG_SITEMGR_ARTICLE_PLURAL) )?></span> <?=$status["a_suspended"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_SUSPENDED): system_showText(LANG_SITEMGR_OVERVIEW_SUSPENDED_PLURAL);?> </p>
							<p><span><?=$about." ".$status["a_added30"]?> <?=($status["a_added30"] == 1 ? system_showText(LANG_SITEMGR_ARTICLE) : system_showText(LANG_SITEMGR_ARTICLE_PLURAL) )?></span> <?=$status["a_added30"] == 1 ? system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS1): system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS1_PLURAL);?> 30 <?=system_showText(LANG_SITEMGR_OVERVIEW_ADDEDLASTDAYS2)?> </p>
						</div>
					<? } ?>
				<? } ?>

				<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PAYMENT)) {
				if (PAYMENT_FEATURE == "on") {
					if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
						if (CUSTOM_INVOICE_FEATURE == "on") { ?>
							<p><span><?=$status["custominvoice_paid"]?> <?=($status["custominvoice_paid"]==1? system_showText(LANG_SITEMGR_CUSTOMINVOICE) : system_showText(LANG_SITEMGR_CUSTOMINVOICE_PLURAL) )?></span> <?=system_showText(LANG_SITEMGR_OVERVIEW_PAID)?> <a id="btMoreCustomInvoice" href="javascript:void(0);">(<?=$label_more?>)</a><a id="btHideCustomInvoice" href="javascript:void(0);" style="display: none"><?=system_showText(LANG_SITEMGR_HIDE);?></a></p>
							<div id="moreCustomInvoice" style="display:none">
								<p><span><?=$status["custominvoice_pending"]?> <?=($status["custominvoice_pending"]==1? system_showText(LANG_SITEMGR_CUSTOMINVOICE) : system_showText(LANG_SITEMGR_CUSTOMINVOICE_PLURAL) )?></span> <?=system_showText(LANG_SITEMGR_OVERVIEW_TOBESENT)?> </p>
								<p><span><?=$status["custominvoice_sent"]?> <?=($status["custominvoice_sent"]==1? system_showText(LANG_SITEMGR_CUSTOMINVOICE) : system_showText(LANG_SITEMGR_CUSTOMINVOICE_PLURAL) )?></span> <?=system_showText(LANG_SITEMGR_OVERVIEW_SENT)?> </p>
							</div>
						<? } ?>
					<? } ?>
					<? }
				} ?>
			</div>
            
            <? system_showFreqActionsList(); ?>

		</div>

	</div>

	<div id="bottom-content-home">&nbsp;</div>

</div>

<br clear="all" />

<a href="#" id="getstarted_window" class="iframe fancy_window_getStarted" style="display:none" title="<?=system_showText(LANG_SITEMGR_TODO_GET_STARTED)?>"></a>

<script type="text/javascript">
    jQuery(document).ready(function() {
        if (showGetStarted > 0 && eDirAct && showGetStartedDemo=="on") {
            $("#getstarted_window").attr("href", '<?=DEFAULT_URL?>/sitemgr/getstarted.php?domain_id=<?=SELECTED_DOMAIN_ID?>');
            $("#getstarted_window").trigger("click");
        }
    });
</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>