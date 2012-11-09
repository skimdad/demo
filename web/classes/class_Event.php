<?

/* ==================================================================*\
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
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /classes/class_Event.php
# ----------------------------------------------------------------------------------------------------

/**
 * <code>
 * 		$eventObj = new Event($id);
 * <code>
 * @copyright Copyright 2005 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @version 8.0.00
 * @package Classes
 * @name Event
 * @method Event
 * @method makeFromRow
 * @method Save
 * @method Delete
 * @method updateImage
 * @method getCategories
 * @method setCategories
 * @method getPrice
 * @method hasRenewalDate
 * @method needToCheckOut
 * @method getNextRenewalDate
 * @method getDateString
 * @method getDateStringEnd
 * @method getDateStringRecurring
 * @method getTimeString
 * @method getMonthAbbr
 * @method checkStartDate
 * @method getDayStr
 * @method setLocationManager
 * @method getLocationManager
 * @method getLocationString
 * @method setFullTextSearch
 * @method getGalleries
 * @method setGalleries
 * @method setMapTuning
 * @method hasDetail
 * @method setNumberViews
 * @method deletePerAccount
 * @method getFriendlyURL
 * @access Public
 */
class Event extends Handle {

    /**
     * @var integer
     * @access Private
     */
    var $id;

    /**
     * @var integer
     * @access Private
     */
    var $account_id;

    /**
     * @var string
     * @access Private
     */
    var $title;

    /**
     * @var string
     * @access Private
     */
    var $seo_title;

    /**
     * @var string
     * @access Private
     */
    var $friendly_url;

    /**
     * @var integer
     * @access Private
     */
    var $image_id;

    /**
     * @var integer
     * @access Private
     */
    var $thumb_id;

    /**
     * @var string
     * @access Private
     */
    var $description1;

    /**
     * @var string
     * @access Private
     */
    var $description2;

    /**
     * @var string
     * @access Private
     */
    var $description3;

    /**
     * @var string
     * @access Private
     */
    var $description4;

    /**
     * @var string
     * @access Private
     */
    var $description5;

    /**
     * @var string
     * @access Private
     */
    var $description6;

    /**
     * @var string
     * @access Private
     */
    var $description7;

    /**
     * @var string
     * @access Private
     */
    var $seo_description1;

    /**
     * @var string
     * @access Private
     */
    var $seo_description2;

    /**
     * @var string
     * @access Private
     */
    var $seo_description3;

    /**
     * @var string
     * @access Private
     */
    var $seo_description4;

    /**
     * @var string
     * @access Private
     */
    var $seo_description5;

    /**
     * @var string
     * @access Private
     */
    var $seo_description6;

    /**
     * @var string
     * @access Private
     */
    var $seo_description7;

    /**
     * @var string
     * @access Private
     */
    var $long_description1;

    /**
     * @var string
     * @access Private
     */
    var $long_description2;

    /**
     * @var string
     * @access Private
     */
    var $long_description3;

    /**
     * @var string
     * @access Private
     */
    var $long_description4;

    /**
     * @var string
     * @access Private
     */
    var $long_description5;

    /**
     * @var string
     * @access Private
     */
    var $long_description6;

    /**
     * @var string
     * @access Private
     */
    var $long_description7;

    /**
     * @var string
     * @access Private
     */
    var $keywords1;

    /**
     * @var string
     * @access Private
     */
    var $keywords2;

    /**
     * @var string
     * @access Private
     */
    var $keywords3;

    /**
     * @var string
     * @access Private
     */
    var $keywords4;

    /**
     * @var string
     * @access Private
     */
    var $keywords5;

    /**
     * @var string
     * @access Private
     */
    var $keywords6;

    /**
     * @var string
     * @access Private
     */
    var $keywords7;

    /**
     * @var string
     * @access Private
     */
    var $seo_keywords1;

    /**
     * @var string
     * @access Private
     */
    var $seo_keywords2;

    /**
     * @var string
     * @access Private
     */
    var $seo_keywords3;

    /**
     * @var string
     * @access Private
     */
    var $seo_keywords4;

    /**
     * @var string
     * @access Private
     */
    var $seo_keywords5;

    /**
     * @var string
     * @access Private
     */
    var $seo_keywords6;

    /**
     * @var string
     * @access Private
     */
    var $seo_keywords7;

    /**
     * @var date
     * @access Private
     */
    var $updated;

    /**
     * @var date
     * @access Private
     */
    var $entered;

    /**
     * @var date
     * @access Private
     */
    var $start_date;

    /**
     * @var char
     * @access Private
     */
    var $has_start_time;

    /**
     * @var date
     * @access Private
     */
    var $start_time;

    /**
     * @var date
     * @access Private
     */
    var $end_date;

    /**
     * @var char
     * @access Private
     */
    var $has_end_time;

    /**
     * @var date
     * @access Private
     */
    var $end_time;

    /**
     * @var string
     * @access Private
     */
    var $location;

    /**
     * @var string
     * @access Private
     */
    var $address;

    /**
     * @var string
     * @access Private
     */
    var $zip_code;

    /**
     * @var integer
     * @access Private
     */
    var $location_1;

    /**
     * @var integer
     * @access Private
     */
    var $location_2;

    /**
     * @var integer
     * @access Private
     */
    var $location_3;

    /**
     * @var integer
     * @access Private
     */
    var $location_4;

    /**
     * @var integer
     * @access Private
     */
    var $location_5;

    /**
     * @var string
     * @access Private
     */
    var $url;

    /**
     * @var string
     * @access Private
     */
    var $contact_name;

    /**
     * @var string
     * @access Private
     */
    var $phone;

    /**
     * @var string
     * @access Private
     */
    var $email;

    /**
     * @var date
     * @access Private
     */
    var $renewal_date;

    /**
     * @var integer
     * @access Private
     */
    var $discount_id;

    /**
     * @var char
     * @access Private
     */
    var $status;

    /**
     * @var integer
     * @access Private
     */
    var $level;

    /**
     * @var char
     * @access Private
     */
    var $recurring;

    /**
     * @var integer
     * @access Private
     */
    var $day;

    /**
     * @var integer
     * @access Private
     */
    var $dayofweek;

    /**
     * @var integer
     * @access Private
     */
    var $week;

    /**
     * @var integer
     * @access Private
     */
    var $month;

    /**
     * @var date
     * @access Private
     */
    var $until_date;

    /**
     * @var char
     * @access Private
     */
    var $repeat_event;

    /**
     * @var integer
     * @access Private
     */
    var $number_views;
    /*
     * @var real
     * @access Private
     */
    var $latitude;
    /*
     * @var real
     * @access Private
     */
    var $longitude;

    /**
     * @var integer
     * @access Private
     */
    var $map_zoom;

    /**
     * @var array
     * @access Private
     */
    var $locationManager;

    /**
     * @var array
     * @access Private
     */
    var $data_in_array;

    /**
     * @var integer
     * @access Private
     */
    var $domain_id;

    /**
     * @var integer
     * @access Private
     */
    var $package_id;

    /**
     * @var integer
     * @access Private
     */
    var $package_price;

