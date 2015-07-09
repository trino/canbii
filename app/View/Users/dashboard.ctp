<?php
 if (isset($user)) {
        $nationality = $user['User']['nationality'];
        $gender = $user['User']['gender'];
        $age_group = $user['User']['age_group'];
        $health = $user['User']['health'];
        $weight = $user['User']['weight'];
        $exp = $user['User']['years_of_experience'];
        $frequency = $user['User']['frequency'];
        $body_type = $user['User']['body_type'];
        $symptoms = $user['User']['symptoms'];
        $card_id = $user['User']['card_id'];
        $country = $user['User']['country'];
        $strain = $user['User']['strain'];
    } else {
        $nationality = "";
        $gender = '';
        $age_group = "";
        $health = "";
        $weight = "";
        $exp = "";
        $frequency = "";
        $body_type = "";
        $symptoms = "";
        $card_id = "";
        $country = "";
        $strain ='';
    }
    ?>
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
        <div class="page_header_right">
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
                <?php if(!$this->Session->read('User.doctor')){
                        if($this->Session->read('User.type')=='2'){?>
                            <a style="margin-right:10px;" title="Read more" href="<?php echo $this->webroot; ?>review/add/<?php echo $this->Session->read('User.strain');?>"
                               class="more large dark_blue icon_small_arrow margin_right_white  ">Add Review</a>
                    <?php }else{?>
                            <a style="margin-right:10px;" title="Read more" href="<?php echo $this->webroot; ?>review"
                               class="more large dark_blue icon_small_arrow margin_right_white  ">Add Review</a>
                    <?php }
                    }?>
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
             <?php if(!$this->Session->read('User.doctor'))
            {
               ?>
                <div class="backgroundcolor"><p>Please ensure accuracy in your information so
                        we can further help personalize medication for other patients.</p></div>
                        <?php }?>

                <?php include('combine/profile_filter_inc.php'); ?>
                <div class="clearfix"></div>

                <input type="submit" name="submit" value="Save" class="blue more" style=""/>

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
elseif($this->Session->read('User.type')=='2')
{
   ?>
    <h3>The more we know, the more we can help.</h3>
            <a style="width:100%;padding:0px;" title="Add A Review" href="<?php echo $this->webroot; ?>review/add/<?php echo $strain;?>"
               class="more dark_blue icon_small_arrow margin_right_white  "><h1 style="padding:20px;color:white;">Add A Review</h1></a>

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
<script>
    function highlightsym(thiss) {
        if (thiss.attr('class').replace('searchact', '') == thiss.attr('class')) {
            thiss.addClass('searchact');
            $('.symp').append('<input type="hidden" name="symptoms[]" value="' + thiss.attr('id').replace('sym_', '') + '" class="' + thiss.attr('id') + '"  />')
        } else {
            thiss.removeClass('searchact')
            $('.' + thiss.attr('id')).remove();
        }
        $('.key').val('');
    }
</script>