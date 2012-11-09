<?
$isMobileApp_MOBI = TRUE;
$detectCurrentLocation = TRUE;
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
# * FILE: /mobile/events.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../conf/mobile.inc.php");
include("../conf/loadconfig.inc.php");
include(MOBILE_EDIRECTORY_ROOT . "/layout/header.php");
?>

<?
# ----------------------------------------------------------------------------------------------------
# customiz the search for each type
# ----------------------------------------------------------------------------------------------------
$headerTitle;
$keyWordHint;
$formAction;

?>

<?
# ----------------------------------------------------------------------------------------------------
# Search Form
# ----------------------------------------------------------------------------------------------------
if ($_GET['type'] == 'deal') {
    $headerTitle = 'DEALS';
    $keyWordHint = 'Type a keyword or deal title';
    $formAction = MOBILE_DEFAULT_URL . '/deal_search.php';
} elseif ($_GET['type'] == 'listing') {
    $formAction = MOBILE_DEFAULT_URL . "/advance_search_result.php";
    $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=listing';
} elseif ($_GET['type'] == 'event') {
    $formAction = MOBILE_DEFAULT_URL . "/event_search.php";
    $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=event';
} elseif ($_GET['type'] == 'classified') {
    $formAction = MOBILE_DEFAULT_URL . "/classified_search.php";
    $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=classified';
} elseif ($_GET['type'] == 'article') {
    $formAction = MOBILE_DEFAULT_URL . "/article_search.php";
    $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=article';
} elseif ($_GET['type'] == 'deal') {
    $formAction = MOBILE_DEFAULT_URL . "/deal_search.php";
    $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=promotion';
} else {
    $formAction = MOBILE_DEFAULT_URL . "/advance_search_result.php";
    $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=listing';
}
?>



<script>
    searchType = "<?
if (!empty($_GET['type']))
    echo $_GET['type'];
else
    echo 'listing'
    ?>" ;
        if(searchType == 'deal') searchType = 'promotion'; 
        $(document).bind ('pageshow', function (e, data) {
            var aux_data = "fnct=categories&type="+searchType;

            $.ajax({
                url: "http://test.dealcloudusa.com/advancedsearch_categories.php",
                context: document.body,
                data: aux_data,
                success: function(html){
                    //alert(html)
                    $("#advanced_search_category_dropdown").html(html);
                    $("#advanced_search_category_dropdown select").val($('#hf_category_id').text());
                    $("#advanced_search_category_dropdown").trigger('create');
                    
                }
            });	
        });
    
</script>

<?
$keyword = $_SESSION[$_GET['type'] . '_keyword'];
$where = $_SESSION[$_GET['type'] . '_where'];
$match = $_SESSION[$_GET['type'] . '_match'];
if(empty($match)){
    $match = 'anyword';
}
$category_id = $_SESSION[$_GET['type'] . '_category_id'];
$dist = $_SESSION[$_GET['type'] . '_dist'];
$zip = $_SESSION[$_GET['type'] . '_zip'];
?>

<div data-role="content" style=" padding:0px;">
    <div style=" text-align:center">
        <img style="width: 30%; height: auto" src="<?= MOBILE_DEFAULT_URL ?>/assets/logo.png" />
        <h2 id="title_deal">Deal Cloud USA</h2>
    </div>
</div>

