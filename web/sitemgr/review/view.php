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
	# * FILE: /sitemgr/review/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/sitemgr/review";
	$url_base = "".DEFAULT_URL."/sitemgr";

	extract($_POST);
	extract($_GET);

	$each_rate = new Review($id);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>
<div id="main-right">
<div id="top-content">
	<div id="header-content">
		<h1><?=ucfirst(system_showText(LANG_SITEMGR_REVIEW))?> - <?=system_showText(LANG_SITEMGR_DETAIL)?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_review_submenu.php"); ?>
		<br />
		<div id="header-view">
			<?=system_showText(LANG_SITEMGR_REVIEW_MANAGEREVIEW)?>
		</div>
		<ul class="list-view">
            <li>
                <a href='javascript:void(0);' onclick='showReviewField(<?=$each_rate->getNumber('id');?>);'>
                    <?=string_ucwords(system_showText(LANG_LABEL_EDIT_REVIEW))?></a>
            </li>
            <? if ( string_strlen(trim($each_rate->getString("response"))) > 0 ) { ?>
                <li>
                    <a href='javascript:void(0);' onclick='showReplyField(<?=$each_rate->getNumber('id');?>);'>
                        <?=string_ucwords(system_showText(LANG_LABEL_EDIT_REPLY))?></a>
                </li>
            <? } ?>
            <? if ($each_rate->getNumber("approved") == 0 || (string_strlen(trim($each_rate->getString("response"))) > 0 && $each_rate->getNumber("responseapproved") == 0)) { ?>
                <li>
                    <a href='javascript:void(0);' onclick='showStatusField(<?=$each_rate->getNumber('id');?>);'>
                        <?=string_ucwords(system_showText(LANG_SITEMGR_APPROVE_REVIEW))?>/<?=string_ucwords(system_showText(LANG_REPLYNOUN))?></a>
                </li>
            <? } ?>
            
			<li>
				<a href="<?=DEFAULT_URL?>/sitemgr/review/delete.php?id=<?=$each_rate->getNumber("id")?>&item_type=<?=$each_rate->getNumber("item_type")?>&item_id=<?=$item_id?><?=($filter_id ? "&filter_id=1" : '')?>&screen=<?=$screen?>&letter=<?=$letter?>&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>" class="link-view"><?=system_showText(LANG_SITEMGR_REVIEW_DELETEREVIEW)?></a>
			</li>
		</ul>
		
		<? if (is_numeric($message) && isset($msg_review[$message])) { ?>
			<p class="successMessage"><?=$msg_review[$message]?></p>
		<? } ?>

        <div id="header-view">
			<?=system_showText(LANG_SITEMGR_REVIEW_REVIEWPREVIEW)?>
		</div>
		<?
		$each_rate->extract();
		$show_item = true;
		$user 	   = false;
		include(INCLUDES_DIR."/views/view_review_detail.php");
		echo $item_reviewcomment;
		?>
	</div>
</div>

<? // table to Edit Forms ?>
<style type="text/css">
    .hideForm {display: none;}
</style>

<table border="1" cellpadding="2" cellspacing="2" align="center" class="standard-tableTOPBLUE">

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
        <tr>
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
                <p class="title">Re: <?=html_entity_decode($review_title);?></p>
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
    
</table>  

<div id="bottom-content">
	&nbsp;
</div>
</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
        
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
        hideReplyField(idIn);
        hideStatusField(idIn);
        $('form')[0].reset();
        $('.errorMessage').css('display', 'none');
        $('#ReviewTR'+idIn).fadeIn(500);
        $('.input-button-form').focus();
    }

    function hideReviewField(idIn) {
        $('#star_<?=$each_rate->getNumber('id');?>').removeClass("clicked");
        setDisplayRatingLevel(<?=$each_rate->getString("rating")?>, 'star_<?=$each_rate->getNumber('id');?>');
        $('#ReviewTR'+idIn).css('display', 'none');
        $('.errorMessage').css('display', 'none');
    }


    function showReplyField(idIn) {
        thisForm = "reply";
        thisId = idIn;
        hideReviewField(idIn);
        hideStatusField(idIn);
        $('form')[1].reset();
        $('.errorMessage').css('display', 'none');
        $('#replyReviewTR'+idIn).fadeIn(500);
        $('.input-button-form').focus();
    }

    function hideReplyField(idIn) {
        $('#replyReviewTR'+idIn).css('display', 'none');;
        $('.errorMessage').css('display', 'none');
    }
    function showStatusField(idIn) {
        thisForm = "status";
        thisId = idIn;
        hideReviewField(idIn);
        hideReplyField(idIn);
        $('.informationMessage').css('display', 'none');
        $('#statusTR'+idIn).fadeIn(500);
        $('.input-button-form').focus();
    }
    
    function hideStatusField(idIn) {
        $('#statusTR'+idIn).css('display', 'none');;
        $('.errorMessage').css('display', 'none');
    }
</script>

<script type="text/javascript">

    <?setting_get("review_manditory", $reviewMandatory);?>
    var reviewMandatory = "<?=$reviewMandatory?>";
    var validInput = /[\w-]+/; 
    
    $(document).ready(function() {

        $("form").submit(function() {
            
            //Review Form Validations
            if (thisForm == "review") {    
                
                $('.errorMessage').empty();
                
                if (reviewMandatory == "on") {
                    if ($("#reviewer_name"+thisId).val() == "") {
                        $('.errorMessage').append("<?=system_showText(LANG_REVIEW_EMPTY_NAME)?><br />\n");    
                    }    
                    if ($("#reviewer_email"+thisId).val() == "") {
                        $('.errorMessage').append("<?=system_showText(LANG_REVIEW_EMPTY_EMAIL)?><br />\n");    
                    }    
                }
                if ($("#reviewer_location"+thisId).val() == "") {
                    $('.errorMessage').append("<?=system_showText(LANG_REVIEW_EMPTY_LOCATION)?><br />\n");    
                }
                if ($("#review_title"+thisId).val() == "") {
                    $('.errorMessage').append("<?=system_showText(LANG_REVIEW_EMPTY_TITLE)?><br />\n");    
                }
                if ($("#review"+thisId).val().search(validInput) == -1) {
                    $('.errorMessage').append("<?=system_showText(LANG_REVIEW_EMPTY)?><br />\n");    
                }
                
                if ($('.errorMessage').text() == "") {
                    $('.errorMessage').css('display', 'none');    
                } else {
                    $('.errorMessage').css('display', '');
                    return false;
                }
                
            //Reply Form Validations
            } else if (thisForm == "reply") {
                
                $('.errorMessage').empty();
                
                if ($("#reply"+thisId).val().search(validInput) == -1) {
                    $('.errorMessage').append("<?=system_showText(LANG_REPLY_EMPTY)?><br />\n");
                    $('.errorMessage').css('display', '');
                    return false;
                }
            
            //Status Form Validations
            } else if (thisForm == "status") {
                
                if ($("#approve_review"+thisId).val() && $("#approve_both"+thisId).val()) {
                    if ($("#approve_review"+thisId).attr("checked") == '' && $("#approve_both"+thisId).attr("checked") == '') {
                        $('.informationMessage').css('display', '');
                        return false;
                    }
                } else {
                    if ($("#approve_review"+thisId).attr("checked") == '' || $("#approve_reply"+thisId).attr("checked") == '') {
                        $('.informationMessage').css('display', '');
                        return false;
                    }    
                }
            } 
          
          return true;

        });
        
    });
    
    $('document').ready(function() {
    
        $('.successMessage').fadeOut(5000);
        
    });

</script>