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
	# * FILE: /blog/includes/views/view_post_detail.php
	# ----------------------------------------------------------------------------------------------------

	$post_id = $id;

	include(BLOG_INCLUDES_DIR."/views/view_comment.php");
	extract($_GET);

?>

	<div class="share">
		<?=$icon_navbar;?>
	</div>
	
	
	<div class="detail">
	
		<h1><?=$title;?></h1>
		
		<div class="info">
			<p><?=system_showText(LANG_BY);?> <strong><?=EDIRECTORY_TITLE;?></strong> <?=$postOn;?></p>
			<p><?=$postCategoryTree;?></p>
		</div>
		
		<? if ($wp_enabled != "on" || ($force_blog_module && $postImage)){ ?>
			<div class="image">
				<?=$imageTag?>
			</div>
		<? } ?>
	
		<? if($content) { ?>
			<div class="content-custom">
				<?=($content)?>
			</div>
		<? } ?>
			
		<? 
		setting_get("commenting_fb", $commenting_fb);
		setting_get("commenting_edir", $commenting_edir);
		setting_get("review_blog_enabled", $review_blog_enabled);
		$showLabel = true;
		?>
	
		<?
		
		if ($commenting_fb){
			$showLabel = false;
		?>
			<span class="clear" style="display:block;"></span>
			<h2 id="posComment"><?=system_showText(LANG_BLOG_COMMENTS)?></h2>

			<?
			
			$detailLink = NON_LANG_URL."/".BLOG_FEATURE_FOLDER."/facebook_comment.php?id=".$post->getNumber("id");

			setting_get("commenting_fb_number_comments", $commenting_fb_number_comments);

			?>

			<script language="javascript" type="text/javascript">
				//<![CDATA[
				(function(d){
				  var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
				  js = d.createElement('script'); js.id = id; js.async = true;
				  js.src = "//connect.facebook.net/<?=EDIR_LANGUAGEFACEBOOK?>/all.js#xfbml=1";
				  d.getElementsByTagName('head')[0].appendChild(js);
				}(document));

				document.write('<div class="fb-comments" data-href="<?=$detailLink?>" data-num-posts="<?=$commenting_fb_number_comments?>" data-width="<?=FB_COMMENTWIDTH_BLOG?>"></div>');
                <? if ($pcomment && !$error_comment) { ?>
                $('html, body').animate({
                    scrollTop: $('#posComment').offset().top
                }, 500);
                 <? } ?>        
				//]]>
			</script>

		<? } ?>
		
		<? if ($detail_comment && $commenting_edir && $review_blog_enabled) { ?>
        	<span class="clear" style="display:block;"></span>
			<? if ($showLabel) { ?>
				<h2 id="posComment"><?=system_showText(LANG_BLOG_COMMENTS)?></h2>
			<? } ?>
                                    
             <? if ($success_message){ ?>
                <p class="successMessage" id="messageSucess"><?=$success_message?></p>
            <? } ?>   
                
			<?=$detail_comment?>
                
                
		<? } ?>

		<? if ($success_message || $success_approve_message) { ?>
			<script type="text/javascript">
					$('html, body').animate({
						scrollTop: $('#messageSucess').offset().top
					}, 500);
			</script>
		<?
			unset($success_message);
		}?>
	
		<? if ($_POST['reply_id'] || $_POST['reply_id'] = 0) { ?>
			<script type="text/javascript">
	
			$(document).ready(function () {
				showhideFormReply(<?=$_POST['reply_id'];?>);
			})
	
			</script>
		<? } ?>
		
	</div>
	
	<? if ($user && $commenting_edir && $review_blog_enabled) { 
		include(BLOG_EDIRECTORY_ROOT."/includes/forms/form_comment.php");
	} ?>