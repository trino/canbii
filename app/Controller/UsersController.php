<?php

class UsersController extends AppController {
    function getURL(){
        $URL="";
        if(isset($_GET['url'])) {
            $URL=$_GET['url'];
            if ($_SERVER["SERVER_NAME"] == "localhost"){
                $URL = substr($URL, 1, strlen($URL)-1);
                $strpos = strpos($URL, "/");
                $URL = substr($URL, $strpos, strlen($URL)-$strpos);
            }
        }
        return $URL;
    }
    
    function baseUrl()
    {
        if($_SERVER['SERVER_NAME']=='localhost')
        return 'http://localhost/canbii/';
        else
        return 'http://canbii.com/';
    }
          
    public function login() {
        $this->set('url', $this->getURL());
       
        if(!$this->request->is('post')) {
            $this->redirect('register');
        }
		
        $this->set('title_for_layout','Login/Registration');
       if($this->request->is('post')) {
        $_POST = $_POST['data']['User'];
            if($user = $this->User->find('first',array('conditions'=>array('username'=>$_POST['username'],'password'=>md5($_POST['password'] . "canbii" )))))
            {
                if($user['User']['user_type']==3)
                {
                    if($user['User']['approved_doctor']==0)
                    {
                        $this->Session->setFlash('Your account is pending approval', 'default', array('class' => 'bad'));
                        $this->redirect('register');
                    }
                    else
                    $this->Session->write('User.doctor',1);
                }
                elseif($user['User']['user_type']=='2')
                    $this->Session->write('User.strain',$user['User']['strain']);
                $this->Session->write('User.username',$_POST['username']);
                $this->Session->write('User.email',$user['User']['email']);
                $this->Session->write('User.id',$user['User']['id']);
                $this->Session->write('User.type',$user['User']['user_type']);

                if(isset($_GET['url'])) {
                    //$this->redirect($this->getURL());
                    $this->redirect( $_GET['url']);
                }else {
                    $this->redirect('dashboard');
                }
            }
            else
			{
	$this->Session->setFlash('Invalid username or password, please try again', 'default', array('class' => 'bad'));
      
	  }
        }
        $this->render('register');
    }
        
    
    public function register(){
        $this->set('url', $this->getURL());
        if($this->Session->read('User')) {
            $this->redirect('dashboard');
        }

      $this->set('title_for_layout','Login/Registration');
      if ($this->request->is('post')) {
            $_POST = $_POST['data'];
            $user['username'] = $_POST['User']['username'];
            $user['email'] = $_POST['User']['email'];
            $user['password'] = md5($_POST['User']['password'] . "canbii" );
            $user['pass_real'] = $_POST['User']['password'];
            $user['user_type'] = $_POST['User']['user_type'];
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
          
            $this->User->create();
            if ($this->User->save($user)) 
            {
                if($user['user_type'] == '2'){
          $emails = new CakeEmail();
          $emails->template('default');
          $emails->to($user['email']);
          $emails->from(array('info@canbii.com'=>'canbii.com'));
          $emails->subject("Canbii: User Registration");
          $emails->emailFormat('html');
          $msg = "Hello,<br/><br/>We received a request to create an account. <br/>Here are your login credentials:<br/>
                Username : " . $user['username'] . "<br/>
                Password : " . $_POST['User']['password'];
          $emails->send($msg);
          $this->Session->write('User.username',$user['username']);
                $this->Session->write('User.email',$user['email']);
                $this->Session->write('User.id',$this->User->id);
                $this->Session->setFlash('You have been registered successfully. <a style="color:white;" href="' .  $this->webroot . 'review">Review a strain here &raquo;</a>', 'default', array('class' => 'good'));
            }
            else{
               $emails = new CakeEmail();
                  $emails->template('default');
                  $emails->to('justdoit2045@gmail.com');
                  $emails->from(array('info@canbii.com'=>'canbii.com'));
                  $emails->subject("Canbii: Doctor's Account Approval");
                  $emails->emailFormat('html');
                  $msg = "Hello,<br/><br/>A doctor's account has been created with the detail below and requires your approval.<br/>
                        Username : " . $user['username'] . "<br/>
                        Email : " . $_POST['User']['email']."<br/><br/>".
                        "Please click <a href='".$this->baseUrl()."users/approve/".sha1($user['username'])."_".$this->User->id."'>here</a> to approve.";
                        ;
                  $emails->send($msg); 
                  $this->Session->setFlash('You will be notified once your account is approved', 'default', array('class' => 'good'));
            }
                
                
                $this->redirect('dashboard');
            }
           $this->Session->setFlash('User could not be added', 'default', array('class' => 'bad'));
        }
    }
    
