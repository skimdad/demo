<?
   $home_url = "http://www.dealcloudusa.com/mobi/index.php/$listing->id";
   $sms_msg = "Visit {$listing->title } website ". $home_url;
?>
<div data-role="content" style="padding: 15px;">
	<a data-role="button" target="_blank" data-transition="fade" href="mailto:?subject=<?= $listing->title ?>&body=<?= 'for more info visit please visit '.$home_url; ?>">
        E-mail
    </a>
	

    <a data-role="button" target="_blank" data-transition="fade" href="sms://?body=Visit%20the%20best%20site%20at%20http://mobilexweb.com">
        TXT
    </a>
    <a data-role="button" target="_blank" data-transition="fade" href="http://www.facebook.com/share.php?u=<?= $home_url; ?>">
        Facebook
    </a>
    <a data-role="button" target="_blank" data-transition="fade" href="https://plus.google.com/share?url=<?= $home_url; ?>">
        Google +
    </a>
    <a data-role="button" target="_blank" data-transition="fade" href="http://www.twitter.com/share?url=<?= $home_url; ?>">
        Twitter
    </a>

</div>