<style>
.eff .left{position:relative;}
.eff em{z-index: 10000;text-align: center;position: relative;top:6px;}
em{letter-spacing:2px;font-style: normal;}
.ratewrap{width: 63%;background:#fff;text-align: center;height:25px;}
.length{padding-top:25px;background:#42B3E5;position:absolute;top:0;}

 @media print {
        .noprint{display:none;}
      .printer {
        color: #FFF;
        text-shadow: 0 0 0 #ccc;
      }

      @media print and (-webkit-min-device-pixel-ratio:0) {
        .printer {
          color: #FFF;
          -webkit-print-color-adjust: exact;
        }
      }
   }
</style>

<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />

<div class="page_layout page_margin_top clearfix">
<div class="page_header clearfix">
<div class="page_header_left">


<?php 
$strain_hexagon = $strain;
include('combine/hexagon.php');?>
<div style="float:left;width:500px;">
<h1 class="page_title" ><?php echo $strain['Strain']['name'];?> Marijuana Strain Report</h1>
<p>
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


<!--ul class="bread_crumb">
<li>
<a href="?page=home" title="Home">
Home
</a>
</li>
<li class="separator icon_small_arrow right_gray">
&nbsp;
</li>
<li>
<?php echo $strain['Strain']['name'];?> Medical Report
</li>
</ul-->
</div>
<div class="page_header_right noprint">

<a class="blue more" style="margin-right: 10px;margin-top:10px;" href="<?php echo $this->webroot;?>review/add/<?php echo $strain['Strain']['slug'];?>">Review Strain</a><a class="blue more" style="margin-top:10px;" href="javascript:void(0)" onclick="window.print();">Print Report</a>
</div>

</div>




<div class="toprint page_margin_top">

<div style="<?php
if($strain['StrainImage'])
{?>width: 60%;<?php }else{?>width:98%<?php }?> float: left; margin-right:2%;">
<h4 class="box_header  slide clearfix" style="">Cannabis Description</h4>

<p><?php echo $strain['Strain']['description']; ?></p>
</div>
<?php
if($strain['StrainImage'])
{?>
<div style="width: 38%; float: left;">
<h4 class="box_header  slide clearfix" style="">Images for <?php echo ($strain['Strain']['name']);?></h4>


<?php

	foreach($strain['StrainImage'] as $g)
	{
	?>
	<a class="fancybox" rel="group" href="<?php echo $this->webroot;?>images/strains/<?php echo $g['image'];?>" style="valign:top;"><img style="valign:top;" src="<?php echo $this->webroot;?>images/strains/<?php echo $g['image'];?>" width="120px" /></a>
	<?php
	}
?>




</div>
<?php }
?>
<div class="clearfix"></div>

<ul class="page_margin_top clearfix">

<li class="footer_banner_box super_light_blue printer" style="position: relative;padding: 0;width:330px;height:100px;">
<img src="<?php echo $this->webroot?>images/bg1.jpg" style=" height: 100px;position: absolute;width: 330px;z-index: -1;" />
<center style="padding:20px 30px;color:#FFF;">
<h2>Overall Rating</h2>
<div class="rating"></div>
</center>

</li>
<li class="footer_banner_box light_blue printer" style="position: relative;padding: 0;width:330px;height:100px;">
<img src="<?php echo $this->webroot?>images/bg2.jpg" style=" height: 100px;position: absolute;width: 330px;z-index: -1;" />
<center style="padding:20px 30px;color:#FFF;">
<h2>Chemical Composition</h2>
<font style="font-size:14px;" color="white">
THC:
<?php echo $strain['Strain']['thc'];?>% &nbsp;/&nbsp; 
CBD:
<?php echo $strain['Strain']['cbd'];?>% &nbsp;/&nbsp;
CBN:
<?php echo $strain['Strain']['cbn'];?>% &nbsp;/&nbsp;
CBC:
<?php echo $strain['Strain']['cbc'];?>% &nbsp;/&nbsp;
THCV:
<?php echo $strain['Strain']['thcv'];?>%
</font>
</center>

</li>
<li class="footer_banner_box blue printer" style="position: relative;padding: 0;width:330px;height:100px;">
<img src="<?php echo $this->webroot?>images/bg3.jpg" style=" height: 100px;position: absolute;width: 330px;z-index: -1;" />
<center style="padding:20px 30px;color:#FFF;">
<h2>Dominant Flavors</h2>
<?php
//$flavor = null;
if($flavor){
    
foreach($flavor as $f)
{
?>


<a class="" href="javascrip:void(0)">
<?php echo $this->requestAction('/strains/getFlavor/'.$f['FlavorRating']['flavor_id']);?>
</a>
<?php
}
}
else
{
    ?>
    No flavors yet.
    <?php
}
?>
</center>

</li>
</ul>


<div  class="clearfix"></div>

<h2 class="box_header page_margin_top slide clearfix" style="">Strain Attributes</h2>






<ul class="columns full_width  clearfix">
<li class="column_left">
					
					
					
<div class="">

<h3>Effects:</h3>
<br>

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
$length = 20*$rate;;
?>
<div class="eff">
<div class="label left"><?php echo $this->requestAction('/strains/getEffect/'.$ar[1]);?></div>
<div class="left ratewrap"><img src="<?php echo $this->webroot;?>Capture.PNG" style="width: <?php echo $length;?>%;height:25px;position: absolute; text-align: center;left:0;" /><em><?php echo $rate;?>/5</em></div>
<div class="clear"></div>
</div>
<?php
}
?>
</div>

</li>
<li class="column_right">

<div class="">

<h3>Symptoms:</h3>
<br>


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
$length = 20*$rate;;
?>
<div class="eff">
<div class="label left"><?php echo $this->requestAction('/strains/getSymptom/'.$ars[1]);?></div>
<div class="left ratewrap">
<img src="<?php echo $this->webroot;?>Capture.PNG" style="width: <?php echo $length;?>%;height:25px;position: absolute; text-align: center;left:0;" />
<em><?php echo $rate;?>/5</em>
</div>
<div class="clear"></div>
</div>
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
$length = 20*$rate;
?>
<div class="eff">
<div class="label left"><?php echo $this->requestAction('/strains/getEffect/'.$ar[1]);?></div>
<div class="left ratewrap"><img src="<?php echo $this->webroot;?>Capture.PNG" style="width: <?php echo $length;?>%;height:25px;position: absolute; text-align: center;left:0;" /><em><?php echo $rate;?>/5</em></div>
<div class="clear"></div>
</div>
<?php
}
?>
</div>


					</li>
					<li class="column_right">

