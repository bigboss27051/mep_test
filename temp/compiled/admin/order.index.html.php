
<?php echo $this->fetch('header.html'); ?>
<?php echo $this->fetch('_menu_top.html'); ?> 
<?php echo $this->fetch('_menu_left.html'); ?> 
<script type="text/javascript" src="<?php echo $this->res_base . "/" . 'js/mlm_json.js'; ?>" charset="utf-8"></script>
 <script>
$(document).ready(function() {
   
     $("#example").DataTable();
	 
         
});

 
 
  </script>

      <div class="content-wrapper">
        
        <section class="content-header">
          <h1>
            Order Management
            <small> </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			 
            <li class="active">Order Management</li>
          </ol>
        </section>

        
        <section class="content">
         
           
           
			
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Information </h3>
                </div>
                <div class="box-body">
				 <div class="col-sm-12">
			 
							 
				 
									<div class="row">
									 <table id="example" class="table table-bordered table-striped">
        							<thead>
												<tr >
												 
												<th><span> ID</span></th>
                                    <th>ชื่อผู้รับ</th>
                                    <th><strong>ประเภทการจ่าย</strong></th>
                                    <th> ยอดเงิน</th>
                                    <th>วิธการจัดส่ง</th>
									<th>วันที่</th>
                                    <th> Status</th>
									<th> Detail</th>			 
												 
								 					 
								 
												</tr>
											</thead>
										  <tbody>
											 <?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['order']):
?>
				                                <tr>
				                                    <td>#<?php echo $this->_var['order']['order_sn']; ?></td>
				                                    <td><?php echo $this->_var['order']['buyer_name']; ?></td>
				                                    <td><?php echo $this->_var['order']['payment_name']; ?> </td>
				
				                                    <td><?php echo price_format($this->_var['order']['goods_amount']); ?></td>
													<td><?php echo $this->_var['order']['shipping_name']; ?></td>
				                                    <td><?php echo local_date("Y-m-d H:i:s",$this->_var['order']['add_time']); ?></td>
				                                    <td><?php if ($this->_var['order']['status'] == '20'): ?><span class="label label-info">รอดำเนินการ</span><?php endif; ?>
										<?php if ($this->_var['order']['status'] == '40'): ?><span class="label label-success">ชำระเงินแล้ว</span><?php endif; ?>
										<?php if ($this->_var['order']['status'] == '0'): ?><span class="label label-danger">ยกเลิก</span><?php endif; ?> 
				                                    </td>
													 <td><a href='index.php?app=order&amp;act=view&amp;id=<?php echo $this->_var['order']['order_id']; ?>' class='btn btn-success'>View</a></span> </td>
				                                </tr>
                                 			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
										  </tbody>
											<tfoot>
												<th><span> ID</span></th>
			                                    <th>ชื่อผู้รับ</th>
			                                    <th><strong>ประเภทการจ่าย</strong></th>
			                                    <th> ยอดเงิน</th>
			                                    <th>วิธการจัดส่ง</th>
												<th>วันที่</th>
			                                    <th> Status</th>
												<th> Detail</th>
											</tfoot>
											</table>
									 	</div>
									 
 		 
		 
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>  



  
    
	</script>
  
<?php echo $this->fetch('footer.html'); ?>
  
 
 
  
 