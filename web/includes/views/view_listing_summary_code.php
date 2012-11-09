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
	# * FILE: /includes/views/view_listing_summary_code.php
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

		<div class="share">
			<?=$listingtemplate_icon_navbar?>
		</div>

		<div class="left">

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

					<?=$listingtemplate_title?>
				</h3>

				<? if ($listingtemplate_complementaryinfo) { ?>
                    <p <?=($listing["id"] ? "id=\"showCategory_".$listing["id"]."\"" : "")?>><?=$listingtemplate_complementaryinfo?></p>
				<? } ?>

			</div>
            
            <?  if ($listingtemplate_image) { ?>

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
                
            <?  if ($listingtemplate_image) { ?> 
                
            </div>
            
            <? } ?>

			<? if ($listingtemplate_description) { ?>
				<p><?=$listingtemplate_description?></p>
			<? } ?>

			<?=$listingtemplate_designations?>

		</div>

		<div class="right">

			<div class="deal <?=(($listing_deal) ? ("") : ("empty"))?>">
                <?=$listing_deal ? $listing_deal : ""?>
			</div>

			<div class="info">

				<? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "<address>\n"; ?>

				<? if ($listingtemplate_address) { ?>
					<span><?=$listingtemplate_address?></span>
				<? } ?>

				<? if ($listingtemplate_address2) { ?>
					<span><?=$listingtemplate_address2?></span>
				<? } ?>

				<? if ($listingtemplate_location) { ?>
					<span><?=$listingtemplate_location?></span>
				<? } ?>

				<? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "\n</address>\n"; ?>

				<? if ($listingtemplate_phone) { ?>
					<p><strong><?=system_showText(LANG_LISTING_LETTERPHONE)?>: </strong><?=$listingtemplate_phone?></p>
				<? } ?>

				<? if ($listingtemplate_fax) { ?>
					<p><strong><?=system_showText(LANG_LISTING_LETTERFAX)?>: </strong><?=$listingtemplate_fax?></p>
				<? } ?>

				<? if ($listingtemplate_url) { ?>
					<p><strong><?=system_showText(LANG_LISTING_LETTERWEBSITE)?>: </strong><?=$listingtemplate_url?></p>
				<? } ?>

				<? if ($listingtemplate_email) { ?>
					<p><strong><?=system_showText(LANG_LISTING_LETTEREMAIL)?>: </strong><?=$listingtemplate_email?></p>
				<? } ?>
					
				<? if($listingtemplate_twilioSMS){ ?>
					<p class="button-send"><a href="<?=$listingtemplate_twilioSMS?>" <?=$twilioSMS_style?>><?=system_showText(LANG_LABEL_SENDPHONE);?></a></p>
				<? } ?> 
                    
				<? if($listingtemplate_twilioCall){ ?>	
					<p class="button-call"><a href="<?=$listingtemplate_twilioCall?>" <?=$twilioCall_style?>><?=system_showText(LANG_LABEL_CLICKTOCALL);?></a></p>
				<? } ?>
					
				<? if ($listingtemplate_claim) { ?>
					<p class="claim">
						<?=$listingtemplate_claim?>
					</p>
				<? } ?>

			</div>

		</div>

	</div>

	<? unset($aux); ?>