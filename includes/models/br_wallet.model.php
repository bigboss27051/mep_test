<?php

 
class Br_walletModel extends BaseModel
{
    var $table  = 'br_wallet';
    var $prikey = 'wallet_id';
    var $_name  = 'br_wallet';
 
	function _get_wallet_total_in($stid)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_wallet WHERE type =1 and  status =1 and member_id =" . $stid );
	} 
	function _get_wallet_total_out($stid)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_wallet WHERE type =2 and status =1 and member_id =" . $stid );
	} 
    
}

?>