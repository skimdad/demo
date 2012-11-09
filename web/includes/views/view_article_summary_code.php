<?
    /* ==================================================================*\
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
    \*================================================================== */

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /includes/views/view_article_summary_code.php
    # ----------------------------------------------------------------------------------------------------

?>

	<div id="article_summary_<?=$article->getNumber("id");?>" class="summary">

		<div class="share">
			<?=$icon_navbar;?>
		</div>

		<div class="full">
			
			<div class="title">

				<h3><?=$summaryTitle;?></h3>

				<p <?=($article->getNumber("id") ? "id=\"showCategory_".$article->getNumber("id")."\"" : "")?>>
					<?=$complementary_info?>
				</p>

			</div>
			
			<div class="image">
				
				<?=$summaryImage;?>
				
				<? if ($item_review){?>
					<div class="review">
						<?=$item_review;?>
					</div>
				<? } ?>
			</div>
			
			<? if ($summaryDescription){?>
				<p class="info"><?= $summaryDescription; ?></p>
			<? } ?>
			
		</div>
		
	</div>