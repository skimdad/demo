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
    # * FILE: /includes/forms/form_faq_settings.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # FORM
    # ----------------------------------------------------------------------------------------------------

?>

    <p class="errorMessage" id="jMessage" style="display:none;"></p>
    <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th colspan="7" class="standard-tabletitle"><?=system_showText(LANG_LABEL_NEW_FAQ)?></th>
		</tr>
        <tr>
            <th>
                <?=system_showText(LANG_SITEMGR_SETTINGS_FAQ_QUESTION)?>        
            </th>
            <td colspan="6">
                <textarea name="faq_question" id="faq_question" rows="5"></textarea> 
            </td>
        </tr>
        <tr>
            <th>
                <?=system_showText(LANG_SITEMGR_SETTINGS_FAQ_ANSWER)?>        
            </th>
            <td colspan="6">
                <textarea name="faq_answer" id="faq_answer" rows="5"></textarea> 
            </td>
        </tr>
        <tr>
            <th class="wrap">
                <?=system_showText(LANG_SITEMGR_LABEL_SECTION)?>        
            </th>
            <td class="td-checkbox"><input type="checkbox" name="faq_section_front" class="inputCheck" /></td>
            <td><?=system_showText(LANG_SITEMGR_FRONT)?></td>
            <td class="td-checkbox"><input type="checkbox" name="faq_section_members" class="inputCheck" /></td>
            <td><?=system_showText(LANG_SITEMGR_MEMBERS)?></td>
            <td class="td-checkbox"><input type="checkbox" name="faq_section_sitemgr" class="inputCheck" /></td>
            <td><?=system_showText(LANG_SITEMGR_SITEMGR)?></td>
        </tr>
    </table>
    <table style="margin: 0 auto 0 auto;" align="center" border="0" cellpadding="0" cellspacing="3">
		<tr>
			<td><button type="submit" name="FAQ_post_submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button></td>
			<td><button type="button" name="cancel" class="input-button-form" value="Cancel" onclick="document.getElementById('formfaqcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button></td>
		</tr>
    </table>
		


<?

