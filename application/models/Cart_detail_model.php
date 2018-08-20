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

    /**
     * var $user_id as parameter
     * cart_detail AS cad
     * LEFT JOIN carts AS car
     * RIGHT JOIN products AS pro
     */
    public function get_cart_product($user_id)
    {
        $query = "SELECT com.name as com_name, car.transaction_code, pro.file_name, pro.name as pro_name, pro.price, cad.qty, car.status, car.id AS cart_id, cad.created_at
                    FROM carts_details AS cad
                    LEFT JOIN carts AS car ON car.id=cad.cart_id
                    RIGHT JOIN products AS pro ON pro.id=cad.product_id,
                    users_companies AS uco,
                    companies AS com
                    WHERE car.status = '2'
                    AND pro.company_id = uco.company_id
                    AND uco.company_id = com.id
                    AND uco.user_id = '$user_id'
                    ORDER BY car.id DESC";

        return $this->db->query($query);
    }

    public function get_cart_by_user_id($user_id)
    {
        $query = "SELECT com.name as com_name, car.transaction_code, pro.file_name, pro.name as pro_name, pro.price, cad.qty, car.status, car.id AS cart_id, cad.created_at, car.created_at AS date_created
                    FROM carts_details AS cad
                    LEFT JOIN carts AS car ON car.id=cad.cart_id
                    RIGHT JOIN products AS pro ON pro.id=cad.product_id,
                    users_companies AS uco,
                    companies AS com
                    WHERE car.status != '1'
                    AND pro.company_id = uco.company_id
                    AND uco.company_id = com.id
                    AND uco.user_id = '$user_id'
                    ORDER BY car.created_at DESC";

        return $this->db->query($query);
    }

    public function get_cart_by_user_id_and_date_between($user_id, $date_start, $date_end)
    {
        $query = "SELECT com.name as com_name, car.transaction_code, pro.file_name, pro.name as pro_name, pro.price, cad.qty, car.status, car.id AS cart_id, cad.created_at, car.created_at
                    FROM carts_details AS cad
                    LEFT JOIN carts AS car ON car.id=cad.cart_id
                    RIGHT JOIN products AS pro ON pro.id=cad.product_id,
                    users_companies AS uco,
                    companies AS com
                    WHERE car.status != '1'
                    AND pro.company_id = uco.company_id
                    AND uco.company_id = com.id
                    AND uco.user_id = '$user_id'
                    AND DATE_FORMAT(car.created_at, '%Y-%m-%d') BETWEEN '$date_start' AND '$date_end'
                    ORDER BY car.created_at DESC";

        return $this->db->query($query);
    }
}
