<?php
class StrainsController extends AppController{
    function index($slug)
    {
        $q = $this->Strain->find('first',array('conditions'=>array('slug'=>$slug)));
        $this->set('strain',$q);
    }
}
?>