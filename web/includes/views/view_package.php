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
	# * FILE: /includes/views/view_package.php
	# ----------------------------------------------------------------------------------------------------

?>

<table cellpadding="2" cellspacing="0" class="table-account">

	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_PACKAGE_TITLE)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account" title="<?=$package->getString("title")?>">
				<?=system_showTruncatedText(system_showAccountUserName($package->getString("title")), 35);?>
			</span>
		</td>
	</tr>

	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_ORDERED_ITEM)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">

				<?
					$module = ucfirst($package->getNumber("module"));
					$level_number = $package->getNumber("level");
					$levelObj = $module."Level";
					$level = new $levelObj();
					$level_str = ucfirst($level->getName($level_number));
				?>

				<?=ucfirst($module).($module != "Article" ? " - ".$level_str : "");?>
			</span>
		</td>
	</tr>

	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_OFFER)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">

				<?
					$module = ucfirst($aux_offer_item);
					$level_number = $aux_offer_item_level;
					if ($aux_offer_item != "custom_package"){
						$levelObj = $module."Level";
						$level = new $levelObj();
						$level_str = ucfirst($level->getName($level_number));
						
						echo $module.($module != "Article" ? " - ".$level_str : "");
					} else {
						echo LANG_SITEMGR_PACKAGE_CUSTOM_OPTION_LABEL;
					}
				?>


			</span>
		</td>
	</tr>
	<?if ($aux_offer_item != "custom_package"){ ?>
		<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

			<tr>
				<th style="width: 600px;"><?=system_showText(LANG_SITEMGR_DOMAIN_PLURAL);?></th>
				<th style="width: 40px;"><?=system_showText(LANG_SITEMGR_LABEL_PRICE);?></th>
			</tr>

			<?

			for($i=0;$i<count($aux_package_items_domains);$i++){

				$domain = new Domain($aux_package_items_domains[$i]);
				if ($domain->getString("status") == "A"){
				?>

				<tr>
					<td><?=$domain->getString("name")?></td>
					<td><?=CURRENCY_SYMBOL." ".$aux_package_items_values[$aux_package_items_domains[$i]]?></td>
				<tr>

		<?	}
		}	?>
		</table>
	<? } else { ?>
	<?/*
		<tr class="tr-account">
			<td align="right" class="td-account">
				<div class="label-account">
					<?=ucfirst(system_showText(LANG_SITEMGR_CONTENT))?>:
				</div>
			</td>
			<td align="left" class="td-account">
				<span class="label-field-account">
					<?=${"content".$langIndex};?>
				</span>
			</td>
		</tr>
		*/?>
		<tr class="tr-account">
			<td align="right" class="td-account">
				<div class="label-account">
					<?=ucfirst(system_showText(LANG_SITEMGR_LABEL_PRICE))?>:
				</div>
			</td>
			<td align="left" class="td-account">
				<span class="label-field-account">
					<?=$price;?>
				</span>
			</td>
		</tr>
	<?	}
	?>
</table>
