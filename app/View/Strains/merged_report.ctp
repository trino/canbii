<script src="<?php echo $this->webroot; ?>js/raty.js"></script>
<script src="<?php echo $this->webroot; ?>js/labs.js"></script>
<link href="<?php echo $this->webroot; ?>css/raty.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->webroot; ?>css/layout.css" rel="stylesheet" type="text/css" title="progress bar"/>
<script src="<?php echo $this->webroot; ?>js/bootstrap.min.js"></script>


<script src="<?php echo $this->webroot; ?>js/html2canvas.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.plugin.html2canvas.js"></script>

<style>
    .nowrap {
        overflow: auto;
        white-space: nowrap;
    }

    li {
        border 1px solid #111;
    }
    
    .page_header_left h1{
        white-space: pre-wrap;    
        white-space: -moz-pre-wrap;
        white-space: -pre-wrap;     
        white-space: -o-pre-wrap;    
        word-wrap: break-word;
    }
    
    .page_header_left .strain_info{
        white-space: pre-wrap;    
        white-space: -moz-pre-wrap;
        white-space: -pre-wrap;     
        white-space: -o-pre-wrap;    
        word-wrap: break-word;
    }
</style>

<?php

    echo "<Strain id='" . $strain['Strain']['id'] . "' />";
    function iif($value, $true, $false = "")
    {
        if ($value) {
            return $true;
        }
        return $false;
    }

    //http://localhost/metronic/templates/admin/ui_general.html
    //Acceptable colors:
    // Metronic: success (green), info (blue), warning (yellow), danger (red). Active does not work
    // Old: light-purple, light-red, light-blue, light-green
    function progressbar($webroot, $value, $textL = "", $textR = "", $color = "success", $color2 = "", $striped = false, $active = false, $min = 0, $max = 100)
    {
        if (false) {
            echo '<div class="left ratewrap"><img src="' . $webroot . 'images/bar_chart/' . $color2 . '.png" style="width: ';
            echo (round($value, 2) > 100) ? 100 : round($value, 2);
            echo '%;height:25px;position: absolute;left:0;"/><em>' . round($value / 20, 2);
            echo '/5</em></div><div class="clear"></div>';
        } else {
            if ($textL) {
                echo '<div style="float: right; padding-right: 4px;">' . $textL . '</div>';
            }
            echo '</div><div style="margin-bottom: 5px;" class="progress' . iif($striped, " progress-striped") . iif($active, " active") . '">';

            echo '<img src="' . $webroot . 'images/bar_chart/' . $color2 . '.png" style="width: ';
            echo (round($value, 2) > 100) ? 100 : round($value, 2);
            echo '%;height:20px;"/>';

            echo "</div>";
            return;
            echo '<div class="progress-bar progress-bar-';
            echo $color . '" role="progressbar" aria-valuenow="' . $value . '" aria-valuemin="' . $min . '" aria-valuemax="' . $max . '" style="';
            echo 'width: ' . round($value / ($max - $min) * 100) . '%"><span>' . $textR . '</span></div></div>';
        }

    }

    function perc($scale)
    {
        return round($scale / 20, 2) . "/5";
    }

?>




