<?php

 
class MemberModel extends BaseModel
{
    var $table  = 'member';
    var $prikey = 'user_id';
    var $_name  = 'member';

 

     
    var $_relation = array(
        
		'has_team' => array(
            'model'       => 'member_team',       
            'type'        => HAS_ONE,       
            'foreign_key' => 'member_id',     �
                    
        ),

		'has_map' => array(
            'model'       => 'mem_map',       
            'type'        => HAS_ONE,       
            'foreign_key' => 'member_id',     �
                    
        ),
		
		'has_com' => array(
            'model'       => 'br_commissiondetail',       
            'type'        => HAS_ONE,       
            'foreign_key' => 'member_id',     �
                    
        ),
		'has_upline' => array(
            'model'       => 'member_team',       
            'type'        => HAS_ONE,       
            'foreign_key' => 'upline',   
	  �
                    
        ),
        'has_store' => array(
            'model'       => 'store',        
            'type'        => HAS_ONE,        
            'foreign_key' => 'store_id',     
            'dependent'   => true            
        ),
        'manage_mall'   =>  array(
            'model'       => 'userpriv',
            'type'        => HAS_ONE,
            'foreign_key' => 'user_id',
            //'ext_limit'   => array('store_id' => 0),
            'dependent'   => true
        ),
         
        'has_address' => array(
            'model'       => 'address',
            'type'        => HAS_MANY,
            'foreign_key' => 'user_id',
            'dependent'   => true
        ),
         
        'has_order' => array(
            'model'         => 'order',
            'type'          => HAS_MANY,
            'foreign_key'   => 'buyer_id',
            'dependent' => true
        ),
         // 一个用户有多条收到的短信
        'has_received_message' => array(
            'model'         => 'message',
            'type'          => HAS_MANY,
            'foreign_key'   => 'to_id',
            'dependent' => true
        ),
        // 一个用户有多条发送出去的短信
        'has_sent_message' => array(
            'model'         => 'message',
            'type'          => HAS_MANY,
            'foreign_key'   => 'from_id',
            'dependent' => true
        ),
        // 会员和商品是多对多的关系（会员收藏商品）
        'collect_goods' => array(
            'model'        => 'goods',
            'type'         => HAS_AND_BELONGS_TO_MANY,
            'middle_table' => 'collect',    //中间表名称
            'foreign_key'  => 'user_id',
            'ext_limit'    => array('type' => 'goods'),
            'reverse'      => 'be_collect', //反向关系名称
        ),
        // 会员和店铺是多对多的关系（会员收藏店铺）
        'collect_store' => array(
            'model'        => 'store',
            'type'         => HAS_AND_BELONGS_TO_MANY,
            'middle_table' => 'collect',
            'foreign_key'  => 'user_id',
            'ext_limit'    => array('type' => 'store'),
            'reverse'      => 'be_collect',
        ),
        // 会员和店铺是多对多的关系（会员拥有店铺权限）
        'manage_store' => array(
            'model'        => 'store',
            'type'         => HAS_AND_BELONGS_TO_MANY,
            'middle_table' => 'user_priv',
            'foreign_key'  => 'user_id',
            'reverse'      => 'be_manage',
        ),
        // 会员和好友是多对多的关系（会员拥有多个好友）
        'has_friend' => array(
            'model'        => 'member',
            'type'         => HAS_AND_BELONGS_TO_MANY,
            'middle_table' => 'friend',
            'foreign_key'  => 'owner_id',
            'reverse'      => 'be_friend',
        ),
        // 好友是多对多的关系（会员拥有多个好友）
        'be_friend' => array(
            'model'        => 'member',
            'type'         => HAS_AND_BELONGS_TO_MANY,
            'middle_table' => 'friend',
            'foreign_key'  => 'friend_id',
            'reverse'      => 'has_friend',
        ),
        //用户与商品咨询是一对多的关系，一个会员拥有多个商品咨询
        'user_question' => array(
            'model' => 'goodsqa',
            'type' => HAS_MANY,
            'foreign_key' => 'user_id',
        ),
        //会员和优惠券编号是多对多的关系
        'bind_couponsn' => array(
            'model'        => 'couponsn',
            'type'         => HAS_AND_BELONGS_TO_MANY,
            'middle_table' => 'user_coupon',
            'foreign_key'  => 'user_id',
            'reverse'      => 'bind_user',
        ),
        // 会员和团购活动是多对多的关系（会员收藏商品）
        'join_groupbuy' => array(
            'model'        => 'groupbuy',
            'type'         => HAS_AND_BELONGS_TO_MANY,
            'middle_table' => 'groupbuy_log',    //中间表名称
            'foreign_key'  => 'user_id',
            'reverse'      => 'be_join', //反向关系名称
        ),
        // 一个会员发起一个团购
        'start_groupbuy' => array(
            'model'         => 'groupbuy',
            'type'          => HAS_ONE,
            'foreign_key'   => 'store_id',
            'dependent'   => true
        ),
    );

