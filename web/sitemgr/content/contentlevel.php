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
	# * FILE: /sitemgr/content/contentlevel.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	
	$_section = str_replace('_advertise', '', $section);
	
	if ((!$section) || (!$value)) {
		header("Location: ".DEFAULT_URL."/sitemgr/content/index.php");
		exit;
	}
	
	if (($section == "listing" || $section == "listing_advertise")) {
		$levelObj = new ListingLevel();
		$listingLevelValue = $levelObj->getValues();
		if (!in_array($value, $listingLevelValue)) {
			header("Location: ".DEFAULT_URL."/sitemgr/content/index.php");
			exit;
		}
	}
	
	if (($section == "event" || $section == "event_advertise") && (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on")) {
		header("Location: ".DEFAULT_URL."/sitemgr/content/index.php");
		exit;
	} elseif ($section == "event") {
		$levelObj = new EventLevel();
		$eventLevelValue = $levelObj->getValues();
		if (!in_array($value, $eventLevelValue)) {
			header("Location: ".DEFAULT_URL."/sitemgr/content/index.php");
			exit;
		}
	}

	if (($section == "banner" || $section == "banner_advertise") && (BANNER_FEATURE != "on" || CUSTOM_BANNER_FEATURE != "on")) {
		header("Location: ".DEFAULT_URL."/sitemgr/content/index.php");
		exit;
	} elseif ($section == "banner" || $section == "banner_advertise") {
		$levelObj = new BannerLevel();
		$bannerLevelValue = $levelObj->getValues();
		if (!in_array($value, $bannerLevelValue)) {
			header("Location: ".DEFAULT_URL."/sitemgr/content/index.php");
			exit;
		}
	}

	if (($section == "classified" || $section == "classified_advertise") && (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on")) {
		header("Location: ".DEFAULT_URL."/sitemgr/content/index.php");
		exit;
	} elseif ($section == "classified") {
		$levelObj = new ClassifiedLevel();
		$classifiedLevelValue = $levelObj->getValues();
		if (!in_array($value, $classifiedLevelValue)) {
			header("Location: ".DEFAULT_URL."/sitemgr/content/index.php");
			exit;
		}
	}

	if (($section == "article" || $section == "article_advertise") && (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on")) {
		header("Location: ".DEFAULT_URL."/sitemgr/content/index.php");
		exit;
	} elseif ($section == "article" || $section == "article_advertise") {
		$levelObj = new ArticleLevel();
		$articleLevelValue = $levelObj->getValues();
		if (!in_array($value, $articleLevelValue)) {
			header("Location: ".DEFAULT_URL."/sitemgr/content/index.php");
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if (($_SERVER['REQUEST_METHOD'] == "POST") && (!DEMO_LIVE_MODE)) {	

		$contentObj = new Content();
		$contentObj->setString("content", $_POST["content_html"]);
		$contentObj->prepareToSave();
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

		$sql    = "SELECT * FROM ".string_ucwords($_section)."Level_Lang WHERE value = '$value' AND lang = '$clang' AND theme = '".EDIR_THEME."'";
		$result = $dbObj->query($sql);

		if (mysql_numrows($result) < 1) {
			$sql = "INSERT INTO ".string_ucwords($_section)."Level_Lang(value, lang, content) VALUES('$value','$clang', ".$contentObj->getString("content", false).")";
		} else {
			$sql = "UPDATE ".string_ucwords($_section)."Level_Lang SET content = ".$contentObj->getString("content", false)." WHERE value = '$value' AND lang = '$clang' AND theme = '".EDIR_THEME."'";
		}

		$dbObj->query($sql);
		unset($contentObj);

		if ($section == "banner" || $section == "banner_advertise") $message = 6;
		else $message = 7;
		
		header("Location:".DEFAULT_URL."/sitemgr/content/contentlevel.php?section=$section&value=$value&clang=$clang&message=$message");
		exit;
	}
	# ----------------------------------------------------------------------------------------------------
	# FORM DEFINES
	# ----------------------------------------------------------------------------------------------------
	if (!$clang) $clang = EDIR_DEFAULT_LANGUAGE;
	if ($_section == "listing") 	  $levelObj = new ListingLevel($clang);
	if ($_section == "event") 	  $levelObj = new EventLevel($clang);
	if ($_section == "banner") 	  $levelObj = new BannerLevel($clang);
	if ($_section == "classified") $levelObj = new ClassifiedLevel($clang);
	if ($_section == "article") 	  $levelObj = new ArticleLevel($clang);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<script type="text/javascript">
<!--
function changeComboLang (value) {
	if (value)
		window.location.href = "contentlevel.php?section=<?=$section?>&value=<?=$value?>&clang="+value;
	return true;
}

function JS_submit() {
	$("#submit_button").attr("value", 1);
	document.contentLevelForm.submit();
}
-->
</script>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT_MANAGECONTENT))?> <? if ($_section == "banner") echo "- ".system_showText(LANG_SITEMGR_LABEL_TYPE); else echo "- ".system_showText(LANG_SITEMGR_LEVEL); ?></h1>
		</div>
	</div>

	<div id="content-content">

		<?
		$contentlevelsection = $section;
		require(EDIRECTORY_ROOT."/sitemgr/registration.php");
		require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
		require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
		$section = $contentlevelsection;
		?>

		<form name="contentLevelForm" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
			
			<input name="clang" type="hidden" value="<?=$clang?>" />
			<input name="section" type="hidden" value="<?=$section?>" />
			<input name="value" type="hidden" value="<?=$value?>" />
			<input type="hidden" name="submit_button" id="submit_button" />

			<div class="default-margin">

				<ul class="list-view">
					<li><a href="<?=DEFAULT_URL?>/sitemgr/content/advertisement.php"><?=system_showText(LANG_SITEMGR_BACK)?></a></li>
				</ul>

				<br />

				<div id="header-export">
					<?
					echo string_ucwords(@constant('LANG_SITEMGR_'.string_strtoupper($_section)))." - ".$levelObj->showLevel($value);
					?>
				</div>

				<? if ($message) { ?>
					<p class="successMessage"><?=$msg_content[$message]?></p>
				<? } ?>

			</div>
			
			<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
				<tr>
					<th><?=system_showText(LANG_SITEMGR_LANGUAGE)?>:</th>
					<td>
					<?=language_writeComboLang('clang', $clang, 'changeComboLang(this.value)')?>
					</td>
				</tr>
				<tr>
					<th class="standard-tabletitle" colspan="2">
						<?=  string_ucwords(system_showText(LANG_SITEMGR_CONTENT));?>
					</th>
				</tr>
				<tr>
					<td colspan="2">
						<? 
							$contentObj = new Content();                            
							$contentObj->setString("content", $levelObj->getContent($value));
							$content = $contentObj->getString("content", false);
						?>
						<textarea id="content_html" name="content_html" rows="5" cols="1" ><?=strip_tags($content);?></textarea>
					</td>
				</tr>
			</table>			
			
			<table style="margin: 0 auto 0 auto;">
			<tr>
				<td>
					<button type="button" value="Save" class="input-button-form" style="width:100px;" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage('".system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2)."');" : "JS_submit();"?>"><?=system_showText(LANG_SITEMGR_SAVE)?></button>
				</td>
			</tr>
			</table>	

		</form>

	</div>

	<div id="bottom-content">&nbsp;</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
