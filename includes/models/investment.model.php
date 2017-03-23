<?php


class InvestmentModel extends BaseModel
{
    var $table  = 'investment';
    var $alias  = 'investment';
    var $prikey = 'investment_id';
    var $_name  = 'investment';
    
	var $_relation = array(
        
		'has_team' => array(
            'model'       => 'member_team',       
            'type'        => HAS_ONE,       
            'foreign_key' => 'investment_id',     
                    
        ),
		'has_map' => array(
            'model'       => 'member_team',       
            'type'        => HAS_ONE,       
            'foreign_key' => 'investment_id',     
                    
        ),
		
	);

	function _get_name_inv($id)
	{
		 
		return $this->getOne("SELECT name  FROM " . DB_PREFIX . "investment WHERE  investment_id = ".$id );
	}
	function get_options2($code)
    {
        $oppti =  "";
        $regions = $this->find(array(
                'order' => 'investment_id',
            ));
		$oppti .="<option value='' selected=selected>Select Investment </option>";
		$set_select ="";
        foreach ($regions as $region)
        {
			$set_select ="";
			if($code == $region['investment_id'])
			{
				$set_select ="selected";
			}
              
			$oppti .="<option value='".$region['investment_id']."'  ".$set_select." >".$region['name']."</option>"; 
        }
        return $oppti;
    }
	function get_options()
    {
        $oppti =  "";
        $regions = $this->find(array(
                'order' => 'investment_id',
            ));
		$oppti .="<option value='' selected=selected>Select Investment </option>";
        foreach ($regions as $region)
        {
              
			$oppti .="<option value='".$region['investment_id']."' >".$region['name']."</option>"; 
        }
        return $oppti;
    }
	function get_options_function()
    {
        $res = array();
      	 
		 $regions = $this->find(array(
                'order' => 'investment_id',
            ));
		foreach ($regions as $region)
        {
            $res[$region['investment_id']] = $region['name'];
        }
         
        return $res;
    }
	function get_options_function_cycle()
    {
        $res = array();
      	 
		 $regions = $this->find(array(
                'order' => 'investment_id',
            ));
		foreach ($regions as $region)
        {
            $res[$region['investment_id']] = $region['cycle'];
        }
         
        return $res;
    }
	function _set_point_fast_start($stid,$inves,$sponsor,$user_regis,$user_regis_id,$sp_inves,$order_id,$form_pv,$pvpercent,$register = 0, $fast_extra =0)
	{
		$br_fast_start_mod =& m('br_fast_start');
		$bag_mod =& m('bag');
		 
	//	$value =floatval($sp_inves['fast_start']) * floatval($inves) ;
 
	//	$value = floatval($value) / 100;

		$txt_limit="";
		if($inves ==0)
		{
				$txt_limit ="(Limit Max fast start)";
		}
	 
		$date_t = date("Y-m-d");
		$data = array(
	        'member_id' => $sponsor,
			'date'=> $date_t,
			'order_id'=> $order_id,
	        'fast_start_name'    =>' From Order -> ' . $order_id ." " .$txt_limit,
			'form_id'  =>$stid,
		    'value'  =>$inves,
	 	 	'investment_id' => $inv,
			'pv_percent'=> $pvpercent,
			'form_pv'  => $form_pv,
           );

		$br_fast_start_mod->add($data);
		if($register)
		{
			if($fast_extra)
			{


				$member_team_mod =& m('member_team');
				$team = $member_team_mod->find($sponsor);

				$team=current($team);

				$conditions ="investment_id =".$team['investment_id'];
				$ttinves =$this->find(array(
	                	'conditions' =>   $conditions,  
	            	));
				$ttinves =current($ttinves);


				if($ttinves['get_extra'])
				{
					$data = array(
				        'member_id' => $sponsor,
						'date'=> $date_t,
						'order_id'=> $order_id,
				        'fast_start_name'    =>' Extra From Order -> ' . $order_id ." " .$txt_limit,
						'form_id'  =>$stid,
					    'value'  =>$fast_extra,
				 	 	'investment_id' => $inv,
						'pv_percent'=> '0',
						'form_pv'  =>'0',
			           );
			
					$br_fast_start_mod->add($data);
				}
			}
			
		}
		
		//$Cs_crow = $br_fast_start_mod->_get_point_total($sponsor,'1');
		//$bag_mod->updat_CS($Cs_crow,$sponsor);
	}
	function _set_point_addcrow($stid,$inv_val,$inv_id,$name )
	{
		$inv_buy_mod =& m('inv_buy');
		$cr_sell_mod =& m('cr_sell');
		$cr_buy_mod =& m('cr_buy');
		$bag_mod =& m('bag');

		$cr_portsell_mod =& m('cr_portsell');
		$rate =$cr_portsell_mod->get_ratenow2();
		$rate =current($rate);

	 
		$total_crown =floatval($inv_val) / floatval($rate['ratenow']);
		
		$data = array(
	        'member_id' => $stid,
			'rate'=> $rate['ratenow'],
			'name' => 'Buy => ' . $name,
	        'amount'    =>$total_crown ,
			'value'    =>$inv_val ,
	 	 	'investment_id' => $inv_id,
           );
		$inv_buy_mod->add($data);
		$inv_crow = $inv_buy_mod->_get_point_total($stid);
		$tb_crow = $cr_buy_mod->_get_point_total($stid);
		$ts_crow = $cr_sell_mod->_get_point_total($stid);
		$tall_crow =($inv_crow + $tb_crow) -$ts_crow;
		$bag_mod->updat_TC2($tall_crow,$stid,$rate['ratenow']);
		
	}
	function _set_point_binary2($team,$stid,$inv,$sponsor)
	{
		$mem_map_mod =& m('mem_map');
		
		$userid = $stid;
		$loop_arr = count($team);
		$user_regis =$team[$stid]['user_name'];
		$user_regis_id =$team[$stid]['member_id'];
		$id_row =0;
		$level =1;

	 	$lvl_upline =0;
	 	$mem_map_mod->_set_map_root($userid,$userid,0,0);
	 


		$status =true;

			do {
	
		 	$position ="";
			$upline = $team[$stid]['upline'];
			if($level ==1)
			{
				$lvl_upline =$team[$stid]['upline'];
			}
			
			if($upline)
			{
 
				$stid =$upline;
				
				$ckk_no = $this->_ckk_lvlnode($lvl_upline,$upline,$userid);
				$mem_map_mod->_set_map_root($userid,$upline,$level,$ckk_no);
			}
			else
			{
				$status =false;
			}
			$level++;
			$id_row++;
				
			if($id_row==$loop_arr)
			{
				$status =false;
			}
		} while ($status);
	 

	}
	function _ckk_lvlnode($upline_id,$head_id,$userid)
	{
		$mem_map_mod =& m('mem_map');
		$conditions = " mem_map.root_id =".$head_id ." and mem_map.member_id =" .$upline_id  ;
		$row_level = $mem_map_mod->find(array(
					            'conditions' =>     $conditions,
					            'join'  => 'belongs_to_team',
					         
					             
					        ));
	

		$row_level =current($row_level);

		$ckk_no =floatval($row_level['no'] * 2);
		if($ckk_no < 1)
		{
			$ckk_no =2;
		}

		if($row_level['left_leg'] == $userid)
		{
			$ckk_no =$ckk_no - 1;
			
		}
	 
		  

		return $ckk_no;
	}
	function _set_point_binary($team,$stid,$inv,$sponsor)
	{
		$bravo_binary_mod =& m('bravo_binary');
		
		$mem_map_mod =& m('mem_map');
		
		$userid = $stid;
		
		$conditions ="investment_id =".$inv;
		$inves = $this->find(array(
	                'conditions' =>   $conditions,  
	            ));
		$inves =current($inves);
	
		$loop_arr = count($team);
		
		
		$conditions ="investment_id =".$team[$sponsor]['investment_id'];
		$sp_inves =$this->find(array(
	                'conditions' =>   $conditions,  
	            ));
		$sp_inves =current($sp_inves);

		$user_regis =$team[$stid]['user_name'];
		$user_regis_id =$team[$stid]['user_id'];
		$id_row =0;
		$status =true; 
		
		$this->_set_point_fast_start($userid,$inves['amount'] ,$sponsor,$user_regis,$user_regis_id,$sp_inves);
		$this->_set_point_addcrow($userid,$inves['amount'],$inves['investment_id'],$inves['name']);
		do {
	
		 	$position ="";
				$upline = $team[$stid]['upline'];
				if($upline)
				{
	
				if($stid == $team[$upline]['left_leg'] )
				{
					$position ="L";
				}
				if($stid == $team[$upline]['right_leg'] )
				{
					$position ="R";
				}
				$stid =$upline;
				$date_t = date("Y-m-d");
				$data = array(
	                'member_id' => $upline,
					'date'=> $date_t,
	                'binary_name'    =>'Register user -> ' . $user_regis,
					'position' =>$position,
					'form_id'  => $user_regis_id,
					'value'  => $inves['amount'],
	 	 			'investment_id' => $inv,
            	);
				$bravo_binary_mod->add($data);
				$bravo_binary_mod->_set_point_update($upline);
				
 
				$mem_map_mod->_set_map_root($userid,$upline);
			}
			else
			{
				$status =false;
			}
			
			$id_row++;
				
			if($id_row==$loop_arr)
			{
				$status =false;
			}
		} while ($status);
	 
			
	
	}

	
	function _set_point_binary_pv($team,$stid,$pv,$sponsor,$order_id,$gofast,$key_id,$get_lvl,$register=0)
	{
		$member_team_mod =& m('member_team');
		$bravo_binary_mod =& m('bravo_binary');
		
		$mem_map_mod =& m('mem_map');
		
		$userid = $stid;
		
		//$conditions ="investment_id =".$inv;
		//$inves = $this->find(array(
	    //            'conditions' =>   $conditions,  
	    //        ));
		//$inves =current($inves);
	
		$loop_arr = count($team);
		
		
		

		$user_regis =$team[$stid]['user_name'];
		$user_regis_id =$team[$stid]['user_id'];
		$id_row =0;
		$status =true; 

		if($sponsor)
		{
			if($gofast)
			{
				$conditions ="investment_id =".$team[$sponsor]['investment_id'];
				$sp_inves =$this->find(array(
	                	'conditions' =>   $conditions,  
	            	));
				$sp_inves =current($sp_inves);
				//$fast_start =  $sp_inves['fast_start']  ;
				
				$pv2 =$pv;

				if($sp_inves['fast_start_max'] < $pv)
				{
					$pv2 =$sp_inves['fast_start_max'];
				}
				$fast_start = ($pv2 * $sp_inves['fast_start'] ) /  100 ;

				if($sp_inves['get_extra']==0)
				{
					$register =$sp_inves['get_extra'];
				}
		
				$this->_set_point_fast_start($userid,$fast_start,$sponsor,$user_regis,$user_regis_id,$sp_inves,$order_id,$pv,$sp_inves['fast_start'],$register,$sp_inves['fast_extra']);
			}
			else
			{
				$this->_set_point_fast_start($userid,'0',$sponsor,$user_regis,$user_regis_id,$sp_inves,$order_id,$pv,'0',$register);
			}
		}
		//$c_mobile = $member_team_mod->find($key_id);
		//$c_mobile =current($c_mobile);
		//if($c_mobile['mobile'])
		//{
		//	$conditions ="investment_id =".$get_lvl;
		//	$mob_inves =$this->find(array(
	    //            	'conditions' =>   $conditions,  
	    //        	));
		//	$mob_inves =current($mob_inves);
		//	$mobile_pay =  $mob_inves['mobile']  ;
		//	
		//	$this->_set_point_mobile($userid,$mobile_pay ,$key_id,$user_regis,$user_regis_id,$sp_inves,$order_id,$pv);
		//}
		//$this->_set_point_addcrow($userid,$inves['amount'],$inves['investment_id'],$inves['name']);
		do {
	
		 	$position ="";
				$upline = $team[$stid]['upline'];
				if($upline)
				{
	
				if($stid == $team[$upline]['left_leg'] )
				{
					$position ="L";
				}
				if($stid == $team[$upline]['right_leg'] )
				{
					$position ="R";
				}
				$stid =$upline;
				$date_t = date("Y-m-d");
				$data = array(
	                'member_id' => $upline,
					'date'=> $date_t,
					'order_id' =>  $order_id,
	                'binary_name'    =>' From Order -> ' . $user_regis,
					'position' =>$position,
					'form_id'  => $user_regis_id,
					'value'  => $pv ,
	 	 			'investment_id' => $inv,
            	);
				$bravo_binary_mod->add($data);
				//$bravo_binary_mod->_set_point_update($upline);
				
				if($sponsor == $upline)
				{
					$member_team_mod->edit($user_regis_id ,array('status_sponsor' => $position)); 
				}
 
				 
			}
			else
			{
				$status =false;
			}
			
			$id_row++;
				
			if($id_row==$loop_arr)
			{
				$status =false;
			}
		} while ($status);
	 
			
	
	}
	function _set_point_mobile($stid,$inves,$sponsor,$user_regis,$user_regis_id,$sp_inves,$order_id,$form_pv)
	{
		$br_mobile_mod =& m('br_mobile');
 
		$txt_limit="";
		 
	 
		$date_t = date("Y-m-d");
		$data = array(
	        'member_id' => $sponsor,
			'date'=> $date_t,
			'order_id'=> $order_id,
	        'mobile_name'    =>'Mobile From Order -> ' . $order_id ." " .$txt_limit,
			'form_id'  =>$stid,
		    'value'  =>$inves,
	 	 	'investment_id' => $inv,
			'form_pv'  => $form_pv,
           );

		$br_mobile_mod->add($data);

		 
	}

