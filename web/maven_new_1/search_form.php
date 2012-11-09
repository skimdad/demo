<?php
require(EDIRECTORY_ROOT . "/frontend/checkregbin.php");
///$categoryDD = "<img src=\"" . DEFAULT_URL . "/theme/" . EDIR_THEME . "/images/iconography/icon-loading-location.gif\" alt=\"" . system_showText(LANG_WAITLOADING) . "\"/>";
//echo $_SERVER["PHP_SELF"];
/* if (string_strpos($_SERVER["PHP_SELF"], "/" . LISTING_FEATURE_FOLDER) !== false) {
  $formAction = "listingresults.php";

  } elseif (string_strpos($_SERVER["PHP_SELF"], "/" . EVENT_FEATURE_FOLDER) !== false) {
  $formAction = "eventresults.php";

  } elseif (string_strpos($_SERVER["PHP_SELF"], "/" . CLASSIFIED_FEATURE_FOLDER) !== false) {
  $formAction = "classifiedresults.php";

  } elseif (string_strpos($_SERVER["PHP_SELF"], "/" . ARTICLE_FEATURE_FOLDER) !== false) {
  $formAction = "articleresults.php";

  } else {
  $formAction = "results.php";

  } */
if ($_GET['type'] == 'listing') {
    $formAction = "advance_search_result.php";
    $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=listing';
} elseif ($_GET['type'] == 'event') {
    $formAction = "event_search.php";
    $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=event';
} elseif ($_GET['type'] == 'classified') {
    $formAction = "classified_search.php";
    $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=classified';
} elseif ($_GET['type'] == 'article') {
    $formAction = "article_search.php";
    $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=article';
} else {
    $formAction = "advance_search_result.php";
    $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=listing';
}





$action = "http://test.dealcloudusa.com/mobile/" . $formAction;
/* (MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ? $action = NON_SECURE_URL . "/search/" : $action = NON_SECURE_URL . "/results.php";

  $searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP);

  $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=listing';

  $hasAdvancedSearch = false;

  $hasWhereSearch = true;

  $debug_geoIP = false; */
$location_GeoIP = geo_GeoIP($debug_geoIP);
//echo $location_GeoIP;

if ($location_GeoIP) {

    list($city, $state, $country) = explode(",", $location_GeoIP);

    $sql = 'SELECT Zipcode FROM `zip` where `City` = "' . $city . '" order by zipcode limit 1';
    $value = mysql_fetch_object(mysql_query($sql));

    if ($value->Zipcode == '') {
        $city = 'Rochester'; // Default city if city not found in the db
        $sql = 'SELECT Zipcode FROM `zip` where `City` = "' . $city . '" order by zipcode limit 1';
        $value = mysql_fetch_object(mysql_query($sql));
    }
}

