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
	# * FILE: /includes/views/view_listing_summary_code.php
	# ----------------------------------------------------------------------------------------------------

	if (is_array($bronze_listing)) {
		$aux = $bronze_listing;
	} else if (is_object($bronze_listing)) {
		$aux = $bronze_listing->listing_array;
	}

	/*if ($bronze_listing_template_friendly_url){ ?>
		<a name="<?=$bronze_listing_template_friendly_url;?>"></a>
	<? } */ ?>
	
	<div class="bronze-listing<?php if ($bronze_listing_count%3 == 0) echo ' left-col'; ?>" style="height:140px;">
		<div onclick="window.location='<?php echo $bronze_listing_url; ?>'" style="cursor: pointer">
			<h3>
				<a href="<?php echo $bronze_listing_url; ?>">
				<?=$bronze_listing_template_title?>
				</a>
			</h3>
			<? if(($bronze_listing_template_address) || ($bronze_listing_template_address2) || ($bronze_listing_template_location)) echo "<address>\n"; ?>
			<p>
			<? if ($bronze_listing_template_address) { ?>
				<?=$bronze_listing_template_address?>
			<? } ?>
	
			<? if ($bronze_listing_template_address2) { ?>
				, <?=$bronze_listing_template_address2?>
			<? } ?>
			</p>
			<? if ($bronze_listing_template_location) { ?>
				<p><?=$bronze_listing_template_location?></p>
			<? } ?>
			<? if(($bronze_listing_template_address) || ($bronze_listing_template_address2) || ($bronze_listing_template_location)) echo "\n</address>\n"; ?>	
		</div>
		<? if ($bronze_listing_template_phone) { ?>
			<p><?=$bronze_listing_template_phone?></p>
		<? } ?>
		<p>
			<span style="float: left; margin-top: 2px;">
				<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo htmlspecialchars($bronze_listing_url); ?>&amp;send=false&amp;layout=button_count&amp;width=80&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=402384413114811" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:21px;" allowTransparency="true"></iframe>
			</span>
			
			<span style="float: left; margin-right: 10px; margin-top: 2px;">
				<span class="g-plusone" data-size="medium" data-annotation="none" data-href="<?php echo $bronze_listing_url; ?>"></span>
			</span>
		</p>
		<p style="clear: left;">			
			<? if($bronze_listing_template_twilioSMS){ ?>
				<span class="button-send" style="margin-right: 10px;"><a href="<?=$bronze_listing_template_twilioSMS?>" <?=$twilioSMS_style?>><?=system_showText(LANG_LABEL_SENDPHONE);?></a></span>
			<? } ?>                     
			<? if ($bronze_listing_template_claim) { ?>
				<span class="claim" style="margin: 6px 10px 6px 0;">
					<?=$bronze_listing_template_claim?>
				</span>
			<? } ?>
		</p>
	</div>

	<? unset($aux); ?>