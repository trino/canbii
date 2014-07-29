<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />
<h1 class="title"><?php echo $strain['Strain']['name'];?><span style="float: right;"><a href="<?php echo $this->webroot;?>review/index/<?php echo $strain['Strain']['slug'];?>">Review Strain</a></span><div class="clear"></div></h1>
<p class="gap">&nbsp;</p>
<!--<div class="goto">
    <div class="left"><strong><img src="<?php echo $this->webroot;?>ra.png" height="50px" /></strong></div>
    <ul id="quick" class="left">        
        <li><a href="#" class="active">Overview</a></li>
        <li><a href="#">Avaibility</a></li>
        <li><a href="#">Reviews</a></li>
        <li><a href="#">Images</a></li>
    </ul>
    <div class="clear"></div>
</div>-->
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
    <div class="rightcontent right"><div class="left"><strong>Reviews:</strong><br /><span class="review"><?php echo $strain['Strain']['review'];?></span></div><div class="left" style="margin-left: 150px;"><strong>Views:</strong><br /><span class="review"><?php echo $strain['Strain']['viewed'];?></span></div><div class="clear"></div></div>
    <div class="clear"></div>
    </div>
    <div class="attributes">
        <h2>Strain Attributes</h2>
        <strong class="active">FLAVORS</strong>
        <?php
        $fa[0] = 0;
        $fa[1] = 145;
        $fa[2] = 325;
        $fa[3] = 490;
        ?>
        <div class="flavors" style="border-right: none;margin:0 auto;width:<?php echo $fa[count($flavor)];?>px;">
        
        <div class="flwrap">
            <?php
                foreach($flavor as $f)
                {
                    ?>
                    <a class="fl" href="javascrip:void(0)">
                    <div>
                        <?php echo $this->requestAction('/strains/getFlavor/'.$f['OverallFlavorRating']['flavor_id']);?>
                    </div>
                    </a>
                    <?php
                } 
            ?>
        </div>
        </div>
             
        <div class="clear"></div>     
        <div class="rightcont">
        <div class="left third">
            <strong class="active first">Positive Effects</strong>
            <div class="effects">
                <?php
                
                foreach($strain['OverallEffectRating'] as $oer)
                {
                    if($this->requestAction('/strains/getPosEff/'.$oer['effect_id']))
                    $arr[] = $oer['rate'].'_'.$oer['effect_id'];
                    else
                    $arr_neg[] = $oer['rate'].'_'.$oer['effect_id'];
                }
                if(isset($arr))
                rsort($arr);
                else
                $arr = array();
                $i=0;
                
                foreach($arr as $e)
                {
                    $ar=explode('_',$e);
                    $i++;
                    if($i==6)
                    break;
                    $rate = $ar[0];
                    $length = 10*$rate;;
                    ?>
                    <div class="eff">
                        <div class="label left"><?php echo $this->requestAction('/strains/getEffect/'.$ar[1]);?></div><div class="left ratewrap"><div class="length" style="width: <?php echo $length;?>%;text-align: center;"></div><em><?php echo $rate;?>/10</em></div><div class="clear"></div>
                    </div>
                    <?php
                }
                ?>
            </div>
            </div>
            <div class="left third">
            <strong class="third">Negative Effects</strong>
            
            <div class="neffects">
                <?php
                if(isset($arr_neg))
                rsort($arr_neg);
                else
                $arr_neg = array();
                $i=0;
                foreach($arr_neg as $e)
                {
                    $ar=explode('_',$e);
                    $i++;
                    if($i==6)
                    break;
                    $rate = $ar[0];
                    $length = 10*$rate;
                    ?>
                    <div class="eff">
                        <div class="label left"><?php echo $this->requestAction('/strains/getEffect/'.$ar[1]);?></div><div class="left ratewrap"><div class="length" style="width: <?php echo $length;?>%;text-align: center;"></div><em><?php echo $rate;?>/10</em></div><div class="clear"></div>
                    </div>
                    <?php
                }
                ?>
            </div>
            </div>
            <div class="left third">
                <strong class="second" >Symptoms</strong>
            
            <div class="symptoms">
                <?php
                foreach($strain['OverallSymptomRating'] as $oer)
                {
                    
                    $arrs[] = $oer['rate'].'_'.$oer['symptom_id'];
                }
                if(isset($arrs))
                rsort($arrs);
                else
                $arrs = array();
                $i=0;
                foreach($arrs as $e)
                {
                    
                    $ars=explode('_',$e);
                    
                    $i++;
                    if($i==6)
                    break;
                    $rate = $ars[0];
                    $length = 10*$rate;;
                    ?>
                    <div class="eff">
                        <div class="label left"><?php echo $this->requestAction('/strains/getSymptom/'.$ars[1]);?></div><div class="left ratewrap"><div class="length" style="width: <?php echo $length;?>%;text-align: center;"></div><em><?php echo $rate;?>/10</em></div><div class="clear"></div>
                    </div>
                    <?php
                }
                ?>
            </div>
            </div>
            <div class="left third">
    <strong>Effect Ratings</strong>
        <?php
        $count = count($strain['Review']);
        if($count){
            $scale = 0;
            $strength = 0;
            $duration = 0;
        foreach($strain['Review'] as $r)
        {
            $scale = $scale+$r['eff_scale'];
            $strength = $strength+$r['eff_strength'];
            $duration = $duration+$r['eff_duration'];
            
        }
        $scale = ($scale/$count)*10;
        $strength = ($strength/$count)*10;
        $duration = ($duration/$count)*10;
        ?>
        
        <div>
            <div class="eff">
                        <div class="label left">Length</div><div class="left ratewrap"><div class="length" style="width: <?php echo $scale;?>%;"></div><em><?php echo $scale/10;?>/10</em></div><div class="clear"></div>
            </div>
            <div class="eff">
                        <div class="label left">Strength</div><div class="left ratewrap" style="width: 63%;background:#FFF;"><div class="length" style="width: <?php echo $strength;?>%;"></div><em><?php echo $strength/10;?>/10</em></div><div class="clear"></div>
            </div>
            <div class="eff">
                        <div class="label left">Duration</div><div class="left ratewrap" style="width: 63%;background:#FFF;"><div class="length" style="width: <?php echo $duration;?>%;"></div><em><?php echo $duration/10;?>/10</em></div><div class="clear"></div>
            </div>        
        </div>
        <div class="clear">
        </div>
        
        
        
        <?php
        }
        ?>
    </div>
            <div class="clear"></div>
        </div>      
        
    </div>
    <div class="highlights">
    
        <div class="leftcontent left">
        <h2>Review highlights</h2>
            <strong>Most Helpful</strong><br />
            <div class="gap">
            <?php if($helpful){?>
                <div class="userinfo">
                    <div class="names left"><?php echo $this->requestAction('/strains/getUserName/'.$helpful['Review']['user_id']);?></div>
                    <div class="dates left"><em><?php echo $helpful['Review']['on_date'];?></em></div>
                    <div class="rates frate left"></div>
                    <div class="clear"></div>
                </div>
                <?php echo $helpful['Review']['review'];
                $rand1 = rand(100,999);
                $rand2 = rand(100,999);
                ?>
                <p class="gap martop">
                    <em>WAS THIS REVIEW HELPFUL TO YOU? </em> &nbsp; &nbsp; <?php if($vote==0){?><a href="javascript:void(0);" id="<?php echo $rand1.'_'.$helpful['Review']['id'];?>" class="btns yes">YES</a> <a class="btns no" href="javascript:void(0);" id="<?php echo ($rand1+1).'_'.$helpful['Review']['id'];?>">NO</a><?php }else{echo "<em style='color:#AAA;'>ALREADY VOTED</em>";}?>
                </p>
                <?php }?>
            </div>
        </div>
        <div class="rightcontent right">
        <h2>Chemical Composition</h2>
            
            <div>
                <div class="eff">
                            <div class="label left" style="width: 16%!important;">CBD</div><div class="left ratewrap" style="width: 73%;background:#FFF;"><div class="length" style="width: <?php echo $strain['Strain']['cbd'];?>%;"></div><em><?php echo $strain['Strain']['cbd'];?>%</em></div><div class="clear"></div>
                </div>
                <div class="eff">
                            <div class="label left" style="width: 16%!important;">CBN</div><div class="left ratewrap" style="width: 73%;background:#FFF;"><div class="length" style="width: <?php echo $strain['Strain']['cbn'];?>%;"></div><em><?php echo $strain['Strain']['cbn'];?>%</em></div><div class="clear"></div>
                </div>
                <div class="eff">
                            <div class="label left" style="width: 16%!important;">CBC</div><div class="left ratewrap" style="width: 73%;background:#FFF;"><div class="length" style="width: <?php echo $strain['Strain']['cbc'];?>%;"></div><em><?php echo $strain['Strain']['cbc'];?>%</em></div><div class="clear"></div>
                </div> 
                <div class="eff">
                            <div class="label left" style="width: 16%!important;">THC</div><div class="left ratewrap" style="width: 73%;background:#FFF;"><div class="length" style="width: <?php echo $strain['Strain']['thc'];?>%;"></div><em><?php echo $strain['Strain']['thc'];?>%</em></div><div class="clear"></div>
                </div> 
                <div class="eff">
                            <div class="label left" style="width: 16%!important;">THCV</div><div class="left ratewrap" style="width: 73%;background:#FFF;"><div class="length" style="width: <?php echo $strain['Strain']['thcv'];?>%;"></div><em><?php echo $strain['Strain']['thcv'];?>%</em></div><div class="clear"></div>
                </div>        
            </div>
        </div>
        <div class="clear"></div>
        <a href="<?php echo $this->webroot;?>strains/review/<?php echo $strain['Strain']['slug'];?>" class="viewall">View All Reviews</a>
    </div>
    <div class="images">
    <strong>IMAGE FOR <em><?php echo strtoupper($strain['Strain']['name']);?></em></strong>
    <p class="gap">&nbsp;</p>
                    <?php
            if($strain['StrainImage'])
            {
                foreach($strain['StrainImage'] as $g)
                {
                    ?>
                    <a class="fancybox" rel="group" href="<?php echo $this->webroot;?>images/strains/<?php echo $g['image'];?>" style="display: inline-block;"><img src="<?php echo $this->webroot;?>images/strains/<?php echo $g['image'];?>" width="120px" height="80px" /></a>
                    <?php
                }
                
            }
            ?>
            <script type="text/javascript">
            	$(document).ready(function() {
            		$(".fancybox").fancybox();
            	});
            </script>
    </div>
    
