<?

$isMobileApp_MOBI = TRUE;


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
# * FILE: /includes/views/view_listing_summary.php
# ----------------------------------------------------------------------------------------------------

if (is_object($listing)) {
    $is_object = true;
    $listingAux = $listing;
    $listing = $listing->data_in_array;
}

//Get fields according to level
unset($array_fields);
$array_fields = system_getFormFields("Listing", $listing['level']);

 if (MODREWRITE_FEATURE == "on") {
        $detailLink = MOBILE_DEFAULT_URL . "/listing/" . $listing["friendly_url"] . ".html";
    } else {
        $detailLink = "" . MOBILE_DEFAULT_URL . "/listingdetail.php?id=" . htmlspecialchars($listing["id"]);    
    }

/*
  $listingtemplate_friendly_url = htmlspecialchars($listing["friendly_url"]);

  $listingtemplate_icon_navbar = "";

  include(EDIRECTORY_ROOT."/includes/views/icon_listing.php");
  $listingtemplate_icon_navbar = $icon_navbar;
  $icon_navbar = "";

  $listingtemplate_claim = "";
  if (CLAIM_FEATURE == "on") {
  if (!htmlspecialchars($listing["account_id"])) {
  if (htmlspecialchars($listing["claim_disable"]) == "n") {
  customtext_get("claim_textlink", $claim_textlink, EDIR_LANGUAGE);
  if ($claim_textlink) $claim_textlink_string = $claim_textlink;
  $listingtemplate_claim = "<a href=\"".$claim_link."\" ".$claim_style.">".$claim_textlink_string."</a>";
  }
  }
  }

  $listingtemplate_video_snippet_width = "";
  $listingtemplate_video_snippet_height = "";
  $listingtemplate_video_snippet = "";
  if (htmlspecialchars($listing["video_snippet"]) && (is_array($array_fields) && in_array("video", $array_fields))) {
  $listingtemplate_video_snippet_width = IMAGE_LISTING_THUMB_WIDTH;
  $listingtemplate_video_snippet_height = IMAGE_LISTING_THUMB_HEIGHT;
  $listingtemplate_video_snippet = system_getVideoSnippetCode($listing["video_snippet"], IMAGE_LISTING_THUMB_WIDTH, IMAGE_LISTING_THUMB_HEIGHT);
  }

  $listingtemplate_image = "";

  if (is_array($array_fields) && in_array("main_image", $array_fields)){
  unset($arrImage);
  if ($tPreview) {
  $listingtemplate_image = "<span class=\"no-image\" style=\"cursor: default;\"></span>";
  } else {
  if ($is_object) {
  $imageObj = new Image($listing["thumb_id"]);
  } else {

  $imageObjT = new Image($listing["thumb_id"]);
  $auxPrefix = $imageObjT->prefix;
  unset($imageObjT);

  $arrImage["id"] = htmlspecialchars($listing["thumb_id"]);
  $arrImage["type"] = htmlspecialchars($listing["thumb_type"]);
  $arrImage["width"] = htmlspecialchars($listing["thumb_width"]);
  $arrImage["height"] = htmlspecialchars($listing["thumb_height"]);
  $arrImage["prefix"] = $auxPrefix;

  $imageObj = new Image($arrImage);
  }

  if ($imageObj->imageExists()) {
  if (($user) && ($levelObj->getDetail(htmlspecialchars($listing["level"])) == "y") || $levelObj->getActive(htmlspecialchars($listing["level"])) == 'n') {
  $listingtemplate_image .= "<a href=\"".$detailLink."\">";
  $listingtemplate_image .= $imageObj->getTag(true, IMAGE_LISTING_THUMB_WIDTH, IMAGE_LISTING_THUMB_HEIGHT, htmlspecialchars($listing["title"]), true);
  $listingtemplate_image .= "</a>";
  } else {
  $listingtemplate_image .= $imageObj->getTag(true, IMAGE_LISTING_THUMB_WIDTH, IMAGE_LISTING_THUMB_HEIGHT, htmlspecialchars($listing["title"]), true);
  }
  } else {
  if (($user) && ($levelObj->getDetail(htmlspecialchars($listing["level"])) == "y") || $levelObj->getActive(htmlspecialchars($listing["level"])) == 'n') {
  $listingtemplate_image .=	"<a href=\"".$detailLink."\" class=\"image\">";
  $listingtemplate_image .=	"<span class=\"no-image\"></span>";
  $listingtemplate_image .=	"</a>";
  } else {
  $listingtemplate_image .= "<span class=\"no-image ".(!$user ? "no-link" : "")." \" style=\"width:".(IMAGE_LISTING_THUMB_WIDTH)."px; height:".(IMAGE_LISTING_THUMB_HEIGHT)."px; float: left;\">&nbsp;</span>";
  }
  }
  }
  }

 */

