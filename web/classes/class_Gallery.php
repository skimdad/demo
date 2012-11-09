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
	# * FILE: /classes/class_gallery.php
	# ----------------------------------------------------------------------------------------------------

	class Gallery extends Handle {

		var $id;
		var $account_id;
		var $title;
		var $entered;
		var $updated;
		var $image;

		function Gallery($var='', $domain_id=false, $main_image = false) {
			if (is_numeric($var) && ($var)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain_id){
					$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
				} else if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}

//				$dbMain->close();
				unset($dbMain);
				$sql = "SELECT * FROM Gallery WHERE id = $var";
				$row = mysql_fetch_array($dbObj->query($sql));
				$sql = "SELECT * FROM Gallery_Image WHERE gallery_id = $var ".(!$main_image ? "AND image_default <> 'y'" : "")." ORDER BY ".($main_image ? "image_default DESC, " : "")."id";
				$r = $dbObj->query($sql);
				$i = 0;
				while ($row_aux = mysql_fetch_array($r)) {
					$image[$i]['id'] = $row_aux['id'];
					$image[$i]['image_id'] = $row_aux['image_id'];
					$image[$i]['thumb_id'] = $row_aux['thumb_id'];
					$image[$i]['image_caption1'] = $row_aux['image_caption1'];
					$image[$i]['image_caption2'] = $row_aux['image_caption2'];
					$image[$i]['image_caption3'] = $row_aux['image_caption3'];
					$image[$i]['image_caption4'] = $row_aux['image_caption4'];
					$image[$i]['image_caption5'] = $row_aux['image_caption5'];
					$image[$i]['image_caption6'] = $row_aux['image_caption6'];
					$image[$i]['image_caption7'] = $row_aux['image_caption7'];
					$image[$i]['thumb_caption1'] = $row_aux['thumb_caption1'];
					$image[$i]['thumb_caption2'] = $row_aux['thumb_caption2'];
					$image[$i]['thumb_caption3'] = $row_aux['thumb_caption3'];
					$image[$i]['thumb_caption4'] = $row_aux['thumb_caption4'];
					$image[$i]['thumb_caption5'] = $row_aux['thumb_caption5'];
					$image[$i]['thumb_caption6'] = $row_aux['thumb_caption6'];
					$image[$i]['thumb_caption7'] = $row_aux['thumb_caption7'];
					$image[$i]['image_default'] = $row_aux['image_default'];
					$image[$i]['order'] = $row_aux['order'];
					$sql = "SELECT * FROM Image WHERE id = $row_aux[image_id]";
					$row_aux = mysql_fetch_array($dbObj->query($sql));
					$image[$i]['width'] = $row_aux['width'];
					$image[$i]['height'] = $row_aux['height'];
					$i++;
				}
				$this->makeFromRow($row, $image);
			} else {
				$this->makeFromRow($var);
			}
		}

		function getAllImages($gallery_id, $domain_id = false) {
			if (is_numeric($gallery_id) && ($gallery_id)) {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				if ($domain_id){
					$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
				} else if (defined("SELECTED_DOMAIN_ID")) {
					$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				} else {
					$dbObj = db_getDBObject();
				}

				unset($dbMain);
				$sql = "SELECT * FROM Gallery WHERE id = $gallery_id";
				$row = mysql_fetch_array($dbObj->query($sql));
				$sql = "SELECT * FROM Gallery_Image WHERE gallery_id = $gallery_id ORDER BY id";
				$r = $dbObj->query($sql);
				$i = 0;
				while ($row_aux = mysql_fetch_array($r)) {
					$image[$i]['id'] = $row_aux['id'];
					$image[$i]['image_id'] = $row_aux['image_id'];
					$image[$i]['thumb_id'] = $row_aux['thumb_id'];
					$image[$i]['image_caption1'] = $row_aux['image_caption1'];
					$image[$i]['image_caption2'] = $row_aux['image_caption2'];
					$image[$i]['image_caption3'] = $row_aux['image_caption3'];
					$image[$i]['image_caption4'] = $row_aux['image_caption4'];
					$image[$i]['image_caption5'] = $row_aux['image_caption5'];
					$image[$i]['image_caption6'] = $row_aux['image_caption6'];
					$image[$i]['image_caption7'] = $row_aux['image_caption7'];
					$image[$i]['thumb_caption1'] = $row_aux['thumb_caption1'];
					$image[$i]['thumb_caption2'] = $row_aux['thumb_caption2'];
					$image[$i]['thumb_caption3'] = $row_aux['thumb_caption3'];
					$image[$i]['thumb_caption4'] = $row_aux['thumb_caption4'];
					$image[$i]['thumb_caption5'] = $row_aux['thumb_caption5'];
					$image[$i]['thumb_caption6'] = $row_aux['thumb_caption6'];
					$image[$i]['thumb_caption7'] = $row_aux['thumb_caption7'];
					$image[$i]['image_default'] = $row_aux['image_default'];
					$image[$i]['order'] = $row_aux['order'];
					$sql = "SELECT * FROM Image WHERE id = $row_aux[image_id]";
					$row_aux = mysql_fetch_array($dbObj->query($sql));
					$image[$i]['width'] = $row_aux['width'];
					$image[$i]['height'] = $row_aux['height'];
					$i++;
				}
				return $image;
			} else {
				return false;
			}
		}

		function getImagesCount() {
			return count($this->image);
		}

		function makeFromRow($row='', $image='') {
			$this->image = $image;
			$row['id'] ? $this->id = $row['id'] : $this->id = 0;
			$row['account_id'] ? $this->account_id = $row['account_id'] : $this->account_id = 0;
			$row['entered'] ? $this->entered = $row['entered'] : $this->entered = 0;
			$row['updated'] ? $this->updated = $row['updated'] : $this->updated = 0;
			$row['title'] ? $this->title = $row['title'] : $this->title = 'NO NAME';
		}

		function Save() {
			$this->prepareToSave();
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);
			if ($this->id) {
				$sql = "UPDATE Gallery SET"
					. " title = $this->title,"
					. " account_id = $this->account_id,"
					. " updated = NOW()"
					. " WHERE id = $this->id";
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO Gallery"
					. " (title,"
					. " account_id,"
					. " entered,"
					. " updated)"
					. " VALUES"
					. " ($this->title, "
					. " $this->account_id, "
					. " NOW(), "
					. " NOW())";
				$dbObj->query($sql); 
				$this->id = mysql_insert_id($dbObj->link_id);
			}
			$this->prepareToUse();
		}

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
			$sql = "SELECT * FROM Gallery_Image WHERE gallery_id = $this->id";
			$r = $dbObj->query($sql);
			while ($row = mysql_fetch_array($r)) {
				$imageObj = new Image($row['image_id']);
				$imageObj->Delete($domain_id);
				$imageObj = new Image($row['thumb_id']);
				$imageObj->Delete($domain_id);
			}
			$sql = "DELETE FROM Gallery_Image WHERE gallery_id = $this->id";
			$dbObj->query($sql);
			$sql = "DELETE FROM Gallery WHERE id = $this->id";
			$dbObj->query($sql);
			$sql = "DELETE FROM Gallery_Item WHERE gallery_id = $this->id";
			$dbObj->query($sql);
		}

		// like prepareToSave but only used by AddImage and EditImage
		function getGalleryToSave($vars='') {
			if($vars) {
				foreach($vars as $key => $value) if (is_string($value)) if ((!strstr($value, "\'")) && (!strstr($value, "\\\"")) && (!strstr($value, "\\"))) $vars[$key] = addslashes($value);
				$result = $vars;
			} else $result = 0;
			return $result;
		}

		// like prepareToUse but only used by AddImage and EditImage
		function getGalleryToUse($vars='') {
			if($vars) {
				foreach($vars as $key => $value) $vars[$key] = stripslashes($value);
				$result = $vars;
			} else $result = 0;
			return $result;
		}

		function AddImage($row, $domain_id = false) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if ($domain_id){
				$dbObj = db_getDBObjectByDomainID($domain_id, $dbMain);
			} else if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);
			$row = $this->getGalleryToSave($row);
			$sql = "INSERT INTO Gallery_Image"
				. " (gallery_id,
					image_id,
					thumb_id,
					image_caption1,
					image_caption2,
					image_caption3,
					image_caption4,
					image_caption5,
					image_caption6,
					image_caption7,
					thumb_caption1,
					thumb_caption2,
					thumb_caption3,
					thumb_caption4,
					thumb_caption5,
					thumb_caption6,
					thumb_caption7,
					image_default)"
				. " VALUES"
				. " ($this->id,"
				. " $row[image_id],"
				. " $row[thumb_id],"
				. " '$row[image_caption1]',"
				. " '$row[image_caption2]',"
				. " '$row[image_caption3]',"
				. " '$row[image_caption4]',"
				. " '$row[image_caption5]',"
				. " '$row[image_caption6]',"
				. " '$row[image_caption7]',"
				. " '$row[thumb_caption1]',"
				. " '$row[thumb_caption2]',"
				. " '$row[thumb_caption3]',"
				. " '$row[thumb_caption4]',"
				. " '$row[thumb_caption5]',"
				. " '$row[thumb_caption6]',"
				. " '$row[thumb_caption7]',"
				. " '$row[image_default]')";
			$dbObj->query($sql);
			$row = $this->getGalleryToUse($row);
		}

		function EditImage($row) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);
			$row = $this->getGalleryToSave($row);
			$sql = "UPDATE Gallery_Image SET"
					. " gallery_id = $this->id,"
					. " image_id = $row[image_id],"
					. " thumb_id = $row[thumb_id],"
					. " image_caption1 = '$row[image_caption1]',"
					. " image_caption2 = '$row[image_caption2]',"
					. " image_caption3 = '$row[image_caption3]',"
					. " image_caption4 = '$row[image_caption4]',"
					. " image_caption5 = '$row[image_caption5]',"
					. " image_caption6 = '$row[image_caption6]',"
					. " image_caption7 = '$row[image_caption7]',"
					. " thumb_caption1 = '$row[thumb_caption1]',"
					. " thumb_caption2 = '$row[thumb_caption2]',"
					. " thumb_caption3 = '$row[thumb_caption3]',"
					. " thumb_caption4 = '$row[thumb_caption4]',"
					. " thumb_caption5 = '$row[thumb_caption5]',"
					. " thumb_caption6 = '$row[thumb_caption6]',"
					. " thumb_caption7 = '$row[thumb_caption7]',"
					. " image_default = '$row[image_default]'"
					. " WHERE id = $row[id]";
			$dbObj->query($sql);
			$row = $this->getGalleryToUse($row);
		}

		function DeleteImage($id) {
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			if (defined("SELECTED_DOMAIN_ID")) {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			} else {
				$dbObj = db_getDBObject();
			}
//			$dbMain->close();
			unset($dbMain);
			$sql = "SELECT * FROM Gallery_Image WHERE image_id = $id AND gallery_id = $this->id";
			$row = mysql_fetch_array($dbObj->query($sql));
			$image = new Image($row["image_id"]);
			$image->Delete();
			$image = new Image($row["thumb_id"]);
			$image->Delete();
			$sql = "DELETE FROM Gallery_Image WHERE image_id = $id";

			$dbObj->query($sql);
		}

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
				$sql = "SELECT * FROM Gallery WHERE account_id = $account_id";
				$result = $dbObj->query($sql);
				while ($row = mysql_fetch_array($result)) {
					$this->makeFromRow($row);
					$this->Delete($domain_id);
				}
			}
		}

		function getItemTitle () {
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

			$sqlGI = "SELECT `item_id`, `item_type` FROM `Gallery_Item` WHERE `gallery_id` = ".db_formatNumber($this->id);
			$resGI = $dbObj->Query($sqlGI);
			if (mysql_num_rows($resGI) > 0) {
				$rowGI = mysql_fetch_assoc($resGI);
				$sqlI = "SELECT `title` FROM `".string_ucwords($rowGI["item_type"])."` WHERE `id` = ".db_formatNumber($rowGI["item_id"]);
				$resI = $dbObj->Query($sqlI);
				if (mysql_num_rows($resI) > 0) {
					$rowI = mysql_fetch_assoc($resI);
					$this->title = $rowI["title"];
				}
			}
		}
	}

?>
