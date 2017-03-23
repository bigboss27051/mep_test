<?php
 
class ReportwithdrawApp extends BackendApp
{
    var $_menu_mod;	
	var $_cr_portsell_mod;
	var $_cr_sell_mod;
	var $_bag_mod;
	var $_cr_buy_mod;

    function __construct()
    {
        $this->ReportwithdrawApp();
    }
    function ReportwithdrawApp()
    {
        parent::BackendApp();
		$this->_menu_mod =& m('menuleft');
        $this->_cr_portsell_mod =& m('cr_portsell');
		$this->_cr_sell_mod =& m('cr_sell');
		$this->_bag_mod =& m('bag');
		$this->_cr_buy_mod =& m('cr_buy');
    }
	
	
 
    function index()
    {

	     $this->display('reportwithdraw.index.html');
	}
     function reportwallet()
    {

	     $this->display('reportwallet.index.html');
	}
	 function reportvoucher()
    {

	     $this->display('reportvoucher.index.html');
	}
	function reportsavestatus()
    {

	     $this->display('reportsavestatus.index.html');
	}
	function reportpercentagepay()
    {

	     $this->display('reportpercentagepay.index.html');
	}
	 function reportchangepos()
    {

	     $this->display('reportchangepos.index.html');
	}
	function reportcomsponsor()
    {

	     $this->display('reportcomsponsor.index.html');
	}
	function reportcomteamsell()
    {

	     $this->display('reportcomteamsell.index.html');
	}
	function reportcomautoship()
    {

	     $this->display('reportcomautoship.index.html');
	}
	function reportsummarypay()
    {

	     $this->display('reportsummarypay.index.html');
	}
	function reportsummarynopay()
    {

	     $this->display('reportsummarynopay.index.html');
	}
	function reportcomunilevel()
    {

	     $this->display('reportcomunilevel.index.html');
	}
}

?>
