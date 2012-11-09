<?php
include("../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSMSession();
permission_hasSMPerm();
include(EDIRECTORY_ROOT . "/classes/class_MobileApplication_Settings.php");
include(EDIRECTORY_ROOT . "/mobi/upload_image.php");
$settObj = new MobileApplication_Settings();
$settObj->getByItemName('dealcloud_logo_url');

$is_mobile_ad_enabledObj = new MobileApplication_Settings();
$is_mobile_ad_enabledObj->getByItemName('is_mobile_ad_enabled');

$mobile_ad_use_img_or_txtObj = new MobileApplication_Settings();
$mobile_ad_use_img_or_txtObj->getByItemName('mobile_ad_use_img_or_txt');

$mobile_ad_txtObj = new MobileApplication_Settings();
$mobile_ad_txtObj->getByItemName('mobile_ad_txt');

$mobile_ad_linkObj = new MobileApplication_Settings();
$mobile_ad_linkObj->getByItemName('mobile_ad_link');





$mobile_ad_imgObj = new MobileApplication_Settings();
$mobile_ad_imgObj->getByItemName('mobile_ad_img');


$settingObjs = Array($settObj, $is_mobile_ad_enabledObj, $mobile_ad_use_img_or_txtObj, $mobile_ad_txtObj, $mobile_ad_linkObj, $mobile_ad_imgObj);
if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['save_settings'])) {
    foreach ($settingObjs as $s_obj) {
        if (!empty($_POST[$s_obj->name]) || $s_obj->name == 'mobile_ad_img') {
            $s_obj->value = $_POST[$s_obj->name];
            if ($s_obj->name == 'mobile_ad_img') {
                $s_obj->value = (!empty($file_name_to_save) )?$file_name_to_save:$s_obj->value ;
            }
            $s_obj->Save();
        }
    }
}

$settObj->getByItemName('dealcloud_logo_url');
# ----------------------------------------------------------------------------------------------------
# HEADER
# ----------------------------------------------------------------------------------------------------
include(SM_EDIRECTORY_ROOT . "/layout/header.php");

# ----------------------------------------------------------------------------------------------------
# NAVBAR
# ----------------------------------------------------------------------------------------------------
include(SM_EDIRECTORY_ROOT . "/layout/navbar.php");
?>

<div id="main-right">
    <div id="top-content">
        <div id="header-content">
            <h1><?= system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS) ?> - Mobile Settings</h1>
        </div>
    </div>
    <br />    <br />

    <form enctype="multipart/form-data" name="mobileapp_settings1" id="mobileapp_settings1" class="mobileapp_settings1" action="<?= system_getFormAction($_SERVER["PHP_SELF"]) ?>" method="post">
        <input type="hidden" name="crop_submit" id="crop_submit">
        <input type="hidden" name="submit_button" id="submit_button" />
        <? include(EDIRECTORY_ROOT . "/includes/code/thumbnail.php"); ?>
        <div id="top-content">
            <div id="Header-content">
                <h2>header Settings</h2>
            </div>
        </div>

        <div id="content-content">
            <div class="default-margin">

                <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                    <tbody>

                        <tr>
                            <th class="wrap"> Daelcloud Logo URL: </th>
                            <td>
                                <input name="dealcloud_logo_url" type="text" value="<?= $settObj->value ?>" />
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div id="top-content">
            <div id="header-content">
                <h2>Ad Settings</h2>
            </div>
        </div>

        <div id="content-content">
            <div class="default-margin">

                <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                    <tbody>

                        <tr>
                            <th class="wrap"> <?= $is_mobile_ad_enabledObj->readable_name ?>: </th>
                            <td>
                                <input name="<?= $is_mobile_ad_enabledObj->name ?>" type="radio" value="y" 
                                       <? if ($is_mobile_ad_enabledObj->value == 'y'): ?>checked="checked"<? endif; ?>
                                       /> yes        
                                <br />
                                <input name="<?= $is_mobile_ad_enabledObj->name ?>" type="radio" value="n" 
                                       <? if ($is_mobile_ad_enabledObj->value == 'n'): ?>checked="checked"<? endif; ?>
                                       /> no
                            </td>
                        </tr>

                        <tr>
                            <th class="wrap"> <?= $mobile_ad_use_img_or_txtObj->readable_name ?>: </th>
                            <td>
                                <input name="<?= $mobile_ad_use_img_or_txtObj->name ?>" type="radio" value="image" 
                                       <? if ($mobile_ad_use_img_or_txtObj->value == 'image'): ?>checked="checked"<? endif; ?>
                                       /> image        
                                <br />
                                <input name="<?= $mobile_ad_use_img_or_txtObj->name ?>" type="radio" value="text" 
                                       <? if ($mobile_ad_use_img_or_txtObj->value == 'text'): ?>checked="checked"<? endif; ?>
                                       /> text
                            </td>
                        </tr>

                        <tr>
                            <th class="wrap"> <?= $mobile_ad_txtObj->readable_name ?>: </th>
                            <td>
                                <input name="<?= $mobile_ad_txtObj->name ?>" type="text" value="<?= $mobile_ad_txtObj->value ?>" />
                            </td>
                        </tr>

                        <tr>
                            <th class="wrap"> <?= $mobile_ad_imgObj->readable_name ?>: </th>
                            <td>
                                <div class="upload_box">

                                    <div class="file_input_div">

                                        <input type="file" name="image" id="image" size="74" onchange="UploadImage('mobileapp_settings1');" />
                                        <? //Crop Tool Inputs  ?>
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
                                <? if (!empty($mobile_ad_imgObj->value)): ?>
                                    <img style="margin: 10px auto; display: block;max-height: 100px" src="<?= DEFAULT_URL . "/mobi/uploded_images/" . $mobile_ad_imgObj->value . '?' . substr(number_format(time() * rand(), 0, '', ''), 0, 10) ?>"/>
                                <? endif; ?>

                            </td>
                        </tr>	

                        <tr>
                            <th class="wrap"> <?= $mobile_ad_linkObj->readable_name ?>: </th>
                            <td>
                                <input name="<?= $mobile_ad_linkObj->name ?>" type="text" value="<?= $mobile_ad_linkObj->value ?>" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="btns" style="width:100%;text-align:center;margin: 10px auto" >
                    <input type="submit" class="input-button-form" value="save" name="save_settings"/>
                </div>

            </div>
        </div>
    </form>
</div>
<style>
    #mobileapp_settings1 input[type="radio"]{
        display: inline;
        margin-right: 10px;
        vertical-align: middle;
        width: auto;
    }
    #mobileapp_settings1 form 
    {
        line-height: 21px;
    }
</style>
<?
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
include(SM_EDIRECTORY_ROOT . "/layout/footer.php");
?>
