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
	# * FILE: /includes/forms/form_wordpress_plugin.php
	# ----------------------------------------------------------------------------------------------------
?>
	<script language="javascript" type="text/javascript">
		function download_wordpress_plugin(type){
			<? if (!DEMO_LIVE_MODE) { ?>
				document.location = "<?=DEFAULT_URL?>/sitemgr/plugins/index.php?download=1&type="+type;
			<? } else { ?>
				livemodeMessage('<?=system_showText(LANG_SITEMGR_PLUGIN_DEMO_MESSAGE);?>');
			<? } ?>
		}

		$(document).ready(
			
			function(){
				$("#wordpress_plugin").submit(function(event){
                    event.preventDefault();
                    if ($("#wordpress_url").val()){
                       
                        $.post("<?=DEFAULT_URL?>/sitemgr/plugins/wordpress_plugin_ajax.php", $("#wordpress_plugin").serialize(), 
                                function(data){
                                    $("#wordpress_download_button").attr("class","wordPressThirdStep");
                                    $("#wordpress_download_button").html(data);
                                });
                    } else {
                       fancy_alert('<?=system_showText(LANG_LABEL_TYPE_URL)?>', 'informationMessage', false, 350, 'auto', false);
                    }
					
				})	
			}
		);
	</script>
	
	<div class="wordPressPlugIn">
		<img src="<?=DEFAULT_URL?>/sitemgr/images/design/img_wordpress_logo.png" />
		<div class="wordPressLeft">
			<h3><?=system_showText(LANG_SITEMGR_WORDPRESS_WHAT_IS_THIS_QUESTION)?></h3>
			<p><?=system_showText(LANG_SITEMGR_WORDPRESS_WHAT_IS_THIS_ANSWER)?></p>
		</div>

		<div class="wordPressRight">
			<h3><?=system_showText(LANG_SITEMGR_WORDPRESS_HOW_DOES_IT_WORKS_QUESTION)?></h3>
			<p>
				<?=system_showText(LANG_SITEMGR_WORDPRESS_HOW_DOES_IT_WORKS_ANSWER)?>
				<a href="javascript:void(0);" onclick="download_wordpress_plugin('wordpress_help');">
					<?=system_showText(LANG_SITEMGR_WORDPRESS_HELPFILE)?>
				</a>
			</p>
		</div>
	</div>

	<div class="wordPressSubmit">
		
		<h2><?=system_showText(LANG_SITEMGR_OPTIONS);?></h2>
		
		<form name="wordpress_plugin_options" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
			
			<input type="hidden" name="type" value="<?=$_GET["type"]?>">
			<input type="hidden" name="plugin_type" value="wordpress">
			
			<? if ($message_wp_options) { ?>
				<div id="warning" class="<?=$error ? "errorMessage" : "successMessage" ?>">
					<?=$message_wp_options?>
				</div>
			<? } ?>
			
			<table cellpadding="0" cellspacing="0" border="0" class="table-form">
				<tr class="tr-form">
					<td align="right" class="td-form">
						<input type="checkbox" name="wp_enabled" value="on" class="inputCheck" <?=($wp_enabled ? "checked" : "")?> />
					</td>
					<td>
						<div class="label-form" align="left"><?=system_showText(LANG_SITEMGR_PLUGINGS_ENABLE_WP)?></div>
						<span><?=system_showText(LANG_SITEMGR_PLUGINGS_WP_TIP)?></span>
					</td>
				</tr>
			</table>
			<table style="margin: 0 auto 0 auto;">
				<tr>
					<td>
						<button type="submit" name="wordpress_plugin_options" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
					</td>
				</tr>
			</table>
		</form>	

		<h2><?=system_showText(LANG_SITEMGR_PLUGIN_INSTALL);?></h2>
		<form name="wordpress_plugin" id="wordpress_plugin" >
			<div class="wordPressFirstStep">
				<p><?=system_showText(LANG_SITEMGR_WORDPRESS_DETAILS)?></p>

					<label>* <?=system_showText(LANG_SITEMGR_WORDPRESS_URL)?></label> 
					<input type="text" name="wordpress_url" id="wordpress_url" value="<?=$wordpress_url?>" />

			</div>
			<div class="wordPressSecondStep">
				<p><?=system_showText(LANG_SITEMGR_WORDPRESS_CLICK_BUTTON_VERIFY)?></p>
				<div class="standardwordPressButton">
					<input type="submit" name="submit_form" value="<?=system_showText(LANG_SITEMGR_WORDPRESS_VERIFY)?>" />
				</div>
			</div>
		</form>
		<div id="wordpress_download_button">
		</div>  
	</div>