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
	# * FILE: /includes/forms/form_export_payment.php
	# ----------------------------------------------------------------------------------------------------

	list($month, $day, $year) = explode("/",date(((EDIR_LANGUAGE == 'en_us') ? "m/d/Y" : "d/m/Y"), mktime(0, 0, 0, date("m"), date("d"), date("Y"))));
	$date_start = implode("/", array($month, $day, $year-1));
	$date_end = implode("/", array($month, $day, $year));
?>

<? if ($message_export_payment) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_export_payment?>
	</div>
<? } ?>

<?  // Account Search Javascript /////////////////////////////////////////////////////// ?>

<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>

<?  // Account Search ////////////////////////////////////////////////////////////////// ?>

	<?
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT_DEFAULT);
	$acct_search_field_name = "account_id";
	$acct_search_field_value = $account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "95%";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width);
	echo $return;
	?>


<?  //////////////////////////////////////////////////////////////////////////////////// ?>
<table cellpadding="2" cellspacing="2" border="0" align="center" style="width: 520px; margin-top: 10px;" class="table-form">
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form"><?=system_showText(LANG_SITEMGR_LABEL_STARTDATE)?>:</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="date_start" id="date_start" value="<?=$_POST["date_start"] ? $_POST["date_start"]: $date_start?>" maxlength="10" style="width:70px" />
		</td>
	</tr>
	<tr>
		<td align="right" class="td-form">
			<div class="label-form"><?=system_showText(LANG_SITEMGR_LABEL_ENDDATE)?>:</div>
		</td>
		<td align="left" class="td-form">      
			<input type="text" name="date_end" id="date_end" value="<?=$_POST["date_end"] ? $_POST["date_end"]: $date_end?>" maxlength="10" style="width:70px" />
		</td>
	</tr>
	<tr>
		<td align="right"><div class="label-form"><?=system_showText(LANG_SITEMGR_EXPORT_RECORDTYPE)?>:</div></td>
		<td colspan=2 nowrap>
			<table cellpadding=0 cellspacing=0 border="0" align="left">
				<tr>
					<td align="right" class="td-form" width=10>
						<input type="radio" name="type" value="invoice" <?=$type_invoice?> class="inputCheck" />
					</td>
					<td nowrap><div class="label-form"><?=system_showText(LANG_SITEMGR_EXPORT_INVOICERECORDS)?></div></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan=2 nowrap>
			<table cellpadding=0 cellspacing=0 border="0" align="left">
				<tr>
					<td align="left" class="td-form" width=10>
						<input type="radio" name="type" value="payment" <?=$type_online?> class="inputCheck" />
					</td>
					<td nowrap><div class="label-form"><?=system_showText(LANG_SITEMGR_EXPORT_TRANSACTIONRECORDS)?></div></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="right"><div class="label-form"><?=system_showText(LANG_SITEMGR_EXPORT_DELIMITER)?>:</div></td>
		<td colspan=2 nowrap>
			<table cellpadding=0 cellspacing=0 border="0" align="left">
				<tr>
					<td align="right" class="td-form" width=10>
						<input type="radio" name="delimiter" value="semicolon" class="inputCheck" />
					</td>
					<td nowrap><div class="label-form">[ ; ] - <?=system_showText(LANG_SITEMGR_EXPORT_SEMICOLON)?></div></td>
					<td align="right" class="td-form" width=10>
						<input type="radio" name="delimiter" value="comma" checked="checked" class="inputCheck" />
					</td>
					<td nowrap><div class="label-form">[ , ] - <?=system_showText(LANG_SITEMGR_EXPORT_COMMA)?></div></td>
				</tr>
			</table>
		</td>
	</tr>
</table>