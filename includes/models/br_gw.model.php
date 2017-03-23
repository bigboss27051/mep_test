<?php

class Br_gwModel extends BaseModel
{
    var $table  = 'br_gw';
    var $prikey = 'gw_id';
    var $_name  = 'br_gw';
   

 	function _get_gw_total_in($stid)
	{
	 
		return $this->getOne("SELECT SUM(value) as total FROM " . $this->table . "  WHERE   type =1 and status =1 and member_id =" . $stid . "   and active=1");
	}
	function _get_gw_total_out($stid)
	{
	 
		return $this->getOne("SELECT SUM(value) as total FROM " . $this->table . "  WHERE   type =2 and status =1 and member_id =" . $stid . "   and active=1");
	} 

	function _get_gw($userid)
	{
		
		$rp_in =	$this->_get_rp_total_in($userid);
		$rp_out = $this->_get_rp_total_out($userid);
	
		$total_mem = $rp_in - $rp_out;
		return  $total_mem;
	}
	function _rem_gw($member_id,$rp_point,$loopid)
	{
 
			$date_t = date("Y-m-d");
			$data_pay = array(
			            'member_id' =>$member_id,
						'order_id' =>$loopid,
						'date'=> $date_t,
			            'gw_name'    =>'Bonus Play at board' , 
						'value'  => $rp_point ,
						'active' => '1' ,
						'type' => '1' ,
		            ); 
				
			$this->add($data_pay );
	} 
	 

	
}

?>
