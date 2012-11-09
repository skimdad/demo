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
	# * FILE: /mobile/breadcrumb.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MOBILE_FEATURE != "on") { exit; }

?>

	<div class="breadcrumb">
		&raquo; <a href="<?=MOBILE_DEFAULT_URL?>/index.php<?=$querystringLang?>"><?=system_showText(LANG_MENU_HOME);?></a>
		<? if (string_strpos($_SERVER["PHP_SELF"], "/results.php") !== false) { ?>
			&raquo; <a href="<?=MOBILE_DEFAULT_URL?>/results.php<?=$querystringLang?>"><?=system_showText(LANG_RESULTS);?></a>
		<? } elseif (string_strpos($_SERVER["PHP_SELF"], "/listings.php") !== false) { ?>
			&raquo; <a href="<?=MOBILE_DEFAULT_URL?>/listings.php<?=$querystringLang?>"><?=system_showText(LANG_MENU_LISTING);?></a>
		<? } elseif ((string_strpos($_SERVER["PHP_SELF"], "/listingresults.php") !== false) || (string_strpos($_SERVER["PHP_SELF"], "/listingdetail.php") !== false)) { ?>
				&raquo; <a href="<?=MOBILE_DEFAULT_URL?>/listings.php<?=$querystringLang?>"><?=system_showText(LANG_MENU_LISTING);?></a>
				&raquo; <a href="<?=MOBILE_DEFAULT_URL?>/listingresults.php<?=$querystringLang?>"><?=system_showText(LANG_RESULTS);?></a>
			<? if((string_strpos($_SERVER["PHP_SELF"], "/listingdetail.php") !== false) && $module_item_title){ ?>
				&raquo; <?=$module_item_title;?></a>
			<? }
		} elseif (string_strpos($_SERVER["PHP_SELF"], "/events.php") !== false) { ?>
			&raquo; <a href="<?=MOBILE_DEFAULT_URL?>/events.php<?=$querystringLang?>"><?=system_showText(LANG_MENU_EVENT);?></a>
		<? } elseif (string_strpos($_SERVER["PHP_SELF"], "/eventresults.php") !== false) { ?>
			&raquo; <a href="<?=MOBILE_DEFAULT_URL?>/events.php<?=$querystringLang?>"><?=system_showText(LANG_MENU_EVENT);?></a>
			&raquo; <a href="<?=MOBILE_DEFAULT_URL?>/eventresults.php<?=$querystringLang?>"><?=system_showText(LANG_RESULTS);?></a>
		<? } elseif (string_strpos($_SERVER["PHP_SELF"], "/classifieds.php") !== false) { ?>
			&raquo; <a href="<?=MOBILE_DEFAULT_URL?>/classifieds.php<?=$querystringLang?>"><?=system_showText(LANG_MENU_CLASSIFIED);?></a>
		<? } elseif (string_strpos($_SERVER["PHP_SELF"], "/classifiedresults.php") !== false) { ?>
			&raquo; <a href="<?=MOBILE_DEFAULT_URL?>/classifieds.php<?=$querystringLang?>"><?=system_showText(LANG_MENU_CLASSIFIED);?></a>
			&raquo; <a href="<?=MOBILE_DEFAULT_URL?>/classifiedresults.php<?=$querystringLang?>"><?=system_showText(LANG_RESULTS);?></a>
		<? } elseif (string_strpos($_SERVER["PHP_SELF"], "/articles.php") !== false) { ?>
			&raquo; <a href="<?=MOBILE_DEFAULT_URL?>/articles.php<?=$querystringLang?>"><?=system_showText(LANG_MENU_ARTICLE);?></a>
		<? } elseif (string_strpos($_SERVER["PHP_SELF"], "/articleresults.php") !== false) { ?>
			&raquo; <a href="<?=MOBILE_DEFAULT_URL?>/articles.php<?=$querystringLang?>"><?=system_showText(LANG_MENU_ARTICLE);?></a>
			&raquo; <a href="<?=MOBILE_DEFAULT_URL?>/articleresults.php<?=$querystringLang?>"><?=system_showText(LANG_RESULTS);?></a>
		<? } ?>
	</div>
