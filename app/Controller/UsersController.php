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
            if($user = $this->User->find('first',array('conditions'=>array('username'=>$_POST['username'],'password'=>$_POST['password']))))
            {
                $this->Session->write('User.username',$_POST['username']);
                $this->Session->write('User.email',$user['User']['email']);
                $this->Session->write('User.id',$user['User']['id']);
                if(isset($_GET['url']))
                    $this->redirect(str_replace('http:/localhost/marijuana','http://localhost',$_GET['url']));
                else
                $this->redirect('dashboard');
            }
            else
                $this->Session->setFlash(__('Invalid username or password, try again'));
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
            $user['password'] = $_POST['User']['password'];
            $this->User->create();
            if ($this->User->save($user)) {
                $this->Session->write('User.username',$user['username']);
                $this->Session->write('User.email',$user['email']);
                $this->Session->write('User.id',$this->User->id);
                $this->Session->setFlash('You have been registered succesfully.','alert-box',array('class'=>'alert alert-success alert-dismissable'),'save');
                $this->redirect('dashboard');
            }
           $this->Session->setFlash('User could not be added','alert-box',array('class'=>'alert alert-warning alert-dismissable'),'warning');
        }
    }
    
     public function logout() {
        $this->Session->delete('User');
        return $this->redirect('/');
    }
    
    public function dashboard()
    {
        $this->set('title_for_layout','User Dashboard');
        if(!$this->Session->read('User'))
            $this->redirect('register');
        
        $this->set('user',$this->User->findById($this->Session->read('User.id')));
        if(isset($_POST['submit']))
        {
            $this->User->id = $this->Session->read('User.id');
            foreach($_POST as $k=>$v)
            {
                $this->User->saveField($k,$v);
            }
            $this->Session->setFlash('Profile saved successfully.','alert-box',array('class'=>'alert alert-success alert-dismissable'),'save');
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
                    $this->Session->setFlash('Username Already Taken.');
                    $this->redirect('settings');
                }
            }
            if($_POST['email'])
            {
                $ch = $this->User->find('first',array('conditions'=>array('email'=>$_POST['email'],'id<>'.$user['User']['id'])));
                if($ch)
                {
                    $this->Session->setFlash('Email Already Taken.');
                    $this->redirect('settings');
                }
            }
            if($_POST['old_password'])
            {
                $ch2 = $this->User->find('first',array('conditions'=>array('username'=>$username,'password'=>$_POST['old_password'])));
                if($ch2)
                {
                    $arr['username'] = $_POST['username'];
                    $arr['email'] = $_POST['email'];
                    if($_POST['password']!="")
                    $arr['password'] = $_POST['password'];
                    $this->User->id = $this->Session->read("User.id");
                    foreach($arr as $k=>$v)
                    {
                        $this->User->saveField($k,$v);
                    }
                    
                        $this->Session->setFlash("Settings Saved.");
                        $this->redirect("dashboard");    
                    
                }
                else
                {
                    $this->Session->setFlash('Old Password Does Not Match!');
                    $this->redirect('settings');
                }
            }
           
        }
    
    }
    function forgot()
    {
        
        $this->set('title_for_layout','Forgot Password');
        if(isset($_POST['email']))
        {
            $q = $this->User->find('first',array('conditions'=>array('email'=>$_POST['email'],'fbid'=>'')));
            if($q)
            {
                //$r = rand(100000,999999);
                $emails = new CakeEmail();
                $emails->to($_POST['email']);
                $emails->from(array('noreply@savnpik.com'=>'MARIJUANA.COM'));
                $emails->subject("Recover Password");
                $emails->emailFormat('html');
                $msg = "Hi there,<br/><br/>We recently received a request from you that you forgot MARIJUANA.COM account password. <br/>Here is your new login detail:<br/>
                Username : ".$q['User']['username']."<br/>
                Password : ".$q['User']['password']."<br/>
                <br/><br/>";
                $msg .= "Regards,<br/>MARIJUANA.COM";
                $emails->send($msg);
                
                $this->Session->setFlash('Password has been sent to '.$_POST['email']);
            }
            else
            {
                $this->Session->setFlash('We could not find the email associated to MARIJUANA.COM');
            }
            $this->redirect('forgot');
        }
    }
    
    
        
}
?>
