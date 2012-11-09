<div data-role="content" class="txt_block with_margin" style="padding: 15px;">
<?
   if(!empty($mobileAppObj->special_announ_content)){
   	
    	echo $mobileAppObj->special_announ_content;
	
	
   }else{
	showErrorMsg($mobileAppObj->special_announ_no_data); 
   	   
   }
?>
</div>