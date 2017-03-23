<?php echo $this->fetch('header.html'); ?>
<?php echo $this->fetch('_menu_top.html'); ?> 
<?php echo $this->fetch('_menu_left.html'); ?> 
<script type="text/javascript">

  
$(function(){

 
       $('input[ectype="change_store_logo"]').change(function(){
		 	
			readURL(this);
		  
		
        });
		
		$("#cate_id").change(function(){
			$("#cate_name").val($("#cate_id option:selected").text());
		});

		$("#profile_set").click(function(){

			
			$("#setitem").val("1");

			alert($("#setitem").val());
			$("#goods_form").submit();
		});

		
		
		 
});

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //$('#blah').attr('src', e.target.result);
				
           $('img[ectype="store_logo"]').attr('src', e.target.result);
  
        }

        reader.readAsDataURL(input.files[0]);
    }
}

</script>
 
      <div class="content-wrapper">
        
        <section class="content-header">
          <h1>
            Product
            <small>Management</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product Management</li>
          </ol>
        </section>

        
        <section class="content">
         
           
           
			
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title"> </h3>
                </div>
                <div class="box-body">
					
					 <div class=col-sm-8>
						<form method="post" id="goods_form" enctype="multipart/form-data">
						 	 
								<div class="form-group">
			                    <label>Image:<font color="#ff0000">*</font></label>
			                     
			                      <p><img src="<?php if ($this->_var['goods']['default_image'] != ''): ?><?php echo $this->_var['site_url']; ?>/<?php echo $this->_var['goods']['default_image']; ?><?php else: ?>templates/style/images/default_goods_image.gif<?php endif; ?>" width="150" height="150" ectype="store_logo" /></p>
			                    	<input type="file" size="1"  name="goods_file_id[]"   style="color: transparent;" maxlength="0" hidefocus="true" ectype="change_store_logo" />
			                  </div>
							<div class="form-group">
			                    <label>Product Name:<font color="#ff0000">*</font></label>
			                     
			                      <input title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" type="text" name="goods_name" value="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" class="form-control"    autocomplete="Off" class="form-control" /> 
			                    
			                  </div>

							<div class="form-group">
			                    <label>Product Code:<font color="#ff0000">*</font></label>
			                     
			                      <input name="good_code" value="<?php echo $this->_var['goods']['good_code']; ?>" type="text" autocomplete="Off" class="form-control" />
			                    
			                  </div>

						 	<div class="form-group">
			                    <label>Price:<font color="#ff0000">*</font></label>
			                     
			                      <input name="spec_id" value="<?php echo $this->_var['goods']['_specs']['0']['spec_id']; ?>" type="hidden" />
								<input name="price" value="<?php echo $this->_var['goods']['_specs']['0']['price']; ?>" type="text" autocomplete="Off" class="form-control" /> 
			                    
			                  </div>
						 	<div class="form-group">
			                    <label>PV:<font color="#ff0000">*</font></label>
			                     
			                    <input name="pv" value="<?php echo $this->_var['goods']['_specs']['0']['pv']; ?>" type="text" autocomplete="Off" class="form-control" />
			                  </div>
							 
						 
							<?php if ($this->_var['goods']['_specs']['0']['spec_id']): ?>
							<div class="form-group">
			                    <label>Show: </label>
			                     
			                     <label><input name="if_show" value="1" type="radio" <?php if ($this->_var['goods']['if_show']): ?>checked="checked" <?php endif; ?>/> ใช่</label>
				                 <label><input name="if_show" value="0" type="radio" <?php if (! $this->_var['goods']['if_show']): ?>checked="checked" <?php endif; ?>/> ไม่</label>
			                  </div>
							<?php else: ?>
									<input name="if_show" value="1"  type="hidden">
							<?php endif; ?>
							<div class="box-footer">
                    			<button type="submit" id="profile_update"  class="btn btn-primary">Submit</button>
                  			</div>
							
                  		</form>
				  	</div>
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>  
 

 
<?php echo $this->fetch('footer.html'); ?>

