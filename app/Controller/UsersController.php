<?php

class UsersController extends AppController {
    
          
    public function login() {
        if(isset($_GET['url']))
            $this->set('url',$_GET['url']);
        else
            $this->set('url',"");
        if(!$this->request->is('post'))
            $this->redirect('register');
		
        $this->set('title_for_layout','Login/Registration');
       if ($this->request->is('post')) {
        $_POST = $_POST['data']['User'];
            if($user = $this->User->find('first',array('conditions'=>array('username'=>$_POST['username'],'password'=>md5($_POST['password'] . "canbii" )))))
            {
                $this->Session->write('User.username',$_POST['username']);
                $this->Session->write('User.email',$user['User']['email']);
                $this->Session->write('User.id',$user['User']['id']);
                
                if(isset($_GET['url']))
                    $this->redirect(str_replace('/canabii','',$_GET['url']));
                else
                $this->redirect('dashboard');
            }
            else
			{
	$this->Session->setFlash('Invalid username or password, please try again', 'default', array('class' => 'bad'));
      
	  }
        }
        $this->render('register');
    }
        
    
    public function register(){
         if(isset($_GET['url']))
            $this->set('url',$_GET['url']);
        else
            $this->set('url',"");
        if($this->Session->read('User'))
            $this->redirect('dashboard');
      $this->set('title_for_layout','Login/Registration');
      if ($this->request->is('post')) {
            $_POST = $_POST['data'];
            $user['username'] = $_POST['User']['username'];
            $user['email'] = $_POST['User']['email'];
            $user['password'] = md5($_POST['User']['password'] . "canbii" );
            if($this->User->findByEmail($user['email']))
            {
                $this->Session->setFlash('Email already taken, please try again', 'default', array('class' => 'bad'));
                $this->redirect('');
            }
            if($this->User->findByUsername($user['username']))
            {
                $this->Session->setFlash('Username already taken, please try again', 'default', array('class' => 'bad'));
                $this->redirect('');
            }

          $emails = new CakeEmail();
          $emails->template('default');
          $emails->to($user['email']);
          $emails->from(array('noreply@canbii.com'=>'canbii.com'));
          $emails->subject("Canbii: User Registration");
          $emails->emailFormat('html');
          $msg = "Hello,<br/><br/>We received a request to create an account. <br/>Here is your login credentials:<br/>
                Username : " . $user['username'] . "<br/>
                Password : " . $_POST['User']['password'] . "<br/>
                <br/><br/>";
          $msg .= "Regards,<br/>canbii.com";
          $emails->send($msg);

            $this->User->create();
            if ($this->User->save($user)) 
            {
                $this->Session->write('User.username',$user['username']);
                $this->Session->write('User.email',$user['email']);
                $this->Session->write('User.id',$this->User->id);
                $this->Session->setFlash('You have been registered successfully', 'default', array('class' => 'good'));
                $this->redirect('dashboard');
            }
           $this->Session->setFlash('User could not be added', 'default', array('class' => 'bad'));
        }
    }
    
     public function logout() {
        $this->Session->delete('User');
        return $this->redirect('/');
    }
    
