<?php

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Company_model', 'company');
        check_session_admin();
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
        if (isset($_POST['submit'])) {
            // Uploading Start
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);

            $this->upload->do_upload('gambar');
            $image = $this->upload->data();
            // Uploading End

            $name = $this->input->post('name');
            $qty = $this->input->post('qty');
            $price = $this->input->post('price');
            $price = str_replace(['Rp', '.', ' '], '', $price);
            $data = [
                'name' => $name,
                'qty' => $qty,
                'company_id' => $this->session->userdata('company_id'),
                'file_name' => $image['file_name'],
                'price' => $price
            ];

            $this->db->insert('products', $data);
            $this->session->set_flashdata('message', 'Barang ' . $name . ' telah berhasil disimpan!');
            redirect('umkm/manage/product');
        } elseif (isset($_POST['form_page'])) {
            $data['active_page'] = 'umkm/manage';
            $data['message'] = '';
            $this->template->load('templates/admin_template', 'umkm/manage/add_product', $data);
        } elseif (isset($_POST['submit_search'])) {
            $keyword = $this->input->post('keyword');
            $company_id = $this->session->userdata('company_id');
            $user_id = $this->session->userdata('user_id');

            // paging logic start
            $record_default = $this->company->product_by_keyword($keyword, $company_id);

            $this->load->library('pagination');
            $config['base_url'] = base_url().'index.php/umkm/manage/product/';
            $config['total_rows'] = $record_default->num_rows();
            $config['per_page'] = 7;

            $this->pagination->initialize($config);

            $data['paging'] = $this->pagination->create_links();
            $page = $this->uri->segment(4);
            $page = $page == '' ? 0 : $page;

            $record_paging = $this->company->product_by_keyword_paging($page, $config['per_page'], $keyword, $company_id);
            // paging logic end

            $data['record'] = $record_paging->result();
            $this->template->load('templates/admin_template', 'umkm/manage/product', $data);
        } else {
            $company_id = $this->session->userdata('company_id');
            $user_id = $this->session->userdata('user_id');

            $record_default = $this->company->product($company_id);

            $this->load->library('pagination');
            $config['base_url'] = base_url().'index.php/umkm/manage/product/';
            $config['total_rows'] = $record_default->num_rows();
            $config['per_page'] = 7;

            $this->pagination->initialize($config);

            $data['paging'] = $this->pagination->create_links();
            $page = $this->uri->segment(4);
            $page = $page == '' ? 0 : $page;

            $record_paging = $this->company->product_paging($page, $config['per_page'], $company_id);
            $data['record'] = $record_paging->result();
            $this->template->load('templates/admin_template', 'umkm/manage/product', $data);
        }
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
