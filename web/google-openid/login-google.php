<?php
error_reporting(1);
// importing required files
require 'config/functions.php';
require 'google-open/openid.php';
// callback URL
define('CALLBACK_URL', 'http://dealcloudusa.com/google-openid?response=success');


// calling login functions
gooleAuthenticate();

function gooleAuthenticate() {
    // Creating new instance
    $openid = new LightOpenID;
   $openid->identity = 'https://www.google.com/accounts/o8/id';
    //setting call back url
    $openid->returnUrl = CALLBACK_URL;
    //finding open id end point from google
    $endpoint = $openid->discover('https://www.google.com/accounts/o8/id');
    $fields =
            '?openid.ns=' . urlencode('http://specs.openid.net/auth/2.0') .
            '&openid.return_to=' . urlencode($openid->returnUrl) .
            '&openid.claimed_id=' . urlencode('http://specs.openid.net/auth/2.0/identifier_select') .
            '&openid.identity=' . urlencode('http://specs.openid.net/auth/2.0/identifier_select') .
            '&openid.mode=' . urlencode('checkid_setup') .
            '&openid.ns.ax=' . urlencode('http://openid.net/srv/ax/1.0') .
            '&openid.ax.mode=' . urlencode('fetch_request') .
            '&openid.ax.required=' . urlencode('email,firstname,lastname') .
            '&openid.ax.type.firstname=' . urlencode('http://axschema.org/namePerson/first') .
            '&openid.ax.type.lastname=' . urlencode('http://axschema.org/namePerson/last') .
            '&openid.ax.type.email=' . urlencode('http://axschema.org/contact/email');
    header('Location: ' . $endpoint . $fields);
}

?>
