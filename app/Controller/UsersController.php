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
                $this->Session->setFlash('login Successfull');
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
    
    
    
        
}
?>