    var $_autov = array(
        'user_name' => array(
            'required'  => true,
            'filter'    => 'trim',
        ),
        'password' => array(
            'required' => true,
            'filter'   => 'trim',
            'min'      => 6,
        ),
    );

  		function _get_username_soap3($user_id)
    {
		$conditions= "  user_id =".$user_id;
		$users = $this->find(array(
      		'fields' => 'this.* ',
            'conditions' =>   $conditions,
             
        ));
		$users =current($users);
		return $users;

	}
	function _getmem_admin()
    {

		$sql = "SELECT member.*,member_team.*,sponser.user_name as sponser_name,upline.user_name as upline_name, member_team.member_id FROM mlm_member_team member_team LEFT JOIN mlm_member member ON member_team.member_id = member.user_id LEFT JOIN mlm_member sponser ON member_team.sponsor = sponser.user_id LEFT JOIN mlm_member upline ON member_team.upline = upline.user_id ORDER BY member.user_id ASC ";
		
		return   $this->db->getAll($sql);

	}
	function _getmem_admin2($userid)
    {

		$sql = "SELECT member.*,member_team.*,sponser.user_name as sponser_name,upline.user_name as upline_name, member_team.member_id FROM mlm_member_team member_team LEFT JOIN mlm_member member ON member_team.member_id = member.user_id LEFT JOIN mlm_member sponser ON member_team.sponsor = sponser.user_id LEFT JOIN mlm_member upline ON member_team.upline = upline.user_id ORDER BY member.user_id ASC ";
		
		return   $this->db->getAll($sql);

	}
	function _getmem_user($userid,$page)
    {

		$sql  = "SELECT  member_team.* ,map.*  FROM mlm_member_team member_team ";
 
		$sql .= "LEFT JOIN mlm_mem_map map on map.member_id = member_team.member_id ";
		$sql .= "WHERE map.root_id = ".$userid . " order by member_team.member_id LIMIT 0 , 15 ";
		
		return   $this->db->getAll($sql);

	}
	function _getmem_admin_autocomplete()
    {
		 
		$sql = "SELECT member.user_name  FROM mlm_member_team member_team LEFT JOIN mlm_member member ON member_team.member_id = member.user_id LEFT JOIN mlm_member sponser ON member_team.sponsor = sponser.user_id LEFT JOIN mlm_member upline ON member_team.upline = upline.user_id ORDER BY member.user_id ASC ";
		
		$sr =   $this->db->getAll($sql);
		foreach ( $sr as $regd)
        {
           $res .= "\"". $regd['user_name'] . "\"," ;
        }
		 
	   return $res;
	}
	function _member_autocomplete($team)
    {
		 
		 
		foreach ( $team as $regd)
        {
           $res .= "\"". $regd['user_name'] . "\"," ;
        }
		 
	   return $res;
	}
	function _getmem_admin_noup()
    {

		$sql = "SELECT member.*,member_team.*,sponser.user_name as sponser_name,upline.user_name as upline_name, member_team.member_id FROM mlm_member_team member_team LEFT JOIN mlm_member member ON member_team.member_id = member.user_id LEFT JOIN mlm_member sponser ON member_team.sponsor = sponser.user_id LEFT JOIN mlm_member upline ON member_team.upline = upline.user_id  " ;
		$sql .= "where member_team.upline =0 ";
		$sql .= "ORDER BY member.user_id ASC ";
		
		return   $this->db->getAll($sql);

	}
	function _getmem_admin_nosponsor()
    {

		$sql = "SELECT member.*,member_team.*,sponser.user_name as sponser_name,upline.user_name as upline_name, member_team.member_id FROM mlm_member_team member_team LEFT JOIN mlm_member member ON member_team.member_id = member.user_id LEFT JOIN mlm_member sponser ON member_team.sponsor = sponser.user_id LEFT JOIN mlm_member upline ON member_team.upline = upline.user_id  " ;
		$sql .= "where member_team.sponsor =0 ";
		$sql .= "ORDER BY member.user_id ASC ";
		
		return   $this->db->getAll($sql);

	}
	function _getmem_admin_setpermiss()
    {

		$sql = "SELECT member.real_name,member.user_name,priv.*,member.user_id FROM mlm_member member LEFT JOIN mlm_user_priv priv ON priv.user_id = member.user_id   ";
		$sql .= "where member.user_id !=1 and  type_zero =1 ";
		$sql .= "ORDER BY member.user_id ASC ";
		
		return   $this->db->getAll($sql);

	}
	function _getmem_admin_setpermiss_edit($mid)
    {

		$sql = "SELECT member.real_name,member.user_name,priv.*,member.user_id FROM mlm_member member LEFT JOIN mlm_user_priv priv ON priv.user_id = member.user_id   ";
		$sql .= "where member.user_id !=1 and  type_zero =1 and member.user_id  = '".$mid . "'";
		$sql .= " ORDER BY member.user_id ASC ";
		
		return   $this->db->getAll($sql);

	}
	function _getmem_admin_setpermiss_add($mid)
    {

		$sql = "SELECT member.real_name,member.user_name,priv.*,member.user_id FROM mlm_member member LEFT JOIN mlm_user_priv priv ON priv.user_id = member.user_id   ";
		$sql .= "where member.user_id !=1 and  type_zero =1 and user_name = '".$mid . "'";
		$sql .= " ORDER BY member.user_id ASC ";
		
		return   $this->db->getAll($sql);

	}
    function unique($user_name, $user_id = 0)
    {
        $conditions = "user_name = '" . $user_name . "'";
        $user_id && $conditions .= " AND user_id <> '" . $user_id . "'";
        return count($this->find(array('conditions' => $conditions))) == 0;
    }

