<?php

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model', 'company');
    }

    public function index()
    {
        $this->session->set_userdata('company_name', 'Form Tambah UMKM');
    	if (isset($_POST['submit'])) {
            $config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $config);

            $upload = $this->upload->do_upload('image');
            $data = $this->upload->data();

            $data = [
                'name' => $this->input->post('name'),
                'location' => $this->input->post('location'),
                'location_full' => $this->input->post('location_full'),
                'image_url' => $data['file_name']
            ];

            $this->company->insert($data);
            $this->session->set_flashdata('message', 'UMKM dengan nama <b>'.$data['name'].'</b> telah berhasil dibuat!!!<br />MOHON TUNGGU SAMPAI ADMIN MEMBERIKAN KONFIRMASI AKSES UMKM YANG BARU ANDA BUAT!!!');
            redirect('dashboard');
    	} else {
            $data['active_page'] = 'umkm/register';
    		$this->template->load('templates/main_template', 'umkm/register/index', $data);
    	}
    }
}
