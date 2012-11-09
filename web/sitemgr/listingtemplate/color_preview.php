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
    # * FILE: /sitemgr/listingtemplate/color_preview.php
    # ----------------------------------------------------------------------------------------------------
    
    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (LISTINGTEMPLATE_FEATURE != "on" || USING_THEME_TEMPLATE) { exit; }
    
    header("Expires: Sat, 01 Jan 1970 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0");
    header("Pragma: no-cache");
    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
    
    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSMSession();
    permission_hasSMPerm();

    $url_redirect = "".DEFAULT_URL."/sitemgr/".LISTING_FEATURE_FOLDER;
    $url_base = "".DEFAULT_URL."/sitemgr";
    $sitemgr = 1;

    # ----------------------------------------------------------------------------------------------------
    # AUX
    # ----------------------------------------------------------------------------------------------------
    extract($_POST);
    extract($_GET);

    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    $error = false;
	
	setting_get('commenting_edir', $commenting_edir);
	setting_get("review_listing_enabled", $review_enabled);

	$levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
	
	$locationsToShow = explode (",", EDIR_LOCATIONS);
	$locationsToShow = array_reverse ($locationsToShow);
	foreach ($locationsToShow as $locationToShow) {
		$reviewer_location .= system_showText(constant("LANG_LABEL_".constant("LOCATION".$locationToShow."_SYSTEM"))).", ";
	}
	$reviewer_location = string_substr("$reviewer_location", 0, -2);
	unset($locationsToShow);
	
	$arrReviewAux["review_title"] = system_showText(LANG_LABEL_ADVERTISE_REVIEW_TITLE);
	$arrReviewAux["reviewer_name"] = system_showText(LANG_LABEL_ADVERTISE_VISITOR);
    $arrReviewAux["reviewer_location"] = $reviewer_location;
    $arrReviewAux["added"] = date("Y-m-d")." ".date("H:m:s");
    $arrReviewAux["approved"] = "1";
	$arrReviewAux["review"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica formas.";
	
    $arrReviewAux["rating"] = "1";
    $arrReviewAux["response"] = "Lorem ipsum dolor sit amet, consectetur. Pellentesque luctus enim ac diam tortor.";
    $arrReviewAux["responseapproved"] = "1";
	$reviewsArr[] = new Review($arrReviewAux);
	
	$arrReviewAux["rating"] = "3";
    $arrReviewAux["response"] = "";
    $arrReviewAux["responseapproved"] = "0";
	$reviewsArr[] = new Review($arrReviewAux);
	
	$arrReviewAux["rating"] = "5";
	$reviewsArr[] = new Review($arrReviewAux);
	unset($arrReviewAux);
    
	$listing = new Listing();

	$levelObj = new ListingLevel(EDIR_LANGUAGE);
	$level = $levelObj;

	$activeLevels = $levelObj->getLevelValues();
	
	$tPreview = "preview";
	
	$arrListingAux['level'] = 10;
	$arrListingAux['title'] = system_showText(LANG_LABEL_ADVERTISE_LISTING_TITLE);
	$arrListingAux['email'] = system_showText(LANG_LABEL_ADVERTISE_ITEM_EMAIL);
    $arrListingAux['url'] = system_showText(LANG_LABEL_ADVERTISE_ITEM_SITE);
    $arrListingAux['address'] = system_showText(LANG_LABEL_ADVERTISE_ITEM_ADDRESS);
    $arrListingAux['zip_code'] = ucwords(system_showText(LANG_LABEL_ADVERTISE_ITEM_ZIPCODE));
	$arrListingAux['video_snippet'] = "<img src=\"".DEFAULT_URL."/images/content/img-video-sample.jpg\" alt=\"\" title=\"\"/>";
    $arrListingAux['phone'] = '000.000.0000';
    $arrListingAux['fax'] = '000.000.0000';
    $arrListingAux['description1'] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrListingAux['description2'] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrListingAux['description3'] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrListingAux['description4'] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrListingAux['description5'] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrListingAux['description6'] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrListingAux['description7'] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrListingAux['long_description1'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
    $arrListingAux['long_description2'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
    $arrListingAux['long_description3'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
    $arrListingAux['long_description4'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
    $arrListingAux['long_description5'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
    $arrListingAux['long_description6'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
    $arrListingAux['long_description7'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
    $arrListingAux['clicktocall_number'] = '000';
	if ($id) {
		$arrListingAux['listingtemplate_id'] = $id;
	}
    
    /**
     * This variable is used on view_listing_summary.php
     */
    if (TWILIO_APP_ENABLED == "on"){
        if (TWILIO_APP_ENABLED_SMS == "on"){
            $levelsWithSendPhone = system_retrieveLevelsWithInfoEnabled("has_sms");
        }else{
            $levelsWithSendPhone = false;
        }
        if (TWILIO_APP_ENABLED_CALL == "on"){
            $levelsWithClicktoCall = system_retrieveLevelsWithInfoEnabled("has_call");
        }else{
            $levelsWithClicktoCall = false;
        }
    }else{
        $levelsWithSendPhone = false;
        $levelsWithClicktoCall = false;
    }
	
	$arrCheckinAux["checkin_name"] = system_showText(LANG_LABEL_ADVERTISE_VISITOR);
	$arrCheckinAux["added"] = date("Y-m-d")." ".date("H:m:s");
	$arrCheckinAux["quick_tip"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica formas.";
	$checkinsArr[] = new CheckIn($arrCheckinAux);
	$checkinsArr[] = new CheckIn($arrCheckinAux);
	$checkinsArr[] = new CheckIn($arrCheckinAux);
	unset($arrCheckinAux);
	
	$listing->makeFromRow($arrListingAux);
	$listingObj = $listing;
	?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
        <title><?=system_showText(LANG_SITEMGR_LISTING_SING)?> <?=string_ucwords(system_showText(LANG_SITEMGR_PREVIEW))?></title>

        <link href="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME;?>/structure.css" rel="stylesheet" type="text/css" />
        <link href="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME;?>/results.css" rel="stylesheet" type="text/css" />
        <link href="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME;?>/detail.css" rel="stylesheet" type="text/css" />
        <link href="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME;?>/advertise.css" rel="stylesheet" type="text/css" />
           
        <?=system_getNoImageStyle($cssfile = true);?>
        
    </head>
    <body class="import-body">
		<div class="level level-preview">
			<div class="level-summary">				

				<p class="preview-desc"><?=system_showText(LANG_LABEL_ADVERTISE_SUMMARYVIEW);?></p>

				<? include(INCLUDES_DIR."/views/view_listing_summary.php"); ?>

			</div>

			<?
			$listing = $listingObj;
			if ($levelObj->getDetail($listing->getNumber("level")) == "y") {
				?>

			<div class="level-detail">

				<p class="preview-desc"><?=system_showText(LANG_LABEL_ADVERTISE_DETAILVIEW);?></p>

				<div class="content">
					<? include(INCLUDES_DIR."/views/view_listing_detail.php"); ?>
				</div>

				<div class="sidebar">
					<? include(LISTING_EDIRECTORY_ROOT."/detail_maps.php"); ?>
					<? include(LISTING_EDIRECTORY_ROOT."/detail_deals.php"); ?>
					<? include(LISTING_EDIRECTORY_ROOT."/detail_reviews.php"); ?>
					<? include(LISTING_EDIRECTORY_ROOT."/detail_checkin.php"); ?>
				</div>

			</div>

				<?
			} ?>

		</div>
    </body>
</html>