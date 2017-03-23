<?php
 
class CrownApp extends BackendApp
{
    var $_menu_mod;	
	var $_cr_portsell_mod;
	var $_cr_sell_mod;
	var $_bag_mod;
	var $_cr_buy_mod;

    function __construct()
    {
        $this->CrownApp();
    }
    function CrownApp()
    {
        parent::BackendApp();
		$this->_menu_mod =& m('menuleft');
        $this->_cr_portsell_mod =& m('cr_portsell');
		$this->_cr_sell_mod =& m('cr_sell');
		$this->_bag_mod =& m('bag');
		$this->_cr_buy_mod =& m('cr_buy');
    }
	
	function crownadmin()
    {
		if (!IS_POST)
        {
			$cusid = $this->visitor->get('user_id');
	
			$portsell =  $this->_cr_portsell_mod->get_ratenow();
			$Data_port =  $this->_cr_portsell_mod->get_datarate();
			
			foreach ($Data_port as $key => $value)
			{
				$portid = $Data_port[$key]['id'];
				$ratenow2 = $Data_port[$key]['ratenow'];
			}
			//echo $portid . "SSSSSS";
			$this->assign('portid', $portid);
			$this->assign('ratenow2', $ratenow2);
			$this->assign('portsell', $portsell);
			$this->assign('cusid', $cusid);
			$this->assign('menus_left', $this->_menu_mod->set_menu('Crown'));
	        $this->display('crownadmin.index.html');
		}
		else
		{
				if($_POST["status"] == "b")
			{
				$cusid = $this->visitor->get('user_id');
				
					
				/*echo "<script language='javascript'>alert('" . $_POST["sum3"] . "')</script>"; */
				$this->_cr_buy_mod->insert_order_buy($_POST["customerid"], $_POST["rate2"], $_POST["amount2"], 'a', $_POST["portid"],$_POST["sum4"]);	
				
							 
				
				//getratemove($ratenow,$nextrate);
				//getreducesum();
				$this->refreshpage2();
						
					
			}
			
			if($_POST["status"] == "s")
			{
				$cusid = $this->visitor->get('user_id');
			  	
						
				//echo $_POST["customerid"] . "dddddd";

				$this->_cr_sell_mod->insert_order_sell($_POST["customerid"], $_POST["rate"], $_POST["amount"], 'a', $_POST["portid"], $_POST["sum3"],$R);


				$this->refreshpage2();
				
			}
			
		}//If
		
		
	}
 
