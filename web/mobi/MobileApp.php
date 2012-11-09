<?
/* ==================================================================*\
######################################################################
#   created by mavencrew                                             #
######################################################################
\*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /sitemgr/listing/MobileApp.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSMSession();
permission_hasSMPerm();

$url_redirect = "" . DEFAULT_URL . "/sitemgr/" . LISTING_FEATURE_FOLDER;
$url_base = "" . DEFAULT_URL . "/sitemgr";
$sitemgr = 1;

# ----------------------------------------------------------------------------------------------------
# AUX
# ----------------------------------------------------------------------------------------------------
extract($_POST);
extract($_GET);
$url_search_params = system_getURLSearchParams((($_POST) ? ($_POST) : ($_GET)));

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
//TODO: Mavencrew - change the include of the model class
include(EDIRECTORY_ROOT . "/mobi/upload_image.php");
include(EDIRECTORY_ROOT . "/classes/class_MobileApplication.php");
include(EDIRECTORY_ROOT . "/includes/code/listing_mobileapp.php");

# ----------------------------------------------------------------------------------------------------
# HEADER
# ----------------------------------------------------------------------------------------------------
include(SM_EDIRECTORY_ROOT . "/layout/header.php");

# ----------------------------------------------------------------------------------------------------
# NAVBAR
# ----------------------------------------------------------------------------------------------------
include(SM_EDIRECTORY_ROOT . "/layout/navbar.php");

$level = new ListingLevel($listing->getNumber("level"));
?>


<div id="main-right">




    <div id="top-content">
        <div id="header-content"><h1><?= system_showText(LANG_SITEMGR_Mobile_App_SING) ?> - <?= $listing->getString("title") ?></h1></div>
    </div>

    <div id="content-content">
        <div class="default-margin">

            <? require(EDIRECTORY_ROOT . "/sitemgr/registration.php"); ?>
            <? require(EDIRECTORY_ROOT . "/includes/code/checkregistration.php"); ?>
            <? require(EDIRECTORY_ROOT . "/frontend/checkregbin.php"); ?>

            <form enctype="multipart/form-data" name="mobileapp_settings" action="<?= system_getFormAction($_SERVER["PHP_SELF"]) . '?id=' . $id . '&screen=' . $screen . '&letter=' . $letter ?>" method="post">

                  <? if (MobileApp_FEATURE != "on") { ?>
                  <p class="informationMessage">
                    <?= system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE) ?>
                </p>
                <?
                } elseif (!empty($_GET['screen']) && in_array($_GET['screen'], array('home','splash', 'promotion', 'events', 'special_announ', 'classified', 'share', 'reviews', 'contactus', 'about'))) {


                ?>
                    <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                        <tbody>
                            <tr>
                                <th colspan="4" class="standard-tabletitle"> <?= $mobileAppObj->{$_GET['screen'].'_title'} ?> Settings</th>
                            </tr>
                            <tr>
                                <th class="wrap">
									Page Title:
								</th>
								<td>
									<input name="<?= $_GET['screen'].'_title' ?>" type="text" value="<? echo $mobileAppObj->{$_GET['screen'].'_title'} ?>" />
								</td>
							</tr>
							<? if($_GET['screen'] == 'home'): ?>
							<tr>
                                <th class="wrap">
									 logo image: 
								</th>
								<td>
								  <div class="upload_box">
					              	<input type="text" readonly="readonly" class="file_input_textbox left" id="fileName">
					
									<div class="file_input_div">
					  					<input type="button" class="file_input_button" value="Browse">
					 					<input type="file" name="image" onchange="javascript: document.getElementById('fileName').value = this.value" class="file_input_hidden">
									</div>
								</div>
								<? if(!empty($mobileAppObj->logo_image )): ?>
								 <img style="margin: 10px auto; display: block" src="<?= "http://www.dealcloudusa.com/mobi/uploded_images/".$mobileAppObj->logo_image ?>" width="50px" height="50px" />
								<? endif; ?>
								</td>
							</tr>	
							<? endif; ?>
                            <? if($_GET['screen'] == 'splash'): ?>
							<tr>
                                <th class="wrap">
									 spalsh extra image: 
								</th>
								<td>
								     <div class="upload_box">
						              	<input type="text" readonly="readonly" class="file_input_textbox left" id="fileName">
						
										<div class="file_input_div">
						  					<input type="button" class="file_input_button" value="Browse">
						 					<input type="file" name="image" onchange="javascript: document.getElementById('fileName').value = this.value" class="file_input_hidden">
										</div>
									</div>
									<? if(!empty($mobileAppObj->splash_extra_image )): ?>
										<img style="margin: 10px auto; display: block" src="<?= "http://www.dealcloudusa.com/mobi/uploded_images/".$mobileAppObj->splash_extra_image ?>" width="50px" height="50px" />
									<? endif; ?>
									
								</td>
							</tr>	
							<? endif; ?>                                                                 
                            <? if($_GET['screen'] == 'special_announ'): ?>
							<tr>
                                <th class="wrap">
									 description:
								</th>
								<td>
								     	    <script type="text/javascript" src="<?= DEFAULT_URL ?>/includes/tiny_mce/tiny_mce_src.js"></script>
                                <script type="text/javascript">
                                    // Default skin
                                    var inlinePopUps = "inlinepopups,";
                                    if ($.browser.msie && $.browser.version == 9){
                                        inlinePopUps = "";
                                    }
                                    tinyMCE.init({
                                        // General options
                                        mode : "exact",
                                        elements : "special_announ_content",
                                        theme : "advanced",
                                        width: "650",
                                        plugins : "imagemanager,safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras," + inlinePopUps + "template,autosave",
                                        //                language : 'en',
                                        language : 'en',
                                        extended_valid_elements : "iframe[src|width|height|name|align]",
                                        // Theme options
                                        theme_advanced_buttons1 : "formatselect,fontselect,fontsizeselect,|,undo,redo,|,bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,|,cut,copy,paste,pasteword,|,link,unlink,",
                                        theme_advanced_buttons2 : "anchor,image,media,emotions,tablecontrols,bullist,numlist,|,print,fullscreen,|,attribs,code,styleprops,preview,|,forecolor,backcolor",
                                        theme_advanced_buttons3 : "",
                                        theme_advanced_buttons4 : "",
                                        theme_advanced_buttons5 : "",

                                        theme_advanced_toolbar_location : "top",
                                        theme_advanced_toolbar_align : "left",
                                        theme_advanced_resizing : false,
                                        convert_urls : false
                                    });

                                </script>
                                <textarea style="border: 1px solid #333333" cols="10" rows="10" name="special_announ_content" class="special_announ_content"><?= $mobileAppObj->special_announ_content ?></textarea>
								</td>
							</tr>	
							<? endif; ?>                                                                
                           
                            
                    
						</tbody>
					</table>			
				    
                <div class="mob">
				    <div class="btns" style="width:100%;text-align:center;margin: 10px auto" >
					<br />
					    <button type="button" name="home" class="input-button-form" value="Home" onclick="window.location.href = '<?= system_getFormAction($_SERVER["PHP_SELF"]) . '?id=' . $id . '&screen=&letter=' . $letter ?>';">Home</button> 
                        <button type="button" name="cancel" class="input-button-form" value="Cancel" onclick="window.location.href = '<?= system_getFormAction($_SERVER["PHP_SELF"]) . '?id=' . $id . '&screen=&letter=' . $letter ?>';">Cancel</button>
                        
                        <input type="submit" class="input-button-form" value="save" />
                    </div>
					<? if($_GET['screen'] == 'home' || ($mobileAppObj->{$_GET['screen'].'_enabled'} == 'y' && $mobileAppObj->is_enabled == 'y')): ?>
                    <div class="mob_pic">
                        <div class="preview">
                            <iframe width="275" height="413" src="<?= DEFAULT_URL .'/mobi/index.php/'.$mobileAppObj->listing_id.'/'.$_GET['screen']?>" style="border-width:0px;"></iframe>
                        </div>
                    </div>
                    <?endif; ?>


                    
                </div>
                <? } else { ?>

                <div id="main-right">
                    <div style="display: inline-block; width: 95%; margin-bottom: 5px;">
                        <div style="float:right; width:170px;"><span  style="float:left">Enable: </span>
                            <input type="radio" name="is_enabled" value="y" <? if ($mobileAppObj->is_enabled == 'y') echo 'checked="checked"' ?> style="float:left; margin-left:10px;margin-top: 4px;" /><span  style="float:left"> Yes</span>
                            <input type="radio" name="is_enabled" value="n" <? if ($mobileAppObj->is_enabled == 'n') echo 'checked="checked"' ?> style="float:left; margin-left:15px;margin-top: 4px;" /><span  style="float:left"> No</span>
                        </div>
                    </div>
                    <br/>
                    <div class="mobile_link" style="display: <?= ($mobileAppObj->is_enabled == 'y') ? 'block' : 'none' ?> ">
                        Mobile Site Url : <span>www.dealcloudusa.com/mobi/index.php/<?= $mobileAppObj->listing_id ?>/</span>
                    </div>

                    <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                        <tbody>
                            <tr>
                                <th colspan="4" class="standard-tabletitle">Settings</th>
                            </tr>
                            <tr>
                                <th class="wrap">
                                    Page Colors:	
                                </th>
                                <td>
                                    <div id="colorSelector" >
                                        <div style="background-color: #<?= $mobileAppObj->bg_color ?>;"></div>
                                    </div>

                                    <input type="hidden"  id="colorpickerField" name="bg_color" value="<?= $mobileAppObj->bg_color ?>" />
                                    </div>
                                </td>

                            </tr>
                            
                             <tr>
                                <th class="wrap">
                                    Fav Icon:	
                                </th>
                                <td>
								
								    <div class="upload_box">
						              	<input type="text" readonly="readonly" class="file_input_textbox left" id="fileName">
						
										<div class="file_input_div">
						  					<input type="button" class="file_input_button" value="Browse">
						 					<input type="file" name="image" onchange="javascript: document.getElementById('fileName').value = this.value" class="file_input_hidden">
										</div>
								    </div>
									<? if(!empty($mobileAppObj->fav_icon_img )): ?>
									 <img style="margin: 10px auto; display: block" src="<?= "http://www.dealcloudusa.com/mobi/uploded_images/".$mobileAppObj->fav_icon_img ?>" width="50px" height="50px" />
									<? endif; ?>
	                        
	                            </td>

                            </tr>
                            
                            
                            
                        </tbody>
                    </table>



                    <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                        <tbody>
                            <tr>
                                <th colspan="6" class="standard-tabletitle">Pages</th>
                            </tr>
							
							<tr>
                                <th class="wrap">
                                    Home Page:	
                                </th>
                                <td>
                                    
                                <td>
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    <a href="<?= system_getFormAction($_SERVER['PHP_SELF']) . '?id=' . $id . '&screen=home' . '&letter=' . $letter ?>">Modify/View</a>
                                </td>
                            </tr>
							
                            <tr>
                                <th class="wrap">
                                    Splash Page:	
                                </th>
                                <td>
                                    <span  style="float:left">Yes</span>
                                <td>
                                    <input type="radio" name="splash_enabled" value="y" <? if ($mobileAppObj->splash_enabled == 'y') echo 'checked="checked"' ?> />
                                </td>
                                <td>
                                    <span  style="float:left">No</span>
                                </td>
                                <td>
                                    <input type="radio" name="splash_enabled" value="n" <? if ($mobileAppObj->splash_enabled == 'n') echo 'checked="checked"' ?>  />
                                </td>
                                <td>
                                    <a href="<?= system_getFormAction($_SERVER['PHP_SELF']) . '?id=' . $id . '&screen=splash' . '&letter=' . $letter ?>">Modify/View</a>
                                </td>
                            </tr>

                            <tr>
                                <th class="wrap">
                                    Deals Page:	
                                </th>
                                <td>
                                    <span  style="float:left">Yes</span>
                                <td>
                                    <input type="radio" name="promotion_enabled" value="y" <? if ($mobileAppObj->promotion_enabled == 'y') echo 'checked="checked"' ?> />
                                </td>
                                <td>
                                    <span  style="float:left">No</span>
                                </td>
                                <td>
                                    <input type="radio" name="promotion_enabled" value="n" <? if ($mobileAppObj->promotion_enabled == 'n') echo 'checked="checked"' ?>  />
                                </td>
                                <td>
                                    <a href="<?= system_getFormAction($_SERVER['PHP_SELF']) . '?id=' . $id . '&screen=promotion' . '&letter=' . $letter ?>">Modify/View</a>
                                </td>
                            </tr>

                            <tr>
                                <th class="wrap">
                                    Events Page:	
                                </th>
                                <td>
                                    <span  style="float:left">Yes</span>
                                <td>
                                    <input type="radio" name="events_enabled" value="y" <? if ($mobileAppObj->events_enabled == 'y') echo 'checked="checked"' ?> />
                                </td>
                                <td>
                                    <span  style="float:left">No</span>
                                </td>
                                <td>
                                    <input type="radio" name="events_enabled" value="n" <? if ($mobileAppObj->events_enabled == 'n') echo 'checked="checked"' ?>  />
                                </td>
                                <td>
                                    <a href="<?= system_getFormAction($_SERVER['PHP_SELF']) . '?id=' . $id . '&screen=events' . '&letter=' . $letter ?>">Modify/View</a>
                                </td>
                            </tr>

                            <tr>
                                <th class="wrap">
                                    Special Announcement Page:	
                                </th>
                                <td>
                                    <span  style="float:left">Yes</span>
                                <td>
                                    <input type="radio" name="special_announ_enabled" value="y" <? if ($mobileAppObj->special_announ_enabled == 'y') echo 'checked="checked"' ?> />
                                </td>
                                <td>
                                    <span  style="float:left">No</span>
                                </td>
                                <td>
                                    <input type="radio" name="special_announ_enabled" value="n" <? if ($mobileAppObj->special_announ_enabled == 'n') echo 'checked="checked"' ?>  />
                                </td>
                                <td>
                                    <a href="<?= system_getFormAction($_SERVER['PHP_SELF']) . '?id=' . $id . '&screen=special_announ' . '&letter=' . $letter ?>">Modify/View</a>
                                </td>
                            </tr>

                            <tr>
                                <th class="wrap">
                                    Classified Page:	
                                </th>
                                <td>
                                    <span  style="float:left">Yes</span>
                                <td>
                                    <input type="radio" name="classified_enabled" value="y" <? if ($mobileAppObj->classified_enabled == 'y') echo 'checked="checked"' ?> />
                                </td>
                                <td>
                                    <span  style="float:left">No</span>
                                </td>
                                <td>
                                    <input type="radio" name="classified_enabled" value="n" <? if ($mobileAppObj->classified_enabled == 'n') echo 'checked="checked"' ?>  />
                                </td>
                                <td>
                                    <a href="<?= system_getFormAction($_SERVER['PHP_SELF']) . '?id=' . $id . '&screen=classified' . '&letter=' . $letter ?>">Modify/View</a>
                                </td>
                            </tr>

                            <tr>
                                <th class="wrap">
                                    Share with Friends Page:	
                                </th>
                                <td>
                                    <span  style="float:left">Yes</span>
                                <td>
                                    <input type="radio" name="share_enabled" value="y" <? if ($mobileAppObj->share_enabled == 'y') echo 'checked="checked"' ?> />
                                </td>
                                <td>
                                    <span  style="float:left">No</span>
                                </td>
                                <td>
                                    <input type="radio" name="share_enabled" value="n" <? if ($mobileAppObj->share_enabled == 'n') echo 'checked="checked"' ?>  />
                                </td>
                                <td>
                                    <a href="<?= system_getFormAction($_SERVER['PHP_SELF']) . '?id=' . $id . '&screen=share' . '&letter=' . $letter ?>">Modify/View</a>
                                </td>
                            </tr>

                            <tr>
                                <th class="wrap">
                                    Reviews Page:	
                                </th>
                                <td>
                                    <span  style="float:left">Yes</span>
                                <td>
                                    <input type="radio" name="reviews_enabled" value="y" <? if ($mobileAppObj->reviews_enabled == 'y') echo 'checked="checked"' ?> />
                                </td>
                                <td>
                                    <span  style="float:left">No</span>
                                </td>
                                <td>
                                    <input type="radio" name="reviews_enabled" value="n" <? if ($mobileAppObj->reviews_enabled == 'n') echo 'checked="checked"' ?>  />
                                </td>
                                <td>
                                    <a href="<?= system_getFormAction($_SERVER['PHP_SELF']) . '?id=' . $id . '&screen=reviews' . '&letter=' . $letter ?>">Modify/View</a>
                                </td>
                            </tr>

                            <tr>
                                <th class="wrap">
                                    Contact Us Page:	
                                </th>
                                <td>
                                    <span  style="float:left">Yes</span>
                                <td>
                                    <input type="radio" name="contactus_enabled" value="y" <? if ($mobileAppObj->contactus_enabled == 'y') echo 'checked="checked"' ?> />
                                </td>
                                <td>
                                    <span  style="float:left">No</span>
                                </td>
                                <td>
                                    <input type="radio" name="contactus_enabled" value="n" <? if ($mobileAppObj->contactus_enabled == 'n') echo 'checked="checked"' ?>  />
                                </td>
                                <td>
                                    <a href="<?= system_getFormAction($_SERVER['PHP_SELF']) . '?id=' . $id . '&screen=contactus' . '&letter=' . $letter ?>">Modify/View</a>
                                </td>
                            </tr>

                            <tr>
                                <th class="wrap">
                                    About Us Page:	
                                </th>
                                <td>
                                    <span  style="float:left">Yes</span>
                                <td>
                                    <input type="radio" name="about_enabled" value="y" <? if ($mobileAppObj->about_enabled == 'y') echo 'checked="checked"' ?> />
                                </td>
                                <td>
                                    <span  style="float:left">No</span>
                                </td>
                                <td>
                                    <input type="radio" name="about_enabled" value="n" <? if ($mobileAppObj->about_enabled == 'n') echo 'checked="checked"' ?>  />
                                </td>
                                <td>
                                    <a href="<?= system_getFormAction($_SERVER['PHP_SELF']) . '?id=' . $id . '&screen=about' . '&letter=' . $letter ?>">Modify/View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>



                </div>

                <input type="hidden" value="<?= $id ?>" name="listing_id" />
                <div style="text-align: center">
                    <input type="submit" class="input-button-form" value="save" />
                </div>
                <? } ?>
            </form>
        </div>

        <div id="bottom-content">&nbsp;</div>

    </div>

    <?
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT . "/layout/footer.php");
    ?>

    <link rel="stylesheet" media="screen" type="text/css" href="http://www.dealcloudusa.com/scripts/jquery/colorpicker/css/colorpicker.css" />
    <script type="text/javascript" src="http://www.dealcloudusa.com/scripts/jquery/colorpicker/colorpicker.js"></script>
    <script>
        $('#colorSelector').ColorPicker({
            color: '#<?= $mobileAppObj->bg_color ?>',

            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                $('#colorSelector div').css('backgroundColor', '#' + hex);
                $('#colorpickerField').val(hex);
            }
        });
    </script>
    <style>
        #main-right {
            border: 0px solid #999;
            clear: right;
            float: left;
            margin: 5px 0 0 28px;
            padding: 0;
            width: 765px;
        }
        #main-right h1{
            border-bottom: 1px solid #BBBDC2;
            color: #000000;
            font-family: Arial,Verdana,sans-serif;
            font-size: 20px;
            font-weight: normal;
            margin: 0;
            padding: 0 0 4px;
            text-align: left;}

        #main-right p{
            color: #000000;
            font-family: Arial,Verdana,sans-serif;
            font-size: 12px;
            font-weight: normal;
            line-height: 19px;
            padding: 0;
            text-align: left;}


        .title {
            float:left; width:200px;
            border: 1px solid #888888;
            color: #888888;
            font-size: 12px;
            font-style: italic;
            height: 32px;
            line-height: 32px;
            margin: 0 0 0 15px;
            padding: 2px;

        }

        .p_title{float:left; height:40px; width:100%; margin-top:20px;}
        .mob{width:485px;
             height:442px;
	     margin:0 auto;
	}

        .mob_pic{ width:346px;
                  height:746px;
                  background-image:url(images/iphone.gif); float:left;
                  margin-left:79px;
                  margin-top:30px;}

        .preview{ 
            float:left;
            margin-left:36px;
            margin-top:108px;}

        .btns{ width:400px; height:40px; float:left; margin-top:-50px; margin-left:145px;}
        .btns a {
            height: 19px;
            width: 100px;
            background-image:url(images/btn.gif); background-repeat:repeat-x; color:#fff; text-align:center; text-decoration:none;
            padding:7px; float:left;
            border-radius: 3px; margin:8px;
        }

        .file_input_div {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 24px;
            color: #ecf5c0;
            text-decoration: none;
            height: 27px;
            margin-left: 3px;
            margin-top:8px;
            float: left;
            text-align: center;
            border-radius: 3px;
            position: relative;
            width: 100px;
            overflow: hidden;
            float: left;
        }
        .file_input_button {
            float: left;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 17px;
            color: #ecf5c0;
            text-decoration: none;
            height:27px;
            width: 100px;
            position: absolute;
            top: 0px;
            color: #FFFFFF;
            border-width:0px;
            background-image: url(images/btn.gif);
            background-repeat: repeat-x;
            margin-left:-50px;
            margin-left:0px \9;
            *margin-left:-50px ;
        }
        .upload_button {
            border-radius: 3px;
            float: right;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 17px;
            color: #ecf5c0;
            text-decoration: none;
            height:24px;
            width: 90px;
            top: 0px;
            color: #FFFFFF;
            border-width:0px;
            background-image: url(images/btn.gif);
            background-repeat: repeat-x;
            margin-top:8px;
            margin-right:-3px
        }
        .file_input_hidden {
            font-size: 45px;
            position: absolute;
            right: 0px;
            top: 0px;
            opacity: 0;
            filter: alpha(opacity=0);
            -ms-filter: "alpha(opacity=0)";
            -khtml-opacity: 0;
            -moz-opacity: 0;
        }

        .upload_box{float:left;width: 100%}

        #colorSelector {
            position: relative;
            width: 36px;
            height: 36px;
            background: url(images/select.png);
        }
        #colorSelector div {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 30px;
            height: 30px;
            background: url(images/select.png) center;
        }
		
		
        table.standard-table tr th .file_input_textbox,table.standard-table tr td .file_input_textbox {
            
            float:left;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            color: #000;
            border-radius: 2px;
            border: 1px solid #888888;
            background-color: #FFF;
            padding-left: 3px;
            padding-top:2px;
            margin-top:8px;
            width:482px;
            border-width:1px;
        }
		
		.mobile_link{
			
			width: 99%;
			height: 28px;
			background-color: #CFE7F9;
			border: 1px solid #91D0FF;
			line-height: 28px;
			
		}

    </style>

    <script type="text/javascript">
        jQuery("input[name=is_enabled]").live('change',function(){
            if(jQuery(this).val() == 'y'){
                jQuery('.mobile_link').show();
            }else{
                jQuery('.mobile_link').hide();
            }
        });
    </script>
