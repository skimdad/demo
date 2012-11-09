<div data-role="content" style="padding: 15px;">
<?
   if(!empty($mobileAppObj->special_announ_content)){
   	
    	echo $mobileAppObj->special_announ_content;
	
	
   }else{
   	    echo '<div class="empty_message">no current special announcment</div>';
   }
?>
</div>