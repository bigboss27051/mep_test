$(document).ready(function(){

  				 
		  

});


function getTabular(id)
{
 
  
	$.ajax({type:"POST",url: "index.php?app=user&act=read_tabu",data:{member_id:id}, success: function(result){
							        $("#tree3").html(result);
							    }}); 
}
function getTabularNode(id,node)
{
	var read = $("#" + node).html();
	if(read == "")
	{
  		$.ajax({type:"POST",url: "index.php?app=user&act=read_tabu",data:{member_id:id,node:1}, success: function(result){
							        $("#" + node).html(result);
							    }}); 
	}
	else
	{
		$("#" + node).html("");
	}
}
 
