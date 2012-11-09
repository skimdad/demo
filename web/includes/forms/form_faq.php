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
	# * FILE: /includes/form/form_faq.php
	# ----------------------------------------------------------------------------------------------------

	?>	
	<script type="text/javascript">
		function showAnswer(answer) {
			$(document).ready(function(){
				if ($('#'+answer).css('display')=='none') 
					$('#'+answer).slideDown(400);					
				else
					$('#'+answer).slideUp(400);
			});
		}
	</script>

	<div class="content-faq">
	
		<? if (!string_strpos($_SERVER["PHP_SELF"], "sitemgr")) { ?>
	
			<div class="search">
				<form name="faq" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get">
					<input type="text" name="keyword" id="keyword" value="<?=$keyword;?>" />
					<button type="submit"><?=system_showText(LANG_BUTTON_SEARCH);?></button>
				</form>
			</div>
	
		<? } ?>
	
		<? if ($faq_front) { ?>
				<h2>
					<?=system_showText(LANG_FAQ_NAME);?>
					<span><a href="<?=DEFAULT_URL?>/contactus.php"><?=system_showText(LANG_FAQ_CONTACT);?></a></span>			
				</h2>
		<? } ?>
	
		<? 
	
		if (!(string_strpos($_SERVER["PHP_SELF"], "search.php") && !isset($keyword))) {
			
            include(INCLUDES_DIR."/tables/table_paging.php");
	
			if ($faqs) {
				$i = 0;
				echo "<div class=\"faqAnswers\">";
				foreach ($faqs as $faq) {
					echo "<div>";
					echo "<h3 class=\"standardSubTitle\"><a href=\"javascript:void(0);\" onclick=\"showAnswer('answer".$i."');\">".$faq["question"]."</a></h3>";
					echo "<p id=\"answer".$i."\" style=\"display:none\">".trim(str_replace('"','',$faq["answer"]))."</p>";
					echo "</div>";
					$i++;
				}
				echo "</div>";
			} else {
				echo "<p class=\"errorMessage\">".system_showText(LANG_MSG_NO_RESULTS_FOUND)."</p>";
			}
		}
		?>	
	
	</div>
