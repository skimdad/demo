<?php

/**
 * File: $Id: class.breadcrumb.inc.php, 2005/01/08 05:15 PST
 * <p><b>Purpose of file:</b> Show the directories and their links in path
 * form:<br>
 * <samp>Home > Firstdir > Seconddir > Etc > filename.php</samp></p>
 * <p><b>Information:</b> If you use this script please contact me with a url
 * or product information plus the product :) and please keep all header
 * information intact. Cheers!</p>
 * <p><b>Pay-Pal info:</b> paypal@baskettcase.com</p>
 * 
 * @author Richard Baskett <rick@baskettcase.com>
 * @category directory structure
 * @copyright Copyright ÃÂ© 2008, Baskettcase Web Development
 * @example example.php
 * @link http://www.baskettcase.com/classes/breadcrumb/
 * @link mailto:paypal@baskettcase.com
 * @package breadcrumb
 * @version 2.4.4
 */
class breadcrumb {

	var $eDirCrumbs = array();
	var $link = array();
	var $module = '';
	var $language = '';
	var $section = '';
	var $useOnBlog = false;
	/**
	 * eDirectory SubFolder
	 * 
	 * Set subfolder path.
	 * <code>$breadcrumb->subFolder = EDIRECTORY_FOLDER;</code>
	 * @var string
	 */
	var $subFolder = '';
	/**
	 * Hide Home Page Breadcrumb
	 * 
	 * Hide breadcrumbs on home page.
	 * <code>$breadcrumb->hideHome = TRUE;</code>
	 * @var bool
	 * @since Version 2.4.4
	 */
	var $hideHome = FALSE;
	/**
	 * Set Root Index Page
	 * 
	 * Sets the root index page link for those who have a splash page and do not
	 * want the home breadcrumb to take them to the splashpage.
	 * <code>$breadcrumb->rootIndexLink = 'index2.php';</code>
	 * @var string
	 * @since Version 2.4.4
	 */
	var $rootIndexLink = '';
	/**
	 * Homepage naming
	 * 
	 * A person can use any name for the homepage/base directory or not show it at
	 * all.
	 * <code>$breadcrumb->homepage = 'homepage';</code><br>
	 * <b>Example:</b>
	 * <samp>homepage > Baskettcase > php_classes > breadcrumb > index.htm</samp>
	 * <br><br><code>$breadcrumb->homepage = '';</code><br>
	 * <b>Example:</b>
	 * <samp>Baskettcase > php_classes > breadcrumb > index.htm</samp>
	 * @var string
	 * @since Version 1.0.0
	 */
	var $homepage = 'home';
	/**
	 * Case formatting
	 * 
	 * Specify the format you would like the directory names to be in, first 
	 * letters uppercase, all uppercase, all lowercase, or the actual naming of
	 * your directory with no changes.
	 * - string_ucwords = uppers case words (use with _toSpace)
	 * - titlecase = upper case words except small words (the, is, with, etc)
	 * - ucfirst = upper case first letter
	 * - uppercase = all uppercase
	 * - lowercase = all lowercase
	 * - none = show directories as they are named in path structure (DEFAULT)
	 *
	 * <code>$breadcrumb->dirformat = 'ucfirst';</code><br>
	 * <b>Example:</b>
	 * <samp>Baskettcase > Php_classes > Breadcrumb > Index.htm</samp>
	 * @var string ucfirst, uppercase, lowercase, string_ucwords, titlecase
	 * @since Version 1.0.0
	 */
	var $dirformat = '';
	/**
	 * Symbol separator
	 * 
	 * Specify what symbols to use between your directory names. 
	 * <pre>DEFAULT = ' > '</pre>
	 * <code>$breadcrumb->symbol = ' || ';</code><br>
	 * <b>Example:</b>
	 * <samp>Baskettcase || php_classes || breadcrumb || index.htm</samp>
	 * @var string
	 * @since Version 1.0.0
	 */
	var $symbol = ' &gt; ';
	/**
	 * CSS Class Style
	 * 
	 * Use a css class to define the look of your breadcrumb.
	 * <code>$breadcrumb->cssClass = 'crumb';</code><br>
	 * @var string
	 * @since Version 2.3.0
	 */
	var $cssClass = '';
	/**
	 * Special formatting
	 * 
	 * I also added a "special" formatting which allows you to show the path as if
	 * Elmer Fudd wrote it, or a Hacker wrote it, or in Reverse or hey even in pig
	 * latin!
	 * - elmer = elmer fudd translation
	 * - hacker = hacker speach translation
	 * - pig = pig latin translation
	 * - reverse = Reverses the text so it is backwards
	 * - none = no special formatting (DEFAULT)
	 *
	 * <code>$breadcrumb->special = 'elmer';</code><br>
	 * <b>Example:</b>
	 * <samp>Baskettcase > php_cwasses > bweadcwumb > index.htm</samp>
	 * @var string elmer, hacker, pig, reverse, none
	 * @since Version 1.0.0
	 */
	var $special = '';
	/**
	 * Frameset Target
	 * 
	 * Target a frameset.
	 * <code>$breadcrumb->target = '_blank';</code>
	 * @var string
	 * @since Version 2.4.0
	 */
	var $target = '';
	/**
	 * Show filename
	 * 
	 * Specify whether or not to show the current file name, just show the path or
	 * show the path with the file name.
	 * <code>$breadcrumb->showfile = FALSE;</code><br>
	 * <b>Example:</b>
	 * <samp>homepage > Baskettcase > php_classes > breadcrumb</samp>
	 * <br><br><code>$breadcrumb->showfile = TRUE;</code><br>
	 * <b>Example:</b>
	 * <samp>Baskettcase > php_classes > breadcrumb > index.htm</samp>
	 * @var bool
	 * @since Version 1.0.0
	 */
	var $showfile = TRUE;
	/**
	 * Unlink Current Directory
	 * 
	 * Removes the current directory link.
	 * <code>$breadcrumb->unlinkCurrentDir = TRUE;</code>
	 * @var bool
	 */
	var $unlinkCurrentDir = FALSE;
	/**
	 * Hide File Extension
	 * 
	 * Hides the filename extension
	 * <code>$breadcrumb->hideFileExt = TRUE;</code><br>
	 * <b>Example:</b>
	 * <samp>Baskettcase > php_classes > breadcrumb > index</samp>
	 * @var bool
	 * @since Version 2.4.2
	 */
	var $hideFileExt = FALSE;
	/**
	 * Filename Linking
	 * 
	 * Links the filename to itself.
	 * <code>$breadcrumb->linkFile = TRUE;</code>
	 * @var bool
	 * @since Version 2.4.0
	 */
	var $linkFile = FALSE;
	/**
	 * Replace Underscores
	 * 
	 * Replace underscores with spaces. 
	 * <code>$breadcrumb->_toSpace = TRUE;</code><br>
	 * <b>Example:</b>
	 * <samp>Baskettcase > php classes > breadcrumb > index.htm</samp>
	 * @link http://www.baskettcase.com/classes/breadcrumb/test_dir_with_underscores/underscore.php
	 * @var bool
	 * @since Version 2.3.0
	 */
	var $_toSpace = FALSE;
	/**
	 * Use images
	 * 
	 * Use images in place of text for your breadcrumbs, by specifying the
	 * directory the images can be found in. You can also specify the image type
	 * (gif, jpg, etc), border, id, name, hspace, vspace, align, height, width, and
	 * alt attributes. I have also included an example of how to use an image for
	 * the separator character. If you use the changeName function along with 
	 * images, the alt attribute will be the changed name, while the id and name
	 * attributes will remain the actual directory name.
	 * <code>$breadcrumb->imagedir = array('path'=>'images/', 'type'=>'gif', 'border'=>2, 'id'=>FALSE, 'name'=>TRUE,
	 * 'hspace'=>2, 'vspace'=>4, 'align'=>'top', 'height'=>20, 'width'=>75, 'alt'=>TRUE, 'title'=>TRUE);</code>
	 * @var array path, type, border, id, name, hspace, vspace, align, height, width, alt, title
	 * @since Version 2.0.0
	 */
	var $imagedir = array();
	/**
	 * Directory aliasing
	 * 
	 * Rename your directories to whatever you would like them to show up as in
	 * your breadcrumb.
	 * <code>$breadcrumb->changeName=array('home'=>'Baskettcase Homepage',
	 *                              'php_classes'=>'PHP Classes',
	 *                              'breadcrumb'=>'Breadcrumbs Class');</code><br>
	 * <b>Example:</b>
	 * <samp>Baskettcase Homepage > PHP Classes > Breadcrumbs Class > index.htm</samp>
	 * @var array
	 * @since Version 1.0.0
	 */
	var $changeName = array();
	/**
	 * Filename Aliasing
	 * 
	 * Change the filename to a more user friendly one.
	 * <code>$breadcrumb->changeFileName = array('/classes/breadcrumb/index.htm'=>'Breadcrumbs PHP Class v. 2.4.4');</code><br>
	 * <b>Example:</b>
	 * <samp>Baskettcase > php_classes > breadcrumb > Breadcrumbs PHP Class v. 2.4.4</samp>
	 * @var array
	 * @since Version 2.3.7
	 */
	var $changeFileName = array();
	var $changeGeneralName = array();
	/**
	 * Index exists?
	 * 
	 * <p>Set your index file name so that if the file exists then link the
	 * directory, otherwise if the file does not exist do not create a link.</p>
	 * <p>This is good for those people that do not want surfers to be able to look
	 * at their directory structure if they do not have a default index page within
	 * that directory. It will still show the directory name within the breadcrumb,
	 * but it will not add a link to the directory name.</p>
	 * <code>$breadcrumb->fileExists = array('index.htm','index.php','index.html');</code>
	 * @var array
	 * @since Version 1.0.0
	 */
	var $fileExists = array();
	/**
	 * Remove Directories
	 * 
	 * Hide a directory from showing in the breadcrumb.
	 * <code>$breadcrumb->removeDirs = array('php_classes');</code><br>
	 * <b>Example:</b>
	 * <samp>homepage > Baskettcase > breadcrumb > index.htm</samp>
	 * @var array
	 * @since Version 2.3.7
	 */
	var $removeDirs = array();
	/**
	 * Directory Structure
	 * @access private
	 */
	var $scriptArray = '';
	/**
	 * File name
	 * @access private
	 */
	var $fileName = '';
	/**
	 * Document Root
	 * @access private
	 */
	var $document_root = '';
	/**
	 * is this a personal site?
	 * @access private
	 */
	var $personalSite = '';
	/**
	 * Show errors
	 * @access private
	 */
	var $showErrors = FALSE;

