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
	# * FILE: /popup/popup.php
	# ----------------------------------------------------------------------------------------------------

    if ($_GET["domain_id"] || $_POST["domain_id"]){
        define("SELECTED_DOMAIN_ID", $_GET["domain_id"] ? $_GET["domain_id"] : $_POST["domain_id"]);
    }
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");
    
    header("Content-Type: text/html; charset=utf-8", TRUE);
	header("Accept-Encoding: gzip, deflate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check", FALSE);
    header("Pragma: no-cache");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	session_start();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    extract($_GET);
    extract($_POST);
    
    if (file_exists(EDIRECTORY_ROOT."/includes/code/$pop_type.php")){
        include(EDIRECTORY_ROOT."/includes/code/$pop_type.php");
    }
    
    $extraStyle = "";
    $aux_modal_box = "";
    
    if (string_strpos($pop_type, "clicktocall") !== false || string_strpos($pop_type, "sendtophone") !== false){
       $extraStyle = "modal-content-small";
    }elseif (string_strpos($pop_type, "profile_login") !== false){
        $extraStyle = "login";
        $aux_modal_box = "profileLogin"; 
    }elseif($pop_type == "uploadimage"){
        $extraStyle = "modal-content-upload";
    }
    
    $loadMembersCss = false;
    $arrayMembersCss = array(0 => "uploadimage", 1 => "custominvoice_items", 2 => "package_items", 3 => "twilio_report");
    if (in_array($pop_type, $arrayMembersCss)){
        $loadMembersCss = true;
    }

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
//echo "aaaa".INCLUDES_DIR;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />

		<?
		include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		?>
        
        <? if (string_strpos($pop_type, "review") !== false || $pop_type == "slideshow" || $pop_type == "deal_redeem" || $pop_type == "uploadimage") { ?>
        
            <script src="<?=DEFAULT_URL?>/scripts/jquery.js" language="javascript" type="text/javascript"></script>
            
        <? }
        
        if ($pop_type == "uploadimage"){ ?>
            
            <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jcrop/js/jquery.Jcrop.js"></script>
            <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/jcrop/css/jquery.Jcrop.css" type="text/css" />
            
        <? }
        
        if (string_strpos($pop_type, "review") !== false) { ?>
        
            <script type="text/javascript" language="javascript">
		
                function setDisplayRatingLevel(level) {
                    for(i = 1; i <= 5; i++) {
                        var starImg = "img_rate_star_off.gif";
                        if( i <= level ) {
                            starImg = "img_rate_star_on.gif";
                        }
                        var imgName = 'star'+i;
                        document.images[imgName].src="<?=DEFAULT_URL?>/images/content/"+starImg;
                    }
                }
                function resetRatingLevel() {
                    setDisplayRatingLevel(document.rate_form.rating.value);
                }
                function setRatingLevel(level) {
                    document.rate_form.rating.value = level;
                }
                $('img[name=star]').bind('click', function(){
                    $(this).fadeOut(50);
                    $(this).fadeIn(50);
                });

                $('document').ready(function() {

                    $('form').submit(function() {

                        <? setting_get("review_manditory", $reviewMandatory);?>
                        var reviewMandatory = "<?=$reviewMandatory?>";
                        var valid_email = new RegExp('^.+@.+\\..+$');
                        var top = 50;
                        var position = 400;

                        $('#JS_errorMessage').empty();
                        $('.errorMessage').css('display', 'none');

                        if ($('#rating').val() == '') {
                            $('#JS_errorMessage').append('<?=str_replace("'", "\\'", system_showText(LANG_MSG_REVIEW_SELECTRATING))?><br />\n');
                            position +=15;
                            top -=1;    
                        }
                        if (reviewMandatory == "on") {
                            if ($('#reviewer_name').val() == '' || $('#reviewer_email').val() == '') {
                                $('#JS_errorMessage').append('<?=str_replace("'", "\\'", system_showText(LANG_MSG_REVIEW_NAMEEMAILREQUIRED))?><br />\n');
                                position +=15;
                                top -=1;
                            } else if ($('#reviewer_email').val().search(valid_email) == -1) {
                                $('#JS_errorMessage').append('<?=str_replace("'", "\\'", system_showText(LANG_MSG_REVIEW_TYPEVALIDEMAIL))?><br />\n');
                            }
                        }
                        if ($('#reviewer_location').val() == '') {
                            $('#JS_errorMessage').append('<?=str_replace("'", "\\'", system_showText(LANG_MSG_REVIEW_CITYSTATEREQUIRED))?><br />\n');
                            position +=15;
                            top -=1;
                        }
                        if ($('#review_title').val() == '' || $('#review').val() == '') {
                            $('#JS_errorMessage').append('<?=str_replace("'", "\\'", system_showText(LANG_MSG_REVIEW_COMMENTREQUIRED))?><br />\n');
                            position +=15;
                            top -=1;
                        }

                        if ($('#JS_errorMessage').text() == "") {
                            $('#JS_errorMessage').css('display', 'none');    
                        } else {
                            $('#JS_errorMessage').css('display', '');
                            $('#TB_ajaxContent').css('height', position);
                            $('#TB_window').css('top', top+'%');
                            return false;
                        }

                        return true;

                    });    

                });

            </script>
        
        <? } elseif ($return_message && (string_strpos($pop_type, "clicktocall") !== false || string_strpos($pop_type, "sendtophone") !== false)) { ?>
			<script language="javascript" type="text/javascript">
				setTimeout(function(){
                    parent.$.fancybox.close();
				}, 6000)
			</script>
		<? } elseif (string_strpos($pop_type, "profile_login") !== false) {
                $aux_modal_box = true;
        ?>
            <script type="text/javascript">

                function changeForm<?=$randomId?>(value) {
                    if (value == "edirectory") {
                        $("#popLEdirectory<?=$randomId?>").addClass('isVisible');
                        $("#popLEdirectory<?=$randomId?>").removeClass('isHidden');

                        $("#popLOpenid<?=$randomId?>").addClass('isHidden');
                        $("#popLOpenid<?=$randomId?>").removeClass('isVisible');

                        $("#popLFacebook<?=$randomId?>").addClass('isHidden');
                        $("#popLFacebook<?=$randomId?>").removeClass('isVisible');

                        $("#popLGoogle<?=$randomId?>").addClass('isHidden');
                        $("#popLGoogle<?=$randomId?>").removeClass('isVisible');
                    } else if (value == "openid") {
                        $("#popLEdirectory<?=$randomId?>").addClass('isHidden');
                        $("#popLEdirectory<?=$randomId?>").removeClass('isVisible');

                        $("#popLOpenid<?=$randomId?>").addClass('isVisible');
                        $("#popLOpenid<?=$randomId?>").removeClass('isHidden');

                        $("#popLFacebook<?=$randomId?>").addClass('isHidden');
                        $("#popLFacebook<?=$randomId?>").removeClass('isVisible');

                        $("#popLGoogle<?=$randomId?>").addClass('isHidden');
                        $("#popLGoogle<?=$randomId?>").removeClass('isVisible');
                    } else if (value == "facebook") {
                        $("#popLEdirectory<?=$randomId?>").addClass('isHidden');
                        $("#popLEdirectory<?=$randomId?>").removeClass('isVisible');

                        $("#popLOpenid<?=$randomId?>").addClass('isHidden');
                        $("#popLOpenid<?=$randomId?>").removeClass('isVisible');

                        $("#popLFacebook<?=$randomId?>").addClass('isVisible');
                        $("#popLFacebook<?=$randomId?>").removeClass('isHidden');

                        $("#popLGoogle<?=$randomId?>").addClass('isHidden');
                        $("#popLGoogle<?=$randomId?>").removeClass('isVisible');
                    } else if (value == "google") {
                        $("#popLEdirectory<?=$randomId?>").addClass('isHidden');
                        $("#popLEdirectory<?=$randomId?>").removeClass('isVisible');

                        $("#popLOpenid<?=$randomId?>").addClass('isHidden');
                        $("#popLOpenid<?=$randomId?>").removeClass('isVisible');

                        $("#popLFacebook<?=$randomId?>").addClass('isHidden');
                        $("#popLFacebook<?=$randomId?>").removeClass('isVisible');

                        $("#popLGoogle<?=$randomId?>").addClass('isVisible');
                        $("#popLGoogle<?=$randomId?>").removeClass('isHidden');
                    }
                }

                function urlRedirect(url) {
                    window.location = url;
                }
            </script>        
            
         <? } elseif ($pop_type == "deal_redeem") { ?>
                    
            <script language="javascript" type="text/javascript">
                function print_page() {
                    $("#bt_print").hide();
                    $("#errorMessage").hide();
                    window.print();
                    window.onfocus = function() { $("#bt_print").show();  $("#errorMessage").show(); }
                }
                
                <? if ($newdealsDone) { ?>
                    parent.updateDeals(<?=$newdealsDone?>);
                <? } ?>
            </script>      
                    
         <? } elseif ($pop_type == "uploadimage") { ?>
            
                <? if ($upload_image == "failed") { ?>
                    <script language="javascript" type="text/javascript">
                        setTimeout(function(){
                             parent.$.fancybox.close();
                        }, 1500);

                    </script>
                <? } else {
                        if (($onlyMainImage) || ($main == "false")){

                            if ($uploadImageUpdate == "y"){?>
                                <script language="javascript" type="text/javascript">
                                    parent.loadGallery(<?=$_POST["item_id"]?>,'y','members','editFe', 'false');
                                    setTimeout(function(){
                                         parent.$.fancybox.close();
                                    }, 1500)
                                </script>
                            <? }elseif ($uploadImageUpdate == "n") {?>
                                <script language="javascript" type="text/javascript">
                                    parent.loadGallery(<?=$_POST["item_id"]?>, 'y', 'members', 'n', 'false');
                                    setTimeout(function(){
                                         parent.$.fancybox.close();
                                    }, 1500)
                                </script>
                            <? }
                        } else {

                            if (($uploadImageUpdate == "y") || ($uploadImageUpdate == "n")){?>
                                <script language="javascript" type="text/javascript">
                                    parent.loadGallery(<?=$_POST["item_id"]?>,'y','members', '', 'true');
                                    setTimeout(function(){
                                         parent.$.fancybox.close();
                                    }, 1500)
                                </script>
                            <? }
                    }
                }?>
          <? } ?>  
        
        <? include(EDIRECTORY_ROOT."/includes/code/ie6pngfix.php"); ?>

	</head>

	<body>
	
		<div class="modal-content <?=$extraStyle?>">
            
            <? if (string_strpos($pop_type, "emailform") !== false) { ?>
		
                <div class="info">

                    <? if ($error) { ?>
                        <p class="errorMessage"><?=$error?></p>
                    <? } ?>

                    <? if ($return_email_message) { ?>

                        <p><?=$return_email_message?></p>

                    <? } else { ?>

                        <h2><?=$obj->getString("title")?></h2>

                        <p><?=$saudation?></p>

                    <? } ?>

                </div>

                <form name="mail" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="form" id="emailForm">

                    <input type="hidden" name="id" value="<?=$id?>" />
                    <input type="hidden" name="receiver" value="<?=$receiver?>" />
                    <input type="hidden" name="pop_type" value="<?=$pop_type?>" />

                    <? if(!$item_error && !$return_email_message) { ?>

                        <div class="left">

                            <? if ($receiver != "owner") { ?>

                            <div>
                                <label for="to">* <?=system_showText(LANG_LABEL_TO)?> <?=system_showText(LANG_LABEL_FRIEND_EMAIL)?></label>
                                <input type="text" name="to" value="<?=$to?>" class="text" />
                            </div>

                            <? } else { ?>
                                <input type="hidden" name="to" value="<?=$to?>" />
                                <div>
                                    <label for="name">* <?=system_showText(LANG_LABEL_NAME);?></label>
                                    <input class="text" type="text" name="name" id="name" value="<?=$name?>" />
                                </div>
                            <? } ?>

                            <div>
                                <label for="from">* <?=($receiver != "owner" ? system_showText(LANG_LABEL_FROM)." (". string_strtolower(LANG_LABEL_YOUREMAIL).")" : system_showText(LANG_LABEL_YOUREMAIL))?></label>
                                <input type="text" name="from" value="<?=$from?>" class="text" />
                            </div>

                            <div>
                                <label for="subject"><?=system_showText(LANG_LABEL_SUBJECT)?></label>
                                <input type="text" name="subject" value="<?=htmlspecialchars_decode($subject)?>" class="text" />
                            </div>

                        </div>

                        <div class="right">

                            <div>
                                <label for="body">* <?=system_showText(LANG_LABEL_ADDITIONALMSG)?></label>
                                <?
                                $body = str_replace("<br />", "", $body);
                                ?>
                                <textarea name="body" rows="6" cols="0" class="textarea"><?=$body?></textarea>
                            </div>

                        </div>

                        <div class="action">

                            <p><?=system_showText(LANG_CAPTCHA_HELP)?></p>
                            <div class="captcha">
                                <div>
                                    <img src="<?=DEFAULT_URL?>/includes/code/captcha.php" border="0" alt="<?=system_showText(LANG_CAPTCHA_ALT)?>" title="<?=system_showText(LANG_CAPTCHA_TITLE)?>" />
                                    <input type="text" value="" name="captchatext" class="text" />
                                </div>
                            </div>
                            <button type="submit" value="Send"><?=system_showText(LANG_BUTTON_SEND)?></button>

                        </div>
                    <? } ?>
                </form>
            
            <? } elseif (string_strpos($pop_type, "review") !== false) { ?>
            
                <div class="info">

                    <h2><?=system_showText(LANG_REVIEWSOF)?> <?=($itemObj->getString("title") ? $itemObj->getString("title") : $itemObj->getString("name") )?></h2>

                    <? if ($message_review) { ?>
                        <? if ($success_review) { ?>
                            <br />
                            <p class="successMessage"><?=$message_review?></p>
                            <?/*
                            <p class="close"><a href="javascript:void(0);" onClick="parent.$.fancybox.close();"><?=system_showText(LANG_CLOSEWINDOW);?></a></p>
                             */?>
                        <? } else { ?>
                            <br />
                            <p class="errorMessage"><?=$message_review?></p>
                        <? } ?>
                    <? } ?>

                    <p class="errorMessage" id="JS_errorMessage" style="display:none">&nbsp;</p>

                    <? 
                    if ($error_message) { ?>
                        <?="<p class=\"errorMessage\">".$error_message."</p>";?>
                    <? 
                    } ?>

                </div>

                <? if (!$success_review) { ?>
                    <form name="rate_form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="form">
                        <input type="hidden" id="item_type" name="item_type" value="<?=$item_type?>" />
                        <input type="hidden" id="item_id" name="item_id" value="<?=$item_id?>" />
                        <input type="hidden" name="pop_type" value="<?=$pop_type?>" />

                        <? 
                        include(INCLUDES_DIR."/forms/form_review.php"); 
                        ?>

                    </form>
                <? } ?>
            
            <? } elseif ($pop_type == "clicktocallpopup") { ?>
            
                <div class="info">
	
					<? if ($error) { ?>
						<p class="errorMessage"><?=$error?></p>
					<? } ?>

					<? if ($return_message) { ?>
						
                        <img src="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME?>/images/iconography/icon-calling.gif" />
						<p><?=$return_message?></p>

					<? } else {

						$auxObj = new $_GET["module"]($_GET["module_id"]); ?>

						<h2><?=$auxObj->getString("title")?></h2>

						<p><?=system_showText(LANG_LISTING_CLICKTOCALL_SAUDATION);?></p>

					<? } ?>

				</div>
				
				<? if (!$return_message){?>
				
					<form name="twilioClickToCall" method="post" class="form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

						<input type="hidden" name="module_id" value="<?=$_GET["module_id"]?>" />
						<input type="hidden" name="module" value="<?=$_GET["module"]?>" />
                        <input type="hidden" name="pop_type" value="<?=$pop_type?>" />
                        
						<div class="left">
							<div>
								<label for="phone">* <?=system_showText(LANG_LABEL_PHONE)?> <span>(000) 000-0000</span></label>
								<input type="text" class="text" name="phone" id="phone" value="<?=$phone?>"  />
								<span class="comment"><?=system_showText(LANG_CLICKTOCALL_TIP6)?></span>
							</div>
						</div>
						<div class="action">
							<button type="submit" value="Send"><?=system_showText(LANG_TWILIO_CALL)?></button>
						</div>
					</form>
				
				<? } ?>
            
            <? } elseif ($pop_type == "sendtophonepopup") { ?>
            
                <div class="info">
	
					<? if ($error) { ?>
						<p class="errorMessage"><?=$error?></p>
					<? } ?>

					<? if ($return_message) { ?>

						<?=$return_message?>

					<? } else {
						$auxObj = new $module($module_id); ?>

						<h2><?=$auxObj->getString("title")?></h2>

						<p><?=system_showText(LANG_LISTING_TOPHONE_SAUDATION);?></p>

					<? } ?>

				</div>
				
				<? if (!$return_message){ ?>
				
					<form name="twilioSMS" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="form">

						<input type="hidden" name="module_id" value="<?=$module_id?>" />
						<input type="hidden" name="module" value="<?=$module?>" />
                        <input type="hidden" name="pop_type" value="<?=$pop_type?>" />
                        
						<div class="left">
							<div>
								<label for="phone">* <?=system_showText(LANG_LABEL_PHONE)?> <span>(000) 000-0000</span></label>
								<input type="text" class="text" name="phone" id="phone" value="<?=$phone?>"  />
								<span class="comment"><?=system_showText(LANG_CLICKTOCALL_TIP7)?></span>
							</div>
						</div>
						<div class="action">
							<button type="submit" value="Send"><?=system_showText(LANG_BUTTON_SEND)?></button>
						</div>
					</form>
				
				<? } 
            
            } elseif ($pop_type == "terms") {

                if ($sitecontent) {
                    echo "<div class=\"content-custom\">".$sitecontent."</div>";
                }
                
            } elseif ($pop_type == "profile_login") { ?>
            
                <h2><?=system_showText(LANG_LABEL_LOGIN);?></h2>
		
                <? if ($foreignaccount_openid || $foreignaccount_google || FACEBOOK_APP_ENABLED == "on") { ?>
                <form class="form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
                    <select id="popLoginType" onChange="changeForm<?=$randomId?>(this.value)" class="select">
                        <option value="edirectory"><?=system_showText(LANG_LOGINDIRECTORYUSER);?></option>
                        <? if ($foreignaccount_openid) { ?>
                        <option value="openid"><?=system_showText(LANG_LOGINOPENIDUSER);?></option>
                        <? } ?>
                        <? if (FACEBOOK_APP_ENABLED == "on" && !$nofacebook) {?>
                        <option value="facebook"><?=system_showText(LANG_LOGINFACEBOOKUSER);?></option>
                        <? } ?>
                        <? if ($foreignaccount_google) { ?>
                        <option value="google"><?=system_showText(LANG_LOGINGOOGLEUSER);?></option>
                        <? } ?>
                    </select>
                </form>
                <? } ?>

                <div id="popLEdirectory<?=$randomId?>" class="isVisible">
                    <form class="form" name="login" target="_parent" method="post" action="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)?><?=$url?>">
                        <? 
                        $members_section = true;
                        include(INCLUDES_DIR."/forms/form_login.php"); ?>

                        <? if(system_checkEmail(SYSTEM_FORGOTTEN_PASS, EDIR_LANGUAGE)) { ?>
                            <p><a href="javascript:void(0);" onClick="urlRedirect('<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/members/forgot.php');" title="<?=system_showText(LANG_LABEL_FORGOTPASSWORD);?>"><?=system_showText(LANG_LABEL_FORGOTPASSWORD);?></a></p>
                        <? } ?>
                    </form>
                </div>

                <? if ($foreignaccount_openid) { ?>
                    <div id="popLOpenid<?=$randomId?>" class="isHidden">
                        <form class="form" name="formOpenID" target="_parent" method="post" action="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)?><?=$url?>">

                            <input type="hidden" name="userform" value="openid" />
                            <? include(INCLUDES_DIR."/forms/form_openidlogin.php"); ?>

                        </form>
                    </div>
                <? } ?>

                <? if (FACEBOOK_APP_ENABLED == "on" && !$nofacebook) {?>
                    <div id="popLFacebook<?=$randomId?>" class="isHidden">
                        <? 
                        $isPopUP = true; 
                        $urlRedirect = "?destiny=".urlencode($_SERVER["HTTP_REFERER"]);
                        ?>
                        <? include(INCLUDES_DIR."/forms/form_facebooklogin.php"); ?>
                    </div>
                <? } ?>

                <? if ($foreignaccount_google) { ?>
                    <div id="popLGoogle<?=$randomId?>" class="isHidden">
                        <? $urlRedirect = "&destiny=".urlencode($_SERVER["HTTP_REFERER"]); ?>
                        <? include(INCLUDES_DIR."/forms/form_googlelogin.php"); ?>
                    </div>
                <? } ?>
            
            <? } elseif ($pop_type == "slideshow") { ?>
                
                <div class="info">
			
                    <h2><?=$galleryObj->getString('title')?></h2>

                </div>

                <input type="hidden" id="slideMode" value="0" />

                <div class="slideshow">

                    <ul>
                        <?
                        $array_img = explode(", ", $image_list);
                        $array_imgCaption = explode("{}", $image_caption_list);
                        for ( $i=0;$i<count($array_img);$i++ ) {
                            $img_loc = string_strpos($array_img[$i], "photo_");
                            $img_part = string_substr($array_img[$i], $img_loc);
                            $img_name = string_substr($img_part, 0, string_strlen($img_part)-1);
                            ?>
                            <li id="img<?=$i?>" class="isHidden">
                                <img src="<?=$array_img[$i]?>" alt="<?=$array_imgCaption[$i]?>"/>
                                <span class="caption">
                                    <?=$array_imgCaption[$i]?>
                                </span>
                            </li>
                            <?
                        }
                        ?>
                    </ul>

                    <? if ($totalImages > 1) { ?>
                        <p class="control">
                            <span class="left" id="nav"></span>
                            <span class="right" id="slide"></span>
                        </p>
                    <? } ?>

                </div>
                
             <? } elseif ($pop_type == "deal_redeem") { ?>
                
                <div class="deal">
                    <?
                    if ($promotion && !$promotionMsg && $errorNumber != 2){

                        //Listing info
                        $listingtemplate_address = "";
                        if ($listing->getString("address")) {
                            $listingtemplate_address = nl2br($listing->getString("address", true));
                        }

                        $listingtemplate_address2 = "";
                        if ($listing->getString("address2")) {
                            $listingtemplate_address2 = nl2br($listing->getString("address2", true));
                        }

                        $listingtemplate_phone = "";
                        if ($listing->getString("phone")) {
                            $listingtemplate_phone  = $listing->getString("phone", true);
                        }

                        $listingtemplate_email = "";
                        if (htmlspecialchars($listing->getString("email"))) {
                            $listingtemplate_email = $listing->getString("email");
                        }

                        $listingtemplate_url = "";
                        if (htmlspecialchars($listing->getString("url"))) {
                            $display_url = htmlspecialchars($listing->getString("url"));
                            if (htmlspecialchars($listing->getString("display_url"))) {
                                $display_url = htmlspecialchars($listing->getString("display_url"));
                            }
                            $listingtemplate_url = $display_url;

                        }

                        $listingtemplate_location = "";
                        $locationsToshow = system_retrieveLocationsToShow();
                        $locationsParam = $locationsToshow." z";
                        $listingtemplate_location = $listing->getLocationString($locationsParam, true);

                        if ($promotion->getNumber("realvalue") > 0){
                            $offer = round(100-(($promotion->getNumber("dealvalue")*100)/$promotion->getNumber("realvalue"))).'%';
                        }else{
                            $offer = system_showText(LANG_NA);
                        }
                        $promotionInfo = $promotion->getDealInfo(sess_getAccountIdFromSession());
                        $contact = new Contact(sess_getAccountIdFromSession());

                        customtext_get("promotion_default_conditions", $promotion_default_conditions, EDIR_LANGUAGE);

                        if ($errorNumber){?>
                        <p id="errorMessage" class="<?=$errorNumber == 1 ? "informationMessage" : "errorMessage"?>"><?=$errorNumber == 1 ? system_showText(DEAL_REDEEM_DONEALREADY) : system_showText(DEAL_REDEEMINFO_2)?></p>
                        <? } ?>


                        <h1><?=$errorNumber ? $redeemCheck : $redeem_code;?></h1>
                        <h2><?=$promotion->getString("name");?></h2>
                        <p>&nbsp;</p>
                        <p><strong><?=system_showText(LANG_LABEL_NAME)?></strong>: <?=$contact->getString("first_name")." ".$contact->getString("last_name")?></p>
                        <p><strong><?=system_showText(LANG_DEAL_REMEEDED_AT)?></strong>: <?=format_date($promotionInfo["account"]["datetime"], DEFAULT_DATE_FORMAT, "date")?> - <?=format_date($promotionInfo["account"]["datetime"], "H:i", "datetime")?></p>
                        <p><strong><?=system_showText(DEAL_VALIDUNTIL)?></strong>: <?=$promotion->getDate("end_date");?></p>
                        <p>&nbsp;</p>
                        <p><strong><?=system_showText(DEAL_ORIGINALVALUE)?></strong>: <?=CURRENCY_SYMBOL.format_money($promotion->getNumber("realvalue"),2)?></p>
                        <p><strong><?=system_showText(DEAL_AMOUNTPAID)?></strong>: <?=CURRENCY_SYMBOL.format_money($promotion->getNumber("dealvalue"),2)?></p>
                        <p>&nbsp;</p>
                        <p><strong><?=system_showText(LANG_LISTING_FEATURE_NAME)?>: </strong><?=$listing->getString("title")?></p>
                        <? if ($listingtemplate_phone) { ?>
                        <p><strong><?=system_showText(ucfirst(LANG_LISTING_LETTERPHONE))?>: </strong><?=$listingtemplate_phone?></p>
                        <? } ?>
                        <? if ($listingtemplate_email) { ?>
                        <p><strong><?=system_showText(ucfirst(LANG_LISTING_LETTEREMAIL))?>: </strong><?=$listingtemplate_email?></p>
                        <? } ?>
                        <? if ($listingtemplate_url) { ?>
                        <p><strong><?=system_showText(ucfirst(LANG_LISTING_LETTERWEBSITE))?>: </strong><?=$listingtemplate_url?></p>
                        <? } ?>
                        <? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) { ?>
                        <p><strong><?=system_showText(LANG_LABEL_ADDRESS)?>: </strong>
                            <? if ($listingtemplate_address) { ?>
                                <span><?=$listingtemplate_address.($listingtemplate_address2 || $listingtemplate_location ? ", " : "" )?></span>
                            <? } ?>
                            <? if ($listingtemplate_address2) { ?>
                                <span><?=$listingtemplate_address2.($listingtemplate_location ? ", " : "")?></span>
                            <? } ?>
                            <? if ($listingtemplate_location) { ?>
                                <span><?=$listingtemplate_location?></span>
                            <? } ?>
                        </p>
                        <? } ?>
                        <p>&nbsp;</p>
                        <?	$langIndex = language_getIndex(EDIR_LANGUAGE); 
                            if ($promotion->getString("conditions$langIndex")) { ?>
                            <div class="terms">
                                <p><?=nl2br($promotion->getString("conditions$langIndex"));?></p>
                            </div>
                        <? } ?>
                        <p>&nbsp;</p>
                        <button href="javascript:void(0);" onclick="javascript:print_page();"><?=system_showText(LANG_LABEL_PRINT);?></button>

                    <? } else { ?>
                        <p class="<?=$errorNumber == 2 ? "errorMessage" : "informationMessage"?>"><?=$errorNumber == 2 ? system_showText(DEAL_REDEEMINFO_2): $promotionMsg;?></p>
                    <?  }?>

                    </div>
                
             <? } elseif ($pop_type == "uploadimage") { ?>
                
                    <h2><?=($captions == "y"? system_showText(LANG_LABEL_EDIT_CAPTIONS) : system_showText(LANG_LABEL_ADDIMAGE))?></h2>
	
                    <?
                    $sql = "SELECT COUNT(*) FROM Gallery_Temp WHERE image_default = 'n' AND sess_id = '".$gallery_hash."'";
                    $dbMain = db_getDBObject(DEFAULT_DB, true);
                    $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                    $r = $dbObj->query($sql);
                    while ($row_aux = mysql_fetch_array($r)) {
                        $cont_temp = $row_aux[0];
                    }
                    if ($galleryid){
                        $gallery = new Gallery($galleryid);
                        $cont_gal = count($gallery->image);
                    }

                    if ($photos && $photos >= 0 && ($cont_temp + $cont_gal) >= $photos){
                        $return_upload_message .= "<p class=\"errorMessage\">".LANG_YOU_CAN_ADD_MAXOF.$photos.LANG_TO_YOUR_GALLERY."</p>";
                    }

                    if ($return_upload_message) {
                        echo $return_upload_message;
                    } else {
                        ?>
                        <form id="uploadimage" name="uploadimage" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="frmEmail" enctype="multipart/form-data" >

                            <input type="hidden" name="pop_type" value="<?=$pop_type?>" />
                            <input type="hidden" name="item_type" value="<?=$item_type?>" />
                            <input type="hidden" name="main" value="<?=$main?>" />
                            <input type="hidden" name="level" value="<?=$level?>" />
                            <input type="hidden" name="temp" value="<?=$temp?>" />
                            <input type="hidden" name="gallery_item_id" id="gallery_item_id" value="<?=$gallery_item_id?>" />
                            <input type="hidden" name="gallery_id" id="gallery_id" value="<?=$gallery_id?>" />
                            <input type="hidden" name="image_id" id="image_id" value="<?=$image_id?>" />
                            <input type="hidden" name="thumb_id" id="thumb_id" value="<?=$thumb_id?>" />
                            <input type="hidden" name="item_id" id="item_id" value="<?=$item_id?>" />
                            <input type="hidden" name="captions" id="captions" value="<?=$captions?>" />
                            <input type="hidden" name="x1" value="0" id="x1" />
                            <input type="hidden" name="y1" value="0" id="y1" />
                            <input type="hidden" name="x2" value="<?=$thumbWidthItem?>" id="x2" />
                            <input type="hidden" name="y2" value="<?=$thumbHeidhtItem?>" id="y2" />
                            <input type="hidden" name="w" value="<?=$thumbWidthItem?>" id="w" />
                            <input type="hidden" name="h" value="<?=$thumbHeightItem?>" id="h" />
                            <input type="hidden" name="gallery_hash" value="<?=$gallery_hash?>" />
                            <input type="hidden" name="domain_id" value="<?=SELECTED_DOMAIN_ID?>" />

                            <? include(INCLUDES_DIR."/forms/form_uploadimage.php"); ?>
                        </form>
                    <? } ?>
                
             <? } elseif ($pop_type == "custominvoice_items") { ?>
                    
                    <div class="customInvoice">
	
                        <? if($customInvoiceItems){ ?>

                            <h2><?=system_showText(LANG_LABEL_CUSTOM_INVOICE_TITLE)?>: <?=$customInvoice->getString("title");?></h2>

                            <h3><?=system_showText(LANG_LABEL_CUSTOM_INVOICE_ITEMS)?></h3>

                            <table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
                                <tr>
                                    <th><?=system_showText(LANG_LABEL_DESCRIPTION)?></th>
                                    <th style="width: 70px;"><?=system_showText(LANG_LABEL_PRICE)?></th>
                                </tr>
                                <? if (!$view || $view != "payment_log") { ?>
                                    <? foreach($customInvoiceItems as $each_custominvoice_item) { ?>
                                        <tr>
                                            <td><?=$each_custominvoice_item["description"]?></td>
                                            <td><?=CURRENCY_SYMBOL." ".format_money($each_custominvoice_item["price"])?></td>
                                        </tr>
                                    <? }?>
                                <? } else { ?>
                                        <?
                                        if ($customInvoicePaymentItems && $customInvoicePaymentPrices) {
                                            foreach ($customInvoicePaymentItems as $key => $each_item) {
                                            ?>
                                                <tr>
                                                    <td><?=$each_item?></td>
                                                    <td><?=CURRENCY_SYMBOL." ".format_money($customInvoicePaymentPrices[$key])?></td>
                                                </tr>
                                            <?
                                            }
                                        }
                                        ?>
                                <? } ?>
                            </table>

                        <? } else { ?>
                                <p class="informationMessage"><?=system_showText(LANG_MSG_NO_ITEMS_FOUND)?></p>
                        <? } ?>

                    </div>
                    
             <? } elseif ($pop_type == "package_items") { ?>
             
                    <div class="customInvoice">

                        <? if($packageItems){ ?>

                            <h2><?=string_ucwords(system_showText(LANG_PACKAGE_SING))?> <?=system_showText(LANG_LABEL_TITLE)?>: <?=$package->getString("title");?></h2>

                            <h3><?=string_ucwords(system_showText(LANG_PACKAGE_SING))?> <?=system_showText(LANG_LABEL_ITEMS)?></h3>

                            <table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
                                <tr>
                                    <th><?=system_showText(LANG_LABEL_DESCRIPTION)?></th>
                                    <th style="width: 70px;"><?=system_showText(LANG_LABEL_PRICE)?></th>
                                </tr>
                                <?
                                if ($packagePaymentItems && $packagePaymentPrices) {
                                    foreach ($packagePaymentItems as $key => $each_item) {
                                    ?>
                                        <tr>
                                            <td><?=$each_item?></td>
                                            <? if ($key != 0) { ?>
                                            <td><?=$str_price?></td>
                                            <? } else { ?>
                                            <td>&nbsp;</td>
                                            <? } ?>
                                        </tr>
                                    <?
                                    }
                                }
                                ?>
                            </table>

                        <? } else { ?>
                                <p class="informationMessage"><?=system_showText(LANG_MSG_NO_ITEMS_FOUND)?></p>
                        <? } ?>

                        </div>
             
             <? }elseif ($pop_type == "twilio_report") { ?>
                 
                   <h2>
                        <?=system_showText(LANG_LISTING_FEATURE_NAME)?> - <?=system_showText(LANG_CLICKTOCALL_REPORT)?> - <?=$listing->getString("title", true, 35);?>
                    </h2>
                    <?
                    include(INCLUDES_DIR."/tables/table_twilio_report.php");			
                    ?>
                    
             <? } ?>
			
		</div>
        
        <? if ($pop_type == "profile_login") { ?>
        
            <? if (SOCIALNETWORK_FEATURE == "on") { ?>
                <div class="button button-profile">
                    <h2><a href="javascript:void(0);" onClick="urlRedirect('<?=SOCIALNETWORK_URL?>/add.php');"><?=system_showText(LANG_JOIN_PROFILE);?></a></h2>			
                </div>
            <? } else { ?>
                <div class="button button-profile">
                    <h2><a href="javascript:void(0);" onClick="urlRedirect('<?=DEFAULT_URL?>/advertise.php');"><?=system_showText(LANG_MENU_ADVERTISE);?></a></h2>	
                </div>
            <? } ?>

            <? if ($_GET["auto"]) { ?>
                <p class="close"><a href="javascript:void(0);" onClick="urlRedirect('<?=DEFAULT_URL.$ItemPath?>');"><?=system_showText(LANG_CLOSEWINDOW);?></a></p>
            <? } ?>
            
         <? } ?>
            
         <? if ($pop_type == "slideshow") { ?>
            
            <script type="text/javascript" language="javascript">
                var qtdImage = '<?=count($array_img)?>';
                qtdImage--;
                $('#slide').html('<?=system_showText(LANG_SLIDESHOW)?>:&nbsp;<a href="javascript:void(0);" onclick="javascript:slideOn(\'0\', \'' + qtdImage + '\');"><span></span></a>');
                $('span', $('#slide')).css('color', 'red').text('<?=system_showText(LANG_SLIDESHOW_OFF)?>');
                $('#nav').html('<span id="prev">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE)?></span> | <a href="javascript:void(0);" onclick="javascript:next(\'0\', \'' + qtdImage + '\');" id="next"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE)?> &raquo;</a>')

                function slideOn(img, max){
                    $('#slideMode').val(1);
                    $('#slide').html('<?=system_showText(LANG_SLIDESHOW)?>:&nbsp;<a href="javascript:void(0);" onclick="javascript:slideOff(\'' + img + '\', \'' + qtdImage + '\');"><span></span></a>');
                    $('span', $('#slide')).css('color', 'green').text('<?=system_showText(LANG_SLIDESHOW_ON)?>');
                    $('#nav').html('<span id="prev">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE)?></span> | <span id="next"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE)?> &raquo;</span>')
                    if (max >= 1) {
                        slideTransition(img, max);
                    }
                }

                function slideOff(img, max){
                    $('#slide').html('<?=system_showText(LANG_SLIDESHOW)?>:&nbsp;<a href="javascript:void(0);" onclick="javascript:slideOn(\'' + img + '\', \'' + qtdImage + '\');"><span></span></a>');
                    $('span', $('#slide')).css('color', 'red').text('<?=system_showText(LANG_SLIDESHOW_OFF)?>');
                    $('#slideMode').val(0);
                    if (max < 1) {
                        $('#nav').html('<span id="prev">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE)?></span> | <span id="next"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE)?> &raquo;</span>')
                    } else {
                        if (img == max) {
                            $('#nav').html('<a href="javascript:void(0);" onclick="javascript:prev(\'' + img + '\', \'' + qtdImage + '\');" id="prev">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE)?></a> | <span id="next"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE)?> &raquo;</span>');
                        } else if (img == 0) {
                            $('#nav').html('<span id="prev">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE)?></span> | <a href="javascript:void(0);" onclick="javascript:next(\'' + img + '\', \'' + qtdImage + '\');" id="next"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE)?> &raquo;</a>');
                        } else {
                            $('#nav').html('<a href="javascript:void(0);" onclick="javascript:prev(\'' + img + '\', \'' + qtdImage + '\');" id="prev">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE)?></a> | <a href="javascript:void(0);" onclick="javascript:next(\'' + img + '\', \'' + qtdImage + '\');" id="next"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE)?> &raquo;</a>');
                        }
                    }
                }

                function slideTransition(img, max){
                    setTimeout(function(){
                        if (($('#slideMode').val()) == 1) {
                            if (img < max){
                                var img2 = (parseInt(img) + 1);
                                $('#slide').html('<?=system_showText(LANG_SLIDESHOW)?>:&nbsp;<a href="javascript:void(0);" onclick="javascript:slideOff(\'' + img2 + '\', \'' + qtdImage + '\');"><span></span></a>');
                                $('span', $('#slide')).css('color', 'green').text('<?=system_showText(LANG_SLIDESHOW_ON)?>');
                                $('#img' + img).fadeTo('fast', 0);
                                $('#img' + img).attr('class', 'isHidden');
                                $('#img' + img2).css('opacity', '0');
                                $('#img' + img2).attr('class', '');
                                $('#img' + img2).fadeTo('fast', 1);
                                slideTransition(img2, max);
                            } else {
                                $('#slide').html('<?=system_showText(LANG_SLIDESHOW)?>:&nbsp;<a href="javascript:void(0);" onclick="javascript:slideOff(\'0\', \'' + qtdImage + '\');"><span></span></a>');
                                $('span', $('#slide')).css('color', 'green').text('<?=system_showText(LANG_SLIDESHOW_ON)?>');
                                $('#img' + max).fadeTo('fast', 0);
                                $('#img' + max).attr('class', 'isHidden');
                                $('#img0').css('opacity', '0');
                                $('#img0').attr('class', '');
                                $('#img0').fadeTo('fast', 1);

                                slideTransition(0, max);
                            }
                        }
                    }, 2000);
                }

                function prev(img, max){
                    $('#img' + img).fadeTo('fast', 0);
                    $('#img' + img).attr('class', 'isHidden');
                    $('#img' + (parseInt(img) - 1)).css('opacity', '0');
                    $('#img' + (parseInt(img) - 1)).attr('class', '');
                    $('#img' + (parseInt(img) - 1)).fadeTo('fast', 1);
                    if (max < 1) {
                        $('#nav').html('<span id="prev">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE)?></span> | <span id="next"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE)?> &raquo;</span>');
                    } else {
                        if ((parseInt(img) - 1) > 0){
                            $('#nav').html('<a href="javascript:void(0);" onclick="javascript:prev(\'' + (parseInt(img) - 1) + '\', \'' + qtdImage + '\');" id="prev">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE)?></a> | <a href="javascript:void(0);" onclick="javascript:next(\'' + (parseInt(img) - 1) + '\', \'' + qtdImage + '\');" id="next"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE)?> &raquo;</a>');
                        } else {
                            $('#nav').html('<span id="prev">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE)?></span> | <a href="javascript:void(0);" onclick="javascript:next(\'' + (parseInt(img) - 1) + '\', \'' + qtdImage + '\');" id="next"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE)?> &raquo;</a>');
                        }
                    }
                    $('#slide').html('<?=system_showText(LANG_SLIDESHOW)?>:&nbsp;<a href="javascript:void(0);" onclick="javascript:slideOn(\'' + (parseInt(img) - 1) + '\', \'' + qtdImage + '\');"><span></span></a>');
                    $('span', $('#slide')).css('color', 'red').text('<?=system_showText(LANG_SLIDESHOW_OFF)?>');
                }

                function next(img, max){
                    $('#img' + img).fadeTo('fast', 0);
                    $('#img' + img).attr('class', 'isHidden');
                    $('#img' + (parseInt(img) + 1)).css('opacity', '0');
                    $('#img' + (parseInt(img) + 1)).attr('class', '');
                    $('#img' + (parseInt(img) + 1)).fadeTo('fast', 1);
                    if (max < 1) {
                        $('#nav').html('<span id="prev">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE)?></span> | <span id="next"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE)?> &raquo;</span>');
                    } else {
                        if ((parseInt(img) + 1) < max){
                            if (img < 0) {
                                $('#nav').html('<span id="prev">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE)?></span> | <a href="javascript:void(0);" onclick="javascript:next(\'' + (parseInt(img) + 1) + '\', \'' + qtdImage + '\');" id="next"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE)?> &raquo;</a>');
                            } else {
                                $('#nav').html('<a href="javascript:void(0);" onclick="javascript:prev(\'' + (parseInt(img) + 1) + '\', \'' + qtdImage + '\');" id="prev">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE)?></a> | <a href="javascript:void(0);" onclick="javascript:next(\'' + (parseInt(img) + 1) + '\', \'' + qtdImage + '\');" id="next"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE)?> &raquo;</a>');
                            }
                        } else {
                            $('#nav').html('<a href="javascript:void(0);" onclick="javascript:prev(\'' + (parseInt(img) + 1) + '\', \'' + qtdImage + '\');" id="prev">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE)?></a> | <span id="next"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE)?> &raquo;</span>');
                        }
                    }
                    $('#slide').html('<?=system_showText(LANG_SLIDESHOW)?>:&nbsp;<a href="javascript:void(0);" onclick="javascript:slideOn(\'' + (parseInt(img) + 1) + '\', \'' + qtdImage + '\');"><span></span></a>');
                    $('span', $('#slide')).css('color', 'red').text('<?=system_showText(LANG_SLIDESHOW_OFF)?>');
                }

                $(document).ready(function() {
                    next('<?=($firstImage - 1)?>', '<?=($totalImages -1)?>');
                    slideOn('<?=($firstImage)?>',qtdImage);
                 });
            </script>
            
         <? } ?>   

	</body>
</html>