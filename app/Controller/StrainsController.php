<?php
class StrainsController extends AppController{
    
      public $components = array('Paginator','RequestHandler');
      public $helpers = array('Js');
    function index($slug)
    {
        $this->loadModel('Country');
        $this->set('countries',$this->Country->find('all'));
        $this->loadModel('OverallFlavorRating');
        $this->loadModel('Review');
        $this->loadModel('FlavorRating');
        
        $q = $this->Strain->find('first',array('conditions'=>array('slug'=>$slug)));
        
        $this->set('title',$q['Strain']['name']);
        $this->set('description',$q['Strain']['description']);
        $this->set('keyword',$q['Strain']['name'].' , Canbii , Medical , Marijuana , Medical Marijuana');
        
        
        
        
        
        $u_cond = '';
        if(isset($_GET['nationality']))
        {
            $u_cond = 'nationality = "'.$_GET['nationality'].'"';
        }
        if(isset($_GET['country']))
        {
            if(!$u_cond)
            $u_cond = 'country = "'.$_GET['country'].'"';
            else
            $u_cond = $u_cond.' AND country = "'.$_GET['country'].'"';
        }
        if(isset($_GET['gender']))
        {
            if(!$u_cond)
            $u_cond = 'gender = "'.$_GET['gender'].'"';
            else
            $u_cond = $u_cond.' AND gender = "'.$_GET['gender'].'"';
        }
        if(isset($_GET['age_group']))
        {
            if(!$u_cond)
            $u_cond = 'age_group = "'.$_GET['age_group'].'"';
            else
            $u_cond = $u_cond.' AND age_group = "'.$_GET['age_group'].'"';
        }
        if(isset($_GET['health']))
        {
            if(!$u_cond)
            $u_cond = 'health = "'.$_GET['health'].'"';
            else
            $u_cond = $u_cond.' AND health = "'.$_GET['health'].'"';
        }
        if(isset($_GET['weight']))
        {
            if(!$u_cond)
            $u_cond = 'weight = "'.$_GET['weight'].'"';
            else
            $u_cond = $u_cond.' AND weight = "'.$_GET['weight'].'"';
        }
        if(isset($_GET['years_of_experience']))
        {
            if(!$u_cond)
            $u_cond = 'years_of_experience = "'.$_GET['years_of_experience'].'"';
            else
            $u_cond = $u_cond.' AND years_of_experience = "'.$_GET['years_of_experience'].'"';
        }
        if(isset($_GET['frequency']))
        {
            if(!$u_cond)
            $u_cond = 'frequency = "'.$_GET['frequency'].'"';
            else
            $u_cond = $u_cond.' AND frequency = "'.$_GET['frequency'].'"';
        }
        if(isset($_GET['body_type']))
        {
            if(!$u_cond)
            $u_cond = 'body_type = "'.$_GET['body_type'].'"';
            else
            $u_cond = $u_cond.' AND body_type = "'.$_GET['body_type'].'"';
        }
        if($u_cond)
        {
            $profile_filter = 'SELECT id FROM users WHERE '.$u_cond;
        }
        else
        $profile_filter = '';
        
        
        
        
        
        if($profile_filter)        
        $q2 = $this->FlavorRating->find('all',array('conditions'=>array('strain_id'=>$q['Strain']['id'],'user_id IN ('.$profile_filter.')'),'order'=>'COUNT(flavor_id) DESC','group'=>'flavor_id','limit'=>3));
        else
        $q2 = $this->FlavorRating->find('all',array('conditions'=>array('strain_id'=>$q['Strain']['id']),'order'=>'COUNT(flavor_id) DESC','group'=>'flavor_id','limit'=>3));
        
        
        if($profile_filter)        
        $q3 = $this->Review->find('first',array('conditions'=>array('strain_id'=>$q['Strain']['id'],'user_id IN ('.$profile_filter.')'),'order'=>'Review.helpful DESC'));
        else                
        $q3 = $this->Review->find('first',array('conditions'=>array('strain_id'=>$q['Strain']['id']),'order'=>'Review.helpful DESC'));
        
        if($profile_filter)
        $q4 = $this->Review->find('first',array('conditions'=>array('strain_id'=>$q['Strain']['id'],'user_id IN ('.$profile_filter.')'),'order'=>'Review.id DESC'));
        else
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
        $q5 = $this->VoteIp->find('first',array('conditions'=>array('review_id'=>$q3['Review']['id'],'ip'=>$ip)));
        if($q5)
        {
            $this->set('vote',1);
            $this->set('yes',$q5['VoteIp']['vote_yes']);
            
        }
        else
        $this->set('vote',0);
        $this->set('profile_filter',$profile_filter);
        
                
        
        
        
    }
    function download($slug = null) {
        // Include Component
        App::import('Component', 'Pdf');
        // Make instance
        $Pdf = new PdfComponent();
        // Invoice name (output name)
        $Pdf->filename = 'your_invoice'; // Without .pdf
        // You can use download or browser here
        $Pdf->output = 'download';
        $Pdf->init();
        // Render the view
        $Pdf->process(Router::url('/', true) . 'strains/index/'. $slug);
        die();
        $this->render(false);
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
        if($yes == 'yes'){
        $helpful = $q['Review']['helpful']+1;
        $not_helpful = $q['Review']['not_helpful'];
        }
        else{
        $not_helpful = $q['Review']['not_helpful']+1;
        $helpful = $q['Review']['helpful'];
        }
        $this->loadModel('VoteIp');
        $ip = $_SERVER['REMOTE_ADDR'];
        if(!$this->VoteIp->find('first',array('conditions'=>array('review_id'=>$id,'ip'=>$ip)))){
        $this->Review->id = $id;        
        $this->Review->saveField('helpful',$helpful);
        $this->Review->saveField('not_helpful',$not_helpful);
        
        
        $this->VoteIp->create();
        $arr['review_id'] = $id;
        $arr['ip'] = $ip;
        if($yes =='yes')
        $arr['vote_yes'] = 1;
        else
        $arr['vote_yes'] = 0;
        
        $this->VoteIp->save($arr);
        }
        die();
    }
    function all($type='',$limit=0)
    {
        $this->loadModel('Country');
        $this->set('countries',$this->Country->find('all'));
        $this->set('type',$type);
        $this->set('limit',$limit);
        if($limit){
            $offset =$limit;
            $limit = '8';
         
        }
        else{
            $limit = 8;
            $offset = 0;
        }
        $arr=array('indica'=>1,'sativa'=>2,'hybrid'=>3);
        
        
        if($type=='')
        {
            $this->set('strains',$this->Strain->find('count'));
            $this->set('strain',$this->Strain->find('all',array('order'=>'Strain.id DESC','limit'=>$limit)));
        }
        else
        {
            $this->set('strain',$this->Strain->find('all',array('conditions'=>array('type_id'=>$arr[$type]),'order'=>'Strain.id DESC','limit'=>$limit,'offset'=>$offset)));
            $this->set('strains',$this->Strain->find('count',array('conditions'=>array('type_id'=>$arr[$type]))));
        }
        
        /*      
        {
            $this->Paginator->settings = array(
                'order' => array('Strain.id' => 'desc'),
                'conditions'=>array('type_id'=>$arr[$type]),
                'limit' => 1
            );
            $this->set('strain',$this->Paginator->paginate('Strain'));
        }*/
    }
    
