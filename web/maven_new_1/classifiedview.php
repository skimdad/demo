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
	# * FILE: /mobile/classifiedview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on") { exit; }
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);

?>

	<div class="itemView classifiedView">
		<h1><?=$classified["title"]?></h1>
		<? if ($classified["classified_price"] != "NULL" && $classified["classified_price"]) { ?>
			<p class="phone"><span class="bold"><?=system_showText(LANG_LABEL_PRICE);?>:</span> <?=CURRENCY_SYMBOL.$classified["classified_price"]?></p>
		<? } ?>
		<? if ($classified["phone"]) { ?>
			<p class="phone"><span class="bold"><?=system_showText(LANG_LISTING_LETTERPHONE);?>:</span> <?=$classified["phone"]?></p>
		<? } ?>
		<? if ($classified["summarydesc".$langIndex]) { ?>
			<p><?=$classified["summarydesc".$langIndex]?></p>
		<? } ?>
	</div>
