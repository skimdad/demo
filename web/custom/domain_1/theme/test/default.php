<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# edirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- edirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	$scheme_path = (EDIR_SCHEME != "custom" ? EDIR_SCHEME : "test");

?>

<? if ($aux_modal_box != "profileLogin"){ ?>
<link href="<?=THEMEFILE_URL;?>/test/structure.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=THEMEFILE_URL;?>/test/schemes/<?=$scheme_path?>/structure.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (string_strpos($_SERVER["PHP_SELF"], "/deal") !== false){ ?>
<link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/countdown/jquery.countdown.css" type="text/css" />
<? } ?>

<? if ((string_strpos($_SERVER['PHP_SELF'], "/".MEMBERS_ALIAS) !== false) && ((string_strpos($_SERVER['PHP_SELF'], "preview.php") === false) || (string_strpos($_SERVER['PHP_SELF'], "invoice.php") === false)) || $loadMembersCss) { ?>
<link href="<?=THEMEFILE_URL;?>/test/members.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=THEMEFILE_URL;?>/test/schemes/<?=$scheme_path?>/members.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((string_strpos($_SERVER['PHP_SELF'], "profile/add.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], "profile/edit.php") !== false)) { ?>
<link href="<?=THEMEFILE_URL;?>/test/members.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=THEMEFILE_URL;?>/test/schemes/<?=$scheme_path?>/members.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((string_strpos($_SERVER['PHP_SELF'], "popup.php") !== false)) { ?>
<link href="<?=THEMEFILE_URL;?>/test/popup.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=THEMEFILE_URL;?>/test/schemes/<?=$scheme_path?>/popup.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((string_strpos($_SERVER['PHP_SELF'], LISTING_FEATURE_FOLDER."/index.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], EVENT_FEATURE_FOLDER."/index.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], CLASSIFIED_FEATURE_FOLDER."/index.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], ARTICLE_FEATURE_FOLDER."/index.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], PROMOTION_FEATURE_FOLDER."/index.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], "/alllocations") !== false) || (string_strpos($_SERVER['PHP_SELF'], "/allcategories") !== false) || (string_strpos($_SERVER['PHP_SELF'], "/alltemplates") !== false)) { ?>
<link href="<?=THEMEFILE_URL;?>/test/front.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=THEMEFILE_URL;?>/test/schemes/<?=$scheme_path?>/front.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (string_strpos($_SERVER['PHP_SELF'], BLOG_FEATURE_FOLDER."/index.php") !== false || (string_strpos($_SERVER['PHP_SELF'], BLOG_FEATURE_FOLDER."/results.php") !== false) || string_strpos($_SERVER['PHP_SELF'], BLOG_FEATURE_FOLDER."/detail.php") !== false || string_strpos($_SERVER['PHP_SELF'], BLOG_FEATURE_FOLDER."/sitemgr/blog/preview.php") !== false){ ?>
<link href="<?=THEMEFILE_URL;?>/test/blog.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=THEMEFILE_URL;?>/test/schemes/<?=$scheme_path?>/blog.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (string_strpos($_SERVER['PHP_SELF'], BLOG_FEATURE_FOLDER."/sitemgr/blog/preview.php") !== false){ ?>
<link href="<?=THEMEFILE_URL;?>/test/advertise.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=THEMEFILE_URL;?>/test/schemes/<?=$scheme_path?>/advertise.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((string_strpos($_SERVER['PHP_SELF'], "order_listing.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], "order_event.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], "order_classified.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], "order_article.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], "order_banner.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], "claim.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], "members/claim/") !== false)) { ?>
<link href="<?=THEMEFILE_URL;?>/test/order.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=THEMEFILE_URL;?>/test/schemes/<?=$scheme_path?>/order.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if (((string_strpos($_SERVER['PHP_SELF'], "favorites") !== false) || (string_strpos($_SERVER['PHP_SELF'], "results.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], "quicklists.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], "comment") !== false) || (string_strpos($_SERVER['PHP_SELF'], "claim.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], "profile/index.php") !== false)) && (!string_strpos($_SERVER['PHP_SELF'], BLOG_FEATURE_FOLDER) !== false)) { ?>
<link href="<?=THEMEFILE_URL;?>/test/results.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=THEMEFILE_URL;?>/test/schemes/<?=$scheme_path?>/results.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((string_strpos($_SERVER['PHP_SELF'], "detail.php") !== false) && (!string_strpos($_SERVER['PHP_SELF'], BLOG_FEATURE_FOLDER."/detail.php") !== false)) { ?>
<link href="<?=THEMEFILE_URL;?>/test/detail.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=THEMEFILE_URL;?>/test/schemes/<?=$scheme_path?>/detail.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((string_strpos($_SERVER['PHP_SELF'], "advertise.php") !== false || string_strpos($_SERVER['PHP_SELF'], "preview.php")) && ((!string_strpos($_SERVER['PHP_SELF'], BLOG_FEATURE_FOLDER) !== false))) { ?>
<link href="<?=THEMEFILE_URL;?>/test/advertise.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=THEMEFILE_URL;?>/test/schemes/<?=$scheme_path?>/advertise.css" rel="stylesheet" type="text/css" media="all" />

<link href="<?=THEMEFILE_URL;?>/test/results.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=THEMEFILE_URL;?>/test/schemes/<?=$scheme_path?>/results.css" rel="stylesheet" type="text/css" media="all" />

<link href="<?=THEMEFILE_URL;?>/test/detail.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=THEMEFILE_URL;?>/test/schemes/<?=$scheme_path?>/detail.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<? if ((string_strpos($_SERVER['PHP_SELF'], "profile/index.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], "profile/edit.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], "profile/add.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], "account/quicklists.php") !== false) || (string_strpos($_SERVER['PHP_SELF'], "account/reviews.php") !== false)) { ?>
<link href="<?=THEMEFILE_URL;?>/test/profile.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=THEMEFILE_URL;?>/test/schemes/<?=$scheme_path?>/profile.css" rel="stylesheet" type="text/css" media="all" />
<? } ?>

<link href="<?=THEMEFILE_URL;?>/test/content_custom.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=THEMEFILE_URL;?>/test/schemes/<?=$scheme_path?>/content_custom.css" rel="stylesheet" type="text/css" media="all" />

<link href="<?=THEMEFILE_URL;?>/test/print.css" rel="stylesheet" type="text/css" media="print" />

<?
setting_get("scheme_custom", $scheme_custom);
?>

<?=($scheme_custom == "on" && !DEMO_LIVE_MODE ? colorscheme_generateDynamicCSS() : "")?>