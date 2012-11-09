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
	# * FILE: /includes/forms/form_contact.php
	# ----------------------------------------------------------------------------------------------------

	$item_form = true;
	$contact = true;
	$dropdown_protocol = html_protocolDropdown($url, "url_protocol", false, $protocol_replace);
	
	if (string_strpos($_SERVER['PHP_SELF'], "/".MEMBERS_ALIAS) === false) { $th_class = " class=\"\""; }
?>

<table id="contact_info" border="0" cellpadding="2" cellspacing="0" class="standard-table standardSIGNUPTable noMargin">

	<? if (string_strpos($_SERVER['PHP_SELF'], "/add/index.php") == true || string_strpos($_SERVER['PHP_SELF'], "add.php") == true || string_strpos($_SERVER['PHP_SELF'], "edit.php") == true || $_SERVER['PHP_SELF'] == "/members/account/account.php") { ?>
	
		<tr>
			<th colspan="2" class="standard-tabletitle">
				<?=system_showText(LANG_LABEL_CONTACT_INFORMATION);?>
				<? if (SOCIALNETWORK_FEATURE == "off") { ?>
					<span><?=system_showText(LANG_MSG_INFO_NOT_DISPLAYED);?></span>
				<? } ?>
			</th>
		</tr>

		<? if (SOCIALNETWORK_FEATURE == "on") { ?>
			<tr id="tr_display_contact" style="<?=$has_profile == "y" || !$has_profile? "": "display: none;";?>">
				<th><input type="checkbox" name="publish_contact" <?=($publish_contact == "y" || $publish_contact == "on") ? "checked=\"checked\"": "" ?> class="inputRadio"/></th>
				<td><?=system_showText(LANG_LABEL_PUBLISH_MY_CONTACT);?></td>
			</tr>
		<? } ?>

	<? } ?>
    <? 
    $langObj = new Lang();
    $languages = $langObj->getCountEnabledLang();
    if ($languages > 1) { ?>
	    <tr>
		    <th class="alignTop alignWithField">* <?=system_showText(LANG_LABEL_LANGUAGE);?>:</th>
		    <td>
			    <?=language_langOptions($lang);?>
			    <span><?=system_showText(LANG_LABEL_LANGUAGETIP)?></span>
		    </td>
	    </tr>
		<tr>
		    <th<?=$th_class;?>>
				<input type="checkbox" name="use_lang" <?=($use_lang == "y" || $use_lang == "on") ? "checked=\"checked\"": "" ?> class="inputRadio" />
			</th>
		    <td>
			    <?=system_showText(LANG_LABEL_USE_SELECTEDLANGUAGE);?>
		    </td>
	    </tr>
    <? } else {
		echo "<input type=\"hidden\" name=\"lang\" value=\"".$langObj->getDefault()."\" />\n";
		echo "<input type=\"hidden\" name=\"use_lang\" value=\"y\" />\n";
	} ?>
    
	<tr>
		<th>* <?=system_showText(LANG_LABEL_FIRST_NAME);?>:</th>
		<td><input type="text" name="first_name" value="<?=$first_name?>" /></td>
	</tr>
	<tr>
		<th>* <?=system_showText(LANG_LABEL_LAST_NAME);?>:</th>
		<td><input type="text" name="last_name" value="<?=$last_name?>" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_COMPANY);?>:</th>
		<td><input type="text" name="company" value="<?=$company?>" /></td>
	</tr>
	<tr>
		<th class="alignTop alignWithField" valign="top"><?=system_showText(LANG_LABEL_ADDRESS1)?>:</th>
		<td><input type="text" name="address" value="<?=$address?>" maxlength="50" />
			<span><?=system_showText(LANG_ADDRESS_EXAMPLE)?></span>
		</td>
	</tr>
	<tr>
		<th class="alignTop alignWithField"><?=system_showText(LANG_LABEL_ADDRESS2)?>:</th>
		<td><input type="text" name="address2" value="<?=$address2?>" maxlength="50" />
			<span><?=system_showText(LANG_ADDRESS2_EXAMPLE)?></span>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_COUNTRY)?>:</th>
		<td><input type="text" name="country" value="<?=$country?>" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_STATE)?>:</th>
		<td><input type="text" name="state" value="<?=$state?>" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_CITY)?>:</th>
		<td><input type="text" name="city" value="<?=$city?>" /></td>
	</tr>
	<tr>
		<th><?=string_ucwords(ZIPCODE_LABEL)?>:</th>
		<td><input type="text" name="zip" value="<?=$zip?>" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_PHONE)?>:</th>
		<td><input type="text" name="phone" value="<?=$phone?>" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_FAX)?>:</th>
		<td><input type="text" name="fax" value="<?=$fax?>" /></td>
	</tr>
	<tr>
		<th>* <?=system_showText(LANG_LABEL_EMAIL)?>:</th>
		<td><input type="text" name="email" id="email" value="<?=$email?>" /></td>
	</tr>
	<? if ($sitemgrsection || $memberssection || $advertise) {?>
	<tr>
		<th<?=$th_class;?>>
			<input type="checkbox" name="notify_traffic_listing" id="notify_traffic_listing" <?=($notify_traffic_listing == "y" || $notify_traffic_listing == "on" || (!$id && $_SERVER["REQUEST_METHOD"] != "POST")) ? "checked=\"checked\"": "" ?> class="inputRadio" />
		</th>
		<td>
			<?=system_showText(LANG_LABEL_NOTIFY_TRAFFIC);?>
		</td>
	</tr>
	<? } ?>
	<tr>
		<th><?=system_showText(LANG_LABEL_URL)?>:</th>
		<td>
			<?=$dropdown_protocol;?>
			<input type="text"  class="httpInput" name="url" value="<?=str_replace($protocol_replace, "", $url)?>" <?=(string_strpos($_SERVER["PHP_SELF"], "sitemgr") !== false ? "style=\"width:487px\"" : "style=\"width:430px\"");?>/>
		</td>
	</tr>
</table>
