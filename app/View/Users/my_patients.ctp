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
                <a style="" title="Read more" href="<?php echo $this->webroot; ?>users/mergedReport/<?php echo $this->Session->read('User.id');?>"
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

        
            <div class="page_left page_margin_top">
            
                   <div class="dropcap" style="border:1px solid #e8e8e8;padding: 0px 20px 10px 20px;">

                    <h2 class="box_header page_margin_top">My Patient</h2>
                    
                    <fieldset>
                      <table class="table" width="100%">
                        <thead><th>S.No</th><th>Username</th><th>Email</th><th>Selected Strain</th><th>Action</th></thead>
                        <?php foreach($patients as $k=>$p)
                            {
                            ?>
                                <tr>
                                    <td><?php echo ++$k;?></td>
                                    <td><?php echo $p['User']['username'];?></td>
                                    <td><?php echo $p['User']['email'];?></td>
                                    <td><?php $st = $this->requestAction("strains/getStrain/".$p['User']['strainz_id']);
                                                //var_dump($st);
                                                echo $st['Strain']['name'];?>
                                    </td>
                                    <td>
                                        <a href="<?php echo $this->webroot;?>users/addPatient/<?php echo $p['User']['id'];?>" class="more blue">Change Strain</a>
                                    </td>
                                </tr>
                        <?php
                            }?>
                      </table>  
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


    </div>
</div>
</div>
<script>
var lastsearch;
$(function(){
    $('#searchName').on('keydown keyup click input submit mouseenter', function(){
	var txt = $(this).val();
    if (txt.length > 2 && txt !=lastsearch) {
        lastsearch=txt;
        $('.butt').html("Now loading...");
        $.ajax({
            type: "post",
            url: "<?php echo $this->webroot;?>strains/ajax_search/patient",
            data: "str=" + txt,
            success: function (msg) {
                $('.results').show();
                $('.butt').html(msg);
            }
        })
    }
});
})
</script>