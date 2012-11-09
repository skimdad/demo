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
	# * FILE: /signup_classified.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    
    $contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Classified Advertisement";
	$content = $contentObj->retrieveContentByType($sitecontentSection);
	if ($content) {
		echo "<blockquote>";
			echo "<div class=\"content-custom\">".$content."</div>";
		echo "</blockquote>";
	}
	
    $classified = new Classified();
    unset($levelObj);
	$levelObj = new ClassifiedLevel(EDIR_LANGUAGE);
	$level = $levelObj;
    $activeLevels = $levelObj->getLevelValues();
    
    $arrayLevelLinks = array();
    $countLevels = 0;
    foreach ($activeLevels as $levelValue) {
        $countLevels++;
        $arrayLevelLinks[] = "<li id=\"tabClassifiedLevel_".$levelValue."\" ".($countLevels == 1 ? "class=\"active\"" : "")." onclick=\"showTabLevels('Classified', ".$levelValue.");\"><h2 class=\"level-name\">".$level->getName($levelValue)."</h2></li>";
        $arrayLevelLinks[] = "<li> | </li>";
    }
    array_pop($arrayLevelLinks);
 
?>
    <ul class="tabsLevels tabsLevelsClassified"><?=implode("", $arrayLevelLinks);?></ul>
<?
	
	$tPreview = "preview";

    $arrClassifiedAux["title"] = system_showText(LANG_LABEL_ADVERTISE_CLASSIFIED_TITLE);
	$arrClassifiedAux["email"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_EMAIL);
    $arrClassifiedAux["url"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_SITE);
    $arrClassifiedAux["contactname"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_CONTACT);
    $arrClassifiedAux["address"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_ADDRESS);
	$arrClassifiedAux["zip_code"] = ucwords(system_showText(LANG_LABEL_ADVERTISE_ITEM_ZIPCODE));
	$arrClassifiedAux["classified_price"] = "100.00";
    $arrClassifiedAux["phone"] = '000.000.0000';
    $arrClassifiedAux["fax"] = '000.000.0000';
    $arrClassifiedAux["summarydesc1"] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrClassifiedAux["summarydesc2"] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrClassifiedAux["summarydesc3"] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrClassifiedAux["summarydesc4"] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrClassifiedAux["summarydesc5"] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrClassifiedAux["summarydesc6"] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
    $arrClassifiedAux["summarydesc7"] = 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.';
	$arrClassifiedAux["detaildesc1"] ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
	$arrClassifiedAux["detaildesc2"] ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
	$arrClassifiedAux["detaildesc3"] ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
	$arrClassifiedAux["detaildesc4"] ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
	$arrClassifiedAux["detaildesc5"] ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
	$arrClassifiedAux["detaildesc6"] ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
	$arrClassifiedAux["detaildesc7"] ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.';
    
    $countLevels = 0;
	foreach ($activeLevels as $levelValue) {
        $countLevels++;
		$arrClassifiedAux['level'] = $levelValue;
		$classified->makeFromRow($arrClassifiedAux);
		$classifiedObj = $classified;
		
		if ($level->getPrice($levelValue) > 0) {
			$price = CURRENCY_SYMBOL.$level->getPrice($levelValue)." ".system_showText(LANG_PER)." ";
			if (payment_getRenewalCycle("classified") > 1) {
				$price .= payment_getRenewalCycle("classified")." ";
				$price .= payment_getRenewalUnitNamePlural("classified");
			}else {
				$price .= payment_getRenewalUnitName("classified");
			}
			if ($payment_tax_status == "on") {
				$price .= "<br />+".$payment_tax_value."% ".$payment_tax_label;
				$price .= " (".CURRENCY_SYMBOL.payment_calculateTax($level->getPrice($levelValue), $payment_tax_value).")";
			}
		} else {
			$price = CURRENCY_SYMBOL.system_showText(LANG_FREE);
		}

		?>
		
		<div class="level levelClassified" id="contentClassifiedLevel_<?=$levelValue?>" <?=$countLevels == 1 ? "style=\"\"": "style=\"display: none;\"";?>>
		
			<div class="level-info">
				
				<p><?=nl2br(strip_tags($level->getContent($levelValue)));?></p>
				<p class="price"><?=$price;?></p>
				<div class="button button-profile">
					<h2><a href="<?=DEFAULT_URL?>/order_classified.php?level=<?=$levelValue?>"><?=system_showText(LANG_BUTTON_SIGNUP);?></a></h2>			
				</div>
			</div>
			
			<div class="level-summary">				
			
				<p class="preview-desc"><?=system_showText(LANG_LABEL_ADVERTISE_SUMMARYVIEW);?><span><?="* ".system_showText(LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE);?></span></p>
				
				<? include(INCLUDES_DIR."/views/view_classified_summary.php"); ?>
				
			</div>
			
			<?
			$classified = $classifiedObj;
			if ($levelObj->getDetail($classified->getNumber("level")) == "y") {
				$typePreview = "detail"; ?>
			
				<div class="level-detail">

					<p class="preview-desc"><?=system_showText(LANG_LABEL_ADVERTISE_DETAILVIEW);?><span><?="* ".system_showText(LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE);?></span></p>

					<div class="content">
						<? include(INCLUDES_DIR."/views/view_classified_detail.php"); ?>
					</div>

					<div class="sidebar">
                        <? include(CLASSIFIED_EDIRECTORY_ROOT."/detail_info.php"); ?>
						<? include(CLASSIFIED_EDIRECTORY_ROOT."/detail_maps.php"); ?>
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
