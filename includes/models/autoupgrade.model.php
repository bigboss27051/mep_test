<?php

 
class AutoupgradeModel extends BaseModel
{
    var $table  = 'autoupgrade';
    var $prikey = 'id';
    var $_name  = 'autoupgrade';

     
	function _get_count_max()
    {
		return	$this->getOne("SELECT max(id) as total  FROM  mlm_autoupgrade ");
	}
	 
	
			

}


?>
