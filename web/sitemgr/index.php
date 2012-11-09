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

	if (domain_returnTotal() <=1){
		header("Location: ".DEFAULT_URL."/sitemgr/dashboard.php");
		exit;
	}
    
	define("MAX_ACTIVITIES", 10);
	//to be approved max number
	define("MAX_TO_APPROVED", 8);

	$activities = "";
	$activities = activity_retrieveActivities(MAX_ACTIVITIES);

	$tobeapproved = "";
	$tobeapproved = activity_retrieveToApproved(MAX_TO_APPROVED);

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


	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    /* Get info to do Dashboard*/
	$dashboardInfo = domain_getDashboardInfo();
	$number_domains = count($dashboardInfo);

	$total_listings = 0;
	$total_contents = 0;
	$total_visits = 0;
	$total_revenue = 0;

	/*
	 * Colors
	 */
	unset($aux_array_colors);
	
	$array_moreColors = unserialize(ARRAY_GRAPHIC_COLORS);
	for ($i=0; $i<domain_returnTotal(); $i++){
		$aux_array_colors[] = $array_moreColors[$i];
	}

    $dbMain = db_getDBObject(DEFAULT_DB, true);
    
	for ($i = 0; $i < $number_domains; $i++){
		${"domain_id_".$i} = $dashboardInfo[$i]["domain_id"];
		${"domain_name_".$i} = $dashboardInfo[$i]["domain_name"];
		${"number_listings_".$i} = $dashboardInfo[$i]["number_listings"];
		${"number_content_".$i} = $dashboardInfo[$i]["number_content"];
		${"number_visits_".$i} = $dashboardInfo[$i]["visits"];
		${"number_revenue_".$i} = $dashboardInfo[$i]["revenue"];

		$total_listings = $total_listings + $dashboardInfo[$i]["number_listings"];
		$total_contents = $total_contents + $dashboardInfo[$i]["number_content"];
		$total_visits = $total_visits + $dashboardInfo[$i]["visits"];
		$total_revenue = $total_revenue + $dashboardInfo[$i]["revenue"];
        
        $dbDomain = db_getDBObjectByDomainID($dashboardInfo[$i]["domain_id"], $dbMain);
        
        $sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'CURRENCY_SYMBOL'";
		$result = $dbDomain->query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			${"currency_symbol_".$i} = $row["value"];
		}
		
	}

	?>
	<div id="main-right">

		<div id="content-content-home" class="dashboard-home">

			<div class="default-margin">

				<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
            
            	<div class="dashboard-main">
                	
                    <div class="dashboard-left">
                    	
                        <h1 class="dashboardTitle"><?=system_showText(LANG_SITEMGR_DASHBOARD)?></h1>

                        <ul class="light-theme">
							<?
							for ($i = 0; $i < $number_domains; $i++){
								($i % 2 == 0) ? $class = "" : $class = "class=\"color\"";
								if ($i != ($number_domains - 1))
									echo "<li $class><a href=\"javascript: void(0);\" title=\"".${"domain_name_".$i}."\" onclick=\"changeDomainInfo(".$dashboardInfo[$i]["domain_id"].",'".DEFAULT_URL."','/sitemgr/dashboard.php','".$_SERVER["QUERY_STRING"]."','false')\">".system_showTruncatedText(${"domain_name_".$i},25)."</a></li>";
								else
									echo "<li $class><a href=\"javascript: void(0);\" title=\"".${"domain_name_".$i}."\" onclick=\"changeDomainInfo(".$dashboardInfo[$i]["domain_id"].",'".DEFAULT_URL."','/sitemgr/dashboard.php','".$_SERVER["QUERY_STRING"]."','false')\">".system_showTruncatedText(${"domain_name_".$i},25)."</a></li>";
							}
							?>
                        </ul>
                        
                    </div>
                    
                    
                    <div class="dashboard-right">
                    
                    	<ul class="dark-theme">
                        	<li class="list-title list-title1"><?=system_showText(LANG_SITEMGR_NAVBAR_LISTING);?></li>
							<?
							for ($i = 0; $i < $number_domains; $i++){
								($i % 2 == 0) ? $class = "" : $class = "class=\"color\"";
								echo " <li $class><p>".${"number_listings_".$i}."</p></li>";
							}
							echo "<li class=\"list-total\"><p>$total_listings</p></li>";
							?>
                        </ul>
                        
                        <ul class="light-theme">
                        	<li class="list-title list-title2"><?=system_showText(LANG_SITEMGR_CONTENT_ADDED);?></li>
							<?
							for ($i = 0; $i < $number_domains; $i++){
								($i % 2 == 0) ? $class = "" : $class = "class=\"color\"";
								echo " <li $class><p>".${"number_content_".$i}."</p></li>";
							}
							echo "<li class=\"list-total\"><p>$total_contents</p></li>";
							?>
                        </ul>
                        
                        <ul class="dark-theme">
                       		<li class="list-title list-title3"><?=system_showText(LANG_SITEMGR_VISITS);?></li>
							<?
							for ($i = 0; $i < $number_domains; $i++){
								($i % 2 == 0) ? $class = "" : $class = "class=\"color\"";
								echo " <li $class><p>".${"number_visits_".$i}."</p></li>";
							}
							echo "<li class=\"list-total\"><p>$total_visits</p></li>";
							?>
                        </ul>

                        <ul class="light-theme revenueList">
                        	<li class="list-title list-title4"><?=system_showText(LANG_SITEMGR_REVENUE);?></li>
							<?
                            $last_currency = $currency_symbol_0;
                            $hideTotal = false;
							for ($i = 0; $i < $number_domains; $i++){
								($i % 2 == 0) ? $class = "" : $class = "class=\"color\"";
                                if ($last_currency != ${"currency_symbol_".$i}){
                                    $hideTotal = true;
                                }
								echo " <li $class><p>".${"currency_symbol_".$i}.format_money(${"number_revenue_".$i})."</p></li>";
							}
                            if (!$hideTotal){
                                echo "<li class=\"list-total list-total-big\"><p>".CURRENCY_SYMBOL.format_money($total_revenue)."</p></li>";
                            }
							?>
                        </ul>
                        
                    </div>
                    
                </div>

                <div id="bottom-content-home">
                
                	<div class="bottom-content-left">

						<? if ($tobeapproved != "<ul></ul>"){?>
                    
                    	<h3><?=system_highlightWords(system_showText(LANG_SITEMGR_TOBEAPPROVED), 2)?></h3>
                        
                        <? echo $tobeapproved; ?>
						<? } ?> 
                        
                    </div>

					<? if ($activities != "<ul></ul>"){?>
                    
                    <div class="bottom-content-right">
                    	
                        <h3><?=system_highlightWords(system_showText(LANG_SITEMGR_RECENT_ACTIVITY), 2)?></h3>
                        
                        <? echo $activities;?>
                        
                    </div>
					<?} ?>
                    
                </div>
				</div>
		</div>

		<div id="bottom-content-home">&nbsp;</div>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>