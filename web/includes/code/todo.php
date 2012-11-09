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
	# * FILE: /includes/code/todo.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$todo = "n";
	$review_todo = "n";

	if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) {
		if ($status["l_pending"] > 0) {
			$todo = "y";
			$review_todo = "y";
		}
	}

	if (permission_hasSMPermSection(SITEMGR_PERMISSION_EVENTS)) {
		if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
			if ($status["e_pending"] > 0) {
				$todo = "y";
				$review_todo = "y";
			}
		}
	}

	if (permission_hasSMPermSection(SITEMGR_PERMISSION_BANNERS)) {
		if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {
			if ($status["b_pending"] > 0) {
				$todo = "y";
				$review_todo = "y";
			}
		}
	}

	if (permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS)) {
		if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
			if ($status["c_pending"] > 0) {
				$todo = "y";
				$review_todo = "y";
			}
		}
	}

	if (permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES)) {
		if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
			if ($status["a_pending"] > 0) {
				$todo = "y";
				$review_todo = "y";
			}
		}
	}

	if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) {
		if ($status["lr_pending"] > 0) {
			$todo = "y";
			$review_todo = "y";
		}
	}

	if (permission_hasSMPermSection(SITEMGR_PERMISSION_PROMOTIONS)) {
        if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on") {
            if ($status["pr_pending"] > 0) {
                $todo = "y";
                $review_todo = "y";
            }
        }
	}

	if (permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES)) {
        if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
            if ($status["ar_pending"] > 0) {
                $todo = "y";
                $review_todo = "y";
            }
        }
	}

	if (permission_hasSMPermSection(SITEMGR_PERMISSION_BLOG)) {
        if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") {
            if ($status["cr_pending"] > 0) {
                $todo = "y";
                $review_todo = "y";
            }
        }
	}

	if (permission_hasSMPermSection(SITEMGR_PERMISSION_PAYMENT)) {
		if (PAYMENT_FEATURE == "on") {
			if (CREDITCARDPAYMENT_FEATURE == "on" || INVOICEPAYMENT_FEATURE == "on") {
				if (CUSTOM_INVOICE_FEATURE == "on") {
					if ($status["custominvoice_pending"] > 0) {
						$todo = "y";
						$review_todo = "y";
					}
				}
			}
		}
	}
	if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) {
		if (CLAIM_FEATURE == "on") {
			if ($status["claim_complete"] > 0) {
				$todo = "y";
				$review_todo = "y";
			}
		}
	}

?>

