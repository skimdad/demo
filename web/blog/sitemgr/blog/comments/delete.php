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
	# * FILE: blog/sitemgr/blog/comments/delete.php
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

	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$commentObj = new Comments($id);
		$is_reply = $commentObj->getNumber("reply_id");
	}	else {
        $message = 0;
		header("Location: ".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/comments/index.php?class=errorMessage&message=".$message."&item_type=$item_type".($filter_id ? "&filter_id=1&item_id=$id" : '')."&screen=$screen&letter=$letter&item_letter=$item_letter&item_screen=$item_screen");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$commentObj = new Comments($id);
		$commentObj->Delete();
		
		//$message = urlencode(system_showText(LANG_SITEMGR_REVIEW_SUCCESSDELETED));
       if ($is_reply){
			$message = 3;
			header("Location: ".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/comments/index.php?reply_id=$is_reply&message=".$message."&item_type=$item_type".($filter_id ? "&filter_id=1&item_id=$item_id" : '')."&screen=$screen&letter=$letter&item_letter=$item_letter&item_screen=$item_screen");
			exit;
	   }
	   else{
			$message = 1;
			header("Location: ".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/comments/index.php?message=".$message."&item_type=$item_type".($filter_id ? "&filter_id=1&item_id=$item_id" : '')."&screen=$screen&letter=$letter&item_letter=$item_letter&item_screen=$item_screen");
			exit;
	   }
	}

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
		<h1><?=system_showText(LANG_SITEMGR_DELETE)?> <?=($is_reply? string_ucwords(system_showText(LANG_SITEMGR_REPLY)): string_ucwords(system_showText(LANG_SITEMGR_COMMENT)))?></h1>
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
		
		<div class="baseForm">

		<form name="delete_review" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
			<input type="hidden" name="id"                 value="<?=$id?>" />
			<input type="hidden" name="item_id"            value="<?=$item_id?>" />
			<input type="hidden" name="item_type"          value="<?=$item_type?>" />
			<? if ($filter_id) { ?>
			<input type="hidden" name="filter_id"          value="1" />
			<? } ?>
			<input type="hidden" name="letter"             value="<?=$letter?>" />
			<input type="hidden" name="screen"             value="<?=$screen?>" />
			<input type="hidden" name="item_screen"        value="<?=$item_screen?>" />
			<input type="hidden" name="item_letter"        value="<?=$item_letter?>" />
			<div class="header-form">

				<?
				if ($commentObj->getString("description")) {
					$comment_title = $commentObj->getString("description", true, 80);
				} else {
					$comment_title = system_showText(LANG_NA);
				}
				
				?>
				
				<?=system_showText(LANG_SITEMGR_DELETE)?> <?=($is_reply? string_ucwords(system_showText(LANG_SITEMGR_REPLY)): string_ucwords(system_showText(LANG_SITEMGR_COMMENT)))?> - <?=$comment_title;?>
			</div>
			<p class="informationMessage">
				<? if ($is_reply){?>
				<?=system_showText(LANG_SITEMGR_REPLY_DELETEQUESTION)?>
				<? } else {?>
				<?=system_showText(LANG_SITEMGR_COMMENT_DELETEQUESTION)?>
				<? } ?>
			</p>
			<button type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
			<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formcommentdeletecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
		</form>
		<form id="formcommentdeletecancel" action="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/comments/index.php" method="get">
			<input type="hidden" name="item_type"        value="<?=$item_type?>" />
			<? if ($filter_id) { ?>
			<input type="hidden" name="filter_id"          value="1" />
			<input type="hidden" name="item_id"            value="<?=$item_id?>" />
			<? } ?>
			<input type="hidden" name="letter"           value="<?=$letter?>" />
			<input type="hidden" name="screen"           value="<?=$screen?>" />
			<input type="hidden" name="item_screen"      value="<?=$item_screen?>" />
			<input type="hidden" name="item_letter"      value="<?=$item_letter?>" />
		</form>
		
		</div>
		<? } ?>
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
