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
	# * FILE: /includes/forms/form_facebooklogin.php
	# ----------------------------------------------------------------------------------------------------

	Facebook::getFBInstance($facebook);

	if (!isset($urlRedirect)) {
		$urlRedirect = "?destiny=".urlencode(NON_LANG_URL.str_replace(EDIRECTORY_FOLDER, "", $_SERVER["REQUEST_URI"]));
	}

	$loginParams = array(
		"redirect_uri"		=> FACEBOOK_REDIRECT_URI.$urlRedirect,
		"scope"				=> FACEBOOK_PERMISSION_SCOPE
	);
?>



<? if ($message_login) { ?><p class="<?=$_GET["np"]? "informationMessage": "errorMessage";?>"><?=$message_login?></p><? } ?>



<?

$linkFBLogin = "<a href=\"".$facebook->getLoginUrl($loginParams)."\">".system_showText(LANG_LABEL_LOGIN)."</a>";

?>

<div class="button button-facebook">
	<h2>
		<? if (string_strpos($_SERVER["PHP_SELF"], "members/login.php") !== false || string_strpos($_SERVER["PHP_SELF"], "profile/add.php") !== false || string_strpos($_SERVER["PHP_SELF"], "profile/edit.php") !== false || string_strpos($_SERVER["PHP_SELF"], "order") !== false || string_strpos($_SERVER["PHP_SELF"], "claim.php") !== false){ ?>
			<script language='javascript' type='text/javascript'>
			//<![CDATA[
			document.write('<?=$linkFBLogin?>');
			//]]>
			</script>
		<?} else {
			echo $linkFBLogin;
		} ?>
	</h2>
</div>

<p>&nbsp;</p>
