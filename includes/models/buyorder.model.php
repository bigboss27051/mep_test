<?php

 
class BuyorderModel extends BaseModel
{
    function submitorder($store_id,$user_id,$user_name,$post,$store_name,$key_id,$register =0)
    {
		
		$goods_info = $this->_get_goods_info($store_id,$user_id,$user_name,$store_name);
		 if ($goods_info === false)
            {
                
                $this->show_warning('goods_empty');

                return;
            }
			$data = array(
                'user_id'       => $user_id,
                'consignee'     => $post['consignee'],
                'region_id'     => $post['region_id'],
                'region_name'   => $post['region_name'],
                'address'       => $post['address'],
                'zipcode'       => '11010',
                'phone_tel'     => $post['phone_tel'],
                 
            );
			$model_address =& m('address');
            $address_id = $model_address->add($data) ;

	 	$goods_type =& gt($goods_info['type']);
        $order_type =& ot($goods_info['otype']);


		$order_id = $order_type->submit_order(array(
                'goods_info'    =>  $goods_info,      
                'post'          =>  $post,           
            ));

		if (!$order_id)
        {
            $this->show_warning($order_type->get_error());

            return;
       }
		 	
			$order_goods_model =& m('order_goods');

                $cart_items      =  $order_goods_model->find(array(
                    'conditions' => "order_id = " .  $order_id, 
                    
                ));

		

		$goods_mod =& m('goods');

		$pv =0;
	 		$br_stock_model =& m('br_stock');
			$goodsspec_model =& m('goodsspec');
		 foreach ($cart_items as $key => $vall)
         {
		
				$goods_list = $goodsspec_model->find($cart_items[$key]['spec_id']);

				$goods_list  = current($goods_list);
		
				$pv = $pv + ($goods_list['pv'] * $cart_items[$key]['quantity']) ;
         
				$ff =date("Y-m-d");
				$data3 = array(
	                 
	                'order_id'     => $order_id,
	                'goods_id'     => $cart_items[$key]['goods_id'],
	                'stock_name'   => "Buy Order ID >> " .$order_id,
	                'value'   => $goods['quantity'],
					'date'   => $ff,
					'type'   => '2',
	                 
	            );
				$br_stock_model->add($data3);
         }
		
 
		$order_mod =& m('order');

		
		
		$order_mod->edit($order_id, array('order_pv' => $pv));

		$rows_or = $order_mod->find($order_id);
		$rows_or = current($rows_or);
 

		$payment_mod =& m('payment');
		$pay_m =  $payment_mod->get_list_paymentadmin();

		$order_mod->edit($order_id, array(	'order_pv' => $pv,
											'status' => '20',
											'payment_id' => $pay_m[$post['payment_id']]['payment_id'],
											'payment_code' =>$pay_m[$post['payment_id']]['payment_code'],
											'payment_name' => $pay_m[$post['payment_id']]['payment_name'] ,
						

		));

		
		
		$this->setpv($pv,$user_id ,$order_id,$key_id,$register);

		$this->_clear_goods($order_id,$post);

	}
	function setpv($pv,$user_id,$order_id,$key_id,$register)
    {	
	
		$bravo_binary_mod =& m('bravo_binary');

		$member_team_mod =& m('member_team');

		$conditions = "member_id =".$user_id;	
		$get_line = $member_team_mod->find(array(
		            'conditions' => $conditions,
		            'join'  => 'belongs_to_user',
		         
		             
		        ));

		$get_line =current($get_line);
		$lineId =$get_line['head_team'];
		$sponsor =  $get_line['sponsor'];
		$get_lvl =  $get_line['investment_id'];
		$get_lvl_old =  $sumpv_point = $bravo_binary_mod->_get_pv_total($user_id,'Y','1');;


		$conditions = "head_team =".$lineId;	
			$team = $member_team_mod->find(array(
		            'conditions' => $conditions,
		            'join'  => 'belongs_to_user',
		         
		             
		        ));




		$bravo_binary_mod =& m('bravo_binary');
		$bravo_binary_mod->_Add_myPv($user_id,$order_id,$pv,$get_line['investment_id']);
		$Month = date("m");
		$year = date("Y");

		$tdate =$year . "-" . $Month ."-01";
		$txt ="Maintained First Time Register From Order ->";
		$bravo_binary_mod->_Add_maintained($user_id,$order_id,$pv,$get_line['investment_id'],$tdate,$txt);	

		$dt_end = date('Y-m-d', strtotime($tdate . ' + 1 month'));
		$bravo_binary_mod->_Add_maintained($user_id,$order_id,$pv,$get_line['investment_id'],$dt_end,$txt);	
		
		$sumpv_point = $bravo_binary_mod->_get_pv_total($user_id,'Y','1');




		 	
		 $member_mod = & m('member');
	     $member_mod->edit($user_id, array('pv' => $sumpv_point));

		 $sort  = 'investment_id';
	     $order = 'desc';
		 $investment_mod =& m('investment');
		 $check_level  =$investment_mod->find(array(
		                'order'         => "$sort $order",  
		            ));

	 	 
		$gofast = true;
		$max_fast=0;


		$ddmem =$member_team_mod->find($user_id);
		$ddmem = current($ddmem);
	
		$ddinv = $ddmem['investment_id'];
		foreach ($check_level as $key=>$id)
		{
	
			
			if($sumpv_point >= $check_level[$key]['amount'])
			{

				if($check_level[$key]['investment_id'] > $ddinv)
				{ 
					$member_team_mod->edit($user_id, array('investment_id' => $check_level[$key]['investment_id']));
					
				}
				$get_lvl = $check_level[$key]['investment_id'];
				$max_fast= $check_level[$key]['fast_start_max'];
				if($get_lvl_old > $check_level[$key]['fast_start_max'])
				{
					$gofast = false;
				}
				break;
			}
		}
	
		$this->_ckkpvinv($user_id,$ddinv,$sumpv_point);

	 
		$gofast = true;
	 
		
		$order_mod =& m('order');
		$rows_or = $order_mod->find($order_id);
		$rows_or = current($rows_or);
		 
		$goods_amount =$rows_or['goods_amount'];
		$order_amount =$rows_or['order_amount'];

		$shipping_pay =$order_amount  - $goods_amount;
 

		$order_mod->edit($order_id, array(  'ship_pay'  => $shipping_pay,
											'order_amount' => $order_amount,
											'disc_percent' => 0,
											'discount' => 0,
		));
		
		 
		$investment_mod->_set_point_binary_pv($team,$user_id,$pv,$sponsor,$order_id, $gofast,$key_id,$get_lvl,$register);
		//$this->_reg_mem_mod->_sponser_upper($sponsor);
		
	}
	function _get_goods_info($store_id,$user_id,$user_name,$store_name)
    {
		
        $return = array(
            'items'     =>  array(),     
            'quantity'  =>  0,           
            'amount'    =>  0,           
            'store_id'  =>  0,           
            'store_name'=>  '',         
            'type'      =>  null,      
			'user_id'      => $user_id,    
			'user_name'      => $user_name,   
            'otype'     =>  'normal',    
            'allow_coupon'  => true,    
        );
  
                if (!$store_id)
                {
                    return false;
                }

				 
                $cart_model =& m('cart');

                $cart_items      =  $cart_model->find(array(
                    'conditions' => "user_id = " . $user_id . " AND store_id = {$store_id} AND session_id='" . SESS_ID . "'",
                    'join'       => 'belongs_to_goodsspec',
                ));
                if (empty($cart_items))
                {
                    return false;
                }


                $store_model =& m('store');
                $store_info = $store_model->get($store_id);

                foreach ($cart_items as $rec_id => $goods)
                {
                    $return['quantity'] += $goods['quantity'];                       
                    $return['amount']   += $goods['quantity'] * $goods['price'];    
                    $cart_items[$rec_id]['subtotal']    =   $goods['quantity'] * $goods['price'];   
                    empty($goods['goods_image']) && $cart_items[$rec_id]['goods_image'] = Conf::get('default_goods_image');
                }

                $return['items']        =   $cart_items;
                $return['store_id']     =   $store_id;
                $return['store_name']   =   $store_name;
                $return['type']         =   'material';
                $return['otype']        =   'normal';
				
         
        return $return;
    }
	function _clear_goods($order_id,$post)
    {
          
                 
                $store_id = $post['store_id'];;
                if (!$store_id)
                {
                    return false;
                }
                $model_cart =& m('cart');
                $model_cart->drop("store_id = {$store_id} AND session_id='" . SESS_ID . "'");
                 
                if (isset($post['coupon_sn']) && !empty($post['coupon_sn']))
                {
                    $sn = trim($post['coupon_sn']);
                    $couponsn_mod =& m('couponsn');
                    $couponsn = $couponsn_mod->get("coupon_sn = '{$sn}'");
                    if ($couponsn['remain_times'] > 0)
                    {
                        $couponsn_mod->edit("coupon_sn = '{$sn}'", "remain_times= remain_times - 1");
                    }
                }
           
        
    }
	function setpv_order($pv,$user_id,$order_id,$post,$key_id)
    {	
	
		$reg_mem_mod =& m('reg_mem');
		$bravo_binary_mod =& m('bravo_binary');
		$member_team_mod =& m('member_team');

		$conditions = "member_id =".$user_id;	
		$get_line = $member_team_mod->find(array(
		            'conditions' => $conditions,
		            'join'  => 'belongs_to_user',
		         
		             
		        ));

		$get_line =current($get_line);
		$lineId =$get_line['head_team'];
		$sponsor =  $get_line['sponsor'];
		$get_lvl =  $get_line['investment_id'];
		$get_lvl_old =  $sumpv_point = $bravo_binary_mod->_get_pv_total($user_id,'Y','1');;

		$conditions = "head_team =".$lineId;	
			$team = $member_team_mod->find(array(
		            'conditions' => $conditions,
		            'join'  => 'belongs_to_user',
		         
		             
		        ));



		
		
		if($post['order_type'] == 0)
		{
			$bravo_binary_mod->_Add_myPv($user_id,$order_id,$pv,$get_line['investment_id']);
		}
		else		
		{
			$Month = date("m");
			$year = date("Y");
			if($post['order_type'] == 1)
			{
				$tdate =$year . "-" . $Month ."-01";
				$dt_end = date('Y-m-d', strtotime($tdate . ' + 1 month'));
				$txt ="Maintained From Order ->";
				$bravo_binary_mod->_Add_maintained($user_id,$order_id,$pv,$get_line['investment_id'],$dt_end,$txt,'0');	
			}
			if($post['order_type'] == 2)
			{
				$tdate =$year . "-" . $Month ."-01";
				$txt ="Maintained Now From Order ->";
				$bravo_binary_mod->_Add_maintained($user_id,$order_id,$pv,$get_line['investment_id'],$tdate,$txt,'1');	
			}
		}


		$sumpv_point = $bravo_binary_mod->_get_pv_total($user_id,'Y','1');
		

		 	
		 $member_mod = & m('member');
	     $member_mod->edit($user_id, array('pv' => $sumpv_point));

		 $sort  = 'investment_id';
	     $order = 'DESC';
		 $investment_mod =& m('investment');
		 $check_level  =$investment_mod->find(array(
		                'order'         => "$sort $order",  
		            ));

		 

		
		$gofast = false;

		if($post['order_type'] == 0)
		{

				$conditions = "member_id =".$sponsor;	
				$get_sponsor = $member_team_mod->find(array(
		           		'conditions' => $conditions,
		       			 ));
			   	$get_sponsor =current($get_sponsor);
 
				 
				$gofast = true;
				 
				$ddmem =$member_team_mod->find($user_id);
				$ddmem = current($ddmem);
	
				$ddinv = $ddmem['investment_id'];
			 
				foreach ($check_level as $key=>$id)
				{
		
					if($sumpv_point >= $check_level[$key]['amount'])
					{
							$member_team_mod->edit($user_id, array('investment_id' => $check_level[$key]['investment_id']));
							$get_lvl = $check_level[$key]['investment_id'];
						 
							if($get_lvl_old > $check_level[$key]['fast_start_max'])
							{
								$gofast = false;	
							}
							break;	
					}
				}
			 	
				


				$this->_ckkpvinv($user_id,$ddinv,$sumpv_point);
			
				$by_pass = $reg_mem_mod->_by_pass($user_id);
				if($by_pass >$get_lvl)
				{
					$member_team_mod->edit($user_id, array('investment_id' => $by_pass));
					$get_lvl = $by_pass;
				}
				
		}
		$this->_set_walletbuy($pv,$user_id,$order_id, $check_level,$get_lvl,$post,$key_id);


		

		if($post['order_type'] == 0)
		{
		 
			$investment_mod->_set_point_binary_pv($team,$user_id,$pv,$sponsor,$order_id,$gofast,'0',$get_lvl);
		}	
		$this->_clear_goods($order_id,$post);
		
	}
	function _set_walletbuy2($pv,$user_id,$order_id, $check_level,$get_lvl,$post,$key_id)
    {


		$disc_percent = $check_level[$get_lvl]['discount'];	

		$order_mod =& m('order');
		$rows_or = $order_mod->find($order_id);
		$rows_or = current($rows_or);
		 
		$goods_amount =$rows_or['goods_amount'];
		$order_amount =$rows_or['order_amount'];

		$shipping_pay =$order_amount  - $goods_amount;
 

		$order_mod->edit($order_id, array(  'ship_pay'  => $shipping_pay,
											'order_amount' => $order_amount,
											'disc_percent' => '0',
											'discount' => '0',
		));
		
 

		//$head_buy = $this->visitor->get('user_id');

		$head_buy =	$key_id;
		
		$ff =date("Y-m-d");

		if($post['payment_id'] == 1)
		{
			$data_wal = array(
	
					'member_id' =>$head_buy,
					'order_id' =>  $order_id,
	                'wal_desc' =>'Buy Product order No. ' .$rows_or['order_sn'],
				  	'type'  => '2',
					'value'  => $order_amount,
					'approv'  => $user_id,
					'date'  => $ff,
	            );
	
			$br_wallet_mod =& m('br_wallet');
			$wallet_id = $br_wallet_mod->add($data_wal);
		}		 
	 	
		$payment_mod =& m('payment');
		$pay_m =  $payment_mod->get_list_paymentadmin2();

		$order_mod->edit($order_id, array(	'order_pv' => $pv,
											'order_type' => $post['order_type'],
											'status' => '20',
											'payment_id' => $pay_m[$post['payment_id']]['payment_id'],
											'payment_code' =>$pay_m[$post['payment_id']]['payment_code'],
											'payment_name' => $pay_m[$post['payment_id']]['payment_name'] ,
						

		));
		
	}


