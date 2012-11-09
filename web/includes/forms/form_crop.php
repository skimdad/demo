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
	# * FILE: /includes/forms/form_crop.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	
	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	
	extract($_GET); 
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<? include(EDIRECTORY_ROOT."/includes/code/ie6pngfix.php"); ?>
	</head>
	<body>
		<script type="text/javascript">
			function setCrop(op, sulfix) {
				if (op == 0) {
					 parent.$.fancybox.close();
				} else if (op == 1) {
                    document.getElementById("image"+sulfix).value = "";
                    document.getElementById("image_type"+sulfix).value = "";
                    parent.$.fancybox.close();
				}
			}
		</script>
		<div id="loadingBar" align="center">
			<img src="<?=DEFAULT_URL?>/images/content/img_loading_bar.gif"/>
		</div>

		<div align="center">
			<p class="errorMessage" id="noImageSpan<?=$multi?>" style="display:none; height: auto; overflow: hidden" >
				<span id="errorType" style="display:none">
					<?=system_showText(LANG_MSG_INVALID_IMAGE_TYPE)?>
				</span>
				<span id="errorSize" style="display:none">
					<?
					$sizeMessage = "";
					$sizeMessage .= system_showText(LANG_MSG_IMAGE_FILE_TOO_LARGE)." ";
					$sizeMessage .= system_showText(LANG_MSG_MAX_FILE_SIZE)." ".UPLOAD_MAX_SIZE." MB.";
					echo $sizeMessage;
					?>
				</span>
				<br />
				<?=system_showText(LANG_PLEASE_TRY_AGAIN_WITH_ANOTHER_IMAGE)?>
			</p>
		</div>

		<div id="crop" style="display:none" align="center">
			<img id="imgUpload<?=$multi?>" style="display:none"/>
		</div>
		<?if (string_strpos($_SERVER["HTTP_REFERER"],'sitemgr')){?>
		<div id="cropButtons" align="center">
			<input type="button" id="ButtonCropSubmit" style="display:none" value="<?=system_showText(LANG_BUTTON_SUBMIT)?>" onClick="setCrop(0, '<?=$multi?>');" class="input-button-form">
			<input type="button" value="<?=system_showText(LANG_BUTTON_CANCEL)?>" onClick="setCrop(1, '<?=$multi?>');" class="input-button-form">
		</div> 
		<? }else{ ?>
		<div id="cropButtons" class="baseButtons">

			<p class="standardButton">
				<button id="ButtonCropSubmit" onClick="setCrop(0, '<?=$multi?>');" type="button"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
			</p>
			<p class="standardButton">
				<button type="submit" onClick="setCrop(1, '<?=$multi?>');"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
			</p>
		
		</div>
		<? } ?>

	</body>
</html>