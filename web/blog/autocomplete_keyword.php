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
	# * FILE: /blog/autocomplete_keyword.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# LANGUAGE VERIFICATION
	# ----------------------------------------------------------------------------------------------------

    $lang_index = language_getIndex(EDIR_LANGUAGE);
    $ii = $lang_index;
    
    # ----------------------------------------------------------------------------------------------------
    # INPUT VERIFICATION
    # ----------------------------------------------------------------------------------------------------
	$limit = $_GET['limit'] ? db_formatNumber($_GET['limit']) : AUTOCOMPLETE_MAXITENS;
    $module   = isset($_GET['module']) ? $_GET['module'] : false;
    $input    = string_strtolower(trim(utf8_decode($_GET["q"])));
    $whereStr = db_formatString('%'.$input.'%');
    
    # ----------------------------------------------------------------------------------------------------
    # SUPPORT FUNCTIONS
    # ----------------------------------------------------------------------------------------------------
    
	function getSQLCategorieSearchBlog() {

        global $ii, $whereStr, $limit;

        $tableCategory = 'BlogCategory';

        $whereLike   = array();
        //adding title search
        $whereLike[] = " title$ii LIKE $whereStr ";
        //adding keywords search
        $whereLike[] = " keywords$ii LIKE $whereStr ";
        //adding seo_keywords search
        $whereLike[] = " seo_keywords$ii LIKE $whereStr ";
        //creating the where condition
        $whereLike = count($whereLike) ? implode(' OR ', $whereLike) : '';
        //creating the sql
        $sql = "SELECT title$ii AS title, (".db_formatString('Blog').") AS module FROM $tableCategory WHERE 1 AND (".$whereLike.") ORDER BY title LIMIT $limit";

        return $sql;

    }

	function getSQLTitleSearchBlog($moduleName) {

        global $ii, $whereStr, $limit;

        $tableModule = ucfirst($moduleName);

        $whereLike    = array();

        $fieldTitle = "title";

		$whereFirst = " status = 'A' AND publication_date <= NOW( )";
		
        //adding title search
        $whereLike[] = " $fieldTitle LIKE $whereStr ";
        //adding keywords search
        $whereLike[] = " keywords$ii LIKE $whereStr ";
        //adding seo_keywords search
        $whereLike[] = " seo_keywords$ii LIKE $whereStr ";
        //creating the where condition
        $whereLike = count($whereLike) ? implode(' OR ', $whereLike) : '';

        //creating the sql
        $sql = "SELECT $fieldTitle AS title FROM $tableModule WHERE $whereFirst AND (".$whereLike.") LIMIT $limit";
		
        return $sql;

    }
	
    # ----------------------------------------------------------------------------------------------------
    # AUTO COMPLETE
    # ----------------------------------------------------------------------------------------------------
	if($input){
        
        $rows = array();
        $dbObj = db_getDBObject();

		 //blog
        if ('blog' == $module || !$module) {
            $sql   = getSQLCategorieSearchBlog();
            $_rows = $dbObj->query($sql);
            while ($row = mysql_fetch_array($_rows)) if ($row['title'])  $rows[] = $row;

            $sql   = getSQLTitleSearchBlog('post');
            $_rows = $dbObj->query($sql);
            while ($row = mysql_fetch_array($_rows)) if ($row['title'])  $rows[] = $row;
        }

		$aResults = array();
		foreach ($rows as $row)
		{
			if (!in_array($row['title'], $aResults)) {
				$aResults[] =  ($row["title"]);
			}
            

		}
        
        echo implode("\n", $aResults);		
		
	}