<div class="page_layout page_margin_top clearfix" style="">

    <div class="page_header clearfix" style="border-bottom: none;white-space: nowrap;">

        <div class="page_header_left" style="white-space: nowrap;">

            <?php
                $strain_hexagon = $strain;
                if (isset($s)){
            ?>
            <a href="<?php echo $this->webroot?>strains/<?php echo $s['Strain']['slug'];?>">

                <? }
                    include('combine/hexagon.php'); ?></a>

            <div style="white-space: nowrap;">
                <h1><?php echo $strain['Strain']['name']; ?> - Medical Report</h1>

                <br />
                <p class="strain_info"><?php
                        switch ($strain['Strain']['type_id']) {
                            case 1:
                                echo "Indica Cannabis: Best suited for night time use.";
                                break;
                            case 2:
                                echo "Sativa Cannabis: Best suited for day time use.";
                                break;
                            case 3:
                                echo "Hybrid Cannabis";
                                break;
                        }
                    ?>
                </p>
            </div>




            <!--li class="column_left" style="border: 1px solid #dadada;padding:0 10px;">
                <p>
                    <?php
                        switch ($strain['Strain']['type_id']) {
                            case 1:
                                echo "Indica Cannabis: Best suited for night time use.";
                                break;
                            case 2:
                                echo "Sativa Cannabis: Best suited for day time use.";
                                break;
                            case 3:
                                echo "Hybrid Cannabis: Suited for day or night time use.";
                                break;
                        }
                    ?>
                </p>


            </li-->




        </div>
        <div class="page_header_right">

         <?php if($this->Session->read('User.type')=='1' || ($this->Session->read('User.type')==2 &&$this->Session->read('User.strain')==$strain['Strain']['slug'])||!$this->Session->read('User')){?>
                <a class="dark_blue more" style="margin-right: 10px;margin-top:10px;"
                   href="<?php echo $this->webroot; ?>review/add/<?php echo $strain['Strain']['slug']; ?>">Review this
                    Strain</a>
                <?php }?>

            <a class="blue more" style="margin-top:10px;" href="javascript:void(0)" onclick="window.print();">Print this
                Report</a>
            <img height="50" alt="logo" style="margin-top:10px;display:none;" src="<?php echo $this->webroot;?>images/logo.png" class="toprint" />
            <!--<a style="" class="blue more" href="<?php echo $this->webroot;?>strains/generateImage/<?php echo $strain['Strain']['slug']; ?>">Print as Image</a>-->
            <!--a style="margin-left: 10px;margin-top:10px;"  class="dark_blue more" href="javascript:void(0)" onclick="save();">Save Report</a-->


        </div>

    </div>

    <!--php include('combine/profile_filter.php'); ?-->


    <div class="toprint ">
        <ul>
            <li>
                <p><?php echo strip_tags(html_entity_decode($strain['Strain']['description'])); ?>
                </p>
    
    
            </li>

        </ul>

    </div>

    <div class="clearfix"></div>

    <ul class="page_margin_top clearfix" style="margin-top: 7px!important;">


        <li class="footer_banner_box super_light_blue printer strain_banner"
            style="position: relative;padding: 0;width:300px;height:120px;">
            <img src="<?php echo $this->webroot ?>images/bg1.jpg"
                 style=" height: 100px;position: absolute;width: 300px;z-index: -1;"/>
            <center style="padding:20px 30px;color:#FFF;">
                <h2>Overall Rating</h2>

                <div class="rating"></div>
            </center>

        </li>
        <li class="footer_banner_box light_blue printer strain_banner"
            style="position: relative;padding: 0;width:300px;height:120px;">
            <img src="<?php echo $this->webroot ?>images/bg2.jpg"
                 style=" height: 100px;position: absolute;width: 300px;z-index: -1;"/>
            <center style="padding:20px 30px;color:#FFF;">
                <h2>Chemical Composition</h2>
                <?php
                    $chemical = 0;

                    function printchemical($chemical, $strain, $acronym, $wikipedia)
                    {
                        if ($strain['Strain'][strtolower($acronym)] != "0") {
                            $chemical++;
                            echo "<span class=' eff2' style='margin-right: 2px;border:1px solid white;padding:1px 3px;'><A target='new' href='" . $wikipedia . "'>" . strtoupper($acronym) . ":</A> " . $strain['Strain'][strtolower($acronym)] . "%</span>";
                        };
                        return $chemical;
                    }

                    $chemical = printchemical($chemical, $strain, "thc", "http://en.wikipedia.org/wiki/Tetrahydrocannabinol");
                    $chemical = printchemical($chemical, $strain, "cbd", "http://en.wikipedia.org/wiki/Cannabidiol");
                    $chemical = printchemical($chemical, $strain, "cbn", "http://en.wikipedia.org/wiki/Cannabinol");
                    $chemical = printchemical($chemical, $strain, "cbc", "http://en.wikipedia.org/wiki/Cannabichromene");
                    $chemical = printchemical($chemical, $strain, "thcv", "http://en.wikipedia.org/wiki/Tetrahydrocannabivarin");

                    if ($chemical == 0) {
                        echo "<span class=' eff2' style=''>Not enough data, check back soon</span>";
                    }
                ?>


            </center>

        </li>
        <li class="footer_banner_box blue printer strain_banner" style="position: relative;padding: 0;width:300px;height:120px;">
            <img src="<?php echo $this->webroot ?>images/bg3.jpg"
                 style=" height: 100px;position: absolute;width: 300px;z-index: -1;"/>

            <div style="color:#FFF;text-align:center;position: relative;width: 100%;">
                <!--h2>Dominant Flavors</h-->

                <table width="100%" align="center" height="100" style="margin-top: 6px;">
                    <TR>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <?php
                            //$flavor = null;
                            if ($flavor) {
                                foreach ($flavor as $f) {
                                    $name = $this->requestAction('/strains/getFlavor/' . $f['FlavorRating']['flavor_id']); //class used to have this in it
                                    ?>
                                    <TD style="padding-top: 0px;"><a class="glow Flavor"
                                                                     href="#"
                                                                     style="position:relative;margin-top:0px;">
                                            <CENTER><img width="55" class="glow"
                                                         src="<?= $this->webroot . "images/icons/" . strtolower($name); ?>.png">
                                            </CENTER>
                                            <CENTER><?= $name; ?></CENTER>
                                        </a></TD>
                                <?php
                                }
                            } else {
                                ?>
                                <TD style="text-align:center">
                                    <a href="<?php echo $this->webroot; ?>review/add/<?php echo $strain['Strain']['slug']; ?>"><i>No
                                            flavors yet. Review this
                                            strain </i><span style="font-size: 26px;padding-left:10px;"
                                                             class="fa fa-star-half-full"></span></a>
                                </TD>
                            <?php
                            }
                        ?>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

                    </TR>

                </table>
                <p style="color: #999;margin-top: -13px;padding-top: 0;">Reported Flavours</p>

            </div>

        </li>
    </ul>


    <div class="clearfix"></div>

    <!--h2 class="box_header page_margin_top slide clearfix" style="">Strain Attributes:

        <div style="float:right;"class="addthis_sharing_toolbox"></div>
        <div style="float:right;">
            Share
        </div>
    </h2-->


    <ul class="columns full_width clearfix page_margin_top">


        <li class="column_left">

            <div class="">

                <h3 class="box_header slide clearfix">Symptoms</h3>
                <p>How does this strain help with my medical condition?</p>
                <br>
                <?php
                    if (!isset($p_filter)) {
                        $p_filter = false;
                    }
                    //var_dump($arr_user);
                    if (!$p_filter) {
                        foreach ($strain['UserSymptomRating'] as $oer) {
                            
                            if(in_array($oer['user_id'],$arr_user))
                            $arrs[] = $oer['rating'] . '_' . $oer['symptom_id'];
                            
                        }
                    } else {
                        $symptom_rate = $this->requestAction('/strains/getSymptomRate2/' . urlencode($profile_filter) . '/' . $strain['Strain']['id']);
                        //var_dump($symptom_rate);
                        $cnt = 0;
                        $eff_id = 0;
                        $total_rate = 0;
                        foreach ($symptom_rate as $er) {
                            $cnt++;
                            if ($eff_id != $er['SymptomRating']['symptom_id']) {
                                if ($cnt != 1) {
                                    $tots = $total_rate;
                                    $total_rate = $er['SymptomRating']['rate'];
                                    $avg_rate = $tots / ($cnt - 1);
                                    $cnt = 0;
                                    $arrs[] = $avg_rate . '_' . $eff_id;
                                    $total_rate = 0;
                                } else {
                                    $total_rate = $er['SymptomRating']['rate'];
                                }
                            } else {
                                $total_rate = $total_rate + $er['SymptomRating']['rate'];
                            }
                            $eff_id = $er['SymptomRating']['symptom_id'];

                        }

                    }
                    if (isset($arrs))
                        rsort($arrs);
                    else
                        $arrs = array();
                    //var_dump($arr);
                    $i = 0;
                    if ($arrs) {
                    foreach ($arrs as $e) {
                    $ars = explode('_', $e);
                    $i++;
                    if ($i == 16)
                        break;
                    $rate = $ars[0];
                    $length = 20 * $rate;;
                ?>
                <div class="eff symps">
                    <div
                        class="label left"
                        style="position: relative; top: 50%; transform: translateY(20%);display: inline-block;
    margin-top: 9px;">
                        <span style="float: left;width:130px;display:inline-block"><?php echo $this->requestAction('/strains/getSymptom/' . $ars[1]); ?></span>

                        <?php progressbar($this->webroot, $length, perc($length), "", "info", "light-blue"); ?>
                        <div class="upvote" title="Was this helpful?">
                            <input type="hidden" class="vote_symp" value="<?php echo $ars[1]; ?>" />
                            <a class="upvote <?php if(isset($symptom_vote_user[$ars[1]])): echo (($symptom_vote_user[$ars[1]] == 1)?"upvote-on":""); endif; ?>"></a>
                            <span class="count"><?php echo (isset($symptom_votes[$ars[1]])?$symptom_votes[$ars[1]]:0); ?></span>
                            <a class="downvote <?php if(isset($symptom_vote_user[$ars[1]])): echo (($symptom_vote_user[$ars[1]] == -1)?"downvote-on":""); endif; ?>"></a>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                        }
                        } else {
                        ?>
                        <i> <a href="<?php echo $this->webroot; ?>review/add/<?php echo $strain['Strain']['slug']; ?>">
                                No ratings yet. Review this
                                strain <i style="font-size: 16px;padding-left:6px;"
                                          class="fa fa-star-half-full"></i></a></i>
                    <?php
                    }
                    ?>

                </div>


                <div class="clearfix"></div>





        </li>


        <li class="column_right">


            <div class="">

                <h3 class="box_header slide clearfix">General Ratings</h3>
                <p> What are the general ratings?</p>
                <br>
                
                <?php
                    if ($scale) {
                        //echo $scale;
                ?>

                <div class="eff">
                    <div class="label left" style="position: relative; top: 50%; transform: translateY(20%);width:244px;">Sedative
                        <?php progressbar($this->webroot, $scale, perc($scale), "", "warning", "light-purple"); ?>
                    </div>
                    <?php
                        }
                    ?>
                    <?php
                        if ($strength) {
                    ?>
                    <div class="eff aaloo">
                        <div class="label left" style="position: relative; top: 50%; transform: translateY(20%);width:244px;">
                            Strength
                            <?php progressbar($this->webroot, $strength, perc($strength), "", "warning", "light-purple"); ?>
                        </div>
                        <?php
                            }
                        ?>
                        <?php
                            if ($duration) {
                        ?>
                        <div class="eff">
                            <div class="label left" style="position: relative; top: 50%; transform: translateY(20%);width:244px;">
                                Duration
                                <?php progressbar($this->webroot, $duration, perc($duration), "", "warning", "light-purple"); ?>
                            </div>
                            <?php
                                }

                                if (!$duration && !$strength && !$scale) {
                                    ?>
                                    <i>
                                        <a href="<?php echo $this->webroot; ?>review/add/<?php echo $strain['Strain']['slug']; ?>">
                                            No ratings yet. Review this
                                            strain <i style="font-size: 16px;padding-left:6px;"
                                                      class="fa fa-star-half-full"></i></a></i>
                                <?php
                                }
                            ?>

                        </div>

                        <!--div class="">

                <h3>Effects:</h3>
                <br>

                <?php
                            $p_filter = 0;
                            if (isset($arr_filter)) {
                                foreach ($arr_filter as $filterwith) {
                                    if (isset($_GET[$filterwith])) {
                                        $p_filter = 1;
                                    }
                                }
                            }
                            if (!$p_filter) {
                                foreach ($strain['UserEffectRating'] as $oer) {
                                    if ($this->requestAction('/strains/getPosEff/' . $oer['effect_id'])){
                                        if(in_array($oer['user_id'],$arr_user))
                                        $arr[] = $oer['rating'] . '_' . $oer['effect_id'];
                                        }
                                    else{
                                        if(in_array($oer['user_id'],$arr_user))
                                        $arr_neg[] = $oer['rating'] . '_' . $oer['effect_id'];
                                        }
                                }
                                //var_dump($arr_neg);
                            } else {
                                var_dump($arr_neg);
                                $effect_rate = $this->requestAction('/strains/getEffectRate/' . urlencode($profile_filter) . '/' . $strain['Strain']['id']);
                                //var_dump($effect_rate);
                                $cnt = 0;
                                $eff_id = 0;
                                $total_rate = 0;
                                foreach ($effect_rate as $er) {

                                    $cnt++;
                                    if ($eff_id != $er['Effect_rating']['effect_id']) {

                                        if ($cnt != 1) {
                                            $tots = $total_rate;
                                            $total_rate = $er['Effect_rating']['rate'];

                                            $avg_rate = $tots / ($cnt - 1);
                                            $cnt = 0;
                                            if ($this->requestAction('/strains/getPosEff/' . $er['Effect_rating']['effect_id']))
                                                $arr[] = $avg_rate . '_' . $eff_id;
                                            else
                                                $arr_neg[] = $avg_rate . '_' . $eff_id;
                                            $total_rate = 0;
                                        } else {
                                            $total_rate = $er['Effect_rating']['rate'];
                                        }

                                    } else {
                                        $total_rate = $total_rate + $er['Effect_rating']['rate'];
                                    }
                                    $eff_id = $er['Effect_rating']['effect_id'];

                                }

                                //die('here');
                            }
                            //die('there');
                            if (isset($arr))
                                rsort($arr);
                            else
                                $arr = array();
                            $i = 0;
                            if ($arr) {
                                foreach ($arr as $e) {
                                    $ar = explode('_', $e);
                                    $i++;
                                    if ($i == 6)
                                        break;
                                    $rate = $ar[0];
                                    $length = 20 * $rate;;
                                    ?>
                <div class="eff">
                    <div class="label left"
                         style="position: relative; top: 50%; transform: translateY(20%);"><?php echo $this->requestAction('/strains/getEffect/' . $ar[1]); ?>
                        <?php progressbar($this->webroot, $length, perc($length), "", "success", "light-green"); ?>


                    </div>
                    <?php
                                }
                            } else {
                                ?>


                        <i>  <a href="<?php echo $this->webroot; ?>review/add/<?php echo $strain['Strain']['slug']; ?>"> No ratings yet. Review this
                                strain <i style="font-size: 16px;padding-left:6px;"
                                          class="fa fa-star-half-full"></i></a></i>

                    <?php
                            }
                        ?>
                </div-->


                        <div class=""><br><br>
                            <h3 class="box_header slide clearfix">Negative Effects</h3>
                            <p>What are the negative effects?</p>
                            <br>
                            <?php
                            //var_dump($oer['UserEffectRating']['user_id']);
                                if (isset($arr_neg))
                                    rsort($arr_neg);
                                else
                                    $arr_neg = array();
                                $i = 0;
                                if ($arr_neg) {
                                foreach ($arr_neg as $e) {
                                $ar = explode('_', $e);
                                $i++;
                                if ($i == 6)
                                    break;
                                $rate = $ar[0];
                                $length = 20 * $rate;
                            ?>
                            <div class="eff">
                                <div
                                    class="label left"
                                    style="position: relative; top: 50%; transform: translateY(20%);width:244px;">
                                    <span style="float: left;width:185px;display:inline-block"><?php echo $this->requestAction('/strains/getEffect/' . $ar[1]); ?></span>
                                    <?php progressbar($this->webroot, $length, perc($length), "", "danger", "light-red"); ?>
                                </div>
                                <?php
                                    }
                                    } else {
                                    ?>
                                    <i> <a href="<?php echo $this->webroot; ?>review/add/<?php echo $strain['Strain']['slug']; ?>">
                                            No ratings yet. Review this
                                            strain <i style="font-size: 16px;padding-left:6px;"
                                                      class="fa fa-star-half-full"></i></a></i>
                                <?php
                                }
                                ?>
                            </div>





        </li>


    </ul>


    <div class="clearfix page_margin_top" style="border-bottom: 1px solid #dadada;"></div>


    <ul class="columns full_width page_margin_top  clearfix ">


        <li class="column_left">
            <h3 class="box_header slide clearfix" style="float:left:width:40%;"> Most Helpful User Review

            </h3>

            <!--h2 class="box_header slide clearfix" style="">Dominant Color(s)</h2>

            <div style="width:50%;margin:0 auto;" class="print printer">
                <?php
                $c = $this->requestAction('/strains/getcolors/' . $strain['Strain']['id']);
                foreach ($c as $col) {
                    if ($col['ReviewColor']['color'] != "") {
                        ?>

                            <div class="print printer" style="  display: inline-block;
                                float:left;width: 25px; height: 25px;padding:0;margin:0;clear:none;background:<?php echo $col['ReviewColor']['color']; ?>;">
                                &nbsp;</div>
                        <?php
                    }
                }
            ?>
            </div-->


            <?php include_once('combine/strain_reviews.php'); ?>

            <script type="text/javascript">
                $(document).ready(function () {
                    $(".fancybox").fancybox();
                });
            </script>

            <div class="clear"></div>



            <?php

                if ($helpful) {

                    ?>

                <?php

                }


            ?>
            <a
                href="<?php echo $this->webroot; ?>strains/review/<?php echo $strain['Strain']['slug']; ?>"
                class="viewall more blue noprint" style="float:right;font-size:12px;">See All Reviews
                for <?php echo $strain['Strain']['name']; ?> &raquo;</a>



            <div style="clear:both;padding: 5px 0px;">

            </div>


