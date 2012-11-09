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
	# * FILE: /includes/forms/form_blogsettings.php
	# ----------------------------------------------------------------------------------------------------

?>


<div class="header-form"><?=string_ucwords(system_showText(LANG_SITEMGR_LABEL_CHANGE_POST_STATUS))?> - <?=$postObj->getString("title")?></div>

<? if ($message_postsettings) { ?>
	<div id="warning" class="errorMessage"><?=$message_postsettings?></div>
<? } ?>


<table cellpadding="2" cellspacing="0" class="table-form table-form-settings table-form-margin">

	<tr class="tr-form">
		<td align="right" class="td-title-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_STATUS)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<?=$statusDropDown?>
		</td>
	</tr>

</table>
