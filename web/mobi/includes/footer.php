<? if ($page_to_load != 'login' && $page_to_load != 'splash'): ?>
    <?
    $is_mobile_ad_enabledObj = new MobileApplication_Settings();
    $is_mobile_ad_enabledObj->getByItemName('is_mobile_ad_enabled');
    if ($is_mobile_ad_enabledObj->value == 'y'):
        ?>
        <div data-theme="a" data-role="footer" data-position="fixed">
            <?
            $mobile_ad_use_img_or_txtObj = new MobileApplication_Settings();
            $mobile_ad_use_img_or_txtObj->getByItemName('mobile_ad_use_img_or_txt');

            $mobile_ad_linkObj = new MobileApplication_Settings();
            $mobile_ad_linkObj->getByItemName('mobile_ad_link');
            ?>
                        <!--<span class="ui-title">-->
            <div style="width: 100%; height: 55px; position: relative; background-color: #fbfbfb; border: 1px solid #b8b8b8;">
                <a style="width:100%; height: 100%;position: absolute;top: 0; left: 0;text-align: center; line-height: 55px;" href="<?= $mobile_ad_linkObj->value ?>">
                    <?
                    if ($mobile_ad_use_img_or_txtObj->value == 'text') {
                        $mobile_ad_txtObj = new MobileApplication_Settings();
                        $mobile_ad_txtObj->getByItemName('mobile_ad_txt');
                        echo $mobile_ad_txtObj->value;
                    }
                    ?>
                </a> 
                <?
                if ($mobile_ad_use_img_or_txtObj->value == 'image') :
                    $mobile_ad_imgObj = new MobileApplication_Settings();
                    $mobile_ad_imgObj->getByItemName('mobile_ad_img');
                    ?>
                    <img src="<?= DEFAULT_URL . "/mobi/uploded_images/" . $mobile_ad_imgObj->value ?>" alt="image" style="display:block; margin: 0 auto">
                <? endif; ?>
            </div>
            <!--</span>-->
        </div>
    <? endif; ?>

    <div data-role="content" style="padding: 15px">
        <ul data-role="listview" data-divider-theme="c" data-inset="true">

            <?php foreach ($enabled_mobile_pages as $p) : ?>
                <? if ($p != 'splash'): ?>
                    <li data-theme="c">
                        <a href="<?= $mobile_base_url . 'index.php/' . $listing->getNumber('id') . '/' . $p ?>" data-transition="slide">
                            <?= $mobileAppObj->{$p . '_title'} ?>
                        </a>
                    </li>
                <? endif; ?>
            <? endforeach; ?>


        </ul>
    </div>


    </div>

<? endif; ?>

<script>
    //App custom javascript
</script>
</body>
</html>