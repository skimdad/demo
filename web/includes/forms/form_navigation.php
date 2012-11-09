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
    # * FILE: /includes/forms/form_navigation.php
    # ----------------------------------------------------------------------------------------------------

?>

	<table border="0" cellspacing="0" cellpadding="0" class="standard-table">
		<tr>
			<th class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_AVAILABLE_MODULES)?></th>
		</tr>
	</table>
	
    <div class="graphicModules">
    	<div class="logoHeader">&nbsp;</div>
        <div class="includeHeader">
			<a id="linktoHeader" href="javascript:void(0);" class="iframe fancy_window_navigation">
				<?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_HEADERNAV)?> - <?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_HEADERNAV_CLICK_TO_EDIT)?>
			</a>
		</div>
        
        <? if (THEME_HAS_FOOTER) { ?>
		
    	<div class="includeFooter">
			<a id="linktoFooter" href="javascript:void(0);" class="iframe fancy_window_navigation">
				<?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_FOOTERNAV)?> - <?=system_showText(LANG_SITEMGR_MENUCONFIG_MC_FOOTERNAV_CLICK_TO_EDIT)?>
			</a>
		</div>
        
        <? } ?>
    </div>

	<script type="text/javascript" charset="utf8">
		$(document).ready(function() {
			$("#linktoHeader").attr("href","<?=DEFAULT_URL?>/sitemgr/content/navigation_popup.php?navbarType=header");
			$("#linktoFooter").attr("href","<?=DEFAULT_URL?>/sitemgr/content/navigation_popup.php?navbarType=footer");

			<? if ($_SESSION["restoreNavbar"] == "header" && !DEMO_LIVE_MODE){?>
				$("#linktoHeader").trigger("click");
			<? } else if ($_SESSION["restoreNavbar"] == "footer" && !DEMO_LIVE_MODE){?>
				$("#linktoFooter").trigger("click");
			<? } 
			unset($_SESSION["restoreNavbar"]);
			?>
		});
	</script>