    function drop($conditions, $fields = 'portrait')
    {
        if ($droped_rows = parent::drop($conditions, $fields))
        {
            restore_error_handler();
            $droped_data = $this->getDroppedData();
            foreach ($droped_data as $row)
            {
                $row['portrait'] && @unlink(ROOT_PATH . '/' . $row['portrait']);
            }
            reset_error_handler();
        }
        return $droped_rows;
    }
	function _set_username()
    {
		 
		$ff ="Aura";
		$max =	$this->getOne("SELECT max(user_id) as total  FROM  mlm_member ");
	 
		$str_code =$max + 1;   
	 
		switch (strlen($str_code)) {
			  case 1:
			      $str_code ="-000" . $str_code;
			    break;
			  case 2:
			    $str_code ="-00" . $str_code;
			    break;
			  case 3:
			   	$str_code ="-0" . $str_code;
			    break;
			 default:
			   	$str_code ="-" . $str_code;
			     
			}

		$str_code = $ff .$str_code;

		return $str_code;

	}
	function _get_username($user_id)
    {
		$conditions= "  user_id  =".$user_id;
		$users = $this->find(array(
      		'fields' => 'this.* ',
            'conditions' =>   $conditions,
             
        ));
		$users =current($users);
		return $users;

	}
	function _get_username_soap($user_id)
    {
		$conditions= "  user_id =".$user_id;
		$users = $this->find(array(
      		'fields' => 'this.* ',
            'conditions' =>   $conditions,
             
        ));
		$users =current($users);
		return $users['user_name'];

	}
	function _read_userteam($user_id)
    {
		$conditions= "  user_id =".$user_id;
		$users = $this->find(array(
      		'fields' => 'this.* ',
            'conditions' =>   $conditions,
             
        ));
		$users =current($users);
		return $users;

	}
	
	function  updat_vippos($user_id,$vip_pv)
	{
		
		$this->edit("user_id=" . $user_id , array('vip_pv' => $vip_pv));	 
	}
	
