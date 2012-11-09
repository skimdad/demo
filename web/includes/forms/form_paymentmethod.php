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
	# * FILE: /includes/forms/form_paymentmethod.php
	# ----------------------------------------------------------------------------------------------------

?>

	<table class="standard-tableTOPBLUE orderPayment">
		<tr>
			<th colspan="2"><?=system_showText(LANG_LABEL_PAYMENT_METHOD);?></th>
		</tr>
		<tr>
			<td colspan="2">
				<table class="paymentMethods" cellpadding="0" cellspacing="0" align="center">
					<tr>

						<? if (AUTHORIZEPAYMENT_FEATURE == "on") { ?>
							<td width="10"><input style="border:0px" type="radio" name="payment_method" value="authorize" /></td>
							<td><b><?=system_showText(LANG_LABEL_BY_CREDIT_CARD)?></b></td>
						<? } ?>

						<? if (LINKPOINTPAYMENT_FEATURE == "on") { ?>
							<td width="10"><input style="border:0px" type="radio" name="payment_method" value="linkpoint" /></td>
							<td><b><?=system_showText(LANG_LABEL_BY_CREDIT_CARD)?></b></td>
						<? } ?>

						<? if (ITRANSACTPAYMENT_FEATURE == "on") { ?>
							<td width="10"><input style="border:0px" type="radio" name="payment_method" value="itransact" /></td>
							<td><b><?=system_showText(LANG_LABEL_BY_CREDIT_CARD)?></b></td>
						<? } ?>

						<? if (WORLDPAYPAYMENT_FEATURE == "on") { ?>
							<td width="10"><input style="border:0px" type="radio" name="payment_method" value="worldpay" /></td>
							<td><b><?=system_showText(LANG_LABEL_BY_CREDIT_CARD)?></b></td>
						<? } ?>

						<? if (PSIGATEPAYMENT_FEATURE == "on") { ?>
							<td width="10"><input style="border:0px" type="radio" name="payment_method" value="psigate" /></td>
							<td><b><?=system_showText(LANG_LABEL_BY_CREDIT_CARD)?></b></td>
						<? } ?>

						<? if (TWOCHECKOUTPAYMENT_FEATURE == "on") { ?>
							<td width="10"><input style="border:0px" type="radio" name="payment_method" value="twocheckout" /></td>
							<td><b><?=system_showText(LANG_LABEL_BY_CREDIT_CARD)?></b></td>
						<? } ?>

						<? if (PAYFLOWPAYMENT_FEATURE == "on") { ?>
							<td width="10"><input style="border:0px" type="radio" name="payment_method" value="payflow" /></td>
							<td><b><?=system_showText(LANG_LABEL_BY_CREDIT_CARD)?></b></td>
						<? } ?>

						<? if (PAYPALAPIPAYMENT_FEATURE == "on") { ?>
							<td width="10"><input style="border:0px" type="radio" name="payment_method" value="paypalapi" /></td>
							<td><b><?=system_showText(LANG_LABEL_BY_CREDIT_CARD)?></b></td>
						<? } ?>

						<? if (PAYPALPAYMENT_FEATURE == "on") { ?>
							<td width="10"><input style="border:0px" type="radio" name="payment_method" value="paypal" /></td>
							<td><b><?=system_showText(LANG_LABEL_BY_PAYPAL)?></b></td>
						<? } ?>

						<? if (SIMPLEPAYPAYMENT_FEATURE == "on") { ?>
							<td width="10"><input style="border:0px" type="radio" name="payment_method" value="simplepay" /></td>
							<td><b><?=system_showText(LANG_LABEL_BY_SIMPLEPAY)?></b></td>
						<? } ?>
                            
                        <? if (PAGSEGUROPAYMENT_FEATURE == "on") { ?>
							<td width="10"><input style="border:0px" type="radio" name="payment_method" value="pagseguro" /></td>
							<td><b><?=system_showText(LANG_LABEL_BY_PAGSEGURO)?></b></td>
						<? } ?>    

						<? if (INVOICEPAYMENT_FEATURE == "on") { ?>
							<td width="10"><input style="border:0px" type="radio" name="payment_method" value="invoice" /></td>
							<td><b><?=system_showText(LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK)?></b></td>
						<? } ?>

					</tr>
				</table>
			</td>
		</tr>
	</table>
