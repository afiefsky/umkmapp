<?php

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }

    public function index()
    {
    	if (isset($_POST['submit'])) {
    		$username = $this->input->post('username');

    		$password = $this->input->post('password');
    		$re_password = $this->input->post('re_password');

            $bank_account_number = $this->input->post('bank_account_number');
            $bank_name = $this->input->post('bank_name');
            $bank_account_owner = $this->input->post('bank_account_owner');
            $phone = $this->input->post('phone');

    		if ($password != $re_password) {
    			$this->session->set_flashdata('error', 'PASSWORD DAN KETIK ULANG PASSWORD TIDAK COCOK, SILAHKAN ISI KEMBALI!!!');
    			redirect('register');
    		} else {
    			$data = [
    				'username' => $username,
    				'password' => md5($password),
                    'phone' => $phone,
                    'bank_account_number' => $bank_account_number,
                    'bank_name' => $bank_name,
                    'bank_account_owner' => $bank_account_owner
    			];
				$this->user->register($data);
				$this->session->set_flashdata('error', 'Akun dengan username '. $username . ' telah berhasil terdaftar!!!<br />Silahkan login untuk menggunakan Aplikasi UMKM!!!');
				redirect('auth');
    		}
    	} else {
    		$data['error'] = $this->session->userdata('error');
        	$this->template->load('templates/register_template', 'register/index', $data);
    	}
    }

    public function request_create_umkm()
    {
        $this->template->load('templates/admin_template', 'umkm/request');
    }
}
		