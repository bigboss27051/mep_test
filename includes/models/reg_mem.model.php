<?php
 
class Reg_memModel extends BaseModel
{
     
	function add_mem($input,$user_id)
    {
	 
         	$investment_id = $input['investment'];

			$sponsor  =  $input['ref_id'];
			

			$member_team_mod =& m('member_team');
			$lineId = 1 ;
			$data2 = array(
                'member_id' => $user_id,
				'head_team'=> $lineId,
                'upline'    => $input['up_id'],
				'sponsor' => $input['ref_id'],
				'status'  => $input['position'],
				'investment_id'=> $investment_id
 	 			 
            );
			$member_team_mod->add($data2);



			$data3 = array();
			if($input['position'] =="L")
			{	
				 
	         	$data3['left_leg'] = $user_id;
			}  
			if($input['position'] =="R")
			{	
				 
	      		$data3['right_leg'] = $user_id;
			} 
			$member_team_mod->edit($input['up_id'],$data3);
		
	
			$conditions = "head_team =".$lineId;	
			$team = $member_team_mod->find();


			$investment_mod =& m('investment');
			$investment_mod->_set_point_binary2($team,$user_id,$investment_id,$sponsor);
	}
	function leveluper($user_id,$position)
    {
	 	$member_team_mod =& m('member_team'); 
		$conditions = "sponsor =".$user_id." and status_sponsor='".$position."'   ";
		 $spon_po = $member_team_mod->find(array(
            'conditions'    => $conditions ,
            'count' => true, 
          
        ));

		return 	$count= $member_team_mod->getCount();	

	}
	function _sponser_upper($user_id)
    {
		 $investment_mod =& m('investment');
		 $bravo_binary_mod =& m('bravo_binary');
		 $member_team_mod =& m('member_team');
		  $sort  = 'investment_id';
	     $order = 'asc';
		 $check_level  =$investment_mod->find(array(
		                'order'         => "$sort $order",  
		            ));
		
		$sumpv_point = $bravo_binary_mod->_get_pv_total($user_id,'Y','1');
		$go_upper = true;
		foreach ($check_level as $key=>$id)
		{
	
			if($sumpv_point >= $check_level[$key]['amount'])
			{

				
						if($check_level[$key]['leveluper_l'] > 0 and $check_level[$key]['leveluper_r'] >0)
						{ 
							$inv_count_L = $check_level[$key]['leveluper_l'];
							$inv_count_R = $check_level[$key]['leveluper_r'];
			
							$count_L= $this->leveluper($user_id,"L");
							$count_R= $this->leveluper($user_id,"R");

							if($count_L < $inv_count_L or $count_R < $inv_count_R)
							{
			
								$go_upper =false;
							}
						
						}


				if($go_upper)
				{
					$member_team_mod->edit($user_id, array('investment_id' => $check_level[$key]['investment_id']));
					$get_lvl =$check_level[$key]['investment_id'];
				}
				else
				{
					break;	
				}

			}
		}
		$by_pass = $this->_by_pass($user_id);
		if($by_pass)
		{
			if($by_pass >$get_lvl)
			{
				$member_team_mod->edit($user_id, array('investment_id' => $by_pass));
			 
			} 
		}
		
	
	}
	function _by_pass($user_id)
    {
		$member_team_mod =& m('member_team'); 
		$conditions = "member_id =".$user_id ;
		 $by_pass = $member_team_mod->find(array(
            'conditions'    => $conditions ,
                     
        ));
		$by_pass =current($by_pass);
	
		return $by_pass['buy_pass'];
	}
}

?>