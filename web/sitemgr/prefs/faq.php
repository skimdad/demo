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
    # * FILE: /sitemgr/prefs/faq.php
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
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    extract($_POST);
    extract($_GET);

	//increases frequently actions
	if (!isset($faq_question)) system_setFreqActions('prefs_faq','faq');
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if ($hiddenValue) {
            $id = intval($hiddenValue);
            $faqObj = new FAQ($id);
            $faqObj->Delete();
			$message = system_showText(LANG_SITEMGR_SETTINGS_MSG_DELETE_SUCCESS);
        } else {
			if ($FAQ_post_submit) {

				if ( validate_form("faq", $_POST, $error) ) {

					$faqObj = new FAQ();

					if ($faq_section_front == "on") {
						$faqObj->setString("frontend", "y");
					}
					if ($faq_section_members == "on") {
						$faqObj->setString("member", "y");
					}
					if ($faq_section_sitemgr == "on") {
						$faqObj->setString("sitemgr", "y");
					}

					$faqObj->setString("question", $faq_question);
					$faqObj->setString("answer", $faq_answer);
					$faqObj->Save();
					header("Location: ".DEFAULT_URL."/sitemgr/prefs/faq.php?stat=0");
					exit;
				} else {
					header("Location: ".DEFAULT_URL."/sitemgr/prefs/faq.php?stat=".$error);
					exit;
				}

			} else if ($FAQ_edit_submit) {

				$faqObj = new FAQ($faq_id);

				($faq_section_front_edit) ? $faqObj->setString("frontend", "y") : $faqObj->setString("frontend", "n");
				($faq_section_members_edit) ? $faqObj->setString("member", "y") : $faqObj->setString("member", "n");
				($faq_section_sitemgr_edit) ? $faqObj->setString("sitemgr", "y") : $faqObj->setString("sitemgr", "n");

				$faqObj->setString("question", $faq_question_edit);
				$faqObj->setString("answer", $faq_answer_edit);
				$faqObj->Save();
				$message = system_showText(LANG_SITEMGR_SETTINGS_MSG_SAVE_SUCCESS);

			}
		}
	} else {
		$error = false;
		if ($_GET["stat"] == "0") {
			$message = system_showText(LANG_SITEMGR_SETTINGS_MSG_SAVE_SUCCESS);
		} else {
			$error = true;
			if ($_GET["stat"] == "1") $message = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_MSGERROR_QUESTION);
			if ($_GET["stat"] == "2") $message = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_MSGERROR_ANSWER);
		}
	}

	 # ----------------------------------------------------------------------------------------------------
    // Page Browsing /////////////////////////////////////////

	$pageObj  = new pageBrowsing("FAQ", $screen, RESULTS_PER_PAGE, "id", "question", $letter,"editable='y'","*",false,false,true);
	$faqs = $pageObj->retrievePage("array");

	$paging_url = DEFAULT_URL."/sitemgr/prefs/faq.php";

	// Letters Menu
	$letters = $pageObj->getString("letters");
	foreach($letters as $each_letter){
		if($each_letter == "#") {
			$letters_menu .= "<a href=\"$paging_url?letter=no\" ".(($letter == "no") ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
			//$letters_menu .= "<a href=\"$paging_url\" ".((!$letter) ? "class=\"firstLetter\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		} else {
			$letters_menu .= "<a href=\"$paging_url?letter=".$each_letter."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		}
	}


	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");

    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/header.php");

    # ----------------------------------------------------------------------------------------------------
    # NAVBAR
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
    
?>

    <?# ----------------------------------------------------------------------------------------------------
    # NEW FAQ FORM
    # ----------------------------------------------------------------------------------------------------?>
    <div id="main-right">

        <div id="top-content">
            <div id="header-content">
                <h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_FAQ_NAME)?></h1>
            </div>
        </div>

		<div id="content-content">

			<div id="table_faq" class="default-margin">
                
                <? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
                <? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
                <? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
                
				<? include(INCLUDES_DIR."/tables/table_faqsettings_submenu.php"); ?>
			</div>

			<div id="new_faq" class="default-margin" style="display:none">
                <form name="FAQ_post" id="FAQ_post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                	<input type="hidden" name="hiddenValue">
                </form>
                <br />
            </div>
			
			<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
			<? if($message) { ?>
				<p class="<?=($error) ? "errorMessage" : "successMessage"?>"><?=$message?></p>
			<? } ?>

			<div id="table_faq" class="default-margin">
				<? include(INCLUDES_DIR."/tables/table_faq.php"); ?>
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

<script type="text/javascript">

    $('document').ready(function() {
        
        $('button[name=FAQ_post_submit]').bind('click', function() {
                
            $('#jMessage').css('display', 'none');
            $('#jMessage').empty();
            
            if ($('#faq_question').val() == '') {
                $('#jMessage').append("&#149;&nbsp;<?=system_showText(LANG_SITEMGR_SETTINGS_MSGERROR_QUESTION)?><br />");
            }
            if ($('#faq_answer').val() == '') {
                $('#jMessage').append("&#149;&nbsp;<?=system_showText(LANG_SITEMGR_SETTINGS_MSGERROR_ANSWER)?>");
            }
            if ($('#jMessage').text() != '') {
                $('#jMessage').css('display', '');
                return false;
            } else {
                return true;
            }
        
        });
        
        $('button[name=FAQ_edit_submit]').bind('click', function() {
            
            $('#jMessageEdit'+thisId).css('display', 'none');
            $('#jMessageEdit'+thisId).empty();
            
            if ($('#faq_question_edit'+thisId).val() == '') {
                $('#jMessageEdit'+thisId).append("&#149;&nbsp;<?=system_showText(LANG_SITEMGR_SETTINGS_MSGERROR_QUESTION)?><br />");
            }
            if ($('#faq_answer_edit'+thisId).val() == '') {
                $('#jMessageEdit'+thisId).append("&#149;&nbsp;<?=system_showText(LANG_SITEMGR_SETTINGS_MSGERROR_ANSWER)?>");
            }
            if ($('#jMessageEdit'+thisId).text() != '') {
                $('#jMessageEdit'+thisId).css('display', '');
                return false;
            } else {
                return true;
            }
        
        });    
    
    });

</script>