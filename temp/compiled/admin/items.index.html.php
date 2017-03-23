<?php echo $this->fetch('header.html'); ?>
<?php echo $this->fetch('_menu_top.html'); ?> 
<?php echo $this->fetch('_menu_left.html'); ?> 
  <script>
 $(function () {
   
     $("#example1").DataTable();
	 
         
});

 
  </script>
 
      <div class="content-wrapper">
        
        <section class="content-header">
          <h1>
           สินค้าโชว์หน้าแรก
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">สินค้าโชว์หน้าแรก</li>
          </ol>
        </section>

        
        <section class="content">
         
           
           
			
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title"> </h3>
                </div>
                <div class="box-body">
				<div class="col-md-12" >
						<form method="post" >
						<div class="input-group input-group-sm">
							
	                    	<input class="form-control" name="utlo" placeholder="ก็อปปี้ลิงค์สินค้าวางที่นี้   ตัวอย่าง : http://item.taobao.com/item.htm?id=111111" type="text">
		                    <span class="input-group-btn">
		                      <button class="btn btn-info btn-flat bg-navy "  type="submit">เพิ่มสินค้า</button>
		                    </span>
							
                  		</div>
						</form>
					 <br/>
					<div class="col-md-12" id="panelmem" style="	overflow-y: hidden;">
						<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
						<th>img</th>
                        <th>Code</th>
                        <th>สินค้า</th>
                         
						<th>ราคา</th>
						<th>sale</th>
						<th>new</th>
						<th>sort</th>
						<th  colspan="2">....</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php $_from = $this->_var['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'rows');if (count($_from)):
    foreach ($_from AS $this->_var['rows']):
?> 
                      <tr>
						<td><img src="<?php echo $this->_var['rows']['logo']; ?>" height="30px"></td>
                        <td><?php echo $this->_var['rows']['item_id']; ?></td>
                        <td><?php echo $this->_var['rows']['thai']; ?></td>
                        <td><?php echo $this->_var['rows']['price']; ?></td>
                        <td><img src="templates/images/icon/<?php if ($this->_var['rows']['sale'] == '1'): ?>true.gif<?php else: ?>false.gif<?php endif; ?>"></td>
                        <td><img src="templates/images/icon/<?php if ($this->_var['rows']['new'] == '1'): ?>true.gif<?php else: ?>false.gif<?php endif; ?>"></td>
					 <td><?php echo $this->_var['rows']['sort_order']; ?></td>
						<td><a href="<?php echo url('app=items&act=edit&id=' . $this->_var['rows']['show_id']. ''); ?>"   class="btn btn-xs bg-maroon">Edit</a></td>
						 <td><a href="<?php echo url('app=items&act=drop&id=' . $this->_var['rows']['show_id']. ''); ?>"   class="btn btn-xs btn-danger">Delete</a>
						</td>
						
                      </tr>
                       	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <tr>
						<th>img</th>
                        <th>Code</th>
                        <th>สินค้า</th>
                         
						<th>ราคา</th>
						<th>sale</th>
						<th>new</th>
						<th>sort</th>
							<th  colspan="2">....</th>
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
 

 
<?php echo $this->fetch('footer.html'); ?>