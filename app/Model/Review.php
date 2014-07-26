<?php
class Review extends AppModel
{
     public $uses = array('EffectRating','Strain');
	public $hasMany=array('EffectRating'=>array('className'=>'EffectRating',
                                 'foreignKey'=>'review_id',
                                 'dependent'=>true,
                                 'exclusive'=>true
                                ),
                                'SymptomRating'=>array('className'=>'SymptomRating',
                                 'foreignKey'=>'review_id',
                                 'dependent'=>true,
                                 'exclusive'=>true
                                ),
                                'FlavorRating'=>array('className'=>'FlavorRating',
                                 'foreignKey'=>'review_id',
                                 'dependent'=>true,
                                 'exclusive'=>true
                                ),
                                'ColourRating'=>array('className'=>'ColourRating',
                                 'foreignKey'=>'review_id',
                                 'dependent'=>true,
                                 'exclusive'=>true
                                ),
                                      
                );
     public $belongsTo = array(
		'Strain' => array(
			'className' => 'Strain',
			'foreignKey' => 'strain_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
        
	);           
}