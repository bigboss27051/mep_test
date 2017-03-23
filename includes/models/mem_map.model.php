<?php

 
class Mem_mapModel extends BaseModel
{
    
	var $table  = 'mem_map';
    var $prikey = 'mem_map_id';
   	var $_name  = 'mem_map';

	var $_relation = array(
        
        'belongs_to_user' => array(
            'model'         => 'member',
            'type'          => BELONGS_TO,
            'foreign_key'   => 'user_id',
            'reverse'       => 'has_map',
        ),
		 'belongs_to_team' => array(
            'model'         => 'member_team',
            'type'          => BELONGS_TO,
            'foreign_key'   => 'member_id',
            'reverse'       => 'has_map',
        ),
		'has_team' => array(
            'model'       => 'member_team',       
            'type'        => HAS_ONE,       
            'foreign_key' => 'member_id',     
                    
        ),
		
	);

	function _get_lastleft($now_head)
	{
		$sort  = 'mem_map.level';
        $order = 'desc';

		$condition ="   mem_map.root_id  =".$now_head." and  mem_map.no = 1 ";
		$row = $this->find(array(
            'conditions' =>$condition ,
			'order' => "$sort $order",
			 'limit' => 1, 
			 'count'         => true,
        ));
		
		$row =current($row);
		

		$git_id =0;
		if($this->getCount()>0)
		{
			$git_id =$row['member_id'];
		}


		return $git_id;
	}
	function _get_lastright($now_head)
	{
		$sort  = 'mem_map.level';
        $order = 'desc';

		$condition =" mem_map.no > 0 and  mem_map.no = POWER(2,mem_map.level) and mem_map.root_id  =".$now_head  ;
		$row = $this->find(array(
            'conditions' =>$condition ,
			'order' => "$sort $order",
		 	 'limit' => 1, 
			  
        ));
		$row =current($row);
		$git_id =0;
 
		if($row)
		{
			$git_id =$row['member_id'];
		}


		return $git_id;
	}


	function _set_map_root($userid,$upline,$level,$ckk_no)
	{
		
		
		
		$data2 = array(
	            'member_id' => $userid,
				'root_id'=> $upline,
	            'level' => $level,  
				'no'  => $ckk_no,  
            	);

		
			 
		$this->add($data2);
	}
	function _count_lvl($stid,$lvl)
	{
		return $this->getOne("SELECT count(member_id) as total FROM " . $this->table . "  WHERE   root_id =" . $stid . " and level=".$lvl);
	} 
	function _stored_member($stid)
	{
		$sql =" CALL List_member(".$stid.");";
		return $this->db->getProcedure($sql);
	}
	
}


								
?>