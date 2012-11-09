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
	# * FILE: /layout/footer.php
	# ----------------------------------------------------------------------------------------------------

	/*
	 * Links to facebook and linkedin
	 */
	setting_get("setting_linkedin_link", $setting_linkedin_link);
	setting_get("setting_facebook_link", $setting_facebook_link);
	
?>
	
		</div>
		<?
		$objCache = new cache("footer");
		if ($objCache->caching) {
		?>
		<div id="footer-wrapper">

			<div id="footer">

				<div class="left">
					<h3>
						<span><?=system_showText(LANG_FOOTER_CONTACT)?></span>
						<?
						if($setting_linkedin_link){
							?>
							<a class="link linkedin" href="<?=$setting_linkedin_link?>" target="_blank" title="<?=system_showText(LANG_ALT_LINKEDIN)?>">Linked In</a>
							<?
						}
						if($setting_facebook_link){
							?>
							<a class="link facebook" href="<?=$setting_facebook_link?>" target="_blank" title="<?=system_showText(LANG_ALT_FACEBOOK)?>">Facebook</a>
							<?
						}
						?>
					</h3>
					<ul class="navbar-footer">
						<?   
						$navbarType = "footer";
						$filterArea = 1;
						include(INCLUDES_DIR."/code/navbar.php"); 
						?>
					</ul>
				</div>
				
				<div class="left">
					<h3><?=system_showText(LANG_LINKS)?></h3>
					<ul class="navbar-footer">
						<?   
						$filterArea = 2;
						include(INCLUDES_DIR."/code/navbar.php"); 
						?>
					</ul>
				</div>
				
				<?
				$twitterObj = new Twitter();
				if($twitterObj->getRandonAccount()){
					?>

					<div class="left">
						<div class="last-tweets">
							<h3>
								<span><?=system_showText(LANG_TWITTER)?></span>
								<? if ($twitterObj->account) { ?>
								<a class="follow twitter" href="http://www.twitter.com/<?=$twitterObj->account;?>" target="_blank" title="<?=system_showText(LANG_FOLLOW_US_TWITTER)?>"><?=system_showText(LANG_FOLLOW_US)?> +</a>
								<? } ?>
							</h3>

							<?
							$tweetInfo = $twitterObj->userInfo();
							if ($tweetInfo["protected"] != "true") {
							?>
								<ul id="twitter_update_list_footer">
									<li id="twitter_loading_footer" class="loading"></li>
								</ul>
							<?}?>
						</div>
					</div>
					<?
				}
				?>
                
				<div class="right">
					<?
						customtext_get("footer_copyright", $footer_copyright, EDIR_LANGUAGE);
						if (!$footer_copyright) {
							$footer = "Copyright &copy; ".date("Y")." iConnectedMarketing.com. <br />All Rights Reserved.";
						} else {
							$footer = $footer_copyright;
						}
					?>
					
					<? if (BRANDED_PRINT == "on") { ?>
						<h5 class="powered-by">Powered by <a href="http://www.iConnectedMarketing.com" target="_blank">iConnectedMarketing.com</a>.</h5>
					<? } ?>
					<p class="copyright">
						<?=$footer?>
					</p>
					<? 
						$w3cCSSURL = "http://jigsaw.w3.org/css-validator/check/referer"; 
						$w3cXHTMLURL = "http://validator.w3.org/check/referer"; 
					?>
                    <?/*
					<p class="w3c">
						W3C 
						<a href="<?=$w3cCSSURL;?>" target="_blank">CSS</a> / 
						<a href="<?=$w3cXHTMLURL;?>" target="_blank">XHTML</a>
					</p>
                    */?>
				</div>
                
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