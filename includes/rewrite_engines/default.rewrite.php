<?php

/**
 *    默认Rewrite引擎
 *
 *    @author    Garbin
 *    @usage    none
 */

/*

##### Rewrite Rule #####

RewriteEngine On

#商品详情
RewriteRule ^goods/([0-9]+)/?$ index.php?app=goods&id=$1 [L]
RewriteRule ^goods/([0-9]+)/([^/]+)/?$ index.php?app=goods&id=$1&act=$2 [L]
RewriteRule ^goods/([0-9]+)/([^/]+)/page_([^/]+)/?$ index.php?app=goods&id=$1&act=$2&page=$3 [L]
RewriteRule ^groupbuy/([0-9]+)/?$ index.php?app=groupbuy&id=$1 [L]

#分类
RewriteRule ^category/goods/?$ index.php?app=category [L]
RewriteRule ^category/(.*)/?$ index.php?app=category&act=$1 [L]

#品牌
RewriteRule ^brand/?$ index.php?app=brand [L]

#文章
RewriteRule ^article/([0-9]+).html$ index.php?app=article&act=view&article_id=$1 [L]

#店铺页面
RewriteRule ^store/([0-9]+)/?$ index.php?app=store&id=$1 [L]
RewriteRule ^store/article/([0-9]+).html$ index.php?app=store&act=article&id=$1 [L]
RewriteRule ^store/([0-9]+)/credit/?$ index.php?app=store&id=$1&act=credit [L]
RewriteRule ^store/([0-9]+)/credit/page_([^/]+)/?$ index.php?app=store&id=$1&act=credit&page=$2 [L]
RewriteRule ^store/([0-9]+)/credit/([0-9]+)/?$ index.php?app=store&id=$1&act=credit&eval=$2 [L]
RewriteRule ^store/([0-9]+)/credit/([0-9]+)/page_([^/]+)/?$ index.php?app=store&id=$1&act=credit&eval=$2&page=$3 [L]
RewriteRule ^store/([0-9]+)/goods/?$ index.php?app=store&id=$1&act=search [L]
RewriteRule ^store/([0-9]+)/goods/page_([^/]+)/?$ index.php?app=store&id=$1&act=search&page=$2 [L]
RewriteRule ^store/([0-9]+)/category/([0-9]+)/?$ index.php?app=store&id=$1&act=search&cate_id=$2 [L]
RewriteRule ^store/([0-9]+)/category/([0-9]+)/page_([^/]+)/?$ index.php?app=store&id=$1&act=search&cate_id=$2&page=$3 [L]
RewriteRule ^store/([0-9]+)/groupbuy/?$ index.php?app=store&id=$1&act=groupbuy [L]
RewriteRule ^store/([0-9]+)/groupbuy/page_([^/]+)/?$ index.php?app=store&id=$1&act=groupbuy&page=$2 [L]

*/

