<?php

class SetlangApp extends BackendApp
{

    function index()
    {
		if (IS_POST)
        {
			 
			setcookie("sess_lang",$_POST['setLang'] ,time() + (86400 * 30), "/"); 
		}
    }
}

?>
