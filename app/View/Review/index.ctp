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



<div class="page_left">

<img src="<?php echo $this->webroot;?>images/IndicaIcon.png" alt="" style="margin-right: 28px">
<img src="<?php echo $this->webroot;?>images/SativaIcon.png" alt="" style="margin-right: 28px">
<img src="<?php echo $this->webroot;?>images/HybridIcon.png" alt="">


<div class="clearfix"></div>
<div class="backgroundcolor page_margin_top"><p>
We value your opinion. Share your experience with others to help guide them towards the strain that will benefit them the most. Thank you!</p>
</div>

<form class="contact_form" action="" method="post">
<label for="searchName">Cannabis Name</label>
<input type="text" id="searchName" value="" />
<span class="extra">(e.g. Purple Kush, Blueberry Yum Yum, Blue Dream)</span>
<div class="results" style="display: none;">
<label>Select Item to Review:</label><br />
<input type="hidden" name="strain" value="" id="strainz" />
<div class="butt" style="color:red;"></div>
</div>
</form>

</div>

<div class="page_right page_margin_top">

<a style="width:120px;float:right;" title="Read more"  href="<?php echo $this->webroot;?>users/dashboard" class=" more large dark_blue icon_small_arrow margin_right_white">Dashboard</a>


<div class="clear"></div>
<a style="width:120px;float:right;"  title="Read more"  href="<?php echo $this->webroot;?>users/settings" class="more large dark_blue icon_small_arrow margin_right_white page_margin_top ">Settings</a>


<div class="clear"></div>
<a style="width:120px;float:right;" title="Read more" href="<?php echo $this->webroot;?>review"  class="more large dark_blue icon_small_arrow margin_right_white page_margin_top active">Add Review</a>


<div class="clear"></div>
<a style="width:120px;float:right;" title="Read more" href="<?php echo $this->webroot;?>review/all"  class="more large dark_blue icon_small_arrow margin_right_white page_margin_top ">My Reviews</a>

</div>





		
		

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