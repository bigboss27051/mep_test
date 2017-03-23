<?php

class Br_spModel extends BaseModel
{
    var $table  = 'br_sp';
    var $prikey = 'sp_id';
    var $_name  = 'br_sp';
   

 	function _get_sp_total_in($stid)
	{
	 
		return $this->getOne("SELECT SUM(value) as total FROM " . $this->table . "  WHERE   type =1 and status =1 and member_id =" . $stid . "   and active=1");
	}
	function _get_sp_total_out($stid)
	{
	 
		return $this->getOne("SELECT SUM(value) as total FROM " . $this->table . "  WHERE   type =2 and status =1 and member_id =" . $stid . "   and active=1");
	} 

	 
	function _rem_sp($member_id,$rp_point,$loopid)
	{
 
			$date_t = date("Y-m-d");
			$data_pay = array(
			            'member_id' =>$member_id,
						'order_id' =>$loopid,
						'date'=> $date_t,
			            'sp_name'    =>'Bonus Play at board' , 
						'value'  => $rp_point ,
						'active' => '1' ,
						'type' => '2' ,
		            ); 
				
			$this->add($data_pay );
	} 
	function _add_sp($member_id,$rp_point,$loopid)
	{
 
			$date_t = date("Y-m-d");
			$data_pay = array(
			            'member_id' =>$member_id,
						'order_id' =>$loopid,
						'date'=> $date_t,
			            'sp_name'    =>'Bonus Play at board' , 
						'value'  => $rp_point ,
						'active' => '1' ,
						'type' => '1' ,
		            ); 
				
			$this->add($data_pay );
	} 
	 

	
}

?>
