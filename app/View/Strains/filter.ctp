<?php
    if($strain)
    {
        $j=0;
        foreach($strain as $s)
        {
            $j++;
            ?>

			<!--?php echo $s['Strain']['published_date'];?>

<a class="" href="<?php echo $this->webroot?>strains/<?php echo $s['Strain']['slug'];?>">
<h2>
<?php echo $s['Strain']['name'];?>
</h2><?php echo $s['StrainType']['title'];?>
</a>

<p><?php echo substr($s['Strain']['description'],0,130).'...';?></p>
<a href="<?php echo $this->webroot?>strains/<?php echo $s['Strain']['slug'];?>" class="button-small">View Detail</a>
<div class="rating<?php echo $j;?> " style=""></div>

<?php if($s['Strain']['review'])echo '<a href="'.$this->webroot.'strains/review/'.$s['Strain']['slug'].'">'.$s['Strain']['review'].' Reviews</a>';else echo '0 Reviews';?>

<script>
$(function(){    
$('.rating<?php echo $j;?>').raty({number:10,readOnly:true,score:<?php echo $s['Strain']['rating'];?>});
});
</script--> 

















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


	<?php
        }
    }
    ?>
    <div class="clear"></div>