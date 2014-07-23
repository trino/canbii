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
<div class="">
    <form action="" method="post">
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
       <strong>Years of Expereince:</strong><input type="text" name="years_of_experience" value="<?php echo $exp;?>" /><br/>
       <strong>Frequency:</strong>
       <select name="frequency">
            <option value="">Select Frequency</option>
            <option value="rarely"<?php if($frequency=='rarely')echo "selected='selected'";?>>Rarely</option>
            <option value="occasional"<?php if($frequency=='occasional')echo "selected='selected'";?>>Occasional</option>
            <option value="often"<?php if($frequency=='often')echo "selected='selected'";?>>Often</option>
       </select>
       <input type="submit" name="submit" value="submit" />
       
    
    </form>

</div>