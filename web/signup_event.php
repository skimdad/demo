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
	# * FILE: /signup_event.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    
    $contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Event Advertisement";
	$content = $contentObj->retrieveContentByType($sitecontentSection);
	if ($content) {
		echo "<blockquote>";
			echo "<div class=\"content-custom\">".$content."</div>";
		echo "</blockquote>";
	}

    $event = new Event();
    unset($levelObj);
	$levelObj = new EventLevel(EDIR_LANGUAGE);
	$level = $levelObj;
	$activeLevels = $levelObj->getLevelValues();
    
    $arrayLevelLinks = array();
    $countLevels = 0;
    foreach ($activeLevels as $levelValue) {
        $countLevels++;
        $arrayLevelLinks[] = "<li id=\"tabEventLevel_".$levelValue."\" ".($countLevels == 1 ? "class=\"active\"" : "")." onclick=\"showTabLevels('Event', ".$levelValue.");\"><h2 class=\"level-name\">".$level->getName($levelValue)."</h2></li>";
        $arrayLevelLinks[] = "<li> | </li>";
    }
    array_pop($arrayLevelLinks);
    
?>
    <ul class="tabsLevels tabsLevelsEvent"><?=implode("", $arrayLevelLinks);?></ul>
<?
	
	$tPreview = "preview";

	$arrEventAux["title"] = system_showText(LANG_LABEL_ADVERTISE_EVENT_TITLE);
    $arrEventAux["email"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_EMAIL);
    $arrEventAux["url"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_SITE);
	$arrEventAux["contact_name"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_CONTACT);
    $arrEventAux["address"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_ADDRESS);
    $arrEventAux["zip_code"] = ucwords(system_showText(LANG_LABEL_ADVERTISE_ITEM_ZIPCODE));
	$arrEventAux["start_date"] = date("Y-m-d");
	$arrEventAux["has_start_time"] = "y";
	$arrEventAux["start_time"] = "08:00:00";
    $arrEventAux["end_date"] = date("Y-m-d", time() + (30 * 24 * 60 * 60));
    $arrEventAux["has_end_time"] = "y";
    $arrEventAux["end_time"] = "12:00:00";
    $arrEventAux["phone"] = '000.000.0000';
    $arrEventAux["description1"] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrEventAux["description2"] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrEventAux["description3"] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrEventAux["description4"] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrEventAux["description5"] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrEventAux["description6"] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrEventAux["description7"] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrEventAux["long_description1"] ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
    $arrEventAux["long_description2"] ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
    $arrEventAux["long_description3"] ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
    $arrEventAux["long_description4"] ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
    $arrEventAux["long_description5"] ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
    $arrEventAux["long_description6"] ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
    $arrEventAux["long_description7"] ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
	    
    $countLevels = 0;
	foreach ($activeLevels as $levelValue) {
        $countLevels++;
		$arrEventAux['level'] = $levelValue;
		$event->makeFromRow($arrEventAux);
		$eventObj = $event;
		
		if ($level->getPrice($levelValue) > 0) {
			$price = CURRENCY_SYMBOL.$level->getPrice($levelValue)." ".system_showText(LANG_PER)." ";
			if (payment_getRenewalCycle("event") > 1) {
				$price .= payment_getRenewalCycle("event")." ";
				$price .= payment_getRenewalUnitNamePlural("event");
			}else {
				$price .= payment_getRenewalUnitName("event");
			}
			if ($payment_tax_status == "on") {
				$price .= "<br />+".$payment_tax_value."% ".$payment_tax_label;
				$price .= " (".CURRENCY_SYMBOL.payment_calculateTax($level->getPrice($levelValue), $payment_tax_value).")";
			}
		} else {
			$price = CURRENCY_SYMBOL.system_showText(LANG_FREE);
		}

		?>
		
		<div class="level levelEvent" id="contentEventLevel_<?=$levelValue?>" <?=$countLevels == 1 ? "style=\"\"": "style=\"display: none;\"";?>>
				
			<div class="level-info">
				
				<p><?=nl2br(strip_tags($level->getContent($levelValue)));?></p>
				<p class="price"><?=$price;?></p>
				<div class="button button-profile">
					<h2><a href="<?=DEFAULT_URL?>/order_event.php?level=<?=$levelValue?>"><?=system_showText(LANG_BUTTON_SIGNUP);?></a></h2>			
				</div>
			</div>
			
			<div class="level-summary">				
			
				<p class="preview-desc"><?=system_showText(LANG_LABEL_ADVERTISE_SUMMARYVIEW);?><span><?="* ".system_showText(LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE);?></span></p>
				
				<? include(INCLUDES_DIR."/views/view_event_summary.php"); ?>
				
			</div>
			
			<?
			$event = $eventObj;
			if ($levelObj->getDetail($event->getNumber("level")) == "y") {
				
				$typePreview = "detail"; ?>
			
				<div class="level-detail">

					<p class="preview-desc"><?=system_showText(LANG_LABEL_ADVERTISE_DETAILVIEW);?><span><?="* ".system_showText(LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE);?></span></p>

					<div class="content">
						<? include(INCLUDES_DIR."/views/view_event_detail.php"); ?>
					</div>

					<div class="sidebar">
                        <? include(EVENT_EDIRECTORY_ROOT."/detail_info.php"); ?>
						<? include(EVENT_EDIRECTORY_ROOT."/detail_maps.php"); ?>
					</div>

				</div>
			
			<? 
			 unset($typePreview);
			} 
			?>
		
		</div>
		
		<?
	}
?>