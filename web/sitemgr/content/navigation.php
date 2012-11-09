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
    # * FILE: /sitemgr/content/navigation.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSMSession();
    permission_hasSMPerm();

	//increases frequently actions
	system_setFreqActions('content_navigation', 'content');

    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/header.php");

    # ----------------------------------------------------------------------------------------------------
    # NAVBAR
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>
	<div id="main-right">

		<div id="top-content">
			<div id="header-content">
				<h1><?=system_showText(LANG_SITEMGR_CONTENT_MANAGECONTENT)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_MODULES))?></h1>
			</div>
		</div>

		<div id="content-content">

			<div class="default-margin">
				<?
				if($_SESSION["restoreNavbar"] != "header" && $_SESSION["restoreNavbar"] != "footer"){
					require(EDIRECTORY_ROOT."/sitemgr/registration.php");
					require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
					require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
				}
				
				include(INCLUDES_DIR."/tables/table_content_submenu.php");
				?>
				
				<form name="navigation" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
					<? include(INCLUDES_DIR."/forms/form_navigation.php"); ?>
				</form>

			</div>

		</div>

	</div>

<?
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>