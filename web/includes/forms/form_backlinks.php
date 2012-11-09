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
	# * FILE: /includes/forms/form_backlinks.php
	# ----------------------------------------------------------------------------------------------------

	?>

	<h2><?=system_showText(str_replace("!", "", LANG_INCREASE_VISIBILITY));?></h2>
        
    <?
    if ($message_backlink) {
        echo "<p class=\"errorMessage\">";
            echo $message_backlink;
        echo "</p>";
    }

    ?>
    
	<div class="stepsBox membersStepsBox" style="height: 147px;">
		<div class="sugarFirstStep" style="height: 130px;">
			<p><?=system_showText(LANG_LABEL_PUTTHISCODE);?></p>
			<textarea readonly  maxlength="160" rows="8" cols="50"><a href="http://www.dealcloudusa.com/listing/guide/<? echo str_replace(" ","-",$catlink); ?>"><? echo $blogo.$btxt ?></a></textarea>
		</div>
		<div class="sugarSecondStep">
			<p><?=system_showText(LANG_LABEL_ENTERURL);?></p> 
			<input type="text" id="website_url" name="backlink_url" value="<?=$backlink_url?>" />
			<span><?=system_showText(LANG_LABEL_ENTERURL_TIP);?></span>
		</div>
		<div class="sugarThirdStep">
			<p><?=system_showText(LANG_LABEL_VERIFYSITE);?></p> 
			<p class="standardButton">
				<button type="button" onclick="checkWebsite();"><?=system_showText(LANG_LABEL_VERIFY)?></button>
                <p style="display:none" id="imgLoading"><img src="<?=THEMEFILE_URL."/".EDIR_THEME."/images/iconography/icon-loading-content.gif"?>" /></p>
			</p>
		</div>
	</div>

	<div class="extendedContent membersExtendedContent">

		<img height="232" width="244" src="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME?>/images/imagery/img-backlink-add.gif">

		<div class="content-custom">
			<p>
				<h4><?=system_showText(LANG_LABEL_QUESTION1);?></h4>
				<?=system_showText(LANG_LABEL_ANSWER1);?><br /> <br />
				<h4><?=system_showText(LANG_LABEL_QUESTION2);?></h4>
				<?=system_showText(LANG_LABEL_ANSWER2);?><br /> <br />
				<h4><?=system_showText(LANG_LABEL_QUESTION3)?></h4>
				<?=system_showText(LANG_LABEL_ANSWER4);?><br />
                <strong><?=system_showText(LANG_LABEL_BACKLINKCODE_TIP);?></strong>
			</p>
		</div>

		<div class="baseButtons">
			<p class="standardButton checkoutButton" style="float: right;">
				<button type="button" class="inactive" id="continue" disabled="disabled" style="cursor: default;" onclick="addBacklink();"><?=system_showText(LANG_LABEL_CONFIRM_BACKLINK);?></button>
			</p>
		</div>
	</div>
	
	<script language="javascript" type="text/javascript">
        function addBacklink(){
			$('#backlinks').submit();
		}
		
		function checkWebsite(){
			
			var url = "";
			var listingId = <?=$id?>;
			
			url = $('#website_url').val();
			
			if (url){
                $("#imgLoading").css("display", "");
				$.post(DEFAULT_URL + "/check_website.php", {
                    url: url,
                    id: listingId,
                    lang: '<?=REDIRECT_EDIR_LANGUAGE ? EDIR_LANGUAGEABBREVIATION : ""?>'
				}, function (response) {
                    $("#imgLoading").css("display", "none");
					if (response == "OK"){
						$('#continue').attr("disabled", "");
						$('#continue').removeClass("inactive");
						$('#continue').css("cursor" , "pointer");
                        $('#backlinkValid').val("1");
                        fancy_alert('<?=system_showText(LANG_LABEL_VALIDATION_OK)?>', 'successMessage', false, 350, 'auto', false);
					} else {
                        $('#continue').attr("disabled", "disabled");
						$('#continue').addClass("inactive");
						$('#continue').css("cursor" , "default");
                        $('#backlinkValid').val("0");
                        fancy_alert('<?=system_showText(LANG_LABEL_VALIDATION_FAIL)?>', 'errorMessage', false, 350, 'auto', false);
					}
				});	
			} else {
                fancy_alert('<?=system_showText(LANG_LABEL_TYPE_URL)?>', 'informationMessage', false, 350, 'auto', false);
			}
		}
		
	</script>