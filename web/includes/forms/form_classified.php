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
	# * FILE: /includes/forms/form_classified.php
	# ----------------------------------------------------------------------------------------------------

	if (string_strpos($_SERVER["HTTP_REFERER"], "members/advertise.php") == true) { ?>
		<input type="hidden" name="from_advertise" value="yes" />
	<? } ?>
        
<a href="#" id="info_window" class="iframe fancy_window_categPath" style="display:none"></a>        
        
<script language="javascript"  type="text/javascript">

	function JS_addCategory(text, id) {
			
		seed = document.classified.seed;
		feed = document.classified.feed;

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
	
		feed = document.classified.feed;
		return_categories = document.classified.return_categories;
		if(return_categories.value.length > 0) return_categories.value="";
		
		for (i=0;i<feed.length;i++) {
			if (!isNaN(feed.options[i].value)) {
				if(return_categories.value.length > 0)
				return_categories.value = return_categories.value + "," + feed.options[i].value;
				else
			return_categories.value = return_categories.value + feed.options[i].value;
			}
		}
		
		document.classified.submit();
	}
    
    // ---------------------------------- //

    function showLangFields(type1, type2, type3, num_language, languages) {
        
        var arrLangNumbers = ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');

        for (j=0;j<languages;j++) {
			i = arrLangNumbers[j];
			jQuery('#'+type1+'_'+i).addClass('isHidden').removeClass('isVisible');
			jQuery('#tab_'+type1+'_'+i).removeClass("tabActived");
			jQuery('#'+type2+'_'+i).addClass('isHidden').removeClass('isVisible');
			jQuery('#tab_'+type2+'_'+i).removeClass("tabActived");
			jQuery('#'+type3+'_'+i).addClass('isHidden').removeClass('isVisible');
			jQuery('#tab_'+type3+'_'+i).removeClass("tabActived");
        }    
		jQuery('#'+type1+'_'+num_language).removeClass('isHidden').addClass('isVisible');
		jQuery('#tab_'+type1+'_'+num_language).addClass("tabActived");
		jQuery('#'+type2+'_'+num_language).removeClass('isHidden').addClass('isVisible');
		jQuery('#tab_'+type2+'_'+num_language).addClass("tabActived");
		jQuery('#'+type3+'_'+num_language).removeClass('isHidden').addClass('isVisible');
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
						<? if ($members) {?>
							loadGallery(item_id, "y", "members", "", "true");
						<? } else { ?>
							loadGallery(item_id, "y", "sitemgr", "", "true");
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
							loadGallery(item_id, "y", "members", "", "true");
						<? } else { ?>
							loadGallery(item_id, "y", "sitemgr", "", "true");
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
									<? if ($hasImage){?>
										if (del) {
											$("#addImage").css("display", "none");
											$("#galleryF").css("display", "");
										} else {
											$("#addImage").css("display", "");
											$("#galleryF").css("display", "none");
										}
									<? } else { ?>
										$("#addImage").css("display", "");
										$("#galleryF").css("display", "none");
									<? } ?>
								}
							} else {
								if (del == "edit" || del == "editFe")
									$("#galleryF").css("display", "");
							}

							if (main == "true"){
								$("#galleryF").css("display", "");
							}
							<? if ($hasImage){ ?>
								$("#galleryF").css("display", "");
							<? } ?>

							if (xmlhttp.responseText == "no image"){
								$("#galleryF").css("display", "none");
							}
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

			xmlhttp.open("GET", "<?=DEFAULT_URL;?>/includes/code/returngallery.php?gallery_hash=<?=$gallery_hash?>&domain_id=<?=SELECTED_DOMAIN_ID?>&id="+id+"&new_image="+new_image+"&main="+main+"&sess="+sess+"&module=classified&level=<?=$level?>", true);
			xmlhttp.send(null);
		}
	}
	
	var arrLangNumbers	= ('<?=EDIR_LANGUAGENUMBERS;?>').split(',');
	
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
        
        $.mask.definitions['~']='[+-]';
        $("#price_int").mask("9?999999",{placeholder:""});
        $("#price_cent").mask("9?9",{placeholder:""});
		
	});
    		
	////////////////////////////////////////////////////////////////////////////////////////////////////////
</script>

<?  // Account Search Javascript /////////////////////////////////////////////////////// ?>

<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>

<?  //////////////////////////////////////////////////////////////////////////////////// ?>

<?
echo "<p class=\"informationMessage\">* ".system_showText(LANG_LABEL_REQUIRED_FIELD)." </p>";
	
	if ($message_classified) {
		echo "<p class=\"errorMessage\">";
		echo $message_classified ;
		echo "</p>";
	}
?>

