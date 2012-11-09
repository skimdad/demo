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
	# * FILE: /includes/code/returngallery.php
	# ----------------------------------------------------------------------------------------------------

    $aux_domain_id = $_GET["domain_id"] ? $_GET["domain_id"] : SELECTED_DOMAIN_ID;

    if (!defined("SELECTED_DOMAIN_ID")){
        define("SELECTED_DOMAIN_ID", $aux_domain_id);
    }

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	$id = $_GET["id"] ? $_GET["id"] : 0;
	$new_image = $_GET["new_image"];
	$sess = $_GET["sess"];
	$module = $_GET["module"];
	$main = $_GET["main"];
	$level = $_GET["level"];
	$gallery_hash = $_GET["gallery_hash"];

	switch ($module){
		case "article" :	$thumb_width = IMAGE_ARTICLE_THUMB_WIDTH;
							$thumb_height = IMAGE_ARTICLE_THUMB_HEIGHT;
							break;
		case "classified" : $thumb_width = IMAGE_CLASSIFIED_THUMB_WIDTH;
							$thumb_height = IMAGE_CLASSIFIED_THUMB_HEIGHT;
							break;
		case "event" :		$thumb_width = IMAGE_EVENT_THUMB_WIDTH;
							$thumb_height = IMAGE_EVENT_THUMB_HEIGHT;
							break;
		case "listing" :	$thumb_width = IMAGE_LISTING_THUMB_WIDTH;
							$thumb_height = IMAGE_LISTING_THUMB_HEIGHT;
							break;
	}
    
    $hasmain_image = true;
    
    $strLevelObj = ucfirst($module)."Level";
    $levelObj = new $strLevelObj();
    $maxImages = $levelObj->getImages($level);
    
	if ($id) {

		if ($sess == "members") {
			sess_validateSession();
			$by_key = array("id", "account_id");
			$by_value = array(db_formatNumber($id), sess_getAccountIdFromSession());
			$moduleObj = db_getFromDB($module, $by_key, $by_value, 1, "", "object", $aux_domain_id);
		} else {
			$moduleObj = db_getFromDB($module, "id", db_formatNumber($id), 1, "", "object", $aux_domain_id);
		}

		$moduleObj->extract();
        
        if ($module != "article"){
            //Get fields according to level
            unset($array_fields);
            $array_fields = system_getFormFields(ucfirst($module), $moduleObj->getNumber("level"));
            if (is_array($array_fields) && !in_array("main_image", $array_fields)){
                $hasmain_image = false;
            }
        }

		$galleries = db_getFromDBBySQL("gallery", "SELECT gallery_id FROM Gallery_Item WHERE item_id = ".$id." AND item_type = '$module' ORDER BY id", "array", false, $aux_domain_id);
		$gallery_id = $galleries[0]["gallery_id"];
	} 
	
	$langIndex = language_getIndex(EDIR_LANGUAGE);

	$return_code = "<ul>";
	if ($thumb_id && $hasmain_image) {
		$imageObj = new Image($thumb_id);
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID($aux_domain_id, $dbMain);
		$sql = "SELECT thumb_caption$langIndex FROM Gallery_Image WHERE gallery_id = $gallery_id AND image_default <> 'n' AND thumb_id = $thumb_id ORDER BY id";
		$r = $dbObj->query($sql);

		while ($row_aux = mysql_fetch_array($r)) {
			$altImage = htmlspecialchars($row_aux["thumb_caption".$langIndex], ENT_QUOTES);
			$thumb_caption = system_showTruncatedText($row_aux["thumb_caption".$langIndex], 40);
		}

		$return_code .= "<li class=\"mainImageGallery\">";
		$return_code .= $imageObj->getTag(true, $thumb_width, $thumb_height, $altImage, true);
		$return_code .= "<h5>".$thumb_caption."</h5>";
        if ($sess == "sitemgr"){
            $return_code .= "<a href=\"".DEFAULT_URL."/$sess/uploadimage.php?item_type=$module&level=$level&item_id=".$id."&image_id=".$image_id."&thumb_id=".$thumb_id."&captions=y\" class=\"ImageEditCaptions iframe fancy_window_imgAdd\">".LANG_LABEL_EDIT_CAPTIONS."</a>";
        } else {
            $return_code .= "<a href=\"".DEFAULT_URL."/popup/popup.php?domain_id=".SELECTED_DOMAIN_ID."&pop_type=uploadimage&item_type=$module&level=$level&item_id=".$id."&image_id=".$image_id."&thumb_id=".$thumb_id."&captions=y\" class=\"ImageEditCaptions iframe fancy_window_imgAdd\">".LANG_LABEL_EDIT_CAPTIONS."</a>";
        }
        $return_code .= "<a href=\"".DEFAULT_URL."/$sess/delete_image.php?item_type=$module&item_id=".$id."\" class=\"ImageDelete iframe fancy_window_imgDelete\" >".LANG_LABEL_DELETE."</a>";
		if ($main != "false"){
			$return_code .= "<a href=\"javascript:void(0);\" class=\"mainImageLink mainImageLinkBK\" title=\"".LANG_LABEL_CLICKTOSETGALLERYIMAGE."\" onclick=\"changeMain(".$image_id.",".$thumb_id.",".$id.",'n',".$gallery_id.",'$module')\">".LANG_LABEL_MAINIMAGE."</a>";
		}
		$return_code .= "</li>";
	}

	if ($gallery_id) {

		$return_code .=	"<input type=\"hidden\" name=\"gallery_id\" id=\"gallery_id\" value=".$gallery_id." />";
		$gallery = new Gallery($gallery_id, $aux_domain_id);

		if ((count($gallery->image) > 0) && ($thumb_id)) {
			$col = 1;
		} else {
			$col = 0;
		}
        
        $totalImages = ($maxImages >= count($gallery->image)) ? count($gallery->image) : $maxImages;

		if (count($gallery->image) > 0) {
			for ($i=0; $i<$totalImages; $i++) {
				if ($col == 0) {
					$return_code .= "";
				}
				$col++;

				$imageObj = new Image($gallery->image[$i]["thumb_id"]);

				$altImage = htmlspecialchars($gallery->image[$i]["thumb_caption".$langIndex], ENT_QUOTES);
				$thumb_caption = system_showTruncatedText($gallery->image[$i]["thumb_caption".$langIndex], 40);
				$return_code .= "<li>";
				$return_code .= "<span class=\"galleryImgThumb\">".$imageObj->getTag(true, $thumb_width, $thumb_height, $altImage, true)."</span>";
				$return_code .= "<h5>".$thumb_caption."</h5>";
                if ($sess == "sitemgr"){
                    $return_code .= "<a href=\"".DEFAULT_URL."/$sess/uploadimage.php?item_type=$module&level=$level&item_id=".$id."&gallery_id=".$gallery_id."&image_id=".$gallery->image[$i]["image_id"]."&thumb_id=".$gallery->image[$i]["thumb_id"]."&captions=y\" class=\"ImageEditCaptions iframe fancy_window_imgAdd\">".LANG_LABEL_EDIT_CAPTIONS."</a>";
                } else {
                    $return_code .= "<a href=\"".DEFAULT_URL."/popup/popup.php?domain_id=".SELECTED_DOMAIN_ID."&pop_type=uploadimage&item_type=$module&level=$level&item_id=".$id."&gallery_id=".$gallery_id."&image_id=".$gallery->image[$i]["image_id"]."&thumb_id=".$gallery->image[$i]["thumb_id"]."&captions=y\" class=\"ImageEditCaptions iframe fancy_window_imgAdd\">".LANG_LABEL_EDIT_CAPTIONS."</a>";
                }
                $return_code .= "<a href=\"".DEFAULT_URL."/$sess/delete_image.php?item_id=".$moduleObj->getNumber("id")."&item_type=$module&gallery_image_id=".$gallery->image[$i]["image_id"]."&gallery_id=".$gallery_id."\" class=\"ImageDelete iframe fancy_window_imgDelete\" >".LANG_LABEL_DELETE."</a>";
				if ($main != "false"){
					$return_code .= "<a href=\"javascript:void(0);\" title=\"".LANG_LABEL_CLICKTOSETMAINIMAGE."\" class=\"mainImageLinkBK\" onclick=\"makeMain(".$gallery->image[$i]["image_id"].",".$gallery->image[$i]["thumb_id"].",".$moduleObj->getNumber("id").",'n','$module')\">".LANG_LABEL_MAKEMAIN."</a>";
				}
				$return_code .= "</li>";
			}
		}

	}

	if ($new_image == "y"){

		$col = 0;

		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID($aux_domain_id, $dbMain);
		$sess_id = $gallery_hash;

		$sql = "SELECT * FROM Gallery_Temp WHERE sess_id='$sess_id'";
		$r = $db->query($sql);
		while ($row = mysql_fetch_array($r)) {
			if ($col == 0) {
					$return_code .= "";
				}
				$col++;

				$imageObj = new Image($row["thumb_id"]);

				$altImage = htmlspecialchars($row["thumb_caption".$langIndex], ENT_QUOTES);
				$thumb_caption = system_showTruncatedText($row["thumb_caption".$langIndex], 40);
				if ($row["image_default"]=='y') {
					$return_code .= "<li class=\"mainImageGallery\">";
				} else{
					$return_code .= "<li>";
				}
				$return_code .= "<span class=\"galleryImgThumb\">".$imageObj->getTag(true, $thumb_width, $thumb_height, $altImage, true)."</span>";
				$return_code .= "<h5>".$thumb_caption."</h5>";
				if ($sess == "sitemgr"){
                    $return_code .= "<a href=\"".DEFAULT_URL."/$sess/uploadimage.php?temp=y&item_type=$module&level=$level&item_id=".$id."&gallery_id=".$gallery_id."&image_id=".$row["image_id"]."&thumb_id=".$row["thumb_id"]."&captions=y\" class=\"ImageEditCaptions iframe fancy_window_imgAdd\">".LANG_LABEL_EDIT_CAPTIONS."</a>";
                } else {
                    $return_code .= "<a href=\"".DEFAULT_URL."/popup/popup.php?domain_id=".SELECTED_DOMAIN_ID."&pop_type=uploadimage&temp=y&item_type=$module&level=$level&item_id=".$id."&gallery_id=".$gallery_id."&image_id=".$row["image_id"]."&thumb_id=".$row["thumb_id"]."&captions=y\" class=\"ImageEditCaptions iframe fancy_window_imgAdd\">".LANG_LABEL_EDIT_CAPTIONS."</a>";
                }
                $return_code .= "<a href=\"".DEFAULT_URL."/$sess/delete_image.php?temp=y&item_type=$module&item_id=".$id."&gallery_image_id=".$row["image_id"]."&gallery_id=".$gallery_id."\" class=\"ImageDelete iframe fancy_window_imgDelete\" >".LANG_LABEL_DELETE."</a>";

				if ($main != "false"){
					if ($row["image_default"] == "n") {
						$return_code .= "<a href=\"javascript:void(0);\" class=\"mainImageLinkBK\" title=\"".LANG_LABEL_CLICKTOSETMAINIMAGE."\" onclick=\"makeMain(".$row["image_id"].",".$row["thumb_id"].",".$id.",'y','$module')\">".LANG_LABEL_MAKEMAIN."</a></li>";
					} else {
						$return_code .= "<a href=\"javascript:void(0);\" class=\"mainImageLink mainImageLinkBK\" title=\"".LANG_LABEL_CLICKTOSETGALLERYIMAGE."\" onclick=\"changeMain(".$row["image_id"].",".$row["thumb_id"].",".$id.",'y',0,'$module')\">".LANG_LABEL_MAINIMAGE."</a></li>";
					}
				}
			}
	}
	$return_code .= "</ul>";

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	header("Accept-Encoding: gzip, deflate");
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check", FALSE);
	header("Pragma: no-cache");

	echo $return_code;
?>