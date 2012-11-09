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
	# * FILE: /layout/langnavbar.php
	# ----------------------------------------------------------------------------------------------------

	unset($edir_languages);
	unset($edir_languagenames);
	$edir_languages = explode(",", EDIR_LANGUAGES);
	$edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
	
	if (count($edir_languages)>1) {
		?>		
		<div class="language">
			
				<?
				$edir_i = 0;
				for ($edir_i=0; $edir_i<count($edir_languages); $edir_i++) {
					$langParts = explode("_", $edir_languages[$edir_i]);
					/*
					 * CR 64267
					 * Remove this if/else sentence below and set $auxlangLink with "/" if you want to restore the language from the cookie value
					 */
					if ($edir_languages[$edir_i] == EDIR_DEFAULT_LANGUAGE){
						$langParts[0] = "";
						$auxlangLink = "";
					} else {
						$auxlangLink = "/";
					}
					
					if (MODREWRITE_FEATURE == "on" && $_GET["url_full"] && SERVER_TYPE != "WIN") {
						$destiny_friendly = system_denyInjections(str_replace("/".EDIR_LANGUAGEABBREVIATION."/", "/", $_GET["url_full"]));
                        if (EDIRECTORY_FOLDER){
                            $destiny_friendly = str_replace(EDIRECTORY_FOLDER."/", "/", $destiny_friendly);
                        }
						$langLink = NON_LANG_URL.$auxlangLink.$langParts[0].$destiny_friendly;
					} else {						
						if (MODREWRITE_FEATURE == "on" && SERVER_TYPE != "WIN") {
							$aux_rurl = system_denyInjections(str_replace("/".EDIR_LANGUAGEABBREVIATION."/", "/", $_SERVER["REDIRECT_URL"]));
							$aux_ruri = system_denyInjections(str_replace("/".EDIR_LANGUAGEABBREVIATION."/", "/", $_SERVER["REQUEST_URI"]));
							
							$aux_rurl = str_replace(EDIRECTORY_FOLDER."/","/",$aux_rurl);
							$aux_ruri = str_replace(EDIRECTORY_FOLDER."/","/",$aux_ruri);
							
							$aux_ques = "";
							if ($aux_rurl != $aux_ruri && string_htmlentities(system_denyInjections($_SERVER["QUERY_STRING"]))) {
								$aux_ques = "?".string_htmlentities(system_denyInjections($_SERVER["QUERY_STRING"]));
								$langLink = NON_LANG_URL.$auxlangLink.$langParts[0].str_replace(EDIRECTORY_FOLDER, "", $_SERVER["PHP_SELF"]).$aux_ques;
							} else {
								$langLink = NON_LANG_URL.$auxlangLink.$langParts[0].$aux_ruri;
							}
						} else {
							if ($_GET["url_full"] && SERVER_TYPE == "WIN"){
								$aux_lang = $edir_languages[$edir_i];
								$aux_dest = string_htmlentities(system_denyInjections(str_replace("url_full=/", "", $_SERVER["QUERY_STRING"])));
								$langLink = NON_SECURE_URL."/setlanguage.php?lang=".$aux_lang."&amp;destiny=".$aux_dest."&amp;url1full=true";
							} else {
								$aux_lang = $edir_languages[$edir_i];
								$aux_dest = system_denyInjections($_SERVER["PHP_SELF"]);
								$aux_ques = string_htmlentities(system_denyInjections($_SERVER["QUERY_STRING"]));
								$langLink = NON_SECURE_URL."/setlanguage.php?lang=".$aux_lang."&amp;destiny=".$aux_dest."&amp;query=".$aux_ques;
							}
						}
					}
					$imgSrc = DEFAULT_URL."/lang/flag/".$edir_languages[$edir_i].".gif";
					$langName = $edir_languagenames[$edir_i];
					if (EDIR_LANGUAGE == $edir_languages[$edir_i]) {
						$imgClass = "class=\"flagActive\"";
					} else {
						$imgClass = "";
					}						
					?>
					<a href="<?=$langLink?>" title="<?=$langName?>"><img width="14" height="11" <?=$imgClass;?> src="<?=$imgSrc;?>" alt="<?=$langName;?>" /></a>
					<?
				}

				unset($edir_i);
				?>

			<? if ( DEMO_MODE ) { ?>
			<a href="javascript:void(0);" id="all-languages-button">
				<?=system_showText(string_ucwords(LANG_MORE)); ?>
			</a>
			<? } ?>
			
		<?
		
		if ( DEMO_MODE ) { ?>
		
			<div class="all-languages" style="display:none;">
			
				<h3><?=string_ucwords(system_showText(LANG_MSG_AVAILABLELANGUAGES))?></h3>
				<p><?=system_showText(LANG_MSG_AVAILABLELANGUAGESMSG)?></p>
				<ul>
			<?
			
			$langObj = new Lang();
			
			$allLanguages = $langObj->getAll(); //do not unset this variable after using, it will be used in includes/code/navbar.php
			
			foreach ( $allLanguages as $language ) { ?>
					<li> 
					<img width="14" height="11" class="flagActive" src="<?=DEFAULT_URL;?>/lang/flag/<?=$language[1];?>.gif" alt="<?=$language[1];?>" />
						<?php echo $language[2] ?>
					</li>
			<? } 
			unset($edir_i);
			?>
				</ul>
			
		</div>
			
			<? 
			} ?>
		
		</div>
	<?	
	}
	
	unset($edir_languages);
	unset($edir_languagenames);
	?>