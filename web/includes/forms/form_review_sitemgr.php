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
	# * FILE: /includes/forms/form_review_sitemgr.php
	# ----------------------------------------------------------------------------------------------------
   
?>

<p class="errorMessage"  style="display:none" id="errorMessageReview"></p>

<? if ($message_review) { ?><p class="errorMessage"><?=$message_review?></p><? } ?> 
<input type="hidden" name="rating_<?=$each_rate->getNumber('id');?>" id="rating_<?=$each_rate->getNumber('id');?>" value="" />
<input type="hidden" name="item_id" value="<?=$each_rate->getNumber('item_id');?>" />
<input type="hidden" name="item_type" value="<?=$each_rate->getNumber('item_type');?>" />
<input type="hidden" name="idReview" value="<?=$each_rate->getNumber('id');?>" />
<? if ($filter_id) { ?>
<input type="hidden" name="filter_id" value="1" />
<? } ?>
<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
	<thead>
	<tr>
		<th colspan="2" class="title"><?=system_showText(LANG_SITEMGR_REVIEW_REVIEWINFORMATION)?></th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td id="star_<?=$each_rate->getNumber('id');?>" align="center" colspan="2" class="rateReviewStars">
			<? 
			###### Keep the IMG's tags together ! #######
            $img_id = "star_".$each_rate->getNumber('id')."";
            $rating_id = "rating_".$each_rate->getNumber('id').""; 
			?>
			<strong><?=system_showText(LANG_SITEMGR_REVIEW_RATEIT)?>:</strong>
			    <img align="absmiddle" border="0" src="<?=DEFAULT_URL?>/images/content/img_rate_star_off.gif" onclick="setRatingLevel(1, '<?=$rating_id?>', '<?=$img_id?>')" onmouseover="setDisplayRatingLevel(1, '<?=$img_id?>')" alt="star" /><img align="absmiddle" border="0" src="<?=DEFAULT_URL?>/images/content/img_rate_star_off.gif" onclick="setRatingLevel(2, '<?=$rating_id?>', '<?=$img_id?>')" onmouseover="setDisplayRatingLevel(2, '<?=$img_id?>')" alt="star" /><img align="absmiddle" border="0" src="<?=DEFAULT_URL?>/images/content/img_rate_star_off.gif" onclick="setRatingLevel(3, '<?=$rating_id?>', '<?=$img_id?>')" onmouseover="setDisplayRatingLevel(3, '<?=$img_id?>')" alt="star" /><img align="absmiddle" border="0" src="<?=DEFAULT_URL?>/images/content/img_rate_star_off.gif" onclick="setRatingLevel(4, '<?=$rating_id?>', '<?=$img_id?>')" onmouseover="setDisplayRatingLevel(4, '<?=$img_id?>')" alt="star" /><img align="absmiddle" border="0" src="<?=DEFAULT_URL?>/images/content/img_rate_star_off.gif" onclick="setRatingLevel(5, '<?=$rating_id?>', '<?=$img_id?>')" onmouseover="setDisplayRatingLevel(5, '<?=$img_id?>')" alt="star" />
			
		</td>
	</tr>
	<tr>
		<th class="reviewTh"><?=system_showText(LANG_SITEMGR_LABEL_NAME)?>:</th>
		<td class="alignTop"><input type="text" name="reviewer_name" id="reviewer_name<?=$each_rate->getNumber('id');?>" value="<?=$each_rate->getString("reviewer_name")?>" maxlength="50" class="input-form-rate" /></td>
	</tr>
	<tr>
		<th class="reviewTh"><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
		<td class="alignTop"><input type="text" name="reviewer_email" id="reviewer_email<?=$each_rate->getNumber('id');?>" value="<?=$each_rate->getString("reviewer_email")?>" maxlength="100" class="input-form-rate" /></td>
	</tr>
	<tr>
		<th class="reviewTh"><?=system_showText(LANG_SITEMGR_LABEL_CITY_STATE)?>:</th>
		<td class="alignTop"><input type="text" name="reviewer_location" id="reviewer_location<?=$each_rate->getNumber('id');?>" value="<?=html_entity_decode($each_rate->getString("reviewer_location"));?>" maxlength="50" class="input-form-rate" /></td>
	</tr>
	<tr>
		<th class="reviewTh"><?=system_showText(LANG_SITEMGR_TITLE)?>:</th>
		<td class="alignTop"><input type="text" name="review_title" id="review_title<?=$each_rate->getNumber('id');?>" value="<?=html_entity_decode($each_rate->getString("review_title"));?>" maxlength="50" class="input-form-rate" /></td>
	</tr>
	<tr>
		<th class="reviewTh"><?=system_showText(LANG_SITEMGR_LABEL_COMMENT)?>:</th>
		<td class="alignTop"><textarea name="review" id="review<?=$each_rate->getNumber('id');?>" class="input-textarea-form-rate" rows="5"><?=html_entity_decode($each_rate->getString("review"));?></textarea></td>
	</tr>
	</tbody>
</table>

<script type="text/javascript">
    function setDisplayRatingLevel(level, star_id) {
            $('img:lt('+level+')', '#'+star_id).attr('src', '<?=DEFAULT_URL?>/images/content/img_rate_star_on.gif');
            $('img:gt('+(level-1)+')', '#'+star_id).attr('src', '<?=DEFAULT_URL?>/images/content/img_rate_star_off.gif');
    }

    function resetRatingLevel(level, star_id) {
      setDisplayRatingLevel(level, star_id);
    }

    function setRatingLevel(level, rating_id, star_id) {
        $('#'+rating_id).val(level);
        $('img:lt('+level+')', '#'+star_id).attr('src', '<?=DEFAULT_URL?>/images/content/img_rate_star_on.gif');
        $('img:gt('+(level-1)+')', '#'+star_id).attr('src', '<?=DEFAULT_URL?>/images/content/img_rate_star_off.gif');

        $('#'+star_id).one('click', function() {
            $("#"+star_id).addClass("clicked");
        });
        
    }
</script>

<script type="text/javascript">
    setDisplayRatingLevel(<?=$each_rate->getString("rating")?>, 'star_<?=$each_rate->getNumber('id');?>');
        
    $('#star_<?=$each_rate->getNumber('id');?>').bind("mouseleave",function() { 
        
        if(!$(this).hasClass('clicked')) {
    
            setDisplayRatingLevel(<?=$each_rate->getString("rating")?>, 'star_<?=$each_rate->getNumber('id');?>');
        
        }
        
        if($(this).hasClass('clicked')) {

            $(this).removeClass("clicked");
        
        }
        
    });
        
</script>

