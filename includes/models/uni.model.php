<?php

 
class UniModel extends BaseModel
{
    
	
    function caluni($memid,$max_Floor,$round_id,$date_st,$maintain_pay)
    {
		$data_uni = array();
      
		$uni_total =0;
		

		$month_detail_mod =& m('month_detail');
		//$month_detail_mod->drop("round_id=".$round_id) ;
		$br_uni_mod =& m('br_uni');
		//$br_uni_mod->drop("round_id=".$round_id) ; 	

		$date = date("Y-m-d");
		
		$data = array(
                'member_id'  =>$memid,
                 'date' =>$date ,
				'round_id' => $round_id,
                'txt_id' => $memid . ',' ,
				'txt_value' => '0,',
				'lvl' => '0',
				'total' => '0',
			
            );
		$month_detail_mod->add($data );
		
	 
		for ($int_row = 1; $int_row <= $max_Floor; $int_row++) 
		{
			
		 	  
		 	$old_row = $int_row - 1;
			$uni_total = $uni_total + $this->calulevel($old_row,$int_row,$memid,$round_id,$date_st,$maintain_pay);
 
		} 

		return $uni_total; 
    }
	function calulevel($old_Floor,$this_Floor,$memid,$round_id,$date_st,$maintain_pay)
    {
		$total =0;
		 $member_team_mod =& m('member_team'); 
		


		$month_detail_mod =& m('month_detail');

		$conditions =" member_id =". $memid . " and round_id=".$round_id . " and 	lvl=".$old_Floor;
		$read_row = $month_detail_mod->find(array(
		       		'conditions' =>     $conditions,
		             	             
		        ));

		$read_row = current($read_row);
		
		$txt_id =	explode(',', $read_row['txt_id']);
			
		$txt_value =	explode(',', $read_row['txt_value']);
	
		$now_id  ="";
		$now_value ="";
		foreach ($txt_id  as $key=>$id)
        {

		
			$stid =	$txt_id[$key];
			 
			if($stid)
			{
				$conditions = "member_id =".$stid;	
				$team = $member_team_mod->find(array(
			            'conditions' => $conditions,
			            'join'  => 'belongs_to_user',
			         
			             
			        ));
				
				$team =current($team);
				
				
				
				
				
				$left_leg_pay =0;
				$left_leg =0;
				if($team['left_leg'])
				{
					$left_leg = $this->checkuser($team['left_leg'],$date_st);
					if($left_leg)
					{
						$left_leg_pay = $this->checkpay($left_leg,$date_st,$maintain_pay);
						$total = $total + $left_leg_pay['pay'];
						$this->_adduni($memid,$left_leg,$left_leg_pay['pay'],$left_leg_pay['maintained'],$round_id,$this_Floor);
					}
				}

				$right_leg_pay = 0;
				$right_leg =0;

				if($team['right_leg'])
				{
					$right_leg =$this->checkuser($team['right_leg'],$date_st); 
					if($right_leg)
					{
						$right_leg_pay = $this->checkpay($right_leg,$date_st,$maintain_pay);
						$total = $total + $right_leg_pay['pay'] ;
						$this->_adduni($memid,$right_leg,$right_leg_pay['pay'],$right_leg_pay['maintained'],$round_id,$this_Floor);
					}
			
				}
				$now_id  .=$left_leg . "," . $right_leg.",";
				$now_value .=$left_leg_pay['pay'] ."," . $right_leg_pay['pay'] .",";
			}
			else
			{

				$now_id  .="0,0,";
				$now_value .="0,0,";
				
			}

			

		}
		$date = date("Y-m-d");
		
			$data = array(
                'member_id'  =>$memid,
                 'date' =>$date ,
				'round_id' => $round_id ,
                'txt_id' => $now_id  ,
				'txt_value' => $now_value,
				'lvl' => $this_Floor,
				'total' => $total,
			
            );
		$month_detail_mod->add($data );

		return $total;
	}
	function _adduni($memid,$form_id,$value,$maintained,$round_id,$lvl)
    {
	
		$br_uni_mod =& m('br_uni'); 
		$date = date("Y-m-d");
		$data = array(
				        'member_id' => $memid,
						'date'=> $date,
						'form_id'  =>$form_id,
					    'value'  =>	$value ,
				 	 	'lvl' =>	$lvl ,
						'maintained' => $maintained,
						'type' => '1',
						 
						'round_id'=> $round_id,
			           );

		$br_uni_mod->add($data);

	}
	function checkuser($memid,$date_st)
    {
		$set_id =0; 
		$mem_map_mod =& m('mem_map'); 
		$bravo_binary_mod =& m('bravo_binary');
	 

		$sort  = 'level';
        $order = 'ASC';
		$conditions = "root_id =".$memid;	
		$team = $mem_map_mod->find(array(
			            'conditions' => $conditions,
 						'order'         => "$sort $order",
			             
			        ));
	 
	 	foreach ($team as $key=>$id)
		{
	
				$ckk_id = $team[$key]['member_id'];
				if($ckk_id)
				{	
					$maintained_month = $bravo_binary_mod->_get_maintained_month3($ckk_id,$date_st);
				 
		 			if($maintained_month )
					{

						$set_id = $ckk_id;
						break;
					}
				}
				 
				

		}  
		
		return $set_id ;
	}

	function checkpay($memid,$date_st,$maintain_pay)
    {
		$maint_pay =array();
		$bravo_binary_mod =& m('bravo_binary');
		$maint_pay = $bravo_binary_mod->_get_maintained_pay($memid,$date_st,$maintain_pay);
 
		return $maint_pay;
	}
 
}

?>