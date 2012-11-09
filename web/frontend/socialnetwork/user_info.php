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
	# * FILE: /frontend/socialnetwork/user_info.php
	# ----------------------------------------------------------------------------------------------------

	extract($_GET);

	$accObj = new Account($id);
	$publish = $accObj->getString("publish_contact");
	
?>

<div class="user-info">
	<? if ($id == sess_getAccountIdFromSession() && $info["is_sponsor"] == 'n') { ?>
		<? if (string_strpos($_SERVER['PHP_SELF'], "edit.php") ==true) { ?>
			<p class="edit"><a href="<?=SOCIALNETWORK_URL;?>/" title="<?=LANG_LABEL_BACKTOPROFILE;?>"><?=LANG_LABEL_BACKTOPROFILE;?></a></p>
		<? } else { ?>
			<p class="edit"><a href="<?=SOCIALNETWORK_URL;?>/edit.php" title="<?=LANG_LABEL_EDITPROFILE;?>"><?=LANG_LABEL_EDITPROFILE;?></a></p>
		<? } ?>
	<? } else if ($id == sess_getAccountIdFromSession() && $info["is_sponsor"] == 'y') {?>
			<p class="edit"><a href="<?=DEFAULT_URL;?>/members/account/account.php?id=<?=sess_getAccountIdFromSession()?>" title="<?=LANG_LABEL_EDITPROFILE;?>"><?=LANG_LABEL_EDITPROFILE;?></a></p>
	<? } ?>
	<? if (!$info["facebook_image"]) {
			$imgObj = new Image($info["image_id"], true);
			if ($imgObj->imageExists()) {
				echo $imgObj->getTag(true, PROFILE_IMAGE_WIDTH, PROFILE_IMAGE_HEIGHT);
			} else {
				echo "<div class=\"image\"><span class=\"no-image no-link\"></span></div>";
			}
		} else { ?>
			<img width="<?=$info["facebook_image_width"] ? $info["facebook_image_width"] : 100?>" height="<?=$info["facebook_image_height"] ? $info["facebook_image_height"] : 100?>" src="<?=$info["facebook_image"]?>" border="0" alt="Facebook Image"/>
		<? } ?>
		<p>
			<?
				$nickName = $info["nickname"];
				$nickParts = explode(" ", $nickName);
				unset($nickName);
				foreach ($nickParts as $part) {
					$part = wordwrap($part, 11, "\n", true);
					$nickName[] = $part;
				}
				echo nl2br(htmlspecialchars(implode(" ", $nickName)));
			?>

			<? if ($info["country"] && $publish == 'y') { ?>
			<span>
			<?				
				echo htmlspecialchars($info["country"]);
			?>
			</span>
			<? } ?>

			<? if ($info["birth_date"] != '0000-00-00') { ?>
			<span>
				<?=format_date($info["birth_date"])?>
			</span>
			<? } ?>
		</p>
		
		<br class="clear" />

		<? if ($info["entered"]) { ?>
			<p><?=system_showText(LANG_LABEL_MEMBER_SINCE);?>: <?=format_date($info["entered"])?></p>
		<? } ?>

		<? if ($info["personal_message"]) { ?>
			<h3><?=system_showText(LANG_LABEL_ABOUT_ME);?></h3>
			<p><?=nl2br(htmlspecialchars($info["personal_message"]))?></p>
		<? } ?>
		<br class="clear" />
		<? if ($info["company"] && $publish == 'y') { ?>
			<h3><?=system_showText(LANG_LABEL_COMPANY);?></h3>
			<p><?=nl2br(htmlspecialchars($info["company"]))?></p>
		<? } ?>
		<? if ($info["address1"] && $publish == 'y') { ?>
			<h3><?=system_showText(LANG_LABEL_ADDRESS1);?></h3>
			<p><?=nl2br(htmlspecialchars($info["address1"]))?></p>
			<? if ($info["address2"]) { ?>
				<h3><?=system_showText(LANG_LABEL_ADDRESS2);?></h3>
				<p><?=nl2br(htmlspecialchars($info["address2"]))?></p>
			<? } ?>
		<? } ?>
		<? if ($info["state"] && $publish == 'y') { ?>
			<h3><?=system_showText(LANG_LABEL_STATE);?></h3>
			<p><?
				echo $info["state"];
			?></p>
		<? } ?>
		<? if ($info["city"] && $publish == 'y') { ?>
			<h3><?=system_showText(LANG_LABEL_CITY);?></h3>
			<p><?
				echo $info["city"];
			?></p>
		<? } ?>
		<? if ($info["zip"] && $publish == 'y') { ?>
			<h3><?=ucfirst(system_showText(ZIPCODE_LABEL));?></h3>
			<p><?=nl2br(htmlspecialchars($info["zip"]))?></p>
		<? } ?>
		<? if ($info["phone"] && $publish == 'y') { ?>
			<h3><?=system_showText(LANG_LABEL_PHONE);?></h3>
			<p><?=nl2br(htmlspecialchars($info["phone"]))?></p>
		<? } ?>
		<? if ($info["fax"] && $publish == 'y') { ?>
			<h3><?=system_showText(LANG_LABEL_FAX);?></h3>
			<p><?=nl2br(htmlspecialchars($info["fax"]))?></p>
		<? } ?>
		<? if ($info["email"] && $publish == 'y') { ?>
			<h3><?=system_showText(LANG_LABEL_EMAIL);?></h3>
			<p><a href="mailto:<?=nl2br(htmlspecialchars($info["email"]))?>" title="<?=system_showText(LANG_LABEL_EMAIL)." ".system_showText(LANG_PAGING_PAGEOF)." ".$info["nickname"]?>"><?=nl2br(htmlspecialchars($info["email"]))?></a></p>
		<? } ?>
		<? if ($info["url"] && $publish == 'y') { ?>
			<h3><?=system_showText(LANG_LABEL_URL);?></h3>
			<p><a href="<?=nl2br(htmlspecialchars($info["url"]))?>" title="<?=system_showText(LANG_LABEL_URL)." ".system_showText(LANG_PAGING_PAGEOF)." ".$info["nickname"]?>" target="_blank"><?=nl2br(htmlspecialchars($info["url"]));?></a></p>
		<? } ?>
		
		<? if ($info["birth_city"]) { ?>
			<h3><?=system_showText(LANG_LABEL_HOMETOWN);?></h3>
			<p><?=nl2br(htmlspecialchars($info["birth_city"]))?></p>
		<? } ?>
		<? if ($info["favorite_books"]) { ?>
			<h3><?=system_showText(LANG_LABEL_FAVORITEBOOKS);?></h3>
			<p><?=nl2br(htmlspecialchars($info["favorite_books"]))?></p>
		<? } ?>
		<? if ($info["favorite_movies"]) { ?>
			<h3><?=system_showText(LANG_LABEL_FAVORITEMOVIES);?></h3>
			<p><?=nl2br(htmlspecialchars($info["favorite_movies"]))?></p>
		<? } ?>
		<? if ($info["favorite_sports"]) { ?>
			<h3><?=system_showText(LANG_LABEL_FAVORITESPORTS);?></h3>
			<p><?=nl2br(htmlspecialchars($info["favorite_sports"]))?></p>
		<? } ?>
		<? if ($info["favorite_musics"]) { ?>
			<h3><?=system_showText(LANG_LABEL_FAVORITEMUSICS);?></h3>
			<p><?=nl2br(htmlspecialchars($info["favorite_musics"]))?></p>
		<? } ?>
		<? if ($info["favorite_foods"]) { ?>
			<h3><?=system_showText(LANG_LABEL_FAVORITEFOODS);?></h3>
			<p><?=nl2br(htmlspecialchars($info["favorite_foods"]))?></p>
		<? } 
		
		if($aux_show_twitter){
			?>
			<br />
			<div class="last-tweets">
				<h2>
					<?=system_showText(LANG_TWITTER)?>
				</h2>
				<ul id="twitter_update_list_profile">
					<?
					/*
					 * This content is prepared by ajax on includes/code/script_loader.php
					 */
					?>
					<li id="twitter_loading_profile" class="loading"></li>
				</ul>
			</div>
			<?
		}
		?>
</div>