<?php

 
class Cart_reModel extends BaseModel
{
    var $table  = 'cart_re';
    var $prikey = 'rec_id';
    var $_name  = 'cart_re';

    var $_relation = array(
        'belongs_to_store'  => array(
            'type'      =>  BELONGS_TO,
            'model'     =>  'store',
            'reverse'   =>  'has_cart',
        ),
        'belongs_to_goodsspec'  => array(
            'type'      =>  BELONGS_TO,
            'model'     =>  'goodsspec',
            'foreign_key' => 'spec_id',
            'reverse'   =>  'has_cart_items',
        ),
    );

     
    function get_kinds($sess_id, $user_id = 0)
    {
        $where_user_id = $user_id ? " AND user_id={$user_id}" : '';
        $kinds = $this->db->getOne("SELECT COUNT(DISTINCT goods_id) as c FROM {$this->table} WHERE session_id='{$sess_id}'{$where_user_id}");

        return $kinds;
    }
}

?>