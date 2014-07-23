<?php
class StrainsController extends AppController{
    function index($slug)
    {
        $q = $this->Strain->find('first',array('conditions'=>array('slug'=>$slug)));
        $this->set('strain',$q);
    }
    function getFlavor($id)
    {
        $this->loadModel('Flavor');
        $q = $this->Flavor->findById($id);
        return $q['Flavor']['title'];die();
    }
    function getEffect($id)
    {
        $this->loadModel('Effect');
        $q = $this->Effect->findById($id);
        return $q['Effect']['title'];die();
    }
    function getSymptom($id)
    {
        $this->loadModel('Symptom');
        $q = $this->Symptom->findById($id);
        return $q['Symptom']['title'];die();
    }
}
?>