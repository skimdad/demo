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
	# * FILE: /includes/forms/form_import.php
	# ----------------------------------------------------------------------------------------------------

	$modules = array("listing", "event", "classified", "article", "banner");
?>
	<br />

	<input type="hidden" id="settingSection" name="settingSection" value="<?=!$settingSection? $modules[0]."_setting_title": $settingSection; ?>"/>
	
<? if ($message_approval_options) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_approval_options?>
	</div>
<? } ?>
	
	<table id="listing_setting_title" onclick="showSettings(this.id);" class="standard-table">
	<tr class="standard-tabletitle-parent">
		<th class="standard-tabletitle">
			<?=LANG_SITEMGR_APPROVE_LISTING?>
		</th>
	</tr>
	</table>

	<div id="listing_setting" class="defaultItems">
		<table class="standard-table left-table">
			<tr>
				<td colspan="2">
					<strong><?=LANG_SITEMGR_MUST_APPROVE?></strong>
				</td>
				<td colspan="2">
					<strong><?=LANG_SITEMGR_WILL_RECEIVE?></strong>
				</td>
			</tr>
			<tr>
				<th>
					<input type="checkbox" id="listing_approve_paid" name="listing_approve_paid"  value="on" <?=$listing_approve_paid_checked?> align="absmiddle" class="inputCheck" />
				</th>
				<td align="left" class="td-form">
					<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_LISTING_AFTER_PAYMENT)?></div>
				</td>
				<th>
					<input type="checkbox" id="new_listing_email" name="new_listing_email"  value="on" <?=$new_listing_email_checked?> align="absmiddle" class="inputCheck" />
				</th>
				<td align="left" class="td-form">
					<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_NEW_ONLY_LISTING)?></div>
				</td>
			</tr>
			<tr>
				<th>
					<input type="checkbox" id="listing_approve_free" name="listing_approve_free"  value="on" <?=$listing_approve_free_checked?> align="absmiddle" class="inputCheck" />
				</th>
				<td align="left" class="td-form">
					<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_FREE_ONLY_LISTING)?></div>
				</td>
				<th>
					<input type="checkbox" id="update_listing_email" name="update_listing_email"  value="on" <?=$update_listing_email_checked?> align="absmiddle" class="inputCheck" />
				</th>
				<td align="left" class="td-form">
					<div class="label-form"><?=ucfirst(system_showText(LANG_SITEMGR_APPROVE_UPDATED_ONLY_LISTING))?></div>
				</td>
			</tr>
			<tr>
				<th>
					<input type="checkbox" id="listing_approve_updated" name="listing_approve_updated"  value="on" <?=$listing_approve_updated_checked?> align="absmiddle" class="inputCheck" />
				</th>
				<td align="left" class="td-form">
					<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_UPDATED_ONLY_LISTING)?></div>
				</td>
			</tr>
		</table>
	</div>

	<? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>

		<table  id="banner_setting_title" onclick="showSettings(this.id);" class="standard-table">
			<tr class="standard-tabletitle-parent">
				<th class="standard-tabletitle">
					<?=LANG_SITEMGR_APPROVE_BANNER?>
				</th>
			</tr>
		</table>

		<div id="banner_setting" class="defaultItems">
			<table class="standard-table left-table">
				<tr class="standard-tabletitle-parent">
					<td colspan="2">
						<strong><?=LANG_SITEMGR_MUST_APPROVE?></strong>
					</td>
					<td colspan="2">
						<strong><?=LANG_SITEMGR_WILL_RECEIVE?></strong>
					</td>
				</tr>
				<tr>
					<th>
						<input type="checkbox" id="banner_approve_paid" name="banner_approve_paid"  value="on" <?=$banner_approve_paid_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_BANNER_AFTER_PAYMENT)?></div>
					</td>
					<th>
						<input type="checkbox" id="new_banner_email" name="new_banner_email"  value="on" <?=$new_banner_email_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_NEW_ONLY_BANNER)?></div>
					</td>
				</tr>
				<tr>
					<th>
						<input type="checkbox" id="banner_approve_free" name="banner_approve_free"  value="on" <?=$banner_approve_free_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_FREE_ONLY_BANNER)?></div>
					</td>
					<th>
						<input type="checkbox" id="update_banner_email" name="update_banner_email"  value="on" <?=$update_banner_email_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=ucfirst(system_showText(LANG_SITEMGR_APPROVE_UPDATED_ONLY_BANNER))?></div>
					</td>
				</tr>
				<tr>
					<th>
						<input type="checkbox" id="banner_approve_updated" name="banner_approve_updated"  value="on" <?=$banner_approve_updated_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_UPDATED_ONLY_BANNER)?></div>
					</td>
				</tr>
			</table>
		</div>
	<? } ?>

	<?
	if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>

		<table  id="event_setting_title" onclick="showSettings(this.id);" class="standard-table">
			<tr class="standard-tabletitle-parent">
				<th class="standard-tabletitle">
					<?=LANG_SITEMGR_APPROVE_EVENT?>
				</th>
			</tr>
		</table>

		<div id="event_setting" class="defaultItems">
			<table class="standard-table left-table">
				<tr>
					<td colspan="2">
						<strong><?=LANG_SITEMGR_MUST_APPROVE?></strong>
					</td>
					<td colspan="2">
						<strong><?=LANG_SITEMGR_WILL_RECEIVE?></strong>
					</td>
				</tr>
				<tr>
					<th>
						<input type="checkbox" id="event_approve_paid" name="event_approve_paid"  value="on" <?=$event_approve_paid_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_EVENT_AFTER_PAYMENT)?></div>
					</td>
					<th>
						<input type="checkbox" id="new_event_email" name="new_event_email"  value="on" <?=$new_event_email_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=ucfirst(system_showText(LANG_SITEMGR_APPROVE_NEW_ONLY_EVENT))?></div>
					</td>
				</tr>
				<tr>
					<th>
						<input type="checkbox" id="event_approve_free" name="event_approve_free"  value="on" <?=$event_approve_free_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_FREE_ONLY_EVENT)?></div>
					</td>
					<th>
						<input type="checkbox" id="update_event_email" name="update_event_email"  value="on" <?=$update_event_email_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=ucfirst(system_showText(LANG_SITEMGR_APPROVE_UPDATED_ONLY_EVENT))?></div>
					</td>
				</tr>
				<tr>
					<th>
						<input type="checkbox" id="event_approve_updated" name="event_approve_updated"  value="on" <?=$event_approve_updated_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_UPDATED_ONLY_EVENT)?></div>
					</td>
				</tr>
			</table>
		</div>
	<? } ?>

	<?
	if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>

		<table id="classified_setting_title" onclick="showSettings(this.id);" class="standard-table">
			<tr class="standard-tabletitle-parent">
				<th class="standard-tabletitle">
					<?=LANG_SITEMGR_APPROVE_CLASSIFIED?>
				</th>
			</tr>
		</table>

		<div id="classified_setting" class="defaultItems">
			<table class="standard-table left-table">
				<tr>
					<td colspan="2">
						<strong><?=LANG_SITEMGR_MUST_APPROVE?></strong>
					</td>
					<td colspan="2">
						<strong><?=LANG_SITEMGR_WILL_RECEIVE?></strong>
					</td>
				</tr>
				<tr>
					<th>
						<input type="checkbox" id="classified_approve_paid" name="classified_approve_paid"  value="on" <?=$classified_approve_paid_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_CLASSIFIED_AFTER_PAYMENT)?></div>
					</td>
					<th>
						<input type="checkbox" id="new_classified_email" name="new_classified_email"  value="on" <?=$new_classified_email_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=ucfirst(system_showText(LANG_SITEMGR_APPROVE_NEW_ONLY_CLASSIFIED))?></div>
					</td>
				</tr>
				<tr>
					<th>
						<input type="checkbox" id="classified_approve_free" name="classified_approve_free"  value="on" <?=$classified_approve_free_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_FREE_ONLY_CLASSIFIED)?></div>
					</td>
					<th>
						<input type="checkbox" id="update_classified_email" name="update_classified_email"  value="on" <?=$update_classified_email_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=ucfirst(system_showText(LANG_SITEMGR_APPROVE_UPDATED_ONLY_CLASSIFIED))?></div>
					</td>
				</tr>
				<tr>
					<th>
						<input type="checkbox" id="classified_approve_updated" name="classified_approve_updated"  value="on" <?=$classified_approve_updated_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_UPDATED_ONLY_CLASSIFIED)?></div>
					</td>
				</tr>
			</table>
		</div>
	<? } ?>

	<?
	if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>

		<table id="article_setting_title" onclick="showSettings(this.id);" class="standard-table">
			<tr class="standard-tabletitle-parent">
				<th class="standard-tabletitle">
					<?=LANG_SITEMGR_APPROVE_ARTICLE?>
				</th>
			</tr>
		</table>

		<div id="article_setting" class="defaultItems">
			<table class="standard-table left-table">
				<tr>
					<td colspan="2">
						<strong><?=LANG_SITEMGR_MUST_APPROVE?></strong>
					</td>
					<td colspan="2">
						<strong><?=LANG_SITEMGR_WILL_RECEIVE?></strong>
					</td>
				</tr>
				<tr>
					<th>
						<input type="checkbox" id="article_approve_paid" name="article_approve_paid"  value="on" <?=$article_approve_paid_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_ARTICLE_AFTER_PAYMENT)?></div>
					</td>
					<th>
						<input type="checkbox" id="new_article_email" name="new_article_email"  value="on" <?=$new_article_email_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=ucfirst(system_showText(LANG_SITEMGR_APPROVE_NEW_ONLY_ARTICLE))?></div>
					</td>
				</tr>
				<tr>
					<th>
						<input type="checkbox" id="article_approve_free" name="article_approve_free"  value="on" <?=$article_approve_free_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_FREE_ONLY_ARTICLE)?></div>
					</td>
					<th>
						<input type="checkbox" id="update_article_email" name="update_article_email"  value="on" <?=$update_article_email_checked?> align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=ucfirst(system_showText(LANG_SITEMGR_APPROVE_UPDATED_ONLY_ARTICLE))?></div>
					</td>
				</tr>
				<tr>
					<th>
						<input type="checkbox" id="article_approve_updated" name="article_approve_updated"  value="on" <?=$article_approve_updated_checked?>  align="absmiddle" class="inputCheck" />
					</th>
					<td align="left" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_APPROVE_UPDATED_ONLY_ARTICLE)?></div>
					</td>
				</tr>
			</table>
		</div>
		<div class="divisor"></div>
	<? } ?>

			
