<?php echo $this->fetch('header.html'); ?>
<?php echo $this->fetch('_menu_top.html'); ?> 
<?php echo $this->fetch('_menu_left.html'); ?> 
  <script>
 $(function () {
   
     
     $("#example").DataTable( {
        "processing": true,
       	"serverSide": true,
        "ajax": "index.php?app=user&act=userlist"
		
    } );
	 
         
});

 
  </script>



      <div class="content-wrapper">
        
        <section class="content-header">
          <h1>
            Member   
            <small>Management</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		 
            <li class="active">Member Management</li>
          </ol>
        </section>

        
        <section class="content">
         
           
           
			
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title"> </h3>
                </div>
                <div class="box-body">
				 <div class="col-sm-12" style="	overflow-y: hidden;">
				 <div class=col-sm-12 style="padding: 10px;">
				 
					
				  	 </div> 				 
										<div class=col-sm-12>
										
												<table id="example" class="table table-bordered table-striped">
                    <thead>
                      <tr>	
								<th>User Name</th>	
								<th>Name</th>
								<th>Email</th>
							 
						 
								<th>Wallet</th>
						 		<th>ระดับ</th>
						 	
								<th>...</th>				 
                      </tr>
                    </thead>
                    
							
												 
                    <tfoot>
                      <tr>	
								<th>User Name</th>	
								<th>Name</th>
								<th>Email</th>
							 
						 
								<th>Wallet</th>
						 		<th>ระดับ</th>
								<th>...</th>				 
                      </tr>
                    </tfoot>
                  </table>
												 
									 	</div>
										 
									</div>
				</div>
		 
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>  



 


<?php echo $this->fetch('footer.html'); ?>