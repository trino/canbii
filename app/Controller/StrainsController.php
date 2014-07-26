<?php
class StrainsController extends AppController{
    function index($slug)
    {
        $this->loadModel('OverallFlavorRating');
        $this->loadModel('Review');
        $q = $this->Strain->find('first',array('conditions'=>array('slug'=>$slug)));
        $q2 = $this->OverallFlavorRating->find('all',array('conditions'=>array('strain_id'=>$q['Strain']['id']),'order'=>'rate DESC','limit'=>3));
        $q3 = $this->Review->find('first',array('conditions'=>array('strain_id'=>$q['Strain']['id']),'order'=>'helpful DESC'));
        $q4 = $this->Review->find('first',array('conditions'=>array('strain_id'=>$q['Strain']['id']),'order'=>'id DESC'));
        $this->set('strain',$q);
        $this->set('flavor',$q2);
        $this->set('helpful',$q3);
        $this->set('recent',$q4);
        
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
    function getPosEff($id)
    {
        $this->loadModel('Effect');
        $q = $this->Effect->findById($id);
        if($q['Effect']['negative']==0)
        return true;
        else
        return false;
    }
    function getUserName($id)
    {
        $this->loadModel('User');
        $q = $this->User->findById($id);
        return $q['User']['username'];
    }
    function helpful($id,$yes)
    {
        $this->loadModel('Review');
        $q =  $this->Review->findById($id);
        if($yes == 'yes')
        $helpful = $q['Review']['helpful']+1;
        else
        $helpful = $q['Review']['helpful']-1;
        $this->Review->id = $id;
        
        $this->Review->saveField('helpful',$helpful);
        die();
    }
    function all($type='')
    {
        $arr=array('indica'=>1,'sativa'=>2,'hybrid'=>3);
        if($type=='')
        $this->set('strain',$this->Strain->find('all',array('order'=>'Strain.id DESC')));
        else
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('type_id'=>$arr[$type]),'order'=>'Strain.id DESC')));
        
    }
    function search()
    {
        if(isset($_GET['key']))
        $key = $_GET['key'];
        else
        $key='';
        $condition='';
        if(isset($_GET['effects']))
        $effects = $_GET['effects'];
        else
        $effects = array();
        if(isset($_GET['symptoms']))
        $symptoms = $_GET['symptoms'];
        else
        $symptoms = array();
        if($effects)
        {
            $i=0;
            foreach($effects as $e)
            {
                $i++;
                if($i==1)
                $condition = $condition.'Strain.id IN (SELECT strain_id FROM reviews WHERE id IN (SELECT review_id FROM effect_ratings WHERE effect_id IN('.$e;
                else
                $condition = $condition.','.$e;
            }
            $condition = $condition.')))';
            
        }
        if($symptoms)
        {
            $i=0;
            foreach($symptoms as $e)
            {
                if($effects)
                $condition = $condition.' AND ';
                $i++;
                if($i==1)
                $condition = $condition.'Strain.id IN (SELECT strain_id FROM reviews WHERE id IN (SELECT review_id FROM symptom_ratings WHERE symptom_id IN('.$e;
                else
                $condition = $condition.','.$e;
            }
            $condition = $condition.')))';
        }
        if(!$condition)
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%'),'order'=>'Strain.id DESC')));
        else
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%',$condition),'order'=>'Strain.id DESC')));
        
    }
    function review($slug)
    {
        $q = $this->Strain->findBySlug($slug);
        $this->set('strain',$q);
    }
}

?>