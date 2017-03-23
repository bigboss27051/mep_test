<?php

class Br_rewardModel extends BaseModel
{
    var $table  = 'br_reward';
    var $prikey = 'rw_id';
    var $_name  = 'br_reward';
     
   
	 
	function _set_reward_forpay($mem_id,$date_st,$round_id,$round,$amount,$all_total,$vat,$dudate,$dtail_id)
	{
			$data = array(
				        'member_id' => $mem_id,
						'date'=> $date_st,
					 
				        'rw_name'    =>' Commission  round-> ' . $round  ,
						'form_id'  =>'0',
					    'amount'  => $amount,
						'value'  =>$all_total,
						'vat'  =>$vat,
						'type' => 1,
						'round_id'=> $round_id,
						'du_date' => $dudate,
						'detail_id' => $dtail_id,
			           );
			
					$this->add($data);
	}
}

?>
