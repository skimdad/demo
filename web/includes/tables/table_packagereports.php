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
	# * FILE: /includes/tables/table_packagereports.php
	# ----------------------------------------------------------------------------------------------------

	
	if ((!string_strpos($_SERVER["PHP_SELF"], "sitemgr/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))){
		include(INCLUDES_DIR."/tables/table_paging.php");
	}
	?>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

		<tr>
			<th style="width: auto;"><?=system_showText(LANG_SITEMGR_PACKAGE_SING);?></th>
			<th style="width: auto;"><?=system_showText(LANG_SITEMGR_DOMAIN_SING);?></th>
			<th style="width: auto;"><?=system_showText(LANG_LABEL_TYPE);?></th>
			<th style="width: auto;"><?=system_showText(LANG_LABEL_ITEM);?></th>
			<th style="width: auto;"><?=system_showText(LANG_LABEL_DATE);?></th>
		</tr>

		<?
		if($packageReports){
			foreach($packageReports as $report){

				$package_name = "";
				$domain_name = "";
				$type = "";
				$item_name = "";

				$package = new Package($report->getNumber("package_id"));
				$type = ucfirst($report->getString("module"));
				if ($type != "Custom_package"){
					$domain = new Domain($report->getNumber("domain_id")); 
					$item = new $type($report->getNumber("module_id"), $report->getNumber("domain_id"));

					if ($type != "Banner")
						$item_name = $item->getString("title");
					else
						$item_name = $item->getString("caption");

					$type = ucfirst(constant("LANG_SITEMGR_".strtoupper($type)));

					$domain_name = $domain->getString("name");

					$linkViewURI = "/sitemgr/".$report->getString("module")."/view.php?id=".$report->getNumber("module_id");
					$linkViewQSTRING = "id=".$report->getNumber("module_id");
					if ($item_name)
						$linkViewItem = "<a class=\"link-table\" href=\"javascript: void(0);\" onclick=\"changeDomainInfo(".$report->getNumber("domain_id").",'".DEFAULT_URL."','".$linkViewURI."','".$linkViewQSTRING."','false', 'true')\" title=\"".$item_name."\">".$item_name."</a>";
					else
						$linkViewItem = $report->getString("module_name");
				} else {
					$linkViewItem = "--";
					$domain_name = "--";
					$type = LANG_SITEMGR_PACKAGE_CUSTOM_OPTION_LABEL;
				}

				$package_name = $package->getString("title");

				$id = $report->getNumber("package_id");
				$str_time = "";
				$str_time = format_getTimeString($report->getString("date"));

				?>
				<tr>
					<td>
						<a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table" title="<?=$package_name?>">
							<?=$package_name?>
						</a>
					</td>
					<td>
						<span title="<?=$domain_name?>" style="cursor:default"><?=$domain_name;?></span>
					</td>
					<td>
						<span title="<?=$type?>" style="cursor:default"><?=$type;?></span>
					</td>
					<td>
						<?=$linkViewItem;?>
					</td>
					<td>
						<span title="<?=format_date($report->getString("date"), DEFAULT_DATE_FORMAT, "datetime")." - ".$str_time?>" style="cursor:default"><?=format_date($report->getString("date"), DEFAULT_DATE_FORMAT, "datetime")." - ".$str_time;?></span>
					</td>
				</tr>
				<?
			}
		}
		?>
	</table>