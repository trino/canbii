<?php
//include(APP.'webroot/html2pdf.class.php');
class StrainsController extends AppController
{

    public $components = array('Paginator', 'RequestHandler');
    public $helpers = array('Js');

    function call($name){
        echo "<BR>Calling: " . $name . " at " . time() . "<BR>";
    }

    function index($slug) {
        //$this->call(__METHOD__);
        //if($this->Session->read('User')){  $this->set('user',$this->User->findById($this->Session->read('User.id'))); }

        $this->loadModel('Country');
        $this->set('countries', $this->Country->find('all'));
        $this->loadModel('OverallFlavorRating');
        $this->loadModel('Review');
        $this->loadModel('FlavorRating');
        $this->loadModel('SymptomVote');

        $q = $this->Strain->find('first', array('conditions' => array('slug' => $slug)));
        //debug($q );
        $this->set('title', $q['Strain']['name']);
        $this->set('description', $q['Strain']['description']);
        $this->set('keyword', $q['Strain']['name'] . ' , Canbii , Medical , Marijuana , Medical Marijuana');
        
        $params_vote_sum = array(
            "conditions"=>array("SymptomVote.strain_id"=>$q['Strain']['id']),
            "group"=>array("SymptomVote.symptom_id"),  
            'fields' => array('SymptomVote.symptom_id','SUM(SymptomVote.vote_yes) as sum'),
        );
        
        $votes_sum = $this->SymptomVote->find("all",$params_vote_sum);
        $votes_sum = Set::combine($votes_sum, '{n}.SymptomVote.symptom_id', '{n}.0.sum');
        
        $this->set("symptom_votes",$votes_sum);
        
        $params_vote_user = array(
                 "conditions"=>array("SymptomVote.strain_id"=>$q['Strain']['id'],
                                     "SymptomVote.client_http"=>md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']))
        );
        
        $vote_user = $this->SymptomVote->find("all",$params_vote_user);
        $vote_user = Set::combine($vote_user, '{n}.SymptomVote.symptom_id', '{n}.SymptomVote.vote_yes');
        
        //die(var_dump($vote_user));
        
        $this->set("symptom_vote_user",$vote_user);

        $u_cond = '';
        if (isset($_GET['nationality'])) {
            $u_cond = 'nationality = "' . $_GET['nationality'] . '"';
        }
        if (isset($_GET['country'])) {
            if (!$u_cond)
                $u_cond = 'country = "' . $_GET['country'] . '"';
            else
                $u_cond = $u_cond . ' AND country = "' . $_GET['country'] . '"';
        }
        if (isset($_GET['gender'])) {
            if (!$u_cond)
                $u_cond = 'gender = "' . $_GET['gender'] . '"';
            else
                $u_cond = $u_cond . ' AND gender = "' . $_GET['gender'] . '"';
        }
        if (isset($_GET['age_group_from'])) {
            if (isset($_GET['age_group_from']))
                $to = $_GET['age_group_to'];
            else
                $to = 100;
            if (!$to)
                $to = 100;
            $from = $_GET['age_group_from'];
            if ($from < 20)
                $from = 20;
            $from++;
            $counter = 0;
            for ($i = $from; $i <= $to; $i++) {
                $counter++;
                $j = $i + 9;
                $group = $i . '-' . $j;
                $i = $j;
                if ($counter == 1) {
                    if (!$u_cond)
                        $u_cond = '(age_group = "' . $group . '"';
                    else
                        $u_cond = $u_cond . ' AND (age_group = "' . $group . '"';
                } else {
                    ' OR age_group = "' . $group . '"';
                }
            }
            $u_cond = $u_cond . ')';

        }
        if (isset($_GET['health'])) {
            if (!$u_cond)
                $u_cond = 'health = "' . $_GET['health'] . '"';
            else
                $u_cond = $u_cond . ' AND health = "' . $_GET['health'] . '"';
        }

        if (isset($_GET['weight_from'])) {
            if (isset($_GET['weight_from']))
                $to = $_GET['weight_to'];
            else
                $to = 280;
            if (!$to)
                $to = 280;

            $from = $_GET['weight_from'];
            if ($from > 100)
                $from++;
            $counter = 0;
            for ($i = $from; $i <= $to; $i++) {
                $counter++;
                if ($i > 100)
                    $j = $i + 9;
                else
                    $j = $i + 10;
                $group = $i . '-' . $j;
                $i = $j;
                if ($counter == 1) {
                    if (!$u_cond)
                        $u_cond = '(weight = "' . $group . '"';
                    else
                        $u_cond = $u_cond . ' AND (weight = "' . $group . '"';
                } else {
                    ' OR weight = "' . $group . '"';
                }
            }
            $u_cond = $u_cond . ')';

        }

        if (isset($_GET['years_of_experience_from'])) {
            if (isset($_GET['years_of_experience_from']))
                $to = $_GET['years_of_experience_to'];
            else
                $to = 50;
            if (!$to)
                $to = 50;
            $from = $_GET['years_of_experience_from'];


            if (!$u_cond)
                $u_cond = 'years_of_experience >= ' . $from . ' AND years_of_experience <= ' . $to;
            else
                $u_cond = $u_cond . ' AND years_of_experience >= ' . $from . ' AND years_of_experience <= ' . $to;


        }
        if (isset($_GET['frequency'])) {
            if (!$u_cond)
                $u_cond = 'frequency = "' . $_GET['frequency'] . '"';
            else
                $u_cond = $u_cond . ' AND frequency = "' . $_GET['frequency'] . '"';
        }
        if (isset($_GET['body_type'])) {
            if (!$u_cond)
                $u_cond = 'body_type = "' . $_GET['body_type'] . '"';
            else
                $u_cond = $u_cond . ' AND body_type = "' . $_GET['body_type'] . '"';
        }
        if ($u_cond) {
            $profile_filter = 'SELECT id FROM users WHERE ' . $u_cond;
        } else
            $profile_filter = '';


        if ($profile_filter)
            $q2 = $this->FlavorRating->find('all', array('conditions' => array('strain_id' => $q['Strain']['id'], 'user_id IN (' . $profile_filter . ')'), 'order' => 'COUNT(flavor_id) DESC', 'group' => 'flavor_id', 'limit' => 3));
        else
            $q2 = $this->FlavorRating->find('all', array('conditions' => array('strain_id' => $q['Strain']['id']), 'order' => 'COUNT(flavor_id) DESC', 'group' => 'flavor_id', 'limit' => 3));


        if ($profile_filter)
            $q3 = $this->Review->find('first', array('conditions' => array('strain_id' => $q['Strain']['id'], 'user_id IN (' . $profile_filter . ')'), 'order' => 'Review.helpful DESC'));
        else
            $q3 = $this->Review->find('first', array('conditions' => array('strain_id' => $q['Strain']['id']), 'order' => 'Review.helpful DESC'));

        if ($profile_filter)
            $q4 = $this->Review->find('first', array('conditions' => array('strain_id' => $q['Strain']['id'], 'user_id IN (' . $profile_filter . ')'), 'order' => 'Review.id DESC'));
        else
            $q4 = $this->Review->find('first', array('conditions' => array('strain_id' => $q['Strain']['id']), 'order' => 'Review.id DESC'));

        $this->set('strain', $q);
        $this->set('flavor', $q2);
        $this->set('helpful', $q3);
        $this->set('recent', $q4);
        if ($q['Strain']['id']) {
            $this->Strain->id = $q['Strain']['id'];
            $viewed = $q['Strain']['viewed'] + 1;
            $this->Strain->saveField('viewed', $viewed);
        }

        $ip = $_SERVER['REMOTE_ADDR'];
        $this->loadModel('VoteIp');
        $q5 = false;
        if (isset($q3['Review'])) {
            $q5 = $this->VoteIp->find('first', array('conditions' => array('review_id' => $q3['Review']['id'], 'ip' => $ip)));
        }
        if ($q5) {
            $this->set('vote', 1);
            $this->set('yes', $q5['VoteIp']['vote_yes']);

        } else
            $this->set('vote', 0);
        $this->set('profile_filter', $profile_filter);


    }
    
    public function mergedReport($slug)
    {
        if(isset($_GET['doc'])){
        if($this->Session->read('User.id') && $this->Session->read('User.id')== $_GET['doc'])
        {
            $doc = $_GET['doc'];
        }
        else
        {
            $this->Session->setFlash('You are not logged in as the doctor who is authorized to view this report', 'default', array('class' => 'bad'));
            $this->redirect('/strains/'.$slug);
        }
        }
        else
        $this->redirect('/strains/'.$slug);
        $this->loadModel('Country');
        $this->set('countries', $this->Country->find('all'));
        $this->loadModel('OverallFlavorRating');
        $this->loadModel('Review');
        $this->loadModel('FlavorRating');
        $this->loadModel('SymptomVote');

        $q = $this->Strain->find('first', array('conditions' => array('slug' => $slug)));
        //debug($q );
        $this->set('title', $q['Strain']['name']);
        $this->set('description', $q['Strain']['description']);
        $this->set('keyword', $q['Strain']['name'] . ' , Canbii , Medical , Marijuana , Medical Marijuana');
        
        $params_vote_sum = array(
            "conditions"=>array("SymptomVote.strain_id"=>$q['Strain']['id']),
            "group"=>array("SymptomVote.symptom_id"),  
            'fields' => array('SymptomVote.symptom_id','SUM(SymptomVote.vote_yes) as sum'),
        );
        
        $votes_sum = $this->SymptomVote->find("all",$params_vote_sum);
        $votes_sum = Set::combine($votes_sum, '{n}.SymptomVote.symptom_id', '{n}.0.sum');
        
        $this->set("symptom_votes",$votes_sum);
        
        $params_vote_user = array(
                 "conditions"=>array("SymptomVote.strain_id"=>$q['Strain']['id'],
                                     "SymptomVote.client_http"=>md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']))
        );
        
        $vote_user = $this->SymptomVote->find("all",$params_vote_user);
        $vote_user = Set::combine($vote_user, '{n}.SymptomVote.symptom_id', '{n}.SymptomVote.vote_yes');
        
        //die(var_dump($vote_user));
        
        $this->set("symptom_vote_user",$vote_user);

        $u_cond = '';
        if (isset($_GET['nationality'])) {
            $u_cond = 'nationality = "' . $_GET['nationality'] . '"';
        }
        if (isset($_GET['country'])) {
            if (!$u_cond)
                $u_cond = 'country = "' . $_GET['country'] . '"';
            else
                $u_cond = $u_cond . ' AND country = "' . $_GET['country'] . '"';
        }
        if (isset($_GET['gender'])) {
            if (!$u_cond)
                $u_cond = 'gender = "' . $_GET['gender'] . '"';
            else
                $u_cond = $u_cond . ' AND gender = "' . $_GET['gender'] . '"';
        }
        if (isset($_GET['age_group_from'])) {
            if (isset($_GET['age_group_from']))
                $to = $_GET['age_group_to'];
            else
                $to = 100;
            if (!$to)
                $to = 100;
            $from = $_GET['age_group_from'];
            if ($from < 20)
                $from = 20;
            $from++;
            $counter = 0;
            for ($i = $from; $i <= $to; $i++) {
                $counter++;
                $j = $i + 9;
                $group = $i . '-' . $j;
                $i = $j;
                if ($counter == 1) {
                    if (!$u_cond)
                        $u_cond = '(age_group = "' . $group . '"';
                    else
                        $u_cond = $u_cond . ' AND (age_group = "' . $group . '"';
                } else {
                    ' OR age_group = "' . $group . '"';
                }
            }
            $u_cond = $u_cond . ')';

        }
        if (isset($_GET['health'])) {
            if (!$u_cond)
                $u_cond = 'health = "' . $_GET['health'] . '"';
            else
                $u_cond = $u_cond . ' AND health = "' . $_GET['health'] . '"';
        }

        if (isset($_GET['weight_from'])) {
            if (isset($_GET['weight_from']))
                $to = $_GET['weight_to'];
            else
                $to = 280;
            if (!$to)
                $to = 280;

            $from = $_GET['weight_from'];
            if ($from > 100)
                $from++;
            $counter = 0;
            for ($i = $from; $i <= $to; $i++) {
                $counter++;
                if ($i > 100)
                    $j = $i + 9;
                else
                    $j = $i + 10;
                $group = $i . '-' . $j;
                $i = $j;
                if ($counter == 1) {
                    if (!$u_cond)
                        $u_cond = '(weight = "' . $group . '"';
                    else
                        $u_cond = $u_cond . ' AND (weight = "' . $group . '"';
                } else {
                    ' OR weight = "' . $group . '"';
                }
            }
            $u_cond = $u_cond . ')';

        }

        if (isset($_GET['years_of_experience_from'])) {
            if (isset($_GET['years_of_experience_from']))
                $to = $_GET['years_of_experience_to'];
            else
                $to = 50;
            if (!$to)
                $to = 50;
            $from = $_GET['years_of_experience_from'];


            if (!$u_cond)
                $u_cond = 'years_of_experience >= ' . $from . ' AND years_of_experience <= ' . $to;
            else
                $u_cond = $u_cond . ' AND years_of_experience >= ' . $from . ' AND years_of_experience <= ' . $to;


        }
        if (isset($_GET['frequency'])) {
            if (!$u_cond)
                $u_cond = 'frequency = "' . $_GET['frequency'] . '"';
            else
                $u_cond = $u_cond . ' AND frequency = "' . $_GET['frequency'] . '"';
        }
        if (isset($_GET['body_type'])) {
            if (!$u_cond)
                $u_cond = 'body_type = "' . $_GET['body_type'] . '"';
            else
                $u_cond = $u_cond . ' AND body_type = "' . $_GET['body_type'] . '"';
        }
        if ($u_cond) {
            $profile_filter = 'SELECT id FROM users WHERE ' . $u_cond;
        } else
            $profile_filter = '';


        if ($profile_filter)
            $q2 = $this->FlavorRating->find('all', array('conditions' => array('strain_id' => $q['Strain']['id'], 'user_id IN (' . $profile_filter . ')','user_id IN (SELECT user_id FROM doctor_strains WHERE doctor_id = '.$this->Session->read('User.id').')'), 'order' => 'COUNT(flavor_id) DESC', 'group' => 'flavor_id', 'limit' => 3));
        else
            $q2 = $this->FlavorRating->find('all', array('conditions' => array('strain_id' => $q['Strain']['id'],'user_id IN (SELECT user_id FROM doctor_strains WHERE doctor_id = '.$this->Session->read('User.id').')'), 'order' => 'COUNT(flavor_id) DESC', 'group' => 'flavor_id', 'limit' => 3));


        if ($profile_filter)
            $q3 = $this->Review->find('first', array('conditions' => array('strain_id' => $q['Strain']['id'], 'user_id IN (' . $profile_filter . ')','user_id IN (SELECT user_id FROM doctor_strains WHERE doctor_id = '.$this->Session->read('User.id').')'), 'order' => 'Review.helpful DESC'));
        else
            $q3 = $this->Review->find('first', array('conditions' => array('strain_id' => $q['Strain']['id'],'user_id IN (SELECT user_id FROM doctor_strains WHERE doctor_id = '.$this->Session->read('User.id').')'), 'order' => 'Review.helpful DESC'));

        if ($profile_filter)
            $q4 = $this->Review->find('first', array('conditions' => array('strain_id' => $q['Strain']['id'], 'user_id IN (' . $profile_filter . ')','user_id IN (SELECT user_id FROM doctor_strains WHERE doctor_id = '.$this->Session->read('User.id').')'), 'order' => 'Review.id DESC'));
        else
            $q4 = $this->Review->find('first', array('conditions' => array('strain_id' => $q['Strain']['id'],'user_id IN (SELECT user_id FROM doctor_strains WHERE doctor_id = '.$this->Session->read('User.id').')'), 'order' => 'Review.id DESC'));
        
        if ($profile_filter)
            $q5 = $this->Review->find('all', array('conditions' => array('strain_id' => $q['Strain']['id'], 'user_id IN (' . $profile_filter . ')','user_id IN (SELECT user_id FROM doctor_strains WHERE doctor_id = '.$this->Session->read('User.id').')'), 'order' => 'Review.id DESC'));
        else
            $q5 = $this->Review->find('all', array('conditions' => array('strain_id' => $q['Strain']['id'],'user_id IN (SELECT user_id FROM doctor_strains WHERE doctor_id = '.$this->Session->read('User.id').')'), 'order' => 'Review.id DESC'));
            
            $this->loadModel('DoctorStrain');
            
            $q6 = $this->DoctorStrain->find('all',array('conditions'=>array('doctor_id'=>$this->Session->read('User.id'))));
            $arr_user = array();
            if($q6)
            {
                foreach($q6 as $d)
                {
                    $arr_user[] = $d['DoctorStrain']['user_id'];
                }
            }
            $this->set('arr_user',$arr_user); 
        $this->set('strain', $q);
        $this->set('flavor', $q2);
        $this->set('helpful', $q3);
        $this->set('recent', $q4);
        $avg = 0;
        $cou = 0;
        $scale = 0;
        $strength = 0;
        $duration = 0;
        //echo count($q5);
        foreach($q5 as $r)
        {
            //echo $r['Review']['eff_scale'];
            $cou++;
            $avg = $avg+$r['Review']['rate'];
            $scale = $scale+$r['Review']['eff_scale'];
            $strength = $strength+$r['Review']['eff_strength'];
            $duration = $duration+$r['Review']['eff_duration'];
        }
        if($avg!=0)
        $avg = $avg/$cou;
        
        
        
        $this->set('avg',$avg);
        if($cou)
         $this->set('scale',$scale*10/($cou));
         else
         $this->set('scale',0);
         if($cou)
        $this->set('strength',$strength*10/($cou));
        else
        $this->set('strength',0);
        if($cou)
        $this->set('duration',$duration*10/($cou));
        else
        $this->set('duration',0);
        
        if ($q['Strain']['id']) {
            $this->Strain->id = $q['Strain']['id'];
            $viewed = $q['Strain']['viewed'] + 1;
            $this->Strain->saveField('viewed', $viewed);
        }

        $ip = $_SERVER['REMOTE_ADDR'];
        $this->loadModel('VoteIp');
        $q5 = false;
        if (isset($q3['Review'])) {
            $q5 = $this->VoteIp->find('first', array('conditions' => array('review_id' => $q3['Review']['id'], 'ip' => $ip)));
        }
        if ($q5) {
            $this->set('vote', 1);
            $this->set('yes', $q5['VoteIp']['vote_yes']);

        } else
            $this->set('vote', 0);
        $this->set('profile_filter', $profile_filter);
    }

    function download($slug = null)
    {//$this->call(__METHOD__);
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
        $Pdf->process(Router::url('/', true) . 'strains/index/' . $slug);
        die();
        $this->render(false);
    }

    function getFlavor($id)
    {//$this->call(__METHOD__);
        $this->loadModel('Flavor');
        $q = $this->Flavor->findById($id);
        return $q['Flavor']['title'];
        die();
    }

    function getEffect($id)
    {//$this->call(__METHOD__);
        $this->loadModel('Effect');
        $q = $this->Effect->findById($id);
        return $q['Effect']['title'];
        die();
    }

    function getSymptom($id)
    {//$this->call(__METHOD__);
        $this->loadModel('Symptom');
        $q = $this->Symptom->findById($id);
        return $q['Symptom']['title'];
        die();
    }

    function getPosEff($id)
    {//$this->call(__METHOD__);
        $this->loadModel('Effect');
        $q = $this->Effect->findById($id);
        if ($q['Effect']['negative'] == 0)
            return true;
        else
            return false;
    }
    
    function symptomVote($strain_id,$symp){
        die($this->request->data('symp'));
       die(var_dump($this->params));
    }

    function getUserName($id)
    {//$this->call(__METHOD__);
        $this->loadModel('User');
        $q = $this->User->findById($id);
        return $q['User']['username'];
    }

    function helpful($id, $yes)
    {//$this->call(__METHOD__);
        $this->loadModel('Review');
        $q = $this->Review->findById($id);
        if ($yes == 'yes') {
            $helpful = $q['Review']['helpful'] + 1;
            $not_helpful = $q['Review']['not_helpful'];
        } else {
            $not_helpful = $q['Review']['not_helpful'] + 1;
            $helpful = $q['Review']['helpful'];
        }
        $this->loadModel('VoteIp');
        $ip = $_SERVER['REMOTE_ADDR'];
        if (!$this->VoteIp->find('first', array('conditions' => array('review_id' => $id, 'ip' => $ip)))) {
            $this->Review->id = $id;
            $this->Review->saveField('helpful', $helpful);
            $this->Review->saveField('not_helpful', $not_helpful);


            $this->VoteIp->create();
            $arr['review_id'] = $id;
            $arr['ip'] = $ip;
            if ($yes == 'yes')
                $arr['vote_yes'] = 1;
            else
                $arr['vote_yes'] = 0;

            $this->VoteIp->save($arr);
        }
        die();
    }

    function all($type = '', $limit = 0)
    {//$this->call(__METHOD__);
        if($this->Session->read('User')){
            $this->loadModel('User');
            $this->set('user',$this->User->findById($this->Session->read('User.id')));
        }



        $this->loadModel('Country');
        $this->set('countries', $this->Country->find('all'));
        $this->set('type', $type);
        $this->set('limit', $limit);
        if ($limit) {
            $offset = $limit;
            $limit = '8';

        } else {
            $limit = 8;
            $offset = 0;
        }
        $arr = array('indica' => 1, 'sativa' => 2, 'hybrid' => 3);

        $conditions = array();
        if ($type) {$conditions['type_id'] = $arr[$type];}
        if(isset($_GET["key"]) && $_GET["key"]){
            $conditions['name LIKE'] = '%' . $_GET["key"] . '%';
        }

        $this->set('strain', $this->Strain->find('all', array('conditions' => $conditions, 'order' => 'Strain.viewed DESC ,Strain.id DESC', 'limit' => $limit, 'offset' => $offset)));
        $this->set('strains', $this->Strain->find('count', array('conditions' => $conditions)));

        /*
        if ($type == '') {
            $this->set('strains', $this->Strain->find('count'));
            $this->set('strain', $this->Strain->find('all', array('order' => 'Strain.viewed DESC ,Strain.id DESC', 'limit' => $limit)));
        } else {
            $this->set('strain', $this->Strain->find('all', array('conditions' => array('type_id' => $arr[$type]), 'order' => 'Strain.viewed DESC ,Strain.id DESC', 'limit' => $limit, 'offset' => $offset)));
            $this->set('strains', $this->Strain->find('count', array('conditions' => array('type_id' => $arr[$type]))));
        }
        /.

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
    
    function showAll($type = '', $limit = 0)
    {
        $this->loadModel('Country');
        $this->set('countries', $this->Country->find('all'));
        $this->set('type', $type);
        $this->set('limit', $limit);
        
        $this->Strain->unbindModel(array('hasMany'=>array('OverallEffectRating','OverallSymptomRating','Flavorstrain','Review','StrainImage')));
        $this->set('strain', $this->Strain->find('all', array('order' => 'Strain.id')));
        //$this->set('strains', $this->Strain->find('count'));

    }

    function search($type = '', $limit = 0)
    {//$this->call(__METHOD__);
        $this->filter($limit, $type);
        return;

        if ($this->Session->read('User')) {
            $this->loadModel('User');
            $this->set('user', $this->User->findById($this->Session->read('User.id')));
        }
        $this->loadModel('Country');
        $this->set('countries', $this->Country->find('all'));

        $this->set('type', $type);
        $this->set('limit', $limit);
        $offset = 0;
        if ($limit) {$offset = $limit;}
        $limit = 8;

        if (isset($_GET['key'])) {
            $key = $_GET['key'];
        }else {
            $key = '';
        }
        $condition = '';
        if (isset($_GET['effects'])) {
            $effects = $_GET['effects'];
        }else {
            $effects = array();
        }

        if (isset($_GET['symptoms'])) {
            $symptoms = $_GET['symptoms'];
            if (!is_array($symptoms)) {$symptoms = explode(",", $symptoms);}
        } else {
            $symptoms = array();
        }

        if ($effects) {
            $i = 0;
            /*
            foreach ($effects as $e) {
                $i++;
                if ($i == 1)
                    $condition = $condition . 'Strain.id IN (SELECT strain_id FROM reviews WHERE id IN (SELECT review_id
                                        FROM effect_ratings
                                        WHERE effect_id
                                        IN ( ' . $e;

                else
                    $condition = $condition . ',' . $e;
            }
            $condition = $condition . ')GROUP BY review_id
                                        HAVING COUNT( effect_id ) =' . count($effects) . '))';

*/
        }
        if ($symptoms) {
            $i = 0;
            foreach ($symptoms as $e) {

                $i++;
                if ($i == 1) {
                    if ($effects)
                        $condition = $condition . ' AND ';
                    $condition = $condition . 'Strain.id IN (SELECT strain_id FROM reviews WHERE id IN (SELECT review_id
                                        FROM symptom_ratings
                                        WHERE symptom_id
                                        IN (' . $e;
                } else
                    $condition = $condition . ',' . $e;
            }
            $condition = $condition . ') GROUP BY review_id
                                        HAVING COUNT( symptom_id ) =' . count($symptoms) . '))';
        }
        if (!$condition) {
            $this->set('strain', $this->Strain->find('all', array('conditions' => array('name LIKE' => '%' . $key . '%'), 'order' => 'Strain.viewed DESC ,Strain.id DESC', 'limit' => $limit, 'offset' => $offset)));
            $this->set('strains', $this->Strain->find('count', array('conditions' => array('name LIKE' => '%' . $key . '%'))));
        } else {
            $this->set('strain', $this->Strain->find('all', array('conditions' => array('name LIKE' => '%' . $key . '%', $condition), 'order' => 'Strain.viewed DESC ,Strain.id DESC', 'limit' => $limit, 'offset' => $offset)));
            $this->set('strains', $this->Strain->find('count', array('conditions' => array('name LIKE' => '%' . $key . '%', $condition))));
        }
        $this->render('all');
    }

