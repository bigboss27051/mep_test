 <?php echo $this->fetch('main_header.html'); ?>
<?php echo $this->fetch('main_search.html'); ?>

<div class="main-container">
        <div class="container">
            <div class="row">
                
					 <?php echo $this->fetch('menu_member.index.html'); ?>
                <div class="col-sm-9 page-content">
                   
                    <div class="inner-box">
                        <h2 class="title-2"><i class="icon-money"></i> รายการสั่งซื้อสินค้า</h2>

                        <div style="clear:both"></div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th><span> ID</span></th>
                                    <th>ชื่อผู้รับ</th>
                                    <th><strong>ประเภทการจ่าย</strong></th>
                                    <th> ยอดเงิน</th>
                                    <th>วิธการจัดส่ง</th>
									<th>วันที่</th>
                                    <th>สถานะ</th>
                                </tr>
                                </thead>
                                <tbody>
									<?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['order']):
?>
                                <tr>
                                    <td><a href="index.php?app=member&act=orderdetail&id=<?php echo $this->_var['order']['order_id']; ?>">#<?php echo $this->_var['order']['order_sn']; ?></a></td>
                                    <td><?php echo $this->_var['order']['buyer_name']; ?></td>
                                    <td><?php echo $this->_var['order']['payment_name']; ?> </td>

                                    <td><?php echo price_format($this->_var['order']['goods_amount']); ?></td>
									<td><?php echo $this->_var['order']['shipping_name']; ?></td>
                                    <td><?php echo local_date("Y-m-d H:i:s",$this->_var['order']['add_time']); ?></td>
                                    <td><?php if ($this->_var['order']['status'] == '20'): ?><span class="label label-info">รอดำเนินการ</span><?php endif; ?>
										<?php if ($this->_var['order']['status'] == '40'): ?><span class="label label-success">ชำระเงินแล้ว</span><?php endif; ?>
										<?php if ($this->_var['order']['status'] == '0'): ?><span class="label label-danger">ยกเลิก</span><?php endif; ?>  
                                    </td>
                                </tr>
                                 
								<?php endforeach; else: ?>
								<tr class="no_data">
									<td colspan="6">ไม่มีข้อมูลที่บันทึกไว้</td>
								</tr>
								<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>

                    
                                
                                </tbody>
                            </table>
                        </div>

                        <div style="clear:both"></div>

                    </div>
                </div>
		
                     
                
            </div>
            
        </div>
        
    </div>
    
     
 
<?php echo $this->fetch('main_footer.html'); ?>