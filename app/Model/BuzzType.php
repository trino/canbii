<?php 
class BuzzType extends AppModel {
	
  public $uses = array('BuzzType','Strain');
	public $hasMany=array('Strain'=>array('className'=>'Strain',
                                 'foreignKey'=>'type_id',
                                 'dependent'=>true,
                                 'exclusive'=>true
                                )
                );
}
?>
