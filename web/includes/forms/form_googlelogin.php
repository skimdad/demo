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

	# * FILE: /includes/forms/form_googlelogin.php

	# ----------------------------------------------------------------------------------------------------



?>

	<? if ($message_login) { ?>

		<p class="<?=$_GET["np"]? "informationMessage": "errorMessage";?>"><?=$message_login?></p>

	<? } ?>



	<script language="javascript" type="text/javascript">

		//<![CDATA[	

		var destiny = '<?=DEFAULT_URL."/members/googleauth.php?login$urlRedirect"?>';

		function googleLogin(){

			window.location = destiny;

		}

		//]]>

	</script>

	

	<div class="button button-google">

		<h2>

			<a href="javascript: void(0);" onclick="googleLogin();"><?=system_showText(LANG_LABEL_LOGIN)?></a>

		</h2>

	</div>



	<p>&nbsp;</p>