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
	# * FILE: /inclues/forms/form_profile.php
	# ----------------------------------------------------------------------------------------------------

	Facebook::getFBInstance($facebook);

	if ($accountObj->getString("is_sponsor") == "y" || SOCIALNETWORK_FEATURE == "off") {
		$statusRedirect = "&action=check_session&type=change_account&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/account/account.php?changeAcc");
		$urlRedirect = "?attach_account=true&is_sponsor=y&edir_account=".sess_getAccountIdFromSession()."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/account/account.php?facebookattached");
	}else {
		$statusRedirect = "&action=check_session&type=change_account&destiny=".urlencode(DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/edit.php?changeAcc");
		$urlRedirect = "?attach_account=true&is_sponsor=n&edir_account=".sess_getAccountIdFromSession()."&destiny=".urlencode(DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/edit.php?facebookattached");
	}
	
	$changeFBAccLink = $facebook->getLoginStatusUrl(
		array (
			"ok_session"	=> FACEBOOK_REDIRECT_URI."?fb_session=ok".$statusRedirect, 
			"no_session"	=> FACEBOOK_REDIRECT_URI."?fb_session=no_session".$statusRedirect, 
			"no_user"		=> FACEBOOK_REDIRECT_URI."?fb_session=no_user".$statusRedirect
		)
	);
	
	if (isset($_GET["changeAcc"])) {
		$changeAccStyle =  ""; 
	} else {
		$changeAccStyle = "style=\"display: none;\"";
	}
?>

<script type="text/javascript">
	//<![CDATA[
	function getFacebookImage() {
		$('#image_fb').html("<img src=\"" + DEFAULT_URL + "/images/img_loading.gif\" alt=\"\" />");
		$.get(DEFAULT_URL + "/members/account/facebookimage.php", {
			id: '<?=sess_getAccountIdFromSession();?>'
		}, function(newImage) {
			var eURL = /http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w- ./?%&=]*)?/
			var arrInfo = newImage.split("[FBIMG]");
			var imgSize = "";
			if (arrInfo[0] && eURL.exec(arrInfo[0])) {
				$('#facebook_image').val(arrInfo[0]);
				if (arrInfo[1] && arrInfo[2]) {
					var w = parseInt(arrInfo[1]);
					var h = parseInt(arrInfo[2]);
					$('#facebook_image_height').val(h);
					$('#facebook_image_width').val(w);
					
					imgSize = " width=\"" + w + "\" ";
					imgSize += " height=\"" + h + "\" ";
				} else {
					$('#facebook_image_height').val("100");
					$('#facebook_image_widht').val("100");
					imgSize = " width=\"100\" ";
					imgSize += " height=\"100\" ";
				}
				$('#image_fb').html("<img src=\"" + arrInfo[0] + "\" " + imgSize + " alt=\"\" />");
				if ($('#message').text() == "<?=system_showText(LANG_MSGERROR_ERRORUPLOADINGIMAGE);?>") {
					$('#message').removeClass("errorMessage");
					$('#message').text('');
				}
			} else if (!eURL.exec(arrInfo[0])) {
				$('#facebook_image').val("");
				$('#image_fb').html("<img src=\"<?=DEFAULT_URL;?>/images/profile_noimage.gif\" width=\"100\" height=\"100\" alt=\"No Image\" />");
				$('#message').removeClass("successMessage");
				$('#message').removeClass("informationMessage");
				$('#message').addClass("errorMessage");
				$('#message').text("<?=system_showText(LANG_MSGERROR_ERRORUPLOADINGIMAGE);?>");
			}
		});
	}

	function profileStatus(check_id, type) {
		var check = $('#' + check_id).attr('checked');
		if (type == 'link') {
			if (check) {
				$('#' + check_id).attr('checked', '');
			} else {
				$('#' + check_id).attr('checked', 'checked');
			}
		}
		check = $('#' + check_id).attr('checked');

		$.post(DEFAULT_URL + "/includes/code/profile.php", {
			has_profile: check,
			account_id: '<?=sess_getAccountIdFromSession();?>',
			ajax: true
		});
		if (check) {
			$('#personal_page').css('display', '');
			$('#tr_display_contact').css('display', '');
			$('#btnSubmit').css('display', '');
			$('#btnCancel').css('display', '');
		} else {
			$('#personal_page').css('display', 'none');
			$('#tr_display_contact').css('display', 'none');
			$('#btnSubmit').css('display', 'none');
			$('#btnCancel').css('display', 'none');
		}
	}
	//]]>
