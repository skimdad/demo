<?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    setting_get("review_manditory", $review_manditory);
    setting_get("review_approve", $review_approve);
    $allowed = TRUE;
    $item_type = 'listing';
    $item_id = $listing->id;

    if (!$_POST["rating"]) {
        $message_review = system_showText(LANG_MSG_REVIEW_SELECTRATING);
        $allowed = false;
    } elseif ($_POST["rating"] > 5) {
        $message_review = system_showText(LANG_MSG_REVIEW_FRAUD_SELECTRATING);
        $allowed = false;
    } elseif (!trim($_POST["review"]) || !trim($_POST["review_title"])) {
        $message_review = system_showText(LANG_MSG_REVIEW_COMMENTREQUIRED);
        $allowed = false;
    }
    if ($review_manditory == "on") {
        if (!trim($_POST["reviewer_name"]) || !trim($_POST["reviewer_email"])) {
            $message_review = system_showText(LANG_MSG_REVIEW_NAMEEMAILREQUIRED);
            $allowed = false;
        }
    }

    if ($_POST["reviewer_email"] && !validate_email($_POST["reviewer_email"])) {
        $message_review = system_showText(LANG_MSG_REVIEW_TYPEVALIDEMAIL);
        $allowed = false;
    }

    $reviewObj = new Review();
    $denied_ips = $reviewObj->getDeniedIpsByItem($item_type, $item_id);
    if ($denied_ips) {
        foreach ($denied_ips as $each_ip) {
            if ($_SERVER["REMOTE_ADDR"] == $each_ip) {
                $message_review = system_showText(LANG_MSG_REVIEW_YOUALREADYGIVENOPINION);
                $allowed = false;
            }
        }
    }

    if ($allowed) {

        $newReview = new Review();
        $newReview->ip = $_SERVER["REMOTE_ADDR"];
        $newReview->item_type = $item_type;
        $newReview->item_id = $item_id;
        $newReview->member_id = sess_getAccountIdFromSession();
        $newReview->review_title = $_POST['review_title'];
        $newReview->review = $_POST['review'];
        $newReview->rating = $_POST['rating'];
        $newReview->reviewer_email = $_POST['reviewer_email'];
        $newReview->reviewer_name = $_POST['reviewer_name'];
        if ($review_approve != "on") {
            $newReview->setNumber("approved", 1);
        }
        $newReview->Save();
        $success_msg = 'Thanks for your review, it\'s wating to be approved.';
        if ($review_approve != "on") {
            $success_msg = 'Thanks for your review.';
            $avg = $reviewObj->getRateAvgByItem($item_type, $item_id);
            if (!is_numeric($avg))
                $avg = 0;
            if ($item_type == 'listing') {
                $listing = new Listing();
                $listing->setAvgReview($avg, $item_id);
            } else if ($item_type == 'promotion') {
                $promotion = new Promotion();
                $promotion->setAvgReview($avg, $item_id);
            } else {
                $articles = new Article();
                $articles->setAvgReview($avg, $item_id);
            }
        }
    }
}
?>

<?
$reviews = new Review();
$reviewsObj = $reviews->getReviewsByItem('listing', $listing->id);
$currentUserId = sess_getAccountIdFromSession();
$reviewLoginLink = $mobile_base_url . 'index.php/' . $listing->id . '/login?redirecturl=' . DEFAULT_URL . $_SERVER['REQUEST_URI'];
$currentUser = new AccountProfileContact(SELECTED_DOMAIN_ID, $currentUserId);
$currentUserImgTag = socialnetwork_writeLink($currentUserId, "profile", "general_see_profile", $currentUser->image_id, false, false);
$currentUserImgTag = trim($currentUserImgTag);
if (empty($currentUserImgTag))
    $currentUserImgTag = "<span class=\"no-image no-link\"></span>";
?>

<?
if (mysql_num_rows($reviewsObj) > 0):
    while ($row = mysql_fetch_array($reviewsObj)):
        $member = new AccountProfileContact(SELECTED_DOMAIN_ID, $row['member_id']);

        $imgTag = socialnetwork_writeLink($row["member_id"], "profile", "general_see_profile", $member->image_id, false, false);
        $imgTag = trim($imgTag);
        if (empty($imgTag))
            $imgTag = "<span class=\"no-image no-link\"></span>";

        if ($row['rating']) {
            unset($rate_stars);
            for ($x = 0; $x < 5; $x++) {
                if ($row['rating'] > $x)
                    $rate_stars .= "<img src=\"" . DEFAULT_URL . "/images/img_rateMiniStarOn.png\" alt=\"Star On\" align=\"bottom\" />";
                else
                    $rate_stars .= "<img src=\"" . DEFAULT_URL . "/images/img_rateMiniStarOff.png\" alt=\"Star Off\" align=\"bottom\" />";
            }
        }
        ?>

        <div data-role="content" style="padding: 15px;">
            <div class="txt_block">
                <div data-role="content" style="padding: 0px;">
                    <div  style="float: left">
                        <?= $imgTag ?>
                    </div>
                    <h3 class="ui-li-heading" style=" text-shadow:none;  width:80%; margin:0px; padding-left:1.5%"><?= $row['review_title']; ?></h3>
                    <div style=" width:80%; margin:0px; padding-left:1.5%;float:left"><?= $rate_stars ?></div>
                    <p style=" white-space:normal; margin-top:2px;text-shadow:none;width:85%; padding-left:1.5%" class="ui-li-desc">
                        <em><?= $row['added']; ?> </em><br/>
                        <strong><?= $row['reviewer_name']; ?></strong><br />
                        <strong><?= $row['reviewer_location']; ?></strong>
                    </p>
                </div>
                <p class="ui-li-desc review" style="width: 100%;float:none;border:0 none">
                    <?= $row['review'] ?>
                </p>
            </div>
        </div>

    <? endwhile; ?>

