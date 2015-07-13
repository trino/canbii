<?php
$Controller = new Controller();
class Strain extends AppModel
{
   // App::uses('SessionComponent', 'Controller/Component');
     public $uses = array('EffectRating','Strain','CakeSession','Controller/Component');
     //public $controller = $this->_registry->getController();
    
    // public $doctor = $this->con->Session->read('User.id');
	public $hasMany=array('OverallEffectRating'=>array('className'=>'OverallEffectRating',
                                 'foreignKey'=>'strain_id',
                                 'dependent'=>true,
                                 'exclusive'=>true
                                ),
                                'OverallSymptomRating'=>array('className'=>'OverallSymptomRating',
                                 'foreignKey'=>'strain_id',
                                 'dependent'=>true,
                                 'exclusive'=>true
                                ),
                                'Flavorstrain'=>array('className'=>'Flavorstrain',
                                 'foreignKey'=>'strain_id',
                                 'dependent'=>true,
                                 'exclusive'=>true
                                ),
                                
                                'Review'=>array('className'=>'Review',
                                 'foreignKey'=>'strain_id',
                                 'dependent'=>true,
                                 'exclusive'=>true
                                ),
                                'StrainImage'=>array('className'=>'StrainImage',
                                 'foreignKey'=>'strain_id',
                                 'dependent'=>true,
                                 'exclusive'=>true
                                ),
                                'UserSymptomRating'=>array(
                                 'className'=>'UserSymptomRating',
                                 'foreignKey'=>'strain_id',
                                 'dependent'=>true,
                                 'exclusive'=>true
                                ),
                                'UserEffectRating'=>array('className'=>'UserEffectRating',
                                 'foreignKey'=>'strain_id',
                                 'dependent'=>true,
                                 'exclusive'=>true
                                ),
                                      
                );
     public $belongsTo = array(
		'StrainType' => array(
			'className' => 'StrainType',
			'foreignKey' => 'type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);           
}