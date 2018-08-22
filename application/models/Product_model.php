<?php

class Product_model extends CI_Model
{
    /**
     * VARIABLES
     * $id
     * $company_id
     */

	public function delete($id)
	{
		$this->db->delete('products', ['id' => $id]);
        return true;
	}

    public function all_by_company_id($company_id)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('company_id', $company_id);
        return $this->db->get();
    }
}