	/**
	 * Breadcrumb
	 * @since Version 2.0.0
	 * @access private
	 */
	function breadcrumb() {
		// Creates an array of Directory Structure
		$this->scriptArray = explode("/", $_SERVER['PHP_SELF']);
		// Pops the filename off the end and throws it into it's own variable
		$this->fileName = array_pop($this->scriptArray);
		// Is this a personal site?
		if (string_substr($_SERVER['PHP_SELF'], 1, 1) == '~') {
			$tmp = explode('/', $_SERVER['PHP_SELF']);
			$this->personalSite = $tmp[1];
			$this->document_root = str_replace(str_replace('/' . $this->personalSite, '', $_SERVER["SCRIPT_NAME"]), '', $_SERVER['PATH_TRANSLATED']);
		}
		else
			$this->document_root = str_replace($_SERVER["SCRIPT_NAME"], '', $_SERVER['PATH_TRANSLATED']);
		#echo $this->document_root.'<Br />';
		#echo $_SERVER["SCRIPT_NAME"].'<Br />';
		#echo $_SERVER["PATH_TRANSLATED"].'<Br />';
	}

	/**
	 * Converts a string to an array
	 * @since Version 2.2.0
	 * @access private
	 */
	function str_split($string) {
		for ($i = 0; $i < string_strlen($string); $i++)
			$array[] = $string{$i};
		return $array;
	}