/* if (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL)) !== false) {

  $searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_LISTING);

  $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=listing';

  $action = MOBILE_DEFAULT_URL."/listingresults.php";

  $action_adv = MOBILE_DEFAULT_URL."/listingresults.php";;

  $hasAdvancedSearch = true;

  $advancedSearchItem = "listing";

  $advancedSearchPath = EDIRECTORY_FOLDER . str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL);
  } elseif (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", PROMOTION_DEFAULT_URL)) !== false) {

  $searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION);

  $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=promotion';

  (MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ? $action = PROMOTION_DEFAULT_URL . "/search/" : $action = PROMOTION_DEFAULT_URL . "/results.php";

  $action_adv = PROMOTION_DEFAULT_URL . "/results.php";

  $hasAdvancedSearch = true;

  $advancedSearchItem = "promotion";

  $advancedSearchPath = EDIRECTORY_FOLDER . str_replace(NON_SECURE_URL, "", PROMOTION_DEFAULT_URL);
  } elseif (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", EVENT_DEFAULT_URL)) !== false) {

  $searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_EVENT);

  $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=event';

  (MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ? $action = EVENT_DEFAULT_URL . "/search/" : $action = EVENT_DEFAULT_URL . "<?=MOBILE_DEFAULT_URL?>/eventresults.php";

  $action_adv = "<?=MOBILE_DEFAULT_URL?>/eventresults.php";

  $hasAdvancedSearch = true;

  $advancedSearchItem = "event";

  $advancedSearchPath = EDIRECTORY_FOLDER . str_replace(NON_SECURE_URL, "", EVENT_DEFAULT_URL);
  } elseif (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", CLASSIFIED_DEFAULT_URL)) !== false) {

  $searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED);

  $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=classified';

  (MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ? $action = CLASSIFIED_DEFAULT_URL . "/search/" : $action = "<?=MOBILE_DEFAULT_URL?>/classifiedresults.php";

  $action_adv =  "<?=MOBILE_DEFAULT_URL?>/classifiedresults.php";

  $hasAdvancedSearch = true;

  $advancedSearchItem = "classified";

  $advancedSearchPath = EDIRECTORY_FOLDER . str_replace(NON_SECURE_URL, "", CLASSIFIED_DEFAULT_URL);
  } elseif (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL)) !== false) {

  $searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE);

  $autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL . '?module=article';

  (MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ? $action = ARTICLE_DEFAULT_URL . "/search/" : $action = "<?=MOBILE_DEFAULT_URL?>/articleresults.php";

  $action_adv = "<?=MOBILE_DEFAULT_URL?>/articleresults.php";

  $hasAdvancedSearch = true;

  $hasWhereSearch = false;

  $advancedSearchItem = "article";

  $advancedSearchPath = EDIRECTORY_FOLDER . str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL);
  } elseif (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", BLOG_DEFAULT_URL)) !== false) {

  $searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_POST);

  $autocomplete_keyword_url = BLOG_AUTOCOMPLETE_KEYWORD_URL . '?module=blog';

  (MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ? $action = BLOG_DEFAULT_URL . "/search/" : $action = BLOG_DEFAULT_URL . "/results.php";

  $action_adv = BLOG_DEFAULT_URL . "/results.php";

  $hasAdvancedSearch = false;

  $hasWhereSearch = false;

  $advancedSearchItem = "blog";

  $advancedSearchPath = EDIRECTORY_FOLDER . str_replace(NON_SECURE_URL, "", BLOG_DEFAULT_URL);


  // the following code is added by Debiprasad on 5th August
  } else {

  //$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_POST);
  //$autocomplete_keyword_url = BLOG_AUTOCOMPLETE_KEYWORD_URL.'?module=blog';
  //(MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ?  $action = BLOG_DEFAULT_URL."/search/" : $action = BLOG_DEFAULT_URL."/results.php" ;

  $action_adv = LISTING_DEFAULT_URL . "/results.php";
  //$action_adv = $action;

  $hasAdvancedSearch = true;

  $advancedSearchItem = "listing";

  $advancedSearchPath = EDIRECTORY_FOLDER . str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL);
  }

  (MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ? $method = "post" : $method = "get";






  $js_fileLoader = system_scriptColectorOnReady("



  $('#keyword').autocomplete(

  '$autocomplete_keyword_url',

  {

  delay:1000,

  dataType: 'html',

  minChars:" . AUTOCOMPLETE_MINCHARS . ",

  matchSubset:0,

  selectFirst:0,

  matchContains:1,

  cacheLength:" . AUTOCOMPLETE_MAXITENS . ",

  autoFill:false,

  maxItemsToShow:" . AUTOCOMPLETE_MAXITENS . ",

  max:" . AUTOCOMPLETE_MAXITENS . "

  }

  );



  ", $js_fileLoader); */
?>
<div data-role="content" style="padding: 15px">
    <form name="search_form" id="search_form" method="get"   action="http://test.dealcloudusa.com/mobile/<?= $formAction ?>">

        <fieldset data-role="controlgroup">
            <label for="where">
                Keyword:
            </label>
            <input type="text" name="keyword" id="keyword" value="<?= $keyword; ?>">



            <fieldset data-role="controlgroup">
                <label for="where">
                    Where:
                </label>
                <input name="where" id="where" value="<?= $where; ?>" class="ac_loading" disabled="disabled" type="text" >
            </fieldset>




            <ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">

                <li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="false" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li ui-li-has-alt ui-li-has-thumb ui-corner-bottom ui-btn-up-c" style="padding:5px; height:330px;">





                    <div style=" width:100%; text-align:left; float:left; padding-bottom:5px; margin-top:10px;">
                        <p><strong>Match:</strong>

                        <fieldset data-role="controlgroup" data-type="vertical">
                            <input name="match" value="exactmatch" id="match1" type="radio">
                            <label for="match1">
