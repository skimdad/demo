<?

/* ==================================================================*\
  ######################################################################
  #   created by mavencrew                                             #
  ######################################################################
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /sitemgr/listing/send_url.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
//sess_validateSMSession();
	//permission_hasSMPerm();
if (true) {


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['send_url'])) {
   // if(true){
        $url_redirect = "" . DEFAULT_URL . "/{$_POST['redirect_folder']}/" . LISTING_FEATURE_FOLDER;
        $url_base = "" . DEFAULT_URL . "/{$_POST['redirect_folder']}/";
        $sitemgr = 1;

        include(EDIRECTORY_ROOT . "/includes/code/listing.php");


//if(isset($_GET['task']) && $_GET['task'] == 'send_url')
//1. get short url
        include(EDIRECTORY_ROOT . "/classes/class_GoogleShorterLink.php" );
        $googleShortLinkObj = new GoogleShorterLink(DEFAULT_URL . '/mobi/index.php/' . $listing->id);
        $short_url = $googleShortLinkObj->shorten();

//2. get account owner email
        $client_account = new Contact($listing->account_id);
        $client_email = (!empty($_POST['send_url_to']))?$_POST['send_url_to']:$client_account ;
//$client_email = 'hager.aly@mavencrew.com';
//3. prep messages and send the mail
        $msg = "
				<html>
					<head>
						<style>
							.email_style_settings{
								font-size:12px;
								font-family:Verdana, Arial, Sans-Serif;
								color:#000;
							}
						</style>
					</head>
					<body>
						<div class=\"email_style_settings\">
							Dear {$client_account->first_name}&nbsp;{$client_account->last_name},
							<br />&nbsp;&nbsp;&nbsp;&nbsp;
							your mobile website link is: <br />
							<a href=\"{$short_url}\" target=\"_blank\">{$short_url}</a> 
						
						</div>
					</body>
				</html>";

        $send_result = system_mail($client_email, "[" . EDIRECTORY_TITLE . "] Mobile Url", $msg, $listing->title, "text/html", '', '', $error);
        if ($send_result) {
            $mail_msg = 'the url was sent to: ' . $client_email;
        } else {
            $mail_msg = 'something went wrong please try again later';
        }
        header("Location: " . DEFAULT_URL . "/{$_POST['redirect_folder']}/" . LISTING_FEATURE_FOLDER . '/MobileApp.php?id=' . $listing->id . '&mail_msg=' . urlencode($mail_msg));
        exit;
    }
}
?>