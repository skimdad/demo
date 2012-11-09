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
	# * FILE: /frontend/featured_listing_review.php
	# ----------------------------------------------------------------------------------------------------

	setting_get('commenting_edir', $commenting_edir);
    setting_get('review_listing_enabled', $review_enabled);

    if($review_enabled == 'on' && $commenting_edir) {
        
        $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");

        if ($levelsWithReview !== false) {
            # ----------------------------------------------------------------------------------------------------
            # LIMIT
            # ----------------------------------------------------------------------------------------------------

            $lastItemStyle = 0;
            $numberOfReviews = 3;
            $reviewMaxSize = 120;

            # ----------------------------------------------------------------------------------------------------
            # CODE
            # ----------------------------------------------------------------------------------------------------
		if ($category_id > 0) {
            $sql = "SELECT item_id, 
                            member_id, 
                            added, 
                            reviewer_name, 
                            reviewer_location, 
                            review_title,
                            review,
                            rating, 
                            Account.image_id, 
                            Account.facebook_image, 
                            Account.has_profile,
                            ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".id,
                            ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".title,
                            ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".friendly_url,
                            ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".level
            FROM Review
            INNER JOIN  ".(FORCE_SECOND ? "Listing_Summary" : "Listing")." ON Review.item_id = ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".id
            LEFT JOIN AccountProfileContact Account ON (Account.account_id = member_id) 
            WHERE item_type = 'listing' AND
                  approved = 1 AND 
				".(($category_id > 0) ? " item_id IN (SELECT distinct listing_id FROM Listing_Category WHERE category_root_id = ".$category_id.") AND ":"")."
				item_id IN (SELECT id from Listing where zip_code IN (SELECT zipcode from zip where city = '".$stname."')) AND 
                 ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".status = 'A' AND 
                 ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".level in (".implode(',', $levelsWithReview).") ORDER BY added DESC LIMIT " . $numberOfReviews;

            $dbObj = db_getDBObject();
            $result = $dbObj->query($sql);
		} //end if category

		if (mysql_numrows($result) < 1) {
            $sql = "SELECT item_id, 
                            member_id, 
                            added, 
                            reviewer_name, 
                            reviewer_location, 
                            review_title,
                            review,
                            rating, 
                            Account.image_id, 
                            Account.facebook_image, 
                            Account.has_profile,
                            ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".id,
                            ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".title,
                            ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".friendly_url,
                            ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".level
            FROM Review
            INNER JOIN  ".(FORCE_SECOND ? "Listing_Summary" : "Listing")." ON Review.item_id = ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".id
            LEFT JOIN AccountProfileContact Account ON (Account.account_id = member_id) 
            WHERE item_type = 'listing' AND
                  approved = 1 AND 
				".(($category_id > 0) ? " item_id IN (SELECT distinct listing_id FROM Listing_Category WHERE category_root_id = ".$category_id.") AND ":"")."
                ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".status = 'A' AND 
                ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".level in (".implode(',', $levelsWithReview).") ORDER BY added DESC LIMIT " . $numberOfReviews;

            $dbObj = db_getDBObject();
            $result = $dbObj->query($sql);
		}// end if (mysql_numrows($result) < 1

            if (mysql_numrows($result)) {
                
                $levelObj = new ListingLevel();
                $sideBarStr .= "<h2>".system_showText(LANG_RECENT_REVIEWS)."</h2>";

                $sideBarStr .= "<div class=\"featured featured-review\">";

                while($row = mysql_fetch_array($result)) {

                    $lastItemStyle++;

                    if($lastItemStyle==1){
                        $itemStyle = "first";
                    }elseif($lastItemStyle==3){
                        $itemStyle = "last";
                    }else{
                        $itemStyle = "";
                    }

                    $sideBarStr .= "<div class=\"featured-item ".$itemStyle."\">";

                    if (SOCIALNETWORK_FEATURE == "on") {
                        if ($row["member_id"] && $row["has_profile"] == "y") {
                            $imgTag = socialnetwork_writeLink($row["member_id"], "profile", "general_see_profile", $row["image_id"], false, false);
                            if (!$imgTag){
                                $imgTag = "<span class=\"no-image no-link\"></span>";
                            }
                        } else {
                            $imgTag = "<span class=\"no-image no-link\"></span>";
                        }
                    }

                    $rate_stars = "";
                    if ($row['rating']) {
                        for ($x=0 ; $x < 5 ;$x++) {
                            if ($row['rating'] > $x) $rate_stars .= "<img src=\"".DEFAULT_URL."/images/img_rateMiniStarOn.png\" alt=\"Star On\" align=\"bottom\" />";
                            else $rate_stars .= "<img src=\"".DEFAULT_URL."/images/img_rateMiniStarOff.png\" alt=\"Star Off\" align=\"bottom\" />";
                        }
                    }

                    if (MODREWRITE_FEATURE == "on") {
                        $detailLink 	= "".LISTING_DEFAULT_URL."/reviews/".$row["friendly_url"];
                        if ($levelObj->getDetail($row["level"]) == "y") {
                            $detailItemLink = "".LISTING_DEFAULT_URL."/".$row["friendly_url"].".html";
                        } else {
                            $detailItemLink = "".LISTING_DEFAULT_URL."/results.php?id=".$row["id"];
                        }
                    } else {
                        $detailLink 	= "".LISTING_DEFAULT_URL."/comments.php?item_type=listing&item_id=".$row["id"];
                        if ($levelObj->getDetail($row["level"]) == "y") {
                            $detailItemLink = "".LISTING_DEFAULT_URL."/detail.php?id=".$row["id"];
                        } else {
                            $detailItemLink = "".LISTING_DEFAULT_URL."/results.php?id=".$row["id"];
                        }
                    }

                    if (SOCIALNETWORK_FEATURE == "on") {
                        $sideBarStr .= "<div class=\"image\">";
                        $sideBarStr .= $imgTag;
                        $sideBarStr .= "</div>";
                    }

                    $sideBarStr .= "<h3><a href=\"".$detailItemLink."\">".string_htmlentities($row["title"])."</a></h3>";

                    $sideBarStr .= "<div class=\"rate\">";
                    $sideBarStr .= $rate_stars;
                    $sideBarStr .= "</div>";

                    $sideBarStr .= "<a href=\"".$detailLink."\">".system_showText(LANG_READMORE)."</a>";

                    $review = "";
                    if (string_strlen(trim($row['review'])) > 0) {
                        $review .= system_showTruncatedText($row['review'], $reviewMaxSize);
                    }

                    $sideBarStr .= "<p>".$review."</p>";

                    $sideBarStr .= "<div class=\"info\">";

                        $str_time = format_getTimeString($row['added']);

                        $publication_string = "";
                        $membersStr = "";
                        if ($row['member_id']) {
                            $membersStr = socialnetwork_writeLink($row['member_id'], "profile", "general_see_profile");
                            if ($membersStr)
                                $publication_string .= "<p>".system_showText(LANG_BY)."&nbsp;".(($row['reviewer_name']) ? $membersStr : system_showText(LANG_NA))."</p>";
                            else
                                $publication_string .= "<p>".system_showText(LANG_BY)."&nbsp;".(($row['reviewer_name']) ? string_htmlentities($row['reviewer_name']) : system_showText(LANG_NA))."</p>";
                        } else {
                            $publication_string .= "<p>".system_showText(LANG_BY)."&nbsp;".(($row['reviewer_name']) ? string_htmlentities($row['reviewer_name']) : system_showText(LANG_NA))."</p>";
                        }
                        $publication_string .= "<p>".(($row['reviewer_location']) ? string_htmlentities($row['reviewer_location']) : system_showText(LANG_NA))."</p>";
                        $publication_string .= "<p>".format_date($row['added'], DEFAULT_DATE_FORMAT, "datetime")." - ".$str_time."</p>";

                        $sideBarStr .= $publication_string;
                        $publication_string = "";

                    $sideBarStr .= "</div>";

                    $sideBarStr .= "</div>";						

                }
                $sideBarStr .= "</div>";
            }
        }
    }
    
    if (!$ajaxSideBar){
        echo $sideBarStr;
    }
?>