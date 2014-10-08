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