<div data-role="content">
    <ul data-role="listview" data-inset="true" class="advanced_page_title" class="ui-listview ui-listview-inset ui-corner-all ui-shadow" >
        <? if ($_GET["type"] == "deal"): ?>
            <li data-theme="b">

                <img src="<?= DEFAULT_URL ?>/images/icon_home_mobile.png" />Deals

            </li>
        <? elseif ($_GET["type"] == "listing"): ?>
            <li data-theme="b">

                <img src="<?= DEFAULT_URL ?>/images/icon_listing_mobile.png" /><?= system_showText(LANG_MENU_LISTING); ?>

            </li>
        <? elseif ($_GET["type"] == "event"): ?>
            <li data-theme="b">

                <img src="<?= DEFAULT_URL ?>/images/icon_events_mobile.png" /><?= system_showText(LANG_MENU_EVENT); ?>

            </li>

        <? elseif ($_GET["type"] == "classified"): ?>
            <li data-theme="b">
                <a href="<?= MOBILE_DEFAULT_URL ?>/advanced_search_new.php?type=classified" accesskey="C">
                    <img src="<?= DEFAULT_URL ?>/images/icon_classified_mobile.png" /><?= system_showText(LANG_MENU_CLASSIFIED); ?>
                </a>
            </li>
        <? elseif ($_GET["type"] == "article"): ?>

            <li data-theme="b">
                <a href="<?= MOBILE_DEFAULT_URL ?>/advanced_search_new.php?type=article" accesskey="A">
                    <img src="<?= DEFAULT_URL ?>/images/icon_articles_mobile.png" /><?= system_showText(LANG_MENU_ARTICLE); ?>
                </a>
            </li>
        <? endif; ?>
    </ul>
</div>
<div data-role="content">
    <form action="<?= $formAction ?>" method="GET" name="search_form" id="search_form">
     <input type="hidden" value="<?= $_GET['type'] ?>" name="type" />
        <fieldset data-role="controlgroup">
            <label for="keyword">
                Keyword:
            </label>
            <input type="text" name="keyword" id="keyword" value="<?= $keyword; ?>">
            <span class="hint">
                <?= $keyWordHint ?>
            </span>
        </fieldset>
        <? if ($_GET['type'] != 'article'): ?>
            <fieldset data-role="controlgroup">
                <label for="where">
                    Where:
                </label>
                <input name="where" id="where" value="<?= $where ?>" class="ac_loading"  type="text" >
                <input type="button" id="get_current_location" value="Use Current Location" data-theme="c" />
            </fieldset>
        <? endif; ?>
        <label for="category_id" class="select" style="position: static">Match:</label>
        <fieldset data-role="controlgroup" data-type="vertical">
            <input name="match" value="exactmatch" id="match1" type="radio" <? if($match == 'exactmatch') echo 'checked="yes"' ?>>
            <label for="match1">
                <?= system_showText(LANG_SEARCH_LABELMATCH_EXACTMATCH) ?>
            </label>

            <input type="radio" name="match" value="anyword" id="match2"   <? if($match == 'anyword') echo 'checked="yes"' ?> >
            <label for="match2">
                <?= system_showText(LANG_SEARCH_LABELMATCH_ANYWORD) ?>
            </label>

            <input type="radio" name="match" value="allwords" id="match3" type="radio" <? if($match == 'allwords') echo 'checked="yes"' ?>>
            <label for="match3">
                <?= system_showText(LANG_SEARCH_LABELMATCH_ALLWORDS) ?>
            </label>
        </fieldset>

        <fieldset data-role="controlgroup" data-type="vertical">
            <label for="category_id" class="select" style="position: static"><?= system_showText(LANG_SEARCH_LABELCATEGORY) ?>:</label>
            <span id="hf_category_id" style="display: none"><?= $category_id  ?></span>
            <div data-role="fieldcontain" id="advanced_search_category_dropdown">
            </div>
        </fieldset>
        <? if ($_GET['type'] != 'article'): ?>
            <fieldset data-role="controlgroup" data-type="vertical">
                <input type="text" name="dist" value="50" style="width:25%; float:left" value="<?= $dist ?>"> 
                <label for="textinput5" style="width:24%; float:left; padding-left:1%; padding-top:12px;">
                    Miles of
                </label>
                <input type="text" id="zip"  name="zip" value="<?= $zip ?>"  style="width:25%; float:left" > 
                <label for="textinput6" style="width:24%; float:left; padding-left:1%; padding-top:12px;">
                    ZipCode
                </label>
            </fieldset>
        <? endif; ?>
        <input type="submit" data-theme="a"  value="<?= system_showText(LANG_BUTTON_SEARCH); ?>" class="searchButtonch btn-seach" />
    </form>

</div>
<?
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
include(MOBILE_EDIRECTORY_ROOT . "/layout/footer_new.php");
?>
