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
	# * FILE: /blog/archive.php
	# ----------------------------------------------------------------------------------------------------


	$infoArchive = blog_retrivePostArchiveFeatured();

	if ($infoArchive){ ?>

		<h2><?=system_showText(LANG_BLOG_ARCHIVE)?></h2>
		<?=$infoArchive;?>
	
	<? } ?>