<? if ($todo == "y") { ?>
	<div class="toBeApproved">
	
		<h2><?=system_showText(LANG_SITEMGR_TOBEAPPROVED)?></h2>

		<form name="doneForm" id="doneForm" action="<?=DEFAULT_URL?>/sitemgr/index.php" method="post" style="margin: 0; padding: 0;">


			<? if ($review_todo == "y") { ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) {?>
						<? if ($status["l_pending"] > 0) { ?>
							<p><a href="<?=DEFAULT_URL?>/sitemgr/<?=LISTING_FEATURE_FOLDER;?>/search.php?search_submit=Search&search_status=P">
							<?=$status["l_pending"]?> <?=($status["l_pending"]==1? system_showText(LANG_SITEMGR_LISTING) : system_showText(LANG_SITEMGR_LISTING_PLURAL) )?> </a> <?=system_showText(LANG_SITEMGR_TODO_REVIEWANDACTIVATE)?></p>
						<? } ?>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_EVENTS)) { ?>
						<? if ((EVENT_FEATURE == "on") && CUSTOM_EVENT_FEATURE == "on" && ($status["e_pending"] > 0)) { ?>
							<p><a href="<?=DEFAULT_URL?>/sitemgr/<?=EVENT_FEATURE_FOLDER;?>/search.php?search_submit=Search&search_status=P"> <?=$status["e_pending"]?> <?=($status["e_pending"]==1? system_showText(LANG_SITEMGR_EVENT) : system_showText(LANG_SITEMGR_EVENT_PLURAL) )?> </a> <?=system_showText(LANG_SITEMGR_TODO_REVIEWANDACTIVATE)?></p>
						<? } ?>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BANNERS)) { ?>
						<? if ((BANNER_FEATURE == "on") && CUSTOM_BANNER_FEATURE == "on" && ($status["b_pending"] > 0)) { ?>
							<p><a href="<?=DEFAULT_URL?>/sitemgr/<?=BANNER_FEATURE_FOLDER;?>/search.php?search_submit=Search&search_status=P"> <?=$status["b_pending"]?> <?=($status["b_pending"]==1? system_showText(LANG_SITEMGR_BANNER) : system_showText(LANG_SITEMGR_BANNER_PLURAL) )?> </a> <?=system_showText(LANG_SITEMGR_TODO_REVIEWANDACTIVATE)?></p>
						<? } ?>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS)) { ?>
						<? if ((CLASSIFIED_FEATURE == "on") && CUSTOM_CLASSIFIED_FEATURE == "on" && ($status["c_pending"] > 0)) { ?>
							<p><a href="<?=DEFAULT_URL?>/sitemgr/<?=CLASSIFIED_FEATURE_FOLDER;?>/search.php?search_submit=Search&search_status=P"><?=$status["c_pending"]?> <?=($status["c_pending"]==1? system_showText(LANG_SITEMGR_CLASSIFIED) : system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL) )?> </a> <?=system_showText(LANG_SITEMGR_TODO_REVIEWANDACTIVATE)?></p>
						<? } ?>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES)) { ?>
						<? if ((ARTICLE_FEATURE == "on") && CUSTOM_ARTICLE_FEATURE == "on" && ($status["a_pending"] > 0)) { ?>
							<p><a href="<?=DEFAULT_URL?>/sitemgr/<?=ARTICLE_FEATURE_FOLDER;?>/search.php?search_submit=Search&search_status=P"> <?=$status["a_pending"]?> <?=($status["a_pending"]==1? system_showText(LANG_SITEMGR_ARTICLE) : system_showText(LANG_SITEMGR_ARTICLE_PLURAL) )?> </a> <?=system_showText(LANG_SITEMGR_TODO_REVIEWANDACTIVATE)?></p>
						<? } ?>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) {?>
						<? if ($status["lr_pending"] > 0) { ?>
							<p><a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=listing"> <?=$status["lr_pending"]?> <?=$status["lr_pending"]==1? system_showText(LANG_SITEMGR_LISTING_REVIEW): system_showText(LANG_SITEMGR_LISTING_REVIEW_PLURAL);?> </a> <?=system_showText(LANG_SITEMGR_TODO_REVIEWANDACTIVATE)?></p>
						<? } ?>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
						<? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on") { ?>
							<? if ($status["pr_pending"] > 0) { ?>
								<p><a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=promotion"> <?=$status["pr_pending"]?> <?=$status["pr_pending"]==1? system_showText(LANG_SITEMGR_DEAL_REVIEW): system_showText(LANG_SITEMGR_DEAL_REVIEW_PLURAL);?> </a> <?=system_showText(LANG_SITEMGR_TODO_REVIEWANDACTIVATE)?></p>
							<? } ?>
						<? } ?>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES)) { ?>
						<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
							<? if ($status["ar_pending"] > 0) { ?>
								<p><a href="<?=DEFAULT_URL?>/sitemgr/review/index.php?item_type=article"> <?=$status["ar_pending"]?> <?=$status["ar_pending"]==1? system_showText(LANG_SITEMGR_ARTICLE_REVIEW): system_showText(LANG_SITEMGR_ARTICLE_REVIEW_PLURAL);?> </a> <?=system_showText(LANG_SITEMGR_TODO_REVIEWANDACTIVATE)?></p>
							<? } ?>
						<? } ?>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BLOG)) { ?>
						<? if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") { ?>
							<? if ($status["cr_pending"] > 0) { ?>
								<p><a href="<?=BLOG_DEFAULT_URL?>/sitemgr/<?=BLOG_FEATURE_FOLDER;?>/comments/index.php"> <?=$status["cr_pending"]?> <?=($status["cr_pending"]==1? system_showText(string_strtolower(LANG_SITEMGR_COMMENT))." / ".system_showText(string_strtolower(LANG_SITEMGR_REPLY)) : system_showText(string_strtolower(LANG_SITEMGR_COMMENT_PLURAL))." / ".system_showText(string_strtolower(LANG_SITEMGR_REPLYS)))?> </a> <?=system_showText(LANG_SITEMGR_TODO_REVIEWANDACTIVATE)?></p>
							<? } ?>
						<? } ?>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PAYMENT)) { ?>
						<?
						if (PAYMENT_FEATURE == "on") {
							if (CREDITCARDPAYMENT_FEATURE == "on" || INVOICEPAYMENT_FEATURE == "on") {
								if (CUSTOM_INVOICE_FEATURE == "on") {
									if ($status["custominvoice_pending"] > 0) {
										?>
								<p><a href="<?=DEFAULT_URL?>/sitemgr/custominvoices/search.php?search_submit=Search&search_status=pending"> <?=$status["custominvoice_pending"]?> <?=($status["custominvoice_pending"]==1 ? system_showText(LANG_SITEMGR_CUSTOMINVOICE) : system_showText(LANG_SITEMGR_CUSTOMINVOICE_PLURAL))?> </a> <?=$status["custominvoice_pending"]==1 ? system_showText(LANG_SITEMGR_TODO_TOBESENT): system_showText(LANG_SITEMGR_TODO_TOBESENT_PLURAL);?></p>
										<?
									}
								}
							}
						}
						?>
					<? } ?>

					<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
						<? if ((CLAIM_FEATURE == "on") && ($status["claim_complete"] > 0)) { ?>
							<p><a href="<?=DEFAULT_URL?>/sitemgr/claim/search.php?search_submit=Search&search_status=complete"> <?=$status["claim_complete"]?> <?=($status["claim_complete"]==1 ? system_showText(LANG_SITEMGR_TODO_CLAIMREVIEW1) : system_showText(LANG_SITEMGR_TODO_CLAIMREVIEW1_PLURAL) )?></a> <?=system_showText(LANG_SITEMGR_TODO_CLAIMREVIEW2)?> </p>
						<? } ?>
					<? } ?>
				<? } ?>		
			<input type="hidden" name="hiddenValue"/>

		</form>

		<br />
	</div>

<? } ?>