<div class="noprint" style="border-top: 1px solid #dadada;">
            <h3 class=" box_header slide clearfix page_margin_top">Print this Report</h3>

            <p class="">Spread the word! The more we know, the more we can help.</p>


            <ul class="columns full_width page_margin_top clearfix">

                <li class="column_left">

                    <a style="" class="" href="javascript:void(0)" onclick="window.print();">
                        <img class="" src="<?php echo $this->webroot ?>images/print_report_small.jpg"
                             style="width:140px;border:1px solid #efefef"/>

                    </a>

                </li>
                <li class="column_right">

                    <!--<a style="" class="blue more" href="<?php echo $this->webroot;?>strain/generateImage/<?php echo $strain['Strain']['slug']; ?>">Print as Image</a>-->
                    <a style="" class="blue more" href="javascript:void(0)" onclick="window.print();">Print this Report</a>
                    <?php if($this->Session->read('User.type')=='1' || ($this->Session->read('User.type')==2 &&$this->Session->read('User.strain')==$strain['Strain']['slug'])||!$this->Session->read('User')){?>
                    <a class="dark_blue more" style="margin-right: 10px;margin-top:10px;"
                       href="<?php echo $this->webroot; ?>review/add/<?php echo $strain['Strain']['slug']; ?>">Review this
                        Strain</a>
                    <?php }?>

                    <div style="clear:both;"></div>
                    <h3 class="" style="margin-top: 10px;">Share with care</h3>

                    <div style="" class="addthis_sharing_toolbox"></div>


                </li>


            </ul>

