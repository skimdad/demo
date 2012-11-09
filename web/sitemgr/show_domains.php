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
	# * FILE: /sitemgr/show_domains.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

	/*
	 * Get all domains
	 */
	$selectDomain = domain_getDomainList(DEFAULT_URL , SELECTED_DOMAIN_ID);
	if(is_array($selectDomain)){
		?>
		<script>
			function aux_changeDomainInfo(domain_id,default_url){
				window.parent.changeDomainInfo(domain_id,default_url,'/dashboard.php','',false);
			}
		</script>
		
		<style>
			
			h3 
			{ font-size: 18px; font-family: "Trebuchet MS", Georgia, "Times New Roman", Times, serif; line-height: 25px; }

			ul
			{ width: 470px; }	

			ul li
			{ background: #F3F3F3; list-style: none; font-size: 14px; font-family: "Trebuchet MS", Georgia, "Times New Roman", Times, serif; line-height: 20px; border: 1px solid #F4F4F4; padding: 2px 5px 2px 5px; margin: 0 0 2px 0; }	

				ul li a
				{ padding: 0; margin: 0; color: #268AAF; }
							
		</style>

		<h3><?=system_showText(LANG_SELECT_DOMAIN)?></h3>

		<ul>
		<?
		for($i=0;$i<count($selectDomain);$i++){
			unset($aux_link);
			
			?>
			<li <?=($selectDomain[$i]["domain_selected"] ? "class='active'" : "")?>>
				<a href="javascript:void(0)" onclick="aux_changeDomainInfo(<?=$selectDomain[$i]["domain_id"];?>,'<?=DEFAULT_URL?>/sitemgr')">
					<?=$selectDomain[$i]["domain_title"]?>
				</a>
			</li>
			<?
		}
		?>
		</ul>
		<?
	}
	

?>
