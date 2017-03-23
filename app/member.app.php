<?php

/**
 *    Desc
 *
 *    @author    Garbin
 *    @usage    none
 */
class MemberApp extends MemberbaseApp
{
    var $_feed_enabled = false;
    function __construct()
    {
        $this->MemberApp();
    }
    function MemberApp()
    {
        parent::__construct();
        $ms =& ms();
        $this->_feed_enabled = $ms->feed->feed_enabled();
        $this->assign('feed_enabled', $this->_feed_enabled);
    }
    function index()
    {
        if (!IS_POST)
        {
	        $cache_server =& cache_server();
	        $cache_server->delete('new_pm_of_user_' . $this->visitor->get('user_id'));
	
	        $user = $this->visitor->get('user_id');
	        $user_mod =& m('member');
	        $member_row = $user_mod->find($user);
			
			$this->assign('member_row', current($member_row));		
			
	       
	        $this->_curitem('overview');
	        $this->_config_seo('title', Lang::get('member_center'));
	        $this->display('member.index.html');
		}
		else
		{
			$member_mod = &m('member');
			$data = array(
                'real_name' => $_POST['realname'],
                'email'    => $_POST['email'],
                'address'  => $_POST['address'],
                'phone_tel'    => $_POST['phone'],
                 
            );
			$get_id = $this->visitor->get('user_id');
			$member_mod->edit($get_id,$data);
			$this->show_message('ทำการอัพเดทข้อมูล เรียบร้อย�');
				
		}
    }

    function repassword()
    {
		if (IS_POST)
        {
			$get_id = $this->visitor->get('user_id');
            
		 
            $ms =& ms();     
            $result = $ms->user->edit2($get_id,  array(
                'password'  => $_POST["pass"],
            ));
            if (!$result)
            {
                 
                $this->show_warning($ms->user->get_error());

                return;
            }

            $this->show_message('ทำการแก้ไขรหัสผ่านเรียบร้อย');
		}

	}
    function register()
    {
        if ($this->visitor->has_login)
        {
            $this->show_warning('has_login');

            return;
        }
        if (!IS_POST)
        {
            if (!empty($_GET['ret_url']))
            {
                $ret_url = trim($_GET['ret_url']);
            }
            else
            {
                if (isset($_SERVER['HTTP_REFERER']))
                {
                    $ret_url = $_SERVER['HTTP_REFERER'];
                }
                else
                {
                    $ret_url = SITE_URL . '/index.php';
                }
            }
            $this->assign('ret_url', rawurlencode($ret_url));
            $this->_curlocal(LANG::get('user_register'));
            $this->_config_seo('title', Lang::get('user_register') . ' - ' . Conf::get('site_title'));

            if (Conf::get('captcha_status.register'))
            {
                $this->assign('captcha', 1);
            }

            /* 导入jQuery的表单验证插件 */
            $this->import_resource('jquery.plugins/jquery.validate.js');
            $this->display('member.register.html');
        }
        else
        {
            if (!$_POST['agree'])
            {
                $this->show_warning('agree_first');

                return;
            }
            if (Conf::get('captcha_status.register') && base64_decode($_SESSION['captcha']) != strtolower($_POST['captcha']))
            {
                $this->show_warning('captcha_failed');
                return;
            }
            if ($_POST['password'] != $_POST['password_confirm'])
            {
                 
                $this->show_warning('inconsistent_password');
                return;
            }

            
			
            $user_name = trim($_POST['user_name']);
            $password  = $_POST['password'];
            $email= trim($_POST['user_name']); 
            $passlen = strlen($password);
            $user_name_len = strlen($user_name);

            if ($user_name_len < 3 || $user_name_len > 25)
            {
                $this->show_warning('user_name_length_error');

                return;
            }
            if ($passlen < 6 || $passlen > 20)
            {
                $this->show_warning('password_length_error');

                return;
            }
            if (!is_email($email))
            {
                $this->show_warning('email_error');

                return;
            }

			$data = array(
                'real_name' => $_POST['realname'],
                'address'  => $_POST['address'], 
				 'phone_tel'  => $_POST['phonetel'], 
				
            );

            $ms =& ms(); //连接用户中心
            $user_id = $ms->user->register($user_name, $password, $email,$data);

            if (!$user_id)
            {
                $this->show_warning($ms->user->get_error());

                return;
            }
            $this->_hook('after_register', array('user_id' => $user_id));
            //登录
            $this->_do_login($user_id);
            
            /* 同步登陆外部系统 */
            $synlogin = $ms->user->synlogin($user_id);

            #TODO 可能还会发送欢迎邮件

            $this->show_message(Lang::get('register_successed') . $synlogin,
                'back_before_register', rawurldecode($_POST['ret_url']),
                'enter_member_center', 'index.php?app=member',
                'apply_store', 'index.php?app=apply'
            );
        }
    }


