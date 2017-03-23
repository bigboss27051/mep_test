<?php

class DefaultApp extends MallbaseApp
{
    function index()
    {
        $this->assign('index', 1); 
        $this->assign('icp_number', Conf::get('icp_number'));

   
        $this->assign('hot_keywords', $this->_get_hot_keywords());

        $this->_config_seo(array(
            'title' => Lang::get('mall_index') . ' - ' . Conf::get('site_title'),
        ));

		$conditions = "sale = 1";
		$showitems_mod =& m('showitems');
        $items_sale = $showitems_mod->find(array(
		            'conditions' => $conditions,
		            'order' =>"sort_order asc",     
		        ));

		

		$this->assign('items_sale', $items_sale);


		$conditions = "new = 1";
		$showitems_mod =& m('showitems');
        $items_new= $showitems_mod->find(array(
		            'conditions' => $conditions,
		            'order' =>"sort_order asc",     
		        ));
		$this->assign('items_new', $items_new);

        $this->assign('page_description', Conf::get('site_description'));
        $this->assign('page_keywords', Conf::get('site_keywords'));
        $this->display('index.html');
    }

    function _get_hot_keywords()
    {
        $keywords = explode(',', conf::get('hot_search'));
        return $keywords;
    }

	function search()
    {
		$myfind_mod =& m('myfind');

		$url = $_POST['ads'];

		//echo $url;
		$id  = $myfind_mod->_idform($url );

		if($id)
		{
			$base_price = 6;

			$myfind_mod->_itemsdetail($id );
			$data = array();

			$price =  $base_price * $myfind_mod->_price;;

			$data['title'] = $myfind_mod->_title;
			$data['thai'] = $myfind_mod->_translate($myfind_mod->_title);
			$data['link'] ="https://world.taobao.com/item/".$id.".html";
			$data['img'] =$myfind_mod->_pic_url ;
			$data['price'] = $myfind_mod->_price;
			$data['price_th'] = $price;
			$data['desc'] = $myfind_mod->_desc;

			$this->assign('data',$data);
			foreach ($myfind_mod->_sizeList as $value) 
			{
					
				$size .='<input  name="msize" type="radio" value="'.$value.'"   >&nbsp;'.$value.'&nbsp;&nbsp;&nbsp;';
			
			} 

					 
			
			$this->assign('size',$size);
			foreach ($myfind_mod->_colorList as $value)
			{
					
				$color .=  '<input name="mcolor" type="radio"  value="'.$value.'" >&nbsp;<img height="30" src="'.$value.'">&nbsp;&nbsp;&nbsp;';
			
			} 
			$this->assign('color',$color);
			
 
			$this->assign('item_res', true);
		}
		else
		{
			$this->assign('item_res', false);
		}
		
		
        $this->display('search_bar.index.html');
			
		
	}
	
