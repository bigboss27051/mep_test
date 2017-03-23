$(document).ready(function(){

$.fn.countdown = function (callback, duration, message) {
     
    message = message || "";

	var contxt ="Calculate in "
     
    var container = $(this[0]).html(contxt + duration + message);
     
    var countdown = setInterval(function () {
        
        if (--duration) {
            
            container.html(contxt + duration + message);
         
        } else {
            
            clearInterval(countdown);
             
            callback.call(container);   
        }
     
    }, 1000);

};

 $("#startp").countdown(redirect, 5, "s remaining");

//setTimeout( redirect("rwer"), 1000 );
			 
}); 

function redirect () {
     //alert(SITE_URL_ID);



	$("#startp").html("Reading Member Data......" );


 
	$.getJSON("index.php?app=calculatecycle&act=getallusermonth",{'file_id':SITE_URL_ID},function(result){						        
									if(result.retval)
									{
										setTimeout(alluser(result.retval), 1000 );
								   		 	
									}
								 
									 
							   }); 
 
	 
}
function alluser (result) {
	
 
	var cities =result.ref_id.split(",");
	var round =result.round;
	var round_id =result.round_id;
	var date_et =result.date_et;
	var date_st =result.date_st;
	var pay_date = result.pay_date;
	$("#usertxt").html("Member Total " + cities.length + " User  ");
	for (i = 0; i < cities.length; i++) {
	

			setTimeout(readcom(cities[i],round,date_et,date_st,round_id,pay_date), 10000 );
			
			
    	 	calpercent(i+1,cities.length);
		     
			
	}
	

}
function readcom (id,round,date_et,date_st,round_id,pay_date) {

		 
			$.ajax({type:"POST",url:"index.php?app=calculatecycle&act=matchingcal",data:{'file_id':SITE_URL_ID,'id':id,'date_et':date_et,'date_st':date_st,'round_id':round_id,'round':round,'pay_date':pay_date}, success: function(result){
									
							       $('#myTbuser').append(result);	
							    }}); 
}

function calpercent(inow,total) { 

		
		var prty = (inow * 100) / total;

		$('#txtper').html(prty + "% Complete"); 
		var style = "width: " + prty + "%;";
		$('#st_progress').attr('style',style );
		if(prty == 100)
		{
			$("#startp").html("Calculate Finish");
		}
}
