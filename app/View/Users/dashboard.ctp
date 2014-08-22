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

<div class="clearfix page_margin_top">


<a title="Read more"  href="<?php echo $this->webroot;?>users/dashboard" class="active more large dark_blue icon_small_arrow margin_right_white">Dashboard</a>
<a title="Read more"  href="<?php echo $this->webroot;?>users/settings" class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">Settings</a>
<a title="Read more" href="<?php echo $this->webroot;?>review"  class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">Add Review</a>
<a title="Read more" href="<?php echo $this->webroot;?>review/all"  class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">My Reviews</a>

<div class="clear"></div>
<form action="" method="post" id="dashboard" class="contact_form">
   <strong>Nationality:</strong>
   <select name="nationality"> 
		<option value="">Select Nationality</option>
		<option value="asian" <?php if($nationality=='asian')echo "selected='selected'";?>>Asian</option>
		<option value="indian"<?php if($nationality=='indian')echo "selected='selected'";?>>Indian</option>
		<option value="white"<?php if($nationality=='white')echo "selected='selected'";?>>White</option>
		<option value="black"<?php if($nationality=='black')echo "selected='selected'";?>>Black</option>
		<option value="hispanic"<?php if($nationality=='hispanic')echo "selected='selected'";?>>Hispanic</option>
		<option value="mid_east"<?php if($nationality=='mid_east')echo "selected='selected'";?>>Middle Eastern</option>
   </select><br />
   <strong>Gender:</strong>
   <select name="gender">
		<option value="">Select Gender</option>
		<option value="male"<?php if($gender=='male')echo "selected='selected'";?>>Male</option>
		<option value="female"<?php if($gender=='female')echo "selected='selected'";?>>Female</option>
   </select><br />
   <strong>Age Group:</strong>
   <select name="age_group">
		<option value="">Select Age Group</option>
		<option value="21"<?php if($age_group=='21')echo "selected='selected'";?>>< 21</option>
		<option value="30"<?php if($age_group=='30')echo "selected='selected'";?>>21-30</option>
		<option value="40"<?php if($age_group=='40')echo "selected='selected'";?>>31-40</option>
		<option value="50"<?php if($age_group=='50')echo "selected='selected'";?>>41-50</option>
		<option value="51"<?php if($age_group=='51')echo "selected='selected'";?>>51+</option>
   </select><br />
   <strong>Health:</strong>
   <select name="health">
		<option value="">Select Health</option>
		<option value="poor"<?php if($health=='poor')echo "selected='selected'";?>>Poor</option>
		<option value="average"<?php if($health=='average')echo "selected='selected'";?>>Average</option>
		<option value="good"<?php if($health=='good')echo "selected='selected'";?>>Good</option>
   </select><br />
   <strong>Weight:</strong><input type="text" name="weight" value="<?php echo $weight;?>" /><br/>
   <strong>Years of Expereince:</strong>
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
   <strong>Frequency:</strong>
   <select name="frequency">
		<option value="">Select Frequency</option>
		<option value="rarely"<?php if($frequency=='rarely')echo "selected='selected'";?>>Rarely</option>
		<option value="occasional"<?php if($frequency=='occasional')echo "selected='selected'";?>>Occasional</option>
		<option value="often"<?php if($frequency=='often')echo "selected='selected'";?>>Often</option>
   </select>
   <br />
   <input type="submit" name="submit" value="submit" class="button button-small" />
</form>

<div class="clearfix"></div>

</div>
</div>