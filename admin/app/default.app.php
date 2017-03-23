<?php

 
class DefaultApp extends BackendApp
{
   	var $_menu_mod;	

	
    function index()
    {
         
        unset($back_nav['dashboard']);
  		 
			
		 
        $this->display('index.html');
    }

   
    function welcome()
    {
      
        $this->assign('cur_lang', LANG);

       
        $this->display('welcome.html');
    }

    
    function aboutus()
    {
        $this->headtag('<base target="_blank" />');
        $this->display('aboutus.html');
    }

    function _get_menu()
    {
        $menu = include(APP_ROOT . '/includes/menu.inc.php');

        return $menu;
    }

  
  

    function _get_sys_info()
    {
        $user_mod =& m('member');
        $filename = ROOT_PATH . '/data/install.lock';
        return array(
            'server_os'     => PHP_OS,
            'web_server'    => $_SERVER['SERVER_SOFTWARE'],
            'php_version'   => PHP_VERSION,
            'mysql_version' => $user_mod->db->version(),
            'ecmall_version'=> VERSION . ' ' . RELEASE,
            'install_date'  => file_exists($filename) ? date('Y-m-d', fileatime($filename)) : date('Y-m-d'),
        );
    }

     

    function clear_cache()
    {
        $cache_server =& cache_server();
        $cache_server->clear();
        $this->json_result('', Lang::get('clear_cache_ok'));
    }

    
 
}
?>