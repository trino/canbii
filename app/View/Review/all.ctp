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

<div class="clearfix page_margin_top ">

<a title="Read more"  href="<?php echo $this->webroot;?>users/dashboard" class="more large dark_blue icon_small_arrow margin_right_white">Dashboard</a>
<a title="Read more"  href="<?php echo $this->webroot;?>users/settings" class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">Settings</a>
<a title="Read more" href="<?php echo $this->webroot;?>review"  class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">Add Review</a>
<a title="Read more" href="<?php echo $this->webroot;?>review/all"  class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">My Reviews</a>

<div class="clearfix"></div>


<table style="width:100%;" class="page_margin_top timetable">
<thead><th>Strain</th><th>Date</th><th>Comment</th><th>Overall Rating</th><th></th></thead>
<?php 
foreach($reviews as $review)
{?>
<tr> 
	<td><?php echo $review['Strain']['name'];?></td>
	<td><?php echo $review['Review']['on_date'];?></td>
	<td><?php echo $review['Review']['review'];?></td>
	<td><?php echo $review['Review']['rate'];?></td>
	<td><a href="<?php echo $this->webroot;?>review/detail/<?php echo $review['Review']['id'];?>">View Detail</a></td>
</tr> 
<?php }?>
</table>


</div>
</div>