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
                            <h2 class="title-2"><i class="icon-money"></i>รายงานการใช้ Wallet</h2>
							
                        </div>
						  
						 
					 
                        <div id="accordion" class="panel-group">
						 
						 					
                                          <table class="table table-bordered" style="padding-top:20px">
			                                <thead>
			                                <tr>
			                                    <th>รายการบัญชี</th>
			                                    <th>จำนวนเงิน</th>
			                                    <th>คงเหลือ</th>
			                                     
												<th>วันที่</th>
			                                    <th>หมายเหตุ</th>
												 
			                                </tr>
			                                </thead>
			                                <tbody>
											<?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['order']):
?>
			                                <tr>
			                                    
			                                    <td>
												 
													<?php if ($this->_var['order']['type'] == '1'): ?><span class="label label-success"><?php echo $this->_var['order']['wal_desc']; ?></span><?php endif; ?>
													<?php if ($this->_var['order']['type'] == '2'): ?><span class="label label-danger"><?php echo $this->_var['order']['wal_desc']; ?></span><?php endif; ?>
												</td>
			                                    <td><?php echo price_format($this->_var['order']['value']); ?> </td>
			
			                                    <td><?php echo price_format($this->_var['order']['gtotal']); ?></td>
												
			                                    <td><?php echo $this->_var['order']['date']; ?> </td>
												<td><?php echo $this->_var['order']['remark']; ?></td>
											 
			                                    
			                                </tr>
			                                 
											<?php endforeach; else: ?>
											<tr class="no_data">
												<td colspan="5">ไม่มีข้อมูลที่บันทึกไว้</td>
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