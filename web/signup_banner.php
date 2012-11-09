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
	# * FILE: /signup_banner.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on" || CUSTOM_BANNER_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    
    $contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Banner Advertisement";
	$content = $contentObj->retrieveContentByType($sitecontentSection);
	if ($content) {
		echo "<blockquote>";
			echo "<div class=\"content-custom\">".$content."</div>";
		echo "</blockquote>";
	}

    unset($levelObj);
    $levelObj = new BannerLevel(EDIR_LANGUAGE);
	$activeLevels = $levelObj->getLevelValues();
	$auxLang = str_replace("_", "", EDIR_LANGUAGE);
    
    $arrayLevelLinks = array();
    $countLevels = 0;
    foreach ($activeLevels as $levelValue) {
        $countLevels++;
        $arrayLevelLinks[] = "<li id=\"tabBannerLevel_".$levelValue."\" ".($countLevels == 1 ? "class=\"active\"" : "")." onclick=\"showTabLevels('Banner', ".$levelValue.");\"><h2 class=\"level-name\">".$levelObj->getName($levelValue)."</h2></li>";
        $arrayLevelLinks[] = "<li> | </li>";
    }
    array_pop($arrayLevelLinks);
    
?>
    <ul class="tabsLevels tabsLevelsBanner"><?=implode("", $arrayLevelLinks);?></ul>
<?
    
	$countLevels = 0;
	foreach ($activeLevels as $levelValue) {
        $countLevels++;
		$auxName = string_strtolower($levelObj->getName($levelValue, true));
		$auxName = str_replace(" ", "", $auxName);
        
        if (file_exists(EDIRECTORY_ROOT."/images/content/img_ad_banner_".$auxName."_".EDIR_THEME.".gif")){
            $bannerImgScr = DEFAULT_URL."/images/content/img_ad_banner_".$auxName."_".EDIR_THEME.".gif";
        } else {
            $bannerImgScr = DEFAULT_URL."/images/content/img_ad_banner_".$auxName.".gif";
        }
		
		if ($levelObj->getPrice($levelValue) > 0) $price = CURRENCY_SYMBOL.$levelObj->getPrice($levelValue);
		else $price = CURRENCY_SYMBOL.system_showText(LANG_FREE);
		$price .= " ".system_showText(LANG_PER)." ";
		if (payment_getRenewalCycle("banner") > 1) {
			$price .= payment_getRenewalCycle("banner")." ";
			$price .= payment_getRenewalUnitNamePlural("banner");
		}else {
			$price .= payment_getRenewalUnitName("banner");
		}

		if ($levelObj->getPrice($levelValue) > 0) {
			if ($payment_tax_status == "on") {
				$price .= "<br />+".$payment_tax_value."% ".$payment_tax_label;
				$price .= " (".CURRENCY_SYMBOL.payment_calculateTax($levelObj->getPrice($levelValue), $payment_tax_value).")";
			}
		}

		$price .= "<br />".system_showText(LANG_OR)."<br />";
		if ($levelObj->getImpressionPrice($levelValue) > 0) $price .= CURRENCY_SYMBOL.$levelObj->getImpressionPrice($levelValue);
		else $price .= CURRENCY_SYMBOL.system_showText(LANG_FREE);
		$price .= " ".system_showText(LANG_PER)." ".$levelObj->getImpressionBlock($levelValue)." ".system_showText(LANG_IMPRESSIONS);

		if ($levelObj->getImpressionPrice($levelValue) > 0) {
			if ($payment_tax_status == "on") {
				$price .= "<br />+".$payment_tax_value."% ".$payment_tax_label;
				$price .= " (".CURRENCY_SYMBOL.payment_calculateTax($levelObj->getImpressionPrice($levelValue), $payment_tax_value).")";
			}
		}
		
		?>
		<div class="level levelBanner" id="contentBannerLevel_<?=$levelValue?>" <?=$countLevels == 1 ? "style=\"\"": "style=\"display: none;\"";?>>
			
			<div class="level-info">
				
				<p><?=nl2br(strip_tags($levelObj->getContent($levelValue)));?></p>
				
				<p class="price"><?=$price;?></p>
				
				<div class="button button-profile">
					<h2><a href="<?=DEFAULT_URL?>/order_banner.php?type=<?=$levelValue?>"><?=system_showText(LANG_BUTTON_SIGNUP);?></a></h2>			
				</div>
				
			</div>
			
			<div class="level-summary">	
                <p class="preview-desc"><?="* ".system_showText(LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE);?></p>
				<img class="banner-image" src="<?=$bannerImgScr?>" alt="<?=$levelObj->getName($levelValue);?>" title="<?=$levelObj->getName($levelValue);?>" />
			</div>
			
		</div>
	<? }
?>