	function get_userinfo($user_id)
    {
		$conditions= "  user_id =".$user_id;
		$result = $this->find(array(
      		'fields' => 'this.* ',
            'conditions' =>   $conditions,
             
        ));
	
		return $result;

	}
	function _getuser2($ref_userid,$up_username,$position)
    {
		$check = true;
		 
		$userid = $ref_userid;

		$conditions =" and user_name='".$userid ."'";
		$users = $this->find(array(
                
            'conditions' => '1=1' . $conditions,  
			'count' => true, 
        ));
		
		
		if ($this->getCount()==0)
        {
            $check = false;
            return $check;
        }
		
		$users =current($users);
		
		$member_team_mod =& m('member_team');
		$conditions = "member.user_name ='".$up_username."'";	
		$team = $member_team_mod->find(array(
		            'conditions' => $conditions,
		            'join'  => 'belongs_to_user',
		         
		             
		        ));
		$leg = true;
		if($team)
		{
			$team =current($team);
			if($position == "R")
			{
				if($team['right_leg'])
				{
					
					$leg =false;
				}
				else
				{
					$leg = true;
				}
			}
			if($position == "L")
			{
				if($team['left_leg'])
				{
					
					$leg =false;
				}
				else
				{
					$leg = true;
				}

			}

			
		}
		else
		{
			$leg =false;
		}

		$check =$leg;
		
		return $check;
	 
	}

	function get_parents($txtsql)
    {
        $res = array();
	 

		 $regions  = $this->find(array(
						'fields' => 'member.user_id,member.real_name,member.user_name,member.reg_time',
			            'conditions' => $txtsql,   
			        ));
        
        foreach ($regions as $region)
        {
            $res['user_name'][$region['user_id']] = $region['user_name'];
			$res['real_name'][$region['user_id']] = $region['real_name'];
			
        }

        return $res;
    }
	function get_parentsall()
    {
        $res = array();
	 

		 $regions  = $this->find(array(
						'fields' => 'member.user_id,member.real_name,member.user_name,member.reg_time',
			             
			        ));
         
		foreach ($regions as $region)
        {
            $res['user_name'][$region['user_id']] = $region['user_name'];
			$res['real_name'][$region['user_id']] = $region['real_name'];
			$res['reg_time'][$region['user_id']] = $region['reg_time'];
			
        }

        return  $res;
    } 
	function _get_count_mem()
	{
		return $this->getOne("SELECT count(*) as total FROM " . $this->table    );
	} 

	function _cremember($userid,$pass)
	{
			
			$mem = $this->find($userid);
			$mem= current($mem);


			$email =	$mem['user_name'].'@aura.in.th';

			echo $email;

			$mage_part = ROOT_PATH ;
			$mage_part = str_replace("mlmsite","mlm",$mage_part); 
			require_once($mage_part.'/app/Mage.php');
			Mage::init();

			$home ="123/11";

			$street ="rama9";
			$district = "Bangna";
			 

			$province = "Bangkok";

			$zip ="10321";

			$customerExist = Mage::getModel('customer/customer')->getCollection()->addFieldToFilter('email',$email)->getData();
 			if($customerExist[0]['email'] == "")
			{
				$customer = Mage::getModel("customer/customer");
				$customer   ->setWebsiteId(1)
							->setStoreId(1)
							->setGroupId(1)
							->setGender($mem['sex'])
							->setFirstname($mem['user_name'])
							->setLastname($mem['user_name'])
							->setPasswordHash(md5($pass))
							->setDob($mem['borndate'])
							->setAge($mem['age'])
							->setRace($mem['race'])
							->setNationality($mem['nationality'])
							->setStatus($mem['yourstatus'])
							->setIdcode($mem['id_card'])
							->setX_date($mem['expire_date'])
							->setAdd1_number($home)
							->setAdd1_village($mem['name_home'])
							->setAdd1_swine($mem['village_no'])
							->setAdd1_street($street)
							->setAdd1_district($district)
							->setAdd1_prefecture($mem['prefecture'])
							->setAdd1_province($province)
							->setAdd1_zip($zip)
							->setAdd3_number($home)
							->setAdd3_village($mem['name_home2'])
							->setAdd3_swine($mem['village_no2'])
							->setAdd3_street($street)
							->setAdd3_district($district)
							->setAdd3_prefecture($mem['prefecture2'])
							->setAdd3_province($province)
							->setAdd3_zip($zip)
							->setAdd2_name($mem['name_job'])
							->setAdd2_number($home)
							->setAdd2_village($mem['name_home3'])
							->setAdd2_swine($mem['village_no3'])
							->setAdd2_street($street)
							->setAdd2_district($district)
							->setAdd2_prefecture($mem['prefecture3'])
							->setAdd2_province($province)
							->setAdd2_zip($zip)
							->setAdd_con(93)
							->setTel($mem['phone_tel'])
							->setTel_job($mem['phone_tel'])
							->setMobile($mem['phone_tel'])
							->setEmail($email)
							->setAdd_con2($mem['con_address_str']);
							
						
					try{
						$customer->save();
						
					}
					catch (Exception $e) {
						echo $e->getMessage();
					}


					$home ="123/11";

		 
			 

					 
					$pr  = $province;
				 
					$st = $home. ", " . $mem['name_home2']. ", " . $mem['village_no2'] . ", " . $street . ", " . $district;
					
			 	
					$address = Mage::getModel("customer/address");
					$address->setCustomerId($customer->getId())
							->setFirstname($mem['user_name'])
							->setLastname($mem['user_name'])
							->setCountryId('TH')
							->setRegionId('12')
							->setPostcode($zip)
							->setCity($pr)
							->setRegion($pr2)
							->setTelephone($mem['phone_tel'])
							->setFax('')
							->setCompany('')
							->setStreet($st)
							->setIsDefaultBilling('1')
							->setIsDefaultShipping('1')
							->setSaveInAddressBook('1');
				
				try{
					$address->save();
					echo $customer->getId() . "|" . $address->getId();
					//echo 'T';
				}
				catch (Exception $e) {
					echo $e->getMessage();
				}
			}
	}

