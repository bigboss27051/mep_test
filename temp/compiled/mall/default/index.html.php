<?php echo $this->fetch('main_header.html'); ?>
<?php echo $this->fetch('main_search.html'); ?>


    <div class="main-container">
        <div class="container">
 			
             
			<div class="col-sm-12 page-content col-thin-left">

				<div class="inner-box has-aff relative">
                       <img src="http://www.vcanbuy.com/protected/app/webroot/img/1212_2/special-promotion.jpg" class="img-responsive" alt=" aff"> </a>

             	</div>
			 </div>
		 

             <div class="col-sm-12 page-content col-thin-left">
				
 				<div class="adds-wrapper property-list">
 
						  
					<?php $_from = $this->_var['items_sale']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'rows');if (count($_from)):
    foreach ($_from AS $this->_var['rows']):
?> 
   
				<div class="item-list make-grid">
                                <div class="col-sm-3 no-padding photobox">
                                    <div class="add-image">
										<?php if ($this->_var['rows']['saleper']): ?><h1 class="pricetag"><?php echo $this->_var['rows']['saleper']; ?>% Off</h1><?php endif; ?>
										<div class="bx-wrapper" style="max-width: 100%;">
											<span class="photo-count"><i
	                                            class="fa fa-camera"></i> 2 </span> <a href="javascript:void(0);" onclick="$('#s<?php echo $this->_var['rows']['show_id']; ?>').submit();"><img
	                                            class="thumbnail no-margin" src="<?php echo $this->_var['rows']['logo']; ?>" alt="img"></a>
										</div>
									</div>
                                </div>
                                
                                <div class="col-sm-6 add-desc-box">
                                    <div class="add-details">
                                        <h5 class="add-title"><a href="javascript:void(0);" onclick="$('#s<?php echo $this->_var['rows']['show_id']; ?>').submit();">
                                            <?php echo $this->_var['rows']['thai']; ?> </a></h5>
									</div>
                                </div>
										
                                
                                
								<div class="col-sm-3 text-right  price-box">
                                    <h3 class="item-price "> <strong><?php echo $this->_var['rows']['price']; ?> THB</strong></h3>
                                     <div style="clear: both"></div>
									<form method="post" action="index.php?act=search" id="s<?php echo $this->_var['rows']['show_id']; ?>">
									<input  type="hidden" name="ads" value="<?php echo $this->_var['rows']['link']; ?>" >
                                    <button class="btn btn-success btn-sm bold" type="submit">
                                      สั่งซื้อสินค้า
                                    </button>
									</form>
									<div class="pull-right">


	                                    <a class="btn btn-border-thin  btn-save"   title="save ads"  data-toggle="tooltip" data-placement="left">
	                                        <i class="icon icon-heart"></i>
	                                    </a>
	                                    <a class="btn btn-border-thin  btn-share ">
	                                        <i class="icon icon-export" data-toggle="tooltip" data-placement="left"  title="share"></i>
	                                    </a>
									</div>

                                </div>
                                
                         </div>
                         
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	
                </div>
                

			</div>
			
	 		
		
                      
        </div>
		 
    </div>
    


	 <div class="main-container">
        <div class="container">
 			
             
			<div class="col-sm-12 page-content col-thin-left">

				<div class="inner-box has-aff relative">
                       <img src="http://www.vcanbuy.com/protected/app/webroot/img/1212_2/special-promotion.jpg" class="img-responsive" alt=" aff"> </a>

             	</div>
			 </div>
		 

             <div class="col-sm-12 page-content col-thin-left">
				
 				<div class="adds-wrapper property-list">
 
						<?php $_from = $this->_var['items_new']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'rows');if (count($_from)):
    foreach ($_from AS $this->_var['rows']):
