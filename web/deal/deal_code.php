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
	# * FILE: /deal/deal_code.php
	# ----------------------------------------------------------------------------------------------------
   
	if (DEFAULT_DATE_FORMAT == "m/d/Y") {
		$sd_date = date("m")."/".date("d")."/".date("Y");
		$ed_date = $promotionDeals['timeleft'][1]."/".$promotionDeals['timeleft'][2]."/".$promotionDeals['timeleft'][0];
	} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
		$sd_date = date("d")."/".date("m")."/".date("Y");
		$ed_date = $promotionDeals['timeleft'][2]."/".$promotionDeals['timeleft'][1]."/".$promotionDeals['timeleft'][0];
	}
	
	$sd_timestamp = system_getTimeStamp($sd_date);
	/*
	 * Get timestamp from $enddate
	 */
	$ed_timestamp = system_getTimeStamp($ed_date);

	/*
	 * Get the difference in days beteween two dates
	 */
	$diffdays = system_getDiffDays($sd_timestamp, $ed_timestamp);

	if ($diffdays){
		$format = "dHM";
	} else {
		$format = "HMS";
	}
	
	if ($user){?>
		<script type="text/javascript">
			//<![CDATA[
			$(document).ready(function() {
				newDate = new Date(<?=$promotionDeals['timeleft'][0]?>,<?=($promotionDeals['timeleft'][1]-1)?>,<?=$promotionDeals['timeleft'][2]?>,23,59,59);
				$('#timeLeft').countdown({
					until: newDate,
					format:'<?=$format?>'
				});
			});
			//]]>
		</script>
	
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/countdown/jquery.countdown.min.js"></script>
	
		<? if (EDIR_LANGUAGE != "en_us") { ?>
			<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/countdown/jquery.countdown-<?=EDIR_LANGUAGE?>.js"></script>
		<? } 
	} ?>