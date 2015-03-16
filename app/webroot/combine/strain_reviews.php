<?php

    if ($helpful) {


?>


        <div class="comments clearfix page_margin_top">
            <div id="comments_list">
                <ul>

                    <li class="comment clearfix">
                        <div class="comment_author_avatar">&nbsp;</div>

                        <div class="comment_details">

<?
                            $strain_hexagon = $strain;
                            include('combine/hexagon.php');
?>

                            <h3><?php echo $helpful['Strain']['name'];?></h3>
                            <?
                                $j = 0;
                            ?>

                            <script>
                                $(function () {
                                    $('.rating<?php echo $j;?>').raty({
                                        number: 5,
                                        readOnly: true,
                                        score:<?php echo $helpful['Review']['rate'];?>
                                    });
                                });
                            </script>


                            <div class="rating<?php echo $j;?> rat" style=""></div>

                            <p>

                                <?php echo substr( $helpful['Review']['review'], 0, 270) . '...'; ?>


                            </p>
                            <div class="posted_by">
                                Reviewed by <a class="author"
                                               href="<?php echo $this->webroot;?>strains/review/all?user=<?php echo $helpful['Review']['user_id'];?>"
                                               title="<?php echo $this->requestAction('/strains/getUserName/' . $helpful['Review']['user_id']);?>"><?php echo $this->requestAction('/strains/getUserName/' . $helpful['Review']['user_id']);?></a>
                                on <?php echo $helpful['Review']['on_date'];?>
                            </div>

                            <?php
                                $rand1 = rand(100, 999);
                                $rand2 = rand(100, 999);
                            ?>

                                 </div>



                    </li>


                </ul>


            </div>

        </div>


    <?php } else {
        ?>
        <div style="padding-top: 10px;">
        <i style="">No reviews yet</i>
        </div>
    <?php
    }
?>