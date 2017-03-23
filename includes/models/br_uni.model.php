<?php

class Br_uniModel extends BaseModel
{
    var $table  = 'br_uni';
    var $prikey = 'uni_id';
    var $_name  = 'br_uni';
     
   
 	function _get_sum_total($stid,$round_id )
	{
		return $this->getOne("SELECT SUM(value) as total FROM " . DB_PREFIX . "br_uni WHERE status =1 and type=1  and member_id =" . $stid . " and round_id='".$round_id."'");
	} 
	function _get_com_user($round_id,$member_id)
    {

		$sql  = "SELECT * FROM  mlm_member  member LEFT JOIN mlm_br_uni uni ON uni.form_id = member.user_id ";
		$sql .= "where uni.round_id =".$round_id."   AND uni.member_id=".$member_id . " ORDER BY uni.lvl  ASC";
		return   $this->db->getAll($sql);

	}
	 
}

?>