    function getEffectRate($profile_filter, $strain)
    {//$this->call(__METHOD__);
        //echo urlencode("SELECT id FROM users WHERE nationality='asian'");die();
        //echo $profile_filter;die();

        $this->loadModel('Effect_rating');
        $q = $this->Effect_rating->find('all', array('conditions' => array('user_id IN (' . $profile_filter . ') AND rate <> 0 AND strain_id = ' . $strain), 'order' => 'effect_id'));
        return $q;
    }

    function getSympto2mRate($profile_filter, $strain)
    {//$this->call(__METHOD__);
        //echo urlencode("SELECT id FROM users WHERE nationality='asian'");die();
        //echo $profile_filter;die();
        $this->loadModel('SymptomRating');
        $q = $this->SymptomRating->find('all', array('conditions' => array('user_id IN (' . $profile_filter . ') AND rate <> 0 AND strain_id = ' . $strain), 'order' => 'symptom_id'));


        return $q;
    }

    function getEffectReview($profile_filter, $strain)
    {//$this->call(__METHOD__);
        $this->loadModel('Review');
        $q = $this->Review->find('all', array('conditions' => array('user_id IN (' . $profile_filter . ') AND strain_id = ' . $strain)));
        return $q;
    }
    function getcolors($strain)
    {//$this->call(__METHOD__);
        
        $this->loadModel('Review');
        $q = $this->Review->find('all', array('conditions' => array('strain_id'=>$strain)));
        return $q;
    }

