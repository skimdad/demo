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
	# * FILE: /includes/code/slideshow.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$galleryObj = new Gallery($_GET["gallery_id"]);
	$galleryObj->getItemTitle();
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	if ($galleryObj->getNumber("id") && $galleryObj->image && count($galleryObj->image) > 0) {
		if ($_GET["listing_level"]) {
			$galleryLevel = new ListingLevel();
			$maxGalleryImages = $galleryLevel->getImages($_GET["listing_level"]);
		} elseif ($_GET["event_level"]) {
			$galleryLevel = new EventLevel();
			$maxGalleryImages = $galleryLevel->getImages($_GET["event_level"]);
		} elseif ($_GET["classified_level"]) {
			$galleryLevel = new ClassifiedLevel();
			$maxGalleryImages = $galleryLevel->getImages($_GET["classified_level"]);
		} elseif ($_GET["article_level"]) {
			$galleryLevel = new ArticleLevel();
			$maxGalleryImages = $galleryLevel->getImages($_GET["article_level"]);
		}

		if (($maxGalleryImages) && (($maxGalleryImages > 0) || ($maxGalleryImages == -1))) {
			$totalImages = ($maxGalleryImages >= count($galleryObj->image)) ? count($galleryObj->image) : $maxGalleryImages;
			if ($maxGalleryImages == -1) $totalImages = count($galleryObj->image);

			$countImages = 0;

			$i=0;
			for ($imgInd = 0; $imgInd < $totalImages; $imgInd++) {
				$each_image = $galleryObj->image[$imgInd];
				$imageObj = new Image($each_image["image_id"]);
				$imageThumbObj = new Image($each_image["thumb_id"]);
				if($_GET["image_id"] == $each_image["image_id"]){
					$firstImage = $i;
				}else if ($_GET["image_id"] == 0){
					$firstImage = 0;
				}
				if ($imageObj->imageExists() && $imageThumbObj->imageExists()) {
					$countImages++;
					$name          = $imageObj->GetString("prefix")."photo_".$imageObj->GetString("id");
					$height[$imgInd] = $imageObj->GetString("height");
					$type          = string_strtolower($imageObj->GetString("type"));
					$image_name    = $name.".".$type;
					$image_caption = $each_image["image_caption".$langIndex];

					if ($i == 0) {
						if (!$first_image_src) $first_image_src = "".DEFAULT_URL."/custom/domain_".SELECTED_DOMAIN_ID."/image_files/$image_name";
						$image_caption = wordwrap($image_caption, 100, "<br />", true);
						$image_caption_list = "$image_caption";
						$image_list         = "".DEFAULT_URL."/custom/domain_".SELECTED_DOMAIN_ID."/image_files/$image_name";
					} elseif ($i > 0) {
						$image_caption = wordwrap($image_caption, 100, "<br />", true);
						$image_caption_list .= "{}$image_caption";
						$image_list         .= ", ".DEFAULT_URL."/custom/domain_".SELECTED_DOMAIN_ID."/image_files/$image_name";
					}
					$i++;
				}
			}
		}
	}
?>