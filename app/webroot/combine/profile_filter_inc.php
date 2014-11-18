<?php
$arr_filter=array('nationality','gender','age_group','weight','health','exp','frequency','body_type','card_id','country');
if(!isset($nationality))
{
    $nationality = '';
}
if(!isset($gender))
{
    $gender = '';
}
if(!isset($age_group))
{
    $age_group = '';
}
if(!isset($weight))
{
    $weight = '';
}
if(!isset($health))
{
    $health = '';
}
if(!isset($exp))
{
    $exp = '';
}
if(!isset($frequency))
{
    $frequency = '';
}
if(!isset($body_type))
{
    $body_type = '';
}
if(!isset($card_id))
{
    $card_id = '';
}
if(!isset($country))
{
    $country = '';
}
?>
<div class="columns clearfix no_width page_margin_top hidden_filter" <?php if($this->params['action']!='dashboard'){?>style="display:none;width:70%;marging-bottom:15px;"<?php }?>>
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
   
   <label>Country</label>
   <select name="country"> 
		<option style="padding-top: 20px; padding-bottom:20px" value="">Select Country</option>
        <?php
        foreach($countries as $cou)
        {
            ?>
            <option value="<?php echo $cou['Country']['countryName'];?>" <?php if($country==$cou['Country']['countryName'])echo "selected='selected'";?>><?php echo $cou['Country']['countryName'];?></option>
            <?php
        }
        ?>
		
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

   <?php
   if($this->params['action']=='dashboard')
   {
    ?>
   <label>Patient card ID</label>
   <input type="text" name="card_id" value="<?php echo $card_id;?>" />
   <?php
   }
   else
   {
    ?>
    <label>Patient with card</label>
    <input type="checkbox" class="card_id" value="1" />
    <?php
   }
   ?>
   <label>Weight</label>
   <select name="weight">
        <option value="">Select Weight</option>
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
        <option value="">Select Years of Experience</option>
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
<?php
if($this->params['controller']=='strains' && $this->params['action']=='index')
{
    ?>
    <br />
    <br />
    <a class="blue more" href="javascript:void(0)" id="filternow">Filter Now</a>
    <?php
}
?>
</div>