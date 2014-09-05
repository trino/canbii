<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />
<div class="page_layout page_margin_top clearfix">
	<div class="page_header clearfix">
		<div class="page_header_left">
			<h1 class="page_title">My Reviews</h1>
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
					My Reviews
				</li>
			</ul>
		</div>
		<div class="page_header_right">
			<!--form class="search">
				<input class="search_input hint" type="text" value="To search type and hit enter..." placeholder="To search type and hit enter...">
			</form-->
		</div>
	</div>

<div class="clearfix page_margin_top revi">



<div class="page_left">

<div class="comments clearfix page_margin_top">
<div id="comments_list"><ul>
<?php 
$j=0;
foreach($reviews as $review)
{
    $j++;?>



<li class="comment clearfix">
<div class="comment_author_avatar">
&nbsp;
</div>

<div class="comment_details">
<div class="posted_by">
Reviewed by <a class="author" href="#" title="Jonh Doe">John Doe</a> on <?php echo $review['Review']['on_date'];?>
</div>

<h3><?php echo $review['Strain']['name'];?></h3>

<div class="rating<?php echo $j;?> rat" style=""></div>
<script>
$(function(){    
$('.rating<?php echo $j;?>').raty({number:10,readOnly:true,score:<?php echo $review['Review']['rate'];?>});
});
</script>
<p>
<?php echo $review['Review']['review'];?>
</p>
<a class="more reply_button" href="#comment_form">
<a href="<?php echo $this->webroot;?>review/detail/<?php echo $review['Review']['id'];?>" class="more blue">View Detail →</a>
</a>
</div>

</li>






<?php }?>

</ul>

			
	</div>

		
		</div>
		</div>

<div class="page_right page_margin_top">





<a style="width:120px;float:right;" title="Read more"  href="<?php echo $this->webroot;?>users/dashboard" class=" more large dark_blue icon_small_arrow margin_right_white">Dashboard</a>


<div class="clear"></div>
<a style="width:120px;float:right;"  title="Read more"  href="<?php echo $this->webroot;?>users/settings" class="more large dark_blue icon_small_arrow margin_right_white page_margin_top ">Settings</a>


<div class="clear"></div>
<a style="width:120px;float:right;" title="Read more" href="<?php echo $this->webroot;?>review"  class="more large dark_blue icon_small_arrow margin_right_white page_margin_top">Add Review</a>


<div class="clear"></div>
<a style="width:120px;float:right;" title="Read more" href="<?php echo $this->webroot;?>review/all"  class="more large dark_blue icon_small_arrow margin_right_white page_margin_top active">My Reviews</a>



		</div>





</div>
</div>