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
	# * FILE: /frontend/socialnetwork/edit_account.php
	# ----------------------------------------------------------------------------------------------------

?>

	<form name="account" id="account" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" enctype="multipart/form-data">
		<input type="hidden" name="tab" id="tab" value="<?=$tab? $tab: "tab_1";?>" />
		<input type="hidden" name="account_id" value="<?=$account_id?>" />
		<? $noteditusername = true; ?>
		<? $noteditagree    = true; ?>
		<div id="cont_tab_1" style="<?=($tab=='tab_1'||!$tab)?'':'display:none'?>">
			<? if (string_strlen(trim($message_profile))>0) { ?>
				<p class="errorMessage">
				<?=$message_profile?>
				</p>
			<? } ?>
			<? include(INCLUDES_DIR."/forms/form_profile.php"); ?>

			<div class="btAdd">
				<p class="standardButton">
					<button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
				</p>
				<p class="standardButton">
					<button type="reset" onclick="redirect('<?=DEFAULT_URL?>/profile/');"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
				</p>
			</div>
		</div>
		<div id="cont_tab_2" style="<?=($tab=='tab_2')?'':'display:none'?>">
			<? if ((string_strlen(trim($message_member))>0) ||(string_strlen(trim($message_account))>0) ||(string_strlen(trim($message_contact))>0) ) { ?>
				<p class="errorMessage">
				<? if (string_strlen(trim($message_member))>0) { ?>
					<?=$message_member?>
				<? } ?>
				<? if ((string_strlen(trim($message_member))>0) && (string_strlen(trim($message_account))>0)) { ?>
					<br />
				<? } ?>
				<? if (string_strlen(trim($message_account))>0) { ?>
					<?=$message_account?>
				<? } ?>
				<? if (string_strlen(trim($message_contact))>0) { ?>
					<?=$message_contact?>
				<? } ?>
				</p>
			<? } ?>
			<? include(INCLUDES_DIR."/forms/form_account.php"); ?>
			<? include(INCLUDES_DIR."/forms/form_contact.php"); ?>

			<div class="btAdd">
				<p class="standardButton">
					<button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
				</p>
				<p class="standardButton">
					<button type="reset" onclick="redirect('<?=DEFAULT_URL?>/profile/');"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
				</p>
			</div>
		</div>
	</form>

	<script language="javascript" type="text/javascript">
		function redirect (url) {
			window.location = url;
		}
	</script>