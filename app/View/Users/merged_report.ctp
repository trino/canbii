<div class="page_layout page_margin_top clearfix">
	<div class="page_header clearfix">
		<div class="page_header_left">
			<h1 class="page_title">User Settings</h1>
			<ul class="bread_crumb">
				<li>
					<a href="<?php echo $this->webroot?>" title="Home">
						Home
					</a>
				</li>
				<li class="separator icon_small_arrow right_gray">
					&nbsp;
				</li>
				<li>
					User Settings
				</li>
			</ul>
		</div>
<div class="page_header_right">
            <a style="margin-right:10px;" title="Read more" href="<?php echo $this->webroot; ?>users/dashboard"
               class="more large dark_blue icon_small_arrow margin_right_white dashboarditem">My Account</a>
            <a style="margin-right:10px;" title="Read more" href="<?php echo $this->webroot; ?>users/settings"
               class="active more large dark_blue icon_small_arrow margin_right_white  ">Settings</a>
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
<div class="clearfix"></div>
</div>
	<div class="clearfix page_margin_top ">




<div class="page_left">

<h2>View Report for</h2>

<?php
foreach($model as $q)
{
    $strain = $this->requestAction('/strains/getStrain/'.$q['DoctorStrain']['strain_id']);
    ?>
    <p style="width: 30%;float: left;">
    <a href="#" class="more blue"><?php echo $strain['Strain']['name'];?></a>
    
    </p>
    
    <?php
}
?><div class="clearfix"></div>


		</div>

<div class="page_right page_margin_top">









		</div>






	</div>

</div>


