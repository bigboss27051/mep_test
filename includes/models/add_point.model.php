<?php

 
class Add_pointModel extends BaseModel
{
    var $table  = 'add_point';
    var $prikey = 'id';
    var $_name  = 'add_point';

    
	

	function  insert_add_point($user_id, $point)
	{
		$data = array(
                'user_id' => $user_id ,
			 	'point' => $point
				      );

		$this->add($data);

 
	}
	
	
}


?>
