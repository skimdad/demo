<?php
//prepare a url to redirect after login success
$next_url = (!empty($_GET['redirecturl'])) ? $_GET['redirecturl'] : DEFAULT_URL . "/mobi/index.php/$listing->id/";

//if already logged in redirect to next url
if(sess_getAccountIdFromSession()){
     header('location:' . $next_url);
}