$listingtemplate_title = "";
if (($user) && ($levelObj->getDetail(htmlspecialchars($listing["level"])) == "y") || $levelObj->getActive(htmlspecialchars($listing["level"])) == 'n') {
    $listingtemplate_title = "<a href=\"" . $detailLink . "\">" . htmlspecialchars($listing["title"]) . "</a>";
} else {
    $listingtemplate_title = htmlspecialchars($listing["title"]);
}
if (zipproximity_getDistanceLabel($zip, "listing", htmlspecialchars($listing["id"]), $distance_label, true, $listing)) {
    $listingtemplate_title .= " (" . $distance_label . ")";
}
$auxOriginalTitle = htmlspecialchars($listing["title"]);

$listingtemplate_title2 = "";

$listingtemplate_complementaryinfo = "";
 /* if ($tPreview) {
    $listingtemplate_complementaryinfo .= system_showText(LANG_IN) . " ";
    $listingtemplate_complementaryinfo .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">" . system_showText(LANG_LABEL_ADVERTISE_CATEGORY1) . "</a>";
    $listingtemplate_complementaryinfo .= ", ";
    $listingtemplate_complementaryinfo .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">" . system_showText(LANG_LABEL_ADVERTISE_CATEGORY2) . "</a>";
    $listingtemplate_complementaryinfo .= " " . LANG_BY . " ";
   if (SOCIALNETWORK_FEATURE == "on") {
      $listingtemplate_complementaryinfo .= "<a href=\"javascript:void(0);\" title=\"".system_showText(LANG_LABEL_ADVERTISE_LISTING_OWNER)."\" style=\"cursor: default;\">".system_showText(LANG_LABEL_ADVERTISE_LISTING_OWNER)."</a>";
      } else {
      $listingtemplate_complementaryinfo .= "<strong>".system_showText(LANG_LABEL_ADVERTISE_LISTING_OWNER)."</strong>";
      }
      } else {
      if(LISTING_SCALABILITY_OPTIMIZATION == "on"){
      $listingtemplate_complementaryinfo = "<a href=\"javascript: void(0);\" ".($user ? "onclick=\"showCategory(".htmlspecialchars($listing["id"]).", 'listing', ".($user ? true : false).", ".$listing["account_id"].")\"" : "style=\"cursor: default;\"").">".system_showText(LANG_VIEWCATEGORY)."</a>";
      } else {
      $listingtemplate_complementaryinfo = system_itemRelatedCategories(htmlspecialchars($listing["id"]), "listing", $user);
      if (socialnetwork_writeLink(htmlspecialchars($listing["account_id"]), "profile", "general_see_profile",false , false, "", false, $user)) {
      $listingtemplate_complementaryinfo .= " ".LANG_BY." ".socialnetwork_writeLink(htmlspecialchars($listing["account_id"]), "profile", "general_see_profile",false , false, "", false, $user);
      }
      } 
}

$listingtemplate_designations = "";
if (is_array($array_fields) && in_array("badges", $array_fields)) {
    include(INCLUDES_DIR . "/tables/table_choice.php");

    $listingtemplate_designations = $designations;
    $designations = "";
}
*/
$listingtemplate_address = "";
if (htmlspecialchars($listing["address"])) {
    $listingtemplate_address = nl2br(htmlspecialchars($listing["address"]));
    $listingtemplate_title2 .= ", " . $listingtemplate_address;
}

$listingtemplate_address2 = "";
if (htmlspecialchars($listing["address2"])) {
    $listingtemplate_address2 = nl2br(htmlspecialchars($listing["address2"]));
}