	/**
	 * Convert string into language specified
	 * @since Version 2.0.0
	 * @access private
	 */
	function specialLang($string, $lang) {
		// parse Directory special text style
		switch ($lang) {
			case 'elmer': $string = str_replace('l', 'w', $string);
				$string = str_replace('r', 'w', $string);
				break;
			case 'hacker': $string = string_strtoupper($string);
				$string = str_replace('A', '&#52;', $string);
				$string = str_replace('C', '&#40;', $string);
				$string = str_replace('D', '&#68;', $string);
				$string = str_replace('E', '&#51;', $string);
				$string = str_replace('F', '&#112;&#104;', $string);
				$string = str_replace('G', '&#54;', $string);
				$string = str_replace('H', '&#125;&#123;', $string);
				$string = str_replace('I', '&#49;', $string);
				$string = str_replace('M', '&#124;&#86;&#124;', $string);
				$string = str_replace('N', '&#124;&#92;&#124;', $string);
				$string = str_replace('O', '&#48;', $string);
				$string = str_replace('R', '&#82;', $string);
				$string = str_replace('S', '&#53;', $string);
				$string = str_replace('T', '&#55;', $string);
				break;
			case 'pig': $vowels = array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U');
				$string = $this->str_split($string);
				$firstLetter = array_shift($string);
				$string = @implode('', $string);
				$string = (in_array($firstLetter, $vowels)) ? $firstLetter . $string . 'yay' : $string . $firstLetter . 'ay';
				break;
			case 'reverse': $string = strrev($string);
				break;
		}
		return $string;
	}

