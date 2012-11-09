<?
    $isMobileApp_MOBI = TRUE;
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
	# * FILE: /mobile/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/mobile.inc.php");
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content();
	$sitecontentinfo = $contentObj->retrieveContentInfoByType("Home Page");
	if ($sitecontentinfo) {
		$headertagtitle = $sitecontentinfo["title"];
	} else {
		$headertagtitle = "";
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;

	include(MOBILE_EDIRECTORY_ROOT."/layout/header.php");

?>

<?
$next_url = (!empty($_GET['redirecturl'])) ? urldecode($_GET['redirecturl']) : urldecode(DEFAULT_URL.'/mobile/');
if (sess_getAccountIdFromSession()) {
    header('location:' . $next_url);
}


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $authmessage = '';
    $is_authanticated = sess_authenticateAccount($_POST["username"], $_POST["password"], $authmessage);
    if ($is_authanticated) {
        sess_registerAccountInSession($_POST["username"]);
        setcookie("username_members", $_POST["username"], time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");

        setcookie("uid", sess_getAccountIdFromSession(), time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");

        $AccountObj = db_getFromDB("account", "username", db_formatString($_POST["username"]));
        if ($_POST["automatic_login"]) {
            setcookie("automatic_login_members", "true", time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
            $_POST["password"] = string_strtolower(PASSWORD_ENCRYPTION) == "on" ? md5($_POST["password"]) : $_POST["password"];
            $aux = md5(MEMBERS_LOGIN_PAGE . trim($_POST["username"]) . $_POST["password"]);
            setcookie("complementary_info_members", $aux, time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");

            $AccountObj->Save();
        } else {
            setcookie("automatic_login_members", "false", time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
        }


        header('location:' . $next_url);
    } else {
        echo '<script>alert("' . $authmessage . '");</script>';
    }
}
?>
<!--<div data-role="page" data-url="<?= $next_url ?>" id="main" style="background-color: <?= '#'.$mobileAppObj->bg_color; ?>; background-image: none;">-->






    <!-- Home -->

    <div data-role="content" class="login-form-container" >
        <div data-role="fieldcontain">
           <select name="selectmenu1" id="selectmenu1" >
                <option value="acc"  >
                    Sign in with Directory Account
                </option>
                <option value="fb" >
                    Sign in with Facebook Account
                </option>
            </select>
        </div>
        <div class="sign_in Directory_account">
            <form action="<?= $_SERVER["PHP_SELF"] . '?redirecturl=' . $next_url ?>" method="post">
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup">
                       
                        <input name="username" id="username" placeholder="E-mail" value="" type="email" style="width: 100%" required>
                    </fieldset>
                </div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup">
                       
                        <input name="password" id="password" placeholder="Password" value="" type="password" style="width: 100%" required>
                    </fieldset>
                </div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup" data-type="vertical">
                        <legend>
                        </legend>
                        <input name="automatic_login_members" id="automatic_login_members" type="checkbox" >
                        <label for="automatic_login_members" style="width: 100%">
                            Sign me in automatically
                        </label>
                    </fieldset>
                </div>
                <input value="Sign in" type="submit" style="width: 100%">
            </form>
        </div>
        <div data-role="content" class="button-facebook sign_in">
            <h2>
                <?
                Facebook::getFBInstance($facebook);

              // $promotionUrl = $mobile_base_url . 'index.php/' . $listing->id . '/promotion_detail/' . $promotionObj->id;
                $urlRedirect = "&action=check_session" . "&tb_link=" . urlencode($next_url) . "&destiny=" . urlencode($next_url);
                $fbLink = $facebook->getLoginStatusUrl(
                        array(
                            "ok_session" => FACEBOOK_REDIRECT_URI . "?fb_session=ok" . $urlRedirect,
                            "no_session" => FACEBOOK_REDIRECT_URI . "?fb_session=no_session" . $urlRedirect,
                            "no_user" => FACEBOOK_REDIRECT_URI . "?fb_session=no_user" . $urlRedirect
                        )
                );
                ?>
                <a href="<?= $fbLink ?>"></a>	</h2>
        </div>

        <!-- <div>
            <a href="" data-transition="fade">
                Forget Password?
            </a>
        </div>-->

        <!-- <a  data-theme="b"  data-role="button" data-transition="fade" href="#page1">
            Create Your Profile
        </a> -->
    </div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MOBILE_EDIRECTORY_ROOT."/layout/footer.php");
?>


