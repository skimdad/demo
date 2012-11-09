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
	# * FILE: /theme/realestate/frontend/searchSidebar.php
	# ----------------------------------------------------------------------------------------------------

    if (THEME_TEMPLATE_ID && THEME_TEMPLATE_ID > 0) {
        $keepFormOpen = true;
        $searchNotFriendly = true;
    }
    $hideSearchTip = true;
    system_sidebarInfo($label, $searchExtraFields);
?>

    <div class="content-search">
        <div class="search">
             <div class="search-box">
               <h2><? //if ($label != "Browse Listings") echo $label; else echo $label; ?>SEARCH DEAL CLOUD USA</h2>
                <? //include(EDIRECTORY_ROOT."/searchfront.php"); ?>
                <? if (THEME_TEMPLATE_ID && THEME_TEMPLATE_ID > 0 && $searchExtraFields) {
                        $listingTemplate = new ListingTemplate(THEME_TEMPLATE_ID);
                        $listingTemplateFields = $listingTemplate->getListingTemplateFields("", true);
                        if ($listingTemplateFields) {
                            echo "<span class=\"clear\"></span>";
                            $lineBreak = false;
                            foreach ($listingTemplateFields as $each_listingTemplateField) {
                                if ((string_strpos($each_listingTemplateField["field"], "custom_checkbox") !== false) && ($each_listingTemplateField["search"] == "y")) {
                                    $lineBreak = true;
                                    ?>
                                    <div class="templateCheckbox">
                                        <input type="checkbox" name="<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>" value="y" class="inputAuto" />
                                        <label><?=@constant($each_listingTemplateField["label"]);?></label>
                                    </div>
                                    <?
                                } elseif ((string_strpos($each_listingTemplateField["field"], "custom_dropdown") !== false) && ($each_listingTemplateField["search"] == "y")) {
                                    $lineBreak = true;
                                    ?>
                                    <fieldset>
                                        <select name="<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>">
                                            <option value=""><?=@constant($each_listingTemplateField["label"]);?></option>
                                            <?
                                            $auxfieldvalues = explode(",", $each_listingTemplateField["fieldvalues"]);
                                            foreach ($auxfieldvalues as $fieldvalue) {
                                                ?><option value="<?=$fieldvalue;?>"><?=$fieldvalue;?></option><?
                                            }
                                            ?>
                                        </select>
                                    </fieldset>
                                    <?
                                } elseif (string_strpos($each_listingTemplateField["field"], "custom_text") !== false) {
                                    if ($each_listingTemplateField["searchbykeyword"] == "y") {
                                        if ($lineBreak) {
                                            echo "<span class=\"clear\"></span>";
                                            $lineBreak = false;
                                        }
                                        $brClear = true;
                                        ?>
                                        <div class="templateText">
                                            <label><?=@constant($each_listingTemplateField["label"]);?></label>
                                            <input type="text" name="<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>" value="" />
                                        </div>
                                        <?
                                    } elseif ($each_listingTemplateField["searchbyrange"] == "y") {
                                        if ($lineBreak) {
                                            echo "<span class=\"clear\"></span>";
                                            $lineBreak = false;
                                        }
                                        if ($brClear){
                                            echo "<br class=\"clear\"/>";
                                            $brClear = false;
                                        }
                                        $dropdownValues = system_getDropdownValues(THEME_TEMPLATE_ID, $each_listingTemplateField["field"]);
                                        ?>
                                        <div class="templateRange">
                                            <p><?=system_showText(LANG_SEARCH_LABELFROM)?></p>
                                            <fieldset>
                                                <select name="from<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>">
                                                    <option value=""><?=@constant($each_listingTemplateField["label"]);?></option>
                                                    <?
                                                    $auxfieldvalues = explode(",", $each_listingTemplateField["fieldvalues"]);
                                                    foreach ($dropdownValues as $fieldvalue) {
                                                        ?><option value="<?=$fieldvalue[1];?>"><?=$fieldvalue[0];?></option><?
                                                    }
                                                    ?>
                                                </select>
                                            </fieldset>
                                            <fieldset>
                                                <p><?=system_showText(LANG_SEARCH_LABELTO)?></p>
                                                <select name="to<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>">
                                                    <option value=""><?=@constant($each_listingTemplateField["label"]);?></option>
                                                    <?
                                                    $auxfieldvalues = explode(",", $each_listingTemplateField["fieldvalues"]);
                                                    foreach ($dropdownValues as $fieldvalue) {
                                                        ?><option value="<?=$fieldvalue[1];?>"><?=$fieldvalue[0];?></option><?
                                                    }
                                                    ?>
                                                </select>
                                            </fieldset>
                                        </div>    
                                        <?/*
                                        <div class="templateRange">
                                            <label><?=@constant($each_listingTemplateField["label"]);?></label>
                                            <p><?=system_showText(LANG_SEARCH_LABELFROM)?></p> <input type="text" name="from<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>" value="" />
                                            <p><?=system_showText(LANG_SEARCH_LABELTO)?></p> <input type="text" name="to<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>" value="" />
                                        </div>
                                        */?>
                                        <?
                                    }
                                } elseif ((string_strpos($each_listingTemplateField["field"], "custom_short_desc") !== false) && ($each_listingTemplateField["searchbykeyword"] == "y")) {
                                    if ($lineBreak) {
                                        echo "<span class=\"clear\"></span>";
                                        $lineBreak = false;
                                    }
                                    ?>
                                    <div class="templateDescription">
                                        <label><?=@constant($each_listingTemplateField["label"]);?></label>
                                        <input type="text" name="<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>" value="" />
                                    </div>
                                    <?
                                } elseif ((string_strpos($each_listingTemplateField["field"], "custom_long_desc") !== false) && ($each_listingTemplateField["searchbykeyword"] == "y")) {
                                    if ($lineBreak) {
                                        echo "<span class=\"clear\"></span>";
                                        $lineBreak = false;
                                    }
                                    ?>
                                    <div class="templateLongDescription">
                                        <label><?=@constant($each_listingTemplateField["label"]);?>:</label>
                                        <input type="text" name="<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>" value="" />
                                    </div>
                                    <?
                                }
                            }
                        }
                    }
    
                    if($hasAdvancedSearch && false){ ?>

                        <a id="advanced-search-button" href="javascript:void(0);" onclick="showAdvancedSearch('<?=$advancedSearchItem?>', '<?=$action?>', '<?=$action_adv?>','<?=$aux_template_id?>', true);">
                            <span id="advanced-search-label">+ <?=system_showText(LANG_BUTTON_ADVANCEDSEARCH);?></span>
                            <span id="advanced-search-label-close" style="display:none">- <?=system_showText(LANG_BUTTON_ADVANCEDSEARCH_CLOSE);?></span>
                        </a>
                        <?          
                            $template_id = $template_id ? $template_id : 0; 
                            $hideSearchTip = true;
                        ?>

                        <div id="advanced-search" style="display:none;">
                            <? include(EDIRECTORY_ROOT."/advancedsearch.php") ?>
                        </div>
                    
                    <button type="button" id="buttonSearch" onclick="submitformSearch('<?=$action?>');"><?=system_showText(LANG_BUTTON_SEARCH);?></button>
				<? } ?>
				<? include(EDIRECTORY_ROOT."/searchfront.php"); ?>
                </form> <!-- this form was opened on searchfront.php -->
            </div>
        </div>
		
    </div> 