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
	# * FILE: /includes/views/view_promotion_detail_code.php
	# ----------------------------------------------------------------------------------------------------
	 
?>

	<div class="share">
		<?=$deal_icon_navbar;?>
		<? if ($map_link) { ?>
			<ul class="share-actions">
				<li><a href="javascript: void(0);" <?=$map_link?> <?=$map_style?>><?=system_showText(LANG_ICONMAP)?></a></li>
			</ul>
		<? } ?>
	</div>

	<div class="detail">

		<h1><?=$deal_name;?></h1>

		<? /*if ($deal_category_tree){ ?>
		<?=$deal_category_tree;?>
		<? }*/ ?>

		<div class="deal">

			<div class="left">
				<? if ($dealsDone) { ?>
				<div class="deal-tag deal-tag-sold-out">
					<span class="price"><?=system_showText(DEAL_SOLDOUT);?></span>
					<span class="discount"><?=$deal_offer?> OFF</span>
				</div>
				<? } else { ?>
				<div class="deal-tag">
					<span class="price"><?=$deal_value.($deal_cents ? "<span class=\"cents\">".$deal_cents."</span>" : "")?></span>
					<span class="discount"><?=$deal_offer?> OFF</span>
				</div>
				<? } ?>
			</div>

			<div class="image">
			   <?=$imageTag;?>
			</div>

			<div class="info">

				<ul class="counter">
					<li id="timeLeft">
						<? if (!$user) { ?>
							<span class="countdown_row countdown_show3">
								<li class="countdown_section">
									<span class="countdown_amount">00</span>
									<strong><?=string_ucwords(system_showText(LANG_LABEL_DAY));?></strong>
								</li>
								<li class="countdown_section">
									<span class="countdown_amount">00</span>
									<strong><?=string_ucwords(system_showText(LANG_LABEL_HOUR));?></strong>
								</li>
								<li class="countdown_section">
									<span class="countdown_amount">00</span>
									<strong><?=string_ucwords(system_showText(LANG_LABEL_MINUTE));?></strong>
								</li>
							</span>
						<? } ?>
					</li>
				</ul>

				<div class="action">

					<? if ($dealsDone) { ?>
						<p><strong><?=system_showText(DEAL_VALUE)?>:</strong> <?=$deal_real_value;?></p>
						<p><strong><?=system_showText(DEAL_WITHTHISCOUPON)?>:</strong> <?=CURRENCY_SYMBOL.format_money($promotion->getNumber("dealvalue"),2)?><p>
						<p><strong><?=system_showText(DEAL_DEALSDONE_PLURAL)?>:</strong> <?=$deal_sold;?></p>
					<? } else { ?>
						<p><strong><?=system_showText(DEAL_VALUE)?>:</strong> <?=$deal_real_value;?></p>
						<p><strong><?=system_showText(LANG_PROMOTION_PLURALWORD)." ".system_showText(DEAL_LEFTAMOUNT)?>:</strong> <?=$deal_left;?></p>
						<p><strong><?=system_showText(DEAL_DEALSDONE_PLURAL)?>:</strong> <label id="updateDeals"><?=$deal_sold;?></label></p>
					<? } ?>

					<div class="facebookConnect">
						<? 
						if (!$dealsDone) {
							if ($redeemLink) { ?>
								<div <?=$buttomClass;?>>
									<h2>
										<?
										$linkFBRedeem = "<a href=\"".$redeemLink."\" $promotionStyle>$buttonText</a>";
										?>
										<script language="javascript" type="text/javascript">
											//<![CDATA[
											document.write('<?=$linkFBRedeem?>');
											//]]>
										</script>
									</h2>
								</div>
							<? } ?>
							<p class="redeem-option">
								<a class="<?=$linkRedeemClass?>" href="<?=$redeemWFB;?>" <?=$promotionStyle?>><?=$linkText;?></a>
							</p>
						<? } ?>

						<? if ($_SESSION["ITEM_ACTION"] == "redeem" && $_SESSION["ITEM_TYPE"] && (is_numeric($_SESSION["ITEM_ID"]) && $_SESSION["ITEM_ID"] == htmlspecialchars($promotion->getNumber('id'))) && sess_isAccountLogged()) { ?>
							<a href="<?=$_SESSION["fb_deal_redirect"]? $_SESSION["fb_deal_redirect"]: $linkRedeem;?>" id="redeem_window" class="iframe fancy_window_redeem" style="display:none"></a>
                            <script type="text/javascript">
								//<![CDATA[                               
                                $("a.fancy_window_redeem").fancybox({
                                    'overlayShow'     : true,
                                    'overlayOpacity'  : 0.75,
                                    'width'           : <?=FANCYBOX_DEAL_WIDTH?>,
                                    'height'          : <?=FANCYBOX_DEAL_HEIGHT?>,
                                    'autoDimensions'  : false
                                });
                                
								jQuery(document).ready(function() {
                                    $("#redeem_window").trigger('click');
                                });
								//]]>
							</script>
							<? unset($_SESSION["ITEM_ACTION"], $_SESSION["ITEM_TYPE"], $_SESSION["ITEM_ID"], $_SESSION["ACCOUNT_REDIRECT"], $_SESSION["fb_deal_redirect"]);
						} ?>

					</div>

				</div>

			</div>

		</div>

		<? if ($deal_conditions) { ?>
			<h2><?=system_showText(LANG_LABEL_DEAL_CONDITIONS);?></h2>
			<p> <?=nl2br($deal_conditions);?></p>
		<? } ?>
		<? if ($deal_description) { ?>
			<h2><?=system_showText(LANG_LABEL_DESCRIPTION);?></h2>
			<p> <?=nl2br($deal_description);?></p>
		<? } ?>
	
    </div>

    <script language="javascript" type="text/javascript">
    //<![CDATA[
    function updateDeals(value){
        $("#updateDeals").text(value);
    }
    //]]>
    </script>