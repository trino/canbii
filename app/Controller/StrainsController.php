<?php
class StrainsController extends AppController{
    function index($slug)
    {
        $this->loadModel('OverallFlavorRating');
        $this->loadModel('Review');
        $q = $this->Strain->find('first',array('conditions'=>array('slug'=>$slug)));
        $q2 = $this->OverallFlavorRating->find('all',array('conditions'=>array('strain_id'=>$q['Strain']['id']),'order'=>'rate DESC','limit'=>3));
        $q3 = $this->Review->find('first',array('conditions'=>array('strain_id'=>$q['Strain']['id']),'order'=>'Review.helpful DESC'));
        $q4 = $this->Review->find('first',array('conditions'=>array('strain_id'=>$q['Strain']['id']),'order'=>'Review.id DESC'));
        $this->set('strain',$q);
        $this->set('flavor',$q2);
        $this->set('helpful',$q3);
        $this->set('recent',$q4);
        $this->Strain->id = $q['Strain']['id'];
        $viewed = $q['Strain']['viewed']+1;
        $this->Strain->saveField('viewed',$viewed);
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->loadModel('VoteIp');
        $q5 = $this->VoteIp->find('all',array('conditions'=>array('review_id'=>$q3['Review']['id'],'ip'=>$ip)));
        if($q5)
        {
            $this->set('vote',1);
        }
        else
        $this->set('vote',0);
        
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
        $this->loadModel('VoteIp');
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->VoteIp->create();
        $arr['review_id'] = $id;
        $arr['ip'] = $ip;
        $this->VoteIp->save($arr);
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
                $condition = $condition.'Strain.id IN (SELECT strain_id FROM reviews WHERE id IN (SELECT review_id
FROM effect_ratings
WHERE effect_id
IN ( '.$e;
 
                else
                $condition = $condition.','.$e;
            }
            $condition = $condition.')GROUP BY review_id
HAVING COUNT( effect_id ) ='.count($effects).'))';
            
            
        }
        if($symptoms)
        {
            $i=0;
            foreach($symptoms as $e)
            {
                
                $i++;
                if($i==1){
                    if($effects)
                $condition = $condition.' AND ';
                $condition = $condition.'Strain.id IN (SELECT strain_id FROM reviews WHERE id IN (SELECT review_id
FROM symptom_ratings
WHERE symptom_id
IN ( '.$e;
}
 
                else
                $condition = $condition.','.$e;
            }
            $condition = $condition.')GROUP BY review_id
HAVING COUNT( symptom_id ) ='.count($symptoms).'))';
        }
        if(!$condition)
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%'),'order'=>'Strain.id DESC')));
        else
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%',$condition),'order'=>'Strain.id DESC')));
        $this->render('all');
    }
    
    
    function filter(){
        $this->layout = 'blank';
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
                $condition = $condition.'Strain.id IN (SELECT strain_id FROM reviews WHERE id IN (SELECT review_id
FROM effect_ratings
WHERE effect_id
IN ( '.$e;
 
                else
                $condition = $condition.','.$e;
            }
            $condition = $condition.')GROUP BY review_id
HAVING COUNT( effect_id ) ='.count($effects).'))';
            
            
        }
        if($symptoms)
        {
            $i=0;
            foreach($symptoms as $e)
            {
                
                $i++;
                if($i==1){
                    if($effects)
                $condition = $condition.' AND ';
                $condition = $condition.'Strain.id IN (SELECT strain_id FROM reviews WHERE id IN (SELECT review_id
FROM symptom_ratings
WHERE symptom_id
IN ( '.$e;
}
 
                else
                $condition = $condition.','.$e;
            }
            $condition = $condition.')GROUP BY review_id
HAVING COUNT( symptom_id ) ='.count($symptoms).'))';
        }
        if(isset($_GET['sort']))
        {
            $sort = $_GET['sort'];
            if($sort == 'recent')
            {
                $order = 'Strain.id DESC';
            }
            else
            if($sort == 'rated')
            {
                $order = 'Strain.rating DESC';
            }
            else
            if($sort == 'reviewed')
            {
                $order = 'Strain.review DESC';
            }
            else
            if($sort == 'viewed')
            {
                $order = 'Strain.viewed DESC';
            }
            else
            $order = 'Strain.name ASC';
        }
        else
        $order =array();
        //var_dump($order);die();
        if(!$condition){
            if(!$order)
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%'),'order'=>'Strain.id DESC')));
        else
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%'),'order'=>$order)));
        }
        else{
            if(!$order)
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%',$condition),'order'=>'Strain.id DESC')));
        else
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%',$condition),'order'=>$order)));
        }
    }
    function review($slug,$sort=null)
    {
        $this->loadModel('Review');
        $q = $this->Strain->findBySlug($slug);
        if(!$sort || $sort=='recent')
        $q2 = $this->Review->find('all',array('conditions'=>array('Review.strain_id'=>$q['Strain']['id']),'order'=>'Review.id DESC'));
        else
        {
            $q2 = $this->Review->find('all',array('conditions'=>array('Review.strain_id'=>$q['Strain']['id']),'order'=>'Review.helpful DESC'));
        }
        $this->set('strain',$q);
        $this->set('review',$q2);
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->loadModel('VoteIp');
        $this->set('vip',$this->VoteIp);
        
    }
    function ajax_search()
    {
        $str = $_POST['str'];
        $search = $this->Strain->find("all",array('conditions'=>array('name LIKE'=>"%".$str."%")));
        foreach($search as $s)
        {
            echo "<a href='javascript:void(0);' class='btn opt' title='".$s['Strain']['slug']."'>".$s['Strain']['name']."</a>";
        }
        die();
    }
}

?>