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
	# * FILE: /blog/results_blog.php
	# ----------------------------------------------------------------------------------------------------

	if($show_results){

		if (!$posts) {
			if ($search_lock) {?>
				<p class="errorMessage">
					<?=system_showText(LANG_MSG_LEASTONEPARAMETER)?>
				</p>
				<?
			} else {
				$db = db_getDBObject();
				if ($db->getRowCount("Post") > 0) { ?>
					<div class="resultsMessage">
						<?//=system_showText(LANG_MSG_NORESULTS);?>
						<?//=system_showText(LANG_MSG_TRYAGAIN);?>
                        
                        <?
                        unset($aux_lang_msg_noresults);                        
                        $aux_lang_msg_noresults = str_replace("[EDIR_LINK_SEARCH_ERROR]",DEFAULT_URL."/contactus.php", LANG_SEARCH_NORESULTS);
                        echo $aux_lang_msg_noresults;
                        ?>
					</div>
					<?
                    /*
					if ($keyword) {
						?>
						<p class="informationMessage">
							<?=system_showText(LANG_MSG_USE_SPECIFIC_KEYWORD);?>
						</p>
						<?
					}
                     * 
                     */
				} else {
					?>
					<p class="informationMessage">
						<?=system_showText(LANG_MSG_NOBLOGS);?>
					</p>
					<?
				}
			}
		} elseif ($posts){
			$count = 10;

			foreach ($posts as $post) {
				
				include(BLOG_EDIRECTORY_ROOT."/prepare_blog_content.php");
				
				include(BLOG_INCLUDES_DIR."/views/icon_post.php");
				
				$summaryFileName = BLOG_INCLUDES_DIR."/views/view_post_summary.php";
                $themesummaryFileName = BLOG_INCLUDES_DIR."/views/view_post_summary_".EDIR_THEME.".php";

                if (file_exists($themesummaryFileName)){
                    include($themesummaryFileName);
                } else {
                    include($summaryFileName);
                }
				$count--;
			}

			$replace_id = true;
		}
	}
?>