<?php
 
define('THUMB_WIDTH', 300);
define('THUMB_HEIGHT', 300);
define('THUMB_QUALITY', 85);

class GoodsApp extends BackendApp
{
   
	var $_menu_mod;	
	 var $_goods_mod;
    var $_spec_mod;
    var $_image_mod;
    var $_uploadedfile_mod;
    var $_store_id;
    var $_brand_mod;
    var $_last_update_id;

    function __construct()
    {
        $this->GoodsApp();
    }
    function GoodsApp()
    {
        parent::BackendApp();

        $this->_goods_mod =& m('goods');
		$this->_menu_mod =& m('menuleft');
		 
        $this->_spec_mod  =& m('goodsspec');
        $this->_image_mod =& m('goodsimage');
        $this->_uploadedfile_mod =& m('uploadedfile');
    }
 
    function index()
    {
        
     
         
         
        $sort  = 'goods_id';
        $order = 'desc';
     
	 
	
        $page = $this->_get_page();
        $goods_list = $this->_goods_mod->get_list_admin(array(
            'conditions' => "1 = 1  "  ,
             'count'         => true,
            'order' => "$sort $order",
            
        ));
        foreach ($goods_list as $key => $goods)
        {
            $goods_list[$key]['cate_name'] = $this->_goods_mod->format_cate_name($goods['cate_name']);
        }
        $this->assign('goods_list', $goods_list);

        $page['item_count'] = $this->_goods_mod->getCount();
        $this->_format_page($page);
        $this->assign('page_info', $page);

         
		$this->assign('menus_left', $this->_menu_mod->set_menu('Product'));

        $cate_mod =& bm('gcategory', array('_store_id' => 0));
        $this->assign('gcategories', $cate_mod->get_options(0, true));
        //$this->import_resource(array('script' => 'mlselection.js,inline_edit.js'));
        $this->assign('enable_radar', Conf::get('enable_radar'));
        $this->display('goods.index.html');
    }

   
    function recommend()
    {
        if (!IS_POST)
        {
            
            $recommend_mod =& bm('recommend', array('_store_id' => 0));
            $recommends = $recommend_mod->get_options();
            if (!$recommends)
            {
                $this->show_warning('no_recommends', 'go_back', 'javascript:history.go(-1);', 'set_recommend', 'index.php?app=recommend');
                return;
            }
            $this->assign('recommends', $recommends);
            $this->display('goods.batch.html');
        }
        else
        {
            $id = isset($_POST['id']) ? trim($_POST['id']) : '';
            if (!$id)
            {
                $this->show_warning('Hacking Attempt');
                return;
            }

            $recom_id = empty($_POST['recom_id']) ? 0 : intval($_POST['recom_id']);
            if (!$recom_id)
            {
                $this->show_warning('recommend_required');
                return;
            }

            $ids = explode(',', $id);
            $recom_mod =& bm('recommend', array('_store_id' => 0));
            $recom_mod->createRelation('recommend_goods', $recom_id, $ids);
            $ret_page = isset($_GET['ret_page']) ? intval($_GET['ret_page']) : 1;
            $this->show_message('recommend_ok',
                'back_list', 'index.php?app=goods&page=' . $ret_page,
                'view_recommended_goods', 'index.php?app=recommend&amp;act=view_goods&amp;id=' . $recom_id);
        }
    }

  
    function edit()
    {
		$id = empty($_GET['id']) ? 0 : intval($_GET['id']);
        if (!IS_POST)
        {
             /* 传给iframe id */
            $this->assign('id', $id);
            $this->assign('belong', BELONG_GOODS);
            if(!$id || !($goods = $this->_get_goods_info($id)))
            {
                $this->show_warning('no_such_goods');
                return;
            }
            $goods['tags'] = trim($goods['tags'], ',');
            $this->assign('goods', $goods);
            /* 取到商品关联的图片 */
            $uploadedfiles = $this->_uploadedfile_mod->find(array(
                'fields' => "f.*,goods_image.*",
                'conditions' => "store_id=0 AND belong=".BELONG_GOODS." AND item_id=".$id,
                'join'       => 'belongs_to_goodsimage',
                'order' => 'add_time ASC'
            ));
            $default_goods_images = array(); // 默认商品图片
            $other_goods_images = array(); // 其他商品图片
            $desc_images = array(); // 描述图片
            /*if (!empty($goods['default_image']))
            {
                   $goods_images
            }*/
            foreach ($uploadedfiles as $key => $uploadedfile)
            {
                if ($uploadedfile['goods_id'] == null)
                {
                    $desc_images[$key] = $uploadedfile;
                }
                else
                {
                    if (!empty($goods['default_image']) && ($uploadedfile['thumbnail'] == $goods['default_image']))
                    {
                        $default_goods_images[$key] = $uploadedfile;
                    }
                    else
                    {
                        $other_goods_images[$key] = $uploadedfile;
                    }
                }
            }

			 $this->assign('mgcategories', $this->_get_mgcategory_options($goods['cate_id']));
            $this->assign('goods_images', array_merge($default_goods_images, $other_goods_images));
            $this->assign('desc_images', $desc_images);
			$this->display('my_goods_edit.form.html');
        }
        else
        {
           
             
            $data = $this->_get_post_data($id);

            /* 检查数据 */
            if (!$this->_check_post_data($data, $id))
            {
                $this->show_warning($this->get_error());
                return;
            }
            /* 保存商品 */
            if (!$this->_save_post_data($data, $id))
            {
                $this->show_warning($this->get_error());
                return;
            }

            $this->show_message('edit_ok',
                'back_list', 'index.php?app=goods' );
                 
             
        }
    }
	function _get_mgcategory_options($cat_id)
    {
        $res ="";
        $mod =& bm('gcategory', array('_store_id' => 0));
        $gcategories = $mod->get_list($parent_id, true);
        foreach ($gcategories as $gcategory)
        {
			$chkk ="";
			if($gcategory['cate_id'] == $cat_id)
			{
				$chkk ="selected";
			}
			$res .="<option  ".$chkk." value='".$gcategory['cate_id']."'>".$gcategory['cate_name'] ."</option>\n	";
            
        }
        return $res;
    }
    
