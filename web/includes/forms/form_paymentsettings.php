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
	# * FILE: /includes/forms/form_paymentsettings.php
	# ----------------------------------------------------------------------------------------------------

$modules = array("currency", "item", "payment", "paypal", "simplepay", "creditcard", "pagseguro");

?>
	<input type="hidden" id="settingSection" name="settingSection" value="<?=!$module? $modules[0]."_setting_title": $modules[$module]."_setting_title"; ?>"/>
<?

	include(INCLUDES_DIR."/forms/form_paymentsettings_currency.php");
	
	include(INCLUDES_DIR."/forms/form_paymentsettings_itemrenewalperiod.php");
	
	include(INCLUDES_DIR."/forms/form_paymentsettings_paymentgateway.php");
	
	include(INCLUDES_DIR."/forms/form_paymentsettings_paypal.php");
	
	include(INCLUDES_DIR."/forms/form_paymentsettings_paypalapi.php");

	include(INCLUDES_DIR."/forms/form_paymentsettings_simplepay.php");
	
	include(INCLUDES_DIR."/forms/form_paymentsettings_twocheckout.php");

	include(INCLUDES_DIR."/forms/form_paymentsettings_authorize.php");

	include(INCLUDES_DIR."/forms/form_paymentsettings_itransact.php");

	include(INCLUDES_DIR."/forms/form_paymentsettings_linkpoint.php");

	include(INCLUDES_DIR."/forms/form_paymentsettings_payflow.php");
	
	include(INCLUDES_DIR."/forms/form_paymentsettings_psigate.php"); 
	
	include(INCLUDES_DIR."/forms/form_paymentsettings_worldpay.php");
    
	include(INCLUDES_DIR."/forms/form_paymentsettings_pagseguro.php");

?>

	<div class="divisor"></div>
	
<script type="text/javascript">
	function showSettings(id){
		var modules = '<?=implode(",", $modules);?>';
		modules = modules.split(",");
		var click = "#" + id;
		click = click.substr(0, (click.length - 6));
		var mod = "";
		for(var i = 0; i < modules.length; i++){
			mod = "#" + modules[i] + "_setting";
			if (mod != click) {
				if($(mod).css("display") != "none"){
					$(mod).hide('blind','', 500);
				}
				$(mod + "_title").css('cursor', 'pointer');
				$(mod + "_title tr th").removeClass('active');
				$(mod + "_span").fadeTo("slow", 0);
			} else {
				if($(click).css("display") == "none"){
					$(click).show('blind','', 500);
				}
				$(mod + "_title tr th").addClass('active');
				$("#" + id).css('cursor', '');
				$(click + "_span").fadeTo("slow", 1);
				$("#settingSection").val(id);
			}
		}
	}

	function manageAll(id){
		var check = "";
		if($("#" + id).hasClass('checked')){
			$("#" + id).addClass('unchecked');
			$("#" + id).removeClass('checked');
			check = false;
		} else {
			$("#" + id).addClass('checked');
			$("#" + id).removeClass('unchecked');
			check = true;
		}
		var click = "#" + id;
		click = click.substr(0, (click.length - 6));
		$(click).find('input[type=checkbox]').attr("checked", check);
	}

	showSettings($("#settingSection").val());

</script>