<div  class="">

<h3>Effect Ratings:</h3>
<br>



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
$scale = ($scale/$count)*20;
$strength = ($strength/$count)*20;
$duration = ($duration/$count)*20;
?>
<div class="eff">
<div class="label left">Sedative</div><div class="left ratewrap"><img src="<?php echo $this->webroot;?>Capture.PNG" style="width: <?php echo round($scale,2);?>%;height:25px;position: absolute;left:0;" /><em><?php echo round($scale/20,2);?>/5</em></div><div class="clear"></div>
</div>
<div class="eff">
<div class="label left">Strength</div><div class="left ratewrap" style="width: 63%;background:#FFF;"><img src="<?php echo $this->webroot;?>Capture.PNG" style="width: <?php echo round($strength,2);?>%;height:25px;position: absolute;left:0;" /><em><?php echo round($strength/20,2);?>/5</em></div><div class="clear"></div>
</div>
<div class="eff">
<div class="label left">Duration</div><div class="left ratewrap" style="width: 63%;background:#FFF;"><img src="<?php echo $this->webroot;?>Capture.PNG" style="width: <?php echo round($duration,2);?>%;height:25px;position: absolute;left:0;" /><em><?php echo round($duration/20,2);?>/5</em></div><div class="clear"></div>
</div>        

<?php
}
?>

</div>

					</li>
				</ul>








<div class="clearfix"></div>


<h2 class="box_header page_margin_top_section slide clearfix" style="">Most Helpful User Review</h2>


<?php include_once('combine/strain_reviews.php');?>
<?php //include_once('combine/invite.php');?>





<script type="text/javascript">
$(document).ready(function() {
$(".fancybox").fancybox();
});
</script>



<div  class="clear"></div>

</div>




<div class="print">
    <center><a class="blue more" href="javascript:void(0)" onclick="window.print();">Print Report</a> <a href="#" class="blue more">Invite your friend</a> <a href="#" class="blue more">Share on Social Media</a></center>
</div>



</div>








<style>

@media print {
  .header_container{display:none;}
  .footer_container{display:none;}
  .cake-sql-log{display:none;}
  .footer_banner_box_container{display:none;}
  .print{display:none}
}

</style>
<script>
$(function(){
$('.rating').raty({number:5,readOnly:true,score:<?php echo $strain['Strain']['rating'];?>});
<?php if($helpful){?>
$('.frate').raty({readOnly:true,score:<?php echo $helpful['Review']['rate'];?>});
$('.srate').raty({readOnly:true,score:<?php echo $recent['Review']['rate'];?>});
<?php }?>
$('.emotion').text('<?php echo ($strain['Strain']['rating']).'/5';?> ');
var check = 0;
$('.yes').click(function(){
if(check==0){
    check++;
var id = $(this).attr('id');
var arr = id.split('_');
var r_id = arr[1];
$.ajax({
url:'<?php echo $this->webroot;?>strains/helpful/'+r_id+'/yes',
});
//$('#'+arr[0]+'_'+r_id).removeClass('yes');
$('#'+arr[0]+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;');
//$('#'+arr[0]+'_'+r_id).attr('onclick','return false;');
var o = parseFloat(arr[0])+1;
//$('#'+o+'_'+r_id).removeClass('no');
$('#'+o+'_'+r_id).attr('style','background:#FFF;cursor: default;display:inline-block;padding:4px 7px;');
$('#'+o+'_'+r_id+' strong').attr('style','color:#eee');
$//('#'+o+'_'+r_id).attr('onclick','return false;'); 
$(this).attr('style',$(this).attr('style').replace('background:#FFF;','background:#e5e5e5;display:inline-block;padding:4px 7px;'));
}
});
$('.no').click(function(){
if(check==0){    
    check++;
var id = $(this).attr('id');

var arr2 = id.split('_');
var num = parseFloat(arr2[0])-1;
var r_id = arr2[1];
$.ajax({
url:'<?php echo $this->webroot;?>strains/helpful/'+r_id+'/no',
});
$('#'+arr2[0]+'_'+r_id).removeClass('yes');
var o = parseFloat(arr2[0])+1;
//$('#'+o+'_'+r_id).removeClass('no'); 
$('#'+num+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;display:inline-block;padding:4px 7px;')
$('#'+num+'_'+r_id+' strong').attr('style','color:#CCC;')
//$('#'+arr2[0]+'_'+r_id).attr('onclick','return false;');
$('#'+o+'_'+r_id).attr('style','background:#FFF;color:#CCC;cursor: default;');
//$('#'+o+'_'+r_id).attr('onclick','return false;'); 
$(this).attr('style','padding-left:10px; padding-right:10px; padding-top: 5px; padding-bottom: 5px; margin-right:5px;background:#e5e5e5;cursor:default;');}
});
});
</script>