<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="apple-touch-icon" href="<?= "http://www.dealcloudusa.com/mobi/uploded_images/".$mobileAppObj->fav_icon_img ?>">
		<link rel="apple-touch-icon" sizes="72x72" href="<?= "http://www.dealcloudusa.com/mobi/uploded_images/".$mobileAppObj->fav_icon_img ?>">
		<link rel="apple-touch-icon" sizes="114x114" href="<?= "http://www.dealcloudusa.com/mobi/uploded_images/".$mobileAppObj->fav_icon_img ?>">

		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
        <title><?= $listing->getString("title") .' - '. $mobileAppObj->{$page_to_load.'_title'}; ?>
        </title>
        <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
        <link rel="stylesheet" href="<?= $mobile_base_url; ?>assets/my.css" />
        <style>
            /* App custom styles */
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
        </script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js">
        </script>
        <script src="<?= $mobile_base_url; ?>assets/my.js">
        </script>
		<script type="text/javascript">

		var addToHomeConfig = {
		touchIcon: true,
		};

		</script>
		<script src="<?= $mobile_base_url; ?>assets/add2home.js">
        </script>
		<link rel="stylesheet" href="<?= $mobile_base_url; ?>assets/add2home.css" />
		
    </head>
    <body >
        <!-- Home -->
        <div data-role="page" id="main" style="background-color: #<?= $mobileAppObj->bg_color; ?>; background-image: none;">
            <div data-theme="c" data-role="header" data-position="fixed">
                <a data-role="button" data-transition="fade" data-theme="b" href="<?= $mobile_base_url.'index.php/'.$listing->getNumber('id').'/home'; ?>" data-icon="home" data-iconpos="left" class="ui-btn-left">
                    <?= $mobileAppObj->home_title; ?>
                </a>
                <h4>
                    <?= $mobileAppObj->{$page_to_load.'_title'}; ?>
                </h4>
            </div>
			<div data-role="content" style="padding: 15px;">
                <div style=" text-align:center">
                   <? if($mobileAppObj->logo_image): ?> <img style="width: 60%; height: auto" src="<?= "http://www.dealcloudusa.com/mobi/uploded_images/".$mobileAppObj->logo_image  ?>" /> <? endif; ?>
                </div>
            </div>