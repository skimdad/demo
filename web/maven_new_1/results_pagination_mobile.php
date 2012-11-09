<?
$isMobileApp_MOBI = TRUE;
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
	# * FILE: /frontend/results_pagination.php
	# ----------------------------------------------------------------------------------------------------
?>

<? if (($array_pages_code["total"] > $aux_items_per_page) && !$hideResults) {     
    ?>
	<div class="pagination <?=(($pagination_bottom==true) ? ("pagination-bottom") : (""))?>">
		
		<? if ($array_pages_code["previous"] || $array_pages_code["next"]){?>
			<ul class="controls">
				<?
				if($array_pages_code["previous"] && $array_pages_code["next"]){
					echo $array_pages_code["previous"];
					?>
					<li>|</li>
					<?
					echo $array_pages_code["next"];
				}elseif($array_pages_code["previous"]){
					echo $array_pages_code["previous"];
				}elseif($array_pages_code["next"]){
					echo $array_pages_code["next"];
				}
				?>
			</ul>
		<? } ?>
		<? if($array_pages_code["first"] || $array_pages_code["pages"] || $array_pages_code["last"]){ ?>
			<ul class="pages">
				<li><?=system_showText(LANG_PAGING_GOTOPAGE)?></li>
				<?=$array_pages_code["first"];?>
				<?=$array_pages_code["pages"];?>
				<?=$array_pages_code["last"];?>
			</ul>
		<? } ?>
	</div>
<? } ?>