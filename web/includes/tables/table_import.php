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
	# * FILE: /includes/tables/table_import.php
	# ----------------------------------------------------------------------------------------------------

?>

<script>
	function JS_openDetail(id) {
		document.getElementById('log_'+id).style.display = '';
		document.getElementById('img_'+id).innerHTML     = '<img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/content/img_close.gif" onclick="JS_closeDetail('+id+');" />'
	}
	function JS_closeDetail(id) {
		document.getElementById('log_'+id).style.display = 'none';
		document.getElementById('img_'+id).innerHTML     = '<img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/content/img_open.gif" onclick="JS_openDetail('+id+');" />'
	}
</script>

<? if($message){ ?>
	<p class="successMessage"><?=$message?></p>
<? } ?>

<tr>
	<td>
		<div id="img_<?=$import->getNumber("id");?>">
			<img style="cursor: pointer;" src="<?=DEFAULT_URL?>/images/content/<?=($log_id == $import->getNumber("id") ? "img_close.gif" : "img_open.gif")?>" onclick="<?=($log_id == $import->getNumber("id") ? "JS_closeDetail" : "JS_openDetail")?>('<?=$import->getNumber("id");?>');" />
		</div>
	</td>
	<td>
		<?=format_date($import->getString("date"))?>&nbsp; - <?=format_getTimeString($import->getNumber("time"))?>
	</td>
	<td>
		<fieldset title="<?=$import->getString("filename");?>">
			<?=$import->getString("filename", true, 23);?>
		</fieldset>
	</td>
	<td id="total_lines_<?=(int)$import->getNumber("id")?>">
		<?=(int)$import->getNumber("totallines")?>
	</td>
	<td id="progress_added_<?=(int)$import->getNumber("id")?>">
		<?=(int)$import->getNumber("linesadded")?>
	</td>
	<td id="tdprogress_<?=$import->getNumber("id")?>">
		<?
		$status = new ImportStatus();
		if ($import->getString("status") == "R") echo $status->getStatusWithStyle($import->getString("status"), $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"> - <span id=\"progress_".$import->getNumber("id")."\">".$import->getString("progress")."</span></span>";
		else if ($import->getString("action") == "NR") echo $status->getStatusWithStyle("WR", $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
		else if ($import->getString("status") == "P" && $import->getString("action") == "RI") echo $status->getStatusWithStyle("Q", $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
		else if ($import->getString("status") == "P" && $import->getString("action") == "NC") echo $status->getStatusWithStyle("Q2", $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
		else if ($import->getString("status") == "P" && $import->getString("action") == "C") echo $status->getStatusWithStyle("U", $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
		else if ($import->getString("status") == "P" && $import->getString("action") == "NA") echo $status->getStatusWithStyle("PA", $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
		else echo $status->getStatusWithStyle($import->getString("status"), $import->getNumber("id"))."<span id=\"progresslabel_".$import->getNumber("id")."\"><span id=\"progress_".$import->getNumber("id")."\"></span></span>";
		?>
	</td>
	<td nowrap="nowrap">
		<? if (($import->getString("status") == "P") && ($import->getString("action") == "NA" || $import->getString("action") == "RI")) {
			$src_view = "bt_view.gif";
			$onclick_view = "linkRedirect('import.php?import_type=$importType&id=".$import->getNumber("id")."&amp;preview=true', true);";
			$cursor_view = "pointer;";
		} else {
			$src_view = "bt_view_off.gif";
			$onclick_view = "javascript: void(0);";
			$cursor_view = "default;";
		} ?>
		<img id="span_view_<?=$import->getNumber("id")?>" src="<?=DEFAULT_URL;?>/images/<?=$src_view?>" border="0"  alt="<?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW);?> <?=LANG_SITEMGR_IMPORT;?>" title="<?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW);?> <?=LANG_SITEMGR_IMPORT;?>" onclick="<?=$onclick_view?>" style="cursor: <?=$cursor_view?>">

		<? if ((($import->getString("status") == "F") || ($import->getString("status") == "S")) && ($import->getString("action") != "NR")) {
			$src_rollback = "icon_rollback.gif";
			$onclick_rollback = "linkRedirect('rollback.php?import_type=$importType&id=".$import->getNumber("id")."', false);";
			$cursor_rollback = "pointer;";
		} else {
			$src_rollback = "icon_rollback_off.gif";
			$onclick_rollback = "javascript: void(0);";
			$cursor_rollback = "default;";
		} ?>
		<img id="span_rollback_<?=$import->getNumber("id")?>" src="<?=DEFAULT_URL;?>/images/<?=$src_rollback?>" border="0"  alt="<?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERETOROLLBACK);?>" title="<?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERETOROLLBACK);?>" onclick="<?=$onclick_rollback?>" style="cursor: <?=$cursor_rollback?>">
	
		<? if ($import->getString("status") == "R") {
			$src_off = "icon_stop.gif";
			$onclick_off = "linkRedirect('stop.php?import_type=$importType&id=".$import->getNumber("id")."', false);";
			$cursor_off = "pointer;";
		} else {
			$src_off = "icon_stop_off.gif";
			$onclick_off = "javascript: void(0);";
			$cursor_off = "default;";
		} ?>
		<img id="span_stop_<?=$import->getNumber("id")?>" src="<?=DEFAULT_URL;?>/images/<?=$src_off?>" border="0"  alt="<?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERETOSTOP);?>" title="<?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERETOSTOP);?>" onclick="<?=$onclick_off?>" style="cursor: <?=$cursor_off?>">

		<? if (($import->getString("status") != "R") && ($import->getString("status") != "W") && ($import->getString("action") != "NR") && ($import->getString("action") != "C")) {
			$src_del = "bt_delete.gif";
			$onclick_del = "linkRedirect('delete.php?import_type=$importType&id=".$import->getNumber("id")."', false);";
			$cursor_del = "pointer;";
		} else {
			$src_del = "bt_delete_off.gif";
			$onclick_del = "javascript: void(0);";
			$cursor_del = "default;";
		} ?>
		<img  id="span_delete_<?=$import->getNumber("id")?>" src="<?=DEFAULT_URL;?>/images/<?=$src_del?>" border="0"  alt="<?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERETOREMOVELOGTEXT);?>" title="<?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERETOREMOVELOGTEXT);?>" onclick="<?=$onclick_del?>" style="cursor: <?=$cursor_del?>">
	</td>
</tr>

<tr id="log_<?=$import->getNumber("id");?>" <? if ($log_id != $import->getNumber("id")) echo "style=\"display:none;\"";?> >
	<td colspan="4">
		<?
		echo import_getHistory($import->getString("history"));
		?>
	</td>
	<td colspan="3" align="center" id="message_progress_<?=$import->getNumber("id")?>">&nbsp;</td>
</tr>