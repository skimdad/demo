<?
# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
//TODO: Mavencrew - change the include of the model class

include(EDIRECTORY_ROOT . "/classes/class_MobileApplication.php");
include(EDIRECTORY_ROOT . "/mobi/upload_image.php");
include(EDIRECTORY_ROOT . "/includes/code/listing_mobileapp.php");

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
             
            <div class="submenu" style="float:none;height: 40px">
                <ul>
                    <li <?if(empty($_GET['screen'])):?>class="submenu_active"<? endif; ?>>
                        <a href="<?= system_getFormAction($_SERVER['PHP_SELF']) . '?id=' . $id . '&screen=&letter=' ?>">
                            Main
                        </a>
                    </li>
                    <? foreach($mobile_screens as  $s): ?>
                    <li <?if($_GET['screen'] == $s):?>class="submenu_active"<? endif; ?>>
                        <a href="<?= system_getFormAction($_SERVER['PHP_SELF']) . '?id=' . $id . '&screen=' . $s . '&letter='?>">
                            <?= $mobileAppObj->{$s.'_title'} ?>
                        </a>
                    </li>
                    <? endforeach; ?>
                </ul>
            </div>
            <? if($_GET['id']!= -1): ?>
            <div class="mobile_link" style="line-height: 16px ; display: <?= ($mobileAppObj->is_enabled == 'y') ? 'block' : 'none' ?> ">
                Mobile Site Url : <span>www.dealcloudusa.com/mobi/index.php/<?= $mobileAppObj->listing_id ?>/</span>
            </div>            
            <br />
            <form class="mobile_link" action="<?= DEFAULT_URL . '/sitemgr/listing/send_url.php?id=' . $listing->id ?>" method="POST">
                <input type="hidden" value="<?= (string_strpos($_SERVER["PHP_SELF"], 'sitemgr/')) ? 'sitemgr' : 'members' ?>" name="redirect_folder"/>
                <?
                $client_account = new Contact($listing->account_id);
                $client_email = $client_account->email;
                ?>
                <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                    <tbody>
                        <tr>
                            <th>Send URL To:</th>
                            <td><input type="email" name='send_url_to' required value="<?= $client_email ?>" />
                                <input type="submit" name="send_url" value="send url" class="input-button-form">
                                <div>
                                    <? if (!empty($_GET['mail_msg'])) echo $_GET['mail_msg'] ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </form>
            <? endif; ?>

            <form enctype="multipart/form-data" name="mobileapp_settings" class="mobileapp_settings" id="mobileapp_settings" action="<?= system_getFormAction($_SERVER["PHP_SELF"]) . '?id=' . $id . '&screen=' . $screen . '&letter=' . $letter ?>" method="post">
                <input type="hidden" name="crop_submit" id="crop_submit">
                <input type="hidden" name="submit_button" id="submit_button" />
                <? include(EDIRECTORY_ROOT . "/includes/code/thumbnail.php"); ?>
                <? if (MobileApp_FEATURE != "on") : ?>
                    <p class="informationMessage"><?= system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE) ?></p>		
                <? elseif (!empty($_GET['screen']) && in_array($_GET['screen'], $mobile_screens)): ?>
                    <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                        <tbody>
                            <tr>
                                <th colspan="4" class="standard-tabletitle"> <?= $mobileAppObj->{$_GET['screen'] . '_title'} ?> Settings</th>
                            </tr>
                            <tr>
                                <th class="wrap"> Page Title: </th>
                                <td>
                                    <input name="<?= $_GET['screen'] . '_title' ?>" type="text" value="<? echo $mobileAppObj->{$_GET['screen'] . '_title'} ?>" />
                                </td>
                            </tr>

                            <? if ($_GET['screen'] == 'home'): ?>
                                <tr>
                                    <th class="wrap"> Logo Image: </th>
                                    <td>
                                        <div class="upload_box">

                                            <div class="file_input_div">
        <!--												<input type="button" class="file_input_button" value="Browse">
                                                    <input type="file" name="image" onchange="javascript: document.getElementById('fileName').value = this.value" class="file_input_hidden">-->
                                                <input type="file" name="image" id="image" size="74" onchange="UploadImage('mobileapp_settings');" />
                                                <? //Crop Tool Inputs ?>
                                                <input type="hidden" name="x" id="x">
                                                <input type="hidden" name="y" id="y">
                                                <input type="hidden" name="x2" id="x2">
                                                <input type="hidden" name="y2" id="y2">
                                                <input type="hidden" name="w" id="w">
                                                <input type="hidden" name="h" id="h">
                                                <input type="hidden" name="image_width" id="image_width">
                                                <input type="hidden" name="image_height" id="image_height">
                                                <input type="hidden" name="image_type" id="image_type">
                                            </div>
                                        </div>
                                        <? if (isset($image_upload_error)): ?>
                                            <p class="errorMessage" style="clear:both"><?= $image_upload_error ?></p>
                                        <? endif; ?>
                                        <? if (!empty($mobileAppObj->logo_image)): ?>
                                            <img style="margin: 10px auto; display: block;max-height: 100px" src="<?= DEFAULT_URL . "/mobi/uploded_images/" . $mobileAppObj->logo_image . '?' . substr(number_format(time() * rand(), 0, '', ''), 0, 10) ?>"/>
                                        <? endif; ?>
                                    </td>
                                </tr>	
                            <? endif; ?>

                            <? if ($_GET['screen'] == 'splash'): ?>
                                <tr>
                                    <th class="wrap">Spalsh Extra Image: </th>
                                    <td>
                                        <div class="upload_box">

                                            <div class="file_input_div">
        <!--												<input type="button" class="file_input_button" value="Browse">
                                                    <input type="file" name="image" onchange="javascript: document.getElementById('fileName').value = this.value" class="file_input_hidden">-->
                                                <input type="file" name="image" id="image" size="74" onchange="UploadImage('mobileapp_settings');" />
                                                <? //Crop Tool Inputs ?>
                                                <input type="hidden" name="x" id="x">
                                                <input type="hidden" name="y" id="y">
                                                <input type="hidden" name="x2" id="x2">
                                                <input type="hidden" name="y2" id="y2">
                                                <input type="hidden" name="w" id="w">
                                                <input type="hidden" name="h" id="h">
                                                <input type="hidden" name="image_width" id="image_width">
                                                <input type="hidden" name="image_height" id="image_height">
                                                <input type="hidden" name="image_type" id="image_type">
                                            </div>
                                        </div>
                                        <? if (isset($image_upload_error)): ?>
                                            <p class="errorMessage" style="clear: both"><?= $image_upload_error ?></p>
                                        <? endif; ?>
                                        <? if (!empty($mobileAppObj->splash_extra_image)): ?>
                                            <img style="margin: 10px auto; display: block;max-height: 100px" src="<?= DEFAULT_URL . "/mobi/uploded_images/" . $mobileAppObj->splash_extra_image . '?' . substr(number_format(time() * rand(), 0, '', ''), 0, 10) ?>"  />
                                        <? endif; ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        show logo or title:
                                    </th>
                                    <td class="splash_title_or_logo">
                                        <input type="radio" name="splash_title_or_logo" value="logo" 
                                               <? if ($mobileAppObj->splash_title_or_logo == 'logo'): ?>checked="checked" <? endif; ?>
                                               />logo only
                                        <br />
                                        <input type="radio" name="splash_title_or_logo" value="title" 
                                               <? if ($mobileAppObj->splash_title_or_logo == 'title'): ?>checked="checked" <? endif; ?>
                                               />title only
                                        <br /><input type="radio" name="splash_title_or_logo" value="title_n_logo" 
                                                     <? if ($mobileAppObj->splash_title_or_logo == 'title_n_logo'): ?>checked="checked" <? endif; ?>       
                                                     />title and logo
                                    </td>
                                </tr>
                            <? endif; ?>

                            <? if ($_GET['screen'] == 'special_announ'): ?>
                                <tr>
                                    <th class="wrap"> Description: </th>
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
                            <? if (in_array($_GET['screen'], $screen_has_emptydata)): ?>
                                <tr>
                                    <th class="wrap"> Empty Data Notifications: </th>
                                    <td>
                                        <? if ($_GET['screen'] != 'special_announ'): ?>
                                            <script type="text/javascript" src="<?= DEFAULT_URL ?>/includes/tiny_mce/tiny_mce_src.js"></script>
                                        <? endif; ?>
                                        <script type="text/javascript">
                                            // Default skin
                                            var inlinePopUps = "inlinepopups,";
                                            if ($.browser.msie && $.browser.version == 9){
                                                inlinePopUps = "";
                                            }
                                            tinyMCE.init({
                                                // General options
                                                mode : "exact",
                                                elements : 'txt_<?= $_GET['screen'] ?>_no_data',
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
                                        <textarea id="txt_<?= $_GET['screen'] ?>_no_data" class="txt_<?= $_GET['screen'] ?>_no_data" name="txt_<?= $_GET['screen'] ?>_no_data"><? echo $mobileAppObj->{$_GET['screen'] . '_no_data'} ?></textarea>
                                    </td>
                                </tr>
                            <? endif; ?>	                                                                
                        </tbody>
                    </table>			

                    <div class="mob">
                        <div class="btns" style="width:100%;text-align:center;margin: 10px auto" >
                            <br />
                            <!--<button type="button" name="home" class="input-button-form" value="Home" onclick="window.location.href = '<?= system_getFormAction($_SERVER["PHP_SELF"]) . '?id=' . $id . '&screen=&letter=' . $letter ?>';">Home</button> -->
                            <button type="button" name="cancel" class="input-button-form" value="Cancel" onclick="window.location.href = '<?= system_getFormAction($_SERVER["PHP_SELF"]) . '?id=' . $id . '&screen=&letter=' . $letter ?>';">Cancel</button>

                            <input type="submit" class="input-button-form" value="save" />
                        </div>
                        <? if ($id != -1 && ($_GET['screen'] == 'home' || ($mobileAppObj->{$_GET['screen'] . '_enabled'} == 'y' && $mobileAppObj->is_enabled == 'y'))): ?>
                            <div class="mob_pic">
                                <div class="preview">
                                    <iframe width="275" height="413" src="<?= DEFAULT_URL . '/mobi/index.php/' . $mobileAppObj->listing_id . '/' . $_GET['screen'] ?>" style="border-width:0px;"></iframe>
                                </div>
                            </div>
                        <? endif; ?>
                    </div>
                <? else: ?>
                    <div style="display: inline-block; width: 95%; margin-bottom: 5px;">
                        <div style="float:right; width:170px;"><span  style="float:left">Enable: </span>
                            <input type="radio" name="is_enabled" value="y" <? if ($mobileAppObj->is_enabled == 'y') echo 'checked="checked"' ?> style="float:left; margin-left:10px;margin-top: 4px;" /><span  style="float:left"> Yes</span>
                            <input type="radio" name="is_enabled" value="n" <? if ($mobileAppObj->is_enabled == 'n') echo 'checked="checked"' ?> style="float:left; margin-left:15px;margin-top: 4px;" /><span  style="float:left"> No</span>
                        </div>
                    </div>
                    <br/>

                    <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                        <tbody>
                            <tr>
                                <th colspan="4" class="standard-tabletitle">Settings</th>
                            </tr>
                            <tr>
                                <th class="wrap">Page Colors:</th>
                                <td>
                                    <div id="colorSelector" >
                                        <div style="background-color: #<?= $mobileAppObj->bg_color ?>;"></div>
                                    </div>
                                    <input type="hidden"  id="colorpickerField" name="bg_color" value="<?= $mobileAppObj->bg_color ?>" />   
                                    <span class="mgHeaderSubtitle">click the colored box to change mobile website backgroung color</span>
                                </td>
                            </tr>
                            <tr>
                                <th class="wrap"> Company Name:	</th>
                                <td class="splash_title_or_logo">
                                    <input type="radio" name="show_inner_title" value="y"  
                                           <? if ($mobileAppObj->show_inner_title == 'y'): ?>checked="checked" <? endif; ?>
                                           />
                                    yes <br/>
                                    <input type="radio" name="show_inner_title" value="n" 
                                           <? if ($mobileAppObj->show_inner_title == 'n'): ?>checked="checked" <? endif; ?>  
                                           />
                                    no
                                </td>
                            </tr>
                            <tr>
                                <th class="wrap"> Home Screen Icon:	</th>
                                <td>
                                    <div class="upload_box">

                                        <div class="file_input_div">
    <!--												<input type="button" class="file_input_button" value="Browse">
                                                <input type="file" name="image" onchange="javascript: document.getElementById('fileName').value = this.value" class="file_input_hidden">-->
                                            <input type="file" name="image" id="image" size="74" onchange="UploadImage('mobileapp_settings');" />

                                            <? //Crop Tool Inputs ?>
                                            <input type="hidden" name="x" id="x">
                                            <input type="hidden" name="y" id="y">
                                            <input type="hidden" name="x2" id="x2">
                                            <input type="hidden" name="y2" id="y2">
                                            <input type="hidden" name="w" id="w">
                                            <input type="hidden" name="h" id="h">
                                            <input type="hidden" name="image_width" id="image_width">
                                            <input type="hidden" name="image_height" id="image_height">
                                            <input type="hidden" name="image_type" id="image_type">
                                        </div>
                                        <span class="mgHeaderSubtitle">

                                            Maximum file size 1.5 MB. Animated .gif isn't supported.<br>(120px x 120px) (JPG, GIF or PNG)
                                        </span>
                                    </div>
                                    <? if (isset($image_upload_error)): ?>
                                        <p class="errorMessage" style="clear: both;"><?= $image_upload_error ?></p>
                                    <? endif; ?>
                                    <? if (!empty($mobileAppObj->fav_icon_img)): ?>
                                        <img style="margin: 10px auto; display: block;max-height: 100px" src="<?= DEFAULT_URL . "/mobi/uploded_images/" . $mobileAppObj->fav_icon_img . '?' . substr(number_format(time() * rand(), 0, '', ''), 0, 10) ?>" width="50px" height="50px" />
                                    <? endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table cellpadding="0" cellspacing="0" border="0" class="standard-table mobile_pages">
                        <tbody>
                            <tr>
                                <th colspan="6" class="standard-tabletitle">Pages</th>
                            </tr>
                            <tr>
                                <th class="wrap"> Home Page: </th>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td class="view_mod_cell">
                                    <a href="<?= system_getFormAction($_SERVER['PHP_SELF']) . '?id=' . $id . '&screen=home' . '&letter=' . $letter ?>">Modify/View</a>
                                </td>
                            </tr>
                            <tr>
                                <th class="wrap">Splash Page:</th>
                                <td class="yes_lbl_cell">
                                    <span  style="">Yes</span>
                                </td>
                                <td>
                                    <input type="radio" name="splash_enabled" value="y" <? if ($mobileAppObj->splash_enabled == 'y') echo 'checked="checked"' ?> />
                                </td>
                                <td style="width: 15px">
                                    <span  style="">No</span>
                                </td>
                                <td>
                                    <input type="radio" name="splash_enabled" value="n" <? if ($mobileAppObj->splash_enabled == 'n') echo 'checked="checked"' ?>  />
                                </td>
                                <td class="view_mod_cell">
                                    <a href="<?= system_getFormAction($_SERVER['PHP_SELF']) . '?id=' . $id . '&screen=splash' . '&letter=' . $letter ?>">Modify/View</a>
                                </td>
                            </tr>
                            <?
                            foreach ($mobile_screens as $screen):
                                if ($screen != 'home' && $screen != 'splash'):
                                    ?>
                                    <tr>
                                        <th class="wrap"> <?= $mobileAppObj->{$screen . '_title'} ?>: </th>
                                        <td class="yes_lbl_cell">
                                            <span  style="">Yes</span>
                                        </td>	
                                        <td>
                                            <input type="radio" name="<?= $screen ?>_enabled" value="y" <? if ($mobileAppObj->{$screen . '_enabled'} == 'y') echo 'checked="checked"' ?> />
                                        </td>
                                        <td>
                                            <span  style="float:left">No</span>
                                        </td>
                                        <td>
                                            <input type="radio" name="<?= $screen ?>_enabled" value="n" <? if ($mobileAppObj->{$screen . '_enabled'} == 'n') echo 'checked="checked"' ?>  />
                                        </td>
                                        <td class="view_mod_cell">
                                            <a href="<?= system_getFormAction($_SERVER['PHP_SELF']) . '?id=' . $id . '&screen=' . $screen . '&letter=' . $letter ?>">Modify/View</a>
                                        </td>	
                                    </tr>	
                                    <?
                                endif;
                            endforeach;
                            ?>	
                        </tbody>
                    </table>
                    <input type="hidden" value="<?= $id ?>" name="listing_id" />
                    <div style="text-align: center">
                        <input type="submit" class="input-button-form" value="save" />
                    </div>
                <? endif; ?>
            </form>
        </div>
        <div id="bottom-content">&nbsp;</div>
    </div>
</div>
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
              background-image:url(http://www.dealcloudusa.com/sitemgr/listing/images/iphone.gif); float:left;
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
        background-image:url(http://www.dealcloudusa.com/sitemgr/listing/images/btn.gif); background-repeat:repeat-x; color:#fff; text-align:center; text-decoration:none;
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
        width: 100%;
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
        background-image: url(http://www.dealcloudusa.com/sitemgr/listing/images/btn.gif);
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
        background-image: url(http://www.dealcloudusa.com/sitemgr/listing/images/btn.gif);
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
        background: url(http://www.dealcloudusa.com/sitemgr/listing/images/select.png);
    }
    #colorSelector div {
        position: absolute;
        top: 3px;
        left: 3px;
        width: 30px;
        height: 30px;
        background: url(http://www.dealcloudusa.com/sitemgr/listing/images/select.png) center;
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

    div.mobile_link{

        width: 99%;
        height: 28px;
        background-color: #CFE7F9;
        border: 1px solid #91D0FF;
        line-height: 28px;

    }

    table.standard-table.mobile_pages td input
    {
        width: auto;
    }

    table.mobile_pages .view_mod_cell
    {
        width: 200px; 
        text-align: center;
    }

    table.mobile_pages td.yes_lbl_cell
    {
        width: 150px; 
        text-align: right;
    }
    .splash_title_or_logo input[type="radio"]{
        display: inline;
        margin-right: 10px;
        vertical-align: middle;
        width: auto;
    }
    .splash_title_or_logo 
    {
        line-height: 21px;
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
