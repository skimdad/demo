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
	# * FILE: /sitemgr/content/navigation_options.php
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
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	header("Content-Type: text/html; charset=utf-8", TRUE);
	header("Accept-Encoding: gzip, deflate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check", FALSE);
    header("Pragma: no-cache");

	# ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
	$hidenavBar = true;
	
	include(INCLUDES_DIR."/code/navbar.php");
	
	extract($_GET);

	if (!$option){
		$option = "module";
	}
	
	if ($number && $navbarType){ ?>
		<div class="informationMessage" style="width:290px;height:20px">
			 <?
			 // SAVED
			 if ($number == 1)
				 echo system_showText(NAVBAR_SAVED_MESSAGE1);

			 // ERROR
			 if ($number == 2)
				echo system_showText(NAVBAR_SAVED_MESSAGE2);
			?>
		 </div>
	<? die;
	}

	if ($option == "module") { ?>
		 <div id="module_options">
			 <h5><?=system_showText(LANG_SITEMGR_MENUCONFIG_SELECT_MODULE)?>: </h5>

			<table cellpadding="0" cellspacing="0" border="0" class="standard-table select-table">
				<? $array_edir_languagenames = explode(",", EDIR_LANGUAGES);
				foreach ($navBarSequenceArray[$navbarType] as  $itemInfo){
					// FIND CURRENT LANGUAGE: EDIR_LANGUAGE../../scripts
					$langObj = new Lang();
					$langOrder = $langObj->getAll();
					$posNameVar = 0;
					foreach ($langOrder as $orderInfo)
						if($orderInfo["id"] == EDIR_LANGUAGE)
							$language_id = $orderInfo["id_number"];

					$varName = "name_{$language_id}";
                    
                    $showItem = true;
                    
                    if ($itemInfo["item"] == EVENT_FEATURE_FOLDER){
						if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on"){
							$showItem = false;
						}
					}

					if ($itemInfo["item"] == CLASSIFIED_FEATURE_FOLDER){
						if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on"){
							$showItem = false;
						}
					}

					if ($itemInfo["item"] == ARTICLE_FEATURE_FOLDER){
						if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on"){
							$showItem = false;
						}
					}

					if ($itemInfo["item"] == PROMOTION_FEATURE_FOLDER){
						if (PROMOTION_FEATURE != "on" || CUSTOM_HAS_PROMOTION != "on" || CUSTOM_PROMOTION_FEATURE != "on"){
							$showItem = false;
						}
					}

					if ($itemInfo["item"] == BLOG_FEATURE_FOLDER){
						if (BLOG_FEATURE != "on" || CUSTOM_BLOG_FEATURE != "on"){
							$showItem = false;
						}
					}
					if ($showItem) { ?>
                        <tr>
                            <th>
                                <a href="javascript:void(0)" name="module" class="module_option optionUse" li_id="<?=$itemInfo["li_id"]?>"
                                   <? foreach ($langOrder as $lang) {?>
                                        <? if ($lang["lang_enabled"] == "y") { ?>
                                            name_<?=$lang["id_number"]?>="<? $varname = "name_{$lang["id_number"]}"; echo trim($itemInfo[$varname])?>"
                                        <? } ?>
                                    <? } ?>
                                    link="<?=$itemInfo["link"]?>"
                                    item="<?=$itemInfo["item"]?>"
                                   ><?=system_showText(LANG_SITEMGR_MENUCONFIG_USE)?>
                                </a>
                            </th>
                            <td><?=$itemInfo[$varName]?> <span class="url">(<?=$itemInfo["link"]?>)</span></td>
                        </tr>
				<? }
                } ?>

					<tr>
						<th>&nbsp;</th>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
							<a href="javascript:void(0)" id="closeButtonfloat2"><?=system_showText(LANG_SITEMGR_CLOSE)?></a>
						</td>
					</tr>
			</table>

		</div>
	<? } ?>

	<? if ($option == "sitecontent"){

		$hidenavBar = true;
		
		include(INCLUDES_DIR."/code/navbar.php");
		
		$langObj = new Lang();
		$langOrder = $langObj->getAll();
		$posNameVar = 0;
		foreach ($langOrder as $orderInfo)
			if($orderInfo["id"] == EDIR_LANGUAGE)
				$language_id = $orderInfo["id_number"];

		if (!$getLines){ ?>

			<div id="custom_options">
				
		<? }
		
        $num_languages = count(explode(",", EDIR_LANGUAGENAMES));

        $screen = (int)$screen;
        $resultsPerPage = 5;

        $pageObj  = new pageBrowsing("Content",$screen,$resultsPerPage, "id", "id", $letter, "section = 'client'");
        $contents = $pageObj->retrievePage();
        $paging_url = "javascript:void(0);\" params=\"";

        # PAGES DROP DOWN ----------------------------------------------------------------------------------------------
        $pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");//id=\"dropdownSitecontent
        # --------------------------------------------------------------------------------------------------------------

        if($contents){ ?>
			<h5><?=system_showText(LANG_SITEMGR_MENUCONFIG_SELECT_CUSTOMPG)?>: </h5>
			
			<table cellpadding="0" cellspacing="0" border="0" class="standard-table" id="itemsTable" >
			<? $domain = new Domain(SELECTED_DOMAIN_ID); 
			
			foreach ($contents as $content){ ?>
				<tr>
					<th>
						<a href="javascript:void(0)" name="module" class="custom_options optionUse" li_id="<?=$content->getString("id")?>"
						<? for ($X=1;$X<=$num_languages;$X++) {
								$varName="name_{$X}";
						?>
						<?=$varName?>="<?=$content->getString("title")?>"
						<? } ?>
						link="http://<?=$domain->getString("url").EDIRECTORY_FOLDER?>/content/<?=$content->getString("url")?>.html" item="custom"
						>  <?=system_showText(DEAL_SITEMGR_USE)?>
						</a>
					</th>
					<td>
						<?=$content->getString("title")?> <span class="url">(http://<?=$domain->getString("url").EDIRECTORY_FOLDER?>/content/<?=$content->getString("url").".html"?>)</span>
					</td>
				</tr>
			<? } ?>
				<tr>
					<th colspan="2"><? include(INCLUDES_DIR."/tables/table_paging.php");?></th>
				</tr>
				<tr>
					<td colspan="2">
						<a href="javascript:void(0);" id="closeButtonfloat2"><?=system_showText(LANG_SITEMGR_CLOSE)?></a>
					</td>
				</tr>
            </table> 
        <? } else { ?>
			
            <p class="informationMessage" >
               <?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_SORRYNOCUSTOM)?>
            </p>
			
        <? } ?>

		<p class="note">
		   <?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_CREATENEWCC)?><a target="_blank" style="padding-left:20px" href="<?=DEFAULT_URL?>/sitemgr/content/client.php">
		   <?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_CLICKINGH)?></a>.
		</p>
		
	<? if (!$getLines){ ?>
		</div>
	<? } ?>

	<? } ?>

	<input type="hidden" id="pleaseSelect" value="<?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_SELECTORHIT)?>">

	<script type="text/javascript">
		
		function setSelection(){
			$(".optionUse").click(function(){
			var currentID=$("#li_id").val();
				var selectBoxes=$(this);
				var num_languages=$("#num_languages").val();
				var currentLang=$(".tabActived").attr("lang_id");
				for (i=1;i<=num_languages;i++){
						var nameid=("name_"+ARRAY_LANG[i-1]);
						var nameToWrite=selectBoxes.attr(nameid);
						$("#"+nameid).attr("value",nameToWrite);
				}

				$("#navBarItemForm").find("#item").attr("value",selectBoxes.attr("item"));
				$("#"+currentID).attr("link",selectBoxes.attr("link"));
				$("#link").attr("value",selectBoxes.attr("link"));

				for (i=1;i<=num_languages;i++){
					$("#"+currentID).attr("name_"+ARRAY_LANG[i-1],selectBoxes.attr("name_"+ARRAY_LANG[i-1]));
				}

				$("#"+currentID).find("a:first").html($("#name_"+currentLang).val());
			   $.closePopupLayer("moduleForm");

			});
		}

		$(document).ready(function() {
			$(".leftArrow").click(function(){
			   var params=$(this).attr("params");
			   if (params){
				   paramsAR=params.split("&");
				   var screen=(paramsAR[1]);
				   if (screen){
						var screenvalueARR=screen.split("=");
					   $("#custom_options select").attr("value",screenvalueARR[1]).trigger("change");
				   }
			   }
			});
			$(".rightArrow").click(function(){
			   var params=$(this).attr("params");
			   if (params){
				   paramsAR=params.split("&");
				   var screen=(paramsAR[1]);
				   if (screen){
						var screenvalueARR=screen.split("=");
					   $("#custom_options select").attr("value",screenvalueARR[1]).trigger("change");
				   }
			   }
			});
			$("#custom_options select").change(function(){
					var pageNumber=$(this).val();
					$.ajax({
					   type: "GET",
					   url: "/sitemgr/content/navigation_options.php?getLines=true&navbarType=<?=$navbarType?>&option=<?=$option?>&screen="+pageNumber,
					   cache: false,
					   beforeSend:function(){
							},
					   success: function(htmsl){
							$("#custom_options").html(htmsl);
					   },
					   complete:function(){
						   setSelection();
					   }
					 });
			 });

			$("#click").click(function(){
			   $.closePopupLayer("moduleForm");
			});

			$("#closeButtonfloat2").click(function(){
				$.closePopupLayer("moduleForm");
			})

			setSelection();
		});
	</script>
