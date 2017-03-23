<?php
 
class ReportApp extends BackendApp
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
       
    }
	
	
 
    function index()
    {

	     $this->display('reportwithdraw.index.html');
	 
	}
	function reportbagbonusview()
    {
		 $member_mod =& m('member');
		 $id =	$_GET['id'];
		  

		 $this->assign('userid',$id);
		
	     $this->assign('menus_left', $this->_menu_mod->set_menu('Reports'));
	     $this->display('report_bagbonusview.html');
		 
	}
	function listbagbonusview()
    {
		
	    $member_id = $_POST['member_id'];
	 
		$ter_sum_total =0;
		$ter_sum_out =0;

		$ter_sum_in =0;


		$txt_table  = "<table  id='tablelist' class='table table-striped table-bordered table-hover table-full-width'>";
        $txt_table .= "<thead>";
        $txt_table .= "<tr>";
        $txt_table .= "<th>No</th>";
        $txt_table .= "<th>Date</th>";
		$txt_table .= "<th>User Name</th>";
 
        $txt_table .= "<th>Detail</th>";
		$txt_table .= "<th>For User</th>";
		$txt_table .= "<th>For Name</th>";
        $txt_table .= "<th>In</th>";
		$txt_table .= "<th>Out</th>";
      
        $txt_table .= "</tr>";

		$member_mod =& m('member');

		

	 
			
		$conditions ="   member_id =".$member_id   ; 
		 
		$br_paycom_mod =& m('br_paycom');	
		$cal_af = $br_paycom_mod->find(array(
		            'conditions' => $conditions,
	  				'order' =>  ' pay_id  ASC '
		        ));
	
	 	foreach ($cal_af as $key => $value)
         {
			 
 			$value_in = 0;
			$value_out= 0;
		
			if($cal_af[$key]['type'] == 1)
			{
				$value_in = $cal_af[$key]['value'];
				$ter_sum_in = $ter_sum_in + $cal_af[$key]['value'];
				$t_color ="green";
			}

			if($cal_af[$key]['type'] == 2)
			{
				$value_out = $cal_af[$key]['value'];
				$ter_sum_out = $ter_sum_out + $cal_af[$key]['value'];
				$t_color ="red";
			}
			
			$memname = $member_mod->_get_username_soap3($cal_af[$key]['member_id']);
			$forname = $member_mod->_get_username_soap3($cal_af[$key]['form_id']);
		  	$txt_table .= "<tr>";
	        $txt_table .= "<td>".$cal_af[$key]['pay_id']."</td>";
	     
	        $txt_table .= "<td>".$cal_af[$key]['date']."</td>";
			$txt_table .= "<td style='color:blue'>".$memname['user_name']."</td>";
	
	        $txt_table .= "<td style='color:".$t_color."'>".$cal_af[$key]['pay_name']."</td>";
			$txt_table .= "<td style='color:#CC6600'>".$forname['user_name']."</td>";
			$txt_table .= "<td>".$forname['real_name']."</td>";
	        $txt_table .= "<td align='right' style='color:green'>".number_format($value_in,2)."&nbsp;&nbsp;&nbsp;</td>";
	   		$txt_table .= "<td align='right' style='color:red'>".number_format($value_out,2)."&nbsp;&nbsp;&nbsp;</td>";
	        $txt_table .= "</tr>";


			 
		}
		 
		$ter_sum_total = $ter_sum_in -	$ter_sum_out;
		$txt_table .= "<tr>";
		$txt_table .= "<td colspan='6' align='right'><h4><b>Total</b></h4></td>";
		$txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum_in,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
		$txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum_out,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
		$txt_table .= "</tr>";

		$txt_table .= "<tr>";
	        
	        $txt_table .= "<td colspan='7' align='right'><h4><b>Balance</b></h4></td>";
	        $txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum_total,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
	   
	        $txt_table .= "</tr>";
		
        $txt_table .= "</thead>";
        $txt_table .= "</table>";

		
	
		echo  $txt_table;
		 
	}
	function reportbagbonus()
    {
		 $member_mod =& m('member');
		 $set_autocom =	$member_mod->_getmem_admin_autocomplete();
		 $this->assign('set_autocom',$set_autocom);
	     $this->assign('menus_left', $this->_menu_mod->set_menu('Reports'));
	     $this->display('report_bagbonus.html');
		 
	}
	function listbagbonus()
    {
		
	    $member_id = $_POST['member_id'];
		$date1 =	$_POST['date1'];
		$date2 =	$_POST['date2'];
		$ter_sum_total =0;
		$ter_sum_out =0;

		$ter_sum_in =0;


		$txt_table  = "<table  id='tablelist' class='table table-striped table-bordered table-hover table-full-width'>";
        $txt_table .= "<thead>";
        $txt_table .= "<tr>";
        $txt_table .= "<th>No</th>";
        $txt_table .= "<th>Date</th>";
		$txt_table .= "<th>User Name</th>";
 
        $txt_table .= "<th>Detail</th>";
		$txt_table .= "<th>For User</th>";
		$txt_table .= "<th>For Name</th>";
        $txt_table .= "<th>In</th>";
		$txt_table .= "<th>Out</th>";
      
        $txt_table .= "</tr>";

		$member_mod =& m('member');

		

		if($member_id !="")
		{
			
			 $conditions ="   member_id =".$member_id . "  and  date  BETWEEN '".$date1."' and '".$date2."'" ; 
		}
		else
		{
			 $conditions ="   date  BETWEEN '".$date1."' and '".$date2."'" ;
		}
		$br_paycom_mod =& m('br_paycom');	
		$cal_af = $br_paycom_mod->find(array(
		            'conditions' => $conditions,
	  				'order' =>  ' pay_id  ASC '
		        ));
	
	 	foreach ($cal_af as $key => $value)
         {
			 
 			$value_in = 0;
			$value_out= 0;
		
			if($cal_af[$key]['type'] == 1)
			{
				$value_in = $cal_af[$key]['value'];
				$ter_sum_in = $ter_sum_in + $cal_af[$key]['value'];
				$t_color ="green";
			}

			if($cal_af[$key]['type'] == 2)
			{
				$value_out = $cal_af[$key]['value'];
				$ter_sum_out = $ter_sum_out + $cal_af[$key]['value'];
				$t_color ="red";
			}
			
			$memname = $member_mod->_get_username_soap3($cal_af[$key]['member_id']);
			$forname = $member_mod->_get_username_soap3($cal_af[$key]['form_id']);
		  	$txt_table .= "<tr>";
	        $txt_table .= "<td>".$cal_af[$key]['pay_id']."</td>";
	     
	        $txt_table .= "<td>".$cal_af[$key]['date']."</td>";
			$txt_table .= "<td style='color:blue'>".$memname['user_name']."</td>";
	
	        $txt_table .= "<td style='color:".$t_color."'>".$cal_af[$key]['pay_name']."</td>";
			$txt_table .= "<td style='color:#CC6600'>".$forname['user_name']."</td>";
			$txt_table .= "<td>".$forname['real_name']."</td>";
	        $txt_table .= "<td align='right' style='color:green'>".number_format($value_in,2)."&nbsp;&nbsp;&nbsp;</td>";
	   		$txt_table .= "<td align='right' style='color:red'>".number_format($value_out,2)."&nbsp;&nbsp;&nbsp;</td>";
	        $txt_table .= "</tr>";


			 
		}
		 
		$ter_sum_total = $ter_sum_in -	$ter_sum_out;
		$txt_table .= "<tr>";
		$txt_table .= "<td colspan='6' align='right'><h4><b>Total</b></h4></td>";
		$txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum_in,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
		$txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum_out,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
		$txt_table .= "</tr>";

		$txt_table .= "<tr>";
	        
	        $txt_table .= "<td colspan='7' align='right'><h4><b>Balance</b></h4></td>";
	        $txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum_total,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
	   
	        $txt_table .= "</tr>";
		
        $txt_table .= "</thead>";
        $txt_table .= "</table>";

		
	
		echo  $txt_table;
		 
	}

	function reportwalettuse()
    {
		 $member_mod =& m('member');
		 $set_autocom =	$member_mod->_getmem_admin_autocomplete();
		 $this->assign('set_autocom',$set_autocom);
	     $this->assign('menus_left', $this->_menu_mod->set_menu('Reports'));
	     $this->display('report_walettuse.index.html');
		 
	}
	function listwalettuse()
    {
		
	    $member_id = $_POST['member_id'];
		$date1 =	$_POST['date1'];
		$date2 =	$_POST['date2'];
		$ter_sum =0;




		$txt_table  = "<table  id='tablelist' class='table table-striped table-bordered table-hover table-full-width'>";
        $txt_table .= "<thead>";
        $txt_table .= "<tr>";
        $txt_table .= "<th>No</th>";
        $txt_table .= "<th>Date</th>";
		$txt_table .= "<th>User Name</th>";
		$txt_table .= "<th>Name</th>";
        $txt_table .= "<th>Detail</th>";
		$txt_table .= "<th>For User</th>";
		$txt_table .= "<th>For Name</th>";
        $txt_table .= "<th>Amount</th>";
      
        $txt_table .= "</tr>";

		$member_mod =& m('member');

		

		if($member_id !="")
		{
			
			$conditions =" tran_form =0 and type = 2 and member_id =".$member_id . " and  date  BETWEEN '".$date1."' and '".$date2."'" ; 
		}
		else
		{
			 $conditions =" tran_form =0 and type = 2 and    date  BETWEEN '".$date1."' and '".$date2."'" ;
		}
		$br_wallet_mod =& m('br_wallet');	
		$cal_af = $br_wallet_mod->find(array(
		            'conditions' => $conditions,
	  				'order' =>  ' date  ASC '
		        ));
	
	 	foreach ($cal_af as $key => $value)
         {
		
			$memname = $member_mod->_get_username_soap3($cal_af[$key]['member_id']);
			$forname = $member_mod->_get_username_soap3($cal_af[$key]['for_user']);
		  	$txt_table .= "<tr>";
	        $txt_table .= "<td>".$cal_af[$key]['wallet_id']."</td>";
	     
	        $txt_table .= "<td>".$cal_af[$key]['date']."</td>";
			$txt_table .= "<td style='color:blue'>".$memname['user_name']."</td>";
			$txt_table .= "<td>".$memname['real_name']."</td>";
	        $txt_table .= "<td>".$cal_af[$key]['wal_desc']."</td>";
			$txt_table .= "<td style='color:#CC6600'>".$forname['user_name']."</td>";
			$txt_table .= "<td>".$forname['real_name']."</td>";
	        $txt_table .= "<td align='right' style='color:green'>".number_format($cal_af[$key]['value'],2)."&nbsp;&nbsp;&nbsp;</td>";
	   
	        $txt_table .= "</tr>";


			$ter_sum =$ter_sum + $cal_af[$key]['value'];
		}
		 
		$txt_table .= "<tr>";
	        
	        $txt_table .= "<td colspan='7' align='right'><h4><b>Total</b></h4></td>";
	        $txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
	   
	        $txt_table .= "</tr>";
		
        $txt_table .= "</thead>";
        $txt_table .= "</table>";

		
	
		echo  $txt_table;
		 
	}
	function reportwalett()
    {
		 $member_mod =& m('member');
		 $set_autocom =	$member_mod->_getmem_admin_autocomplete();
		 $this->assign('set_autocom',$set_autocom);
	     $this->assign('menus_left', $this->_menu_mod->set_menu('Reports'));
	     $this->display('report_walett.index.html');
		 
	}

	function listwalett()
    {
		
	    $member_id = $_POST['member_id'];
		$date1 =	$_POST['date1'];
		$date2 =	$_POST['date2'];
		$ter_sum =0;




		$txt_table  = "<table  id='tablelist' class='table table-striped table-bordered table-hover table-full-width'>";
        $txt_table .= "<thead>";
        $txt_table .= "<tr>";
        $txt_table .= "<th>No</th>";
        $txt_table .= "<th>Date</th>";
		$txt_table .= "<th>User Name</th>";
		$txt_table .= "<th>Name</th>";
        $txt_table .= "<th>Detail</th>";
        $txt_table .= "<th>Amount</th>";
      
        $txt_table .= "</tr>";

		$member_mod =& m('member');

		

		if($member_id !="")
		{
			
			$conditions =" tran_form =0 and type = 1 and member_id =".$member_id . " and  date  BETWEEN '".$date1."' and '".$date2."'" ; 
		}
		else
		{
			 $conditions =" tran_form =0 and type = 1 and    date  BETWEEN '".$date1."' and '".$date2."'" ;
		}
		$br_wallet_mod =& m('br_wallet');	
		$cal_af = $br_wallet_mod->find(array(
		            'conditions' => $conditions,
	  				'order' =>  ' date  ASC '
		        ));
	
	 	foreach ($cal_af as $key => $value)
         {
		
			$memname = $member_mod->_get_username_soap3($cal_af[$key]['member_id']);
		  	$txt_table .= "<tr>";
	        $txt_table .= "<td>".$cal_af[$key]['wallet_id']."</td>";
	     
	        $txt_table .= "<td>".$cal_af[$key]['date']."</td>";
			$txt_table .= "<td>".$memname['user_name']."</td>";
			$txt_table .= "<td>".$memname['real_name']."</td>";
	        $txt_table .= "<td>".$cal_af[$key]['wal_desc']."</td>";
	        $txt_table .= "<td align='right'>".number_format($cal_af[$key]['value'],2)."&nbsp;&nbsp;&nbsp;</td>";
	   
	        $txt_table .= "</tr>";


			$ter_sum =$ter_sum + $cal_af[$key]['value'];
		}
		 
		$txt_table .= "<tr>";
	        
	        $txt_table .= "<td colspan='5' align='right'><h4><b>Total</b></h4></td>";
	        $txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
	   
	        $txt_table .= "</tr>";
		
        $txt_table .= "</thead>";
        $txt_table .= "</table>";

		
	
		echo  $txt_table;
		 
	}

	function reportaf()
    {
		 $member_mod =& m('member');
		 $set_autocom =	$member_mod->_getmem_admin_autocomplete();
		 $this->assign('set_autocom',$set_autocom);
	     $this->assign('menus_left', $this->_menu_mod->set_menu('Reports'));
	     $this->display('report_af.index.html');
		 
	}
	function listaf()
    {
		
	    $member_id = $_POST['member_id'];
		$date1 =	$_POST['date1'];
		$date2 =	$_POST['date2'];
		$ter_sum =0;




		$txt_table  = "<table  id='tablelist' class='table table-striped table-bordered table-hover table-full-width'>";
        $txt_table .= "<thead>";
        $txt_table .= "<tr>";
        $txt_table .= "<th>No</th>";
        $txt_table .= "<th>Date</th>";
		$txt_table .= "<th>User Name</th>";
		$txt_table .= "<th>Name</th>";
        $txt_table .= "<th>Detail</th>";
        $txt_table .= "<th>Amount</th>";
      
        $txt_table .= "</tr>";

		$member_mod =& m('member');

		

		if($member_id !="")
		{
			
			$conditions ="type = 1 and member_id =".$member_id . " and  date  BETWEEN '".$date1."' and '".$date2."'" ; 
		}
		else
		{
			 $conditions ="type = 1 and    date  BETWEEN '".$date1."' and '".$date2."'" ;
		}
		$br_af_mod =& m('br_af');	
		$cal_af = $br_af_mod->find(array(
		            'conditions' => $conditions,
	  				'order' =>  ' date  ASC '
		        ));
	
	 	foreach ($cal_af as $key => $value)
         {
		
			$memname = $member_mod->_get_username_soap3($cal_af[$key]['member_id']);
		  	$txt_table .= "<tr>";
	        $txt_table .= "<td>".$cal_af[$key]['af_id']."</td>";
	     
	        $txt_table .= "<td>".$cal_af[$key]['date']."</td>";
			$txt_table .= "<td>".$memname['user_name']."</td>";
			$txt_table .= "<td>".$memname['real_name']."</td>";
	        $txt_table .= "<td>".$cal_af[$key]['af_name']."</td>";
	        $txt_table .= "<td align='right'>".number_format($cal_af[$key]['value'],2)."&nbsp;&nbsp;&nbsp;</td>";
	   
	        $txt_table .= "</tr>";


			$ter_sum =$ter_sum + $cal_af[$key]['value'];
		}
		 
		$txt_table .= "<tr>";
	        
	        $txt_table .= "<td colspan='5' align='right'><h4><b>Total</b></h4></td>";
	        $txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
	   
	        $txt_table .= "</tr>";
		
        $txt_table .= "</thead>";
        $txt_table .= "</table>";

		
	
		echo  $txt_table;
		 
	}

  
	function reportcomsponsor()
    {
		 $member_mod =& m('member');
		 $set_autocom =	$member_mod->_getmem_admin_autocomplete();
		 $this->assign('set_autocom',$set_autocom);
	     $this->assign('menus_left', $this->_menu_mod->set_menu('Reports'));

	     $this->display('reportcomsponsor.index.html');
	}
	function listsponsor()
    {
		
	    $member_id = $_POST['member_id'];
		$date1 =	$_POST['date1'];
		$date2 =	$_POST['date2'];
		$ter_sum =0;

		 
	 

		$txt_table  = "<table  id='tablelist' class='table table-striped table-bordered table-hover table-full-width'>";
        $txt_table .= "<thead>";
        $txt_table .= "<tr>";
        $txt_table .= "<th>No</th>";
        $txt_table .= "<th>Date</th>";
		$txt_table .= "<th>User name</th>";
		$txt_table .= "<th>Name</th>";
        $txt_table .= "<th>Detail</th>";
		$txt_table .= "<th>From PV</th>";
		$txt_table .= "<th>Fast Start (%)</th>";
        $txt_table .= "<th>Total</th>";
      
        $txt_table .= "</tr>";

		$member_mod =& m('member');
	 

		

		if($member_id)
		{
			
			$conditions ="type = 1 and member_id =".$member_id . " and  date  BETWEEN '".$date1."' and '".$date2."'" ;
		}
		else
		{
			$conditions ="type = 1   and  date  BETWEEN '".$date1."' and '".$date2."'" ;
		}
		
		
		$br_fast_start_mod =& m('br_fast_start');
		$cal_af = $br_fast_start_mod->find(array(
		            'conditions' => $conditions,
	  				'order' =>  ' date  ASC '
		        ));
	
	 	foreach ($cal_af as $key => $value)
         {
			$memname = $member_mod->_get_username_soap3($cal_af[$key]['member_id']);

		  	$txt_table .= "<tr>";
	        $txt_table .= "<td>".$cal_af[$key]['fast_start_id']."</td>";
	     
	        $txt_table .= "<td>".$cal_af[$key]['date']."</td>";
			$txt_table .= "<td>".$memname['user_name']."</td>";
			$txt_table .= "<td>".$memname['real_name']."</td>";
	        $txt_table .= "<td>".$cal_af[$key]['fast_start_name']."</td>";
			$txt_table .= "<td align='right'>".number_format($cal_af[$key]['form_pv'],2)."&nbsp;&nbsp;&nbsp;</td>";
			$txt_table .= "<td align='center'>".number_format($cal_af[$key]['pv_percent'],2)." </td>";
	        $txt_table .= "<td align='right'>".number_format($cal_af[$key]['value'],2)."&nbsp;&nbsp;&nbsp;</td>";
	   
	        $txt_table .= "</tr>";


			$ter_sum =$ter_sum + $cal_af[$key]['value'];
		}
		 
		$txt_table .= "<tr>";
	        
	        $txt_table .= "<td colspan='7' align='right'><h4><b>Total</b></h4></td>";
	        $txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
	   
	        $txt_table .= "</tr>";
		
        $txt_table .= "</thead>";
        $txt_table .= "</table>";

		
	
		echo  $txt_table;
		 
	}
	function reportmaintained()
    {
		$member_mod =& m('member');
		 $set_autocom =	$member_mod->_getmem_admin_autocomplete();
		 $this->assign('set_autocom',$set_autocom);
	     $this->assign('menus_left', $this->_menu_mod->set_menu('Reports'));

	     $this->display('report_maintained.index.html');
	}
	function listmaintained()
    {
		
	    $member_id = $_POST['member_id'];
		$date1 =	$_POST['date1'];
		$date2 =	$_POST['date2'];
		$ter_sum_L =0;
		$ter_sum_R =0;
		 
	 

		$txt_table  = "<table  id='tablelist' class='table table-striped table-bordered table-hover table-full-width'>";
        $txt_table .= "<thead>";
        $txt_table .= "<tr>";
        $txt_table .= "<th>No</th>";
        $txt_table .= "<th>Date</th>";
		$txt_table .= "<th>User name</th>";
		$txt_table .= "<th>Name</th>";
        $txt_table .= "<th>Maintained</th>";
		$txt_table .= "<th>Amount (pv)</th>";
	 
      
      
        $txt_table .= "</tr>";

		$member_mod =& m('member');
	 	if($member_id)
		{
			
			$conditions =" position ='M'  and  type = 1 and member_id =".$member_id . " and  date  BETWEEN '".$date1."' and '".$date2."'" ;
		}
		else
		{
			$conditions =" position ='M' and  type = 1  and  date  BETWEEN '".$date1."' and '".$date2."'" ;
		}

	
		
		
		$bravo_binary_mod =& m('bravo_binary');
		$cal_af = $bravo_binary_mod->find(array(
		            'conditions' => $conditions,
	  				'order' =>  ' date  ASC ,order_id ASC'
		        ));
	
	 	foreach ($cal_af as $key => $value)
         {

				$memname = $member_mod->_get_username_soap3($cal_af[$key]['member_id']);

			 

				 
		  	$txt_table .= "<tr>";
	        $txt_table .= "<td>".$cal_af[$key]['binary_id']."</td>";
	     
	        $txt_table .= "<td>".$cal_af[$key]['date']."</td>";
			$txt_table .= "<td>".$memname['user_name']."</td>";
			$txt_table .= "<td>".$memname['real_name']."</td>";
	        $txt_table .= "<td>".$cal_af[$key]['binary_name']."</td>";
			$txt_table .= "<td align='right'>".number_format($cal_af[$key]['value'],2)."&nbsp;&nbsp;&nbsp;</td>";
			 
	        $txt_table .= "</tr>";

			$ter_sum =$ter_sum + $cal_af[$key]['value'];
			
		}
		 
		$txt_table .= "<tr>";
	        
	        $txt_table .= "<td colspan='5' align='right'><h4><b>Total</b></h4></td>";
	        $txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
	   	 
	        $txt_table .= "</tr>";
		
        $txt_table .= "</thead>";
        $txt_table .= "</table>";

		
	
		echo  $txt_table;
		 
	}
 
	function reportcycle()
    {
		$member_mod =& m('member');
		 $set_autocom =	$member_mod->_getmem_admin_autocomplete();
		 $this->assign('set_autocom',$set_autocom);
	     $this->assign('menus_left', $this->_menu_mod->set_menu('Reports'));

	    $this->display('report_cycle.index.html');
	}
	
 	function listcycle()
    {
		
	    $member_id = $_POST['member_id'];
		$date1 =	$_POST['date1'];
		$date2 =	$_POST['date2'];
		$ter_sum_L =0;
		$ter_sum_R =0;
		 
	 

		$txt_table  = "<table  id='tablelist' class='table table-striped table-bordered table-hover table-full-width'>";
        $txt_table .= "<thead>";
        $txt_table .= "<tr>";
        $txt_table .= "<th>No</th>";
        $txt_table .= "<th>Date</th>";
		$txt_table .= "<th>User name</th>";
		$txt_table .= "<th>Name</th>";
        $txt_table .= "<th>Detail</th>";
		$txt_table .= "<th>Left point</th>";
		$txt_table .= "<th>Right point</th>";
      
      
        $txt_table .= "</tr>";

		$member_mod =& m('member');
	 	if($member_id)
		{
			
			$conditions =" (position ='L' or position ='R') and value > 0  and member_id =".$member_id . " and  date  BETWEEN '".$date1."' and '".$date2."'" ;
		}
	 

	
		
		//echo $conditions;
		$bravo_binary_mod =& m('bravo_binary');
		$cal_af = $bravo_binary_mod->find(array(
		            'conditions' => $conditions,
	  				'order' =>  ' date  ASC ,order_id ASC'
		        ));
	
	 	foreach ($cal_af as $key => $value)
         {

				$memname = $member_mod->_get_username_soap3($cal_af[$key]['member_id']);

				$l_point =0;
				$R_point =0;
				if($cal_af[$key]['position'] == 'L')
				{
					if($cal_af[$key]['type'] == 1)
					{
						$ter_sum_L =$ter_sum_L + $cal_af[$key]['value'];
					}
					if($cal_af[$key]['type'] == 2)
					{
						$ter_sum_L =$ter_sum_L - $cal_af[$key]['value'];
					}
					
					
					$l_point = $cal_af[$key]['value'];
				}

				if($cal_af[$key]['position'] == 'R')
				{
					if($cal_af[$key]['type'] == 1)
					{
						$ter_sum_R =$ter_sum_R + $cal_af[$key]['value'];
					}
					if($cal_af[$key]['type'] == 2)
					{
						$ter_sum_R =$ter_sum_R - $cal_af[$key]['value'];
					}
					
					$R_point  = $cal_af[$key]['value'];
				}

			$txtcolor = "green";

			if($cal_af[$key]['type'] == 1)
			{
				if($cal_af[$key]['position'] == 'L')
				{
					$txtcolor = "navy";
				}

			}
			if($cal_af[$key]['type'] == 2)
			{
				$txtcolor = "red";
			}
				 
		  	$txt_table .= "<tr style='color:".$txtcolor."'>";
	        $txt_table .= "<td>".$cal_af[$key]['binary_id']."</td>";
	     
	        $txt_table .= "<td>".$cal_af[$key]['date']."</td>";
			$txt_table .= "<td>".$memname['user_name']."</td>";
			$txt_table .= "<td>".$memname['real_name']."</td>";

			$order_txt ="";
			if($cal_af[$key]['order_id'])
			{
				$order_txt ="<a href='index.php?app=order&act=view&id=".$cal_af[$key]['order_id']."' target='_blank'    >   Detail</a> ";;
			}
	        $txt_table .= "<td>".$cal_af[$key]['binary_name']." ".$order_txt."</td>";
			$txt_table .= "<td align='right'>".number_format($l_point,2)."&nbsp;&nbsp;&nbsp;</td>";
			 
	        $txt_table .= "<td align='right'>".number_format($R_point,2)."&nbsp;&nbsp;&nbsp;</td>";
	   
	        $txt_table .= "</tr>";


			
		}
		 
		$txt_table .= "<tr>";
	        
	        $txt_table .= "<td colspan='5' align='right'><h4><b>Total</b></h4></td>";
	        $txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum_L,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
	   		 $txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum_R,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
	        $txt_table .= "</tr>";
		
        $txt_table .= "</thead>";
        $txt_table .= "</table>";

		
	
		echo  $txt_table;
		 
	}

	function reportcomshowcycle()
    {
		 $member_mod =& m('member');
		 $set_autocom =	$member_mod->_getmem_admin_autocomplete();
		 $this->assign('set_autocom',$set_autocom);
	     $this->assign('menus_left', $this->_menu_mod->set_menu('Reports'));

	     $this->display('report_showcycle.index.html');
	}
	function listshowcycle()
    {
		
	    $member_id = $_POST['member_id'];
		$date1 =	$_POST['date1'];
		$date2 =	$_POST['date2'];
		$ter_sum =0;
	 
		 
	 

 
        $txt_table .= "<table id='myTbuser' class='table table-striped table-bordered table-hover table-full-width' style='color:#000000;'>";
		$txt_table .= "<thead>";
		$txt_table .= "<tr >";
		$txt_table .= "<th style='width: 37px;'  colspan='1' rowspan='2'   >Date</th>";
 
		$txt_table .= "<th style='width: 111px;' colspan='1' rowspan='2' >Name</th>";
		$txt_table .= "<th style='width: 108px;' colspan='2' rowspan='1'   align='center'>Cycle</th> ";
		$txt_table .= "<th style='width: 108px;' colspan='3' rowspan='1'   >Cycle pay (Lvl First) </th> ";
		$txt_table .= "<th style='width: 108px;' colspan='3' rowspan='1'   >Cycle pay (Lvl Second ) </th> ";
		$txt_table .= "<th style='width: 108px;' colspan='3' rowspan='1'   >Cycle pay (Lvl Third)  </th> ";
		$txt_table .= "<th style='width: 108px;' colspan='1' rowspan='2'  >Use Cycle</th> ";
		$txt_table .= "<th style='width: 108px;' colspan='2' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' >balance</th> ";
 		$txt_table .= "<th style='width: 108px;' colspan='1' rowspan='2' aria-controls='sample_1' tabindex='0' role='columnheader' >Total Pay</th> ";
		$txt_table .= "</tr>";
		$txt_table .= "<tr role='row' class='th' align='center'>";
		$txt_table .= "<th style='width: 108px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' >Left</th> ";
		$txt_table .= "<th style='width: 108px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' >Right</th> ";
		$txt_table .= "<th style='width: 108px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' >Qty </th> ";
		$txt_table .= "<th style='width: 108px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' >Pay / Cycle</th> ";
		$txt_table .= "<th style='width: 108px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' >Total</th> ";
		$txt_table .= "<th style='width: 108px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' >Qty </th> ";
		$txt_table .= "<th style='width: 108px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' >Pay / Cycle</th> ";
		$txt_table .= "<th style='width: 108px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' >Total</th> ";
		$txt_table .= "<th style='width: 108px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' >Qty </th> ";
		$txt_table .= "<th style='width: 108px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' >Pay / Cycle</th> ";
		$txt_table .= "<th style='width: 108px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' >Total</th> ";
		$txt_table .= "<th style='width: 108px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' >Left</th>"; 
		$txt_table .= "<th style='width: 108px;' colspan='1' rowspan='1' aria-controls='sample_1' tabindex='0' role='columnheader' >Right</th> ";
		$txt_table .= "</tr>";
		$txt_table .= "</thead>";
											

		$member_mod =& m('member');
	 

		
		
		if($member_id)
		{
			$conditions ="    member_id =".$member_id . " and  date  BETWEEN '".$date1."' and '".$date2."'" ;
			
		}
		else
		{
			$conditions ="       date  BETWEEN '".$date1."' and '".$date2."'" ;
		}
		
		$bravo_binary_mod =& m('br_com_cycle_report');
		$cal_af = $bravo_binary_mod->find(array(
		            'conditions' => $conditions,
	  				'order' =>  ' date  ASC   '
		        ));
	
		$int_row =1;
	 	foreach ($cal_af as $key => $value)
         {
			  
 			$memname = $member_mod->_get_username_soap3($cal_af[$key]['member_id']);

				 
		  	$txt_table .= "<tr>";
	    
	     
	        $txt_table .= "<td>".$cal_af[$key]['date']."</td>";
			 
			$txt_table .= "<td>".$memname['real_name']."</td>";
	     
			$txt_table .= "<td align='right' style='color:#336699;'>".number_format($cal_af[$key]['befor_total_left'],2)."&nbsp;&nbsp;&nbsp;</td>";
			 
	        $txt_table .= "<td align='right' style='color:#336699;'>".number_format($cal_af[$key]['befor_total_right'],2)."&nbsp;&nbsp;&nbsp;</td>";
			
			$txt_table .= "<td align='right'>".number_format($cal_af[$key]['qty1'],2)."&nbsp;&nbsp;&nbsp;</td>";
			 
	        $txt_table .= "<td align='right'>".number_format($cal_af[$key]['per_cycle1'],2)."&nbsp;&nbsp;&nbsp;</td>";
			
			$txt_table .= "<td align='right' style='color:green;'>".number_format($cal_af[$key]['total1'],2)."&nbsp;&nbsp;&nbsp;</td>";
			 

				
			$txt_table .= "<td align='right'>".number_format($cal_af[$key]['qty2'],2)."&nbsp;&nbsp;&nbsp;</td>";
			 
	        $txt_table .= "<td align='right'>".number_format($cal_af[$key]['per_cycle2'],2)."&nbsp;&nbsp;&nbsp;</td>";
			
			$txt_table .= "<td align='right' style='color:green;'>".number_format($cal_af[$key]['total2'],2)."&nbsp;&nbsp;&nbsp;</td>";
			
				$txt_table .= "<td align='right'>".number_format($cal_af[$key]['qty3'],2)."&nbsp;&nbsp;&nbsp;</td>";
			 
	        $txt_table .= "<td align='right'>".number_format($cal_af[$key]['per_cycle3'],2)."&nbsp;&nbsp;&nbsp;</td>";
			
			$txt_table .= "<td align='right' style='color:green;'>".number_format($cal_af[$key]['total3'],2)."&nbsp;&nbsp;&nbsp;</td>";
			 

	        $txt_table .= "<td align='right' style='color:#CC6600'>".number_format($cal_af[$key]['cycle_total'],2)."&nbsp;&nbsp;&nbsp;</td>";
	  
	   		$txt_table .= "<td align='right'>".number_format($cal_af[$key]['total_left'],2)."&nbsp;&nbsp;&nbsp;</td>";
			$txt_table .= "<td align='right'  >".number_format($cal_af[$key]['total_right'],2)."&nbsp;&nbsp;&nbsp;</td>";
	  		$txt_table .= "<td align='right' style='color:blue'>".number_format($cal_af[$key]['total_pay'],2)."&nbsp;&nbsp;&nbsp;</td>";
		
	        $txt_table .= "</tr>";


			$ter_sum =$ter_sum + $cal_af[$key]['total_pay'];
		}
		 
		$txt_table .= "<tr>";
	        
	        $txt_table .= "<td colspan='16' align='right'><h4><b>Total</b></h4></td>";
	         
	   		 $txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
	        $txt_table .= "</tr>";
		
        $txt_table .= "</thead>";
        $txt_table .= "</table>";

		
	
		echo  $txt_table;
		 
	}
	function reportwithdraw()
    {
		 $member_mod =& m('member');
		 $set_autocom =	$member_mod->_getmem_admin_autocomplete();
		 $this->assign('set_autocom',$set_autocom);
	     $this->assign('menus_left', $this->_menu_mod->set_menu('Reports'));

	     $this->display('report_withdraw.html');
	} 
	function listwithdraw()
    {
		
	    $member_id =  $_POST['member_id'];
		$date1 =	$_POST['date1'];
		$date2 =	$_POST['date2'];
		$ter_sum =0;
	 
		 $res_status = array();
		$res_status[0] ="Pending";
		$res_status[1] ="Paid";
	 
		$res_bank = array();
		$res_bank[35] ="KTB Bank";	
		$res_bank[36] ="Bangkok Bank";
		$res_bank[37] ="SCB Bank"; 
		$res_bank[38] ="Kasikorn Bank";
		$txt_table  = "<table  id='tablelist' class='table table-striped table-bordered table-hover table-full-width'>";
        $txt_table .= "<thead>";
        $txt_table .= "<tr>";
        $txt_table .= "<th>No</th>";
        $txt_table .= "<th>Date</th>";
 
		$txt_table .= "<th>Name</th>"; 
		$txt_table .= "<th>Bank</th>";
		$txt_table .= "<th>Bank Acc.</th>";
		$txt_table .= "<th>Commission</th>";
		$txt_table .= "<th> Amount</th>";
		$txt_table .= "<th> Vat (5%) </th>";
		$txt_table .= "<th> Total</th>";
		$txt_table .= "<th>Pay Date</th>";
		$txt_table .= "<th>Status</th>";
		$txt_table .= "<th></th>";
        $txt_table .= "</tr>";


		$member_mod =& m('member');
	 

		
		
		if($member_id)
		{
			$conditions =" pay=1 and approv=0 and  member_id =".$member_id . " and  date  BETWEEN '".$date1."' and '".$date2."'" ;
			
		}
		else
		{
			$conditions =" pay=1 and approv=0 and   date  BETWEEN '".$date1."' and '".$date2."'" ;
		}
		
		$br_reward_mod =& m('br_reward');
		$cal_af = $br_reward_mod->find(array(
		            'conditions' => $conditions,
	  				'order' =>  ' date  ASC   '
		        ));
	
		$int_row =1;
	 	foreach ($cal_af as $key => $value)
         {
			  
 			$memname = $member_mod->_get_username_soap3($cal_af[$key]['member_id']);

				 
		  	$txt_table .= "<tr>";
	        $txt_table .= "<td>".$cal_af[$key]['rw_id']."</td>";
	     
	        $txt_table .= "<td>".$cal_af[$key]['date']."</td>";
			 
			$txt_table .= "<td>".$memname['real_name']."</td>";
	     	$txt_table .= "<td>".$res_bank[$memname['name_bank']]."</td>";
			$txt_table .= "<td>".$memname['bank_account']."</td>"; 
	  
	   		$txt_table .= "<td >".$cal_af[$key]['rw_name']."</td>";
			$txt_table .= "<td align='right'  style='color:blue'>".number_format($cal_af[$key]['value'],2)."&nbsp;&nbsp;&nbsp;</td>";
			$txt_table .= "<td align='right'  style='color:blue'>".number_format($cal_af[$key]['vat'],2)."&nbsp;&nbsp;&nbsp;</td>";
	  		$txt_table .= "<td align='right'  style='color:blue'>".number_format($cal_af[$key]['amount'],2)."&nbsp;&nbsp;&nbsp;</td>";
			$txt_table .= "<td>".$cal_af[$key]['du_date']."</td>";
			$txt_table .= "<td >".$res_status[$cal_af[$key]['approv']]."</td>";

			$txt_table .= "<td > <a href='javascript:withdrawid(".$cal_af[$key]['rw_id'].");' id='withdraw'    class='btn btn-blue next-step btn-block' tabindex=20    >Paid</a><form id='a".$cal_af[$key]['rw_id']."' action='index.php?app=report&act=addpaywithdraw' method='post'><input type='hidden' name='rw_id' value='".$cal_af[$key]['rw_id']."'> </form></td>"; 
			 
	        $txt_table .= "</tr>";


			$ter_sum =$ter_sum + $cal_af[$key]['amount'];
		}
		 
		$txt_table .= "<tr>";
	        
	        $txt_table .= "<td colspan='8' align='right'><h4><b>Total</b></h4></td>";
	         
	   		$txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
	        $txt_table .= "</tr>";
		
        $txt_table .= "</thead>";
        $txt_table .= "</table>";

		
	
		echo  $txt_table;
		 
	} 

	function addpaywithdraw()
    {
		if (IS_POST)
        {
			$rw_id =	$_POST['rw_id'];
			 $ff = date("Y-m-d");
			 $data = array(
	                'approv' =>  1,
					'approv_date' =>  $ff ,
				);
			$br_reward_mod =& m('br_reward');
			$br_reward_mod->edit($rw_id,$data); 
		   	$this->show_message('update_ok' );
		}

	}

	function reportshowwithdraw()
    {
		 $member_mod =& m('member');
		 $set_autocom =	$member_mod->_getmem_admin_autocomplete();
		 $this->assign('set_autocom',$set_autocom);
	     $this->assign('menus_left', $this->_menu_mod->set_menu('Reports'));

	     $this->display('report_showwithdraw.html');
	} 
	function listshowwithdraw()
    {
		
	    $member_id =  $_POST['member_id'];
		$date1 =	$_POST['date1'];
		$date2 =	$_POST['date2'];
		$ter_sum =0;
	 
		 $res_status = array();
		$res_status[0] ="Pending";
		$res_status[1] ="Paid";
	 
		$res_bank = array();
		$res_bank[35] ="KTB Bank";	
		$res_bank[36] ="Bangkok Bank";
		$res_bank[37] ="SCB Bank"; 
		$res_bank[38] ="Kasikorn Bank";
		$txt_table  = "<table  id='tablelist' class='table table-striped table-bordered table-hover table-full-width'>";
        $txt_table .= "<thead>";
        $txt_table .= "<tr>";
        $txt_table .= "<th>No</th>";
        $txt_table .= "<th>Date</th>";
 
		$txt_table .= "<th>Name</th>"; 
		$txt_table .= "<th>Bank</th>";
		$txt_table .= "<th>Bank Acc.</th>";
		$txt_table .= "<th>Commission</th>";
		$txt_table .= "<th> Amount</th>";
		$txt_table .= "<th> Vat (5%) </th>";
		$txt_table .= "<th> Total</th>";
		$txt_table .= "<th>Pay Date</th>";
		$txt_table .= "<th>Status</th>";
	 
        $txt_table .= "</tr>";


		$member_mod =& m('member');
	 

		
		
		if($member_id)
		{
			$conditions =" pay=1 and approv=1 and  member_id =".$member_id . " and  date  BETWEEN '".$date1."' and '".$date2."'" ;
			
		}
		else
		{
			$conditions =" pay=1 and approv=1 and   date  BETWEEN '".$date1."' and '".$date2."'" ;
		}
		
		$br_reward_mod =& m('br_reward');
		$cal_af = $br_reward_mod->find(array(
		            'conditions' => $conditions,
	  				'order' =>  ' date  ASC   '
		        ));
	
		$int_row =1;
	 	foreach ($cal_af as $key => $value)
         {
			  
 			$memname = $member_mod->_get_username_soap3($cal_af[$key]['member_id']);

				 
		  	$txt_table .= "<tr>";
	        $txt_table .= "<td>".$cal_af[$key]['rw_id']."</td>";
	     
	        $txt_table .= "<td>".$cal_af[$key]['date']."</td>";
			 
			$txt_table .= "<td>".$memname['real_name']."</td>";
	     	$txt_table .= "<td>".$res_bank[$memname['name_bank']]."</td>";
			$txt_table .= "<td>".$memname['bank_account']."</td>"; 
	  
	   		$txt_table .= "<td >".$cal_af[$key]['rw_name']."</td>";
			$txt_table .= "<td align='right'  style='color:blue'>".number_format($cal_af[$key]['value'],2)."&nbsp;&nbsp;&nbsp;</td>";
			$txt_table .= "<td align='right'  style='color:blue'>".number_format($cal_af[$key]['vat'],2)."&nbsp;&nbsp;&nbsp;</td>";
	  		$txt_table .= "<td align='right'  style='color:blue'>".number_format($cal_af[$key]['amount'],2)."&nbsp;&nbsp;&nbsp;</td>";
			$txt_table .= "<td>".$cal_af[$key]['du_date']."</td>";
			$txt_table .= "<td >".$res_status[$cal_af[$key]['approv']]."</td>";

		 	 
	        $txt_table .= "</tr>";


			$ter_sum =$ter_sum + $cal_af[$key]['amount'];
		}
		 
		$txt_table .= "<tr>";
	        
	        $txt_table .= "<td colspan='8' align='right'><h4><b>Total</b></h4></td>";
	         
	   		$txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
	        $txt_table .= "</tr>";
		
        $txt_table .= "</thead>";
        $txt_table .= "</table>";

		
	
		echo  $txt_table;
		 
	} 
	function reportfast()
    {
		$member_mod =& m('member');
		 $set_autocom =	$member_mod->_getmem_admin_autocomplete();
		 $this->assign('set_autocom',$set_autocom);
	     $this->assign('menus_left', $this->_menu_mod->set_menu('Reports'));

	    $this->display('report_fast.index.html');
	}
	function listfast()
    {
		
	    $member_id = $_POST['member_id'];
		$date1 =	$_POST['date1'];
		$date2 =	$_POST['date2'];
		$ter_sum_L =0;
		$ter_sum_R =0;
		 
	 

		$txt_table  = "<table  id='tablelist' class='table table-striped table-bordered table-hover table-full-width'>";
        $txt_table .= "<thead>";
        $txt_table .= "<tr>";
        $txt_table .= "<th>No</th>";
        $txt_table .= "<th>Date</th>";
		$txt_table .= "<th>User name</th>";
		$txt_table .= "<th>Name</th>";
        $txt_table .= "<th>Detail</th>";
		$txt_table .= "<th>IN</th>";
		$txt_table .= "<th>OUT</th>";
      
      
        $txt_table .= "</tr>";

		$member_mod =& m('member');
	 	if($member_id)
		{
			
			$conditions =" value > 0 and  member_id =".$member_id . " and  date  BETWEEN '".$date1."' and '".$date2."'" ;
		}
	 

	
		
		//echo $conditions;
		$br_fast_start_mod =& m('br_fast_start');
		$cal_af = $br_fast_start_mod->find(array(
		            'conditions' => $conditions,
	  				'order' =>  ' date  ASC ,order_id ASC'
		        ));
	
	 	foreach ($cal_af as $key => $value)
         {
				$l_point = 0;
				$R_point = 0;

				$memname = $member_mod->_get_username_soap3($cal_af[$key]['member_id']);

			 	$l_point = 0;
				if($cal_af[$key]['type'] == 1)
				{
					$ter_value = $ter_valueL + $cal_af[$key]['value'];

					$l_point  = $cal_af[$key]['value'];
				}
				if($cal_af[$key]['type'] == 2)
				{
					$ter_value = $ter_value - $cal_af[$key]['value'];
					$R_point = $cal_af[$key]['value'];
				}
					
					
				 
			 
			 

			

			if($cal_af[$key]['type'] == 1)
			{
				 
				$txtcolor = "green";
				 

			}
			if($cal_af[$key]['type'] == 2)
			{
				$txtcolor = "red";
			}
				 
		  	$txt_table .= "<tr style='color:".$txtcolor."'>";
	        $txt_table .= "<td>".$cal_af[$key]['fast_start_id']."</td>";
	     
	        $txt_table .= "<td>".$cal_af[$key]['date']."</td>";
			$txt_table .= "<td>".$memname['user_name']."</td>";
			$txt_table .= "<td>".$memname['real_name']."</td>";

			$order_txt ="";
			if($cal_af[$key]['order_id'])
			{
				$order_txt ="<a href='index.php?app=order&act=view&id=".$cal_af[$key]['order_id']."' target='_blank'    >   Detail</a> ";;
			}
	        $txt_table .= "<td>".$cal_af[$key]['fast_start_name']." ".$order_txt."</td>";
			$txt_table .= "<td align='right'>".number_format($l_point,2)."&nbsp;&nbsp;&nbsp;</td>";
			 
	        $txt_table .= "<td align='right'>".number_format($R_point,2)."&nbsp;&nbsp;&nbsp;</td>";
	   
	        $txt_table .= "</tr>";


			
		}
		 
		$txt_table .= "<tr>";
	        
	        $txt_table .= "<td colspan='5' align='right'><h4><b>Total</b></h4></td>";
	        $txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum_L,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
	   		 $txt_table .= "<td align='right' ><p style='border-bottom: 3px double;font-size:20px;'> ".number_format($ter_sum_R,2)." </p>&nbsp;&nbsp;&nbsp;</td>";
	        $txt_table .= "</tr>";
		
        $txt_table .= "</thead>";
        $txt_table .= "</table>";

		
	
		echo  $txt_table;
		 
	}


	
}

?>