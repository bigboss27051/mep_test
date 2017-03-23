<?php

 
class EwalletApp extends BackendApp
{
    var $_user_mod;
	var $_menu_mod;	
	var $_ewallet_mod;
	var	$_br_wallet;
    function __construct()
    {
        $this->EwalletApp();
    }

    function EwalletApp()
    {
        parent::__construct();
        $this->_user_mod =& m('member');
		$this->_menu_mod =& m('menuleft');
		$this->_ewallet_mod =& m('ewallet'); 
		$this->_br_wallet_mod =& m('br_wallet'); 
	 
	
    }
	function index()
    {
	

				
		$walet_row = $this->_ewallet_mod->find();

		$this->assign("walet_row",$walet_row);
		$this->assign('menus_left', $this->_menu_mod->set_menu('E-wallet'));
		$this->display('ewallet.list.html');
	}
	
	function appwalet()
    {
		if (IS_POST)
        { 
			$user_id =$this->visitor->get('user_id');
			 
			$eid = empty($_POST['eid']) ? 0 : intval($_POST['eid']);


			$row_wallet = $this->_ewallet_mod->find($eid);
			
			$row_wallet = current($row_wallet);


			$userid =$row_wallet['member_id'];

			$br_wallet_mod =& m('br_wallet'); 

			$wallet_in =$br_wallet_mod->_get_wallet_total_in($userid);
			$wallet_out =$br_wallet_mod->_get_wallet_total_out($userid);
	
			$wallet_total = $wallet_in - $wallet_out;
				 

			 
			
			
			$row_eid = $this->_ewallet_mod->get_total($eid);

		 
			$gtotal = $wallet_total + $row_eid['amount'];

			$data_wal = array(

				'member_id' =>$row_eid['member_id'],
                'wal_desc' =>'เติมเครดิต ',
			  	'type'  => '1',
				'value'  => $row_eid['amount'],
			 	'order_id'  => $eid,
					'gtotal'  => $gtotal,
            );

		
		 	$wallet_id = $this->_br_wallet_mod->add($data_wal);

			$user_mod =& m('member');
				
			$datauser = array(
                'wallet' => $gtotal	
			);

			$user_mod->edit($userid ,$datauser );
			
			
			$data = array(
                'transfer_stat' => '1' ,
				'status' => '1' ,
				'approv' => $user_id,
			
				'wallet_id' => $wallet_id,

			);
			
 			$this->_ewallet_mod->edit($eid,$data);
			$this->show_message('approv_ok',
                'back_list',    'index.php?app=ewallet');
		}

	}
	
	function add()
    {
		if (!IS_POST)
        {
	 
			$member_team_mod =& m('member_team');
		  
			  
			
			$this->assign('menus_left', $this->_menu_mod->set_menu('E-wallet'));
		  
			$this->display('ewallet.index.html');
		}
		else
		{
			$user_id =$this->visitor->get('user_id');
			

			$member_mod =& m('member'); 

			$team= $member_mod->find($_POST["ref_id"]);
			$team = current($team);


			$data = array(
			 	'order_sn' => $this->_ewallet_mod->_set_so_id(),
                'member_id' => $_POST["ref_id"] ,
			 	'user_name' => $_POST["cust_userid"],
				'name' =>	$team["real_name"],
				'amount' =>$_POST["point"],
				'status' => 0,
				'transfer' =>$_POST["point"],
				'user_add'  =>$user_id,
			 
			 
            );

 			$this->_ewallet_mod->add($data);
			$this->show_message('add_ok', 'back_list',    'index.php?app=ewallet' );
		}
		
    }
	
	function view()
    {
		if (!IS_POST)
        {
	 

		$id = empty($_GET['id']) ? 0 : intval($_GET['id']);


		
		$walet_row = $this->_ewallet_mod->find($id);
		$this->assign("walet_row",current($walet_row));
		$this->assign("id",$id);

		$this->assign('menus_left', $this->_menu_mod->set_menu('E-wallet'));
		$this->display('ewallet.detail.html');

		}
		else
		{

			
			 
			$eid = empty($_POST['eid']) ? 0 : intval($_POST['eid']);

			$row_wallet = $this->_ewallet_mod->find($eid);
			
			$row_wallet = current($row_wallet);


			$userid =$row_wallet['member_id'];

			$br_wallet_mod =& m('br_wallet'); 

			$wallet_in =$br_wallet_mod->_get_wallet_total_in($userid);
			$wallet_out =$br_wallet_mod->_get_wallet_total_out($userid);
	
			$wallet_total = $wallet_in - $wallet_out;
				 
		
			
			$row_eid = $this->_ewallet_mod->get_total($eid);

			$gtotal = $wallet_total + $row_eid['amount'];

			if($_POST['status'] == 1)
			{
		 
				$data_wal = array(
	
					'member_id' =>$row_eid['member_id'],
	                'wal_desc' =>'เติมเครดิต',
				  	'type'  => '1',
					'value'  => $row_eid['amount'],
					'gtotal'  => $gtotal,
					'order_id'  => $eid,
				 
	            );
	
			
			 	$wallet_id = $br_wallet_mod->add($data_wal);

				$user_mod =& m('member');
				
				$datauser = array(
	                'wallet' => $gtotal	,
				);
	
				$user_mod->edit($userid ,$datauser);
			}
			
			
			
			$data = array(
                'transfer_stat' => '1' ,
				'status' => $_POST['status'] ,
				'approv' => $user_id,
				
				'wallet_id' => $wallet_id,
				'remarktran' =>  $_POST['remarktran'],

			);
			
 			$this->_ewallet_mod->edit($eid,$data);
			$this->show_message('อัพเดทข้อมูลเรียบร้อย',
                'back_list',    'index.php?app=ewallet');

		}
	} 
	 
}

?>