</div>


        </li>


        <li class="column_right">


            <h3 class="box_header slide clearfix"
                style=""><?php echo $strain['Strain']['name']; ?> Images</h3>


            <!--table>
                <tr>
                    <?
                $breaker = 0;
                for ($i = 1; $i < 5; $i++) {
                    $image = "images/strains/" . $strain['Strain']['id'] . "/" . $strain['Strain']['slug'] . "_" . $i . ".jpg";
                    $filename = getcwd() . "/" . $image; //C:\wamp\www\marijuana\app\webroot
                    $image = $this->webroot . $image;
                    if (!file_exists($filename) && file_exists(str_replace(".jpg", ".jpeg", $filename))) {
                        $image = str_replace(".jpg", ".jpeg", $image);
                        $filename = str_replace(".jpg", ".jpeg", $filename);
                    }
                    if (file_exists($filename)) {
                        $breaker++;

                        ?>


                            <?
                        if ($breaker == 2) {
                            echo "</tr><tr>";
                        }
                    }
                } ?>
                </tr>
            </table-->

            <?php include('combine/images.php'); ?>


        </li>
    </ul>




    <ul class="columns full_width page_margin_top clearfix">


        <li class="column_left">


        </li>
        <li class="column_right">



        </li>


    </ul>




</div>

