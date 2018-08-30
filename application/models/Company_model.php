<?php

class Company_model extends CI_Model
{
    public function insert($data)
    {
    	$check = $this->db->insert('companies', $data);
    	// RETURN THE ID FROM THE NEWEST INSERTED DATA TO COMPANY TABLE
    	$insert_id = $this->db->insert_id();

    	$user_id = $this->session->userdata('user_id');
    	$data = [
    		'user_id' => $user_id,
    		'company_id' => $insert_id
    	];
    	$this->db->insert('users_companies', $data);

    	return $insert_id;
    }

    /**
     * $id = company_id
     */
    public function detail($id)
    {
        $this->db->select('com.*, usr.phone');
        $this->db->from('users_companies AS usc');
        $this->db->join('companies AS com', 'com.id = usc.company_id');
        $this->db->join('users AS usr', 'usr.id = usc.user_id');
        $this->db->where('company_id', $id);
        $this->db->order_by('id', 'ASC');
        return $this->db->get();
    }

    public function list($user_id)
    {
        /**
         * usr = users table
         * com = companies table
         * ucm = users_companies table, a many to many relationship will resulting a new hidden table
         */
        $this->db->select('com.*, com.id AS company_id, com.is_confirmed');
        $this->db->from('users_companies AS ucm');
        $this->db->join('companies AS com', 'com.id = ucm.company_id', 'right');
        $this->db->join('users AS usr', 'usr.id = ucm.user_id', 'left');
        $this->db->where('usr.id', $user_id);
        $this->db->where('com.is_deleted !=', '1');
        $this->db->order_by('com.id');
        return $this->db->get();
    }

    public function list_paging($page, $limiter, $user_id)
    {
        /**
         * usr = users table
         * com = companies table
         * ucm = users_companies table, a many to many relationship will resulting a new hidden table
         */
        $this->db->select('com.*, com.id AS company_id, com.is_confirmed');
        $this->db->from('users_companies AS ucm');
        $this->db->join('companies AS com', 'com.id = ucm.company_id', 'right');
        $this->db->join('users AS usr', 'usr.id = ucm.user_id', 'left');
        $this->db->where('usr.id', $user_id);
        $this->db->where('com.is_deleted !=', '1');
        $this->db->order_by('com.id');
        $this->db->limit($limiter, $page);
        return $this->db->get();
    }

    public function list_by_keyword($keyword, $user_id)
    {
        /**
         * usr = users table
         * com = companies table
         * ucm = users_companies table, a many to many relationship will resulting a new hidden table
         */
        $this->db->select('com.*, com.id AS company_id, com.is_confirmed');
        $this->db->from('users_companies AS ucm');
        $this->db->join('companies AS com', 'com.id = ucm.company_id', 'right');
        $this->db->join('users AS usr', 'usr.id = ucm.user_id', 'left');
        $this->db->where('usr.id', $user_id);
        $this->db->where('com.is_deleted !=', '1');
        $this->db->like('com.name', $keyword);
        $this->db->order_by('com.id');
        return $this->db->get();
    }

    public function list_by_keyword_paging($page, $limiter, $keyword, $user_id)
    {
        /**
         * usr = users table
         * com = companies table
         * ucm = users_companies table, a many to many relationship will resulting a new hidden table
         */
        $this->db->select('com.*, com.id AS company_id, com.is_confirmed');
        $this->db->from('users_companies AS ucm');
        $this->db->join('companies AS com', 'com.id = ucm.company_id', 'right');
        $this->db->join('users AS usr', 'usr.id = ucm.user_id', 'left');
        $this->db->where('usr.id', $user_id);
        $this->db->where('com.is_deleted !=', '1');
        $this->db->like('com.name', $keyword);
        $this->db->order_by('com.id');
        $this->db->limit($limiter, $page);
        return $this->db->get();
    }

    public function product($company_id)
    {
        $query = "SELECT *
                    FROM
                    products
                    WHERE
                    company_id = $company_id ORDER BY id DESC";
        return $this->db->query($query);
    }

    public function product_paging($page, $limiter, $company_id)
    {
        $query = "SELECT *
                    FROM
                    products
                    WHERE
                    company_id = $company_id ORDER BY id DESC LIMIT $page, $limiter";
        return $this->db->query($query);
    }

    public function product_by_keyword($keyword, $company_id)
    {
        $query = "SELECT *
                    FROM
                    products
                    WHERE
                    company_id = $company_id
                    AND
                    products.name LIKE '%$keyword%'";
        return $this->db->query($query);
    }

    public function product_by_keyword_paging($page, $limiter, $keyword, $company_id)
    {
        $query = "SELECT *
                    FROM
                    products
                    WHERE
                    company_id = $company_id
                    AND
                    products.name LIKE '%$keyword%'
                    LIMIT $page, $limiter";
        return $this->db->query($query);
    }

    public function all()
    {
        $this->db->where('is_confirmed !=', '0');
        $this->db->where('is_deleted !=', '1');
        return $this->db->get('companies');
    }
}
	