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
	# * FILE: /sugarCRM.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");
	
	if (SUGARCRM_FEATURE != "on"){
		exit;
	}

	if (MODREWRITE_FEATURE != "on"){
		$_GET["url_full"] = "/sugar/".$_GET["edirectory_id"]."/".$_GET["sugar_id"]."/";
	}

	if($_GET["url_full"]){

		/*
		 * Get hash to validate edirectory and ID of sugarCRM
		 */
		$sugarArray = explode("/", $_GET["url_full"]);
		$position_sugar_key = array_search("sugar",$sugarArray)+2;
		$position_edirectory_key = array_search("sugar",$sugarArray)+1;

		$edirectory_key = $sugarArray[$position_edirectory_key];
		$sugar_id = $sugarArray[$position_sugar_key];

		/*
		 * Get information about registration
		 */
		$domain = $_SERVER["HTTP_HOST"];
		if (string_strpos($domain, "www.") !== false) {
			$domain = str_replace("www.", "", $domain);
		}
		if (string_strpos(DEFAULT_URL, $domain) === false) {
			$domain = "";
		}

		$errorMessage = "";

		if(sugar_validate_plugin($domain, $edirectory_key)){
			$result = sugar_login();
		} else {
			$errorMessage = system_showText(LANG_SUGAR_WRONG_KEY)."<br />";
		}

		if(!$errorMessage && is_array($result)){
			$sugar_data = sugar_getInformationToDirectory($sugar_id, $result);
		} else {
			$errorMessage = system_showText(LANG_SUGAR_CHECKINFO)."<br />";
		}

		if(!$errorMessage && is_array($sugar_data)){
			extract($sugar_data);
		} else {
			$errorMessage = system_showText(LANG_SUGAR_CHECKINFO)."<br />";
		}

		header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", FALSE);
		header("Pragma: no-cache");
		header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

		include(INCLUDES_DIR."/code/headertag.php");

		$headertag_title		= (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE));
		$headertag_author		= (($headertag_author) ? ($headertag_author) : ("Arca Solutions"));
		$headertag_description	= (($headertag_description) ? ($headertag_description) : (EDIRECTORY_TITLE));
		$headertag_keywords		= (($headertag_keywords) ? ($headertag_keywords) : (EDIRECTORY_TITLE));

		$lang_import_item_from_sugar = str_replace("[SUGAR_ITEM_TITLE]", $listing_title, LANG_IMPORT_ITEM_FROM_SUGAR);
		$lang_import_item_from_sugar = str_replace("[EDIRECTORY_TITLE]", EDIRECTORY_TITLE, $lang_import_item_from_sugar);

		?>

		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

		<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en">

			<head>
				<title><?=$headertag_title?></title>
				<meta name="author" content="<?=$headertag_author?>" />
				<meta name="description" content="<?=$headertag_description?>" />
				<meta name="keywords" content="<?=$headertag_keywords?>" />
				<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
				<?=system_getFavicon();?>
				<link rel="stylesheet" href="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME?>/sugarcrm.css" type="text/css" />
				<meta name="ROBOTS" content="index, follow" />
			</head>
			<body class="sugarCRMScreen">

				<div>
					<div class="sugarLogo">
						<img src="<?=DEFAULT_URL?>/images/bg_edirectory_sugarcmr_logo.png" alt=""/>
						<? if (!$errorMessage) {?>
						<div class="importSugarTitle">
							<p>
								<span>
									<?=$lang_import_item_from_sugar?>
								</span>
							</p>
						</div>
						<? } ?>
					</div>

					<? if (!$errorMessage) {?>

					<form class="sugarCRMForm" method="post" action="<?=DEFAULT_URL?>/order_listing.php">
						<input type="hidden" name="account_sugar_id" id="account_sugar_id" value="<?=$account_information_suggar_id?>" />
						<input type="hidden" name="username" id="username" value="<?=$account_information_email?>" />
						<input type="hidden" name="password" id="password" value="<?=$default_password?>" />
						<input type="hidden" name="retype_password" id="retype_password" value="<?=$default_password?>" />
						<input type="hidden" name="agree_tou" id="agree_tou" value="1" />
						<input type="hidden" name="title" id="title" value="<?=$listing_title?>" />
						<input type="hidden" name="friendly_url" id="friendly_url" value="<?=$listing_title?>" />
						<input type="hidden" name="language" id="language" value="<??>" />
						<input type="hidden" name="first_name" id="first_name" value="<?=$account_information_first_name?>" />
						<input type="hidden" name="last_name" id="last_name" value="<?=$account_information_last_name?>" />
						<input type="hidden" name="company" id="company" value="<?=$listing_title?>" />
						<input type="hidden" name="address" id="address" value="<?=$account_information_address1?>" />
						<input type="hidden" name="address2" id="address2" value="<?=$account_information_address2?>" />
						<input type="hidden" name="country" id="country" value="<?=$account_information_country?>" />
						<input type="hidden" name="state" id="state" value="<?=$account_information_state?>" />
						<input type="hidden" name="city" id="city" value="<?=$account_information_city?>" />
						<input type="hidden" name="zip" id="zip" value="<?=$account_information_zip_code?>" />
						<input type="hidden" name="phone" id="phone" value="<?=$account_information_phone?>" />
						<input type="hidden" name="fax" id="fax" value="<?=$account_information_fax?>" />
						<input type="hidden" name="email" id="email" value="<?=$account_information_email?>" />
						<input type="hidden" name="url" id="url" value="<?=$account_information_url?>" />
						<input type="hidden" name="user_type" id="user_type" value="newuser" />
						<input type="hidden" name="signup" id="signup" value="true" />

						<table class="sugarCRMTable">
							<tr>
								<th class="sugarCRMTableTop">
									<?=system_showText(LANG_SELECTPACKAGE);?>
								</th>
								<td class="sugarCRMTableTop">
									<select name="level" id="level">
									<?
									$listingLevelObj = new ListingLevel();
									$aux_default_level = $listingLevelObj->getDefaultLevel();
									echo $aux_default_level."<br>";
									$levelValue = $listingLevelObj->getValues();
									foreach ($levelValue as $value) { ?>
										<option value="<?=$value?>" <?=($aux_default_level == $value ? "selected" : "")?>><?=$listingLevelObj->showLevel($value)?></option>
										<?
									}
									?>	
									</select>
								</td>
							</tr>
							<?
							/*
							<tr>
								<th>
									Template Theme
								</th>
								<td>
									<select name="listingtemplate_id" onchange="templateSwitch(this.value);">
										<option value=""><?=system_showText(LANG_BUSINESS);?></option>
										<?
										$dbObjLT = db_getDBObJect();
										$sqlLT = "SELECT id FROM ListingTemplate WHERE status = 'enabled' AND editable = 'y' ORDER BY title";
										$resultLT = $dbObjLT->query($sqlLT);
										while ($rowLT = mysql_fetch_assoc($resultLT)) {
											$listingtemplate = new ListingTemplate($rowLT["id"]);
											echo "<option value=\"".$listingtemplate->getNumber("id")."\"";
											if ($listingtemplate_id == $listingtemplate->getNumber("id")) {
												echo " selected";
											}
											echo ">".$listingtemplate->getString("title");
											if ($listingtemplate->getString("price") > 0) echo " (+".CURRENCY_SYMBOL.$listingtemplate->getString("price").")";
											else echo " (".system_showText(LANG_FREE).")";
											echo "</option>";
										}
										?>
									</select>
								</td>
							</tr>

							<?
							 * 
							 */
							$langObj = new Lang();
							$languages = $langObj->getCountEnabledLang();
							if ($languages > 1) { ?>
								<tr>
									<th<?=$th_class;?>><?=system_showText(LANG_LABEL_LANGUAGE);?></th>
									<td>
										<?=language_langOptions($lang);?>
									</td>
								</tr>
								<? 
							} else{
								echo "<input type=\"hidden\" name=\"lang\" value=\"".$langObj->getDefault()."\" />\n";
							}
							?>

							<tr>
								<td class="sugarCRMButton" colspan="2">
									<p class="standardSugarButton">
										<input type="submit" name="submit_form" value="Import" />
									</p>
								</td>
							</tr>
						</table>
					</form>
					<? } else { ?>
						<table class="sugarCRMTable">
							<tr>
								<td class="sugarCRMButton" colspan="2">
									<p class="errorMessage">
										<?=system_showText($errorMessage);?>
									</p>
								</td>
							</tr>
						</table>
					<? } ?>
				</div>

				<div class="sugarCRMFooter">
					<div class="sugarVersion">Sugar Importer V.1</div>
					<? if (!$errorMessage) {?>
					<div class="wrapper">
						<?
						/*
						 * Prepare message
						 */
						$lang_message_sugar = str_replace("[SUGAR_ITEM_TITLE]", $listing_title, LANG_MESSAGE_ON_FOOTER);
						?>
						<p>
							<?=$lang_message_sugar?>
						</p>
						<h1>
							<?=system_showText(LANG_YOU_NEARLY_DONE)?>
						</h1>
					</div>
					<? } ?>
				</div>
			</body>
		</html>
	<? } ?>			