	function check_payment($userid,$payment_id,$totalpay)
	{
	
		$arr_pay = array();	
		$go_regis =true;

		
		if($payment_id == 1)
		{
			$br_wallet_mod =& m('br_wallet');
			$wallet_in =$br_wallet_mod->_get_wallet_total_in($userid);
			$wallet_out =$br_wallet_mod->_get_wallet_total_out($userid);
	
			$wallet_total = $wallet_in - $wallet_out;
					
					 
			if($totalpay > $wallet_total)
			{
				$go_regis = false;
				
			}  
						

		}
	 
		 
		$arr_pay['payment_id'] =$payment_id;
		$arr_pay['go_regis'] =$go_regis;

		return $arr_pay;

	}
	function submititem($user_id,$user_name,$post,$key_id,$arr_pay,$order_id,$arr_order)
    {
		$order_mod =& m('order');
 

		$payment_mod =& m('payment');
		$pay_m =  $payment_mod->find($arr_pay['payment_id']);

		$order_mod->edit($order_id, array( 
											'order_pv' => $arr_order['pv'] ,
											'order_type' => $post['order_type'],
										    'status' => '20',
											'payment_id' => $pay_m[$arr_pay['payment_id']]['payment_id'],
											'payment_code' =>$pay_m[$arr_pay['payment_id']]['payment_code'],
											'payment_name' => $pay_m[$arr_pay['payment_id']]['payment_name'] ,
										
						

		));


		$get_or = $order_mod->find($order_id); 
		
		$get_or= current($get_or);
	

		$order_amount =  $get_or['order_amount']; 
		$order_id =  $get_or['order_id']; 

		$shipping_mod =& m('shipping');
		$shipid  =$shipping_mod->find($post['shipping_id']); 
		$shipid = current($shipid );

		$ship_pay = $shipid['first_price'];

		$order_amount =  $order_amount   ;
	 	
		$order_mod->edit($order_id, array( 
										     
											'ship_pay' => $ship_pay,
											'shipping_id' => $shipid['shipping_id'],
											'shipping_name' => $shipid['shipping_name'],
											 
 		

		));	

		if($arr_pay['payment_id'] == 1)
		{
			$this->_set_walletbuy($order_amount,$user_id,$key_id,$order_id,$ckk=3);
		}

		$this->setpv2($arr_order['pv'],$user_id ,$order_id,$key_id,0,$post);
		$this->_clear_goods($order_id,$post);
	}
	function _set_walletbuy($order_amount,$user_id,$key_id,$learn_id,$ckk=0 )
    {
 	 
		$wal_desc =	"Buy Products ".$learn_id ;
	 
		
		$date_t = date("Y-m-d");

			$data_wal = array(
	
					'member_id' =>$key_id,
					'order_id' => $learn_id,
	                'wal_desc' =>$wal_desc,
				  	'type'  => '2',
					'value'  => $order_amount,
					'approv'  => $key_id,
					'for_user' => $user_id,
					'date'  => $date_t,
	            );
	
			$br_wallet_mod =& m('br_wallet');
			$wallet_id = $br_wallet_mod->add($data_wal);
	 
	}
	function setpv2($pv,$user_id,$order_id,$key_id,$register,$post)
    {	
	
		$bravo_binary_mod =& m('bravo_binary');

		$member_team_mod =& m('member_team');

		$conditions = "member_id =".$user_id;	
		$get_line = $member_team_mod->find(array(
		            'conditions' => $conditions,
		            'join'  => 'belongs_to_user',
		         
		             
		        ));

		$get_line =current($get_line);
		$lineId =$get_line['head_team'];
		$sponsor =  $get_line['sponsor'];
		$get_lvl =  $get_line['investment_id'];
		$get_lvl_old =  $sumpv_point = $bravo_binary_mod->_get_pv_total($user_id,'Y','1');;


		$conditions = "head_team =".$lineId;	
			$team = $member_team_mod->find(array(
		            'conditions' => $conditions,
		            'join'  => 'belongs_to_user',
		         
		             
		        ));




		$bravo_binary_mod =& m('bravo_binary');
		if($post['order_type'] == 0)
		{
		
			$bravo_binary_mod->_Add_myPv($user_id,$order_id,$pv,$get_line['investment_id']);
			if($post['order_hold'] == 1 )
			{
				$member_team_mod =& m('member_team');
				
				$mm_mem= $member_team_mod->find($key_id);

				$mm_mem =current($mm_mem);	
					
				$percen =$mm_mem['mob_per'];
				$gtotal = ($pv * $percen) /100;
	
				$ff =date("Y-m-d");
				$data_com = array(
	                'date'       => $ff,
					'order_id'       => $order_id,
	                'pay_name'       => "Commission Mobile", 
					'member_id'       => $key_id,
					'form_id'  => $user_id,
					'value' => $gtotal,
					'form_pv' => $pv,
					'pv_percent' => $percen,
					
	                 
	            );
				$br_paycom_mod =& m('br_paycom');
				$br_paycom_mod->add($data_com);

				$order_mod =& m('order');

				$data_mol = array(
	                'mobile'       => $post['order_hold'],
					 
	                 
	            );
				$order_mod->edit($order_id,$data_mol);
			}
		}
		$Month = date("m");
		$year = date("Y");

		if($register)
		{
			$tdate =$year . "-" . $Month ."-01";
			$txt ="Maintained First Time Register From Order ->";
			$bravo_binary_mod->_Add_maintained($user_id,$order_id,$pv,$get_line['investment_id'],$tdate,$txt);	
	
			$dt_end = date('Y-m-d', strtotime($tdate . ' + 1 month'));
			$bravo_binary_mod->_Add_maintained($user_id,$order_id,$pv,$get_line['investment_id'],$dt_end,$txt);	
		}
	
		$sumpv_point = $bravo_binary_mod->_get_pv_total($user_id,'Y','1');




		 	
		 //$member_mod = & m('member');
	     //$member_mod->edit($user_id, array('pv' => $sumpv_point));

		 $sort  = 'investment_id';
	     $order = 'desc';
		 $investment_mod =& m('investment');
		 $check_level  =$investment_mod->find(array(
		                'order'         => "$sort $order",  
		            ));

	 	 
		$gofast = true;
		$max_fast=0;
		
		$ddmem =$member_team_mod->find($user_id);
		$ddmem = current($ddmem);
	
		$ddinv = $ddmem['investment_id'];

		foreach ($check_level as $key=>$id)
		{
	
			if($sumpv_point >= $check_level[$key]['amount'])
			{
				if($check_level[$key]['investment_id'] > $ddinv)
				{ 
					$member_team_mod->edit($user_id, array('investment_id' => $check_level[$key]['investment_id']));
				}
				$get_lvl = $check_level[$key]['investment_id'];
				$max_fast= $check_level[$key]['fast_start_max'];
				if($get_lvl_old > $check_level[$key]['fast_start_max'])
				{
					$gofast = false;
				}
				break;
			}
		}
	

		$this->_ckkpvinv($user_id,$ddinv,$sumpv_point);
	 
		$gofast = true;
	 
		
		$order_mod =& m('order');
		$rows_or = $order_mod->find($order_id);
		$rows_or = current($rows_or);
		 
		$goods_amount =$rows_or['goods_amount'];
		$order_amount =$rows_or['order_amount'];

	  	if($post['order_type'] == 0)
		{
			$investment_mod->_set_point_binary_pv($team,$user_id,$pv,$sponsor,$order_id, $gofast,$key_id,$get_lvl,$register);
		}
		//$this->_reg_mem_mod->_sponser_upper($sponsor);
		
	}
	function _readtotal_bag($member_id,$arr = 0) 
    {
			$bag_val = array();
		
			$br_paycom_mod =& m('br_paycom'); 
	 
	
			
		 
		    $All_Lpv_now =$br_paycom_mod->_get_pv_total_l($member_id);

			$bag_val['all_l'] = $All_Lpv_now;
		 
			 
			$All_Rpv_now = $br_paycom_mod->_get_pv_total_r($member_id)  ;

			$bag_val['all_r'] = $All_Rpv_now;

			
			$total_remove = $br_paycom_mod->_get_pv_total_m($member_id);
			$bag_val['all_remove'] = $total_remove ;

			
			$other_get = $br_paycom_mod->_get_pv_total_other($member_id);
			$bag_val['other_get'] =$other_get;
			

			$bag_val['sum_get_bag'] = ($All_Lpv_now + $All_Rpv_now + $other_get );


			$All_total =($All_Lpv_now + $All_Rpv_now + $other_get ) - $total_remove ;
			$bag_val['total'] =$All_total;



			$total_wait =$br_paycom_mod->_get_pv_totalwait($member_id);
			$bag_val['total_wait'] =$total_wait;
			$bag_val['for_up'] =0;

			if($arr ==1)
			{
				$investment_model =& m('investment'); 
				$now_inv =$investment_model->find();
				$get_id = $member_id;
				$member_team_mod =& m('member_team');

				$team = $member_team_mod->find($get_id);
				$team =current($team);

				$invest =$team['investment_id'];

				$my_lvl =$now_inv[$invest]['lvl'];
				$my_course =$now_inv[$invest]['course'] + 1;
 	
		  
				$next =	$this->_old_lvl($now_inv,$my_lvl,$my_course); 

				if(!$next['check'])
				{
					 $next =	$this->_next_lvl($now_inv,$my_lvl,$my_course);
				}
			 
	
				if($next['check'])
				{


				  

					$now_usercount =  pow(2,$now_inv[$invest]['pay_level'] ); 
					$amount = $now_inv[$next['next']]['amount'];
	 

					$pay_per_one =  $amount / $now_usercount;

					$conditions =" investment_id=".$invest." and type=1 and active =1 and status =1 and member_id=".$member_id;
					$count_user_getnow = $br_paycom_mod->find(array(
                    							'conditions' => $conditions ,
                     							'count' => true,
                									));

					$for_up = $pay_per_one *  $br_paycom_mod->getCount();
					
					 
					if($bag_val['total'] >= $for_up)
					{
						$bag_val['total'] =	$bag_val['total']  - $for_up;	
	
						$bag_val['for_up'] = $for_up;
					}
					else
					{
						$bag_val['for_up'] = $bag_val['total'];
						$bag_val['total'] =0;
						
					}
					 
				}
		
				
				return $bag_val;
			}
			 

		return $All_total  ;

	} 
	function _old_lvl($now_inv,$my_lvl,$my_course)
    {
			$check = false;
			$rows= array();

			foreach ($now_inv as $key => $val) 
			{
				if($now_inv[$key]['lvl'] == $my_lvl and $now_inv[$key]['course'] == $my_course )
				{
					$check = true;
					
					$rows['next'] = $now_inv[$key]['investment_id'];
					break;
				}
			}

			$rows['check'] = $check;

		return $rows;

	}
	function _next_lvl($now_inv,$my_lvl,$my_course)
    {
			$check = false;
			$rows= array();
			$my_lvl = $my_lvl + 1 ;
			foreach ($now_inv as $key => $val) 
			{
				if($now_inv[$key]['lvl'] == $my_lvl and $now_inv[$key]['course'] == '1' )
				{
					$check = true;
					$rows['next'] = $now_inv[$key]['investment_id'];
					break;
				}
			
			}	

			$rows['check'] = $check;

		return $rows;

	}

	function _ckkpvinv($user_id,$inv,$sumpv_point)
    {
		$member_team_mod =& m('member_team');
		 $sort  = 'investment_id';
	     $order = 'desc';
		 $investment_mod =& m('investment');
		 $check_level  =$investment_mod->find(array(
		                'order'         => "$sort $order",  
		            ));
		foreach ($check_level as $key=>$id)
		{
				
			if($sumpv_point >= $check_level[$key]['amount'])
			{
		
				if($check_level[$key]['investment_id'] > $inv)
				{
					
					echo "member>>". $user_id."<br>";
					echo "inv>>". $check_level[$key]['investment_id']."<br>";
			
					$member_team_mod->edit($user_id, array('investment_id' => $check_level[$key]['investment_id']));
					break;
				}
			}
		}
	

	}
}

?>