<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->lib_base . "/" . 'templates2/assets/ico/apple-touch-icon-144-precomposed.png'; ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->lib_base . "/" . 'templates2/assets/ico/apple-touch-icon-114-precomposed.png'; ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->lib_base . "/" . 'templates2/assets/ico/apple-touch-icon-72-precomposed.png'; ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $this->lib_base . "/" . 'templates2/assets/ico/apple-touch-icon-57-precomposed.png'; ?>">
    <link rel="shortcut icon" href="<?php echo $this->lib_base . "/" . 'templates2/assets/ico/favicon.png'; ?>">
    <title>BOOTCLASIFIED - Responsive Classified Theme</title>
    
    <link href="<?php echo $this->lib_base . "/" . 'templates2/assets/bootstrap/css/bootstrap.min.css'; ?>" rel="stylesheet">

    
    <link href="<?php echo $this->lib_base . "/" . 'templates2/assets/css/style.css'; ?>" rel="stylesheet">

    
    <link href="<?php echo $this->lib_base . "/" . 'templates2/assets/css/owl.carousel.css'; ?>" rel="stylesheet">
    <link href="<?php echo $this->lib_base . "/" . 'templates2/assets/css/owl.theme.css'; ?>" rel="stylesheet">

    
    
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    

    <script>
        paceOptions = {
            elements: true
        };
    </script>
    <script src="<?php echo $this->lib_base . "/" . 'templates2/assets/js/pace.min.js'; ?>"></script>
	<script type="text/javascript">
	//<!CDATA[
	var SITE_URL = "<?php echo $this->_var['site_url']; ?>";
	var REAL_SITE_URL = "<?php echo $this->_var['real_site_url']; ?>";
	var PRICE_FORMAT = '<?php echo $this->_var['price_format']; ?>';

	 
	//]]>
	</script>

</head>
<body>

<div id="wrapper">

    <div class="header">
        <nav class="navbar   navbar-site navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                            class="icon-bar"></span> <span class="icon-bar"></span></button>
                    <a href="index.php" class="navbar-brand logo logo-title">
                        
							<img src="<?php echo $this->lib_base . "/" . 'templates2/images/logo.png'; ?>" height="35" alt="img"  /></a></div>
                <div class="navbar-collapse collapse">

                    <ul class="nav navbar-nav navbar-right">
						<li><a href="index.php">หน้าหลัก</a></li>
						

						
						<?php if (! $this->_var['visitor']['user_id']): ?>
						<li><a href="<?php echo url('act=viewcart'); ?>">ตระกร้าสินค้า</a></li>
                        <li><a href="<?php echo url('app=member&act=login&ret_url=' . $this->_var['ret_url']. ''); ?>">เข้าสู่ระบบ</a></li>
                        <li><a href="<?php echo url('app=member&act=register&ret_url=' . $this->_var['ret_url']. ''); ?>">สมัครสมาชิก</a></li>
						
						<?php else: ?>
						<li><a href="<?php echo url('app=member'); ?>">บัญชีของ <?php echo htmlspecialchars($this->_var['visitor']['user_name']); ?></a></li>
						<li><a href="<?php echo url('app=member&act=order'); ?>">รายการสั่งซื้อสินค้า</a></li>
						<li><a href="<?php echo url('act=viewcart'); ?>">ตระกร้าสินค้า</a></li>
						<li><a href="index.php?app=member&amp;act=logout">ออกจากระบบ</a></li>
						<?php endif; ?>
                        <li class="postadd"><a class="btn btn-block   btn-border btn-post btn-danger" href="index.php?act=howto">ดูวิธีสั่งซื้อ?</a></li>
                    </ul>
                </div>
                
            </div>
            
        </nav>
    </div>
    
	  <div class="topmem" id="topmem">
	 <div class="container">
			<ul class=" pull-left navbar-link topmem-nav">
                <li>
					<a href="index.php">หน้าแรก </a> 
					<a href="index.php?act=aboutus">เกี่ยวกับเรา </a> 
					<a href="index.php?app=member">สมาชิก </a> 
					<a href="index.php?act=howto">วิธีการสั่งซื้อสินค้า </a> 
					<a href="index.php?act=search">สั่งสินค้า </a> 
					<a href="index.php?act=shipping">ค่าขนส่ง</a>
					<a href="index.php?act=news">ข่าวสารและกิจกรรม</a>
					<a href="index.php?act=promotion">โปรโมชั่น</a>
					<a href="index.php?act=faq">ถามตอบ</a>
					<a href="index.php?act=contact">ติดต่อเรา</a>
				</li>
            </ul>
	  </div>
	</div>
    
 