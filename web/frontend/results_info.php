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
	# * FILE: /frontend/results_info.php
	# ----------------------------------------------------------------------------------------------------

	if($show_results || true){ ?>
		<? if ($str_search) {
			?>
			<div class="search-info" style="font-size:18px;">
				<a href="http://www.dealcloudusa.com" alt=""><?=system_showText(LANG_SEARCHRESULTS)?></a> 
				<?=$str_search?>
			</div>
			<?
		}
?>
<!--
<div style="width:100%;height:50px;margin-top:-5px;font-size:15px;font-weight:bold;background:url(../images/search_all.png) no-repeat center bottom;">
	<div style="margin-top:22px;float:left;border-left-width: 10px; margin-left: 10px;">
		<a href="#" alt="">Daily Deals [10]</a>
	</div>	
</div>
-->
<?  
if (
	((strpos($_SERVER['REQUEST_URI'],"deal/") 
	|| strpos($_SERVER['REQUEST_URI'],"listing/") 
	|| strpos($_SERVER['REQUEST_URI'],"classified/") 
	|| strpos($_SERVER['REQUEST_URI'],"event/") 
	|| strpos($_SERVER['REQUEST_URI'],"article/")
	|| strpos($_SERVER['REQUEST_URI'],"results.php")	
	))&& !strpos($_SERVER['REQUEST_URI'],"/where/empty")
	 && strpos($_SERVER['REQUEST_URI'],"keyword")) {

	if ($_SESSION["s_kind"] == "DEALS") $cls = "active||||";
	elseif ($_SESSION["s_kind"] == "LISTINGS") $cls = "|active|||";
	elseif ($_SESSION["s_kind"] == "CLASSIFIEDS") $cls = "||active||";
	elseif ($_SESSION["s_kind"] == "EVENTS") $cls = "|||active|";
	elseif ($_SESSION["s_kind"] == "ARTICLES") $cls = "||||active";
	elseif ($_SESSION["s_kind"] == "HOME") $cls = "||||";	
	$cls = explode('|',$cls);
	$url=parse_url($_SERVER['REQUEST_URI']);
	$qurl = substr($url["query"],strpos($url["query"],"keyword"));
	if (!strpos($_SERVER['REQUEST_URI'],"article/")) $_SESSION['s_qurl'] = $qurl;
	//htmlencde($url);htmlencde($durl,1);htmlencde($_SERVER['HTTP_HOST']."/deal/",1);
	$hurl = "http://".$_SERVER['HTTP_HOST']."/listing/results_home.php?".$_SESSION['s_qurl'];
	$durl = "http://".$_SERVER['HTTP_HOST']."/deal/results.php?".$_SESSION['s_qurl'];
	$lurl = "http://".$_SERVER['HTTP_HOST']."/listing/results.php?".$_SESSION['s_qurl'];
	$curl = "http://".$_SERVER['HTTP_HOST']."/classified/results.php?".$_SESSION['s_qurl'];
	$eurl = "http://".$_SERVER['HTTP_HOST']."/event/results.php?".$_SESSION['s_qurl'];
	$aurl = "http://".$_SERVER['HTTP_HOST']."/article/results.php?".$_SESSION['s_qurl'];//."keyword=".$keyword."&match=".$match."&advsearch=yes&category_id=";
?>
	<div id="searchalldiv">
	<div class="container">
	<ul class="menu" rel="sam1">
	<li class="<?=$cls[0]?>"><a href="<?=$durl?>">Daily Deals (<?=$totaldealsfound?>)</a></li>
	<li class="<?=$cls[1]?>"><a href="<?=$lurl?>">Business Listings (<?=$totallistingsfound?>)</a></li>
	<li class="<?=$cls[2]?>"><a href="<?=$curl?>">Classifieds (<?=$totalclassifiedsfound?>)</a></li>
	<li class="<?=$cls[3]?>"><a href="<?=$eurl?>">Local Events (<?=$totaleventsfound?>)</a></li>
	<li class="<?=$cls[4]?>"><a href="<?=$aurl?>">Articles (<?=$totalarticlesfound?>)</a></li>
	</ul>
	</div>
	</div>


<?
	
		/*
		 * These variables are prepared on MODULE/results.php file
		 */
		if ($category_id && $aux_CategoryObj && $aux_CategoryModuleURL && $aux_CategoryNumColumn) {
			$objCache = new cache("{$aux_CategoryObj}_results_category_{$category_id}.php");
			if ($objCache->caching) {
				include(system_getFrontendPath("browsebycategory.php"));
			}
			$objCache->close();
		}

		if($aux_module_items){
			$itemRSSSection = $aux_module_itemRSSSection;
		}
	} 
}
?>