   function ajax_col()
   {
       $id     = empty($_GET['id']) ? 0 : intval($_GET['id']);
       $column = empty($_GET['column']) ? '' : trim($_GET['column']);
       $value  = isset($_GET['value']) ? trim($_GET['value']) : '';
       $data   = array();

       if (in_array($column ,array('goods_name', 'brand', 'closed')))
       {
           $data[$column] = $value;
           $this->_goods_mod->edit($id, $data);
           if(!$this->_goods_mod->has_error())
           {
               echo ecm_json_encode(true);
           }
       }
       else
       {
           return ;
       }
       return ;
   }
 
    function drop()
    {
        if (!IS_POST)
        {
            $this->display('goods.batch.html');
        }
        else
        {
            $id = isset($_POST['id']) ? trim($_POST['id']) : '';
            if (!$id)
            {
                $this->show_warning('Hacking Attempt');
                return;
            }
            $ids = explode(',', $id);

            // notify store owner
            $ms =& ms();
            $goods_list = $this->_goods_mod->find(array(
                "conditions" => $ids,
                "fields" => "goods_name, store_id",
            ));
            foreach ($goods_list as $goods)
            {
                //$content = sprintf(LANG::get('toseller_goods_droped_notify'), );
                $content = get_msg('toseller_goods_droped_notify', array('reason' => trim($_POST['drop_reason']),
                    'goods_name' => addslashes($goods['goods_name'])));
                $ms->pm->send(MSG_SYSTEM, $goods['store_id'], '', $content);
            }

            // drop
            $this->_goods_mod->drop_data($ids);
            $this->_goods_mod->drop($ids);
            $ret_page = isset($_GET['ret_page']) ? intval($_GET['ret_page']) : 1;
            $this->show_message('drop_ok',
                'back_list', 'index.php?app=goods&page=' . $ret_page);
        }
    }
	function add()
    {

        if (!IS_POST)
        {
			 $this->assign('mgcategories', $this->_get_mgcategory_options(0));
             $this->assign('menus_left', $this->_menu_mod->set_menu('Product'));
             $this->display('my_goods.form.html');
        }
		else
		{
			$data = $this->_get_post_data(0);
			if (!$this->_check_post_data($data, 0))
            {
                $this->show_warning($this->get_error());
                return;
            }
			if (!$this->_save_post_data($data, 0))
            {
                $this->show_warning($this->get_error());
                return;
            }
			 
			$url ="index.php?app=goods";
		 
			$this->show_message('add_ok',
            'back_list', $url);
		}

        
    }
	 

