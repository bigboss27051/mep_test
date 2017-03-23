<?php

 
class WithdrawApp extends BackendApp
{
    var $_menu_mod;
    function __construct()
    {
        $this->WithdrawApp();
    }

    function WithdrawApp()
    {
        parent::__construct();
        $this->_menu_mod =& m('menuleft');
	
    }
	function index()
    {
		
		 
 			
	 
	
		$sattus = array();
		$sattus[0] = "Waiting";
		$sattus[1] = "Paid";
		$sattus[2] = "Cancel";
		$br_withdraw_mod =& m('br_withdraw');
			
	 
		$walet_row = $br_withdraw_mod->find();

		$this->assign("sattus",$sattus);
 
		$this->assign("walet_row",$walet_row);
		$this->assign('menus_left', $this->_menu_mod->set_menu('Reports'));
		$this->display('withdraw.list.html');
	}
	function view()
    {
	
		if (!IS_POST)
        {
			$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;	
			$membert_mod =& m('member'); 
	
			
	
		
			$sattus = array();
			$sattus[0] = "Waiting";
			$sattus[1] = "Paid";
			$sattus[2] = "Cancel";
			$br_withdraw_mod =& m('br_withdraw');
				
		 
			$walet_row = $br_withdraw_mod->find($order_id);
	
			$walet_row =	current($walet_row);
	
			$team = $membert_mod->find($walet_row['member_id']);
			$team = current($team);
	
			$this->assign("sattus",$sattus);
			$this->assign('user_name', $team['user_name']);
				$this->assign('branch_id', $team['branch_id']);
				$this->assign('team', $team);
	 
				$this->assign('realname', $team['real_name'] );
			$this->assign("walet_row",$walet_row);
			$this->assign('menus_left', $this->_menu_mod->set_menu('Reports'));
			$this->assign('order_id', $order_id);
			 $this->display('withdraw.view.html');
		}
		else
		{
			
			$order_id = $_POST["order_id"];

			if($order_id)
			{
				$br_withdraw_mod =& m('br_withdraw');
			
				$data = array(
	                'active' => '1' ,
					 
	
				);
		 		$br_withdraw_mod->edit($order_id, $data); 
			 
				$this->show_message('approv_ok');
			}
		}
	} 
	 
	
}

?>
