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
	# * FILE: /includes/forms/form_listinglevel.php
	# ----------------------------------------------------------------------------------------------------

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	customtext_get("payment_tax_label", $payment_tax_label, EDIR_LANGUAGE);

	$levelValue = $levelObj->getValues();
	unset($strArray);
	foreach ($levelValue as $value) {
		$strAux = "<tr><th>".$levelObj->showLevel($value).":</th><td><strong>";
		if ($levelObj->getPrice($value) > 0) $strAux .= CURRENCY_SYMBOL.$levelObj->getPrice($value);
		else $strAux .= CURRENCY_SYMBOL.system_showText(LANG_LABEL_FREE);
		$strAux .= "</strong>";
		$strAux .= " ".system_showText(LANG_PER)." ";
		if (payment_getRenewalCycle("listing") > 1) {
			$strAux .= payment_getRenewalCycle("listing")." ";
			$strAux .= payment_getRenewalUnitName("listing")."s";
		}else {
			$strAux .= payment_getRenewalUnitName("listing");
		}
		$strAux .= "</td></tr>";
		$strArray[] = $strAux;
	}

?>

<table border="0" cellpadding="0" cellspacing="0" class="levelTable">

	<tr>
		<th class="levelTitle"><?=system_showText(LANG_MENU_SELECTLISTINGLEVEL)?></th>
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
		<th class="tableOption" colspan="2"><a href="<?=NON_SECURE_URL?>/advertise.php" target="_blank" class="listingOption"><?=system_showText(LANG_LISTING_OPTIONS);?></a></th>
	</tr>
	<? } ?>
	<tr>

		<? if ((!$listing) || (($listing) && ($listing->needToCheckOut())) || (string_strpos($url_base, "/sitemgr")) || ($claimlistingid) || (($listing) && ($listing->getPrice() <= 0))) { ?>
           
							<td>
				<table border="0" cellpadding="2" cellspacing="2" class="standardChooseLevel">
					<? if (LISTINGTEMPLATE_FEATURE == "on" && !USING_THEME_TEMPLATE) { ?>
                        <tr>
							<th class="listingLevel"><?=system_showText(LANG_LISTING_TEMPLATE);?>:</th>
                            <td>
                                <select name="listingtemplate_id">
                                    <option value=""><?=system_showText(LANG_BUSINESS);?></option>
                                    <?
									$dbMain = db_getDBObject(DEFAULT_DB, true);
									$dbObjLT = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
									$sqlLT = "SELECT id FROM ListingTemplate WHERE status = 'enabled' AND editable = 'y' ORDER BY title";
                                    $resultLT = $dbObjLT->query($sqlLT);
                                    while ($rowLT = mysql_fetch_assoc($resultLT)) {
                                        $listingtemplate = new ListingTemplate($rowLT["id"]);
                                        echo "<option value=\"".$listingtemplate->getNumber("id")."\"";
                                        if ($listingtemplate_id == $listingtemplate->getNumber("id")) {
                                            echo " selected";
                                        }
                                        echo ">".$listingtemplate->getString("title");
										if ($listingtemplate->getString("price") > 0) echo " (+".CURRENCY_SYMBOL.$listingtemplate->getString("price").")";
										else echo " (".system_showText(LANG_LABEL_FREE).")";
                                        echo "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
					<? } elseif (USING_THEME_TEMPLATE) { ?>
                        <input type="hidden" name="listingtemplate_id" value="<?=($listingtemplate_id > 0  ? $listingtemplate_id : THEME_TEMPLATE_ID)?>" />
                    <? } ?>    
                        <?
                        $levelvalues = $levelObj->getLevelValues();
	                        foreach ($levelvalues as $levelvalue) {
	                            ?>
	                            <tr>
	                                <th class="listingLevel"><?=$levelObj->showLevel($levelvalue)?></th>
	                                <td><input type="radio" name="level" value="<?=$levelvalue?>" <? if ($levelArray[$levelObj->getLevel($levelvalue)]) echo "checked"; ?> style="width: auto;" /></td>
	                            </tr>
	                            <?
	                        }
					?>
				</table>
			</td>

		<? } else { ?>

			<td>
				<table border="0" cellpadding="0" cellspacing="0" class="standardChooseLevel">
					<? if (LISTINGTEMPLATE_FEATURE == "on") { ?>
						<tr>
							<th><?=system_showText(LANG_LISTING_TEMPLATE)?>:</th>
							<td>
								<?
								$listingtemplate = new ListingTemplate($listing->getNumber("listingtemplate_id"));
								if (($listingtemplate) && ($listingtemplate->getNumber("id") > 0)) {
									echo $listingtemplate->getString("title");
								} else {
									echo system_showText(LANG_LABEL_DEFAULT);
                        }
								if ($listingtemplate->getString("price") > 0) echo " (+".CURRENCY_SYMBOL.$listingtemplate->getString("price").")";
								else echo " (".system_showText(LANG_LABEL_FREE).")";
                        ?>
								<input type="hidden" name="listingtemplate_id" value="<?=$listingtemplate_id?>" />
							</td>
						</tr>
					<? } ?>
                        <tr>
                            <th><?=system_showText(LANG_LISTING_LEVEL);?>:</th>
                            <td>
                                <?=string_ucwords($levelObj->getLevel($level));?>
                                <input type="hidden" name="level" value="<?=$level?>" />
                            </td>
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