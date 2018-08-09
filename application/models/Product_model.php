<?php

class Product_model extends CI_Model
{
	public function delete($id)
	{
		$this->db->delete('products', ['id' => $id]);
        return true;
	}
}