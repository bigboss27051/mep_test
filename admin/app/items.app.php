<?php

 
class ItemsApp extends BackendApp
{
    var $_partner_mod;

    function __construct()
    {
        $this->ItemsApp();
    }

    function ItemsApp()
    {
        parent::BackendApp();

        
    }

    
    function index()
    {

		if (!IS_POST)
        {
			$showitems_mod =& m('showitems');
         	$items = $showitems_mod->find();
			
			$this->assign("items", $items);	
        	$this->display('items.index.html');
		}
		else
		{
		 
		 	$base_price = 6;
			$myfind_mod =& m('myfind');
			$url =$_POST['utlo'];
			$id  = $myfind_mod->_idform($url );
			$myfind_mod->_itemsdetail($id );
	 
			 
			
			$showitems_mod =& m('showitems');


			$price =  $base_price * $myfind_mod->_price;;

		 	$link ="https://world.taobao.com/item/".$id.".html";

			$data = array(
                'item_id' => $id  ,
			 	'name' =>$myfind_mod->_title  ,
				'thai' =>$myfind_mod->_translate($myfind_mod->_title)  ,		
				'link' =>$link   ,
				'logo' =>$myfind_mod->_pic_url   ,
				'price' => $price   ,
				'saleper' => '40'  ,
				'sale' => '1'  ,
				
				
					
				
            );
			$showitems_mod->add($data);
			
			 $this->show_message('Add_Done');
		}
		
    }
	function edit()
	{
		$id = empty($_GET['id']) ? 0 : intval($_GET['id']);
	    if (!IS_POST)
	    {
			
			$showitems_mod =& m('showitems');
         	$items = $showitems_mod->find($id );
			
			$this->assign("items", current($items));	
        	$this->display('items_edit.form.html');	
			
		}
		else
		{
			$id= $_POST['show_id'];
			$showitems_mod =& m('showitems');
			$data = array(
                
				'thai' =>$_POST['thai']  ,		
				'price' => $_POST['price']    ,
				'saleper' => $_POST['saleper']  ,
				'sale' => $_POST['sale']  ,
				'new' => $_POST['new'] ,
				'sort_order' => $_POST['sort_order'] ,
					
				
            );
			$showitems_mod->edit($id,$data);
			
			$this->show_message('Edit_Done');
		}

	}
	function drop()
	{
		$id = empty($_GET['id']) ? 0 : intval($_GET['id']);

		$showitems_mod =& m('showitems');
        $showitems_mod->drop($id );
		$this->show_message('Delete_Done');
	}
	     
}

?>