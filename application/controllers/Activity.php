<?php

class Activity extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $company_id = $this->session->userdata('company_id');
        $data['record'] = $this->db->get_where('activities', ['company_id' => $company_id]);
        $this->template->load('templates/main_template', 'activity/index', $data);
    }

    public function add()
    {
        if (isset($_POST['submit'])) {
            $name = $this->input->post('name');
            $date = $this->input->post('date');
            
            // uploading start
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $this->upload->do_upload('file_name');
            $image_data = $this->upload->data();

            $data = [
                'name' => $name,
                'date' => $date,
                'company_id' => $this->session->userdata('company_id'),
                'file_name' => $image_data['file_name']
            ];

            $this->db->insert('activities', $data);
            redirect('Activity');
            // uploading end

        } else {
            $this->template->load('templates/main_template', 'activity/add');   
        }
    }
}