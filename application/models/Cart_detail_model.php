<?php

class Cart_detail_model extends CI_Model
{
    public function get_with_product($cart_id)
    {
        $this->db->select('*, crd.id AS detail_id, crd.qty AS qty');
        $this->db->from('carts_details AS crd');
        $this->db->join('products AS prd', 'prd.id = crd.product_id', 'right');
        $this->db->where('cart_id', $cart_id);
        $this->db->where('is_cancelled != "1"');
        return $this->db->get();
    }
}