    function rectime($lasttime, $text = ""){
        //$this->call(__METHOD__);
        $method = "console.log";//"alert";
        $now = time();
        $diff = $now - $lasttime;
        echo "<SCRIPT>" . $method . "('" . $now . " " . $diff . " " . $text . "');</SCRIPT>";
        return $now;
    }
    function filter($limit = 0, $type = '')
    {
        //$this->call(__METHOD__);
        $this->loadModel('Country');
        $this->loadModel('Strainslim');
        $this->set('countries', $this->Country->find('all'));
        $this->set('limit', $limit);
        $this->set('type', $type);

        $offset = 0;
        if ($limit) { $offset = $limit;}
        $limit = 8;

        //echo $limit;die();
        $this->layout = 'blank';
        if (isset($_GET['key'])) {
            $key = $_GET['key'];
            if (substr($key,0,3)=="CMD"){
                echo $this->commmandline($key);
            }
        }else {
            $key = '';
        }
        $condition = '';
        if (isset($_GET['effects']))
            $effects = $_GET['effects'];
        else
            $effects = array();
        if (isset($_GET['symptoms'])) {
            $symptoms = $_GET['symptoms'];
        }else {
            $symptoms = "";
        }

        if (isset($_GET['sort']))
            $test_sort = $_GET['sort'];
        else
            $test_sort = '';

        $u_cond = '';
        if (isset($_GET['nationality'])) {
            $u_cond = 'nationality = "' . $_GET['nationality'] . '"';
            $this->set('nationality', $_GET['nationality']);
        }
        if (isset($_GET['country'])) {
            if (!$u_cond)
                $u_cond = 'country = "' . $_GET['country'] . '"';
            else
                $u_cond = $u_cond . ' AND country = "' . $_GET['country'] . '"';
            $this->set('country', $_GET['country']);
        }
        if (isset($_GET['gender'])) {
            if (!$u_cond)
                $u_cond = 'gender = "' . $_GET['gender'] . '"';
            else
                $u_cond = $u_cond . ' AND gender = "' . $_GET['gender'] . '"';
            $this->set('gender', $_GET['gender']);
        }
        if (isset($_GET['age_group_from'])) {
            $this->set('age_group_from', $_GET['age_group_from']);

            if (isset($_GET['age_group_to'])) {
                $to = $_GET['age_group_to'];
                $this->set('age_group_to', $_GET['age_group_to']);
            } else
                $to = 100;
            if (!$to)
                $to = 100;
            $from = $_GET['age_group_from'];
            if ($from < 20)
                $from = 20;
            $from++;
            $counter = 0;
            for ($i = $from; $i <= $to; $i++) {
                $counter++;
                $j = $i + 9;
                $group = $i . '-' . $j;
                $i = $j;
                if ($counter == 1) {
                    if (!$u_cond)
                        $u_cond = '(age_group = "' . $group . '"';
                    else
                        $u_cond = $u_cond . ' AND (age_group = "' . $group . '"';
                } else {
                    ' OR age_group = "' . $group . '"';
                }
            }
            $u_cond = $u_cond . ')';

        }
        if (isset($_GET['health'])) {
            $this->set('health', $_GET['health']);
            if (!$u_cond)
                $u_cond = 'health = "' . $_GET['health'] . '"';
            else
                $u_cond = $u_cond . ' AND health = "' . $_GET['health'] . '"';
        }

        if (isset($_GET['weight_from'])) {
            $this->set('weight_from', $_GET['weight_from']);
            if (isset($_GET['weight_to'])) {
                $to = $_GET['weight_to'];
                $this->set('weight_to', $_GET['weight_to']);
            } else
                $to = 280;
            if (!$to)
                $to = 280;

            $from = $_GET['weight_from'];
            if ($from > 100)
                $from++;
            $counter = 0;
            for ($i = $from; $i <= $to; $i++) {
                $counter++;
                if ($i > 100)
                    $j = $i + 9;
                else
                    $j = $i + 10;
                $group = $i . '-' . $j;
                $i = $j;
                if ($counter == 1) {
                    if (!$u_cond)
                        $u_cond = '(weight = "' . $group . '"';
                    else
                        $u_cond = $u_cond . ' AND (weight = "' . $group . '"';
                } else {
                    ' OR weight = "' . $group . '"';
                }
            }
            $u_cond = $u_cond . ')';

        }

        if (isset($_GET['years_of_experience_from'])) {
            $this->set('years_of_experience_from', $_GET['years_of_experience_from']);
            if (isset($_GET['years_of_experience_to'])) {
                $to = $_GET['years_of_experience_to'];
                $this->set('years_of_experience_to', $_GET['years_of_experience_to']);
            } else
                $to = 50;
            if (!$to)
                $to = 50;
            $from = $_GET['years_of_experience_from'];


            if (!$u_cond)
                $u_cond = 'years_of_experience >= ' . $from . ' AND years_of_experience <= ' . $to;
            else
                $u_cond = $u_cond . ' AND years_of_experience >= ' . $from . ' AND years_of_experience <= ' . $to;


        }
        if (isset($_GET['frequency'])) {
            $this->set('frequency', $_GET['frequency']);
            if (!$u_cond)
                $u_cond = 'frequency = "' . $_GET['frequency'] . '"';
            else
                $u_cond = $u_cond . ' AND frequency = "' . $_GET['frequency'] . '"';
        }
        if (isset($_GET['body_type'])) {
            $this->set('body_type', $_GET['body_type']);
            if (!$u_cond)
                $u_cond = 'body_type = "' . $_GET['body_type'] . '"';
            else
                $u_cond = $u_cond . ' AND body_type = "' . $_GET['body_type'] . '"';
        }
        if ($u_cond) {
            $profile_filter = 'SELECT id FROM users WHERE ' . $u_cond;
        } else
            $profile_filter = '';
        if (isset($_GET['sort']) && ($_GET['sort'] == 'indica' || $_GET['sort'] == 'sativa' || $_GET['sort'] == 'hybrid')) {
            $s_arr = array('indica' => 1, 'sativa' => 2, 'hybrid' => 3);
            $condition = 'Strain.type_id = ' . $s_arr[$_GET['sort']];
            $_GET['sort'] = 'alpha';

        }

        if ($effects && is_array($effects)) {
            if (isset($_GET['sort']) && ($test_sort == 'indica' || $test_sort == 'sativa' || $test_sort == 'hybrid'))
                $condition = $condition . ' AND ';
            $i = 0;
            foreach ($effects as $e) {//this loop will no longer function, as it's no longer an array
                $i++;
                if ($i == 1)
                    $condition = $condition . 'Strain.id IN (SELECT strain_id FROM reviews WHERE id IN (SELECT review_id
                                        FROM effect_ratings
                                        WHERE effect_id
                                        IN (' . $e;

                else
                    $condition = $condition . ',' . $e;
            }
            if ($profile_filter)
                $condition = $condition . ')GROUP BY review_id
                                    HAVING COUNT( effect_id ) =' . count($effects) . ') AND user_id IN (' . $profile_filter . '))';
            else
                $condition = $condition . ')GROUP BY review_id
                                    HAVING COUNT( effect_id ) =' . count($effects) . '))';


        }


        if ($symptoms) {
                if (is_array($symptoms)){
                    $symptomscount=count($symptoms);
                    $symptoms=implode(",", $symptoms);
                }else{
                    $symptomscount=count(explode(",", $symptoms));
                }
                if ($_SERVER["SERVER_NAME"] != "localhost" && $symptomscount>1 && false) {
                    $symptomscount=1;
                    $symptoms = explode(",", $symptoms)[0];
                    echo "You can only search by 1 symptom at a time";
                }

                if($condition){$condition.=' AND '; }

    /*
                $condition.= 'Strain.id IN (SELECT strain_id FROM reviews WHERE id IN (SELECT review_id
                                                FROM symptom_ratings
                                                WHERE symptom_id
                                                IN (' . $symptoms . '))';
                $condition .= ' GROUP BY strain_id HAVING COUNT(symptom_id) =' . $symptomscount . ')';
                if ($profile_filter) {  $condition .= ' AND user_id IN (' . $profile_filter . ')';}
                //$condition .= ')';
    */

    /*//old
                $condition .= 'Strain.id IN (SELECT strain_id FROM reviews WHERE id IN (SELECT review_id
                                            FROM symptom_ratings
                                            WHERE symptom_id
                                            IN ( ' . $symptoms . ')
                                            GROUP BY review_id
                                            HAVING COUNT( symptom_id ) =' . $symptomscount . '))';
*/
/*
                //optimized new
                $condition .= 'Strain.id IN (SELECT strain_id
                                            FROM symptom_ratings
                                            WHERE symptom_id
                                            IN (' . $symptoms . ')

                                            )';
*/

            //super query
            //$condition .= 'SELECT strain_id, COUNT(DISTINCT symptom_id) AS matched_symptoms FROM symptom_ratings WHERE symptom_id IN (' . $symptoms  . ') GROUP BY strain_id HAVING matched_symptoms = ' . $symptomscount;
            $condition .= 'Strain.id IN (SELECT strain_id FROM (SELECT strain_id,
                                        COUNT(DISTINCT symptom_id) AS matched_symptoms
                                        FROM symptom_ratings
                                        WHERE symptom_id IN (' . $symptoms  . ')
                                        GROUP BY strain_id
                                        HAVING matched_symptoms = ' . $symptomscount . ') as IDs)';



                /*
                $condition.= 'Strain.id IN (SELECT strain_id
                                                FROM symptom_ratings
                                                WHERE symptom_id
                                                IN (' . $symptoms . '))';
    */

    /*
                $condition.= 'Strain.id IN (SELECT strain_id
                                               FROM reviews
                                               WHERE symptoms
                                               IN (' . $symptoms . '))';
                */

                   // $condition = 'WHERE Reviews.symptoms IN (' . $symptoms . ')';


               // $condition.= 'test Strain.id JOIN reviews.strain_id WHERE reviews.symptom_id IN (' . $symptoms . ')';
        }
        //echo( "<BR>RAN AT test: " . time() . " " . $condition);




        if (isset($_GET['sort']) && ($test_sort != 'indica' && $test_sort != 'sativa' && $test_sort != 'hybrid')) {
            $sort = $_GET['sort'];
            if ($sort == 'recent') {
                $order = 'Strain.id ' . $_GET['order'];
            } else if ($sort == 'rated') {
                $order = 'Strain.rating ' . $_GET['order'];
            } else if ($sort == 'reviewed') {
                $order = 'Strain.review ' . $_GET['order'];
            } else if ($sort == 'viewed') {
                $order = 'Strain.viewed ' . $_GET['order'];
            } else {
                $order = 'Strain.name ' . $_GET['order'];
            }
        } else {
            $order = "";
        }

        $model=$this->Strainslim;
        $parameters = array();
        $conditions = array();
        if($key){$conditions['name LIKE'] = '%' . $key . '%';}
        if($profile_filter){$conditions[] = 'Strain.id IN (SELECT strain_id FROM reviews WHERE user_id IN (' . $profile_filter . '))';}
        if($condition){$conditions[] = $condition;}
        if ($type) {
            $arr = array('indica' => 1, 'sativa' => 2, 'hybrid' => 3);
            $conditions['type_id'] = $arr[$type];
        }
        $parameters['conditions'] = $conditions;
        if ($order) {
            $parameters['order'] = $order;
        } else {
            $parameters['order'] = 'Strain.viewed DESC, Strain.id DESC';
        }

        $count = $model->find('count', $parameters);
        if($symptoms){$this->makesymptomslist($symptoms, $symptomscount);}
        $this->set('strains', $count);
        $parameters['limit'] = $limit;
        $parameters['offset'] = $offset;
        //var_dump($parameters);
        $this->set('strain', $model->find('all', $parameters));
    }

    function makesymptomslist($symptoms, $symptomscount){
        if($symptoms) {
            $symptomlist = $this->listsymptoms($symptoms);
            $delimeter = "";
            $index = 0;
            echo "These strains have been known to help with: ";
            foreach ($symptomlist as $symptom) {
                echo $delimeter . $symptom['Symptom']['title'];
                $index++;
                if (!$delimeter) {$delimeter = ", ";}
                if ($index == $symptomscount - 1) {$delimeter = " and ";}
            }
            echo "<BR><BR>";
        }
    }
    function listsymptoms($symptoms){
        if (is_array($symptoms)){ $symptoms = implode(",", $symptoms);}
        $this->loadModel('Symptom');
        return $this->Symptom->find('all',array('conditions' => array('id IN (' . $symptoms . ')')));
    }

    function review($slug, $sort = null, $limit = 0)
    {//$this->call(__METHOD__);
        $this->loadModel('Review');
        $this->loadModel('Country');
        $this->set('countries', $this->Country->find('all'));
        $this->set('limit', $limit);
        $this->set('slug', $slug);


        $u_cond = '';
        if (isset($_GET['nationality'])) {
            $u_cond = 'nationality = "' . $_GET['nationality'] . '"';
        }
        if (isset($_GET['country'])) {
            if (!$u_cond)
                $u_cond = 'country = "' . $_GET['country'] . '"';
            else
                $u_cond = $u_cond . ' AND country = "' . $_GET['country'] . '"';
        }
        if (isset($_GET['gender'])) {
            if (!$u_cond)
                $u_cond = 'gender = "' . $_GET['gender'] . '"';
            else
                $u_cond = $u_cond . ' AND gender = "' . $_GET['gender'] . '"';
        }
        if (isset($_GET['age_group'])) {
            if (!$u_cond)
                $u_cond = 'age_group = "' . $_GET['age_group'] . '"';
            else
                $u_cond = $u_cond . ' AND age_group = "' . $_GET['age_group'] . '"';
        }
        if (isset($_GET['health'])) {
            if (!$u_cond)
                $u_cond = 'health = "' . $_GET['health'] . '"';
            else
                $u_cond = $u_cond . ' AND health = "' . $_GET['health'] . '"';
        }
        if (isset($_GET['weight'])) {
            if (!$u_cond)
                $u_cond = 'weight = "' . $_GET['weight'] . '"';
            else
                $u_cond = $u_cond . ' AND weight = "' . $_GET['weight'] . '"';
        }
        if (isset($_GET['years_of_experience'])) {
            if (!$u_cond)
                $u_cond = 'years_of_experience = "' . $_GET['years_of_experience'] . '"';
            else
                $u_cond = $u_cond . ' AND years_of_experience = "' . $_GET['years_of_experience'] . '"';
        }
        if (isset($_GET['frequency'])) {
            if (!$u_cond)
                $u_cond = 'frequency = "' . $_GET['frequency'] . '"';
            else
                $u_cond = $u_cond . ' AND frequency = "' . $_GET['frequency'] . '"';
        }
        if (isset($_GET['body_type'])) {
            if (!$u_cond)
                $u_cond = 'body_type = "' . $_GET['body_type'] . '"';
            else
                $u_cond = $u_cond . ' AND body_type = "' . $_GET['body_type'] . '"';
        }
        if ($u_cond) {
            $profile_filter = 'SELECT id FROM users WHERE ' . $u_cond;
        } else
            $profile_filter = '';


        if ($limit) {
            $offset = $limit;
            $limit = '8';

        } else {
            $limit = 8;
            $offset = 0;
        }
        $q = $this->Strain->findBySlug($slug);
        if (!$sort || $sort == 'recent') {//do not use nested redundant if statements, generate the array cell by cell
            if (!isset($_GET['user'])) {
                if (!$profile_filter)
                    $q2 = $this->Review->find('all', array('conditions' => array('Review.strain_id' => $q['Strain']['id']), 'order' => 'Review.id DESC', 'limit' => $limit, 'offset' => $offset));
                else
                    $q2 = $this->Review->find('all', array('conditions' => array('Review.strain_id' => $q['Strain']['id'], 'Review.user_id IN (' . $profile_filter . ')'), 'order' => 'Review.id DESC', 'limit' => $limit, 'offset' => $offset));
                $this->set('reviewz', $this->Review->find('count', array('conditions' => array('Review.strain_id' => $q['Strain']['id']))));
            } else {
                $q2 = $this->Review->find('all', array('conditions' => array('Review.user_id' => $_GET['user']), 'order' => 'Review.id DESC', 'limit' => $limit, 'offset' => $offset));
                $this->set('reviewz', $this->Review->find('count', array('conditions' => array('Review.user_id' => $_GET['user']))));
            }
        } else {
            if (!isset($_GET['user'])) {
                $q2 = $this->Review->find('all', array('conditions' => array('Review.strain_id' => $q['Strain']['id']), 'order' => 'Review.helpful DESC', 'limit' => $limit, 'offset' => $offset));
                $this->set('reviewz', $this->Review->find('count', array('conditions' => array('Review.strain_id' => $q['Strain']['id']))));
            } else {
                $q2 = $this->Review->find('all', array('conditions' => array('Review.user_id' => $_GET['user']), 'order' => 'Review.helpful DESC', 'limit' => $limit, 'offset' => $offset));
                $this->set('reviewz', $this->Review->find('count', array('conditions' => array('Review.user_id' => $_GET['user']))));
            }
        }


        $this->loadModel('VoteIp');
        $this->set('vip', $this->VoteIp);
        if (isset($_GET['user'])) {
            $this->set('reviews', $q2);
            $this->render('/review/all');
        } else {
            $this->set('strain', $q);
            $this->set('review', $q2);
        }

    }

    function review_filter($slug, $sort, $limit)
    {//$this->call(__METHOD__);
        $this->set('limit', $limit);
        $this->set('slug', $slug);
        $this->set('sort', $sort);

        $u_cond = '';
        if (isset($_GET['nationality'])) {
            $u_cond = 'nationality = "' . $_GET['nationality'] . '"';
        }
        if (isset($_GET['country'])) {
            if (!$u_cond)
                $u_cond = 'country = "' . $_GET['country'] . '"';
            else
                $u_cond = $u_cond . ' AND country = "' . $_GET['country'] . '"';
        }
        if (isset($_GET['gender'])) {
            if (!$u_cond)
                $u_cond = 'gender = "' . $_GET['gender'] . '"';
            else
                $u_cond = $u_cond . ' AND gender = "' . $_GET['gender'] . '"';
        }
        if (isset($_GET['age_group_from'])) {
            if (isset($_GET['age_group_from']))
                $to = $_GET['age_group_to'];
            else
                $to = 100;
            if (!$to)
                $to = 100;
            $from = $_GET['age_group_from'];
            if ($from < 20)
                $from = 20;
            $from++;
            $counter = 0;
            for ($i = $from; $i <= $to; $i++) {
                $counter++;
                $j = $i + 9;
                $group = $i . '-' . $j;
                $i = $j;
                if ($counter == 1) {
                    if (!$u_cond)
                        $u_cond = '(age_group = "' . $group . '"';
                    else
                        $u_cond = $u_cond . ' AND (age_group = "' . $group . '"';
                } else {
                    ' OR age_group = "' . $group . '"';
                }
            }
            $u_cond = $u_cond . ')';

        }
        if (isset($_GET['health'])) {
            if (!$u_cond)
                $u_cond = 'health = "' . $_GET['health'] . '"';
            else
                $u_cond = $u_cond . ' AND health = "' . $_GET['health'] . '"';
        }

        if (isset($_GET['weight_from'])) {
            if (isset($_GET['weight_from']))
                $to = $_GET['weight_to'];
            else
                $to = 280;
            if (!$to)
                $to = 280;

            $from = $_GET['weight_from'];
            if ($from > 100)
                $from++;
            $counter = 0;
            for ($i = $from; $i <= $to; $i++) {
                $counter++;
                if ($i > 100)
                    $j = $i + 9;
                else
                    $j = $i + 10;
                $group = $i . '-' . $j;
                $i = $j;
                if ($counter == 1) {
                    if (!$u_cond)
                        $u_cond = '(weight = "' . $group . '"';
                    else
                        $u_cond = $u_cond . ' AND (weight = "' . $group . '"';
                } else {
                    ' OR weight = "' . $group . '"';
                }
            }
            $u_cond = $u_cond . ')';

        }

        if (isset($_GET['years_of_experience_from'])) {
            if (isset($_GET['years_of_experience_from']))
                $to = $_GET['years_of_experience_to'];
            else
                $to = 50;
            if (!$to)
                $to = 50;
            $from = $_GET['years_of_experience_from'];


            if (!$u_cond)
                $u_cond = 'years_of_experience >= ' . $from . ' AND years_of_experience <= ' . $to;
            else
                $u_cond = $u_cond . ' AND years_of_experience >= ' . $from . ' AND years_of_experience <= ' . $to;


        }
        if (isset($_GET['frequency'])) {
            if (!$u_cond)
                $u_cond = 'frequency = "' . $_GET['frequency'] . '"';
            else
                $u_cond = $u_cond . ' AND frequency = "' . $_GET['frequency'] . '"';
        }
        if (isset($_GET['body_type'])) {
            if (!$u_cond)
                $u_cond = 'body_type = "' . $_GET['body_type'] . '"';
            else
                $u_cond = $u_cond . ' AND body_type = "' . $_GET['body_type'] . '"';
        }
        if ($u_cond) {
            $profile_filter = 'SELECT id FROM users WHERE ' . $u_cond;
        } else
            $profile_filter = '';


        if ($limit) {
            $offset = $limit;
            $limit = '8';

        } else {
            $limit = 8;
            $offset = 0;
        }
        //echo $limit;die();
        $this->layout = 'blank';

        $this->loadModel('Review');
        $q = $this->Strain->findBySlug($slug);
        if (!$sort || $sort == 'recent') {//do not use nested redundant if statements, generate the array cell by cell
            if (!isset($_GET['user'])) {
                if (!$profile_filter)
                    $q2 = $this->Review->find('all', array('conditions' => array('Review.strain_id' => $q['Strain']['id']), 'order' => 'Review.id DESC', 'limit' => $limit, 'offset' => $offset));
                else
                    $q2 = $this->Review->find('all', array('conditions' => array('Review.strain_id' => $q['Strain']['id'], 'Review.user_id IN (' . $profile_filter . ')'), 'order' => 'Review.id DESC', 'limit' => $limit, 'offset' => $offset));
                if (!$profile_filter)
                    $this->set('reviewz', $this->Review->find('count', array('conditions' => array('Review.strain_id' => $q['Strain']['id']))));
                else
                    $this->set('reviewz', $this->Review->find('count', array('conditions' => array('Review.strain_id' => $q['Strain']['id'], 'Review.user_id IN (' . $profile_filter . ')'))));
                //var_dump($q2);die();

            } else {
                $q2 = $this->Review->find('all', array('conditions' => array('Review.user_id' => $_GET['user']), 'order' => 'Review.id DESC', 'limit' => $limit, 'offset' => $offset));
                $this->set('reviewz', $this->Review->find('count', array('conditions' => array('Review.user_id' => $_GET['user']))));
            }
        } else {
            if (!isset($_GET['user'])) {
                if (!$profile_filter)
                    $q2 = $this->Review->find('all', array('conditions' => array('Review.strain_id' => $q['Strain']['id']), 'order' => 'Review.helpful DESC', 'limit' => $limit, 'offset' => $offset));
                else
                    $q2 = $this->Review->find('all', array('conditions' => array('Review.strain_id' => $q['Strain']['id'], 'Review.user_id IN (' . $profile_filter . ')'), 'order' => 'Review.helpful DESC', 'limit' => $limit, 'offset' => $offset));
                if (!$profile_filter)
                    $this->set('reviewz', $this->Review->find('count', array('conditions' => array('Review.strain_id' => $q['Strain']['id']))));
                else
                    $this->set('reviewz', $this->Review->find('count', array('conditions' => array('Review.strain_id' => $q['Strain']['id'], 'Review.user_id IN (' . $profile_filter . ')'))));
            } else {
                $q2 = $this->Review->find('all', array('conditions' => array('Review.user_id' => $_GET['user']), 'order' => 'Review.helpful DESC', 'limit' => $limit, 'offset' => $offset));
                $this->set('reviewz', $this->Review->find('count', array('conditions' => array('Review.user_id' => $_GET['user']))));
            }
        }


        $this->loadModel('VoteIp');
        $this->set('vip', $this->VoteIp);
        if (isset($_GET['user'])) {
            $this->set('reviews', $q2);

            $this->render('/review/all');
        } else {
            $this->set('strain', $q);
            $this->set('review', $q2);
        }

    }

    function ajax_search($patient=""){
        //$this->call(__METHOD__);
        $str = $_POST['str'];
        if (substr($str,0,3) == "CMD"){
            echo $this->commmandline($str);
        } else {
            $search = $this->Strain->find("all", array('conditions' => array('name LIKE' => "%" . $str . "%")));
            if (count($search) == 0) {
                echo "No results found for '" . $str . "'";
            }
            if($patient!=""){
                foreach ($search as $s) {
                    echo "<a href='javascript:void(0);' class='more blue icon_small_arrow margin_right_white page_margin_top' onclick=\"$('#searchName').val('".$s['Strain']['name']."');$('#strainz').val('".$s['Strain']['id']."');$('.results').hide();$('#strain_slug').val('".$s['Strain']['slug']."')\" style='margin-right:10px;' title='" . $s['Strain']['id'] . "'>" . $s['Strain']['name'] . "</a>";
                }
            }
            else
            {
                foreach ($search as $s) {
                    echo "<a href='" . $this->webroot . "review/add/" . $s['Strain']['slug'] . "' class='more blue icon_small_arrow margin_right_white page_margin_top' style='margin-right:10px;' title='" . $s['Strain']['slug'] . "'>" . $s['Strain']['name'] . "</a>";
                }
            }
        }
        die();
    }

    function commmandline($Text){
        //$this->call(__METHOD__);
        if (substr($Text,0,3) == "CMD") {
            substr($Text, 3, strlen($Text) - 3);
        }
        switch(strtolower(trim($Text))){
            case "factor":
                return "TEST: " . $this->factorstrains();
                break;
        }
        return "No command run (" . $Text . ")";
    }

    function factorstrains($ForceRefresh=false){
        //ALTER TABLE `reviews` ADD `symptomscount` INT NOT NULL ;

        $this->loadModel("Review");
        $Reviews = $this->Review->find('all');
        $Index=0;
        foreach($Reviews as $Review){
            if(!$Review['Review']['symptoms'] || $ForceRefresh) {
                $id = $Review['Review']['id'];
                $factor=$this->factorreview($id);
                if($factor) {
                    $Index++;
                    $this->Review->id = $id;
                    $this->Review->saveField('symptoms', $factor);
                    $this->Review->saveField('symptomscount', count(explode(",", $factor)));
                }
            }
        }
        return $Index . " reviews factored";
    }
    function factorreview($ReviewID){
        $this->loadModel('SymptomRating');
        $Symptoms = $this->SymptomRating->find('all',array('conditions'=>array("review_id"=>$ReviewID)));
        $SymptomList = array();
        foreach($Symptoms as $Symptom){
            $SymptomList[$Symptom["SymptomRating"]["symptom_id"]]=true;
        }
        return implode(",", array_keys($SymptomList));
    }
    function getStrain($id)
    {
        return $this->Strain->findById($id);
    }
    
    /*function generateImage($slug)
    {
        if($_SERVER['SERVER_NAME']=='localhost')
        $html_content = file_get_contents('http://127.0.0.1'.$this->webroot.'strains/'.$slug);
        else
        $html_content = file_get_contents('http://www.charlieschopsticks.com/strains/'.$slug);
         $html2pdf = new HTML2PDF('P', 'A4');
         $html2pdf->writeHTML($html_content);
         $rand = rand(1000000000,9999999999).'.pdf';
         $file = $html2pdf->Output(APP.'webroot/pdfs/'.$rand,'F');
         
         $im = new imagick(APP.'webroot/pdfs/'.$rand);
        $im->setImageFormat( "jpg" );
        $img_name = str_replace('.pdf','',$rand).'.jpg';
        $im->setSize(800,600);
        $im->writeImage($img_name);
        $im->clear();
        $im->destroy();
        die();
    }*/
}

?>