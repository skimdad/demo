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

	# * FILE: /includes/forms/form_listingdefaultprice.php

	# ----------------------------------------------------------------------------------------------------



	$levelObj = new ListingLevel();



?>

<div class="header-form"><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING_PLURAL))?> - <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_PRICING_DEFAULTPRICES))?></div>



<p class="informationMessage">

    <?="&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_PRICING_CATEGORIESTIP)?>    

    <?="<br />&#149;&nbsp;".system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP1)." ".system_showText(MAX_CATEGORY_ALLOWED)." ".system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP2)?>    

</p>



<? if(is_numeric($message) && isset($msg_levels[$message]) && $levelModule == "listing") { ?>

    <a name="link">&nbsp;</a>

    <p class="successMessage"><?=$msg_levels[$message]?></p>

<? } ?>



<? if ($message_listingdefaultprice) { ?>

<div id="warning" class="<?=$message_style?>"><?=$message_listingdefaultprice?></div>

<? } ?>

<table><tr><td>

<table cellpadding="2" cellspacing="0" class="table-form" border="0">



	<tr class="tr-form" style="width:320px; cellpadding:-20px">

		<td></td>

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

		<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b># <?=system_showText(LANG_SITEMGR_SETTINGS_PRICING_CATEGORIESINCLUDED)?></b></div></td>

		<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=system_showText(LANG_SITEMGR_SETTINGS_PRICING_EXTRACATEGORYPRICE)?></b></div></td>


		<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b>#<?=system_showText(LANG_SITEMGR_NAVBAR_PROMOTION)?> included</b></div></td>
        
        <td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b>Extra <?=system_showText(LANG_SITEMGR_NAVBAR_PROMOTION)?> Price </b></div></td>		
		
        
      </tr>



	<?

	$levelvalues = $levelObj->getLevelValues();	

	foreach ($levelvalues as $levelvalue) {

		?>

		<tr>

			<td align="left" class="td-form"><div class="label-form label-level" style="text-align:right"><?=$levelObj->showLevel($levelvalue)?>:</div></td>

			<td align="left" class="td-form">

				<input type="text" name="price[<?=$levelvalue?>]" class="input-form-listing" style="width:100px" value="<?=$levelObj->getPrice($levelvalue)?>" maxlength="8" />

			</td>

			<td align="left" class="td-form">

				<input type="text" name="free_category[<?=$levelvalue?>]" class="input-form-listing" style="width:100px" value="<?=$levelObj->getFreeCategory($levelvalue)?>" maxlength="2" />

			</td>

			<td align="left" class="td-form">

				<input type="text" name="category_price[<?=$levelvalue?>]" class="input-form-listing" style="width:100px" value="<?=$levelObj->getCategoryPrice($levelvalue)?>" maxlength="8" />

			</td>
			

			<td align="left" class="td-form">

				<input type="text" name="free_deal[<?=$levelvalue?>]" class="input-form-listing" style="width:100px" value="<?=$levelObj->getFreeDeal($levelvalue)?>" maxlength="2" />

			</td>

			<td align="left" class="td-form">

				<input type="text" name="extra_deal_price[<?=$levelvalue?>]" class="input-form-listing" style="width:100px" value="<?=$levelObj->getExtraDealPrice($levelvalue)?>" maxlength="8" />

			</td>
			
			
			

		</tr>

		<?

	}

	?>
</table>
</td>
<td>

</td></tr></table>

