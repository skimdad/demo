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
	# * FILE: /layout/usernavbar.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerUserNavbar-->

	<div id="user-navbar">

		<div class="wrapper">

			<ul class="user-options">
                
				<? if (SOCIALNETWORK_FEATURE == "on") {
						$aux_show_logoff = false;
						if (sess_getAccountIdFromSession()) {
							$dbObjWelcome = db_getDBObJect(DEFAULT_DB,true);
							$sqlWelcome = "SELECT C.first_name,
												  C.last_name,
												  A.has_profile,
												  A.is_sponsor,
												  P.friendly_url,
												  P.nickname
											 FROM Contact C
												LEFT JOIN Account A ON (C.account_id = A.id)
												LEFT JOIN Profile P ON (P.account_id = A.id)
										   WHERE A.id = ".sess_getAccountIdFromSession();

							$resultWelcome = $dbObjWelcome->query($sqlWelcome);
							$contactWelcome = mysql_fetch_assoc($resultWelcome);?>

							<? if ($contactWelcome["has_profile"] == "y") { ?>
								<li><a href="<?=SOCIALNETWORK_URL?>/"><?=system_showTruncatedText(string_htmlentities($contactWelcome["nickname"]), 20)?></a></li>
							<? } else { ?>
								<li><strong><?=system_showTruncatedText(string_htmlentities($contactWelcome["first_name"])." ".string_htmlentities($contactWelcome["last_name"]), 20)?></strong></li>
							<? } 

							$aux_show_logoff = true;

							if ($contactWelcome["is_sponsor"] == "y") { ?>
								<li><a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/members/"><?=system_showText(LANG_MANAGE_CONTENT);?></a></li>
							<? } ?>

							<?
							$favorites_link = "";
							if ($contactWelcome["is_sponsor"] == "y") {
								$favorites_link = DEFAULT_URL."/".MEMBERS_ALIAS."/account/quicklists.php";
							} else {
								if (MODREWRITE_FEATURE == "on"){
									$favorites_link = SOCIALNETWORK_URL."/".$contactWelcome["friendly_url"]."/favorites";
								} else {
									$favorites_link = SOCIALNETWORK_URL."/index.php?id=".sess_getAccountIdFromSession()."&c=favorites";
								}
							}

							?>	
							<li><a href="<?=$favorites_link?>"><?=system_showText(LANG_QUICK_LIST)?></a></li>

						<? } else { ?>
								<li><a href="<?=SOCIALNETWORK_URL;?>/add.php" class="sign-up"><?=system_showText(LANG_JOIN_PROFILE)?></a></li>
								<li><a href="<?=DEFAULT_URL."/popup/popup.php?pop_type=profile_login"?>" class="fancy_window_login"><?=system_showText(LANG_BUTTON_LOGIN)?></a></li>
						<? }

						if($aux_show_logoff){
							if (!empty($_SESSION[SM_LOGGEDIN])) { ?>
								<script language="javascript" type="text/javascript">
									//<![CDATA[
									function sitemgrSection() {
										location = "<?=DEFAULT_URL?>/members/sitemgraccess.php?logout";
									}
									$('#demo_mode_sitemgr').css("display", "none");
									//]]>
								</script>
								<li><a href="javascript:sitemgrSection();">Sitemgr Section</a></li>
							<? } ?>
							<li><a href="<?=SOCIALNETWORK_URL?>/logout.php"><?=system_showText(LANG_BUTTON_LOGOUT)?></a></li>
						<? }  
				} else { ?>
					<? if (sess_getAccountIdFromSession()){ ?>
						<li><a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/members/"><?=system_showText(LANG_MANAGE_CONTENT);?></a></li>
						<li><a href="<?=DEFAULT_URL."/".MEMBERS_ALIAS."/account/quicklists.php";?>"><?=system_showText(LANG_QUICK_LIST)?></a></li>
						<li><a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/members/logout.php"><?=system_showText(LANG_BUTTON_LOGOUT)?></a></li>
					<? } else { ?>	
						<li><a href="<?=DEFAULT_URL."/popup/popup.php?pop_type=profile_login"?>" class="fancy_window_login"><?=system_showText(LANG_BUTTON_LOGIN)?></a></li>
					<? } ?>	
				<? } ?>
			</ul>

			<? include(EDIRECTORY_ROOT."/layout/langnavbar.php"); ?>
			
			<? system_increaseVisit(db_formatString(getenv("REMOTE_ADDR"))); ?>

			<div style="float:right;margin:3px;">
				<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
				<script type=IN/Share data-counter="right" data-url="www.dealcloudusa.com"></script>
			</div>			
			
			<?php // the following code is added by Debiprasad on 6th August 2012 for Facebook Like and Google+ buttons ?>
			<div style="float: right; margin-top: 3px;">
				<div class="g-plusone" data-size="tall" data-annotation="none" data-href="http://www.dealcloudusa.com/"></div>
			</div>

			<script type="text/javascript">
			  (function() {
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			    po.src = 'https://apis.google.com/js/plusone.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>

			<div style="float: right; margin-top: 3px;">
				<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.dealcloudusa.com%2F&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>
			</div>

			

		</div>
	</div>
	
	<!--cachemarkerUserNavbar-->