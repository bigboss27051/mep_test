<?php

/* 管理员控制器 */
class AdminApp extends BackendApp
{
    var $_admin_mod;
    var $_user_mod;
 
	var $_menu_mod;	

    function __construct()
    {
        $this->AdminApp();
    }

    function AdminApp()
    {
        parent::__construct();
        $this->_admin_mod = & m('userpriv');
        $this->_user_mod = & m('member');
		$this->_menu_mod =& m('menuleft');
    }
    function index()
    {
		$team =  $this->_user_mod->_getmem_admin_setpermiss(); 
 
		foreach ($team as $key => $value)
        {
		  	$arr_row =	explode(',', $team[$key]['privs']);
			$team[$key]['ck_user'] =0; 
			$team[$key]['ck_goods'] =0;;
			$team[$key]['ck_order'] =0;
			$team[$key]['ck_calculatecycle']=0;
			$team[$key]['ck_investment']=0;
			$team[$key]['ck_vip']=0;
			$team[$key]['ck_ewallet']=0;
		
			foreach ($arr_row as $data)
        	{
				switch ($data) 
				{
				    case "user|all":
				        $team[$key]['ck_user'] ='1';
				        break;
				    case "goods|all":
				        $team[$key]['ck_goods'] ='1';
				        break;
				    case "order|all":
				        $team[$key]['ck_order'] ='1';
				        break;
					case "calculatecycle|all":
				        $team[$key]['ck_calculatecycle'] ='1';
				        break;
					case "investment|all":
				        $team[$key]['ck_investment'] ='1';
				        break;
					case "vip|all":
				        $team[$key]['ck_vip'] ='1';
				        break;
					case "ewallet|all":
				        $team[$key]['ck_ewallet'] ='1';
				        break;

			
				}

			}
		 	
		 	
		}
        $this->assign('team', $team);
        $this->assign('menus_left', $this->_menu_mod->set_menu('Member'));
        $this->display('user_admin.index.html');
    } 
	function add()
    {
	 	if (!IS_POST)
        {
			$this->assign('menus_left', $this->_menu_mod->set_menu('Member'));
			$this->display('admin_add.form.html');
		}
		else
		{
			$privs = "default|all,";
				if($_POST['ck_user'])
				{
					$privs .="user|all,";
				}

				if($_POST['ck_goods'])
				{
					$privs .="goods|all,";
				}

				if($_POST['ck_order'])
				{
					$privs .="order|all,";
				}
				
				if($_POST['ck_calculatecycle'])
				{
					$privs .="calculatecycle|all,";
				}

				if($_POST['ck_investment'])
				{
					$privs .="investment|all,";
				}
				
				if($_POST['ck_vip'])
				{
					$privs .="vip|all,";
				}
				if($_POST['ck_ewallet'])
				{
					$privs .="ewallet|all,";
				}
					 
				$type_branch =0;
				if($_POST['type_branch'])
				{
					$type_branch .="1";
				}
		 
			$dataadmin = array(
                
                'privs'    =>$privs,
				'type_zero' =>'1',
			 	'type_branch' =>$type_branch
            );	
			$this->_admin_mod->edit($_POST['refid'],$dataadmin);
		 	$this->show_message('add_ok');
		}
	}
	function edit()
    {
		if (!IS_POST)
        {
			$m_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	 		$team =  $this->_user_mod->_getmem_admin_setpermiss_edit($m_id); 
 			$team = current($team);
			 
			  	$arr_row =	explode(',', $team['privs']);
				$team['ck_user'] =0; 
				$team['ck_goods'] =0;;
				$team['ck_order'] =0;
				$team['ck_calculatecycle']=0;
				$team['ck_investment']=0;
				$team['ck_vip']=0;
				$team['ck_ewallet']=0;
				foreach ($arr_row as $data)
	        	{
					switch ($data) 
					{
					    case "user|all":
					        $team['ck_user'] ='1';
					        break;
					    case "goods|all":
					        $team['ck_goods'] ='1';
					        break;
					    case "order|all":
					        $team['ck_order'] ='1';
					        break;
						case "calculatecycle|all":
					        $team['ck_calculatecycle'] ='1';
					        break;
						case "investment|all":
					        $team['ck_investment'] ='1';
					        break;
						case "vip|all":
					        $team['ck_vip'] ='1';
					        break;
						case "ewallet|all":
				        	$team[$key]['ck_ewallet'] ='1';
				        break;
				
					}
	
				}
			 	
			 	
		 
	        $this->assign('team',  $team );
	        $this->assign('menus_left', $this->_menu_mod->set_menu('Member'));
			$this->display('admin_edit.form.html');
		}
		else
		{
				 


				$privs = "default|all,";
				if($_POST['ck_user'])
				{
					$privs .="user|all,";
				}

				if($_POST['ck_goods'])
				{
					$privs .="goods|all,";
				}

				if($_POST['ck_order'])
				{
					$privs .="order|all,";
				}
				
				if($_POST['ck_calculatecycle'])
				{
					$privs .="calculatecycle|all,";
				}

				if($_POST['ck_investment'])
				{
					$privs .="investment|all,";
				}
				
				if($_POST['ck_vip'])
				{
					$privs .="vip|all,";
				}
				if($_POST['ck_ewallet'])
				{
					$privs .="ewallet|all,";
				}
				$type_branch =0;
				if($_POST['type_branch'])
				{
					$type_branch .="1";
				}
		 
			$dataadmin = array(
                
                'privs'    =>$privs,
				'type_zero' =>'1',
			 	'type_branch' =>$type_branch
            );
			$this->_admin_mod->edit($_POST['refid'],$dataadmin);
		 	$this->show_message('EDIT_ok');	
		}

	}
	function dropadmin()
    {
		if (IS_POST)
        {
			$dataadmin = array(	 
				 		'type_zero'    =>0,
	            	);
			$this->_admin_mod->edit($_POST['refid'],$dataadmin);
			$this->show_message('ban_ok');
		}
	}
	function ckkuser()
    {
		$userid = $_GET['file_id'];
		
		$conditions =" and user_name='".$userid ."'";
		$users = $this->_user_mod->find(array(
                
            'conditions' => '1=1' . $conditions,  
			'count' => true, 
        ));
		
		
		if ($this->_user_mod->getCount()==0)
        {

			$this->json_result(false);
            exit;
            
        }
		else
		{
			$team =  $this->_user_mod->_getmem_admin_setpermiss_add($userid); 

			if ($team)
        	{
				$this->json_result(false);
            	exit;
			}
			else
			{
				$users =current($users);
				$this->json_result(array('res' => true,   'ref_id' => $users['user_id']));
            	exit;
			}
			
		}
		
		 
		  
	 
	}
}

?>
