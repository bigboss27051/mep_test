<?php

class Mg_spModel extends BaseModel
{
	
 	function _get_img($owerid)
	{
	 
		return $this->getOne("SELECT * FROM app_shop WHERE owerid=" . $owerid);
	}
	
}

?>
