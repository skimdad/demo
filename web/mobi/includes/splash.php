<div class="splash_image_container" data-role="content">
    <div data-role="content" style="padding: 0;overflow: hidden" class="company-main-image-container">

        <? if ($mobileAppObj->splash_title_or_logo == 'title' || $mobileAppObj->splash_title_or_logo == 'title_n_logo'): ?>

            <h2 class="mobi_title">
                <?= $listing->title ?>
            </h2>    
        <? endif; ?>   
        <? if (($mobileAppObj->splash_title_or_logo == 'logo' || $mobileAppObj->splash_title_or_logo == 'title_n_logo') && $mobileAppObj->logo_image): ?> 
            <img class="company-main-image" src="<?= $mobile_base_url . "uploded_images/" . $mobileAppObj->logo_image ?>" />
        <? endif; ?>
    </div>
    <?php if (!empty($mobileAppObj->splash_extra_image)): ?>

        <img class="splash_image" src="<?= $mobile_base_url . "uploded_images/" . $mobileAppObj->splash_extra_image . "?" . substr(number_format(time() * rand(), 0, '', ''), 0, 10); ?>" alt="image" >

    <?php endif; ?>
</div>