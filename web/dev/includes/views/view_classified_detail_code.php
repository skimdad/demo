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
	# * FILE: /includes/views/view_classified_detail_code.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="share">
		<?=$classified_icon_navbar?>
	</div>
	
	<div class="detail">
		
		<h1><?=$classified_title;?></h1>
		
		<div class="columns">
			
			<div class="left">
				
				<? /*if ($classified_category_tree) { ?>
					<?=$classified_category_tree?>
				<? }*/ ?>
				
				<div class="content-box pd-0">
					<?=$classified_facebook_buttons;?>
					<?=$classified_googleplus_button;?>
				</div>
				
				<h2><?=system_showText(LANG_LABEL_OVERVIEW);?></h2>
				
				<p><?=$classified_summary;?></p>
					
				<? if ($classified_price != 'NULL') {?>
					<br />
					<p><strong><?=system_showText(LANG_LABEL_PRICE);?>:</strong>
					<?=CURRENCY_SYMBOL." ".$classified_price;?></p>
				<? } ?>
						
				<? if (($classified_contactName) || ($classified_phone) || ($classified_fax) || ($classified_email) || ($classified_url)) { ?>
                    <h2><?=ucfirst(system_showText(LANG_CONTACTINFO))?></h2>
				<? } ?>
				
				<? if (($location) || ($classified_address) || ($classified_address2)) echo "<address>\n";  ?>
				
				<? if($classified_address) { ?>
					<span><?=nl2br($classified_address)?></span>
				<? } ?>

				<? if($classified_address2) { ?>
					<span><?=nl2br($classified_address2)?></span>
				<? } ?>

				<? if($location) { ?>
					<span><?=$location?></span>
				<? } ?>

				<? if (($location) || ($classified_address) || ($classified_address2)) echo "</address>\n";  ?>
				
				<? if ($classified_contactName){ ?>
					<p><strong><?=system_showText(LANG_LABEL_CONTACTNAME)?>:</strong> <?=nl2br($classified_contactName)?></p>
				<? } ?>
					
				<? if ($phone_display_code){ ?>
					<p><strong><?=system_showText(LANG_LABEL_PHONE)?>:</strong> <?=nl2br($phone_display_code)?></p>
				<? } ?>
					
				<? if ($classified_fax){ ?>
					<p><strong><?=system_showText(LANG_LABEL_FAX)?>:</strong> <?=nl2br($classified_fax)?></p>
				<? } ?>
					
				<? if ($classified_email){ ?>
					<p><strong><?=system_showText(LANG_LABEL_EMAIL)?>:</strong> <a href="<?=$contact_email?>" class="<?=!$tPreview? "iframe fancy_window_tofriend": "";?>" style="<?=$contact_email_style?>"><?=system_showText(LANG_SEND_AN_EMAIL);?></a></p>
				<? } ?>	
			
				<? if ($classified_url){ ?>
					<? if ($user){ ?>
						<p><strong><?=system_showText(LANG_LABEL_URL)?>:</strong> <a href="<?=nl2br($classified_url)?>" target="_blank"><?=nl2br($classified_url)?></a></p>
					<? } else { ?>
						<p><strong><?=system_showText(LANG_LABEL_URL)?>:</strong> <a href="javascript:void(0);" style="cursor:default"><?=nl2br($classified_url)?></a></p>
					<? } ?>
				<? } ?>
				
			</div>
			
			<div class="right">
				
				<? if ($imageTag) { ?>
                    <h2><?=LANG_GALLERYTITLE?></h2>
                    <div class="image">
                        <?=$imageTag?>
                    </div>
				<? } ?>

				<? if($classifiedGallery) { ?>
                    <div class="gallery">
                        <?=$classifiedGallery?>
                    </div>
				<? } ?>
				
				<?php     // the following code modified by Debiprasad Sahoo (Indibits) on 19 July 2012 ?>
				<? if ($classified_video_snippet) { ?>
					<h2><?=system_showText(LANG_LABEL_VIDEO);?></h2>
					<div class="video">
						<script language="javascript" type="text/javascript">
						//<![CDATA[
						document.write("<?=str_replace("\"","'",$classified_video_snippet)?>");
						//]]>
						</script>
					</div>
				<? } ?>
				<?php // end by Debiprasad ?>
			</div>
			
		</div>
			
		<? if ($classified_description) { ?>
            <h2><?=system_showText(LANG_LABEL_DESCRIPTION);?></h2>
            <div class="content-box">
                <p><?=$classified_description?></p>
            </div>
		<? }?>
		
	</div>