    function search($type='',$limit=0)
    {
        $this->set('type',$type);
        $this->set('limit',$limit);
        if($limit){
            $offset =$limit;
        $limit = '8';
         
        }
        else{
        $limit = 8;
        $offset = 0;
        }
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
        {
            $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%'),'order'=>'Strain.id DESC','limit'=>$limit,'offset'=>$offset)));
            $this->set('strains',$this->Strain->find('count',array('conditions'=>array('name LIKE'=>'%'.$key.'%'))));
        }
        else
        {
            $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%',$condition),'order'=>'Strain.id DESC','limit'=>$limit,'offset'=>$offset)));
            $this->set('strains',$this->Strain->find('count',array('conditions'=>array('name LIKE'=>'%'.$key.'%',$condition))));
        }
        $this->render('all');
    }
    
    function getEffectRate($profile_filter,$strain)
    {
        //echo urlencode("SELECT id FROM users WHERE nationality='asian'");die();
        //echo $profile_filter;die();
        
        $this->loadModel('Effect_rating');
        $q = $this->Effect_rating->find('all',array('conditions'=>array('user_id IN ('.$profile_filter.') AND rate <> 0 AND strain_id = '.$strain),'order'=>'effect_id'));
        return $q;
    }
    function getSymptomRate($profile_filter,$strain)
    {
        //echo urlencode("SELECT id FROM users WHERE nationality='asian'");die();
        //echo $profile_filter;die();
        $this->loadModel('SymptomRating');
        $q = $this->SymptomRating->find('all',array('conditions'=>array('user_id IN ('.$profile_filter.') AND rate <> 0 AND strain_id = '.$strain),'order'=>'symptom_id'));
        return $q;
    }
    function getEffectReview($profile_filter,$strain)
    {
        $this->loadModel('Review');
        $q = $this->Review->find('all',array('conditions'=>array('user_id IN ('.$profile_filter.') AND strain_id = '.$strain)));
        return $q;
    }
    function filter($limit=0,$type=''){
        $this->loadModel('Country');
        $this->set('countries',$this->Country->find('all'));
        $this->set('limit',$limit);
        $this->set('type',$type);
        if($limit){
            $offset =$limit;
        $limit = '8';
         
        }
        else{
        $limit = 8;
        $offset = 0;
        }
        //echo $limit;die();
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
        if(isset($_GET['sort']))
        $test_sort = $_GET['sort'];
        else
        $test_sort = '';
        
        $u_cond = '';
        if(isset($_GET['nationality']))
        {
            $u_cond = 'nationality = "'.$_GET['nationality'].'"';
        }
        if(isset($_GET['country']))
        {
            if(!$u_cond)
            $u_cond = 'country = "'.$_GET['country'].'"';
            else
            $u_cond = $u_cond.' AND country = "'.$_GET['country'].'"';
        }
        if(isset($_GET['gender']))
        {
            if(!$u_cond)
            $u_cond = 'gender = "'.$_GET['gender'].'"';
            else
            $u_cond = $u_cond.' AND gender = "'.$_GET['gender'].'"';
        }
        if(isset($_GET['age_group_from']))
        {
            if(isset($_GET['age_group_to']))
            $to = $_GET['age_group_to'];
            else
            $to = 100;
            if(!$to)
            $to=100;
            $from = $_GET['age_group_from'];
            if($from<20)
            $from=20;
            $from++;
            $counter=0;
            for($i=$from;$i<=$to;$i++)
            {
                $counter++;
                $j=$i+9;
                $group = $i.'-'.$j;
                $i=$j;
                if($counter==1){
                if(!$u_cond)
                $u_cond = '(age_group = "'.$group.'"';
                else
                $u_cond = $u_cond.' AND (age_group = "'.$group.'"';
                }
                else
                {
                    ' OR age_group = "'.$group.'"';
                }    
            }
            $u_cond = $u_cond.')';
            
        }
        if(isset($_GET['health']))
        {
            if(!$u_cond)
            $u_cond = 'health = "'.$_GET['health'].'"';
            else
            $u_cond = $u_cond.' AND health = "'.$_GET['health'].'"';
        }
        
        if(isset($_GET['weight_from']))
        {   
            if(isset($_GET['weight_from']))
            $to = $_GET['weight_from'];
            else
            $to = 280;
            if(!$to)
            $to=280;
            
            $from = $_GET['weight_from'];
            if($from>100)            
            $from++;
            $counter=0;
            for($i=$from;$i<=$to;$i++)
            {
                $counter++;
                if($i>100)
                $j=$i+9;
                else
                $j=$i+10;
                $group = $i.'-'.$j;
                $i=$j;
                if($counter==1){
                if(!$u_cond)
                $u_cond = '(weight = "'.$group.'"';
                else
                $u_cond = $u_cond.' AND (weight = "'.$group.'"';
                }
                else
                {
                    ' OR weight = "'.$group.'"';
                }    
            }
            $u_cond = $u_cond.')';
            
        }
        
        if(isset($_GET['years_of_experience_from']))
        {
            if(isset($_GET['years_of_experience_from']))
            $to = $_GET['years_of_experience_from'];
            else
            $to = 50;
            if(!$to)
            $to=50;
            $from = $_GET['years_of_experience_from'];
            
            
                if(!$u_cond)
                $u_cond = 'years_of_experience >= '.$from.' AND years_of_experience <= '.$to;
                else
                $u_cond = $u_cond.' AND years_of_experience >= '.$group.' AND years_of_experience <= '.$to;
                
            
        }
        if(isset($_GET['frequency']))
        {
            if(!$u_cond)
            $u_cond = 'frequency = "'.$_GET['frequency'].'"';
            else
            $u_cond = $u_cond.' AND frequency = "'.$_GET['frequency'].'"';
        }
        if(isset($_GET['body_type']))
        {
            if(!$u_cond)
            $u_cond = 'body_type = "'.$_GET['body_type'].'"';
            else
            $u_cond = $u_cond.' AND body_type = "'.$_GET['body_type'].'"';
        }
        if($u_cond)
        {
            $profile_filter = 'SELECT id FROM users WHERE '.$u_cond;
        }
        else
        $profile_filter = '';
        if(isset($_GET['sort']) && ($_GET['sort']=='indica' || $_GET['sort']=='sativa' || $_GET['sort']=='hybrid') )
        {
            $s_arr = array('indica'=>1,'sativa'=>2,'hybrid'=>3);
            $condition = 'Strain.type_id = '.$s_arr[$_GET['sort']];
            $_GET['sort'] = 'alpha';
            
        }
        if($effects)
        {
            if(isset($_GET['sort']) &&($test_sort=='indica' || $test_sort=='sativa' || $test_sort=='hybrid') )
            $condition = $condition.' AND ';
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
            if($profile_filter)            
            $condition = $condition.')GROUP BY review_id
                                    HAVING COUNT( effect_id ) ='.count($effects).') AND user_id IN ('.$profile_filter.'))';
            else
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
                if(isset($_GET['sort']) &&($test_sort=='indica' || $test_sort=='sativa' || $test_sort=='hybrid') ){
                if(!$effects)    
                $condition = $condition.' AND ';
                }
                $condition = $condition.'Strain.id IN (SELECT strain_id FROM reviews WHERE id IN (SELECT review_id
                                            FROM symptom_ratings
                                            WHERE symptom_id
                                            IN ( '.$e;
                                            }
 
