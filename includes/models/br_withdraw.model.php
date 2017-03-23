<?php

 
class Br_withdrawModel extends BaseModel
{
    var $table  = 'br_withdraw';
    var $prikey = 'withdraw_id';
    var $_name  = 'br_withdraw';

    
 
	function _set_so_id()
    {
		 
		$ff ="WD";
		$conditions= " and  order_sn like '". $ff . "%' ";
		$this->find(array(
      		'fields' => 'this.user_name ',
            'conditions' => '1=1 ' . $conditions,
            'count' => true,
        ));
	
		$str_code =$this->getCount() + 1;   
	 
		switch (strlen($str_code)) {
			  case 1:
			      $str_code ="-000" . $str_code;
			    break;
			  case 2:
			    $str_code ="-00" . $str_code;
			    break;
			  case 3:
			   	$str_code ="-0" . $str_code;
			    break;
			}

		$str_code = $ff .$str_code;

		return $str_code;

	}
}

?>
