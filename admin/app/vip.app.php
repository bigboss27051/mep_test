<?php

 
class VipApp extends BackendApp
{
    var $_user_mod;
	var $_menu_mod;	
	var $_add_point_mod;

    function __construct()
    {
        $this->VipApp();
    }

    function VipApp()
    {
        parent::__construct();
         $this->_user_mod =& m('member');
		$this->_menu_mod =& m('menuleft');
		$this->_member_team_mod2 =& m('member_team'); 
		$this->_add_point_mod =& m('add_point'); 
    }

    function index()
    {
        
    }
	function vipupdate()
    {
		if (!IS_POST)
        {
			$this->assign('rowuser',$this->_user_mod->_get_username($_GET['username']));
			$this->assign('menus_left', $this->_menu_mod->set_menu('Member'));
			$this->assign('usid',$_GET['username']);
			$sort  = 'investment_id';
            $order = 'asc';

			$investment_mod =& m('investment');
			$inves = $investment_mod->find(array(
             
            'fields' => 'this.*',
            'conditions' => '1=1',
            
            'order' => "$sort $order",
         
       		));
			$this->assign('inves', $inves);
			$this->display('vipupdate.index.html');
		}
		else
		{
		 
		
	 	 	$user_id= $_POST['user_id'];
		 	$member_team_mod =& m('member_team');
		 	$member_team_mod->edit($user_id, array('investment_id' => $_POST['RG'],
												 'buy_pass'  => $_POST['RG'], ));
		

		 	$this->show_message('update_ok', 'back_list', url("app=vip&act=vipposition") );
		 
			
		}
		
    }
	function addpoint()
    {
		if (!IS_POST)
        {
			$this->assign('menus_left', $this->_menu_mod->set_menu('Member'));
			$this->display('addpoint.index.html');
		}
		else
		{
			$this->_add_point_mod->insert_add_point($_POST["cust_userid"], $_POST["point"]);	
			$this->assign('menus_left', $this->_menu_mod->set_menu('Member'));
			$this->refreshpage();
		}
		
    }
	function vipposition()
    {
		
		$investment_mod =& m('investment');
		$mem_map_mod =& m('mem_map');		
		$team =  $this->_user_mod->_getmem_admin(); 
		$this->assign('set_invest', $investment_mod->get_options_function() );
        $this->assign('team', $team);
        $this->assign('menus_left', $this->_menu_mod->set_menu('Member'));
		$this->display('vipposition.index.html');
		
    }
	function vipmobile()
    {
		
		$investment_mod =& m('investment');
		$mem_map_mod =& m('mem_map');		
		$team =  $this->_user_mod->_getmem_admin(); 
		$this->assign('set_invest', $investment_mod->get_options_function() );
        $this->assign('team', $team);
        $this->assign('menus_left', $this->_menu_mod->set_menu('Member'));
		$this->display('vipmobile.index.html');
		
    }
	function mobile()
    {
		 
			$user_id = $_GET['username'];
			$status = $_GET['status'];
		 	$member_team_mod =& m('member_team');
		 	$member_team_mod->edit($user_id, array('mobile' => $status ));
			$this->show_message('update_ok', 'back_list', url("app=vip&act=vipmobile") );
		 
    }
		
	function  refreshpage()
	{
	
		header( "location: http://www.bravonetwork2015.com/admin/index.php?app=user&act=addpoint" );
 	 
 	}
     
}

?>
