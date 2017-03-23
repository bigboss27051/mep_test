<?php

class Br_mobileModel extends BaseModel
{
    var $table  = 'br_mobile';
    var $prikey = 'mobile_id';
    var $_name  = 'br_mobile';
     
      

	function _get_point_total($stid,$type)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_mobile WHERE type =".$type." and member_id =" . $stid   );
	} 
	
	function _get_point_total_in($stid,$date)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_mobile WHERE  staus =1 and type =1 and date <='".$date."' and  member_id =" . $stid   );
	} 
	function _get_point_total_out($stid,$date)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_mobile WHERE  staus =1 and type =2 and date <='".$date."' and  member_id =" . $stid   );
	} 

	function _get_sum_date($stid,$code)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_mobile WHERE round_id  = ".$code."  and type =1 and member_id =" . $stid   );
	} 
	function _set_mobile_forpay($mem_id, $maintained,$date_st,$round_id,$round)
	{
		$node = array();

		$node['mo_in'] = $this->_get_point_total_in($mem_id,$date_st);
		$node['mo_out'] = $this->_get_point_total_out($mem_id,$date_st);
	
		$node['mo_value'] = $node['mo_in'] - $node['mo_out'];

		 	$node['mo_total']  =$node['mo_value'];
			$data = array(
				        'member_id' => $mem_id,
						'date'=> $date_st,
						'order_id'=>  '0',
				        'mobile_name'    =>' Commission  round-> ' . $round  ,
						'form_id'  =>'0',
					    'value'  =>$node['mo_value'] ,
				 	 	'investment_id' => '0',
						'form_pv'  => 0,
						'type' => 2,
						'use_com' => '1',
						'round_id'=> $round_id,
			           );
			
					$this->add($data);
		 


		return $node;	
	}
	 

	 
	 
}

?>
