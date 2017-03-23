<?php echo $this->fetch('header.html'); ?>
<?php echo $this->fetch('_menu_top.html'); ?> 
<?php echo $this->fetch('_menu_left.html'); ?> 
<script type="text/javascript" src="<?php echo $this->res_base . "/" . 'js/mlm_json.js'; ?>" charset="utf-8"></script>
 
 
      <div class="content-wrapper">
        
        <section class="content-header">
          <h1>
            เติม Wallet
             
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="index.php?app=ewallet"><i class="fa fa-money"></i>Wallet</a></li>
            <li class="active">Add</li>
          </ol>
        </section>

        
        <section class="content">
         
           
           
			
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title"> </h3>
                </div>
                <div class="box-body">
                  <form role=form id="order"  class="smart-wizard form-horizontal" name=searchform id=searchform action="" method=post>
						  	<div class=form-group>
							</div>
							<div class=form-group>
								<label class="col-sm-3 control-label" for=ref_username>User ID:<font color="#ff0000">*</font></label>
									<div class=col-sm-7>

										<table>
										<tr>
											<td> <input <?php if ($this->_var['user_id']): ?> readonly="true" <?php endif; ?> name=cust_userid tabindex=2 id=cust_userid type=text size=22  placeholder="Type Members name here ..." maxlength=20 autocomplete=Off value='<?php echo $this->_var['user_name']; ?>' title="" class=form-control />
													<span id='referral_box'  class="messageboxok" style="display:none;">
														<span id="msss">  </span> 
													</span>
													<span id=errormsg4 ></span> 
													<input name='ref_id'  id='ref_id' type="hidden" value='' />
											</td>
											<td valign="top"><a href="javascript:void(0);" id="check_member"   class="btn btn-block btn-primary" tabindex=20    > Check Member  </i></a> </td>
										</tr>
									</table>

										
										
								</div>
							</div>
							<div class=form-group>
								<label class="col-sm-3 control-label" for=ref_username>Amount:<font color="#ff0000">*</font></label>
									<div class=col-sm-4>
 										<input   name=point tabindex=2 id=point type=text size=22    maxlength=20 autocomplete=Off value='' title="" class=form-control />
								</div>
							</div>
							<div class=form-group>
								<label class="col-sm-3 control-label" for=ref_username>Payment:<font color="#ff0000">*</font></label>
									<div class=col-sm-4>
 									<select size="1" name="spayment" id="spayment"  class=form-control >
           
 													<option value="1" >เงินโอน &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
              								</select>
								</div>
							</div>
							</form>
						<div class="tabbable" style="width:90%">
							<table border="0" width="100%">
                              <tbody><tr valign="top">
                                <td>
                                   
                              <tr>
                                <td id="sale" align="center" >
                                
                                <br>
								<div class="col-md-3"></div>
                               	<div class="col-md-3">
                                  <input type="button" value="Submit" name="ok" id="ok" class="btn btn-block btn-success" onClick="Addwallet();">
                                 </div>
                                </td>
                              </tr>
                              <tr>
                                <td></td>
                              </tr>
                            </tbody></table>
						</div>	
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>  


 
 
    <script>
	 
	 
	function Addwallet() 
	{
		 		var r = true;
  
			 
				if (r == true)
				{
					var amt = $('#point').val();
				 
					var ref_id = $('#ref_id').val();
				
					if(ref_id =="")
					{
						alert("Check member ");
						return false;
					}

 
				 
					$('#order').submit();
				 
				}
 		
			 
		}
	</script>
  
<?php echo $this->fetch('footer.html'); ?>