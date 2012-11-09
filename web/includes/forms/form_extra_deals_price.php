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
	# * FILE: /includes/forms/form_eventdefaultprice.php
	# ----------------------------------------------------------------------------------------------------

	$levelObj = new PromotionPrice();

?>

<div class="header-form"><?=system_showText(LANG_SITEMGR_NAVBAR_PROMOTION)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_PRICING_DEFAULTPRICES))?></div>

<? if(is_numeric($message) && isset($msg_levels[$message]) && $levelModule == "promotion") { ?>
    <a name="link">&nbsp;</a>
    <p class="successMessage"><?=$msg_levels[$message]?></p>
<? } ?>

<? if ($message_extradealsprice) { ?>
	<div id="warning" class="<?=$message_style?>"><?=$message_extradealsprice?></div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form" border="0">

	<tr class="tr-form">
		<td align="center" class="td-form">&nbsp;</td>
		<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b>
			<?=system_showText(LANG_SITEMGR_SETTINGS_PRICING_PRICEPER)?>
			<?
			if (payment_getRenewalCycle("listing") > 1) {
				echo payment_getRenewalCycle("listing")." ";
				echo payment_getRenewalUnitName("listing")."s";
			}else {
				echo payment_getRenewalUnitName("listing");
			}
			?>
		</b></div></td>
	</tr>

	<?
	foreach ($levelObj->price as $promotion => $price) {
		?>
		<tr>
			<td align="left" class="td-form"><div class="label-form label-level" style="text-align:right">Extra <?=$levelObj->extra_promotions[$promotion]?> <?=system_showText(LANG_SITEMGR_NAVBAR_PROMOTION)?>:</div></td>
			<td align="left" class="td-form">
				<input type="text" name="price[<?=$promotion?>]" class="input-form-event" style="width:100px" value="<?=$price?>" maxlength="8" />
			</td>
		</tr>
		<?
	}
	?>

</table>
