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
    # * FILE: /autocomplete_keyword.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("./conf/loadconfig.inc.php");

    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

    # ----------------------------------------------------------------------------------------------------
    # LANGUAGE VERIFICATION
    # ----------------------------------------------------------------------------------------------------

    $lang_index = language_getIndex(EDIR_LANGUAGE);
    $ii = (!$lang_index) ? '' : "$lang_index";
    
    # ----------------------------------------------------------------------------------------------------
    # INPUT VERIFICATION
    # ----------------------------------------------------------------------------------------------------
    $limit = $_GET['limit'] ? db_formatNumber($_GET['limit']) : AUTOCOMPLETE_MAXITENS;
    $module   = isset($_GET['module']) ? $_GET['module'] : false;
    $input    = string_strtolower(trim($_GET["q"]));
    $whereStr = db_formatString('%'.$input.'%');

    /*
     * Keyword for title of Listing
     */
    $whereStr_Listing = db_formatString($input."*");
	//htmlencde("From autocomplete.php input=".$input." where=".$whereStr." module=".$module,0);   
    # ----------------------------------------------------------------------------------------------------
    # SUPPORT FUNCTIONS
    # ----------------------------------------------------------------------------------------------------
    
    function getSQLCategorieSearch($moduleName) {

        global $ii, $whereStr, $limit;

        $tableCategory = ucfirst($moduleName).'Category';
        
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
        $sql = "SELECT title$ii AS title, (".db_formatString(@constant('LANG_'.string_strtoupper($moduleName).'_FEATURE_NAME_PLURAL')).") AS module FROM $tableCategory WHERE 1 AND (".$whereLike.") AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND enabled = 'y' ORDER BY title$ii LIMIT $limit";
        return $sql;
        
    }

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
        $sql = "SELECT title$ii AS title, (".db_formatString('Blog').") AS module FROM $tableCategory WHERE 1 AND (".$whereLike.") ORDER BY title$ii LIMIT $limit";

        return $sql;

    }
    
    function getSQLTitleSearch($moduleName,$extraParam=false) {

        global $ii, $whereStr, $limit, $whereStr_Listing;
        if($moduleName == "listing" && FORCE_SECOND){
                $tableModule = "Listing_Summary";
        }else{
                $tableModule = ucfirst($moduleName);
        }
        $whereLike    = array();
        
        $fieldTitle = "title";
        
        $whereFirst = " status = 'A' ";
        if ($moduleName == 'promotion') {
            $fieldTitle = "name";
            $whereFirst = '1';
        }
        //adding title search
        $whereLike[] = " $fieldTitle LIKE $whereStr ";
        //adding keywords search
        $whereLike[] = " keywords$ii LIKE $whereStr ";
        //adding seo_keywords search
        $whereLike[] = " seo_keywords$ii LIKE $whereStr ";
        //creating the where condition
        $whereLike = count($whereLike) ? implode(' OR ', $whereLike) : '';
		       
        //creating the sql
        $sql = "SELECT $fieldTitle AS title, (".db_formatString(@constant('LANG_'.string_strtoupper($moduleName).'_FEATURE_NAME_PLURAL')).") AS module FROM $tableModule WHERE $whereFirst AND (".$whereLike.") LIMIT $limit";
       
        return $sql;
        
    }

    function getSQLTitleSearchBlog($moduleName) {

        global $ii, $whereStr, $limit;

        $tableModule = ucfirst($moduleName);

        $whereLike    = array();

        $fieldTitle = "title";

        $whereFirst = " status = 'A' ";
		
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
	
    function getSQLPromotionListing() {

        global $ii, $whereStr, $limit;
        
        $whereLike    = array();
        
        //adding title search for Promotions
        $whereLike1[] = " Promotion.name LIKE $whereStr ";
        //adding keywords search
        $whereLike1[] = " Promotion.keywords$ii LIKE $whereStr ";
        //adding seo_keywords search
        $whereLike1[] = " Promotion.seo_keywords$ii LIKE $whereStr ";
        //creating the where condition
        $whereLike1 = count($whereLike1) ? implode(' OR ', $whereLike1) : '';
        
        //adding title search for Listings
        $whereLike2[] = " Listing.title LIKE $whereStr ";
        //adding keywords search
        $whereLike2[] = " Listing.keywords$ii LIKE $whereStr ";
        //adding seo_keywords search
        $whereLike2[] = " Listing.seo_keywords$ii LIKE $whereStr ";
        //creating the where condition
        $whereLike2 = count($whereLike2) ? implode(' OR ', $whereLike2) : '';
        
        //creating the sql 
        $sqls = array();
        $sqls[] = "SELECT Promotion.name AS title FROM Promotion WHERE Promotion.listing_status = 'A' AND Promotion.listing_id <> '0' AND (".$whereLike1.")";
        $sqls[] = "SELECT Listing.title AS title FROM Promotion INNER JOIN Listing ON Listing.promotion_id = Promotion.id WHERE Listing.status = 'A' AND  Listing.promotion_id <> '0' AND (".$whereLike2.") GROUP BY Promotion.id ";
        
        return $sqls;
        
    }
	
    # ----------------------------------------------------------------------------------------------------
    # AUTO COMPLETE
    # ----------------------------------------------------------------------------------------------------
    if($input){
        
        $rows = array();
        $dbObj_main = db_getDBObject(DEFAULT_DB,true);
        $dbObj = db_getDBObjectByDomainID(0,$dbObj_main,$_SERVER["HTTP_HOST"]);
        
        //listing
        if ('listing' == $module || !$module) {
            $sql   = getSQLCategorieSearch('listing');
            //$_rows = $dbObj->query($sql);
            $_rows = $dbObj->unbuffered_query($sql);
            while ($row = mysql_fetch_array($_rows)){
                if ($row['title']){
                    $rows[] = $row;
                }
            }
            
            //titles
            $sql   = getSQLTitleSearch('listing');
            //$_rows = $dbObj->query($sql);
            $_rows = $dbObj->unbuffered_query($sql);
            while ($row = mysql_fetch_array($_rows)){
                if ($row['title']){
                    $rows[] = $row;
                }
            }
        }
       
        //promotion
        if ('promotion' == $module || !$module) {
            //promotion title
            $sqls   = getSQLPromotionListing();
            //$_rows = $dbObj->query($sqls[0]);
            $_rows = $dbObj->unbuffered_query($sqls[0]);
            while ($row = mysql_fetch_array($_rows)){
                if ($row['title']){
                    $rows[] = $row;
                }
            }
            
            //listing title
            //$_rows = $dbObj->query($sqls[1]);
            $_rows = $dbObj->unbuffered_query($sqls[1]);
            while ($row = mysql_fetch_array($_rows)){
                if ($row['title']){
                    $rows[] = $row;
                }
            }

        }
        
        //event
        if ('event' == $module || !$module) {
            $sql   = getSQLCategorieSearch('event');
            //$_rows = $dbObj->query($sql);
            $_rows = $dbObj->unbuffered_query($sql);
            while ($row = mysql_fetch_array($_rows)){
                if ($row['title']){
                    $rows[] = $row;
                }
            }
            //titles
            $sql   = getSQLTitleSearch('event');
            //$_rows = $dbObj->query($sql);
            $_rows = $dbObj->unbuffered_query($sql);
            while ($row = mysql_fetch_array($_rows)){
                if ($row['title']){
                    $rows[] = $row;
                }
            }
        }
        
        //classified
        if ('classified' == $module || !$module) {
            $sql   = getSQLCategorieSearch('classified');
            //$_rows = $dbObj->query($sql);
            $_rows = $dbObj->unbuffered_query($sql);
            while ($row = mysql_fetch_array($_rows)){
                if ($row['title']){
                    $rows[] = $row;
                }
            }
            
            $sql   = getSQLTitleSearch('classified');
            //$_rows = $dbObj->query($sql);
            $_rows = $dbObj->unbuffered_query($sql);
            while ($row = mysql_fetch_array($_rows)){
                if ($row['title']){
                    $rows[] = $row;
                }
            }
        }
        
        //article
        if ('article' == $module || !$module) {
            $sql   = getSQLCategorieSearch('article');
            //$_rows = $dbObj->query($sql);
            $_rows = $dbObj->unbuffered_query($sql);
            while ($row = mysql_fetch_array($_rows)){
                if ($row['title']){
                    $rows[] = $row;
                }
            }
            
            $sql   = getSQLTitleSearch('article');
            //$_rows = $dbObj->query($sql);
            $_rows = $dbObj->unbuffered_query($sql);
            while ($row = mysql_fetch_array($_rows)){
                if ($row['title']){
                    $rows[] = $row;
                }
            }
        }

		 //blog
        if ('blog' == $module || !$module) {
            $sql   = getSQLCategorieSearchBlog();
            //$_rows = $dbObj->query($sql);
            $_rows = $dbObj->unbuffered_query($sql);
            while ($row = mysql_fetch_array($_rows)){
                if ($row['title']){
                    $rows[] = $row;
                }
            }

            $sql   = getSQLTitleSearchBlog('post');
            //$_rows = $dbObj->query($sql);
            $_rows = $dbObj->unbuffered_query($sql);
            while ($row = mysql_fetch_array($_rows)){
                if ($row['title']){
                    $rows[] = $row;
                }
            }
        }

        $aResults = array();
        foreach ($rows as $row)
        {
            if (!in_array($row['title'], $aResults)) {
                    $aResults[] = ($row["title"].'|'.$row["id"]);
            }


        }
        
        echo implode("\n", $aResults);		
		
	}