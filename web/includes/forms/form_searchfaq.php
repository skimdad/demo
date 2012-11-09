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
	# * FILE: /includes/forms/form_searchfaq.php
	# ----------------------------------------------------------------------------------------------------

?>


<table border="0" cellpadding="2" cellspacing="2" class="standard-table" style="margin-top: 0;">					<tr>
	<tr>
		<th>
			<?=system_showText(LANG_SITEMGR_LABEL_KEYWORDS)?>:
		</th>
		<td>
			<input type="text" name="keyword" value="<?=$keyword?>" maxlength="100" />
		</td>
	</tr>
</table>
