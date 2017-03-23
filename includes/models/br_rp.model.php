<?php

class Br_rpModel extends BaseModel
{
    var $table  = 'br_rp';
    var $prikey = 'rp_id';
    var $_name  = 'br_rp';
   

 	function _get_rp_total_in($stid)
	{
	 
		return $this->getOne("SELECT SUM(value) as total FROM " . $this->table . "  WHERE   type =1 and status =1 and member_id =" . $stid . "   and active=1");
	}
	function _get_rp_total_out($stid)
	{
	 
		return $this->getOne("SELECT SUM(value) as total FROM " . $this->table . "  WHERE   type =2 and status =1 and member_id =" . $stid . "   and active=1");
	} 

	function _get_rp($userid)
	{
		
		$rp_in =	$this->_get_rp_total_in($userid);
		$rp_out = $this->_get_rp_total_out($userid);
	
		$total_mem = $rp_in - $rp_out;
		return  $total_mem;
	}
	
	function _get_rp_total()
	{
		
		return $this->getOne("SELECT SUM(value) as total FROM " . $this->table . "  WHERE   type =1 and status =1     and active=1");
	  
	} 

 	function _rem_rp($member_id,$rp_point,$loopid)
	{
 
			$date_t = date("Y-m-d");
			$data_pay = array(
			            'member_id' =>$member_id,
						'order_id' =>$loopid,
						'date'=> $date_t,
			            'rp_name'    =>'Play at board 9Corperation' , 
						'value'  => $rp_point ,
						'active' => '1' ,
						'type' => '2' ,
		            ); 
				
			$this->add($data_pay );
	} 
  
	
	function _investment_rp($member_id)
	{
		$investment_mod =& m('investment');
		$member_team_mod =& m('member_team');
		
		$team = $member_team_mod->find($member_id);
		$team = current($team);
		 
		$inv = $investment_mod->find($team['investment_id']);
		$inv = current($inv);

		return $inv['rp_set'];
			
	}

	function _get_start()
	{
	
	 
		$sSQL = "SELECT * FROM board_start";
	
		$ff = $this->getAll($sSQL);
		$ff =current($ff);
	 
    	return $ff['start'];
	}
	function  _insert_data_RP_log($loopid, $rp, $ad, $gw, $status,$userid)
	{
	
	 	
		$sSQL = "INSERT INTO board_member_rp(loopid, rp, ad, gw, status, userid) VALUES ($loopid, $rp, $ad, $gw, '$status', $userid)";
	 	return $this->getQuery($sSQL);
	  
	}
	function  _getloopid()
	{
		$sSQL = "SELECT id,adjust FROM `board_admin_setting` WHERE status='T'";
		return   $this->getAll($sSQL);
	}
	function  _get_max_all($loopid)
	{
		$sSQL = "SELECT sum(rp) as maxall FROM `board_member_rp` WHERE loopid=".$loopid;
		return $this->getAll($sSQL);
	}
	function _update_gw_user($loopid)
	{
		$sSQL = "SELECT * FROM board_member_rp WHERE loopid=" . $loopid ;
		return $this->getAll($sSQL);
	}
	function  _insert_new_loop()
	{
		$sSQL = "INSERT INTO `board_admin_setting`(`adjust`, `allsale`, `allsalenow`, `status`) VALUES (10,0,0,'T')";
    	return $this->getQuery($sSQL);
	}
	function  _close_loop($loopid)
	{
		$sSQL = "UPDATE `board_admin_setting` SET `status`='F' WHERE id=".$loopid;	
     	return $this->getQuery($sSQL);
	}

	function _update_next_loop($loopid)
	{
		$sSQL = "UPDATE `board_member_rp` SET `loopid`=$loopid  , status='O' ";
 		return $this->getQuery($sSQL);
	}
 
	function _insert_data_loop()
	{
	
		$br_point_mod =& m('br_point'); 
		$loopdata = $this->_getloopid();
		foreach ($loopdata as $key => $val)
        {
			$datamax = $this->_get_max_all($loopdata[$key]['id']);

			foreach ($datamax as $key2 => $val2)
        	{ 
				$maxallsale = $datamax[$key2]['maxall'] * ($loopdata[$key]['adjust']/100);

				$point_in =$br_point_mod->_get_point_total_inall();
				$point_out =$br_point_mod->_get_point_total_outall();
				$allsale = $point_in - $point_out;	

				
				if($allsale >= $maxallsale)
				{
					$gwuser = $this->_update_gw_user($loopdata[$key]['id']);
				 	foreach ($gwuser as $key3 => $val3)
					{
						//$gw = $gwuser[$key3]['gw'];
						$br_gw_mod =& m('br_gw'); 
						$br_gw_mod->_rem_gw($gwuser[$key3]['userid'],$gwuser[$key3]['gw'] ,$loopdata[$key]['id']);
						


					}
				 
					$br_point_mod->_Add_mypoint_out($maxallsale,$loopdata[$key]['id']);
					
					$this->_insert_new_loop();
					$this->_close_loop($loopdata[$key]['id']);
					$loopdata2 = $this->_getloopid();
					
					foreach ($loopdata2 as $key4 => $val)
        			{
					 
						$this->_update_next_loop($loopdata2[$key4]['id']);
					}
				}
				 
			}
		
			 
		}
		
 

	}
	function _getsp_user($userid)
	{
		$br_sp_mod =& m('br_sp'); 				
		$point_in = $br_sp_mod->_get_sp_total_in($userid);
		$point_out = $br_sp_mod->_get_sp_total_out($userid);
		$allsp = $point_in - $point_out;	
		return $allsp ;
	}
	function _getgw_user($userid)
	{
		$br_gw_mod =& m('br_gw'); 				
		$point_in = $br_gw_mod->_get_gw_total_in($userid);
		$point_out = $br_gw_mod->_get_gw_total_out($userid);
		$allgw = $point_in - $point_out;	
		return $allgw ;
	}
	function _getallsale()
	{
		$br_point_mod =& m('br_point'); 				
		$point_in =$br_point_mod->_get_point_total_inall();
		$point_out =$br_point_mod->_get_point_total_outall();
		$allsale = $point_in - $point_out;	
		return $allsale;
	}

	function  _get_max_all2($loopid)
	{
		$sSQL = "SELECT sum(rp) as maxall FROM `board_member_rp` WHERE loopid=".$loopid;
		return $this->getOne($sSQL);
	}

	function  _get_data_admin()
	{
		$sSQL = "SELECT * FROM board_admin_setting where status='T'";
		return $this->getAll($sSQL);
	}
	
}

?>