                else
                $condition = $condition.','.$e;
            }
            if($profile_filter)
            $condition = $condition.')GROUP BY review_id
                                    HAVING COUNT( symptom_id ) ='.count($symptoms).') AND user_id IN ('.$profile_filter.'))';
            else
            $condition = $condition.')GROUP BY review_id
                                    HAVING COUNT( symptom_id ) ='.count($symptoms).'))';
                                                
        }
        if(isset($_GET['sort']) && ($test_sort!='indica' && $test_sort!='sativa' && $test_sort!='hybrid'))
        {
            $sort = $_GET['sort'];
            if($sort == 'recent')
            {
                $order = 'Strain.id '.$_GET['order'];
            }
            else
            if($sort == 'rated')
            {
                $order = 'Strain.rating '.$_GET['order'];
            }
            else
            if($sort == 'reviewed')
            {
                $order = 'Strain.review '.$_GET['order'];
            }
            else
            if($sort == 'viewed')
            {
                $order = 'Strain.viewed '.$_GET['order'];
            }
            else
            $order = 'Strain.name '.$_GET['order'];
        }
        else
        {
            $order =array();
            
        }
        
        //var_dump($order);die();
        if($type==''){
        if(!$condition){
            if(!$order){
        if(!$profile_filter)                        
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%'),'order'=>'Strain.id DESC','limit'=>$limit,'offset'=>$offset)));
        else
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%','Strain.id IN (SELECT strain_id FROM reviews WHERE user_id IN ('.$profile_filter.'))'),'order'=>'Strain.id DESC','limit'=>$limit,'offset'=>$offset)));                
        }
        else{
                        
        if(!$profile_filter)                
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%'),'order'=>$order,'limit'=>$limit,'offset'=>$offset)));
        else
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%','Strain.id IN (SELECT strain_id FROM reviews WHERE user_id IN ('.$profile_filter.'))'),'order'=>$order,'limit'=>$limit,'offset'=>$offset)));                
        }
        if(!$profile_filter)
        $this->set('strains',$this->Strain->find('count',array('conditions'=>array('name LIKE'=>'%'.$key.'%'))));
        else
        $this->set('strains',$this->Strain->find('count',array('conditions'=>array('name LIKE'=>'%'.$key.'%','Strain.id IN (SELECT strain_id FROM reviews WHERE user_id IN ('.$profile_filter.'))'))));
        }
        else{
            if(!$order){
        if(!$profile_filter)                
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%',$condition),'order'=>'Strain.id DESC','limit'=>$limit,'offset'=>$offset)));
        else
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%',$condition),'order'=>'Strain.id DESC','limit'=>$limit,'offset'=>$offset)));
        }
        else
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('name LIKE'=>'%'.$key.'%',$condition),'order'=>$order,'limit'=>$limit,'offset'=>$offset)));
        
        $this->set('strains',$this->Strain->find('count',array('conditions'=>array('name LIKE'=>'%'.$key.'%',$condition))));
        }
        }
        else
        {
        $arr=array('indica'=>1,'sativa'=>2,'hybrid'=>3);            
        if(!$condition){
            if(!$order)
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('type_id'=>$arr[$type],'name LIKE'=>'%'.$key.'%','Strain.id IN (SELECT strain_id FROM reviews WHERE user_id IN ('.$profile_filter.'))'),'order'=>'Strain.id DESC','limit'=>$limit,'offset'=>$offset)));
        else
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('type_id'=>$arr[$type],'name LIKE'=>'%'.$key.'%','Strain.id IN (SELECT strain_id FROM reviews WHERE user_id IN ('.$profile_filter.'))'),'order'=>$order,'limit'=>$limit,'offset'=>$offset)));
        
        $this->set('strains',$this->Strain->find('count',array('conditions'=>array('type_id'=>$arr[$type],'name LIKE'=>'%'.$key.'%','Strain.id IN (SELECT strain_id FROM reviews WHERE user_id IN ('.$profile_filter.'))'))));
        }
        else{
            if(!$order)
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('type_id'=>$arr[$type],'name LIKE'=>'%'.$key.'%',$condition),'order'=>'Strain.id DESC','limit'=>$limit,'offset'=>$offset)));
        else
        $this->set('strain',$this->Strain->find('all',array('conditions'=>array('type_id'=>$arr[$type],'name LIKE'=>'%'.$key.'%',$condition),'order'=>$order,'limit'=>$limit,'offset'=>$offset)));
        $this->set('strains',$this->Strain->find('count',array('conditions'=>array('type_id'=>$arr[$type],'name LIKE'=>'%'.$key.'%',$condition))));
        }    
        }
		
    }
    function review($slug,$sort=null,$limit=0)
    {
        $this->loadModel('Review');
        $this->loadModel('Country');
        $this->set('countries',$this->Country->find('all'));
        $this->set('limit',$limit);
        $this->set('slug',$slug);
        
        
        $u_cond = '';
        if(isset($_GET['nationality']))
        {
            $u_cond = 'nationality = "'.$_GET['nationality'].'"';
        }
        if(isset($_GET['country']))
        {
            if(!$u_cond)
            $u_cond = 'country = "'.$_GET['country'].'"';
            else
            $u_cond = $u_cond.' AND country = "'.$_GET['country'].'"';
        }
        if(isset($_GET['gender']))
        {
            if(!$u_cond)
            $u_cond = 'gender = "'.$_GET['gender'].'"';
            else
            $u_cond = $u_cond.' AND gender = "'.$_GET['gender'].'"';
        }
        if(isset($_GET['age_group']))
        {
            if(!$u_cond)
            $u_cond = 'age_group = "'.$_GET['age_group'].'"';
            else
            $u_cond = $u_cond.' AND age_group = "'.$_GET['age_group'].'"';
        }
        if(isset($_GET['health']))
        {
            if(!$u_cond)
            $u_cond = 'health = "'.$_GET['health'].'"';
            else
            $u_cond = $u_cond.' AND health = "'.$_GET['health'].'"';
        }
        if(isset($_GET['weight']))
        {
            if(!$u_cond)
            $u_cond = 'weight = "'.$_GET['weight'].'"';
            else
            $u_cond = $u_cond.' AND weight = "'.$_GET['weight'].'"';
        }
        if(isset($_GET['years_of_experience']))
        {
            if(!$u_cond)
            $u_cond = 'years_of_experience = "'.$_GET['years_of_experience'].'"';
            else
            $u_cond = $u_cond.' AND years_of_experience = "'.$_GET['years_of_experience'].'"';
        }
        if(isset($_GET['frequency']))
        {
            if(!$u_cond)
            $u_cond = 'frequency = "'.$_GET['frequency'].'"';
            else
            $u_cond = $u_cond.' AND frequency = "'.$_GET['frequency'].'"';
        }
        if(isset($_GET['body_type']))
        {
            if(!$u_cond)
            $u_cond = 'body_type = "'.$_GET['body_type'].'"';
            else
            $u_cond = $u_cond.' AND body_type = "'.$_GET['body_type'].'"';
        }
        if($u_cond)
        {
            $profile_filter = 'SELECT id FROM users WHERE '.$u_cond;
        }
        else
        $profile_filter = '';
        
        
        
        if($limit){
            $offset = $limit;
            $limit = '8';
         
        }
        else{
            $limit = 8;
            $offset = 0;
        }
        $q = $this->Strain->findBySlug($slug);
        if(!$sort || $sort=='recent'){
            if(!isset($_GET['user']))
            {    
                if(!$profile_filter)
                $q2 = $this->Review->find('all',array('conditions'=>array('Review.strain_id'=>$q['Strain']['id']),'order'=>'Review.id DESC','limit'=>$limit,'offset'=>$offset));
                else
                $q2 = $this->Review->find('all',array('conditions'=>array('Review.strain_id'=>$q['Strain']['id'],'Review.user_id IN ('.$profile_filter.')'),'order'=>'Review.id DESC','limit'=>$limit,'offset'=>$offset));
                $this->set('reviewz', $this->Review->find('count',array('conditions'=>array('Review.strain_id'=>$q['Strain']['id']))) );
            }
            else
            {
                $q2 = $this->Review->find('all',array('conditions'=>array('Review.user_id'=>$_GET['user']),'order'=>'Review.id DESC','limit'=>$limit,'offset'=>$offset));
                $this->set('reviewz', $this->Review->find('count',array('conditions'=>array('Review.user_id'=>$_GET['user']))) );
            }
        }
        else
        {
            if(!isset($_GET['user']))
            {
                $q2 = $this->Review->find('all',array('conditions'=>array('Review.strain_id'=>$q['Strain']['id']),'order'=>'Review.helpful DESC','limit'=>$limit,'offset'=>$offset));
                $this->set('reviewz', $this->Review->find('count',array('conditions'=>array('Review.strain_id'=>$q['Strain']['id']))) );
            }
            else
            {
                $q2 = $this->Review->find('all',array('conditions'=>array('Review.user_id'=>$_GET['user']),'order'=>'Review.helpful DESC','limit'=>$limit,'offset'=>$offset));
                $this->set('reviewz', $this->Review->find('count',array('conditions'=>array('Review.user_id'=>$_GET['user']))) );
            }
        }
        
        
        $this->loadModel('VoteIp');
        $this->set('vip',$this->VoteIp);
        if(isset($_GET['user'])){
            $this->set('reviews',$q2);
            $this->render('/review/all');
        }
        else
        {
           $this->set('strain',$q);
            $this->set('review',$q2); 
        }
        
    }
    function review_filter($slug,$sort,$limit)
    {
        $this->set('limit',$limit);
        $this->set('slug',$slug);
        $this->set('sort',$sort);
        
        $u_cond = '';
        if(isset($_GET['nationality']))
        {
            $u_cond = 'nationality = "'.$_GET['nationality'].'"';
        }
        if(isset($_GET['country']))
        {
            if(!$u_cond)
            $u_cond = 'country = "'.$_GET['country'].'"';
            else
            $u_cond = $u_cond.' AND country = "'.$_GET['country'].'"';
        }
        if(isset($_GET['gender']))
        {
            if(!$u_cond)
            $u_cond = 'gender = "'.$_GET['gender'].'"';
            else
            $u_cond = $u_cond.' AND gender = "'.$_GET['gender'].'"';
        }
        if(isset($_GET['age_group']))
        {
            if(!$u_cond)
            $u_cond = 'age_group = "'.$_GET['age_group'].'"';
            else
            $u_cond = $u_cond.' AND age_group = "'.$_GET['age_group'].'"';
        }
        if(isset($_GET['health']))
        {
            if(!$u_cond)
            $u_cond = 'health = "'.$_GET['health'].'"';
            else
            $u_cond = $u_cond.' AND health = "'.$_GET['health'].'"';
        }
        if(isset($_GET['weight']))
        {
            if(!$u_cond)
            $u_cond = 'weight = "'.$_GET['weight'].'"';
            else
            $u_cond = $u_cond.' AND weight = "'.$_GET['weight'].'"';
        }
        if(isset($_GET['years_of_experience']))
        {
            if(!$u_cond)
            $u_cond = 'years_of_experience = "'.$_GET['years_of_experience'].'"';
            else
            $u_cond = $u_cond.' AND years_of_experience = "'.$_GET['years_of_experience'].'"';
        }
        if(isset($_GET['frequency']))
        {
            if(!$u_cond)
            $u_cond = 'frequency = "'.$_GET['frequency'].'"';
            else
            $u_cond = $u_cond.' AND frequency = "'.$_GET['frequency'].'"';
        }
        if(isset($_GET['body_type']))
        {
            if(!$u_cond)
            $u_cond = 'body_type = "'.$_GET['body_type'].'"';
            else
            $u_cond = $u_cond.' AND body_type = "'.$_GET['body_type'].'"';
        }
        if($u_cond)
        {
            $profile_filter = 'SELECT id FROM users WHERE '.$u_cond;
        }
        else
        $profile_filter = '';
        
        
        
        if($limit){
            $offset =$limit;
        $limit = '8';
         
        }
        else{
        $limit = 8;
        $offset = 0;
        }
        //echo $limit;die();
        $this->layout = 'blank';
        
        $this->loadModel('Review');
        $q = $this->Strain->findBySlug($slug);
        if(!$sort || $sort=='recent'){
            if(!isset($_GET['user']))
            { 
                if(!$profile_filter)
                $q2 = $this->Review->find('all',array('conditions'=>array('Review.strain_id'=>$q['Strain']['id']),'order'=>'Review.id DESC','limit'=>$limit,'offset'=>$offset));
                else
                $q2 = $this->Review->find('all',array('conditions'=>array('Review.strain_id'=>$q['Strain']['id'],'Review.user_id IN ('.$profile_filter.')'),'order'=>'Review.id DESC','limit'=>$limit,'offset'=>$offset));
                if(!$profile_filter)
                $this->set('reviewz', $this->Review->find('count',array('conditions'=>array('Review.strain_id'=>$q['Strain']['id']))) );
                else
                $this->set('reviewz', $this->Review->find('count',array('conditions'=>array('Review.strain_id'=>$q['Strain']['id'],'Review.user_id IN ('.$profile_filter.')'))) );
                //var_dump($q2);die();
                
            }
            else
            {
                $q2 = $this->Review->find('all',array('conditions'=>array('Review.user_id'=>$_GET['user']),'order'=>'Review.id DESC','limit'=>$limit,'offset'=>$offset));
                $this->set('reviewz', $this->Review->find('count',array('conditions'=>array('Review.user_id'=>$_GET['user']))) );
            }
        }
        else
        {
            if(!isset($_GET['user']))
            {
                if(!$profile_filter)
                $q2 = $this->Review->find('all',array('conditions'=>array('Review.strain_id'=>$q['Strain']['id']),'order'=>'Review.helpful DESC','limit'=>$limit,'offset'=>$offset));
                else
                $q2 = $this->Review->find('all',array('conditions'=>array('Review.strain_id'=>$q['Strain']['id'],'Review.user_id IN ('.$profile_filter.')'),'order'=>'Review.helpful DESC','limit'=>$limit,'offset'=>$offset));
                if(!$profile_filter)
                $this->set('reviewz', $this->Review->find('count',array('conditions'=>array('Review.strain_id'=>$q['Strain']['id']))) );
                else
                $this->set('reviewz', $this->Review->find('count',array('conditions'=>array('Review.strain_id'=>$q['Strain']['id'],'Review.user_id IN ('.$profile_filter.')'))) );
            }
            else
            {
                $q2 = $this->Review->find('all',array('conditions'=>array('Review.user_id'=>$_GET['user']),'order'=>'Review.helpful DESC','limit'=>$limit,'offset'=>$offset));
                $this->set('reviewz', $this->Review->find('count',array('conditions'=>array('Review.user_id'=>$_GET['user']))) );
            }
        }
        
        
        $this->loadModel('VoteIp');
        $this->set('vip',$this->VoteIp);
        if(isset($_GET['user'])){
            $this->set('reviews',$q2);
            
        $this->render('/review/all');}
        else{
           $this->set('strain',$q);
        $this->set('review',$q2); 
        }
        
    }
    function ajax_search()
    {
        $str = $_POST['str'];
        $search = $this->Strain->find("all",array('conditions'=>array('name LIKE'=>"%".$str."%")));
        foreach($search as $s)
        {
            echo "<a href='".$this->webroot."review/add/".$s['Strain']['slug']."' class='more blue icon_small_arrow margin_right_white page_margin_top' style='margin-right:10px;' title='".$s['Strain']['slug']."'>".$s['Strain']['name']."</a>";
        }
        die();
    }
}

?>