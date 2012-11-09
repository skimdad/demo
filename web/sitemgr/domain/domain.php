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
	# * FILE: /sitemgr/domain/domain.php
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

	$url_redirect = "".DEFAULT_URL."/sitemgr/domain";
	$url_base 	  = "".DEFAULT_URL."/sitemgr";
	$sitemgr 	  = 1;
	$item_form    = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);

	if (!$step) $step = 1;

	//increases frequently actions
	if (!isset($id)) system_setFreqActions('domain_add','domain');

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/domain.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

	if (DEMO_LIVE_MODE) { ?>
		<script language="javascrip" type="text/javascript">
            $(document).ready(function(){
                fancy_alert('<?=system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE4);?>', 'informationMessage', false, 450, 100, true);
                setTimeout("window.location=\"<?=DEFAULT_URL;?>/sitemgr/domain/\"", 5000);
            });
		</script>
	<? } ?>

<script type="text/javascript">
	function domainFinish (id) {
		var domain_name = $("#name").val();
		var domain_url = $("#url").val();
		var domain_server = $("#server").val();
		var domain_subfolder = $("#subfolder").val();
		var domain_id = id;
		$('#domainButtons').css('display', 'none');
		$('#domainProgress').css('display', '');
		$('#finishError').css('display', 'none');
		$.post(DEFAULT_URL + "/sitemgr/domain/finish.php", {
			domain_name: domain_name,
			domain_url: domain_url,
			domain_server: domain_server,
			domain_id: domain_id,
			domain_subfolder: domain_subfolder,
			action: "save"
		}, function (ret) {
			domain_id = ret;
			$.post(DEFAULT_URL + "/sitemgr/domain/finish.php", {
				domain_id: domain_id,
				action: "create"
			});
			showPercentage(domain_id);
		});
	}

	function showPercentage (domain_id) {
		$.post(DEFAULT_URL + "/sitemgr/domain/finish.php", {
			domain_id: domain_id,
			action: "read"
		}, function (ret) {
			var aRet = ret.split("|");
			if (aRet[1] == 100) {
				$("#domain_message").html(aRet[0]);
			} else {
				$("#domain_message").html(aRet[0] + "<br /><img src=\"<?=DEFAULT_URL;?>/images/img_loading.gif\" />");
			}
			$("#domain_progress").text(aRet[1]);
			if (aRet[1] >= 0 && aRet[1] < 100) {
				showPercentage(domain_id);
			} else if (aRet[1] == 100) {
				window.location = DEFAULT_URL + "/sitemgr/domain/index.php?message=0&domain_id=" + domain_id;
			} else if (aRet[1] == "error") {
				$('#finishError').html(aRet[0] + "<br /><?=system_showText(LANG_SITEMGR_DOMAIN_ERROR_TRYAGAIN);?>");
				$('#finishError').css('display', '');
				$('#domainButtons').css('display', '');
				$('#domainProgress').css('display', 'none');
				$("#domain_message").html("<?=system_showText(LANG_SITEMGR_DOMAIN_PROCESS_STARTING);?><br /><img src=\"<?=DEFAULT_URL;?>/images/img_loading.gif\"> /");
				$("#domain_progress").text("0");
			}
		});
	}
</script>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<?
			$prefix = string_ucwords(system_showText(LANG_SITEMGR_ADD));
			?>
			<h1><?=$prefix?> <?=system_showText(LANG_SITEMGR_DOMAIN_SING)?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/sitemgr/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_domain_submenu.php"); ?>

			<p class="informationMessage">
				<?=system_showText(LANG_SITEMGR_DOMAIN_TIP);?>&nbsp;<br />
				<a href="http://edirectory.com/orders/" title="eDirectory Order" target="_blank">
					<?=system_showText(LANG_SITEMGR_DOMAIN_TIPLINK);?>
				</a>
			</p>

			<div class="baseForm">

			<? if (!$deniedOperation) {?>

			<form name="domain" id="domain" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<p class="errorMessage" id="finishError" style="display: none"></p>

				<? 
				include(INCLUDES_DIR."/forms/form_domain.php");

				?>
				<div id="domainProgress" style="display: none;">
					<p class="informationMessage">
						<?=system_showText(LANG_SITEMGR_DOMAIN_PROCESS_MSG);?>
					</p>
					<p style="padding-top: 10px; text-align: center;">
						<span id="domain_message"><?=system_showText(LANG_SITEMGR_DOMAIN_PROCESS_STARTING);?><br /><img src="<?=DEFAULT_URL;?>/images/img_loading.gif" /></span>
					</p>
					<p style="padding-top: 10px; text-align: center;">
						<span id="domain_progress">0</span>
						<span id="dmoain_progress_percentage">%</span>
					</p>
				</div>
				<div id="domainButtons">
					<button type="submit" id="bt_submit" name="submit_button" class="input-button-form" value="Submit"><?=system_showText(LANG_SITEMGR_SUBMIT);?></button>
					<button type="button" name="cancel" class="input-button-form" value="Cancel" onclick="window.location = '<?=DEFAULT_URL?>/sitemgr/domain/index.php<?=$id? "?cancel=".$id :''?>'"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
				</div>
			</form>

			<form id="formdomainstep" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<input type="hidden" name="id" value="<?=$id?>" />
				<input type="hidden" name="visitedStep" value="<?=$visitedStep;?>" />
				<input type="hidden" name="step" id="toStep" value="<?=$previousstep?>" />
			</form>

			<? } else {
				include(INCLUDES_DIR."/forms/form_domain_denied.php");
			 } ?>
			</div>

		</div>
	</div>

	<div id="bottom-content">&nbsp;</div>

	<script type="text/javascript">
		var is_valid = '<?=$is_valid;?>';
		var domain_id = '<?=$domain_id;?>';
		if (is_valid) {
			domainFinish(domain_id);
		}
	</script>
</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>