<? // Display Level ////////////////////////////////////////////////////////////////// ?>
<?php
$level_name = "";
if ($level) {
	$levelObjTMP = new ClassifiedLevel();
	$level_name = $levelObjTMP->getLevel($level);
}
?>
<table class="levelTable">
	<tr>
		<th class="levelTitle"><?=system_showText(LANG_CLASSIFIED_LEVEL);?></th>
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
<?  //////////////////////////////////////////////////////////////////////////////////// ?>

	<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_INFORMATION);?></th>
		</tr>
		<tr>
			<th>* <?=system_showText(LANG_CLASSIFIED_TITLE);?>:</th>
			<td>
				<input type="text" name="title" value="<?=$title?>" maxlength="100" <?=(!$id) ? " onblur=\"easyFriendlyUrl(this.value, 'friendly_url', '".FRIENDLYURL_VALIDCHARS."', '".FRIENDLYURL_SEPARATOR."');\" " : ""?> />
				<input type="hidden" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" />
			</td>
		</tr>

        
        <? if (is_array($array_fields) && in_array("contact_name", $array_fields)){ ?>
            <tr>
                <th><?=system_showText(LANG_LABEL_CONTACT_NAME);?>:</th>
                <td><input type="text" name="contactname" value="<?=$contactname?>" /></td>
            </tr>
        <? } ?>
            
		<tr>
			<th><?=system_showText(LANG_LABEL_CONTACT_PHONE);?>:</th>
			<td><input type="text" name="phone" value="<?=$phone?>" /></td>
		</tr>

        <? if (is_array($array_fields) && in_array("fax", $array_fields)){ ?>
            <tr>
                <th><?=system_showText(LANG_LABEL_CONTACT_FAX);?>:</th>
                <td><input type="text" name="fax" value="<?=$fax?>" /></td>
            </tr>
        <? } ?>
            
		<tr>
			<th><?=system_showText(LANG_LABEL_CONTACT_EMAIL);?>:</th>
			<td><input type="text" name="email" value="<?=$email?>" /></td>
		</tr>

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
			<th><?=system_showText(LANG_LABEL_PRICE);?>:</th>
			<td>
				<?
				if ( $classified_price != 'NULL' ) {
					$price_value = explode(".", $classified_price);	
				}
				echo CURRENCY_SYMBOL;
				?>
				<input type="text" name="classified_price_int" id="price_int" value="<?=$price_value[0] ? $price_value[0] : $classified_price_int?>" maxlength="7" style="width:55px; text-align:right;" />
				<strong> &nbsp;.&nbsp; </strong>
				<input type="text" name="classified_price_cent" id="price_cent" value="<?=$price_value[1] ? $price_value[1] : $classified_price_cent?>" maxlength="2" style="width:20px;" />
			</td>
		</tr>
	</table>

	<table border="0" cellpadding="0" cellspacing="0" class="standard-table nomargin">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_LOCATIONS)?></th>
		</tr>
		<tr>
			<th><?=system_showText(LANG_LABEL_ADDRESS);?>:</th>
			<td><input type="text" name="address" id="address" <?=($loadMap ? "onblur=\"loadMap(document.classified);\"" : "")?> value="<?=$address?>" value="<?=$address?>" /></td>
		</tr>
		<tr>
			<th><?=system_showText(LANG_LABEL_ADDRESS_OPTIONAL);?>:</th>
			<td><input type="text" name="address2" value="<?=$address2?>" /></td>
		</tr>
        
		<tr>
			<th><?=string_ucwords(ZIPCODE_LABEL)?>:</th>
			<td><input type="text" name="zip_code" id="zip_code" <?=($loadMap ? "onblur=\"loadMap(document.classified);\"" : "")?> value="<?=$zip_code?>" maxlength="10" /></td>
		</tr>
        
        <? if ($loadMap) { ?>
        <tr>
            <th><?=system_showText(LANG_LABEL_LATITUDE)?>:</th>
            <td>
                <input type="text" name="latitude" id="latitude" <?=($loadMap ? "onblur=\"loadMap(document.classified, true);\"" : "")?> value="<?=$latitude?>" maxlength="10" />
                <span>Ex: 38.830391</span>
            </td>
        </tr>

        <tr>
            <th><?=system_showText(LANG_LABEL_LONGITUDE)?>:</th>
            <td>
                <input type="text" name="longitude" id="longitude" <?=($loadMap ? "onblur=\"loadMap(document.classified, true);\"" : "")?> value="<?=$longitude?>" maxlength="10" />
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
                        <a id="linkDisplayMap" href="javascript:void(0)" onclick="displayMapForm(document.classified, false);">
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
	
<? if ((is_array($array_fields) && in_array("main_image", $array_fields)) || $levelMaxImages > 0) { ?>
	<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
		<tr>
			<th colspan="3" class="standard-tabletitle"><?=($onlyMainImage ? system_showText(LANG_LABEL_IMAGE) : system_showText(LANG_LABEL_IMAGE_PLURAL))?> <span>(<?=IMAGE_CLASSIFIED_FULL_WIDTH?>px x <?=IMAGE_CLASSIFIED_FULL_HEIGHT?>px) (JPG, GIF <?=system_showText(LANG_OR);?> PNG)</span></th>
		</tr>

		<tr id="table_gallery">
			<th class=Full>
				<div id="galleryF"></div>
			</th>
		</tr>

		<?
		$gallery_id = $classified->getGalleries();
		if ($onlyMainImage){
        ?>
			<tr id="addImage" style="display:<?=($image_id ? 'none' : '');?>">
        <? } else { ?>
			<tr>
        <? } ?>
                <td class="alignTop width100">
                    
                    <? if ($members) { ?>
                        <a id="uploadimage" href="<?=DEFAULT_URL?>/popup/popup.php?domain_id=<?=SELECTED_DOMAIN_ID?>&pop_type=uploadimage&gallery_hash=<?=$gallery_hash?>&item_type=classified&item_id=<?=$classified->getNumber("id")?>&galleryid=<?=$gallery_id[0]?>&photos=<?=$levelMaxImages?>&level=<?=$level?>" class="addImageForm input-button-form iframe fancy_window_imgAdd"><?=system_showText(LANG_LABEL_ADDIMAGE)?></a>
                    <? } else { ?>
                        <a id="uploadimage" href="<?=DEFAULT_URL?>/sitemgr/uploadimage.php?gallery_hash=<?=$gallery_hash?>&item_type=classified&item_id=<?=$classified->getNumber("id")?>&galleryid=<?=$gallery_id[0]?>&photos=<?=$levelMaxImages?>&level=<?=$level?>" class="addImageForm input-button-form iframe fancy_window_imgAdd"><b><?=system_showText(LANG_LABEL_ADDIMAGE)?></b></a>
                    <? } ?>
                    
                    <span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></span>
                    
                    <? if ($levelMaxImages > 0){ ?>
                        <p class="informationMessage"><?=system_showText(LANG_MSG_CLASSIFIED_WILL_SHOW)?> <?=(($levelMaxImages == -1) ? (system_showText(LANG_LABEL_UNLIMITED)) : (system_showText(LANG_MSG_THE_MAX_OF)." ".$levelMaxImages))." ".(($levelMaxImages == 1) ? (LANG_MSG_GALLERY_PHOTO) : (LANG_MSG_GALLERY_PHOTOS)) ?> <?=system_showText(LANG_MSG_PER_GALLERY)?><?=($hasMainImage ? " ".system_showText(LANG_MSG_PLUS_MAINIMAGE) : ".")?></p>
                    <? } ?>
                </td>
            </tr>
		
	</table>
<? } ?>
	<?php /* the following codes are added by Debiprasad Sahoo (Indibits) on 19 July 2012 */ ?>
    <? if(is_array($array_fields) && in_array("video", $array_fields)){ ?>
        
        <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
            <tr>
                <th colspan="2" class="standard-tabletitle">
                    <?=system_showText(LANG_LABEL_VIDEO_SNIPPET_CODE)?>
                    <span style="display: block; white-space: normal;">(<?=system_showText(LANG_MSG_VIDEO_SNIPPET_CODE)?>)</span>
                </th>
            </tr>
            <tr>
                <th class="alignTop"><?=system_showText(LANG_LABEL_CODE)?>:</th>
                <td>
                    <input type="text" name="video_snippet" value="<?=$video_snippet?>" class="videoSnippetInput" />
                    <span><?=system_showText(LANG_MSG_MAX_VIDEO_CODE_SIZE);?>: <?=IMAGE_LISTING_FULL_WIDTH?>px x <?=IMAGE_LISTING_FULL_HEIGHT?>px.<br /><?=system_showText(LANG_MSG_VIDEO_MODIFIED);?></span>
                    <? if($members == 1) {?>
                        <span><a href="<?=DEFAULT_URL?>/members/faq.php?keyword=video" target="_blank"><?=system_showText(LANG_VIDEO_SNIPPETTIP)?></a></span>
                    <? } else { ?>
                        <span><a href="<?=DEFAULT_URL?>/sitemgr/faq/faq.php?keyword=video" target="_blank"><?=system_showText(LANG_VIDEO_SNIPPETTIP)?></a></span>
                    <? } ?>
                </td>
            </tr>
        </table>
    <? } ?>
	<?php /* the above codes are added by Debiprasad Sahoo (Indibits) on 19 July 2012 */ ?>
	
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
		<tr>
			<th class="standard-tabletitle">
				<?=system_showText(LANG_LABEL_SUMMARY_DESCRIPTION)?> <span>(<?=string_strtolower(system_showText(LANG_MSG_MAX_250_CHARS))?>)</span>
			</th>
		</tr>
		<?
		foreach ($language_numbers as $k=>$i) {
			$labelsuffix = $i;
		?>
		<tr id="summary_<?=$i?>" <?=($k == 0) ? "class=\"isVisible\"" : "class=\"isHidden\""?>>
			<td>
				<textarea id="summarydesc<?=$labelsuffix;?>" name="summarydesc<?=$labelsuffix;?>" rows="5" cols="1" ><?=${"summarydesc".$labelsuffix};?></textarea>
				<div id="textAreaCallback_<?=$labelsuffix;?>"></div>
			</td>
		</tr>
		<? } ?>
	</table>
	
	<? if (is_array($array_fields) && in_array("long_description", $array_fields)){ ?>
        <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
            <tr>
                <th class="standard-tabletitle"><?=system_showText(LANG_LABEL_DETAIL_DESCRIPTION)?></th>
            </tr>
            <? foreach ($language_numbers as $k=>$i) {
                $labelsuffix = $i;
            ?>
                <tr id="detail_<?=$i?>" <?=($k == 0) ? "class=\"isVisible\"" : "class=\"isHidden\""?>>
                    <td>
                        <textarea name="detaildesc<?=$labelsuffix;?>" rows="5"><?=${"detaildesc".$labelsuffix}?></textarea>
                    </td>
                </tr>
            <? } ?>
        </table>
    <? } ?>
	
	<table cellpadding="0" cellspacing="0" border="0" class="standard-table nomargin">
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
		<?
		foreach ($language_numbers as $k=>$i) {
			$labelsuffix = $i;
		?>
		<tr id="keywords_<?=$i?>" <?=($k == 0) ? "class=\"isVisible\"" : "class=\"isHidden\""?>>
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
			<p class="warningBOXtext"><?=system_showText(LANG_MSG_ONLY_SELECT_SUBCATEGS)?><br /><?=system_showText(LANG_MSG_CLASSIFIED_AUTOMATICALLY_APPEAR)?><br /></p>
			<p><?=system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP1)." <strong>".system_showText(MAX_CATEGORY_ALLOWED)."</strong> ".system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP2)?></p>
		</td>
	</tr>
	<input type="hidden" name="return_categories" value="" />
	<tr>
		<td colspan="2" class="treeView">
			<ul id="classified_categorytree_id_0" class="categoryTreeview">&nbsp;</ul>
			<table width="100%" border="0" cellpadding="0" class="tableCategoriesADDED" cellspacing="0">				
				<tr>
					<th colspan="2" class="tableCategoriesTITLE alignLeft"><strong><?=system_showText(LANG_CLASSIFIED_CATEGORY_PLURAL);?>:</strong></th>
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
							<button class="input-button-form" type="button" value="<?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?>" onclick="JS_displayCategoryPath(document.classified.feed, '<?=system_showText(LANG_MSG_SELECT_CATEGORY_FIRST)?>', '../<?=CLASSIFIED_FEATURE_FOLDER;?>', 'info_window', false, 300, 100);"><?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?></button>
							<button class="input-button-form" type="button" value="<?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?>" onclick="JS_removeCategory(document.classified.feed, false);"><?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?></button>
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
			<? if (((!$classified->getNumber("id")) || (($classified) && ($classified->needToCheckOut())) || (string_strpos($url_base, "/sitemgr")) || (($classified) && ($classified->getPrice() <= 0))) && ($process != "signup")) { ?>
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

<script type="text/javascript">

		
	$('input:text[name=classified_price_cent]').keydown(function(e) {
		if (e.which == 8) {
			if (this.value == '') {
				$('input:text[name=classified_price_int]').focus();
			}
		}	
	});
	
	$('input:text[name=classified_price_int]').keydown(function(e) {
		if (e.which == 8 || e.which == 46) {
			if ($(this).val() == '') {
				$('input:text[name=classified_price_cent]').focus();
			}
		}	
	});
    
	loadCategoryTree('all', 'classified_', 'ClassifiedCategory', 0, 0, '<?=DEFAULT_URL?>',<?=SELECTED_DOMAIN_ID?>);

	<? if ($members) $sess='members'; else $sess='sitemgr'; ?>
	loadGallery(<?=$id? $id : '0'?>,'y','<?=$sess?>','<?=$id ? 'editFe' : 'editF'?>', <?=$onlyMainImage ? "'false'" : "''"?>);
    
    <? if ($hasValidCoord) { ?>
        loadMap(document.classified, true);
    <? } ?>
</script>