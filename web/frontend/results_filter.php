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
	# * FILE: /frontend/results_filter.php
	# ----------------------------------------------------------------------------------------------------

	/*
	 * Prepare $aux_array_rss to RSS 
	 */
	 if($show_results && $itemRSSSection){
		include(EDIRECTORY_ROOT."/includes/code/rss.php");
	 }

	if ($aux_module_items && !$hideResults) { ?>
		<div class="filter">
			<div class="left">
				<?=$orderbyDropDown?>
			</div>
			<div class="right">
				<?
				if(is_array($aux_array_rss)){
					?>
					<a title="<?=LANG_LABEL_SUBSCRIBERSS?>" class="rss-feed" target="_blank" href="<?=$aux_array_rss["link"]?>">
						<?=LANG_LABEL_SUBSCRIBERSS?>
					</a>
					<?
				}
				if (CACHE_FULL_FEATURE != "on"){
				?>
				<form class="form" method="post" action="<?=DEFAULT_URL.str_replace("&", "&amp;", $_SERVER["REQUEST_URI"])?>">
					<label><?=system_showText(LANG_PAGING_RESULTS_PER_PAGE);?>:</label>
					<select class="select" name="results_per_page" id="results_per_page" disabled="disabled">
						<option <?=($aux_items_per_page == 10 ? "selected=\"selected\"" : "")?>>10</option>
						<option <?=($aux_items_per_page == 20 ? "selected=\"selected\"" : "")?>>20</option>
						<option <?=($aux_items_per_page == 30 ? "selected=\"selected\"" : "")?>>30</option>
						<option <?=($aux_items_per_page == 40 ? "selected=\"selected\"" : "")?>>40</option>
					</select>
				</form>
				<? } ?>
				<p><?=$array_pages_code["total"] != 1 ? system_showText(LANG_PAGING_FOUND_PLURAL) : system_showText(LANG_PAGING_FOUND)?> <strong><?=$array_pages_code["total"]?></strong> <?=(($array_pages_code["total"]!=1)?(system_showText(LANG_PAGING_RECORD_PLURAL)):(system_showText(LANG_PAGING_RECORD)))?>  | <?=system_showText(LANG_SEARCHRESULTS_PAGE)?> <strong><?=$array_pages_code["current"]?></strong> <?=system_showText(LANG_PAGING_PAGEOF)?> <strong><?=$array_pages_code["last_page"]?></strong><?(CACHE_FULL_FEATURE != "on" ? " |" : "")?></p>
			</div>
		</div>
		<?
	} 
	?>