    /**
     *    检查用户是否存在
     *
     *    @author    Garbin
     *    @return    void
     */
    function check_user()
    {
        $user_name = empty($_GET['user_name']) ? null : trim($_GET['user_name']);
        if (!$user_name)
        {
            echo ecm_json_encode(false);

            return;
        }
        $ms =& ms();

        echo ecm_json_encode($ms->user->check_username($user_name));
    }

    /**
     *    修改基本信息
     *
     *    @author    Hyber
     *    @usage    none
     */
    function profile(){

        $user_id = $this->visitor->get('user_id');
        if (!IS_POST)
        {
            /* 当前位置 */
            $this->_curlocal(LANG::get('member_center'),  'index.php?app=member',
                             LANG::get('basic_information'));

            /* 当前用户中心菜单 */
            $this->_curitem('my_profile');

            /* 当前所处子菜单 */
            $this->_curmenu('basic_information');

            $ms =& ms();    //连接用户系统
            $edit_avatar = $ms->user->set_avatar($this->visitor->get('user_id')); //获取头像设置方式

            $model_user =& m('member');
            $profile    = $model_user->get_info(intval($user_id));
            $profile['portrait'] = portrait($profile['user_id'], $profile['portrait'], 'middle');
            $this->assign('profile',$profile);
            $this->import_resource(array(
                'script' => 'jquery.plugins/jquery.validate.js',
            ));
            $this->assign('edit_avatar', $edit_avatar);
            $this->_config_seo('title', Lang::get('member_center') . ' - ' . Lang::get('my_profile'));
            $this->display('member.profile.html');
        }
        else
        {
            $data = array(
                'real_name' => $_POST['real_name'],
                'gender'    => $_POST['gender'],
                'birthday'  => $_POST['birthday'],
                'im_msn'    => $_POST['im_msn'],
                'im_qq'     => $_POST['im_qq'],
            );

            if (!empty($_FILES['portrait']))
            {
                $portrait = $this->_upload_portrait($user_id);
                if ($portrait === false)
                {
                    return;
                }
                $data['portrait'] = $portrait;
            }

            $model_user =& m('member');
            $model_user->edit($user_id , $data);
            if ($model_user->has_error())
            {
                $this->show_warning($model_user->get_error());

                return;
            }

            $this->show_message('edit_profile_successed');
        }
    }
    /**
     *    修改密码
     *
     *    @author    Hyber
     *    @usage    none
     */
    function password()
	{
        $user_id = $this->visitor->get('user_id');
        if (!IS_POST)
        {
            
            $this->_config_seo('title', Lang::get('user_center') . ' - ' . Lang::get('edit_password'));
            $this->display('member.pass.html');
        }
        else
        {
             $get_id = $this->visitor->get('user_id');
            
		 
            $ms =& ms();     
            $result = $ms->user->edit2($get_id,  array(
                'password'  => $_POST["pass"],
            ));
            if (!$result)
            {
                 
                $this->show_warning($ms->user->get_error());

                return;
            }

            $this->show_message('ทำการแก้ไขรหัสผ่านเรียบร้อย');
        }
    }
    /**
     *    修改电子邮箱
     *
     *    @author    Hyber
     *    @usage    none
     */
    function email(){
        $user_id = $this->visitor->get('user_id');
        if (!IS_POST)
        {
            /* 当前位置 */
            $this->_curlocal(LANG::get('member_center'),  'index.php?app=member',
                             LANG::get('edit_email'));

            /* 当前用户中心菜单 */
            $this->_curitem('my_profile');

            /* 当前所处子菜单 */
            $this->_curmenu('edit_email');
            $this->import_resource(array(
                'script' => 'jquery.plugins/jquery.validate.js',
            ));
            $this->_config_seo('title', Lang::get('user_center') . ' - ' . Lang::get('edit_email'));
            $this->display('member.email.html');
        }
        else
        {
            $orig_password  = $_POST['orig_password'];
            $email          = isset($_POST['email']) ? trim($_POST['email']) : '';
            if (!$email)
            {
                $this->show_warning('email_required');

                return;
            }
            if (!is_email($email))
            {
                $this->show_warning('email_error');

                return;
            }

            $ms =& ms();    //连接用户系统
            $result = $ms->user->edit($this->visitor->get('user_id'), $orig_password, array(
                'email' => $email
            ));
            if (!$result)
            {
                $this->show_warning($ms->user->get_error());

                return;
            }

            $this->show_message('edit_email_successed');
        }
    }

