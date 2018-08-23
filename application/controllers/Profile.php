<?php

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('company_name', 'Profil');
        $data['record'] = $this->db->get_where('users', ['id'=>$this->session->userdata('user_id')])->row_array();
        $this->template->load('templates/main_template', 'profile/index', $data);
    }

    public function edit()
    {
        $user_id = $this->uri->segment(3);

        if (isset($_POST['submit'])) {
            $password = $this->input->post('password');
            $re_password = $this->input->post('re_password');

            if ($password != $re_password) {
                $this->session->set_flashdata('message', 'KATA SANDI DAN KATA SANDI ULANG TIDAK COCOK!!!');
                redirect('profile/edit/'.$user_id);
                die();
            }

            $data = $this->db->get_where('users', ['id'=>$user_id])->row_array();
            if ($password==$data['password']) {

            } else {
                $password = md5($password);
            }

            $username = $this->input->post('username');
            $phone = $this->input->post('phone');
            $bank_account_number = $this->input->post('bank_account_number');
            $bank_name = $this->input->post('bank_name');
            $bank_account_owner = $this->input->post('bank_account_owner');

            $data = [
                'username' => $username,
                'phone' => $phone,
                'bank_account_number' => $bank_account_number,
                'bank_name' => $bank_name,
                'bank_account_owner' => $bank_account_owner,
                'password' => $password
            ];

            $this->db->where('id', $user_id);
            $this->db->update('users', $data);

            $this->session->set_flashdata('message', 'PROFIL BERHASIL DIUBAH!!!');
            redirect('profile');
        } else {
            $this->session->set_userdata('company_name', 'Profil');
            $data['record'] = $this->db->get_where('users', ['id'=>$user_id])->row_array();
            $this->template->load('templates/main_template', 'profile/edit', $data);
        }
    }
}
