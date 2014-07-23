<?php
    class ReviewController extends AppController
    {
        function beforeFilter()
        {
            $this->loadModel("Review");
            if(!$this->Session->read('User'))
                $this->redirect('/users/register');
        }
        function index($slug)
        {
            $this->loadModel('Effect');
            $this->loadModel("Strain");
            $strain = $this->Strain->findBySlug($slug);
            $this->set("strain_id",$strain['Strain']['id']);
            $this->set('effects',$this->Effect->find('all'));
            $this->loadModel('Symptom');
            $this->set('symptoms',$this->Symptom->find('all'));
            if(isset($_POST['submit']))
            {
                $ar['user_id'] = $this->Session->read('User.id');
                $ar['strain_id'] = $strain['Strain']['id'];
               foreach($_POST as $k=>$v)
               {
                    $ar[$k]=$v;
                    
               }
               $this->Review->create();
               if($this->Review->save($ar))
               {
                    $this->Session->setFlash('Review Saved.');
                    $this->redirect('/');
               }
            }
        }
        
        function rating($strain_id,$eff_id,$table)
        {
            $this->loadModel('EffectRating');
            $this->loadModel('SymptomRating');
            $this->layout = "modal";
            $this->set('strain_id',$strain_id);
            $this->set('eff_id',$eff_id);
            $this->set('table',$table);
            if(isset($_POST['submit'])&& $_POST['submit']=='ok')
            {
                  $arr['strain_id'] = $strain_id;
                  $arr['user_id'] = $this->Session->read("User.id");
                  $arr['rate'] = $_POST['rate'];
                  if($table =='effect')
                  {
                        $arr['effect_id'] = $eff_id;
                        $this->EffectRating->deleteAll(array('user_id'=>$this->Session->read('User.id'),'strain_id'=>$strain_id,'effect_id'=>$eff_id));
                        $this->EffectRating->create();
                        if($this->EffectRating->save($arr))
                        {
                            echo "Rating Saved.";die();
                        }
                        else
                        {
                            echo "Rating Couldnot be saved. Please try Again.";die();
                        }
                        
                  }
                  elseif($table=='symptom')
                  {
                        $arr['symptom_id'] = $eff_id;
                        $this->SymptomRating->deleteAll(array('user_id'=>$this->Session->read('User.id'),'strain_id'=>$strain_id,'symptom_id'=>$eff_id));
                        $this->SymptomRating->create();
                        if($this->SymptomRating->save($arr))
                        {
                            echo "Rating Saved.";die();
                        }
                        else
                        {
                            echo "Rating Couldnot be saved. Please try Again.";die();
                        }
                    
                  }
                //var_dump($arr);    
            }
            
        }
    }
?>