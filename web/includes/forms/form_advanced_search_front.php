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
	# * FILE: /includes/forms/form_advanced_search_front.php
	# ----------------------------------------------------------------------------------------------------

	if (!$hideSearchTip) { ?>
        <div class="left search-tips">
            <h4><?=system_showText(LANG_SEARCH_MESSAGE_TITLE)?></h4>
            <p>&quot;<?=system_showText(LANG_SEARCH_MESSAGE_TEXT)?>&quot;</p>
        </div>
    <? } ?>

	<div class="left match" style="width: 220px; float: left;">
		<label><?=system_showText(LANG_SEARCH_LABELMATCH)?>:</label>
		<div style="width: 80px; float:left;"><input type="radio" name="match" value="exactmatch" class="radio" /> <?=system_showText(LANG_SEARCH_LABELMATCH_EXACTMATCH)?></div>
		<div style="width: 72px; float:left;"><input type="radio" name="match" value="anyword" class="radio" /> <?=system_showText(LANG_SEARCH_LABELMATCH_ANYWORD)?></div>
		<div style="width: 65px; float:left;"><input type="radio" name="match" value="allwords" class="radio" checked="yes" /> <?=system_showText(LANG_SEARCH_LABELMATCH_ALLWORDS)?></div>
		<input type="hidden" name="advsearch" value="yes" />
	</div>

<? if (true) {?>	
	<div class="left">
		<label><?=system_showText(LANG_SEARCH_LABELCATEGORY)?>:</label>
		<div id="advanced_search_category_dropdown">
			<?=$categoryDD;?>
		</div>
	</div>
<? } ?>	

	<?
	unset($showLoc);
	if ($_default_locations_info) {
		foreach ($_default_locations_info as $info) {
			if ($info["show"] == "y") {
				$showLoc = true;
				break;
			}
		}
	}

	/* if (${"locations".$_non_default_locations[0]} || $showLoc) {
		?>
		<div class="left">
			<div id="LocationbaseAdvancedSearch">
				<? $advanced_search = true; ?>
				<? include(EDIRECTORY_ROOT."/includes/code/load_location.php"); ?>
			</div>
		</div>
	<? } */
		
	if ($hasWhereSearch) { ?>

		<div class="left zipcode"  style="width:210px;">
			<label><?=string_ucwords(ZIPCODE_LABEL)?>:</label>
			<? if (ZIPCODE_PROXIMITY == "on") { ?>
                <div style="width: 110px; float: left;">
                    <input type="text" name="dist" value="<?=($dist)? $dist : "100" ?>" class="text" />
                    <?=string_ucwords(ZIPCODE_UNIT_LABEL_PLURAL)." ".system_showText(LANG_SEARCH_LABELZIPCODE_OF)?>
                </div>
            <? } ?>
			<div style="width: 100px; float: left;">
				<input type="text" name="zip" id="zip" value="<?=isset($_SESSION["s_zip"])? $_SESSION["s_zip"] : "" ?>" class="text" onfocus="emptywhere();"/>
				<?=(ZIPCODE_PROXIMITY == "on" ? string_ucwords(ZIPCODE_LABEL) : "")?>
			</div>
		</div>
	<? } ?>