$locationsToshow = system_retrieveLocationsToShow();
$listingtemplate_location = "";
if ($tPreview) {
    $locationsToShow = explode(",", EDIR_LOCATIONS);
    $locationsToShow = array_reverse($locationsToShow);
    foreach ($locationsToShow as $locationToShow) {
        $listingtemplate_location .= system_showText(constant("LANG_LABEL_" . constant("LOCATION" . $locationToShow . "_SYSTEM"))) . ", ";
    }
    $listingtemplate_location = string_substr("$listingtemplate_location", 0, -2) . ', ' . $listing["zip_code"];
} else {

    $locationsParam = $locationsToshow . ", z";

    if ($is_object) {
        $listingtemplate_location = $listingAux->getLocationString($locationsParam, true);
        unset($array_location_string2);
        $array_location_string2 = array();
        if ($listingAux->getNumber("location_4")) {
            $auxLocation4 = new Location4($listingAux->getNumber("location_4"));
            $array_location_string2[] = $auxLocation4->getString("name");
            $auxLocation3 = new Location3($listingAux->getNumber("location_3"));
            $array_location_string2[] = $auxLocation3->getString("abbreviation");
        }
        $listingtemplate_title2 .= ($listingtemplate_title2 ? ", " : "") . implode(", ", $array_location_string2);
        unset($listingAux);
    } else {
        unset($locationsParam_array);
        $locationsParam_array = explode(",", $locationsParam);
        unset($array_location_string);
        unset($array_location_string2);
        $array_location_string = array();
        $array_location_string2 = array();
        for ($r = 0; $r < count($locationsParam_array); $r++) {
            unset($aux_field_name);
            $field_id = trim($locationsParam_array["$r"]);
            if ($field_id == "z") {
                $aux_field_name = "zip_code";
            } else {
                $aux_field_name = "location_" . $field_id . "_title";
            }
            if (strlen($listing[$aux_field_name]) > 0) {
                $array_location_string[] = $listing[$aux_field_name];
            }
            if ($aux_field_name == "location_4_title") {
                if ($listing[$aux_field_name]) {
                    $array_location_string2[] = $listing[$aux_field_name];
                }
                if ($listing["location_3_abbreviation"]) {
                    $array_location_string2[] = $listing["location_3_abbreviation"];
                }
            }
        }
        $listingtemplate_location = implode(", ", $array_location_string);
        if (is_array($array_location_string2) && $array_location_string2[0]) {
            $listingtemplate_title2 .= ", " . implode(", ", $array_location_string2);
        }
    }
}
/*
if (USING_THEME_TEMPLATE && THEME_TEMPLATE_ID > 0 && TEMPLATE_SUMMARY_FIELDS && $listing["listingtemplate_id"] == THEME_TEMPLATE_ID) {
    $themeSummaryFields = unserialize(TEMPLATE_SUMMARY_FIELDS);
    if ($listing[$themeSummaryFields["price_field"]]) {
        $listingtemplate_title2 .= " | " . CURRENCY_SYMBOL . $listing[$themeSummaryFields["price_field"]];
    }
    $array_comp_info = array();
    if ($listing[$themeSummaryFields["bedroom_field"]]) {
        $array_comp_info[] = $listing[$themeSummaryFields["bedroom_field"]] . " " . system_showText(LANG_LABEL_TEMPLATE_BEDROOM);
    }
    if ($listing[$themeSummaryFields["bathroom_field"]]) {
        $array_comp_info[] = $listing[$themeSummaryFields["bathroom_field"]] . " " . system_showText(LANG_LABEL_TEMPLATE_BATHROOM);
    }
    if ($listing[$themeSummaryFields["squarefeet_field"]]) {
        $array_comp_info[] = $listing[$themeSummaryFields["squarefeet_field"]] . " " . system_showText(LANG_LABEL_TEMPLATE_SQUARE);
    }
    $listingtemplate_complementaryinfo2 = "";
    $listingtemplate_complementaryinfo2 = implode(" | ", $array_comp_info);
}
 * */


$listingtemplate_title2 = htmlspecialchars($listingtemplate_title2);

unset($labelsuffix);

$labelsuffix = language_getIndex(EDIR_LANGUAGE);

$listingtemplate_description = "";

if (htmlspecialchars($listing["description" . $labelsuffix]) && (is_array($array_fields) && in_array("summary_description", $array_fields))) {
    $listingtemplate_description = nl2br(htmlspecialchars($listing["description" . $labelsuffix]));
}

