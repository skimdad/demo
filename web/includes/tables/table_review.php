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
	# * FILE: /includes/tables/table_review.php
	# ---------------------------------------------------------------------------------------------------

?>
    <? if (is_numeric($message) && isset($msg_review[$message])) { ?>
        <p class="<?=($class == '' ? 'successMessage' : $class);?>"><?=$msg_review[$message]?></p>
	<? 
		
	} ?>

	<table border="1" cellpadding="2" cellspacing="2" align="center" class="standard-tableTOPBLUE">
		<tr>
			<th style="width: 55px;"><?=system_showText(LANG_LABEL_TYPE);?></th>
			<th style="width: 220px;"><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th style="width: 145px;"><?=system_showText(LANG_LABEL_ADDED);?></th>
			<th style="width: 65px;"><?=string_ucwords(system_showText(LANG_LABEL_RATING));?></th>
			<th style="width: 95px;"><?=string_ucwords(system_showText(LANG_LABEL_EVALUATOR));?></th>
			<th style="width: 45px;"><?=string_ucwords(system_showText(LANG_LABEL_STATUS));?></th>
			<? if (string_strpos($url_base, "/sitemgr")) { ?>
                <th style="width: 80px;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
            <? } else { ?>
                <th style="width: 45px;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
            <? } ?>
		</tr>

		<? $url_aux = (string_strpos($url_base, "/sitemgr")) ? "sitemgr" : "members"; ?>

		<? if ($reviewsArr) foreach($reviewsArr as $each_rate) { ?>

			<?
			
            $rate = $each_rate->getNumber('rating');
    
            $info = array();
			$item_type = $each_rate->getString('item_type');
			$item_id = $each_rate->getNumber("item_id");
			if ($item_type == 'listing') $itemObj = new Listing($item_id); else if ($item_type == 'article') $itemObj = new Article($item_id); else if ($item_type == 'promotion') $itemObj = new Promotion($item_id);
			
            $info["review"] = addslashes($each_rate->getString("review", true));
			if ($item_type != 'promotion'){
				$info["item_title"] = addslashes($itemObj->getString("title" , true));
			} else {
				$info["item_title"] = addslashes($itemObj->getString("name" , true));
			}
            $info["item_title"] = htmlspecialchars($info["item_title"]);
            if (string_strlen($each_rate->getString("response")) > 0) $info["response"] = addslashes($each_rate->getString("response", true));
			// review is a text field type so search for \r \n to not mess javascript
			$info["review"] = str_replace("\r\n", "<br />", $info["review"]);
			$info["review"] = str_replace("\r", "<br />", $info["review"]);
			$info["review"] = str_replace("\n", "<br />", $info["review"]);
			// if review size > 200, get only first 200 chars and put "..."
			$info["review"] = system_showTruncatedText($info["review"], 200);
            
            // response is a text field type so search for \r \n to not mess javascript
            if ($info["response"]) { 
                $info["response"] = str_replace("\r\n", "<br />", $info["response"]);
                $info["response"] = str_replace("\r", "<br />", $info["response"]);
                $info["response"] = str_replace("\n", "<br />", $info["response"]);
                // if response size > 200, get only first 200 chars and put "..."
                $info["response"] = system_showTruncatedText($info["response"], 200);
            }
			?>

			<tr>
				<td><?=ucfirst(@constant('LANG_'.string_strtoupper($each_rate->getString("item_type"))))?></td>
				<td>
				
					<?
					if ($each_rate->getString("review_title")) {
						$review_title = $each_rate->getString("review_title", true, 25);
					} else {
						$review_title = system_showText(LANG_NA);
					}
					?>
					<span class="link-table" style="cursor: help; vertical-align: middle;" OnMouseMove="enablePopupLayer('review','<?=$info["review"]?>','<?=$info["item_title"]?>','<?=(($info["response"]) ? $info["response"] : '' )?>')" OnMouseOut="disablePopupLayer()"><img src="<?=DEFAULT_URL?>/images/icon_eye.gif" border="0" OnMouseMove="enablePopupLayer('<?=$info["review"]?>','<?=$info["item_title"]?>','<?=(($info["response"]) ? $info["response"] : '' )?>')" OnMouseOut="disablePopupLayer()" /></span>
					<a href="<?=DEFAULT_URL?>/<?=$url_aux?>/review/view.php?item_id=<?=$each_rate->getString("item_id")?>&item_type=<?=$each_rate->getString("item_type")?><?=($filter_id ? "&filter_id=1" : '')?>&id=<?=$each_rate->getString("id")?>&screen=<?=$screen?>&letter=<?=$letter?>&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>" class="link-table"><?=$review_title?></a>
				</td>
				<td><?=($each_rate->getString("added")) ? format_date($each_rate->getString("added"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($each_rate->getNumber("added")) : system_showText(LANG_NA);?></td>
				<td><?=($each_rate->getString("rating")) ? $each_rate->getString("rating", true) : system_showText(LANG_NA);?></td>
				<td>
					<?
					if ($each_rate->getString("reviewer_name")) {
						$reviewer_name = $each_rate->getString("reviewer_name", true, 25);
					} else {
						$reviewer_name = system_showText(LANG_NA);
					}
					?>
					<?=$reviewer_name?>
				</td>
                
                <?
                /**
                 * Reviews Status 
                 */
                ?>
                <td style="padding-left:15px">
                
                <? if (string_strpos($url_base, "/sitemgr") && ($each_rate->getNumber("approved") == 0 || (string_strlen(trim($each_rate->getString("response"))) > 0 && $each_rate->getNumber("responseapproved") == 0))) { ?> <a href='javascript:void(0);' onclick='showStatusField(<?=$each_rate->getNumber('id');?>);'> <? } ?>
                    <?
                    if ($each_rate->getNumber("approved") == 0) {
                        
                        if (string_strlen(trim($each_rate->getNumber("response"))) > 0) {
                            if ($each_rate->getNumber("responseapproved") == 0) {
                                ?>
                                <img src="<?=DEFAULT_URL?>/images/bt_review_reply_pending.gif" border="0" alt="<?=system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW_REPLY);?>" title="<?=system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW_REPLY);?>" />
                                <?
                            }
                        } else {
                            ?>
                            <img src="<?=DEFAULT_URL?>/images/bt_review_pending.gif" border="0" alt="<?=system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW);?>" title="<?=system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW);?>" />
                            <?
                        }
                    
                    } elseif ($each_rate->getNumber("approved") == 1) {
                        
                            if (string_strlen(trim($each_rate->getNumber("response"))) == 0) {
                                ?>
                                <img src="<?=DEFAULT_URL?>/images/bt_review_approved.gif" border="0" alt="<?=system_showText(LANG_MSG_REVIEW_ALREADY_APPROVED);?>" title="<?=system_showText(LANG_MSG_REVIEW_ALREADY_APPROVED);?>" />
                                <?
                            } elseif (string_strlen($each_rate->getNumber("response")) > 0) {
                                 
                                if ($each_rate->getNumber("responseapproved") == 0) {
                                    ?>
                                    <img src="<?=DEFAULT_URL?>/images/bt_reply_pending.gif" border="0" alt="<?=system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY);?>" title="<?=system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY);?>" />
                                    <?
                                } else {
                                    ?>
                                    <img src="<?=DEFAULT_URL?>/images/bt_reply_approved.gif" border="0" alt="<?=system_showText(LANG_MSG_REVIEWANDREPLY_ALREADY_APPROVED);?>" title="<?=system_showText(LANG_MSG_REVIEWANDREPLY_ALREADY_APPROVED);?>" />
                                    <?    
                                }
                            }
                    
                    } 
                    ?>
                <? if (string_strpos($url_base, "/sitemgr") && ($each_rate->getNumber("approved") == 0 || (string_strlen(trim($each_rate->getString("response"))) > 0 && $each_rate->getNumber("responseapproved") == 0))) { ?> </a> <? } ?>      
                    
                </td>
				<td>

					<a href="<?=DEFAULT_URL?>/<?=$url_aux?>/review/view.php?item_id=<?=$each_rate->getString("item_id")?>&item_type=<?=$each_rate->getString("item_type")?><?=($filter_id ? "&filter_id=1" : '')?>&id=<?=$each_rate->getString("id")?>&screen=<?=$screen?>&letter=<?=$letter?>&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW)?>" />
					</a>
                    
                    <? if (string_strpos($url_base, "/members")) { ?>
                    
                            <a href='javascript:void(0);' onclick='showReplyField(<?=$each_rate->getNumber('id');?>);'><img src="<?=DEFAULT_URL?>/images/bt_reply.gif" border="0" alt="<?=system_showText(LANG_MSG_REVIEW_REPLY);?>" title="<?=system_showText(LANG_MSG_REVIEW_REPLY);?>" /></a>
                        
                    <? } ?>
                    
					<? if (string_strpos($url_base, "/sitemgr")) { ?>
                    
                        <a href='javascript:void(0);' onclick='showReviewField(<?=$each_rate->getNumber('id');?>);'>	
                            <img src="<?=DEFAULT_URL?>/images/bt_edit_review.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW)?>" />
						</a>
                        
                        <? if (string_strlen(trim($each_rate->getstring("response"))) > 0) { ?>
                            <a href='javascript:void(0);' onclick='showReplyField(<?=$each_rate->getNumber('id');?>);'>
                                <img src="<?=DEFAULT_URL?>/images/bt_edit_reply.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_REPLY)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_REPLY)?>" />
                            </a>
                        <? } else { ?>
                            <img src="<?=DEFAULT_URL?>/images/bt_edit_reply_off.gif" border="0" />    
                        <? } ?>

						<a href="<?=DEFAULT_URL?>/sitemgr/review/delete.php?item_id=<?=$each_rate->getString("item_id")?>&item_type=<?=$each_rate->getString("item_type")?><?=($filter_id ? "&filter_id=1" : '')?>&id=<?=$each_rate->getString("id")?>&screen=<?=$screen?>&letter=<?=$letter?>&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW)?>" title="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW)?>" />
						</a>
                        
					<? } ?>

				</td>
			</tr>
            
            <? if (string_strpos($url_base, "/sitemgr")) {
                // Review Edit Form ?>
                <tr id="ReviewTR<?=$each_rate->getNumber('id');?>" class="hideForm" style="display:none">
                    <td colspan="7" id="ReviewTD<?=$each_rate->getNumber('id');?>" class="innerTable">
                        <form name="formReview" action="review.php">
                            <?
                            include(INCLUDES_DIR."/forms/form_review_sitemgr.php"); 
                            ?>
                            <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto 0 auto;" align="center">
                                <tr>
                                    <td>
                                        <button type="submit" name="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                                        <button type="reset"  name="cancel" value="Cancel" class="input-button-form" onclick="hideReviewField(<?=$each_rate->getNumber('id');?>);"><?=system_showText(LANG_BUTTON_CANCEL);?></button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
            <? } ?>
            
            
            <?// Reply Edit Form ?>
            <tr id="replyReviewTR<?=$each_rate->getNumber('id');?>" class="hideForm" style="display:none">
                <td colspan="7" id="replyReviewTD<?=$each_rate->getNumber('id');?>" class="innerTable">
                    <form name="formReply" action="reply.php">
                        <p class="errorMessage"  style="display:none" id="errorMessageReply"></p>
                        <input type="hidden" name="item_id" value="<?=$each_rate->getNumber('item_id');?>" />
                        <input type="hidden" name="item_type" value="<?=$each_rate->getNumber('item_type');?>" />
                        <input type="hidden" name="idReview" value="<?=$each_rate->getNumber('id');?>" />
						<? if ($filter_id) { ?>
						<input type="hidden" name="filter_id" value="1" />
						<? } ?>
                        <input type="hidden" name="screen" value="<?=$_GET['screen']?>" /> 
                        <input type="hidden" name="letter" value="<?=$_GET['letter']?>" />
                        <p class="title">Re: <?=$review_title;?></p>
                        <p class="centerField"><textarea name="reply" id="reply<?=$each_rate->getNumber('id');?>" rows="5"><?=$each_rate->getString('response');?></textarea></p>
                        <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto 0 auto;" align="center">
                                <tr>
                                    <td>
                                        <button type="submit" name="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_BUTTON_SEND);?></button>
                                        <button type="reset"  name="cancel" value="Cancel" class="input-button-form" onclick="hideReplyField(<?=$each_rate->getNumber('id');?>);"><?=system_showText(LANG_BUTTON_CANCEL);?></button>
                                    </td>
                                </tr>
                        </table>
                    </form>
                </td>
            </tr>
            
            <? if (string_strpos($url_base, "/sitemgr")) {
                // Status Edit Form ?>
                <tr id="statusTR<?=$each_rate->getNumber('id');?>" class="hideForm" style="display:none">
                    <td colspan="7" id="statusTD<?=$each_rate->getNumber('id');?>" class="innerTable">
                        <form name="formStatus" action="status.php">
                            <p class="informationMessage"  style="display:none" id="informationMessageStatus"><?=system_showText(LANG_STATUS_EMPTY);?></p>
                            <input type="hidden" name="item_id" value="<?=$each_rate->getNumber('item_id');?>" />
                            <input type="hidden" name="item_type" value="<?=$each_rate->getNumber('item_type');?>" />
                            <input type="hidden" name="idReview" value="<?=$each_rate->getNumber('id');?>" />
                            <input type="hidden" name="domain_id" value="<?=SELECTED_DOMAIN_ID;?>" />
                            <? if ($filter_id) { ?>
                            <input type="hidden" name="filter_id" value="1" />
                            <? } ?>
                            <input type="hidden" name="screen" value="<?=$_GET['screen']?>" /> 
                            <input type="hidden" name="letter" value="<?=$_GET['letter']?>" />
                            <p class="title"><?=$review_title;?></p><br />
                            <?if ($each_rate->getNumber("approved") == 0) {?>
                                <input type="radio" name="status" value="review" id="approve_review<?=$each_rate->getNumber('id');?>">&nbsp;<?=system_showText(LANG_SITEMGR_APPROVE_REVIEW)?></input><br />
                            <? } ?>
                            <?if (string_strlen(trim($each_rate->getString("response"))) > 0 && $each_rate->getNumber("responseapproved") == 0 && $each_rate->getNumber("approved") == 1) {?>
                            <input type="radio" name="status" value="reply" id="approve_reply<?=$each_rate->getNumber('id');?>">&nbsp;<?=system_showText(LANG_SITEMGR_APPROVE_REPLY)?></input><br />
                            <? } ?>
                            <?if (string_strlen(trim($each_rate->getString("response"))) > 0 && $each_rate->getNumber("responseapproved") == 0 && $each_rate->getNumber("approved") == 0) {?>
                            <input type="radio" name="status" value="both" id="approve_both<?=$each_rate->getNumber('id');?>">&nbsp;<?=system_showText(LANG_SITEMGR_APPROVE);?> <?=system_showText(LANG_REVIEWANDREPLY);?></input><br />
                            <? } ?>
                            <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto 0 auto;" align="center">
                                <tr>
                                    <td>
                                        <button type="submit" name="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_BUTTON_SEND);?></button>
                                        <button type="reset"  name="cancel" value="Cancel" class="input-button-form" onclick="hideStatusField(<?=$each_rate->getNumber('id');?>);"><?=system_showText(LANG_BUTTON_CANCEL);?></button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
            <? } ?>

		<? } ?>
	</table>

<script type="text/javascript">

    var thisForm = "";
    var thisId = "";
    
    $('img[alt=star]').bind('click', function(){
        $(this).fadeOut(50);
        $(this).fadeIn(50);
    });

    function showReviewField(idIn) {
        
        thisForm = "review";
        thisId = idIn;
        hideAllReviews();
        hideAllReplies();
        hideAllStatus();
        
        $("form").each(function() {
            this.reset();
        });
        $('.errorMessage').css('display', 'none');
        $('#ReviewTR'+idIn).css('display', '');
        $('.input-button-form').focus();
		document.getElementById("dropdownDomain").disabled = true;
    }
    
    function showReplyField(idIn) {
        
        thisForm = "reply";
        thisId = idIn;
        
        hideAllReplies();
        hideAllReviews();
        hideAllStatus();
        
        $("form").each(function() {
            this.reset();
        });
        $('.errorMessage').css('display', 'none');
        $('#replyReviewTR'+idIn).css('display', '');
        $('.input-button-form').focus();
		document.getElementById("dropdownDomain").disabled = true;
    }
    
    function showStatusField(idIn) {     
        
        thisForm = "status";
        thisId = idIn;
        
        hideAllReviews();
        hideAllReplies();
		hideAllStatus();
        
		$('.informationMessage').css('display', 'none');
		$('#statusTR'+idIn).css('display', '');
        $('.input-button-form').focus();
		document.getElementById("dropdownDomain").disabled = true;
    }

    function hideReviewField(idIn) {
        <? if ($reviewsArr) foreach($reviewsArr as $each_rate) { ?>
            $('#star_<?=$each_rate->getNumber('id');?>').removeClass("clicked");
            setDisplayRatingLevel(<?=$each_rate->getString("rating")?>, 'star_<?=$each_rate->getNumber('id');?>');
        <? } ?>
        $('#ReviewTR'+idIn).css('display', 'none');
        $('.errorMessage').css('display', 'none');
		document.getElementById("dropdownDomain").disabled = false;
    }
    
    function hideReplyField(idIn) {
        $('#replyReviewTR'+idIn).css('display', 'none');
        $('.errorMessage').css('display', 'none');
		document.getElementById("dropdownDomain").disabled = false;
    }
    
    function hideStatusField(idIn) {
        $('#statusTR'+idIn).css('display', 'none');
        $('.informationMessage').css('display', 'none');
		document.getElementById("dropdownDomain").disabled = false;
    }
    
    function hideAllReviews() {
    <? if ($reviewsArr) foreach($reviewsArr as $each_rate) { ?>
        $('#ReviewTR'+<?=$each_rate->getNumber('id');?>).css('display','none');
    <? } ?>
    }
    
    function hideAllReplies() {
    <? if ($reviewsArr) foreach($reviewsArr as $each_rate) { ?>
        $('#replyReviewTR'+<?=$each_rate->getNumber('id');?>).css('display','none');
    <? } ?>
    }
    
    function hideAllStatus() {
    <? if ($reviewsArr) foreach($reviewsArr as $each_rate) { ?>
        $('#statusTR'+<?=$each_rate->getNumber('id');?>).css('display','none');
    <? } ?>
    }
    
    

</script>
<ul class="standard-iconDESCRIPTION">
	<li class="review-pending-icon"><?=system_showText(LANG_REVIEW_PENDINGAPPROVAL);?></li>
	<li class="review-approved-icon"><?=system_showText(LANG_REVIEW_ACTIVE);?></li>
</ul>
<ul class="standard-iconDESCRIPTION">
	<li class="status-on-off-icon"><?=system_showText(LANG_REPLY_PENDINGAPPROVAL);?></li>
	<li class="status-off-off-icon"><?=system_showText(LANG_REVIEWANDREPLY_PENDINGAPPROVAL);?></li>
</ul>
<ul class="standard-iconDESCRIPTION">
	<li class="status-on-on-icon"><?=system_showText(LANG_REVIEWANDREPLY_ACTIVE);?></li>
</ul>
<ul class="standard-iconDESCRIPTION">
	<li class="moreinfo-icon"><?=system_showText(LANG_MOREINFO);?></li>
	<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
	<? if (string_strpos($url_base, "/sitemgr")) { ?>
		<li class="edit-review-icon"><?=system_showText(LANG_LABEL_EDIT_REVIEW);?></li>
		<li class="edit-reply-icon"><?=system_showText(LANG_LABEL_EDIT_REPLY);?></li>
		<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
	<? } else { ?>
		<li class="reply-icon"><?=system_showText(LANG_REPLY);?></li>
	<? } ?>
</ul>