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
	# * FILE: /sitemgr/plugins/index.php
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
	
	$_GET["type"] = ($_POST["type"] ? $_POST["type"] : $_GET["type"]);
	
	if (!$_GET["type"] && SUGARCRM_FEATURE == "on"){
		//increases frequently actions
		system_setFreqActions('sugar','sugar');
	} else {
		if (SUGARCRM_FEATURE == "off" && !$_GET["download"]){
			$_GET["type"] = 0;
		}
		system_setFreqActions('wordpress','wordpress');
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/plugins.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

	
	//Tabs controler
	unset($array_edir_plugin);

	if (SUGARCRM_FEATURE == "on"){
		$array_edir_plugin[0]["plugin_name"]			= LANG_SITEMGR_NAVBAR_SUGARCRM;
		$array_edir_plugin[0]["plugin_include_file"]	= "form_suggar_plugin.php";
		$array_edir_plugin[1]["plugin_name"]			= LANG_SITEMGR_NAVBAR_WORDPRESS;
		$array_edir_plugin[1]["plugin_include_file"]	= "form_wordpress_plugin.php";
	} else {
		$array_edir_plugin[0]["plugin_name"]			= LANG_SITEMGR_NAVBAR_WORDPRESS;
		$array_edir_plugin[0]["plugin_include_file"]	= "form_wordpress_plugin.php";
	}
	
	
	
?>
<script language="javascript" type="text/javascript">
	function ShowTabs(total_tabs, actived_id_tab, div_prefix, tab_prefix){
		
		for(i=0;i<total_tabs;i++){
			
			jQuery('#'+div_prefix+'_'+i).css('display', 'none');
			jQuery('#'+tab_prefix+'_'+i).removeClass("tabActived");
			
		}
		jQuery('#'+div_prefix+'_'+actived_id_tab).css('display', '');
		jQuery('#'+tab_prefix+'_'+actived_id_tab).addClass("tabActived");
		
	}

</script>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_PLUGINS)?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<br />

		
			<? if ($message_plugin) { ?>
				<div id="warning" class="<?=$message_style?>"><?=$message_plugin?></div>
			<? } ?>

			<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
				<tr>
					<th class="tabsBase">
						<ul class="tabs">
							<? 
							for($i=0;$i<count($array_edir_plugin);$i++){
								?>
								<li id="tab_plugin_<?=$i?>" <?=($i == $_GET["type"] ? "class=\"tabActived\"" : "")?>>
									<a href="javascript:void(0)" onclick="ShowTabs(<?=count($array_edir_plugin)?>, <?=$i?>, 'plugin_div', 'tab_plugin')">
										<?=$array_edir_plugin[$i]["plugin_name"]?><? if (DEMO_MODE && $array_edir_plugin[$i]["plugin_name"] == LANG_SITEMGR_NAVBAR_SUGARCRM) { ?>* <span class="optional">(Optional Module)</span> <? } ?>
									</a>
								</li>
								<?

							}?>
						</ul>
					</th>
				</tr>
			</table>

			<?
			// Create tabs to plugins
			if($_GET["type"]){
				$tab_active = $_GET["type"];
			}else{
				$tab_active = 0;
			}
			for($i=0;$i<count($array_edir_plugin);$i++){
				?>
				<div>
					<div id="plugin_div_<?=$i?>" <?=($tab_active != $i ? "style=\"display:none\"" : "")?>>
						<?
						include(INCLUDES_DIR."/forms/".$array_edir_plugin[$i]["plugin_include_file"]);
						?>
					</div>
				</div>
				<?
			}
			?>
			
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
