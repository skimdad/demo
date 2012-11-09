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
    # * FILE: /includes/forms/form_category_featured.php
    # ----------------------------------------------------------------------------------------------------
    
    
	if ($featuredListingCategory) {
		$title = "listing";
		$table = "ListingCategory";
		$categoryObj = new ListingCategory($category_id);			
		$categoryNoRecord = LANG_SITEMGR_LISTING_CATEGORY_NORECORD;			
	} elseif  ($featuredEventCategory) {
		$title = "event";
		$table = "EventCategory";
		$categoryObj = new EventCategory($category_id);		
		$categoryNoRecord = LANG_SITEMGR_EVENT_CATEGORY_NORECORD;				
	} elseif ($featuredClassifiedCategory) {
		$title = "classified";
		$table = "ClassifiedCategory";
		$categoryObj = new ClassifiedCategory($category_id);		
		$categoryNoRecord = LANG_SITEMGR_CLASSIFIED_CATEGORY_NORECORD;				
	} elseif ($featuredArticleCategory) {
		$title = "article";
		$table = "ArticleCategory";
		$categoryObj = new ArticleCategory($category_id);		
		$categoryNoRecord = LANG_SITEMGR_ARTICLE_CATEGORY_NORECORD;
	}
	?>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
		<tr>
			<td colspan="3">
				<a href="<?=$url_redirect?>"><?=system_showText(LANG_SITEMGR_MENU_HOME)?></a>
				<?
				$path_count = 1;
				if ($category_id) {					
					$path_elem_array = $categoryObj->getFullPath();
					$featuredStatus = $path_elem_array[0]["featured"];
					if ($path_elem_array) {
						foreach ($path_elem_array as $each_category) {
							echo " <a href=\"".$url_redirect."?category_id=".$each_category["id"]."&screen=".$screen."&letter=".$letter.(($url_search_params) ? "&$url_search_params" : "")."\">&raquo; ".$each_category["title"]."</a>";
							$path_count++;
						}
					}
				}
				?>
			</td>
		</tr>
	</table>	
	<?
	if ($categories) {
                
			if ($path_count>FEATUREDCATEGORY_LEVEL_AMOUNT) {
				?>
				<script type="text/javascript">
					$(location).attr('href', '<?=DEFAULT_URL?>/sitemgr/<?=$title?>categs/');
				</script>
				<?
				exit;
			}

			?>
	        <script type="text/javascript">
			<!--
				
				function switchCheck(link, obj) {
					
					var open = obj.checked;
					feat_categories = $('#feat_categories').val();
					non_feat_categories = $('#non_feat_categories').val();

					if(link == true){
						if (open==true){
							$('.standard-tableTOPBLUE input').attr('checked', '');
							document.getElementById('toggle_all').checked = false;
							document.getElementById('toggle_all2').checked = false;

							if ((feat_categories!="")&&(non_feat_categories!=""))
								non_feat_categories=non_feat_categories+",";
							$('#non_feat_categories').attr('value', non_feat_categories+feat_categories);
							$('#feat_categories').attr('value', "");

						} else {
							
							$('.standard-tableTOPBLUE input').attr('checked', 'checked');
							document.getElementById('toggle_all').checked = true;
							document.getElementById('toggle_all2').checked = true;

							if ((feat_categories!="")&&(non_feat_categories!=""))
								feat_categories=feat_categories+",";
							$('#feat_categories').attr('value', feat_categories+non_feat_categories);
							$('#non_feat_categories').attr('value', "");

						}
					} else{
						if (open==true){

							$('.standard-tableTOPBLUE input').attr('checked', 'checked');
							document.getElementById('toggle_all').checked = true;
							document.getElementById('toggle_all2').checked = true;

							if ((feat_categories!="")&&(non_feat_categories!=""))
								feat_categories=feat_categories+",";
							$('#feat_categories').attr('value', feat_categories+non_feat_categories);
							$('#non_feat_categories').attr('value', "");

						} else {
							
							$('.standard-tableTOPBLUE input').attr('checked', '');
							document.getElementById('toggle_all').checked = false;
							document.getElementById('toggle_all2').checked = false;

							if ((feat_categories!="")&&(non_feat_categories!=""))
								non_feat_categories=non_feat_categories+",";
							$('#non_feat_categories').attr('value', non_feat_categories+feat_categories);
							$('#feat_categories').attr('value', "");

						}
					}
					
				}

				function makeFeaturedList(id) {

					feat_categories = $('#feat_categories').val();
					non_feat_categories = $('#non_feat_categories').val();
					feat_categories = feat_categories.split(",");
					non_feat_categories = non_feat_categories.split(",");

					if ($('#checkfeat'+id).is(':checked')) {
						indice = jQuery.inArray(id, non_feat_categories);
						non_feat_categories.splice(indice,1);
						feat_categories.push(id);
					} else {
						indice = jQuery.inArray(id, feat_categories);
						feat_categories.splice(indice,1);
						non_feat_categories.push(id);
					}
					feat_categories=feat_categories.join();
					non_feat_categories=non_feat_categories.join();

					if (feat_categories.charAt(0)==',')
						feat_categories = feat_categories.substr(1,feat_categories.length);

					if (non_feat_categories.charAt(0)==',')
						non_feat_categories = non_feat_categories.substr(1,non_feat_categories.length);

					$('#feat_categories').attr('value', feat_categories);
					$('#non_feat_categories').attr('value', non_feat_categories);

					return;
				}
			-->
			</script>
			
	        <form name="fm_featuredCategories" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<table border="0" cellpadding="0" cellspacing="0" class="alignTLeft">
					<tr>
						<th><input type="checkbox" id="toggle_all" name="toggle_all" onclick="switchCheck(false, document.getElementById('toggle_all'))" /></th>
						<td><p class="check"><a href="javascript:void(0)" onclick="switchCheck(true, document.getElementById('toggle_all'))"><?=LANG_CHECK_UNCHECK_ALL?></a></p></td>
					</tr>
				</table>
				<ul class="standard-iconDESCRIPTION">
					<li class="view-icon"><?=string_ucwords(system_showText(LANG_SITEMGR_VIEW))?> <?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
				</ul>
		        <table  border="0" width="95%" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
		            <thead>
		                <tr>
		                     <th style="width:80px"><?=system_showText(LANG_SITEMGR_LABEL_FEATURED)?></th>
		                     <th><?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?> <?=string_ucwords(system_showText(LANG_SITEMGR_TITLE))?></th>
							 <? if ($path_count < FEATUREDCATEGORY_LEVEL_AMOUNT) { ?>
								<th style="width: 100px;"><?=system_showText(LANG_SITEMGR_SUBCATEGORIES)?></th>
								<th style="width: 100px;"><?=system_showText(LANG_SITEMGR_FEATUREDSUBCATEGORY_PLURAL)?></th>
							<? } ?>
							
							<th style="width: 100px;"><?=system_showText(LANG_LABEL_STATUS);?></th>
							
							<th style="width: 20px;">&nbsp;</th>
		                </tr>
		            </thead>
		            <tbody>
		            <?
		            $feat_categories = array();
					$flag_status = false;
		            foreach ($categories as $category) {
						$id = $category["id"];
						if ($category["featured"] != "y") {
							$flag_status = true;
						}
						$subcategories = db_getFromDB(string_strtolower($table), "category_id", $id, "all", "title", "object", SELECTED_DOMAIN_ID, false, $fields);
						$featuredSubcategories = db_getFromDBBySQL($table, "SELECT id FROM ".$table." WHERE category_id = ".$id." AND featured = 'y'", "object", false, SELECTED_DOMAIN_ID);
						?>
			            <tr>
			                <td><input id="checkfeat<?=$id?>" type="checkbox" name="featureds[]" value="<?=$id?>" onchange="makeFeaturedList(this.value)" <? if ($category['featured'] == 'y') echo "checked=\"checked\""; ?> /></td>
				            <td>					
								<? if ($path_count < FEATUREDCATEGORY_LEVEL_AMOUNT) { ?>
									<a href="<?=$url_redirect?>?category_id=<?=$id?>" class="link-table" title="<?=$category["title"];?>">
										<?=$category["title"];?>
									</a>
								<? } else {
									echo $category["title"];
								} ?>
							</td>
							
							<? if ($path_count < FEATUREDCATEGORY_LEVEL_AMOUNT) { ?>
								<td><?=count($subcategories);?></td> 
								<td><?=count($featuredSubcategories);?></td>
							<? } ?>
							
							<td>
								<? if ($category['enabled'] == 'y') {
									echo LANG_SITEMGR_LABEL_ENABLED;
								} else {
									echo LANG_SITEMGR_LABEL_DISABLED;
								} ?>
							</td>
							
							<td nowrap="nowrap">
								<? if ($path_count < FEATUREDCATEGORY_LEVEL_AMOUNT) { ?>
									<a href="<?=$url_redirect?>?category_id=<?=$id?>" class="link-table">
										<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" />
									</a>
								<? } else { ?>
									<img src="<?=DEFAULT_URL?>/images/bt_view_off.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" />
								<? } ?>
							</td>					
			            </tr>
			            <?
			            ($category['featured'] == 'y') ? $feat_categories[] = $id : $no_feat_categories[] = $id ;
						$all_categories[] = $id;
		            }
					
		            if ($feat_categories) $ids_feat_categories = implode(",", $feat_categories);
					if ($no_feat_categories) $ids_non_feat_categories = implode(",", $no_feat_categories);

		            ?>
		            </tbody>
		        </table>
				<ul class="standard-iconDESCRIPTION">
					<li class="view-icon"><?=string_ucwords(system_showText(LANG_SITEMGR_VIEW))?> <?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
				</ul>
		        <input type="hidden" name="save" value="1" />
				<input type="hidden" id="feat_categories" name="feat_categories" value="<?=$ids_feat_categories?>" />
				<input type="hidden" id="non_feat_categories" name="non_feat_categories" value="<?=$ids_non_feat_categories?>" />
				<input type="hidden" id="featured_status" name="featured_status" value="<?=$featuredStatus?>" />
				<table border="0" cellpadding="0" cellspacing="0">
				    <tr>
					<th><input type="checkbox" id="toggle_all2" name="toggle_all2" onclick="switchCheck(false, document.getElementById('toggle_all2'))" /></th>
					<td><p class="check"><a href="javascript:void(0)" onclick="switchCheck(true, document.getElementById('toggle_all2'))"><?=LANG_CHECK_UNCHECK_ALL?></a></p>
				    </tr>
				</table>
				<?
				if ($flag_status == false) { ?>
						<script type="text/javascript">

							document.getElementById('toggle_all').checked = true;
							document.getElementById('toggle_all2').checked = true;

						</script>
				<? } ?>
		        <div align="left"><button type="submit" name="bt_submit" class="input-button-form" value="<?=system_showText(LANG_SITEMGR_SAVE)?>"><?=system_showText(LANG_SITEMGR_SAVE)?></button></div>
	        </form>
	        <?   
    } else {        
        ?>
		<p class="informationMessage"><?=system_showText($categoryNoRecord)?></p>        
		<?            
    }
    ?>