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
	# * FILE: /listing/detail_reviews.php
	# ----------------------------------------------------------------------------------------------------

	if (!$listingMsg && !$hideDetail && $review_enabled == "on" && $commenting_edir && $levelReview){
		
		if ($tPreview || !$user) {
			$reviewsLink = "javascript:void(0);";
			$linkReviewFormPopup = "javascript:void(0);";
			$linkStyle = "style=\"cursor:default;\"";
		}
?>
	<h2>
		<span><?=system_showText(LANG_REVIEW_PLURAL)?></span>
		<? if ($review_amount > $numberOfReviews){ ?>
		<a class="view-more" href="<?=$reviewsLink?>" <?=$linkStyle?>><?=system_showText(LANG_LABEL_VIEW_ALL2)?></a>
		<span class="split">|</span>
		<? } ?>
		<a class="view-more <?=!$tPreview? $class : "";?> rate-it" href="<?=$linkReviewFormPopup?>" <?=$linkStyle?>>
			<? if($review_amount > 0){ 
				echo system_showText(LANG_REVIEWRATEIT);
			} ?>
		</a>
	</h2>

	<div class="featured featured-review">
		<? if($review_amount == 0){ ?>
			<a class="<?=!$tPreview? $class : "";?> rate-it-first" href="<?=$linkReviewFormPopup?>" <?=$linkStyle?>><?=system_showText(LANG_REVIEWBETHEFIRST);?></a>
		<? }else{
			echo $listingtemplate_review;
		} ?>
	</div>

<? } ?>

	<? setting_get("commenting_fb", $commenting_fb);?>
	
	<? 
	if (!$listingMsg && !$hideDetail && $commenting_fb && ($user || $tPreview)){ ?>
		<h2>
			<span><?=system_showText(LANG_LABEL_COMMENTS)?></span>
		</h2>
        
		<?
		if ($user) {

			$detailLink = NON_LANG_URL."/".LISTING_FEATURE_FOLDER."/facebook_comment.php?id=".$listing->getNumber("id");

			setting_get("commenting_fb_number_comments", $commenting_fb_number_comments);

			?>

			<script language="javascript" type="text/javascript">
				//<![CDATA[
				(function(d){
				  var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
				  js = d.createElement('script'); js.id = id; js.async = true;
				  js.src = "//connect.facebook.net/<?=EDIR_LANGUAGEFACEBOOK?>/all.js#xfbml=1";
				  d.getElementsByTagName('head')[0].appendChild(js);
				}(document));

				document.write('<div class="fb-comments" data-href="<?=$detailLink?>" data-num-posts="<?=$commenting_fb_number_comments?>" data-width="<?=FB_COMMENTWIDTH_LISTING?>"></div>');
				//]]>
			</script>
	
		<? } else { ?>
			<img src="<?=THEMEFILE_URL."/".EDIR_THEME."/schemes/".EDIR_SCHEME."/images/structure/facebook-comment-sample.png"?>" alt="Sample" />
		<? }
	} ?>