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
	# * FILE: /signup_article.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------

	if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	
	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Article Advertisement";
	$content = $contentObj->retrieveContentByType($sitecontentSection);
	if ($content) {
		echo "<blockquote>";
			echo "<div class=\"content-custom\">".$content."</div>";
		echo "</blockquote>";
	}
	
	$article = new Article();

	$levelObj = new ArticleLevel(EDIR_LANGUAGE);
	$level = $levelObj;

	$activeLevels = $levelObj->getLevelValues();
	
	$tPreview = "preview";
	
    
    $arrArticleAux["title"] = system_showText(LANG_LABEL_ADVERTISE_ARTICLE_TITLE); 
    $arrArticleAux["author"] = system_showText(LANG_LABEL_ADVERTISE_ARTICLE_AUTHOR);
    $arrArticleAux["author_url"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_SITE);
    $arrArticleAux["publication_date"] = date("Y-m-d");
	$arrArticleAux["abstract1"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas."; 
    $arrArticleAux["abstract2"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas."; 
    $arrArticleAux["abstract3"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas."; 
    $arrArticleAux["abstract4"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas."; 
    $arrArticleAux["abstract5"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas."; 
    $arrArticleAux["abstract6"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas."; 
    $arrArticleAux["abstract7"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.";     
    $arrArticleAux["content1"] = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.</p>"; 
    $arrArticleAux["content2"] = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.</p>"; 
    $arrArticleAux["content3"] = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.</p>"; 
    $arrArticleAux["content4"] = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.</p>"; 
    $arrArticleAux["content5"] = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.</p>"; 
    $arrArticleAux["content6"] = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.</p>"; 
    $arrArticleAux["content7"] = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.</p>"; 

	foreach ($activeLevels as $levelValue) {
		$arrArticleAux['level'] = $levelValue;
		$article->makeFromRow($arrArticleAux);
		$articleObj = $article;
		
		if ($level->getPrice($levelValue) > 0) {
			$price = CURRENCY_SYMBOL.$level->getPrice($levelValue)." ".system_showText(LANG_PER)." ";
			if (payment_getRenewalCycle("article") > 1) {
				$price .= payment_getRenewalCycle("article")." ";
				$price .= payment_getRenewalUnitNamePlural("article");
			}else {
				$price .= payment_getRenewalUnitName("article");
			}
			if ($payment_tax_status == "on") {
				$price .= "<br />+".$payment_tax_value."% ".$payment_tax_label;
				$price .= " (".CURRENCY_SYMBOL.payment_calculateTax($level->getPrice($levelValue), $payment_tax_value).")";
			}
		} else {
			$price = CURRENCY_SYMBOL.system_showText(LANG_FREE);
		}

		?>
		
		<div class="level">
		
			<h2 class="level-name"><?=$level->getName($levelValue);?></h2>
			
			<div class="level-info">
				
				<p><?=nl2br(strip_tags($level->getContent($levelValue)));?></p>
				<p class="price"><?=$price;?></p>
				<div class="button button-profile">
					<h2><a href="<?=DEFAULT_URL?>/order_article.php?level=<?=$levelValue?>"><?=system_showText(LANG_BUTTON_SIGNUP);?></a></h2>			
				</div>
			</div>
			
			<div class="level-summary">				
			
				<p class="preview-desc"><?=system_showText(LANG_LABEL_ADVERTISE_SUMMARYVIEW);?><span><?="* ".system_showText(LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE);?></span></p>
				
				<? include(INCLUDES_DIR."/views/view_article_summary.php"); ?>
				
			</div>
			
			<?
			$article = $articleObj;
			if ($levelObj->getDetail($article->getNumber("level")) == "y") {
				$typePreview = "detail"; ?>
			
				<div class="level-detail">

					<p class="preview-desc"><?=system_showText(LANG_LABEL_ADVERTISE_DETAILVIEW);?><span><?="* ".system_showText(LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE);?></span></p>

					<div class="content">
						<? include(INCLUDES_DIR."/views/view_article_detail.php"); ?>
					</div>

					<div class="sidebar">
                        <? include(ARTICLE_EDIRECTORY_ROOT."/detail_info.php"); ?>
						<? include(ARTICLE_EDIRECTORY_ROOT."/detail_reviews.php"); ?>
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