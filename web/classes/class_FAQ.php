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
    # * FILE: /classes/class_FAQ.php
    # ----------------------------------------------------------------------------------------------------

    class FAQ extends Handle {

        var $id;
        var $sitemgr;
        var $member;
        var $frontend;
        var $question;
        var $answer;
        var $editable;

        function FAQ($var="") {
            if (is_numeric($var) && ($var)) {
                $db = db_getDBObject(DEFAULT_DB, true);
                $sql = "SELECT * FROM FAQ WHERE id = $var";
                $row = mysql_fetch_array($db->query($sql));
                $this->makeFromRow($row);
            } else {
                $this->makeFromRow($var);
            }
        }

        function makeFromRow($row="") {

            $this->id                    = ($row["id"])                     ? $row["id"]                    : ($this->id                    ? $this->id                     : 0);
            $this->sitemgr               = ($row["sitemgr"])                ? $row["sitemgr"]               : ($this->sitemgr               ? $this->sitemgr                : "n");
            $this->member                = ($row["member"])                 ? $row["member"]                : ($this->member                ? $this->member                 : "n");
            $this->frontend              = ($row["frontend"])               ? $row["frontend"]              : ($this->frontend              ? $this->frontend               : "n");
            $this->editable              = ($row["editable"])               ? $row["editable"]              : ($this->editable              ? $this->editable               : "n");
            $this->question              = ($row["question"])               ? $row["question"]              : "";
            $this->answer                = ($row["answer"])                 ? $row["answer"]                : "";

        }

        function Save() {

            $dbObj = db_getDBObject(DEFAULT_DB, true);

            $this->prepareToSave();

            if ($this->id) {

                $sql = "UPDATE FAQ SET"
                    . " sitemgr           = $this->sitemgr,"
                    . " member            = $this->member,"
                    . " frontend          = $this->frontend,"
                    . " question          = $this->question,"
                    . " answer            = $this->answer"
                    . " WHERE id          = $this->id";

                    $dbObj->query($sql);

            } else {

                $sql = "INSERT INTO FAQ"
                    . " (sitemgr,"
                    . " member,"
                    . " frontend,"
                    . " question,"
                    . " answer"
                    . " )"
                    . " VALUES"
                    . " ("
                    . " $this->sitemgr,"
                    . " $this->member,"
                    . " $this->frontend,"
                    . " $this->question,"
                    . " $this->answer"
                    . " )";

                $dbObj->query($sql);

                $this->id = mysql_insert_id($dbObj->link_id);

            }

            $this->prepareToUse();

        }

        function Delete() {
            $dbObj = db_getDBObject(DEFAULT_DB, true);
            $sql = "DELETE FROM FAQ WHERE id = $this->id";
            $dbObj->query($sql);
        }
        
        function retrieveEditableFAQs() {
        
            $dbObj = db_getDBObject(DEFAULT_DB, true);
            $sql = "SELECT * FROM FAQ WHERE editable='y' ORDER BY id";
            $results = $dbObj->query($sql);
            while ($row[] = mysql_fetch_array($results)) {
                $faqs = $row;
            }
            if ($faqs) {
                return $faqs;
            } else {
                return false;
            }    
        
        }
        
    }

?>
