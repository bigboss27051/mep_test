<?php

 
class OrderApp extends BackendApp
{
    var $_menu_mod;	
    function index()
    {

 
        $this->updatedate();
        
		
		$this->_menu_mod =& m('menuleft');
		$this->assign('menus_left', $this->_menu_mod->set_menu('Order'));
         $sort  = 'add_time';
            $order = 'desc';
        $model_order =& m('order');
		$get_id = $this->visitor->get('user_id');
        $orders = $model_order->find(array(
      
             'join'          => 'has_orderextm',
             'order'         => "$sort $order",
                          
        ));  

		$this->assign('orders', $orders);   
     
        
        $this->display('order.index.html');
	}
    function view()
    {
        $order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if (!$order_id)
        {
            $this->show_warning('no_such_order');

            return;
        }

        
        $model_order =& m('order');
        $order_info = $model_order->get(array(
            'conditions'    => $order_id,
            'join'          => 'has_orderextm',
            'include'       => array(
                'has_ordergoods',   //取出订单商品
            ),
        ));

        if (!$order_info)
        {
            $this->show_warning('no_such_order');
            return;
        }
        $order_type =& ot($order_info['extension']);
        $order_detail = $order_type->get_order_detail($order_id, $order_info);
        $order_info['group_id'] = 0;
        if ($order_info['extension'] == 'groupbuy')
        {
            $groupbuy_mod =& m('groupbuy');
            $groupbuy = $groupbuy_mod->get(array(
                'fields' => 'groupbuy.group_id',
                'join' => 'be_join',
                'conditions' => "order_id = {$order_info['order_id']} ",
                )
            );
            $order_info['group_id'] = $groupbuy['group_id'];
        }
        foreach ($order_detail['data']['goods_list'] as $key => $goods)
        {
            if (substr($goods['goods_image'], 0, 7) != 'http://')
            {
                $order_detail['data']['goods_list'][$key]['goods_image'] = SITE_URL . '/' . $goods['goods_image'];
				$order_detail['data']['goods_list'][$key]['goods_total'] =$order_detail['data']['goods_list'][$key]['quantity'] * $order_detail['data']['goods_list'][$key]['price'] ;
            }
        }
		$this->_menu_mod =& m('menuleft');
		$this->assign('menus_left', $this->_menu_mod->set_menu('Order'));
		
        $this->assign('order', $order_info);
        $this->assign($order_detail['data']);
        $this->display('order.view.html');
    }

	 
	function report()
    {
		$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if (!$order_id)
        {
            $this->show_warning('no_such_order');

            return;
        }

        
        $model_order =& m('order');
        $order_info = $model_order->get(array(
            'conditions'    => $order_id ,
            'join'          => 'has_orderextm',
            'include'       => array(
                'has_ordergoods',   //取出订单商品
            ),
        ));

		if (!$order_info)
        {
            $this->show_warning('no_such_order');
            return;
        }
        $order_type =& ot($order_info['extension']);
        $order_detail = $order_type->get_order_detail($order_id, $order_info);
        $order_info['group_id'] = 0;
        if ($order_info['extension'] == 'groupbuy')
        {
            $groupbuy_mod =& m('groupbuy');
            $groupbuy = $groupbuy_mod->get(array(
                'fields' => 'groupbuy.group_id',
                'join' => 'be_join',
                'conditions' => "order_id = {$order_info['order_id']} ",
                )
            );
            $order_info['group_id'] = $groupbuy['group_id'];
        }
        foreach ($order_detail['data']['goods_list'] as $key => $goods)
        {
            if (substr($goods['goods_image'], 0, 7) != 'http://')
            {
                $order_detail['data']['goods_list'][$key]['goods_image'] = SITE_URL . '/' . $goods['goods_image'];
            }
        }
	 
		ob_start();

	    	 echo "<img src='templates/images/po.jpg' width='750'  >";

			 
			echo "<div style='position:absolute;top:150px;left:615px' >" . $order_info['order_sn'] ."</div>";
			echo "<div style='position:absolute;top:188px;left:100px' >" . $order_info['consignee'] ."</div>";
			echo "<div style='position:absolute;top:172px;left:615px' >" . date("Y-m-d", $order_info['add_time']) ."</div>";
			echo "<div style='position:absolute;top:223px;left:100px' >" . $order_info['address']  ."</div>";

			 
			
			$row_num = 1;
			$row_line = 310;
			foreach ( $order_detail['data']['goods_list'] as $key => $value )
			{
				 
				$total = $order_detail['data']['goods_list'][$key]['price'] * $order_detail['data']['goods_list'][$key]['quantity'];
				echo "<div style='position:absolute;top:".$row_line."px;left:50px;font-size:12px' >".$row_num."</div>";
				echo "<div style='position:absolute;top:".$row_line."px;left:90px;font-size:12px' >00". $order_detail['data']['goods_list'][$key]['goods_id']."</div>";
				echo "<div style='position:absolute;top:".$row_line."px;left:145px;font-size:12px' >". $order_detail['data']['goods_list'][$key]['goods_name']." X " . $order_detail['data']['goods_list'][$key]['quantity']  ."</div>";
				echo "<div style='position:absolute;top:".$row_line."px;left:645px;font-size:12px;width:50px;text-align: right;' >".number_format($total,2)."</div>";
			 	$row_num++;
				$row_line=$row_line + 25;
			}
				echo "<div style='position:absolute;top:".$row_line."px;left:50px;font-size:12px' >".$row_num."</div>";
				echo "<div style='position:absolute;top:".$row_line."px;left:90px;font-size:12px' ></div>";
				echo "<div style='position:absolute;top:".$row_line."px;left:145px;font-size:12px' >Shipping ". $order_info['shipping_name']."</div>";
				echo "<div style='position:absolute;top:".$row_line."px;left:645px;font-size:12px;width:50px;text-align: right;' >".number_format($order_info['shipping_fee'],2)."</div>";
			
			$amout_order = floatval($order_info['order_amount']);
			$vat =($amout_order  * 7) /100 ;
			$total_order_sum = $amout_order +$vat;
			echo "<div style='position:absolute;top:625px;left:645px;font-size:12px;width:50px;text-align: right;' ><b>".number_format($amout_order,2)."</b></div>";
		    echo "<div style='position:absolute;top:660px;left:645px;font-size:12px;width:50px;text-align: right;' ><b>".number_format($vat,2)."</b></div>";
		    echo "<div style='position:absolute;top:695px;left:645px;font-size:12px;width:50px;text-align: right;' ><b>".number_format($total_order_sum,2)."</b></div>";
		    
 
		    $content = ob_get_clean();
		
		 
		    require_once(ROOT_PATH .'/includes/pdf/html2pdf.class.php');
		    try
		    {
		        $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
				$html2pdf->setDefaultFont('freeserif');  
		        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		        $html2pdf->Output('exemple13.pdf');
		    }
		    catch(HTML2PDF_exception $e) {
		        echo $e;
		        exit;
		    }
		
	}
	function setfinish()
    {
		 $order_id= empty($_GET['id']) ? 0 : intval($_GET['id']);
		 $order_mod =& m('order');
		 $order_mod->edit($order_id, array(	'finished_time' =>  gmtime(),
											'status' =>  '40'));
		 $this->show_message('finish_ok' );
	}
	function setship()
    {
		 $order_id= empty($_GET['id']) ? 0 : intval($_GET['id']);
		 $order_mod =& m('order');
		 $order_mod->edit($order_id, array(	'ship_time' =>  gmtime(),
											'status' =>  '30'));
		 $this->show_message('setship_ok' );
	}
 
