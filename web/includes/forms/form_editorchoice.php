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
	# * FILE: /includes/forms/form_editorchoice.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFAULT
	# ----------------------------------------------------------------------------------------------------
	$default_max_choice = 3;

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	/**
	* Field values
	****************************************************************************/
	if ($default_max_choice == 1) $editorChoices[] = db_getFromDB("editor_choice", "", "", $default_max_choice, "id", "object", SELECTED_DOMAIN_ID);
	else $editorChoices = db_getFromDB("editor_choice", "", "", $default_max_choice, "id", "object", SELECTED_DOMAIN_ID);
	$indice = 0;
	if ($editorChoices) {
		foreach ($editorChoices as $editor) { 
			$default_editor_id[$indice] = $editor->getNumber("id");
			$default_name[$indice]      = $editor->getString("name");
			$default_available[$indice] = ($editor->available) ? "checked" : "";
			$default_images[$indice++]  = $editor->getNumber("image_id");
		}
	}

?>

<div class="header-form">
	<?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_LISTING_DESIGNATIONS));?>
	<font class="subheader-form">(<?=IMAGE_DESIGNATION_WIDTH?>px x <?=IMAGE_DESIGNATION_HEIGHT?>px) (<?=system_showText(LANG_SITEMGR_JPGORGIF)?>)</font>
</div>

<? if (is_numeric($message) && isset($msg_designation[$message])) { ?>
	<div id="warning" class="successMessage">
		<?=$msg_designation[$message]?>
	</div>
<? } ?>

<? if ($message_editorchoice) { ?>
	<div id="warning" class="successMessage">
		<?=$message_editorchoice?>
	</div>
<? } ?>

<? if ($message_error_editorchoice) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_error_editorchoice?>
	</div>
<? } ?>
<br />
<div class="tip-base">
	<p style="text-align: justify;"><a href="<?=DEFAULT_URL;?>/sitemgr/faq/faq.php?keyword=<?=urlencode("badges");?>" target="_blank"><?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_TIP)?></a></p>
</div>
<br />

<? include(EDIRECTORY_ROOT."/includes/code/thumbnail.php"); ?>

<table cellpadding="2" cellspacing="0" border="0" class="table-form">

	<? for($i=0; $i < $default_max_choice; $i++) { ?>

		<tr class="tr-form">
			<td rowspan="4" align="center" class="td-form">
				<?
				$imageObj = new Image($default_images[$i]);
				
				if($imageObj->imageExists()) {
					echo $imageObj->getTag(IS_UPGRADE == "on" ? true : false, IMAGE_DESIGNATION_WIDTH, IMAGE_DESIGNATION_HEIGHT, $default_name[$i], false);
					$hasImage = true;
				} else {
					$hasImage = false;
				}
				?>
			</td>
		</tr>
		<tr class="tr-form">
			<td align="right" class="td-form">
				<div class="label-form">
					<input type="hidden" name="choice[]" value="<?=$default_editor_id[$i]?>" />
					<input type="hidden" name="image[]"  value="<?=$default_images[$i]?>" />
					<?=system_showText(LANG_SITEMGR_LABEL_NAME)?> <?=$i+1?>:
				</div>
			</td>
			<td align="left" class="td-form">
				<input type="text" name="name[]" value="<?=$_POST['name'][$i] ? htmlspecialchars(stripslashes($_POST['name'][$i])) : $default_name[$i]?>" class="input-form-adminemail" />
			</td>
		</tr>
		<tr class="tr-form">
			<td align="right" class="td-form">
				<div class="label-form">
					<?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_FILE)?> <?=$i+1?>:<br /><br />
				</div>
			</td>

			<td align="left" class="td-form">

				<input type="file" class="input-form-listing" id="image<?=$i+1?>" name="file<?=$i+1?>" onchange="UploadImage('editorchoice','<?=$i+1?>');" /><br />
				<span style="float:left"><?=system_showText(LANG_SITEMGR_MSGMAXFILESIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></span>

				<? // Crop Tool Inputs ?>
				<input type="hidden" name="x<?=$i+1?>" id="x<?=$i+1?>">
				<input type="hidden" name="y<?=$i+1?>" id="y<?=$i+1?>">
				<input type="hidden" name="x2<?=$i+1?>" id="x2<?=$i+1?>">
				<input type="hidden" name="y2<?=$i+1?>" id="y2<?=$i+1?>">
				<input type="hidden" name="w<?=$i+1?>" id="w<?=$i+1?>">
				<input type="hidden" name="h<?=$i+1?>" id="h<?=$i+1?>">
				<input type="hidden" name="image_width<?=$i+1?>" id="image_width<?=$i+1?>">
				<input type="hidden" name="image_height<?=$i+1?>" id="image_height<?=$i+1?>">
				<input type="hidden" name="image_type<?=$i+1?>" id="image_type<?=$i+1?>">

				<? if (($hasImage) || ($default_name[$i])) { ?>

					<table border="0" cellpadding="0" cellspacing="0" style=" width: auto;">
						<tr>
							<td style="padding: 2px;"><a href="<?=DEFAULT_URL?>/sitemgr/prefs/editorchoice.php?delete=y&id=<?=$default_editor_id[$i]?>" title="<?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_CLICKHERETODELETECHOICE)?> <?=$i+1?>" style="line-height: 13px; color: #CC0000; font-weight: bold;"><img src="<?=DEFAULT_URL?>/images/bt_delete.gif" alt="delete" title="delete" border="0" /></a></td>
							<td style="padding: 2px;"><a href="<?=DEFAULT_URL?>/sitemgr/prefs/editorchoice.php?delete=y&id=<?=$default_editor_id[$i]?>" title="<?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_CLICKHERETODELETECHOICE)?> <?=$i+1?>" style="line-height: 13px; color: #CC0000; font-weight: bold;"> <?=string_strtolower(system_showText(LANG_SITEMGR_DELETE))?></a></td>
						</tr>
					</table>

				<? } ?>

			</td>
			
		</tr>
		<tr class="tr-form">
			<td align="right" class="td-form">
				<input type="checkbox" name="available_<?=$i?>" value="1" <?=$default_available[$i]?> class="inputCheck" />
			</td>
			<td align="left" class="td-form">
				<div class="label-form">
					<?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_LISTINGACCOUNTSCANSELECT)?>
				</div>
			</td>
		</tr>

		<tr class="tr-form">
		  <td> </td>
		</tr>
	<? } ?>

</table>
