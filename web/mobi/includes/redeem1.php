<?
$id = getUriSegments(4);
$redeemit = TRUE;
$nofacebook = true;
//the next included file used for validate redeem request and add it to the database 
include(EDIRECTORY_ROOT."/includes/code/deal_redeem.php");?>

<?
if ($promotion && !$promotionMsg && $errorNumber != 2){

	//Listing info
	$listingtemplate_address = "";
	if ($listing->getString("address")) {
		$listingtemplate_address = nl2br($listing->getString("address", true));
	}

	$listingtemplate_address2 = "";
	if ($listing->getString("address2")) {
		$listingtemplate_address2 = nl2br($listing->getString("address2", true));
	}

	$listingtemplate_phone = "";
	if ($listing->getString("phone")) {
		$listingtemplate_phone  = $listing->getString("phone", true);
	}

	$listingtemplate_email = "";
	if (htmlspecialchars($listing->getString("email"))) {
		$listingtemplate_email = $listing->getString("email");
	}

	$listingtemplate_url = "";
	if (htmlspecialchars($listing->getString("url"))) {
		$display_url = htmlspecialchars($listing->getString("url"));
		if (htmlspecialchars($listing->getString("display_url"))) {
			$display_url = htmlspecialchars($listing->getString("display_url"));
		}
		$listingtemplate_url = $display_url;

	}

	$listingtemplate_location = "";
	$locationsToshow = system_retrieveLocationsToShow();
	$locationsParam = $locationsToshow." z";
	$listingtemplate_location = $listing->getLocationString($locationsParam, true);

	if ($promotion->getNumber("realvalue") > 0){
		$offer = round(100-(($promotion->getNumber("dealvalue")*100)/$promotion->getNumber("realvalue"))).'%';
	}else{
		$offer = system_showText(LANG_NA);
	}
	$promotionInfo = $promotion->getDealInfo(sess_getAccountIdFromSession());
	$contact = new Contact(sess_getAccountIdFromSession());

	customtext_get("promotion_default_conditions", $promotion_default_conditions, EDIR_LANGUAGE);
?>
<div data-role="content" style="padding: 15px;">
<?	if ($errorNumber){?>

		<p id="errorMessage" class="<?=$errorNumber == 1 ? "informationMessage" : "errorMessage"?>"><?=$errorNumber == 1 ? system_showText(DEAL_REDEEM_DONEALREADY) : system_showText(DEAL_REDEEMINFO_2)?></p>
 <? } ?>


<h1><?=$errorNumber ? $redeemCheck : $redeem_code;?></h1>
<h2><?=$promotion->getString("name");?></h2>
<p>&nbsp;</p>
<p><strong><?=system_showText(LANG_LABEL_NAME)?></strong>: <?=$contact->getString("first_name")." ".$contact->getString("last_name")?></p>
<p><strong><?=system_showText(LANG_DEAL_REMEEDED_AT)?></strong>: <?=format_date($promotionInfo["account"]["datetime"], DEFAULT_DATE_FORMAT, "date")?> - <?=format_date($promotionInfo["account"]["datetime"], "H:i", "datetime")?></p>
<p><strong><?=system_showText(DEAL_VALIDUNTIL)?></strong>: <?=$promotion->getDate("end_date");?></p>
<p>&nbsp;</p>
<p><strong><?=system_showText(DEAL_ORIGINALVALUE)?></strong>: <?=CURRENCY_SYMBOL.format_money($promotion->getNumber("realvalue"),2)?></p>
<p><strong><?=system_showText(DEAL_AMOUNTPAID)?></strong>: <?=CURRENCY_SYMBOL.format_money($promotion->getNumber("dealvalue"),2)?></p>
<p>&nbsp;</p>
<p><strong><?=system_showText(LANG_LISTING_FEATURE_NAME)?>: </strong><?=$listing->getString("title")?></p>
                        <? if ($listingtemplate_phone) { ?>
	<p><strong><?=system_showText(ucfirst(LANG_LISTING_LETTERPHONE))?>: </strong><?=$listingtemplate_phone?></p>
                        <? } ?>
                        <? if ($listingtemplate_email) { ?>
	<p><strong><?=system_showText(ucfirst(LANG_LISTING_LETTEREMAIL))?>: </strong><?=$listingtemplate_email?></p>
                        <? } ?>
                        <? if ($listingtemplate_url) { ?>
	<p><strong><?=system_showText(ucfirst(LANG_LISTING_LETTERWEBSITE))?>: </strong><?=$listingtemplate_url?></p>
                        <? } ?>
                        <? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) { ?>
	<p><strong><?=system_showText(LANG_LABEL_ADDRESS)?>: </strong>
                            <? if ($listingtemplate_address) { ?>
	<span><?=$listingtemplate_address.($listingtemplate_address2 || $listingtemplate_location ? ", " : "" )?></span>
                            <? } ?>
                            <? if ($listingtemplate_address2) { ?>
	<span><?=$listingtemplate_address2.($listingtemplate_location ? ", " : "")?></span>
                            <? } ?>
                            <? if ($listingtemplate_location) { ?>
	<span><?=$listingtemplate_location?></span>
                            <? } ?>
</p>
                        <? } ?>
<p>&nbsp;</p>
                        <?	$langIndex = language_getIndex(EDIR_LANGUAGE); 
                        if ($promotion->getString("conditions$langIndex")) { ?>
	<div class="terms">
	<p><?=nl2br($promotion->getString("conditions$langIndex"));?></p>
	</div>
                        <? } ?>
<p>&nbsp;</p>

                    <? } else { ?>
<p class="<?=$errorNumber == 2 ? "errorMessage" : "informationMessage"?>"><?=$errorNumber == 2 ? system_showText(DEAL_REDEEMINFO_2): $promotionMsg;?></p>
                    <?  }?>

                    </div>
</div>

