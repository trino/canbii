<?php
class Strain extends AppModel
{
     public $uses = array('EffectRating','Strain');
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
                                'StrainLocation'=>array('className'=>'StrainLocation',
                                 'foreignKey'=>'strain_id',
                                 'dependent'=>true,
                                 'exclusive'=>true
                                ),
                                      
                );
}