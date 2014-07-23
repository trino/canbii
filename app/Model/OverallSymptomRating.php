<?php
class OverallSymptomRating extends AppModel
{
    public $belongsTo = array(
		'Strain' => array(
			'className' => 'City',
			'foreignKey' => 'strain_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}