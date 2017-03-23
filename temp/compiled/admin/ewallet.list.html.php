<?php echo $this->fetch('header.html'); ?>
<?php echo $this->fetch('_menu_top.html'); ?> 
<?php echo $this->fetch('_menu_left.html'); ?> 
 
 
      <div class="content-wrapper">
        
        <section class="content-header">
          <h1>
            Wallet
            <small>Management</small>
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
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                       <th>ID</th>
				 
						<th>Username</th>
						<th>ชื่อ-นามสกุล</th>
						<th>ยอดเงินที่เติม</th>
						<th>โอนเงิน</th> 
					 
						 
						<th>สถาณะ </th> 
						<th>ข้อมูลการโอนเงิน </th> 
                      </tr>
                    </thead>
                    <tbody>
						<?php $_from = $this->_var['walet_row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'rows');if (count($_from)):
    foreach ($_from AS $this->_var['rows']):
?> 
                      <tr>
                        <td><?php echo $this->_var['rows']['order_sn']; ?></td>
                        <td><?php echo $this->_var['rows']['user_name']; ?></td>
                        <td><?php echo $this->_var['rows']['name']; ?></td>
                        <td><?php echo price_format($this->_var['rows']['amount']); ?> </td>
						<td><?php if ($this->_var['rows']['transfer_stat']): ?><img src="templates/images/icon/true.gif" ><?php else: ?><a href="javascript:void(0);" id="<?php echo $this->_var['rows']['e_id']; ?>" ectype='tranfer' title="Approve"><img src="templates/images/icon/false.gif" ></a> <form id="a<?php echo $this->_var['rows']['e_id']; ?>"  action="index.php?app=ewallet&act=appwalet"   method="post"><input type="hidden" name="eid" value="<?php echo $this->_var['rows']['e_id']; ?>"></form><?php endif; ?></td>	
					  
						<td><?php if ($this->_var['rows']['status'] == 0): ?><font color='blue'>รอดำเนินการ  </font><?php endif; ?>
							<?php if ($this->_var['rows']['status'] == 1): ?><font color='Green'>เรียบร้อย</font> <?php endif; ?>
							<?php if ($this->_var['rows']['status'] == 2): ?><font color='red'>ยกเลิก</font> <?php endif; ?></td>
						<td><a href="index.php?app=ewallet&amp;act=view&amp;id=<?php echo $this->_var['rows']['e_id']; ?>" class="btn btn-success">View</a> </td>
                      </tr>
                       	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>ID</th>
				 
						<th>Username</th>
						<th>ชื่อ-นามสกุล</th>
						<th>ยอดเงินที่เติม</th>
						<th>โอนเงิน</th> 
					 
						<th>สถาณะ </th> 
						<th>ข้อมูลการโอนเงิน </th> 
                      </tr>
                    </tfoot>
                  </table>	
					</div>
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>  
 
  <script>
      $(function () {
        $("#example1").DataTable({
         
  
          
         
        });
         
      });
    </script>
<script>

 $(document).ready(function(){ 
 
	 
	$('a[ectype="tranfer"]').click(function(){
			 
				
						var aid = $(this).attr("id");
			 
					   
						$('#a' + aid).submit();
				});
	});
</script> 
  
	</div>  
 
<?php echo $this->fetch('footer.html'); ?>