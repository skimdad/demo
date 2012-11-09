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
	# * FILE: /includes/forms/form_forgot_password.php
	# ----------------------------------------------------------------------------------------------------

?>
	<? if ($section == "sitemgr") { ?>
	<div class="formFieldsLogin formFieldsForgot">
    
    	<div class="tipLogin">
            <?=LANG_SITEMGR_FORGOOTTEN_PASS_1;?>
            <div class="tipLoginBottom"></div>
        </div>
		
		<? if ($special_message) { ?><p class="informationMessage"><?=$special_message?></p><? } ?>

		<? if ($message) { ?><p class="<?=$message_class?>"><?=$message?></p><? } ?>
		
        <div class="formFieldsLeft">
            <label for="username"><?=system_showText(LANG_SITEMGR_EMAIL_ADDRESS)?></label>
            <input type="text" name="username" value="" />
    
            <div class="automaticBox">
                <div class="automaticLogin">
                    <a href="<?=DEFAULT_URL?>/sitemgr/login.php"><?=LANG_SITEMGR_FORGOOTTEN_PASS_3;?></a>
                </div>
            </div>
    	</div>
        
        <div class="formFieldsRight">
        	<p class="login-question">
                <b><?=LANG_SITEMGR_FORGOOTTEN_PASS_2;?></b><br /><?=LANG_SITEMGR_FORGOOTTEN_PASS_TIP;?>
            </p>
        	<p class="standardButton">
                <button type="submit" value="Send It"><?=LANG_SITEMGR_SEND_IT;?></button>
            </p>
        </div>
	</div>

	<? } else {?>

		<? if ($special_message) { ?><p class="informationMessage"><?=$special_message?></p><? } ?>

		<? if ($message) { ?><p class="<?=$message_class?>"><?=$message?></p><? } ?>

		<div class="formFieldsLogin">

			<label for="username"><?=system_showText(LANG_LABEL_USERNAME)?>:</label>
			<input type="text" id="username" name="username" value="" />

			<p class="standardButton">
				<button type="submit" value="<?=system_showText(LANG_BUTTON_CONTINUE)?>"><?=system_showText(LANG_BUTTON_CONTINUE)?></button>
			</p>
			<p class="standardButton">
				<button type="button" onclick="document.location.href='<?=DEFAULT_URL;?>/<?=$cancel_section;?>/'"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
			</p>

		</div>

	<? } ?>

