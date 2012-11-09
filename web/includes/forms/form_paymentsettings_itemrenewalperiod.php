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
	# * FILE: /includes/forms/form_paymentsettings_itemrenewalperiod.php
	# ----------------------------------------------------------------------------------------------------

?>
	
	<table id="item_setting_title" onclick="showSettings(this.id);" class="standard-table">
		<tr>
			<th class="standard-tabletitle">
				<?=LANG_SITEMGR_ITEM_RENEWAL_PERIOD?>
			</th>
		</tr>
	</table>
	
	<?
	if ($error) 
		echo "<p class=\"errorMessage\">&#149;&nbsp;".$msg_error."</p>";
	else if ($success)
		echo "<p class=\"successMessage\">&#149;&nbsp;".$msg_success."</p>";
	unset($error);
	?>
	<div id="item_setting" class="defaultItems">
		<table class="standard-table left-table" id="itemrenewalperiod_form">

			<tr>
				<td colspan="3">
					<strong>* <?=LANG_SITEMGR_LISTING_SING?></strong>
				</td>
			</tr>
			<tr>
				<? if ($select_listing == "D") { ?>

					<th>
						<input type="radio" name="listingPeriod" checked="checked" value="D" onclick="getPeriodDropDown(this, 'select_listingD','select_listingM','select_listingY');" class="inputCheck" />
					</th>
					<td style="width: 50px;" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_DAY)?></div>
					</td>

				<? } else { ?>

					<th>
						<input type="radio" name="listingPeriod" value="D" onclick="getPeriodDropDown(this, 'select_listingD','select_listingM','select_listingY');" class="inputCheck" />
					</th>
					<td style="width: 50px;" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_DAY)?></div>
					</td>

				<? } ?>

				<td>
					<select name="select_listingD" id="select_listingD" style="<?if ($select_listing != "D") echo "display: none;"; ?> width: 100px;">
						<option value="0" selected="selected"><?=LANG_PAGING_ORDERBYPAGE_SELECT?></option>;
						<?
							$max = 30;

							$periodDropDown = "";
							for ($i = 1; $i <= $max; $i++) {
								if ($listingPD == $i) {
									$periodDropDown .= "<option value=\"".$i."\"selected=\"selected\">".$i."</option>\n";
								} else $periodDropDown .= "<option value=\"".$i."\">".$i."</option>\n";
							}
							echo $periodDropDown;
							?>
					</select>
				</td>
			</tr>

			<tr>
				<? if ($select_listing == "M") { ?>

					<th>
						<input type="radio" name="listingPeriod" checked="checked" value="M" onclick="getPeriodDropDown(this, 'select_listingM','select_listingD','select_listingY');" class="inputCheck" />
					</td>
					<td style="width: 50px;" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?></div>
					</td>

				<? } else { ?>

					<th>
						<input type="radio" name="listingPeriod" value="M" onclick="getPeriodDropDown(this, 'select_listingM','select_listingD','select_listingY');" class="inputCheck" />
					</th>
					<td style="width: 50px;" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?></div>
					</td>

				<? } ?>

				<td>
						<select name="select_listingM" id="select_listingM" style="<?if ($select_listing != "M") echo "display: none;"; ?> width: 100px;">
							<option value="0" selected="selected"><?=LANG_PAGING_ORDERBYPAGE_SELECT?></option>;
							<?
								$max = 12;

								$periodDropDown = "";
								for ($i = 1; $i <= $max; $i++) {
									if ($listingPM == $i) {
										$periodDropDown .= "<option value=\"".$i."\"selected=\"selected\">".$i."</option>\n";
									} else $periodDropDown .= "<option value=\"".$i."\">".$i."</option>\n";
								}
								echo $periodDropDown;
							?>
						</select>
				</td>
			</tr>
			<tr>
				<? if ($select_listing == "Y") { ?>

					<th>
						<input type="radio" name="listingPeriod" checked="checked" value="Y" onclick="getPeriodDropDown(this, 'select_listingY','select_listingD','select_listingM');" class="inputCheck" />
					</th>
					<td style="width: 50px;" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?></div>
					</td>
				<? } else { ?>
					<th>
						<input type="radio" name="listingPeriod" value="Y" onclick="getPeriodDropDown(this, 'select_listingY','select_listingD','select_listingM');" class="inputCheck" />
					</th>
					<td style="width: 50px;" class="td-form">
						<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?></div>
					</td>
				<? } ?>
				<td>
					<select name="select_listingY" id="select_listingY" style="<?if ($select_listing != "Y") echo "display: none;"; ?> width: 100px;">
						<option value="0" selected="selected"><?=LANG_PAGING_ORDERBYPAGE_SELECT?></option>
						<?
							$max = 5;

							$periodDropDown = "";
							for ($i = 1; $i <= $max; $i++) {
								if ($listingPY == $i) {
									$periodDropDown .= "<option value=\"".$i."\"selected=\"selected\">".$i."</option>\n";
								} else $periodDropDown .= "<option value=\"".$i."\">".$i."</option>\n";
							}
							echo $periodDropDown;
						?>
					</select>
				</td>
			</tr>

			<? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
				<tr><th colspan="3"><div class="divisor"></div><th/></tr>
				<tr>
					<td colspan="3">
						<strong>* <?=LANG_SITEMGR_BANNER_SING?></strong>
					</td>
				</tr>
				<tr>
					<? if ($select_banner == "D") { ?>

						<th>
							<input type="radio" name="bannerPeriod" checked="checked" value="D" onclick="getPeriodDropDown(this, 'select_bannerD','select_bannerM','select_bannerY');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_DAY)?></div>
						</td>

					<? } else { ?>

						<th>
							<input type="radio" name="bannerPeriod" value="D" onclick="getPeriodDropDown(this, 'select_bannerD','select_bannerM','select_bannerY');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_DAY)?></div>
						</td>

					<? } ?>
					<td>
						<select name="select_bannerD" id="select_bannerD" style="<?if ($select_banner != "D") echo "display: none;"; ?> width: 100px;">
							<option value="0" selected="selected"><?=LANG_PAGING_ORDERBYPAGE_SELECT?></option>;
							<?
								$max = 30;

								$periodDropDown = "";
								for ($i = 1; $i <= $max; $i++) {
									if ($bannerPD == $i) {
										$periodDropDown .= "<option value=\"".$i."\"selected=\"selected\">".$i."</option>\n";
									} else $periodDropDown .= "<option value=\"".$i."\">".$i."</option>\n";
								}
								echo $periodDropDown;
							?>
						</select>
					</td>
				</tr>
				<tr>
					<? if ($select_banner == "M") { ?>

						<th>
							<input type="radio" name="bannerPeriod" checked="checked" value="M" onclick="getPeriodDropDown(this, 'select_bannerM','select_bannerD','select_bannerY');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?></div>
						</td>

					<? } else { ?>

						<th>
							<input type="radio" name="bannerPeriod" value="M" onclick="getPeriodDropDown(this, 'select_bannerM','select_bannerD','select_bannerY');" class="inputCheck"/>
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?></div>
						</td>

					<? } ?>
					<td>
						<select name="select_bannerM" id="select_bannerM" style="<?if ($select_banner != "M") echo "display: none;"; ?> width: 100px;">
							<option value="0" selected="selected"><?=LANG_PAGING_ORDERBYPAGE_SELECT?></option>;
							<?
								$max = 12;

								$periodDropDown = "";
								for ($i = 1; $i <= $max; $i++) {
									if ($bannerPM == $i) {
										$periodDropDown .= "<option value=\"".$i."\"selected=\"selected\">".$i."</option>\n";
									} else $periodDropDown .= "<option value=\"".$i."\">".$i."</option>\n";
								}
								echo $periodDropDown;
							?>
						</select>
					</td>
				</tr>
				<tr>
					<? if ($select_banner == "Y") { ?>
						<th>
							<input type="radio" name="bannerPeriod" checked="checked" value="Y" onclick="getPeriodDropDown(this, 'select_bannerY','select_bannerD','select_bannerM');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?></div>
						</td>
					<? } else { ?>
						<th>
							<input type="radio" name="bannerPeriod" value="Y" onclick="getPeriodDropDown(this, 'select_bannerY','select_bannerD','select_bannerM');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?></div>
						</td>
					<? } ?>
					<td>
						<select name="select_bannerY" id="select_bannerY" style="<?if ($select_banner != "Y") echo "display: none;"; ?> width: 100px;">
							<option value="0" selected="selected"><?=LANG_PAGING_ORDERBYPAGE_SELECT?></option>;
							<?

								$max = 5;

								$periodDropDown = "";
								for ($i = 1; $i <= $max; $i++) {
									if ($bannerPY == $i) {
										$periodDropDown .= "<option value=\"".$i."\"selected=\"selected\">".$i."</option>\n";
									} else $periodDropDown .= "<option value=\"".$i."\">".$i."</option>\n";
								}
								echo $periodDropDown;
							?>
						</select>
					</td>
				</tr>
			<? } ?>

			<? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
				<tr><th colspan="3"><div class="divisor"></div><th/></tr>
				<tr>
					<td colspan="3">
						<strong>* <?=LANG_SITEMGR_EVENT_SING?></strong>
					</td>
				</tr>
				<tr>
					<? if ($select_event == "D") { ?>

						<th>
							<input type="radio" name="eventPeriod" checked="checked" value="D" onclick="getPeriodDropDown(this, 'select_eventD','select_eventM','select_eventY');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_DAY)?></div>
						</td>

					<? } else { ?>

						<th>
							<input type="radio" name="eventPeriod" value="D" onclick="getPeriodDropDown(this, 'select_eventD','select_eventM','select_eventY');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_DAY)?></div>
						</td>

					<? } ?>
					<td>
						<select name="select_eventD" id="select_eventD" style="<?if ($select_event != "D") echo "display: none;"; ?> width: 100px;">
							<option value="0" selected="selected"><?=LANG_PAGING_ORDERBYPAGE_SELECT?></option>;
							<?
								$max = 30;

								$periodDropDown = "";
								for ($i = 1; $i <= $max; $i++) {
									if ($eventPD == $i) {
										$periodDropDown .= "<option value=\"".$i."\"selected=\"selected\">".$i."</option>\n";
									} else $periodDropDown .= "<option value=\"".$i."\">".$i."</option>\n";
								}
								echo $periodDropDown;
							?>
						</select>
					</td>
				</tr>
				<tr>
					<? if ($select_event == "M") { ?>

						<th>
							<input type="radio" name="eventPeriod" checked="checked" value="M" onclick="getPeriodDropDown(this, 'select_eventM','select_eventD','select_eventY');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?></div>
						</td>

					<? } else { ?>

						<th>
							<input type="radio" name="eventPeriod" value="M" onclick="getPeriodDropDown(this, 'select_eventM','select_eventD','select_eventY');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?></div>
						</td>

					<? } ?>
					<td>
						<select name="select_eventM" id="select_eventM" style="<?if ($select_event != "M") echo "display: none;"; ?> width: 100px;">
							<option value="0" selected="selected"><?=LANG_PAGING_ORDERBYPAGE_SELECT?></option>;
							<?
								$max = 12;

								$periodDropDown = "";
								for ($i = 1; $i <= $max; $i++) {
									if ($eventPM == $i) {
										$periodDropDown .= "<option value=\"".$i."\"selected=\"selected\">".$i."</option>\n";
									} else $periodDropDown .= "<option value=\"".$i."\">".$i."</option>\n";
								}
								echo $periodDropDown;
							?>
						</select>
					</td>
				</tr>
				<tr>
					<? if ($select_event == "Y") { ?>
						<th>
							<input type="radio" name="eventPeriod" checked="checked"  value="Y" onclick="getPeriodDropDown(this, 'select_eventY','select_eventD','select_eventM');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?></div>
						</td>
					<? } else { ?>
						<th>
							<input type="radio" name="eventPeriod" value="Y" onclick="getPeriodDropDown(this, 'select_eventY','select_eventD','select_eventM');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?></div>
						</td>
					<? } ?>
					<td>
						<select name="select_eventY" id="select_eventY" style="<?if ($select_event != "Y") echo "display: none;"; ?> width: 100px;">
							<option value="0" selected="selected"><?=LANG_PAGING_ORDERBYPAGE_SELECT?></option>
							<?

								$max = 5;

								$periodDropDown = "";
								for ($i = 1; $i <= $max; $i++) {
									if ($eventPY == $i) {
										$periodDropDown .= "<option value=\"".$i."\"selected=\"selected\">".$i."</option>\n";
									} else $periodDropDown .= "<option value=\"".$i."\">".$i."</option>\n";
								}
								echo $periodDropDown;

							?>
						</select>
					</td>
				</tr>
			<? } ?>

			<? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
				<tr><th colspan="3"><div class="divisor"></div><th/></tr>
				<tr>
					<td colspan="3">
						<strong>* <?=LANG_SITEMGR_CLASSIFIED_SING?></strong>
					</td>
				</tr>
				<tr>
					<? if ($select_classified == "D") { ?>

						<th>
							<input type="radio" name="classifiedPeriod" checked="checked" value="D" onclick="getPeriodDropDown(this, 'select_classifiedD','select_classifiedM','select_classifiedY');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_DAY)?></div>
						</td>

					<? } else { ?>

						<th>
							<input type="radio" name="classifiedPeriod" value="D" onclick="getPeriodDropDown(this, 'select_classifiedD','select_classifiedM','select_classifiedY');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_DAY)?></div>
						</td>

					<? } ?>
					<td>
						<select name="select_classifiedD" id="select_classifiedD" style="<?if ($select_classified != "D") echo "display: none;"; ?> width: 100px;">
							<option value="0" selected="selected"><?=LANG_PAGING_ORDERBYPAGE_SELECT?></option>;
							<?
								$max = 30;

								$periodDropDown = "";
								for ($i = 1; $i <= $max; $i++) {
									if ($classifiedPD == $i) {
										$periodDropDown .= "<option value=\"".$i."\"selected=\"selected\">".$i."</option>\n";
									} else $periodDropDown .= "<option value=\"".$i."\">".$i."</option>\n";
								}
								echo $periodDropDown;
							?>
						</select>
					</td>
				</tr>
				<tr>
					<? if ($select_classified == "M") { ?>

						<th>
							<input type="radio" name="classifiedPeriod" checked="checked" value="M" onclick="getPeriodDropDown(this, 'select_classifiedM','select_classifiedD','select_classifiedY');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?></div>
						</td>

					<? } else { ?>

						<th>
							<input type="radio" name="classifiedPeriod" value="M" onclick="getPeriodDropDown(this, 'select_classifiedM','select_classifiedD','select_classifiedY');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?></div>
						</td>

					<? } ?>
					<td>
						<select name="select_classifiedM" id="select_classifiedM" style="<?if ($select_classified != "M") echo "display: none;"; ?> width: 100px;">
							<option value="0" selected="selected"><?=LANG_PAGING_ORDERBYPAGE_SELECT?></option>;
							<?
								$max = 12;

								$periodDropDown = "";
								for ($i = 1; $i <= $max; $i++) {
									if ($classifiedPM == $i) {
										$periodDropDown .= "<option value=\"".$i."\"selected=\"selected\">".$i."</option>\n";
									} else $periodDropDown .= "<option value=\"".$i."\">".$i."</option>\n";
								}
								echo $periodDropDown;
							?>
						</select>
					</td>
				</tr>
				<tr>
					<? if ($select_classified == "Y") { ?>
						<th>
							<input type="radio" name="classifiedPeriod" checked="checked" value="Y" onclick="getPeriodDropDown(this, 'select_classifiedY','select_classifiedD','select_classifiedM');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?></div>
						</td>
					<? } else { ?>
						<th>
							<input type="radio" name="classifiedPeriod" value="Y" onclick="getPeriodDropDown(this, 'select_classifiedY','select_classifiedD','select_classifiedM');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?></div>
						</td>
					<? } ?>
					<td>
						<select name="select_classifiedY" id="select_classifiedY" style="<?if ($select_classified != "Y") echo "display: none;"; ?> width: 100px;">
							<option value="0" selected="selected"><?=LANG_PAGING_ORDERBYPAGE_SELECT?></option>
							<?

								$max = 5;

								$periodDropDown = "";
								for ($i = 1; $i <= $max; $i++) {
									if ($classifiedPY == $i) {
										$periodDropDown .= "<option value=\"".$i."\"selected=\"selected\">".$i."</option>\n";
									} else $periodDropDown .= "<option value=\"".$i."\">".$i."</option>\n";
								}
								echo $periodDropDown;
							?>
						</select>
					</td>
				</tr>
			<? } ?>

			<? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
				<tr><th colspan="3"><div class="divisor"></div><th/></tr>
				<tr>
					<td colspan="3">
						<strong>* <?=LANG_SITEMGR_ARTICLE_SING?></strong>
					</td>
				<tr>
				<tr>
					<? if ($select_article == "D") { ?>

						<th>
							<input type="radio" name="articlePeriod" checked="checked" value="D" onclick="getPeriodDropDown(this, 'select_articleD','select_articleM','select_articleY');" class="inputCheck" />
						</td>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_DAY)?></div>
						</td>

					<? } else { ?>

						<th>
							<input type="radio" name="articlePeriod" value="D" onclick="getPeriodDropDown(this, 'select_articleD','select_articleM','select_articleY');" class="inputCheck" />
						</td>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_DAY)?></div>
						</td>

					<? } ?>
					<td>
						<select name="select_articleD" id="select_articleD" style="<?if ($select_article != "D") echo "display: none;"; ?> width: 100px;">
							<option value="0" selected="selected"><?=LANG_PAGING_ORDERBYPAGE_SELECT?></option>;
							<?
								$max = 30;

								$periodDropDown = "";
								for ($i = 1; $i <= $max; $i++) {
									if ($articlePD == $i) {
										$periodDropDown .= "<option value=\"".$i."\"selected=\"selected\">".$i."</option>\n";
									} else $periodDropDown .= "<option value=\"".$i."\">".$i."</option>\n";
								}
								echo $periodDropDown;
							?>
						</select>
					</td>
				</tr>
					<tr>
					<? if ($select_article == "M") { ?>

						<th>
							<input type="radio" name="articlePeriod" checked="checked" value="M" onclick="getPeriodDropDown(this, 'select_articleM','select_articleD','select_articleY');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?></div>
						</td>

					<? } else { ?>

						<th>
							<input type="radio" name="articlePeriod" value="M" onclick="getPeriodDropDown(this, 'select_articleM','select_articleD','select_articleY');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?></div>
						</td>

					<? } ?>
						<td>
						<select name="select_articleM" id="select_articleM" style="<?if ($select_article != "M") echo "display: none;"; ?> width: 100px;">
							<option value="0" selected="selected"><?=LANG_PAGING_ORDERBYPAGE_SELECT?></option>;
							<?
								$max = 12;

								$periodDropDown = "";
								for ($i = 1; $i <= $max; $i++) {
									if ($articlePM == $i) {
										$periodDropDown .= "<option value=\"".$i."\"selected=\"selected\">".$i."</option>\n";
									} else $periodDropDown .= "<option value=\"".$i."\">".$i."</option>\n";
								}
								echo $periodDropDown;
							?>
						</select>
					</td>
					</tr>
					<tr>
					<? if ($select_article == "Y") { ?>
						<th>
							<input type="radio" name="articlePeriod" checked="checked" value="Y" onclick="getPeriodDropDown(this, 'select_articleY','select_articleD','select_articleM');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?></div>
						</td>
					<? } else { ?>
						<th>
							<input type="radio" name="articlePeriod" value="Y" onclick="getPeriodDropDown(this, 'select_articleY','select_articleD','select_articleM');" class="inputCheck" />
						</th>
						<td style="width: 50px;" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?></div>
						</td>
					<? } ?>
					<td>
						<select name="select_articleY" id="select_articleY" style="<?if ($select_article != "Y") echo "display: none;"; ?> width: 100px;">
							<option value="0"><?=LANG_PAGING_ORDERBYPAGE_SELECT?></option>
							<?

								$max = 5;

								$periodDropDown = "";
								for ($i = 1; $i <= $max; $i++) {
									if ($articlePY == $i) {
										$periodDropDown .= "<option value=\"".$i."\"selected=\"selected\">".$i."</option>\n";
									} else $periodDropDown .= "<option value=\"".$i."\">".$i."</option>\n";
								}
								echo $periodDropDown;
							?>
						</select>
					</td>
				</tr>
			<? } ?>

		</table>
	</div>
	
	<script type="text/javascript">

		function getPeriodDropDown(obj, id1, id2, id3) {
			if (obj.checked){

				document.getElementById(id1).style.display = '';
				document.getElementById(id2).style.display = 'none';
				document.getElementById(id3).style.display = 'none';
				document.getElementById(id1).value = 0;
				document.getElementById(id2).value = 0;
				document.getElementById(id3).value = 0;
			}else {

				document.getElementById(id1).style.display = 'none';
				document.getElementById(id2).style.display = 'none';
				document.getElementById(id3).style.display = 'none';
			}
		}
	</script>