<?php

class Br_fast_startModel extends BaseModel
{
    var $table  = 'br_fast_start';
    var $prikey = 'fast_start_id';
    var $_name  = 'br_fast_start';
     
      

	function _get_point_total($stid,$type)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_fast_start WHERE type =".$type." and member_id =" . $stid   );
	} 
	
	function _get_point_total_in($stid,$date)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_fast_start WHERE  staus =1 and type =1 and date <='".$date."' and  member_id =" . $stid   );
	} 
	function _get_point_total_out($stid,$date)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_fast_start WHERE  staus =1 and type =2 and date <='".$date."' and  member_id =" . $stid   );
	} 

	function _get_sum_date($stid,$code)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_fast_start WHERE round_id  = ".$code."  and type =1 and member_id =" . $stid   );
	} 
	function _set_fast_forpay($mem_id,$date_st,$round_id,$round)
	{
		$node = array();

		$fs_in = $this->_get_point_total_in($mem_id,$date_st);
		$fs_out = $this->_get_point_total_out($mem_id,$date_st);
	
		$Total = $fs_in - $fs_out;

		 	 
			$data = array(
				        'member_id' => $mem_id,
						'date'=> $date_st,
						'order_id'=>  '0',
				        'fast_start_name'    =>' Commission  round-> ' . $round  ,
						'form_id'  =>'0',
					    'value'  => $Total ,
				 	 	'investment_id' => '0',
						'form_pv'  => 0,
						'type' => 2,
						'use_com' => '1',
						'round_id'=> $round_id,
			           );
			
			$this->add($data);
		 


		return $Total;	
	}
	 
}

?>