</div>
<script>
$(function(){
$('.rating').raty({number:10,readOnly:true,score:<?php echo $strain['Strain']['rating'];?>});
<?php if($helpful){?>
$('.frate').raty({readOnly:true,score:<?php echo $helpful['Review']['rate']/2;?>});
$('.srate').raty({readOnly:true,score:<?php echo $recent['Review']['rate']/2;?>});
<?php }?>
$('.emotion').text('<?php echo ($strain['Strain']['rating']).'/10';?> ');
$('.yes').click(function(){
   var id = $(this).attr('id');
   var arr = id.split('_');
   var r_id = arr[1];
   $.ajax({
    url:'<?php echo $this->webroot;?>strains/helpful/'+r_id+'/yes',
   });
   $('#'+arr[0]+'_'+r_id).removeClass('yes');
   $('#'+arr[0]+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;');
   $('#'+arr[0]+'_'+r_id).attr('onclick','return false;');
   var o = parseFloat(arr[0])+1;
   $('#'+o+'_'+r_id).removeClass('no');
   $('#'+o+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;');
   $('#'+o+'_'+r_id).attr('onclick','return false;'); 
   $(this).attr('style',$(this).attr('style').replace('background:#FFF;','background:#e5e5e5;'));
});
$('.no').click(function(){
   var id = $(this).attr('id');
   
   var arr2 = id.split('_');
   var r_id = arr2[1];
   $.ajax({
    url:'<?php echo $this->webroot;?>strains/helpful/'+r_id+'/no',
   });
   $('#'+arr2[0]+'_'+rid).removeClass('yes');
   var o = parseFloat(arr2[0])+1;
   $('#'+o+'_'+r_id).removeClass('no'); 
   $('#'+arr2[0]+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;')
   $('#'+arr2[0]+'_'+r_id).attr('onclick','return false;');
   $('#'+o+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;');
   $('#'+o+'_'+r_id).attr('onclick','return false;'); 
   $(this).attr('style',$(this).attr('style').replace('background:#FFF;','background:#e5e5e5;'));
});
});
</script>