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
	# * FILE: /includes/forms/form_articledefaultprice.php
	# ----------------------------------------------------------------------------------------------------

	$levelObj = new ArticleLevel();

?>

<div class="header-form"><?=string_ucwords(system_showText(LANG_SITEMGR_ARTICLE_PLURAL))?> - <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_PRICING_DEFAULTPRICES))?></div>

<? if(is_numeric($message) && isset($msg_levels[$message]) && $levelModule == "article") { ?>
    <a name="link">&nbsp;</a>
    <p class="successMessage"><?=$msg_levels[$message]?></p>
<? } ?>

<? if ($message_articledefaultprice) { ?>
	<div id="warning" class="<?=$message_style?>"><?=$message_articledefaultprice?></div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form" border="0">

	<?
	$levelvalues = $levelObj->getLevelValues();
	foreach ($levelvalues as $levelvalue) {
		?>
		<tr>
			<td align="left" class="td-form"><div class="label-form label-level" style="text-align:right"><?=$levelObj->showLevel($levelvalue)?>:</div></td>
			<td align="left" class="td-form">
				<input type="text" name="price[<?=$levelvalue?>]" class="input-form-article" style="width:100px" value="<?=$levelObj->getPrice($levelvalue)?>" maxlength="8" />
			</td>
			<td align="left" class="td-form">
				<div class="label-form" style="text-align: left;"><b>
					<?=system_showText(LANG_SITEMGR_SETTINGS_PRICING_PRICEPER)?>
					<?
					if (payment_getRenewalCycle("article") > 1) {
						echo payment_getRenewalCycle("article")." ";
						echo payment_getRenewalUnitName("article")."s";
					}else {
						echo payment_getRenewalUnitName("article");
					}
					?>
				</b></div>
			</td>
		</tr>
		<?
	}
	?>

</table>
