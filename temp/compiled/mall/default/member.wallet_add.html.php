<?php echo $this->fetch('main_header.html'); ?>
<?php echo $this->fetch('main_search.html'); ?>

 
    <div class="main-container">
        <div class="container">
            <div class="row">
                
					 <?php echo $this->fetch('menu_member.index.html'); ?>
                <div class="col-sm-9 page-content">
                   

                    <div class="inner-box">
                        <div class="welcome-msg">
                            <h2 class="title-2"><i class="icon-money"></i>แจ้งการเติมเครดิต</h2>
                        </div>
                        <div id="accordion" class="panel-group">
                            <div class="panel panel-default">
                                
                                <div class="panel-collapse collapse in" id="collapseB1">
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form" method="post">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">วันที่โอน</label>

                                                <div class="col-sm-9">
                                                    <input type="text" name="datetran" value="" class="form-control" placeholder="วัน/เดือน/ปี">
                                                </div>
                                            </div>
											<div class="form-group">
                                                <label class="col-sm-3 control-label">เวลาที่โอน</label>

                                                <div class="col-sm-9">
                                                    <input type="text" name="timetran" value="" class="form-control" placeholder="ชม/นาที">
													
                                                </div>
												
                                            </div>
											<div class="form-group">
                                                <label class="col-sm-3 control-label">จำนวนเงิน</label>

                                                <div class="col-sm-9">
                                                    <input type="text" name="amounttran" value="" class="form-control" placeholder="1000.00">
													
                                                </div>
												
                                            </div>
											<div class="form-group">
                                                <label class="col-sm-3 control-label">ธนาคาร</label>

                                            	<div class="col-sm-9">
                                                 <select name="banktran" id="banktran" class=form-control >
                  
													<option></option>
												 
													<option value="ธนาคารกรุงไทย" >ธนาคารกรุงไทย</option>
													<option value="ธนาคารกรุงศรีอยุธยา" >ธนาคารกรุงศรีอยุธยา</option>
													<option value="ธนาคารกสิกรไทย" >ธนาคารกสิกรไทย</option>
													
													<option value="ธนาคารซิตี้แบงค์" >ธนาคารซิตี้แบงค์</option>
													<option value="ธนาคารทหารไทย" >ธนาคารทหารไทย</option>
													
													<option value="ธนาคารไทยพาณิชย์" >ธนาคารไทยพาณิชย์</option>
													<option value="ธนาคารธนชาต" >ธนาคารธนชาต</option>
													
			                  					</select>
													
                                                </div>
												
                                            </div>
										 	  <div class="form-group">
                                                <label class="col-sm-3 control-label">แนบ </label>

                                                <div class="col-sm-9">
                                                    <input  type="file"  name="fileinfo" value=""   placeholder=" ">
													<label   control-label">(นามสกุลไฟล์ที่อนุญาติ: .jpg, .gif, .jpeg, .png)</label>
                                                </div>
												
                                            </div>
										    <div class="form-group">
                                                <label class="col-sm-3 control-label">หมายเหตุ</label>

                                                <div class="col-sm-9">
                                                    <input type="text" name="remarktran" value="" class="form-control" placeholder="">
													
                                                </div>
												
                                            </div>
											 
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9"></div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-default">Update</button>
                                                </div>
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
    


<?php echo $this->fetch('main_footer.html'); ?>