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
	# * FILE: /includes/forms/form_domain_denied.php
	# ----------------------------------------------------------------------------------------------------
?>
	<p class="informationMessage">
		<?=system_showText(LANG_SITEMGR_DOMAIN_CONTACT_SUPPORT);?>
	</p>

	<? if ($privileges["denied"]) { ?>
		<p class="errorMessage">
			<?=system_showText(LANG_SITEMGR_DOMAIN_PRIVILEGEWARNING);?>
			<br />
			<?
			echo system_showText(LANG_SITEMGR_DOMAIN_YOURPRIVILEGES);
			$strprivilege = "";
			if (is_array($privileges["granted"])) {
				foreach ($privileges["granted"] as $privilegeGranted){
						$strprivilege .= $privilegeGranted.", ";
				}
				$strprivilege = string_substr($strprivilege,0,-2);
			} else {
				$strprivilege = system_showText(LANG_SITEMGR_NONE);
			}
			echo $strprivilege."<br/>";

			echo system_showText(LANG_SITEMGR_DOMAIN_MISSINGPRIVILEGES);
			$strprivilege = "";
			if (is_array($privileges["denied"])) {
				foreach ($privileges["denied"] as $privilegeDenied){
						$strprivilege .= $privilegeDenied.", ";
				}
				$strprivilege = string_substr($strprivilege,0,-2);
			} else {
				$strprivilege = system_showText(LANG_SITEMGR_NONE);
			}
			echo $strprivilege;
			?>
		</p>
	<? }
	
	if ((int)$folderPerm < (int)PERMISSION_CUSTOM_FOLDER) { ?>
		<p class="errorMessage">
			<?=system_showText(LANG_SITEMGR_DOMAIN_PERMISSIONWARNING);?>
			<br />
			<?=system_showText(LANG_SITEMGR_DOMAIN_CURRENT_PERMISSION).$folderPerm;?>
			<br />
			<?=system_showText(LANG_SITEMGR_DOMAIN_NEEDED_PERMISSION).PERMISSION_CUSTOM_FOLDER;?>
		</p>
	<? } ?>

	<? if ($safeMode) { ?>
		<p class="errorMessage">
			<?=system_showText(LANG_SITEMGR_DOMAIN_SAFEMODEWARNING);?>
		</p>
	<? } ?>

	<div id="content-content">
		<div class="default-margin">
			<div class="baseForm">

				<button type="button" name="back" class="input-button-form" value="Back" onclick="window.location = '<?=DEFAULT_URL?>/sitemgr/domain/index.php'"><?=system_showText(LANG_SITEMGR_BACK)?></button>

			</div>
		</div>
	</div>