	function _advanc_point_pv($team,$stid,$pv,$topic )
	{
		$member_team_mod =& m('member_team');
		$bravo_binary_mod =& m('bravo_binary');
		
		$mem_map_mod =& m('mem_map');
		
		$userid = $stid;
		
	 
	
		$loop_arr = count($team);
		
		
		

		$user_regis =$team[$stid]['user_name'];
		$user_regis_id =$team[$stid]['user_id'];
		$id_row =0;
		$status =true; 
 
		do {
	
		 	$position ="";
				$upline = $team[$stid]['upline'];
				if($upline)
				{
	
				if($stid == $team[$upline]['left_leg'] )
				{
					$position ="L";
				}
				if($stid == $team[$upline]['right_leg'] )
				{
					$position ="R";
				}
				$stid =$upline;
				$date_t = date("Y-m-d");
				$data = array(
	                'member_id' => $upline,
					'date'=> $date_t,
					'order_id' =>  $order_id,
	                'binary_name'    =>' Advance -> ' . $topic,
					'position' =>$position,
					'form_id'  => $user_regis_id,
					'value'  => $pv ,
	 	 			'investment_id' => $inv,
            	);
				$bravo_binary_mod->add($data);
				//$bravo_binary_mod->_set_point_update($upline);
				
				if($sponsor == $upline)
				{
					$member_team_mod->edit($user_regis_id ,array('status_sponsor' => $position)); 
				}
 
				 
			}
			else
			{
				$status =false;
			}
			
			$id_row++;
				
			if($id_row==$loop_arr)
			{
				$status =false;
			}
		} while ($status);
	 
			
	
	}

	
}



?>
