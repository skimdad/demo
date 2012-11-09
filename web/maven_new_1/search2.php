<?php (MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ?  $action =  NON_SECURE_URL."/search/" : $action =  NON_SECURE_URL."/results.php" ;

	$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP);

	$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=listing';

	$hasAdvancedSearch = false;

	$hasWhereSearch = true;

$debug_geoIP = false;
	$location_GeoIP = geo_GeoIP($debug_geoIP);
	//echo $location_GeoIP;

	if($location_GeoIP){

		list($city, $state, $country) = explode(",", $location_GeoIP);

		$sql ='SELECT Zipcode FROM `zip` where `City` = "'.$city.'" order by zipcode limit 1';
    $value = mysql_fetch_object(mysql_query($sql));
	if ($value->Zipcode == ''){
			$city = 'Rochester'; // Default city if city not found in the db
			$sql ='SELECT Zipcode FROM `zip` where `City` = "'.$city.'" order by zipcode limit 1';
			$value = mysql_fetch_object(mysql_query($sql));
	}
	}

	if (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL)) !== false) {

		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_LISTING);

		$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=listing';

		(MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ?  $action = LISTING_DEFAULT_URL."/search/" : $action = LISTING_DEFAULT_URL."/results.php" ;

		$action_adv = LISTING_DEFAULT_URL."/results.php" ;

		$hasAdvancedSearch = true;

		$advancedSearchItem = "listing";

		$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL);



	} elseif (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", PROMOTION_DEFAULT_URL)) !== false) {

		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION);

		$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=promotion';

		(MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ?  $action = PROMOTION_DEFAULT_URL."/search/" : $action = PROMOTION_DEFAULT_URL."/results.php" ;

		$action_adv = PROMOTION_DEFAULT_URL."/results.php" ;

		$hasAdvancedSearch = true;

		$advancedSearchItem = "promotion";

		$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", PROMOTION_DEFAULT_URL);



	} elseif (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", EVENT_DEFAULT_URL)) !== false) {

		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_EVENT);

		$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=event';

		(MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ?  $action = EVENT_DEFAULT_URL."/search/" : $action = EVENT_DEFAULT_URL."/results.php" ;

		$action_adv = EVENT_DEFAULT_URL."/results.php" ;

		$hasAdvancedSearch = true;

		$advancedSearchItem = "event";

		$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", EVENT_DEFAULT_URL);



	} elseif (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", CLASSIFIED_DEFAULT_URL)) !== false) {

		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED);

		$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=classified';

		(MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ?  $action = CLASSIFIED_DEFAULT_URL."/search/" : $action = CLASSIFIED_DEFAULT_URL."/results.php" ;

		$action_adv = CLASSIFIED_DEFAULT_URL."/results.php" ;

		$hasAdvancedSearch = true;

		$advancedSearchItem = "classified";

		$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", CLASSIFIED_DEFAULT_URL);



	} elseif (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL)) !== false) {

		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE);

		$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=article';

		(MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ?  $action = ARTICLE_DEFAULT_URL."/search/" : $action = ARTICLE_DEFAULT_URL."/results.php" ;

		$action_adv = ARTICLE_DEFAULT_URL."/results.php" ;

		$hasAdvancedSearch = true;

		$hasWhereSearch = false;

		$advancedSearchItem = "article";

		$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL);



	} elseif (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", BLOG_DEFAULT_URL)) !== false) {

		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_POST);

		$autocomplete_keyword_url = BLOG_AUTOCOMPLETE_KEYWORD_URL.'?module=blog';

		(MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ?  $action = BLOG_DEFAULT_URL."/search/" : $action = BLOG_DEFAULT_URL."/results.php" ;

		$action_adv = BLOG_DEFAULT_URL."/results.php" ;

		$hasAdvancedSearch = false;

		$hasWhereSearch = false;

		$advancedSearchItem = "blog";

		$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", BLOG_DEFAULT_URL);


		// the following code is added by Debiprasad on 5th August
	} else {

		//$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_POST);

		//$autocomplete_keyword_url = BLOG_AUTOCOMPLETE_KEYWORD_URL.'?module=blog';

		//(MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ?  $action = BLOG_DEFAULT_URL."/search/" : $action = BLOG_DEFAULT_URL."/results.php" ;

		$action_adv = LISTING_DEFAULT_URL."/results.php" ;
		//$action_adv = $action;

		$hasAdvancedSearch = true;

		$advancedSearchItem = "listing";

		$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL);



	}

	(MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ?  $method = "post" : $method = "get" ;

	

	if (!$browsebylocation && !$browsebycategory){



		/*

		 * Social network options

		 */

		$useSocialNetworkLocation = false;

		if (sess_getAccountIdFromSession () && !$where){

			$profileObj = new Profile(sess_getAccountIdFromSession());

			if ($profileObj->location && $profileObj->usefacebooklocation){

				$where = $profileObj->location;

				$useSocialNetworkLocation = true;

			}

		}



		/*

		 * GeoIP

		 */	

		

		$waitGeoIP = false;

		

		if (!$useSocialNetworkLocation 

				&& !$where 

				&& GEOIP_FEATURE == "on" 

				&& $advancedSearchItem != "article" 

				&& $advancedSearchItem != "blog"

				&& (!$screen || string_strpos($_SERVER["PHP_SELF"],"profile") > 0)

				&& !$letter 

				&& (string_strpos($_SERVER["PHP_SELF"],"results.php")===false)

			){

			

			$waitGeoIP = true; 



			$where = system_showText(LANG_LABEL_WAIT_LOCATION);

			

			$js_fileLoader = system_scriptColectorOnReady("



				$.ajax({

				   type: \"GET\",

				   url: \"".DEFAULT_URL."/getGeoIP.php\",

				   success: function(msg){

					    $('#where').removeClass('ac_loading');

					    $('#where').attr('disabled', '');

						$('#where').attr('value', msg);

				   }

				 });



			",$js_fileLoader);

		}

	}

	

	$hasWhereSearch ? $auxScript = "document.getElementById('where').value" : $auxScript = "''";



	?>



<div data-role="content" style="padding: 15px">
<!--<?php require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?> -->

    <fieldset data-role="controlgroup">
        
        
     

				<label for="keyword"><?=system_showText(LANG_LABEL_SEARCHKEYWORD);?></label>

				<input type="text" name="keyword" placeholder="Type a keyword or deal title"  id="keyword" value="<?=$keyword;?>" onfocus="showAdvancedSearch('<?=$advancedSearchItem?>', '<?=$action?>', '<?=$action_adv?>','<?=$aux_template_id?>', true);" onkeypress="return submitenter(this,event)" <?if ((MODREWRITE_FEATURE == "on" && !$searchNotFriendly)) echo "onkeyup=\"changeFormAction('".$action."', this.value, ".$auxScript.")\""?> />

				<p><?=$searchByKeywordTip?></p>

    </fieldset>
    
			<?

                        

            if (string_strpos($_SERVER["PHP_SELF"], PROMOTION_FEATURE_FOLDER) === false || (string_strpos($_SERVER["PHP_SELF"], PROMOTION_FEATURE_FOLDER) !== false && PROMOTION_SCALABILITY_USE_AUTOCOMPLETE == "on")){



                $js_fileLoader = system_scriptColectorOnReady("



                        $('#keyword').autocomplete(

                            '$autocomplete_keyword_url',

                                    {

                                        delay:1000,

                                        dataType: 'html',

                                        minChars:".AUTOCOMPLETE_MINCHARS.",

                                        matchSubset:0,

                                        selectFirst:0,

                                        matchContains:1,

                                        cacheLength:".AUTOCOMPLETE_MAXITENS.",

                                        autoFill:false,

                                        maxItemsToShow:".AUTOCOMPLETE_MAXITENS.",

                                        max:".AUTOCOMPLETE_MAXITENS."

                                    }

                            );



                ",$js_fileLoader);

            }

                        

			if ($hasWhereSearch) { ?>






    <fieldset data-role="controlgroup">
     

					<label for="where"><?=system_showText(LANG_LABEL_SEARCHWHERE);?></label>

					<input type="text" name="where" id="where" value="<?=$where;?>" <?=($waitGeoIP ? "class=\"ac_loading\" disabled=\"disabled\"" : "")?> onkeypress="return submitenter(this,event)" <?if ((MODREWRITE_FEATURE == "on" && !$searchNotFriendly)) echo "onkeyup=\"changeFormAction('".$action."', document.getElementById('keyword').value, this.value)\""?>/>

					<p><?=system_showText(LANG_LABEL_SEARCHWHERETIP);?></p>

				</fieldset>


				<?

				$js_fileLoader = system_scriptColectorOnReady("



					$('#where').autocomplete(

						'".AUTOCOMPLETE_LOCATION_URL."',

							{

								delay:1000,

								minChars:".AUTOCOMPLETE_MINCHARS.",

								matchSubset:0,

								selectFirst:0,

								matchContains:1,

								cacheLength:".AUTOCOMPLETE_MAXITENS.",

								autoFill:false,

								maxItemsToShow:".AUTOCOMPLETE_MAXITENS.",

								max:".AUTOCOMPLETE_MAXITENS."

							}

					 );



				",$js_fileLoader);



			} 

			?>
			<script>


$("#where").change(function() {
    var where = $("#where").val();
    var dataString = "where="+ where;
	if (where != ''){
	//alert(where);
    $.ajax({
            Type: "GET",
            url: "http://www.dealcloudusa.com/autocomplete_zip.php",
            data: dataString,
            success: function(result) {
			//	alert(result);
               document.search_form.zip.value = result;
        }
            })
	}
});
</script>



    <ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">

        <li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="false" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li ui-li-has-alt ui-li-has-thumb ui-corner-bottom ui-btn-up-c" style="padding:5px; height:330px;">





            <div style=" width:100%; text-align:left; float:left; padding-bottom:5px; margin-top:10px;">
                <p><strong>Match:</strong>

                <fieldset data-role="controlgroup" data-type="vertical">
                    <input name="radio1" id="radio1" type="radio">
                    <label for="radio1">
                        Exact Match
                    </label>

                    <input name="radio1" id="radio2" type="radio">
                    <label for="radio2">
                        Any Word
                    </label>

                    <input name="radio1" id="radio3" type="radio">
                    <label for="radio3">
                        All Words
                    </label>
                </fieldset>
                </p><br/><br/>
                <p>
                    <strong>Category:</strong>
                    <label for="selectmenu1">
                    </label>
                    <select name="selectmenu1" id="selectmenu1">
                        <option value="option1" >
                            Accountance
                        </option>
                        <option value="value">
                            Sign in with OpenID 2.0 Account
                        </option>
                        <option value="value">
                            Sign in with Facebook Account
                        </option>
                        <option value="value">
                            Sign in with Google Account
                        </option>
                    </select>
                </p><br/>

                <p>
                    <strong>ZipCode:</strong>


                    <input name="" id="textinput5" placeholder="" value="" type="email" style="width:25%; float:left"> 
                    <label for="textinput5" style="width:24%; float:left; padding-left:1%; padding-top:12px;">
                        Miles of
                    </label>


                    <input name="" id="textinput6" placeholder="" value="" type="email" style="width:25%; float:left" > 
                    <label for="textinput6" style="width:24%; float:left; padding-left:1%; padding-top:12px;">
                        ZipCode
                    </label>
                </p>

            </div>
        </li>
    </ul>



    <a  data-theme="b"  data-role="button" data-transition="fade" href="#page1">
        Search
    </a>
</div>





</div>
<script language="javascript" type="text/javascript">
    function changeFormAction(action, value_keyword, value_where){

            var form = document.getElementById("search_form");

            var keyword = '';

            var where = '';



            value_keyword = value_keyword.replace(/\//g,"|2F");

            value_where = value_where.replace(/\//g,"|2F");

            value_keyword = value_keyword.replace(/\\/g,"|3F");

            value_where = value_where.replace(/\\/g,"|3F");



            keyword = urlencode(value_keyword);

            where = urlencode(value_where);



            if (where){

                where = "where/"+where;

            } else {

                <? if ($hasAdvancedSearch){?>

                    where = "where/empty";

                <?} else {?>

                    where = "";

                <? } ?>

            }

            if (keyword){

                where = "/"+where;

            } else {

                keyword = "empty";

                where = "/"+where;

            }



            form.action = action+keyword+where;

        }



        function submitformSearch(action){
			return check_these();

            var keyword = document.getElementById("keyword").value;

            var where = '';



            keyword = keyword.replace(/\//g,"|2F");

            keyword = keyword.replace(/\\/g,"|3F");



            if (document.getElementById("where")){

                where = document.getElementById("where").value;

                where = where.replace(/\//g,"|2F");

                where = where.replace(/\\/g,"|3F");

                if (where){

                    where = "where/"+urlencode(where);

                } else {

                    where = "where/empty";

                }

            } else{

                where = "";

            }



            if (keyword){

                where = "/"+where;

            } else {

                keyword = "empty";

                where = "/"+where;

            }





            <?if ((MODREWRITE_FEATURE == "on" && !$searchNotFriendly)) { ?>

                window.location = action+urlencode(keyword)+where;

            <? } else {?>

               // document.search_form.submit();
			    

            <? } ?>

        }



        function submitenter(myfield,e){

            var keycode;

            if (window.event){

                keycode = window.event.keyCode;

            }else if (e){

                keycode = e.which;

            }else{

                return true;

            } 



            if (keycode == 13){

                submitformSearch('<?=$action?>');

                return false;

            } else return true;

        }
	
        

	

</script>
<? if (!$keepFormOpen) { ?>

	<!--</form>-->
<script type="text/javascript">
 showAdvancedSearch('<?=$advancedSearchItem?>', '<?=$action?>', '<?=$action_adv?>','<?=$aux_template_id?>', true); 
/*closeAdvancedSearch('<?=$advancedSearchItem?>', '<?=$action?>', '<?=$action_adv?>','<?=$aux_template_id?>');*/
</script>
    <? } ?>

