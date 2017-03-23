<?php

 
class BagModel extends BaseModel
{
    var $table  = 'bag';
    var $prikey = 'id';
    var $_name  = 'bag';

    function  get_bag($cusid)
	{
		 
		$conditions = " customerid = " . $cusid ;	
		$result = $this->find(array(
		            'conditions' => $conditions,  
				            
		        ));
	
	 
		return $result;
	}
	function calTD($ratenow,$TC,$R,$cusid)
	{
		//echo $TC . " " . $R ." " .$ratenow;
		$TD = $TC - (($TC*$R)/$ratenow);
		$this->updat_TD($TD,$cusid);
		//echo number_format($TD, 2);
		
	}
	function calSP($ratenow,$SP,$amount,$cusid)
	{
	 
		$SP = $SP - $amount;
		
		$this->updat_SP($ratenow,$SP,$cusid);
		//echo number_format($TD, 2);
		
	}
	function  updat_SP($rate,$SP,$cusid)
	{
		
		$this->edit("customerid=".$cusid, array('SP' => $SP,'rate' => $rate ));
	}

	function  updat_TD($TD,$cusid)
	{
		
		$this->edit("customerid=".$cusid, array('TD' => $TD));		 
	}

	function  updat_SP2($SP,$cusid,$orate)
	{
		
		$this->edit("customerid=".$cusid, array('SP' => $SP,'rate' => $orate));		
	}
	
	function  updat_TC2($TC,$cusid,$orate)
	{

		$this->edit("customerid=".$cusid, array('TC' => $TC,'rate' => $orate));
	
	}
	function calTC($ratenow,$TC,$Rsell,$amount,$cusid)
	{
	 
		$TC = ($TC - $amount)*$Rsell;
		//echo $TC . " " . $ratenow;
		$TC = $TC / $ratenow;
		//echo $TC;
		$this->updat_TC($ratenow,$TC,$cusid);
		//echo number_format($TD, 2);
		
	}
	function  updat_TC($rate,$TC,$cusid)
	{
	
		$this->edit("customerid=".$cusid, array('TC' => $TC,'rate' => $rate));

	}
	function  updat_CS($CS,$cusid)
	{
		$this->edit("customerid=".$cusid, array('CS' => $CS  ));

 	 
	}
	function  updat_CSCP($CS,$CP,$rate,$cusid)
	{
		$this->edit("customerid=".$cusid, array('CS' => $CS, 'CP' => $CP ,'rate' => $rate));

 	 
	}
	function  updat_CP($CP,$cusid)
	{
		$this->edit("customerid=".$cusid, array('CP' => $CP  ));

	}
	function  updat_BP($BP,$cusid)
	{
		$this->edit("customerid=".$cusid, array('BP' => $BP  ));

	}
 	function calCS($CS,$amount,$cusid)
	{
		//echo $CS ." ". $amount;
		$CS = $CS - $amount;
		
		$this->updat_CS($CS,$cusid);
		//echo number_format($TD, 2);
		
	}
	function  updat_TC3($TC,$cusid)
	{
	
		$this->edit("customerid=".$cusid, array('TC' => $TC  ));
		 

	}
	function calBO($BO,$amount,$cusid)
	{
		//echo $CS ." ". $amount;
		$BO = $BO - $amount;
		
		$this->updat_BO($BO,$cusid);
		//echo number_format($TD, 2);
		
	 }
	function calCP($CP,$amount,$cusid)
	{
		//echo $CS ." ". $amount;
		$CP = $CP - $amount;
		
		$this->updat_CP($CP,$cusid);
		//echo number_format($TD, 2);
		
	 }
	 function calBP($BP,$amount,$cusid)
	{
		//echo $CS ." ". $amount;
		$BP = $BP - $amount;
		
		$this->updat_BP($BP,$cusid);
		//echo number_format($TD, 2);
		
	 }
	function  updat_BO($BO,$cusid)
	{
	
		$this->edit("customerid=".$cusid, array('BO' => $BO  ));
 
	}

}


?>
