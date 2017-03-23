<?php echo $this->fetch('header.html'); ?>
<?php echo $this->fetch('_menu_top.html'); ?> 
<?php echo $this->fetch('_menu_left.html'); ?> 
 
 
      <div class="content-wrapper">
        
        <section class="content-header">
          <h1>
            แจ้งการเติม Wallet
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Wallet</li>
          </ol>
        </section>

        
        <section class="content">
         
           
           
			
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title"> </h3>
                </div>
                <div class="box-body">
				<div class="col-md-12" style="	overflow-y: hidden;">
                    	<form class="form-horizontal" role="form" method="post">

											 
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">วันที่โอน</label>

                                                <div class="col-sm-9">
                                                    <input type="text" name="datetran" value="<?php echo $this->_var['walet_row']['datetran']; ?>"  readonly class="form-control" placeholder="วัน/เดือน/ปี">
                                                </div>
                                            </div>
											<div class="form-group">
                                                <label class="col-sm-3 control-label">เวลาที่โอน</label>

                                                <div class="col-sm-9">
                                                    <input type="text" name="timetran" value="<?php echo $this->_var['walet_row']['timetran']; ?>" readonly class="form-control" placeholder="ชม/นาที">
													
                                                </div>
												
                                            </div>
											<div class="form-group">
                                                <label class="col-sm-3 control-label">จำนวนเงิน</label>

                                                <div class="col-sm-9">
                                                    <input type="text" name="amounttran" value="<?php echo $this->_var['walet_row']['amounttran']; ?>" readonly class="form-control" placeholder="1000.00">
													
                                                </div>
												
                                            </div>
											<div class="form-group">
                                                <label class="col-sm-3 control-label">ธนาคาร</label>

                                            	<div class="col-sm-9">
													 <input type="text" name="banktran" value="<?php echo $this->_var['walet_row']['banktran']; ?>" readonly class="form-control" placeholder="1000.00">
													
													
                                                </div>
												
                                            </div>
											
										 
										    <div class="form-group">
                                                <label class="col-sm-3 control-label">หมายเหตุ</label>

                                                <div class="col-sm-9">
                                                    <input type="text" name="remarktran" value="<?php echo $this->_var['walet_row']['remarktran']; ?>" class="form-control" placeholder="">
													
                                                </div>
												
                                            </div>
											 <div class="form-group">
                                                <label class="col-sm-3 control-label">สถาณะ</label>

                                            	<div class="col-sm-9">
													 
													<select class="form-control" name="status">
								                        <option <?php if ($this->_var['walet_row']['status'] == '0'): ?> selected <?php endif; ?> value="0"><font color="Blue">รอดำเนินการ</font>  </option>
								                        <option <?php if ($this->_var['walet_row']['status'] == '1'): ?> selected <?php endif; ?> value="1"><font color="Green">เรียบร้อย</font></option>
								                        <option <?php if ($this->_var['walet_row']['status'] == '2'): ?> selected <?php endif; ?> value="2"><font color="Maroon">ยกเลิก</font></option>
								                         
								                      </select>
													
                                                </div>
												
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9"></div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
													<input  name="eid" type="hidden"   value="<?php echo $this->_var['id']; ?>">
													<?php if ($this->_var['walet_row']['status'] == '1'): ?>
													<?php else: ?>
                                                    <button type="submit" class="btn btn-success">Update</button>
													<?php endif; ?>
                                                </div>
                                            </div>
                                        </form>
					 
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>  
  
 
  
	</div>  
 
<?php echo $this->fetch('footer.html'); ?>