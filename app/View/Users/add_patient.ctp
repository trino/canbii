<div class="page_layout page_margin_top clearfix">
    <div class="page_header clearfix">
        <div class="page_header_left">
            <h1 class="page_title">My Account</h1>
            <ul class="bread_crumb">
                <li>
                    <a href="<?php echo $this->webroot ?>" title="Home">
                        Home
                    </a>
                </li>
                <li class="separator icon_small_arrow right_gray">
                    &nbsp;
                </li>
                <li>
                    My Account
                </li>
            </ul>
        </div>
        <div class="page_header_right"><!-- float:right;-->
            <a style="margin-right:10px;" title="Read more" href="<?php echo $this->webroot; ?>users/dashboard"
               class="active more large dark_blue icon_small_arrow margin_right_white dashboarditem">My Account</a>
            <a style="margin-right:10px;" title="Read more" href="<?php echo $this->webroot; ?>users/settings"
               class="more large dark_blue icon_small_arrow margin_right_white  ">Settings</a>
            <?php if($this->Session->read('User.doctor'))
            {
               ?>
               <a style="margin-right:10px;" title="Read more" href="<?php echo $this->webroot; ?>users/myPatients"
               class="more large dark_blue icon_small_arrow margin_right_white  ">My Patients</a>
                <a style="" title="Read more" href="<?php echo $this->webroot; ?>strains/<?php echo $this->Session->read('User.id');?>/mergedReport"
               class="more large dark_blue icon_small_arrow margin_right_white">Merged Report</a>
               <?php 
            }
            else
            {
                ?>
                <a style="margin-right:10px;" title="Read more" href="<?php echo $this->webroot; ?>review"
               class="more large dark_blue icon_small_arrow margin_right_white  ">Add Review</a>
            <a style="" title="Read more" href="<?php echo $this->webroot; ?>review/all"
               class="more large dark_blue icon_small_arrow margin_right_white">My Reviews</a>
                <?php
            }
            ?>
            
        </div>

        <div class="clearfix">
        </div>

        <form action="" method="post" id="dashboard" class="contact_form">
            <div class="page_left page_margin_top">
            
                   <div class="dropcap" style="border:1px solid #e8e8e8;padding: 0px 20px 10px 20px;">

                    <h2 class="box_header page_margin_top">Add Patient</h2>
                    <?php echo $this->Form->create('User', array('action' => 'addPatient', 'class' => 'contact_form', 'onsubmit' => "if($('.chh').is(':checked'))return true;else{ $('.check_error').show(); $('.check_error').fadeOut(5000); return false;}")); ?>
                    <fieldset>
                        <?php echo $this->Form->input('email', array('div' => array('class' => 'form-row'), 'label' => 'Email Address', 'type' => 'email')); ?>
                        <?php echo $this->Form->input('username', array('div' => array('class' => 'form-row'))); ?>
                        <div class="form-row required">
                            <label for="UserPassword1">Password</label>
                            <input id="UserPassword1" type="password" required="required" name="data[User][password]"/>
                        </div>
                        <?php //echo $this->Form->input('password',array('div'=>array('class'=>'form-row'))); ?>
                        <?php echo $this->Form->input('confirm_password', array('div' => array('class' => 'form-row'), 'type' => 'password')); ?>
                        
                        <div class="form-row required">
                        <label for="UserStrain">Strain</label>
                            <select  required="required" name="data[User][strain]">
                                <option value="">Select Strain</option>
                            <?php foreach($strains as $s)
                            {?>
                               <option value="<?php echo $s['Strain']['slug'];?>"><?php echo $s['Strain']['name'];?></option> 
                            <?php
                            }?>
                            </select>
                        </div>
                        <div style="margin: 15px 0;height:1px;background:#e5e5e5;"></div>
                     
                        <?php echo $this->Form->submit('Add', array('class' => 'more blue sbmt', 'style' => 'float:left;margin-top:0px;')) ?>
                        <?php echo $this->Form->end(); ?>
                    </fieldset>


                    <div class="clearfix"></div>
                </div>
                

            </div>

            <div class="page_right page_margin_top">

<?php
if($this->Session->read('User.doctor'))
{
    ?>
    
            <a style="width:100%;padding:0px;" title="Add A Patient" href="<?php echo $this->webroot; ?>users/addPatient"
               class="more dark_blue icon_small_arrow margin_right_white  "><h1 style="padding:20px;color:white;">Add A Patient</h1></a>

    <?php
}
else
{
    ?>
    <h3>The more we know, the more we can help.</h3>
            <a style="width:100%;padding:0px;" title="Add A Review" href="<?php echo $this->webroot; ?>review"
               class="more dark_blue icon_small_arrow margin_right_white  "><h1 style="padding:20px;color:white;">Add A Review</h1></a>

    <?php
}
?>



        </form>

    </div>
</div>
</div>