	function search_old()
    {


		

		 $url  = "http://www.vcanbuy.com/cgi-bin/grab/vcb_grab.pl?u=";
			
		 //$url .= "https://world.taobao.com/item/543632292120.htm?fromSite=main&spm=a312a.7728556.w4004-15727673629.2.TIEznn";
		 $url .= $_POST['ads'];
		 $respon = file_get_contents($url);
		 if($respon)
		 {
			$items	 = explode(':|:', $respon);

			
			//print_r($item_array);
			
			$row_arr = 0;	
			
			$item_array	 = explode('||', $items[0]);
			$item_imge =  $item_array[2];
			$item_imge = str_replace("_180x180.jpg","",$item_imge );
		
			$price_array =  $item_array[2];
			
			 
			$this->_search2($items,$item_imge);
			
			$this->assign('item_name', $item_array[0]);
			$this->assign('item_imge', $item_imge."_300x300.jpg");
			$this->assign('item_price', $item_array[8]);
		    $this->assign('link_ads', $_POST['ads']);
			
			$this->assign('item_res', true);
			$item_price_thai = number_format($this->convertCurrency($item_array[8], "CNY", "THB"),2);
			$this->assign('item_price_thai',$item_price_thai );
				
		}
		else
		{
			$this->assign('item_res', false);
		}
        $this->display('search_bar.index.html');
    }
	function convertCurrency($amount, $from, $to)
	{
		$url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
		$data = file_get_contents($url);
		preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
		$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
		return round($converted, 3);
	}
	function _search2($items,$item_imge)
    {
		 //$url  = "http://www.vcanbuy.com/cgi-bin/grab/vcb_grab.pl?u=";
		 //$url .= "https://world.taobao.com/item/43507398249.htm?spm=a21bp.7915459.179241.8.96RjuW";
		 //$respon = file_get_contents($url);
		 //$items	 = explode(':|:', $respon);

		 
		$row_arr = 0;

		$data = array();
		$row_n = array();
		$_row = 1;
		$_rowdata = 0;
		foreach ($items as $value) {
			if($row_arr > 0)
			{
				$row_n[$_row] =  $value;

				$_row++;  
				if($_row > 6 )
				{
					$_row = 1;
					$data[$_rowdata] = $row_n;  
					$_rowdata++;
				}
			
			}
	 
			$row_arr++;
		}

 

		$size ="";
		$color ="";
		$color_change ="";
		$size_change ="";

		$row_until = 1;
		foreach ($data  as $key=>$id) 
		{
			if($data[$key][3] >0) 
			{
			   $key_2 	 = explode(';', $data[$key][2]);

				
				
				$key_2_lv1 	 = explode(':', $key_2[0]);

			    $check = "";
				if($color_change !=  $key_2_lv1[3])
				{
					
					if($row_until == 1)
					{
						$check = 'checked="checked"';
					}
					
					$color .= '<input id="color" name="color" value="'.$key_2_lv1[0].':'.$key_2_lv1[1].'"  '.$check .'   type="radio">';
					if($data[$key][5] =="")
					{
						$color .= '<img src="'.$item_imge.'_30x30.jpg" >&nbsp;&nbsp;'; 
					}
					else
					{
						$color .= '<img src="'.$data[$key][5].'_30x30.jpg" >';
					}
					$color_change = $key_2_lv1[3];
				}

			    if(count($key_2)  > 1)
				{

					if($size_change =="" or $size_change == $key_2_lv1[1])
					{

						$key_2_lv2 = explode(':', $key_2[1]);
						$size .= '<input id="size" name="size" value="'.$key_2_lv2[0].':'.$key_2_lv2[1].'" '.$check .'  type="radio">'.$key_2_lv2[3].'&nbsp;&nbsp;' ;
						$size_change  = $key_2_lv1[1];


						
					}
				}
				$row_until++;

			}
		}
		$this->assign('color', $color);
		$this->assign('size', $size);
		 

	}
	function addtocart()
    {
		if (IS_POST)
        {
		 

			$mod_cart =& m('cart');

			
			 $cart_item = array(
				'user_id'       => $this->visitor->get('user_id'),
				'session_id'    => SESS_ID,
		  
				'goods_name'    => $_POST['adname'] ,
				'goods_name_thai'  => $_POST['adname_thai'] ,
				'price'         => $_POST['adprice'],
				'price_thai' => $_POST['adprice_thai'],
				'quantity'      => $_POST['qty'] ,
				'goods_image'   => $_POST['adimge'] ,
				'adlink'  => $_POST['adlink'] ,
				'color' => $_POST['mcolor'] ,
				'size' => $_POST['msize'] ,
			);


			  $mod_cart->add( $cart_item);
			$this->show_message('เพิ่มสินค้าไปยังตระกร้า เรียบร้อย ' , 'go_back', 'index.php?act=viewcart');
		}
		
		 
	}
	function viewcart()
    {
		$mod_cart =& m('cart');	

		$conditions = "session_id = '".SESS_ID."'";
		$list_cart = $mod_cart->find(array(
            'conditions'    => $conditions,
             
        ));
		$this->assign('list_cart', $list_cart);
		$this->display('search_viewcart.index.html');
	}
	function aboutus()
    {
	
		 $this->display('about-us.html');
	}

	function howto()
    {
	
		 $this->display('howto.html');
	}
	function shipping()
    {
	
		 $this->display('shippingtxt.html');
	}
	function news()
    {
	
		 $this->display('news.html');
	}
	function promotion()
    {
	
		 $this->display('promotion.html');
	}
	function faq()
    {
	
		 $this->display('faq.html');
	}
	  
	function contact()
    {
	
		 $this->display('contact.html');
	}
}

?>