<div class="invite noprint" style="display: none; margin-top:10px">
    <center>
        <form action="<?php echo $this->webroot; ?>pages/send_email" method="post">
            <input type="hidden" name="slug" value="<?php echo $strain['Strain']['slug']; ?>"/>
            <label for="email">Email Address (Use ',' for multiple recipents)</label><br/>
            <textarea name="email" id="email"></textarea><br/>
            <input type="submit" name="send" value="Send"/>
        </form>
    </center>
</div>

</div>


<style>

    @media print {
        .eff.symps{margin-bottom:0px!important;}
        .page_layout{border:2px solid #e5e5e5;padding:10px}
        .strain_banner{width:320px!important;}
        li.column_left{width:464px!important;}
        li.column_right{width:464px!important;}
        .header_container {
            display: none;
            margin-left: auto;
            margin-right: auto;
        }

        .footer_container {
            display: none;
        }

        .cake-sql-log {
            display: none;
        }

        .footer_banner_box_container {
            display: none;
        }

        .print {
            display: none
        }
    }

</style>
<script>
    function takeScreenShot() {
        html2canvas(window.parent.document.body, {
            onrendered: function (canvas) {
                var cand = document.getElementsByTagName('canvas');
                if (cand[0] === undefined || cand[0] === null) {

                } else {
                    //cand[0].remove();
                    document.body.removeChild(cand[0]);
                }
                document.body.appendChild(canvas);
            }
        });
    }

    function postImage() {
        var cand = document.getElementsByTagName('canvas');
        var canvasData = cand[0].toDataURL("image/png");
        var ajax = new XMLHttpRequest();
        ajax.open("POST", '/pr/custom/testSave.php', false);
        ajax.setRequestHeader('Content-Type', 'application/upload');
        ajax.send(canvasData);
        alert('done');
    }


    function save() {
        Rectangle
        screenRect = new Rectangle(Toolkit.getDefaultToolkit().getScreenSize());
        BufferedImage
        capture = new Robot().createScreenCapture(screenRect);
        ImageIO.write(capture, "bmp", new File(args[0]));

        //$('#target').html2canvas({
        //    onrendered: function (canvas) {

        //Set hidden field's value to image data (base-64 string)
        //$('#img_val').val(canvas.toDataURL("image/png"));
        //Submit the form manually
        //document.getElementById("myForm").submit();
        //   }
        //});
    }
</script>
<script>
    
    
    $(function () {
        
        var makeVote =function(data){
            symp = data.id;
            
            up= data.upvoted;
            down= data.downvoted;
            console.log(up);
            
            setZero = true;
            
            $.each(data.classList,function(i,e){
                if (e.className.indexOf('downvote-on') != -1 || e.className.indexOf('upvote-on') != -1) {
                    setZero = false;
                    
                    if (e.className.indexOf('downvote-on') != -1) {
                        down = true;
                        up = 0;
                    }
                    else if (e.className.indexOf('upvote-on') != -1) {
                        up = true;
                        down = 0;
                    }
                }
            });
            
            if (setZero) {
                up = 0;
                down = 0;
            }
            console.log(up);
            //
            //if (access == true) {
            $.ajax({
                type: "POST",
                url: "<?php echo Router::url(array('controller' => 'symptomvote', 'action' => 'sendVote'));?>/<?php echo $strain['Strain']['id'] ?>/"+symp,
                data: {up: up, down: down},
                success:function(response){
                    console.log(response);
                }
            });
            
            //}
        };
        $('div.upvote').each(function(i,e){
            $(this).upvote({ele:$(this),classList:$(this).find("a"),id:$(this).find(".vote_symp").val(),callback:makeVote});
        })
        
        //$(".upvote a.upvote").click(function(){
        //    makeVote($(this),1);
        //});
        //$(".upvote a.downvote").click(function(){
        //    makeVote($(this),0);            
        //});
        <?php
        if(!$p_filter)
        {
            ?>
        $('.rating').raty({number: 5, readOnly: true, score:<?php echo $avg;?>});
        <?php
    }
    else
    {
        $effect_reviews = $this->requestAction('/strains/getEffectReview/'.urlencode($profile_filter).'/'.$strain['Strain']['id']);
        $count_rate=0;
        $rate = 0;
        foreach($effect_reviews as $oar)
        {
            if($oar['Review']['rate']==0)
            continue;
            else
            $count_rate++;
            $rate = $rate+$oar['Review']['rate'];

        }
        if($count_rate==0)
        {
            $rate = 0;
        }
        else
        $rate = $rate/$count_rate;

        $rate = number_format($rate,2);
        ?>
        $('.rating').raty({number: 5, readOnly: true, score:<?php echo $rate;?>});
        <?php
    }
    ?>


        <?php if($helpful){?>
        $('.frate').raty({readOnly: true, score:<?php echo $helpful['Review']['rate'];?>});
        $('.srate').raty({readOnly: true, score:<?php echo $recent['Review']['rate'];?>});
        <?php }?>
        $('.emotion').text('<?php echo ($strain['Strain']['rating']).'/5';?> ');
        var check = 0;
        $('.yes').click(function () {
            if (check == 0) {
                check++;
                var id = $(this).attr('id');
                var arr = id.split('_');
                var r_id = arr[1];
                $.ajax({
                    url: '<?php echo $this->webroot;?>strains/helpful/' + r_id + '/yes',
                });
//$('#'+arr[0]+'_'+r_id).removeClass('yes');
                $('#' + arr[0] + '_' + r_id).attr('style', 'background:#FFF;color:#CCC;cursor: default;');
//$('#'+arr[0]+'_'+r_id).attr('onclick','return false;');
                var o = parseFloat(arr[0]) + 1;
//$('#'+o+'_'+r_id).removeClass('no');
                $('#' + o + '_' + r_id).attr('style', 'background:#FFF;cursor: default;display:inline-block;padding:4px 7px;');
                $('#' + o + '_' + r_id + ' strong').attr('style', 'color:#eee');
                $//('#'+o+'_'+r_id).attr('onclick','return false;');
                $(this).attr('style', $(this).attr('style').replace('background:#FFF;', 'background:#e5e5e5;display:inline-block;padding:4px 7px;'));
            }
        });
        $('.no').click(function () {
            if (check == 0) {
                check++;
                var id = $(this).attr('id');

                var arr2 = id.split('_');
                var num = parseFloat(arr2[0]) - 1;
                var r_id = arr2[1];
                $.ajax({
                    url: '<?php echo $this->webroot;?>strains/helpful/' + r_id + '/no',
                });
                $('#' + arr2[0] + '_' + r_id).removeClass('yes');
                var o = parseFloat(arr2[0]) + 1;
//$('#'+o+'_'+r_id).removeClass('no');
                $('#' + num + '_' + r_id).attr('style', 'background:#FFF;color:#CCC;cursor: default;display:inline-block;padding:4px 7px;')
                $('#' + num + '_' + r_id + ' strong').attr('style', 'color:#CCC;')
//$('#'+arr2[0]+'_'+r_id).attr('onclick','return false;');
                $('#' + o + '_' + r_id).attr('style', 'background:#FFF;color:#CCC;cursor: default;');
//$('#'+o+'_'+r_id).attr('onclick','return false;');
                $(this).attr('style', 'padding-left:10px; padding-right:10px; padding-top: 5px; padding-bottom: 5px; margin-right:5px;background:#e5e5e5;cursor:default;');
            }
        });
    });
</script>


<style>
.page_header{padding-bottom:10px!important;}
    
    .eff .left {
        position: relative;
    }

    .eff em {
        z-index: 10000;
        text-align: center;
        position: relative;
        top: 6px;
    }

    em {
        letter-spacing: 2px;
        font-style: normal;
    }

    .ratewrap {
        width: 63%;
        /*background: #fff;*/
        text-align: center;
        height: 25px;
    }

    .length {
        padding-top: 25px;
        background: #42B3E5;
        position: absolute;
        top: 0;
    }

    @media print {
        .page_layout{font-size:24px!important;}
        .page_header_right a{display:none;}
        .toprint{display: block!important;}
        .noprint {
            display: none;
        }

        .printer {
            color: #FFF;
            text-shadow: 0 0 0 #ccc;
        }

        @media print and (-webkit-min-device-pixel-ratio: 0) {
            .printer {
                color: #FFF;
                -webkit-print-color-adjust: exact;
            }
        }
    }
</style>