	function _check_post_data($data, $id = 0)
    {
         
         
        if ($data['goods']['spec_qty'] == 1 && empty($data['goods']['spec_name_1'])
                  || $data['goods']['spec_qty'] == 2 && (empty($data['goods']['spec_name_1']) || empty($data['goods']['spec_name_2'])))
        {
            $this->_error('fill_spec_name');
            return false;
        }
        if (empty($data['specs']))
        {
            $this->_error('fill_spec');
            return false;
        }

        return true;
    }

	function _save_post_data($data, $id = 0)
    {
        import('image.func');
        import('uploader.lib');

        if ($data['goods']['tags'])
        {
            $data['goods']['tags'] = $this->_format_goods_tags($data['goods']['tags']);
        }
 
        if ($id > 0)
        {
            // edit
            if (!$this->_goods_mod->edit($id, $data['goods']))
            {
                $this->_error($this->_goods_mod->get_error());
                return false;
            }

            $goods_id = $id;
        }
        else
        {
            // add
            $goods_id = $this->_goods_mod->add($data['goods']);
            if (!$goods_id)
            {
                $this->_error($this->_goods_mod->get_error());
                return false;
            }
            if (($data['goods_file_id'] || $data['desc_file_id'] ))
            {
                $uploadfiles = array_merge($data['goods_file_id'], $data['desc_file_id']);
                $this->_uploadedfile_mod->edit(db_create_in($uploadfiles, 'file_id'), array('item_id' => $goods_id));
            }
            if (!empty($data['goods_file_id']))
            {
                $this->_image_mod->edit(db_create_in($data['goods_file_id'], 'file_id'), array('goods_id' => $goods_id));
            }
        }
       
        if ($id > 0)
        {
             
            $goods_specs = $this->_spec_mod->find(array(
                'conditions' => "goods_id = '{$id}'",
                'fields' => 'spec_id'
            ));
            $drop_spec_ids = array_diff(array_keys($goods_specs), array_keys($data['specs']));
            if (!empty($drop_spec_ids))
            {
                $this->_spec_mod->drop($drop_spec_ids);
            }

        }
        $default_spec = array(); // 初始化默认规格
        foreach ($data['specs'] as $key => $spec)
        {
            if ($spec_id = $spec['spec_id']) // 更新已有规格ID
            {
                $this->_spec_mod->edit($spec_id,$spec);
            }
            else // 新加规格ID
            {
                $spec['goods_id'] = $goods_id;
                $spec_id = $this->_spec_mod->add($spec);
            }
            if (empty($default_spec))
            {
                $default_spec = array('default_spec' => $spec_id, 'price' => $spec['price']);
            }
        }
 
        $this->_goods_mod->edit($goods_id, $default_spec);
        if ($this->_goods_mod->has_error())
        {
            $this->_error($this->_goods_mod->get_error());
            return false;
        }

    
        $this->_goods_mod->unlinkRelation('belongs_to_gcategory', $goods_id);
        if ($data['cates'])
        {
            $this->_goods_mod->createRelation('belongs_to_gcategory', $goods_id, $data['cates']);
        }

        $default_image = $this->_upload_image($goods_id);
         
		if($default_image)
		{
	        $this->_goods_mod->edit($goods_id, array(
	            'default_image' => $default_image  ,
	        ));
		}

        $this->_last_update_id = $goods_id;

        return true;
    }
	
