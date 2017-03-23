$(document).ready(function(){

 			 
			$("#check_member").click(function(){
				
					var fggff=$("#cust_userid").val();
					
					var date1 =$("#dt_start").val();
					var date2 =$("#dt_end").val();
					var scheck = true;
					var memid = "";
					if(fggff !="")
					{
					
					
						$('#referral_box').attr('style','opacity: 1;display:block;');
						$('#msss').html("<img src='templates/images/loader.gif' align='absmiddle'>Checking sponsor username...");
						$.getJSON("index.php?app=user&act=getuser",{'file_id':fggff},function(result){
						   if(result.retval)
							{
								//$("#consignee").val(result.retval.name) ;
							 	//$("#ref_id").val(result.retval.ref_id);
									 
							 	memid = result.retval.ref_id;
								$('#referral_box').attr('style','opacity: 1;display:block;');
								$('#msss').html("<img src='templates/images/accepted.png' align='absmiddle'>Member username validated...");
								$("#referal_div").attr('style','display:block;');
							 	getRepoData(memid,date1,date2);
								
								  
							}
							else
							{
								
								 
								$('#referral_box').attr('style','opacity: 1;display:block;');
								$('#msss').html("<img src='templates/images/Error.png' align='absmiddle'> Invalid Member  username ...");
								$("#referal_div").attr('style','display:none;');
								 scheck = 	false;
							}
						
						});
					}
					else
					{	 
						getRepoData(memid,date1,date2);
					}
				
			});
			 

		


	});;

function withdrawid(id)
{
		 $("#a"+ id).submit();			 
}