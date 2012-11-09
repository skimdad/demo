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
	# * FILE: /includes/forms/form_event.php
	# ----------------------------------------------------------------------------------------------------

	if (string_strpos($_SERVER["HTTP_REFERER"], "members/advertise.php") == true) { ?>
		<input type="hidden" name="from_advertise" value="yes" />
	<? } ?>   
        
<a href="#" id="info_window" class="iframe fancy_window_categPath" style="display:none"></a> 

<script language="javascript"  type="text/javascript">

    // ---------------------------------- //
    
    function JS_addCategory(text, id) {

		seed = document.form_event.seed;
		feed = document.form_event.feed;

		var flag=true;
		for (i=0;i<feed.length;i++)
			if (feed.options[i].value==id)
				flag=false;
				
		if(text && id && flag){
			feed.options[feed.length] = new Option(text, id);
			$('#categoryAdd'+id).after("<span class=\"categorySuccessMessage\"><?=system_showText(LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED)?></span>").css('display', 'none');
			$('.categorySuccessMessage').fadeOut(5000);
		} else {
			if (!flag) $('#categoryAdd'+id).after("</a> <span class=\"categoryErrorMessage\"><?=system_showText(LANG_MSG_CATEGORY_ALREADY_INSERTED)?></span> </li>");  
            else ('#categoryAdd'+id).after("</a> <span class=\"categoryErrorMessage\"><?=system_showText(LANG_MSG_SELECT_VALID_CATEGORY)?></span> </li>");
		}

	}

	// ---------------------------------- //

	function JS_submit() {
	
		feed = document.form_event.feed;
		return_categories = document.form_event.return_categories;
		if(return_categories.value.length > 0) return_categories.value="";
		
		for (i=0;i<feed.length;i++) {
			if (!isNaN(feed.options[i].value)) {
				if(return_categories.value.length > 0)
				return_categories.value = return_categories.value + "," + feed.options[i].value;
				else
			return_categories.value = return_categories.value + feed.options[i].value;
			}
		}
		
		document.form_event.submit();
	}
    
    // ---------------------------------- //

    function showLangFields(type1, type2, type3, num_language, languages) {
        
        var arrLangNumbers = ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');

        for (j=0;j<languages;j++) {
			i = arrLangNumbers[j];
			jQuery('#'+type1+'_'+i).css('display', 'none');
			jQuery('#tab_'+type1+'_'+i).removeClass("tabActived");
			jQuery('#'+type2+'_'+i).css('display', 'none');
			jQuery('#tab_'+type2+'_'+i).removeClass("tabActived");
			jQuery('#'+type3+'_'+i).css('display', 'none');
			jQuery('#tab_'+type3+'_'+i).removeClass("tabActived");
        }    
		jQuery('#'+type1+'_'+num_language).css('display', '');
		jQuery('#tab_'+type1+'_'+num_language).addClass("tabActived");
		jQuery('#'+type2+'_'+num_language).css('display', '');
		jQuery('#tab_'+type2+'_'+num_language).addClass("tabActived");
		jQuery('#'+type3+'_'+num_language).css('display', '');
		jQuery('#tab_'+type3+'_'+num_language).addClass("tabActived");
    }
	
	// ---------------------------------- //

	function makeMain(image_id,thumb_id,item_id,temp,item_type) {

		var xmlhttp;

		try {
			xmlhttp = new XMLHttpRequest();
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					xmlhttp = false;
				}
			}
		}

		if (xmlhttp) {
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4) {
					if (xmlhttp.status == 200) {
						response =  xmlhttp.responseText;
						<? if ($members) { ?>
							loadGallery(item_id, 'y', 'members', '', 'true');
						<? } else { ?>
							loadGallery(item_id, 'y', 'sitemgr', '', 'true');
						<? } ?>
					}
				}
			}

			xmlhttp.open("GET", "<?=DEFAULT_URL;?>/makemainimage.php?gallery_hash=<?=$gallery_hash?>&image_id="+image_id+"&thumb_id="+thumb_id+"&item_id="+item_id+"&temp="+temp+"&item_type="+item_type+"&domain_id=<?=SELECTED_DOMAIN_ID;?>", true);
			xmlhttp.send(null);
		}
	}
	
	// ---------------------------------- //

	function changeMain(image_id,thumb_id,item_id,temp,gallery_id,item_type) {

		var xmlhttp;

		try {
			xmlhttp = new XMLHttpRequest();
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					xmlhttp = false;
				}
			}
		}

		if (xmlhttp) {
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4) {
					if (xmlhttp.status == 200) {
						response =  xmlhttp.responseText;
						if (response == "error"){
							fancy_alert('<?=system_showText(LANG_ITEM_ALREADY_HAD_MAX_IMAGE)?>', 'errorMessage', false, 500, 100, false);
						}
						<? if ($members) { ?>
							loadGallery(item_id,'y','members','','true');
						<? } else { ?>
							loadGallery(item_id,'y','sitemgr','','true');
						<? } ?>
					}
				}
			}

			xmlhttp.open("GET", "<?=DEFAULT_URL;?>/changemainimage.php?gallery_hash=<?=$gallery_hash?>&image_id="+image_id+"&thumb_id="+thumb_id+"&item_id="+item_id+"&gallery_id="+gallery_id+"&temp="+temp+"&item_type="+item_type+"&domain_id=<?=SELECTED_DOMAIN_ID;?>"+"&level=<?=$level;?>", true);
			xmlhttp.send(null);
		}
	}
	
	// ---------------------------------- //

	function loadGallery(id, new_image, sess, del, main) {

		var xmlhttp;

		try {
			xmlhttp = new XMLHttpRequest();
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					xmlhttp = false;
				}
			}
		}

		if (xmlhttp) {
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4) {
					if (xmlhttp.status == 200) {
							$("#galleryF").html(xmlhttp.responseText);

							if (del != "edit" && del != "editFe"){
								if (del == "n"){
									$("#addImage").css("display", "none");
									$("#galleryF").css("display", "");
								} else {
									<? if ($hasImage){ ?>
										if(del) {
											$("#addImage").css("display", "none");
											$("#galleryF").css("display", "");
										} else {
											$("#addImage").css("display", "");
											$("#galleryF").css("display","none");
										}
									<? } else { ?>
										$("#addImage").css("display", "");
										$("#galleryF").css("display", "none");
									<? } ?>
								}
							} else {
								if (del == "edit" || del == "editFe"){
                                    $("#galleryF").css("display", "");
                                }	
							}

							if (main == "true") {
								$("#galleryF").css("display", "");
							}
							<? if ($hasImage){ ?>
								$("#galleryF").css("display", "");
							<? } ?>

							if (xmlhttp.responseText == "no image"){
								$("#galleryF").css("display", "none");
							}
							$("#galleryF").html(xmlhttp.responseText);
                            $("a.fancy_window_imgAdd").fancybox({
                                'overlayShow'			: true,
                                'overlayOpacity'		: 0.75,
                                'autoDimensions'        : false,
                                'width'                 : <?=FANCYBOX_UPIMAGE_WIDTH?>,
                                'height'                : <?=FANCYBOX_UPIMAGE_HEIGHT?>
                            });

                            $("a.fancy_window_imgDelete").fancybox({
                                'overlayShow'			: true,
                                'overlayOpacity'		: 0.75,
                                'autoDimensions'        : false,
                                'width'                 : <?=FANCYBOX_DELIMAGE_WIDTH?>,
                                'height'                : <?=FANCYBOX_DELIMAGE_HEIGHT?>
                            });
					}
				}
			}

			xmlhttp.open("GET", "<?=DEFAULT_URL;?>/includes/code/returngallery.php?gallery_hash=<?=$gallery_hash?>&domain_id=<?=SELECTED_DOMAIN_ID?>&id="+id+"&new_image="+new_image+"&main="+main+"&sess="+sess+"&module=event&level=<?=$level?>", true);
			xmlhttp.send(null);
		}
	}
	
	// ---------------------------------- //

	function recurringcheck() {
        if (document.getElementById("recurring").checked==true){
            document.getElementById("reccuring_events").style.display='';
            document.getElementById("reccuring_ends").style.display='';
            document.getElementById("end_date").disabled=true;
			document.getElementById("labelEndDate").style.display='none';
            chooseperiod(document.getElementById("period").value);
			if (document.getElementById("eventEver").checked==true){
				document.getElementById("until_date").disabled=true;
			} else {
				document.getElementById("until_date").disabled=false;
			}

        }else{
            document.getElementById("reccuring_events").style.display='none';
            document.getElementById("reccuring_ends").style.display='none';
			document.getElementById("end_date").disabled=false;
			document.getElementById("labelEndDate").style.display='';
        }
    }
	
	// ---------------------------------- //

	function chooseperiod(value){
        if (value=="daily" || value=="" ){
            document.getElementById("select_day").style.display='none';
            document.getElementById("select_week").style.display='none';
            document.getElementById("day").disabled=true;
            document.getElementById("week").disabled=true;
            document.getElementById("dayofweek").disabled=true;
			for (i=0;i<7;i++){
				document.getElementById("dayofweek_"+i).disabled=true;
			}
			for (i=0;i<5;i++){
				document.getElementById("numberofweek_"+i).disabled=true;
			}
            document.getElementById("month").disabled=true;
        }else if(value=='weekly'){
            document.getElementById("select_day").style.display='none';
            document.getElementById("of").style.display='none';
            document.getElementById("week_of").style.display='none';
            document.getElementById("of2").style.display='';
            document.getElementById("of3").style.display='none';
            document.getElementById("of4").style.display='none';
            document.getElementById("month_of").style.display='none';
            document.getElementById("week").style.display='none';
            document.getElementById("weeklabel").style.display='none';
            document.getElementById("month").style.display='none';
            document.getElementById("month2").style.display='none';
            document.getElementById("select_week").style.display='';

            document.getElementById("day").disabled=true;
            document.getElementById("dayofweek").disabled=false;
			for (i=0;i<7;i++){
				document.getElementById("dayofweek_"+i).disabled=false;
			}
			for (i=0;i<5;i++){
				document.getElementById("numberofweek_"+i).disabled=false;
			}
            document.getElementById("week").disabled=true;
            document.getElementById("month").disabled=true;
            document.getElementById("month2").disabled=true;
            document.getElementById("precision1").style.display='none';
            document.getElementById("precision2").style.display='none';

        }else if(value=='monthly'){
            document.getElementById("precision1").style.display='';
            document.getElementById("precision2").style.display='';
            document.getElementById("precision2").checked=true;
            document.getElementById("select_day").style.display='';
            document.getElementById("of").style.display='';
            document.getElementById("week_of").style.display='';
            document.getElementById("of2").style.display='none';
            document.getElementById("of3").style.display='none';
            document.getElementById("of4").style.display='';
            document.getElementById("month_of").style.display='none';
            document.getElementById("week").style.display='';
            document.getElementById("weeklabel").style.display='';
            document.getElementById("month").style.display='none';
            document.getElementById("month2").style.display='none';
            document.getElementById("select_week").style.display='';

            document.getElementById("day").disabled=true;
            document.getElementById("dayofweek").disabled=false;
			for (i=0;i<7;i++){
				document.getElementById("dayofweek_"+i).disabled=false;
			}
			for (i=0;i<5;i++){
				document.getElementById("numberofweek_"+i).disabled=false;
			}
            document.getElementById("week").disabled=false;
            document.getElementById("month").disabled=false;
            document.getElementById("month2").disabled=true;

        }else if(value=='yearly'){
            document.getElementById("select_day").style.display='';
            document.getElementById("of").style.display='';
            document.getElementById("week_of").style.display='';
            document.getElementById("of2").style.display='';
            document.getElementById("of3").style.display='';
            document.getElementById("of4").style.display='none';
            document.getElementById("month_of").style.display='';
            document.getElementById("week").style.display='';
            document.getElementById("weeklabel").style.display='';
            document.getElementById("month").style.display='';
            document.getElementById("month2").style.display='';
            document.getElementById("select_week").style.display='';
            document.getElementById("precision1").style.display='';
            document.getElementById("precision2").style.display='';
			document.getElementById("precision2").checked=true;
            document.getElementById("day").disabled=true;
            document.getElementById("dayofweek").disabled=false;
			for (i=0;i<7;i++){
				document.getElementById("dayofweek_"+i).disabled=false;
			}
			for (i=0;i<5;i++){
				document.getElementById("numberofweek_"+i).disabled=false;
			}
            document.getElementById("week").disabled=false;
            document.getElementById("month").disabled=true;
            document.getElementById("month2").disabled=false;
        }
    }
	
	// ---------------------------------- //
	
    function chooseprecision(value){

        if (value=='day'){

			var start_date = $("#start_date").val();
			var date_format = '<?=DEFAULT_DATE_FORMAT;?>';
			var arrStDate = start_date.split("/");
			if (date_format == 'd/m/Y') {
				var defDay = arrStDate[0];
				var defMonth = arrStDate[1];
			} else if (date_format == 'm/d/Y') {
				var defDay = arrStDate[1];
				var defMonth = arrStDate[0];
			}

			if ($("#day").val() == "") {
				$("#day").val(defDay);
			}

			if ($("#month option:selected").val() == "") {
				var nMonth = document.getElementById("month");
				nMonth[(defMonth - 1) + 1].selected = true;
			}

            document.getElementById("day").disabled=false;
            document.getElementById("dayofweek").disabled=true;
			for (i=0;i<7;i++){
				document.getElementById("dayofweek_"+i).disabled=true;
			}
			for (i=0;i<5;i++){
				document.getElementById("numberofweek_"+i).disabled=true;
			}
            document.getElementById("week").disabled=true;
            document.getElementById("month").disabled=false;
            document.getElementById("month2").disabled=true;
            document.getElementById("precision1").checked=true;
            document.getElementById("precision2").checked=false;
        } else if (value=='weekday') {
            document.getElementById("day").disabled=true;
            document.getElementById("dayofweek").disabled=false;
			for (i=0;i<7;i++){
			 document.getElementById("dayofweek_"+i).disabled=false;
			}
			for (i=0;i<5;i++){
			 document.getElementById("numberofweek_"+i).disabled=false;
			}
            document.getElementById("week").disabled=false;
            document.getElementById("month").disabled=true;
            document.getElementById("month2").disabled=false;
        } else {
            document.getElementById("day").disabled=true;
            document.getElementById("dayofweek").disabled=false;
			for (i=0;i<7;i++){
				document.getElementById("dayofweek_"+i).disabled=false;
			}
			for (i=0;i<5;i++){
				document.getElementById("numberofweek_"+i).disabled=false;
			}
            document.getElementById("week").disabled=false;
            document.getElementById("month").disabled=true;
            document.getElementById("week2").disabled=false;
        }
    }
	
	// ---------------------------------- //

	function enableUntil(op){
		if (op==1){
			document.getElementById("until_date").disabled=true;
		} else if (op==2){
			document.getElementById("until_date").disabled=false;
		}
	}
	
	var arrLangNumbers	= ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');
	<? if (is_array($array_fields) && in_array("summary_description", $array_fields)){ ?>
	$(document).ready(function(){
		
		for (j=0;j<arrLangNumbers.length;j++) {
			i = arrLangNumbers[j];
			var field_name = 'summarydesc'+i;
			var count_field_name = 'summarydesc_remLen'+i;

			var options = {
						'maxCharacterSize': 250,
						'originalStyle': 'originalTextareaInfo',
						'warningStyle' : 'warningTextareaInfo',
						'warningNumber': 40,
						'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name+'" name="'+count_field_name+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
				};
			$('#'+field_name).textareaCount(options);

		}
		
	});
	<? } ?>
	
