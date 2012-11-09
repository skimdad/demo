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
	# * FILE: /includes/forms/form_login.php
	# ----------------------------------------------------------------------------------------------------

?>

<input type="hidden" name="destiny" value="<?=$destiny?>" />
<input type="hidden" name="query" value="<?=urlencode($query)?>" />

<? $style = ($special_message || $message_login) ? "display:visible;" : "display:none;"; ?>

<?
$defaultusername = $username;
$defaultpassword = "";
if (DEMO_MODE) {
	if(!$_POST["account_sugar_id"]){
		if ($members_section) {
			$defaultusername = "demo@demodirectory.com";
			$defaultpassword = "abc123";
		} elseif ($sitemgr_section) {
			$defaultusername = "sitemgr@demodirectory.com";
			$defaultpassword = "abc123";
		}
	}
}
?>

	<? if($aux_modal_box){ ?>
		<? if ($special_message) { ?><p class="errorMessage" style="<?=$style?>"><?=$special_message?></p><? } ?>
		<? if ($message_login) { ?><p class="<?=$_GET["np"]? "informationMessage": "errorMessage";?>" style="<?=$style?>"><?=$message_login?></p><? } ?>
		<div>
			<label for="username"><?=system_showText(LANG_LABEL_USERNAME);?>:</label>
			<input class="text" type="text" name="username" id="username" value="<?=$defaultusername?>" />
		</div>
		<div>
			<label for="password"><?=system_showText(LANG_LABEL_PASSWORD);?>:</label>
			<input class="text" type="password" name="password" id="password" value="<?=$defaultpassword?>" />
		</div>
		<? if ($automatically !== false) { ?>
		<div>
			<input type="checkbox" name="automatic_login" value="1" <?=$checked?> class="checkbox" style="float:left;" /><? /**/ ?>
			<label for="automatic_login"><?=system_showText(LANG_AUTOLOGIN);?></label>
		</div>
		<? } ?>		
		
		<button type="submit"><?=system_showText(LANG_BUTTON_LOGIN);?></button>
		
	<?
	}elseif (!$sitemgr_section) { ?>
    	<? if ($special_message) { ?><p class="errorMessage" style="<?=$style?>"><?=$special_message?></p><? } ?>
		<? if ($message_login) { ?><p class="<?=$_GET["np"]? "informationMessage": "errorMessage";?>" style="<?=$style?>"><?=$message_login?></p><? } ?>
		<div class="formFieldsLogin">
			<label for="username"><?=system_showText(LANG_LABEL_USERNAME);?>:</label>
			<input class="text" type="text" name="username" id="username" value="<?=$defaultusername?>" />
			<span class="clear"></span>
			<label for="password"><?=system_showText(LANG_LABEL_PASSWORD);?>:</label>
			<input type="password" name="password" id="password" value="<?=$defaultpassword?>" />
			<? if ($automatically !== false) { ?>
				<span class="automaticLogin">
					<input type="checkbox" name="automatic_login" value="1" <?=$checked?> class="inputAuto" />
					<?=system_showText(LANG_AUTOLOGIN);?>
				</span>
			<? } ?>
			<span class="clear"></span>
			<p class="standardButton">
				<button type="submit"><?=system_showText(LANG_BUTTON_LOGIN);?></button>
			</p>
		</div>
	<? } else { ?>
		<div class="formFieldsLogin">
			<div class="tipLogin">
				<?=system_showText(LANG_SITEMGR_LOGIN_ACCOUNT);?>
				<div class="tipLoginBottom"></div>
			</div>
            
            <? if ($special_message) { ?><p class="errorMessage" style="<?=$style?>"><?=$special_message?></p><? } ?>
			<? if ($message_login) { ?><p class="errorMessage" style="<?=$style?>"><?=$message_login?></p><? } ?>
			<div class="formFieldsLeft">
				<label for="username"><?=system_showText(LANG_SITEMGR_EMAIL_ADDRESS);?></label>
				<input type="text" name="username" id="username" value="<?=$defaultusername?>" />

				<span class="clear"></span>

				<label for="password"><?=system_showText(LANG_LABEL_PASSWORD);?></label>
				<input type="password" name="password" id="password" value="<?=$defaultpassword?>" />

				<? if (DEMO_MODE) { ?> <center class="warning">Test Password: abc123</center> <? } ?>

				<p class="linkLogin">
					<a href="<?=((SSL_ENABLED == "on" && FORCE_SITEMGR_SSL == "on") ? SECURE_URL : DEFAULT_URL)?>/sitemgr/forgot.php"><?=system_showText(LANG_SITEMGR_FORGOTPASS_FORGOTYOURPASSWORD)?></a>
				</p>

				<? if ($automatically !== false) { ?>
                	<div class="automaticBox">
                        <div class="automaticLogin">
                            <input type="checkbox" name="automatic_login" value="1" <?=$checked?> class="inputAuto" />
                            <?=system_showText(LANG_AUTOLOGIN);?>
                        </div>
                    </div>
				<? } ?>
			</div>

			<div class="formFieldsRight">
				<p class="login-question">
					<b><?=system_showText(LANG_SITEMGR_LOGIN);?></b><br /><?=system_showText(LANG_SITEMGR_LOGIN_TIP);?><br /><br />
					<? if (DEMO_MODE){ ?>
						<?=system_showText(LANG_SITEMGR_LOGIN_TIP_2);?> <a href="<?=DEFAULT_URL."/advertise.php"?>"><?=system_showText(LANG_SITEMGR_LOGIN_TIP_3);?></a>.
					<? } ?>
				</p>
			</div>
            <p class="standardButton">
                <button type="submit"><?=system_showText(LANG_BUTTON_LOGIN);?></button>
            </p>
		</div>
	<? } ?>