	function _get_post_data($id = 0)
    {
        $goods = array(
            'goods_name'       => $_POST['goods_name'],
			'good_code'      => trim($_POST['good_code']),
            'description'      => $_POST['description'],
            'cate_id'             => $_POST['cate_id'],
            'cate_name'        => $_POST['cate_name'],
            'brand'                  => $_POST['brand'],
            'if_show'             => $_POST['if_show'],
            'last_update'      => gmtime(),
            'recommended'      => $_POST['recommended'],
            'tags'             => trim($_POST['tags']),
			'price'             => trim($_POST['price']),
			
        );
        $spec_name_1 = !empty($_POST['spec_name_1']) ? $_POST['spec_name_1'] : '';
        $spec_name_2 = !empty($_POST['spec_name_2']) ? $_POST['spec_name_2'] : '';
        if ($spec_name_1 && $spec_name_2)
        {
            $goods['spec_qty'] = 2;
        }
        elseif ($spec_name_1 || $spec_name_2)
        {
            $goods['spec_qty'] = 1;
        }
        else
        {
            $goods['spec_qty'] = 0;
        }

        $goods_file_id = array();
        $desc_file_id =array();
        if (isset($_POST['goods_file_id']))
        {
            $goods_file_id = $_POST['goods_file_id'];
        }
        if (isset($_POST['desc_file_id']))
        {
            $desc_file_id = $_POST['desc_file_id'];
        }
        if ($id <= 0)
        {
            $goods['type'] = 'material';
            $goods['closed'] = 0;
            $goods['add_time'] = gmtime();
        }

        $specs = array(); // 原始规格
        switch ($goods['spec_qty'])
        {
            case 0: // 没有规格
                $specs[intval($_POST['spec_id'])] = array(
                    'price' => $this->_filter_price($_POST['price']),
                    'stock' => intval($_POST['stock']),
                    'sku'      => trim($_POST['sku']),
					'pv'      => trim($_POST['pv']),
				 
                    'spec_id'  => trim($_POST['spec_id']),
                );
                break;
            
            default:
                break;
        }

 

        return array('goods' => $goods, 'specs' => $specs, 'cates' => $cates, 'goods_file_id' => $goods_file_id, 'desc_file_id' => $desc_file_id);
    }
	 function _filter_price($price)
    {
        return abs(floatval($price));
    }
	function _get_goods_info($id = 0)
    {
        $default_goods_image = Conf::get('default_goods_image'); // 商城默认商品图片
        if ($id > 0)
        {
            $goods_info = $this->_goods_mod->get_info($id);
            if ($goods_info === false)
            {
                return false;
            }
            $goods_info['default_goods_image'] = $default_goods_image;
            if (empty($goods_info['default_image']))
            {
                   $goods_info['default_image'] = $default_goods_image;
            }
        }
        else
        {
            $goods_info = array(
                'cate_id' => 0,
                'if_show' => 1,
                'recommended' => 1,
                'price' => 1,
                'stock' => 1,
                'spec_qty' => 0,
                'spec_name_1' => Lang::get('color'),
                'spec_name_2' => Lang::get('size'),
                'default_goods_image' => $default_goods_image,
            );
        }
        $goods_info['spec_json'] = ecm_json_encode(array(
            'spec_qty' => $goods_info['spec_qty'],
            'spec_name_1' => isset($goods_info['spec_name_1']) ? $goods_info['spec_name_1'] : '',
            'spec_name_2' => isset($goods_info['spec_name_2']) ? $goods_info['spec_name_2'] : '',
            'specs' => $goods_info['_specs'],
        ));
        return $goods_info;
    }
	function _upload_image($goods_id)
    {
        import('image.func');
        import('uploader.lib');
        $uploader = new Uploader();
        $uploader->allowed_type(IMAGE_FILE_TYPE);
        $uploader->allowed_size(SIZE_GOODS_IMAGE); // 400KB

        
        
        $upload_mod =& m('uploadedfile');
        $remain        = $settings['space_limit'] > 0 ? $settings['space_limit'] * 1024 * 1024 - $upload_mod->get_file_size($this->_store_id) : false;

        $files = $_FILES['goods_file_id'];
        foreach ($files['error'] as $key => $error)
        {
            if ($error == UPLOAD_ERR_OK)
            {
                /* 处理文件上传 */
                $file = array(
                    'name'            => $files['name'][$key],
                    'type'            => $files['type'][$key],
                    'tmp_name'  => $files['tmp_name'][$key],
                    'size'            => $files['size'][$key],
                    'error'        => $files['error'][$key]
                );
                $uploader->addFile($file);
                if (!$uploader->file_info())
                {
                    $this->_error($uploader->get_error());
                    return false;
                }

                /* 判断能否上传 */
                if ($remain !== false)
                {
                    if ($remain < $file['size'])
                    {
                        $this->_error('space_limit_arrived');
                        return false;
                    }
                    else
                    {
                        $remain -= $file['size'];
                    }
                }

                $uploader->root_dir(ROOT_PATH);
                $dirname      = 'data/files/admin_pro/goods_' . (time() % 200);
                $filename  = $uploader->random_filename();
                $file_path = $uploader->save($dirname, $filename);
                $thumbnail = dirname($file_path) . '/small_' . basename($file_path);
                make_thumb(ROOT_PATH . '/' . $file_path, ROOT_PATH . '/' . $thumbnail, THUMB_WIDTH, THUMB_HEIGHT, THUMB_QUALITY);

                /* 处理文件入库 */
                $data = array(
                    'store_id'  => $this->_store_id,
                    'file_type' => $file['type'],
                    'file_size' => $file['size'],
                    'file_name' => $file['name'],
                    'file_path' => $file_path,
                    'add_time'  => gmtime(),
                );
                $uf_mod =& m('uploadedfile');
                $file_id = $uf_mod->add($data);
                if (!$file_id)
                {
                    $this->_error($uf_mod->get_error());
                    return false;
                }

                /* 处理商品图片入库 */
                $data = array(
                    'goods_id'      => $goods_id,
                    'image_url'  => $file_path,
                    'thumbnail'  => $thumbnail,
                    'sort_order' => 255,
                    'file_id'       => $file_id,
                );
                if (!$this->_image_mod->add($data))
                {
                    $this->_error($this->_image_mod->get_error());
                    return false;
                }
            }
        }

        return $thumbnail;
    }
	function receive()
    {
		$this->_menu_mod =& m('menuleft');
		$this->assign('menus_left', $this->_menu_mod->set_menu('Product'));
		$receive_mod =& m('receive');	

		  
        $sort  = 'order_id';
        $order = 'desc';
     
	 
		$order =$receive_mod->find(array(
                     
                    'order' => "$sort $order",
                ));
         
         


		$this->assign('orders', $order );
		$this->display('receive.index.html');
	}
	function receiveitem()
    {
		
		$this->_menu_mod =& m('menuleft');
		$this->assign('menus_left', $this->_menu_mod->set_menu('Product'));
		

 
		 

		 $goods_mod =& m('goods');
		$sort  = 'goods_id';
        $order = 'asc';
      
        $goods_list = $goods_mod->get_list_admin(array(
            'conditions' => "1 = 1 and g.if_show = 1 "  ,
            'order' => "$sort $order",
           
        ));
         
        $this->assign('goods_list', $goods_list);
		 
		
	 	 
      	  
		$this->display('receive.form.html');
	}
	function submitorder()
    {

		 
		$cart_model =& m('cart_re');

        $cart_items      =  $cart_model->find(array(
                    'conditions' => " session_id='" . SESS_ID . "'",
                    'join'       => 'belongs_to_goodsspec',
                ));

		$receive_model =& m('receive');	
		$receive_goods_model =& m('receive_goods');	
		$br_stock_model =& m('br_stock');	
	
		
		$get_id = $this->visitor->get('user_id');
		$data = array(
                 
                'date'     => $_POST['date'],
                'remark'     => $_POST['remark'],
                'user_id'   =>$get_id,
                 
                 
            );

		$recive_id=  $receive_model->add($data);
		foreach ($cart_items as $key => $value)
        {
		 
			$data2 = array(
	                 
	                'order_id'     => $recive_id,
	                'goods_id'     => $cart_items[$key]['goods_id'],
	                'goods_name'   => $cart_items[$key]['goods_name'],
					'spec_id'   => $cart_items[$key]['spec_id'],
					'price'   => $cart_items[$key]['price'],
	                'quantity'   => $cart_items[$key]['quantity'],
					'goods_image'   => $cart_items[$key]['goods_image'],
	                 
	            );
	
			$receive_goods_model->add($data2 );

			
			$data3 = array(
	                 
	                'order_id'     => $recive_id,
	                'goods_id'     => $cart_items[$key]['goods_id'],
	                'stock_name'   => "Recive Order ID >> " .$recive_id,
	                'value'   => $cart_items[$key]['quantity'],
					'date'   => $_POST['date'],
					'type'   => '1',
	                 
	            );

		 	$br_stock_model->add($data3);
		}
		$cart_model->drop(" session_id='" . SESS_ID . "'");
		$this->show_message('add_ok', 'back_list',    'index.php?app=goods&act=receiveitem' );


	}
	function deltable()
    {
		if (IS_POST)
        { 
	        $rec_id   = isset($_POST['rec_id']) ? intval($_POST['rec_id']) : 0;
			$cart_model =& m('cart_re');
			$cart_model->drop($rec_id);
			$this->get_table();
		}
	}
	function add2()
    {
	    
		if (IS_POST)
        { 
	        $spec_id   = isset($_POST['spec_id']) ? intval($_POST['spec_id']) : 0;
	        $quantity   = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
			$store_id   = isset($_POST['store_id']) ? intval($_POST['store_id']) : 0;
			$user_id   = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
	        
	      
	        $spec_model =& m('goodsspec');
	        $spec_info  =  $spec_model->get(array(
	            'fields'        => 'g.store_id, g.goods_id, g.goods_name, g.spec_name_1, g.spec_name_2, g.default_image, gs.spec_1, gs.spec_2, gs.stock, gs.price',
	            'conditions'    => $spec_id,
	            'join'          => 'belongs_to_goods',
	        ));
	
	      
	        $spec_info['store_id']  =$store_id;
	        
	
	         
	        $model_cart =& m('cart_re');
	        $item_info  = $model_cart->get("spec_id={$spec_id} AND session_id='" . SESS_ID . "'");
	         
	
	   
	
	        $spec_1 = $spec_info['spec_name_1'] ? $spec_info['spec_name_1'] . ':' . $spec_info['spec_1'] : $spec_info['spec_1'];
	        $spec_2 = $spec_info['spec_name_2'] ? $spec_info['spec_name_2'] . ':' . $spec_info['spec_2'] : $spec_info['spec_2'];
	
	        $specification = $spec_1 . ' ' . $spec_2;
	 
	        $cart_item = array(
	            'user_id'       => $user_id ,
	            'session_id'    => SESS_ID,
	            'store_id'      => $spec_info['store_id'],
	            'spec_id'       => $spec_id,
	            'goods_id'      => $spec_info['goods_id'],
	            'goods_name'    => addslashes($spec_info['goods_name']),
	            'specification' => addslashes(trim($specification)),
	            'price'         => $spec_info['price'],
	            'quantity'      => $quantity,
	            'goods_image'   => addslashes($spec_info['default_image']),
	        );
	
	         
	        $cart_model =&  m('cart_re');
	        $cart_model->add($cart_item);
 			$this->get_table2();
       	 }
    }
	