    /**
     * Feed设置
     *
     * @author Garbin
     * @param
     * @return void
     **/
    function feed_settings()
    {
        if (!$this->_feed_enabled)
        {
            $this->show_warning('feed_disabled');
            return;
        }
        if (!IS_POST)
        {
            /* 当前位置 */
            $this->_curlocal(LANG::get('member_center'),  'index.php?app=member',
                             LANG::get('feed_settings'));

            /* 当前用户中心菜单 */
            $this->_curitem('my_profile');

            /* 当前所处子菜单 */
            $this->_curmenu('feed_settings');
            $this->_config_seo('title', Lang::get('user_center') . ' - ' . Lang::get('feed_settings'));

            $user_feed_config = $this->visitor->get('feed_config');
            $default_feed_config = Conf::get('default_feed_config');
            $feed_config = !$user_feed_config ? $default_feed_config : unserialize($user_feed_config);

            $buyer_feed_items = array(
                'store_created' => Lang::get('feed_store_created.name'),
                'order_created' => Lang::get('feed_order_created.name'),
                'goods_collected' => Lang::get('feed_goods_collected.name'),
                'store_collected' => Lang::get('feed_store_collected.name'),
                'goods_evaluated' => Lang::get('feed_goods_evaluated.name'),
                'groupbuy_joined' => Lang::get('feed_groupbuy_joined.name')
            );
            $seller_feed_items = array(
                'goods_created' => Lang::get('feed_goods_created.name'),
                'groupbuy_created' => Lang::get('feed_groupbuy_created.name'),
            );
            $feed_items = $buyer_feed_items;
            if ($this->visitor->get('manage_store'))
            {
                $feed_items = array_merge($feed_items, $seller_feed_items);
            }
            $this->assign('feed_items', $feed_items);
            $this->assign('feed_config', $feed_config);
            $this->display('member.feed_settings.html');
        }
        else
        {
            $feed_settings = serialize($_POST['feed_config']);
            $m_member = &m('member');
            $m_member->edit($this->visitor->get('user_id'), array(
                'feed_config' => $feed_settings,
            ));
            $this->show_message('feed_settings_successfully');
        }
    }

     /**
     *    三级菜单
     *
     *    @author    Hyber
     *    @return    void
     */
    function _get_member_submenu()
    {
        $submenus =  array(
            array(
                'name'  => 'basic_information',
                'url'   => 'index.php?app=member&amp;act=profile',
            ),
            array(
                'name'  => 'edit_password',
                'url'   => 'index.php?app=member&amp;act=password',
            ),
            array(
                'name'  => 'edit_email',
                'url'   => 'index.php?app=member&amp;act=email',
            ),
        );
        if ($this->_feed_enabled)
        {
            $submenus[] = array(
                'name'  => 'feed_settings',
                'url'   => 'index.php?app=member&amp;act=feed_settings',
            );
        }

        return $submenus;
    }

