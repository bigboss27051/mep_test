<?PHP
error_reporting(0);

$leversion="Languages Editor V1.2";
$emallvers="ECMALL 2.3";


$rdfile=$_GET['l'];

function is_array_empty($a){
foreach($a as $elm)
if(!empty($elm)) return false;
return true;
}

 if($_GET['do']=="save"){
$arr= $_POST; 
$fp = fopen($rdfile, 'w') or die('Could not open file!');  

$bheader = "<?php 
return array(\n";
$bfooter = "\n);
?>";

$ch=0;
fwrite($fp, $bheader) or die('Could not write to file');  
foreach ($arr as $key=>$value) { 
if(!empty($_POST)){


          if(is_array_empty($value)){
			  $ktc="'".stripslashes($value)."', \n";
			  
		  }else{
			  $ktc="array( \n";
			  $ktcend="), \n";
		  }

		   //$toFile= "'$key' => ".$ktc;
           fwrite($fp, "'$key' => ".$ktc) or die('Could not write to file'); 
          foreach ($value as $keyb=>$valueb) { 
		   //$toFile= "'$keyb' => '".stripslashes($valueb)."', \n";
		   fwrite($fp, "'$keyb' => '".stripslashes($valueb)."', \n") or die('Could not write to file');  
          }

		  if(is_array_empty($value)){
		  }else{
			  //$toFile= $ktcend;
			  fwrite($fp, $ktcend) or die('Could not write to file');  
		  }


		
	// write to file  
    //fwrite($fp, "$toFile") or die('Could not write to file');  

}
// close file  
} 
fseek($fp, -3, SEEK_END);
fwrite($fp, $bfooter) or die('Could not write to file'); 
fclose($fp);

echo "<script>window.location='?l=".$rdfile."&save=ok';</script>";
 }


// for test output on screen
/*
  if($_GET['do']=="save"){
	  $arr= $_POST;
	  foreach ($arr as $key=>$value) { 

          if(is_array_empty($value)){
			  $ktc="'".stripslashes($value)."', <br>";
		  }else{
			  $ktc="array( <br>";
			  $ktcend="), \n<br>";
		  }

		   echo "'$key' => $ktc";
          foreach ($value as $keyb=>$valueb) { 
		   echo "'$keyb' => '".stripslashes($valueb)."', <br>";
          }

		  if(!is_array_empty($value)){
			  echo $ktcend;
		  }


	  }
	  //print_r($_POST);
	  //echo $_POST;

  }*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $leversion; ?> (For <?php echo $emallvers; ?>)</title>
<style type="text/css">
body {
	margin: 10;
	padding: 0;
	color: #000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	line-height: 1.4;
}
.cc {
	font-size: 14px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	line-height: normal;
	color: #333;
}
ul, ol, dl { 
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	
	padding-right: 15px;
	padding-left: 15px; 
}
a img { 
	border: none;
}

a:link {
	color: #42413C;
	text-decoration: none;
}
a:visited {
	color: #6E6C64;
	text-decoration: none;
}
a:hover, a:active, a:focus { 
	text-decoration: none;
}
INPUT:hover {
	background-color: #F60;
}
INPUT:focus {
	background-color: #FFE4CA;
}
INPUT:focus:hover {
	background-color: #CCC;
}
.footer {
	font-size: 10px;
}
</style>

</head>

<body>
<?php


$objScan = scandir(".");
$n=0;
foreach ($objScan as $value) {
	$rddir = explode(".", $value);
	if(($rddir[2]=="php") and empty($rddir[3])){
	$n++;

	if ($rdfile==$value){
    echo "<b>$value</b> &nbsp;";
	}else{
	echo "<a href=\"?l=$value\">$value</a> &nbsp;";
	}


	}
}
echo "<br> มี  ".$n. "ไฟล์";
echo"<br /><br />";


if (!file_exists($rdfile)){
echo "ไม่พบไฟล์ที่ต้องการแปล กรุณาพิมพ์ \"?l=languages.php\" หรือเลือกไฟล์จากด้านบน";
exit();
}

if($_GET['save']=="ok"){
	$saved="ทำการบันทึกเรียบร้อยแล้ว!";
}



$file = fopen($rdfile, "r");

echo "<font class=\"cc\">".$leversion." (For ".$emallvers.")<br />
by Alongkorn Khaoto / alongkorn@live.com </font><br />
<br />
กำลังเปิดไฟล์ : <b>".$rdfile."</b> ".$saved."
<br />
<br />";


echo "<form action=\"?l=$rdfile&do=save\" method=\"post\" enctype=\"multipart/form-data\" name=\"form1\" id=\"form1\">";
echo "<table width=\"700\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";




$file = include $rdfile;
$i = 0;
foreach ($file  as $obj_key =>$title){
  $i++;
  echo "<tr>";
  echo "<tr> <td width=\"204\">".$obj_key."</td><td width=\"9\">&nbsp;</td>";
  echo "<td width=\"485\">"; 
  if(is_array_empty($title)){
  echo "<input  onclick=\"this.select();\" type=\"text\" name=\"$obj_key\" id=\"$c[1]\" size=\"50\" value=\"".htmlspecialchars($title)."\"/><br>"; 
  }else{
  //echo "$obj_key : $title";
    foreach ($title as $key=>$value){
	$i++;
     echo "$key <input  onclick=\"this.select();\" type=\"text\" name=\"".$obj_key."[".$key."]\" id=\"$c[1]\" size=\"20\" value=\"".htmlspecialchars($value)."\"/><br>"; 
    //echo "$key: $value";
  }
  }
echo "</td></tr>";
}




//echo "0".$c[0]."/1".$c[1]."/2".$c[2]."/3".$c[3];
if($i<1){
echo "ไม่พบข้อมูลในไฟล์ที่ต้องการ!";
}

echo "</table>";
echo"<br />";
echo "<input type=\"submit\"  id=\"button\" value=\"Save\" ";
if($i<1){
	echo " disabled";
}
echo"/>";

if($i>0){
echo "&nbsp;&nbsp;&nbsp;  ตรวจพบ ".$i." รายการ";
}

$last_mod = filemtime($rdfile);
if (file_exists($rdfile)){
	echo "&nbsp;&nbsp;&nbsp; Last modified: ".date( "F d Y H:i:s.", $last_mod );
}

echo"<br />";
echo"</form>";




?>
<table width="717" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="717" height="20" align="center" class="footer">Copyright © 2013 <strong>IMZER</strong>. All Rights Reserved</td>
  </tr>
</table>
</body>
</html>
