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
	include_once(EDIRECTORY_ROOT."/conf/load_wtc.php");	


	# ----------------------------------------------------------------------------------------------------

	# CODE

	# ----------------------------------------------------------------------------------------------------



	(MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ?  $action =  NON_SECURE_URL."/search/" : $action =  NON_SECURE_URL."/results.php" ;

	$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP);

	$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=listing';

	$hasAdvancedSearch = true;

	$hasWhereSearch = true;



	if (string_strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL)) !== false ) {

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







	} else {

/*  		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION);
		$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=listing';
		(MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ?  $action = NON_SECURE_URL."/search/" : $action = NON_SECURE_URL."/listing/results.php" ;
		$action_adv = NON_SECURE_URL."/listing/results.php" ;
		$hasAdvancedSearch = true;
		$advancedSearchItem = "listing";
		$advancedSearchPath = NON_SECURE_URL."/listing/results.php" ;
		//$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", PROMOTION_DEFAULT_URL);		 
 */

 		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_LISTING);
		$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=listing';
		(MODREWRITE_FEATURE == "on" && !$searchNotFriendly) ?  $action = LISTING_DEFAULT_URL."/search/" : $action = LISTING_DEFAULT_URL."/home_results.php" ;
		$action_adv = LISTING_DEFAULT_URL."/home_results.php" ;
		$hasAdvancedSearch = true;
		$advancedSearchItem = "listing";
		$advancedSearchPath = LISTING_DEFAULT_URL."/home_results.php";
		
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

				&& (string_strpos($_SERVER["PHP_SELF"],"results")===false)

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

                document.search_form.submit();

            <? } ?>

        }

        function emptywhere(){
            if (document.getElementById("where")){
                /* document.getElementById("where").value = ""; */
            }
        }

        function emptyzip(){
			showAdvancedSearch('<?=$advancedSearchItem?>', '<?=$action?>', '<?=$action_adv?>','<?=$aux_template_id?>', true);
			if (document.getElementById("zip")){
                document.getElementById("zip").value = "";
            }
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



	<form class="form" name="search_form" id="search_form" method="<?=$method?>" action="<?=$action;?>">

		<? //$keyword = $_SESSION["s_keyword"]; 
			//<a name="reset" id="reset" alt="" href="#" onclick="document.getElementById('search_form').submit();">Reset</a>
		?>
		<div id="search">
		<div style="float:right;padding-right:15px;margin-top:0px;position:absolute;padding-left: 215px;">
			<a id="reset" name="reset" alt="" href="<?="/clear_search.php";?>">Reset</a>
		</div>

			<fieldset>

				<label><?=system_showText(LANG_LABEL_SEARCHKEYWORD);?></label>

				<input type="text" name="keyword" id="keyword" value="<?=$keyword?>" onkeypress="return submitenter(this,event)" <?if ((MODREWRITE_FEATURE == "on" && !$searchNotFriendly)) echo "onkeyup=\"changeFormAction('".$action."', this.value, ".$auxScript.")\""?> />

				<p><?=$searchByKeywordTip?></p>

			</fieldset>

			<?
                       
            if (string_strpos($_SERVER["PHP_SELF"], PROMOTION_FEATURE_FOLDER) === false || (string_strpos($_SERVER["PHP_SELF"], PROMOTION_FEATURE_FOLDER) !== false && PROMOTION_SCALABILITY_USE_AUTOCOMPLETE == "on")){
//htmlencde($autocomplete_keyword_url,1);
                $js_fileLoader = system_scriptColectorOnReady("

                        $('#keyword').autocomplete(

                            '$autocomplete_keyword_url',

                                    {
                                        delay:100,

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

					<input type="text" name="where" id="where" value="<?=$tmpwhere;?>" onfocus="emptyzip();"      <?=($waitGeoIP ? "class=\"ac_loading\" disabled=\"disabled\"" : "")?> onkeypress="return submitenter(this,event)" <?if ((MODREWRITE_FEATURE == "on" && !$searchNotFriendly)) echo "onkeyup=\"changeFormAction('".$action."', document.getElementById('keyword').value, this.value)\""?> />
					

					<p><?=system_showText(LANG_LABEL_SEARCHWHERETIP);?></p>

				</fieldset>

				<?

				$js_fileLoader = system_scriptColectorOnReady("


					$('#where').autocomplete(

						'".AUTOCOMPLETE_LOCATION_URL."',

							{

								delay:100,

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
	<? if (ZIPCODE_PROXIMITY == "on" && false) { ?>
	<div style="width:100%; float:left;">
		<label><?=string_ucwords("DISTANCE BY ZIPCODE")?>:</label>
		<div class="left zipcode"  style="width: 125px;float:left;clear:none;padding-top:0px;">
                <div style="float: left;">
                    <input type="text" style="width:105px;" name="dist" value="<?=($dist)? $dist : "100" ?>" class="text" />
                    <?=string_ucwords(ZIPCODE_UNIT_LABEL_PLURAL)." ".system_showText(LANG_SEARCH_LABELZIPCODE_OF)?>
                </div>
			</div>
		<div class="left zipcode"  style="width: 125px; float:left; clear:none; padding-top:0px; margin-left:0px;">
			<div style="float: left;"><fieldset>
				<input type="text" style="width:105px;" id="zip" name="zip" value="<?=isset($_SESSION["s_zip"])? $_SESSION["s_zip"] : "" ?>" class="text" />
				<?=(ZIPCODE_PROXIMITY == "on" ? string_ucwords(ZIPCODE_LABEL) : "")?></fieldset>
			</div>
		</div>
	</div>			
    <? } ?>			


	
</div>
	<?	if ($hasAdvancedSearch  && !$keepFormOpen) {

			$template_id = $template_id ? $template_id : 0; 
			
	?>

			<div id="advanced-search" style="display:none;">

				<? include(EDIRECTORY_ROOT."/advancedsearch.php") ?>

			</div>

	<? } ?>
			
			
<div id="search">			
            <? if (!$keepFormOpen) { ?>

                <div class="left">
                    <button type="button" id="buttonSearch" onclick="submitformSearch('<?=$action?>');"><?=system_showText(LANG_BUTTON_SEARCH);?></button>

                    <? 

                    if ($hasAdvancedSearch) {

                        $aux_template_id = $template_id;

                    ?>

                    <a id="advanced-search-button" href="javascript:void(0);" onclick="showAdvancedSearch('<?=$advancedSearchItem?>', '<?=$action?>', '<?=$action_adv?>','<?=$aux_template_id?>', true);">
<?/*?>
                        <span id="advanced-search-label" style="display:inline">Refine Your Search (Advanced)<?//=system_showText(LANG_BUTTON_ADVANCEDSEARCH);?></span>
                        <span id="advanced-search-label-close" style="display:none"><?=system_showText(LANG_BUTTON_ADVANCEDSEARCH_CLOSE);?></span>
<?*/?>
                    </a>

                    <? } ?>
                </div>

             <? } ?>



		</div>


	<?	/* if ($hasAdvancedSearch  && !$keepFormOpen) {


			$template_id = $template_id ? $template_id : 0; ?>

			<div id="advanced-search" style="display:none;">

				<? include(EDIRECTORY_ROOT."/advancedsearch.php") ?>

			</div>

	<? } */ ?>
		
		 










<? if (!$keepFormOpen) { ?>
	
	<script type="text/javascript">
	<? if ($_SESSION["s_zip"]=="" && false) {?>
		closeAdvancedSearch('<?=$advancedSearchItem?>', '<?=$action?>', '<?=$action_adv?>','<?=$aux_template_id?>');
	<? } else {?>
		showAdvancedSearch('<?=$advancedSearchItem?>', '<?=$action?>', '<?=$action_adv?>','<?=$aux_template_id?>', true); 
	<? }?>
	</script>
<? } ?>