</script>

<?  // Account Search Javascript /////////////////////////////////////////////////////// ?>

<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>

<?  //////////////////////////////////////////////////////////////////////////////////// ?>

<?
	echo "<p class=\"informationMessage\">* ".system_showText(LANG_LABEL_REQUIRED_FIELD)." </p>";

	if ($message_event) {
		echo "<p class=\"errorMessage\">".$message_event."</p>";
	}
?>
<? // Display Level ////////////////////////////////////////////////////////////////// ?>
<?php
$level_name = "";
if ($level) {
	$levelObjTMP = new EventLevel();
	$level_name = $levelObjTMP->getLevel($level);
}
?>
<table class="levelTable">
	<tr>
		<th class="levelTitle"><?=system_showText(LANG_EVENT_LEVEL);?></th>
	</tr>
	<tr>
		<th class="tableSelectedOption"><?=ucfirst($level_name); ?></th>
	</tr>
</table>

<? // Account Search ////////////////////////////////////////////////////////////////// ?>
<? if (!$members) { ?>

	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?> <span><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_TOACCOUNT_SPAN)?></span></th>
		</tr>
	</table>

	<?
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT_DEFAULT);
	$acct_search_field_name = "account_id";
	$acct_search_field_value = $account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "95%";
	$acct_search_cell_width = "";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width);
	echo $return;
	?>

