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
	# * FILE: /quicklist.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		extract($_POST);
        
        if ($type_action == "check"){
             $quicklistObj = new Quicklist("", $account_id, $item_id, $item_type);
             
             if ($quicklistObj->getNumber("id")){
                 echo "not ok"; //item already added to favorites
             } else {
                 echo "ok";
             }
        } else {
            if ($action == "add") {
                if (is_numeric($account_id) && $account_id != 0 && is_numeric($item_id) && $item_id != 0 && $item_type) {
                    $quicklistObj = new Quicklist("", $account_id, $item_id, $item_type);
                    if ($quicklistObj->getNumber("id") == 0) {
                        $quicklistObj->setNumber("account_id", $account_id);
                        $quicklistObj->setNumber("item_id", $item_id);
                        $quicklistObj->setString("item_type", $item_type);
                        $quicklistObj->Add();
                    }
                }
            } else if ($action == "remove") {
                if (is_numeric($account_id) && $account_id != 0 && is_numeric($item_id) && $item_id != 0 && $item_type) {
                    $quicklistObj = new Quicklist("", $account_id, $item_id, $item_type);
                    $quicklistObj->Delete();
                }
            }
        }
        
	} else {
		header("Location: ".DEFAULT_URL);
		exit;
	}
?>