?> 
   
					<div class="item-list make-grid">
                                <div class="col-sm-3 no-padding photobox">
                                    <div class="add-image">
										<?php if ($this->_var['rows']['saleper']): ?><h1 class="pricetag"><?php echo $this->_var['rows']['saleper']; ?>% Off</h1><?php endif; ?>
										<div class="bx-wrapper" style="max-width: 100%;">
											<span class="photo-count"><i
	                                            class="fa fa-camera"></i> 2 </span> <a href="javascript:void(0);" onclick="$('#n<?php echo $this->_var['rows']['show_id']; ?>').submit();"><img
	                                            class="thumbnail no-margin" src="<?php echo $this->_var['rows']['logo']; ?>" alt="img"></a>
										</div>
									</div>
                                </div>
                                
                                <div class="col-sm-6 add-desc-box">
                                    <div class="add-details">
                                        <h5 class="add-title"><a href="javascript:void(0);" onclick="$('#n<?php echo $this->_var['rows']['show_id']; ?>').submit();">
                                            <?php echo $this->_var['rows']['thai']; ?> </a></h5>
									</div>
                                </div>
										
                                
                                
								<div class="col-sm-3 text-right  price-box">
                                    <h3 class="item-price "> <strong><?php echo $this->_var['rows']['price']; ?> THB</strong></h3>
                                     <div style="clear: both"></div>
									
                                    <form method="post" action="index.php?act=search" id="n<?php echo $this->_var['rows']['show_id']; ?>">
									<input  type="hidden" name="ads" value="<?php echo $this->_var['rows']['link']; ?>" >
                                    <button class="btn btn-success btn-sm bold" type="submit">
                                      สั่งซื้อสินค้า
                                    </button>
									</form>
									
									<div class="pull-right">


	                                    <a class="btn btn-border-thin  btn-save"   title="save ads"  data-toggle="tooltip" data-placement="left">
	                                        <i class="icon icon-heart"></i>
	                                    </a>
	                                    <a class="btn btn-border-thin  btn-share ">
	                                        <i class="icon icon-export" data-toggle="tooltip" data-placement="left"  title="share"></i>
	                                    </a>
									</div>

                                </div>
                                
                         </div>
                         
	
				 	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	
                </div>
                

			</div>
			
	 		
		
                      
        </div>
		 
    </div>
    
    <div class="page-info hasOverly" style="background: url(http://maha-express.com/main/includes/libraries/javascript/templates2/images/bg.jpg); background-size:cover">
        <div class="bg-overly">
            <div class="container text-center section-promo">
                <div class="row">
                    <div class="col-sm-3 col-xs-6 col-xxs-12">
                        <div class="iconbox-wrap">
                            <div class="iconbox">
                                <div class="iconbox-wrap-icon">
                                    <i class="icon  icon-group"></i>
                                </div>
                                <div class="iconbox-wrap-content">
                                    <h5><span>2200</span></h5>

                                    <div class="iconbox-wrap-text">Trusted Seller</div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="col-sm-3 col-xs-6 col-xxs-12">
                        <div class="iconbox-wrap">
                            <div class="iconbox">
                                <div class="iconbox-wrap-icon">
                                    <i class="icon  icon-th-large-1"></i>
                                </div>
                                <div class="iconbox-wrap-content">
                                    <h5><span>100</span></h5>

                                    <div class="iconbox-wrap-text">Categories</div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="col-sm-3 col-xs-6  col-xxs-12">
                        <div class="iconbox-wrap">
                            <div class="iconbox">
                                <div class="iconbox-wrap-icon">
                                    <i class="icon  icon-map"></i>
                                </div>
                                <div class="iconbox-wrap-content">
                                    <h5><span>700</span></h5>

                                    <div class="iconbox-wrap-text">Location</div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="col-sm-3 col-xs-6 col-xxs-12">
                        <div class="iconbox-wrap">
                            <div class="iconbox">
                                <div class="iconbox-wrap-icon">
                                    <i class="icon icon-facebook"></i>
                                </div>
                                <div class="iconbox-wrap-content">
                                    <h5><span>50,000</span></h5>

                                    <div class="iconbox-wrap-text"> Facebook Fans</div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>

                </div>

            </div>
        </div>
    </div>
    

    <div class="page-bottom-info">
        <div class="page-bottom-info-inner">

            <div class="page-bottom-info-content text-center">
                <h1>If you have any questions, comments or concerns, please call the Classified Advertising department
                    at (000) 555-5555</h1>
                <a class="btn  btn-lg btn-primary-dark" href="tel:+000000000">
                    <i class="icon-mobile"></i> <span class="hide-xs color50">Call Now:</span> (000) 555-5555 </a>
            </div>

        </div>
    </div>
<?php echo $this->fetch('main_footer.html'); ?>


    