<?php echo $this->fetch('main_header.html'); ?>
<?php echo $this->fetch('main_search.html'); ?>

 
    <div class="main-container">
        <div class="container">
            <div class="row">
                
					 <?php echo $this->fetch('menu_member.index.html'); ?>
                <div class="col-sm-9 page-content">
                   

                    <div class="inner-box">
				
                        <div class="welcome-msg">
							<a class="btn btn-lg btn-primary pull-right" href="index.php?app=member&act=addwallet">แจ้งการเติมเครดิต</a>
                            <h2 class="title-2"><i class="icon-money"></i>Wallet</h2>
							
                        </div>
						  
						 
					 
                        <div id="accordion" class="panel-group">
						 
						 					
                                          <table class="table table-bordered" style="padding-top:20px">
			                                <thead>
			                                <tr>
			                                    <th>วันที่</th>
			                                    <th>ประเภท</th>
			                                    <th>ธนาคาร</th>
			                                     
												<th>วันที่/เวลาฝาก</th>
			                                    <th>จำนวนเงิน</th>
												<th>หมายเหตุ</th>
												<th>สถาณะ</th>
			                                </tr>
			                                </thead>
			                                <tbody>
											<?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['order']):
?>
			                                <tr>
			                                    
			                                    <td><?php echo $this->_var['order']['date']; ?></td>
			                                    <td><?php echo $this->_var['order']['typetran']; ?> </td>
			
			                                    <td><?php echo $this->_var['order']['banktran']; ?></td>
												
			                                    <td><?php echo $this->_var['order']['datetran']; ?>  <?php echo $this->_var['order']['timetran']; ?></td>
												<td><?php echo price_format($this->_var['order']['amounttran']); ?></td>
												<td><?php echo $this->_var['order']['remarktran']; ?></td>
			                                    <td>
													<?php if ($this->_var['order']['status'] == '0'): ?><span class="label label-info">รอดำเนินการ</span><?php endif; ?>
													<?php if ($this->_var['order']['status'] == '1'): ?><span class="label label-success">ดำเนินการแล้ว</span><?php endif; ?>
												    <?php if ($this->_var['order']['status'] == '2'): ?><span class="label label-danger">ยกเลิก</span><?php endif; ?>
			                                    </td>
			                                </tr>
			                                 
											<?php endforeach; else: ?>
											<tr class="no_data">
												<td colspan="8">ไม่มีข้อมูลที่บันทึกไว้</td>
											</tr>
											<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
			
			                                
			
			                                 
			                                 
			
			                                 
			 
			                                
			                                </tbody>
			                            </table>
						 
                            
                            
                             
                        </div>
                        

                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>
    


<?php echo $this->fetch('main_footer.html'); ?>