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
	# * FILE: /favoritescontent.php
	# ----------------------------------------------------------------------------------------------------

?>
	<? if (!$members) { ?>
		<h2 class="standardTitle"><?=system_showText(LANG_LABEL_QUICKLIST);?></h2>
	<? } 

	 $myfavorites = 0;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if (!$_GET["id"]) {
		$id = sess_getAccountIdFromSession();
	} else {
		$id = $_GET["id"];
	}

	if ($id) {
		$dealObj = new Promotion();
		$dealsArr = $dealObj->getDealsFromUser($id);
	}

?>
<?
if ($dealsArr) {?>
	<h2 class="standardSubTitle"><?=system_showText(DEAL_RECENTDEALS)?></h2>

	
    <?
	foreach ($dealsArr as $dealdone){

		$auxMessage = "";
		if ($dealdone["facebooked"] && $dealdone["twittered"]) $auxMessage = system_showText(LANG_DEAL_POSTFACEBOOK_TWITTER);
		else if ($dealdone["facebooked"] && !$dealdone["twittered"]) $auxMessage = system_showText(LANG_DEAL_POSTFACEBOOK);
		else if (!$dealdone["facebooked"] && $dealdone["twittered"]) $auxMessage = system_showText(LANG_DEAL_TWITTER);

        $promotionObj= new Promotion($dealdone["promotion_id"]);
        ?>
		<p>		
			<?=format_date($dealdone["datetime"], DEFAULT_DATE_FORMAT)?> - <?=format_getTimeString($dealdone["datetime"]);
			$promotionLink = ((MODREWRITE_FEATURE != "on") ? "detail.php?id=".$promotionObj->getNumber("id") : $promotionObj->getString("friendly_url").".html");
			?>
			<strong><a href="<?=DEFAULT_URL?>/<?=PROMOTION_FEATURE_FOLDER?>/<?=$promotionLink?>"><?=$promotionObj->getString("name")?></a></strong>
        	<?=$dealdone["used"] ? " (".LANG_DEAL_CHECKOUT.") " : " (".LANG_DEAL_OPENED.") "?>
        	<span><?=$auxMessage?></span>
        </p>
		<br />
        <?
    }
} else {
  ?>
      <p class="informationMessage"><?=system_showText(DEAL_DIDNTNOTFINISHED)?></p>
    <?  
}
?>