	function multiLanguage($string) {

		if (!strcmp($string, 'home')) {
			$string = system_showText(LANG_MENU_HOME);
		} elseif (!strcmp($string, LISTING_FEATURE_FOLDER)) {
			$string = system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);
		} elseif (!strcmp($string, ARTICLE_FEATURE_FOLDER)) {
			$string = system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL);
		} elseif (!strcmp($string, EVENT_FEATURE_FOLDER)) {
			$string = system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);
		} elseif (!strcmp($string, PROMOTION_FEATURE_FOLDER)) {
			$string = system_showText(LANG_PROMOTION_FEATURE_NAME_PLURAL);
		} elseif (!strcmp($string, CLASSIFIED_FEATURE_FOLDER)) {
			$string = system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL);
		}
		return $string;
	}

	/**
	 * Convert string into specified format
	 * @since Version 2.2.0
	 * @access private
	 */
	function dirFormat($string, $format) {
		// parse Directory text style
		switch ($format) {
			case 'titlecase': $string = $this->titleCase($string);
				break;
			case 'ucfirst': $string = ucfirst($string);
				break;
			case 'string_ucwords': $string = $this->convertUnderScores($string);
				$string = string_ucwords($string);
				break;
			case 'uppercase': $string = string_strtoupper($string);
				break;
			case 'lowercase': $string = string_strtolower($string);
				break;
			default: $string = $string;
		}
		return $string;
	}

	/**
	 * TitleCase
	 * Convert string into Title Case which excludes capitalizing certain small
	 * words.  As in a movie title, or book title. "The Wind in the Trees"
	 * @author Justin@gha.bravepages.com, un-thesis@wakeup-people.com, mgm@starlingtech.com, rick@baskettcase.com
	 * @access private
	 * @since Version 2.3.0
	 */
	function titleCase($text) {
		$text = $this->convertUnderScores($text);
		$min_word_len = 4;
		$always_cap_first = TRUE;
		$exclude = array('of', 'a', 'the ', 'and', 'an', 'or', 'nor', 'but', 'is', 'if',
			'then', 'else', 'when', 'up', 'at', 'from', 'by', 'on', 'off',
			'for', 'in', 'out', 'over', 'to', 'into', 'with', 'htm', 'html',
			'php', 'phtml');

		// Allows for the specification of the minimum length  
		// of characters each word must be in order to be capitalized 
		// Make sure words following punctuation are capitalized 
		$text = str_replace(array('(', '-', '.', '?', ',', ':', '[', ';', '!'), array('( ', '- ', '. ', '? ', ', ', ': ', '[ ', '; ', '! '), $text);

		$words = explode(' ', string_strtolower($text));
		$count = count($words);
		$num = 0;

		while ($num < $count) {
			if (string_strlen($words[$num]) >= $min_word_len
					&& array_search($words[$num], $exclude) === false)
				$words[$num] = ucfirst($words[$num]);
			$num++;
		}

		$text = @implode(' ', $words);
		$text = str_replace(
				array('( ', '- ', '. ', '? ', ', ', ': ', '[ ', '; ', '! '), array('(', '-', '.', '?', ',', ':', '[', ';', '!'), $text);

		// Always capitalize first char if cap_first is true 
		if ($always_cap_first) {
			if (ctype_alpha($text[0]) && ord($text[0]) <= ord('z')
					&& ord($text[0]) > ord('Z'))
				$text[0] = chr(ord($text[0]) - 32);
		}

		return $text;
	}

	/**
	 * Remove Directories
	 * Remove the directories from the breadcrumb
	 * @since Version 2.3.2
	 * @access private
	 */
	function removeDirectories() {
		$numDirs = count($this->scriptArray);
		for ($i = 0; $i < $numDirs; $i++) {
			if (!in_array($this->scriptArray[$i], $this->removeDirs))
				$newArray[] = $this->scriptArray[$i];
		}
		return $newArray;
	}

	/**
	 * Remove File Extension
	 * Remove the file extension from the filename
	 * @since Version 2.4
	 * @access private
	 */
	function removeFileExt($filename) {
		$newFileName = @explode('.', $filename);
		return $newFileName[0];
	}

	/**
	 * Convert Underscores
	 * Replace underscores with spaces
	 * @since Version 2.4
	 * @access private
	 */
	function convertUnderScores($name) {
		$varName = str_replace('_', ' ', $name);
		return $varName;
	}

	function eDirStructure($item_id, $identifier, $type, $lang) {

		function filter_array($element) {
			if ($element != '')
				return $element;
		}

		if (!strcmp($type, 'listing')) {
			$this->module = LISTING_FEATURE_FOLDER;
		} elseif (!strcmp($type, 'event')) {
			$this->module = EVENT_FEATURE_FOLDER;
		} elseif (!strcmp($type, 'article')) {
			$this->module = ARTICLE_FEATURE_FOLDER;
		} elseif (!strcmp($type, 'classified')) {
			$this->module = CLASSIFIED_FEATURE_FOLDER;
		} elseif (!strcmp($type, 'promotion')) {
			$this->module = PROMOTION_FEATURE_FOLDER;
		} elseif (!strcmp($type,'blog')){
			$this->module = BLOG_FEATURE_FOLDER;
		}

		$this->language = $lang;
		$this->section = $identifier;

		switch ($identifier) {
			case 'template':
				$label = ucfirst(system_showText(LANG_LABEL_TYPE));
				break;
			case 'category':
				if($this->useOnBlog){
					$label = ucfirst(LANG_TAGS);
				}else{
					$label = ucfirst(system_showText(LANG_CATEGORIES_SUBCATEGS));
				}
				break;
			case 'allcategories':
				if($this->useOnBlog){
					$label = ucfirst(LANG_TAGS);
				}else{
					$label = ucfirst(system_showText(LANG_CATEGORIES_SUBCATEGS));
				}
				break;
			case 'location':
				$label = ucfirst(system_showText(LANG_LOCATIONS));
				break;
			case 'alllocations':
				$label = ucfirst(system_showText(LANG_LOCATIONS));
				break;
			case 'alltemplates':
				$label = ucfirst(system_showText(LANG_LABEL_TYPE));
				break;
		}

		$edirCrumb = array_filter($this->eDirCrumbs, filter_array);
		$crumb_array = array_values($edirCrumb);

		/**
		 * @categories
		 */
		$categoryChain = array();
		if ($identifier == "category") {
			if ($type == "promotion")
				$typeObj = "ListingCategory";
			else
				$typeObj = ucfirst($type) . "Category";
			$categoryObj = new $typeObj($item_id);
			$cat_id = $categoryObj->category_id;
			$i = 0;
			while ($cat_id) {
				unset($categoryObj);
				$categoryObj = new $typeObj($cat_id);
				$categoryChain[$i]['id'] = $categoryObj->getNumber("id");
				$categoryChain[$i]['title'] = $categoryObj->getString("title" . $lang);
				$categoryChain[$i]['friendly'] = $categoryObj->getString("friendly_url" . $lang);
				$i++;
				$cat_id = $categoryObj->category_id;
			}

			$categoryChain = array_reverse($categoryChain);
		}

		/**
		 * @locations
		 */
		if ($identifier == "location") {

			$crumb_array = $crumb_array[0];
			if ($crumb_array)
				$last_location = array_pop($crumb_array);
			$count = count($crumb_array);
			$_locations = explode(",", EDIR_LOCATIONS);
			$k = 0;

			foreach ($_locations as $_location) {

				$j = $_location;

				if ($j == 1) {
					$Location1Obj = new Location1($item_id[$k]);
					$location_0 = $crumb_array[$k];
					$location_0_url = $Location1Obj->getString("friendly_url");
					$k++;
				}
				if ($j == 2) {
					$Location2Obj = new Location2($item_id[$k]);
					$location_1 = $crumb_array[$k];
					$location_1_url = $Location2Obj->getString("friendly_url");
					$k++;
				}
				if ($j == 3) {
					$Location3Obj = new Location3($item_id[$k]);
					$location_2 = $crumb_array[$k];
					$location_2_url = $Location3Obj->getString("friendly_url");
					$k++;
				}
				if ($j == 4) {
					$Location4Obj = new Location4($item_id[$k]);
					$location_3 = $crumb_array[$k];
					$location_3_url = $Location4Obj->getString("friendly_url");
					$k++;
				}
				if ($j == 5) {
					$Location5Obj = new Location5($item_id[$k]);
					$location_4 = $crumb_array[$k];
					$location_4_url = $Location5Obj->getString("friendly_url");
					$k++;
				}
			}
		}

		if ($label) {
			$numDirs = count($this->scriptArray);
			if ($numDirs > 3) {
				for ($i = 3; $i <= $numDirs; $i++)
					unset($this->scriptArray[$i]);
			}

			if (EDIRECTORY_FOLDER != '') {

				if (!strcmp($type, 'listing')) {
					$this->scriptArray[1] = LISTING_FEATURE_FOLDER;
				} elseif (!strcmp($type, 'article')) {
					$this->scriptArray[1] = ARTICLE_FEATURE_FOLDER;
				} elseif (!strcmp($type, 'event')) {
					$this->scriptArray[1] = EVENT_FEATURE_FOLDER;
				} elseif (!strcmp($type, 'classified')) {
					$this->scriptArray[1] = CLASSIFIED_FEATURE_FOLDER;
				} elseif (!strcmp($type, 'promotion')) {
					$this->scriptArray[1] = PROMOTION_FEATURE_FOLDER;
				} elseif (!strcmp($type,'blog')){
					$this->scriptArray[1] = BLOG_FEATURE_FOLDER;
				}
			} else {


				if (!strcmp($type, LISTING_FEATURE_FOLDER)) {
					$this->scriptArray[1] = LISTING_FEATURE_FOLDER;
				} elseif (!strcmp($type, ARTICLE_FEATURE_FOLDER)) {
					$this->scriptArray[1] = ARTICLE_FEATURE_FOLDER;
				} elseif (!strcmp($type, EVENT_FEATURE_FOLDER)) {
					$this->scriptArray[1] = EVENT_FEATURE_FOLDER;
				} elseif (!strcmp($type, CLASSIFIED_FEATURE_FOLDER)) {
					$this->scriptArray[1] = CLASSIFIED_FEATURE_FOLDER;
				} elseif (!strcmp($type, PROMOTION_FEATURE_FOLDER)) {
					$this->scriptArray[1] = PROMOTION_FEATURE_FOLDER;
				} elseif (!strcmp($type,BLOG_FEATURE_FOLDER)){
					$this->scriptArray[1] = BLOG_FEATURE_FOLDER;

				}
			}
			$this->scriptArray[2] = $label;

			$i = 3;
			$link = array();
			//categories

			foreach ($categoryChain as $eachCat) {
				$this->scriptArray[$i] = $eachCat["title"];
				if (MODREWRITE_FEATURE == "on")
					$this->link[$i] = $this->link[$i - 1] . "/" . $eachCat["friendly"];
				else
					$this->link[$i] = "results.php?category_id=" . $eachCat["id"];
				$i++;
			}

			$_locations = explode(",", EDIR_LOCATIONS);

			if ($location_0) {
				$l = 0;
				$this->scriptArray[$i] = $location_0;
				if (MODREWRITE_FEATURE == "on")
					$this->link[$i] = $location_0_url;
				else
					$this->link[$i] = "results.php?location_1=" . $item_id[0];
				$i++;
			}
			if ($location_1) {
				$l = 0;
				$this->scriptArray[$i] = $location_1;
				if (MODREWRITE_FEATURE == "on")
					$this->link[$i] = ($location_0_url ? $location_0_url . "/" : '') . $location_1_url;
				else
					$this->link[$i] = "results.php?" . ($location_0 ? "location_1=" . $item_id[$l++] . "&" : "") . "location_2=" . $item_id[$l++];
				$i++;
			}
			if ($location_2) {
				$l = 0;
				$this->scriptArray[$i] = $location_2;
				if (MODREWRITE_FEATURE == "on")
					$this->link[$i] = ($location_0_url ? $location_0_url . "/" : '') . ($location_1_url ? $location_1_url . "/" : '') . $location_2_url;
				else
					$this->link[$i] = "results.php?" . ($location_0 ? "location_1=" . $item_id[$l++] . "&" : "") . ($location_1 ? "location_2=" . $item_id[$l++] . "&" : "") . "location_3=" . $item_id[$l++];
				$i++;
			}
			if ($location_3) {
				$l = 0;
				$this->scriptArray[$i] = $location_3;
				if (MODREWRITE_FEATURE == "on")
					$this->link[$i] = ($location_0_url ? $location_0_url . "/" : '') . ($location_1_url ? $location_1_url . "/" : '') . ($location_2_url ? $location_2_url . "/" : '') . $location_3_url;
				else
					$this->link[$i] = "results.php?" . ($location_0 ? "location_1=" . $item_id[$l++] . "&" : "") . ($location_1 ? "location_2=" . $item_id[$l++] . "&" : "") . ($location_2 ? "location_3=" . $item_id[$l++] . "&" : "") . "location_4=" . $item_id[$l++];
				$i++;
			}
			if ($location_4) {
				$l = 0;
				$this->scriptArray[$i] = $location_4;
				if (MODREWRITE_FEATURE == "on")
					$this->link[$i] = ($location_0_url ? $location_0_url . "/" : '') . ($location_1_url ? $location_1_url . "/" : '') . ($location_2_url ? $location_2_url . "/" : '') . ($location_3_url ? $location_3_url . "/" : '') . $location_4_url;
				else
					$this->link[$i] = "results.php?" . ($location_0 ? "location_1=" . $item_id[$l++] . "&" : "") . ($location_1 ? "location_2=" . $item_id[$l++] . "&" : "") . ($location_2 ? "location_3=" . $item_id[$l++] . "&" : "") . ($location_3 ? "location_4=" . $item_id[$l++] . "&" : "") . "location_5=" . $item_id[$l++];
				$i++;
			}
			if ($crumb_array[0] != '' || $last_location) {
				if ($identifier == "location")
					$this->scriptArray[$i] = $last_location;
				else
					$this->scriptArray[$i] = $crumb_array[0];
			}
		}
	}

	/**
	 * Show Breadcrumb
	 *
	 * Outputs the html formatted breadcrumb according to the variables you set.
	 * <code>echo "<p>".$breadcrumb->show_breadcrumb()."</p>";</code>
	 * @since Version 0.0.1
	 */
	function show_breadcrumb() {

		if ($this->hideHome && $this->section == "home") {
			return false;
		} else {

			$dir = $showLink = $class = $target = '';

			// Either set the home element or pop the first empty array off the beginning
			if ($this->homepage != '')
				$this->scriptArray[0] = $this->homepage;
			else
				$tmp = array_shift($this->scriptArray);

			// if this is a personal site remove the root directory and set
			// new homepage to user directory
			if ($this->personalSite != '') {
				$this->removeDirs[] = $this->scriptArray[0];
				if ($this->homepage != '')
					$this->scriptArray[1] = $this->homepage;
				else
					$tmp = array_shift($this->scriptArray);
			}

			if ($this->homepage == '')
				//$dir = '/';
				
				/*
				 * Prepare breadcrumb with language
				 */
				unset($aux_breadcrumb, $aux_default_lang);
				$aux_default_lang = explode("_", EDIR_DEFAULT_LANGUAGE);

				$dir = NON_LANG_URL.(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "");

			// Set sub folder if true
			if ($this->subFolder != '') {
				$sub_dir = "/" . $this->subFolder;
				$dir = $sub_dir;
			}

			// Build Path Structure
			$numDirs = count($this->scriptArray);

			// BEGIN DIRECTORY FOR LOOP
			for ($i = 0; $i < $numDirs; $i++) {
				#echo $this->changeName[$this->scriptArray[$i]];
				#$dirName = $this->scriptArray[$i];

				$dirName = ($this->changeName[$this->scriptArray[$i]] != '') ?
						$this->changeName[$this->scriptArray[$i]] :
						$this->scriptArray[$i];

				if ($this->personalSite != '' && $i == 1)
					$this->scriptArray[$i] = $this->personalSite;

				if ($break_dir) {
					if (MODREWRITE_FEATURE == "on") {
						if ($this->section == "type")
							$dir = "$sub_dir".(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/$this->module/type/";
						else if ($this->section == "location")
							$dir = "$sub_dir".(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/$this->module/location/";
						else if ($this->section == "category")
							$dir = "$sub_dir".(REDIRECT_EDIR_LANGUAGE ? "/".EDIR_LANGUAGEABBREVIATION : "")."/$this->module/guide";
					}
					else
						unset($dir);
				} else {
					if ($this->sub_folder && $this->section == 'home')
						$dir .= $this->sub_folder;
					else
						$dir .= ( $i == 0 && $this->homepage != '') ? '/' : $this->scriptArray[$i] . "/";
				}

				// Replace underscores with spaces if _toSpace is set
				if ($this->_toSpace == TRUE)
					$dirTxtName = $this->convertUnderScores($dirName);

				// parse Directory special text style
				$dirTxtName = $this->specialLang($dirName, $this->special);

				// Convert string into specified format
				$dirTxtName = $this->dirFormat($dirName, $this->dirformat);

				// parse eDirectory language
				$dirTxtName = $this->multiLanguage($dirName);

				// Use text instead of images
				if ($this->imagedir['path'] == '')
					$dirName = $dirTxtName;

				// Use Images instead of text
				else {
					// Set defaults
					if (!$this->imagedir['type'])
						$this->imagedir['type'] = 'gif';
					if (!$this->imagedir['border'])
						$this->imagedir['border'] = '0';
					if (!$this->imagedir['id'])
						$this->imagedir['id'] = TRUE;
					if (!$this->imagedir['name'])
						$this->imagedir['name'] = TRUE;
					if (!$this->imagedir['alt'])
						$this->imagedir['alt'] = TRUE;

					$dirName = '<img src="' . $this->imagedir['path'] .
							$this->scriptArray[$i] . '.' . $this->imagedir['type'] .
							'" border="' . $this->imagedir['border'] . '"';

					if ($this->imagedir['id'] == TRUE) // id
						$dirName .= ' id="' . $this->scriptArray[$i] . '"';
					if ($this->imagedir['name'] == TRUE) // name
						$dirName .= ' name="' . $this->scriptArray[$i] . '"';
					if ($this->imagedir['alt'] == TRUE) { // alt
						$alt = ($this->changeName[$this->scriptArray[$i]] != '') ? $this->changeName[$this->scriptArray[$i]] : $this->scriptArray[$i];
						$dirName .= ' alt="' . $alt . '"';
					}
					if ($this->imagedir['title'] == TRUE) { // title
						$title = ($this->changeName[$this->scriptArray[$i]] != '') ? $this->changeName[$this->scriptArray[$i]] : $this->scriptArray[$i];
						$dirName .= ' title="' . $title . '"';
					}

					if ($this->imagedir['hspace']) // hspace
						$dirName .= ' hspace="' . $this->imagedir['hspace'] . '"';
					if ($this->imagedir['vspace']) // vspace
						$dirName .= ' vspace="' . $this->imagedir['vspace'] . '"';
					if ($this->imagedir['align']) // align
						$dirName .= ' align="' . $this->imagedir['align'] . '"';
					if ($this->imagedir['height']) // height
						$dirName .= ' height="' . $this->imagedir['height'] . '"';
					if ($this->imagedir['width']) // width
						$dirName .= ' width="' . $this->imagedir['width'] . '"';

					$dirName .= ' />';
				}

				// Add CSS
				if ($this->cssClass != '')
					$class = ' class="' . $this->cssClass . '"';

				// Add frame target
				if ($this->target != '')
					$target = ' target="' . $this->target . '"';

				// create link
				// If fileExists has values then check to make sure one of those files
				// exists, if it does, link it, otherwise do not link
				if ($this->fileExists) {
					for ($k = 0; $k < count($this->fileExists); $k++) {
						if ($this->personalSite != '') {
							if (string_strpos($dir, $this->personalSite))
								$exists_filename = str_replace($this->personalSite . '/', '', $this->document_root . $dir . $this->fileExists[$k]);
							else
								continue;
						}
						else
							$exists_filename = $this->document_root . $dir . $this->fileExists[$k];
						#echo $exists_filename.'<br />';
						if (file_exists($exists_filename)) {
							$showLink = 'yes';
							break;
						} else
							$showLink = 'no';
					}
				}

				// Set the root filename if it is different then the default index page
				if ($break_dir) {
					$rootFileName = $this->link[$i];
				} else {
					$rootFileName = ($this->rootIndexLink != '' && $dir == '/') ? $this->rootIndexLink : '';
				}

				//$current_dir = string_substr($dir, string_strpos($dir, "/", 2)+1, string_strrpos($dir, "/")-(string_strpos($dir, "/", 2)+1));
				$dirs = explode("/", $dir);
				$needle = count($dirs) - 2;
				$current_dir = $dirs[$needle];

				switch ($current_dir) {
					case ucfirst(system_showText(LANG_TAGS)):
						if (MODREWRITE_FEATURE == "on"){
							$dir = $previous_dir."allcategories.php";
						}else{
							$dir = 'allcategories.php';
						}
						$break_dir = true;
						break;
					case ucfirst(system_showText(LANG_CATEGORIES_SUBCATEGS)):
						if (MODREWRITE_FEATURE == "on")
							$dir = $previous_dir . "allcategories.php";
						else
							$dir = 'allcategories.php';
						$break_dir = true;
						break;
					case ucfirst(system_showText(LANG_LABEL_TYPE)):
						$dir = $previous_dir . "alltemplates.php";
						$break_dir = true;
						break;
					case ucfirst(system_showText(LANG_LOCATIONS)):
						if (MODREWRITE_FEATURE == "on")
							$dir = $previous_dir . "alllocations.php";
						else
							$dir = 'alllocations.php';
						$break_dir = true;
						break;
				}

				if (!in_array($this->scriptArray[$i], $this->removeDirs)) {
					if ($this->unlinkCurrentDir == TRUE && ($i + 1) == $numDirs || $showLink == 'no') {

						$breadcrumb[] = ucfirst($dirName);
					}
					// If we are not supposed to remove the directory, show it
					elseif (!in_array($this->scriptArray[$i], $this->removeDirs) || $showLink == 'yes')
						$breadcrumb[] = '<a href="' . $dir . $rootFileName . '"' . $class . $target . ' title="' . $dirTxtName . '">' . ucfirst($dirName) . '</a>';
					elseif ($this->personalSite != '' && $i == 1)
						$breadcrumb[] = '<a href="' . $dir . $rootFileName . '"' . $class . $target . ' title="' . $dirTxtName . '">' . $dirName . '</a>';
				}
				$previous_dir = $dir;
			}
			// END DIRECTORY FOR LOOP

			$fileName = $originalFileName = $this->fileName;

			#if ($this->fileNametoTitle==TRUE) $fileName = $this->getPageTitle(); 
			// Check to see if hideFileExt is on, if so turn on showfile
			// and remove the file extension
			if ($this->hideFileExt == TRUE)
				$this->showfile = TRUE;

			if ($this->showfile == TRUE) {
				// Change the filename if filename is in changeFileName array
				if ($this->changeFileName[$_SERVER['REQUEST_URI']] != '')
					$fileName = $this->changeFileName[$_SERVER['REQUEST_URI']];
				// Change the filename if filename is in changeGeneralName array
				if ($this->changeGeneralName[$this->fileName] != '')
					$fileName = $this->changeGeneralName[$this->fileName];
				// If it is not then just use $fileName or remove extension if specified
				elseif ($this->hideFileExt == TRUE)
					$fileName = $this->removeFileExt($fileName);

				// Convert underscores to spaces
				if ($this->_toSpace == TRUE)
					$fileName = $this->convertUnderScores($fileName);
				// parse filename special text style
				$fileName = $this->specialLang($fileName, $this->special);
				// Convert string into specified format
				$fileName = $this->dirFormat($fileName, $this->dirformat);
				// Add CSS
				if ($this->cssClass != '')
					$fileName = '<span class="' . $this->cssClass . '">' .
							$fileName . '</span>';
				// Add link to filename
				if ($this->linkFile == TRUE)
					$fileName = '<a href="' . $originalFileName . '">' . $fileName . '</a>';
				$fileName = $this->symbol . $fileName;
			} else
				$fileName = '';

			// Web Server Path
			// return if we are not at root

			if ($numDirs > 0)
				return @implode($this->symbol, $breadcrumb) . $fileName;
			// if at root just return the filename
			else
				return $fileName;
		}
	}
	
	function show_auxbreadcrumb(){
		
		$$auxbreadcrumb = "";
		
		if (string_strpos($_SERVER["PHP_SELF"], "contactus.php") !== false){
			$auxbreadcrumb .= "<a href=\"".DEFAULT_URL."\" title=\"".system_showText(LANG_MENU_HOME)."\">".system_showText(LANG_MENU_HOME)."</a><span class=\"split\">&nbsp;&nbsp;/&nbsp;&nbsp;</span>";
			$auxbreadcrumb .= system_showText(LANG_MENU_CONTACT);
		}

		if (string_strpos($_SERVER["PHP_SELF"], "errorpage.php") !== false){
			$auxbreadcrumb .= "<a href=\"".DEFAULT_URL."\" title=\"".system_showText(LANG_MENU_HOME)."\">".system_showText(LANG_MENU_HOME)."</a><span class=\"split\">&nbsp;&nbsp;/&nbsp;&nbsp;</span>";
			$auxbreadcrumb .= system_showText(LANG_PAGE_NOT_FOUND);
		}

		if (string_strpos($_SERVER["PHP_SELF"], "sitemap.php") !== false){
			$auxbreadcrumb .= "<a href=\"".DEFAULT_URL."\" title=\"".system_showText(LANG_MENU_HOME)."\">".system_showText(LANG_MENU_HOME)."</a><span class=\"split\">&nbsp;&nbsp;/&nbsp;&nbsp;</span>";
			$auxbreadcrumb .= system_showText(LANG_MENU_SITEMAP);
		}

		if (string_strpos($_SERVER["PHP_SELF"], "maintenancepage.php") !== false){
			$auxbreadcrumb .= "<a href=\"".DEFAULT_URL."\" title=\"".system_showText(LANG_MENU_HOME)."\">".system_showText(LANG_MENU_HOME)."</a><span class=\"split\">&nbsp;&nbsp;/&nbsp;&nbsp;</span>";
			$auxbreadcrumb .= system_showText(LANG_MAINTENANCE_PAGE);
		}
		
		return $auxbreadcrumb;
		
	}

}

?>