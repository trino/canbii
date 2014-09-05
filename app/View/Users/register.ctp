<div class="page_layout page_margin_top clearfix">
	<div class="page_header clearfix">
		<div class="page_header_left">
			<h1 class="page_title">Login / Register</h1>
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
					Login / Register
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














<div class="columns page_margin_top full_width clearfix">
<div class="column_left">
<!--div class="backgroundcolor ">
Returning user? Please sign in below.
</div-->
<h2 class="box_header  page_margin_top ">Login</h2>
<br>
<?php echo $this->Form->create('User',array('action'=>'login?url='.$url, 'class'=>'contact_form')); ?>

<?php echo $this->Form->input('username',array('div'=>array('class'=>''))); ?>
<?php echo $this->Form->input('password',array('div'=>array('class'=>''))); ?>

<?php echo $this->Form->submit('Login',array('class'=>'more blue ', 'style'=>'float:left;'))?>
<?php echo $this->Form->end(); ?> <div class="clearfix"></div>
<div class="page_margin_top clearfix">
<a href="<?php echo $this->webroot;?>users/forgot" class="forgot-password">Forgot Password?</a>

</div>
</div>
<div class="column_right">

<!--div class="backgroundcolor ">
Looking to sign up? Please enter your information below.</div-->
<h2 class="box_header  page_margin_top">Register</h2><br>
<?php echo $this->Form->create('User',array('action'=>'register', 'class'=>'contact_form')); ?>
<fieldset>
<?php echo $this->Form->input('email',array('div'=>array('class'=>'form-row'),'label'=>'Email Address','type'=>'text')); ?> 
<?php echo $this->Form->input('username',array('div'=>array('class'=>'form-row'))); ?>
<?php echo $this->Form->input('password',array('div'=>array('class'=>'form-row'))); ?>
<?php echo $this->Form->input('confirm_password',array('div'=>array('class'=>'form-row'),'type'=>'password')); ?>
<div class="backgroundcolor page_margin_top ">

<label class="checkbox" style="margin:0px;"><input type="checkbox" name="check_field" class="chh" onchange="if($('.chh').is(':checked'))$('.sbmt').removeAttr('disabled');else{$('.sbmt').attr('disabled','');}"/>&nbsp; &nbsp; I agree to the <a href="">Privacy Policy</a> and <a href="">Terms & Conditions</a>.
</label>
</div>
</fieldset>

<?php echo $this->Form->submit('Register',array('class'=>'more blue ', 'style'=>'float:left;'))?>

<?php echo $this->Form->end(); ?>



</div>

</div>












</div>
</div>