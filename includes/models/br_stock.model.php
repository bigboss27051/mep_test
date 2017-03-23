<?php

 
class Br_stockModel extends BaseModel
{
    var $table  = 'br_stock';
    var $prikey = 'stock_id';
    var $_name  = 'br_stock';
     
     function _get_stockhold_total_in($stid,$goods_id)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_stock WHERE type = 1 and goods_id =".$goods_id."   and member_id =" . $stid );
	} 
	function _get_stockhold_out($stid,$goods_id)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_stock WHERE type = 2 and goods_id =".$goods_id."   and member_id =" . $stid );
	}    
        
}

?>