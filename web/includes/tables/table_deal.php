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
	# * FILE: /includes/tables/table_deal.php
	# ----------------------------------------------------------------------------------------------------

?>

<form name="item_table">
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

		<tr>
			<th style="width: auto;"><?=system_showText(LANG_LABEL_ACCOUNT);?></th>
			<th style="width: 100px" colspan="2"><?=system_showText(LANG_LABEL_POSTED_ON);?></th>
			<th style="width: 15%"><?=system_showText(LANG_LABEL_DATE);?></th>
			<th style="width: 100px;"><?=system_showText(DEAL_SITEMGR_REDEEMCODE);?></th>
			<th style="width: 100px;"><?=system_showText(LANG_LABEL_STATUS);?></th>
		</tr>
		<?
			foreach ($dealsInfo as $info) {
				$profileObj = new Profile($info["account_id"]);
				if ($profileObj->getString("nickname")) $info["profile_name"] = $profileObj->getString("nickname");
				?>
				<tr>
					<td>
					<? if ($profileObj->getNumber("account_id") && string_strpos($url_base, "sitemgr") !== false) { ?>
						<a href="<?=$url_base?>/account/view.php?id=<?=$info["account_id"];?>"><?=$info["profile_name"]?></a>
					<? } else { ?>
						<?=$info["profile_name"]?>
					<? } ?>
					</td>
					<td class="facebookRedeem">
					<?
						if ($info["facebooked"]) {?>
							<img src="<?=DEFAULT_URL;?>/images/facebook.gif" border="0">
						<? } else { ?>
							<img src="<?=DEFAULT_URL;?>/images/facebook_off.gif" border="0">
						<? }
					?>
                    </td>
                    <td class="twitterRedeem">
					<?
						if ($info["twittered"]) {?>
							<img src="<?=DEFAULT_URL;?>/images/twitter.gif" border="0">
						<? } else { ?>
							<img src="<?=DEFAULT_URL;?>/images/twitter_off.gif" border="0">
						<? }
					?>
					</td>
					<td><?=format_date($info["datetime"],DEFAULT_DATE_FORMAT);?></td>
					<td><?=$info["redeem_code"]?></td>
					<td>
						<input type="checkbox" <?=$info["used"] ? "checked=\"checked\"" : ""?> id="checkout" code="<?=$info["redeem_code"]?>" value="0" class="checkout" name="checkout">
						<div code="<?=$info["redeem_code"]?>">
							<?=$info["used"] ? system_showText(DEAL_SITEMGR_USED) : system_showText(DEAL_SITEMGR_AVAILABLE)?>
						</div>
					</td>
				</tr>
				<?
			}
		?>

	</table>
</form>