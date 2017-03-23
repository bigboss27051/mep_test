<?php

 
class Receive_goodsModel extends BaseModel
{
    var $table  = 'receive_goods';
    var $prikey = 'rec_id';
    var $_name  = 'receive_goods';
    var $_relation = array(
        
        'belongs_to_order' => array(
            'model'         => 'receive',
            'type'          => BELONGS_TO,
            'foreign_key'   => 'order_id',
            'reverse'       => 'has_ordergoods',
        ),
    );
}

?>