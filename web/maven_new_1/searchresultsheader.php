<?

$mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS);

$user = true;
$langIndex = language_getIndex(EDIR_LANGUAGE);
$str_search = "";
if ($keyword) {
    $str_search .= " " . system_showText(LANG_SEARCHRESULTS_KEYWORD) . " <strong>" . $keyword . "</strong>";
}
if ($where) {
    $str_search .= " " . system_showText(LANG_SEARCHRESULTS_WHERE) . " <strong>" . $where . "</strong>";
}
if ($template_id) {
    $search_template = new ListingTemplate($template_id);
    if ($search_template->getString("title")) {
        $str_search .= " " . system_showText(LANG_SEARCHRESULTS_TEMPLATE) . " <strong>" . $search_template->getString("title") . "</strong>";
    }
}
if ($category_id) {
    $search_category = new ListingCategory($category_id);
    if ($search_category->getString("title" . $langIndex)) {
        $str_search .= " " . system_showText(LANG_SEARCHRESULTS_INCATEGORY) . " <strong title = \"" . ($search_category->getString("title" . $langIndex)) . "\">" . $search_category->getString("title" . $langIndex, true, 60) . "</strong>";
    }
}
if ($zip) {
    $str_search .= " " . system_showText(LANG_SEARCHRESULTS_ZIP) . " " . ZIPCODE_LABEL . " <strong>" . $zip . (($dist) ? (" (" . $dist . " " . ZIPCODE_UNIT_LABEL_PLURAL . ")") : ("")) . "</strong>";
}

?>

<? if(!empty($str_search)): ?>
<h1 class="txt-block">search result <?= $str_search ?></h1>
<? endif; ?>

