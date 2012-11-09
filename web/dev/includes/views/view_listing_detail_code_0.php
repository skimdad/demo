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
	# * FILE: /includes/views/view_listing_detail_code_0.php
	# ----------------------------------------------------------------------------------------------------
?>

	<div class="share">
		<?=$listingtemplate_icon_navbar?>
	</div>

	<div class="detail">

		<h1><?=$listingtemplate_title?></h1>

		<div class="columns">

			<div class="left">

				<? /*if ($listingtemplate_category_tree) { ?>
					<?=$listingtemplate_category_tree?>
				<? }*/ ?>

				<? if ($listingtemplate_designations) { ?>
					<div class="content-box">
						<?=$listingtemplate_designations?>
					</div>
				<? } ?>
				
				<div class="content-box pd-0">
					<?=$listingtemplate_facebook_buttons?>
					<?=$listingtemplate_googleplus_button?>
				</div>
				
				<? if ($listingtemplate_description) { ?>
					<h2><?=system_showText(LANG_LABEL_OVERVIEW);?></h2>
					<div class="content-box">
						<p><?=$listingtemplate_description?></p>
					</div>
				<? }?>

				<?
				if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)
					|| ($listingtemplate_phone) ||	($listingtemplate_fax) || ($listingtemplate_url) || ($listingtemplate_email)
					|| ($listingtemplate_twilioSMS) || ($listingtemplate_twilioClickToCall)
					){?>
					<h2><?=LANG_LABEL_CONTACT_INFORMATION?></h2>
				<? } ?>

				<? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "\n<address>\n"; ?>

				<? if ($listingtemplate_address) { ?>
					<span><?=$listingtemplate_address?></span>
				<? } ?>

				<? if ($listingtemplate_address2) { ?>
					<span><?=$listingtemplate_address2?></span>
				<? } ?>

				<? if ($listingtemplate_location) { ?>
					<span><?=$listingtemplate_location?></span>
				<? } ?>

				<? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "</address>\n"; ?>

				<? if ($listingtemplate_phone) { ?>
					<p><strong><?=system_showText(LANG_LISTING_LETTERPHONE)?>:</strong> <?=$listingtemplate_phone?></p>
				<? } ?>

				<? if ($listingtemplate_fax) { ?>
					<p><strong><?=system_showText(LANG_LISTING_LETTERFAX)?>:</strong> <?=$listingtemplate_fax?></p>
				<? } ?>

				<? if ($listingtemplate_url) { ?>
					<p><strong><?=system_showText(LANG_LISTING_LETTERWEBSITE)?>:</strong> <?=$listingtemplate_url?></p>
				<? } ?>
					
				<? if($listingtemplate_twilioSMS){ ?>
					<p class="button-send"><a href="<?=$listingtemplate_twilioSMS?>" <?=$twilioSMS_style?>><?=system_showText(LANG_LABEL_SENDPHONE);?></a></p>                    
				<? } ?> 
					
				<? if($listingtemplate_twilioClickToCall){ ?>					
                    <p class="button-call"><a href="<?=$listingtemplate_twilioClickToCall?>" <?=$twilioClickToCall_style?>><?=system_showText(LANG_LABEL_CLICKTOCALL);?></a></p>
				<? } ?> 

				<? if ($listingtemplate_claim) { ?>
					<?=$listingtemplate_claim?>
				<? } ?>

				<? if ($listingtemplate_email){ ?>
					<div class="button button-contact">
						<h2><a href="javascript: void(0);" <?=$user ? "onclick=\"scrollPage('#contact-formScroll');\"" : "style=\"cursor:default\"" ?>><?=system_showText(LANG_LISTING_CONTACT)?></a></h2>			
					</div>
				<? } ?>

                <? if ($listingtemplate_attachment_file) { ?>
                    <h2><?=ucfirst(system_showText(LANG_LABEL_ADDITIONALINFORMATION))?></h2>
                    <?=$listingtemplate_attachment_file?>
                <? } ?>

			</div>

			<div class="right">

				<? if ($listingtemplate_image) { ?>
                    <h2><?=LANG_GALLERYTITLE?></h2>
                    <div class="image">
                        <?=$listingtemplate_image?>
                    </div>
				<? } ?>

				<? if($listingtemplate_gallery) { ?>
                    <div class="gallery">
                        <?=$listingtemplate_gallery?>
                    </div>
				<? } ?>

				<? if ($listingtemplate_video_snippet) { ?>
					<h2><?=system_showText(LANG_LABEL_VIDEO);?></h2>
					<div class="video">
						<script language="javascript" type="text/javascript">
						//<![CDATA[
						document.write("<?=str_replace("\"","'",$listingtemplate_video_snippet)?>");
						//]]>
						</script>
					</div>
					
				<? } ?>

			</div>

		</div>

		<? if ($listingtemplate_long_description) { ?>
			<h2><?=system_showText(LANG_LABEL_DESCRIPTION);?></h2>
			<p><?=$listingtemplate_long_description?></p>
		<? } ?>

		<? if ($listingtemplate_hours_work) { ?>
			<h2><?=system_showText(LANG_LISTING_HOURS_OF_WORK)?></h2>
			<p><?=$listingtemplate_hours_work?></p>
		<? } ?>

		<? if ($listingtemplate_locations) { ?>
			<h2><?=system_showText(LANG_LOCATIONS)?></h2>
			<p><?=$listingtemplate_locations?></p>
		<? } ?>

		<? if ($templateExtraFields) { ?>
            <div class="extra-fields">
                <?=$templateExtraFields;?>
            </div>
		<? } ?>

	</div>