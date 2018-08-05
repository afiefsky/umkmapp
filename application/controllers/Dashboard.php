<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }

    public function index()
    {
        // $this->load->view('dashboard/index');
        $user_id = $this->session->userdata('id');
        $num_rows_companies = $this->user->check($user_id);
        $this->session->set_userdata([
        	'num_rows_companies' => $num_rows_companies
        ]);
        $data['active_page'] = 'dashboard';
        $this->template->load('templates/main_template', 'dashboard/index', $data);
    }
}