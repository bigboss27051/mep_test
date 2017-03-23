<?php echo $this->fetch('main_header.html'); ?>
 
 
 
   <?php if ($this->_var['item_res']): ?>

    <div class="main-container">
        <div class="container">
            <ol class="breadcrumb pull-left">
                <li><a href="#"><i class="icon-home fa"></i></a></li>
                <li><a href="category.html">สินค้า</a></li>
 
                <li class="active">ค้นหาสินค้า</li>
            </ol>
            <div class="pull-right backtolist"><a href="sub-category-sub-location.html"> <i
                    class="fa fa-angle-double-left"></i> Back to Results</a></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 page-content col-thin-right">
                    <div class="inner inner-box ads-details-wrapper">
                        <h3><?php echo $this->_var['data']['thai']; ?>
                       
                        </h3>
						<h6><?php echo $this->_var['data']['title']; ?>
                       
                        </h6>
                        <span class="info-row">Link:<a href="<?php echo $this->_var['data']['link']; ?>" target="_blank" ><?php echo $this->_var['data']['link']; ?></a><span>
						
                   

                        <div class="Ads-Details">
                           
                            <div class="row">
								<form  method="post" action="index.php?act=addtocart" name="adstocart">

								<input type="hidden" name="adlink" value="<?php echo $this->_var['data']['link']; ?>" >
								<input type="hidden" name="adimge" value="<?php echo $this->_var['data']['img']; ?>" >
								<input type="hidden" name="adname" value="<?php echo $this->_var['data']['title']; ?>" >
								<input type="hidden" name="adname_thai" value="<?php echo $this->_var['data']['thai']; ?>" >
							
								<input type="hidden" name="adprice" value="<?php echo $this->_var['data']['price']; ?>" >
								<input type="hidden" name="adprice_thai" value="<?php echo $this->_var['data']['price_th']; ?>" >
								<div class="col-md-6">
                                    
									<ul class="bxslider">
										<li><img src="<?php echo $this->_var['data']['img']; ?>" alt="img"  width="300" /></li>
										 
									</ul>
                                    
                                </div>
                                <div class="ads-details-info col-md-6">
                                     
                                    <div id="sizeDiv"><h4>Price:<font color="#FF9113"> <?php echo $this->_var['data']['price']; ?> RMB </font></h4><hr></div>
                                    <div id="sizeDiv"><h4>Price Thai:  <font color="#FF9113"> <?php echo $this->_var['data']['price_th']; ?> บาท (โดยประมาณ)</font></h4><hr></div>
									<?php if ($this->_var['color']): ?>
									<h4>Color:</h4>
									<div id="colorDiv" style="font-size:1em;"><?php echo $this->_var['color']; ?><hr></div>
									<?php endif; ?>
									<?php if ($this->_var['size']): ?>
									<h4>Size:</h4>
									<div id="sizeDiv"><?php echo $this->_var['size']; ?><hr></div>
									<?php endif; ?>
									<div id="sizeDiv"><h4>จำนวน:<input name="qty" max="100" min="0" value="1" type="number"></h4><hr></div>
									<div id="sizeDiv"><button class="btn btn-primary" type=submit"><i lass=" icon-phone-1"></i>สั่งซื้อสินค้า</button><hr></div>
                                </div>
                                </form >
                            </div>
                             
                        </div>
						<div class="Ads-Details info-row" style="color:#000">
							<h3>รายละเอียดสินค้า</h3>
							<?php echo $this->_var['data']['desc']; ?>
						</div>
                    </div>
                    

                </div>
                

                <div class="col-sm-3  page-sidebar-right">
                    <aside>
                        <div class="panel sidebar-panel panel-contact-seller">
                            <div class="panel-heading">ติอต่อเรา</div>
                            <div class="panel-content user-info">
                                <div class="panel-body text-center">
                                    <div class="seller-info">
                                        <h3 class="no-margin">maha-express</h3>

                                        <p>Location: <strong>New York</strong></p>

                                        <p> Joined: <strong>12 Mar 2009</strong></p>
                                    </div>
                                    <div class="user-ads-action"><a href="#contactAdvertiser" data-toggle="modal"
                                                                    class="btn   btn-default btn-block"><i
                                            class=" icon-mail-2"></i> Send a message </a> <a
                                            class="btn  btn-info btn-block"><i class=" icon-phone-1"></i> 01680 531 352
                                    </a></div>
                                </div>
                            </div>
                        </div>
                        <div class="panel sidebar-panel">
                            <div class="panel-heading">หมายเหตุ</div>
                            <div class="panel-content">
                                <div class="panel-body text-left">
                                    <ul class="list-check">
                                        <li>ควรเลือกสีและขนาดให้ถูกต้อง ระบบจะทำการสั่งรายการสินค้าโดยอัตโนมัติ</li>
                                        <li> สีอาจมีความแตกต่างจากของจริง เนื่องจากบางร้านค้าใช้เทคนิคในการแต่งรูปภาพสินค้า</li>
                                        
                                    </ul>
                                    <p><a class="pull-right" href="#"> Know more <i
                                            class="fa fa-angle-double-right"></i> </a></p>
                                </div>
                            </div>
                        </div>
                        
                    </aside>
                </div>
                
            </div>
        </div>
    </div>
    
	
   <?php else: ?>
	<div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12 page-content">
                    <div class="inner-box category-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-danger pgray  alert-lg" role="alert">
                                    <h2 class="no-margin no-padding">ไม่พบข้อมูลสินค้าที่ท่านค้นหา.</h2>

                                  
									<div class="row search-row animated fadeInUp">
									  <form method="post" id="login_form" action="index.php?act=search"  role="form">
										<div class="col-lg-8 col-sm-8 search-col relative"><i class="icon-docs icon-append"></i>
											<input type="text" name="ads" class="form-control has-icon"
												   placeholder="ก็อปปี้ลิงค์สินค้าวางที่นี้   ตัวอย่าง : http://item.taobao.com/item.htm?id=111111"   value="">
										</div>
										<div class="col-lg-4 col-sm-4 search-col">
											<button class="btn btn-primary btn-search btn-block"><i
													class="icon-search"></i><strong>Find</strong></button>
										</div>
										</form>
										 </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
                
            </div>
            
        </div>
    </div>
    
 
 <?php endif; ?>
<?php echo $this->fetch('main_footer.html'); ?>