<?
/* ==================================================================*\
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
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/code/thumbnail.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------

/* * *************************************************************************************************
 * CREATING AN IMAGE FOR CROPPING TOOL
 * description:	This code will be executed in the iframe and then
 * 				a function will be sent back to the parent form.
 * 				This way the form will not be reloaded.
 */

function arrayValue($v, $w) {
    if ($v != '' && $w == '')
        return $v;
    elseif ($w != '')
        return $w;
}

$aux_aspectRat = 0;
if (string_strpos($_SERVER["PHP_SELF"], "/profile") !== false || (string_strpos($_SERVER["PHP_SELF"], "/account") !== false)) {
    $_image_relative_path = PROFILE_IMAGE_RELATIVE_PATH;
    $_image_dir = PROFILE_IMAGE_DIR;
    $_image_url = PROFILE_IMAGE_URL;
    $aux_aspectRat = 1;
} else {
    $_image_relative_path = IMAGE_RELATIVE_PATH;
    $_image_dir = IMAGE_DIR;
    $_image_url = IMAGE_URL;
}

if (string_strpos($_SERVER["PHP_SELF"], PROMOTION_FEATURE_FOLDER) !== false) {
    if (GALLERY_FREE_RATIO == "on") {
        $aspectratio = 0;
    } else {
        $mdc = image_getMdc(IMAGE_PROMOTION_THUMB_WIDTH, IMAGE_PROMOTION_THUMB_HEIGHT);
        $aux_aspectRat = (IMAGE_PROMOTION_THUMB_WIDTH / $mdc) / (IMAGE_PROMOTION_THUMB_HEIGHT / $mdc);
    }
}

//adjust mobile app aspect ratios
if (string_strpos($_SERVER["PHP_SELF"], "/MobileApp.php") !== false) {
    if (empty($_GET['screen'])) {
        $aux_aspectRat = 1;
    } elseif ($_GET['screen'] == 'home') {
        $aux_aspectRat = 1.5;
    }
    elseif ($_GET['screen'] == 'splash') {
        $aux_aspectRat = 0.75;
    }
}

if(string_strpos($_SERVER["PHP_SELF"], '/mobileappsettings.php'))
{
    $aux_aspectRat = 4.5;
}


$user_id = $_COOKIE["PHPSESSID"];
$dir = $_image_dir;

if (is_array($_POST["crop_submit"]))
    $crop = array_shift($_POST["crop_submit"]);
else
    $crop = $_POST["crop_submit"];
if ($crop == 'true')
    $crop = true;

if (!is_bool($crop)) {
    $counter = $crop;
    $files = array_keys($_FILES);
    $file = $files[$crop - 1];
} else {
    $counter = '';
    $file = array_shift(array_keys($_FILES));
}

if ($crop && $_FILES[$file]) {

    $str_type = $_FILES[$file]["type"];
    if (is_array($str_type))
        $str_type = array_reduce($str_type, 'arrayValue');
    $array_type = explode("/", $str_type);
    $imagetype = array_pop($array_type);
    if ($imagetype == 'pjpeg')
        $imagetype = 'jpeg';
    if ($imagetype == 'x-png')
        $imagetype = 'png';

    $files = glob("$dir/_" . ($crop - 1) . "_" . $user_id . "_*.*");

    print ( "<script type=\"text/javascript\">");
    if ($_FILES[$file]["error"] == 1) {
        print ( "parent.noImage('size','" . $counter . "');");
    } else if ($imagetype == 'jpeg' || $imagetype == 'gif' || $imagetype == 'png') {

        $imagename = uniqid("_" . ($crop - 1) . "_" . $user_id . "_") . "." . $imagetype;

        $file_tmpname = $_FILES[$file]['tmp_name'];
        if (is_array($file_tmpname))
            $file_tmpname = array_reduce($file_tmpname, 'arrayValue');
        $file_name = $_FILES[$file]['name'];
        if (is_array($file_name))
            $file_name = array_reduce($file_name, 'arrayValue');

        // move (actually just rename) the temporary file to the real name.
        // write permissions are required by the script to place the image here.

        $maxImageSize = "0000000";
        $maxImageSize = string_substr($maxImageSize, string_strlen((UPLOAD_MAX_SIZE * 10) + 1));
        $maxImageSize = ((UPLOAD_MAX_SIZE * 10) + 1) . "00000";

        if (filesize($file_tmpname) < $maxImageSize) {
            move_uploaded_file($file_tmpname, $dir . "/" . $imagename);
            list($width, $height, $type, $attr) = getimagesize($_image_dir . "/" . $imagename);
            if ($type == "1" || $type == "2" || $type == "3") {
                if (file_exists($dir . "/" . $imagename) && $file_name != '') {
                    print ( "parent.SetImageFile(\"" . $_image_url . "/" . $imagename . "\", " . $width . ", " . $height . ", " . $type . ", '" . $counter . "' , $aux_aspectRat);");
                }
            } else {
                print ( "parent.noImage('type','" . $counter . "');");
            }
        } else {
            print ( "parent.noImage('size','" . $counter . "');");
        }
    } else {
        print ( "parent.noImage('type','" . $counter . "');");
    }

    print ( "</script>");

    foreach ($files as $file)
        unlink($file);
}

