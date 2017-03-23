<?php

class Bravo_binaryModel extends BaseModel
{
    var $table  = 'bravo_binary';
    var $prikey = 'binary_id';
    var $_name  = 'bravo_binary';
     
      


	function _get_pv_total($stid,$position,$status)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE status =".$status." and member_id =" . $stid . " and position='".$position."'");
	} 

	function _get_pv_L_total_in($stid,$date = "")
	{
		$f_date  =date("Y-m-d");

		if($date !="")
		{
			$f_date =$date;
		}	

		$str = "SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  < '".$f_date."' and type =1 and status =1 and member_id =" . $stid . " and position='L'" ;
		//echo $str . "<br>";
		return $this->getOne($str );
	}
	function _get_pv_L_total_out($stid,$date = "")
	{
		$f_date  =date("Y-m-d");
		if($date !="")
		{
			$f_date =$date;
		}
		
		$str =	"SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  < '".$f_date."' and type =2 and status =1 and member_id =" . $stid . " and position='L'";
		//echo $str. "<br>";
		return $this->getOne($str);
	}
	function _get_pv_L_total_in_now($stid ,$date = "")
	{
	 
		$f_date  =date("Y-m-d");
		if($date !="")
		{
			$f_date =$date;
		}
		$str ="SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  = '".$f_date."' and type =1 and status =1 and member_id =" . $stid . " and position='L'";
		//echo $str. "<br>";
		return $this->getOne($str);
	}
	function _get_pv_L_total_out_now($stid,$date = "")
	{
		$f_date  =date("Y-m-d");
 
		if($date !="")
		{
			$f_date =$date;
		}

		$str = "SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  = '".$f_date."' and type =2 and status =1 and member_id =" . $stid . " and position='L'";
		//echo $str. "<br>";
		return $this->getOne($str);
	}


	function _get_pv_R_total_in($stid,$date = "")
	{
		 
		$f_date  =date("Y-m-d");
 
		if($date !="")
		{
			$f_date =$date;
		}

		$str ="SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  < '".$f_date."' and type =1 and status =1 and member_id =" . $stid . " and position='R'";
		//echo $str. "<br>";
	
		return $this->getOne($str);
	}
	function _get_pv_R_total_out($stid,$date = "")
	{
		 

		$f_date  =date("Y-m-d");
 
		if($date !="")
		{
			$f_date =$date;
		}
		
		$str = "SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  < '".$f_date."' and type =2 and status =1 and member_id =" . $stid . " and position='R'";
		//echo $str. "<br>";
	
		return $this->getOne($str);
	}
	function _get_pv_R_total_in_now($stid,$date = "")
	{
		
		$f_date  =date("Y-m-d");
 
		if($date !="")
		{
			$f_date =$date;
		}

		$str = "SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  = '".$f_date."' and type =1 and status =1 and member_id =" . $stid . " and position='R'" ;
		//echo $str. "<br>";
		return $this->getOne($str);
	}
	function _get_pv_R_total_out_now($stid,$date = "")
	{
		 
			
		$f_date  =date("Y-m-d");
 
		if($date !="")
		{
			$f_date =$date;
		}

		$str ="SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  = '".$f_date."' and type =2 and status =1 and member_id =" . $stid . " and position='R'";
		//echo $str. "<br>";
		return $this->getOne($str);
	}

	function _get_point_total($stid,$position,$type)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE type =".$type." and member_id =" . $stid . " and position='".$position."'");
	} 

	function _get_point_total2($stid,$type)
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE type =".$type." and member_id =" . $stid  );
	} 

	function _set_point_update($stid)
	{
		$count_L_get = $this->_get_point_total($stid,"L","1");
		$count_L_use = $this->_get_point_total($stid,"L","2");
		$count_R_get = $this->_get_point_total($stid,"R","1");
		$count_R_use = $this->_get_point_total($stid,"R","2");
		$count_total_L =  $count_L_get - $count_L_use;
		$count_total_R =  $count_R_get - $count_R_use;
		$user_mod =& m('member');

			$data3 = array(
                 
				'left_point' => $count_total_L,
				'right_point'  => $count_total_R,
 	 
            );
		$user_mod->edit($stid,$data3);
	}


 
	function _get_pv_L_total_in_date($stid,$f_date)
	{
		 
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  < '".$f_date."' and type =1 and status =1 and member_id =" . $stid . " and position='L'");
	}
	function _get_pv_L_total_out_date($stid,$f_date)
	{
		 
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  < '".$f_date."' and type =2 and status =1 and member_id =" . $stid . " and position='L'");
	}

	function _get_pv_L_total_in_today($stid,$f_date)
	{
		 
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  = '".$f_date."' and type =1 and status =1 and member_id =" . $stid . " and position='L'");
	}
	function _get_pv_L_total_out_today($stid,$f_date)
	{
		 
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  = '".$f_date."' and type =2 and status =1 and member_id =" . $stid . " and position='L'");
	}



	function _get_pv_R_total_in_date($stid,$f_date)
	{
		 
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  < '".$f_date."' and type =1 and status =1 and member_id =" . $stid . " and position='R'");
	}
	function _get_pv_R_total_out_date($stid,$f_date)
	{
		 
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  < '".$f_date."' and type =2 and status =1 and member_id =" . $stid . " and position='R'");
	}

	function _get_pv_R_total_in_today($stid,$f_date)
	{
		 
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  = '".$f_date."' and type =1 and status =1 and member_id =" . $stid . " and position='R'");
	}
	function _get_pv_R_total_out_today($stid,$f_date)
	{
		 
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "bravo_binary WHERE  date  = '".$f_date."' and type =2 and status =1 and member_id =" . $stid . " and position='R'");
	}

	function _Add_myPv($user_id,$order_id,$pv,$investment_id)
	{
		$date_t = date("Y-m-d");
		$data = array(
	                'member_id' => $user_id,
					'date'=> $date_t,
					'order_id' =>  $order_id,
	                'binary_name'    =>'Buy From Order -> ' . $order_id,
				 	'position' => 'Y',
					'form_id'  => $user_id,
					'value'  => $pv ,
	 	 			'investment_id' => $investment_id,
            	);
		 $this->add($data);

	}
	function _Add_advance_myPv($user_id,$pv,$topic )
	{
		$date_t = date("Y-m-d");
		$data = array(
	                'member_id' => $user_id,
					'date'=> $date_t,
		 
	                'binary_name'    =>'Advance -> ' . $topic ,
				 	'position' => 'Y',
					'form_id'  => $user_id,
					'value'  => $pv ,
	 	 		 
            	);
		 $this->add($data);

	}
	function _Add_maintained($user_id,$order_id,$pv,$investment_id,$date_t,$txt,$now=0)
	{
		 $Wdate =date("Y-m-d");
	 
		$data = array(
	                'member_id' => $user_id,
					'date'=> $date_t,
					'order_id' =>  $order_id,
	                'binary_name'    =>$txt . $order_id,
				 	'position' => 'M',
					'form_id'  => $user_id,
					'value'  => $pv ,
					'now'=> $now , 
					'now_date' => $Wdate , 
	 	 			'investment_id' => $investment_id,
            	);
		 $this->add($data);

	}

	
	function _get_maintained_month($stid)
	{
		 
		$conditions =	" position  = 'M' and   year(date) = ".date('Y')."  and month(date)=".date('m')." and status =1 and member_id =" . $stid ;
		$row =	$this->find(array(
			            'conditions' => $conditions,
			           
			        ));
		$row = current($row);
		return  $row['binary_id'];
	}
	function _get_maintained_month2($stid,$date_now)
	{
		$ckk = true;

			
		$f_date = explode('-', $date_now);;
		$conditions =" position  = 'M' and year(date) = ".$f_date[0]."  and month(date)=".$f_date[1]." and status =1 and member_id =" . $stid ;
		//echo $conditions;
		$row =	$this->find(array(
			            'conditions' => $conditions,
			           
			        ));
		$row = current($row);
		if($row)
		{
			if($row['now'])
			{
				
				//$d1	= date('d',$date);
				//$d2	= date('d',$row['date']);
				//echo date($date);
				//echo "<br>";
				//echo $row['now_date'];
				//echo "<br>";
				//echo	$stid;
				if(date($date_now) < date($row['now_date']))
				{
					 
					$ckk =false;
				}
			}
		}
		else
		{
			$ckk =false;
		}
	
		return  $ckk;
	}

	function _get_maintained_month3($stid,$date_now)
	{
		$ckk = true;

			
		$f_date = explode('-', $date_now);;
		$conditions =" position  = 'M' and year(date) = ".$f_date[0]."  and month(date)=".$f_date[1]." and status =1 and member_id =" . $stid ;
		//echo $conditions;
		$row =	$this->find(array(
			            'conditions' => $conditions,
			           
			        ));
		$row = current($row);
		if($row)
		{
			 $ckk = true;
		}
		else
		{
			$ckk =false;
		}
	
		return  $ckk;
	}

	function _get_maintained_pay($stid,$date_now,$pecen)
	{
		$pay =array();
		$pay['pay']=0;
		$pay['maintained'] =0;
		$f_date =$date_now;
		$conditions =	"date   = '".$f_date."'   and status =1 and member_id =" . $stid ;
		$row =	$this->find(array(
			            'conditions' => $conditions,
		));
		$row = current($row);
		if($row)
		{
			$pay['pay'] = ($pecen * $row['value'] ) /  100;

			$pay['maintained']  =$row['value'] ;
		}
		
		return $pay;
	}
	function _get_nodeL_for_today($mem_id,$date_st)
	{

			
			$node = array();
		
			$node['old_L_in'] =$this->_get_pv_L_total_in_date($mem_id,$date_st);
			$node['old_L_out'] =$this->_get_pv_L_total_out_date($mem_id,$date_st);
			$node['old_L_total'] = $node['old_L_in'] - $node['old_L_out'];

			
			$node['L_in']  = $this->_get_pv_L_total_in_today($mem_id,$date_st);
			$node['L_out']  = $this->_get_pv_L_total_out_today($mem_id,$date_st);
			$node['L_total']  = $node['L_in']  - $node['L_out'] ;
 
			$node['node_L']  =$node['old_L_total']  + $node['L_total'] ;

			 
		return $node;
	}
	function _get_nodeR_for_today($mem_id,$date_st)
	{
			$node = array();

			$node['old_R_in'] =	$this->_get_pv_R_total_in_date($mem_id,$date_st);
			$node['old_R_out'] = $this->_get_pv_R_total_out_date($mem_id,$date_st);
			$node['old_R_total'] = $node['old_R_in'] - $node['old_R_out'];

			$node['R_in'] =	$this->_get_pv_R_total_in_today($mem_id,$date_st);
			$node['R_out'] = $this->_get_pv_R_total_out_today($mem_id,$date_st);
			$node['R_total'] =$node['R_in'] -  $node['R_out'];
		 
			$node['node_R'] = $node['old_R_total'] + $node['R_total']; 
		return $node;
	}

	function _cal_cycle($level_cycle,$node_L,$node_R,$node)
	{
	 
		for ($x = 1; $x < 5; $x++) 
		{
		
			if($level_cycle[$x]['cycle'] != 'none')
			{
				$txt_arr =explode('-', $level_cycle[$x]['cycle']);
			
				$c_start =$txt_arr[0];
				$c_end =$txt_arr[1];

			 	 

				$max_count =$c_end;
			 	
				$remove_start =  ($txt_arr[0] - 1);

				$node['cycle_pay_one'.$x] = $level_cycle[$x]['pay_cycle'];
				
				
				if($node_L >= $node['cycle_per_pv'] and $node_R >= $node['cycle_per_pv'] )
				{
					if($node_L > $node_R )
					{
						$node['ckk_sum_clcle'.$x] =$node_R / $node['cycle_per_pv'];
						$node['ckk_sum_clcle'.$x] = floor($node['ckk_sum_clcle'.$x]);
							
					}
					else
					{
						$node['ckk_sum_clcle'.$x] = $node_L / $node['cycle_per_pv'] ;
						$node['ckk_sum_clcle'.$x] = floor($node['ckk_sum_clcle'.$x]);	
					}	
					if($c_end > 0)
					{
						if($node['ckk_sum_clcle'.$x] > $max_count)
						{
							$node['ckk_sum_clcle'.$x] = $max_count;
						}
				
					}
					if($remove_start)
					{
						$node['ckk_sum_clcle'.$x]  = $node['ckk_sum_clcle'.$x]  - $remove_start;
					}
					
					if($node['ckk_sum_clcle'.$x] < 0)
					{
						$node['ckk_sum_clcle'.$x] =0;
						
					}

					$node['cycle_count_use_pv'.$x] = $node['ckk_sum_clcle'.$x] * $node['cycle_per_pv'];
					$node['cycle_value'.$x] = $node['ckk_sum_clcle'.$x] * $node['cycle_pay_one'.$x] ;
					 
					$node['cycle_total'] = $node['cycle_total']  + 	$node['cycle_value'.$x] ;
						
			 		$node['cycle_total_pv'] =$node['cycle_total_pv']+ $node['cycle_count_use_pv'.$x];	
				}
			}
		}
		return $node;

	}

	function _set_nodepay_cycle($invest_id,$maintained,$date_st,$round_id,$round,$mem_id)
	{

		$node = array();
		$investment_mod =& m('investment');

		$node['cycle_value'] =0;
		$node['cycle_count_use_pv'] =0;
		$node['ckk_sum_clcle'] =0;

		$com_cycle_L =$this->_get_nodeL_for_today($mem_id,$date_st);
		$com_cycle_R =$this->_get_nodeR_for_today($mem_id,$date_st);

		$inv_row = $investment_mod->find(array(
                		'order' => 'investment_id',
           		 	)); 
		$node_L= $com_cycle_L['node_L'];
		$node_R= $com_cycle_R['node_R'];
		 


		$node['cycle_per_pv'] = $inv_row[$invest_id]['cycle_cal'] ;

		$level_cycle = array();
	
		$level_cycle[1]['cycle'] = $inv_row[$invest_id]['cycle1'] ;
		$level_cycle[1]['pay_cycle'] = $inv_row[$invest_id]['per_cycle_1'] ; 
	
	 	$level_cycle[2]['cycle'] = $inv_row[$invest_id]['cycle2'] ;
		$level_cycle[2]['pay_cycle'] = $inv_row[$invest_id]['per_cycle_2'] ; 

		$level_cycle[3]['cycle'] = $inv_row[$invest_id]['cycle3'] ;
		$level_cycle[3]['pay_cycle'] = $inv_row[$invest_id]['per_cycle_3'] ; 
	
	 	$level_cycle[4]['cycle'] = $inv_row[$invest_id]['cycle4'] ;
		$level_cycle[4]['pay_cycle'] = $inv_row[$invest_id]['per_cycle_4'] ; 
			
		$level_cycle[5]['cycle'] = $inv_row[$invest_id]['cycle5'] ;
		$level_cycle[5]['pay_cycle'] = $inv_row[$invest_id]['per_cycle_5'] ; 

		$node = $this->_cal_cycle($level_cycle,$node_L,$node_R,$node);
		

	 

		
			
			 
			if($maintained  or  $mem_id ==1 )
			{
			  	 

				if($node['cycle_total'])
				{
					$data_bi = array(
			                'member_id' =>$mem_id,
							'date'=> $date_st,
			                'binary_name'    =>'Commission  round->'. $round , 
						 	'position' => 'L',
							'form_id'  => '0',
							'value'  => $node['cycle_total_pv'] ,
			 	 		 	'round_id'=> $round_id,
							'type' => 2,
		            	);
					$this->add($data_bi);
					$data_bi['position'] ="R";
					$this->add($data_bi);
				}
				$br_com_cycle_report_mod =& m('br_com_cycle_report'); 

				 
				$data3 = array(
			                'member_id' => $mem_id,
							'date'=> $date_st,
			                'old_left'    => $com_cycle_L['old_L_total'] ,
							'now_left' => $com_cycle_L['L_total'],
							'befor_total_left'=> $node_L,
							'old_right'  =>$com_cycle_R['old_R_total'],
							'now_right' => $com_cycle_R['$R_total'],
							'befor_total_right'=> $node_R,

							'qty1'=> $node['ckk_sum_clcle1'],
							'per_cycle1'=> $node['cycle_pay_one1'],
							'total1'=> $node['cycle_value1'],
							
							'qty2'=> $node['ckk_sum_clcle2'],
							'per_cycle2'=> $node['cycle_pay_one2'],
							'total2'=> $node['cycle_value2'],

							'qty3'=> $node['ckk_sum_clcle3'],
							'per_cycle3'=> $node['cycle_pay_one3'],
							'total3'=> $node['cycle_value3'],


							'qty4'=> $node['ckk_sum_clcle4'],
							'per_cycle4'=> $node['cycle_pay_one4'],
							'total4'=> $node['cycle_value4'],

							'qty5'=> $node['ckk_sum_clcle5'],
							'per_cycle5'=> $node['cycle_pay_one5'],
							'total5'=> $node['cycle_value5'],
			
							'cycle_total' => $node['cycle_count_use_pv'] ,
							'total_pay'  => $node['cycle_total'] ,
							'total_left' => $node_L -  $node['cycle_total_pv'],
							'total_right' => $node_R - $node['cycle_total_pv'] ,
							'round_id' => $round_id ,
							'detail_id' => $dtail_id ,
		 	 			 	'cre_date'  =>   gmtime(),
		            	);
				 $br_com_cycle_report_mod->add($data3);
			
			}
			else
			{		
					$node['cycle_total'] =0;

					
					$data_remove = array(
			                	'member_id' =>$mem_id,
								'date'=> $date_st,
			                	'binary_name'    =>'Do not Maintained => '. $round , 
						 		'position' => 'L',
								'form_id'  => '0',
								'value'  => $node_L ,
			 	 		 		'round_id'=> $round_id,
								'type' => 2,
		            			);
					if($node_L)
					{
						$this->add($data_remove);
					}
								 
					if($node_R)
					{
						$data_remove['position'] ="R";
						$data_remove['value'] =$node_R;
						$this->add($data_remove);
					}

			}



		return $node ;

	}
}

?>
