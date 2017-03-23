<?php

 

class taobaoClass{

var $_num_iid  = "";
var $_title  = "";	
var $_desc_short = "";
var $_price = "";
var $_orginal_price = "";
var $_nick = "";
var $_pic_url= "";
var $_brand = "";
var $_desc= "";
var $_imageListTotal = "";
var $_imageList  = array();
var $_sizeListTotal = "";
var $_sizeList = array();
var $_colorListTotal = "";
var $_colorList = array();
		 
		
		function _itemsdetail($itemid) 
		{
			$map_url =  '.php?api_name=get_taobao_item&num_iid='.$itemid;
			$page = $this->get_remote_data($map_url);  
			$df = explode('<textarea', $page);
			$detail  = explode('</textarea>', $df[2]);
			$spirt_array =  explode('=>', $detail[0]);
			$crop_img  = explode('[item_imgs]', $detail[0]);
			$imgitems  = explode('[item_weight]', $crop_img[1]);
			$img_list =  explode('[url] =>', $imgitems[0]); 
			$crop_props = explode('[props_list]', $detail[0]);
			$propsitems  = explode('[seller_info]', $crop_props[1]);
			$size_list =  explode('尺码:', $propsitems[0]); 
			$crop_color = explode('[props_img] ', $detail[0]);
			$coloritems  = explode('[shop_item]', $crop_color[1]);
			$color_list =  explode('] =>', $coloritems[0]); 
			$data = array();
			$this->_num_iid = str_replace('[title]','',$spirt_array[2]);
			$this->_title = str_replace('[desc_short]','',$spirt_array[3]);
			$this->_desc_short = str_replace('[price]','',$spirt_array[4]);
			$this->_price = str_replace('[orginal_price]','',$spirt_array[5]); 
			$this->_orginal_price = str_replace('[nick]','',$spirt_array[6]);
			$this->_nick  = str_replace('[num]','',$spirt_array[7]);
			$this->_pic_url = str_replace('[brand]','',$spirt_array[11]);
			$this->_brand = str_replace('[brandId]','',$spirt_array[12]);
			$this->_desc = str_replace('[item_imgs]','',$spirt_array[17]);
			$this->_imageList  =array();
			$total_img = count($img_list)-1;
			$this->_imageListTotal = $total_img;
			if($total_img > 0)
			{
				for ($x = 1; $x <= $total_img; $x++) {
					$img  = explode(')', $img_list[$x]);	 
					$this->_imageList[$x] =$img[0];
				} 
			}
			$this->_sizeList  =array();
			$total_size = count($size_list) - 1;
			$this->_sizeListTotal = $total_size;
			if($total_size > 0)
			{
				for ($x = 1; $x <= $total_size; $x++) {
					$img  = explode('[', $size_list[$x]);	 
					$this->_sizeList[$x] =$img[0];
				} 
			}
			$this->_colorList  =array();
			$total_color = count($color_list) - 1; 
			$_colorListTotal  = $total_color;
			if($total_color > 0)
			{
				for ($x = 1; $x <= $total_color; $x++) {
					$img  = explode('[', $color_list[$x]);
					$img[0] = str_replace(')','', $img[0]);  
					$this->_colorList[$x] =$img[0];
				} 
			}

			 
		}
		function get_remote_data($url, $post_paramtrs = false) 
		{
			$c = curl_init();
			$url='api.onebound.cn/taobao/demo/demo'.$url;
			curl_setopt($c, CURLOPT_URL, $url);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
			if ($post_paramtrs) {
				curl_setopt($c, CURLOPT_POST, TRUE);
				curl_setopt($c, CURLOPT_POSTFIELDS, "var1=bla&" . $post_paramtrs);
			} curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0");
			curl_setopt($c, CURLOPT_COOKIE, 'CookieName1=Value;');
			curl_setopt($c, CURLOPT_MAXREDIRS, 10);
			$follow_allowed = ( ini_get('open_basedir') || ini_get('safe_mode')) ? false : true;
			if ($follow_allowed) {
				curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
			}curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 9);
			curl_setopt($c, CURLOPT_REFERER, $url);
			curl_setopt($c, CURLOPT_TIMEOUT, 60);
			curl_setopt($c, CURLOPT_AUTOREFERER, true);
			curl_setopt($c, CURLOPT_ENCODING, 'gzip,deflate');
			$data = curl_exec($c);
			$status = curl_getinfo($c);
			curl_close($c);
			preg_match('/(http(|s)):\/\/(.*?)\/(.*\/|)/si', $status['url'], $link);
			$data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/|\/)).*?)(\'|\")/si', '$1=$2' . $link[0] . '$3$4$5', $data);
			$data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/)).*?)(\'|\")/si', '$1=$2' . $link[1] . '://' . $link[3] . '$3$4$5', $data);
			if ($status['http_code'] == 200) {
				return $data;
			} elseif ($status['http_code'] == 301 || $status['http_code'] == 302) {
				if (!$follow_allowed) {
					if (empty($redirURL)) {
						if (!empty($status['redirect_url'])) {
							$redirURL = $status['redirect_url'];
						}
					} if (empty($redirURL)) {
						preg_match('/(Location:|URI:)(.*?)(\r|\n)/si', $data, $m);
						if (!empty($m[2])) {
							$redirURL = $m[2];
						}
					} if (empty($redirURL)) {
						preg_match('/href\=\"(.*?)\"(.*?)here\<\/a\>/si', $data, $m);
						if (!empty($m[1])) {
							$redirURL = $m[1];
						}
					} if (!empty($redirURL)) {
						$t = debug_backtrace();
						return call_user_func($t[0]["function"], trim($redirURL), $post_paramtrs);
					}
				}
			} return "ERRORCODE22 with $url!!<br/>Last status codes<b/>:" . json_encode($status) . "<br/><br/>Last data got<br/>:$data";
		}

		function _translate($text,$apiKey)
		{
			
			$url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source=zh_cn&target=th';

			 
			$handle = curl_init($url);
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($handle);                 
			$responseDecoded = json_decode($response, true);
			curl_close($handle);

			 
			echo  $responseDecoded['data']['translations'][0]['translatedText'];
		}
       
}


?>