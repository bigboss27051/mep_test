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
            Products
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Products</li>
          </ol>
        </section>

        
        <section class="content">
         
           
           
			
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title"> </h3>
                </div>
                <div class="box-body">
					<div class=col-sm-3>
						<div class="form-group">
							<a   href="<?php echo url('app=goods&act=add'); ?>"  class="btn btn-primary">Add Product</a>
						</div>
					</div>
					<div class="col-md-12" id="panelmem" style="	overflow-y: hidden;">
						<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>PV</th>
					  

						<th>Show</th>
				 
						<th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
										    <tr >
										       
											<td ><img src="<?php echo $this->_var['site_url']; ?>/<?php echo $this->_var['goods']['default_image']; ?>" width="50" height="50"  /></td>
										     <td><?php echo htmlspecialchars($this->_var['goods']['good_code']); ?></td>
										      <td><span ectype="inline_edit" fieldname="goods_name" fieldid="<?php echo $this->_var['goods']['goods_id']; ?>" required="1" class="editable" title="editable"><?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?></span></td>
										      
										 
										      <td align="right"><?php echo price_format($this->_var['goods']['price']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>	
											  <td align="center"><?php echo price_format2($this->_var['goods']['pv']); ?></td>	
										 
										     <td align="center"><?php if ($this->_var['goods']['if_show']): ?><img src="<?php echo $this->res_base . "/" . 'style/images/positive_enabled.gif'; ?>" /><?php else: ?><img src="<?php echo $this->res_base . "/" . 'style/images/positive_disabled.gif'; ?>" /><?php endif; ?></td>
										      <td align="center"><a target="_blank" href="index.php?app=goods&act=edit&id=<?php echo $this->_var['goods']['goods_id']; ?>" class="btn btn-success">Edit</a></td>
										      
										      
										    </tr>
										    
										    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Image</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>PV</th>
					  

						<th>Show</th>
				 
						<th>Action</th>
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


