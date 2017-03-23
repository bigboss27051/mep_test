<div class="footer" id="footer">
        <div class="container">
            <ul class=" pull-left navbar-link footer-nav">
                 <li>
					<a href="index.html">หน้าแรก </a> 
					<a href="about-us.html">เกี่ยวกับเรา </a> 
					<a href="terms-conditions.html">สมาชิก </a> 
					<a href="#">วิธีการสั่งซื้อสินค้า </a> 
					<a href="contact.html">สั่งสินค้า </a> 
					<a href="faq.html">ค่าขนส่ง</a>
					<a href="faq.html">ข่าวสารและกิจกรรม</a>
					<a href="faq.html">โปรโมชั่น</a>
					<a href="faq.html">ถามตอบ</a>
					<a href="faq.html">ติดต่อเรา</a>
				</li>
            </ul>
            <ul class=" pull-right navbar-link footer-nav">
                <li> &copy; maha-express.com 2015 BootClassified</li>
            </ul>
        </div>

    </div>
    
</div>


<!-- Le javascript
================================================== -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="<?php echo $this->lib_base . "/" . 'templates2/assets/bootstrap/js/bootstrap.min.js'; ?>"></script>


<script src="<?php echo $this->lib_base . "/" . 'templates2/assets/js/owl.carousel.min.js'; ?>"></script>


<script src="<?php echo $this->lib_base . "/" . 'templates2/assets/js/jquery.matchHeight-min.js'; ?>"></script>


<script src="<?php echo $this->lib_base . "/" . 'templates2/assets/js/hideMaxListItem.js'; ?>"></script>


<script src="<?php echo $this->lib_base . "/" . 'templates2/assets/plugins/jquery.fs.scroller/jquery.fs.scroller.js'; ?>"></script>
<script src="<?php echo $this->lib_base . "/" . 'templates2/assets/plugins/jquery.fs.selecter/jquery.fs.selecter.js'; ?>"></script>



<script src="<?php echo $this->lib_base . "/" . 'templates2/assets/js/script.js'; ?>"></script>

<script>


</script>




<script>
function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
 
 
	$(document).ready(function(){
	 

		  $.getJSON("index.php?app=member&act=getwallet",function(result){
				if(result.retval)
				{	 
				
					$("#walle").html(addCommas(result.retval.wallet));
					 
				}	
		}); 

		 
 
	 
	 });
</script>

 

</body>
</html>