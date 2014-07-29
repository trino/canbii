<div id="login-account">
                <h2>LOGIN TO YOUR ACCOUNT</h2>
                           
                <div class="form-wrap">
                     <?php echo $this->Form->create('User',array('action'=>'login?url='.$url)); ?>
                            <fieldset>
                                 <?php echo $this->Form->input('username',array('div'=>array('class'=>'form-row'))); ?>
                                <?php  //echo $this->Form->input('password',array('div'=>array('class'=>'form-row'))); ?>
                                
                                <div class="form-row">
                    <label>Your Password <a href="<?php echo $this->webroot;?>users/forgot" class="forgot-password">forgot password?</a></label>
                    <input id="UserPassword" type="password" required="required" name="data[User][password]">
                    </div>

                    
                                
                               
                        </fieldset>
                    <?php echo $this->Form->submit('Login',array('class'=>'green-btn'))?>
                        <?php echo $this->Form->end(); ?> 
                </div>
            </div>

            <div id="create-account">

                <h2>REGISTER YOUR ACCOUNT</h2>
                
               
                <!--<a href="" class="twitter-signin">Sign in with Twitter</a>-->
                
                <div class="form-wrap">
                        <?php echo $this->Form->create('User',array('action'=>'register')); ?>
                            <fieldset>
                                <?php echo $this->Form->input('email',array('div'=>array('class'=>'form-row'),'label'=>'Email Address','type'=>'text')); ?> 
                                <?php echo $this->Form->input('username',array('div'=>array('class'=>'form-row'))); ?>
                                <?php  echo $this->Form->input('password',array('div'=>array('class'=>'form-row'))); ?>
                                <?php  echo $this->Form->input('confirm_password',array('div'=>array('class'=>'form-row'),'type'=>'password')); ?>
                                
                             <br/>
                             
                    <div class="form-row">
                        <label class="checkbox"><input type="checkbox" name="check_field" class="chh" onchange="if($('.chh').is(':checked'))$('.sbmt').removeAttr('disabled');else{$('.sbmt').attr('disabled','');}"/>I certify I am at least 18 years old and I have read & agree to the <a href="">Privacy Policy</a> and <a href="">Terms & Conditions</a></label>
                    </div>
                    </fieldset>
                        <div class="submit">
                        <input class="green-btn sbmt" type="submit" value="Register" disabled=""/>
                        </div>  
                        <?php echo $this->Form->end(); ?>
            </div>
        </div>
