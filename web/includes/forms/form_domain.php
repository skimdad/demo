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
	# * FILE: /includes/forms/form_domain_step1.php
	# ----------------------------------------------------------------------------------------------------
?>

<?
if ($message_domain) {
	echo "<p class='errorMessage'>";
	echo $message_domain;
	echo "</p>";
}
?>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_DOMAIN_INFORMATION)?></th>
	</tr>
	<tr>
		<th class="wrap">
			<?
				echo "* ".system_showText(LANG_SITEMGR_DOMAIN_NAME).":";
			?>
		</th>
		<td>
			<input type="text" name="name" id="name" value="<?=$name?>" maxlength="200" />
			<span>
				<?=system_showText(LANG_SITEMGR_DOMAIN_FRIENDLY_NAME)?>
			</span>
		</td>
	</tr>
	<tr class="wrap">
		<th>
			<?
				echo "* ".system_showText(LANG_SITEMGR_DOMAIN_URL).":";
			?>
		</th>
		<td>
			<input type="text" name="url" id="url" value="<?=$url?>" maxlength="200" />
			<span>
			yoursite.com
			</span>
		</td>
	</tr>
	<tr class="wrap">
		<th>
			<?
				echo system_showText(LANG_SITEMGR_DOMAIN_SUBFOLDER).":";
			?>
		</th>
		<td>
			<input type="text" name="subfolder" id="subfolder" value="<?=$subfolder?>" maxlength="200" />
			<span>
			/subfolder
			</span>
		</td>
	</tr>
	<tr>
		<th class="wrap">
			<?
				echo system_showText(LANG_SITEMGR_DOMAIN_MODULES).":";
			?>
		</th>
		<td>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<input class="inputRadio" type="checkbox" name="article_feature" <?=$article_feature? "checked": "";?>/> &nbsp; <?=system_showText(LANG_ARTICLE_FEATURE_NAME);?>
					</td>
					<td>
						<input class="inputRadio" type="checkbox" name="banner_feature" <?=$banner_feature? "checked": "";?>/> &nbsp; <?=system_showText(LANG_BANNER_FEATURE_NAME);?>
					</td>
					<td>
						<input class="inputRadio" type="checkbox" name="classified_feature" <?=$classified_feature? "checked": "";?>/> &nbsp; <?=system_showText(LANG_CLASSIFIED_FEATURE_NAME);?>
					</td>
					<td>
						<input class="inputRadio" type="checkbox" name="event_feature" <?=$event_feature? "checked": "";?>/> &nbsp; <?=system_showText(LANG_EVENT_FEATURE_NAME);?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr <?=(count($servers) > 1) ? "": "style=\"display: none;\"";?>>
		<th class="wrap">
			<?
				echo system_showText(LANG_SITEMGR_DOMAIN_SERVER).":";
			?>
		</th>
		<td>
			<select name="server" id="server">
				<?
					foreach ($servers as $server) {
						?>
						<option value="<?=$server == system_showText(LANG_SITEMGR_DOMAIN_CURRENT_SERVER)? "default": $server;?>" <?=$selected_server == $server? "selected": "";?>><?=$server;?></option>
						<?
					}
				?>
			</select>
		</td>
	</tr>
</table>