<? } ?>
<? //////////////////////////////////////////////////////////////////////////////////// ?>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_INFORMATION);?></th>
	</tr>
	<tr>
		<th>* <?=system_showText(LANG_EVENT_TITLE)?>:</th>
		<td>
			<input type="text" name="title" value="<?=$title?>" maxlength="100" <?=(!$id) ? " onblur=\"easyFriendlyUrl(this.value, 'friendly_url', '".FRIENDLYURL_VALIDCHARS."', '".FRIENDLYURL_SEPARATOR."');\" " : ""?> />
			<input type="hidden" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" />
		</td>
	</tr>

	<? if (is_array($array_fields) && in_array("email", $array_fields)){ ?>
        <tr>
            <th><?=system_showText(LANG_LABEL_EMAIL)?>:</th>
            <td><input type="text" name="email" value="<?=$email?>" /></td>
        </tr>
    <? } ?>

	<? if (is_array($array_fields) && in_array("url", $array_fields)){ ?>
		<tr>
			<th><?=system_showText(LANG_LABEL_URL)?>:</th>
			<td>
			<select name="url_protocol" class="httpSelect">
			<?
			$url_protocols 	= explode(",", URL_PROTOCOL);
			$sufix   			= "://";
			$protocol_replace 	= "" ;
			for ($i=0; $i<count($url_protocols); $i++) {
				$selected = false;
				$protocol = $url_protocols[$i];
				if (isset($url) || isset($url_protocol)) {
					if ($url && !$url_protocol) {
						$_protocol = explode($sufix, $url);
						$_protocol = $_protocol[0];
					} else if ($url_protocol) {
						$_protocol = str_replace($sufix, "", $url_protocol);
					}
					if ($_protocol == $protocol) {
						$selected = true;
						$protocol_replace = $_protocol.$sufix;
					}
				} else if (!isset($id) && !$i) {
					$selected = true;
					$protocol_replace = $url_protocols[$i];
					$protocol_replace = $protocol_replace.$sufix;
				}
				$protocol .= $sufix;
			?>
			<option value="<?=$protocol?>"  <?=($selected==true  ? "selected=\"selected\"" : "")?> ><?=$protocol?></option>
			<?
			}
			?>
			</select>
			<input type="text" class="httpInput" name="url" value="<?=str_replace($protocol_replace, "", $url)?>" maxlength="255" />
			</td>
		</tr>
    <? } ?>
	<tr>
		<th><?=system_showText(LANG_LABEL_PHONE)?>:</th>
		<td><input type="text" name="phone" value="<?=$phone?>" /></td>
	</tr>

    <? if (is_array($array_fields) && in_array("contact_name", $array_fields)){ ?>
		<tr>
			<th><?=system_showText(LANG_LABEL_CONTACT_NAME)?>:</th>
			<td><input type="text" name="contact_name" value="<?=$contact_name?>" /></td>
		</tr>
    <? } ?>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table noMargin">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_LOCATIONS)?></th>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_LOCATION_NAME)?>:</th>
		<td><input type="text" name="location" value="<?=$location?>" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_STREET_ADDRESS)?>:</th>
		<td><input type="text" name="address" id="address" <?=($loadMap ? "onblur=\"loadMap(document.form_event);\"" : "")?> value="<?=$address?>" /></td>
	</tr>
    
	<tr>
		<th><?=string_ucwords(ZIPCODE_LABEL)?>:</th>
		<td><input type="text" name="zip_code" id="zip_code" <?=($loadMap ? "onblur=\"loadMap(document.form_event);\"" : "")?> value="<?=$zip_code?>" maxlength="10" /></td>
	</tr>
    
    <? if ($loadMap) { ?>
    <tr>
		<th><?=system_showText(LANG_LABEL_LATITUDE)?>:</th>
		<td>
            <input type="text" name="latitude" id="latitude" <?=($loadMap ? "onblur=\"loadMap(document.form_event, true);\"" : "")?> value="<?=$latitude?>" maxlength="10" />
            <span>Ex: 38.830391</span>
        </td>
	</tr>
    
    <tr>
		<th><?=system_showText(LANG_LABEL_LONGITUDE)?>:</th>
		<td>
            <input type="text" name="longitude" id="longitude" <?=($loadMap ? "onblur=\"loadMap(document.form_event, true);\"" : "")?> value="<?=$longitude?>" maxlength="10" />
            <span>Ex: -77.196370</span>
        </td>
	</tr>
    <? } ?>
