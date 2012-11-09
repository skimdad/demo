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
	# * FILE: /includes/forms/form_searchclassified.php
	# ----------------------------------------------------------------------------------------------------

?>

<? // Account Search Javascript /////////////////////////////////////////////////////////////////////// ?>
<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>
<? //////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<? if ($message_searchclassified) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_searchclassified?>
	</div>
<? } ?>

<? // Account Search ////////////////////////////////////////////////////////////////////////////////// ?>
<?
if (!$user) {
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT_DEFAULT);
	$acct_search_field_name = "search_account_id";
	$acct_search_field_value = $search_account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "95%";
	$acct_search_cell_width = "";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width);
	echo $return;
}
?>
<? //////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table noMargin">
	<tr>
		<th>&nbsp;</th>
		<td><input type="checkbox" value="1" name="search_no_owner" <?=($search_no_owner==1) ? "checked" : "";?> class="inputAlign" /><?=system_showText(LANG_SITEMGR_NOOWNER)?><span><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER_INFO)?></span></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_SEARCHKEYWORD)?>:</th>
		<td><input type="text" name="search_title" value="<?=$search_title?>" class="input-form-searchclassifieds" /></td>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LEVEL)?>:</th>
		<td>
			<table>
				<tr>
					<?
					$level = new ClassifiedLevel();
					$levelvalues = $level->getLevelValues();
					foreach ($levelvalues as $levelvalue) {
						?>
						<td class="td-checkbox"><input type="radio" name="search_level" value="<?=$levelvalue?>" <? if ($search_level == $levelvalue) echo "checked"; ?> class="inputCheck" /></td>
						<td><span class="label-field-form"><?=$level->showLevel($levelvalue)?></span></td>
						<?
					}
					?>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th><?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?>:</th>
		<td><?=$categoryDropDown?></td>
	</tr>

	<? if (!$user) { ?>
		<tr>
			<th><?=system_showText(LANG_SITEMGR_STATUS)?>:</th>
			<td><?=$statusDropDown?></td>
		</tr>
	<? } ?>

	<? if ( PAYMENTSYSTEM_FEATURE == 'on' ) { ?>
		<tr>
			<th class="alignTop"><?=system_showText(LANG_SITEMGR_LABEL_EXPIRATION)?>: </th>
			<td>
			<input type="text" name="search_expiration_date" id="search_expiration_date" value="<?=$search_expiration_date?>" style="width:80px;" maxlength="10" />
			&nbsp;
			<input type="radio" name="search_opt_expiration_date" value="1" class="inputCheck" <?php if (!isset($search_opt_expiration_date) || intval($search_opt_expiration_date) == 1) { echo "checked"; } ?> />
			&nbsp;<?=system_showText(LANG_SITEMGR_LABEL_EXPIRATION_OPT1)?>&nbsp; <?=system_showText(LANG_SITEMGR_LABEL_OR)?> &nbsp;
			<input type="radio" name="search_opt_expiration_date" value="2" class="inputCheck" <?php if (intval($search_opt_expiration_date) == 2) { echo "checked"; } ?> />
			&nbsp;
			<?=system_showText(LANG_SITEMGR_LABEL_EXPIRATION_OPT2)?>
			<span>(<?=format_printDateStandard()?>)</span>
			</td>
		</tr>
		<tr>
			<th><?=string_ucwords(LANG_LABEL_DISCOUNTCODE)?>:</th>
			<td><input type="text" name="search_discount" value="<?=$search_discount?>" maxlength="10" class="input-form-searchclassifieds" /></td>
		</tr>
	<? } else echo "<input type=\"hidden\" name=\"search_expiration_date\"" ?>
</table>

<?
$contact = true;
include(EDIRECTORY_ROOT."/includes/code/load_location.php");
?>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th><?=string_ucwords(ZIPCODE_LABEL)?>:</th>
		<td><input type="text" name="search_zipcode" value="<?=$search_zipcode?>" maxlength="10" class="input-form-searchclassifieds" /></td>
	</tr>
	
</table>