<script type="text/javascript">
	function showSettings(id){
		var modules = '<?=implode(",", $modules);?>';
		modules = modules.split(",");
		var click = "#" + id;
		click = click.substr(0, (click.length - 6));
		var mod = "";
		for(var i = 0; i < modules.length; i++){
			mod = "#" + modules[i] + "_setting";
			if (mod != click) {
				if($(mod).css("display") != "none"){
					$(mod).hide('blind','', 500);
				}
				$(mod + "_title").css('cursor', 'pointer');
				$(mod + "_title tr th").removeClass('active');
				$(mod + "_span").fadeTo("slow", 0);
			} else {
				if($(click).css("display") == "none"){
					$(click).show('blind','', 500);
				}
				$(mod + "_title tr th").addClass('active');
				$("#" + id).css('cursor', '');
				$(click + "_span").fadeTo("slow", 1);
				$("#settingSection").val(id);
			}
		}
	}

	function manageAll(id){
		var check = "";
		if($("#" + id).hasClass('checked')){
			$("#" + id).addClass('unchecked');
			$("#" + id).removeClass('checked');
			check = false;
		} else {
			$("#" + id).addClass('checked');
			$("#" + id).removeClass('unchecked');
			check = true;
		}
		var click = "#" + id;
		click = click.substr(0, (click.length - 6));
		$(click).find('input[type=checkbox]').attr("checked", check);
	}

	showSettings($("#settingSection").val());
</script>