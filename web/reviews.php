<?

    $reviews = new Review();
	$reviewsObj = $reviews->getReviewsByItem('listing',$listing->id);
?>

<? 
     if(mysql_num_rows($reviewsObj) > 0): 
	 while($row = mysql_fetch_array($reviewsObj)): 

   
     $member =  new AccountProfileContact(SELECTED_DOMAIN_ID,$row['member_id']);
	 $image_url = '';
	 
	 if(!empty($member->facebook_image))
	     $image_url = $member->facebook_image;
     else
	 {
	 	 
		   $image_url = $member->image_id;
		}  
		
		 $imgTag = socialnetwork_writeLink($row["member_id"], "profile", "general_see_profile", $image_url, false, false);

	 $rating = $row['rating'];
	
	if ($rating) {
			unset($rate_stars);
			for ($x=0 ; $x < 5 ;$x++) {
				if ($rating > $x) $rate_stars .= "<img src=\"".DEFAULT_URL."/images/img_rateMiniStarOn.png\" alt=\"Star On\" align=\"bottom\" />";
				else $rate_stars .= "<img src=\"".DEFAULT_URL."/images/img_rateMiniStarOff.png\" alt=\"Star Off\" align=\"bottom\" />";
			}
		}	 
	 
?>

	
	<div data-role="content" style="padding: 15px;">
                  
		<div data-role="content" style="padding: 0px;">
		<div  style="float: left">
		<?= $imgTag ?>
		</div>
		<h3 class="ui-li-heading" style="color:#f2f2f2; text-shadow:none; float:left; width:80%; margin:0px; padding-left:1.5%"><?= $row['review_title']; ?></h3>
<div style="float:left; width:80%; margin:0px; padding-left:1.5%"><?= $rate_stars  ?></div>
		<p style=" white-space:normal;color:#f2f2f2; margin-top:2px;;text-shadow:none;width:85%; float:left;padding-left:1.5%" class="ui-li-desc">
		<em><?= $row['added']; ?> </em><br/>
		<strong><?= $row['reviewer_name']; ?></strong><br />
		<strong><?= $row['reviewer_location']; ?></strong>
		</p>
		</div>
		
		<p class="ui-li-desc review" style="width: 100%">
		<?= $row['review'] ?>
		</p><br/>
		
		</div>
				
<? endwhile; ?>

<? else: ?>
<div data-role="content" style="padding: 15px;">
     <?= showErrorMsg('There is no Current Reviews are  Available'); ?> 
</div>
<? endif; ?> 

     
			