    public function approve($code='')
    {
        $arr = explode('_',$code);
        $id = $arr[1];
        $q = $this->User->findById($id);
        if(sha1($q['User']['username']) == $arr[0])
        {
            $this->User->id = $id;
            $this->User->save(array('approved_doctor'=>1));
            
              $emails = new CakeEmail();
              $emails->template('default');
              $emails->to($q['User']['email']);
              $emails->from(array('info@canbii.com'=>'canbii.com'));
              $emails->subject("Canbii: Account Approved");
              $emails->emailFormat('html');
              $msg = "Hello,<br/><br/>We received a request to create an account and have approved it. <br/>Here are your login credentials:<br/>
                    Username : " . $q['User']['username'] . "<br/>
                    Password : " . $q['User']['pass_real'];
              $emails->send($msg);
            $this->Session->setFlash('An email has been sent to the doctor with login detail', 'default', array('class' => 'good'));
        }
        $this->redirect('/');
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

    public function get($name, $default=""){
        if (isset($_GET[$name])){ return $_GET[$name];}
        if (isset($_POST[$name])){ return $_POST[$name];}
        return $default;
    }
    public function settings(){
        if(!$this->Session->read('User'))
            $this->redirect('register');
        $user =$this->User->findById($this->Session->read("User.id"));
        $this->set('user',$user);
        $username = $user['User']['username'];
        if(isset($_POST['submit'])) {
            $newusername = trim($this->get('username'));
            if($newusername && strcasecmp($newusername, $username)<>0){
                $ch = $this->User->find('first',array('conditions'=>array('username'=>$newusername,'id<>'.$user['User']['id'])));
                if($ch){
                    $this->Session->setFlash('Username already taken', 'default', array('class' => 'bad'));
                    $this->redirect('settings');
                }
            }
            $newemail=trim($this->get('email'));
            if($newemail) {
                $ch = $this->User->find('first',array('conditions'=>array('email'=>$newemail,'id<>'.$user['User']['id'])));
                if($ch) {
                    $this->Session->setFlash('Email already taken', 'default', array('class' => 'bad'));
                    $this->redirect('settings');
                }
            }

            if($_POST['old_password'] && $_POST['password']) {
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
            if($q) {
                //$r = rand(100000,999999);
                $emails = new CakeEmail();
                $emails->template('default');
                //$emails->to("roy@trinoweb.com");
                $emails->to($_POST['email']);
                $emails->from(array('info@canbii.com'=>'canbii.com'));
                $emails->subject("Canbii: Password Recovery");
                $emails->emailFormat('html');//$q['User']['password']
                $msg = "Hello,<br/><br/>We received a request to reset your password. <br/>Here are your new login credentials:<br/>
                Username : " . $q['User']['username'] . "<br/>
                Password : " . $this->changeuserpasssword($_POST['email']);
                $emails->send($msg);
                
                $this->Session->setFlash('A new password has been sent to '.$_POST['email'], 'default', array('class' => 'good'));
            }  else  {
                $this->Session->setFlash('We could not find an account associated with your email address', 'default', array('class' => 'bad'));
            }
            $this->redirect('forgot');
        } elseif (isset($_GET["test"])){
            if ($_GET["test"] == "8437") {
                $emails = new CakeEmail();
                $emails->template('default');
                $emails->to("roy@trinoweb.com");
                $emails->from(array('info@canbii.com'=>'canbii.com'));
                $emails->subject("Canbii: Test Email");
                $emails->emailFormat('html');//$q['User']['password']
                $emails->send("This is a test email");
                $this->Session->setFlash('A test email has been sent', 'default', array('class' => 'good'));
                $this->redirect('forgot');
            }
        }
    }
    
    function addPatient($user_id ="")
    {
        $this->checkSess();
        $this->checkDoc();
        $this->loadModel('Strain');
        $strains = $this->Strain->find('all',array('order'=>'Strain.id'));
        if($user_id !=""){
            $user = $this->User->findById($user_id);
            $this->set('user', $user);
        }
        $this->set('strains', $strains);
        $this->set('title_for_layout','Add Patient');
      if ($this->request->is('post')) {
            $_POST = $_POST['data'];
            $user['username'] = $_POST['User']['username'];
            $user['email'] = $_POST['User']['email'];
            $user['password'] = md5($_POST['User']['password'] . "canbii" );
            $user['pass_real'] = $_POST['User']['password'];
            $user['strain'] = $_POST['User']['strain'];
            $user['doctor_id'] = $this->Session->read('User.id');
            $user['user_type'] = '2';
            $user['strainz_id'] = $_POST['User']['strain_id'];
            if($this->User->findByEmail($user['email']))
            {
                $this->Session->setFlash('Email already registered, please try again', 'default', array('class' => 'bad'));
                $this->redirect('');
            }
            if($this->User->findByUsername($user['username']))
            {
                $this->Session->setFlash('Username already registered, please try again', 'default', array('class' => 'bad'));
                $this->redirect('');
            }
          
            $this->User->create();
            if ($this->User->save($user)) 
            {
                if($user['user_type'] == '2'){
                  $emails = new CakeEmail();
                  $emails->template('default');
                  $emails->to($user['email']);
                  $emails->from(array('info@canbii.com'=>'canbii.com'));
                  $emails->subject("Canbii: User Registration");
                  $emails->emailFormat('html');
                  $msg = "Hello,<br/><br/>A new account has been created for you by your doctor in Canbii.com. <br/>Here are your login credentials:<br/>
                        Username : " . $user['username'] . "<br/>
                        Password : " . $_POST['User']['password'];
                  $emails->send($msg);
                  
                $this->Session->setFlash('Your Patient has been registered successfully.', 'default', array('class' => 'good'));
                
                $this->loadModel('DoctorStrain');
                $arr['doctor_id'] = $user['doctor_id'];
                $arr['user_id'] = $this->User->id;
                $this->loadModel('Strain');
                if(!is_numeric($user['strain'])){
                $qq = $this->Strain->findBySlug($user['strain']);
                $arr['strain_id'] = $qq['Strain']['id'];
                }
                else
                $arr['strain_id'] = $user['strain'];
                $this->DoctorStrain->create();
                $this->DoctorStrain->save($arr);
            }
            /*
            else{
               $emails = new CakeEmail();
                  $emails->template('default');
                  $emails->to('justdoit2045@gmail.com');
                  $emails->from(array('info@canbii.com'=>'canbii.com'));
                  $emails->subject("Canbii: Doctor's Account Approval");
                  $emails->emailFormat('html');
                  $msg = "Hello,<br/><br/>A doctor's account has been created with the detail below and requires your approval.<br/>
                        Username : " . $user['username'] . "<br/>
                        Email : " . $_POST['User']['email']."<br/><br/>".
                        "Please click <a href='".$this->baseUrl()."users/approve/".sha1($user['username'])."_".$this->User->id."'>here</a> to approve.";
                        ;
                  $emails->send($msg); 
                  $this->Session->setFlash('You will be notified once your account is approved', 'default', array('class' => 'good'));
            }*/
                
                
                $this->redirect('dashboard');
            }
           $this->Session->setFlash('Patient could not be added', 'default', array('class' => 'bad'));
        }
        
    }
    
    function checkSess(){
        if(!$this->Session->read('User'))
        {
            $url = $this->here;
            $this->Session->setFlash('Please log in or register to add a review','default',array('class'=>'bad'));
            $this->redirect('/users/register?url='.$url);
        }
    }
    
    function checkDoc($doc=''){
        if(!$this->Session->read('User.doctor'))
        {
            $url = $this->here;
            if($doc!="")
                $this->Session->setFlash('You are not a doctor.','default',array('class'=>'bad'));
            else
                $this->Session->setFlash('Only Doctors can add patient.','default',array('class'=>'bad'));
            $this->redirect('/users/dashboard');
        }
        
    }
    function mergedReport($doctor)
    {
        $this->loadModel('DoctorStrain');
        $q = $this->DoctorStrain->find('all',array('conditions'=>array('doctor_id'=>$doctor)));
        $this->set('model',$q);
    }
    
    function myPatients()
    {
        $this->loadModel('User');
        $this->checkDoc('doc');
        $patients = $this->User->find('all',array('conditions'=>array('doctor_id'=>$this->Session->read('User.id'))));
        $this->set('patients',$patients);
    }
    
    
        
}
?>