/* * ************************************************************************************************ */

# ----------------------------------------------------------------------------------------------------
# SCRIPTS
# ----------------------------------------------------------------------------------------------------
?>
<a href="#" id="crop_window" class="fancy_window_crop" style="display:none"></a>

<script type="text/javascript">
    //<![CDATA[
    
    $(document).ready(function() {
        $("a.fancy_window_crop").fancybox({
            'autoDimensions'        : false,
            'modal'                 : true,
            'overlayShow'			: true,
            'overlayOpacity'		: 0.75,
            'width'                 : 415,
            'height'                : 455
        });
    });
    
    // creating an iframe to post the image to generate a preview
    $('document').ready(function() { $("<iframe name='img_frame' style='display:none;'></iframe>").appendTo('body'); });

    // description : upload the image to the server
    // notes : 1. send to the iframe created before
    // 		   2. submit the form to it
    function UploadImage(form, multi) {
        if ( multi ) {
            var counter = multi;
            var subcrop = multi;
        }
        else {
            var counter = '';
            var subcrop = true;
        }
        $("#crop_window").attr("href", '<?= DEFAULT_URL ?>/includes/forms/form_crop.php?multi=' + counter);
        $("#crop_window").trigger('click');

        // clearing error message and removing thumb preview
        $('#noImageSpan'+counter).css('display', 'none');
        $('.imageSpace img').css('display', 'none');
        // removing pre-cropped images if any
        if ( '.jcrop-holder' ) {
            $('.jcrop-holder').remove();
            $('.jcrop-hline').remove();
            $('.jcrop-vline').remove();
            $('.jcrop-tracker').remove();
            $('.jcrop-handle').remove();
        }
        // sending image
        $('#crop_submit').val(subcrop);
        $('#'+form).attr('target', 'img_frame');
        $('#'+form).submit();
        $('#'+form).attr('target', '_self');
        $('#crop_submit').val(0);
    }

    // placing an error message if the image format is not allowed
    function noImage(message, multi) {
        if ( multi ) var counter = multi;
        else var counter = '';
        $('#loadingBar').remove();
        if(message == "type"){
            $('#errorType').css('display', '');
        } else if(message == "size") {
            $('#errorSize').css('display', '');
        }
        $('#noImageSpan'+counter).css('display', '');
    }

    // set the src of the image to the uploaded one
    function SetImageFile( pImgSrc, imgWidth, imgHeight, imgType, multi , aspectRat ) {
        if ( multi ) var counter = multi;
        else var counter = '';
        $('#loadingBar').remove();
        $('#ButtonCropSubmit').css('display', '');
        $('#imgUpload'+counter).attr('src', pImgSrc);
        $('#imgUpload'+counter).css('display', '');
        $('#crop').css('display', '');

        setJcrop(imgWidth, imgHeight, imgType, counter, aspectRat);
    }

    // creating the Jcrop
    function setJcrop(imgWidth, imgHeight, imgType, multi, aspectRat) {
        if ( multi ) var counter = multi;
        else var counter = '';
        $('#imgUpload'+counter).Jcrop({
            onChange: showCoords,
            onSelect: showCoords,
            setSelect:   [ (imgWidth/4), (imgHeight/4), (imgWidth/4*3), (imgHeight/4*3) ],
            aspectRatio: aspectRat,
            boxWidth: 400,
            boxHeight: 400,
            bgColor: 'transparent',
            fullImageWidth: imgWidth,
            fullImageHeight: imgHeight
        });
        function showCoords(c) {
            $('#x'+counter).val(c.x);
            $('#y'+counter).val(c.y);
            $('#x2'+counter).val(c.x2);
            $('#y2'+counter).val(c.y2);
            $('#w'+counter).val(c.w);
            $('#h'+counter).val(c.h);
            $('#image_width'+counter).val(imgWidth);
            $('#image_height'+counter).val(imgHeight);
            $('#image_type'+counter).val(imgType);
        };
    }
    //]]>
</script>