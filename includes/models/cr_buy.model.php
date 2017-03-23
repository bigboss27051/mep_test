<?php

 
class Cr_buyModel extends BaseModel
{
    var $table  = 'cr_buy';
    var $prikey = 'id';
    var $_name  = 'cr_buy';

    
	function  get_report_buy($cusid)
	{
	
		$sort  = 'buydate';
        $order = ' DESC';
		$conditions = " customerid = " .$cusid  ;	
		$result = $this->find(array(
		            'conditions' => $conditions,  
					'order' => "$sort $order",             
		        ));
		 
		return $result;
	}

	function  insert_order_buy($customerid, $rate, $amount, $status, $portid, $total)
	{
		$data = array(
                'customerid' => $customerid ,
			 	'rate' => $rate,
				'amount' => $amount,
				'status' => $status,
				'portid' => $portid,
			 
				'total_crown' => $total,
            );

		$this->add($data);

 
	}
	
	function  updat_all_buy($cusid)
	{
	
		$this->edit("status='a' and customerid=" . $cusid, array('status' => 'i'));
	}
	
	function _get_point_total($id)
	{
		return $this->getOne("SELECT SUM(total_crown) as total FROM " . DB_PREFIX . "cr_buy WHERE id=" . $id   );
	} 
}


?>
