<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Activity_model', 'activity');
    }

    public function index()
    {
        // check if user is confirmed or not
        $user_data = $this->db->get_where('users', ['id' => $this->session->userdata('user_id')])->row_array();

        // $this->load->view('dashboard/index');
        $user_id = $this->session->userdata('user_id');
        $num_rows_companies = $this->user->check($user_id);
        $this->session->set_userdata([
        	'num_rows_companies' => $num_rows_companies
        ]);
        $data['active_page'] = 'dashboard';
        $data['record'] = $this->activity->list($user_id);
        $this->template->load('templates/main_template', 'dashboard/index', $data);
    }
}
