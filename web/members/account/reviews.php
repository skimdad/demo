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
	# * FILE: /members/account/reviews.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();


	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	setting_get('commenting_edir', $commenting_edir);
	setting_get('review_listing_enabled', $review_enabled);
	setting_get('review_article_enabled', $review_article_enabled);
	setting_get('review_promotion_enabled', $review_promotion_enabled);
	
	if (($review_enabled != "on" && $review_article_enabled != "on" && $review_promotion_enabled != "on") || !$commenting_edir){
		header("Location: ".DEFAULT_URL."/members/account/account.php");
		exit;
	}

	// required because of the cookie var
	$username = "";

	// Default CSS class for message box
	$message_style = "errorMessage";

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($_POST["hiddenValue"]) {
			$reviewObj = new Review($_POST["hiddenValue"]);

			$item_type = $reviewObj->getString("item_type");
			$item_id = $reviewObj->getNumber("item_id");

			$reviewObj->Delete();

			$avg = $reviewObj->getRateAvgByItem($item_type, $item_id);
			if (!is_numeric($avg)) $avg = 0;

			if ($item_type == "listing") {
				$listing = new Listing();
				$listing->setAvgReview($avg, $item_id);
			} elseif ($item_type == "article") {
				$articles = new Article();
				$articles->setAvgReview($avg, $item_id);
			} elseif ($item_type == "promotion"){
                $promotions = new Promotion();
				$promotions->setAvgReview($avg, $item_id);
            }
			
			$message = system_showText(LANG_MSG_REVIEW_SUCCESS_DELETED);
			$message_style = "successMessage";
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

	$levelObj = new ListingLevel();

?>

	<div class="content">

		<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? if (SOCIALNETWORK_FEATURE == "on") { ?>
			<h2><?=system_showText(LANG_LABEL_ACCOUNT_INFORMATION)?></h2>
		<? } else { ?>
			<h2><?=system_showText(LANG_LABEL_ACCOUNT_AND_CONTACT_INFO)?></h2>
		<? } ?>

		<?
		$contentObj = new Content("", EDIR_LANGUAGE);
		$content = $contentObj->retrieveContentByType("Manage Account");
		if ($content) {
			echo "<blockquote>";
				echo "<div class=\"dynamicContent\">".$content."</div>";
			echo "</blockquote>";
		}
		?>

		<table cellpadding="0" cellspacing="0" border="0" class="standard-table tabsTable">
			<tr>
				<th class="tabsBase">
					<ul class="tabs">
						<? if (SOCIALNETWORK_FEATURE == "on") { ?>
                            <li id="tab_1">
                                <a href="<?=DEFAULT_URL;?>/members/account/account.php?type=tab_1"><?=system_showText(LANG_LABEL_PERSONAL_PAGE)?></a>
                            </li>
						<? } ?>
						<li id="tab_2">
							<a href="<?=DEFAULT_URL;?>/members/account/account.php?type=tab_2"><?=system_showText(LANG_LABEL_ACCOUNT_SETTINGS)?></a>
						</li>
						<? if(($review_enabled == "on" || $review_article_enabled == "on" || $review_promotion_enabled == "on") && $commenting_edir) { ?>
							<li id="tab_3" class="tabActived">
								<a href="javascript:void(0);"><?=system_showText(LANG_REVIEW_PLURAL)?></a>
							</li>
						<? } ?>
						<li id="tab_4">
							<a href="<?=DEFAULT_URL;?>/members/account/quicklists.php"><?=system_showText(LANG_LABEL_QUICKLIST)?></a>
						</li>
						<li id="tab_5">
							<a href="<?=DEFAULT_URL;?>/members/account/deals.php"><?=system_showText(LANG_LABEL_ACCOUNT_DEALS)?></a>
						</li>
					</ul>
				</th>
			</tr>
		</table>

		<div class="content-profile featured featured-review">
            <div id="reviews" class="default-margin" style="display:none">
                <form name="reviews_post" id="reviews_post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                	<input type="hidden" name="hiddenValue" />
                </form>
            </div>
			<? $members = "members"; ?>
			<? $profile_review = true; ?>
			<? include(system_getFrontendPath("socialnetwork/featured_review.php")); ?>
		</div>
		<?
		$contentObj = new Content("", EDIR_LANGUAGE);
		$content = $contentObj->retrieveContentByType("Manage Account Bottom");
		if ($content) {
			echo "<blockquote>";
				echo "<div class=\"dynamicContent\">".$content."</div>";
			echo "</blockquote>";
		}
		?>

	</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>

<script language="javascript" type="text/javascript">

	function redirect (url) {
		window.location = url;
	}

	function changePageProfile(url, page, moderewrite) {
		redirect(url + "?screen=" + page);
	}
	$('document').ready(function() {
		$('#results_per_page').removeAttr('disabled');
		$('#results_per_page').change(function(){
			$.cookie('profilereviews_per_page', $('#results_per_page').val(), {path: '<?=EDIRECTORY_FOLDER?>/'}); 
			$(location).attr('href','<?=$_SERVER["REQUEST_URI"]?>');
		});
	});
</script>