    public function dashboard()
    {
        $this->loadModel('Country');
        $this->set('countries',$this->Country->find('all'));
        $this->set('title_for_layout','User Dashboard');
        if(!$this->Session->read('User')){ $this->redirect('register');}
        
        $this->set('user',$this->User->findById($this->Session->read('User.id')));
        if(isset($_POST['submit']))
        {
            //var_dump($_POST['symptoms']); die();
            $this->User->id = $this->Session->read('User.id');
            if(isset($_POST['symptoms']) && $_POST['symptoms'])
            {
                foreach($_POST['symptoms'] as $k=>$symp)
                {
                    if($k==0)
                    {
                        $s=$symp;
                    }
                    else
                    $s = $s.','.$symp;
                }
                unset($_POST['symptoms']);
                $_POST['symptoms'] = $s;
            }
            //echo $_POST['symptoms']; die();
            foreach($_POST as $k=>$v)
            {
                $this->User->saveField($k,$v);
            }
            $this->Session->setFlash('Profile saved successfully', 'default', array('class' => 'good'));
            $this->redirect('dashboard');
            
        }
        
        
        
    }
    public function settings()
    {
        if(!$this->Session->read('User'))
            $this->redirect('register');
        $user =$this->User->findById($this->Session->read("User.id"));
        $this->set('user',$user);
        $username = $user['User']['username'];
        if(isset($_POST['submit']))
        {
            if($_POST['username'])
            {
                $ch = $this->User->find('first',array('conditions'=>array('username'=>$_POST['username'],'id<>'.$user['User']['id'])));
                if($ch)
                {
                    $this->Session->setFlash('Username already taken', 'default', array('class' => 'bad'));
                    $this->redirect('settings');
                }
            }
            if($_POST['email'])
            {
                $ch = $this->User->find('first',array('conditions'=>array('email'=>$_POST['email'],'id<>'.$user['User']['id'])));
                if($ch)
                {
                    $this->Session->setFlash('Email already taken', 'default', array('class' => 'bad'));
                    $this->redirect('settings');
                }
            }
            if($_POST['old_password'])
            {
                $ch2 = $this->User->find('first',array('conditions'=>array('username'=>$username,'password'=> md5($_POST['old_password'] . "canbii" ))));
                if($ch2)
                {
                    $arr['username'] = $_POST['username'];
                    $arr['email'] = $_POST['email'];
                    if($_POST['password']!="")
                    $arr['password'] = md5($_POST['password'] . "canbii" );
                    $this->User->id = $this->Session->read("User.id");
                    foreach($arr as $k=>$v)
                    {
                        $this->User->saveField($k,$v);
                    }
                    
                        $this->Session->setFlash("Settings Saved.", 'default', array('class' => 'good'));
                        $this->redirect("dashboard");    
                    
                }
                else
                {
                    $this->Session->setFlash('Old Password Does Not Match!', 'default', array('class' => 'bad'));
                    $this->redirect('settings');
                }
            }
           
        }
    
    }

    function randompassword($digits=8){
        return substr(md5(rand()), 0, $digits);
    }
    function changeuserpasssword($emailaddress, $digits=8){
        $pass=$this->randompassword($digits);
        $newpass=md5($pass . "canbii");
        $ch = $this->User->find('first',array('conditions'=>array('email'=>$emailaddress)));
        if($ch){
            $this->User->id = $ch['User']['id'];
            $this->User->saveField("password",$newpass);
            return $pass;
        }
        return false;
    }

    function forgot() {
        
        $this->set('title_for_layout','Forgot Password');
        if(isset($_POST['email']))
        {
            $q = $this->User->find('first',array('conditions'=>array('email'=>$_POST['email'],'fbid'=>'')));
            if($q)
            {
                //$r = rand(100000,999999);
                $emails = new CakeEmail();
                $emails->template('default');
                //$emails->to("roy@trinoweb.com");
                $emails->to($_POST['email']);
                $emails->from(array('noreply@canbii.com'=>'canbii.com'));
                $emails->subject("Canbii: Password Recovery");
                $emails->emailFormat('html');//$q['User']['password']
                $msg = "Hello,<br/><br/>We received a request to reset your password. <br/>Here is your new login credentials:<br/>
                Username : " . $q['User']['username'] . "<br/>
                Password : " . $this->changeuserpasssword($_POST['email']) . "<br/>
                <br/><br/>";
                $msg .= "Regards,<br/>canbii.com";
                $emails->send($msg);
                
                $this->Session->setFlash('A new password has been sent to '.$_POST['email'], 'default', array('class' => 'good'));
            }
            else
            {
                $this->Session->setFlash('We could not find an account associated with your email address', 'default', array('class' => 'bad'));
            }
            $this->redirect('forgot');
        }
    }
    
    
        
}
?>
