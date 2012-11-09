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
	# * FILE: /includes/forms/form_listing_extra_fields.php
	# ----------------------------------------------------------------------------------------------------

	if ($templateObj && $templateObj->getString("status")=="enabled") {
		$template_fields = $templateObj->getListingTemplateFields();
        $themeTemplate = false;
        if (USING_THEME_TEMPLATE && $templateObj->getNumber("id") == THEME_TEMPLATE_ID){
            $themeTemplate = true;
        }
		if ($template_fields!==false) {
			?>
			<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
				<tr>
					<th colspan="2" class="standard-tabletitle"><?=($themeTemplate ? system_showText(LANG_TEMPLATE_AMENITIES) : system_showText(LANG_EXTRA_FIELDS));?></th>
				</tr>
				<?				
				foreach ($template_fields as $row) {
					$row["form_value"] = $row["field"];
					template_CreateDynamicField($row, $themeTemplate); 					
				}				
				?>
			</table>
			<?
		}
	}

?>