    /**
     * 上传头像
     *
     * @param int $user_id
     * @return mix false表示上传失败,空串表示没有上传,string表示上传文件地址
     */
    function _upload_portrait($user_id)
    {
        $file = $_FILES['portrait'];
        if ($file['error'] != UPLOAD_ERR_OK)
        {
            return '';
        }
        import('uploader.lib');
        $uploader = new Uploader();
        $uploader->allowed_type(IMAGE_FILE_TYPE);
        $uploader->addFile($file);
        if ($uploader->file_info() === false)
        {
            $this->show_warning($uploader->get_error(), 'go_back', 'index.php?app=member&amp;act=profile');
            return false;
        }
        $uploader->root_dir(ROOT_PATH);
        return $uploader->save('data/files/mall/portrait/' . ceil($user_id / 500), $user_id);
    }

	function order()
    {
		  $sort  = 'add_time';
            $order = 'desc';
        $model_order =& m('order');
		$get_id = $this->visitor->get('user_id');
        $orders = $model_order->find(array(
            'conditions'    => "buyer_id = ".$get_id,
             'join'          => 'has_orderextm',
             'order'         => "$sort $order",
                          
        ));  

		$this->assign('orders', $orders);       
		$this->display('member_order.html');
	}
	function orderdetail()
    {
		if (!IS_POST)
        {
          
			 $id = is_numeric($_GET['id']) ? $_GET['id'] : 0;
		
	
			$model_ordergoods =& m('ordergoods');
	
			
			$orders = $model_ordergoods->find(array(
	            'conditions'    => "order_id = ".$id,
	             
	                          
	        ));
	
			foreach ($orders as $key=>$value)
			{
				$orders[$key]['amount'] =  $orders[$key]['quantity'] * $orders[$key]['price_thai'];
	
			}
	
			$this->assign('list_cart', $orders);   
				
			$model_orderextm =& m('orderextm');
			$orders_address = $model_orderextm->find(array(
	            'conditions'    => "order_id = ".$id,
	             
	                          
	        ));
			$this->assign('orders_address',current($orders_address));   
	
			$model_or =& m('order');
			$_rowor = $model_or->find($id);
			
			
			$this->assign('orders',current($_rowor));   
			$this->assign('tid',$id);   
	    	
			$this->display('member_order_detail.html');
		}
		else
		{

			$tid =  $_POST['tid'];
			$order_mod =& m('order');	
			$order_extm_mod =& m('orderextm');
			$order_goods_mod =& m('ordergoods');

			$row_order =$order_mod->find($tid);
			$row_order = current($row_order);

			$data2 = array(
		                'order_sn' => $this->_gen_order_sn2(),
						'type'=> 'material',
		                'extension'    => 'normal',
						'seller_id' => $row_order['seller_id'],
						'seller_name'  => $row_order['seller_name'],
						'buyer_id' => $row_order['buyer_id'],	
						'buyer_name'  => $row_order['buyer_name'] ,
						'buyer_email' => $row_order['buyer_email'],	
						'status'  => '20', 
						'add_time'      => gmtime(),
						'payment_id'  => $row_order['payment_id'],
						'payment_name' => $row_order['payment_name'],
						'payment_code' => $row_order['payment_code'],
						'goods_amount' => $row_order['goods_amount'],
			 
						'order_amount' => $row_order['order_amount'],
					 
					 
					 
					 
		            );
					
			$order_id =	$order_mod->add($data2);

		 
		
			$row_address = $order_extm_mod->find($tid );

			$row_address = current($row_address);
		 
			$data3 = array(
		                'order_id' => $order_id,
						'consignee' =>$row_address['consignee'],
						'region_id' =>$row_address['region_id'],
						'region_name' =>$row_address['region_name'],
						'address' => $row_address['address'] ,
						'phone_tel' =>$row_address['phone_tel'] ,
						'shipping_id' =>$row_address['shipping_id'],
						'shipping_name' => $row_address['shipping_name'],
					);

			$order_extm_mod->add($data3);

		 
			$name = $_POST['items'];
			foreach( $name as $key => $n ) {

					$data4 = array(
		                'order_id' => $order_id,
					 );
					
				$order_goods_mod->edit($n,$data4);
 				 
		   }
			$conditions ="order_id =".$order_id ;
			$row_good = $order_goods_mod->find(array(
		            'conditions' => $conditions,

		             
		           ));

		   $gtotal = 0;
		   foreach($row_good as $key => $values ) 
		   {
				$gtotal =$gtotal + ($row_good[$key]['quantity'] * $row_good[$key]['price_thai']);
		   }

		   $data4 = array(
		                'goods_amount' => $gtotal,
						'order_amount' => $gtotal,
					 );	
		   $order_mod->edit($order_id,$data4);


		   $conditions ="order_id =".$tid ;
		   $row_good_old = $order_goods_mod->find(array(
		            'conditions' => $conditions,

		             
		           ));

		   $gtotal_oldorder = 0;

		   foreach($row_good_old as $key => $values ) 
		   {
				$gtotal_oldorder = $gtotal_oldorder + ($row_good_old[$key]['quantity'] * $row_good_old[$key]['price_thai']);
		   }
		   $data6 = array(
		                'goods_amount' => $gtotal_oldorder,
						'order_amount' => $gtotal_oldorder,
					 );	
		   $order_mod->edit($tid,$data6 );	

	
			$userid = $this->visitor->get('user_id');
			$br_wallet_mod =& m('br_wallet'); 

			$wallet_in =$br_wallet_mod->_get_wallet_total_in($userid);
			$wallet_out =$br_wallet_mod->_get_wallet_total_out($userid);

			$wallet_total = $wallet_in - $wallet_out;

			if($wallet_total < $gtotal)
			{
				$this->show_warning('Wallet ของคุณไม่พอจ่าย');

            	return;
			}
			else
			{
				$balanc = $wallet_total - $gtotal;
				$data_wal = array(

					'member_id' =>$userid,
                	'wal_desc' =>'ซื้อสินค้า',
			  		'type'  => '2',
					'value'  =>$gtotal,
			 		'order_id'  =>$order_id,
					'gtotal'  => $balanc,
            	);
				$br_wallet_mod->add($data_wal);

 

				 

				$data7 = array(
		                 
						'status'  => '40', 
					 
						'payment_id'  => '2',
						'payment_name' => 'ชำระด้วย Wallet',
						'payment_code' => 'Wallet',
		 
					 
		            );
					
			  	$order_mod->edit($order_id,$data7);
				$this->show_message('ทำรายการเสร็จสิ้น','back_list','index.php?app=member&act=order' );
			 
			}
			

			
		}
	}
	function orderpaid()
    {
		if (IS_POST)
        {


			$order_id =  $_POST['orid'];
			$order_mod =& m('order');	
			$order_extm_mod =& m('orderextm');
			$order_goods_mod =& m('ordergoods');
 
			$conditions ="order_id =".$order_id ;
			$row_good = $order_goods_mod->find(array(
		            'conditions' => $conditions,

		             
		           ));

		   $gtotal = 0;
		   foreach($row_good as $key => $values ) 
		   {
				$gtotal =$gtotal + ($row_good[$key]['quantity'] * $row_good[$key]['price_thai']);
		   }

		   	

	
			$userid = $this->visitor->get('user_id');
			$br_wallet_mod =& m('br_wallet'); 

			$wallet_in =$br_wallet_mod->_get_wallet_total_in($userid);
			$wallet_out =$br_wallet_mod->_get_wallet_total_out($userid);

			$wallet_total = $wallet_in - $wallet_out;

			if($wallet_total < $gtotal)
			{
				$this->show_warning('Wallet ของคุณไม่พอจ่าย');

            	return;
			}
			else
			{

				$balanc = $wallet_total - $gtotal;
				$data_wal = array(

					'member_id' =>$userid,
                	'wal_desc' =>'ซื้อสินค้า',
			  		'type'  => '2',
					'value'  =>$gtotal,
			 		'order_id'  =>$order_id,
					'gtotal'  => $balanc,
            	);
				$br_wallet_mod->add($data_wal);

 				$user_mod =& m('member');
				
				$datauser = array(
	                'wallet' => $balanc	,
				);
	
				$user_mod->edit($userid ,$datauser);

				 

				$data7 = array(
		                 
						'status'  => '40', 
					 
						'payment_id'  => '2',
						'payment_name' => 'ชำระด้วย Wallet',
						'payment_code' => 'Wallet',
		 				'goods_amount' => $gtotal,
			 
						'order_amount' => $gtotal,
					 
		            );
					
			  	$order_mod->edit($order_id,$data7);
				$this->show_message('ทำรายการเสร็จสิ้น','back_list','index.php?app=member&act=order' );
			 
			}
			

		}

	}
	function wallet()
    {
		$ewallet_mod =& m('ewallet'); 
	  
		$user_id = $this->visitor->get('user_id');
		$conditions = "member_id = ".$user_id ;
		$wallet = $ewallet_mod->find(array(
		            'conditions' => $conditions,
		             
		           
		             
		        ));

		$this->assign('orders', $wallet);   
		$this->display('member.wallet.html');
		
	}
	function addwallet()
    {

		if (!IS_POST)
        {
	  
			$this->display('member.wallet_add.html');
		}
		else
		{
				$ewallet_mod =& m('ewallet'); 

				$user_id = $this->visitor->get('user_id');
				
				$user_mod =& m('member');
	        	$team = $user_mod->find($user_id);

				$team  =current($team) ;

				$amounttran =str_replace(",","",$_POST["amounttran"]);
				
				$data = array(
			 	'order_sn' => $ewallet_mod->_set_so_id(),
                'member_id' => $user_id ,
			 	'user_name' => $team["user_name"],
				'name' =>	$team["real_name"],
				'amount' => $amounttran,
				'transfer' => $amounttran,
				'user_add'  =>$user_id,
				'status' => 0,
				
				'datetran' =>  $_POST["datetran"],
				'timetran' =>  $_POST["timetran"],
				'amounttran' =>  $amounttran,
			    'banktran' =>  $_POST["banktran"],
				'remarktran' =>  $_POST["remarktran"],
			 
            );

 			$ewallet_mod->add($data);
			$this->show_message('บันทึกข้อมูลเรียบร้อย','back_list','index.php?app=member&act=wallet' );
		}
		
	}
	
