<script src="<?php echo $this->webroot; ?>js/raty.js"></script>
<script src="<?php echo $this->webroot; ?>js/labs.js"></script>
<link href="<?php echo $this->webroot; ?>css/raty.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->webroot; ?>css/layout.css" rel="stylesheet" type="text/css" title="progress bar"/>
<script src="<?php echo $this->webroot; ?>js/bootstrap.min.js"></script>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="<?php echo $this->webroot; ?>js/html2canvas.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.plugin.html2canvas.js"></script>

<style>
    .nowrap {
        overflow: auto;
        white-space: nowrap;
    }
</style>

<?php
function iif($value, $true, $false=""){
    if ($value) { return $true; }
    return $false;
}

//http://localhost/metronic/templates/admin/ui_general.html
//Acceptable colors:
// Metronic: success (green), info (blue), warning (yellow), danger (red). Active does not work
// Old: light-purple, light-red, light-blue, light-green
function progressbar($webroot, $value, $textL="", $textR="", $color = "success", $color2="", $striped=false, $active=false, $min = 0, $max=100){
    if (false){
        echo '<div class="left ratewrap"><img src="' . $webroot . 'images/bar_chart/' . $color2 . '.png" style="width: ';
        echo (round($value, 2) > 100) ? 100 : round($value, 2);
        echo '%;height:25px;position: absolute;left:0;"/><em>' . round($value / 20, 2);
        echo '/5</em></div><div class="clear"></div>';
    } else {
        if ($textL) {echo '<div style="float: right; padding-right: 4px;">' . $textL . '</div>';}
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
function perc($scale){
    return round($scale/20,2) . "/5";
}
?>




<div class="page_layout page_margin_top clearfix">
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
                <h1 class=""><?php echo $strain['Strain']['name']; ?> - Medical Report</h1>


                <p style="white-space: nowrap;">
                    <?php
                        switch ($strain['Strain']['type_id']) {
                            case 1:
                                echo "Indica";
                                break;
                            case 2:
                                echo "Sativa";
                                break;
                            case 3:
                                echo "Hybrid";
                                break;
                        }
                    ?> Cannabis
                </p>
            </div>


        </div>
        <div class="page_header_right noprint">




            <a class="dark_blue more" style="margin-right: 10px;margin-top:10px;"
               href="<?php echo $this->webroot; ?>review/add/<?php echo $strain['Strain']['slug']; ?>">Review Strain</a>
            <a class="blue more" style="margin-top:10px;" href="javascript:void(0)" onclick="window.print();">Print Report</a>
            <!--a style="margin-left: 10px;margin-top:10px;"  class="dark_blue more" href="javascript:void(0)" onclick="save();">Save Report</a-->



        </div>

    </div>

    <!--php include('combine/profile_filter.php'); ?-->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53333c8154cd758d"
            async="async"></script>

    <div class="toprint ">
        <ul id="" class="clearfix">
            <li id="text_in_li">
                <p><?php echo strip_tags($strain['Strain']['description']); ?></p>



            </li>


        </ul>


    </div>

    <div class="clearfix"></div>

    <ul class="page_margin_top clearfix">


        <li class="footer_banner_box super_light_blue printer"
            style="position: relative;padding: 0;width:330px;height:100px;">
            <img src="<?php echo $this->webroot ?>images/bg1.jpg"
                 style=" height: 100px;position: absolute;width: 330px;z-index: -1;"/>
            <center style="padding:20px 30px;color:#FFF;">
                <h2>Overall Rating</h2>

                <div class="rating"></div>
            </center>

        </li>
        <li class="footer_banner_box light_blue printer"
            style="position: relative;padding: 0;width:330px;height:100px;">
            <img src="<?php echo $this->webroot ?>images/bg2.jpg"
                 style=" height: 100px;position: absolute;width: 330px;z-index: -1;"/>
            <center style="padding:20px 30px;color:#FFF;">
                <h2>Chemical Composition</h2>
                <font style="font-size:14px;" color="white">
                    THC:
                    <?php echo $strain['Strain']['thc']; ?>% &nbsp;&nbsp;
                    CBD:
                    <?php echo $strain['Strain']['cbd']; ?>% &nbsp;&nbsp;
                    CBN:
                    <?php echo $strain['Strain']['cbn']; ?>% &nbsp;&nbsp;
                    CBC:
                    <?php echo $strain['Strain']['cbc']; ?>% &nbsp;&nbsp;
                    THCV:
                    <?php echo $strain['Strain']['thcv']; ?>%
                </font>
            </center>

        </li>
        <li class="footer_banner_box blue printer" style="position: relative;padding: 0;width:330px;height:100px;">
            <img src="<?php echo $this->webroot ?>images/bg3.jpg"
                 style=" height: 100px;position: absolute;width: 330px;z-index: -1;"/>

            <div style="padding:20px 30px;color:#FFF;text-align:center;">
                <h2>Dominant Flavors</h2>
                <?php
                    //$flavor = null;
                    if ($flavor) {

                        foreach ($flavor as $f) {
                            ?>


                            <a class="glow <?php echo $this->requestAction('/strains/getFlavor/' . $f['FlavorRating']['flavor_id']); ?>"
                               href="javascrip:void(0)" style="position:relative;margin-right:5px;">
                                <?php echo $this->requestAction('/strains/getFlavor/' . $f['FlavorRating']['flavor_id']); ?>
                            </a>
                        <?php
                        }
                    } else {
                        ?>
                        No flavors yet.
                    <?php
                    }
                ?>
            </div>

        </li>
    </ul>


    <div class="clearfix"></div>

    <h2 class="box_header page_margin_top slide clearfix" style="">Strain Attributes:

        <!--div style="float:right;"class="addthis_sharing_toolbox"></div>
        <div style="float:right;">
            Share
        </div-->
    </h2>


    <ul class="columns full_width clearfix">
        <li class="column_right">


            <div class="">

                <h3>Effects:</h3>
                <br>

                <?php
                    $p_filter = 0;
                    if(isset($arr_filter)) {
                        foreach ($arr_filter as $filterwith) {
                            if (isset($_GET[$filterwith])) {
                                $p_filter = 1;
                            }
                        }
                    }
                    if (!$p_filter) {
                        foreach ($strain['OverallEffectRating'] as $oer) {
                            if ($this->requestAction('/strains/getPosEff/' . $oer['effect_id']))
                                $arr[] = $oer['rate'] . '_' . $oer['effect_id'];
                            else
                                $arr_neg[] = $oer['rate'] . '_' . $oer['effect_id'];
                        }
                    } else {
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
                                <div class="label left" style="position: relative; top: 50%; transform: translateY(20%);"><?php echo $this->requestAction('/strains/getEffect/' . $ar[1]); ?>
                                <?php progressbar($this->webroot, $length, perc($length), "", "info", "light-blue");?>


                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <i>No ratings yet</i>
                    <?php
                    }
                ?>
            </div>

        </li>
        <li class="column_left">

            <div class="">

                <h3>Symptoms:</h3>
                <br>


                <?php
                    if (!$p_filter) {
                        foreach ($strain['OverallSymptomRating'] as $oer) {
                            $arrs[] = $oer['rate'] . '_' . $oer['symptom_id'];
                        }
                    } else {
                        $symptom_rate = $this->requestAction('/strains/getSymptomRate/' . urlencode($profile_filter) . '/' . $strain['Strain']['id']);
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
                            if ($i == 6)
                                break;
                            $rate = $ars[0];
                            $length = 20 * $rate;;
                            ?>
                            <div class="eff">
                                <div
                                    class="label left" style="position: relative; top: 50%; transform: translateY(20%);"><?php echo $this->requestAction('/strains/getSymptom/' . $ars[1]); ?>
                                    <?php progressbar($this->webroot, $length, perc($length), "", "success", "light-green");?>
                                <div class="clear"></div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <i>No ratings yet</i>
                    <?php
                    }
                ?>

            </div>


            <div class="clearfix"></div>


        </li>
    </ul>
    <ul class="columns full_width page_margin_top clearfix">
        <li class="column_left">
            <div class="">
                <h3>Negative Effects:</h3>
                <br>
                <?php
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
                                    class="label left" style="position: relative; top: 50%; transform: translateY(20%);"><?php echo $this->requestAction('/strains/getEffect/' . $ar[1]); ?>
                                    <?php progressbar($this->webroot, $length, perc($length), "", "danger", "light-red"); ?>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <i>No ratings yet</i>
                    <?php
                    }
                ?>
            </div>


        </li>
        <li class="column_right">

            <div class="">

                <h3>General Ratings:</h3>
                <br/>
                <?php
                    if (!$p_filter) {
                        $count = count($strain['Review']);
                        if ($count) {
                            $scale = 0;
                            $strength = 0;
                            $duration = 0;
                            foreach ($strain['Review'] as $r) {
                                $scale = $scale + $r['eff_scale'];
                                $strength = $strength + $r['eff_strength'];
                                $duration = $duration + $r['eff_duration'];
                            }
                            $scale = ($scale / $count) * 20;
                            $strength = ($strength / $count) * 20;
                            $duration = ($duration / $count) * 20;
                        } else {
                            $scale = 0;
                            $strength = 0;
                            $duration = 0;
                        }
                    } else {
                        $effect_review = $this->requestAction('/strains/getEffectReview/' . urlencode($profile_filter) . '/' . $strain['Strain']['id']);

                        $count = count($strain['Review']);
                        if ($count) {
                            $scale = 0;
                            $strength = 0;
                            $duration = 0;
                            foreach ($effect_review as $r) {
                                $scale = $scale + $r['Review']['eff_scale'];
                                $strength = $strength + $r['Review']['eff_strength'];
                                $duration = $duration + $r['Review']['eff_duration'];
                            }
                            $scale = ($scale / $count) * 20;
                            $strength = ($strength / $count) * 20;
                            $duration = ($duration / $count) * 20;
                        } else {
                            $scale = 0;
                            $strength = 0;
                            $duration = 0;
                        }
                    }
                ?>
                <?php
                    if ($scale) {
                        ?>

                        <div class="eff">
                            <div class="label left" style="position: relative; top: 50%; transform: translateY(20%);">Sedative
                            <?php progressbar($this->webroot, $scale, perc($scale), "", "warning", "light-purple"); ?>
                        </div>
                    <?php
                    }
                ?>
                <?php
                    if ($strength) {
                        ?>
                        <div class="eff aaloo">
                            <div class="label left" style="position: relative; top: 50%; transform: translateY(20%);">Strength
                            <?php progressbar($this->webroot, $strength, perc($strength), "", "warning", "light-purple");?>
                        </div>
                    <?php
                    }
                ?>
                <?php
                    if ($duration) {
                        ?>
                        <div class="eff">
                            <div class="label left" style="position: relative; top: 50%; transform: translateY(20%);">Duration
                            <?php progressbar($this->webroot, $duration, perc($duration), "", "warning", "light-purple");?>
                        </div>
                    <?php
                    }
                ?>
                <?php
                    if (!$duration && !$strength && !$scale) {
                        ?>
                        <i>No ratings yet</i>
                    <?php
                    }
                ?>

            </div>

        </li>
    </ul>
    <ul class="columns full_width page_margin_top clearfix">
        <li class="column_left">
            <div class="">
                <h2>Colour</h2>
                <?php 
                    $c = $this->requestAction('/strains/getcolors/'.$strain['Strain']['id']);
                    foreach($c as $col)
                    {
                        if($col['ReviewColor']['color']!=""){
                        ?>
                         <p style="width: 5px; height: 10px;float:left;clear:none;background:#<?php echo $col['ReviewColor']['color'];?>;">&nbsp;</p>  
                    <?php
                        }
                    }            
                ?>
                <div class="clearfix"></div>
            </div>
        </li>
    </ul>

    <div class="clearfix page_margin_top" style="border-bottom: 1px solid #dadada;"></div>


    <ul class="columns full_width page_margin_top clearfix " >



        <li class="column_left">


            <h2 class="box_header slide clearfix" style="">Most Helpful User Review</h2>


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
                    <div style="border-top: 1px solid #dadada;padding: 5px 0px;"></div>
                <center>    <a href="<?php echo $this->webroot; ?>strains/review/<?php echo $strain['Strain']['slug']; ?>"
                       class="viewall more large blue noprint" style="">See All Reviews for <?php echo $strain['Strain']['name']; ?> &raquo;</a>
</center>
                <?php

                }


            ?>

        </li>





        <li class="column_right">


            <h2 class="box_header  slide clearfix"
                style=""><?php echo $strain['Strain']['name']; ?> Images</h2>

            <?php include('combine/images.php');?>


        </li>
    </ul>


