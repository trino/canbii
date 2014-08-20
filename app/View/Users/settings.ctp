<div class="page_layout page_margin_top clearfix">
	<div class="page_header clearfix">
		<div class="page_header_left">
			<h1 class="page_title">User Settings</h1>
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
					User Settings
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


<a title="Read more"  href="<?php echo $this->webroot;?>users/dashboard" class="more large dark_blue icon_small_arrow margin_right_white">Dashboard</a>
<a title="Read more"  href="<?php echo $this->webroot;?>users/settings" class="active more large dark_blue icon_small_arrow margin_right_white margin_left_10">Settings</a>
<a title="Read more" href="<?php echo $this->webroot;?>review"  class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">Add Review</a>
<a title="Read more" href="<?php echo $this->webroot;?>review/all"  class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">My Reviews</a>


<!--form action="" method="post" id="myform">
<table>
<tr><td><strong>User Name</strong></td><td><input type="text" name="username" value="<?php echo $user['User']['username'];?>" /></td></tr>
<tr><td><strong>Email</strong></td><td><input type="text" name="email" id="email" value="<?php echo $user['User']['email'];?>" /></td></tr>
<tr><td><b>Old password</b></td><td><input type="password" name="old_password" id="old_password" class="required"  /><span id="response"></span></td></tr>
<tr><td><b>New Password</b></td><td><input type="password" id="passw" name="password" class="" /></td></tr>
<tr><td><b>New Password Again</b></td><td><input type="password" id="npassw" name="npassword" class="" /></td></tr>
</table>
<input type="submit" name="submit" value="Save" />
</form-->




<form class="contact_form" id="myform" action="" method="post" >
<fieldset class="left">
	<label>Username</label>
	<div class="block">
		<input class="text_input" type="text" name="username" value="<?php echo $user['User']['username'];?>">
	</div>
	<label>Email</label>
	<div class="block">
		<input class="text_input" name="email" id="email" value="<?php echo $user['User']['email'];?>" type="text" >
	</div>
		<label>Old Password</label>
	<div class="block">
		<input class="text_input required"  type="password" name="old_password" id="old_password" >
	</div>
	<label>New Password</label>
	<div class="block">
		<input class="text_input"  type="password" id="passw" name="password">
	</div>
	<label>New Password Again</label>
	<div class="block">
		<input class="text_input" type="password" id="npassw" name="npassword">
	</div>
	<input type="submit" name="submit" value="Save" class="more blue">
</fieldset>
</form>


<div class="clearfix"></div>


	</div>
</div>

<script>
$(function(){
   $('#passw').val('');
   $('#old_password').val('');
   $('#myform').validate({
    rules:{
     npassword:{
        equalTo:'#passw'
     }   
    },
    messages:{
        npassword:{
            equalTo:'Please enter same password'
        }
    }
   });
   /*
   $('#old_password').keyup(function(){
    if($(this).val() == '')
    {
        $('#passw').removeClass('required');
    }
    else
    {
        if($('#passw').attr('class').replace('required','') == $('#passw').attr('class'))
        $('#passw').addClass('required');
    }
    
   });*/  
   $('#old_password').change(function(){
    if($(this).val() == '')
    {
        $('#passw').removeClass('required');
    }    
   });
   $('#passw').change(function(){
    $('#passw').removeClass('error');
   });
   
});
</script>


