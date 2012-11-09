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
    # * FILE: /classes/class_twitter.php
    # ----------------------------------------------------------------------------------------------------

	/**
	 * <code>
	 *		$twitterObj = new Twitter();
	 * <code>
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 7.5.00
	 * @package Classes
	 * @name Twitter
	 * @method Twitter
	 * @method makeFromRow
	 * @method Save
	 * @method Delete
	 * @method getRandonAccount
	 * @method setRPP
	 * @method setPN
	 * @method search
	 * @method userInfo
	 * @method prepareData
	 * @method objectsIntoArray
	 * @access Public
	 */
    class Twitter extends Handle {
		/**
		 * @var string
		 * @type constant
		 */
		const user_url = "http://api.twitter.com/1/users/show.xml?screen_name=";

		/**
		 * @var string
		 * @type constant
		 */
		const search_url = "http://search.twitter.com/search.atom";

		/**
		 * @var integer
		 * @access Private
		 */
		var $rows_per_page = 100;

		/**
		 * @var integer
		 * @access Private
		 */
		var $page_number = 1;

		/**
		 * @var string
		 * @access Private
		 */
		var $search_query;

		/**
		 * @var string
		 * @access Private
		 */
		var $search_user;

		/**
		 * @var array
		 * @access Private
		 */
		var $data_array;

		/**
		 * @var string
		 * @access Public
		 */
        var $account;

		/**
		 * <code>
		 *		$twitterObj = new Twitter();
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name Twitter
		 * @access Public
		 * @param integer $var
		 * @param array $var
		 */
        function Twitter($var='') {
			$this->makeFromRow($var);
		}

		/**
		 * <code>
		 *		$this->makeFromRow($row);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.00
		 * @name makeFromRow
		 * @access Public
		 * @param array $row
		 */
        function makeFromRow($row='') {
            $this->account           = ($row["account"])               ? $row["account"]           : ($this->account               ? $this->account           :  '');   
        }
        

		/**
		 * <code>
		 *		//Using this in forms or other pages.
		 *		if ($twitterObj->getRandonAccount()) $twitterAccount = $twitterObj->getString("account");
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.10
		 * @name getRandonAccount
		 * @access Public
		 * @return Boolean
		 */
		function getRandonAccount () {
			
			setting_get("twitter_account", $account);
			
			if ($account){
				$this->account = $account;
				$this->search_user = $account;
				return true;
			} else {
				return false;
			}
		}

		/**
		 * //Used to set the number of rows of the Twitter search
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$twitterObj->setRPP(10);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.10
		 * @name setRPP
		 * @access Public
		 * @param integer $count
		 */
		public function setRPP ($count) {
	        $this->rows_per_page = $count;
		}

		/**
		 * //Used to set the page number of the Twitter search
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$twitterObj->setPN(2);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.10
		 * @name setPN
		 * @access Public
		 * @param integer $page
		 */
		public function setPN ($page) {
			$this->page_number = $page;
		}

		/**
		 * //Used to make a search by content or hashtag in Twitter
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$twitterObj->search("edirectory");
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.10
		 * @name search
		 * @access Public
		 * @param string $query
		 * @return array $this->data_array
		 */
		public function search ($query = false) {
			if ($query) {
				$this->search_query = $query;
				$url = Twitter::search_url;
				$url .= "?q=".$this->search_query;
				$url .= "&rpp=".$this->rows_per_page;
				$url .= "&page=".$this->page_number;
				$this->prepareData($url);
				return $this->data_array;
			} else {
				return false;
			}
		}

		/**
		 * //Used to retrive an User Information from Twitter
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$twitterObj->userInfo("edirectory");
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.10
		 * @name userInfo
		 * @access Public
		 * @param string $user
		 * @return array $this->data_array
		 */
		public function userInfo ($user = false) {
			if ($this->search_user || $user) {
				if ($user) $this->search_user = $user;
				$url = Twitter::user_url;
				$url .= $this->search_user;
				$this->prepareData($url);
				return $this->data_array;
			} else {
				return false;
			}
		}

		/**
		 * //Used to retrive an User Information in XML from Twitter Search API
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$twitterObj->prepareData($xmlUrl);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.10
		 * @name prepareData
		 * @access Private
		 * @param string $xmlUrl
		 */
		private function prepareData($xmlUrl) {
			$ch = curl_init($xmlUrl);
			curl_setopt($ch, CURLOPT_URL, $xmlUrl);
			curl_setopt($ch, CURLOPT_TIMEOUT, 180);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPGET, 1);
			$xmlStr = curl_exec($ch);
			if (!curl_errno($ch)) {
				$xmlObj = @simplexml_load_string($xmlStr);
				$this->data_array = $this->objectsIntoArray($xmlObj);
			}
			curl_close($ch);
		}

		/**
		 * //Used to retrive an User Information in Array from prepareData
		 * <code>
		 *		//Using this in forms or other pages.
		 *		$twitterObj->objectsIntoArray($xmlObj);
		 * <code>
		 * @copyright Copyright 2005 Arca Solutions, Inc.
		 * @author Arca Solutions, Inc.
		 * @version 7.5.10
		 * @name objectsIntoArray
		 * @access Private
		 * @param array $arrObjData
		 * @param array $arrSkipIndices
		 */
		private function objectsIntoArray($arrObjData, $arrSkipIndices = array()) {
			$arrData = array();
			if (is_object($arrObjData)) {
				$arrObjData = get_object_vars($arrObjData);
			}
			if (is_array($arrObjData)) {
				foreach ($arrObjData as $index => $value) {
					if (is_object($value) || is_array($value)) {
						$value = $this->objectsIntoArray($value, $arrSkipIndices);
					}
					if (in_array($index, $arrSkipIndices)) {
						continue;
					}
					$arrData[$index] = $value;
				}
			}
			return $arrData;
		}
	}