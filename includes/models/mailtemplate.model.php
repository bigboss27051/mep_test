<?php

/* 邮件模板 mailtemplate */
class MailtemplateModel extends BaseModel
{
    var $table  = 'mail_template';
    var $prikey = 'temp_id';
    var $_name  = 'mailtemplate';


function _mail_touser($users,$total,$email)
    {
         $to = $email;

		 
		 
		$subject = 'แจ้งการสังซื้อสินค้า';

		 
		
		$headers = "From: admin@maha-express.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=utf-8\r\n";

	 

		$message = '<html><body>';
		$message .= '<img src="http://maha-express.com/main/includes/libraries/javascript/templates2/images/logo.png"   height="100" alt="maha-express.com" />';
	 
		$message .= "<table     cellpadding='1'>";
		$message .= "<tr style='background: #fff;'><td><p style='font-size:40px;'>สวัสดีคุณ  ".$users."</p> </td></tr>";
 
		$message .= "<tr style='background: #fff;'><td><hr></td></tr>";
		$message .= "<tr style='background: #fff;'><td><p style='font-size:18px;'>คุณได้ทำการสั่งซื้อสินค้า ยอดเงินทั้งสิ้น  ".$total."</p></td></tr>";
 
 

		$message .= '</table > ';


		$message .= '</body></html>';

		mail($to, $subject, $message, $headers);
    }
}

?>