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
	# * FILE: /includes/forms/form_clicktocall.php
	# ----------------------------------------------------------------------------------------------------
	
	if ($error) {
		?>
		<p class="errorMessage">
			<?=$message?>
		</p>
		<?		
	}elseif($message){
		?>
		<p class="informationMessage">
			<?=$message?>
		</a>
		<?
	}
	?>
		
	<script type="text/javascript">
		function changeSendForm(method){
			if(method == "checkClickToCall"){
				document.getElementById("action_clicktocall").value = "verify_number";	
			} else if (method == "clearNumber"){
				document.getElementById("action_clicktocall").value = "clearNumber";	
			} else if (method == "copyNumber"){
				document.getElementById("action_clicktocall").value = "copyNumber";	
			}
			document.getElementById('clicktocall_form').submit();	
		}
        
        $(document).ready(function(){
            $('#item_clicktocall_number').autocomplete(
                '<?=DEFAULT_URL;?>/autocomplete_twilio.php?domain_id=<?=SELECTED_DOMAIN_ID?>&account_id=<?=$accId?>',{
                delay:1000,
                dataType:'html',
                minChars:3,
                matchSubset:0,
                selectFirst:0,
                matchContains:1,
                cacheLength:100,
                autoFill:false,
                maxItemsToShow:100,
                max:100
            }).result(function(event, item) {
                $("#item_clicktocall_number").attr("value", item[1]);
                <? if ($members) { ?>
                    $("#buttonSaveCopy").removeClass("standardButton");
                    $("#buttonSaveCopy").removeClass("standardButton-disabled");
                    $("#buttonSaveCopy").addClass("standardButton");
                <? } else { ?>
                    $("#buttonSaveCopy").removeClass("input-button-form");
                    $("#buttonSaveCopy").removeClass("input-button-form-disabled");
                    $("#buttonSaveCopy").addClass("input-button-form");
                <? } ?>
                $("#buttonSaveCopy").attr("disabled", false);
                document.getElementById("buttonSaveCopy").onclick = function() {
                    changeSendForm('copyNumber');
				}        
            });
        });
	</script>
	
	<input type="hidden" name="action_clicktocall" id="action_clicktocall" value="addCallerID" />
	
	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th class="wrap">
				<?="* ".system_showText(LANG_CLICKTOCALL_PHONE).":";?>
			</th>
			<td>
				<input type="text" name="item_clicktocall_number" id="item_clicktocall_number" value="<?=$item_clicktocall_number ? $item_clicktocall_number : ""?>" maxlength="15" <?=((DEMO_LIVE_MODE) ? "readonly": "")?>/>
				<span><?=system_showText(LANG_CLICKTOCALL_TIP7)?></span>
			</td>
		</tr>
		<?
		/**
		 * Don't work to extension 
		 *
		<tr>
			<th class="wrap">
				<?=system_showText(LANG_CLICKTOCALL_EXTENSION).":";?>
			</th>
			<td>
				<input type="text" name="item_clicktocall_extension" value="<?=$item_clicktocall_extension ? $item_clicktocall_extension : ""?>" maxlength="100" />				
			</td>
		</tr>
		 * 
		 */
		?>
	</table>