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
	# * FILE: /blog/sitemgr/blog/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BLOG_FEATURE != "on") {
		header("Location: ".DEFAULT_URL."/sitemgr/");
		exit;
	}

	/*
     * Session variable to force connection with second DB
     */
    $_SESSION["FORCE_SECOND"] = false;
    
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER;
	$url_base = "".BLOG_DEFAULT_URL."/sitemgr";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$_GET = format_magicQuotes($_GET);
	extract($_GET);
	$_POST = format_magicQuotes($_POST);
	extract($_POST);

	//increases frequently actions
	if (!isset($acct_search_field_name)) system_setFreqActions('post_search','BLOG_FEATURE');

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$arrLangs = explode(",", EDIR_LANGUAGENUMBERS);
	$endExpr = ")";

	if (count($arrLangs) > 1) {
		$fields = "id, IF (`title".$langIndex."` != '', `title".$langIndex."`, ";
		$orderby = " IF (`title".$langIndex."` != '', `title".$langIndex."`, ";
		foreach ($arrLangs as $lang) {
			if ($langIndex != $lang) {
				$fields .= "IF (`title".$lang."` != '', `title".$lang."`, ";
				$orderby .= "IF (`title".$lang."` != '', `title".$lang."`, ";
				$endExpr .= ")";
			}
		}
		$fields .= "''".$endExpr." AS `title`";
		$orderby .= "''".$endExpr." ";
	} else {
		$fields = "`id`, `title".$langIndex."` AS `title`";
		$orderby = "`title".$langIndex."`";
	}

	##################################################################################################################################
	# CATEGORY
	##################################################################################################################################
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$categories = db_getFromDB_Blog("blogcategory", "category_id", 0, "all", $orderby, "object", SELECTED_DOMAIN_ID, $fields);
	$nameArray  = array();
	$valueArray = array();
	if ($categories) {
		foreach ($categories as $category) {
			if (BLOGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$valueArray[] = "";
				$nameArray[]  = "--------------------------------------------------";
			}
			$valueArray[] = $category->getNumber("id");
			if ($category->getString("title".$langIndex)) $nameArray[] = $category->getString("title".$langIndex);
			else $nameArray[] = $category->getString("title");
//			if (BLOGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
//				$subcategories = db_getFromDB_Blog("blogcategory", "category_id", $category->getNumber("id"), "all", "title", "object", SELECTED_DOMAIN_ID);
//				if ($subcategories) {
//					foreach ($subcategories as $subcategory) {
//						$valueArray[] = $subcategory->getNumber("id");
//						if ($subcategory->getString("title".$langIndex)) $nameArray[] = " &raquo; ".$subcategory->getString("title".$langIndex);
//						else $nameArray[] = " &raquo; ".$subcategory->getString("title");
//						$subcategories2 = db_getFromDB_Blog("blogcategory", "category_id", $subcategory->getNumber("id"), "all", "title", "object", SELECTED_DOMAIN_ID);
//						if ($subcategories2) {
//							foreach ($subcategories2 as $subcategory2) {
//								$valueArray[] = $subcategory2->getNumber("id");
//								if ($subcategory2->getString("title".$langIndex)) $nameArray[] = " &raquo;&raquo; ".$subcategory2->getString("title".$langIndex);
//								else $nameArray[] = " &raquo;&raquo; ".$subcategory2->getString("title");
//								$subcategories3 = db_getFromDB_Blog("blogcategory", "category_id", $subcategory2->getNumber("id"), "all", "title", "object", SELECTED_DOMAIN_ID);
//								if ($subcategories3) {
//									foreach ($subcategories3 as $subcategory3) {
//										$valueArray[] = $subcategory3->getNumber("id");
//										if ($subcategory3->getString("title".$langIndex)) $nameArray[] = " &raquo;&raquo;&raquo; ".$subcategory3->getString("title".$langIndex);
//										else $nameArray[] = " &raquo;&raquo;&raquo; ".$subcategory3->getString("title");
//										$subcategories4 = db_getFromDB_Blog("blogcategory", "category_id", $subcategory3->getNumber("id"), "all", "title", "object", SELECTED_DOMAIN_ID);
//										if ($subcategories4) {
//											foreach ($subcategories4 as $subcategory4) {
//												$valueArray[] = $subcategory4->getNumber("id");
//												if ($subcategory4->getString("title".$langIndex)) $nameArray[] = " &raquo;&raquo;&raquo;&raquo; ".$subcategory4->getString("title".$langIndex);
//												else $nameArray[] = " &raquo;&raquo;&raquo;&raquo; ".$subcategory4->getString("title");
//											}
//										}
//									}
//								}
//							}
//						}
//					}
//				}
//			}
		}
	}
	if (BLOGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
		$valueArray[] = "";
		$nameArray[] = "--------------------------------------------------";
	}
	$categoryDropDown = html_selectBox("search_category_id", $nameArray, $valueArray, $search_category_id, "", "class='input-dd-form-post'", "-- ".system_showText(LANG_LABEL_SELECT_ALLTAGS)." --");

	##################################################################################################################################
	# STATUS
	##################################################################################################################################

	$arrayNameDD = Array("Active", "Suspended");
	$arrayValueDD = Array("A", "S");
	$statusDropDown = html_selectBox("search_status", $arrayNameDD, $arrayValueDD, $search_status, "", "class='input-dd-form-searchpost'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

	/************************************************
	* @desc Category auxiliar code
	*************************************************/
	
	if($search_category_id) {
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$sql = "SELECT post_id FROM Post_Item WHERE blogcat_id = '$search_category_id'";
		$rs = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $post_ids_from_category[] = $row["post_id"];
		$category_post_ids = ($post_ids_from_category) ? implode(",",$post_ids_from_category) : "'0'";
	}
	
	/************************************************
	* @desc Category auxiliar code
	************************************************/
	if ($category_post_ids) {
		$search_post_ids = $category_post_ids;
	}

	if ($search_title) {
        $search_title = str_replace("\\", "", $search_title);
        $search_for_keyword_fields[] = "Post.fulltextsearch_keyword";
        $sql_where[] = search_getSQLFullTextSearch($search_title, $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"], $order_by_keyword_score2, "keyword_score2");
    }
	if ($search_status) $sql_where[] = " status = '$search_status' ";
	if ($search_post_ids) $sql_where[] = " id IN ($search_post_ids) "; // search_post_ids

	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";
	
	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	
	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$paging_url = BLOG_DEFAULT_URL."/sitemgr/".BLOG_FEATURE_FOLDER."/search.php";

	if ($search_submit) {
		$pageObj = new pageBrowsing("Post", $screen, RESULTS_PER_PAGE, "title DESC", "title", $letter, $where);
		$posts = $pageObj->retrievePage("object");
		// Letters Menu
		$letters = $pageObj->getString("letters");
		foreach ($letters as $each_letter) {
			if ($each_letter == "#") {
				$letters_menu .= "<a href=\"$paging_url?letter=no".(($url_search_params) ? "&$url_search_params" : "")."\" ".(($letter == "no") ? "class=\"firstLetter\"" : "" ).">".string_strtoupper($each_letter)."</a>";
			} else {
				$letters_menu .= "<a href=\"$paging_url?letter=".$each_letter.(($url_search_params) ? "&$url_search_params" : "")."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
			}
		}
		# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
		$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

	$_GET = format_magicQuotes($_GET);
	extract($_GET);
	$_POST = format_magicQuotes($_POST);
	extract($_POST);

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=string_ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?> <?=system_showText(LANG_SITEMGR_POST_BLOG_SING)?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<?if (CUSTOM_BLOG_FEATURE != "on"){ ?>
				<p class="informationMessage">
					<?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
				</p>
			<? }else { ?>

			<? include(BLOG_INCLUDES_DIR."/tables/table_blog_submenu.php"); ?>

			<br />

			<? if ($search_submit) { ?>
				<div class="header-form">
					<?=string_ucwords(system_showText(LANG_SITEMGR_RESULTS))?>
				</div>
				<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
				<? if ($posts) { ?>
					<? include(BLOG_INCLUDES_DIR."/tables/table_blog.php"); ?>
				<? } else { ?>
					<p class="errorMessage"><?=system_showText(LANG_SITEMGR_NORESULTS)?></p>
				<? } ?>
			<? } ?>

			<div class="header-form">
				<?=system_showText(LANG_SITEMGR_SEARCH)?>
			</div>

			<form name="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get">

				<? if ($error_message) echo "<p class=\"errorMessage\">".$error_message."</p>"; ?>

				<? include(BLOG_INCLUDES_DIR."/forms/form_searchpost.php"); ?>

				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="search_submit" value="Search" class="input-button-form"><?=system_showText(LANG_SITEMGR_SEARCH)?></button>
						</td>
						<td>
							<button type="button" value="Clear" onclick="searchResetSitemgr(this.form);" class="input-button-form"><?=system_showText(LANG_SITEMGR_CLEAR)?></button>
						</td>
					</tr>
				</table>

			</form>

			<? } ?>

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