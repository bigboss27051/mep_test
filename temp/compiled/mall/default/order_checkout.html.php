<?php echo $this->fetch('main_header.html'); ?>

    <div class="main-container">
        <div class="container">
            <ol class="breadcrumb pull-left">
                
             <li><a href="#"><i class="icon-home fa"></i></a></li>
                <li><a href="category.html">สินค้า</a></li>
 
                <li class="active">Checkout</li>
            </ol>
            <div class="pull-right backtolist"><a href="property-list.html"> <i
                    class="fa fa-angle-double-left"></i> Back to Results</a></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 page-content col-thin-right">
                    <div class="inner inner-box ads-details-wrapper">
                        <h1 class="auto-heading"><span
                                class="auto-title left">ยอดสั่งซื้อรวมทั้งสิ้น</span> <span
                                class="auto-price pull-right"><?php echo price_format($this->_var['g_total']); ?> บาท</span></h1>

                        <div style="clear:both;"></div>
                         


                        <div class="row ">

                            <div class="col-sm-12 automobile-left-col">
							<form class="form-horizontal" id="checkoutForm"  method="post" role="form">
                                 
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title"><a href="#collapseB1" data-toggle="collapse"> ที่อยู่จัดส่ง </a></h4>
										</div>
										<div class="panel-collapse collapse in" id="collapseB1">
											<div class="panel-body">
												
													<div class="form-group">
														<label  class="col-sm-3 control-label">ชื่อ-นามสกุล</label>

														<div class="col-sm-9">
															<input name="consignee" class="form-control" placeholder="" type="text" required>
														</div>
													</div>
													 
													 
													<div class="form-group">
														<label class="col-sm-3 control-label">ที่อยู่</label>

														<div class="col-sm-9">
															<input name="address" class="form-control" placeholder=".." type="text" required>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">รหัสไปรษณีย์</label>

														<div class="col-sm-9">
															<input name="zipcode" class="form-control" placeholder=".." type="text" required>
														</div>
													</div>
													<div class="form-group">
														<label for="Phone"  class="col-sm-3 control-label">เบอร์โทรติดต่อ</label>

														<div class="col-sm-9">
															<input name="phone" class="form-control" id="Phone" placeholder=".." type="text" required> 
														</div>
													</div>
													

													 
													<div class="form-group">
														<div class="col-sm-offset-3 col-sm-9"></div>
													</div>
													 
												
											</div>
										</div>
									</div>
									<input name="total" type="hidden" value="<?php echo $this->_var['g_total']; ?>">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title"><a href="#collapseB1" data-toggle="collapse"> วิธีการส่งสินค้า </a></h4>
										</div>
										<div class="panel-collapse collapse in" id="collapseB1">
											<div class="panel-body">
												
													<div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="checkbox">
                                                    <label>
														<input name="shipping_id" checked  value="1"  type="radio">  รับสินค้าด้วยตัวเอง</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="shipping_id"  value="2"  type="radio" >  ไปรษณีย์ (EMS) </label>
                                                </div>
												<div class="checkbox">
                                                    <label>
                                                        <input  name="shipping_id" value="3"  type="radio"> Kerry Express </label>
                                                </div>
                                            </div>
											<div class="form-group">
														<div class="col-sm-offset-3 col-sm-9" style="color:red;">* ราคานี้ยังไม่รวมค่าขนส่งซึ่งจะแจ้งให้ทราบหลังจากสินค้าถึงประเทศไทยแล้ว</div>
													</div>
													 
											
                                        </div>
													 
												
											</div>
										</div>
									</div>
								</form>
                            </div>
                        </div>
                        


                         
                    </div>
                    

                </div>
                

                <div class="col-sm-3  page-sidebar-right">
                    <aside>
                        <div class="panel sidebar-panel panel-contact-seller">
                            <div class="panel-heading">ยืนยันคำสั่งซื้อ</div>
                            <div class="panel-content user-info">
                                <div class="panel-body text-center">
                                    <div class="seller-info">
                                        
                                        <h3 class="no-margin"> ยอดสั่งซื้อรวมทั้งสิ้น</h3>


									   <h3 class="no-margin" style="color:#FF9113"><?php echo price_format($this->_var['g_total']); ?> บาท</h3>
                                       
                                
                                    </div>
                                    <div class="user-ads-action">

                                        <a href="#" onclick="document.getElementById('checkoutForm').submit();" data-toggle="modal" class="btn btn-primary btn-block"><i
                                                class=" icon-link"></i>ชำระค่าสินค้า</a>
                                         </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel sidebar-panel">
                            <div class="panel-heading">Safety Tips for Buyers</div>
                            <div class="panel-content">
                                <div class="panel-body text-left">
                                    <ul class="list-check">
                                        <li> Meet seller at a public place</li>
                                        <li> Check the item before you buy</li>
                                        <li> Pay only after collecting the item</li>
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
    

 
<script>

    $(document).ready(function () {

            // Slider
        var $mainImgSlider = $('.bxslider').bxSlider({
            speed:1000,
            pagerCustom: '#bx-pager',
            controls: false,
            adaptiveHeight: true
          });

        // initiates responsive slide
        var settings = function () {
            var mobileSettings = {
                slideWidth: 80,
                minSlides: 2,
                maxSlides: 5,
                slideMargin: 5,
                adaptiveHeight: true,
                pager: false,

            };
            var pcSettings = {
                slideWidth: 100,
                minSlides: 3,
                maxSlides: 5,
                pager: false,
                slideMargin: 10,
                adaptiveHeight: true
            };
            return ($(window).width() < 768) ? mobileSettings : pcSettings;
        }

        var thumbSlider;

        function tourLandingScript() {
            thumbSlider.reloadSlider(settings());
        }

        thumbSlider = $('.product-view-thumb').bxSlider(settings());
        $(window).resize(tourLandingScript);

    });
</script>
 
<?php echo $this->fetch('main_footer.html'); ?>