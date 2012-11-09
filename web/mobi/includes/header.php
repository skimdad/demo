<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <script>
            var main_url  = "<?= $mobile_base_url . 'index.php/' . $listing->getNumber('id'); ?>";
            var home_url  = "<?= $mobile_base_url . 'index.php/' . $listing->getNumber('id') . '/home'; ?>";
            if(navigator != undefined && navigator.standalone != undefined)
            {
                if (window.location.href != main_url &&  navigator.standalone) {
                    if (!document.referrer) {
                        window.location.href = main_url;
                    }
                }
            }
        </script>
        <title><?= $listing->getString("title") . ' - ' . $page_title ?>
        </title>
        <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
        <link rel="stylesheet" href="<?= $mobile_base_url; ?>assets/my.css" />
        <link rel="stylesheet" href="<?= $mobile_base_url; ?>assets/jquery.mobile.simpledialog.min.css" />
        <style>
            /* App custom styles */
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
        </script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js">
        </script>
        <script src="<?= $mobile_base_url; ?>assets/jquery.mobile.simpledialog2.min.js">
        </script>
        <script src="<?= $mobile_base_url; ?>assets/my.js">
        </script>

        <? if ($page_to_load == 'splash' || ($page_to_load == 'home' && $mobile_base_url->splash_enabled == 'n' )) : ?>
            <link rel="apple-touch-icon" href="<?= $mobile_base_url . "uploded_images/" . $mobileAppObj->fav_icon_img ?>">
            <link rel="apple-touch-icon" sizes="72x72" href="<?= $mobile_base_url . "uploded_images/" . $mobileAppObj->fav_icon_img ?>">
            <link rel="apple-touch-icon" sizes="114x114" href="<?= $mobile_base_url . "uploded_images/" . $mobileAppObj->fav_icon_img ?>">

            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="black">

            <script type="text/javascript">

                var addToHomeConfig = {
                    touchIcon: true,
                    startDelay: 500,
                    returningVisitor: true
                };

            </script>
            <script src="<?= $mobile_base_url; ?>assets/add2home.js">
            </script>
            <link rel="stylesheet" href="<?= $mobile_base_url; ?>assets/add2home.css" />
        <? endif; ?>
        <meta property="og:title" content="<?= $listing->title ?>"/>
        <meta property="og:image" content="<?= $mobile_base_url . "uploded_images/" . $mobileAppObj->logo_image ?>"/>
        <meta property="og:description" content="<?= nl2br($listing->getStringLang(EDIR_LANGUAGE, "description", true)) ?>"/>
    </head>
    <body >
        <!-- Home -->
        <? if ($page_to_load != 'login'): ?>
            <div data-role="page" id="main" style="background-color: #<?= $mobileAppObj->bg_color; ?>; background-image: none;">

                <div data-theme="c" data-role="header" data-position="fixed">
                    <? if ($page_to_load == 'splash'): ?> 
                                  <!--   <h4 class="ui-title" role="heading" aria-level="1" style="line-height: 32px; margin: 3px auto;"><img src="http://www.dealcloudusa.com/custom/domain_1/content_files/img_logo.png" style="height: 53px; display: inline; vertical-align: middle;">proudly presents ...</h4> -->

                        <?
                    elseif ($page_to_load == 'home'):

                        /* $settObj = new MobileApplication_Settings();
                          $settObj->getByItemName('dealcloud_logo_url'); */
                        ?> 
                                       <!--      <h4 class="ui-title" role="heading" aria-level="1" ><a target="_blank" href="<?= $settObj->value ?>"><img src="http://www.dealcloudusa.com/custom/domain_1/content_files/img_logo.png" style="height: 53px; display: inline; vertical-align: middle;border:0" /></a>proudly presents ...</h4> -->

                    <? else: ?>	
                        <a data-role="button" data-transition="fade" data-theme="b" href="<?= $mobile_base_url . 'index.php/' . $listing->getNumber('id') . '/home'; ?>" data-icon="home" data-iconpos="left" class="ui-btn-left">
                            <?= $mobileAppObj->home_title; ?>
                        </a>
                        <h4>
                            <?= $page_title; ?>
                        </h4>
                    <? endif; ?>
                </div>




                <? if ($page_to_load != 'splash'): ?>
                    <div data-role="content" style="padding: 0;overflow: hidden" class="company-main-image-container">
                        <? if ($mobileAppObj->show_inner_title == 'y'): ?>
                            <h2 class="mobi_title">
                                <?= $listing->title ?>
                            </h2>    
                        <? endif; ?>     
                        <? if ($mobileAppObj->logo_image): ?> 
                            <img class="company-main-image" src="<?= $mobile_base_url . "uploded_images/" . $mobileAppObj->logo_image ?>" />
                        <? endif; ?>

                    </div>
                <? endif; ?>

            <? endif; ?>