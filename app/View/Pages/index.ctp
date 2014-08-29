<div class="page_layout page_margin_top clearfix">

<div class="announcement  clearfix">
	<ul class="columns no_width">
		<li class="column_left">
			<h1>There's a strain for that.. Lorem Ipsum</h1>
			<p>Fees are an estimate only and may be more depending on your situatio depending on your situation</p>
		</li>
		<li class="column_right">
			<div class="vertical_align">
				<div class="vertical_align_cell">
					<a title="Make an Appointment" href="?page=contact" class="more blue medium animated_element animation-slideLeft slideLeft" style="-webkit-animation: 600ms 0ms; transition: 0ms; -webkit-transition: 0ms;">View the Strains</a>
				</div>
			</div>
		</li>
	</ul>
</div>
		
<h2 class="box_header page_margin_top clearfix" style="">Strain Types</h2>

<ul class="columns_3 clearfix page_margin_top">
			<li class="column">
				<h3 class="box_header">
					Indica
				</h3>
<img src="images/IndicaIcon.png" alt="" style="float:right;">
<p>
Indica plants typically grow short and wide. Indica plants are better suited for indoor growing because of their short growth. The smoking of Indica bud will make you sleepy and provides a deep relaxation feeling. This type of strain has great medecal benefit as well as treatment to certain illness.
</p>
<a title="Browse Strains" href="<?php echo $this->webroot;?>strains/all/indica" class="more">
Browse Strains →
</a>
			</li>
			<li class="column">
				<h3 class="box_header slide">
					Sativa
				</h3>

				
		<img src="images/SativaIcon.png" alt="" style="float:right;">
		<p>
Sativa plants grow tall and thin. sativa plants are better suited for outdoor growing because some strains can reach over 25 ft. in height. Sativa smoking is known for its energetic and uplifting feeling. This type of strain has great medecal benefit as well as treatment to certain illness.
</p>
<a title="Browse Strains" href="<?php echo $this->webroot;?>strains/all/sativa" class="more">
Browse Strains →
</a>

			</li>
			<li class="column">
				<h3 class="box_header slide">
					Hybrid
				</h3>
				
				<img src="images/HybridIcon.png" alt="" style="float:right;">
<p>
Sativa and Indica are the two major types of cannabis plants which can mix together to create hybrid strains. Marijuana strains range from pure sativas to pure indicas and hybrid strains consisting of both indica and sativa (30% indica – 70% sativa, 50% – 50% combinations, 80% indica – 20% sativa).
</p>
<a title="Browse Strains" href="<?php echo $this->webroot;?>strains/all/hybrid" class="more">
Browse Strains →
</a>
			</li>
		</ul>



<h2 class="box_header page_margin_top_section slide">
Latest Strains
</h2>


<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />


<?php
if($strain)
{
?>
<div class="columns columns_4 page_margin_top clearfix">

<?php
$j=0;
foreach($strain as $s)
{
$j++;
?>
<ul class="column">
<li class="item_content clearfix">



<div style="float:left;background-image: url('images/features_small/icon.png');width:57px;height:66px;margin-right:10px;">
<p style="vertical-align:middle;text-align:center;color:white;font-size:18px;margin-top:-5px">


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


</li>
</ul>

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
</div>
</div>


		

<script>
function highlighteff(thiss){
if(thiss.attr('class').replace('searchact','')==thiss.attr('class'))
{
    thiss.addClass('searchact');
    $('.effe').append('<input type="hidden" name="effects[]" value="'+thiss.attr('id').replace('eff_','')+'" class="'+thiss.attr('id')+'"  />')}else{thiss.removeClass('searchact')
   
        $('.'+thiss.attr('id')).remove();
    }
    $('.key').val('');
}
function highlightsym(thiss){
if(thiss.attr('class').replace('searchact','')==thiss.attr('class'))
{
    thiss.addClass('searchact');
    $('.symp').append('<input type="hidden" name="symptoms[]" value="'+thiss.attr('id').replace('sym_','')+'" class="'+thiss.attr('id')+'"  />')}else{thiss.removeClass('searchact')
    
        $('.'+thiss.attr('id')).remove();
    }
    $('.key').val('');
}
</script>