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
	# * FILE: /includes/forms/form_searchpackage.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if ($message_searchpackage) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_searchpackage?>
	</div>
<? } ?>


<table border="0" cellpadding="2" cellspacing="0" class="standard-table" style="margin-top: 15px;">
	<tr>
		<th>
			<?=system_showText(LANG_LABEL_SEARCHKEYWORD)?>:
		</th>
		<td>
			<input type="text" name="search_title" value="<?=$search_title?>" class="input-form-searcharticles" />
		</td>
	</tr>

	<tr>
		<th>
			<?=system_showText(LANG_SITEMGR_STATUS)?>:
		</th>
		<td>
			<?=$statusDropDown?>
		</td>
	</tr>
	
</table>