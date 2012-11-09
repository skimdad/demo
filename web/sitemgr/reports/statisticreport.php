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
    # * FILE: sitemgr/reports/statisticreport.php
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

	extract($_POST);
	extract($_GET);

	//increases frequently actions
	if (!isset($month)) system_setFreqActions('report_statistic','report');

	# ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    $chartColors     = array();
    $chartColors[1]  = "336699";
    $chartColors[2]  = "6699CC";
    $chartColors[3]  = "339933";
    $chartColors[4]  = "00CC00";
    $chartColors[5]  = "CC3300";
    $chartColors[6]  = "FF6600";
    $chartColors[7]  = "FF9933";
    $chartColors[8]  = "CC9966";
    $chartColors[9]  = "999999";
    $chartColors[10] = "996699";
    $chartColors[11] = "9999FF";
    $chartColors[12] = "339999";
    $chartColors[13] = "A5A469";
    $chartColors[14] = "000000";
    $chartColors[15] = "666666";

    $modules[] = "h";
    $modules[] = "l";
    if(EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on")       $modules[] = "e";
    if(CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on")  $modules[] = "c";
    if(ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on")     $modules[] = "a";
    if(BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on")     $modules[] = "p";

    # ----------------------------------------------------------------------------------------------------
    # GET DATABASE
    # ----------------------------------------------------------------------------------------------------
    $db = db_getDBObject();

    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/header.php");

    # ----------------------------------------------------------------------------------------------------
    # NAVBAR
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<script type="text/javascript">
<!--
	var moduleAtivo = <?=($_GET['module'] ? "'".$_GET['module']."'" : "'module_h'")?>;
    function displayReport(module) {

    	if (!module) return false;

        <? foreach($modules as $module ) { ?>
            document.getElementById("module_<?=$module;?>").style.display = "none";
						document.getElementById("style_module_<?=$module;?>").className = "";
        <? } ?>

        document.getElementById(module).style.display = "block";
				document.getElementById('style_' + module).className = "active";

		moduleAtivo = module;
    }

    var blockRefresh = '';
    function doRefreshStatus() {
		dataFormat = '<?=format_date(date("Y-m-d"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString(date("Y-m-d H:i:s"))?>';
    	if (!blockRefresh) {
    		url = "<?=DEFAULT_URL?>/sitemgr/reports/statisticreport_refresh.php";
    		html_animloading = "<img src=\"<?=DEFAULT_URL.'/sitemgr/images/anim_ajaxloading.gif'?>\" border=\"0\" align=\"absmiddle\" />";
    		$.get(url, {'refresh':1}, function (data) {
				secondsFormat = data.substr(data.lastIndexOf(" - "));
    			$('#reportRefreshStatus').html("<p class=\"successMessage\"><?=system_showText(LANG_SITEMGR_REPORT_STATSHASBEENUPDATED)?> "+dataFormat+secondsFormat+" <?=system_showText(LANG_SITEMGR_REPORT_SECONDS)?></p>");
    			$('#reportRefreshStatus').fadeIn(2000);
    			window.setTimeout(refreshStatusClose, 3000);
    		});
    		$('#reportRefreshStatus').html(html_animloading);
    		$('#reportRefreshStatus').css('display', 'block');
    		blockRefresh = true;
    	}
    }

    function refreshStatusClose() {
    	$('#reportRefreshStatus').fadeOut(1000, function() {
    		<?
    		$url   = DEFAULT_URL.'/sitemgr/reports/statisticreport.php';
    		// Query string
    		$qs    = $_SERVER['QUERY_STRING'];
    		while ($start = string_strpos($qs, "&module=")) {
    			 $end   = string_strpos($qs, '&', $start+1);
    			 $end   = $end === false ? string_strlen($qs) : $end;
    			 $qs = string_substr($qs, 0, $start).string_substr($qs, $end, 999);
    		}
    		$url .= '?'.$qs.($qs ? '&' : '').'module=';
    		?>
    		url = "<?=$url?>"+moduleAtivo;
    		window.location.href = url;
    	});
    	blockRefresh = false;
    }

-->
</script>

<div id="main-right">

    <div id="top-content">
        <div id="header-content">
            <h1><?=string_ucwords(system_showText(LANG_SITEMGR_REPORT_STATISTICREPORT))?></h1>
        </div>
    </div>

    <br />
    <p class="informationMessage">
       <?=system_showText(LANG_SITEMGR_REPORT_STATISTICREPORT_ALERT);?>
    </p>

    <ul class="list-view">
    	<li class="no-bullet"><span class="refresh"><a href="javascript:void(0)" onclick="doRefreshStatus()"><?=system_showText(LANG_SITEMGR_REPORT_REFRESHNOW)?></a></span></li>
    </ul>
    <div id="reportRefreshStatus" style="display:none"></div>
    <br />


    <div id="content-content">
        <div class="default-margin">

        <? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>

        <?
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$db = db_getDBObject();
			}
            $sql = "SELECT DISTINCT YEAR(`day`) AS `year` FROM `Report_Statistic_Daily` ORDER BY `year` DESC";
            $result = $db->query($sql);
            $years = array();
            if($result){
                while($row = mysql_fetch_array($result)) {
                    $years[] = $row['year'];
                }
            }
        ?>

        <? if(count($years) > 0) { ?>

        <div class="reportPeriod">
				<form name="searchStatistReport" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get">
				<table class="reportForm" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							<h2><?=system_showText(LANG_SITEMGR_REPORT_LABEL_SELECTAPERIOD)?></h2>
						</td>
						<td>
										<?
											if (!$_GET['month']) {
												$date = date('n');
											} else $date = $_GET['month'];
										?>
										<label><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?>: </label>
										<select name='month'>
												<option value='1'  <?=($date == 1) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_JANUARY)?></option>
												<option value='2'  <?=($date == 2) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_FEBRUARY)?></option>
												<option value='3'  <?=($date == 3) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_MARCH)?></option>
												<option value='4'  <?=($date == 4) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_APRIL)?></option>
												<option value='5'  <?=($date == 5) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_MAY)?></option>
												<option value='6'  <?=($date == 6) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_JUNE)?></option>
												<option value='7'  <?=($date == 7) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_JULY)?></option>
												<option value='8'  <?=($date == 8) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_AUGUST)?></option>
												<option value='9'  <?=($date == 9) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_SEPTEMBER)?></option>
												<option value='10' <?=($date == 10) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_OCTOBER)?></option>
												<option value='11' <?=($date == 11) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_NOVEMBER)?></option>
												<option value='12' <?=($date == 12) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_DECEMBER)?></option>
										</select>

										<label><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?>: </label>
										<select name='year'>
												<? foreach($years as $year) { ?>
														<option value='<?=$year;?>' <?=($_GET['year'] == $year) ? "selected='selected'" : ""; ?>><?=$year;?></option>
												<? } ?>
										</select>



						</td>
						<td>
							<input type="submit" value="<?=system_showText(LANG_SITEMGR_SEARCH)?>" class="button-form" />
						</td>
					</tr>
				</table>
				</form>
			</div>
        <? } else { ?>
            <p class="informationMessage"><?=system_showText(LANG_SITEMGR_REPORT_REPORTEMPTYMESSAGE)?></p>
        <? } ?>

        <? if (($_GET["year"]) && ($_GET['month']) && is_numeric($_GET["year"]) && is_numeric($_GET['month'])) {
                $sql = "SELECT `module`, `key`, `value`, SUM(`quantity`) AS quantity FROM `Report_Statistic_Daily` WHERE YEAR(`day`) = '".$_GET["year"]."' AND MONTH(`day`) = '".$_GET["month"]."' GROUP BY `module`, `key`, `value` ORDER BY `module` ASC, `key` ASC, `quantity` DESC;";
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				$result = $db->query($sql);

                if($result) {
                    $report = array();
                    $reportTotalKey = array();
                    $actualModule = "none";
                    $actualKey = "none";

                    while($row = mysql_fetch_array($result)) {
                        $module     = $row["module"];
                        $key        = $row["key"];
                        $value      = $row["value"];
                        $quantity   = $row["quantity"];

                        if($actualModule != $module) {
                            $actualModule = $module;
                            $report[$actualModule] = array();
                            $reportTotalKey[$actualModule] = array();
                        }

                        if($actualKey != $key) {
                            $totalKey = 0;
                            $actualKey = $key;
                            $report[$actualModule][$actualKey] = array();
                            $reportTotalKey[$actualModule][$actualKey] = 0;
                        }

                        if(count($report[$actualModule][$actualKey]) < 15 ) {
                            $report[$actualModule][$actualKey][$value]["quantity"] = $quantity;
                            $reportTotalKey[$actualModule][$actualKey] += $quantity;
                        }
                    }
                }

                /* TABS */
                echo "<div class=\"reportPeriodTabs\">";
                echo "<ul>";
                foreach ($modules as $module) {
                    if($module == 'h') $name = system_showText(LANG_SITEMGR_REPORT_GENERALSEARCHES);
                    if($module == 'l') $name = system_showText(LANG_SITEMGR_NAVBAR_LISTING);
                    if($module == 'a') $name = system_showText(LANG_SITEMGR_NAVBAR_ARTICLE);
                    if($module == 'e') $name = system_showText(LANG_SITEMGR_NAVBAR_EVENT);
                    if($module == 'c') $name = system_showText(LANG_SITEMGR_NAVBAR_CLASSIFIED);
                    if($module == 'p') $name = system_showText(LANG_MENU_BLOG);
                    echo "<li id='style_module_".$module."'><a href=\"javascript:void(0);\" onclick=\"javascript:displayReport('module_".$module."');\">".$name."</a></li>";
                }
                echo "</ul><br class=\"clear\">";
				echo "</div>";
                ?>

                <? foreach ($modules as $module) { ?>
                    <div id="module_<?=$module;?>" style='display:none;'>
                        <div class='default-report'>
                            <table cellpadding='0' cellspacing='0' class='highlight-report'>
                                <tbody>
                                    <tr>
                                        <th class='highlight-title'>
                                            <?=system_showText(LANG_SITEMGR_REPORT_STATISTICREPORT)?> : <span>
                                            <?
                                                if($module == 'h') echo system_showText(LANG_SITEMGR_REPORT_GENERALSEARCHES);
                                                if($module == 'l') echo string_ucwords(system_showText(LANG_SITEMGR_LISTING_PLURAL));
                                                if($module == 'a') echo string_ucwords(system_showText(LANG_SITEMGR_ARTICLE_PLURAL));
                                                if($module == 'e') echo string_ucwords(system_showText(LANG_SITEMGR_EVENT_PLURAL));
                                                if($module == 'c') echo string_ucwords(system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL));
                                                if($module == 'p') echo string_ucwords(system_showText(LANG_MENU_BLOG));
                                            ?>
                                            </span>
                                        </th>
                                        <th class='highlight-title-center'>
                                             <? echo system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH).': <span>', system_showDate('F', mktime(0, 0, 0, $_GET['month'], 1, $_GET['year'])), '</span> / '.system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR).': <span>', $_GET['year'], '</span>'; ?>
                                        </th>
                                    </tr>

                                    <? /* keywords */ ?>
                                    <? if(count($report[$module]['keywords']) > 0) { ?>
                                        <tr>
                                            <td class='leftColumn'>

                                                <h3><?=system_showText(LANG_SITEMGR_REPORT_TOP15KEYWORDS)?></h3>

                                                <table cellpadding="0" cellspacing="0" class="reportList">

                                                    <?
                                                    $idx = 1;
                                                    $colorList   = array();
                                                    $percentList = array();
                                                    $labelList   = array();
                                                    foreach($report[$module]['keywords'] as $data => $quantity) {
                                                        $percent = format_money((($quantity['quantity'] * 100) / $reportTotalKey[$module]['keywords']), 2);
                                                        echo "<tr><td class='chart-color-", $idx, "'>", $data, '</td><td class="number">', $percent, '%</td></tr>';
                                                        $idx++;
                                                        $colorList[] = $chartColors[$idx - 1];
                                                        $labelList[]   = $percent . "%";
                                                        $percentList[] = $percent;
                                                    }
                                                    ?>

                                                </table>

                                            </td>
                                            <td class='rightColumn'>
                                                <? echo "<img src='http://chart.apis.google.com/chart?chs=350x170&amp;chf=bg,s,ffffff&amp;cht=p&amp;chd=t:", implode(',', $percentList),"&amp;chl=", implode('|', $labelList),"&amp;chco=", implode(',', $colorList), "' alt='".system_showText(LANG_SITEMGR_REPORT_STATISTICCHART)."'/>"; ?>
                                            </td>
                                        </tr>
                                    <? } else { ?>
                                        <tr>
                                            <td class='leftColumn'>
                                                <h3><?=system_showText(LANG_SITEMGR_REPORT_TOP15KEYWORDS)?></h3>
                                                <p class="informationMessage"><?=system_showText(LANG_SITEMGR_REPORT_EMPTYMESSAGE)?></p>
                                            </td>
                                        </tr>
                                    <? } ?>

                                    <? /* where */ ?>
                                    <? if(($module != 'a') && ($module != 'p')) { ?>
                                        <? if(count($report[$module]['where']) > 0) { ?>
                                            <tr>
                                                <td class='leftColumn'>

                                                    <h3><?=system_showText(LANG_SITEMGR_REPORT_TOP15WHERE)?></h3>

												    <table cellpadding="0" cellspacing="0" class="reportList">

                                                        <?
													    $idx = 1;
													    $colorList   = array();
													    $percentList = array();
													    $labelList   = array();
													    foreach($report[$module]['where'] as $data => $quantity) {
													        $percent = format_money((($quantity['quantity'] * 100) / $reportTotalKey[$module]['where']), 2);
													        echo "<tr><td class='chart-color-", $idx, "'>", $data, '</td><td class="number">', $percent, '%</td></tr>';
													        $idx++;
													        $colorList[] = $chartColors[$idx - 1];
													        $labelList[]   = $percent . "%";
													        $percentList[] = $percent;
													    }
													    ?>

												    </table>

                                                </td>
                                                <td class='rightColumn'>
                                                    <? echo "<img src='http://chart.apis.google.com/chart?chs=350x170&amp;chf=bg,s,ffffff&amp;cht=p&amp;chd=t:", implode(',', $percentList),"&amp;chl=", implode('|', $labelList),"&amp;chco=", implode(',', $colorList), "' alt='".system_showText(LANG_SITEMGR_REPORT_STATISTICCHART)."'/>"; ?>
                                                </td>
                                            </tr>
                                        <? } else { ?>
                                            <tr>
                                                <td class='leftColumn'>
                                                    <h3><?=system_showText(LANG_SITEMGR_REPORT_TOP15WHERE)?></h3>
                                                    <p class="informationMessage"><?=system_showText(LANG_SITEMGR_REPORT_EMPTYMESSAGE)?></p>
                                                </td>
                                            </tr>
                                        <? } ?>
                                    <? } ?>

                                    <? if(($module != 'h')) { ?>
                                        <tr>
											<td <?=($module != 'a' && $module!='p') ? "class='leftColumn'" : "class='extended' colspan='2'"; ?>>
												<h3 <?=($module != 'a' && $module!='p') ? "" : "class='extended'"; ?>><?=system_showText(LANG_SITEMGR_REPORT_TOP15CATEGORIES)?></h3>
												<? if(count($report[$module]['categories']) > 0) { ?>
													<table cellpadding="0" cellspacing="0" class="reportList">
														<?
															foreach($report[$module]['categories'] as $data => $quantity) {
																$percent = format_money((($quantity['quantity'] * 100) / $reportTotalKey[$module]['categories']), 2);
																echo "<tr><td>", $data, '</td><td class="number">', $percent, '%</td></tr>';
															}
														?>
													</table>
												<? } else { ?>
													<p class="informationMessage"><?=system_showText(LANG_SITEMGR_REPORT_EMPTYMESSAGE)?></p>
												<? } ?>
											</td>
											<? if(($module != 'a') && ($module !='p')) { ?>
												<td class='rightColumn'>
													<h3 class="extented"><?=system_showText(LANG_SITEMGR_REPORT_TOP15LOCATIONS)?></h3>
													<? if(count($report[$module]['locations']) > 0) { ?>
														<table cellpadding="0" cellspacing="0" class="reportList">
															<?
																foreach($report[$module]['locations'] as $data => $quantity) {
																	$percent = format_money((($quantity['quantity'] * 100) / $reportTotalKey[$module]['locations']), 2);
																	echo "<tr><td>", $data, '</td><td class="number">', $percent, '%</td></tr>';
																}
															?>
														</table>
													<? } else {?>
														<p class="informationMessage"><?=system_showText(LANG_SITEMGR_REPORT_EMPTYMESSAGE)?></p>
													<? } ?>
												</td>
											<? } ?>
										</tr>
                                    <? } ?>

                                    <tr>
                                        <th class='highlight-subtitle-left'>
                                            <?
												$domainObj = new Domain(SELECTED_DOMAIN_ID);
												if (HTTPS_MODE == "on") echo "https://".$domainObj->getString("url");
												else echo "http://".$domainObj->getString("url").EDIRECTORY_FOLDER;
											?>
                                        </th>
                                        <th class='highlight-subtitle'>
                                            <?=system_showText(LANG_SITEMGR_REPORT_STATISTICSEARCHREPORTBY)?> <span><a href="http://www.edirectory.com" target="_blank">eDirectory</a></span>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <? } ?>
                <script type="text/javascript">
                <!--
                displayReport(moduleAtivo);
                -->
                </script>
            <? } ?>

        </div>
    </div>

    <div id="bottom-content">
        &nbsp;
    </div>

</div>
<?
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>