	function getwallet()
    {
		$userid = $this->visitor->get('user_id');

		
		
		$br_wallet_mod =& m('br_wallet'); 

		$wallet_in =$br_wallet_mod->_get_wallet_total_in($userid);
		$wallet_out =$br_wallet_mod->_get_wallet_total_out($userid);

		$wallet_total = $wallet_in - $wallet_out;

 
		$this->json_result(array('res' => true, 
								 'wallet' =>  $wallet_total,
								 
			));
        exit;
	 
	}
	function reportwallet()
    {
		$br_wallet_mod =& m('br_wallet'); 
	  
		$user_id = $this->visitor->get('user_id');
		$conditions = "member_id = ".$user_id ;
		$wallet = $br_wallet_mod->find(array(
		            'conditions' => $conditions,
  					'order' => 'wallet_id asc',
		        ));

		$this->assign('orders', $wallet);   
		$this->display('member.report_wallet.html');
		
	}
	function _gen_order_sn2()
    {
         
        mt_srand((double) microtime() * 1000000);
        $timestamp = gmtime();
        $y = date('y', $timestamp);
        $z = date('z', $timestamp);
        $order_sn = $y . str_pad($z, 3, '0', STR_PAD_LEFT) . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

        $model_order =& m('order');
        $orders = $model_order->find('order_sn=' . $order_sn);
        if (empty($orders))
        {
             
            return $order_sn;
        }

         
        return $this->_gen_order_sn();
    }
}

?>