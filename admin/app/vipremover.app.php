<?php

 
class VipremoverApp extends BackendApp
{
    

    function __construct()
    {
        $this->VipremoverApp();
    }

    function VipremoverApp()
    {
        parent::__construct();
         
    }

    function index()
    {
		
	//$this->_reindex();
        $this->show_message('remove_ok');
    }
	function _reindex()
    {
		$address_mod =& m('address');
 		$address_mod->drop(" addr_id > 0 ");

		$bravo_binary_mod =& m('bravo_binary');
		$bravo_binary_mod->drop(" binary_id > 0 ");

		$br_af_mod =& m('br_af');
		$br_af_mod->drop(" af_id > 0 ");

		$br_commission_mod =& m('br_commission');
		$br_commission_mod->drop(" round_id > 0 ");

		$br_commissiondetail_mod =& m('br_commissiondetail');
		$br_commissiondetail_mod->drop(" detail_id > 0 ");

		$br_com_cycle_report_mod =& m('br_com_cycle_report');
		$br_com_cycle_report_mod->drop(" report_id > 0 ");

		$br_fast_start_mod =& m('br_fast_start');
		$br_fast_start_mod->drop(" fast_start_id > 0 ");

		$br_stock_mod =& m('br_stock');
		$br_stock_mod->drop(" stock_id > 0 ");

		$br_wallet_mod =& m('br_wallet');
		$br_wallet_mod->drop(" wallet_id > 0 ");

		$cart_mod =& m('cart');
		$cart_mod->drop(" rec_id > 0 ");

		$cart_re_mod =& m('cart_re');
		$cart_re_mod->drop(" rec_id > 0 ");


		$ewallet_mod =& m('ewallet');
		$ewallet_mod->drop(" e_id > 0 ");

		$br_point_mod =& m('br_point'); 
		$br_point_mod->drop("	point_id > 0 ");


		//$goods_mod =& m('goods');
		//$goods_mod->drop(" goods_id > 0 ");
		
		//$goods_image_mod =& m('goodsimage');
		//$goods_image_mod->drop(" image_id > 0 ");

		//$goodsspec_mod =& m('goodsspec');
		//$goodsspec_mod->drop(" spec_id > 0 ");

		$member_mod =& m('member');
		$member_mod->drop(" user_id > 1 "); 

		$member_team_mod =& m('member_team');
		$member_team_mod->drop(" member_id > 1 "); 
		$member_team_mod->edit('1',array('left_leg' =>'0',
										'right_leg' =>'0',
								));
		
		
		$mem_map_mod =& m('mem_map');
		$mem_map_mod->drop(" mem_map_id > 1 "); 

		$order_mod =& m('order');
		$order_mod->drop(" order_id > 1 "); 

		$br_paycom_mod =& m('br_paycom');
		$br_paycom_mod->drop(" pay_id > 1 "); 

		$br_learncourse_mod =& m('br_learncourse');
		$br_learncourse_mod->drop(" learn_id > 1 "); 

		
		
	}
     
}

?>
