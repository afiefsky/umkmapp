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


    /**
     * $this->template->load('templating file loc', '$contents loc');
     * example: $this->template->load('templates/main_template', 'umkm/manage/add_product');
     */
    public function product()
    {
        if (isset($_POST['submit'])) {
            // Uploading Start
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $config);

            $this->upload->do_upload('gambar');
            $image = $this->upload->data();
            // Uploading End

            $name = $this->input->post('name');
            $qty = $this->input->post('qty');
            $data = [
                'name' => $name,
                'qty' => $qty,
                'company_id' => $this->session->userdata('company_id'),
                'file_name' => $image['file_name']
            ];

            $this->db->insert('products', $data);
            $this->session->set_flashdata('message', 'Barang ' . $name . ' telah berhasil disimpan!');
            redirect('umkm/manage/product');
        } elseif (isset($_POST['form_page'])) {
            $data['active_page'] = 'umkm/manage';
            $data['message'] = '';
            $this->template->load('templates/main_template', 'umkm/manage/add_product', $data);
        } else {
            $data['active_page'] = 'umkm/manage';        
            $company_id = $this->session->userdata('company_id');
            $user_id = $this->session->userdata('user_id');

            $data['record'] = $this->company->product($company_id)->result();
            $this->template->load('templates/main_template', 'umkm/manage/product', $data);
        }
    }
}