</table>	
<? include(EDIRECTORY_ROOT."/includes/code/load_location.php"); 

 if ($loadMap){
               
        include(EDIRECTORY_ROOT."/includes/code/maptuning_forms.php");
 
?>
<table cellpadding="0" cellspacing="0" border="0" class="standard-table noMargin" id="tableMapTuning" <?=($hasValidCoord ? "" : "style=\"display: none\"" )?>>
	<tr>
		<th colspan="2" class="standard-tabletitle">
            <?=system_showText(LANG_LABEL_MAP_TUNING)?> 
            <span style="display: block; white-space: normal;" id="divDisplayMap">
                <a id="linkDisplayMap" href="javascript:void(0)" onclick="displayMapForm(document.form_event, false);">
                    <?=(($_COOKIE['showMapForm'] == 0) ? (system_showText(LANG_LABEL_HIDEMAP)) : (system_showText(LANG_LABEL_SHOWMAP)))?>
                </a>
            </span>
            <div id="tipsMap">
                <span style="text-align: justify;"><?=system_showText(LANG_MSG_USE_CONTROLS_TO_ADJUST)?></span>
                <br />
                <span style="text-align: justify;"><?=system_showText(LANG_MSG_USE_ARROWS_TO_NAVIGATE)?></span>
                <br />
                <span style="text-align: justify;"><?=system_showText(LANG_MSG_DRAG_AND_DROP_MARKER)?></span>
            </div>
        </th>
	</tr>
        
    <tr>
		<td>
            <div id="map" class="googleBase" style="border: 1px solid #000;">&nbsp;</div>
            <input type="hidden" name="latitude_longitude" id="myLatitudeLongitude" value="<?=$latitude_longitude?>" />
            <input type="hidden" name="map_zoom" id="map_zoom" value="<?=$map_zoom?>" />
            <input type="hidden" name="maptuning_done" id="maptuning_done" value="<?=$maptuning_done?>" />
        </td>
	</tr>
    
</table>

<? } ?>

