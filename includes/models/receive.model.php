<?php

 
class ReceiveModel extends BaseModel
{
    var $table  = 'receive';
    var $alias  = 'receive_alias';
    var $prikey = 'order_id';
    var $_name  = 'receive';
    var $_relation  = array(
         
       
        'has_ordergoods' => array(
            'model'         => 'receive_goods',
            'type'          => HAS_MANY,
            'foreign_key'   => 'order_id',
            'dependent'     => true
        ),
        
    );

     
}

?>
