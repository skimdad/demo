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
	# * FILE: /frontend/results_pagination.php
	# ----------------------------------------------------------------------------------------------------
?>

<? if (($showLetterBronze || ($array_pages_code_bronze["total"] > $aux_items_per_page)) && !$hideResults) {     
    ?>
	<div class="pagination">
		<?
		if($showLetterBronze && $letters_menu_bronze){
			?>
			<ul class="letters">
				<?=$letters_menu_bronze?>
			</ul>
			<?
		}
		?>
		<? if ($array_pages_code_bronze["previous"] || $array_pages_code_bronze["next"]){?>
			<ul class="controls">
				<?
				if($array_pages_code_bronze["previous"] && $array_pages_code_bronze["next"]){
					echo $array_pages_code_bronze["previous"];
					?>
					<li>|</li>
					<?
					echo $array_pages_code_bronze["next"];
				}elseif($array_pages_code_bronze["previous"]){
					echo $array_pages_code_bronze["previous"];
				}elseif($array_pages_code_bronze["next"]){
					echo $array_pages_code_bronze["next"];
				}
				?>
			</ul>
		<? } ?>
		<? if($array_pages_code_bronze["first"] || $array_pages_code_bronze["pages"] || $array_pages_code_bronze["last"]){ ?>
			<ul class="pages">
				<li><?=system_showText(LANG_PAGING_GOTOPAGE)?></li>
				<?=$array_pages_code_bronze["first"];?>
				<?=$array_pages_code_bronze["pages"];?>
				<?=$array_pages_code_bronze["last"];?>
			</ul>
		<? } ?>
	</div>
<? } ?>