<table id="range_date" border="0" cellpadding="0" cellspacing="0" class="standard-table noMargin">
    <tr>
        <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_EVENT_DATE)?></th>
    </tr>
    <tr>
        <th class="alignTop">* <?=system_showText(LANG_LABEL_START_DATE)?>:</th>
		<td>
			<input type="text" name="start_date" id="start_date" value="<?=$start_date?>" style="width:80px" /><span>(<?=format_printDateStandard()?>)</span>
		</td>
    </tr>
    <tr id="labelEndDate">
        <th class="alignTop">* <?=system_showText(LANG_LABEL_END_DATE)?>:</th>
        <td>
			<input type="text" name="end_date" id="end_date" value="<?=$end_date?>" style="width:80px" /><span>(<?=format_printDateStandard()?>)</span>
		</td>
    </tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table noMargin">
    <? if (is_array($array_fields) && in_array("start_time", $array_fields)){ ?>
    	<tr>
			<th><?=system_showText(LANG_LABEL_START_TIME)?>:</th>
			<td>
				<?=$start_time_hour_DD?> : <?=$start_time_min_DD?>
                <? if (CLOCK_TYPE == '12') { ?>
				    <input type="radio" name="start_time_am_pm" value="am" <? if ($start_time_am_pm == "am") echo "checked"; ?> class="inputRadio" /> AM <input type="radio" name="start_time_am_pm" value="pm" <? if ($start_time_am_pm == "pm") echo "checked"; ?> class="inputRadio" /> PM (hh:mm)
                <? } ?>
			</td>
		</tr>
    <? } ?>
        
    <? if (is_array($array_fields) && in_array("end_time", $array_fields)){ ?>
		<tr>
			<th><?=system_showText(LANG_LABEL_END_TIME)?>:</th>
			<td>
				<?=$end_time_hour_DD?> : <?=$end_time_min_DD?>
                <? if (CLOCK_TYPE == '12') { ?>
				    <input type="radio" name="end_time_am_pm" value="am" <? if ($end_time_am_pm == "am") echo "checked"; ?> class="inputRadio" /> AM <input type="radio" name="end_time_am_pm" value="pm" <? if ($end_time_am_pm == "pm") echo "checked"; ?> class="inputRadio" /> PM (hh:mm)
                <? } ?>
			</td>
		</tr>
    <? } ?>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table noMargin">
    <tr>
        <th>
            <input type="checkbox" id="recurring" name="recurring" value="Y" <? if ($recurring == "Y") { echo "checked"; } ?> onclick="recurringcheck();" />
        </th>
        <td>
            <?=system_showText(LANG_EVENT_RECURRING)?>
        </td>
    </tr>
</table>

