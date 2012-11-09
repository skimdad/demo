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
	# * FILE: /includes/code/order_package.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		/*
		 * Check package_id
		 */
		if($_POST["package_id"] && $_POST["item_name"]){
			$package_id = package_buying_package($_POST, true);
		}
		

		/*
		 * Make Payment
		 */
		$payment_method = $_POST["payment_method"];
		if ($payment_method == "checkout") {
			header("Location: ".DEFAULT_URL."/members/".$_POST["item_type"]."/".$_POST["item_type"].".php?id=".$_POST["item_id"]."&process=signup&package_id=$package_id");
		} elseif ($payment_method == "invoice") {
			header("Location: ".DEFAULT_URL."/members/signup/invoice.php?ispackage=true&package_id=$package_id");
		} else {
			header("Location: ".DEFAULT_URL."/members/signup/payment.php?payment_method=".$payment_method."&ispackage=true&package_id=$package_id");
		}
		exit;
	}
?>