$listingtemplate_phone = "";
if (htmlspecialchars($listing["phone"])) {
    if ($user) {
       // $listingtemplate_phone .= "<span id=\"phoneLink" . htmlspecialchars($listing["id"]) . "\" class=\"show-inline\"></span>";
        $listingtemplate_phone .= "<span id=\"phoneNumber" . htmlspecialchars($listing["id"]) . "\" class=\"hide\" title=\"" . htmlspecialchars($listing["phone"]) . "\">" . system_showTruncatedText($listing["phone"], 30) . "</span>";
    } else {
        $listingtemplate_phone = system_showTruncatedText($listing["phone"], 30);
    }
}
/*
$listingtemplate_fax = "";
if (htmlspecialchars($listing["fax"]) && (is_array($array_fields) && in_array("fax", $array_fields))) {
    if ($user) {
        $listingtemplate_fax .= "<span id=\"faxLink" . htmlspecialchars($listing["id"]) . "\" class=\"show-inline\"><a href=\"javascript:showFax('" . htmlspecialchars($listing["id"]) . "','" . DEFAULT_URL . "');\">" . system_showText(LANG_LISTING_VIEWFAX) . "</a></span>";
        $listingtemplate_fax .= "<span id=\"faxNumber" . htmlspecialchars($listing["id"]) . "\" class=\"hide\" title=\"" . htmlspecialchars($listing["fax"]) . "\">" . system_showTruncatedText($listing["fax"], 30) . "</span>";
    } else {
        $listingtemplate_fax = system_showTruncatedText($listing["fax"], 30);
    }
}

$listingtemplate_url = "";
if (htmlspecialchars($listing["url"]) && (is_array($array_fields) && in_array("url", $array_fields))) {
    $display_url = htmlspecialchars($listing["url"]);
    if (htmlspecialchars($listing["display_url"])) {
        $display_url = htmlspecialchars($listing["display_url"]);
    }
    $display_url_title = $display_url;
    $display_url = system_showTruncatedText($display_url, 29);
    if ($user) {
        $listingtemplate_url = "<a href=\"" . DEFAULT_URL . "/listing_reports.php?report=website&amp;id=" . htmlspecialchars($listing["id"]) . "\" target=\"_blank\" title=\"$display_url_title\">" . $display_url . "</a>";
    } else {
        $listingtemplate_url = "<a href=\"javascript:void(0);\" title=\"$display_url_title\" style=\"cursor:default\">" . $display_url . "</a>";
    }
}

$listingtemplate_email = "";
if (htmlspecialchars($listing["email"]) && (is_array($array_fields) && in_array("email", $array_fields))) {
    $display_email = wordwrap(htmlspecialchars($listing["email"]), 30, "<br />", true);
    if ($user) {
        $listingtemplate_email = "<a href=\"" . DEFAULT_URL . "/popup/popup.php?pop_type=listing_emailform&amp;id=" . htmlspecialchars($listing["id"]) . "&amp;receiver=owner\" class=\"iframe fancy_window_tofriend\">" . system_showText(LANG_SEND_AN_EMAIL) . "</a>";
    } else {
        $listingtemplate_email = "<a href=\"javascript:void(0);\" style=\"cursor:default\">" . system_showText(LANG_SEND_AN_EMAIL) . "</a>";
    }
}

$listingtemplate_attachment_file = "";
if (htmlspecialchars($listing["attachment_file"]) && (is_array($array_fields) && in_array("attachment_file", $array_fields))) {
    if (file_exists(EXTRAFILE_DIR . "/" . $listing["attachment_file"])) {
        $listingtemplate_attachment_file .= "<p>";
        if ($user) {
            $listingtemplate_attachment_file .= "<a href=\"" . EXTRAFILE_URL . "/" . htmlspecialchars($listing["attachment_file"]) . "\" target=\"_blank\">";
        } else {
            $listingtemplate_attachment_file .= "<a href=\"javascript:void(0);\" >";
        }
        if (htmlspecialchars($listing["attachment_caption"])) {
            $listingtemplate_attachment_file .= htmlspecialchars($listing["attachment_caption"]);
        } else {
            $listingtemplate_attachment_file .= system_showText(LANG_LISTING_ATTACHMENT);
        }
        $listingtemplate_attachment_file .= "</a>";
        $listingtemplate_attachment_file .= "</p>";
    }
}*/
$listingtemplate_long_description = "";
if (htmlspecialchars($listing["long_description" . $labelsuffix]) && (is_array($array_fields) && in_array("long_description", $array_fields))) {
    $listingtemplate_long_description = nl2br(htmlspecialchars($listing["long_description" . $labelsuffix]));
}

