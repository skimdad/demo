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
	# * FILE: /sitemgr/content/slidergo.php
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


/*$x  = htmlencde($_SESSION['state']."-s-".$_SESSION['city']."-s-".$_SESSION['cat']."-s-".$_SESSION['subcat']."-s-");
$x = htmlencde($_POST['state']."-p-".$_POST['city']."-p-".$_POST['cat']."-p-".$_POST['subcat']."-p-",1); */

				$redirecturl = system_getFormAction($_SERVER["PHP_SELF"]);
				$mthd = "POST";

				if ($_POST["kind"] != "") {
					if (isset($_SESSION['kind']) && $_SESSION['kind'] != $_POST["kind"]){ 
						$_POST['state'] = "";
						$_SESSION['state'] = "";
					}
					$_SESSION['kind'] = $_POST["kind"];
				} 
				
				if ($_POST["state"] != "") {
					if (isset($_SESSION['state'])) {
						if ($_SESSION['state'] != $_POST["state"]){ 
							$_SESSION['city'] = "";
							$_POST["city"] = "";
							$_SESSION['state'] = $_POST["state"];
						}
					} else {
						$_SESSION['state'] = $_POST["state"];
						$_SESSION['city'] = "";
						$_POST["city"] = "";
					}
				}
				if ($_POST["city"] != "") {
					$_SESSION['city'] = $_POST["city"];
				} else {
					$_SESSION['city'] = "";
				}

				/* if ($_POST["existing_state"] != "") {
					if (isset($_SESSION['existing_state'])) {
						if ($_SESSION['existing_state'] != $_POST["existing_state"]){ 
							$_SESSION['existing_state'] = $_POST["existing_state"];
						}
					} else {
						$_SESSION['existing_state'] = $_POST["existing_state"];
					}
				} */
		$err = "";
		if (isset($_POST['btnButton'])) {
			if ($_SESSION["state"] != "" && $_SESSION["city"] != "") { 
				$redirecturl = str_replace("slidergo.php","content_slider.php",system_getFormAction($_SERVER["PHP_SELF"]))."?kind=".$_SESSION['kind']."&state=".$_SESSION['state']."&city=".$_SESSION['city'];			
				header("Location: ".str_replace(" ","+",$redirecturl)); 
				exit;
			} else {
				$err = "Please select both State and City to Add/Edit Slider";
			}
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

<script type="text/javascript">

/* function SetButtonStatus(v) {
var e = document.getElementById("div_select_4");
alert("In func");
	if ( v !='' )
		document.getElementById(target).disabled = false;
alert("In IF");
	else
		document.getElementById(target).disabled = true;
alert("In Else");		
} */

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

				<? include(INCLUDES_DIR."/tables/table_content_submenu.php"); ?>
				
				
				<? if ($_POST["s"]) { ?>
					<p class="successMessage">
						<?=system_showText(LANG_SITEMGR_SETTINGS_YOURSETTINGSWERECHANGED);?>
					</p>
				<? } ?>

				
				<? if ($slider_feature == "on") { ?>
				
				<form name="slider" action="<? echo $redirecturl ?>" method="<? echo $mthd ?>" >
					
<? 
	$sqlstate = "SELECT distinct name FROM `Location_3` WHERE location_1 = 1 order by name"; 
	//$selname = "state";
	$dbObj = db_getDBObject(DEFAULT_DB,true);$resultstate = $dbObj->query($sqlstate);
	if ($_SESSION['state']) {
		$sqlcity = "SELECT distinct name FROM `Location_4` WHERE Location_3 = (SELECT MIN(id) from Location_3 where name = '".$_SESSION['state']."') ORDER BY name"; 
		//$selname = "city"; 
		$resultcity = $dbObj->query($sqlcity);
		//$sqlexistingstate = "SELECT distinct slider_loc3 as name FROM Slider WHERE slider_kind = '".$_SESSION['kind']."' AND image_id > 0 ORDER BY slider_loc3";
		$sqlslidercity = "SELECT distinct slider_loc4 as name FROM Slider WHERE slider_loc3 = '".$_SESSION['state']."' AND slider_kind = '".$_SESSION['kind']."' AND image_id > 0 ORDER BY slider_loc4";
		$dbObj2 = db_getDBObject();
		//$resultexistingstate = $dbObj2->query($sqlexistingstate);
		$resultcity2 = $dbObj2->query($sqlslidercity);
	}

	/* $sqlcat = "SELECT distinct ListingCategory.title1 name,ListingCategory.id id FROM `Listing_Category` INNER Join ListingCategory ON `Listing_Category`.category_root_id = ListingCategory.id order by 1"; 
	$selname = "cat"; $dbObj = db_getDBObject();$resultcat = $dbObj->query($sqlcat);
	if ($catid > 0 )  {
		$sqlsubcat = "SELECT distinct c.title1 name, c.id id FROM Listing_Category b INNER JOIN ListingCategory c on (b.category_id = c.id) WHERE (c.enabled= 'y') AND c.`left` >= (select cl.`left` from ListingCategory cl where cl.id = ".$catid.") AND c.`right` <= (select cr.`right` from ListingCategory cr where cr.id = ".$catid.") AND c.root_id = (select root.root_id from ListingCategory root where root.id = ".$catid.") order by 1"; 
		$selname = "subcat"; $dbObj = db_getDBObject();$resultsubcat = $dbObj->query($sqlsubcat);
	} */
?>	

	<table border="0" cellspacing="0" cellpadding="0" class="standard-table">
		<tr>
			<th class="standard-tabletitle">Master Default Category Slider Controls</th>
		</tr>
	</table>
	
	<? 

	$selmsg = "";
	if ($selmsg && false) { ?>
		<p class="successMessage">
			<? echo $selmsg;?>
		</p>
	<?}?>


	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
		<tr>
			<th  style="width:auto;">Slider Name</th>
			<th style="width: 100px;">Turn ON/OFF</th>
			<th style="width: 145px;">Edit</th>
		</tr>
		<? $static_redirect = str_replace("slidergo.php","content_slider.php",system_getFormAction($_SERVER["PHP_SELF"]))."?kind=HOME&state=DEFAULT&city=DEFAULT"?>
		<tr>
			<td>
				<a title="HOME" href="<? echo  $static_redirect; ?>" class="link-table">Home Default Slider</a>
			</td>
			<td>
				<a title="Click to ON/OFF"  href="<? echo str_replace("content_slider.php","slider_switch.php",$static_redirect); ?>" class="link-table">
				 <span class=status-active><?setting_get("HOME", $slider_feature); echo $slider_feature;?></span></a>
			</td>
			<td>
				<a href="<? echo $static_redirect; ?>"  class="link-table">
						<img src="http://www.dealcloudusa.com/images/bt_edit.gif" border="0" alt="Click here to edit this Slider" title="Click here to edit this Slider" />
				</a>
			</td>
		</tr>
		<? $static_redirect = str_replace("slidergo.php","content_slider.php",system_getFormAction($_SERVER["PHP_SELF"]))."?kind=LISTINGS&state=DEFAULT&city=DEFAULT"?>
		<tr>
			<td>
				<a title="HOME" href="<? echo  $static_redirect; ?>" class="link-table">Listings Default Slider</a>
			</td>
			<td>
				<a title="Click to ON/OFF"  href="<? echo str_replace("content_slider.php","slider_switch.php",$static_redirect); ?>" class="link-table">
				 <span class=status-active><?setting_get("LISTINGS", $slider_feature); echo $slider_feature;?></span></a>
			</td>
			<td>
				<a href="<? echo $static_redirect; ?>"  class="link-table">
						<img src="http://www.dealcloudusa.com/images/bt_edit.gif" border="0" alt="Click here to edit this Slider" title="Click here to edit this Slider" />
				</a>
			</td>
		</tr>
		<? $static_redirect = str_replace("slidergo.php","content_slider.php",system_getFormAction($_SERVER["PHP_SELF"]))."?kind=DEALS&state=DEFAULT&city=DEFAULT"?>
		<tr>
			<td>
				<a title="HOME" href="<? echo  $static_redirect; ?>" class="link-table">Deals Default Slider</a>
			</td>
			<td>
				<a title="Click to ON/OFF"  href="<? echo str_replace("content_slider.php","slider_switch.php",$static_redirect); ?>" class="link-table">
				 <span class=status-active><?setting_get("DEALS", $slider_feature); echo $slider_feature;?></span></a>
			</td>
			<td>
				<a href="<? echo $static_redirect; ?>"  class="link-table">
						<img src="http://www.dealcloudusa.com/images/bt_edit.gif" border="0" alt="Click here to edit this Slider" title="Click here to edit this Slider" />
				</a>
			</td>
		</tr>
		<? $static_redirect = str_replace("slidergo.php","content_slider.php",system_getFormAction($_SERVER["PHP_SELF"]))."?kind=EVENTS&state=DEFAULT&city=DEFAULT"?>
		<tr>
			<td>
				<a title="HOME" href="<? echo  $static_redirect; ?>" class="link-table">Events Default Slider</a>
			</td>
			<td>
				<a title="Click to ON/OFF"  href="<? echo str_replace("content_slider.php","slider_switch.php",$static_redirect); ?>" class="link-table">
				 <span class=status-active><?setting_get("EVENTS", $slider_feature); echo $slider_feature;?></span></a>
			</td>
			<td>
				<a href="<? echo $static_redirect; ?>"  class="link-table">
						<img src="http://www.dealcloudusa.com/images/bt_edit.gif" border="0" alt="Click here to edit this Slider" title="Click here to edit this Slider" />
				</a>
			</td>
		</tr>
		<? $static_redirect = str_replace("slidergo.php","content_slider.php",system_getFormAction($_SERVER["PHP_SELF"]))."?kind=ARTICLES&state=DEFAULT&city=DEFAULT"?>
		<tr>
			<td>
				<a title="HOME" href="<? echo  $static_redirect; ?>" class="link-table">Articles Default Slider</a>
			</td>
			<td>
				<a title="Click to ON/OFF"  href="<? echo str_replace("content_slider.php","slider_switch.php",$static_redirect); ?>" class="link-table">
				 <span class=status-active><?setting_get("ARTICLES", $slider_feature); echo $slider_feature;?></span></a>
			</td>
			<td>
				<a href="<? echo $static_redirect; ?>"  class="link-table">
						<img src="http://www.dealcloudusa.com/images/bt_edit.gif" border="0" alt="Click here to edit this Slider" title="Click here to edit this Slider" />
				</a>
			</td>
		</tr>
		<? $static_redirect = str_replace("slidergo.php","content_slider.php",system_getFormAction($_SERVER["PHP_SELF"]))."?kind=CLASSIFIEDS&state=DEFAULT&city=DEFAULT"?>
		<tr>
			<td>
				<a title="HOME" href="<? echo  $static_redirect; ?>" class="link-table">Classifieds Default Slider</a>
			</td>
			<td>
				<a title="Click to ON/OFF"  href="<? echo str_replace("content_slider.php","slider_switch.php",$static_redirect); ?>" class="link-table">
				 <span class=status-active><?setting_get("CLASSIFIEDS", $slider_feature); echo $slider_feature;?></span></a>
			</td>
			<td>
				<a href="<? echo $static_redirect; ?>"  class="link-table">
						<img src="http://www.dealcloudusa.com/images/bt_edit.gif" border="0" alt="Click here to edit this Slider" title="Click here to edit this Slider" />
				</a>
			</td>
		</tr>
		<? $static_redirect = str_replace("slidergo.php","content_slider.php",system_getFormAction($_SERVER["PHP_SELF"]))."?kind=BLOGS&state=DEFAULT&city=DEFAULT"?>
		<tr>
			<td>
				<a title="HOME" href="<? echo  $static_redirect; ?>" class="link-table">Blogs Default Slider</a>
			</td>
			<td>
				<a title="Click to ON/OFF"  href="<? echo str_replace("content_slider.php","slider_switch.php",$static_redirect); ?>" class="link-table">
				 <span class=status-active><?setting_get("BLOGS", $slider_feature); echo $slider_feature;?></span></a>
			</td>
			<td>
				<a href="<? echo $static_redirect; ?>"  class="link-table">
						<img src="http://www.dealcloudusa.com/images/bt_edit.gif" border="0" alt="Click here to edit this Slider" title="Click here to edit this Slider" />
				</a>
			</td>
		</tr>

		</table>	



	
	<table border="0" cellspacing="0" cellpadding="0" class="standard-table">
	<tr>
		<th class="standard-tabletitle" style="font-size:14px;">Select State and City to Add/Edit Slides</th>
	</tr>
	<tr>
	<td id="div_select_0" class="field locationSelect" colspan="2">
	<select name="kind" onchange="submit();" class="select" style = "font-size:14px;color:green;font-weight:bold;">
	<option value = "<? if ($_SESSION['kind']) echo $_SESSION['kind']; else echo "HOME"; ?>"><? if ($_SESSION['kind']) echo $_SESSION['kind']; else echo "HOME"; ?></option>
	<option value = "HOME">HOME</option>
	<option value = "DEALS">DEALS</option>
	<option value = "LISTINGS">LISTINGS</option>
	<option value = "CLASSIFIEDS">CLASSIFIEDS</option>
	<option value = "EVENTS">EVENTS</option>
	<option value = "ARTICLES">ARTICLES</option>	
	<option value = "BLOGS">BLOGS</option>		
	 </select>		
	 </td>
	</tr>
	

	<tr>
	<td id="div_select_1" class="field locationSelect" colspan="2">
	<select name="state"  onchange="submit();" class="select" style = "font-size:14px;color:green;font-weight:bold;">
		<option value = "<? if ($_SESSION['state']) echo $_SESSION['state']; else echo ""; ?>"><? if ($_SESSION['state']) echo $_SESSION['state']; else echo "Select State"; ?></option>
		<option value = "Select State">Select State</option>
		<? while($row = mysql_fetch_assoc($resultstate)) { ?>
			<option value = "<? echo $row['name'] ?>"><? echo $row['name'] ?></option>
		<? } ?>
	 </select>		
	 </td>
	</tr>

	<tr>
	<td id="div_select_2" class="field locationSelect" >
	<select name="city"  class="select" style = "font-size:14px;color:green;font-weight:bold;width:367px;">
	 <option value = "<? if ($_SESSION['city']) echo $_SESSION['city']; else echo ""; ?>"><? if ($_SESSION['city']) echo $_SESSION['city']; else echo "Select City"; ?></option>
	  <? while($row = mysql_fetch_assoc($resultcity)) { ?>
		<option value = "<? echo $row['name'] ?>"><? echo $row['name'] ?></option>
	 <? } ?>
	<option>None</option>
	 </select>		
	 </td>
	 <td>
		<input type="submit" name="btnButton" ID="btnButton"  value='ADD/Edit Slider' class="input-button-form" style="font-size:12px;" onClick="submit();"></button>
	 </td>
	 <?if ($err) {?><tr><td style="color:red;" colspan="2"><?=$err?></td></tr><?}?>
	</tr>

	</table>

<? /* ?>
	<tr>
	<td id="div_select_3" class="field locationSelect" >
	<select name="cat"  onchange="submit();" class="select" style = "font-size:14px;" disabled="true">
	 <option value = "<? if ($_SESSION['cat']) echo $_SESSION['cat']; else echo ""; ?>"><? if ($_SESSION['catname']) echo $_SESSION['catname']; else echo "Select Category"; ?></option>
	  <? while($row = mysql_fetch_assoc($resultcat)) { ?>
		<option value = "<? echo $row['name']."'".$row['id'] ?>"><? echo $row['name'] ?></option>
	 <? } ?>
	<option>None</option>
	 </select>		
	 </td>
	</tr>


	<tr>
	<td id="div_select_4" class="field locationSelect" >
	<select name="subcat" class="select" style = "font-size:14px;" disabled="true">
	 <option value = "<? if ($_SESSION['subcat']) echo $_SESSION['subcat']; else echo ""; ?>"><? if ($_SESSION['subcatname']) echo $_SESSION['subcatname']; else echo "Select Sub Category"; ?></option>
	  <? while($row = mysql_fetch_assoc($resultsubcat)) { ?>
		<option value = "<? echo $row['name']."'".$row['id'] ?>"><? echo $row['name'] ?></option>
	 <? } ?>
	<option>None</option>
	 </select>		
	 </td>
	</tr>
<? */ ?>

	


	
	
	<table border="0" cellspacing="0" cellpadding="0" class="standard-table" style="margin:0px;">						
		<tbody><tr><th class="standard-tabletitle">Modified sliders for<?=" ".$_SESSION['kind']." by cities";?></th></tr></tbody>	
	</table>
	
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
		<tr>
			<th  style="width:auto;">City Name</th>
			<th style="width: 145px;">Edit</th>
		</tr>
	<? while($row = mysql_fetch_assoc($resultcity2)) { 
		$redirecturl = str_replace("slidergo.php","content_slider.php",system_getFormAction($_SERVER["PHP_SELF"]))."?kind=".$_SESSION['kind']."&state=".$_SESSION['state']."&city=".$row['name'];
	?>
		<tr>
			<td>
				<a title="<? echo $row['name'] ?>" href="<? echo $redirecturl ?>" class="link-table"><? echo $row['name'];?></a>
			</td>
			<td>
				<a href="<? echo $redirecturl ?>" class="link-table">
						<img src="http://www.dealcloudusa.com/images/bt_edit.gif" border="0" alt="Click here to edit this Slider" title="Click here to edit this Slidert" />
				</a>
				<!-- <a href="http://www.dealcloudusa.com/sitemgr/event/delete.php?id=5&screen=&letter=" class="link-table">
					<img src="http://www.dealcloudusa.com/images/bt_delete.gif" alt="Click here to delete this Slider" border="0" title="Click here to delete this Slidert" />
				</a> -->
			</td>
		</tr>
	<? } ?>
	</table>			

	



	


	<? unset($dbCatObj); unset($dbCatObj2);?>

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

