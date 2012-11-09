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
	# * FILE: /layout/themenavbar.php
	# ----------------------------------------------------------------------------------------------------

	if (DEMO_LIVE_MODE) {

        unset($edir_themes);
		unset($edir_themenames);
        unset($edir_schemes);
		unset($edir_schemenames);
        
        //Themes
		$edir_themes = explode(",", EDIR_THEMES);
		$edir_themenames = explode(",", EDIR_THEMENAMES);
        
        //Schemes
        $edir_schemes = explode(",", EDIR_SCHEMES);
		$edir_schemenames = explode(",", EDIR_SCHEMENAMES);
        
		if (count($edir_themes)>1) {
			$destiny=system_denyInjections($_SERVER["PHP_SELF"]);
			$query=system_denyInjections($_SERVER["QUERY_STRING"]);
        ?>
			<div class="theme">
				<select name="theme_id" id="theme_id" onchange="Redirect(this.value)">
					<option value=""><?=system_showText(LANG_MENU_CHOOSETHEME)?></option>
					<?
					$edir_i = 0;
					for ($edir_i=0; $edir_i<count($edir_themes); $edir_i++) {
						if ($edir_themes[$edir_i] != "custom"){
							$selected = (EDIR_THEME == $edir_themes[$edir_i]) ? "selected" : "";
							?><option <?=$selected?> value="<?=NON_SECURE_URL;?>/settheme.php?theme=<?=$edir_themes[$edir_i];?>&amp;destiny=<?=system_denyInjections($_SERVER["PHP_SELF"]);?>&amp;query=<?=system_denyInjections(string_htmlentities($_SERVER["QUERY_STRING"]));?>"><?=$edir_themenames[$edir_i]?></option><?
							unset($selected);
						}
					}
					?>
					<option value="http://www.edirectory.com/edirectory-themes.php"><?=system_showText(ucfirst(LANG_MORE))?>&raquo;</option>
				</select>
			<? if (count($edir_schemes) < 1) { ?>
               </div> 
            <? } ?>    

			<?
		}
		
		if (count($edir_schemes)>1) {
			$destiny=system_denyInjections($_SERVER["PHP_SELF"]);
			$query=system_denyInjections($_SERVER["QUERY_STRING"]);
        ?>
			<? if (count($edir_themes) < 1) { ?>
               <div class="theme">
            <? } ?>   
				<select name="theme_id" id="theme_id" onchange="Redirect(this.value)">
					<option value=""><?=system_showText(LANG_MENU_CHOOSESCHEME)?></option>
					<?
					$edir_i = 0;
					for ($edir_i=0; $edir_i<count($edir_schemes); $edir_i++) {
						if ($edir_schemes[$edir_i] != "custom"){
							$selected = (EDIR_SCHEME == $edir_schemes[$edir_i]) ? "selected" : "";
							?><option <?=$selected?> value="<?=NON_SECURE_URL;?>/settheme.php?theme=<?=$edir_schemes[$edir_i];?>&amp;changeScheme=true&amp;destiny=<?=system_denyInjections($_SERVER["PHP_SELF"]);?>&amp;query=<?=system_denyInjections(string_htmlentities($_SERVER["QUERY_STRING"]));?>"><?=$edir_schemenames[$edir_i]?></option><?
							unset($selected);
						}
					}
					?>
					<option value="http://www.edirectory.com/edirectory-themes.php"><?=system_showText(ucfirst(LANG_MORE))?>&raquo;</option>
				</select>
			</div>

			<?
		}
        
        unset($edir_themes);
		unset($edir_themenames);
		unset($edir_schemes);
		unset($edir_schemenames);
	}
	?>