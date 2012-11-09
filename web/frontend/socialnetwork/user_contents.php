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
	# * FILE: /frontend/socialnetwork/user_contents.php
	# ----------------------------------------------------------------------------------------------------
	if ($pag_content == "reviews") {
		?>
        <div id="reviews" class="default-margin" style="display:none">
            <form name="reviews_post" id="reviews_post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                <input type="hidden" name="hiddenValue" />
            </form>
        </div>
		<div class="content-profile featured featured-review">
			<? $members = "profile"; ?>
			<? $profile_review = true; ?>
			<? unset($searchResults); ?>
			<form name="account" id="account" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<input type="hidden" name="hiddenValue" value="" />
			</form>
			<? include(system_getFrontendPath("socialnetwork/featured_review.php")); ?>
		</div>
		<? 
	} else if ($pag_content == "favorites") {
		?>
		<div class="content-profile">
			<? $members = "profile"; ?>
			<? unset($searchResults); ?>
			<? include(system_getFrontendPath("socialnetwork/favoritescontent.php")); ?>
		</div>
		<? 
	} else if ($pag_content == "deals") {
		?>
		<div class="content-profile">
			<? $members = "profile"; ?>
			<? unset($searchResults); ?>
			<? include(system_getFrontendPath("socialnetwork/dealscontent.php")); ?>
		</div>
		<?
	}
	?>