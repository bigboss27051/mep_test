<?php

 
class Api_keyModel extends BaseModel
{
    var $table  = 'api_key';
    var $prikey = 'sesskey';
    var $_name  = 'api_key';

    var $session_id ="";
	var $_userid = "";
	var $max_life_time = 1440;
	var $gmtime = 0;
	
	
	function gen_session_id()
    {
        $this->session_id = md5(uniqid(mt_rand(), true));

        $this->insert_session();
    }
 	function insert_session()
    {
        $adminid = !empty($_SESSION['admin_id']) ? intval($_SESSION['admin_id']) : 0;
        $expiry  = $this->get_expiry();
		$real_ip  =		real_ip();

		$data = array(
                'sesskey' => $this->session_id ,
                'expiry'  => $expiry, 
				'ip'  => $real_ip, 
				'userid'  => $this->_userid, 
			
            );
		$this->add($data);
		
        
    }
	function get_expiry()
    {
		$this->gmtime = gmtime();
        return $this->gmtime + $this->max_life_time;
    }
	function _login()
    {

		$conditions = " userid = '".$this->_userid . "'";
		$data = array(
                'is_overflow' => '1' ,

            	);
		$this->edit($conditions,$data);

		$this->gen_session_id();
	}
	function readlife_time()
    {
		$life = true;

		$this->gmtime = gmtime();

		$conditions = " sesskey = '".$this->session_id . "'";
		$_row_key = $this->find(array(
		            'conditions' => $conditions,
		             
		         
		             
		        ));
	

		$_row_key = current($_row_key);


		if($_row_key['is_overflow'])
		{
			$life =	false;	
		}
		else
		{
			$time_key = $_row_key['expiry'] - $this->gmtime;
	
			if($time_key < 0) 
			{
				$life =	false;
				$data = array(
                'is_overflow' => '1' ,

            	);
				$this->edit($conditions,$data);
			}
			else
			{
				$data = array(
                'expiry' => $this->get_expiry() ,

            	);
				$this->edit($conditions,$data);

				$this->_userid = $_row_key['userid'];
		
			}
			
		}
		 
        return $life  ;
    }
	

	
}


?>
