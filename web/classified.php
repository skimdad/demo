<?
    $classifiedObj = new Classified();
	$classifieds = $classifiedObj->getByAccount($listing->account_id);
	//$classifieds = $classifiedObj->getByAccount(2);
	
	$langIndex = language_getIndex(EDIR_LANGUAGE);
?>
<div data-role="content" style="padding: 15px;">

<? if($classifieds): ?>
      <? while($row = mysql_fetch_array($classifieds)):
	 	   $imageObj = new Image($row["thumb_id"]);
		   $classifedImage = '';
		   if ($imageObj->imageExists()){
			   $classifedImage = $imageObj->getPath();
		   } 
		   
		   $category  = new ClassifiedCategory($row['cat_'.$langIndex.'_id']);
		   $parent_cat =  new ClassifiedCategory($category->category_id);
		  
		   $cat_name = $parent_cat->{'title'.$langIndex};
		   
		   $accountProfile = new AccountProfileContact(SELECTED_DOMAIN_ID,$row['account_id']);
		   
		   $owner_name = $accountProfile->nickname;
		  
		   
	  
	  ?>
	   
	      <ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
			<li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="false" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li ui-li-has-alt ui-li-has-thumb ui-corner-bottom ui-btn-up-c">
            <p class="ui-li-aside ui-li-desc" style="width:100%; text-align:center; font-size:16px; color:#006">
				<strong></strong>
			</p>
            <img src="<?= $classifedImage ?>" alt="image" style="width: 100%; height: auto; margin-top:25px;">
            
            <div class="ui-btn-inner ui-li ui-li-has-alt"><div class="ui-btn-text">
				<a href="<?= $mobile_base_url.'index.php/'.$listing->id.'/classified_detail/'.$row['id']; ?>" class="ui-link-inherit" data-transition="slideup" style="padding:0px;padding-left:10px;">
            	<h3 class="ui-li-heading"><?= $row['title']; ?></h3>
				<p class="ui-li-desc">in <strong><?= $cat_name ?></strong><br/> By <strong><?= $owner_name ?></strong></p>
				</a></div></div><a style="padding:0px" href="<?= $mobile_base_url.'index.php/'.$listing->id.'/classified_detail/'.$row['id']; ?>" data-transition="slideup" title="Purchase album
			" class="ui-li-link-alt ui-btn ui-btn-up-c ui-btn-icon-notext ui-corner-br" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="false" data-iconpos="notext" data-theme="c"><span class="ui-btn-inner"><span class="ui-btn-text"></span><span data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="arrow-r" data-iconpos="notext" data-theme="b" title="" class="ui-btn ui-btn-up-b ui-shadow ui-btn-corner-all ui-btn-icon-notext"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text"></span><span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span></span></span></span></a></li>
			</ul> 
	  
	  <? endwhile; ?>

<? else: ?>
    <div class="empty_message">There is no current Classifieds</div>

<? endif; ?>
</div>