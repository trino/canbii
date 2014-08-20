<div class="page_layout page_margin_top clearfix">
<div class="page_header clearfix">
<div class="page_header_left">
<h1 class="page_title">The Internet's Largest Marijuana Strain Database</h1>
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
Filter Strains
</li>
</ul-->
</div>
<div class="page_header_right">
<!--form class="search">
<input class="search_input hint" type="text" value="To search type and hit enter..." placeholder="To search type and hit enter...">
</form-->
</div>
</div>

<div class="clearfix">


<form class="contact_form" action="<?php echo $this->webroot;?>strains/search" method="get" id="search" style="margin:0px;">

<center>
<input type="text" placeholder="Search Strain" name="key" class="key" style="width:50%;"/>
<h1>or</h1>
</center>
<ul class="tabs_navigation2" style="padding-top:10px;">
<li><strong><a href="#">Search Effects</a></strong></li>


<?php $effect = $this->requestAction('/pages/getEff');
foreach($effect as $e)
{
?><li>
<a href="javascript:void(0)" class="small-btn" onclick="highlighteff($(this))" id="eff_<?php echo $e['Effect']['id'];?>"><?php echo $e['Effect']['title']?></a>
</a></li>
<?php
}
?>

</ul>
<p style="display: none;" class="effe"></p>


<ul class="tabs_navigation2" style="padding-top:30px;">

<li><strong><a href="#">Search by Symptoms</a></strong></li>

<?php $effect = $this->requestAction('/pages/getSym');
foreach($effect as $e)
{
?><li>
<a href="javascript:void(0)" onclick="highlightsym($(this))" class="small-btn" id="sym_<?php echo $e['Symptom']['id'];?>"><?php echo $e['Symptom']['title']?></a>
</li>
<?php
}
?>


</ul>




<p style="display: none;" class="symp"></p>
<input type="submit" value="Search" class="more large dark_blue" style="" />

<div class="clearfix"></div>
</form>



<h3 class="box_header page_margin_top_section slide clearfix" style="">
Strain Types
</h3>




<div class="columns columns_3 page_margin_top clearfix">
<ul class="column">
<li class="item_content clearfix">
<a class="features_image" href="#" title="">
<img src="images/features_small/lab.png" alt="">
</a>
<div class="text">

<h3>
<a href="?page=about" title="Lorem ipsum">
Indica
</a>
</h3>

Indica plants typically grow short and wide. Indica plants are better suited for indoor growing because of their short growth. The smoking of Indica bud will make you sleepy and provides a deep relaxation feeling. This type of strain has great medecal benefit as well as treatment to certain illness.
<div class="item_footer clearfix">
<a title="Read more" href="?page=about" class="more">
Read more →
</a>
</div>
</div>
</li>
</ul>





<ul class="column">
<li class="item_content clearfix">
<a class="features_image" href="#" title="">
<img src="images/features_small/dropper.png" alt="">
</a>
<div class="text">

<h3>
<a href="?page=about" title="Lorem ipsum">
Sativa
</a>
</h3>


Sativa plants grow tall and thin. sativa plants are better suited for outdoor growing because some strains can reach over 25 ft. in height. Sativa smoking is known for its energetic and uplifting feeling. This type of strain has great medecal benefit as well as treatment to certain illness.
<div class="item_footer clearfix">
<a title="Read more" href="?page=about" class="more">
Read more →
</a>
</div>
</div>
</li>
</ul>
<ul class="column">
<li class="item_content clearfix">
<a class="features_image" href="#" title="">
<img src="images/features_small/pill.png" alt="">
</a>
<div class="text">

<h3>
<a href="?page=about" title="Lorem ipsum">
Hybrid
</a>
</h3>

Sativa and Indica are the two major types of cannabis plants which can mix together to create hybrid strains. Marijuana strains range from pure sativas to pure indicas and hybrid strains consisting of both indica and sativa (30% indica – 70% sativa, 50% – 50% combinations, 80% indica – 20% sativa).
<div class="item_footer clearfix">
<a title="Read more" href="?page=about" class="more">
Read more →
</a>
</div>

</div>
</li>
</ul>
</div>




<h3 class="box_header page_margin_top_section slide">
Latest Strains
</h3>

<br>











<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />


<?php
if($strain)
{
?>

<?php
$j=0;
foreach($strain as $s)
{
$j++;
?>

<div style="float:left;width:23%;margin-right:1%;">


<div style="float:left;background-image: url('images/features_small/icon.png');width:57px;height:66px;margin-right:10px;">
<p style="vertical-align:middle;text-align:center;color:white;font-size:18px;">


<?php 
$name_arr = explode(' ',$s['Strain']['name']);
$i=0;
foreach($name_arr as $na)
{
$i++;
if($i==1){
echo ucfirst($na[0]);
}
else echo strtolower($na[0]);
}
?>
</p>
</div>


<div style="float:left;">
<h3 class="block-title">
<a href="<?php echo $this->webroot?>strains/<?php echo $s['Strain']['slug'];?>">
<?php echo $s['Strain']['name'];?>
</a>
</h3>

<ul class="">
<li><?php echo $s['StrainType']['title'];?></li>
<!--<li>
<a href="#" title="General">
General,
</a>
</li>
<li>
<a href="#" title="Outpatient surgery">
Outpatient surgery
</a>
</li>-->
</ul>



</div>
<div style="clear:both;">
<p>
<?php echo substr($s['Strain']['description'],0,160).'...';?>

</p>

<ul class="post_footer_details">
<li>Added on</li>
<li>
<?php echo $s['Strain']['published_date'];?>
</li>
</ul>


</div>

</div>

<?
if(false){
?>
<ul class="blog">
<li class="post">
<ul class="comment_box clearfix" style="">
<li class="date clearfix">
<div class="value">
<a style="color:white;" href="<?php echo $this->webroot?>strains/<?php echo $s['Strain']['slug'];?>">
<?php echo $s['StrainType']['title'];?>

</a>
</div>
</li>
<li class="comments_number" style="">
<?php if($s['Strain']['review'])echo '<a href="'.$this->webroot.'strains/review/'.$s['Strain']['slug'].'">'.$s['Strain']['review'].' Reviews</a>';else echo '0 Reviews';?>
</li>
</ul>
<div class="post_content">
<h2>
<a target="_blank" href="http://themeforest.net/item/medicenter-responsive-medical-health-template/4000598?ref=QuanticaLabs" title="Lorem ipsum dolor sit amat velum">



<a href="<?php echo $this->webroot?>strains/<?php echo $s['Strain']['slug'];?>">
<?php echo $s['Strain']['name'];?>
</a>

</a>
</h2>
<p>
<?php echo substr($s['Strain']['description'],0,160).'...';?>

</p>
<div class="rating<?php echo $j;?> " style=""></div>


<script>
$(function(){    
$('.rating<?php echo $j;?>').raty({number:10,readOnly:true,score:<?php echo $s['Strain']['rating'];?>});
});
</script> 

<div class="post_footer">
<ul class="post_footer_details">
<li>Posted in</li>
<li>
<a href="#" title="General">
General,
</a>
</li>
<li>
<a href="#" title="Outpatient surgery">
Outpatient surgery
</a>
</li>
</ul>
<ul class="post_footer_details">
<li>Posted by </li>
<li>
<a href="#" title="John Doe">
John Doe
</a>
</li>
</ul>
</div>
</div>
</li>
</ul>
<?}?>
<?php
}
?>

<?php
}
?>

</div></div>