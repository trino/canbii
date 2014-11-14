<?php
    if(isset($user))
    {
        $nationality = $user['User']['nationality'];
        $gender = $user['User']['gender'];
        $age_group = $user['User']['age_group'];
        $health = $user['User']['health'];
        $weight = $user['User']['weight'];
        $exp = $user['User']['years_of_experience'];
        $frequency = $user['User']['frequency'];
        $body_type = $user['User']['body_type'];
        $symptoms = $user['User']['symptoms'];
    }
    else
    {
        $nationality = "";
        $gender = '';
        $age_group = "";
        $health = "";
        $weight = "";
        $exp = "";
        $frequency = "";
        $body_type = "";
        $symptoms = "";
    }
?>



<div class="page_layout page_margin_top clearfix">
	<div class="page_header clearfix">
		<div class="page_header_left">
			<h1 class="page_title">My Dashboard</h1>
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
					My Dashboard
				</li>
			</ul>
		</div>
		<div class="page_header_right">
			<!--form class="search">
				<input class="search_input hint" type="text" value="To search type and hit enter..." placeholder="To search type and hit enter...">
			</form-->
		</div>
	</div>

<div class="clearfix">







<div class="notification_box nb_info page_margin_top">
							<h2>
								Information
							</h2>
							<h5>
								Lorem ipsum dolor sit amet.
							</h5>
						</div>





<div class="page_left page_margin_top">



<div class="backgroundcolor"><p>Welcome to your corner of canbii. Please enter accurate information so we can further help personalize medication for other users. We thank you for your help and support.</p></div> 
<form action="" method="post" id="dashboard" class="contact_form">

<?php include('combine/profile_filter_inc.php');?>

<div class="clearfix"></div>
<div class="separators"></div>
<label>What do you suffer from?</label>
<div id="dashboard_symptom" style="background:#42B3E5; border-radius: 3px; margin: 0 auto; padding:30px; ">
<p id="P_5">
<?php $effect = $this->requestAction('/pages/getSym');
$symp = explode(',',$symptoms);
foreach($effect as $e)
{
?>
<a class="A_6 <?php if(in_array($e['Symptom']['id'],$symp)){?>searchact<?php }?>" style="" href="javascript:void(0)" onclick="highlightsym($(this))" class=""  id="sym_<?php echo $e['Symptom']['id'];?>"><?php echo $e['Symptom']['title']?></a>
<?php
}
?>
</p>
<p style="display: none;" class="symp">
    <?php
    if($symp)
    {
        foreach($symp as $sy)
        {
            ?>
            <input class="sym_<?php echo $sy;?>" type="hidden" value="<?php echo $sy;?>" name="symptoms[]">
            <?php
        }
    }
    ?>
</p>
<div class="clearfix"></div>
</div>
<input type="submit" name="submit" value="submit" class="blue more" />
   
</form>


</div>




<div class="page_right page_margin_top">


<a style="width:120px;float:right;" title="Read more"  href="<?php echo $this->webroot;?>users/dashboard" class="active more large dark_blue icon_small_arrow margin_right_white">Dashboard</a>


<div class="clear"></div>
<a style="width:120px;float:right;"  title="Read more"  href="<?php echo $this->webroot;?>users/settings" class="more large dark_blue icon_small_arrow margin_right_white page_margin_top ">Settings</a>


<div class="clear"></div>
<a style="width:120px;float:right;" title="Read more" href="<?php echo $this->webroot;?>review"  class="more large dark_blue icon_small_arrow margin_right_white page_margin_top ">Add Review</a>


<div class="clear"></div>
<a style="width:120px;float:right;" title="Read more" href="<?php echo $this->webroot;?>review/all"  class="more large dark_blue icon_small_arrow margin_right_white page_margin_top ">My Reviews</a>











		</div>











</div>
</div>
<script>
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