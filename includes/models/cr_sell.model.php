<?php

 
class Cr_sellModel extends BaseModel
{
    var $table  = 'cr_sell';
    var $prikey = 'id';
    var $_name  = 'cr_sell';

    
	function  get_datasell($rate,$cusid)
	{
		$sort  = 'id';
        $order = ' ASC';
		$conditions = " rate = ".$rate."   and customerid = " .$cusid  ;	
		$result = $this->find(array(
		            'conditions' => $conditions,  
					'order' => "$sort $order",             
		        ));
 
		 
		$sta_sell = "Y";
		foreach ($result as $key => $value)
		{
			$sta_sell = "N";
		}
		 
		return $sta_sell;
	}
	function  get_report_sell($cusid)
	{
		$sort  = 'selldate';
        $order = ' DESC';
		$conditions = " customerid = " .$cusid  ;	
		$result = $this->find(array(
		            'conditions' => $conditions,  
					'order' => "$sort $order",             
		        ));
	
	 
 
		return $result;
	}
	
	function  get_type_sell($id)
	{
		$conditions = " id = " .$id  ;	
		$result = $this->find(array(
		            'conditions' => $conditions,  
					         
		        ));
 
	    
		return $result;
	}

	function  del_sell($id)
	{
		$this->drop($id);
	
	}

	function  insert_order_sell2($customerid, $rate, $amount, $status, $portid ,$cash1, $cash2,$orate)
	{
	
		
		$data = array(
                'customerid' => $customerid ,
			 	'rate' => $rate,
				'amount' => $amount,
				'status' => $status,
				'portid' => $portid,
				'cash' => $cash1,
				'cash2' => $cash2,
				'oldrate' => $orate,
            );
		
		$this->add($data);
 
	}
	
	function  insert_order_sell($customerid, $rate, $amount, $status, $portid ,$cash1,$orate)
	{
	
		
		$data = array(
                'customerid' => $customerid ,
			 	'rate' => $rate,
				'amount' => $amount,
				'status' => $status,
				'portid' => $portid,
				'cash' => $cash1,
				'oldrate' => $orate,
            );
		
		$this->add($data);
 
	}
	function  get_report_sell2()
	{
	
		$sort  = 'id';
        $order = ' ASC';
		$conditions = "status ='a'"  ;	
		$result = $this->find(array(
		            'conditions' => $conditions,  
					'order' => "$sort $order",     	         
		        ));
 

		 
		return $result;
	}

	function  updat_left($id,$c)
	{
		$this->edit($id, array('cleft' => $c  ));

	}
	
	function  updat_all_sell($id)
	{
		$this->edit($id, array('status' => 'i'  ));
	
		 
	}
	function _get_point_total($id)
	{
		return $this->getOne("SELECT SUM(amount) as total FROM " . DB_PREFIX . "cr_sell WHERE id=" . $id  );
	}
	 
}


?>
