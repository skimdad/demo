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
	# * FILE: blog/includes/tables/table_comments.php
	# ---------------------------------------------------------------------------------------------------

//	setting_get("wp_enabled", $wp_enabled);
//	
//	if (BLOG_WITH_WORDPRESS == "on"){
//		$wp_enabled = "";
//	}

	$wp_enabled = "";
?>
	<ul class="standard-iconDESCRIPTION">
		<? if (!$wp_enabled) { ?>
		<?if ($reply_id){?>
			<li class="review-pending-icon"><?=system_showText(LANG_REPLY_PENDINGAPPROVAL);?></li>
			<li class="review-approved-icon"><?=system_showText(LANG_REPLY_ACTIVE);?></li>
		<?} else { ?>
			<li class="review-pending-icon"><?=system_showText(LANG_COMMENT_PENDINGAPPROVAL);?></li>
			<li class="review-approved-icon"><?=system_showText(LANG_COMMENT_ACTIVE);?></li>
		<?}}?>
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
		<? if (!$wp_enabled) { ?>
		<? if (!$reply_title) { ?>
			<li class="view-reply-icon"><?=system_showText(LANG_LABEL_VIEW_REPLY);?></li>
		<? }} ?>
        <li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
	</ul>


 	<table border="1" cellpadding="2" cellspacing="2" align="center" class="standard-tableTOPBLUE">
		<tr>
			<? if ($reply_id){?>
			<th style="width: 220px;"><?=system_showText(LANG_LABEL_REPLY);?></th>
			<? } else {?>
			<th style="width: 220px;"><?=system_showText(LANG_LABEL_COMMENT);?></th>
			<? } ?>
			<th style="width: 220px;"><?=system_showText(LANG_LABEL_POST);?></th>
			<th style="width: 145px;"><?=system_showText(LANG_LABEL_ADDED);?></th>
			<th style="width: 95px;"><?=string_ucwords(system_showText(LANG_LABEL_ACCOUNT));?></th>
			<? if (!$wp_enabled) { ?>
			<th style="width: 45px;"><?=string_ucwords(system_showText(LANG_LABEL_STATUS));?></th>
			<? } ?>
			<th style="width:<?=($reply_title ? "40px" : "60px")?>;"><?=system_showText(LANG_LABEL_OPTIONS)?></th>

		</tr>

		<? if ($commentsArr) foreach($commentsArr as $each_rate) {

			$hasReply = blog_getReply($each_rate->getNumber('id'));
			$post = new Post($each_rate->getNumber('post_id'));

            $info = array();
			$item_type = $each_rate->getString('item_type');
			$item_id = $each_rate->getNumber("item_id");
			?>

			<tr>
				<td>
					<?
					if ($each_rate->getString("description")) {
						$comment_title = $each_rate->getString("description", true, 30);
					} else {
						$comment_title = system_showText(LANG_NA);
					}
					?>

					<a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/comments/view.php?post_id=<?=$post->getNumber("id")?>&id=<?=$each_rate->getString("id")?>&screen=<?=$screen?>&letter=<?=$letter?>&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>" class="link-table"><?=$comment_title?></a>
				</td>
				<td>
					<? $post_title = $post->getString("title", true, 30); ?>
					<a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/view.php?id=<?=$post->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-table"><?=$post_title?></a>

				</td>
				<td><?=($each_rate->getString("added")) ? format_date($each_rate->getString("added"), DEFAULT_DATE_FORMAT, "datetime")." - ".$each_rate->getTimeString("added") : system_showText(LANG_NA);?></td>
				<td>
					<?
					$account_id = $each_rate->getNumber("member_id");
					$account = new Contact($account_id);
					if ($account->getString("first_name")) {
						$reviewer_name = system_showTruncatedText($account->getString("first_name")." ".$account->getString("last_name"), 25);
					} else {
						$reviewer_name = system_showText(LANG_NA);
					}
					?>

					<a href="<?=DEFAULT_URL?>/sitemgr/account/view.php?id=<?=$account_id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table" title="<?=$reviewer_name?>">
					<?=$reviewer_name?>
					</a>
				</td>
				<? if (!$wp_enabled) { ?>
				 <td style="padding-left:15px">

                <? if ($each_rate->getNumber("approved") == 0) { ?> <a href='javascript:void(0);' onclick='showStatusField(<?=$each_rate->getNumber('id');?>);'> <? } ?>
                    <?
                    if ($each_rate->getNumber("approved") == 0) {
                            ?>
                            <img src="<?=DEFAULT_URL?>/images/bt_review_pending.gif" border="0" alt="<?=($reply_id? system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY) : system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE_COMMENT));?>" title="<?=($reply_id? system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY) : system_showText(LANG_MSG_WAITINGSITEMGRAPPROVE_COMMENT));?>" />
                            <?
                    } elseif ($each_rate->getNumber("approved") == 1) {
                                ?>
                                <img src="<?=DEFAULT_URL?>/images/bt_review_approved.gif" border="0" alt="<?=($reply_id? system_showText(LANG_MSG_REPLY_ALREADY_APPROVED) : system_showText(LANG_MSG_COMMENT_ALREADY_APPROVED));?>" title="<?=($reply_id? system_showText(LANG_MSG_REPLY_ALREADY_APPROVED) : system_showText(LANG_MSG_COMMENT_ALREADY_APPROVED));?>" />
                                <?
                    }
                    ?>
                <? if ($each_rate->getNumber("approved") == 0) { ?> </a> <? } ?>

                </td>
				<? } ?>

				<td>
					<a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/comments/view.php?post_id=<?=$post->getNumber("id")?>&id=<?=$each_rate->getString("id")?>&screen=<?=$screen?>&letter=<?=$letter?>&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=($reply_id ? system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_REPLY) : system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_COMMENT))?>" title="<?=($reply_id ? system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_REPLY) : system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_COMMENT))?>" />
					</a>
					<? if (!$wp_enabled) { ?>
					<? if (!$reply_title) { ?>
						<? if (!$hasReply) { ?>
							<img src="<?=DEFAULT_URL?>/images/bt_reply_blog_pending.gif" border="0" alt="<?=system_showText(LANG_MSG_NO_REPLIES);?>" title="<?=system_showText(LANG_MSG_NO_REPLIES);?>" />
						<? } else { ?>
							<a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/comments/index.php?reply_id=<?=$each_rate->getNumber("id")?>" class="link-table">
								<img src="<?=DEFAULT_URL?>/images/bt_reply_blog_approved.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_REPLIES);?>" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_REPLIES);?>" />
							</a>
						<? } ?>
					<? } ?>
					<? } ?>
					<a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/comments/delete.php?post_id=<?=$post->getNumber("id")?>&id=<?=$each_rate->getString("id")?>&screen=<?=$screen?>&letter=<?=$letter?>&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=($reply_id ? system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_REPLY) : system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_COMMENT))?>" title="<?=($reply_id ? system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_REPLY) : system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_COMMENT))?>" />
					</a>
				</td>
			</tr>

             <? // Status Edit Form ?>
                <tr id="statusTR<?=$each_rate->getNumber('id');?>" class="hideForm" style="display:none">
                    <td colspan="7" id="statusTD<?=$each_rate->getNumber('id');?>" class="innerTable">
                        <form name="formStatus" action="status.php">
                            <p class="informationMessage"  style="display:none" id="informationMessageStatus"><?=system_showText(LANG_STATUS_EMPTY);?></p>
                            <input type="hidden" name="post_id" value="<?=$each_rate->getNumber('post_id');?>" />
                            <input type="hidden" name="idComment" value="<?=$each_rate->getNumber('id');?>" />
                            <? if ($filter_id) { ?>
                            <input type="hidden" name="filter_id" value="1" />
                            <? } ?>
                            <input type="hidden" name="screen" value="<?=$_GET['screen']?>" />
                            <input type="hidden" name="letter" value="<?=$_GET['letter']?>" />
                            <p class="title"><?=$comment_title;?></p><br />
                            <?if ($each_rate->getNumber("approved") == 0) {?>
                                <input type="radio" name="status" value="comment" id="approve_comment<?=$each_rate->getNumber('id');?>">&nbsp;<?=( $reply_id ?system_showText(LANG_SITEMGR_APPROVE_REPLY) : system_showText(LANG_SITEMGR_APPROVE_COMMENT))?></input><br />
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


	<script type="text/javascript">

    var thisForm = "";
    var thisId = "";

    $('img[alt=star]').bind('click', function(){
        $(this).fadeOut(50);
        $(this).fadeIn(50);
    });


    function showStatusField(idIn) {

        thisForm = "status";
        thisId = idIn;

        hideAllComments();
		hideAllStatus();

		$('.informationMessage').css('display', 'none');
		$('#statusTR'+idIn).css('display', '');
        $('.input-button-form').focus();
    }

    function hideReplyField(idIn) {
        $('#replyReviewTR'+idIn).css('display', 'none');
        $('.errorMessage').css('display', 'none');
    }

    function hideStatusField(idIn) {
        $('#statusTR'+idIn).css('display', 'none');
        $('.informationMessage').css('display', 'none');
    }

    function hideAllComments() {
    <? if ($commentsArr) foreach($commentsArr as $each_rate) { ?>
        $('#CommentTR'+<?=$each_rate->getNumber('id');?>).css('display','none');
    <? } ?>
    }

    function hideAllStatus() {
    <? if ($commentsArr) foreach($commentsArr as $each_rate) { ?>
        $('#statusTR'+<?=$each_rate->getNumber('id');?>).css('display','none');
    <? } ?>
    }



</script>

	</table>

    <ul class="standard-iconDESCRIPTION">
		<? if (!$wp_enabled) { ?>
		<?if ($reply_id){?>
			<li class="review-pending-icon"><?=system_showText(LANG_REPLY_PENDINGAPPROVAL);?></li>
			<li class="review-approved-icon"><?=system_showText(LANG_REPLY_ACTIVE);?></li>
		<?} else { ?>
			<li class="review-pending-icon"><?=system_showText(LANG_COMMENT_PENDINGAPPROVAL);?></li>
			<li class="review-approved-icon"><?=system_showText(LANG_COMMENT_ACTIVE);?></li>
		<?}}?>
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
		<? if (!$wp_enabled) { ?>
		<? if (!$reply_title) { ?>
			<li class="view-reply-icon"><?=system_showText(LANG_LABEL_VIEW_REPLY);?></li>
		<? }} ?>
        <li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
	</ul>