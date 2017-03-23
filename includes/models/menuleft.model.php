<?php

 
class MenuleftModel extends BaseModel
{
 
 
    function get_menu_array()
    {
        $_relation_menu  =   array(
         
        	'Dashboard' => '',
			'Register'=> '',
			'Downline'=> '',
        	'Account'=> '',
			'Payout'=> '',
			'Settings'=> '',
			'Tools'=> '',
			'E-wallet'=> '',
			'Password'=> '',
			'Reports'=> '',
			'Member'=> '',
			'Mail'=> '',
			'Commission'=> '',
			'Admin'=> '',
			'Order' => '',
			'Calculate' => '',
			'Product' => '',
			
    	);

		 

	 	$_relation_menu['setmenu_mobile'] = $team['mobile'];

		return $_relation_menu;
    }

   
    function set_menu($file_id)
    { 
		$_relation_menu = $this->get_menu_array();
		
		$_relation_menu[$file_id] ="active open";
		return $_relation_menu;
		
    }
}

?>