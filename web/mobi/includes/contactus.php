<?php
$title = $listing->getString("title");
$email = $listing->getString("email");
$phone = $listing->getString("phone");
$address = $listing->getString("address");
$address2 = $listing->getString("address2");
$zip_code = $listing->getString("zip_code");
$url = $listing->getString("url");

//$location = $listing->getString("location", true);
$locationsToshow = system_retrieveLocationsToShow();
$locationsParam = $locationsToshow . " z";
$location = $listing->getLocationString($locationsParam, true);

$listingtemplate_locations = "";
if ($listing->getString("locations"))
    $listingtemplate_locations = nl2br($listing->getString("locations", true))
    ?>

<div data-role="content"  style="padding: 15px;color:black; text-shadow:none">
    <div class="txt_block">
        <? if (!empty($title)): ?>
            <strong><span><?= $title ?></span></strong> <br /><br />
        <? endif; ?>	
        <? if (!empty($address) || !empty($address2) || !empty($location)): ?>
            <em>
                <? if (!empty($address)): ?>
                    <span><?= $address; ?></span> <br />
                <? endif; ?>	
                <? if (!empty($address2)): ?>
                    <span><?= $address2; ?></span> <br />
                <? endif; ?>
                <? if (!empty($location)): ?>
                    <span><?= $location; ?></span> <br />
                <? endif; ?>	
                <br /> 
            </em>
        <? endif; ?>   
        <? if (!empty($phone)): ?>
            <a href="tel:<?= $phone ?>"><?= $phone ?></a> <br /><br />
        <? endif ?>	
        <? if (!empty($url)): ?>
            <a href="<?= $url ?>"> <?= $url ?> </a><br /><br />
        <? endif ?>	
        <? if (!empty($email)): ?>
            <a href="mailto:<?= $email ?>"> <?= $email ?> </a> <br /><br />
        <? endif; ?>	
    </div>
</div>