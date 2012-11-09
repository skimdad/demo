<?
$eventObj = new Event();
$events  = $eventObj->getByAccount($listing->account_id);
//$events = $eventObj->getByAccount(0);
$langIndex = language_getIndex(EDIR_LANGUAGE);
?>
<div data-role="content" style="padding: 15px;">	
<? if(mysql_num_rows($events) > 0): ?>	
	<? while($row = mysql_fetch_array($events)): 
		#validate date
	    $end_date = $row['end_date'];
	 	if($row['has_start_time'] == 'y')
			$end_date = $end_date . $row['end_time'];
	 	if(time() <= strtotime($end_date)):
	 		
		#handleing Image
		$imageObj = new Image($row["thumb_id"]);
		$eventImage = '';
		if ($imageObj->imageExists()){
			$eventImage = $imageObj->getPath();
		}
		#short description:
		$short_description = "";
        $short_description = nl2br($row["description".$langIndex]);
	?>
		
	<ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
	<li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="false" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li ui-li-has-alt ui-li-has-thumb ui-corner-bottom ui-btn-up-c">
	    <p class="ui-li-aside ui-li-desc" style="width:100%; text-align:center; font-size:18px; color:#006">
				   
			From: <strong>
				<?= $row['start_date']; ?>&nbsp;
			</strong>
			<? if($row['has_start_time'] == 'y'): ?>
					
				<?= $row['start_time']; ?>
					
			<? endif; ?>
			<br />
			To: <strong>
				<?= $row['end_date']; ?>
			</strong>
			<? if($row['has_end_time'] == 'y'): ?>
					
				<?= $row['end_time']; ?>
					
			<? endif; ?>

</p>
<img src="<?= $eventImage;  ?>" alt="image" style="width: 100%; height: auto; margin-top:50px;">

<div class="ui-btn-inner ui-li ui-li-has-alt">
<div class="ui-btn-text">
<a href="<?= $mobile_base_url.'index.php/'.$listing->id.'/event_detail/'.$row['id']; ?>" data-transition="slideup" class="ui-link-inherit" style="padding:0px;padding-left:10px;">
<h3 class="ui-li-heading"><?= $row['title']; ?></h3>
<p class="ui-li-desc">
<?= $short_description; ?>
</p>
</a>
</div>
</div>
<a style="padding:0px" href="<?= $mobile_base_url.'index.php/'.$listing->id.'/event_detail/'.$row['id']; ?>" data-transition="slideup" title="Purchase album" class="ui-li-link-alt ui-btn ui-btn-up-c ui-btn-icon-notext ui-corner-br" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="false" data-iconpos="notext" data-theme="c">
<span class="ui-btn-inner">
<span class="ui-btn-text"></span>
<span data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="arrow-r" data-iconpos="notext" data-theme="b" title="" class="ui-btn ui-btn-up-b ui-shadow ui-btn-corner-all ui-btn-icon-notext">
<span class="ui-btn-inner ui-btn-corner-all">
<span class="ui-btn-text"></span>
<span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span>
</span>
</span>
</span>
</a>
</li>
</ul> 
		<? endif;endwhile; ?>
<? else: ?>
     
	 <div class="empty_message">There is no current Available</div>
 
<? endif; ?>
</div>
 
       