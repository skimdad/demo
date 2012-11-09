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
	# * FILE: /includes/views/view_listing_summary_code_realestate.php
	# ----------------------------------------------------------------------------------------------------

	if (is_array($listing)) {
		$aux = $listing;
	} else if (is_object($listing)) {
		$aux = $listing->listing_array;
	}

	if ($listingtemplate_friendly_url){ ?>
		<a name="<?=$listingtemplate_friendly_url;?>"></a>
	<? } ?>
	
	<div <?=$listing["id"] ? "id=\"listing_summary_".$listing["id"]."\"" : ""?> class="<?=$listing["backlink"] == "y" && BACKLINK_FEATURE == "on" ? "summary summary-backlink" : "summary" ?>">

		<div class="left">

            <? if ($listingtemplate_image) { ?>
            
			<div class="image">

				<?=$listingtemplate_image?>
                
            <? } ?>
                
				<? if ($listingtemplate_review) { ?>
                    <div class="review">
                        <?=$listingtemplate_review?>
                    </div>
				<? } ?>
				
				<? if($listingtemplate_checkin) { ?>
                    <div class="check-in">
                        <?=$listingtemplate_checkin?>
                    </div>
				<? } ?>

			</div>
            
            <div class="backlink-content">
            
                <div class="title">
    
                    <h3>
                        <? if ((string_strpos($_SERVER["PHP_SELF"], "results.php") !== false) && GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") { ?>
                            <? if ($aux["latitude"] && $aux["longitude"]) { ?>
                                <span id="summaryNumberID<?=$mapNumber;?>" class="map <?=(($_COOKIE['showMap'] == 0) ? ('visible') : ('hidden'))?>">
                                    <a class="map-link" href="javascript:void(0);" onclick="myclick(<?=($mapNumber);?>);scrollPage();">
                                        <?=$mapNumber;?>.
                                    </a>
                                </span>
                            <? } ?>
                        <? } ?>
                        <?
                        $listingtemplate_title = str_replace($auxOriginalTitle, $auxOriginalTitle.htmlspecialchars($listingtemplate_title2), $listingtemplate_title);
                        ?>
                        <?=$listingtemplate_title?>
                    </h3>
    
                    <? if ($listingtemplate_complementaryinfo) { ?>
                        <p <?=($listing["id"] ? "id=\"showCategory_".$listing["id"]."\"" : "")?>><?=$listingtemplate_complementaryinfo?></p>
                    <? } ?>
    
                </div>
                
                <? if ($listingtemplate_description) { ?>
                    <p><?=$listingtemplate_description?></p>
                <? } ?>
                    
                 <? if ($listingtemplate_complementaryinfo2) { ?>
                    <p><strong><?=$listingtemplate_complementaryinfo2?></strong></p>
                <? } ?>  
                
			</div> 

		</div>

	</div>

	<? unset($aux); ?>