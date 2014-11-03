<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function index()
    {
        //asd
        $this->loadModel('Strain');
        $this->set('strain',$this->Strain->find('all',array('order'=>'Strain.id DESC','limit'=>4)));
        $this->set('homepage','1');
        
    }
    function getGeneric()
    {
        $arr['title'] = 'Canbii';
        $arr['keyword']='Canbii , Marijuana , Medical marijuana , Strains,Strain Types , Sativa , Hybrid , Indica';
        $arr['description'] = 'Medical marijuana has been used as a form of treatment for thousands of years. This all natural plant contains tetrahydrocannabinol (THC) and cannabidiol (CBD) which helps treat illnesses or alleviate symptoms. What is THC and CBD? Tetrahydrocannabinol (THC) is the main psychoactive ingredient in the cannabis plant. It gives one the feeling of euphoria. It is also known to increase ones appetite. Cannabidiol (CBD) is a cannabinoid that repress neurotransmitter release in the brain. Together THC and CBD offers natural pain relief. ';
        return $arr;
    }
    function get_strain()
    {
        $this->loadModel('Strain');
        return $this->Strain->find('all',array('order'=>'Strain.id DESC','limit'=>4));
    }
    // public function view_page($slug)
    // {
        
        // $detail = $this->Page->findBySlug($slug);
        // $this->set('detail',$detail);
        
    // }
	
	function contact_us()
    {
         if(isset($_POST['name'])&&$_POST['name'])
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $sub = $_POST['subject'];
            $msg = $_POST['message'];
            $emails = new CakeEmail();
            $emails->from(array('noreply@canabii.com'=>'Canabii'));
            
            $emails->emailFormat('html');
            
            $emails->subject('New contact Message');
            
            
            $message="
            Hello,<br/><br/>
            You've received a new message from Canabii<br/><br/> 
            
            <b>From</b> : ".$name."<br/>
            <b>Email</b> : ".$email."<br/>
            <b>Subject</b> : ".$sub."<br/>
            <b>Message</b> : ".$msg."<br/><br/>Thankyou,<br/>Canabii.";
            $emails->to('admin@web-nepal.com');
            $emails->send($message);
            $this->Session->setFlash('Message sent successfully');
            $this->redirect('contact_us');
        }
    }
	
		function about()
    {

    }
	
	function privacy()
    {
        
    }
    function terms()
    {
        
    }
    function getEff()
    {
        $this->loadModel('Effect');
        return $this->Effect->find('all',array('order'=>'Effect.title ASC'));
        
    }
    function getSym()
    {
        $this->loadModel('Symptom');
        return $this->Symptom->find('all',array('order'=>'Symptom.title ASC'));
    }
}
