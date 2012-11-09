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
	# * FILE: /includes/forms/form_blog.php
	# ----------------------------------------------------------------------------------------------------

    // HTTPS ON NEED TO REWRITE URL FOR AJAX REQUEST
    if (SSL_ENABLED=='on' && $_SERVER["HTTPS"]=='on')
        $blog_default_url=SECURE_URL."/".BLOG_FEATURE_FOLDER;
    else
        $blog_default_url=NON_SECURE_URL."/".BLOG_FEATURE_FOLDER;

?>

<script type="text/javascript" src="<?=NON_LANG_URL?>/includes/tiny_mce/tiny_mce_src.js"></script>
<script language="javascript" type="text/javascript">

	function JS_addCategory(text, id) {

		seed = document.blog.seed;
		feed = document.blog.feed;
		
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
            else ('#categoryAdd'+id).after("</a> <span class=\"categoryErrorMessage\"><?=system_showText(LANG_MSG_SELECT_VALID_TAG)?></span> </li>");
		}

	}

	// ---------------------------------- //

	function JS_submit() {

		feed = document.blog.feed;
		return_categories = document.blog.return_categories;
		if(return_categories.value.length > 0) return_categories.value="";

		for (i=0;i<feed.length;i++) {
			if (!isNaN(feed.options[i].value)) {
				if(return_categories.value.length > 0)
				return_categories.value = return_categories.value + "," + feed.options[i].value;
				else
			return_categories.value = return_categories.value + feed.options[i].value;
			}
		}

		document.blog.submit();
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
    
    function system_displayTinyMCEJS(txId) {

    	tinyMCE.execCommand('mceAddControl', false, txId);
    
    }
	
	//////////////////////////////////////////////////////////////////////////////////////////
	
	
	function loadGallery(id,new_image,sess,del) {

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
						if (del!='edit' && del!='editFe'){
							if (del=='n'){
								$('#addImage').css('display','none');
								$('#gBlog').css('display','');
							}
							else{
								$('#addImage').css('display','');
								$('#gBlog').css('display','none');
							}
						}else{
							if (del=='edit' || del=='editFe')
								$('#gBlog').css('display','');
						}
						if (xmlhttp.responseText=='no image'){
							$('#gBlog').css('display','none');
						}

						<? if ($hasImage){?>
								$('#gBlog').css('display','');
							<? } ?>
						$("#gBlog").html(xmlhttp.responseText);
						$("#gBlog").css('width',$("#imgThumb").width()+6);
                        
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

			xmlhttp.open("GET", "<?=$blog_default_url;?>/includes/code/returngallery.php?gallery_hash=<?=$gallery_hash?>&domain_id=<?=SELECTED_DOMAIN_ID?>&id="+id+"&new_image="+new_image, true);
			xmlhttp.send(null);
		}
		}

	////////////////////////////////////////////////////////////////////////////////////////////////////////

</script>


<p class="informationMessage">* <?=system_showText(LANG_LABEL_REQUIRED_FIELD)?> </p>

<?
if ($message_blog) {
	echo "<p class=\"errorMessage\">";
		echo $message_blog;
	echo "</p>";
}
?>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_INFORMATION);?></th>
	</tr>
		<tr>
		<th>* <?=system_showText(LANG_SITEMGR_TITLE);?>:</th>
		<td>
			<input type="text" name="title" value="<?=$title?>" maxlength="100" <?=(!$id) ? " onblur=\"easyFriendlyUrl(this.value, 'friendly_url', '".FRIENDLYURL_VALIDCHARS."', '".FRIENDLYURL_SEPARATOR."');\" " : ""?> />
			<input type="hidden" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" />
		</td>
	</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="3" class="standard-tabletitle"><?=system_showText(LANG_LABEL_IMAGE)?> <span>(<?=IMAGE_BLOG_FULL_WIDTH?>px x <?=IMAGE_BLOG_FULL_HEIGHT?>px) (JPG, GIF <?=system_showText(LANG_OR);?> PNG)</span></th>
	</tr>

	<tr>
		<th class=Full>
			<div id="gBlog"></div>
		</th>
	</tr>

	<tr id="addImage" style="display:<?=($image_id ? 'none' : '');?>">
		<td class="alignTop width100">
			<a id="uploadimage" href="<?=$blog_default_url?>/sitemgr/uploadimage.php?gallery_hash=<?=$gallery_hash?>&item_type=post&item_id=<?=$post->getNumber("id")?>" class="addImageForm input-button-form iframe fancy_window_imgAdd"><b><?=system_showText(LANG_LABEL_ADDIMAGE)?></b></a>
			<span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></span>	
		</td>
	</tr>

</table>

