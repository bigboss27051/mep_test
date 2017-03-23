<?php

 
class Inv_buyModel extends BaseModel
{
    var $table  = 'inv_buy';
    var $prikey = '	buy_id';
    var $_name  = 'inv_buy';

    
 
	function _get_point_total($stid )
	{
		return $this->getOne("SELECT SUM(amount) as total FROM " . DB_PREFIX . "inv_buy WHERE     member_id =" . $stid   );
	} 
}


?>
