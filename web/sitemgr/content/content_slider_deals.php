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
	# * FILE: /sitemgr/content/content_slider.php
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
	extract($_POST);	

/* htmlencde($_SESSION['state']."-s-".$_SESSION['city']."-s-".$_SESSION['cat']."-s-".$_SESSION['subcat']."-s-");
htmlencde($_POST['state']."-p-".$_POST['city']."-p-".$_POST['cat']."-p-".$_POST['subcat']."-p-",1); */

				$redirecturl = system_getFormAction($_SERVER["PHP_SELF"]);
				$mthd = "POST";
				if ($_POST["state"] != "") {
					if (isset($_SESSION['state'])) {
						if ($_SESSION['state'] != $_POST["state"]){ 
							$_SESSION['city'] = "";
							$_POST["city"] = "";
							//$_SESSION['cat'] = "";
							//$_POST['cat'] = "";
							$_SESSION['subcat'] = "";
							$_POST['subcat'] = "";
							$_SESSION['state'] = $_POST["state"];
						}
					} else {
						$_SESSION['state'] = $_POST["state"];
						$_SESSION['city'] = "";
						$_POST["city"] = "";
						//$_SESSION['cat'] = "";
						//$_POST['cat'] = "";
						$_SESSION['subcat'] = "";
						$_POST['subcat'] = "";
					}
				}
				if ($_POST["city"] != "") {
					$_SESSION['city'] = $_POST["city"];
				} else {
					$_SESSION['city'] = "";
				}


				if ($_POST["cat"] != "") {
					if (isset($_SESSION['cat'])) {
						if ($_SESSION['cat'] != $_POST["cat"]){
							$_SESSION['subcat'] = "";
							$_POST["subcat"] = "";
							$_SESSION['cat'] = $_POST["cat"];
							$cat_a = explode("'",$_SESSION['cat']); $catid = $cat_a[1]; $catname = $cat_a[0];
						} else {
							$cat_a = explode("'",$_SESSION['cat']); $catid = $cat_a[1]; $catname = $cat_a[0];						
						}
					} else {
						$_SESSION['cat'] = $_POST["cat"];
						$_SESSION['subcat'] = "";
						$_POST["subcat"] = "";
					}
				} else {
						$_SESSION['cat'] = "";
						$_SESSION['subcat'] = "";
						$_POST["subcat"] = "";				
				}
		if ($_POST["subcat"] != "" && $_SESSION["cat"] != "" && $_SESSION["state"] != "" && $_SESSION["city"] != "") { 
			$_SESSION['subcat'] = $_POST["subcat"];
			$cat_a = explode("'",$_SESSION['cat']); $catid = $cat_a[1]; $catname = $cat_a[0];
			$subcat_a = explode("'",$_SESSION['subcat']); $subcatid = $subcat_a[1]; $subcatname = $subcat_a[0];
			$redirecturl = str_replace("content_slider_deals.php","content_slider_deals_test.php",system_getFormAction($_SERVER["PHP_SELF"]))."?cat=".$catid."&subcat=".$subcatid."&state=".$_SESSION['state']."&city=".$_SESSION['city'];
			header("Location: ".str_replace(" ","+",$redirecturl)); 
			//htmlencde($redirecturl); 
			exit;
		}
		
		
	
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/slider.php");
	
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
function JS_submit() {
	$("#submit_button").attr("value", 1);
	document.slider.submit();
}

