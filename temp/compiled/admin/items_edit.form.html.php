<?php echo $this->fetch('header.html'); ?>
<?php echo $this->fetch('_menu_top.html'); ?> 
<?php echo $this->fetch('_menu_left.html'); ?> 
 
 
      <div class="content-wrapper">
        
        <section class="content-header">
          <h1>
            Product
            <small>Management</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product Management</li>
          </ol>
        </section>

        
        <section class="content">
         
           
           
			
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title"> </h3>
                </div>
                <div class="box-body">
					
					
						<form method="post" id="goods_form" enctype="multipart/form-data">
						  <div class=col-sm-6>	 
								<div class="form-group">
			                    <label>Image:<font color="#ff0000">*</font></label>
			                     
			                      <p><img src="<?php echo $this->_var['items']['logo']; ?>" width="300"  ectype="store_logo" /></p>
			                     
			                  </div>
						</div>
						<div class=col-sm-6>	
							<div class="form-group">
			                    <label>Product Code:<font color="#ff0000">*</font></label>
			                     
			                      <input name="good_code" value="<?php echo $this->_var['items']['item_id']; ?>" type="text" autocomplete="Off" readonly class="form-control" />
			                    	<input  name="show_id" type="hidden" value="<?php echo $this->_var['items']['show_id']; ?>" >
			                  </div>
							<div class="form-group">
			                    <label>Name:<font color="#ff0000">*</font></label>
			                     
			                      <textarea class="form-control" rows="3" name="thai"><?php echo $this->_var['items']['thai']; ?></textarea> 
			                    
			                  </div>

							

						 	<div class="form-group">
			                    <label>Price:<font color="#ff0000">*</font></label>
			                     
			                      
								<input name="price" value="<?php echo $this->_var['items']['price']; ?>" type="text" autocomplete="Off" class="form-control" /> 
			                    
			                  </div>

							<div class="form-group">
			                    <label>ส่วนลด:<font color="#ff0000">*</font></label>
			                     
			                      
								<input name="saleper" value="<?php echo $this->_var['items']['saleper']; ?>" type="text" autocomplete="Off" class="form-control" /> 
			                    
			                  </div>
						 	 
							 <div class="form-group">
			                    <label>สินค้าลดราคา: </label>
			                     
			                      <select name="sale" class="form-control">
				                        <option <?php if ($this->_var['items']['sale'] == '1'): ?> selected  <?php endif; ?> value="1">ใช่</option>
				                        <option <?php if ($this->_var['items']['sale'] == '0'): ?> selected  <?php endif; ?>  value="0">ไม่ใช่</option>
				                         
				                      </select>
			                  </div>
							 
							<div class="form-group">
			                    <label>สินค้าใหม่: </label>
			                     
			                      <select name="new" class="form-control">
				                        <option <?php if ($this->_var['items']['new'] == '1'): ?> selected  <?php endif; ?> value="1">ใช่</option>
				                        <option <?php if ($this->_var['items']['new'] == '0'): ?> selected  <?php endif; ?>  value="0">ไม่ใช่</option>
				                         
				                      </select>
			                  </div>
						 	<div class="form-group">
			                    <label>ลำดับการแสดงผล: </label>
			                     <input name="sort_order" value="<?php echo $this->_var['items']['sort_order']; ?>" type="text" autocomplete="Off" class="form-control" /> 
			                       
			                  </div>
							<div class="box-footer">
                    			<button type="submit" id="profile_update"  class="btn btn-primary">Submit</button>
                  			</div>
						</div>	
                  		</form>
				  
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>  
 

 
<?php echo $this->fetch('footer.html'); ?>

