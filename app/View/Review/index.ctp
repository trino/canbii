<div class="page_layout page_margin_top clearfix">
	<div class="page_header clearfix">
		<div class="page_header_left">
			<h1 class="page_title">New Cannabis Review</h1>
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
					New Cannabis Review
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
<a title="Read more" href="<?php echo $this->webroot;?>review"  class="active more large dark_blue icon_small_arrow margin_right_white margin_left_10">Add Review</a>
<a title="Read more" href="<?php echo $this->webroot;?>review/all"  class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">My Reviews</a>

<div class="clearfix"></div>
<p>
Lorem ipsum some laki a  ipsum some laki a  ipsum some laki a  ipsum some laki a  ipsum some laki a  ipsum some laki a  ipsum some laki a  ipsum some laki a  ipsum some laki a  ipsum some laki a  ipsum some laki a  ipsum some laki a  ipsum some laki a  ipsum some laki a  ipsum some laki a  ipsum some laki a  ipsum some laki a  i ipsum some laki a psum some laki a  ipsum some laki a 
</p>

<form class="contact_form" action="" method="post">
<label for="searchName">Enter Name:</label>
<input type="text" id="searchName" value="" />
<span class="extra">(e.g. Purple Kush, Purple Nepal, Blue Dream)</span>
<div class="results" style="display: none;">
<label>Select Item to Review:</label><br />
<input type="hidden" name="strain" value="" id="strainz" />
<div class="butt" style="color:red;"></div>
</div>
</form>


</div>
</div>
<script>
$(function(){
$('.opt').live('click',function(){
	$("#strainz").val($(this).attr("title"));
   $("#sub").removeAttr("disabled"); 
  if($(this).attr('class').replace('sel',"")!=$(this).attr('class'))
	{
		$(this).removeClass('sel');
		return
	}
	$('.opt').each(function(){
		$(this).removeClass('sel');
	});
	$(this).addClass('sel');
})
$('#searchName').keyup(function(){
	var txt = $(this).val();
	$.ajax({
		type:"post",
		url:"<?php echo $this->webroot;?>strains/ajax_search",
		data:"str="+txt,
		success: function(msg)
		{
			$('.results').show();
			$('.butt').html(msg);
		}
	}) 
});
});
</script>