/*$listingtemplate_hours_work = "";
if (htmlspecialchars($listing["hours_work"]) && (is_array($array_fields) && in_array("hours_of_work", $array_fields))) {
    $listingtemplate_hours_work = nl2br(htmlspecialchars($listing["hours_work"]));
}
 * */
 

$listingtemplate_locations = "";
if (htmlspecialchars($listing["locations"]) && (is_array($array_fields) && in_array("locations", $array_fields))) {
    
    $listingtemplate_locations = nl2br(htmlspecialchars($listing["locations"]));
}

/* $listingtemplate_twilioSMS = "";
  $listingtemplate_twilioCall = "";

  if ($levelsWithSendPhone) { // this variable is created on /listing/results_listing.php
  if (in_array($listing["level"], $levelsWithSendPhone)) {
  /*
 * Prepare link to Twilio SMS

  if ($user){
  $listingtemplate_twilioSMS = twilio_PrepareLink("Listing", $listing["id"]);
  $twilioSMS_style = "class=\"iframe fancy_window_twilio\"";
  } else {
  $listingtemplate_twilioSMS = "javascript: void(0);";
  $twilioSMS_style = "style=\"cursor: default;\"";
  }
  }
  }

  if ($levelsWithClicktoCall) {  // this variable is created on /listing/results_listing.php

  if (in_array($listing["level"], $levelsWithClicktoCall) && $listing["clicktocall_number"]) {
  /*
 * Prepare link to Twilio Click to Call

  if ($user){
  $listingtemplate_twilioCall = twilio_PrepareLink("Listing", $listing["id"], true);
  $twilioCall_style = "class=\"iframe fancy_window_twilio\"";
  } else {
  $listingtemplate_twilioCall = "javascript: void(0);";
  $twilioCall_style = "style=\"cursor: default;\"";
  }
  }
  } 

$listingtemplate_review = "";

if ($review_enabled == "on" && $commenting_edir) {
    if ($levelsWithReview) {
        if (in_array($listing["level"], $levelsWithReview)) {
            $item_type = 'listing';
            $item_id = htmlspecialchars($listing["id"]);
            $itemObj = $listing;
            include(INCLUDES_DIR . "/views/view_review.php");
            $listingtemplate_review .= $item_review;
            $item_review = "";
        }
    }
}

$listingtemplate_checkin = "";

include(INCLUDES_DIR . "/views/view_checkin.php");
$listingtemplate_checkin .= $item_checkin;
$item_checkin = "";

$moreinfo_link = "";
$moreinfo_label = "";
if ($levelObj->getDetail(htmlspecialchars($listing["level"])) == "y") {
    if ($user) {
        $moreinfo_link = $detailLink;
        $moreinfo_label = system_showText(LANG_LISTING_MOREINFO) . " &raquo;";
    } else {
        $moreinfo_link = "javascript:void(0);";
        $moreinfo_label = system_showText(LANG_LISTING_MOREINFO);
    }
}

$listingviewtype = "summary";

/*
 * DEAL ITEM

$listing_deal = "";
if (($levelObj->getHasPromotion($listing["level"]) == "y") && (PROMOTION_FEATURE == 'on' && CUSTOM_PROMOTION_FEATURE == 'on')) {
    if ($tPreview) {
        $listing_deal = "<div class=\"deal-tag\">" . CURRENCY_SYMBOL . "90</div>";
        $listing_deal .= "<h4><a href=\"javascript:void(0);\" style=\"cursor: default;\">" . system_showText(LANG_LABEL_ADVERTISE_DEAL_TITLE) . "</a></h4>";
    } else {
        if ($promotionObj) {
            unset($promotionObj);
            if ($promotion)
                unset($promotion);
        }

        $hasDeal = false;
        $listing_deal = "";
        if ($listing['promotion_id'] && (PROMOTION_FEATURE == 'on' && CUSTOM_PROMOTION_FEATURE == 'on')) {

            $promotionObj = new Promotion($listing['promotion_id']);

            if ((validate_date_deal($promotionObj->getDate("start_date"), $promotionObj->getDate("end_date"))) && (validate_period_deal($promotionObj->getNumber("visibility_start"), $promotionObj->getNumber("visibility_end")))) {
                $hasDeal = true;

                $promotionInfo['name'] = $promotionObj->getString('name', true, 40);

                if ($promotionObj->realvalue > 0 && $promotionObj->dealvalue > 0) {
                    $offer = CURRENCY_SYMBOL . string_substr($promotionObj->dealvalue, 0, (string_strpos($promotionObj->dealvalue, ".")));
                    $cents = string_substr($promotionObj->getNumber("dealvalue"), (string_strpos($promotionObj->getNumber("dealvalue"), ".")), 3);
                    if ($cents == ".00")
                        $cents = "";
                }

                else
                    $offer = system_showText(LANG_NA);
                $promotionInfo['offer'] = $offer;
                $promotionInfo['cents'] = $cents;

                $promotionInfo['url'] = PROMOTION_DEFAULT_URL . '/' . ((MODREWRITE_FEATURE != 'on') ? "detail.php?id=" . $promotionObj->id : $promotionObj->getString('friendly_url') . ".html");
                if (!$user) {
                    $promotionInfo['url'] = 'javascript:void(0)';
                    $promotionInfo['style'] = " style=\"cursor:default\"";
                }

                $listing_deal .= "<div class=\"deal-tag\">" . $promotionInfo['offer'] . ($promotionInfo['cents'] ? "<span class=\"cents\">" . $promotionInfo['cents'] . "</span>" : "") . "</div>";
                $listing_deal .= "<h4><a href=\"" . $promotionInfo['url'] . "\"" . $promotionInfo['style'] . ">" . $promotionInfo['name'] . "</a></h4>";
            }
        }
    }
}
*/
?>
<li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="false" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li ui-li-has-alt ui-li-has-thumb ui-corner-top ui-btn-up-c">
    <div class="ui-btn-inner ui-li ui-li-has-alt ui-corner-top">
        <div class="ui-btn-text" style="font-weight: normal">
           <a href="<?= $detailLink ?>" class="ui-link-inherit" data-transition="slideup" style="padding:0px; padding-left:10px;">
                <h3 class="ui-li-heading">
                    <?= htmlspecialchars($listing["title"]) ?>
                    
                </h3>
                <? if($listingtemplate_address || $listingtemplate_address2 || $listingtemplate_location || $listingtemplate_locations) { ?>
                    <address style="font-style: normal;margin-bottom: 5px;">
                        <? if ($listingtemplate_address) { ?>
                            <div><?= $listingtemplate_address ?></div>
                        <? } ?>
                        <? if ($listingtemplate_address2) { ?>
                            <div><?= $listingtemplate_address2 ?></div>
                        <? } ?>
                        <? if ($listingtemplate_location ||$listingtemplate_locations) { ?>
                            <div>
                                <?
                                if ($listingtemplate_location)
                                    echo $listingtemplate_location;
                               
                               
                                ?>
                            </div>
                        <? } ?>
                    </address>
                <? } ?>
                <? if ($listingtemplate_phone) { ?>
                    <div class="phone" style="font-style: normal;margin-bottom: 5px;"><span class="bold"><?= system_showText(LANG_LISTING_LETTERPHONE); ?>:</span> <?= htmlspecialchars($listing["phone"]); ?></div>
                <? } ?>
                <? if ($listingtemplate_description) { ?>
                    <div style="font-style: normal;margin-bottom: 5px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden"> <?= $listingtemplate_description ?></div>
                <? } ?>
            </a>
        </div>
    </div>
    <a style="padding:0px;" href="<?= $detailLink ?>" data-transition="slideup" title="Purchase album" class="ui-li-link-alt ui-btn ui-btn-icon-notext ui-corner-tr ui-btn-up-c" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="false" data-iconpos="notext" data-theme="c"><span class="ui-btn-inner ui-corner-tr"><span class="ui-btn-text ui-corner-tr"></span><span data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="arrow-r" data-iconpos="notext" data-theme="b" title="" class="ui-btn ui-btn-up-b ui-shadow ui-btn-corner-all ui-btn-icon-notext"><span class="ui-btn-inner ui-btn-corner-all ui-corner-tr"><span class="ui-btn-text ui-corner-tr"></span><span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span></span></span></span></a>
</li>

<?


//include(INCLUDES_DIR."/views/view_listing.php");

?>
