<?php

class Br_paycomModel extends BaseModel
{
    var $table  = 'br_paycom';
    var $prikey = 'pay_id';
    var $_name  = 'br_paycom';
   


	function get_listtran($memid)
    {
    
         
        $sql = " SELECT * FROM mlm_br_paycom paycom LEFT JOIN mlm_member member ON member.user_id = paycom.member_id ";
		 
		$sql .= "  where trans =1  and  paycom.member_id =".$memid." ORDER BY paycom.pay_id  DESC ";

        $d_list = $this->db->getAll($sql);
 

        return $d_list;
    }

	function _get_pv_total_l($stid)
	{
	 
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_paycom WHERE   type =1 and status =1 and member_id =" . $stid . " and position='L' and active=1");
	}
  


	function  _get_pv_total_r($stid)
	{
		 
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_paycom WHERE   type =1 and status =1 and member_id =" . $stid . " and position='R' and active=1");
	}
	 
	
	function _get_pv_total_m($stid)
	{
		 
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_paycom WHERE     status =1  and type =2 and member_id =" . $stid . " and active=1 and position='M'");
	}

	function _get_pv_total_other($stid)
	{
		 
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_paycom WHERE     status =1  and type =1 and member_id =" . $stid . " and active=1 and position=''");
	}
	
	function _get_pv_totalwait($stid)
	{
		 
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_paycom WHERE    type =1 and status =1 and member_id =" . $stid . " and active=0");
	}
	 
}

?>
