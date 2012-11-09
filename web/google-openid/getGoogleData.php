<?php
include 'config/functions.php';

session_start();

if (!empty($_GET['openid_ext1_value_firstname']) && !empty($_GET['openid_ext1_value_lastname']) && !empty($_GET['openid_ext1_value_email'])) {    
    $username = $_GET['openid_ext1_value_firstname'] . $_GET['openid_ext1_value_lastname'];
    $email = $_GET['openid_ext1_value_email'];

    $user = new User();
    $userdata = $user->checkUserGoogle($uid, 'Google', $username, $email);
    if(!empty($userdata)) {
        session_start();
        $_SESSION['id'] = $userdata['id'];
        $_SESSION['oauth_id'] = $uid;

        $_SESSION['username'] = $userdata['username'];
        $_SESSION['email'] = $userdata['email'];
        $_SESSION['oauth_provider'] = $userdata['oauth_provider'];
        header("Location: home.php");

    } else {
        // Something's missing, go back to square 1
        header('Location: error.php');
    }

}
?>
