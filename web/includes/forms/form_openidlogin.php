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
	# * FILE: /includes/forms/form_openidlogin.php
	# ----------------------------------------------------------------------------------------------------

?>

	<input type="hidden" name="destiny" value="<?=$destiny?>" />
	<input type="hidden" name="query" value="<?=urlencode($query)?>" />

	<? if ($message_login) { ?>
		<p class="<?=$_GET["np"]? "informationMessage": "errorMessage";?>"><?=$message_login?></p>
	<? } ?>

	<? 
	$defaultopenidurl = $openidurl; 
	if($aux_modal_box){ ?>

		<div>
			<label for="username"><?=system_showText(LANG_LABEL_OPENIDURL);?>:</label>
			<input type="text" name="openidurl" id="openidurl" value="<?=$defaultopenidurl?>" class="text" />
		</div>

		<button type="submit"><?=system_showText(LANG_BUTTON_LOGIN);?></button>

		<p>&nbsp;</p>

	<? } else {	?>

		<div class="formFieldsLogin">
			<label for="username"><?=system_showText(LANG_LABEL_OPENIDURL);?>:</label>
			<input type="text" name="openidurl" id="openidurl" value="<?=$defaultopenidurl?>" />
			<span class="clear"></span>
			<p class="standardButton">
				<button type="submit"><?=system_showText(LANG_BUTTON_LOGIN);?></button>
			</p>
		</div>

	<? } ?>