<table id="reccuring_events" border="0" cellpadding="0" cellspacing="0" class="standard-table noMargin" style="display:none;">
    <tr>
        <th>
            * <?=system_showText(LANG_PERIOD)?>:
        </th>
        <td class="eventRec">
            <select id="period" name="period" style="width:135px;" onchange="chooseperiod(this.value)">
                <option value=""><?=system_showText(LANG_CHOOSE_PERIOD)?></option>
                <option value="daily"  <?=($period=="daily")?" selected=\"selected\"":""?>><?=system_showText(LANG_DAILY)?></option>
                <option value="weekly" <?=($period=="weekly")?" selected=\"selected\"":""?>><?=system_showText(LANG_WEEKLY)?></option>
                <option value="monthly"<?=($period=="monthly")?" selected=\"selected\"":""?>><?=system_showText(LANG_MONTHLY)?></option>
                <option value="yearly" <?=($period=="yearly")?" selected=\"selected\"":""?>><?=system_showText(LANG_YEARLY)?></option>
            </select>
        </td>
    </tr>

    <tr id="select_day" style="display:none;">
        <th>
            <input type="radio" id="precision1" name="precision" value="day" <? if ($precision == "day") { echo "checked"; } ?> onclick="chooseprecision(this.value)"  />
        </th>
        <td class="eventRec">
            <?
            $month_names = explode(",", LANG_DATE_MONTHS);
            $weekday_names = explode(",", LANG_DATE_WEEKDAYS);
            ?>
            * <?=system_showText(LANG_EVERY2)." ".system_showText(LANG_DAY)?> &nbsp;<input type="text" id="day" name="day" style="width:30px;" value="<?=($day == 0? "": $day)?>" maxlength="2"><label id="of2" for="month">&nbsp;&nbsp;* <?=system_showText(LANG_OF2)?>&nbsp;&nbsp;</label><label id="of4" for="month">&nbsp;&nbsp; <?=system_showText(LANG_OF4)?>&nbsp;<?=system_showText(LANG_THE_MONTH)?>&nbsp;&nbsp;</label>
			<select id="month" name="month" style="width:120px;" >
				<option value=""><?=system_showText(LANG_CHOOSE_MONTH)?></option>
				<? for ($i=0;$i<12;$i++){
					echo "<option value=\"".($i+1)."\" ".((($i+1)==$month && $precision=="day")?" selected=\"selected\"":"").">".ucfirst($month_names[$i])."</option>\n";
				}?>

			</select>
        </td>

    </tr>
    <tr id="select_week" >
		<th class="alignTop inputAlign">
            <input type="radio" id="precision2" name="precision" value="weekday" <? if ($precision == "weekday") { echo "checked"; } ?> onclick="chooseprecision(this.value)" />
        </th>
        <td class="eventRec">
        	<table cellpadding="0" cellspacing="0">
          	<tr>
				<td class="eventRecLabel alignTop nowrap"><abbr id="every">* <?=system_showText(LANG_EVERY)?></abbr></td>
			  <td>
				  <table id="dayofweek" border="0" cellpadding="0" cellspacing="0" class="standard-table noMargin">
				  <tr>
					  <?
						$array_dayofweek = explode(",",$dayofweek);

						foreach ($weekday_names as $k=>$day_name) {
							echo "<td class=\"widthAuto center\"><input type=\"checkbox\" id=\"dayofweek_$k\" name=\"dayofweek_$k\" ".(in_array($k+1,$array_dayofweek) ? "checked" : "")." class=\"inputCheck\"/><br />".ucfirst(string_substr($day_name, 0, 3))."</td>";
						}
					  ?>
				  </tr>
				  </table>
			  </td>
            </tr>
            <tr id="week_of" style="display:none;">
				<td class="eventRecLabel alignTop nowrap"><abbr id="of">* <?=system_showText(LANG_OF3)?></abbr></td>
				<td>
				  <table id="week" border="0" cellpadding="0" cellspacing="0" class="standard-table noMargin">
				  <tr>
					  <?
						$array_numberofweek = explode(",",$week);
						$numbers_week = array(0=>LANG_FIRST,1=>LANG_SECOND,2=>LANG_THIRD,3=>LANG_FOURTH,4=>LANG_LAST);
						foreach ($numbers_week as $k=>$name) {
							echo "<td class=\"center nowrap\"><input type=\"checkbox\" id=\"numberofweek_$k\" name=\"numberofweek_$k\" ".(in_array($k+1,$array_numberofweek) ? "checked" : "")." class=\"inputCheck inputAlign inputAlignNoMargin\"/><br />".ucfirst($name)."</td>";
						}
					  ?>
				  </tr>

				  </table>
				</td>
			  <td id="weeklabel" class="alignTop"><?=system_showText(LANG_WEEK)?></td>
            </tr>
            <tr id="month_of" style="display:none;">
          		<td class="eventRecLabel"><abbr id="of3">* <?=system_showText(LANG_OF2)?></abbr></td>
              <td>
              	<select id="month2" name="month">
                    <option value=""><?=system_showText(LANG_CHOOSE_MONTH)?></option>
                    <? for ($i=0;$i<12;$i++){
                        echo "<option value=\"".($i+1)."\" ".((($i+1)==$month && $precision=="weekday")?" selected=\"selected\"":"").">".ucfirst($month_names[$i])."</option>\n";
                    }?>
                </select>
              </td>
            </tr>
          </table>
        </td>
    </tr>
</table>

<table id="reccuring_ends" border="0" cellpadding="0" cellspacing="0" class="standard-table" style="display:none;">
	<tr>
        <th class="alignMiddle">
            * <?=system_showText(LANG_ENDS_IN)?>:
        </th>
        <td class="eventRec">
         <table id="dayofweek" border="0" cellpadding="0" cellspacing="0" class="standard-table noMargin">
          <tr>
          	<td>
              <input type="radio" id="eventEver" name="eventPeriod" value="ever" <? if (!$until_date || $eventPeriod == "ever") echo "checked=\"checked\"" ?> class="inputRadio" onclick="enableUntil('1');"/> <?=system_showText(LANG_NEVER)?><span class="clear"></span>
              <input type="radio" id="eventUntil" name="eventPeriod" value="until" <? if ($until_date || $eventPeriod =="until") echo "checked=\"checked\"" ?> class="inputRadio" onclick="enableUntil('2');" /> <?=system_showText(LANG_UNTIL)?>: <input type="text" <? if (!$until_date && $eventPeriod == "ever") echo "disabled" ?> name="until_date" id="until_date" value="<?=$until_date?>" style="width:80px" /> <span class="inline">(<?=format_printDateStandard()?>)</span>
            </td>
          </tr>
			  </table>
        </td>
    </tr>
</table>

