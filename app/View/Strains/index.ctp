<style>
.eff .left{position:relative;}
.eff em{z-index: 10000;text-align: center;position: relative;top:3px;}
.ratewrap{width: 63%;background:#fff;text-align: center;height:25px;}
.length{padding-top:25px;background:#42B3E5;position:absolute;top:0;}
</style>

<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />

<div class="page_layout page_margin_top clearfix">
<div class="page_header clearfix">
<div class="page_header_left">
<h1 class="page_title"><?php echo $strain['Strain']['name'];?></h1>
<ul class="bread_crumb">
<li>
<a href="?page=home" title="Home">
Home
</a>
</li>
<li class="separator icon_small_arrow right_gray">
&nbsp;
</li>
<li>
<?php echo $strain['Strain']['name'];?>
</li>
</ul>
</div>
<div class="page_header_right">
<!--form class="search">
<input class="search_input hint" type="text" value="To search type and hit enter..." placeholder="To search type and hit enter...">
</form-->
</div>
</div>




<div class="clearfix page_margin_top ">








<a href="<?php echo $this->webroot;?>review/add/<?php echo $strain['Strain']['slug'];?>">Review Strain</a>

<p>Description:</p>
<p><?php echo $strain['Strain']['description']; ?></p>

<!--<p><?php echo $strain['StrainType']['title'];?></p>
<?php echo $strain['Strain']['name'];?>-->
<h2>Reviews:</h2>
<div class="one-third dark">
<p>OVERALL RATING:</p>
<div class="rating left"></div>
</div>

<div class="one-third light">
<p>Reviews</p>
<?php echo $strain['Strain']['review'];?>
</div>
<div class="one-third lighter">
<p>Views:</p>
<?php echo $strain['Strain']['viewed'];?>
</div>
<div  class="clearfix"></div>

<h2 class="martop25">Strain Attributes</h2>

<div class="flavors">
<p class="ptitle">FLAVORS</p>
<?php
foreach($flavor as $f)
{
?>
<a class="fl" href="javascrip:void(0)">
<?php echo $this->requestAction('/strains/getFlavor/'.$f['FlavorRating']['flavor_id']);?>
</a>
<?php
}
?>
</div>
<div>
<div class="half">
<p>Positive Effects</p>
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
<div class="label left"><?php echo $this->requestAction('/strains/getEffect/'.$ar[1]);?></div>
<div class="left ratewrap"><div class="length" style="width: <?php echo $length;?>%;text-align: center;"></div><em><?php echo $rate;?>/5</em></div>
<div class="clear"></div>
</div>
<?php
}
?>
</div>
<div class="half  second-half">



<p class="third">Negative Effects</p>
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
<div class="label left"><?php echo $this->requestAction('/strains/getEffect/'.$ar[1]);?></div>
<div class="left ratewrap"><div class="length" style="width: <?php echo $length;?>%;text-align: center;"></div><em><?php echo $rate;?>/5</em></div>
<div class="clear"></div>
</div>
<?php
}
?>
</div>
<div class="clearfix"></div>
</div>
<div>
<div class="half">

<p class="second" >Symptoms</p>
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
<div class="label left"><?php echo $this->requestAction('/strains/getSymptom/'.$ars[1]);?></div>
<div class="left ratewrap">
<div class="length" style="width: <?php echo $length;?>%;text-align: center;"></div>
<em><?php echo $rate;?>/5</em>
</div>
<div class="clear"></div>
</div>
<?php
}
?>
</div>

<div  class="half second-half">
<p>Effect Ratings</p>
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


<div class="eff">
<div class="label left">Length</div><div class="left ratewrap"><div class="length" style="width: <?php echo round($scale,2);?>%;"></div><em><?php echo round($scale/10,2);?>/10</em></div><div class="clear"></div>
</div>
<div class="eff">
<div class="label left">Strength</div><div class="left ratewrap" style="width: 63%;background:#FFF;"><div class="length" style="width: <?php echo round($strength,2);?>%;"></div><em><?php echo round($strength/10,2);?>/5</em></div><div class="clear"></div>
</div>
<div class="eff">
<div class="label left">Duration</div><div class="left ratewrap" style="width: 63%;background:#FFF;"><div class="length" style="width: <?php echo round($duration,2);?>%;"></div><em><?php echo round($duration/10,2);?>/5</em></div><div class="clear"></div>
</div>        

<?php
}
?>
</div>
<div class="clearfix"></div>
</div>

<h2 class="martop25">Review highlights</h2>
<div class="half white">
<p>Most Helpful</p>
<?php if($helpful){?>
<div class="userinfo">
<div class="names left"><strong>Reviewed By: </strong><?php echo $this->requestAction('/strains/getUserName/'.$helpful['Review']['user_id']);?> (<em><?php echo $helpful['Review']['on_date'];?></em>)</div>
<div class="clear"></div>
<div class="rates frate"></div>
<div class="clear"></div>
</div>
<i><?php echo $helpful['Review']['review'];?></i>
<?php
$rand1 = rand(100,999);
$rand2 = rand(100,999);
?>
<p>
<em>WAS THIS REVIEW HELPFUL TO YOU? </em> &nbsp; &nbsp; <?php if($vote==0){?><a href="javascript:void(0);" id="<?php echo $rand1.'_'.$helpful['Review']['id'];?>" class="btns yes">YES</a> <a class="btns no" href="javascript:void(0);" id="<?php echo ($rand1+1).'_'.$helpful['Review']['id'];?>">NO</a><?php }else{echo "<em style='color:#AAA;'>ALREADY VOTED</em>";}?>
<br />
<a href="<?php echo $this->webroot;?>strains/review/<?php echo $strain['Strain']['slug'];?>" class="viewall more blue martop25">View All Reviews</a>
</p>
<?php }?>
</div>
<div class="clearfix"></div>
<div class="chemical">
<h2>Chemical Composition</h2>
<div class="half">

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
<div class="half second-half">
<b>IMAGE FOR <em><?php echo strtoupper($strain['Strain']['name']);?></em></b>
<br />
<br />
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
<div  class="clear"></div>
</div>
</div>
</div>

<script>
$(function(){
$('.rating').raty({number:5,readOnly:true,score:<?php echo $strain['Strain']['rating'];?>});
<?php if($helpful){?>
$('.frate').raty({readOnly:true,score:<?php echo $helpful['Review']['rate'];?>});
$('.srate').raty({readOnly:true,score:<?php echo $recent['Review']['rate'];?>});
<?php }?>
$('.emotion').text('<?php echo ($strain['Strain']['rating']).'/5';?> ');
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