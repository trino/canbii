<div class="page_left">
    <?php
    if(isset($reviewid)) {
        echo "DELETE review ID: " . $reviewid;
    }
    ?>


    <div class="comments clearfix page_margin_top">
        <div id="comments_list">
            <?php if (count($reviews) > 0) { ?>
                <ul>
                    <?php
                    $j = 0;
                    $id=-1;
                    if (isset($_GET["delete"])) { $id =  $_GET["delete"];}
                    foreach ($reviews as $review) {
                        //debug($review['Strain']);
                        if ($review['Strain']["id"] != $id) {
                            $j++;?>

                        <li class="comment clearfix">
                            <div class="comment_author_avatar">
                                &nbsp;
                            </div>

                            <div class="comment_details">
                                <div class="posted_by">
                                    Reviewed by <a class="author"
                                                   href="<?php echo $this->webroot; ?>strains/review/all?user=<?php echo $review['Review']['user_id']; ?>"
                                                   title="<?php echo $this->requestAction('/strains/getUserName/' . $review['Review']['user_id']); ?>"><?php echo $this->requestAction('/strains/getUserName/' . $review['Review']['user_id']); ?></a>
                                    on <?php echo $review['Review']['on_date']; ?>
                                </div>

                                <h3><?php echo $review['Strain']['name']; ?></h3>

                                <div class="rating<?php echo $j; ?> rat" style=""></div>
                                <script>
                                    $(function () {
                                        $('.rating<?php echo $j;?>').raty({
                                            number: 5,
                                            readOnly: true,
                                            score:<?php echo $review['Review']['rate'];?>
                                        });
                                    });
                                </script>
                                <p>
                                    <?php echo $review['Review']['review']; ?>
                                </p>
                                <a class="more reply_button" href="#comment_form">
                                    <a href="<?php echo $this->webroot; ?>review/detail/<?php echo $review['Review']['id']; ?>" class="more blue">View Detail →</a>
                                    <!--A href="<!= $this->webroot . "review/add/" . $review['Strain']['slug'] . "?review=" . $review['Review']['id']; ?>" class="more dark_blue" style="margin-left: 10px;">Edit</A-->
                                    <a href="<?php echo $this->webroot;?>review/all?delete=<?php echo $review['Review']['strain_id'];?>" onclick="return confirm('Are you sure you want to delete your review for <?= $review['Strain']['name'] ?>?');" class="more red">Delete</a>
                                </a>
                            </div>
                        </li>
                    <?php } } ?>
                </ul>
                <div class="clear"></div>
                <div class="morelist" style="display: none;"></div>
            <?php

            if ($reviewz && $reviewz > 1){
            ?>
                <div class="loadmore"><a href="javascript:void(0);">Load More</a></div>
            <?php } ?>
                <script>
                    $(function () {
                        var j = 0;
                        $('.comment').each(function () {
                            j++;
                        })
                        if (j ==<?php echo ($reviewz);?>)
                            $('.loadmore').hide();
                        var m = 0
                        $('.loadmore').each(function () {
                            m++;
                            if (m != 1) {
                                $(this).remove();
                            }
                        });
                    });
                </script>
            <?php
            }
            if (count($reviews) == 0 or  (count($reviews) ==1 and isset($_GET["delete"]))) {
                echo '<a href="' . $this->webroot .  'review/">';
                echo "No reviews yet. Feel free to add one </a>";
            }?>
        </div>
    </div>

</div>