<? if ((is_array($array_fields) && in_array("main_image", $array_fields)) || $levelMaxImages > 0) { ?>
	<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
		<tr>
			<th colspan="3" class="standard-tabletitle"><?=($onlyMainImage ? system_showText(LANG_LABEL_IMAGE) : system_showText(LANG_LABEL_IMAGE_PLURAL))?> <span>(<?=IMAGE_EVENT_FULL_WIDTH?>px x <?=IMAGE_EVENT_FULL_HEIGHT?>px) (JPG, GIF <?=system_showText(LANG_OR);?> PNG)</span></th>
		</tr>
        
		<tr id="table_gallery">
			<th class=Full>
				<div id="galleryF"></div>
			</th>
		</tr>

		<?
		$gallery_id = $event->getGalleries();
		if ($onlyMainImage){
		?>
			<tr id="addImage" style="display:<?=($image_id ? 'none' : '');?>">
		<? } else { ?>
			<tr>
		<? } ?>
                <td class="alignTop width100">
                   
                    <? if ($members) { ?>
                        <a id="uploadimage" href="<?=DEFAULT_URL?>/popup/popup.php?domain_id=<?=SELECTED_DOMAIN_ID?>&pop_type=uploadimage&gallery_hash=<?=$gallery_hash?>&item_type=event&item_id=<?=$event->getNumber("id")?>&galleryid=<?=$gallery_id[0]?>&photos=<?=$levelMaxImages?>&level=<?=$level?>" class="addImageForm input-button-form iframe fancy_window_imgAdd"><?=system_showText(LANG_LABEL_ADDIMAGE)?></a>
                    <? } else { ?>
                        <a id="uploadimage" href="<?=DEFAULT_URL?>/sitemgr/uploadimage.php?gallery_hash=<?=$gallery_hash?>&item_type=event&item_id=<?=$event->getNumber("id")?>&galleryid=<?=$gallery_id[0]?>&photos=<?=$levelMaxImages?>&level=<?=$level?>" class="addImageForm input-button-form iframe fancy_window_imgAdd"><b><?=system_showText(LANG_LABEL_ADDIMAGE)?></b></a>
                    <? } ?>
                    
                    <span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></span>
                    
                    <? if ($levelMaxImages > 0){ ?>
                        <p class="informationMessage"><?=system_showText(LANG_MSG_EVENT_WILL_SHOW)?> <?=(($levelMaxImages == -1) ? (system_showText(LANG_LABEL_UNLIMITED)) : (system_showText(LANG_MSG_THE_MAX_OF)." ".$levelMaxImages))." ".(($levelMaxImages == 1) ? (LANG_MSG_GALLERY_PHOTO) : (LANG_MSG_GALLERY_PHOTOS)) ?> <?=system_showText(LANG_MSG_PER_GALLERY)?><?=($hasMainImage ? " ".system_showText(LANG_MSG_PLUS_MAINIMAGE) : ".")?></p>
                    <? } ?>
                </td>
		</tr>	
	</table>
<? } ?>

<div class="multilanguageContent">

	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		
		<tr>
			<th class="tabsBase">
				<?
				$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
				$num_languages = count(explode(",", EDIR_LANGUAGENAMES));
				$language_numbers = explode(",", EDIR_LANGUAGENUMBERS);
				$labelsuffix = "";
				?>
				<ul class="tabs">
					<? foreach ($language_numbers as $k=>$i) { ?>
						<li id="tab_summary_<?=$i?>" <?=($k == 0) ? "class=\"tabActived\"" : ""?>><a href="javascript:void(0)" onclick="showLangFields('summary', 'detail', 'keywords', '<?=$i?>', '<?=$num_languages?>')"><?=$array_edir_languagenames[$k]?></a></li>
					<? } ?>
				</ul>
			</th>
		</tr>
			
        <? if (is_array($array_fields) && in_array("summary_description", $array_fields)){ ?>
            <tr>
                <th class="standard-tabletitle">
                    <?=system_showText(LANG_LABEL_SUMMARY_DESCRIPTION)?> <span>(<?=string_strtolower(system_showText(LANG_MSG_MAX_250_CHARS))?>)</span>
                </th>
            </tr>
            <? foreach ($language_numbers as $k=>$i) {
                $labelsuffix = $i
            ?>
                <tr id="summary_<?=$i?>" <?=($k == 0) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
                    <td>
                        <textarea id="summarydesc<?=$labelsuffix;?>" name="description<?=$labelsuffix;?>" rows="5" cols="1" ><?=${"description".$labelsuffix};?></textarea>
                        <div id="textAreaCallback_<?=$labelsuffix;?>"></div>
                    </td>
                </tr>
            <? } 
        } ?>
	
	</table>
	
	<? if (is_array($array_fields) && in_array("long_description", $array_fields)) { ?>
	    <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
            <tr>
                <th class="standard-tabletitle"><?=system_showText(LANG_LABEL_DESCRIPTION)?></th>
            </tr>
            <tr>
                </tr>
                <?
                foreach ($language_numbers as $k=>$i) {
                    $labelsuffix = $i
                    ?>
                    <tr id="detail_<?=$i?>" <?=($k == 0) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
                        <td>
                            <textarea name="long_description<?=$labelsuffix;?>" rows="5"><?=${"long_description".$labelsuffix}?></textarea>
                        </td>
                    </tr>
                    <?
                }
                ?>
        </table>
    <? } ?>
	
	<table cellpadding="0" cellspacing="0" border="0" class="standard-table noMargin">
		<tr>
			<th class="standard-tabletitle">
				<?=system_showText(LANG_LABEL_KEYWORDS_FOR_SEARCH)?> <span>(<?=system_showText(LANG_LABEL_MAX);?> <?=MAX_KEYWORDS?> <?=system_showText(LANG_LABEL_KEYWORDS);?>)</span>
				<img src="<?=DEFAULT_URL?>/images/icon_interrogation.gif" alt="?" title="<?=system_showText(LANG_MSG_INCLUDE_UP_TO_KEYWORDS)?> <?=MAX_KEYWORDS?> <?=system_showText(LANG_MSG_KEYWORDS_WITH_MAXIMUM_50)?>" border="0" />
			</th>
		</tr>
		<tr>
			<td class="standard-tableContent">
				<table border="0" cellpadding="0" cellspacing="0" align="center">
					<tr>
						<th><?=system_showText(LANG_MSG_KEYWORD_PER_LINE)?></th>
						<td>
							<?=system_showText(LANG_KEYWORD_SAMPLE_1);?><br />
							<?=system_showText(LANG_KEYWORD_SAMPLE_2);?><br />
							<?=system_showText(LANG_KEYWORD_SAMPLE_3);?><br />
						</td>
					</tr>
				</table>
			</td>
		</tr>
        <? foreach ($language_numbers as $k=>$i) {
            $labelsuffix = $i
        ?>
            <tr id="keywords_<?=$i?>" <?=($k == 0) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
                <td>
                    <textarea name="keywords<?=$labelsuffix;?>" rows="5"><?=${"keywords".$labelsuffix}?></textarea>
                </td>
            </tr>
        <? } ?>
	</table>

