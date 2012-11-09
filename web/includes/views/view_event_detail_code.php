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
	# * FILE: /includes/views/view_event_detail_code.php
	# ----------------------------------------------------------------------------------------------------
	
?>
<?/*?>
	<div class="share">
		<?=$event_icon_navbar?>
	</div>
<?*/?>

	<div class="detail">
		
		<h1><?=$event_title;?></h1>
		
		<div class="columns">
			
			<div class="left">
				
				<? if ($event_category_tree) { ?>
					<?=$event_category_tree?>
				<? } ?>

				<div class="content-box pd-0">
					<?=$event_facebook_buttons;?>
					<?=$event_googleplus_button;?>
				</div>
					
				<h2><?=system_showText(LANG_LABEL_OVERVIEW);?></h2>	
				
				<p><strong><?=system_showText(LANG_EVENT_WHEN);?>:</strong> <?=($event->getString("recurring") != "Y" ? $str_date : $str_recurring);?></p>

				<? if ($str_time) { ?>
                    <p><strong><?=system_showText(LANG_EVENT_TIME)?>:</strong> <?=$str_time?></p>
				<? } ?>

				<? if ($event_location) { ?>
                    <p><strong><?=system_showText(LANG_SEARCH_LABELLOCATION)?>:</strong> <?=nl2br($event_location)?></p>
				<? } ?>
					
				<? if ($location_map) { ?>
					<? if ($user) { ?>
						<p><a href="<?=$map_link?>" target="_blank"><?=system_showText(LANG_EVENT_DRIVINGDIRECTIONS)?> &raquo;</a></p>
					<? } else { ?>
						<p><a href="javascript:void(0);" style="cursor:default"><?=system_showText(LANG_EVENT_DRIVINGDIRECTIONS)?> &raquo;</a></p>
					<? } ?>
				<? } ?>
						
				<? if (($event_contactName) || ($event_phone) || ($event_fax) || ($event_email) || ($event_url)) { ?>
                    <h2><?=ucfirst(system_showText(LANG_CONTACTINFO))?></h2>
				<? } ?>
				
				<? if (($location) || ($event_address) || ($event_address2)) echo "<address>\n";  ?>

				<? if($event_address) { ?>
					<span><?=nl2br($event_address)?></span>
				<? } ?>

				<? if($event_address2) { ?>
					<span><?=nl2br($event_address2)?></span>
				<? } ?>

				<? if($location) { ?>
					<span><?=$location?></span>
				<? } ?>

				<? if (($location) || ($event_address) || ($event_address2)) echo "</address>\n";  ?>

				<? if($event_url) { ?>
					<p><strong><?=system_showText(LANG_EVENT_WEBSITE)?>:</strong>
					<? if (!$user){
						echo "<a href=\"javascript:void(0);\" style=\"cursor:default\">".$dispurl."</a>";
					} else {
						echo "<a href=\"".$event_url."\" target=\"_blank\">".$event_url."</a>";
					}?>
					</p>
				<? } ?>

				<? if ($event_email){ ?>
					<p><strong><?=system_showText(LANG_LABEL_EMAIL)?>:</strong> <a href="<?=$contact_email?>" class="<?=!$tPreview? "iframe fancy_window_tofriend": "";?>" style="<?=$contact_email_style?>"><?=system_showText(LANG_SEND_AN_EMAIL);?></a></p>
				<? } ?>	

				<? if($event_contactName) { ?>
					<p><strong><?=system_showText(LANG_LABEL_CONTACTNAME)?>:</strong> <?=$event_contactName?></p>
				<? } ?>

				<? if($phone_display_code) { ?>
					<p><strong><?=system_showText(LANG_LABEL_PHONE)?>:</strong> <?=$phone_display_code?></p>
				<? } ?>

			</div>
			
			<div class="right">
				
				<? if ($imageTag) { ?>
                    <h2><?=LANG_GALLERYTITLE?></h2>
                    <div class="image">
                        <?=$imageTag?>
                    </div>
				<? } ?>

				<? if($eventGallery) { ?>
                    <div class="gallery">
                        <?=$eventGallery?>
                    </div>
				<? } ?>
				
			</div>
			
		</div>
		
		<? if ($event_description) { ?>
			<h2><?=system_showText(LANG_LABEL_DESCRIPTION);?></h2>
			<div class="content-box">
				<p><?=$event_description?></p>
			</div>
		<? } ?>
	
	</div>