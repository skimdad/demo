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
	# * FILE: /includes/forms/form_review.php
	# ----------------------------------------------------------------------------------------------------
    
    setting_get("review_manditory", $review_manditory);
	?>

	<div class="rate">
		<h3><?=system_showText(LANG_REVIEWRATEIT)?></h3>
		<?
		if($rating_stars == "") { ?>
			<img style="cursor:pointer" src="<?=DEFAULT_URL?>/images/content/img_rate_star_off.gif" alt="star" onclick="setRatingLevel(1)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(1)" name="star1" />
			<img style="cursor:pointer" src="<?=DEFAULT_URL?>/images/content/img_rate_star_off.gif" alt="star" onclick="setRatingLevel(2)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(2)" name="star2" />
			<img style="cursor:pointer" src="<?=DEFAULT_URL?>/images/content/img_rate_star_off.gif" alt="star" onclick="setRatingLevel(3)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(3)" name="star3" />
			<img style="cursor:pointer" src="<?=DEFAULT_URL?>/images/content/img_rate_star_off.gif" alt="star" onclick="setRatingLevel(4)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(4)" name="star4" />
			<img style="cursor:pointer" src="<?=DEFAULT_URL?>/images/content/img_rate_star_off.gif" alt="star" onclick="setRatingLevel(5)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(5)" name="star5" />
		<? } else {
			echo $rating_stars;
		}
		?>
	</div>

	<input type="hidden" name="rating" id="rating" value="<?=$rating?>" />
	<input type="hidden" id="member_id" name="member_id" value="<?=sess_getAccountIdFromSession()?>" />
	
	<div class="left">
	
		<div>
			<label><?=$review_manditory? "* " : ""?><?=system_showText(LANG_LABEL_NAME)?>:</label>
			<input class="text" type="text" name="reviewer_name" id="reviewer_name" value="<?=(sess_getAccountIdFromSession() && SOCIALNETWORK_FEATURE == "on" && $reviewerAcc->getString("has_profile") == "y") ? ($reviewerProfile->getString("nickname")) : ($reviewer_name)?>" maxlength="50" tabindex="1" <?=(sess_getAccountIdFromSession() && SOCIALNETWORK_FEATURE == "on" && $reviewerAcc->getString("has_profile") == "y") ? "readonly=\"readonly\"" : ""?>/>
		</div>
		<div>
			<label>* <?=system_showText(LANG_LABEL_COMMENTTITLE);?>:</label>
			<input class="text" type="text" name="review_title" id="review_title" value="<?=$review_title?>" maxlength="50" tabindex="2" />
		</div>
		<div>
			<label><?=$review_manditory? "* " : ""?><?=system_showText(LANG_LABEL_EMAIL)?>:</label>
			<input class="text" type="text" name="reviewer_email" id="reviewer_email" value="<?=(sess_getAccountIdFromSession() && SOCIALNETWORK_FEATURE == "on" && $reviewerAcc->getString("has_profile") == "y") ? ($reviewerInfo->getString("email")) : ($reviewer_email)?>" maxlength="100" tabindex="3" />
		</div>
		<div>
			<label>* <?=system_showText(LANG_LABEL_CITY)?>, <?=system_showText(LANG_LABEL_STATE)?>:</label>
			<?
			if (sess_getAccountIdFromSession() && !$reviewer_location) {
				unset($rLoc);
				if ($reviewerInfo->getString("city")) $rLoc[] = $reviewerInfo->getString("city");
				if ($reviewerInfo->getString("state")) $rLoc[] = $reviewerInfo->getString("state");
				
				if (is_array($rLoc) && $rLoc[0]) $reviewer_location = implode(", ", $rLoc);
			}
			?>
			<input class="text" type="text" name="reviewer_location" id="reviewer_location" value="<?=$reviewer_location;?>" maxlength="50" tabindex="4" />
		</div>
		
	</div>
	
	<div class="right">
	
		<div>
			<label>* <?=system_showText(LANG_LABEL_COMMENT)?>:</label>
			<textarea class="textarea" name="review" id="review" rows="9" tabindex="5"><?=$review?></textarea>
		</div>
		
	</div>
	
	<div class="action">
	
		<p><?=system_showText(LANG_CAPTCHA_HELP)?></p>
		<div class="captcha">
			<div>
				<img src="<?=DEFAULT_URL?>/includes/code/captcha.php" border="0" alt="<?=system_showText(LANG_CAPTCHA_ALT)?>" title="<?=system_showText(LANG_CAPTCHA_TITLE)?>" />
				<input type="text" value="" name="captchatext" class="text">
			</div>
		</div>
		<button type="submit" name="submit" value="Submit"><?=system_showText(LANG_BUTTON_SEND)?></button>
	
	</div>