    /**
     * <code>
     * 		$eventObj = new Event($id);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Event
     * @access Public
     * @param integer $var
     */
    function Event($var = '', $domain_id = false) {

        if (is_numeric($var) && ($var)) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if ($domain_id) {
                $this->domain_id = $domain_id;
                $db = db_getDBObjectByDomainID($domain_id, $dbMain);
            } else if (defined("SELECTED_DOMAIN_ID")) {
                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $db = db_getDBObject();
            }
            unset($dbMain);
            $sql = "SELECT * FROM Event WHERE id = $var";
            $row = mysql_fetch_array($db->query($sql));

            $this->old_account_id = $row["account_id"];

            $this->makeFromRow($row);
        } else {
            $this->makeFromRow($var);
        }
    }

    /**
     * <code>
     * 		$this->makeFromRow($row);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name makeFromRow
     * @access Public
     * @param array $row
     */
    function makeFromRow($row = '') {

        $statusObj = new ItemStatus();
        $level = new EventLevel();

        $this->id = ($row["id"]) ? $row["id"] : ($this->id ? $this->id : 0);
        $this->account_id = ($row["account_id"]) ? $row["account_id"] : 0;
        $this->title = ($row["title"]) ? $row["title"] : ($this->title ? $this->title : "");
        $this->seo_title = ($row["seo_title"]) ? $row["seo_title"] : ($this->seo_title ? $this->seo_title : "");
        $this->friendly_url = ($row["friendly_url"]) ? $row["friendly_url"] : "";
        $this->image_id = ($row["image_id"]) ? $row["image_id"] : ($this->image_id ? $this->image_id : 0);
        $this->thumb_id = ($row["thumb_id"]) ? $row["thumb_id"] : ($this->thumb_id ? $this->thumb_id : 0);

        $this->description1 = ($row["description1"]) ? $row["description1"] : "";
        $this->description2 = ($row["description2"]) ? $row["description2"] : "";
        $this->description3 = ($row["description3"]) ? $row["description3"] : "";
        $this->description4 = ($row["description4"]) ? $row["description4"] : "";
        $this->description5 = ($row["description5"]) ? $row["description5"] : "";
        $this->description6 = ($row["description6"]) ? $row["description6"] : "";
        $this->description7 = ($row["description7"]) ? $row["description7"] : "";

        $this->seo_description1 = ($row["seo_description1"]) ? $row["seo_description1"] : ($this->seo_description1 ? $this->seo_description1 : "");
        $this->seo_description2 = ($row["seo_description2"]) ? $row["seo_description2"] : ($this->seo_description2 ? $this->seo_description2 : "");
        $this->seo_description3 = ($row["seo_description3"]) ? $row["seo_description3"] : ($this->seo_description3 ? $this->seo_description3 : "");
        $this->seo_description4 = ($row["seo_description4"]) ? $row["seo_description4"] : ($this->seo_description4 ? $this->seo_description4 : "");
        $this->seo_description5 = ($row["seo_description5"]) ? $row["seo_description5"] : ($this->seo_description5 ? $this->seo_description5 : "");
        $this->seo_description6 = ($row["seo_description6"]) ? $row["seo_description6"] : ($this->seo_description6 ? $this->seo_description6 : "");
        $this->seo_description7 = ($row["seo_description7"]) ? $row["seo_description7"] : ($this->seo_description7 ? $this->seo_description7 : "");

        $this->long_description1 = ($row["long_description1"]) ? $row["long_description1"] : "";
        $this->long_description2 = ($row["long_description2"]) ? $row["long_description2"] : "";
        $this->long_description3 = ($row["long_description3"]) ? $row["long_description3"] : "";
        $this->long_description4 = ($row["long_description4"]) ? $row["long_description4"] : "";
        $this->long_description5 = ($row["long_description5"]) ? $row["long_description5"] : "";
        $this->long_description6 = ($row["long_description6"]) ? $row["long_description6"] : "";
        $this->long_description7 = ($row["long_description7"]) ? $row["long_description7"] : "";

        $this->keywords1 = ($row["keywords1"]) ? $row["keywords1"] : "";
        $this->keywords2 = ($row["keywords2"]) ? $row["keywords2"] : "";
        $this->keywords3 = ($row["keywords3"]) ? $row["keywords3"] : "";
        $this->keywords4 = ($row["keywords4"]) ? $row["keywords4"] : "";
        $this->keywords5 = ($row["keywords5"]) ? $row["keywords5"] : "";
        $this->keywords6 = ($row["keywords6"]) ? $row["keywords6"] : "";
        $this->keywords7 = ($row["keywords7"]) ? $row["keywords7"] : "";

        $this->seo_keywords1 = ($row["seo_keywords1"]) ? $row["seo_keywords1"] : ($this->seo_keywords1 ? $this->seo_keywords1 : "");
        $this->seo_keywords2 = ($row["seo_keywords2"]) ? $row["seo_keywords2"] : ($this->seo_keywords2 ? $this->seo_keywords2 : "");
        $this->seo_keywords3 = ($row["seo_keywords3"]) ? $row["seo_keywords3"] : ($this->seo_keywords3 ? $this->seo_keywords3 : "");
        $this->seo_keywords4 = ($row["seo_keywords4"]) ? $row["seo_keywords4"] : ($this->seo_keywords4 ? $this->seo_keywords4 : "");
        $this->seo_keywords5 = ($row["seo_keywords5"]) ? $row["seo_keywords5"] : ($this->seo_keywords5 ? $this->seo_keywords5 : "");
        $this->seo_keywords6 = ($row["seo_keywords6"]) ? $row["seo_keywords6"] : ($this->seo_keywords6 ? $this->seo_keywords6 : "");
        $this->seo_keywords7 = ($row["seo_keywords7"]) ? $row["seo_keywords7"] : ($this->seo_keywords7 ? $this->seo_keywords7 : "");

        $this->updated = ($row["updated"]) ? $row["updated"] : ($this->updated ? $this->updated : "");
        $this->entered = ($row["entered"]) ? $row["entered"] : ($this->entered ? $this->entered : "");
        $this->setDate("start_date", $row["start_date"]);
        $this->has_start_time = ($row["has_start_time"]) ? $row["has_start_time"] : "n";
        $this->start_time = ($row["start_time"]) ? $row["start_time"] : 0;
        $this->setDate("end_date", $row["end_date"]);
        $this->has_end_time = ($row["has_end_time"]) ? $row["has_end_time"] : "n";
        $this->end_time = ($row["end_time"]) ? $row["end_time"] : 0;
        $this->location = ($row["location"]) ? $row["location"] : "";
        $this->address = ($row["address"]) ? $row["address"] : "";
        $this->zip_code = ($row["zip_code"]) ? $row["zip_code"] : "";
        $this->location_1 = ($row["location_1"]) ? $row["location_1"] : 0;
        $this->location_2 = ($row["location_2"]) ? $row["location_2"] : 0;
        $this->location_3 = ($row["location_3"]) ? $row["location_3"] : 0;
        $this->location_4 = ($row["location_4"]) ? $row["location_4"] : 0;
        $this->location_5 = ($row["location_5"]) ? $row["location_5"] : 0;
        $this->url = ($row["url"]) ? $row["url"] : "";
        $this->contact_name = ($row["contact_name"]) ? $row["contact_name"] : "";
        $this->phone = ($row["phone"]) ? $row["phone"] : "";
        $this->email = ($row["email"]) ? $row["email"] : "";
        $this->renewal_date = ($row["renewal_date"]) ? $row["renewal_date"] : ($this->renewal_date ? $this->renewal_date : 0);
        $this->discount_id = ($row["discount_id"]) ? $row["discount_id"] : "";
        $this->status = ($row["status"]) ? $row["status"] : $statusObj->getDefaultStatus();
        $this->level = ($row["level"]) ? $row["level"] : ($this->level ? $this->level : $level->getDefaultLevel());
        $this->recurring = ($row["recurring"]) ? $row["recurring"] : "N";
        $this->day = ($row["day"]) ? $row["day"] : 0;
        $this->dayofweek = ($row["dayofweek"]) ? $row["dayofweek"] : "";
        $this->week = ($row["week"]) ? $row["week"] : "";
        $this->month = ($row["month"]) ? $row["month"] : 0;
        $this->setDate("until_date", $row["until_date"]);
        $this->repeat_event = ($row["repeat_event"]) ? $row["repeat_event"] : "N";
        if ($this->recurring == "N") {
            $this->day = 0;
            $this->dayofweek = "";
            $this->week = "";
            $this->month = 0;
            $this->until_date = "";
        }
        $this->number_views = ($row["number_views"]) ? $row["number_views"] : ($this->number_views ? $this->number_views : 0);
        $this->latitude = ($row["latitude"]) ? $row["latitude"] : ($this->latitude ? $this->latitude : "");
        $this->longitude = ($row["longitude"]) ? $row["longitude"] : ($this->longitude ? $this->longitude : "");
        $this->map_zoom = ($row["map_zoom"]) ? $row["map_zoom"] : 0;
        $this->data_in_array = $row;
        $this->package_id = ($row["package_id"]) ? $row["package_id"] : ($this->package_id ? $this->package_id : 0);
        $this->package_price = ($row["package_price"]) ? $row["package_price"] : ($this->package_price ? $this->package_price : 0);
    }

    function getByAccount($count_id = 0) {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if ($domain_id) {
            $this->domain_id = $domain_id;
            $db = db_getDBObjectByDomainID($domain_id, $dbMain);
        } else if (defined("SELECTED_DOMAIN_ID")) {
            $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $db = db_getDBObject();
        }
        unset($dbMain);
        $sql = "SELECT * FROM Event WHERE account_id = $count_id AND (DATE(end_date) > DATE(NOW())) ";
        return $db->query($sql);
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->Save();
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->Save();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Save
     * @access Public
     */
    function Save() {

        $dbMain = db_getDBObject(DEFAULT_DB, true);

        if ($this->domain_id) {
            $dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
            $aux_log_domain_id = $this->domain_id;
        } else if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            $aux_log_domain_id = SELECTED_DOMAIN_ID;
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);

        $this->prepareToSave();

        $aux_old_account = str_replace("'", "", $this->old_account_id);
        $aux_account = str_replace("'", "", $this->account_id);

        $this->friendly_url = string_strtolower($this->friendly_url);

        if ($this->id) {

            $sql = "SELECT status, end_date, until_date FROM Event WHERE id = $this->id";
            $result = $dbObj->query($sql);
            if ($row = mysql_fetch_assoc($result)) {
                $last_status = $row["status"];
                $last_end_date = $row["end_date"];
                $last_until_date = $row["until_date"];
            }
            $this_status = $this->status;
            $this_id = $this->id;

            $sql = "UPDATE Event SET"
                    . " account_id        = $this->account_id,"
                    . " title             = $this->title,"
                    . " seo_title         = $this->seo_title,"
                    . " friendly_url      = $this->friendly_url,"
                    . " image_id          = $this->image_id,"
                    . " thumb_id          = $this->thumb_id,"
                    . " description1      = $this->description1,"
                    . " description2      = $this->description2,"
                    . " description3      = $this->description3,"
                    . " description4      = $this->description4,"
                    . " description5      = $this->description5,"
                    . " description6      = $this->description6,"
                    . " description7      = $this->description7,"
                    . " seo_description1  = $this->seo_description1,"
                    . " seo_description2  = $this->seo_description2,"
                    . " seo_description3  = $this->seo_description3,"
                    . " seo_description4  = $this->seo_description4,"
                    . " seo_description5  = $this->seo_description5,"
                    . " seo_description6  = $this->seo_description6,"
                    . " seo_description7  = $this->seo_description7,"
                    . " long_description1 = $this->long_description1,"
                    . " long_description2 = $this->long_description2,"
                    . " long_description3 = $this->long_description3,"
                    . " long_description4 = $this->long_description4,"
                    . " long_description5 = $this->long_description5,"
                    . " long_description6 = $this->long_description6,"
                    . " long_description7 = $this->long_description7,"
                    . " keywords1         = $this->keywords1,"
                    . " keywords2         = $this->keywords2,"
                    . " keywords3         = $this->keywords3,"
                    . " keywords4         = $this->keywords4,"
                    . " keywords5         = $this->keywords5,"
                    . " keywords7         = $this->keywords6,"
                    . " keywords6         = $this->keywords7,"
                    . " seo_keywords1     = $this->seo_keywords1,"
                    . " seo_keywords2     = $this->seo_keywords2,"
                    . " seo_keywords3     = $this->seo_keywords3,"
                    . " seo_keywords4     = $this->seo_keywords4,"
                    . " seo_keywords5     = $this->seo_keywords5,"
                    . " seo_keywords6     = $this->seo_keywords6,"
                    . " seo_keywords7     = $this->seo_keywords7,"
                    . " updated           = NOW(),"
                    . " start_date        = $this->start_date,"
                    . " has_start_time    = $this->has_start_time,"
                    . " start_time        = $this->start_time,"
                    . " end_date          = $this->end_date,"
                    . " has_end_time      = $this->has_end_time,"
                    . " end_time          = $this->end_time,"
                    . " location          = $this->location,"
                    . " address           = $this->address,"
                    . " zip_code          = $this->zip_code,"
                    . " location_1        = $this->location_1,"
                    . " location_2        = $this->location_2,"
                    . " location_3        = $this->location_3,"
                    . " location_4        = $this->location_4,"
                    . " location_5        = $this->location_5,"
                    . " url               = $this->url,"
                    . " contact_name      = $this->contact_name,"
                    . " phone             = $this->phone,"
                    . " email             = $this->email,"
                    . " renewal_date      = $this->renewal_date,"
                    . " discount_id       = $this->discount_id,"
                    . " status            = $this->status,"
                    . " level             = $this->level,"
                    . " recurring         = $this->recurring,"
                    . " day 			  = $this->day,"
                    . " dayofweek		  = $this->dayofweek,"
                    . " week			  = $this->week,"
                    . " month			  = $this->month,"
                    . " until_date        = $this->until_date,"
                    . " repeat_event	  = $this->repeat_event,"
                    . " number_views      = $this->number_views,"
                    . " latitude          = $this->latitude,"
                    . " longitude         = $this->longitude,"
                    . " map_zoom          = $this->map_zoom,"
                    . " package_id		  = $this->package_id,"
                    . " package_price	  = $this->package_price"
                    . " WHERE id          = $this->id";

            $dbObj->query($sql);

            $last_status = str_replace("\"", "", $last_status);
            $last_status = str_replace("'", "", $last_status);
            $this_status = str_replace("\"", "", $this_status);
            $this_status = str_replace("'", "", $this_status);
            $this_id = str_replace("\"", "", $this_id);
            $this_id = str_replace("'", "", $this_id);

            /////
            $lastendDateStr = explode("-", $last_end_date);
            $lastuntilDateStr = explode("-", $last_until_date);
            $endDateStr = explode("-", $this->end_date);
            $untilDateStr = explode("-", $this->until_date);


            $lastendDateStr = $lastendDateStr[0] . $lastendDateStr[1] . $lastendDateStr[2];
            $lastuntilDateStr = $lastuntilDateStr[0] . $lastuntilDateStr[1] . $lastuntilDateStr[2];
            $endDateStr = $endDateStr[0] . $endDateStr[1] . $endDateStr[2];
            $untilDateStr = $untilDateStr[0] . $untilDateStr[1] . $untilDateStr[2];
            $endDateStr = str_replace("'", "", $endDateStr);
            $untilDateStr = str_replace("'", "", $untilDateStr);
            ////

            $incCheck = false;
            $decCheck1 = false;
            $decCheck2 = false;
            //if end_date/until_date is in the past and item status = A, category_count doesn't need changes, because daily_maintenance already did.
            //only change the counter if sitemgr/member corrects the date to future
            if (($last_status == "A" && $this_status == "A") && (($lastendDateStr < date("Ymd") && $endDateStr >= date("Ymd") && $this->recurring == "'N'") || ($this->recurring == "'Y'" && $this->repeat == "'N'" && $lastuntilDateStr < date("Ymd") && $untilDateStr >= date("Ymd")))) {
                $incCheck = true;
            }

            if (($last_status == "A" && $this_status != "A") && (($lastendDateStr < date("Ymd") && $endDateStr < date("Ymd") && $this->recurring == "'N'") || ($this->recurring == "'Y'" && $this->repeat == "'N'" && $lastuntilDateStr < date("Ymd") && $untilDateStr < date("Ymd")))) {
                $decCheck1 = true; //doesn't need any changes
            }

            if (($last_status != "A" && $this_status == "A") && (($lastendDateStr < date("Ymd") && $endDateStr < date("Ymd") && $this->recurring == "'N'") || ($this->recurring == "'Y'" && $this->repeat == "'N'" && $lastuntilDateStr < date("Ymd") && $untilDateStr < date("Ymd")))) {
                $decCheck2 = true; //doesn't need any changes
            }

            if ($incCheck)
                system_countActiveItemByCategory("event", $this_id, "inc");
            if (($this_status == "A") && ($last_status != "A") && !$decCheck2)
                system_countActiveItemByCategory("event", $this_id, "inc");
            elseif (($last_status == "A") && ($this_status != "A") && !$decCheck1)
                system_countActiveItemByCategory("event", $this_id, "dec");

            if ($aux_old_account != $aux_account && $aux_account != 0) {
                domain_SaveAccountInfoDomain($aux_account, $this);
            }

            if ($last_status != "P" && $this_status == "P") {
                activity_newToApproved($aux_log_domain_id, $this->id, "event", $this->title);
            } else if ($last_status == "P" && $this_status != "P") {
                activity_deleteRecord($aux_log_domain_id, $this->id, "event");
            } else if ($last_status == $this_status) {
                activity_updateRecord($aux_log_domain_id, $this->id, $this->title, "item", "event");
            }
        } else {

            $sql = "INSERT INTO Event"
                    . " (account_id,"
                    . " title,"
                    . " seo_title,"
                    . " friendly_url,"
                    . " image_id,"
                    . " thumb_id,"
                    . " description1,"
                    . " description2,"
                    . " description3,"
                    . " description4,"
                    . " description5,"
                    . " description6,"
                    . " description7,"
                    . " seo_description1,"
                    . " seo_description2,"
                    . " seo_description3,"
                    . " seo_description4,"
                    . " seo_description5,"
                    . " seo_description6,"
                    . " seo_description7,"
                    . " long_description1,"
                    . " long_description2,"
                    . " long_description3,"
                    . " long_description4,"
                    . " long_description5,"
                    . " long_description6,"
                    . " long_description7,"
                    . " keywords1,"
                    . " keywords2,"
                    . " keywords3,"
                    . " keywords4,"
                    . " keywords5,"
                    . " keywords6,"
                    . " keywords7,"
                    . " seo_keywords1,"
                    . " seo_keywords2,"
                    . " seo_keywords3,"
                    . " seo_keywords4,"
                    . " seo_keywords5,"
                    . " seo_keywords6,"
                    . " seo_keywords7,"
                    . " updated,"
                    . " entered,"
                    . " start_date,"
                    . " has_start_time,"
                    . " start_time,"
                    . " end_date,"
                    . " has_end_time,"
                    . " end_time,"
                    . " location,"
                    . " address,"
                    . " zip_code,"
                    . " location_1,"
                    . " location_2,"
                    . " location_3,"
                    . " location_4,"
                    . " location_5,"
                    . " url,"
                    . " contact_name,"
                    . " phone,"
                    . " email,"
                    . " renewal_date,"
                    . " discount_id,"
                    . " status,"
                    . " level,"
                    . " fulltextsearch_keyword,"
                    . " fulltextsearch_where,"
                    . " recurring,"
                    . " day,"
                    . " dayofweek,"
                    . " week,"
                    . " month,"
                    . " until_date,"
                    . " repeat_event,"
                    . " number_views,"
                    . " latitude,"
                    . " longitude,"
                    . " map_zoom,"
                    . " package_id,"
                    . " package_price)"
                    . " VALUES"
                    . " ($this->account_id,"
                    . " $this->title,"
                    . " $this->title,"
                    . " $this->friendly_url,"
                    . " $this->image_id,"
                    . " $this->thumb_id,"
                    . " $this->description1,"
                    . " $this->description2,"
                    . " $this->description3,"
                    . " $this->description4,"
                    . " $this->description5,"
                    . " $this->description6,"
                    . " $this->description7,"
                    . " $this->description1,"
                    . " $this->description2,"
                    . " $this->description3,"
                    . " $this->description4,"
                    . " $this->description5,"
                    . " $this->description6,"
                    . " $this->description7,"
                    . " $this->long_description1,"
                    . " $this->long_description2,"
                    . " $this->long_description3,"
                    . " $this->long_description4,"
                    . " $this->long_description5,"
                    . " $this->long_description6,"
                    . " $this->long_description7,"
                    . " $this->keywords1,"
                    . " $this->keywords2,"
                    . " $this->keywords3,"
                    . " $this->keywords4,"
                    . " $this->keywords5,"
                    . " $this->keywords6,"
                    . " $this->keywords7,"
                    . " " . str_replace(" || ", ", ", $this->keywords1) . ","
                    . " " . str_replace(" || ", ", ", $this->keywords2) . ","
                    . " " . str_replace(" || ", ", ", $this->keywords3) . ","
                    . " " . str_replace(" || ", ", ", $this->keywords4) . ","
                    . " " . str_replace(" || ", ", ", $this->keywords5) . ","
                    . " " . str_replace(" || ", ", ", $this->keywords6) . ","
                    . " " . str_replace(" || ", ", ", $this->keywords7) . ","
                    . " NOW(),"
                    . " NOW(),"
                    . " $this->start_date,"
                    . " $this->has_start_time,"
                    . " $this->start_time,"
                    . " $this->end_date,"
                    . " $this->has_end_time,"
                    . " $this->end_time,"
                    . " $this->location,"
                    . " $this->address,"
                    . " $this->zip_code,"
                    . " $this->location_1,"
                    . " $this->location_2,"
                    . " $this->location_3,"
                    . " $this->location_4,"
                    . " $this->location_5,"
                    . " $this->url,"
                    . " $this->contact_name,"
                    . " $this->phone,"
                    . " $this->email,"
                    . " $this->renewal_date,"
                    . " $this->discount_id,"
                    . " $this->status,"
                    . " $this->level,"
                    . " '',"
                    . " '',"
                    . " $this->recurring,"
                    . " $this->day,"
                    . " $this->dayofweek,"
                    . " $this->week,"
                    . " $this->month,"
                    . " $this->until_date,"
                    . " $this->repeat_event,"
                    . " $this->number_views,"
                    . " $this->latitude,"
                    . " $this->longitude,"
                    . " $this->map_zoom,"
                    . " $this->package_id,"
                    . " $this->package_price)";

            $dbObj->query($sql);
            $this->id = mysql_insert_id($dbObj->link_id);

            if (sess_getAccountIdFromSession() || string_strpos($_SERVER["PHP_SELF"], "order_") !== false) {
                activity_newActivity($aux_log_domain_id, $this->account_id, 0, "newitem", "event", $this->title);
            }

            if ($this->status == "'P'") {
                activity_newToApproved($aux_log_domain_id, $this->id, "event", $this->title);
            }

            domain_updateDashboard("number_content", "inc", 0, $aux_log_domain_id);

            $this_status = $this->status;
            $this_id = $this->id;
            $this_status = str_replace("\"", "", $this_status);
            $this_status = str_replace("'", "", $this_status);
            $this_id = str_replace("\"", "", $this_id);
            $this_id = str_replace("'", "", $this_id);
            if ($this_status == "A")
                system_countActiveItemByCategory("event", $this_id, "inc");

            if ($aux_account != 0) {
                domain_SaveAccountInfoDomain($aux_account, $this);
            }
        }

        $this->prepareToUse();

        $this->setFullTextSearch();
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->Delete();
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Delete
     * @access Public
     * @param integer $domain_id
     */
    function Delete($domain_id = false) {

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if ($domain_id) {
            $dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
        } else {
            if (defined("SELECTED_DOMAIN_ID")) {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $dbObj = db_getDBObject();
            }
            unset($dbMain);
        }
        ### EVENT CATEGORY
        if ($this->status == "A")
            system_countActiveItemByCategory("event", $this->id, "dec", false, $domain_id);

        ### GALERY
        $sql = "DELETE FROM Gallery_Item WHERE item_type = 'event' AND item_id = $this->id";
        $dbObj->query($sql);

        ### IMAGE
        if ($this->image_id) {
            $image = new Image($this->image_id);
            if ($image)
                $image->Delete($domain_id);
        }
        if ($this->thumb_id) {
            $image = new Image($this->thumb_id);
            if ($image)
                $image->Delete($domain_id);
        }

        ### INVOICE
        $sql = "UPDATE Invoice_Event SET event_id = '0' WHERE event_id = $this->id";
        $dbObj->query($sql);

        ### PAYMENT
        $sql = "UPDATE Payment_Event_Log SET event_id = '0' WHERE event_id = $this->id";
        $dbObj->query($sql);

        ### GALERY
        $sql = "DELETE FROM Gallery_Item WHERE item_type = 'event' AND item_id = $this->id";
        $dbObj->query($sql);

        ### EVENT
        $sql = "DELETE FROM Event WHERE id = $this->id";
        $dbObj->query($sql);

        if ($domain_id) {
            $domain_idDash = $domain_id;
        } else {
            $domain_idDash = SELECTED_DOMAIN_ID;
        }

        domain_updateDashboard("number_content", "dec", 0, $domain_idDash);

        activity_deleteRecord($domain_idDash, $this->id, "event");
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->updateImage($imageArray);
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->updateImage($imageArray);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name updateImage
     * @access Public
     * @param array $imageArray
     */
    function updateImage($imageArray) {
        unset($imageObj);
        if ($this->image_id) {
            $imageobj = new Image($this->image_id);
            if ($imageobj)
                $imageobj->delete();
        }
        $this->image_id = $imageArray["image_id"];
        unset($imageObj);
        if ($this->thumb_id) {
            $imageObj = new Image($this->thumb_id);
            if ($imageObj)
                $imageObj->delete();
        }
        $this->thumb_id = $imageArray["thumb_id"];
        unset($imageObj);
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->getCategories();
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->getCategories();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getCategories
     * @access Public
     * @return array
     */
    function getCategories() {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);
        $sql = "SELECT cat_1_id, cat_2_id, cat_3_id, cat_4_id, cat_5_id FROM Event WHERE id = $this->id";
        $r = $dbObj->query($sql);
        while ($row = mysql_fetch_array($r)) {
            if ($row["cat_1_id"])
                $categories[] = new EventCategory($row["cat_1_id"]);
            if ($row["cat_2_id"])
                $categories[] = new EventCategory($row["cat_2_id"]);
            if ($row["cat_3_id"])
                $categories[] = new EventCategory($row["cat_3_id"]);
            if ($row["cat_4_id"])
                $categories[] = new EventCategory($row["cat_4_id"]);
            if ($row["cat_5_id"])
                $categories[] = new EventCategory($row["cat_5_id"]);
        }
        return $categories;
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->setCategories();
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->setCategories();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setCategories
     * @access Public
     */
    function setCategories($array) {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);

        if ($this->status == "A")
            system_countActiveItemByCategory("event", $this->id, "dec");

        $cat_1_id = 0;
        $parcat_1_level1_id = 0;
        $parcat_1_level2_id = 0;
        $parcat_1_level3_id = 0;
        $parcat_1_level4_id = 0;
        $cat_2_id = 0;
        $parcat_2_level1_id = 0;
        $parcat_2_level2_id = 0;
        $parcat_2_level3_id = 0;
        $parcat_2_level4_id = 0;
        $cat_3_id = 0;
        $parcat_3_level1_id = 0;
        $parcat_3_level2_id = 0;
        $parcat_3_level3_id = 0;
        $parcat_3_level4_id = 0;
        $cat_4_id = 0;
        $parcat_4_level1_id = 0;
        $parcat_4_level2_id = 0;
        $parcat_4_level3_id = 0;
        $parcat_4_level4_id = 0;
        $cat_5_id = 0;
        $parcat_5_level1_id = 0;
        $parcat_5_level2_id = 0;
        $parcat_5_level3_id = 0;
        $parcat_5_level4_id = 0;
        if ($array) {
            $count_category_aux = 1;
            foreach ($array as $category) {
                if ($category) {
                    unset($parents);
                    $cat_id = $category;
                    $i = 0;
                    while ($cat_id != 0) {
                        $sql = "SELECT * FROM EventCategory WHERE id = $cat_id";
                        $rs1 = $dbObj->query($sql);
                        if (mysql_num_rows($rs1) > 0) {
                            $cat_info = mysql_fetch_assoc($rs1);
                            $cat_id = $cat_info["category_id"];
                            $parents[$i++] = $cat_id;
                        } else {
                            $cat_id = 0;
                        }
                    }
                    for ($j = count($parents) - 1; $j < 4; $j++) {
                        $parents[$j] = 0;
                    }
                    ${"cat_" . $count_category_aux . "_id"} = $category;
                    ${"parcat_" . $count_category_aux . "_level1_id"} = $parents[0];
                    ${"parcat_" . $count_category_aux . "_level2_id"} = $parents[1];
                    ${"parcat_" . $count_category_aux . "_level3_id"} = $parents[2];
                    ${"parcat_" . $count_category_aux . "_level4_id"} = $parents[3];
                    $count_category_aux++;
                }
            }
        }
        $sql = "UPDATE Event SET cat_1_id = " . $cat_1_id . ", parcat_1_level1_id = " . $parcat_1_level1_id . ", parcat_1_level2_id = " . $parcat_1_level2_id . ", parcat_1_level3_id = " . $parcat_1_level3_id . ", parcat_1_level4_id = " . $parcat_1_level4_id . ", cat_2_id = " . $cat_2_id . ", parcat_2_level1_id = " . $parcat_2_level1_id . ", parcat_2_level2_id = " . $parcat_2_level2_id . ", parcat_2_level3_id = " . $parcat_2_level3_id . ", parcat_2_level4_id = " . $parcat_2_level4_id . ", cat_3_id = " . $cat_3_id . ", parcat_3_level1_id = " . $parcat_3_level1_id . ", parcat_3_level2_id = " . $parcat_3_level2_id . ", parcat_3_level3_id = " . $parcat_3_level3_id . ", parcat_3_level4_id = " . $parcat_3_level4_id . ", cat_4_id = " . $cat_4_id . ", parcat_4_level1_id = " . $parcat_4_level1_id . ", parcat_4_level2_id = " . $parcat_4_level2_id . ", parcat_4_level3_id = " . $parcat_4_level3_id . ", parcat_4_level4_id = " . $parcat_4_level4_id . ", cat_5_id = " . $cat_5_id . ", parcat_5_level1_id = " . $parcat_5_level1_id . ", parcat_5_level2_id = " . $parcat_5_level2_id . ", parcat_5_level3_id = " . $parcat_5_level3_id . ", parcat_5_level4_id = " . $parcat_5_level4_id . " WHERE id = $this->id";
        $dbObj->query($sql);
        $this->setFullTextSearch();

        if ($this->status == "A")
            system_countActiveItemByCategory("event", $this->id, "inc");
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->getCategories();
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->getCategories();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getCategories
     * @access Public
     * @return real
     */
    function getPrice() {

        $price = 0;

        $dbMain = db_getDBObject(DEFAULT_DB, true);

        if ($this->domain_id) {
            $dbObj = db_getDBObjectByDomainID($this->domain_id, $dbMain);
        } else if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);

        $levelObj = new EventLevel();
        if ($this->package_id) {
            $price = $this->package_price;
        } else {
            $price = $price + $levelObj->getPrice($this->level);
        }

        if ($this->discount_id) {

            $discountCodeObj = new DiscountCode($this->discount_id);

            if (is_valid_discount_code($this->discount_id, "event", $this->id, $discount_message, $discount_error)) {

                if ($discountCodeObj->getString("id") && $discountCodeObj->expire_date >= date('Y-m-d')) {

                    if ($discountCodeObj->getString("type") == "percentage") {
                        $price = $price * (1 - $discountCodeObj->getString("amount") / 100);
                    } elseif ($discountCodeObj->getString("type") == "monetary value") {
                        $price = $price - $discountCodeObj->getString("amount");
                    }
                } elseif (($discountCodeObj->type == 'percentage' && $discountCodeObj->amount == '100.00') || ($discountCodeObj->type == 'monetary value' && $discountCodeObj->amount > $price)) {
                    $this->status = 'E';
                    $this->renewal_date = $discountCodeObj->expire_date;

                    $sql = "UPDATE Event SET status = 'E', renewal_date = '" . $discountCodeObj->expire_date . "', discount_id = '' WHERE id = " . $this->id;
                    $result = $dbObj->query($sql);
                }
            } else {

                if (($discountCodeObj->type == 'percentage' && $discountCodeObj->amount == '100.00') || ($discountCodeObj->type == 'monetary value' && $discountCodeObj->amount > $price)) {
                    $this->status = 'E';
                    $this->renewal_date = $discountCodeObj->expire_date;
                    $sql = "UPDATE Event SET status = 'E', renewal_date = '" . $discountCodeObj->expire_date . "', discount_id = '' WHERE id = " . $this->id;
                } else {
                    $sql = "UPDATE Event SET discount_id = '' WHERE id = " . $this->id;
                }
                $result = $dbObj->query($sql);
            }
        }

        if ($price <= 0)
            $price = 0;

        return $price;
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->hasRenewalDate();
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->hasRenewalDate();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name hasRenewalDate
     * @access Public
     * @return boolean
     */
    function hasRenewalDate() {
        if (PAYMENT_FEATURE != "on")
            return false;
        if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on") && (MANUALPAYMENT_FEATURE != "on"))
            return false;
        if ($this->getPrice() <= 0)
            return false;
        return true;
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->needToCheckOut();
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->needToCheckOut();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name needToCheckOut
     * @access Public
     * @return boolean
     */
    function needToCheckOut() {

        if ($this->hasRenewalDate()) {

            $today = date("Y-m-d");
            $today = explode("-", $today);
            $today_year = $today[0];
            $today_month = $today[1];
            $today_day = $today[2];
            $timestamp_today = mktime(0, 0, 0, $today_month, $today_day, $today_year);

            $this_renewaldate = $this->renewal_date;
            $renewaldate = explode("-", $this_renewaldate);
            $renewaldate_year = $renewaldate[0];
            $renewaldate_month = $renewaldate[1];
            $renewaldate_day = $renewaldate[2];
            $timestamp_renewaldate = mktime(0, 0, 0, $renewaldate_month, $renewaldate_day, $renewaldate_year);

            if (($this->status == "E") || ($this_renewaldate == "0000-00-00") || ($timestamp_today > $timestamp_renewaldate)) {
                return true;
            }
        }

        return false;
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->getNextRenewalDate($times);
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->getNextRenewalDate($times);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getNextRenewalDate
     * @access Public
     * @param integer $times
     * @return date
     */
    function getNextRenewalDate($times = 1) {

        $nextrenewaldate = "0000-00-00";

        if ($this->hasRenewalDate()) {

            if ($this->needToCheckOut()) {

                $today = date("Y-m-d");
                $today = explode("-", $today);
                $start_year = $today[0];
                $start_month = $today[1];
                $start_day = $today[2];
            } else {

                $this_renewaldate = $this->renewal_date;
                $renewaldate = explode("-", $this_renewaldate);
                $start_year = $renewaldate[0];
                $start_month = $renewaldate[1];
                $start_day = $renewaldate[2];
            }

            $renewalcycle = payment_getRenewalCycle("event");
            $renewalunit = payment_getRenewalUnit("event");

            if ($renewalunit == "Y") {
                $nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int) $start_month, (int) $start_day, (int) $start_year + ($renewalcycle * $times)));
            } elseif ($renewalunit == "M") {
                $nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int) $start_month + ($renewalcycle * $times), (int) $start_day, (int) $start_year));
            } elseif ($renewalunit == "D") {
                $nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int) $start_month, (int) $start_day + ($renewalcycle * $times), (int) $start_year));
            }
        }

        return $nextrenewaldate;
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->getDateString();
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->getDateString();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getDateString
     * @access Public
     * @return string
     */
    function getDateString($use_text = false) {
        $str_date = "";

        if ($this->getDate("start_date") == $this->getDate("end_date")) {
            $str_date = $this->getDate("start_date");
        } elseif ($this->getString("recurring") != "Y") {
            if ($use_text) {
                $str_date = "<p><strong>" . ucfirst(system_showText(LANG_LABEL_FROM)) . ":</strong>" . "<span>" . $this->getDate("start_date") . "</span></p>" . "<p><strong>" . ucfirst(system_showText(LANG_LABEL_DATE_TO)) . ":</strong>" . "<span>" . $this->getDate("end_date") . "</span></p>";
            } else {
                $str_date = $this->getDate("start_date") . " - " . $this->getDate("end_date");
            }
        } else {
            $str_date = $this->getDate("start_date");
        }

        return $str_date;
    }

    function getDateStringEnd() {
        $str_date = "";
        $str_date = $this->getDate("until_date");

        return $str_date;
    }

    function getDateStringRecurring() {
        $str_date = "";

        if ($this->getString("recurring") == "Y") {

            $month_names = explode(",", LANG_DATE_MONTHS);
            $weekday_names = explode(",", LANG_DATE_WEEKDAYS);
            if ($this->getString("dayofweek") and $this->getNumber("week") and $this->getNumber("month")) {
                $aux = system_getRecurringWeeks($this->getString("week"));
                $checkDays = system_checkDay($this->getString("dayofweek"));
                $str_date .= $checkDays;
                if ($aux)
                    $str_date .= " " . system_showText(LANG_OF) . " " . $aux . system_showText(LANG_WEEK) . " " . system_showText(LANG_OF2) . " " . ucfirst($month_names[$this->getNumber("month") - 1]);
                else
                    $str_date .= " " . system_showText(LANG_OF2) . " " . ucfirst($month_names[$this->getNumber("month") - 1]);
            }elseif ($this->getNumber("day")) {
                if ($this->getNumber("month")) {
                    if (EDIR_LANGUAGE == "en_us")
                        $str_date .= ucfirst($month_names[$this->getNumber("month") - 1]) . " " . $this->getNumber("day");
                    else
                        $str_date .= ucfirst(system_showText(LANG_DAY)) . " " . $this->getNumber("day") . " " . system_showText(LANG_OF2) . " " . ucfirst($month_names[$this->getNumber("month") - 1]);
                }else {
                    $str_date .= system_showText(LANG_EVERY2) . " " . system_showText(LANG_DAY) . " " . $this->getNumber("day");
                }
            } elseif ($this->getString("dayofweek")) {

                if ($this->getNumber("week")) {

                    $aux = system_getRecurringWeeks($this->getString("week"));
                    $checkDays = system_checkDay($this->getString("dayofweek"));
                    $str_date .= $checkDays . " ";
                    if ($aux)
                        $str_date .= LANG_OF3 . " " . $aux . LANG_WEEK;
                }else {
                    $checkDays = system_checkDay($this->getString("dayofweek"));
                    $str_date .= $checkDays;
                }
            } else {
                $str_date .= system_showText(LANG_DAILY2);
            }
        }

        return $str_date;
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->getTimeString();
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->getTimeString();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getTimeString
     * @access Public
     * @return string
     */
    function getTimeString() {
        $str_time = "";
        if ($this->getString("has_start_time") == "y") {
            $startTimeStr = explode(":", $this->getString("start_time"));
            if (CLOCK_TYPE == '24') {
                $start_time_hour = $startTimeStr[0];
            } elseif (CLOCK_TYPE == '12') {
                if ($startTimeStr[0] > "12") {
                    $start_time_hour = $startTimeStr[0] - 12;
                    $start_time_am_pm = "pm";
                } elseif ($startTimeStr[0] == "12") {
                    $start_time_hour = 12;
                    $start_time_am_pm = "pm";
                } elseif ($startTimeStr[0] == "00") {
                    $start_time_hour = 12;
                    $start_time_am_pm = "am";
                } else {
                    $start_time_hour = $startTimeStr[0];
                    $start_time_am_pm = "am";
                }
            }
            if ($start_time_hour < 10)
                $start_time_hour = "0" . ($start_time_hour + 0);
            $start_time_min = $startTimeStr[1];
            $str_time .= $start_time_hour . ":" . $start_time_min . " " . $start_time_am_pm;
        } else {
            $str_time .= LANG_NA;
        }
        $str_time .= " - ";
        if ($this->getString("has_end_time") == "y") {
            $endTimeStr = explode(":", $this->getString("end_time"));
            if (CLOCK_TYPE == '24') {
                $end_time_hour = $endTimeStr[0];
            } elseif (CLOCK_TYPE == '12') {
                if ($endTimeStr[0] > "12") {
                    $end_time_hour = $endTimeStr[0] - 12;
                    $end_time_am_pm = "pm";
                } elseif ($endTimeStr[0] == "12") {
                    $end_time_hour = 12;
                    $end_time_am_pm = "pm";
                } elseif ($endTimeStr[0] == "00") {
                    $end_time_hour = 12;
                    $end_time_am_pm = "am";
                } else {
                    $end_time_hour = $endTimeStr[0];
                    $end_time_am_pm = "am";
                }
            }
            if ($end_time_hour < 10)
                $end_time_hour = "0" . ($end_time_hour + 0);
            $end_time_min = $endTimeStr[1];
            $str_time .= $end_time_hour . ":" . $end_time_min . " " . $end_time_am_pm;
        } else {
            $str_time .= LANG_NA;
        }
        if (($this->getString("has_start_time") == "n") && ($this->getString("has_end_time") == "n")) {
            $str_time = "";
        }
        return $str_time;
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->getMonthAbbr();
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->getMonthAbbr();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getMonthAbbr
     * @access Public
     * @return string
     */
    function getMonthAbbr() {
        $aux = explode("/", $this->getDate("start_date"));
        $months = explode(",", LANG_DATE_MONTHS);
        if (DEFAULT_DATE_FORMAT == "m/d/Y")
            $month = $aux[0];
        else
            $month = $aux[1];

        switch ($month) {
            case "01" : return string_substr($months[0], 0, 3);
                break;
            case "02" : return string_substr($months[1], 0, 3);
                break;
            case "03" : return string_substr($months[2], 0, 3);
                break;
            case "04" : return string_substr($months[3], 0, 3);
                break;
            case "05" : return string_substr($months[4], 0, 3);
                break;
            case "06" : return string_substr($months[5], 0, 3);
                break;
            case "07" : return string_substr($months[6], 0, 3);
                break;
            case "08" : return string_substr($months[7], 0, 3);
                break;
            case "09" : return string_substr($months[8], 0, 3);
                break;
            case "10" : return string_substr($months[9], 0, 3);
                break;
            case "11" : return string_substr($months[10], 0, 3);
                break;
            case "12" : return string_substr($months[11], 0, 3);
                break;
        }
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->checkStartDate();
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->checkStartDate();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name checkStartDate
     * @access Public
     * @return string
     */
    function checkStartDate() {
        if ($this->getString("recurring") != "Y") {
            $today = date("Y-m-d");
            $auxStartDate = explode("/", $this->getDate("start_date"));
            if (DEFAULT_DATE_FORMAT == "m/d/Y") {
                $startDate = $auxStartDate[2] . "-" . $auxStartDate[0] . "-" . $auxStartDate[1];
            } else {
                $startDate = $auxStartDate[2] . "-" . $auxStartDate[1] . "-" . $auxStartDate[0];
            }
            if ($today == $startDate) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->getMonthAbbr();
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->getMonthAbbr();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getTimeString
     * @access Public
     * @return string
     */
    function getDayStr() {
        $aux = explode("/", $this->getDate("start_date"));
        if (DEFAULT_DATE_FORMAT == "m/d/Y")
            return $aux[1];
        else
            return $aux[0];
    }

    /**
     * <code>
     * 		//Using this in Event() class.
     * 		$this->setLocationManager(&$locationManager);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setLocationManager
     * @access Public
     * @param string $locationManager
     */
    function setLocationManager(&$locationManager) {
        $this->locationManager = & $locationManager;
    }

    /**
     * <code>
     * 		//Using this in Event() class.
     * 		$this->getLocationManager();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getLocationManager
     * @access Public
     * @return array
     */
    function &getLocationManager() {
        return $this->locationManager; /* NEVER auto-instantiate this */
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->getLocationString($format,$forceManagerCreation);
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->getLocationString();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getLocationString
     * @access Public
     * @param string $format, boolean $forceManagerCreation
     * @return array
     */
    function getLocationString($format, $forceManagerCreation = false) {
        if ($forceManagerCreation && !$this->locationManager)
            $this->locationManager = new LocationManager();
        return db_getLocationString($this, $format);
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->setFullTextSearch();
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->setFullTextSearch();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setFullTextSearch
     * @access Public
     */
    function setFullTextSearch() {

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);

        if ($this->title) {
            $string = str_replace(" || ", " ", $this->title);
            $fulltextsearch_keyword[] = $string;
            $addkeyword = format_addApostWords($string);
            if ($addkeyword != '')
                $fulltextsearch_keyword[] = $addkeyword;
            unset($addkeyword);
        }

        $edir_languages = explode(",", EDIR_LANGUAGENUMBERS);

        foreach ($edir_languages as $lang_index) {
            if ($this->{"keywords" . $lang_index}) {
                $string = str_replace(" || ", " ", $this->{"keywords" . $lang_index});
                $fulltextsearch_keyword[] = $string;
                $addkeyword = format_addApostWords($string);
                if ($addkeyword != '')
                    $fulltextsearch_keyword[] = $addkeyword;
                unset($addkeyword);
            }

            if ($this->{"description" . $lang_index}) {
                $fulltextsearch_keyword[] = string_substr($this->{"description" . $lang_index}, 0, 100);
            }
        }

        if ($this->address) {
            $fulltextsearch_where[] = $this->address;
        }

        if ($this->location) {
            $fulltextsearch_where[] = $this->location;
        }

        if ($this->zip_code) {
            $fulltextsearch_where[] = $this->zip_code;
        }

        $Location1 = new Location1($this->location_1);
        if ($Location1->getNumber("id")) {
            $fulltextsearch_where[] = $Location1->getString("name", false);
            if ($Location1->getString("abbreviation")) {
                $fulltextsearch_where[] = $Location1->getString("abbreviation", false);
            }
        }

        $_locations = explode(",", EDIR_LOCATIONS);
        foreach ($_locations as $each_location) {
            unset($objLocation);
            $objLocationLabel = "Location" . $each_location;
            $attributeLocation = 'location_' . $each_location;
            $objLocation = new $objLocationLabel;
            $objLocation->SetString("id", $this->$attributeLocation);
            $locationsInfo = $objLocation->retrieveLocationById();
            if ($locationsInfo["id"]) {
                $fulltextsearch_where[] = $locationsInfo["name"];
                if ($locationsInfo["abbreviation"]) {
                    $fulltextsearch_where[] = $locationsInfo["abbreviation"];
                }
            }
        }

        $categories = $this->getCategories();
        if ($categories) {
            foreach ($categories as $category) {
                unset($parents);
                $category_id = $category->getNumber("id");
                while ($category_id != 0) {
                    $sql = "SELECT * FROM EventCategory WHERE id = $category_id";
                    $result = $dbObj->query($sql);
                    if (mysql_num_rows($result) > 0) {
                        $category_info = mysql_fetch_assoc($result);
                        $langs = explode(",", $category_info["lang"]);
                        if (is_array($langs) && $langs[0]) {
                            $langObj = new Lang();
                            foreach ($langs as $lang) {
                                if ($lang) {
                                    $lang_id = $langObj->returnLangId($lang);

                                    if ($category_info["enabled"] == "y") {
                                        if ($category_info["title" . $lang_id]) {
                                            $fulltextsearch_keyword[] = $category_info["title" . $lang_id];
                                        }

                                        if ($category_info["keywords" . $lang_id]) {
                                            $fulltextsearch_keyword[] = $category_info["keywords" . $lang_id];
                                        }
                                    }
                                }
                            }
                        }
                        $category_id = $category_info["category_id"];
                    } else {
                        $category_id = 0;
                    }
                }
            }
        }

        if (is_array($fulltextsearch_keyword)) {
            $fulltextsearch_keyword_sql = db_formatString(implode(" ", $fulltextsearch_keyword));
            $sql = "UPDATE Event SET fulltextsearch_keyword = $fulltextsearch_keyword_sql WHERE id = $this->id";
            $result = $dbObj->query($sql);
        }
        if (is_array($fulltextsearch_where)) {
            $fulltextsearch_where_sql = db_formatString(implode(" ", $fulltextsearch_where));
            $sql = "UPDATE Event SET fulltextsearch_where = $fulltextsearch_where_sql WHERE id = $this->id";
            $result = $dbObj->query($sql);
        }
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->getGalleries();
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->getGalleries();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name getGalleries
     * @access Public
     * @return array
     */
    function getGalleries() {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);
        $sql = "SELECT * FROM Gallery_Item WHERE item_type='event' AND item_id = $this->id ORDER BY gallery_id";
        $r = $dbObj->query($sql);
        if ($this->id > 0)
            while ($row = mysql_fetch_array($r))
                $galleries[] = $row["gallery_id"];
        return $galleries;
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->setGalleries($gallery);
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->setGalleries($gallery);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setGalleries
     * @access Public
     * @param integer $gallery
     */
    function setGalleries($gallery = false) {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);
        $sql = "DELETE FROM Gallery_Item WHERE item_type='event' AND item_id = $this->id";
        $dbObj->query($sql);
        if ($gallery) {
            $sql = "INSERT INTO Gallery_Item (item_id, gallery_id, item_type) VALUES ($this->id, $gallery, 'event')";
            $rs3 = $dbObj->query($sql);
        }
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->setMapTuning($latitude_longitude,$map_zoom);
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->setMapTuning($gallery);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setMapTuning
     * @access Public
     * @param string $latitude_longitude, integer $map_zoom
     */
    function setMapTuning($latitude_longitude = "", $map_zoom) {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }
        unset($dbMain);

        $auxCoord = explode(",", $latitude_longitude);
        $latitude = $auxCoord[0];
        $longitude = $auxCoord[1];

        $sql = "UPDATE Event SET latitude = " . db_formatString($latitude) . ", longitude = " . db_formatString($longitude) . ", map_zoom = " . db_formatNumber($map_zoom) . " WHERE id = " . $this->id . "";
        $dbObj->query($sql);
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->hasDetail();
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->hasDetail();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name hasDetail
     * @access Public
     * @return char
     */
    function hasDetail() {
        $eventLevel = new EventLevel();
        $detail = $eventLevel->getDetail($this->level);
        unset($eventLevel);
        return $detail;
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->setNumberViews($id);
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->setNumberViews($id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name setNumberViews
     * @access Public
     * @param integer $id
     */
    function setNumberViews($id) {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if (defined("SELECTED_DOMAIN_ID")) {
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        } else {
            $dbObj = db_getDBObject();
        }

        unset($dbMain);
        $sql = "UPDATE Event SET number_views = " . $this->number_views . " + 1 WHERE Event.id = " . $id;
        $dbObj->query($sql);
    }

    /**
     * <code>
     * 		//Using this in forms or other pages.
     * 		$eventObj->deletePerAccount($account_id);
     * <br /><br />
     * 		//Using this in Event() class.
     * 		$this->deletePerAccount($account_id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name deletePerAccount
     * @access Public
     * @param integer $account_id
     * @param integer $domain_id
     */
    function deletePerAccount($account_id = 0, $domain_id = false) {
        if (is_numeric($account_id) && $account_id > 0) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if ($domain_id) {
                $dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
            } else {
                if (defined("SELECTED_DOMAIN_ID")) {
                    $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                } else {
                    $dbObj = db_getDBObject();
                }
                unset($dbMain);
            }
            $sql = "SELECT * FROM Event WHERE account_id = $account_id";
            $result = $dbObj->query($sql);
            while ($row = mysql_fetch_array($result)) {
                $this->makeFromRow($row);
                $this->Delete($domain_id);
            }
        }
    }

    function getFriendlyURL($mobile = false) {
        if ($mobile) {
            $aux_url = DEFAULT_URL . "/mobile/" . EVENT_FEATURE_FOLDER;
        } else {
            $aux_url = EVENT_DEFAULT_URL;
        }

        if (MODREWRITE_FEATURE == "on") {
            return $aux_url . "/" . $this->friendly_url . ".html";
        } else {
            return $aux_url . "/detail.php?id=" . $this->id;
        }
    }

}

?>