<div class="multilanguageContent">

	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		
		<tr>
			<th colspan="2" class="tabsBase">
			<?
				$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
				$num_languages = count(explode(",", EDIR_LANGUAGENAMES));
				$language_numbers = explode(",", EDIR_LANGUAGENUMBERS);
				$labelsuffix = "";
				?>
				<ul class="tabs">
					<? foreach ($language_numbers as $k=>$i) { ?>
						<li id="tab_abstract_<?=$i?>" <?=($k == 0) ? "class=\"tabActived\"" : ""?>><a href="javascript:void(0)" onclick="showLangFields('abstract', 'content', 'keywords', '<?=$i?>', '<?=$num_languages?>'), system_displayTinyMCEJS('content<?=$i?>')"><?=$array_edir_languagenames[$k]?></a></li>
					<? } ?>
				</ul>
		</tr>
					
	</table>
	
	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	
		<tr>
			<th class="standard-tabletitle">
				* <?=system_showText(LANG_LABEL_POST_CONTENT)?>
			</th>
		</tr>

		<?
		foreach ($language_numbers as $k=>$i) {
			$labelsuffix = $i;
		?>
			<tr id="content_<?=$i?>" <?=($k == 0) ? "class=\"isVisible\"" : "class=\"isHidden\""?>>
				<td class="packageEditor">
					<? // TinyMCE Editor Init
						// getting language
						$pos = string_strpos(EDIR_LANGUAGE, "_");
						$lang = string_substr(EDIR_LANGUAGE, 0, $pos);
						// getting content
						//$content = $contentObj->getString("content", false);
						
						//fix ie bug with images
						if (!(${"content".$labelsuffix})) ${"content".$labelsuffix} =  "&nbsp;".${"content".$labelsuffix};
												
						// calling TinyMCE
						system_addTinyMCE($lang, "none", "advanced", "content$labelsuffix", "30", "15", "500", ${"content".$labelsuffix}, false);
					?>
				</td>
			</tr>
		<? } ?>		
	</table>
	
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
			<?=system_showText(LANG_TAGS)?>
		</th>
	</tr>
	<tr>
		<td colspan="2">
			<p class="warningBOXtext" style="background-position: 10px 0;"><?=system_showText(LANG_MSG_ONLY_SELECT_TAGS)?><br /><?=system_showText(LANG_MSG_POST_AUTOMATICALLY_APPEAR);?></p>     
		</td>
	</tr>
	<input type="hidden" name="return_categories" value="" />
	<tr>
		<td colspan="2" class="treeView">
			<ul id="blog_categorytree_id_0" class="categoryTreeview">&nbsp;</ul>

			<table width="100%" border="0" cellpadding="2" class="tableCategoriesADDED" cellspacing="0">
				<tr>
					<th colspan="2" class="tableCategoriesTITLE alignLeft"><strong><?=system_showText(LANG_SITEMGR_TAGS);?>:</strong></th>
				</tr>
				<tr id="msgback2" class="informationMessageShort">
					<td colspan="2" style="width: auto;"><div><img width="16" height="14" src="<?=DEFAULT_URL?>/images/icon_atention.gif" alt="<?=LANG_LABEL_ATTENTION?>" title="<?=LANG_LABEL_ATTENTION?>" /></div><p><?=system_showText(LANG_MSG_CLICKADDTOSELECTTAGS);?></p></td>
				</tr>
				<tr id="msgback" style="display:none">
					<td colspan="2"><div><img width="16" height="14" src="<?=DEFAULT_URL?>/images/icon_atention.gif" alt="<?=LANG_LABEL_ATTENTION?>" title="<?=LANG_LABEL_ATTENTION?>" /></div><p><?=system_showText(LANG_MSG_CLICKADDTOADDTAGS);?></p></td>
				</tr>
				<tr>
					<td colspan="2" class="tableCategoriesCONTENT"><?=$feedDropDown?></td>
				</tr>
				<tr>
					<td class="tableCategoriesBUTTONS" colspan="2">
						<center>
							<button class="input-button-form" type="button" value="<?=system_showText(LANG_BUTTON_REMOVESELECTEDTAG)?>" onclick="JS_removeCategory(document.blog.feed, false);"><?=system_showText(LANG_BUTTON_REMOVESELECTEDTAG)?></button>
						</center>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?
	system_displayTinyMCE('content'.EDIR_DEFAULT_LANGUAGENUMBER);

?>
<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/categorytree.js"></script>
<script language="javascript" type="text/javascript">
	loadCategoryTree('all', 'blog_', 'BlogCategory', 0, 0, '<?=DEFAULT_URL?>',<?=SELECTED_DOMAIN_ID?>);
</script>

<script language="javascript" type="text/javascript">
	<?if ($members) $sess='members'; else $sess='sitemgr'; ?>
		loadGallery(<?=$id? $id : '0'?>,'y','<?=$sess?>','<?=$id? 'editFe' : 'editF'?>');
</script>