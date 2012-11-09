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
	# * FILE: /sitemgr/accountsearch.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	// Security Check
	sess_validateSMSession();
	if(sess_isSitemgrLogged() == false){ exit; }

	if(($_GET["company"] || $_GET["username"]) && $_GET["acct_search_field_name"]) {

		$username = trim(string_substr(db_formatString($_GET["username"]), 1 , string_strlen(db_formatString($_GET["username"]))-2));
		$company = trim(string_substr(db_formatString($_GET["company"]), 1 , string_strlen(db_formatString($_GET["company"]))-2));

		$sql = "SELECT A.id, A.username, A.is_sponsor, C.company, C.country, C.state, C.city, C.zip, C.phone, C.fax, C.email FROM Contact C, Account A";
		if($_GET["company"]) $sql_where[] = "C.company LIKE '%".$company."%'";
		if($_GET["username"]) $sql_where[] = "((A.username LIKE '".$username."%' AND A.username NOT LIKE '%::%') OR A.username LIKE '%::".$username."%')";
		$sql_where[] = "A.id = C.account_id";
		$sql .= " WHERE ".implode(" AND ", $sql_where);
		$sql .= " ORDER BY A.username";

		$dbObj = db_getDBObject(DEFAULT_DB, true);
		$rs = $dbObj->query($sql);
		unset($dbObj);

        if (isset($_GET['selectAccountCustom'])){
            $function=trim("selectAccountCustom");
        } else $function="selectAccount";
		
		if (isset($_GET['extraId'])){
            $extraId=$_GET['extraId'];
        } else $extraId="";

		if(mysql_num_rows($rs) > 0) {

			$result = "<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">";
			$i=0;
			while($row = mysql_fetch_assoc($rs)){
				
				$acct_value = $row["id"]."||".htmlspecialchars(system_showAccountUserName($row["username"]))."||".addslashes(htmlspecialchars($row["company"]));
				
				$result .= "<tr>";
				if ($row["is_sponsor"] == "y") {
					$result .= "<th class=\"selectAccountImage\"><img class=\"img_select_account_search\" acctid=\"$acct_value\" src=\"".DEFAULT_URL."/images/icon_select.gif\" alt=\"select\" title=\"".system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECTTHIS)."\" onclick=\"$function('$acct_value', '".$_GET["acct_search_field_name"]."', ".($extraId ? $extraId : "0").")\" /></th>";
				} else {
					$result .= "<th class=\"selectAccountImage\">".system_showText(LANG_SITEMGR_LABEL_MEMBER_ACCOUNT)."</th>";
				}
				$result .= "<td>";
				$result .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>";
				$result .= "<th>".system_showText(LANG_SITEMGR_LABEL_USERNAME)."</th>";
				$result .= "<td><b>".system_showAccountUserName($row["username"])."</b></td></tr><tr>";
				$result .= "<th>".system_showText(LANG_SITEMGR_LABEL_COMPANY)."</th>";
				$result .= "<td>".$row["company"]."</td></tr><tr>";
				$result .= "<th>".system_showText(LANG_SITEMGR_LABEL_EMAIL)."</th>";
				$result .= "<td>".$row["email"]."</td></tr>";
				$result .= "<th>".system_showText(LANG_SITEMGR_LABEL_PHONE)."</th>";
				$result .= "<td>".$row["phone"]."</td></tr><tr>";
				$result .= "<th>".system_showText(LANG_SITEMGR_LABEL_STATE)."</th>";
				$result .= "<td>".$row["state"]."</td></tr><tr>";
				$result .= "<th>".system_showText(LANG_SITEMGR_LABEL_CITY)."</th>";
				$result .= "<td>".$row["city"]."</td></tr><tr>";
				$result .= "</table>";
				$result .= "</td>";
				$result .= "</tr>";

				$i++;

			}

		} else {

			$result .= "<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\"><tr><td class=\"errorMessage\" colspan=\"3\">".system_showText(LANG_SITEMGR_NORESULTS)." ".system_showText(LANG_SITEMGR_EXPORT_PLEASETRYAGAIN)."</td></tr></table>";

		}

		$result .= "</table>";

	} else {

		$result .= system_showText(LANG_SITEMGR_ACCOUNTSEARCH_PLEASESUPPLYACOMPANY);

	}

	$result .= "ok";
	print $result;

?>