	function _getmemdetail($member_id)
	{
		$member_team_mod =& m('member_team');
		$conditions = "member_id  =".$u_memid;		
		$team = $member_team_mod->find(array(
			            'conditions' => $conditions,
			            'join'  => 'belongs_to_user',
			         
			             
			        ));
			
	
		$team =current($team);

		return $team;
	}

	function _getpv($member_id)
	{
		$pv_arr = array();

		$bravo_binary_mod =& m('bravo_binary'); 
		$pv_total = $bravo_binary_mod->_get_pv_total($member_id,'Y','1');
	
	
		$in_Lpv_last = $bravo_binary_mod->_get_pv_L_total_in($member_id);
		$out_Lpv_last = $bravo_binary_mod->_get_pv_L_total_out($member_id);
		$total_Lpv_last =$in_Lpv_last - $out_Lpv_last;
	
		$in_Lpv_now = $bravo_binary_mod->_get_pv_L_total_in_now($member_id);
			//$out_Lpv_now = $bravo_binary_mod->_get_pv_L_total_out_now($member_id);
		$total_Lpv_now =$in_Lpv_now - $out_Lpv_now;
	
		$All_Lpv_now =	$total_Lpv_now + $total_Lpv_last;



		$pv_arr['total_Lpv_last'] = $total_Lpv_last ; 
		$pv_arr['total_Lpv_now']  = $total_Lpv_now;
		$pv_arr['All_Lpv_now']  = $All_Lpv_now;
			
			
	
		$in_Rpv_last = $bravo_binary_mod->_get_pv_R_total_in($member_id);
		$out_Rpv_last = $bravo_binary_mod->_get_pv_R_total_out($member_id);
		$total_Rpv_last =$in_Rpv_last - $out_Rpv_last;
	
		$in_Rpv_now = $bravo_binary_mod->_get_pv_R_total_in_now($member_id);
			//$out_Rpv_now = $bravo_binary_mod->_get_pv_R_total_out_now($member_id);
		$total_Rpv_now =$in_Rpv_now - $out_Rpv_now;
	
		$All_Rpv_now = $total_Rpv_last + $total_Rpv_now;



		$pv_arr['total_Rpv_last'] = $total_Rpv_last;
		$pv_arr['total_Rpv_now'] = $total_Rpv_now;

		$pv_arr['All_Rpv_now'] = $All_Rpv_now ;

		return $pv_arr ;

	}

	
	 
 

	

		
}

?>