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

	# * FILE: /searchfront.php

	# ----------------------------------------------------------------------------------------------------



	# ----------------------------------------------------------------------------------------------------

	# AUX

	# ----------------------------------------------------------------------------------------------------

	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");



	# ----------------------------------------------------------------------------------------------------

	# CODE

	# ----------------------------------------------------------------------------------------------------



	(MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ?  $action =  NON_SECURE_URL."/search/" : $action =  NON_SECURE_URL."/results.php" ;

	$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP);

	$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=listing';

	$hasAdvancedSearch = false;

	$hasWhereSearch = true;



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



    <script language="javascript" type="text/javascript">

	function check_these(){
		document.search_form.action = "http://www.dealcloudusa.com/listing/results.php";
		document.search_form.submit();
		/*
		document.search_form.action = '';
		var keyword = document.getElementById('keyword').value;
		var where = document.getElementById('where').value;
		if (document.getElementById('keyword').value.length == 0 || document.getElementById('keyword').value == ''){	
				
				if (document.getElementById('check_deals').checked)
					document.search_form.action = "http://www.dealcloudusa.com/deal/search/"+keyword+"/where/"+where+"/";
				else if (document.getElementById('check_list').checked)
					document.search_form.action = "http://www.dealcloudusa.com/listing/search/"+keyword+"/where/"+where+"/";
				else if (document.getElementById('check_class').checked)
					document.search_form.action = "http://www.dealcloudusa.com/classified/search/"+keyword+"/where/"+where+"/";
				else if (document.getElementById('check_events').checked)
					document.search_form.action = "http://www.dealcloudusa.com/event/search/"+keyword+"/where/"+where+"/";
				else if (document.getElementById('check_articles').checked)
					document.search_form.action = "http://www.dealcloudusa.com/article/search/"+keyword+"/where/"+where+"/";
				else				 
					document.search_form.action = "http://www.dealcloudusa.com/search/"+keyword+"/where/"+where+"/";
					document.search_form.submit();
				return;
				}
		else	{	
				
				if (document.getElementById('check_deals').checked)
					document.search_form.action = "http://www.dealcloudusa.com/deal/results.php";
				else if (document.getElementById('check_list').checked)
					document.search_form.action = "http://www.dealcloudusa.com/listing/results.php";
				else if (document.getElementById('check_class').checked)
					document.search_form.action = "http://www.dealcloudusa.com/classified/results.php";
				else if (document.getElementById('check_events').checked)
					document.search_form.action = "http://www.dealcloudusa.com/event/results.php";
				else if (document.getElementById('check_articles').checked)
					document.search_form.action = "http://www.dealcloudusa.com/article/results.php";
				else				 
					document.search_form.action = "http://www.dealcloudusa.com/results.php";
					document.search_form.submit();
				return;
				}	
			*/
			return;
		}

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


	<form class="form" name="search_form" id="search_form" method="<?=$method?>"  >
				<div><input type="checkbox" name="check_deals" id="check_deals" value="deals"  class="checkbox" onClick="document.getElementById('check_all').checked = false;"/>Deals&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="check_list" id="check_list" value="listing" class="checkbox" onClick="document.getElementById('check_all').checked = false;"/>Businessess&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="check_class" id="check_class" value="classified" class="checkbox" onClick="document.getElementById('check_all').checked = false;"/>Classifieds<br />
				<input type="checkbox" name="check_events" id="check_events" value="events"  class="checkbox" onClick="document.getElementById('check_all').checked = false;"/>Events&nbsp;&nbsp;
				<input type="checkbox" name="check_articles" id="check_articles" value="articles" class="checkbox" onClick="document.getElementById('check_all').checked = false;"/>Articles&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="check_all" id="check_all" value="all" class="checkbox" checked onClick="document.getElementById('check_deals').checked = false;document.getElementById('check_list').checked = false;document.getElementById('check_class').checked = false; document.getElementById('check_events').checked = false;document.getElementById('check_articles').checked = false;"/>All
	</div>
	<div id="search">

			<fieldset>

				<label><?=system_showText(LANG_LABEL_SEARCHKEYWORD);?></label>

				<input type="text" name="keyword" id="keyword" value="<?=$keyword;?>" onfocus="showAdvancedSearch('<?=$advancedSearchItem?>', '<?=$action?>', '<?=$action_adv?>','<?=$aux_template_id?>', true);" onkeypress="return submitenter(this,event)" <?if ((MODREWRITE_FEATURE == "on" && !$searchNotFriendly)) echo "onkeyup=\"changeFormAction('".$action."', this.value, ".$auxScript.")\""?> />

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



				<fieldset>

					<label><?=system_showText(LANG_LABEL_SEARCHWHERE);?></label>

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

            <? if (!$keepFormOpen) { ?>

                <div class="left">
                    <button type="button" id="buttonSearch" onclick="submitformSearch('<?=$action?>');"><?=system_showText(LANG_BUTTON_SEARCH);?></button>
					


                    <? 

                    if ($hasAdvancedSearch) {

                        $aux_template_id = $template_id;

                    ?>

                    <a id="advanced-search-button" href="javascript:void(0);" onclick="showAdvancedSearch('<?=$advancedSearchItem?>', '<?=$action?>', '<?=$action_adv?>','<?=$aux_template_id?>', true);">

                        <span id="advanced-search-label" style="display:inline">Refine Your Search (Advanced)<?//=system_showText(LANG_BUTTON_ADVANCEDSEARCH);?></span>

                        <span id="advanced-search-label-close" style="display:none"><?=system_showText(LANG_BUTTON_ADVANCEDSEARCH_CLOSE);?></span>

                    </a>

                    <? } ?>
                </div>

             <? } ?>



		</div>



		<? 

		if ($hasAdvancedSearch  && !$keepFormOpen) {

			$template_id = $template_id ? $template_id : 0; ?>

			<div id="advanced-search" style="display:none;">

				<? include(EDIRECTORY_ROOT."/advancedsearch.php") ?>

			</div>

			<? 

		} 

	if (!$keepFormOpen) { ?>

	</form>
<script type="text/javascript">
 showAdvancedSearch('<?=$advancedSearchItem?>', '<?=$action?>', '<?=$action_adv?>','<?=$aux_template_id?>', true); 
/*closeAdvancedSearch('<?=$advancedSearchItem?>', '<?=$action?>', '<?=$action_adv?>','<?=$aux_template_id?>');*/
</script>
    <? } ?>