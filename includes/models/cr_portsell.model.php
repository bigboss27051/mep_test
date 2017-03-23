<?php

 
class Cr_portsellModel extends BaseModel
{
    var $table  = 'cr_portsell';
    var $prikey = 'id';
    var $_name  = 'cr_portsell';

    
	function  get_datarate()
	{
	
		$conditions = " status ='a'" ;	
		$result = $this->find(array(
		            'conditions' => $conditions,               
		        ));
		return $result;
	}
	
	

	function  get_ratenow()
	{
		$sort  = 'id';
        $order = ' ASC';
		$conditions = " status ='i'"   ;	
		$result = $this->find(array(
		            'conditions' => $conditions,  
					'order' => "$sort $order",             
		        ));
 
		 
		return $result;
	}
	function  get_ratenow2()
	{
			$sort  = 'id';
	        $order = ' ASC';
	 	
			$result = $this->find(array(
			          
						'order' => "$sort $order",             
			        ));
	 
			 
			return $result;
	}

	function  updat_ratenext2($id)
	{
		$this->edit($id, array('status' => 'a'));	
	} 

	function  updat_ratenext($id)
	{
	
		$this->edit($id, array('status' => 'd'));	 
	}
	function  updat_amsell($total_amsell)
	{
		
		$this->edit("status='a'", array('amsell' => $total_amsell));	 
	}
	function  updat_ambuy($total_ambuy)
	{
		
		$this->edit("status='a'", array('ambuy' => $total_ambuy));	 
	}
	function  updat_allsell($total)
	{
		
		$this->edit("status='a'", array('amount2' => $total));	 
	}
}


?>
