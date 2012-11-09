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
	# * FILE: /sitemgr/content/content.php
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
	# CODE
	# ----------------------------------------------------------------------------------------------------

	extract($_GET);
	extract($_POST);
	
	if ($id) {
		
		// getting the section and type from Content table
		$auxContent = new Content($id);

		if (($auxContent->getString("section") == "article") || ($auxContent->getString("section") == "advertise_article")){
			if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on"){
				header("Location: ".DEFAULT_URL."/sitemgr/");
				exit;
			}
		}
		if (($auxContent->getString("section") == "event") || ($auxContent->getString("section") == "advertise_event")){
			if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on"){
				header("Location: ".DEFAULT_URL."/sitemgr/");
				exit;
			}
		}
		if (($auxContent->getString("section") == "classified") || ($auxContent->getString("section") == "advertise_classified")){
			if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on"){
				header("Location: ".DEFAULT_URL."/sitemgr/");
				exit;
			}
		}

		$clang = $clang ? $clang : EDIR_DEFAULT_LANGUAGE;
		$contentObj = new Content($_REQUEST["id"], $clang);
		if (($_SERVER['REQUEST_METHOD'] == "POST") && (!DEMO_LIVE_MODE)) {
			
            $description = str_replace('"', '', $_POST["description"]);
            $keywords = str_replace('"', '', $_POST["keywords"]);
            
            $contentObj->setString("title", trim($title));
			$contentObj->setString("description", trim($description));
			$contentObj->setString("keywords", trim($keywords));
			$contentObj->setString("content", $content_html);
			$contentObj->Save();
            $id = $contentObj->getNumber("id");
			$message = 0;
            
			header("Location:".DEFAULT_URL."/sitemgr/content/content.php?id=$id&clang=$clang&message=$message");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/sitemgr/content/");
		exit;
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

<script type="text/javascript">
<!--

function JS_submit() {
	$("#submit_button").attr("value", 1);
	document.content.submit();
}

-->
</script>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT_MANAGECONTENT))?></h1>
		</div>
	</div>

	<div id="content-content">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>


		<form name="content" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

			<input name="id" type="hidden" value="<?=$id?>" />

			<div class="default-margin">

				<ul class="list-view">
					<?
					$backPage = "index.php";
					if ($auxContent->getString("section") != "general" && string_strpos($auxContent->getString("section"), 'advertise_') === false) $backPage = $auxContent->getString("section").".php";
					else if (string_strpos($auxContent->getString("section"), 'advertise_') !== false) $backPage = "advertisement.php";
					?>
					<li><a href="<?=DEFAULT_URL?>/sitemgr/content/<?=$backPage?>"><?=system_showText(LANG_SITEMGR_BACK)?></a></li>
				</ul>

				<br />

				<div id="header-export">
					<?=$auxContent->type?>
				</div>

				<? if(is_numeric($message)) { ?>
                    <p class="successMessage"><?=$msg_content[$message]?></p>
                <? } ?>

			</div>

			<table cellpadding="0" cellspacing="0" border="0" class="standard-table">

				<? 
				if ((($auxContent->getString("section") == "general") || ($auxContent->getString("section") == "listing") || 
				($auxContent->getString("section") == "event") || ($auxContent->getString("section") == "classified") || 
				($auxContent->getString("section") == "article") || ($auxContent->getString("section") == "banner")
				|| ($auxContent->getString("section") == "promotion")|| ($auxContent->getString("section") == "member")
				|| (string_strpos($auxContent->getString("section"), "advertise_") !== false))) {
					?>
					<tr>
						<th><?=system_showText(LANG_SITEMGR_LANGUAGE)?>:</th>
						<td><?=language_writeComboLang('clang', $clang, 'changeComboLang(this.value)')?></td>
					</tr>
					<?
				}
				?>

				<? if ((($auxContent->getString("section") == "general") || (string_strpos($auxContent->type, "Advertisement") === false)) 
				&& (string_strpos($auxContent->type, "Bottom") === false) && ($auxContent->getString("section") != "member") && (string_strpos($auxContent->type,"Packages") === false )) { ?>
					<tr>
						<th colspan="2" class="standard-tabletitle">
							<?=system_showText(LANG_SITEMGR_CONTENT_SEOCENTER)?>
						</th>
					</tr>
					<tr>
						<th><?=system_showText(LANG_SITEMGR_TITLE)?>:</th>
						<td><input type="text" name="title" value="<?=$contentObj->title?>" maxlength="100" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_SITEMGR_LABEL_DESCRIPTION)?>:</th>
						<td>
							<textarea id="description" name="description" rows="5"><?=$contentObj->description?></textarea>
							<div id="textAreaCallback_1"></div>

						</td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_SITEMGR_LABEL_KEYWORDS)?>:</th>
						<td>
							<textarea id="keywords" name="keywords" rows="5"><?=$contentObj->keywords?></textarea>
							<div id="textAreaCallback_2"></div>
						</td>
					</tr>
				<? } ?>

			</table>

			<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
				<tr>
					<th colspan="2" class="standard-tabletitle">
						<?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT))?>
					</th>
				</tr>
			</table>
			
            <div class="multilanguageContent">
                <table width="650" class="standard-table">
                    <tr>
                        <td colspan="2" class="standard-tablenote">
                            <p class="warning"><strong><?=system_showText(LANG_SITEMGR_LABEL_NOTE)?>1:</strong>&nbsp;<?=system_showText(LANG_SITEMGR_ADDING_HIPERLINK_EDITOR)?></p>
                            <p class="warning"><strong><?=system_showText(LANG_SITEMGR_LABEL_NOTE)?>2:</strong>&nbsp;<?=system_showText(LANG_SITEMGR_ADDING_EMBED_EDITOR)?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="packageEditor" colspan="2">
                            <? // TinyMCE Editor Init
								// getting language
								$pos = string_strpos(EDIR_LANGUAGE, "_");
								$editorLang = string_substr(EDIR_LANGUAGE, 0, $pos);
								// getting content
								$content = $contentObj->getString("content", false);
								//fix ie bug with images
								if (!$content) $content = "&nbsp;".$content;
                                // calling TinyMCE
                                system_addTinyMCE($editorLang, "exact", "advanced", "content_html", "30", "25", "650", $content);
    
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

			<table style="margin: 0 auto 0 auto;">
				<tr>
					<td><button type="button" name="Save" value="Save" class="input-button-form" style="width:100px;" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage('".system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2)."');" : "JS_submit();"?>"><?=system_showText(LANG_SITEMGR_SAVE)?></button></td>
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

<script type="text/javascript">
	
	var arrFields = ('description,keywords').split(',');
	
	$(document).ready(function(){
		
		for (j=0;j<arrFields.length;j++) {
			i = arrFields[j];
			var field_name = i;
			var count_field_name = 'remLen'+i;

			var options = {
						'maxCharacterSize': 250,
						'originalStyle': 'originalTextareaInfo',
						'warningStyle' : 'warningTextareaInfo',
						'warningNumber': 40,
						'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name+'" name="'+count_field_name+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
				};
			$('#'+field_name).textareaCount(options);

		}
		
	});
	
	function changeComboLang (value) {
		if (value)
			window.location.href = "content.php?id=<?=$id?>&clang="+value;
		return true;
	}
</script>