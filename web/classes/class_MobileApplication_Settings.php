<?php
  
class MobileApplication_Settings extends Handle{
	var $id;
	var $name;
	var $value;
        var $readable_name;
	
	
	function MobileApplication_Settings($var='', $domain = false){
		if (is_numeric($var) && ($var)) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain) {
				$domain = str_replace("www.", "", $domain);
				$db = db_getDBObjectByDomainID(0, $dbMain, $domain);
			} else {
				if (defined("SELECTED_DOMAIN_ID")) {
					$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$db = db_getDBObject();
				}
				unset($dbMain);
			}
			$sql = "SELECT * FROM MobileApplication_Settings WHERE id = $var";
			$row = mysql_fetch_array($db->query($sql));
			$this->makeFromRow($row);
		}
		
	}
	
	function makeFromRow($row='') {

		$this->id		= ($row['id'])		? $row['id']		: 0;
		$this->name		= ($row['name'])	? $row['name']		: 0;
		$this->value	= ($row['value'])	? $row['value']		: "";
                $this->readable_name	= ($row['readable_name'])	? $row['readable_name']		: "";


	}
	
	function getByItemName($name,$domain = FALSE){
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		if ($domain) {
			$domain = str_replace("www.", "", $domain);
			$db = db_getDBObjectByDomainID(0, $dbMain, $domain);
		} else {
			if (defined("SELECTED_DOMAIN_ID")) {
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$db = db_getDBObject();
			}
			unset($dbMain);
		}
		$sql = "SELECT * FROM MobileApplication_Settings WHERE name ='$name'";
		$row = mysql_fetch_array($db->query($sql));
		$this->makeFromRow($row);
	}
	
	function updateByValue($value,$name){
		
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		if (defined("SELECTED_DOMAIN_ID")) {
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		} else {
			$dbObj = db_getDBObject();
		}

		unset($dbMain);
		if ($this->id) {
			$sql =	"UPDATE MobileApplication_Settings SET"
				. " value = $this->value"
				. " WHERE name = $name";
			$dbObj->query($sql);
		}
	}
	
	function Save() {

		

		$dbMain = db_getDBObject(DEFAULT_DB, true);
		if (defined("SELECTED_DOMAIN_ID")) {
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		} else {
			$dbObj = db_getDBObject();
		}

		unset($dbMain);
		if ($this->id) {
			$sql =	"UPDATE MobileApplication_Settings SET"
				. " name  = '$this->name', "
				. " value = '$this->value' "
				. " WHERE id = $this->id";
				
		
			$dbObj->query($sql);
		}
	}
}