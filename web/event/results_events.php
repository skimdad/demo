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
	# * FILE: /event/results_events.php
	# ----------------------------------------------------------------------------------------------------

	if($show_results){

		if (!$events) {

			if ($search_lock) {?>
				<p class="errorMessage">
					<?=system_showText(LANG_MSG_LEASTONEPARAMETER)?>
				</p>
				<?
			} else {
				$db = db_getDBObject();
				if ($db->getRowCount("Event") > 0) { ?>
					<div class="resultsMessage">
						<?//=system_showText(LANG_MSG_NORESULTS);?>
						<?//=system_showText(LANG_MSG_TRYAGAIN);?>
                        
                        <?
                        unset($aux_lang_msg_noresults);                        
                        $aux_lang_msg_noresults = str_replace("[EDIR_LINK_SEARCH_ERROR]",DEFAULT_URL."/contactus.php", LANG_SEARCH_NORESULTS);
                        echo $aux_lang_msg_noresults;
                        ?>
					</div>
					<?
                    /*
					if ($keyword) {
						?>
						<p class="informationMessage">
							<?=system_showText(LANG_MSG_USE_SPECIFIC_KEYWORD);?>
						</p>
						<?
					}
                     * 
                     */
				} else {
					?>
					<p class="informationMessage">
						<?=system_showText(LANG_MSG_NOEVENTS);?>
					</p>
					<?
				}
			}
		} elseif ($events){

            $level = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
			$locationManager = new LocationManager();
			$mapNumber = 0;
			$count = 10;
			$ids_report_lote = "";

			foreach ($events as $event) {
				$ids_report_lote .= $event->getString("id").",";
				$event->setLocationManager($locationManager);
				
				if ($event->getString("latitude") && $event->getString("longitude")) {
					$mapNumber++;
				}

                include(EDIRECTORY_ROOT."/includes/views/view_event_summary.php");
				$count--;
			}
			$ids_report_lote = string_substr($ids_report_lote, 0, -1);
			report_newRecord("event", $ids_report_lote, EVENT_REPORT_SUMMARY_VIEW, true);
		}
	}
?>