function JS_submitDisable() {
	document.slider_disable.submit();
}
-->
</script>

	<div id="main-right">

		<div id="top-content">
			<div id="header-content">
				<h1><?=ucfirst(system_showText(LANG_SITEMGR_CONTENT_MANAGECONTENT))?> - <?=ucfirst(system_showText(LANG_SITEMGR_NAVBAR_SLIDER))?></h1>
			</div>
		</div>

		<div id="content-content">

			<div class="default-margin">

				<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<? //include(INCLUDES_DIR."/tables/table_content_submenu.php"); ?>
				
				
				<? if ($_POST["s"]) { ?>
					<p class="successMessage">
						<?=system_showText(LANG_SITEMGR_SETTINGS_YOURSETTINGSWERECHANGED);?>
					</p>
				<? } ?>
					<table border="0" cellspacing="0" cellpadding="0" class="standard-table">
						<tr>
							<th class="standard-tabletitle">Select Category and Location for Slider you want to Add/Edit</th>
						</tr>
					</table>
				
				<? 

				//if (!isset($_SESSION['state']) || $_SESSION['state'] != $state) { $_SESSION['state'] = $state; $city = "Select City";}
				//if (isset($_SESSION['cat']) || $_SESSION['cat'] != $cat) { $_SESSION['cat'] = $cat; $subcat = "Select Sub Category"; $subcatname = "Select Sub Category";}

				if ($state) $selmsg = "Selected ".$state;	
				if ($city) $selmsg = "Selected ".$city.", ".$state; 
				if ($catname) $selmsg = "Selected ".$city.", ".$state." for ".$catname; 
				if ($subcatname) $selmsg = "Selected ".$city.", ".$state." for ".$subcatname." in ".$catname;
				if ($selmsg && false) { ?>
					<p class="successMessage">
						<? echo $selmsg;?>
					</p>
				<?}?>
				
				<? if ($slider_feature == "on") { ?>
				
					<p class="contentSpace">
					</p>

					<form class="default-form slider-form" name="slider" action="<? echo $redirecturl ?>" method="<? echo $mthd ?>" >
					<?/*
					<? if ($state) {?> <input type="hidden" name="state" value= "<? echo $state; ?>"/> <?}?>
					<? if ($city) {?> <input type="hidden" name="city" value= "<? echo $city; ?>"/> <?}?>
					<? if ($cat) {?> <input type="hidden" name="cat" value= "<? echo $cat; ?>"/> <?}?>
					<? if ($subcat) {?> <input type="hidden" name="subcat" value= "<? echo $subcat; ?>"/> <?}?>
					*/?>
					
<? 
	$sqlstate = "SELECT distinct name FROM `Location_3`"; 
	$selname = "state";$dbObj = db_getDBObject(DEFAULT_DB,true);$resultstate = $dbObj->query($sqlstate);
	if ($_SESSION['state']) {
	$sqlcity = "SELECT distinct name FROM `Location_4` WHERE Location_3 = (SELECT MIN(id) from Location_3 where name = '".$_SESSION['state']."') ORDER BY name"; 
	$selname = "city";$resultcity = $dbObj->query($sqlcity);
	}

	$sqlcat = "SELECT distinct ListingCategory.title1 name,ListingCategory.id id FROM `Listing_Category` INNER Join ListingCategory ON `Listing_Category`.category_root_id = ListingCategory.id order by 1"; 
	$selname = "cat"; $dbObj = db_getDBObject();$resultcat = $dbObj->query($sqlcat);
	if ($catid > 0 )  {
		$sqlsubcat = "SELECT distinct c.title1 name, c.id id FROM Listing_Category b INNER JOIN ListingCategory c on (b.category_id = c.id) WHERE (c.enabled= 'y') AND c.`left` >= (select cl.`left` from ListingCategory cl where cl.id = ".$catid.") AND c.`right` <= (select cr.`right` from ListingCategory cr where cr.id = ".$catid.") AND c.root_id = (select root.root_id from ListingCategory root where root.id = ".$catid.") order by 1"; 
		$selname = "subcat"; $dbObj = db_getDBObject();$resultsubcat = $dbObj->query($sqlsubcat);
	}
	?>
	
	<table border="0" cellspacing="0" cellpadding="0" class="standard-table">						
	<tr>
	<td id="div_select_1" class="field locationSelect" >
	<select name="state"  onchange="submit();" class="select" style = "font-size:14px;">
	 <option value = "<? if ($_SESSION['state']) echo $_SESSION['state']; else echo ""; ?>"><? if ($_SESSION['state']) echo $_SESSION['state']; else echo "Select State"; ?></option>
	  <? while($row = mysql_fetch_assoc($resultstate)) { ?>
		<option value = "<? echo $row['name'] ?>"><? echo $row['name'] ?></option>
	 <? } ?>
	<option>None</option>
	 </select>		
	 </td>
	</tr>

	<tr>
	<td id="div_select_2" class="field locationSelect" >
	<select name="city"  class="select" style = "font-size:14px;">
	 <option value = "<? if ($_SESSION['city']) echo $_SESSION['city']; else echo ""; ?>"><? if ($_SESSION['city']) echo $_SESSION['city']; else echo "Select City"; ?></option>
	  <? while($row = mysql_fetch_assoc($resultcity)) { ?>
		<option value = "<? echo $row['name'] ?>"><? echo $row['name'] ?></option>
	 <? } ?>
	<option>None</option>
	 </select>		
	 </td>
	</tr>


	<tr>
	<td id="div_select_3" class="field locationSelect" >
	<select name="cat"  onchange="submit();" class="select" style = "font-size:14px;">
	 <option value = "<? if ($_SESSION['cat']) echo $_SESSION['cat']; else echo ""; ?>"><? if ($catname) echo $catname; else echo "Select Category"; ?></option>
	  <? while($row = mysql_fetch_assoc($resultcat)) { ?>
		<option value = "<? echo $row['name']."'".$row['id'] ?>"><? echo $row['name'] ?></option>
	 <? } ?>
	<option>None</option>
	 </select>		
	 </td>
	</tr>


	<tr>
	<td id="div_select_4" class="field locationSelect" >
	<select name="subcat"  class="select" style = "font-size:14px;">
	 <option value = "<? if ($subcat) echo $subcat; else echo ""; ?>"><? if ($subcatname) echo $subcatname; else echo "Select Sub Category"; ?></option>
	  <? while($row = mysql_fetch_assoc($resultsubcat)) { ?>
		<option value = "<? echo $row['name']."'".$row['id'] ?>"><? echo $row['name'] ?></option>
	 <? } ?>
	<option>None</option>
	 </select>		
	 </td>
	</tr>


	<tr><td>
	<a class="link" href ="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">Reset</a>
	</td></tr>
	<tr><td>

	</td></tr>
	</table>
	<input type=button class="input-button-form" onClick="submit();" value='Edit Slides'></button>

				
						
						<? unset($dbCatObj); ?>

						<span class="clear"></span>
						
					</form>
				<? } ?>

			</div>

		</div>

	</div>

	<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
	?>

