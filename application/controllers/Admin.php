<?php

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Company_model', 'company');
	}

	public function index()
	{
		$data['active_page'] = '';
		$this->template->load('templates/admin_template', 'admin/index', $data);
	}

	public function umkm()
	{
		$data['active_page'] = '';
		$data['record'] = $this->db->get('companies')->result();
		$this->template->load('templates/admin_template', 'admin/umkm', $data);
	}

	public function check_umkm()
	{
		$data['active_page'] = '';
		$company_id = $this->uri->segment(3);
		$this->session->set_userdata('company_id', $company_id);

        $data['record'] = $this->company->detail($company_id)->row_array();
        $this->template->load('templates/admin_template', 'umkm/manage/list', $data);
	}

	public function check_umkm_product()
	{
		$data['active_page'] = 'umkm/manage';        
        $company_id = $this->session->userdata('company_id');
        $user_id = $this->session->userdata('user_id');

        $data['record'] = $this->company->product($company_id)->result();
        $this->template->load('templates/admin_template', 'umkm/manage/product', $data);
	}

	public function activate_umkm()
	{
		$company_id = $this->uri->segment(3);
		$this->db->where('id', $company_id);
		$this->db->update('companies', ['is_confirmed' => '1']);

		$data = $this->db->get_where('companies', ['id' => $company_id])->row_array();

		$this->session->set_flashdata('message', 'UMKM '.$data['name'].' telah berhasil diaktivasi!!!');

		redirect('admin/umkm');
	}
}