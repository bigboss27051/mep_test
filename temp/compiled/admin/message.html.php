 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MLM Software | Log in</title>
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="<?php echo $this->lib_base . "/" . 'templates/bootstrap/css/bootstrap.min.css'; ?>">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    <link rel="stylesheet" href="<?php echo $this->lib_base . "/" . 'templates/dist/css/AdminLTE.min.css'; ?>">
    
    <link rel="stylesheet" href="<?php echo $this->lib_base . "/" . 'templates/plugins/iCheck/square/blue.css'; ?>">

    
    
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 
 
<script>
var RecaptchaOptions = {
   theme : 'white',
   lang : 'en',
   tabindex : 2
};
</script>
  </head>

  <body class="hold-transition login-page"  style="overflow:hidden;">
    <div class="login-box">
      <div class="login-logo">
     
      </div>
      <div class="login-box-body">

		    <table align="center">
				<tr>
					<td> <h4><?php echo $this->_var['message']; ?></h4> </td>
				</tr>
				<?php if ($this->_var['redirect']): ?>
				
				<?php else: ?>
		 		 <?php $_from = $this->_var['links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
			   	<tr><td><a href="<?php echo $this->_var['item']['href']; ?>" class="forward"><?php echo $this->_var['item']['text']; ?></a></td></tr>
			    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			 <?php endif; ?>
			</table>
 
		<?php if ($this->_var['redirect']): ?>
        <p class="login-box-msg" >Please Wait.......</p>
       
        <table align="center">
			<tr>
				<td> <img     src="templates/images/Preloader_8.gif" width="100"></td>
			</tr>
		</table>
		<?php endif; ?>
	

      </div>
    </div>

	<?php if ($this->_var['redirect']): ?>
	<script type="text/javascript">
	<!--
	window.setTimeout("<?php echo $this->_var['redirect']; ?>", 3000);
	//-->
	</script>
	<?php endif; ?>
    
    <script src="<?php echo $this->lib_base . "/" . 'templates/plugins/jQuery/jQuery-2.1.4.min.js'; ?>"></script>
    
    <script src="<?php echo $this->lib_base . "/" . 'templates/bootstrap/js/bootstrap.min.js'; ?>"></script>
    
    <script src="<?php echo $this->lib_base . "/" . 'templates/plugins/iCheck/icheck.min.js'; ?>"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>



     

 


 