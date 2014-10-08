<?php
    if($strain)
    {
	?>
	<ul class="page_margin_top">
	
	<?
        $j=rand(1000000,9999999999);
        foreach($strain as $s)
        {
            $j++;
            ?>

			
<li class="item_content clearfix" style="border-bottom:1px solid #E8E8E8;">

			
<a class="thumb_image" href="#" style="margin:0px;">

<div style="text-align: center; float:left;background-image: url('<?php echo $this->webroot?>images/<?php echo $s['StrainType']['title'];?>.png');width:57px;height:66px;background-repeat: no-repeat;">
<p style="vertical-align:middle;text-align:center;color:white;font-size:18px; margin-top:15px">
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

</a>


<div class="text" style="width:88%;">

<h2>
<a href="<?php echo $this->webroot?>strains/<?php echo $s['Strain']['slug'];?>">
<?php echo $s['Strain']['name'];?>
</a>
</h2>


<p>
<?php echo substr($s['Strain']['description'],0,150).'...';?>
</p>


<ul class="post_footer_details">
<li class="">
<?php echo $s['StrainType']['title'];?>
</li>
<li class="" style="">
<?php if($s['Strain']['review']){
echo $s['Strain']['review'].' Reviews';
}else
{
echo '0 Reviews';
}
?>
</li>
</ul>

<ul class="post_footer_details" style="float:right;margin-top:-5px;">
<li>
<div class="rating<?php echo $j;?> " style=""></div>
<script>
$(function(){    
$('.rating<?php echo $j;?>').raty({number:5,readOnly:true,score:<?php echo $s['Strain']['rating'];?>});
});
</script> 
</li>
</ul>
</div>

</li>
			


<?php
}
?>
</ul>
<?
}
?>


	
	
		
	
    <div class="clear"></div>
    <div class="morelist" style="display: none;"></div>
    <?php if($strain){?>
    <div class="loadmore"><a href="javascript:void(0);">Load More</a></div>
    <?php }?>
    <script>
    $(function(){
        var m=0
       $('.loadmore').each(function(){
        m++;
        if(m!=1)
        {
            $(this).remove();
        }
       }); 
    });
    </script>