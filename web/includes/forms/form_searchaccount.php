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
	# * FILE: /includes/forms/form_searchaccount.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if ($message_searchaccount) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_searchaccount?>
	</div>
<? } ?>
<table cellpadding="2" cellspacing="0" class="table-form">
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_TYPE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<select name="search_type">
				<option value=""><?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_DROPDOWN_ALL)?></option>
				<option value="directory" <? if ($search_type == "directory") { echo "selected"; } ?> >Directory</option>
				<option value="openid" <? if ($search_type == "openid") { echo "selected"; } ?> >OpenID 2.0</option>
				<option value="facebook" <? if ($search_type == "facebook") { echo "selected"; } ?> >Facebook</option>
				<option value="google" <? if ($search_type == "google") { echo "selected"; } ?> >Google</option>
			</select>
		</td>
	</tr>
	<? if (SOCIALNETWORK_FEATURE == "on") {?>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_SECTION)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<select name="search_section">
				<option value=""><?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_DROPDOWN_ALL)?></option>
				<option value="sponsor" <? if ($search_section == "sponsor") { echo "selected"; } ?> ><?=system_showText(LANG_SITEMGR_SECTION_SPONSOR);?></option>
				<option value="member" <? if ($search_section == "member") { echo "selected"; } ?> ><?=system_showText(LANG_SITEMGR_LABEL_MEMBER);?></option>
			</select>
		</td>
	</tr>
	<? } ?>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="search_username" value="<?=$search_username?>" class="input-form-searchaccount" />
		</td>
	</tr>
</table>