</script>

<?if($_GET["error"] == "disableAttach"){ ?>
	<p class="errorMessage"><?=system_showText(LANG_FB_ALREADY_LINKED)?></p>
<? } ?>

<?if (isset($_GET["facebookerror"])){ ?>
	<p class="errorMessage"><?=system_showText(LANG_MSG_ERROR_NUMBER)." 10001. ".system_showText(LANG_MSG_TRY_AGAIN);?></p>
<? } ?>

<? $validate_demodirectoryDotCom = true; ?>
<? if (DEMO_LIVE_MODE) {
	$validate_demodirectoryDotCom = validate_demodirectoryDotCom($username, $message_demoDotCom);
}
if ($validate_demodirectoryDotCom) { ?>
	<table border="0" cellpadding="2" cellspacing="0" class="standard-table noMargin">
		<tr>
			<? if ($is_sponsor == 'y') { ?>
				<th class="standard-tabletitle" style="width: 10px;">
					<input type="checkbox" id="has_profile" style="margin-right: 10px;" name="has_profile" <?=($has_profile == "y") ? "checked=\"checked\"": "" ?> class="inputCheck" onclick="profileStatus(this.id);"/>
				</th>
				<th class="standard-tabletitle">
					<a href="javascript:void(0);" onclick="profileStatus('has_profile', 'link');" ><?=system_showText(LANG_LABEL_CREATE_PERSONAL_PAGE);?></a>
				</th>
			<? } else { ?>
				<th class="standard-tabletitle">
					<?=system_showText(LANG_MSG_MY_PERSONAL_PAGE);?>
				</th>
			<? } ?>
		</tr>
	</table>
<? } ?>

<?
	$domain = new Domain(SELECTED_DOMAIN_ID);
	$domain_url = (HTTPS_MODE == "on" ? "https://" : "http://").$domain->getString("url").EDIRECTORY_FOLDER."/".SOCIALNETWORK_FEATURE_NAME;
