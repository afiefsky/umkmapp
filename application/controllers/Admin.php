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
        $this->session->set_userdata('company_name', 'Beranda Admin');
        $data['active_page'] = '';
        $this->template->load('templates/admin_template', 'admin/index', $data);
    }

    // $this->db->select('com.*, use.last_logged_in');
    //     $this->db->from('users_companies AS uco');
    //     $this->db->join('users AS use', 'use.id = uco.user_id');
    //     $this->db->join('companies AS com', 'com.id = uco.company_id');
    //     $this->db->where('use.id = '.$this->session->userdata('user_id'));
    //     $this->db->where('com.is_deleted = 0');
    //     $data['record'] = $this->db->get()->result();
    public function umkm()
    {
        $this->session->set_userdata('company_name', 'Daftar UMKM');
        $data['active_page'] = '';
        // $data['record'] = $this->db->get_where('companies', ['is_deleted' => '0'])->result();

        $this->db->select('com.*, usr.last_logged_in');
        $this->db->from('users_companies AS usc');
        $this->db->join('companies AS com', 'com.id = usc.company_id');
        $this->db->join('users AS usr', 'usr.id = usc.user_id');
        $this->db->where('com.is_deleted', '0');
        $record = $this->db->get();

        $data['record'] = $record->result();

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
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);

            $this->upload->do_upload('gambar');
            $image = $this->upload->data();
            // Uploading End

            $name = $this->input->post('name');
            $qty = $this->input->post('qty');
            $price = $this->input->post('price');
            $price = str_replace(['Rp', '.', ' '], '', $price);
            $data = [
                'name'       => $name,
                'qty'        => $qty,
                'company_id' => $this->session->userdata('company_id'),
                'file_name'  => $image['file_name'],
                'price'      => $price,
            ];

            $this->db->insert('products', $data);
            $this->session->set_flashdata('message', 'Barang '.$name.' telah berhasil disimpan!');
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

    public function check_umkm_activity()
    {
        // $this->session->set_userdata('company_name', $this->session->userdata('company_name'));
        $this->session->set_userdata('active_url', $this->uri->segment(1));
        $company_id = $this->session->userdata('company_id');
        $data['record'] = $this->db->get_where('activities', ['company_id' => $company_id]);
        $this->template->load('templates/admin_template', 'activity/index', $data);
    }

    public function umkm_activity_detail()
    {
        $id = $this->uri->segment(3);
        $this->session->set_userdata('active_page', $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3));
        $data['record'] = $this->db->get_where('activities', ['id' => $id])->row_array();
        $this->session->set_userdata('company_id', $data['record']['company_id']);
        $this->session->set_userdata('company_name', $this->session->userdata('company_name'));
        $this->template->load('templates/admin_template', 'activity/detail', $data);
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

    public function activate_umkm_alternate()
    {
        $company_id = $this->uri->segment(3);
        $this->db->where('id', $company_id);
        $this->db->update('companies', ['is_active' => '1']);

        $data = $this->db->get_where('companies', ['id' => $company_id])->row_array();

        $this->session->set_flashdata('message', 'UMKM '.$data['name'].' telah berhasil diaktivasi!!!');

        redirect('admin/umkm');
    }

    public function deactivate_umkm_alternate()
    {
        $company_id = $this->uri->segment(3);
        $this->db->where('id', $company_id);
        $this->db->update('companies', ['is_active' => '0']);

        $data = $this->db->get_where('companies', ['id' => $company_id])->row_array();

        $this->session->set_flashdata('message', 'UMKM '.$data['name'].' telah berhasil dinpnaktifkan!!!');

        redirect('admin/umkm');
    }
}