	function get_table2()
    {

		$link   = isset($_POST['link']) ? intval($_POST['link']) : 0;
		$sort  = 'rec_id';
        $order = 'ASC';
		$cart_model =& m('cart_re');
        $cart_items = $cart_model->find(array(
            'conditions'    => 'session_id = \'' . SESS_ID . "'"  ,
            'fields'        => 'this.*,store.store_name',
            'join'          => 'belongs_to_store',
			'order'         => "$sort $order",
        ));

 
	

	 	echo "<div class=\"col-sm-12\">\n";
			
		echo "<table class=\"table table-striped table-bordered table-hover table-full-width\" id=\"sample_1\"  >\n";
		echo "<thead>\n";
		echo "<tr role='row'  class='th' align='center'  bgcolor='#00BFFF' >\n";
		echo "<th style='width: 37px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting_asc'>No</th>\n";
		echo "<th style='width: 120px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>Image</th>\n";
		echo "<th style='width: 120px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>Code Product</th>\n";
		echo "<th style='width: 300px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>Detail</th>\n";
		echo "<th style='width: 90px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>Price</th>\n";
		echo "<th style='width: 90px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>PV</th> \n";
		echo "<th style='width: 90px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>Qty. </th> \n";
		echo "<th style='width: 90px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>Total</th> \n";
		echo "<th style='width: 90px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>Action</th> \n";
 
		
		echo "</thead>\n";
		$g_total =0;
		$g_total_pv =0;
		$row_s = 1;	
		$goods_mod =& m('goods');

		 
		foreach ($cart_items as $item)
        {
              
			$goods_list = $goods_mod->get_info($item['goods_id']);
			
            $item['subtotal']   = $item['price'] * $item['quantity'];
			$g_total_pv = $g_total_pv + (  $goods_list['_specs'][0]['pv'] * $item['quantity']);
			$g_total =$g_total + $item['subtotal'] ;
				echo "<tr class='odd' align='center'>\n";
				echo "<td>".$row_s."</td>\n";
				echo "<td><img src='".SITE_URL .$goods_list['default_image'] ."' width='50'></td>\n";
				echo "<td>".$goods_list[$item['goods_id']]['good_code'] ."</td>\n";
				echo "<td>".$item['goods_name']."</td>\n";
				echo "<td>".number_format($item['price'],2)."</td>\n";
				echo "<td>".$goods_list['_specs'][0]['pv']."</td>\n";
				echo "<td>".number_format($item['quantity'],2)."</td>\n";
				echo "<td>".number_format($item['subtotal'],2)."</td>\n";
			 
				echo "<td><a href=\"javascript:del_table('".$item['rec_id']."');\" >Delete</a></td>\n";
				echo "</tr>\n";

				$row_s++;
             
        }

	
				echo "<tr  class='odd' align='center'>\n";
				echo "<td> </td>\n";
				echo "<td></td>\n";
				echo "<td></td>\n";
				echo "<td></td>\n";
				echo "<td><b>Total</b></td>\n";
				echo "<td><b>".number_format($g_total_pv,2)." </b></td>\n";
				echo "<td></td>\n";
				echo "<td><b>".number_format($g_total,2)."</b></td>\n";
				if($link)
				{
						echo "<td><input id='ckktotal' type='hidden' value='".$g_total."'></td>\n";
				} 
				else
				{
					echo "<td><input id='ckktotal' type='hidden' value='".$g_total."'><a href=\"javascript:checkout();\" id=\"checkout\"   class=\"btn btn-blue next-step btn-block\" tabindex=20    > Check Out <i class=\"fa fa-arrow-circle-right\"></i>  </a></td>\n";
				}

				
			 	echo "</tr>\n";
				 
	}
	function canclebill()
    {
		if (IS_POST)
        {
		 	$order = $_POST['order'];
			$receive_mod =& m('receive');

			$receive_mod->edit($order, array('status' => '0'));
			
			$br_stock_mod =& m('br_stock');
	
			$br_stock_mod->edit("order_id=".$order , array('status' => '0'));
			$this->show_message('cancal_ok');
		}
		
	}
	function addtoset()
    {
	    
		if (IS_POST)
        { 
	        $spec_id   = isset($_POST['spec_id']) ? intval($_POST['spec_id']) : 0;
	        $quantity   = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
			$store_id   = isset($_POST['store_id']) ? intval($_POST['store_id']) : 0;
			$user_id   = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
	        
	      
	        $spec_model =& m('goodsspec');
	        $spec_info  =  $spec_model->get(array(
	            'fields'        => 'g.store_id, g.goods_id, g.goods_name, g.spec_name_1, g.spec_name_2, g.default_image, gs.spec_1, gs.spec_2, gs.stock, gs.price',
	            'conditions'    => $spec_id,
	            'join'          => 'belongs_to_goods',
	        ));
	
	      
	        $spec_info['store_id']  =$store_id;
	        
	
	         
	        $model_cart =& m('cart');
	        $item_info  = $model_cart->get("spec_id={$spec_id} AND session_id='" . SESS_ID . "'");
	         
	
	   
	
	        $spec_1 = $spec_info['spec_name_1'] ? $spec_info['spec_name_1'] . ':' . $spec_info['spec_1'] : $spec_info['spec_1'];
	        $spec_2 = $spec_info['spec_name_2'] ? $spec_info['spec_name_2'] . ':' . $spec_info['spec_2'] : $spec_info['spec_2'];
	
	        $specification = $spec_1 . ' ' . $spec_2;
	 
	        $cart_item = array(
	            'user_id'       => $user_id ,
	            'session_id'    => SESS_ID,
	            'store_id'      => $spec_info['store_id'],
	            'spec_id'       => $spec_id,
	            'goods_id'      => $spec_info['goods_id'],
	            'goods_name'    => addslashes($spec_info['goods_name']),
	            'specification' => addslashes(trim($specification)),
	            'price'         => $spec_info['price'],
	            'quantity'      => $quantity,
	            'goods_image'   => addslashes($spec_info['default_image']),
	        );
	
	         
	        $cart_model =&  m('cart');
	        $cart_model->add($cart_item);
 			$this->get_table();
       	 }
    }
	function get_table()
    {

		$link   = isset($_POST['link']) ? intval($_POST['link']) : 0;
		$sort  = 'rec_id';
        $order = 'ASC';
		$cart_model =& m('cart');
        $cart_items = $cart_model->find(array(
            'conditions'    => 'session_id = \'' . SESS_ID . "'"  ,
            'fields'        => 'this.*,store.store_name',
            'join'          => 'belongs_to_store',
			'order'         => "$sort $order",
        ));

 
	

	 	echo "<div class=\"col-sm-12\">\n";
			
		echo "<table class=\"table table-striped table-bordered table-hover table-full-width\" id=\"sample_1\"  >\n";
		echo "<thead>\n";
		echo "<tr role='row'  class='th' align='center'  bgcolor='#00BFFF' >\n";
		echo "<th style='width: 37px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting_asc'>No</th>\n";
		echo "<th style='width: 120px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>Image</th>\n";
		echo "<th style='width: 120px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>Code Product</th>\n";
		echo "<th style='width: 300px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>Detail</th>\n";
		echo "<th style='width: 90px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>Price</th>\n";
		echo "<th style='width: 90px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>PV</th> \n";
		echo "<th style='width: 90px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>Qty. </th> \n";
		echo "<th style='width: 90px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>Total</th> \n";
		echo "<th style='width: 90px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' class='sorting'>Action</th> \n";
 
		
		echo "</thead>\n";
		$g_total =0;
		$g_total_pv =0;
		$row_s = 1;	
		$goods_mod =& m('goods');

		 
		foreach ($cart_items as $item)
        {
              
			$goods_list = $goods_mod->get_info($item['goods_id']);
			
            $item['subtotal']   = $item['price'] * $item['quantity'];
			$g_total_pv = $g_total_pv + (  $goods_list['_specs'][0]['pv'] * $item['quantity']);
			$g_total =$g_total + $item['subtotal'] ;
				echo "<tr class='odd' align='center'>\n";
				echo "<td>".$row_s."</td>\n";
				echo "<td><img src='".SITE_URL .$goods_list['default_image'] ."' width='50'></td>\n";
				echo "<td>".$goods_list[$item['goods_id']]['good_code'] ."</td>\n";
				echo "<td>".$item['goods_name']."</td>\n";
				echo "<td>".number_format($item['price'],2)."</td>\n";
				echo "<td>".$goods_list['_specs'][0]['pv']."</td>\n";
				echo "<td>".number_format($item['quantity'],2)."</td>\n";
				echo "<td>".number_format($item['subtotal'],2)."</td>\n";
			 
				echo "<td><a href=\"javascript:del_table('".$item['rec_id']."');\" >Delete</a></td>\n";
				echo "</tr>\n";

				$row_s++;
             
        }

	
				echo "<tr  class='odd' align='center'>\n";
				echo "<td> </td>\n";
				echo "<td></td>\n";
				echo "<td></td>\n";
				echo "<td></td>\n";
				echo "<td><b>Total</b></td>\n";
				echo "<td><b>".number_format($g_total_pv,2)." </b></td>\n";
				echo "<td></td>\n";
				echo "<td><b>".number_format($g_total,2)."</b></td>\n";
				if($link)
				{
						echo "<td><input id='ckktotal' type='hidden' value='".$g_total."'></td>\n";
				} 
				else
				{
					echo "<td><input id='ckktotal' type='hidden' value='".$g_total."'><a href=\"javascript:checkout();\" id=\"checkout\"   class=\"btn btn-blue next-step btn-block\" tabindex=20    > Update <i class=\"fa fa-arrow-circle-right\"></i>  </a></td>\n";
				}

				
			 	echo "</tr>\n";
				 
	}
}

?>
