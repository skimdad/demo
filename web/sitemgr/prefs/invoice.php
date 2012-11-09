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
	# * FILE: /sitemgr/prefs/invoice.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (INVOICEPAYMENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	//increases frequently actions
	if (!isset($invoice_company)) system_setFreqActions('prefs_invoiceinformation','INVOICEPAYMENT_FEATURE');


	if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
		if ($invoiceinfo) {
		
			if (!setting_set("invoice_company", $invoice_company))
				if (!setting_new("invoice_company", $invoice_company))
					$error = true;

			if (!setting_set("invoice_address", $invoice_address))
				if (!setting_new("invoice_address", $invoice_address))
					$error = true;

			if (!setting_set("invoice_city", $invoice_city))
				if (!setting_new("invoice_city", $invoice_city))
					$error = true;

			if (!setting_set("invoice_state", $invoice_state))
				if (!setting_new("invoice_state", $invoice_state))
					$error = true;

			if (!setting_set("invoice_country", $invoice_country))
				if (!setting_new("invoice_country", $invoice_country))
					$error = true;

			if (!setting_set("invoice_zipcode", $invoice_zipcode))
				if (!setting_new("invoice_zipcode", $invoice_zipcode))
					$error = true;

			if (!setting_set("invoice_phone", $invoice_phone))
				if (!setting_new("invoice_phone", $invoice_phone))
					$error = true;

			if (!setting_set("invoice_fax", $invoice_fax))
				if (!setting_new("invoice_fax", $invoice_fax))
					$error = true;

			if (!setting_set("invoice_email", $invoice_email))
				if (!setting_new("invoice_email", $invoice_email))
					$error = true;
				
			if ($invoice_notes)
				$invoice_notes = str_replace("\r", "", $invoice_notes);
			if (!setting_set("invoice_notes", $invoice_notes))
				if (!setting_new("invoice_notes", $invoice_notes))
					$error = true;
					
			if (!setting_set("invoice_payableto", $invoice_payableto))
				if (!setting_new("invoice_payableto", $invoice_payableto))
					$error = true;

			if ($remove_image){
				$image = new Image($invoice_image);
				$image->Delete();
				$invoice_image = 0;
			}
			
			// Image Crop
            if ($_POST["image_type"]) {

                // TYPES
                //1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order), 
                //9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
                $user_id = $_COOKIE["PHPSESSID"];
                $dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files/";
                $files = glob("$dir/_0_".$user_id."_*.*");
                if ($files[0] != '') {
					switch ($_POST["image_type"]) {
						case 1:
							$img_type='gif';
							$img_r = imagecreatefromgif( $files[0] );
							break;
						case 2:
							$img_type='jpeg';
							$img_r = imagecreatefromjpeg( $files[0] );
							break;
						case 3:
							$img_type='png';
							$img_r = imagecreatefrompng( $files[0] );
							break;
					}

					$dst_r = ImageCreateTrueColor( $_POST['w'], $_POST['h'] );

					if ($img_r) {
						
						if($img_type == "png" || $img_type == "gif"){
							imagealphablending($dst_r, false);
							imagesavealpha($dst_r,true);
							$transparent = imagecolorallocatealpha( $dst_r, 255, 255, 255, 127 );
							imagefill( $dst_r, 0, 0, $transparent ); 
							imagecolortransparent( $dst_r, $transparent);
						}
						
						if ($img_type == "gif"){ //use imagecopyresized for gif to keep the transparency. The functions imagecopyresized and imagecopyresampled works in the same way with the exception that the resized image generated through imagecopyresampled is smoothed so that it is still visible.
							//low quality
							imagecopyresized( $dst_r,
											$img_r,
											0,
											0,
											$_POST["x"],
											$_POST["y"],
											$_POST["w"],
											$_POST["h"],
											$_POST["w"],
											$_POST["h"]
										  );
						} else {
							//better quality
							imagecopyresampled( $dst_r,
											$img_r,
											0,
											0,
											$_POST["x"],
											$_POST["y"],
											$_POST["w"],
											$_POST["h"],
											$_POST["w"],
											$_POST["h"]
										  );
						}
					}

					$crop_image = $dir."crop_image.$img_type";
					if ($img_type == 'gif') imagegif($dst_r, $crop_image);
					elseif ($img_type == 'jpeg') imagejpeg($dst_r, $crop_image);
					elseif ($img_type == 'png') imagepng($dst_r, $crop_image);

					//removing image files
					foreach($files as $file) unlink($file);
				}
            }
			
			$upload_image = "";
			if ($crop_image) {
				if (!image_upload_check ($crop_image)) {
					$upload_image = "failed";
					$upload_actions = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ALERTUPLOADIMAGE);
					@unlink($_FILES['image']['tmp_name']);
				} else {
					$imageObj = image_upload($crop_image, IMAGE_INVOICE_LOGO_WIDTH, IMAGE_INVOICE_LOGO_HEIGHT, "sitemgr_");
					if (!$imageObj) {
						$upload_image = "failed";
						$upload_actions = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ALERTUPLOADIMAGE2);
						$invoice_image = 0;
					} else {
						$upload_image = "success";
						$image = new Image($invoice_image);
						$image->Delete();
						$invoice_image = $imageObj->getNumber("id");
					}
				}
			}

			if (!setting_set("invoice_image", $invoice_image))
				if (!setting_new("invoice_image", $invoice_image))
					$error = true;

			$message_invoiceinfo = "";
			if (!$error) {
				if ($upload_image == "success") $message_invoiceinfo .= "<p class=\"successMessage\">&nbsp;".system_showText(LANG_SITEMGR_INVOICE_WASCHANGED)."<br />&#149;&nbsp;".system_showText(LANG_SITEMGR_INVOICE_LOGOWASUPLOADED)."</p>";
				elseif ($upload_image == "failed") $message_invoiceinfo .= "<p class=\"successMessage\">&#149;&nbsp;".system_showText(LANG_SITEMGR_INVOICE_WASCHANGED)."</p><p class=\"errorMessage\">".$upload_actions."</p>";
				else $message_invoiceinfo .= "<p class=\"successMessage\">&#149;&nbsp;".system_showText(LANG_SITEMGR_INVOICE_WASCHANGED)."</p>";
			} else {
				if ($upload_image == "success") $message_invoiceinfo .= "<p class=\"errorMessage\">&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR)."</p><p class=\"successMessage\">&#149;&nbsp;".system_showText(LANG_SITEMGR_INVOICE_LOGOWASUPLOADED)."</p>";
				elseif ($upload_image == "failed") $message_invoiceinfo .= "<p class=\"errorMessage\">&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR)."<br />".$upload_actions."</p>";
				else $message_invoiceinfo .= "<p class=\"errorMessage\">&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR)."</p>";
			}

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	setting_get("invoice_company", $invoice_company);
	setting_get("invoice_address", $invoice_address);
	setting_get("invoice_city", $invoice_city);
	setting_get("invoice_state", $invoice_state);
	setting_get("invoice_country", $invoice_country);
	setting_get("invoice_zipcode", $invoice_zipcode);
	setting_get("invoice_phone", $invoice_phone);
	setting_get("invoice_fax", $invoice_fax);
	setting_get("invoice_email", $invoice_email);
	setting_get("invoice_image", $invoice_image);
	setting_get("invoice_notes", $invoice_notes);
	$invoice = nl2br($invoice_notes);
	$height_notes = 530 + string_substr_count($invoice, '<br />') * 14;
	setting_get("invoice_payableto", $invoice_payableto);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_INVOICE))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>	

			<br />

			<form name="invoiceinfo" id="invoiceinfo" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
				<?include(INCLUDES_DIR."/forms/form_invoiceinfo.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="invoiceinfo" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						</td>
					</tr>
				</table>
			</form>

		</div>
	</div>

	<br />

	
	<div id="header-view"><?=system_showText(LANG_LABEL_INVOICE)?> <?=string_ucwords(system_showText(LANG_SITEMGR_PREVIEW))?></div>
	<center>
		
		<a href="view_invoice.php" class="standardLINK iframe fancy_window_auto"><?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW)?> <?=system_showText(LANG_LABEL_INVOICE)?></a>
	</center>
	

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?> 
