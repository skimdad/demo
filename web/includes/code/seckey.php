<?php

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
	# * FILE: /includes/code/seckey.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$boolean_seckey = false;
	$clearSess = false;

	if ($request_method_seckey == "post") {
		if (md5($_POST["seckey01"].$_POST["seckey02"].$_POST["seckey03"]) == $_SESSION["seckey"]) {
			$boolean_seckey = true;
		}
		$clearSess = true;
	} elseif ($request_method_seckey == "get") {
		if (md5($_GET["seckey01"].$_GET["seckey02"].$_GET["seckey03"]) == $_SESSION["seckey"]) {
			$boolean_seckey = true;
		}
		$clearSess = true;
	} else if (!$_SESSION["seckey"]) {
		$seckey01 = md5(uniqid("001".rand(), true));
		$seckey02 = md5(uniqid("002".rand(), true));
		$seckey03 = md5(uniqid("003".rand(), true));
		$_SESSION["seckey"] = md5($seckey01.$seckey02.$seckey03);
		echo "
			<input type=\"hidden\" name=\"seckey01\" value=\"".$seckey01."\" />
			<input type=\"hidden\" name=\"seckey02\" value=\"".$seckey02."\" />
			<input type=\"hidden\" name=\"seckey03\" value=\"".$seckey03."\" />
		";
	}
	$request_method_seckey = "";

	if ($clearSess) {
		unset($_SESSION["seckey"], $clearSess);
	}

?>
