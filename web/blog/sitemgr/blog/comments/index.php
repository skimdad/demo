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
	# * FILE: /sitemgr/comments/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();
	
	$url_redirect = "".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/comments";
	$url_base     = "".BLOG_DEFAULT_URL."/sitemgr";

	extract($_GET);
	extract($_POST);
	
	//increases frequently actions
	if (!isset($message)) system_setFreqActions('comments_blog','BLOG_FEATURE');

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	
	$itemObj = new Post($item_id);
	// Page Browsing /////////////////////////////////////////
	if ($item_id) 				 $sql_where[] = " item_type = '$item_type' AND item_id = '$item_id' ";
	
	$reply_id = ($reply_id ? $reply_id : 0);
	if ($reply_id) {
		$replyObj = new Comments($reply_id);

		if ($replyObj->getString("description")) {
			$reply_title = $replyObj->getString("description", true, 15);
		} else {
			$replytitle = system_showText(LANG_NA);
		}
	}
	$sql_where[] = " reply_id = $reply_id";
	if ($sql_where) 
		$where .= " ".implode(" AND ", $sql_where)." ";

	$pageObj  = new pageBrowsing("Comments", $screen, RESULTS_PER_PAGE, "added DESC", "description", $letter, $where);
	$commentsArr = $pageObj->retrievePage("object");

	$paging_url = BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/comments/index.php?reply_id=$reply_id&item_id=$item_id".($filter_id ? "&filter_id=1" : '')."&item_screen=$item_screen&item_letter=$item_letter";

	// Letters Menu
	$letters = $pageObj->getString("letters");
	foreach($letters as $each_letter){
		if($each_letter == "#"){
			$letters_menu .= "<a href=\"$paging_url&letter=no\" ".(($letter == "no") ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
			//$letters_menu .= "<a href=\"$paging_url\" ".((!$letter) ? "class=\"firstLetter\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		} else {
			$letters_menu .= "<a href=\"$paging_url&letter=$each_letter\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		}
	}
	
	$_GET["comment_screen"] = $screen;
	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
?>
<div id="main-right">
<div id="top-content">
	<div id="header-content">
		<?if ($reply_id) {?>
		<h1><?=system_showText(LANG_SITEMGR_COMMENT_MANAGEREPLIES)?></h1>
		<?} else {?>
		<h1><?=system_showText(LANG_SITEMGR_COMMENT_MANAGECOMMENTS)?></h1>
		<?}?>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<?if (CUSTOM_BLOG_FEATURE != "on"){ ?>
			<p class="informationMessage">
				<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
			</p>
		<? }else { ?>
		<br />

		<div id="header-view">
			<?if ($reply_id) {?>
				<?=string_ucwords(system_showText(LANG_SITEMGR_REPLYS))?>
			<?} else {?>
				<?=string_ucwords(system_showText(LANG_BLOG_COMMENTS))?>
			<?}?>
		</div>

		<br />

		<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
		   <? if (is_numeric($message) && isset($msg_comment[$message])) { ?>
        <p class="<?=($class == '' ? 'successMessage' : $class);?>"><?=$msg_comment[$message]?></p>
		<?

		} ?>
		<? if ($commentsArr) { ?>
			<? include(BLOG_INCLUDES_DIR."/tables/table_comments.php"); ?>

			<? if ($openapprove == "yes"){?>
				<script type="text/javascript">
					showStatusField(<?=$id?>);
				</script>
			<? } ?>
		<? } else { ?>
			<?if (!$reply_id) {?>
				<p class="informationMessage"><?=system_showText(LANG_SITEMGR_COMMENT_NORECORD)?></p>
			<? } else {?>
				<p class="informationMessage"><?=system_showText(LANG_SITEMGR_REPLY_NORECORD)?></p>
			<? } ?>
		<? }
		}?>

	</div>
</div>
<div id="bottom-content">
	&nbsp;
</div>
</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>