<?php

class User_model extends CI_Model
{
    public function validate($data)
    {
        $user = $this->db->get_where('users',
            [
                'username' => $data['username'],
                'password' => md5($data['password'])
            ]
        );

        if ($user->num_rows() > 0) {
            /**
             * Below is logic for storing session for username and its id
             */
            $user_data = $user->row_array();
            $this->session->set_userdata([
                'id' => $user_data['id'],
                'user_id' => $user_data['id'],
                'username' => $user_data['username']
            ]);
            return 1;
        } else {
            return 0;
        }
    }

    public function register($data)
    {
        $user = $this->db->get_where('users', ['username' => $data['username']]);
        $check = $user->num_rows();
        if ($check == 0) {
            $this->db->insert('users', $data);
            return 1;
        } else {
            $this->session->set_flashdata('error', 'Akun dengan username '. $data['username'] . ' sudah ada!!<br />Silahkan daftar menggunakan username lainnya!!!');
            redirect('register');
        }
    }

    public function check($id)
    {
        $this->db->select('*');
        $this->db->from('users_companies');
        $this->db->where('user_id', $id);
        return $this->db->get()->num_rows();
    }
}