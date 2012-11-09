    <?
		$listing_description = "";
    	
        $listing_description = nl2br($listing->getStringLang(EDIR_LANGUAGE, "description", true));
		
	$listing_long_description = "";
    	
        $listing_long_description = nl2br($listing->getStringLang(EDIR_LANGUAGE, "long_description", true));
    
	?>
	<div data-role="content" style="padding: 15px;">
            <div class="txt_block">
	   <? if(!empty($listing_description)): ?>
	       <h3 class="ui-li-heading">Summary</h3>
		   <?= $listing_description; ?>
	   <? endif; ?>
            </div>
	  <div class="txt_block">
	  <? if(!empty($listing_long_description)): ?>
	       <h3 class="ui-li-heading">Description</h3>
		   <?= $listing_long_description; ?>
	   <? endif; ?>
            </div>
	</div>