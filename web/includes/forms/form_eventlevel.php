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
	# * FILE: /includes/forms/form_eventlevel.php
	# ----------------------------------------------------------------------------------------------------

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	customtext_get("payment_tax_label", $payment_tax_label, EDIR_LANGUAGE);

	$levelObj = new EventLevel();
	$levelValue = $levelObj->getValues();
		unset($strArray);
		foreach ($levelValue as $value) {
			$strAux = "<tr><th>".$levelObj->showLevel($value).":</th><td><strong>";
			if ($levelObj->getPrice($value) > 0) $strAux .= CURRENCY_SYMBOL.$levelObj->getPrice($value);
			else $strAux .= CURRENCY_SYMBOL.system_showText(LANG_LABEL_FREE);
			$strAux .= "</strong>";
			$strAux .= " ".system_showText(LANG_PER)." ";
			if (payment_getRenewalCycle("event") > 1) {
				$strAux .= payment_getRenewalCycle("event")." ";
				$strAux .= payment_getRenewalUnitName("event")."s";
			}else {
				$strAux .= payment_getRenewalUnitName("event");
			}
			$strAux .= "</td></tr>";
			$strArray[] = $strAux;
		}

?>

<table border="0" cellpadding="0" cellspacing="0" class="levelTable">
	<tr>
		<th class="levelTitle"><?=system_showText(LANG_MENU_SELECT_EVENT_LEVEL)?></th>
		<td class="levelTopdetail">
			<?=system_showText(LANG_LABEL_PRICE_PLURAL);?>
			<?
				if ($payment_tax_status == "on") {
					echo " (+".$payment_tax_value."% ".$payment_tax_label.")";
				}
			?>
		</td>
	</tr>
	<?if (count($levelValue) > 1){?>
	<tr>
		<th class="tableOption" colspan="2"><a href="<?=NON_SECURE_URL?>/advertise.php?event" target="_blank"><?=system_showText(LANG_EVENT_OPTIONS);?></a></th>
	</tr>
	<?}?>
	<tr>
		<? if ((!$event) || (($event) && ($event->needToCheckOut())) || (string_strpos($url_base, "/sitemgr")) || (($event) && ($event->getPrice() <= 0))) { ?>
		<td>
           	<table border="0" cellpadding="2" cellspacing="2" class="standardChooseLevel">
                <?
						$levelvalues = $levelObj->getLevelValues();
							foreach ($levelvalues as $levelvalue) {
								?>
								<tr>
									<th><?=$levelObj->showLevel($levelvalue)?></th>
									<td><input class="standard-table-putradio" type="radio" name="level" value="<?=$levelvalue?>" <? if ($levelArray[$levelObj->getLevel($levelvalue)]) echo "checked"; ?> /></td>
								</tr>
								<?
							}
						 ?>
				</table>
			</td>
		<? } else { ?>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" class="standardChooseLevel">
						 <tr>
						<th><?=string_ucwords($levelObj->getLevel($level));?></th>
						<td><input type="hidden" name="level" value="<?=$level?>" /></td>
						</tr>
			</table>
		</td>
		<? } ?>
            <td class="levelPrice">
                <table border="0" cellpadding="2" cellspacing="2" class="standard-tableSAMPLE">
                    <tr>
					<? echo implode("", $strArray); ?>
                    </tr>
                </table>
            </td>
	</tr>
</table>