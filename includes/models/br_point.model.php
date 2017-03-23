<?php

class Br_pointModel extends BaseModel
{
    var $table  = 'br_point';
    var $prikey = 'point_id';
    var $_name  = 'br_point';
     

	function _get_point_total_in($stid)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . $this->table . "  WHERE type =1 and  status =1 and member_id =" . $stid );
	} 
	function _get_point_total_out($stid)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . $this->table . "  WHERE type =2 and status =1 and member_id =" . $stid );
	} 
   function _Add_mypoint($user_id, $pv,$point_name)
	{
		$date_t = date("Y-m-d");
		$data = array(
	                'member_id' => $user_id,
					'date'=> $date_t,
	                'point_name'    => $point_name,
					'value'  => $pv ,
	 	 			 
            	);
		 $this->add($data);

	}  
	function _get_point_total_inall()
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . $this->table . "  WHERE type =1 and  status =1 "  );
	} 
	function _get_point_total_outall()
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . $this->table . "  WHERE type =2 and  status =1 ");
	} 
	 function _Add_mypoint_out( $point,$loopid)
	{
		$date_t = date("Y-m-d");
		$data = array(
					'order_id' =>$loopid,
	                'member_id' => 0,
					'date'=> $date_t,
	                'point_name'    => 'Play at board ',
					'value'  => $point ,
					'type'  => '2' ,
	 	 			 
            	);
		 $this->add($data);

	}  
	 
}

?>