    function index()
    {

		if (!IS_POST)
        {
			$cusid = $this->visitor->get('user_id');
	
			$Data_port =  $this->_cr_portsell_mod->get_datarate();
			
			foreach ($Data_port as $key => $value)
			{
				$portid = $Data_port[$key]['id'];
				$ratenow = $Data_port[$key]['ratenow'];
				$nextrate = $Data_port[$key]['nextrate'];
				$amsell = $Data_port[$key]['amsell'];
				$ambuy = $Data_port[$key]['ambuy'];
				$amt = $Data_port[$key]['amount'];
				$id = $Data_port[$key]['id'];
				if($amsell >= $amt )
				{
					
					$sta_sell = "N";
					//echo $amsell . " " . $amt;
				}
				else
				{
					$sta_sell = "Y";
					$sta_sell = $this->_cr_sell_mod->get_datasell($ratenow,$cusid);
					//echo "2";
				}
				
				if($ambuy >= $amt )
				{
					$sta_buy = "N";
					$row3 = $this->_cr_portsell_mod->get_ratenow();
	
					foreach ($row3 as $key => $value)
					{
					 
					
						$oldid = $row3[$key]['id']; 
						$this->_cr_portsell_mod->updat_ratenext2($oldid); 
					
					}
					
					$this->_cr_portsell_mod->updat_ratenext($id);
					
				}
				else
				{
					$sta_buy = "Y";
				}
			}
			
		    $row4 = $this->_bag_mod->get_bag($cusid);
			
			foreach ($row4 as $key => $value)
			{
		 		$TC = $row4[$key]["TC"]; 
				$R =  $row4[$key]["rate"];
				$this->_bag_mod->calTD($ratenow,$TC,$R,$cusid);
			}
			
			//$Data_bag = get_bag($cusid);
			foreach ($row4 as $key => $value)
			{	
				$TC = number_format($row4[$key]["TC"],2, '.', ''); 
				$R = number_format($row4[$key]["rate"],2, '.', '');
				if($row4[$key]["TD"] < $row4[$key]["package"])
				{
					$TD = number_format($row4[$key]["TD"],2, '.', '');
				}
				else
				{
					$TD =$row4[$key]["package"];
				}
				
				$CS = number_format($row4[$key]["CS"],2, '.', '');
				$CP = number_format($row4[$key]["CP"],2, '.', '');
				$BW = number_format($row4[$key]["BW"],2, '.', '');
				$BP = number_format($row4[$key]["BP"],2, '.', '');
				$SP = number_format($row4[$key]["SP"],2, '.', '');
				$BO = number_format($row4[$key]["BO"],2, '.', '');     
				
			}
			$Data_report_sell = $this->_cr_sell_mod->get_report_sell($cusid);
			$Data_report_buy = $this->_cr_buy_mod->get_report_buy($cusid);
			
			$total_amsell = $this->_cr_sell_mod->_get_point_total($portid);
			
			if($total_amsell == "")
			{
				$total_amsell =0;
			}else{
			$this->_cr_portsell_mod->updat_amsell($total_amsell);
			}
			//echo $total_amsell . "dDDDDDDDDDDDDDd";
			$total_ambuy = $this->_cr_buy_mod->_get_point_total($portid);
			if($total_ambuy == "")
			{
				$total_ambuy =0;
			}else{
			$this->_cr_portsell_mod->updat_ambuy($total_ambuy);
			}
			if($total_ambuy !=0 || $total_amsell !=0)
			{
				if($total_ambuy > $total_amsell)
				{
					//echo "11111111111";
					$alltotal =$total_ambuy-$total_amsell;
				}
				if($total_ambuy < $total_amsell)
				{
					//echo "2222222222";
					$alltotal =$total_amsell-$total_ambuy;
				} 
				$this->_cr_portsell_mod->updat_allsell($alltotal);
			}
			$this->assign('Data_report_sell', $Data_report_sell);
			$this->assign('Data_report_buy', $Data_report_buy);
	
			$this->assign('TC', $TC);
			$this->assign('TD', $TD);
			$this->assign('CS', $CS);
			$this->assign('CP', $CP);
			$this->assign('BW', $BW);
			$this->assign('BP', $BP);
			$this->assign('SP', $SP);
			$this->assign('BO', $BO);
			
			
			$this->assign('portid', $portid);
			$this->assign('cusid', $cusid);
			$this->assign('ratenow', $ratenow);	
			$this->assign('sta_sell', $sta_sell);
			$this->assign('sta_buy', $sta_buy);
	
		 
			
	
			
				
	        $this->assign('menus_left', $this->_menu_mod->set_menu('Crown'));
	        $this->display('crown.index.html');
		}
		else
		{
			//echo $_POST["del"];
			if($_POST["del"] != "")
			 {
				$cusid = $this->visitor->get('user_id');
				$row8 = $this->_bag_mod->get_bag($cusid);

				foreach ($row8 as $key => $value)
				{
				 	$SP = $row8[$key]["SP"]; 
					$TC = $row8[$key]["TC"];
					
				}
				
				$row = $this->_cr_sell_mod->get_type_sell($_POST["del"]);
				
				
					
					
			
				
				foreach ($row as $key => $value)
				{
				 	$cs = $row[$key]['cash2'];
					$amt = $row[$key]['amount'];
					$orate = $row[$key]['oldrate'];
					
					if($cs == 0)
					{
						$total = $amt + $SP;
					 
						$this->_bag_mod->updat_SP2($total,$cusid,$orate);
						
					}
					else
					{
						$total = $amt + $TC;
						$this->_bag_mod->updat_TC2($total,$cusid,$orate);
					}
					$this->_cr_sell_mod->del_sell($_POST["del"]);
					$total_amsell = $this->_cr_sell_mod->_get_point_total($cusid);
					$this->_cr_portsell_mod->updat_amsell($total_amsell);
					$this->refreshpage();
				}
				
			 }
		
			if($_POST["status"] == "b")
			{
				$cusid = $this->visitor->get('user_id');
				$row4 = $this->_bag_mod->get_bag($cusid);
				foreach ($row4 as $key => $value)
				{
					 	
					$CS = $row4[$key]["CS"]; 
					$BO = $row4[$key]["BO"]; 
					$R = $row4[$key]["rate"];
					$TC = $row4[$key]["TC"];
					$CP = $row4[$key]["CP"];
					$BP = $row4[$key]["BP"];
				}
					
				
				$this->_cr_buy_mod->insert_order_buy($_POST["customerid"], $_POST["rate2"], $_POST["amount2"], 'a', $_POST["portid"],$_POST["sum4"]);	
				if($_POST["drop1"] == "1")
				{
					//echo $_POST["drop1"] . "CCCCCCCCCCCCC"; 
					$this->_bag_mod->calCP($CP,$_POST["amount2"],$cusid);
					
					$TC = $TC + $_POST["sum4"];
								 
					$this->_bag_mod->updat_TC3($TC,$cusid);
								 
				}
				else
				{
					//echo $_POST["drop1"] . "DDDDDDDDDDDDDDDDDDDDDDD"; 
					$this->_bag_mod->calBP($BP,$_POST["amount2"],$cusid);
					$TC = $TC + $_POST["sum4"];
					$this->_bag_mod->updat_TC3($TC,$cusid);
								 
				}
							 
				$cleft = 0;
				$aid = "";
				$lid = "";
				$allcr = 0;
				$sumid = 0;
							 
				$row5 = $this->_cr_sell_mod->get_report_sell2();
				foreach ($row5 as $key => $value)
				{ 	
					$sumid = $sumid + 1;
					if($row5[$key]["cleft"] > 0)
					{
						$allcr = $allcr + $row5[$key]["cleft"];
					}
					else
					{
						$allcr = $allcr + $row5[$key]["amount"];
					}
								
								
					if($allcr > $_POST["sum4"])
					{
						$sumid = $sumid - 1;
						
						$allcr = $allcr - $_POST["sum4"];
			
								
						$this->_cr_sell_mod->updat_left($row5[$key]["id"],$allcr);
			
					}
									
				}
				$sumid2 = 0;
				$row8 = $this->_cr_sell_mod->get_report_sell2();
				foreach ($row8 as $key1 => $value)
				{
				 
					if($sumid == $sumid2)
					{	
						break;
					}
					$sellcusid = "";
					$sellcusid = $row8[$key1]["customerid"];
					$row9 = $this->_bag_mod->get_bag($sellcusid);
					foreach ($row9 as $key => $value)
					{ 	
						$CS2 = $row9[$key]["CS"]; 
						$CP = $row9[$key]["CP"]; 
						 
						
						$CS2 = $CS2 + $row8[$key1]["cash"]; 
						$CP = $CP + $row8[$key1]["cash2"]; 
						$this->_bag_mod->updat_CSCP($CS2,$CP,$row8[$key1]["rate"],$sellcusid);
						
						$this->_cr_buy_mod->updat_all_buy($_POST["customerid"]);
						$this->_cr_sell_mod->updat_all_sell($row8[$key]["id"]);
					}
									
				$sumid2 = $sumid2 + 1;
				}
				//getratemove($ratenow,$nextrate);
				//getreducesum();
				$this->refreshpage();
						
					
			}
			
			
			if($_POST["status"] == "s")
			{
				$cusid = $this->visitor->get('user_id');
			  	$row4 = $this->_bag_mod->get_bag($cusid);
				foreach ($row4 as $key => $value)
				{
				  	
					$TC2 = $row4[$key]["TC"]; 
					$SP = $row4[$key]["SP"];
					$R = $row4[$key]["rate"];
				
				}
						
				if($_POST["drop2"] == "1")
				{
					/*echo "<script language='javascript'>alert('" . $_POST["sum3"] . "')</script>"; */

					$this->_cr_sell_mod->insert_order_sell($_POST["customerid"], $_POST["rate"], $_POST["amount"], 'a', $_POST["portid"], $_POST["sum3"],$R);

					$this->_bag_mod->calSP($ratenow,$SP,$_POST["amount"],$cusid);

					//getratemove($ratenow,$nextrate);
					//getsum();

					$this->refreshpage();
				}
				else
				{
					$this->_cr_sell_mod->insert_order_sell2($_POST["customerid"], $_POST["rate"], $_POST["amount"], 'a', $_POST["portid"], $_POST["sum"], $_POST["sum2"],$R);
					//echo $_POST["status"];
						
					//calTC($TC2,$_POST["rate"],$_POST["amount"],$cusid);
						  
					//getratemove($ratenow,$nextrate);
					//$ratenow = getrate();

					$Data_port =  $this->_cr_portsell_mod->get_datarate();
					$Data_port=current($Data_port);
					$ratenow = $Data_port['ratenow'];
				 	
					$this->_bag_mod->calTC($ratenow ,$TC2 , $_POST["rate"] , $_POST["amount"] , $cusid );
		
					//getsum();

					$this->refreshpage();
				}
			 
	  		}
		}	
	}

	
	function  refreshpage()
	{
	
		header( "location: http://www.bravonetwork2015.com/admin/index.php?app=crown" );
 	 
 	}
	function  refreshpage2()
	{
	
		header( "location: http://www.bravonetwork2015.com/admin/index.php?app=crown&act=crownadmin" );
 	 
 	}
    
}

?>
