<?php

 
class Goods_setModel extends BaseModel
{
    var $table  = 'goods_set';
    var $prikey = 'rec_id';
    var $_name  = 'goods_set';

    
	
	function  get_goods_set($goods_id)
	{
		$sort  = 'rec_id';
        $order = ' ASC';
		$conditions = " root_id = " .$goods_id  ;	
		$result = $this->find(array(
		            'conditions' => $conditions,  
					'order' => "$sort $order",             
		        ));
	
	 
 
		return $result;
	} 
}

?>