?>

	<table id="personal_page" border="0" cellpadding="2" cellspacing="0" class="standard-table" style="<?=($has_profile == "y") ? "": "display: none;" ?>">
		<tr>
			<th colspan="2" class="widthAuto" style="text-align: left;">
				<strong><?=system_showText(LANG_LABEL_FOR_EXAMPLE);?>:</strong>
				<br />
				<?=system_showText(LANG_MSG_FRIENDLY_URL_PROFILE_TIP);?>
				<br />
				"<?=$domain_url;?>/john-smith.html"
			</th>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<strong>* <?=system_showText(LANG_LABEL_YOUR_URL);?></strong> &nbsp;<?=$domain_url;?>/<input type="text" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" style="width: 100px;"/>.html
			</td>
		</tr>
	</table>

	<? if ($twitterSupport) {?>

		<input type="hidden" name="tw_oauth_token" value="<?=$tw_oauth_token?>"/>
		<input type="hidden" name="tw_oauth_token_secret" value="<?=$tw_oauth_token_secret?>"/>
		<input type="hidden" name="tw_screen_name" value="<?=$tw_screen_name?>"/>
	<?
	}
	?>

	<?
	include(EDIRECTORY_ROOT."/includes/code/thumbnail.php");
	?>

	<table id="socialNetworking" border="0" cellpadding="2" cellspacing="0" class="standard-table" style="<?=($has_profile == "y") ? "": "display: none;" ?>">
		<?if (($twitterSupport) || (FACEBOOK_APP_ENABLED == "on") && $accountObj->getString("username") != $accountObj->getString("facebook_username")){?>
		<tr>
			<th colspan="2" class="standard-tabletitle" style="text-align: left;">
				<?=system_showText(LANG_LABEL_FOREIGN_ACCOUNTS);?>
			</th>
		</tr>

		<? if ($accountObj->getString("username") != $accountObj->getString("facebook_username")){?>

		<? if (FACEBOOK_APP_ENABLED == "on"){  ?>
		<tr>
			<th>Facebook:</th>
			<td>
				<?
				if ($profileObj && $profileObj->facebook_uid!='') {
				?>
					<strong><?=$accountObj->getString("facebook_firstname")?> <?=$accountObj->getString("facebook_lastname")?></strong>
					<br/><a href="<?=DEFAULT_URL?>/profile/edit.php?signoffFacebook"><?=system_showText(LANG_LABEL_UNLINK_FB);?></a> | <a href="<?=$changeFBAccLink;?>"><?=LANG_LABEL_CHANGE_ACCOUNT?></a>
					<? if (isset($_GET["facebookattached"])){?>
						   <br/> <p class="successMessage"><?=system_showText(LANG_LABEL_FB_SIGNFB_CONN);?></p>
					<? } ?>
				<?} else {?>
						<a href="javascript:void(0);" id="open_facebook_form_connection" ><?=system_showText(LANG_LABEL_LINK_FACEBOOK);?></a>
					<? if ($facebookMessage){?>
						   <br/> <p class="successMessage"><?=$facebookMessage?></p>
						<? } ?>
				<? } ?>
			</td>
		</tr>
		
		<tr id="option_fb_1" <?=$changeAccStyle;?>>
			<th>
				<input type="radio" name="join_facebook_option" id="join_facebook_option_import" value="facebook_import" checked="checked" onclick="setFBCookie('facebook_import')" />
			</th>
			<td>
				<?=system_showText(LANG_LABEL_CONNECT_WITH_FB_AND_IMPORT)?>
			</td>
		</tr>

		<tr id="option_fb_2" <?=$changeAccStyle;?>>
			<th>
				<input type="radio" name="join_facebook_option" id="join_facebook_option_link" value="facebook_connect" onclick="setFBCookie('facebook_link')" />
			</th>
			<td>
				<?=system_showText(LANG_LABEL_CONNECT_WITH_FB)?>
			</td>
		</tr>
	
		<tr id="option_fb_3" <?=$changeAccStyle;?>>
			<th>&nbsp;</th>
			<td colspan="2">
				<div id="lFacebook">
					<? include(INCLUDES_DIR."/forms/form_facebooklogin.php"); ?>
				</div>
				<div id="loadingFB" style="display:none">
					<img src="<?=DEFAULT_URL?>/images/img_loading.gif" border="0" alt="" />
				</div>
			</td>
		</tr>
		<?}}?>

		<? if ($twitterSupport) {

			if (!isset($twitterInfo)){

				if (!isset($EpiTwitter))
					$EpiTwitter = new EpiTwitter($foreignaccount_twitter_apikey, $foreignaccount_twitter_apisecret);
			?>
				<tr>
					<th>Twitter:</th>
					<td>
						<a href="<?=$EpiTwitter->getAuthorizationUrl()?>"><?=system_showText(LANG_LABEL_TW_LINK)?></a>
						<? if ($twitterMessage){?>
						   <br/> <p class="<?=$_GET["signofftwitter"] == "success"? "successMessage": "errorMessage"?>"><?=$twitterMessage?></p>
						<? } ?>
						  <p class="informationMessage">
							<?=system_showText(LANG_PROFILE_TWITTER_TIP1);?>
						</p>
					</td>
				</tr>

			<? } else { ?>

				<tr>
					<th>Twitter:</th>
					<td>
						<strong><?=$tw_screen_name?></strong>
						<br/><a href="<?=DEFAULT_URL?>/twitter.php?signoffTwitter"><?=system_showText(LANG_LABEL_UNLINK_TW)?></a>
						<? if ($twitterMessage){?>
						   <br/> <p class="<?=$_GET["twitter"] == "success"? "successMessage": "errorMessage"?>"><?=$twitterMessage?></p>
						<? } ?>
					</td>
				</tr>
				<tr>
					<th>&nbsp;</th>
					<td>
						<input type="checkbox" id="tw_post" name="tw_post" value="1" <?=$twpost_checked?> style="width:auto" />&nbsp;<?=system_showText(LANG_LABEL_POSTRED)?><br/>
					</td>
				</tr>
			<? }
			}

		}?>

		<tr>
			<th colspan="2" class="standard-tabletitle" style="text-align: left;">
				<?=system_showText(LANG_LABEL_PROFILE_INFORMATION);?>
			</th>
		</tr>

		<tr>

		<?
		if(!$facebook_image) {
			if ($image_id) {
				$imageObj = new Image($image_id, true);
				if ($imageObj->imageExists()) {
					echo "<th id=\"image_fb\" class=\"imageSpace\" style=\"text-align: center; width: 150px;\">";
					echo $imageObj->getTag(true, PROFILE_IMAGE_WIDTH, PROFILE_IMAGE_HEIGHT);
					echo "</th>";
				} else {
					echo "<th id=\"image_fb\" class=\"imageSpace user-info\" style=\"text-align: center; width: 150px;\">";
					echo "<div class=\"image\"><span class=\"no-image no-link\"></span></div>";
					echo "</th>";
				}
			} else {
				echo "<th id=\"image_fb\" class=\"imageSpace user-info\" style=\"text-align: center; width: 150px;\">";
				echo "<div class=\"image\"><span class=\"no-image no-link\"></span></div>";
				echo "</th>";
			}
		} else { ?>
			<? if ($facebook_image) { ?>
				<th id="image_fb" class="imageSpace" style="text-align: center;width: 150px;">
					<img src="<?=$facebook_image;?>" width="<?=$facebook_image_width ? $facebook_image_width : 100;?>" height="<?=$facebook_image_height ? $facebook_image_height : 100?>" alt="Facebook Image" />
				</th>
			<? } else { ?>
				<th id="image_fb" class="imageSpace" style="text-align: center;width: 150px;">
					<img src="<?=DEFAULT_URL;?>/images/profile_noimage.gif" width="100" height="100" alt="No Image" />
				</th>
			<? } ?>
		<? } ?>

			<td class="alignTop">
				<input type="hidden" id="facebook_image" name="facebook_image" value="<?=$facebook_image?>" />
				<input type="hidden" id="facebook_image_height" name="facebook_image_height" value="<?=$facebook_image_height?>" />
				<input type="hidden" id="facebook_image_width" name="facebook_image_width" value="<?=$facebook_image_width?>" />
				<? if ($accountObj->getString("facebook_username")) { ?>
					<p>
						<a href="javascript:void(0);" onclick="getFacebookImage();">
							<img src="<?=DEFAULT_URL?>/images/icon_facebook.gif" class="alignIMGtxt" alt=""/>
							<?=system_showText(LANG_LABEL_IMAGE_FROM_FACEBOOK);?>
						</a>
					</p>
					<?=ucfirst(system_showText(LANG_OR));?>
					<br />
				<? } ?>

				<input type="file" name="image" id="image" size="74" onchange="UploadImage('account');" /><span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?><br/>(<?=100;?>px x <?=100;?>px) (JPG, GIF <?=system_showText(LANG_OR);?> PNG)</span>
				<input type="hidden" name="image_id" value="<?=$image_id?>" />
				<!--Crop Tool Inputs-->
				<input type="hidden" name="x" id="x" />
				<input type="hidden" name="y" id="y" />
				<input type="hidden" name="x2" id="x2" />
				<input type="hidden" name="y2" id="y2" />
				<input type="hidden" name="w" id="w" />
				<input type="hidden" name="h" id="h" />
				<input type="hidden" name="image_width" id="image_width" />
				<input type="hidden" name="image_height" id="image_height" />
				<input type="hidden" name="image_type" id="image_type" />
				<input type="hidden" name="crop_submit" id="crop_submit" />
			</td>
		</tr>

		 <? if ($image_id || $facebook_image) { ?>
			<tr>
				<th>
					<input type="checkbox" name="remove_image" class="inputCheck" value="1" style="vertical-align:middle;" />
				</th>
				<td>
					<?=system_showText(LANG_MSG_CHECK_TO_REMOVE_IMAGE)?>
				</td>
			</tr>
		<? } ?>

		<tr>
			<th>* <?=system_showText(LANG_LABEL_NICKNAME);?>:</th>
			<td>
				<input type="text" name="nickname" value="<?=$nickname?>" />
			</td>
		</tr>
		<tr>
			<th><?=system_showText(LANG_LABEL_ABOUT_ME);?>:</th>
			<td>
				<textarea id="personal_message" name="personal_message" rows="7" cols="1" ><?=$personal_message?></textarea>
				<div id="textAreaCallback"></div>
			</td>
		</tr>
		<tr>
			<th><?=system_showText(LANG_LABEL_BIRTHDATE);?>:</th>
			<td>
				<input type="text" name="birth_date" id="birth_date" value="<?=$birth_date?>" style="width:80px" />
			</td>
		</tr>
		<tr>
			<th><?=system_showText(LANG_LABEL_HOMETOWN);?>:</th>
			<td><input type="text" name="birth_city" value="<?=$birth_city?>" /></td>
		</tr>

		<tr>
			<th><?=system_showText(LANG_LABEL_FAVORITEBOOKS);?>:</th>
			<td><textarea name="favorite_books" rows="3" cols="1"><?=$favorite_books?></textarea></td>
		</tr>

		<tr>
			<th><?=system_showText(LANG_LABEL_FAVORITEMOVIES);?>:</th>
			<td><textarea name="favorite_movies" rows="3" cols="1"><?=$favorite_movies?></textarea></td>
		</tr>

		<tr>
			<th><?=system_showText(LANG_LABEL_FAVORITESPORTS);?>:</th>
			<td><textarea name="favorite_sports" rows="3" cols="1"><?=$favorite_sports?></textarea></td>
		</tr>

		<tr>
			<th><?=system_showText(LANG_LABEL_FAVORITEMUSICS);?>:</th>
			<td><textarea name="favorite_musics" rows="3" cols="1"><?=$favorite_musics?></textarea></td>
		</tr>

		<tr>
			<th><?=system_showText(LANG_LABEL_FAVORITEFOODS);?>:</th>
			<td><textarea name="favorite_foods" rows="3" cols="1"><?=$favorite_foods?></textarea></td>
		</tr>

			<?
				$location_GeoIP = geo_GeoIP();
				if ($location && $location_GeoIP) {

				?>
				<tr>
					<th colspan="2" class="standard-tabletitle" style="text-align: left;">
							<?=system_showText(LANG_LABEL_LOCATIONPREF);?>
					</th>
				</tr>

				 <tr>
					<th><?=system_showText(LANG_LABEL_CHOOSELOCATIONPREF);?>: </th>
					<td>
						<input type="radio"  name="usefacebooklocation" value="1" style="width:auto" <?=$usefacebooklocation?" checked=\"checked\" ":""?> /> <?=system_showText(LANG_LABEL_USEFACEBOOKLOCATION)?>: <strong> <?=$location?></strong>
						<br/>
						<input type="radio"  name="usefacebooklocation" value="0" style="width:auto" <?=!$usefacebooklocation?" checked=\"checked\" ":""?> /> <?=system_showText(LANG_LABEL_USECURRENTLOCATION)?>: <strong> <?=$location_GeoIP?></strong>
						<input type="hidden" name="location" id="location" value="<?=$location?>" />
					</td>
				</tr>
			<? } ?>
	</table>