	function updatedate()
    { 
		$model_order =& m('order');
		$orders = $model_order->find(array(
            				'conditions'    => "d_active = 0" ,
                          
       			 			));

		foreach ($orders as $key=>$id)
		{
			$date =	local_date("Y-m-d H:i:s",$orders[$key]['add_time']);
			 
			$data = array(
                 
                'date'       => $date,
                'd_active'     =>'1',
                 
            );
			$model_order->edit($orders[$key]['order_id'],$data);
				


		}

	
	}
	function reportpdf()
    {
		$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if (!$order_id)
        {
            $this->show_warning('no_such_order');

            return;
        }

        
        $model_order =& m('order');
        $order_info = $model_order->get(array(
            'conditions'    => $order_id ,
            'join'          => 'has_orderextm',
            'include'       => array(
                'has_ordergoods',   //取出订单商品
            ),
        ));

		if (!$order_info)
        {
            $this->show_warning('no_such_order');
            return;
        }
        $order_type =& ot($order_info['extension']);
        $order_detail = $order_type->get_order_detail($order_id, $order_info);
        $order_info['group_id'] = 0;
        if ($order_info['extension'] == 'groupbuy')
        {
            $groupbuy_mod =& m('groupbuy');
            $groupbuy = $groupbuy_mod->get(array(
                'fields' => 'groupbuy.group_id',
                'join' => 'be_join',
                'conditions' => "order_id = {$order_info['order_id']} ",
                )
            );
            $order_info['group_id'] = $groupbuy['group_id'];
        }
        foreach ($order_detail['data']['goods_list'] as $key => $goods)
        {
            if (substr($goods['goods_image'], 0, 7) != 'http://')
            {
                $order_detail['data']['goods_list'][$key]['goods_image'] = SITE_URL . '/' . $goods['goods_image'];
            }
        }
	 
		ob_start();

	    	 echo "<img src='templates/images/aura_print.jpg' width='750'  >";
				
			$eng_date=strtotime(date("Y-m-d", $order_info['add_time']));   
		    
		 	$row_line = 165;
		//	echo "<div style='position:absolute;top:".$row_line."px;left:610px;font-size:12px' >0115553003791</div>"; 
			$row_line = $row_line + 35 ;
			echo "<div style='position:absolute;top:".$row_line."px;left:610px;font-size:12px' >" . $order_info['order_sn'] ."</div>";
			$row_line = $row_line + 8 ;
			echo "<div style='position:absolute;top:".$row_line."px;left:100px;font-size:12px' >" . $order_info['consignee'] ."</div>";
			$row_line = $row_line + 22 ;
			echo "<div style='position:absolute;top:".$row_line."px;left:610px;font-size:12px' >" . $this->thai_date($eng_date) ."</div>";
			$row_line = $row_line + 20 ;
			echo "<div style='position:absolute;top:".$row_line."px;left:100px;font-size:12px' >" . $order_info['address']  ."</div>";
			$row_line = $row_line + 12 ;
			//echo "<div style='position:absolute;top:".$row_line."px;left:610px;font-size:12px' >7%</div>";
			$row_line = $row_line + 28 ;
			echo "<div style='position:absolute;top:".$row_line."px;left:610px;font-size:12px' >" . $order_info['buyer_name']  ."</div>";
			$row_line = $row_line + 20 ;
			echo "<div style='position:absolute;top:".$row_line."px;left:100px;font-size:12px' >" . $order_info['phone_tel']  ."</div>";
		 
			$member_team_mod =& m('member_team');

			$memm_tr = $member_team_mod->find($order_info['buyer_id']);
			
			$memm_tr = current($memm_tr);
			$user_mod =& m('member');

			$spone_use = $user_mod->find($memm_tr['sponsor']);
			$spone_use =current($spone_use);
			$row_line = $row_line + 80 ;
			echo "<div style='position:absolute;top:".$row_line."px;left:105px;font-size:12px' >" . $spone_use['real_name']  ."(".$spone_use['user_name'].")</div>";
			
			$row_num = 1;
			$row_line = 445;
			$goods_mod =& m('goods');
			$goodsspec_mod =& m('goodsspec');
			
			foreach ( $order_detail['data']['goods_list'] as $key => $value )
			{
				 
				$gg = $goods_mod->find($order_detail['data']['goods_list'][$key]['goods_id']);
				$gg =current($gg); 

				$gg_spec =$goodsspec_mod->find($order_detail['data']['goods_list'][$key]['spec_id']);
				$gg_spec = current($gg_spec);

				$total = $order_detail['data']['goods_list'][$key]['price'] * $order_detail['data']['goods_list'][$key]['quantity'];
			 
				echo "<div style='position:absolute;top:".$row_line."px;left:45px;font-size:12px' >". $gg['good_code']."</div>";
				echo "<div style='position:absolute;top:".$row_line."px;left:135px;font-size:12px' >". $order_detail['data']['goods_list'][$key]['goods_name'] ."</div>";
				echo "<div style='position:absolute;top:".$row_line."px;left:395px;font-size:12px' >".$order_detail['data']['goods_list'][$key]['quantity']."</div>";
				echo "<div style='position:absolute;top:".$row_line."px;left:485px;font-size:12px' >".number_format($gg_spec['pv'],0)."</div>";
				echo "<div style='position:absolute;top:".$row_line."px;left:575px;font-size:12px' >".number_format($order_detail['data']['goods_list'][$key]['price'],2)."</div>";
				echo "<div style='position:absolute;top:".$row_line."px;left:655px;font-size:12px;width:50px;text-align: right;' >".number_format($total,2)."</div>";
			 	$row_num++;
				$row_line=$row_line + 25;
			}
				 

		 
			echo "<div style='position:absolute;top:760px;left:50px;font-size:12px;' ><b>PV = ".$order_info['order_pv']."</b></div>";
			echo "<div style='position:absolute;top:760px;left:445px;font-size:12px;text-align: right;width:250px;' ><b>(".$this->convert($order_info['order_amount']).")</b></div>";
			$amout_order = floatval($order_info['order_amount']);
			//$vat = $amout_order -  ($amout_order / 1.07) ;
			//$total_order_sum = $amout_order - $vat;
			echo "<div style='position:absolute;top:790px;left:645px;font-size:12px;width:50px;text-align: right;' ><b>0.00</b></div>";
			echo "<div style='position:absolute;top:830px;left:645px;font-size:12px;width:50px;text-align: right;' ><b>".number_format($total_order_sum,2)."</b></div>";
		    echo "<div style='position:absolute;top:865px;left:645px;font-size:12px;width:50px;text-align: right;' ><b>".number_format($vat,2)."</b></div>";
		    echo "<div style='position:absolute;top:900px;left:645px;font-size:12px;width:50px;text-align: right;' ><b>".number_format($amout_order,2)."</b></div>";
		    
 
		    $content = ob_get_clean();
		
		 
		    require_once(ROOT_PATH .'/includes/pdf/html2pdf.class.php');
		    try
		    {
		        $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
				$html2pdf->setDefaultFont('freeserif');  
		        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		        $html2pdf->Output('exemple13.pdf');
		    }
		    catch(HTML2PDF_exception $e) {
		        echo $e;
		        exit;
		    }
		
	}
		function thai_date($time)
	{  

				
		$thai_month_arr=array(  
		    "0"=>"",  
		    "1"=>"มกราคม",  
		    "2"=>"กุมภาพันธ์",  
		    "3"=>"มีนาคม",  
		    "4"=>"เมษายน",  
		    "5"=>"พฤษภาคม",  
		    "6"=>"มิถุนายน",   
		    "7"=>"กรกฎาคม",  
		    "8"=>"สิงหาคม",  
		    "9"=>"กันยายน",  
		    "10"=>"ตุลาคม",  
		    "11"=>"พฤศจิกายน",  
		    "12"=>"ธันวาคม"                    
		);  
	
	    $thai_date_return.= date("j",$time);  
	    $thai_date_return.="/".$thai_month_arr[date("n",$time)];  
	    $thai_date_return.= "/".(date("Yํ",$time)+543);  
 
	    return $thai_date_return;  
	}
	function convert($number)
	{ 
		$txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
		$txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
		$number = str_replace(",","",$number); 
		$number = str_replace(" ","",$number); 
		$number = str_replace("บาท","",$number); 
		$number = explode(".",$number); 
		if(sizeof($number)>2)
		{ 
			return 'ทศนิยมหลายตัวนะจ๊ะ'; 
			exit; 
		} 
		$strlen = strlen($number[0]); 
		$convert = ''; 
		for($i=0;$i < $strlen;$i++)
		{ 
			$n = substr($number[0], $i,1); 
			if($n!=0)
			{ 
				if($i==($strlen-1) AND $n==1)
				{ 
					$convert .= 'เอ็ด';
				 } 
				elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; } 
				elseif($i==($strlen-2) AND $n==1){ $convert .= ''; } 
				else{ $convert .= $txtnum1[$n]; } 
				$convert .= $txtnum2[$strlen-$i-1]; 
			} 
		} 
		
		$convert .= 'บาท'; 
		if($number[1]=='0' OR $number[1]=='00' OR $number[1]=='')
		{ 
			$convert .= 'ถ้วน'; 
		}
		else
		{ 
			$strlen = strlen($number[1]); 
			for($i=0;$i < $strlen;$i++)
			{ 
				$n = substr($number[1], $i,1); 
				if($n!=0){ 
				if($i==($strlen-1) AND $n==1)
				{
					$convert .= 'เอ็ด';
				} 
				elseif($i==($strlen-2) AND $n==2)
				{
					$convert .= 'ยี่';
				} 
				elseif($i==($strlen-2) AND $n==1)
				{
					$convert .= '';
				} 
				else
				{ 
					$convert .= $txtnum1[$n];
				} 
				$convert .= $txtnum2[$strlen-$i-1]; 
				} 
			} 
			$convert .= 'สตางค์'; 
		} 
		return $convert; 
	} 
 
}
?>