<? else: ?>
    <div data-role="content" style="padding: 15px;">
        <? showErrorMsg($mobileAppObj->reviews_no_data); ?> 
    </div>
<? endif; ?> 

<div data-role="content" style="padding: 15px;">

    <? if (!$currentUserId): ?>
        <p class="redeem-option" style="text-align:right" >
            <a style="width: 100%" data-role="button" data-transition="fade" data-theme="c" href="<?= $reviewLoginLink ?>" class="ui-btn-left">
                Login to Review
            </a>
        </p>
    <? else: ?>
        <script language="javascript">
            function setDisplayRatingLevel(level) {
                for(i = 1; i <= 5; i++) {
                    var starImg = "img_rate_star_off.gif";
                    if( i <= level ) {
                        starImg = "img_rate_star_on.gif";
                    }
                    var imgName = 'star'+i;
                    document.images[imgName].src="<?= DEFAULT_URL ?>/images/content/"+starImg;
                }
            }
            function resetRatingLevel() {
                setDisplayRatingLevel(document.rate_form.rating.value);
            }
            function setRatingLevel(level) {
                document.rate_form.rating.value = level;
            }
            $('img[name=star]').bind('click', function(){
                $(this).fadeOut(50);
                $(this).fadeIn(50);
            });
        </script>
        <form method="POST" action="<?= $_SERVER['REQUEST_URI']; ?>" name="rate_form" id="rate_form">
            <?= $currentUserImgTag; ?><br />
            <div class="rate">
                <input type="hidden" name="rating" id="rating" value="<?= $rating ?>" />
                <? if ($rating_stars == "") { ?>
                    <img style="cursor:pointer" src="<?= DEFAULT_URL ?>/images/content/img_rate_star_off.gif" alt="star" onclick="setRatingLevel(1)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(1)" name="star1" />
                    <img style="cursor:pointer" src="<?= DEFAULT_URL ?>/images/content/img_rate_star_off.gif" alt="star" onclick="setRatingLevel(2)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(2)" name="star2" />
                    <img style="cursor:pointer" src="<?= DEFAULT_URL ?>/images/content/img_rate_star_off.gif" alt="star" onclick="setRatingLevel(3)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(3)" name="star3" />
                    <img style="cursor:pointer" src="<?= DEFAULT_URL ?>/images/content/img_rate_star_off.gif" alt="star" onclick="setRatingLevel(4)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(4)" name="star4" />
                    <img style="cursor:pointer" src="<?= DEFAULT_URL ?>/images/content/img_rate_star_off.gif" alt="star" onclick="setRatingLevel(5)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(5)" name="star5" />
                    <?
                } else {
                    echo $rating_stars;
                }
                ?>
            </div>

            <div data-role="fieldcontain">
                <fieldset data-role="controlgroup">

                    <input name="reviewer_name" id="reviewer_name" placeholder="Name" value="" style="width: 100%" required>
                </fieldset>
            </div>
            <div data-role="fieldcontain">
                <fieldset data-role="controlgroup">

                    <input name="reviewer_email" id="reviewer_email" placeholder="E-mail" value="" style="width: 100%" type="email" required>
                </fieldset>
            </div>
            <div data-role="fieldcontain">
                <fieldset data-role="controlgroup">

                    <input name="review_title" id="review_title" placeholder="Title" value="" style="width: 100%" required>
                </fieldset>
            </div>
            <div data-role="fieldcontain">
                <fieldset data-role="controlgroup">

                    <textarea name="review" id="review" placeholder="Comment" value="" style="width: 100%" required>
                    </textarea> 
                </fieldset>
            </div>   
            <input value="Post" type="submit" style="width: 98%">
        </form>  
        <? if (isset($message_review)): ?>
            <div class="txt_block txt_center">
                <?= $message_review ?>
            </div>
        <? endif; ?>
        <? if (isset($success_msg)): ?>
            <script>   
                alert("<?= $success_msg ?>");
            </script>
        <? endif; ?>

    <? endif; ?>
</div>


