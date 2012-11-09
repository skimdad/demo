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
	# * FILE: /includes/forms/form_colorscheme.php
	# ----------------------------------------------------------------------------------------------------


?>	
	
	<script language="javascript" type="text/javascript">

		function JS_submit(type) {
			if (type == "reset"){
				$("#action").attr("value", "reset");
				dialogBox("confirm", '<?=system_showText(LANG_SITEMGR_COLORS_RESET_CONFIRM);?>', "Submit", "color_scheme", 200,'<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
			} 
			if (type == "apply"){
				$("#aux_action").attr("value", "1");
			}
			
			if (type != "reset"){
				document.color_scheme.submit();
			}
		}
		
		function enableOptions(id){
			$("#"+id).css("display", "");
		}
		
		function hideOptions(id){
			$("#"+id).css("display", "none");
		}
		
		function emptyColor(id, div, box){
			$("#"+id).attr("value", "SCHEME_EMPTY");
			$("#"+div+" div").css("backgroundColor", "");
			$("#"+box).css("display", "none");
		}
		
		function restoreDefault(id, div, color, box){
			if (color){
				$("#"+id).attr("value", color);
				$("#"+div+" div").css("backgroundColor", "#"+color);
			} else {
				$("#"+id).attr("value", "SCHEME_EMPTY");
				$("#"+div+" div").css("backgroundColor", "");
			}
			$("#"+box).css("display", "none");
		}

	</script>
	
	<? if ($errorMessage) { ?>
		<div id="warning" class="errorMessage">
			<?=$errorMessage?>
		</div>
	<? } else if ($successMessage){ ?>
		<div id="warning" class="successMessage">
			<?=$successMessage?>
		</div>
	<? } ?>

	<div class="header-form">
		<?=ucwords(system_showText(LANG_SITEMGR_COLOR_SCHEME)." - $label");?>
	</div>
	
	<? if ($scheme != EDIR_SCHEME){ ?>
		<p class="informationMessage"><?=system_showText(LANG_SITEMGR_COLOR_SCHEME_TIP)?></p>
	<? } ?>
	
	<br />
	
	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_COLOR_COLOROPTIONS)?></th>
		</tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" class="standard-table double-table" style="z-index:10;">
		<? foreach ($table_colors_1 as $table_info) { ?>
		
			<tr>
				<th class="alignTop"><?=system_showText(constant("LANG_SITEMGR_COLOR_".string_strtoupper($table_info)."COLOR"))?>:</th>
				<td>
					<p>
						<div class="colorSelector" id="colorSelector<?=$table_info?>"><div style="background-color: #<?=${"color".$table_info}?>; cursor:pointer;"></div></div>
						<a class="colorOptions" href="javascript: void(0);" onclick="enableOptions('options<?=$table_info?>')"><?=string_strtolower(system_showText(LANG_LABEL_OPTIONS));?></a>
					</p>
					<div style="display:none" id="options<?=$table_info?>" class="optionsBackground">
						<table>
							<tr>
								<th class="closeTitle">
									<a href="javascript: void(0);" onclick="hideOptions('options<?=$table_info?>')" class=""><img class="closeButton" src="<?=DEFAULT_URL?>/images/icon_close.gif" /></a>
								</th>
							</tr>
							<tr>
								<td>
									<ul class="list-view">
										<li>
											<a href="javascript: void(0);" onclick="restoreDefault('color<?=$table_info?>', 'colorSelector<?=$table_info?>', '<?=$arrayDefault[$theme][$scheme]["color".$table_info]?>', 'options<?=$table_info?>')"><?=LANG_SITEMGR_COLOR_RESTORE?></a>
										</li>
										<li>
											<a href="javascript: void(0);" onclick="emptyColor('color<?=$table_info?>', 'colorSelector<?=$table_info?>', 'options<?=$table_info?>')"><?=system_showText(LANG_SITEMGR_COLOR_EMPTY)?></a>
										</li>
									</ul>
								</td>
							</tr>
						</table>
					</div>
				</td>

				<input type="hidden" id="color<?=$table_info?>" name="color<?=$table_info?>" value="<?=${"color".$table_info}?>"/>
			</tr>
		
		<? } ?>
	</table>
	
	<table cellpadding="0" cellspacing="0" border="0" class="standard-table double-table" style="z-index:10;">
		<? foreach ($table_colors_2 as $table_info) { ?>
		
			<tr>
				<th class="alignTop"><?=system_showText(constant("LANG_SITEMGR_COLOR_".string_strtoupper($table_info)."COLOR"))?>:</th>
				<td>
					<p>
						<div class="colorSelector" id="colorSelector<?=$table_info?>"><div style="background-color: #<?=${"color".$table_info}?>; cursor:pointer;"></div></div>
						<a class="colorOptions" href="javascript: void(0);" onclick="enableOptions('options<?=$table_info?>')"><?=string_strtolower(system_showText(LANG_LABEL_OPTIONS));?></a>
					</p>
					<div style="display:none" id="options<?=$table_info?>" class="optionsBackground">
						<table>
							<tr>
								<th class="closeTitle">
									<a href="javascript: void(0);" onclick="hideOptions('options<?=$table_info?>')" class=""><img class="closeButton" src="<?=DEFAULT_URL?>/images/icon_close.gif" /></a>
								</th>
							</tr>
							<tr>
								<td>
									<ul class="list-view">
										<li>
											<a href="javascript: void(0);" onclick="restoreDefault('color<?=$table_info?>', 'colorSelector<?=$table_info?>', '<?=$arrayDefault[$theme][$scheme]["color".$table_info]?>', 'options<?=$table_info?>')"><?=LANG_SITEMGR_COLOR_RESTORE?></a>
										</li>
										<li>
											<a href="javascript: void(0);" onclick="emptyColor('color<?=$table_info?>', 'colorSelector<?=$table_info?>', 'options<?=$table_info?>')"><?=system_showText(LANG_SITEMGR_COLOR_EMPTY)?></a>
										</li>
									</ul>
								</td>
							</tr>
						</table>
					</div>
				</td>

				<input type="hidden" id="color<?=$table_info?>" name="color<?=$table_info?>" value="<?=${"color".$table_info}?>"/>
			</tr>
		
		<? } ?>
	</table>
	
	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_COLOR_BACKGROUNDIMAGE)?> <span>(JPG, GIF, PNG)</span></th>
		</tr>
		<tr>
			<th class="alignTop"><?=system_showText(LANG_LABEL_IMAGE_SOURCE)?>:</th>
			<td>
				<input type="file" name="background_image" size="50" /><span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?> <?=system_showText(LANG_SITEMGR_MSGTRANSPARENTGIF)?></span>
			</td>
		</tr>
		<?  if ($theme_imageID && is_numeric($theme_imageID)) { ?>
		<tr class="imageSpace">
			<th>&nbsp;
				
			</th>
			<td colspan="2">
				<?
				$imageObj = new Image($theme_imageID);
				if ($imageObj->imageExists()) {
					echo $imageObj->getTag(true, 100, 150, system_showText(LANG_SITEMGR_COLOR_BACKGROUNDIMAGE));
				}
				?>
			</td>
			<input type="hidden" name="aux_imageID" value="<?=$theme_imageID?>">
		</tr>
		<tr>
			<th>
				<input type="checkbox" name="remove_image" class="inputCheck" value="1" style="vertical-align:middle;" />
			</th>
			<td>
				<?=system_showText(LANG_MSG_CHECK_TO_REMOVE_IMAGE)?>
			</td>
		</tr>
		<? } ?>
		<tr>
			<th class="alignTop"><?=system_showText(LANG_SITEMGR_COLOR_ALIGNOPTIONS)?>:</th>
			<td>
				<?=$arrayAlign;?>
			</td>
		</tr>
		<tr>
			<th class="alignTop"><?=system_showText(LANG_SITEMGR_COLOR_REPEATOPTIONS)?>:</th>
			<td>
				<?=$arrayRepeat;?>
			</td>
		</tr>
	</table>
    
    <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
		</tr>
		<tr>
			<th><input type="checkbox" name="change_images" value="on" <?=$change_images_checked?> /></th>
			<td>
				<?=system_showText(LANG_SITEMGR_COLOR_IMAGES)?>
				<span><?=system_showText(LANG_SITEMGR_COLOR_IMAGES_TIP)?></span>
			</td>
			
		</tr>
	</table>
	
	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=string_ucwords(system_showText(LANG_SITEMGR_COLOR_TYPOGRAFYOPTIONS))?></th>
		</tr>
		<tr>
			<th class="alignTop"><?=system_showText(LANG_SITEMGR_COLOR_FONT)?>:</th>
			<td>
				<?=$arrayFont;?>
			</td>
		</tr>
	</table>