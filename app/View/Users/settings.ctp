<div class="tabs">
    <a href="<?php echo $this->webroot;?>users/settings" class="button">Settings</a>
    <a href="<?php echo $this->webroot;?>review" class="button">Add Review</a>
    <a href="<?php echo $this->webroot;?>review/all" class="button">My Reviews</a>
</div>
<div class="">

<h1 class="title">User Settings</h1>
<form action="" method="post" id="myform">
<table>
<tr><td><strong>User Name</strong></td><td><input type="text" name="username" value="<?php echo $user['User']['username'];?>" /></td></tr>
<tr><td><strong>Email</strong></td><td><input type="text" name="email" id="email" value="<?php echo $user['User']['email'];?>" /></td></tr>
<tr><td><b>Old password</b></td><td><input type="password" name="old_password" id="old_password" class="required"  /><span id="response"></span></td></tr>
<tr><td><b> New Password</b></td><td><input type="password" id="passw" name="password" class="" /></td></tr>
<tr><td><b>New Password Again</b></td><td><input type="password" id="npassw" name="npassword" class="" /></td></tr>
        

</table>
<input type="submit" name="submit" value="Save" />
</form>
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