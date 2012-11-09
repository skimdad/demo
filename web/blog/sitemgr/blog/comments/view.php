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
	# * FILE: /sitemgr/review/view.php
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
	$url_base = "".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER;

	extract($_POST);
	extract($_GET);

	$each_rate = new Comments($id);
	$is_reply = $each_rate->getNumber("reply_id");

	
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
		<? if ($is_reply){?>
		<h1><?=ucfirst(system_showText(LANG_SITEMGR_REPLY))?> - <?=system_showText(LANG_SITEMGR_DETAIL)?></h1>
		<? } else { ?>
		<h1><?=ucfirst(system_showText(LANG_SITEMGR_COMMENT))?> - <?=system_showText(LANG_SITEMGR_DETAIL)?></h1>
		<? } ?>
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
			<? if ($is_reply){?>
				<?=system_showText(LANG_SITEMGR_COMMENT_MANAGEREPLY)?>
			<? } else { ?>
				<?=system_showText(LANG_SITEMGR_COMMENT_MANAGECOMMENT)?>
			<? } ?>
		</div>
		<ul class="list-view">         
			<li>
				<a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/comments/delete.php?id=<?=$each_rate->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?>" class="link-view"><?=($is_reply ? system_showText(LANG_SITEMGR_COMMENT_DELETEREPLY): system_showText(LANG_SITEMGR_COMMENT_DELETECOMMENT))?></a>
			</li>

			<li>
				<a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/comments/index.php?reply_id=<?=$is_reply?>" class="link-view"><?=system_showText(LANG_SITEMGR_BACK)?></a>
			</li>
		</ul>
		
		<? if (is_numeric($message) && isset($msg_review[$message])) { ?>
			<p class="successMessage"><?=$msg_review[$message]?></p>
		<? } ?>

        <div id="header-view">
			<? if ($is_reply){?>
				<?=system_showText(LANG_SITEMGR_REPLY_REVIEWPREVIEW)?>
			<? } else { ?>
				<?=system_showText(LANG_SITEMGR_COMMENT_REVIEWPREVIEW)?>
			<? } ?>
		</div>
		<?
		$each_rate->extract();
		$addedTime = $each_rate->getTimeString();
		$show_item = true;
		$user 	   = false;
		$account = new Account($member_id);
		$contact = new Contact($member_id);
		$profile = new Profile($member_id);
		if (SOCIALNETWORK_FEATURE == "on" && $account->getString("has_profile") == "y") {
			$name = $profile->getString("nickname");
		} else {
			$name = $contact->getString("first_name")." ".$contact->getString("last_name");
		}
		$email = $contact->getString("email");
		/////////////////////////////////////////////////////////////////////////////////////
		$item_type='blog';

		$item_reviewcomment = "";

		$itemObj = new Post($item_id);

		$item_default_url = @constant(string_strtoupper($item_type).'_DEFAULT_URL');

		$item_reviewcomment .= "<div class=\"rateComments\">";

		if ($show_item) {

			if (!$user) $linkstr = "javascript:void(0)";
			if (string_strpos($url_base, 'sitemgr') || string_strpos($url_base, 'members')) {
				$linkstr = $url_base."/comments/view.php?id=".$item_id;
			} else {
				$linkstr = $item_default_url."/detail.php?id=".$item_id;
			}
			$item_reviewcomment .= "<h3><a href=\"".$linkstr."\">";
			$item_reviewcomment .= $itemObj->getString("title");
			$item_reviewcomment .= "</a></h3>";

		}

		$item_reviewcomment .= "<div class=\"rateStars\">".$rate_stars."</div>";
		$item_reviewcomment .= "<p class=\"complementaryInfo\">";
		$item_reviewcomment .= "<strong>";
		$item_reviewcomment .= ($name) ? $name : system_showText(LANG_NA);
		$item_reviewcomment .= "</strong>";
		$item_reviewcomment .= "  - ".format_date($added, DEFAULT_DATE_FORMAT, "datetime")." ".$addedTime;
		$item_reviewcomment .= "</p>";

		$item_reviewcomment .= "<p class=\"complementaryInfo\">";
		$item_reviewcomment .= ($email) ? $email : system_showText(LANG_NA);
		$item_reviewcomment .= "</p>";

		$item_reviewcomment .= "<p class=\"complementaryInfo\">";
		$item_reviewcomment .= ($website) ? $website : system_showText(LANG_NA);
		$item_reviewcomment .= "</p>";

		$item_reviewcomment .= "<p class=\"review\">".(($description) ? (html_entity_decode($description)) : system_showText(LANG_NA))."</p>";

		$item_reviewcomment .= "</div>";

		echo $item_reviewcomment;

		/////////////////////////////////////////////////////////////////////////////////////

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
       