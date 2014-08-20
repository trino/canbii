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

<a title="Read more"  href="<?php echo $this->webroot;?>users/dashboard" class="more large dark_blue icon_small_arrow margin_right_white">Dashboard</a>
<a title="Read more"  href="<?php echo $this->webroot;?>users/settings" class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">Settings</a>
<a title="Read more" href="<?php echo $this->webroot;?>review"  class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">Add Review</a>
<a title="Read more" href="<?php echo $this->webroot;?>review/all"  class="active more large dark_blue icon_small_arrow margin_right_white margin_left_10">My Reviews</a>

<div class="clearfix"></div>

<h2 class="martop25">My Reviews</h2>
<!--<table style="width:100%;" class="page_margin_top timetable">
<thead><th>Strain</th><th>Date</th><th>Comment</th><th>Overall Rating</th><th></th></thead>-->
<?php 
$j=0;
foreach($reviews as $review)
{
    $j++;?>

<div class="list-review">
    <h3><?php echo $review['Strain']['name'];?></h3>
	<strong>Reviewed on: </strong><?php echo $review['Review']['on_date'];?>
    <div class="rating<?php echo $j;?> rat" style=""></div>
       <script>
        $(function(){    
        $('.rating<?php echo $j;?>').raty({number:10,readOnly:true,score:<?php echo $review['Review']['rate'];?>});
        });
        </script>
    <p>
	   <?php echo $review['Review']['review'];?>
    </p>
    
	   
    
	<a href="<?php echo $this->webroot;?>review/detail/<?php echo $review['Review']['id'];?>" class="more blue">View Detail</a>
    <div class="clear"></div>
</div>    
<?php }?>
<!--</table>-->


</div>
</div>