<?= system_showText(LANG_SEARCH_LABELMATCH_EXACTMATCH) ?>
                            </label>

                            <input type="radio" name="match" value="anyword" id="match2" checked="yes">
                            <label for="match2">
                                <?= system_showText(LANG_SEARCH_LABELMATCH_ANYWORD) ?>
                            </label>

                            <input type="radio" name="match" value="allwords" id="match3"type="radio">
                            <label for="match3">
                                <?= system_showText(LANG_SEARCH_LABELMATCH_ALLWORDS) ?>
                            </label>
                        </fieldset>
                        </p><br/><br/>
                        <p>
                        <div class="left">
                            <label for="category_id" class="select"><?= system_showText(LANG_SEARCH_LABELCATEGORY) ?>:</label>
                            <div data-role="fieldcontain" id="advanced_search_category_dropdown">


                            </div>


                            </p><br/>

                            <p>
                                <strong>ZipCode:</strong>


                                <input type="text" name="dist" value="50" style="width:25%; float:left"> 
                                <label for="textinput5" style="width:24%; float:left; padding-left:1%; padding-top:12px;">
                                    Miles of
                                </label>


                                <input type="text" id="zip"  name="zip" value="<?= $value->Zipcode; ?>"  style="width:25%; float:left" > 
                                <label for="textinput6" style="width:24%; float:left; padding-left:1%; padding-top:12px;">
                                    ZipCode
                                </label>
                            </p>


                            </li>
                            </ul>

                            <input type="submit" data-theme="b"  value="<?= system_showText(LANG_BUTTON_SEARCH); ?>" class="searchButtonch btn-seach" />


                            </form>     
                        </div>

                    </div>





                    </div>










                    <script>
                        $(document).bind ('pageshow', function (e, data) {
                            $('#keyword').autocomplete(

                            " <?= $autocomplete_keyword_url ?>",

                            {

                                delay:1000,

                                dataType:"html",

                                minChars:AUTOCOMPLETE_MINCHARS,

                                matchSubset:0,

                                selectFirst:0,

                                matchContains:1,

                                cacheLength:AUTOCOMPLETE_MAXITENS,

                                autoFill:false,

                                maxItemsToShow:AUTOCOMPLETE_MAXITENS,

                                max:AUTOCOMPLETE_MAXITENS

                            }

                        );
                        });


                    
                        function submitformSearch(action){
                            document.search_form.action = '';
                            var keyword = document.getElementById('keyword').value;
                            var where = document.getElementById('where').value;
                            //document.search_form.action = "http://www.dealcloudusa.com/results.php";
        
                            //  document.search_form.submit();
			
                            // var keyword = document.getElementById("keyword").value;
                            // alert("3"+keyword )

                            where = '';



                            keyword = keyword.replace(/\//g,"|2F");

                            keyword = keyword.replace(/\\/g,"|3F");

                            // alert("4"+keyword )

                            if (document.getElementById("where")){

                                where = document.getElementById("where").value;
                                //
                                //  alert("5"+where )

                                where = where.replace(/\//g,"|2F");

                                where = where.replace(/\\/g,"|3F");

                                // alert("6"+where )
                                if (where){

                                    where = encodeURIComponent(where);
                                    where=where.replace(/%20/g,"+");
                                    alert(where)

                                    // alert("7"+where )

                                } else {

                                    where = "";
                                    //alert("8"+where )

                                }

                            } 
                          

        




<?
if ((MODREWRITE_FEATURE == "on" && !$searchNotFriendly)) {
    ?>
                var key=encodeURIComponent(keyword);
                key=key.replace(/%20/g,"+");
                            
                window.location  = "http://test.dealcloudusa.com/results.php?keyword="+key+"&where="+where+"&match=anyword&advsearch=yes&category_id=&location_1=&location_3=&location_4=&dist=50&zip=14602";
                //window.location = "http://www.test.dealcloudusa.com/listing/results.php?keyword="+ encodeURIComponent(keyword)+"&where="+where;

<? } else { ?>

            // document.search_form.submit();
                                                                                    			    

<? } ?>

    }



    function submitenter(myfield,e){

        var keycode;
        //alert(myfield)
        //alert(e)
        // alert(window.event)
        if (window.event){

            keycode = window.event.keyCode;
            //alert( "1"+ keycode)

        }else if (e){

            keycode = e.which;

        }else{

            return true;

        } 



        if (keycode == 13){

            //alert("2"+'<?= $action ?>')
            submitformSearch('<?= $action ?>');

            return false;

        } else return true;

    }
	
        

 /* var advancedSearchShow = false;
  function showAdvancedSearch(item_type, action, action_adv, template_id, load_cat) {
        document.getElementById("buttonSearch").removeAttribute("onclick");
      
        //  alert(item_type)
	
        if (load_cat){
            
            if(template_id > 0){
                aux_data += "&template_id="+template_id;
            }

          
        }  

    } */
                    </script>
