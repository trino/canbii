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





<div class="columns clearfix no_width page_margin_top">
<ul class="column_left">

   <label>Nationality</label>
   <select name="nationality"> 
		<option style="padding-top: 20px; padding-bottom:20px" value="">Select Nationality</option>
		<option value="asian" <?php if($nationality=='asian')echo "selected='selected'";?>>Asian</option>
		<option value="indian"<?php if($nationality=='indian')echo "selected='selected'";?>>Indian</option>
		<option value="white"<?php if($nationality=='white')echo "selected='selected'";?>>White</option>
		<option value="black"<?php if($nationality=='black')echo "selected='selected'";?>>Black</option>
		<option value="hispanic"<?php if($nationality=='hispanic')echo "selected='selected'";?>>Hispanic</option>
		<option value="mid_east"<?php if($nationality=='mid_east')echo "selected='selected'";?>>Middle Eastern</option>
   </select><br />
   
   
   <label>Gender</label>
   <select name="gender">
		<option value="">Select Gender</option>
		<option value="male"<?php if($gender=='male')echo "selected='selected'";?>>Male</option>
		<option value="female"<?php if($gender=='female')echo "selected='selected'";?>>Female</option>
   </select><br />
   
   
   <label>Age Group</label>
   <select name="age_group">
		<option value="">Select Age Group</option>
		<option value="21"<?php if($age_group=='21')echo "selected='selected'";?>>< 21</option>
		<option value="30"<?php if($age_group=='30')echo "selected='selected'";?>>21-30</option>
		<option value="40"<?php if($age_group=='40')echo "selected='selected'";?>>31-40</option>
		<option value="50"<?php if($age_group=='50')echo "selected='selected'";?>>41-50</option>
		<option value="50"<?php if($age_group=='50')echo "selected='selected'";?>>51-60</option>
		<option value="50"<?php if($age_group=='50')echo "selected='selected'";?>>61-70</option>
		<option value="51"<?php if($age_group=='51')echo "selected='selected'";?>>71+</option>
   </select><br />
   
   
   <label>Health</label>
   <select name="health">
		<option value="">Select Health</option>
		<option value="poor"<?php if($health=='poor')echo "selected='selected'";?>>Poor</option>
		<option value="average"<?php if($health=='average')echo "selected='selected'";?>>Average</option>
		<option value="good"<?php if($health=='good')echo "selected='selected'";?>>Good</option>
   </select><br />
   
   
      
   
</ul>
<ul class="column_right">

   
   <label>Weight</label>
   <select name="weight">
    <?php
    for($i=100;$i<=300;$i=$i+10)
    {
        ?>
        <option value="<?php if($i==100)echo $i.'-'.($i+10);else echo ($i+1).'-'.($i+10);?>" <?php if($weight==($i+1).'-'.($i+10)){?>selected="selected"<?php }?>><?php if($i==100)echo $i.'-'.($i+10);else echo ($i+1).'-'.($i+10);?></option>
        <?php
    }
    ?>
   </select>
   <br/>
   
   
   <label>Years of Expereince</label>
   <select  name="years_of_experience" >
   <?php for($i = 1; $i<=50; $i++)
   {
		if($i ==$exp)
		$sel = "selected='selected'";
		else
		$sel = "";
		echo "<option value='".$i."' ".$sel.">".$i."</option>";
   }?>
   </select><br/>
   
   
   <label>Frequency</label>
   <select name="frequency">
		<option value="">Select Frequency</option>
		<option value="rarely"<?php if($frequency=='rarely')echo "selected='selected'";?>>Rarely</option>
		<option value="occasional"<?php if($frequency=='occasional')echo "selected='selected'";?>>Occasional</option>
		<option value="often"<?php if($frequency=='often')echo "selected='selected'";?>>Often</option>
   </select>
   <br />
   
   <label>Body Type</label>
   <select name="body_type">
		<option value="">Select Body Type</option>
		<option value="Muscular"<?php if($body_type=='Muscular')echo "selected='selected'";?>>Muscular</option>
		<option value="Slim"<?php if($body_type=='Slim')echo "selected='selected'";?>>Slim</option>
		<option value="Heavy"<?php if($body_type=='Heavy')echo "selected='selected'";?>>Heavy</option>
        <option value="Average"<?php if($body_type=='Average')echo "selected='selected'";?>>Average</option>
        <option value="Athletic"<?php if($body_type=='Athletic')echo "selected='selected'";?>>Athletic</option>
   </select>
   
<br />

   
</ul>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="separator"></div>
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