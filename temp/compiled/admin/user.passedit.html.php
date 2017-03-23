<?php echo $this->fetch('header.html'); ?>
<?php echo $this->fetch('_menu_top.html'); ?> 
<?php echo $this->fetch('_menu_left.html'); ?> 
<script type="text/javascript" src="<?php echo $this->res_base . "/" . 'js/mlm_json.js'; ?>" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="templates/style/easyui.css"/>
 

<script type="text/javascript" src="templates/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="templates/js/jscharts.js"></script>

      <div class="content-wrapper">
        
        <section class="content-header">
          <h1>
            Edit Password 
            <small> </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			 
            <li class="active"> Edit Password </li>
          </ol>
        </section>

        
        <section class="content">
         
           
           
			
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Information </h3>
                </div>
                <div class="box-body">
				<div class=col-sm-6 >
				 
				<form   method="post" id="myForm">
                                     
                   <div class="form-group">
                    <label>User Id:</label>
                    <div class="input-group">
                       <div class="input-group-addon">
                        <i class="fa fa-search"></i>
                      </div>
					<input  name=cust_userid   id=cust_userid type=text size=22   autocomplete=Off value='Admin' title="" class="form-control pull-right" />

					 
													
                      
                    </div>
                  </div>
                  <p class="margin"><span id='referral_box'  class="messageboxok" style="display:none;">
														<span id="msss">  </span> 
													</span>
													<span id=errormsg4 ></span> 
													<input id="ref_id" name="ref_id"   type="hidden" value="1"  >
														 
					</p>   

				 
                     
                                    
                  <div class="form-group">
                    <label>Password:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                      </div><input id="pass" name="pass"  type="password" class="form-control pull-right"  value=""    >
                       <input name="user_id" type="hidden" value="<?php echo $this->_var['usid']; ?>">
                    </div>
                  </div>
               
                                     
									  
                                       
                                        
                                    </form>
				 
				</div>
				<div class=col-sm-12 >
					  
                                
                               
                                  <input type="button" class="btn btn-block btn-success" value="Update" name="ok" id="ok" style="width:200px" onClick="Addwallet();">
                                 
                                 
				</div>
		 
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>  

 
 
 
 
 
 
 
  
  
    <script>
function Addwallet() {

		  
			 
					var ref_id = $('#ref_id').val();
					var pass = $('#pass').val();
				 
					if(pass  =="")
					{
						alert("Please Check Password");
						return false;
					}
				 
					if(ref_id  =="")
					{
						alert("Please Check member");
						return false;
					}
					else
					{
						$('#myForm').submit();
					}
 	 
		 
			 
		}
	</script>
  
<?php echo $this->fetch('footer.html'); ?>