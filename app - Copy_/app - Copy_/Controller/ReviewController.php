<?php
    class ReviewController extends AppController
    {
        function beforeFilter()
        {
            $this->loadModel("Review");
            if(!$this->Session->read('User'))
            {
                $url = Router::url($this->here, true);
                $this->redirect('/users/register?url='.$url);
            }
        }
        
        function all()
        {
            $reviews = $this->Review->find('all',array("conditions"=>array('user_id'=>$this->Session->read('User.id'))));
            $this->set("reviews",$reviews);
            
        }
        
        function detail($id)
        {
            $this->loadModel('Effect');
            $this->loadModel("Strain");
            $this->loadModel("Colour");
            $this->loadModel("Flavor");
            $this->loadModel('EffectRating');
            $this->loadModel('SymptomRating');
            $this->loadModel('ColourRating');
            $this->loadModel('FlavorRating');
            
            
            $this->set('effects',$this->Effect->find('all',array('conditions'=>array("negative"=>'0'))));
            $this->set('negative',$this->Effect->find('all',array('conditions'=>array("negative"=>'1'))));
            $this->set("effectz",$this->Effect->find('all'));
            $this->set('colours',$this->Colour->find('all'));
            $this->set('flavors',$this->Flavor->find('all'));
            $this->loadModel('Symptom');
            $this->set('symptoms',$this->Symptom->find('all'));
            $this->set('review',$this->Review->findById($id));
            $this->render('add');
            
        }
        function index()
        {
            if(isset($_POST['submit']))
            {
                $slug = $_POST['strain'];
                if($slug!="")
                    $this->redirect("index/".$slug);
            }
        }
        function add($slug)
        {
            $this->loadModel('Effect');
            $this->loadModel("Strain");
            $this->loadModel("Colour");
            $this->loadModel("Flavor");
            $this->loadModel('EffectRating');
            $this->loadModel('SymptomRating');
            $this->loadModel('ColourRating');
            $this->loadModel('FlavorRating');
            $strain = $this->Strain->findBySlug($slug);
            $this->set("strain_id",$strain['Strain']['id']);
            $this->set("strain_name",$strain['Strain']['name']);
            $this->set('effects',$this->Effect->find('all',array('conditions'=>array("negative"=>'0'))));
            $this->set('negative',$this->Effect->find('all',array('conditions'=>array("negative"=>'1'))));
            $this->set('colours',$this->Colour->find('all'));
            $this->set('flavors',$this->Flavor->find('all'));
            $this->loadModel('Symptom');
            $this->set('symptoms',$this->Symptom->find('all'));
            if(isset($_POST['submit']))
            {
                //var_dump($_POST);die();
                $ar['user_id'] = $this->Session->read('User.id');
                $ar['strain_id'] = $strain['Strain']['id'];
                $ar['on_date'] = date("y-m-d");
               foreach($_POST as $k=>$v)
               {
                    $ar[$k]=$v;
                    
               }
               $this->Review->create();
               if($this->Review->save($ar))
               {
                    $r_id = $this->Review->id;
                    //echo $_POST['rate'];
                    $this->change_overall_rating($strain['Strain']['id'],"strain",$_POST['rate']);
                    //die($o_R);
                    $ar['review_id'] = $r_id;
                    if(isset($_POST['effect'])&& count($_POST['effect'])>0)
                    {
                        foreach($_POST['effect'] as $k=>$v )
                        {
                            $this->change_overall_rating($strain['Strain']['id']."_".$k,"effect",$v);
                            $ar['effect_id'] = $k;
                            $ar['rate'] = $v;
                            $this->EffectRating->create();
                            $this->EffectRating->save($ar);
                            
                        }
                    }
                    if(isset($_POST['medical'])&& count($_POST['medical'])>0)
                    {
                        foreach($_POST['medical'] as $k=>$v )
                        {
                            $this->change_overall_rating($strain['Strain']['id']."_".$k,"symptom",$v);
                            $ar['symptom_id'] = $k;
                            $ar['rate'] = $v;
                            $this->SymptomRating->create();
                            $this->SymptomRating->save($ar);
                            
                        }
                    }
                    if(isset($_POST['color'])&& count($_POST['color'])>0)
                    {
                        foreach($_POST['color'] as $k=>$v )
                        {
                            $this->change_overall_rating($strain['Strain']['id']."_".$k,"colour",$v);
                            $ar['colour_id'] = $k;
                            $ar['rate'] = $v;
                            $this->ColourRating->create();
                            $this->ColourRating->save($ar);
                            
                        }
                    }
                    if(isset($_POST['flavor'])&& count($_POST['flavor'])>0)
                    {
                        foreach($_POST['flavor'] as $k=>$v )
                        {
                            $this->change_overall_rating($strain['Strain']['id']."_".$k,"flavor",$v);
                            $ar['flavor_id'] = $k;
                            $ar['rate'] = $v;
                            $this->FlavorRating->create();
                            $this->FlavorRating->save($ar);
                            
                        }
                    }
                    
                    $this->Strain->id = $strain['Strain']['id'];
                    if($strain['Strain']['review'])
                    {
                        $review = $strain['Strain']['review'] + 1;
                    }
                    else
                    $review = 1;
                    $this->Strain->saveField('review',$review);
                    $this->Session->setFlash('Review Saved','default',array('class'=>'good'));
                    $this->redirect('all');
               }
            }
        }
        
        function change_overall_rating($id,$table,$rate)
        {
            $this->loadModel('Strain');
            $this->loadModel('OverallEffectRating');
            $this->loadModel('OverallSymptomRating');
            $this->loadModel('OverallColourRating');
            $this->loadModel('OverallFlavorRating');
            if($table =='strain')
            {
                $st = $this->Strain->findById($id);
                $overallrate = ($st['Strain']['rating']+$rate)/2;
                $overallrate = round($overallrate,2);
                //return $overallrate;
                $this->Strain->id = $st['Strain']['id'];
                $this->Strain->saveField('rating',$overallrate);
            }
            if($table == 'effect')
            {
                $arr =explode("_",$id);
                $eff['strain_id'] =$arr[0];
                $eff['effect_id'] =$arr[1];
                if($st = $this->OverallEffectRating->find('first',array('conditions'=>array("strain_id"=>$eff['strain_id'],"effect_id"=>$eff['effect_id']))))
                {
                    $overallrate = ($st['OverallEffectRating']['rate']+$rate)/2;
                    $overallrate = round($overallrate,2);
                    $this->OverallEffectRating->id = $st['OverallEffectRating']['id'];
                    $this->OverallEffectRating->saveField('rate',$overallrate);
                }
                else
                {
                    $eff['rate'] =$rate;
                    $this->OverallEffectRating->create();
                    $this->OverallEffectRating->save($eff); 
                }
            }
            if($table == 'symptom')
            {
                $arr =explode("_",$id);
                $eff['strain_id'] =$arr[0];
                $eff['symptom_id'] =$arr[1];
                if($st = $this->OverallSymptomRating->find('first',array('conditions'=>array("strain_id"=>$eff['strain_id'],"symptom_id"=>$eff['symptom_id']))))
                {
                    $overallrate = ($st['OverallSymptomRating']['rate']+$rate)/2;
                    $this->OverallSymptomRating->id = $st['OverallSymptomRating']['id'];
                    $overallrate = round($overallrate,2);
                    $this->OverallSymptomRating->saveField('rate',$overallrate);
                }
                else
                {
                    $eff['rate'] =$rate;
                    $this->OverallSymptomRating->create();
                    $this->OverallSymptomRating->save($eff); 
                }
            }
            if($table == 'colour')
            {
                $arr =explode("_",$id);
                $eff['strain_id'] =$arr[0];
                $eff['colour_id'] =$arr[1];
                if($st = $this->OverallColourRating->find('first',array('conditions'=>array("strain_id"=>$eff['strain_id'],"colour_id"=>$eff['colour_id']))))
                {
                    $overallrate = ($st['OverallColourRating']['rate']+$rate)/2;
                    $this->OverallColourRating->id = $st['OverallColourRating']['id'];
                    $overallrate = round($overallrate,2);
                    $this->OverallColourRating->saveField('rate',$overallrate);
                }
                else
                {
                    $eff['rate'] =$rate;
                    $this->OverallColourRating->create();
                    $this->OverallColourRating->save($eff); 
                }
            }
            if($table == 'flavor')
            {
                $arr =explode("_",$id);
                $eff['strain_id'] =$arr[0];
                $eff['flavor_id'] =$arr[1];
                if($st = $this->OverallFlavorRating->find('first',array('conditions'=>array("strain_id"=>$eff['strain_id'],"flavor_id"=>$eff['flavor_id']))))
                {
                    $overallrate = ($st['OverallFlavorRating']['rate']+$rate)/2;
                    $overallrate = round($overallrate,2);
                    $this->OverallFlavorRating->id = $st['OverallFlavorRating']['id'];
                    $this->OverallFlavorRating->saveField('rate',$overallrate);
                }
                else
                {
                    $eff['rate'] =$rate;
                    $this->OverallFlavorRating->create();
                    $this->OverallFlavorRating->save($eff); 
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