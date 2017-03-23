<?php

 
class BranchModel extends BaseModel
{
    var $table  = 'branch';
    var $prikey = 'branch_id';
    var $_name  = 'branch';
 
	function _read_brname($br)
    {
		$conditions= "  branch_id =".$br;
		$users = $this->find(array(
      		'fields' => 'this.* ',
            'conditions' =>   $conditions,
             
        ));
		$users =current($users);
		return $users['branch_code'];

	}
    
}

?>