<?php

 
class UserApp extends BackendApp
{
    var $_user_mod;
	var $_menu_mod;	
	var $_add_point_mod;
	var $_reg_mem_mod;
    function __construct()
    {
        $this->UserApp();
    }

    function UserApp()
    {
        parent::__construct();
        $this->_user_mod =& m('member');
		$this->_menu_mod =& m('menuleft');
	 
	 
    }

	
    function index()
    {
		 
		$this->assign('menus_left', $this->_menu_mod->set_menu('Member'));
        $this->display('user.index.html');

         
    }
		function userlist()
    {
		
	 
		  
		$data_field = array();
		$data_field[0] ='user_name';
		$data_field[1] ='real_name';
 		$data_field[2] ='email';
		$data_field[3] ='wallet';
		$data_field[4] ='member_type';
		$data_field[5] ='user_id'; 
		 
		
		
		
 		$id = empty($_GET['id']) ? 0 : intval($_GET['id']);
		
		$draw = empty($_GET['draw']) ? 1 : intval($_GET['draw']);
	 	$length = empty($_GET['length']) ? 10 : intval($_GET['length']);
		$start = empty($_GET['start']) ? 0 : intval($_GET['start']);

		$order  =  $_GET['order'];
	 	
		$search  =  $_GET['search'];
 		
		$conditions =""; 
		if($search['value'])
		{
			 
			$conditions =" (". $data_field[0]." like '%" .$search['value']."%' or " . $data_field[1] . " like '%".$search['value']."%' or " . $data_field[2] . " like '%".$search['value']."%' or " . $data_field[3] . " like '%".$search['value']."%'   ) and"; 
		}

 
		 
		$conditions .= " user_id  > 0";
		 
		$team = $this->_user_mod->find2(array(
					            'conditions' => $conditions,
					             
					         	'count' => true, 
								'fields' => "user_name,real_name,email,wallet,member_type,user_id",
			         			'limit' => $start . "," .$length,
					            'order' => $data_field[$order[0]['column']]  ." ".  $order[0]['dir'],   
					        ));
 
	
		foreach ($team as $key=>$value)
		{
			 


		
			 
			$team[$key]['user_id'] ="<a href='index.php?app=user&amp;act=account&amp;id=".$team[$key]['user_id']."' class='btn btn-success btn-sm'><span class=title>แก้ไข</span></a>&nbsp;";
 
			$team[$key]['wallet'] = number_format($team[$key]['wallet'],0);
		 
			$team[$key]['member_type'] ='<img src="templates/images/icon/'.$team[$key]['member_type'].'.png" width="30">';
		}
		
		$total_row = $this->_user_mod->getCount();
		$get_js =	json_encode( $team);
		
		$get_js =str_replace("{","[",$get_js);
		$get_js =str_replace("}","]",$get_js);
		$get_js =str_replace('"user_name":','',$get_js);
 		$get_js =str_replace('"real_name":','',$get_js);
 		$get_js =str_replace('"email":','',$get_js);
 		$get_js =str_replace('"wallet":','',$get_js);
		$get_js =str_replace('"user_id":','',$get_js);
		$get_js =str_replace('"member_type":','',$get_js);

	 
 
		
 		$export_js =  json_encode(array('draw' => $draw,'recordsTotal' => $total_row,'recordsFiltered' =>$total_row,'data' => ''));
 		
	 	$export_js  = str_replace('""}','',$export_js);

		$export_js =$export_js . " " . $get_js . "}"; 
		echo $export_js;

	 

			

	}
	function account()
    {
		 
        if (!IS_POST)
        {
			$get_id = $_GET['id'];
		 	
		 
		 
		 
			 
			$team = $this->_user_mod->find($get_id);
			$team=current($team);
		 
        	$this->assign('team', $team);
			$this->display('user.myacc.html');


           
        }
        else
        {
			$cust_id =$_POST['idd'];


				$data = array(
                'real_name' => $_POST['consignee'],
	 
                'gender'    => $_POST['gender'],
				'address' => $_POST['address'],
				'city' => $_POST['city'],
				'zipcode' => $_POST['zipcode'],
 			
                'phone_tel' =>  $_POST['phone_tel'],
 
            	'id_card' =>$_POST['idcard'],
				'email' =>$_POST['email'],
				 
				 
				
            );
			$this->_user_mod->edit($cust_id, $data);
			 
           	$this->show_message('อัพเดทข้อมูลสมาชิกเรียบร้อย' );
			 
        }
	}
	function editpassadmin()
    {
		if (!IS_POST)
        {
	 
		 
		 	$user_id =$this->visitor->get('user_id');
			$this->assign('user_id',$user_id);
		 
			$this->assign('menus_left', $this->_menu_mod->set_menu('Rp'));
			 
		 
			$this->display('user.passedit.html');
		}
		else
		{ 

			$get_id = $_POST["ref_id"];
			$pass = $_POST["pass"];

			$ms =& ms();     
            $result = $ms->user->edit2($get_id,  array(
                'password'  => $pass
            ));
			if (!$result)
            {
               
                $this->show_warning($ms->user->get_error());

                return;
            }

	 
		
			$this->show_message('แก้ไขรหัสผ่านเรียบร้อย'   );
		}
	}

	 function getuser()
    {
	
		$userid = $_GET['file_id'];

		$up_username = $_GET['up_username'];
		$position = $_GET['position'];
		

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
			
		


		$users =current($users);
		
		 
		
		 
		$this->json_result(array('res' => true, 'name' => $users['real_name'], 'ref_id' => $users['user_id'] ));
        exit;
	 
	}

	
}

?>