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
	# * FILE: /theme/realestate/layout/footer.php
	# ----------------------------------------------------------------------------------------------------
	
    //Links to twitter, facebook and linkedin
    setting_get("twitter_account", $setting_twitter_link);
	setting_get("setting_facebook_link", $setting_facebook_link);
    setting_get("setting_linkedin_link", $setting_linkedin_link);
    
    //Copyright Info
    customtext_get("footer_copyright", $footer_copyright, EDIR_LANGUAGE);
    if (!$footer_copyright) {
        $footer = "Copyright &copy; ".date("Y")." Arca Solutions, Inc. All Rights Reserved.";
    } else {
        $footer = $footer_copyright;
    }
?>
	
		</div>
		<?
		$objCache = new cache("footer");
		if ($objCache->caching) {
		?>
		<div id="footer-wrapper">

			<div id="footer">
                <? if ($setting_twitter_link || $setting_facebook_link || $setting_linkedin_link) { ?>
            	<div class="social-buttons">
                    
                    <? if ($setting_twitter_link) { ?>
                        <a href="http://www.twitter.com/<?=$setting_twitter_link?>" target="_blank" title="<?=system_showText(LANG_FOLLOW_US_TWITTER)?>">
                            <img src="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME?>/images/iconography/icon-share-twitter.png" alt="" />
                        </a>
                    <? } ?>
                    
                    <? if ($setting_facebook_link) { ?>
                        <a href="<?=$setting_facebook_link?>" target="_blank" title="<?=system_showText(LANG_ALT_FACEBOOK)?>">
                            <img src="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME?>/images/iconography/icon-share-facebook.png" alt="" />
                        </a>
                    <? } ?>
                    
                    <? if ($setting_linkedin_link) { ?>
                        <a href="<?=$setting_linkedin_link?>" target="_blank" title="<?=system_showText(LANG_ALT_LINKEDIN)?>">
                            <img src="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME?>/images/iconography/icon-share-linkedin.png" alt="" />
                        </a>
                    <? } ?>
                    
                </div>
                <? } ?>
                
                <? if (BRANDED_PRINT == "on") { ?>
                    <h5 class="powered-by">Powered by <a href="http://www.edirectory.com" target="_blank">eDirectory&trade;</a>.</h5>
                <? } ?>
                <p class="copyright">
                    <?=$footer?>
                </p>
                
                <p class="site-url"><?=DEFAULT_URL?></p>
            </div>
                
		</div>
		<?
		}
		$objCache->close();
		?>
        <?php include(INCLUDES_DIR."/code/statisticreport.php"); ?>

		<?php
            /* googlemap */
            if (string_strpos($_SERVER["PHP_SELF"], 'results.php') !== false) {

                if($itemRSSSection == 'listing') {
					$searchResults = $listings;
					$item_type = "listing";
				}
                if($itemRSSSection == 'classified') {
					$searchResults = $classifieds;
					$item_type = "classified";
				}
                if($itemRSSSection == 'event') {
					$searchResults = $events;
					$item_type = "event";
				}

                if($promotions) {
                    
                    $searchResults = array();
                    $promotionTitle[] = array();
                    if ($promotions) {
						$listingObj = new Listing();
                        foreach($promotions as $promotion){
							$listings = $listingObj->retrieveListingsbyPromotion_id($promotion->getNumber("id"));
                            foreach($listings as $listing){
                                $searchResults[] = $listing;
                                $promotionTitle[$listing->getNumber('id')] = $promotion->getString('name', true);
                            }
                        }
						$item_type = "promotion";
                    }
                }

                $mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS);
                if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") {
                    include(INCLUDES_DIR.'/views/view_resultsmap.php');
                }
            }
        ?>

		<?
		// GOOGLE ANALYTICS FEATURE
		if (!DEMO_DEV_MODE && (GOOGLE_ANALYTICS_ENABLED == "on")) {
			$google_analytics_page = "front";
			include(INCLUDES_DIR."/code/google_analytics.php");
		}
		?>

		<?
		include(EDIRECTORY_ROOT."/includes/code/script_loader.php");
		?>
	</body>
</html>