class DefaultRewrite extends BaseRewrite
{
    /* Rewrite规则地图，记录参数对应的rule名称 */
    var $_rewrite_maps  = array(
        

         
        'store_id'  => 'store_index',

         
        'goods_id'  => 'goods_detail',
        'groupbuy_id'   => 'groupbuy_detail',

         
        'category'  => 'goods_cate',

         
        'brand'     => 'brand_list',
 
        'category_act' => 'store_cate',
 
        'article_act_id' => 'article_detail',
        'article_act_article_id' => 'article_detail',
 
        'store_act_id'  => REWRITE_RULE_FN,
        'store_act_id_page' => REWRITE_RULE_FN,
        'store_act_eval_id' => 'store_credit_eval',
        'store_act_eval_id_page'    => 'store_credit_eval_page',
        'store_act_cate_id_id'  => 'store_goodscate',
        'store_act_cate_id_id_page' => 'store_goodscate_page',
        'goods_act_id'      => 'goods_extra_info',
        'goods_act_id_page' => 'goods_extra_info_page',
		'user'  => 'user',

		
		'user_act_lag_sp_up'  => REWRITE_RULE_FN,
		'user_act'  => REWRITE_RULE_FN,
		'vip_act'  => REWRITE_RULE_FN,
		'admin'  => 'admin',
		'gcategory'  => 'gcategory',
		'goods'  => 'goods',
		'goods_act'  => REWRITE_RULE_FN,
		'ewallet'  => 'ewallet',
		'investment'  => 'investment',
		'order'  => 'order',
		'order_act'  => REWRITE_RULE_FN,
		'calculatecycle'  => 'calculatecycle',
	 
		'calculatecycle_act'  => REWRITE_RULE_FN,
		'default_act'  => REWRITE_RULE_FN,
		'ewallet_act'  => REWRITE_RULE_FN,
		'commission_act' => REWRITE_RULE_FN,
		'user_act_id_pass' => REWRITE_RULE_FN,
		'user_act_username' => REWRITE_RULE_FN, 
		'user_act_id' => REWRITE_RULE_FN,
	 
			
    );

    
    var $_rewrite_rules = array(
        'store_index'   => array(
            'rewrite'   => 'store/%id%',
        ),
        'goods_detail'  => array(
            'rewrite'   => 'goods/%id%',
        ),
        'goods_cate'    => array(
            'rewrite'   => 'category/goods',
        ),
        'brand_list'    => array(
            'rewrite'   => 'brand',
        ),
        'store_cate'    => array(
            'rewrite'   => 'category/%act%',
        ),
        'article_detail'    => array(
            'rewrite'   => 'article/%article_id%.html',
        ),
        'store_article' => array(
            'rewrite'   => 'store/article/%id%.html',
        ),
        'store_credit'  => array(
            'rewrite'   => 'store/%id%/credit',
        ),
        'store_credit_page'  => array(
            'rewrite'   => 'store/%id%/credit/page_%page%',
        ),
        'store_credit_eval'  => array(
            'rewrite'   => 'store/%id%/credit/%eval%',
        ),
        'store_credit_eval_page'    => array(
            'rewrite'   => 'store/%id%/credit/%eval%/page_%page%',
        ),
        'store_goodslist'   => array(
            'rewrite'   => 'store/%id%/goods',
        ),
        'store_goodslist_page'   => array(
            'rewrite'   => 'store/%id%/goods/page_%page%',
        ),
        'store_goodscate'   => array(
            'rewrite'   => 'store/%id%/category/%cate_id%',
        ),
        'store_goodscate_page'   => array(
            'rewrite'   => 'store/%id%/category/%cate_id%/page_%page%',
        ),
        'goods_extra_info' => array(
            'rewrite'   => 'goods/%id%/%act%',
        ),
        'goods_extra_info_page' => array(
            'rewrite'   => 'goods/%id%/%act%/page_%page%',
        ),
        'groupbuy_detail'   =>  array(
            'rewrite'   => 'groupbuy/%id%',
        ),
        'store_groupbuy'   =>  array(
            'rewrite'   => 'store/%id%/groupbuy',
        ),
        'store_groupbuy_page'   =>  array(
            'rewrite'   => 'store/%id%/groupbuy/page_%page%',
        ),
		'user'    => array(
            'rewrite'   => 'member',
        ),
		 
		'vip'    => array(
            'rewrite'   => 'vip',
        ),
		 
		'genealogy'    => array(
            'rewrite'   => 'binary',
        ),
		'sponsor'    => array(
            'rewrite'   => 'sponsor',
        ),
		'registerhost'    => array(
            'rewrite'   => 'registerhost',
        ),
		'noup'    => array(
            'rewrite'   => 'noup',
        ),
		'nosponser'    => array(
            'rewrite'   => 'nosponser',
        ),
		'vipposition'    => array(
            'rewrite'   => 'vipposition',
        ),
		'addpoint'    => array(
            'rewrite'   => 'addpoint',
        ),
	 	'admin'    => array(
            'rewrite'   => 'setadmin',
        ),
		'gcategory'    => array(
            'rewrite'   => 'category',
        ),
		'goods'    => array(
            'rewrite'   => 'product',
        ),	
	 
		'proadd'    => array(
            'rewrite'   => 'newproduct',
        ),
		'receive'    => array(
            'rewrite'   => 'receive',
        ),
		
		'ewallet'    => array(
            'rewrite'   => 'recharge',
        ),
		'investment'    => array(
            'rewrite'   => 'investment',
        ),
	
		'order'    => array(
            'rewrite'   => 'order',
        ),
		
		'makeorder'    => array(
            'rewrite'   => 'keyorder',
        ),

		'calculatecycle'    => array(
            'rewrite'   => 'cycle',
        ),
		'cycleb'    => array(
            'rewrite'   => 'cycleb',
        ),
		'logout'    => array(
            'rewrite'   => 'logout',
        ),
		'myaccount'    => array(
            'rewrite'   => 'myaccount',
        ),
		'indexsell'    => array(
            'rewrite'   => 'sell',
        ),
		'addrecharge'    => array(
            'rewrite'   => 'add-recharge',
        ),
		'billwallet'    => array(
            'rewrite'   => 'bill-recharge',
        ),

		'com-detail'    => array(
            'rewrite'   => 'com-detail',
        ),
		'register'    => array(
            'rewrite'   => 'register-%sp%-%lag%-%up%.html',
        ),
		'recomplete'    => array(
            'rewrite'   => 'complete-%id%-%pass%.html',
        ),
		'find-genealogy'    => array(
            'rewrite'   => 'find-genealogy_%username%.html',
        ),
		'submit-register'    => array(
            'rewrite'   => 'submit-register_%id%.html',
        ),
		'submit-ckkidcard'    => array(
            'rewrite'   => 'submit-idcard_%id%.html',
        ),
		'submit-ckkbank'    => array(
            'rewrite'   => 'submit-bank_%id%.html',
        ),
		
		
    );
	
