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
	# * FILE: /includes/forms/form_classifieddefaultprice.php
	# ----------------------------------------------------------------------------------------------------

	$levelObj = new ClassifiedLevel();

?>

<div class="header-form"><?=string_ucwords(system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL))?> - <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_PRICING_DEFAULTPRICES))?></div>

<? if(is_numeric($message) && isset($msg_levels[$message]) && $levelModule == "classified") { ?>
    <a name="link">&nbsp;</a>
    <p class="successMessage"><?=$msg_levels[$message]?></p>
<? } ?>

<? if ($message_classifieddefaultprice) { ?>
	<div id="warning" class="<?=$message_style?>"><?=$message_classifieddefaultprice?></div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form" border="0">

	<?
	$levelvalues = $levelObj->getLevelValues();
	foreach ($levelvalues as $levelvalue) {
		?>
		<tr>
			<td align="left" class="td-form"><div class="label-form label-level" style="text-align:right"><?=$levelObj->showLevel($levelvalue)?>:</div></td>
			<td align="left" class="td-form">
				<input type="text" name="price[<?=$levelvalue?>]" class="input-form-classified" style="width:100px" value="<?=$levelObj->getPrice($levelvalue)?>" maxlength="8" />
			</td>
			<td align="left" class="td-form">
				<div class="label-form" style="text-align: left;"><b>
					<?=system_showText(LANG_SITEMGR_SETTINGS_PRICING_PRICEPER)?>
					<?
					if (payment_getRenewalCycle("classified") > 1) {
						echo payment_getRenewalCycle("classified")." ";
						echo payment_getRenewalUnitName("classified")."s";
					}else {
						echo payment_getRenewalUnitName("classified");
					}
					?>
				</b></div>
			</td>
		</tr>
		<?
	}
	?>

</table>
