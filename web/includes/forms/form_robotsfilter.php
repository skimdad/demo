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
    # * FILE: /includes/forms/form_robotsfilter.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # FORM DEFINES
    # ----------------------------------------------------------------------------------------------------
    $robots_list = "";
    $robotsObj = new RobotsFilter();
    $array = $robotsObj->retrieveAll();
    if (is_array($array)) $robots_list = implode("\n", $array);
    
    # ----------------------------------------------------------------------------------------------------
?>

<div class="header-form">
    <?=system_showText(LANG_SITEMGR_SETTINGS_ROBOTS)?>
</div>

<? if ($message_robotsfilter) { ?>
    <div id="warning" class="<?=$message_style?>">
        <?=$message_robotsfilter?>
    </div>
<? } ?>

<table cellpadding="0" cellspacing="0" border="0" class="table-form" width="100%">
    <tr align="center" class="tr-form">                                          
        <td align="right" class="td-form" width="22%">
        <?=system_showText(LANG_SITEMGR_SETTINGS_ROBOTS_LIST)?>:
        </td>
        <td align="left" class="td-form" width="78%">
            <textarea name="robots_list" id="robots_list" rows="5"><?=$robots_list?></textarea>
            <p><span><?=system_showText(LANG_SITEMGR_SMACCOUNT_TIP1)?></span></p>
            <p><span><?=system_showText(LANG_SITEMGR_SMACCOUNT_TIP4)?></span></p>
        </td>
    </tr>
</table>
