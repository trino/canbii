<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />
<h1 class="title"><?php echo $strain['Strain']['name'];?></h1>
<div class="goto">
    <div class="left"><strong><img src="<?php echo $this->webroot;?>ra.png" height="50px" /></strong></div>
    <ul id="quick" class="left">        
        <li><a href="#" class="active">Overview</a></li>
        <li><a href="#">Avaibility</a></li>
        <li><a href="#">Reviews</a></li>
        <li><a href="#">Images</a></li>
    </ul>
    <div class="clear"></div>
</div>
<div class="maincontent">
    <div class="general">
        <div class="description left">
        <strong>Description: </strong><?php
        echo $strain['Strain']['description'];
        ?>
        </div>
        <div class="type right">
            <div class="iconstrain">
                <h2><?php echo $strain['StrainType']['title'];?></h2>
                <strong>
                <?php 
                $name_arr = explode(' ',$strain['Strain']['name']);
                $i=0;
                foreach($name_arr as $na)
                {
                    $i++;
                    if($i==1){
                        echo ucfirst($na[0]);
                        }
                        else echo strtolower($na[0]);
                        }
                        ?></strong>
                <br />
                <?php echo $strain['Strain']['name'];?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="reviews">
    <div class="leftcontent left">
        <strong>OVERALL RATING:</strong>
        <div>
        <div class="rating left">
        </div>
        <div class="left emotion" style=" font-size: 18px;font-weight: bold;margin-left: 10px;margin-top: 14px;color:#FF9900;"></div>
        <div class="clear"></div>
        </div>
    </div>
    <div class="rightcontent right"><strong>Reviews:</strong><br /><span class="review"><?php echo $strain['Strain']['review'];?></span></div>
    <div class="clear"></div>
    </div>
    <div class="attributes">
        <h2>Strain Attributes</h2>
        <div class="flavors leftcontent left">
        <strong class="active">FLAVORS</strong>
        <div class="flwrap">
            <?php
                foreach($strain['Flavorstrain'] as $f)
                {
                    ?>
                    <a class="fl" href="javascrip:void(0)">
                    <div>
                        <?php echo $this->requestAction('/strains/getFlavor/'.$f['flavor_id']);?>
                    </div>
                    </a>
                    <?php
                } 
            ?>
        </div>
        </div>
        <div class="rightcontent right">
            <strong class="active first"><a href="javascript:void(0)" onclick="$('.effects').show();$('.symptoms').hide();$(this).parent().addClass('active');$('.second').removeClass('active');">Effects</a></strong><strong class="second" ><a  href="javascript:void(0)" onclick="$('.effects').hide();$('.symptoms').show();$(this).parent().addClass('active');$('.first').removeClass('active');">Symptoms</a></strong>
            <div class="effects">
                <?php
                foreach($strain['OverallEffectRating'] as $oer)
                {
                    
                    $arr[] = $oer['rate'].'_'.$oer['effect_id'];
                }
                rsort($arr);
                $i=0;
                foreach($arr as $e)
                {
                    $ar=explode('_',$e);
                    $i++;
                    if($i==6)
                    break;
                    $rate = $ar[0];
                    $length = ($rate/5)*100;
                    ?>
                    <div class="eff">
                        <div class="label left"><?php echo $this->requestAction('/strains/getEffect/'.$ar[1]);?></div><div class="length left" style="width: <?php echo $length-40;?>%"></div><div class="clear"></div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="symptoms" style="display: none;">
                <?php
                foreach($strain['OverallSymptomRating'] as $oer)
                {
                    
                    $arrs[] = $oer['rate'].'_'.$oer['symptom_id'];
                }
                rsort($arrs);
                $i=0;
                foreach($arrs as $e)
                {
                    
                    $ars=explode('_',$e);
                    
                    $i++;
                    if($i==6)
                    break;
                    $rate = $ars[0];
                    $length = ($rate/5)*100;
                    ?>
                    <div class="eff">
                        <div class="label left"><?php echo $this->requestAction('/strains/getSymptom/'.$ars[1]);?></div><div class="length left" style="width: <?php echo $length-40;?>%"></div><div class="clear"></div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<script>
$(function(){
$('.rating').raty({readOnly:true,score:<?php echo $strain['Strain']['rating'];?>});
$('.emotion').text('<?php echo $strain['Strain']['rating'];?> '+$('.rating img').attr('title')+'!');

});
</script>