</div>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle">
			<?=system_showText(LANG_CATEGORIES_SUBCATEGS)?>
		</th>
	</tr>
	<tr>
		<td colspan="2">
			<p class="warningBOXtext"><?=system_showText(LANG_MSG_ONLY_SELECT_SUBCATEGS)?><br /><?=system_showText(LANG_MSG_EVENT_AUTOMATICALLY_APPEAR)?><br /></p>
            <p class="warningBOXtext"><?=system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP1)." <strong>".system_showText(MAX_CATEGORY_ALLOWED)."</strong> ".system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP2)?></p>
		</td>
	</tr>
	<input type="hidden" name="return_categories" value="" />
	<tr>
		<td colspan="2" class="treeView">
			<ul id="event_categorytree_id_0" class="categoryTreeview">&nbsp;</ul>
			<table width="100%" border="0" cellpadding="2" class="tableCategoriesADDED" cellspacing="0">				
				<tr>
					<th colspan="2" class="tableCategoriesTITLE alignLeft"><strong><?=system_showText(LANG_EVENT_CATEGORY_PLURAL);?>:</strong></th>
				</tr>
				<tr id="msgback2" class="informationMessageShort">
					<td colspan="2" style="width: auto;"><p><img width="16" height="14" src="<?=DEFAULT_URL?>/images/icon_atention.gif" alt="<?=LANG_LABEL_ATTENTION?>" title="<?=LANG_LABEL_ATTENTION?>" /> <?=system_showText(LANG_MSG_CLICKADDTOSELECTCATEGORIES);?></p></td>
				</tr>
				<tr id="msgback" style="display:none">
					<td colspan="2"><div><img width="16" height="14" src="<?=DEFAULT_URL?>/images/icon_atention.gif" alt="<?=LANG_LABEL_ATTENTION?>" title="<?=LANG_LABEL_ATTENTION?>" /></div><p><?=system_showText(LANG_MSG_CLICKADDTOADDCATEGORIES);?></p></td>
				</tr>
				<tr>
					<td colspan="2" class="tableCategoriesCONTENT"><?=$feedDropDown?></td>
				</tr>
				<tr>
					<td class="tableCategoriesBUTTONS" colspan="2">
						<center>
							<button class="input-button-form" type="button" value="<?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?>" onclick="JS_displayCategoryPath(document.form_event.feed, '<?=system_showText(LANG_MSG_SELECT_CATEGORY_FIRST)?>', '../<?=EVENT_FEATURE_FOLDER;?>', 'info_window', false, 300, 100);"><?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?></button>
							<button class="input-button-form" type="button" value="<?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?>" onclick="JS_removeCategory(document.form_event.feed, false);"><?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?></button>
						</center>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<? if (PAYMENT_FEATURE == "on") { ?>
	<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
		<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
			<tr>
				<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
			</tr>
			<? if (((!$event->getNumber("id")) || (($event) && ($event->needToCheckOut())) || (string_strpos($url_base, "/sitemgr")) || (($event) && ($event->getPrice() <= 0))) && ($process != "signup")) { ?>
				<tr>
					<th><?=system_showText(LANG_LABEL_CODE)?>:</th>
					<td><input type="text" name="discount_id" value="<?=$discount_id?>" maxlength="10" /></td>
				</tr>
			<? } else { ?>
				<tr>
					<th><?=system_showText(LANG_LABEL_CODE)?>:</th>
					<td><?=(($discount_id) ? $discount_id : system_showText(LANG_NA) )?></td>
				</tr>
			<? } ?>
		</table>
	<? } ?>
<? } ?>


<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/categorytree.js"></script>
<script language="javascript" type="text/javascript">
	
	<? if($recurring == "Y"){ ?>
		recurringcheck();
        chooseperiod('<?=$period?>');
        <? if($period == "monthly" || $period == "yearly" ){ ?>
            chooseprecision('<?=$precision?>');
        <? } ?>
	<? } ?>
	
	loadCategoryTree('all', 'event_', 'EventCategory', 0, 0, '<?=DEFAULT_URL?>', <?=SELECTED_DOMAIN_ID?>);

	<? if ($members) $sess = 'members'; else $sess = 'sitemgr'; ?>
		loadGallery(<?=$id? $id : '0'?>,'y','<?=$sess?>','<?=$id ? 'editFe' : 'editF'?>', <?=$onlyMainImage ? "'false'" : "''"?>);
        
    <? if ($hasValidCoord) { ?>
        loadMap(document.form_event, true);
    <? } ?>
		
</script>