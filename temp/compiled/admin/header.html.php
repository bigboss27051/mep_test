<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Backoffice | Dashboard</title>
 
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
     
    <link rel="stylesheet" href="<?php echo $this->lib_base . "/" . 'templates/bootstrap/css/bootstrap.min.css'; ?>">
     
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
     
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    <link rel="stylesheet" href="<?php echo $this->lib_base . "/" . 'templates/dist/css/AdminLTE.min.css'; ?>">
    
    <link rel="stylesheet" href="<?php echo $this->lib_base . "/" . 'templates/dist/css/skins/_all-skins.min.css'; ?>">
    
    <link rel="stylesheet" href="<?php echo $this->lib_base . "/" . 'templates/plugins/iCheck/flat/blue.css'; ?>">
     
    <link rel="stylesheet" href="<?php echo $this->lib_base . "/" . 'templates/plugins/morris/morris.css'; ?>">
    
    <link rel="stylesheet" href="<?php echo $this->lib_base . "/" . 'templates/plugins/jvectormap/jquery-jvectormap-1.2.2.css'; ?>">
     
    <link rel="stylesheet" href="<?php echo $this->lib_base . "/" . 'templates/plugins/datepicker/datepicker3.css'; ?>">
     
    <link rel="stylesheet" href="<?php echo $this->lib_base . "/" . 'templates/plugins/daterangepicker/daterangepicker-bs3.css'; ?>">
    
    <link rel="stylesheet" href="<?php echo $this->lib_base . "/" . 'templates/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'; ?>">

	 <link rel="stylesheet" href="<?php echo $this->lib_base . "/" . 'templates/plugins/datatables/dataTables.bootstrap.css'; ?>">
  	<script src="<?php echo $this->lib_base . "/" . 'templates/plugins/jQuery/jQuery-2.1.4.min.js'; ?>"></script>
    
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

  </head>
 <body class="hold-transition skin-blue sidebar-mini">
<script>
 
//<!CDATA[
var SITE_URL = "<?php echo $this->_var['site_url']; ?>";
var REAL_SITE_URL = "<?php echo $this->_var['real_site_url']; ?>";
var REAL_BACKEND_URL = "<?php echo $this->_var['real_backend_url']; ?>";
var SITE_URL_ID = "<?php echo $this->_var['id']; ?>";
//]]>
 
function getlangpage(id)
{
 
	
	$.ajax({type:"POST",url:"<?php echo $this->_var['real_backend_url']; ?>/setlang/",data:{setLang:id}, success: function(result){
							        location.reload(); 
							    }}); 
}
function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
</script>

<div class="wrapper">
 
 