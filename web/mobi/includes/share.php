<?
$home_url = $mobile_base_url . "index.php/$listing->id";
$sms_msg = "Visit {$listing->title } website " . $home_url;
?>
<div data-role="content" style="padding: 15px;">
    <a data-role="button" target="_blank" data-transition="fade" href="mailto:?subject=<?= $listing->title ?>&body=<?= nl2br($listing->getStringLang(EDIR_LANGUAGE, 'description', false)) . '%0Dfor more info visit please visit %0D' . $home_url; ?>">
        E-mail
    </a>


    <a data-role="button" target="_blank" data-transition="fade" href="sms:?body=Visit%20<?= $home_url; ?>"> 
        TXT
    </a>
    <a data-role="button" target="_blank" data-transition="fade" href="http://www.facebook.com/share.php?u=<?= $home_url; ?>">
        Facebook
    </a>
    <a data-role="button" target="_blank" data-transition="fade" href="https://plus.google.com/share?url=<?= $home_url; ?>">
        Google +
    </a>
    <a data-role="button" target="_blank" data-transition="fade" href="http://www.twitter.com/share?url=<?= $home_url; ?>&text=<?= str_replace(' ', '+', $listing->getStringLang(EDIR_LANGUAGE, 'description', false)) ?>">
        Twitter 
    </a>

</div>