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
	# * FILE: /includes/forms/form_featuredcategory_admin.php
	# ----------------------------------------------------------------------------------------------------

	
	
	

echo '
<script type="text/javascript">
<!--
function check_featuredcategory() {
	if (document.getElementById("featuredcategory_enabled").checked) {
		
		document.getElementById("listing_featuredcategory_enabled").disabled = false;
		document.getElementById("listing_featuredcategory_enabled").checked = true;
		'.(EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on" ? '
		document.getElementById("event_featuredcategory_enabled").disabled = false;
		document.getElementById("event_featuredcategory_enabled").checked = true;
		':'').'
		'.(CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on" ? '
		document.getElementById("classified_featuredcategory_enabled").disabled = false;
		document.getElementById("classified_featuredcategory_enabled").checked = true;
		':'').'
		'.(ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on"? '
		document.getElementById("article_featuredcategory_enabled").disabled = false;
		document.getElementById("article_featuredcategory_enabled").checked = true;
		':'').'
	} else if (!document.getElementById("featuredcategory_enabled").checked) {
		
		document.getElementById("listing_featuredcategory_enabled").disabled = true;
		document.getElementById("listing_featuredcategory_enabled").checked = false;
		'.(EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on" ? '
		document.getElementById("event_featuredcategory_enabled").disabled = true;
		document.getElementById("event_featuredcategory_enabled").checked = false;
		':'').'
		'.(CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on" ? '
		document.getElementById("classified_featuredcategory_enabled").disabled = true;
		document.getElementById("classified_featuredcategory_enabled").checked = false;
		':'').'
		'.(ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on" ? '
		document.getElementById("article_featuredcategory_enabled").disabled = true;
		document.getElementById("article_featuredcategory_enabled").checked = false;
		':'').'	
	}
}

function verifyExistsPopCateg() {	
	flag_listing = $("#listing_featuredcategory_enabled").is(":checked");
	'.(EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on" ? 'flag_event = $("#event_featuredcategory_enabled").is(":checked");':'').'
	'.(CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on" ? 'flag_classified = $("#classified_featuredcategory_enabled").is(":checked");':'').'
	'.(ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on" ? 'flag_article = $("#article_featuredcategory_enabled").is(":checked");':'').'
	if (!(flag_listing'.(EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on" ? '||flag_event':'').''.(CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on" ? '||flag_classified':'').''.(ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on" ? '||flag_article':'').')) {

		document.getElementById("featuredcategory_enabled").checked=false;
		check_featuredcategory();
	}	
}

function startChecks() {
	if (!document.getElementById("featuredcategory_enabled").checked) {
		document.getElementById("listing_featuredcategory_enabled").disabled = true;
		'.(EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on" ? '
		document.getElementById("event_featuredcategory_enabled").disabled = true;
		':'').'
		'.(CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on" ? '
		document.getElementById("classified_featuredcategory_enabled").disabled = true;
		':'').'
		'.(ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on" ? '
		document.getElementById("article_featuredcategory_enabled").disabled = true;
		':'').'	
	}	
};		
 -->
</script>
';

?>
<? if ($message_featuredcategory_admin) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_featuredcategory_admin?>
	</div>
<? } ?>

<br />

<table cellpadding="2" cellspacing="0" border="0" class="table-form">
	
	<tr class="tr-form">
		<td align="left" class="td-form">
			<input type="checkbox" name="featuredcategory_enabled" id="featuredcategory_enabled" value="on" <?=$featuredcategory_enabled_checked?>  class="inputCheck" onclick="check_featuredcategory()" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="featuredcategory_enabled"><?=system_showText(LANG_SITEMGR_SETTINGS_FEATUREDCATEGORIES_CHECKTHISBOXTOENABLE)?></label></div>
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="left" class="td-form">
			<input type="checkbox" name="listing_featuredcategory_enabled" id="listing_featuredcategory_enabled" value="on" <?=$listing_featuredcategory_enabled_checked?>  class="inputCheck" onclick="verifyExistsPopCateg();" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="listing_featuredcategory_enabled"><?=system_showText(string_ucwords(LANG_SITEMGR_LISTING))?></label></div>
		</td>
	</tr>
	<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
		<tr class="tr-form">
			<td align="left" class="td-form">
				<input type="checkbox" name="event_featuredcategory_enabled" id="event_featuredcategory_enabled" value="on" <?=$event_featuredcategory_enabled_checked?>  class="inputCheck" onclick="verifyExistsPopCateg();" />
			</td>
			<td>
				<div class="label-form" align="left"><label for="event_featuredcategory_enabled"><?=system_showText(string_ucwords(LANG_SITEMGR_EVENT))?></label></div>
			</td>
		</tr>
	<? } ?>	
	<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
		<tr class="tr-form">
			<td align="left" class="td-form">
				<input type="checkbox" name="classified_featuredcategory_enabled" id="classified_featuredcategory_enabled" value="on" <?=$classified_featuredcategory_enabled_checked?>  class="inputCheck" onclick="verifyExistsPopCateg();" />
			</td>
			<td>
				<div class="label-form" align="left"><label for="classified_featuredcategory_enabled"><?=system_showText(string_ucwords(LANG_SITEMGR_CLASSIFIED))?></label></div>
			</td>
		</tr>
	<? } ?>	
	<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
		<tr class="tr-form">
			<td align="left" class="td-form">
				<input type="checkbox" name="article_featuredcategory_enabled" id="article_featuredcategory_enabled" value="on" <?=$article_featuredcategory_enabled_checked?>  class="inputCheck" onclick="verifyExistsPopCateg();" />
			</td>
			<td>
				<div class="label-form" align="left"><label for="article_featuredcategory_enabled"><?=system_showText(string_ucwords(LANG_SITEMGR_ARTICLE))?></label></div>
			</td>
		</tr>
	<? } ?>	
	
</table>
<script type="text/javascript">	
	startChecks();
</script>
