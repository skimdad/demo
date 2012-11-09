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
	# * FILE: /includes/forms/form_suggar_plugin.php
	# ----------------------------------------------------------------------------------------------------
?>
	<script language="javascript" type="text/javascript">
		function download_sugar_plugin(){
			<? if (!DEMO_LIVE_MODE) { ?>
				document.location = "<?=DEFAULT_URL?>/sitemgr/plugins/index.php?download=1&type=sugar";
			<? } else { ?>
				livemodeMessage('<?=system_showText(LANG_SITEMGR_PLUGIN_DEMO_MESSAGE);?>');
			<? } ?>
		}
        
		$(document).ready(
			
			function(){
				$("#sugar_plugin").submit(function(event){
					event.preventDefault();
                    if ($("#sugar_url").val() && $("#sugar_user").val() && $("#sugar_password").val()){
                    
                        $.post("<?=DEFAULT_URL?>/sitemgr/plugins/sugarCRM_plugin_ajax.php", $("#sugar_plugin").serialize(), 
                        function(data){
                            $("#sugar_download_button").attr("class","sugarThirdStep");
                            $("#sugar_download_button").html(data);
                        });
                    } else {
                        fancy_alert('<?=system_showText(LANG_LABEL_TYPE_FIELDS)?>', 'informationMessage', false, 350, 'auto', false);
                    }
				})	
			}
		);
	</script>

	<div class="sugarCRMPlugIn">
		<img src="<?=DEFAULT_URL?>/sitemgr/images/design/img_sugarcrm_logo.gif" />
		<div class="sugarLeft">
			<h3><?=system_showText(LANG_SITEMGR_SUGAR_WHAT_IS_THIS_QUESTION)?></h3>
			<p><?=system_showText(LANG_SITEMGR_SUGAR_WHAT_IS_THIS_ANSWER)?></p>
		</div>

		<div class="sugarRight">
			<h3><?=system_showText(LANG_SITEMGR_SUGAR_HOW_DOES_IT_WORKS_QUESTION)?></h3>
			<p><?=system_showText(LANG_SITEMGR_SUGAR_HOW_DOES_IT_WORKS_ANSWER)?></p>
		</div>
	</div>

	<div class="sugarCRMSubmit">

		<h2><?=system_showText(LANG_SITEMGR_PLUGIN_INSTALL);?></h2>
		<form name="suggar_plugin" id="sugar_plugin" >
			
			<input type="hidden" name="plugin_type" value="sugar">
			
			<div class="sugarFirstStep">
				<p><?=system_showText(LANG_SITEMGR_SUGARDETAILS)?></p>

					<label>* <?=system_showText(LANG_SITEMGR_SUGAR_CRM_URL)?></label> 
					<input type="text" name="sugar_url" id="sugar_url" value="<?=$sugar_url?>" />
					<label>* <?=system_showText(LANG_SITEMGR_SUGAR_ADMIN_USER_ID)?></label> 
					<input type="text" name="sugar_user" id="sugar_user" value="<?=$sugar_user?>"/>
					<label>* <?=system_showText(LANG_SITEMGR_SUGAR_PASSWORD)?></label> 
					<input type="password" name="sugar_password" id="sugar_password" value="<?=$sugar_password?>" />

			</div>
			<div class="sugarSecondStep">
				<p><?=system_showText(LANG_SITEMGR_SUGAR_CLICK_BUTTON_VERIFY)?></p>
				<div class="standardSugarButton">
					<input type="submit" name="submit_form" value="<?=system_showText(LANG_SITEMGR_SUGAR_VERIFY)?>" />
				</div>
			</div>
		</form>
		<div id="sugar_download_button">
		</div>	
		<?
		/*
		<div class="sugarThirdStep">
			<p>Download the Plugin and follow the enclosed instructions</p> 
			<div class="sugarCRMDownload" id="sugar_download_button">
				<a href="javascript:void(0)">
					<?=system_showText(LANG_SITEMGR_SUGAR_DOWNLOAD)?>
				</a>
			</div>
		</div>
		*/
		?>

	</div>