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

<h2 class="page_title">Login</h2>
<?php echo $this->Form->create('User',array('action'=>'login?url='.$url, 'class'=>'contact_form')); ?>

<?php echo $this->Form->input('username',array('div'=>array('class'=>''))); ?>
<?php echo $this->Form->input('password',array('div'=>array('class'=>''))); ?>

<a href="<?php echo $this->webroot;?>users/forgot" class="forgot-password">forgot password?</a>
<?php echo $this->Form->submit('Login',array('class'=>'more blue ', 'style'=>'float:left;'))?>
<?php echo $this->Form->end(); ?> 

</div>
<div class="column_right">



<h2>Register</h2>
<?php echo $this->Form->create('User',array('action'=>'register', 'class'=>'contact_form')); ?>
<fieldset>
<?php echo $this->Form->input('email',array('div'=>array('class'=>'form-row'),'label'=>'Email Address','type'=>'text')); ?> 
<?php echo $this->Form->input('username',array('div'=>array('class'=>'form-row'))); ?>
<?php echo $this->Form->input('password',array('div'=>array('class'=>'form-row'))); ?>
<?php echo $this->Form->input('confirm_password',array('div'=>array('class'=>'form-row'),'type'=>'password')); ?>

<label class="checkbox"><input type="checkbox" name="check_field" class="chh" onchange="if($('.chh').is(':checked'))$('.sbmt').removeAttr('disabled');else{$('.sbmt').attr('disabled','');}"/>I certify I am at least 18 years old and have read & agreed to the <a href="">Privacy Policy</a> and <a href="">Terms & Conditions</a>.
</label>

</fieldset>

<?php echo $this->Form->submit('Register',array('class'=>'more blue ', 'style'=>'float:left;'))?>

<?php echo $this->Form->end(); ?>



</div>

</div>












</div>
</div>