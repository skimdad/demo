<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /members/googleauth.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");
	
	try {
    # Change 'localhost' to your domain name.
	$domain_url = str_replace("http://", "", NON_LANG_URL);
	$domain_url = str_replace("https://", "", $domain_url);
//	$domain_url = $domain_url."/web/members/";
	$openid = new LightOpenID($domain_url);

    if(!$openid->mode) {
        if(isset($_GET['login'])) {
            $openid->identity = 'https://www.google.com/accounts/o8/id';
            header('Location: ' . $openid->authUrl());
        }
?>
<form action="?login" method="post">
    <button>Login with Google</button>
</form>
<?php
    } elseif($openid->mode == 'cancel') {
        echo 'User has canceled authentication!';
    } else {
        echo 'User ' . ($openid->validate() ? $openid->identity . ' has ' : 'has not ') . 'logged in.';
    }
} catch(ErrorException $e) {
		header("Location: ".DEFAULT_URL."/members/login.php?googleerror=error");
		exit;
	}
	//$redirectUrl = system_getAccountRedirect($_GET["destiny"]);
	//header("Location: ".$redirectUrl);
	//exit;

?>
