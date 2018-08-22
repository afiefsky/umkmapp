<?php

class Cart_model extends CI_Model
{
    public function get_scheduled_day($id)
    {
        $this->db->select('(created_at + INTERVAL "1" DAY) AS scheduled_day');
        $this->db->from('carts');
        $this->db->where('id', $id);
        return $this->db->get();
    }
}
