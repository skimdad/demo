    <?
		$promotionObj= new Promotion();
		$promotions = $promotionObj->getPromotionByListing($listing->id);
		
		if(mysql_num_rows($promotions) > 0):
		
	?>
	
	<div data-role="content" style="padding: 15px;">
        <ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
	<?
		
		
		while ($row = mysql_fetch_array($promotions)) { 
		#deals valuse prep
		$price = string_substr($row['dealvalue'],0,(string_strpos($row['dealvalue'],".")));
		$cents = string_substr($row['dealvalue'],(string_strpos($row['dealvalue'],".")),3);
		if ($cents == ".00") $cents = "";
		if ($row['realvalue']>0 && $row['dealvalue']>0){
			$offer = round(100-(($row['dealvalue']*100)/$row['realvalue'])).'% '.system_showText(LANG_DEAL_OFF)."! ".CURRENCY_SYMBOL.format_money($row['dealvalue'],2);
			$summary_offer = round(100-(($row['dealvalue']*100)/$row['realvalue'])).'% '.system_showText(LANG_DEAL_OFF);
		}else{
			$offer = system_showText(LANG_NA);
		}
		
		#####################################
		
		
		?>
             <li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="false" data-iconpos="right" data-theme="c"
			 class="ui-btn ui-btn-icon-right ui-li ui-li-has-alt ui-li-has-thumb ui-corner-top ui-btn-up-c">
			 <div class="ui-btn-inner ui-li ui-li-has-alt ui-corner-top">
			 <div class="ui-btn-text">
			 <a href="<?= $mobile_base_url.'index.php/'.$listing->id.'/promotion_detail/'.$row['id']; ?>" class="ui-link-inherit" data-transition="slideup" style="padding:0px; padding-left:10px;">
				<div style="width:100%; float:left">
                		<div class="price"><?=CURRENCY_SYMBOL.$price.($cents ? "<span class=\"cents\">".$cents."</span>" : "")?></div>
					    <span style="float:left; margin-top:13px; margin-left:10px; color:#C03"><?=$summary_offer;?></span>
                </div>
				<h3 class="ui-li-heading" style="width:90%; float:left; margin-left:9px"><?= $row['name'] ?></h3>
				<p class="ui-li-desc" style="width:90%; float:left; white-space:normal; margin-left:9px;">
					<?= $row['description1'] ?>
				</p>
                
                
				</a></div></div><a style="padding:0px;" href="<?= $mobile_base_url.'index.php/'.$listing->id.'/promotion_detail/'.$row['id']; ?>" data-transition="slideup" title="Purchase album
			" class="ui-li-link-alt ui-btn ui-btn-icon-notext ui-corner-tr ui-btn-up-c" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="false" data-iconpos="notext" data-theme="c"><span class="ui-btn-inner ui-corner-tr"><span class="ui-btn-text ui-corner-tr"></span><span data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="arrow-r" data-iconpos="notext" data-theme="b" title="" class="ui-btn ui-btn-up-b ui-shadow ui-btn-corner-all ui-btn-icon-notext"><span class="ui-btn-inner ui-btn-corner-all ui-corner-tr"><span class="ui-btn-text ui-corner-tr"></span><span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span></span></span></span></a></li>
	    <?}

	?>
	    </ul>
    </div>		

   
    <? else: ?>
		<div data-role="content" style="padding: 15px;">
		      <?= showErrorMsg("There is no Current Deals are  Available"); ?>
			 
		</div>
	<? endif; ?>
	
				