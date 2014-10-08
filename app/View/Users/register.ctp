<script type="text/javascript">
window.onload = function () {
    document.getElementById("UserPassword1").onchange = validatePassword;
    document.getElementById("UserConfirmPassword").onchange = validatePassword;
}
function validatePassword(){
var pass2=document.getElementById("UserConfirmPassword").value;
var pass1=document.getElementById("UserPassword1").value;
if(pass1!=pass2)
    document.getElementById("UserConfirmPassword").setCustomValidity("Passwords Don't Match");
else
    document.getElementById("UserConfirmPassword").setCustomValidity(''); 
//empty string means no validation error
}
</script>
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

<ul class="columns_3 page_margin_top clearfix">
					<li class="column">
						<div class="dropcap">
				<h2 class="box_header  page_margin_top">Login</h2>

<div class="clearfix"></div>
<?php echo $this->Form->create('User',array('action'=>'login?url='.$url, 'class'=>'contact_form')); ?>

<?php echo $this->Form->input('username',array('div'=>array('class'=>''))); ?>
<?php echo $this->Form->input('password',array('div'=>array('class'=>''))); ?>

<?php echo $this->Form->submit('Login',array('class'=>'more blue ', 'style'=>'float:left;'))?>
<?php echo $this->Form->end(); ?> <div class="clearfix"></div>
<div class="page_margin_top clearfix">
<a href="<?php echo $this->webroot;?>users/forgot" class="forgot-password">Forgot Password?</a>
</div>

						</div>
					</li>
					<li class="column">
						<div class="dropcap">
				
<h2 class="box_header  page_margin_top">Register</h2>
<?php echo $this->Form->create('User',array('action'=>'register', 'class'=>'contact_form','onsubmit'=>"if($('.chh').is(':checked'))return true;else{ $('.check_error').show(); $('.check_error').fadeOut(5000); return false;}")); ?>
<fieldset>
<?php echo $this->Form->input('email',array('div'=>array('class'=>'form-row'),'label'=>'Email Address','type'=>'email')); ?> 
<?php echo $this->Form->input('username',array('div'=>array('class'=>'form-row'))); ?>
<div class="form-row required">
<label for="UserPassword1">Password</label>
<input id="UserPassword1" type="password" required="required" name="data[User][password]"/>
</div>
<?php //echo $this->Form->input('password',array('div'=>array('class'=>'form-row'))); ?>
<?php echo $this->Form->input('confirm_password',array('div'=>array('class'=>'form-row'),'type'=>'password')); ?>
<div class="backgroundcolor page_margin_top ">

<label class="checkbox" style="margin:0px;"><input type="checkbox" name="check_field" class="chh" />&nbsp; &nbsp; I agree to the <a href="<?php echo $this->webroot.'pages/privacy';?>" target="_blank">Privacy Policy</a> and <a href="<?php echo $this->webroot.'pages/terms';?>" target="_blank">Terms & Conditions</a>.
</label>
<label class="check_error" style="color: red; display:none;"> Please Aggree The Terms & Conditions.</label>
</div>
</fieldset>

<?php echo $this->Form->submit('Register',array('class'=>'more blue sbmt', 'style'=>'float:left;'))?>

<?php echo $this->Form->end(); ?>



						</div>
					</li>
					<li class="column super_light_blue">
	
	
	
	
	
	
	
<ul>
				<li class="home_box light_blue animated_element animation-fadeIn duration-500 fadeIn" style="z-index: 3; -webkit-animation: 500ms 0ms; transition: 0ms; -webkit-transition: 0ms;">
					<h2>
							Why Sign Up?
					</h2>
					<div class="news clearfix">
						<p class="text">
							If you need a doctor urgently outside of medicenter opening hours, call emergency appointment number for emergency service.
			
						</p>
		
					</div>
				</li>
				<li class="home_box blue animated_element animation-slideDown duration-800 delay-250 slideDown" style="z-index: 2; -webkit-animation: 800ms 250ms; transition: 250ms; -webkit-transition: 250ms;">
					<h2>
							Reason # 2
					</h2>
					<div class="news clearfix">
						<p class="text">
							Here at medicenter we have individual doctor's lists. Click read more below to see services and current timetable for our doctors.
						</p>
		
					</div>
				</li>
			
			</ul>
	

					</li>
				</ul>

</div>
</div>