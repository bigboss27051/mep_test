$(document).ready(function(){

 		 
		 
			$("#next_1").click(function(){
					
				 	var position = $("#position").val();
					var up_username = $("#up_username").val();
					var fggff=$("#ref_username").val();
					$('#referral_box').attr('style','opacity: 1;display:block;');
					$('#msss').html("<img src='templates/images/loader.gif' align='absmiddle'>Checking sponsor username...");
					
				   $.getJSON("soap.php?app=soap&act=getuser",{'file_id':fggff,'position':position,'up_username':up_username},function(result){
					   if(result.retval)
						{
							var check =true;
							  
							$("#ref_name").val(result.retval.name) ;
						 	$("#ref_id").val(result.retval.ref_id);
						 	if(!result.retval.leg)
							{
								//alert("yy76");
								$('#ddposition').attr('class','form-group has-error');
								$('#msgposition').html("Can't use This position")
								check = false;
							}
					
							$('#referral_box').attr('style','opacity: 1;display:block;');
							$('#msss').html("<img src='templates/images/accepted.png' align='absmiddle'>Sponsor username validated...");
							$("#referal_div").attr('style','display:block;');
								
						 	
							 
							if($('#position').val() == "")
							{
								$('#ddposition').attr('class','form-group has-error');
								$('#msgposition').html("You must select your position..")
								check = false;
							}
							if(check)
							{
								  
								$('#ddposition').attr('class','form-group');
								$('#msgposition').html("")
								$('#ddpoinves').attr('class','form-group');
								$('#msginves').html("")
								$("#step-1").attr('style','display:none;');
								$("#link_step1").attr('class','done');
								$("#link_step2").attr('class','selected');
								
								$('#st_progress').attr('style','width: 33%;');
								$('#step-2').attr('style','display:block;');
							
							}
							
							 
						}
						else
						{
							
							$("#ref_name").val("") ;
							$('#referral_box').attr('style','opacity: 1;display:block;');
							$('#msss').html("<img src='templates/images/Error.png' align='absmiddle'> Invalid Sponsor username ...");
							$("#referal_div").attr('style','display:none;');
						}
					});

			});

			$("#next_2back").click(function(){
				
					$('#step-1').attr('style','display:block;');
					$("#step-2").attr('style','display:none;');
				});

			$("#next_2go").click(function(){
				
				var check =true;
			 
				var elm_check = $('#agree').is(':checked');
				if($('#full_name').val() == "")
				{
					$('#ddfull_name').attr('class','form-group has-error');
					$('#msgfull_name').html("You must enter Name.")
					 check = false;
				}	
				else
				{
					$('#ddfull_name').attr('class','form-group');
					$('#msgfull_name').html("")
				}
				if($('#pswd').val() == "")
				{
					$('#ddpswd').attr('class','form-group has-error');
					$('#msgpswd').html("You must enter Password.")
				 	check = false;
				}
				else
				{
					$('#ddpswd').attr('class','form-group');
					$('#msgpswd').html("")
				}
				if($('#cpswd').val() == "")
				{
					$('#ddcpswd').attr('class','form-group has-error');
					$('#msgcpswd').html("You must enter Password.")
				 	check = false;
				}
				else
				{
					$('#ddcpswd').attr('class','form-group');
					$('#msgcpswd').html("")
				}
				if($('#address').val() == "")
				{
					$('#ddaddress').attr('class','form-group has-error');
					$('#msgaddress').html("You must enter Address.")
				 	check = false;
				}
				else
				{
					$('#ddaddress').attr('class','form-group');
					$('#msgaddress').html("")
				}
				if($('#phone_tel').val() == "")
				{
					$('#ddphone_tel').attr('class','form-group has-error');
					$('#msgphone_tel').html("You must enter Contact Phone.")
				 	check = false;
				}
				else
				{
					$('#ddphone_tel').attr('class','form-group');
					$('#msgphone_tel').html("")
				}
			

				
				if(!check)
				{
					window.scrollTo(0, 0);
					return;
				}
				
				if(elm_check)
				{
					 var position = $("#position").val();
					var up_username = $("#up_username").val();
					 
					var fggff=$("#ref_username").val();

				 
					$('#referral_box').attr('style','opacity: 1;display:block;');
					$('#msss').html("<img src='templates/images/loader.gif' align='absmiddle'>Checking sponsor username...");
					
				    $.getJSON("soap.php?app=soap&act=getuser",{'file_id':fggff,'position':position,'up_username':up_username},function(result){
					   if(result.retval)
						{
							var check =true; 
							$("#ref_name").val(result.retval.name) ;
						 	$("#ref_id").val(result.retval.ref_id);
							if(!result.retval.leg)
							{
								$('#ddposition').attr('class','form-group has-error');
								$('#msgposition').html("Can't use This position")
								check = false;
							}
		
						 
							$('#referral_box').attr('style','opacity: 1;display:block;');
							$('#msss').html("<img src='templates/images/accepted.png' align='absmiddle'>Sponsor username validated...");
							$("#referal_div").attr('style','display:block;');
								
						 	
							 
							if($('#position').val() == "")
							{
								$('#ddposition').attr('class','form-group has-error');
								$('#msgposition').html("You must select your position..")
								check = false;
							}
							if(check)
							{
								$('#form_reg').submit();
								  
								
							
							}
							else
							{
								 
								$("#step-3").attr('style','display:none;');
								$("#link_step1").attr('class','selected');
								$("#link_step2").attr('class','disabled');
								$("#link_step3").attr('class','disabled');
								
								$('#st_progress').attr('style','width: 0%;');
								$('#step-1').attr('style','display:block;');
								
							}
							
							 
						}
						else
						{
							
							$("#ref_name").val("") ;
							$('#referral_box').attr('style','opacity: 1;display:block;');
							$('#msss').html("<img src='templates/images/Error.png' align='absmiddle'> Invalid Sponsor username ...");
							$("#referal_div").attr('style','display:none;');
						}
					});
				}
				else
				{
					$('#ddagree').attr('class','form-group has-error');
					$('#msgagree').html("You must Read and ACCEPT TERMS.")
					
				}
			});

			 

		 	 

	});;