<?php echo $this->fetch('header.html'); ?>
<?php echo $this->fetch('_menu_top.html'); ?> 
<?php echo $this->fetch('_menu_left.html'); ?> 
 
 
 
  

      <div class="content-wrapper">
        
        <section class="content-header">
          <h1>
            My Account
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	 
            <li class="active">My Account</li>
          </ol>
        </section>

        
        <section class="content">
         
           
           
			
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title"> </h3>
                </div>
                <div class="box-body">
                   <form   method=post name=form id='form_reg' enctype="multipart/form-data">
							 
							 
							  <div class="callout callout-info">
			                    <h4>ข้อมูลสมาชิก</h4>
			                    
			         		</div>
						 
							 
							<div class="row">
								 
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">ชื่อ-นามสกุล<span class="symbol required"></span>
										</label>
										<input class="form-control" name="consignee" id="consignee" tabindex="4" value="<?php echo $this->_var['team']['real_name']; ?>" type="text">
										 
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">User Name<span class="symbol required"></span></label>
										<label class="form-control" readonly="true"><?php echo $this->_var['team']['user_name']; ?></label>
										<input class="form-control" name="username" id="username" size="22" maxlength="20" value="<?php echo $this->_var['team']['user_name']; ?>" tabindex="6" type="hidden">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">วันที่เกิด<span class="symbol required"></span></label>
										<div class="row">
											
											<div class="col-md-3">
												<input class="form-control" name="date_of_birth" id="date_of_birth" tabindex="4" value="<?php echo $this->_var['team']['birthday']; ?>" type="text">	 
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">เพศ<span class="symbol required"></span></label>
						
										<div class="row">
											<div class="col-md-9">
												<select name="gender" id="gender" tabindex="10" class="form-control">
													<option value="">เลือก</option>
													<option value="M" <?php if ($this->_var['team']['gender'] == 1): ?> selected="selected" <?php endif; ?>>ชาย </option>
													<option value="F" <?php if ($this->_var['team']['gender'] == 0): ?> selected="selected" <?php endif; ?>>หญิง</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">เลขประจำตัวประชาชน<span class="symbol required"></span>
										</label>
										<input class="form-control" name="idcard" id="idcard" tabindex="4" value="<?php echo $this->_var['team']['id_card']; ?>" type="text">
										 
									</div>
								</div>
								<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Email</label>
											<div class="row">
												<div class="col-md-9">
													<input class="form-control" name="email" id="email" tabindex="19" size="22" maxlength="100" autocomplete="Off" value="<?php echo $this->_var['team']['email']; ?>" type="text">
													 
												</div>
											</div>
										</div>
									</div>
							</div>
							 <div class="callout callout-info">
			                    <h4> ข้อมูลติดต่อ</h4>
			                    
			         		</div>
							<div class="row">
								 
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">ที่อยู่ปัจจุบัน<span class="symbol required"></span></label>
										<div class="row">
											<div class="col-md-9">
												<textarea class="form-control" rows="4" name="address" id="address" cols="17" tabindex="11"><?php echo $this->_var['team']['address']; ?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									
									<div class="form-group">
										<label class="control-label">จังหวัด</label>
										<div class="row">
											<div class="col-md-9">
												<input class="form-control" name="city" id="city" tabindex="18" size="22" maxlength="20" value="<?php echo $this->_var['team']['city']; ?>" type="text">
												 
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">รหัสไปรษณีย์</label>
										<div class="row">
											<div class="col-md-9">
												<input class="form-control" name="zipcode" id="zipcode" tabindex="18" size="22" maxlength="20" value="<?php echo $this->_var['team']['zipcode']; ?>" type="text">
												 
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">โทรศัพท์ </label>
										<div class="row">
											<div class="col-md-9">
												<input class="form-control" name="phone_tel" id="phone_tel" tabindex="18" size="22" maxlength="20" value="<?php echo $this->_var['team']['phone_tel']; ?>" type="text">
												 
											</div>
										</div>
									</div>
									
								</div>
							 
							</div>
						 	 
							 
							 <input name="idd"   value="<?php echo $this->_var['team']['user_id']; ?>" type="hidden">
							<div class="row">
								<div class="col-md-8">
								 
								</div>
								<div class="col-md-2">
									<button class="btn btn-block btn-success" type="submit" name="update_profile" id="update_profile" value="update_profile" tabindex="29">Update Profile <i class="fa fa-arrow-circle-right"></i>
									</button>
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