	function rule_user_act_id($params)
    {
		$rule_name = '';
	 
        switch ($params['act'])
        {
			case 'ckkreg':
                $rule_name = 'submit-register';
            break;	
			case 'ckkidcard':
                $rule_name = 'submit-ckkidcard';
            break;
			case 'ckkbank':
                $rule_name = 'submit-ckkbank';
            break;
		
		 
		
 		}
		return $rule_name;
	}
	function rule_user_act_username($params)
    {
		$rule_name = '';
	 
        switch ($params['act'])
        {
			case 'genealogy':
                $rule_name = 'find-genealogy';
            break;	
		 
		
 		}
		return $rule_name;
	}
	function rule_commission_act($params)
    {
		$rule_name = '';
	 
        switch ($params['act'])
        {
			case 'detail':
                $rule_name = 'com-detail';
            break;	
		 
		
 		}
		return $rule_name;
	}
	
	
	function rule_user_act_id_pass($params)
    {
		$rule_name = '';
	 
        switch ($params['act'])
        {
		  
			case 'recomplete':
				
                $rule_name = 'recomplete';
            break;
 		}
		return $rule_name;
	}
	function rule_user_act_lag_sp_up($params)
    {
		$rule_name = '';
	 
        switch ($params['act'])
        {
		  
			case 'register':
				
                $rule_name = 'register';
            break;
 		}
		return $rule_name;
	}
	function rule_ewallet_act($params)
    {
		$rule_name = '';
	 
        switch ($params['act'])
        {
			case 'add':
                $rule_name = 'addrecharge';
            break;	
			case 'billwallet':
                $rule_name = 'billwallet';
            break; 
		
 		}
		return $rule_name;
	}
	function rule_default_act($params)
    {
		$rule_name = '';
	 
        switch ($params['act'])
        {
			case 'logout':
                $rule_name = 'logout';
            break;	 
		
 		}
		return $rule_name;
	}
	function rule_calculatecycle_act($params)
    {
		$rule_name = '';
	 
        switch ($params['act'])
        {
			case 'calculatecycleb':
                $rule_name = 'cycleb';
            break;	 
		
 		}
		return $rule_name;
	}
	function rule_order_act($params)
    {
		$rule_name = '';
	 
        switch ($params['act'])
        {
             
			
			case 'makeorder':
                $rule_name = 'makeorder';
            break;
			case 'indexsell':
                $rule_name = 'indexsell';
            break;
			  


		
 		}
		return $rule_name;
	}
	function rule_goods_act($params)
    {
		$rule_name = '';
	 
        switch ($params['act'])
        {
             
			
			case 'add':
                $rule_name = 'proadd';
            break;
			case 'receive':
                $rule_name = 'receive';
            break;
		
 		}
		return $rule_name;
	}
	function rule_vip_act($params)
    {
		$rule_name = '';
        switch ($params['act'])
        {
             

			case 'vipposition':
                $rule_name = 'vipposition';
            break;

			case 'addpoint':
                $rule_name = 'addpoint';
            break;
			
			
			
        }

        return $rule_name;
	}

    function rule_user_act($params)
    {
	 
        $rule_name = '';
        switch ($params['act'])
        {
            case 'genealogy':
                $rule_name = 'genealogy';
            break;
            case 'sponsor':
                $rule_name = 'sponsor';
            break;
            case 'registerhost':
                $rule_name = 'registerhost';
            break;
            case 'noup':
                $rule_name = 'noup';
            break;

			 case 'nosponser':
                $rule_name = 'nosponser';
            break;

			case 'myaccount':
                $rule_name = 'myaccount';
            break;
			
			 
			
			
		
			
        }
		
        return $rule_name;
    }

	function rule_store_act_id($params)
    {
        $rule_name = '';
        switch ($params['act'])
        {
            case 'article':
                $rule_name = 'store_article';
            break;
            case 'credit':
                $rule_name = 'store_credit';
            break;
            case 'search':
                $rule_name = 'store_goodslist';
            break;
            case 'groupbuy':
                $rule_name = 'store_groupbuy';
            break;
			
			
        }

        return $rule_name;
    }
    function rule_store_act_id_page($params)
    {
        $rule_name = '';
        switch ($params['act'])
        {
            case 'credit':
                $rule_name = 'store_credit_page';
            break;
            case 'search':
                $rule_name = 'store_goodslist_page';
            break;
            case 'groupbuy':
                $rule_name = 'store_groupbuy_page';
            break;
        }

        return $rule_name;
    }
}

?>