<script language="javascript" type="text/javascript">
	var openformOptions = true;
	
	function setFBCookie(option){
		$.cookie('fb_attachOption', option, {expires: 7, path: '/'});
	}
	
	$(document).ready(function() {
		<?
			if ( DEFAULT_DATE_FORMAT == "m/d/Y" ) $date_format = "mm/dd/yy";
			elseif ( DEFAULT_DATE_FORMAT == "d/m/Y" ) $date_format = "dd/mm/yy";
		?>

		 $('#birth_date').datepicker({
			dateFormat: '<?=$date_format?>',
			changeMonth: true,
			changeYear: true,
			yearRange: '1940:<?=date('Y')?>'
		});

		$("#open_facebook_form_connection").click(function () {
			if (openformOptions){
				$("#option_fb_1").show();
				$("#option_fb_2").show();
				$("#option_fb_3").show();
				openformOptions = false;
			} else {
				$("#option_fb_1").hide();
				$("#option_fb_2").hide();
				$("#option_fb_3").hide();
				openformOptions = true;
			}
		});

		$("#change_facebook_account").click(function () {
			if (openformOptions){
				$("#option_fb_1").show();
				$("#option_fb_2").show();
				$("#option_fb_3").show();
				openformOptions = false;
			} else {
				$("#option_fb_1").hide();
				$("#option_fb_2").hide();
				$("#option_fb_3").hide();
				openformOptions = true;
			}
		});
		
		<? if (isset($_GET["changeAcc"]) || isset($_GET["signoffFacebook"]) || isset($_GET["facebookattached"]) || isset($_GET["twitter"]) || isset($_GET["signofftwitter"])) { ?>
			$('html, body, table').animate({
				scrollTop: $("#socialNetworking").offset().top
			}, 500);
		<? } ?>
	});
	
	$(document).ready(function(){
		
		var field_name = 'personal_message';
		var count_field_name = 'personal_message_remLen';

		var options = {
					'maxCharacterSize': 250,
					'originalStyle': 'originalTextareaInfo',
					'warningStyle' : 'warningTextareaInfo',
					'warningNumber': 40,
					'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name+'" name="'+count_field_name+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
			};
		$('#'+field_name).textareaCount(options);
		
	});
</script>