</div>


<div class="print noprint">


    <div align="center">
        <div style="margin-bottom: 10px;"  class="addthis_sharing_toolbox"></div>

        <a style="" class="dark_blue more" href="<?php echo $this->webroot; ?>review/add/<?php echo $strain['Strain']['slug']; ?>">Review Strain</a>
        <a style=""  class="blue more" href="javascript:void(0)" onclick="window.print();">Print Report</a>
        <!--a style="" name="test" class="dark_blue more" href="javascript:void(0)" onclick="save();"  id="target">Save Report</a-->
        <!--input type="text" name="img_val" id="img_val"><br/-->
    </div>


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
    function takeScreenShot(){
        html2canvas(window.parent.document.body, {
            onrendered: function(canvas) {
                var cand = document.getElementsByTagName('canvas');
                if(cand[0] === undefined || cand[0] === null){

                }else{
                    //cand[0].remove();
                    document.body.removeChild(cand[0]);
                }
                document.body.appendChild(canvas);
            }
        });
    }

    function postImage(){
        var cand = document.getElementsByTagName('canvas');
        var canvasData = cand[0].toDataURL("image/png");
        var ajax = new XMLHttpRequest();
        ajax.open("POST",'/pr/custom/testSave.php',false);
        ajax.setRequestHeader('Content-Type', 'application/upload');
        ajax.send(canvasData );
        alert('done');
    }



    function save() {
        Rectangle screenRect = new Rectangle(Toolkit.getDefaultToolkit().getScreenSize());
        BufferedImage capture = new Robot().createScreenCapture(screenRect);
        ImageIO.write(capture, "bmp", new File(args[0]));

        //$('#target').html2canvas({
        //    onrendered: function (canvas) {

                //Set hidden field's value to image data (base-64 string)
                //$('#img_val').val(canvas.toDataURL("image/png"));
                //Submit the form manually
                //document.getElementById("myForm").submit();
         //   }
        //});
    //}
</script>
<script>
    $(function () {

        <?php
        if(!$p_filter)
        {
            ?>
        $('.rating').raty({number: 5, readOnly: true, score:<?php echo $strain['Strain']['rating'];?>});
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