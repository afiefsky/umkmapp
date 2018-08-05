<?php

class Manage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model', 'company');
    }

    public function index()
    {
        $data['active_page'] = 'umkm/manage';
        $data['record'] = $this->company->list($this->session->userdata('user_id'))->result();
        $this->template->load('templates/main_template', 'umkm/manage/index', $data);
    }

    public function list()
    {
        $data['active_page'] = 'umkm/manage';
        $company_id = $this->uri->segment(4);
        // Adding company id to the session
        $this->session->set_userdata('company_id', $company_id);

        $data['record'] = $this->company->detail($company_id)->row_array();
        $this->template->load('templates/main_template', 'umkm/manage/list', $data);
    }

    public function add()
    {
        $data['active_page'] = 'umkm/manage';
        $company_id = $this->session->userdata('company_id');

        $data['record'] = $this->company->detail($company_id)->row_array();
        $this->template->load('templates/main_template', 'umkm/manage/add', $data);
    }
}