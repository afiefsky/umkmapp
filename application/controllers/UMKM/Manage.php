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
        if (isset($_POST['submit_search'])) {
            $keyword = $this->input->post('company_name');
            $data['active_page'] = 'umkm/manage';
            $data['record_default'] = $this->company->list_by_keyword($keyword, $this->session->userdata('user_id'))->result();

            $this->load->library('pagination');
            $config['base_url'] = base_url().'index.php/umkm/manage/index/';
            $config['total_rows'] = $this->company->list_by_keyword($keyword, $this->session->userdata('user_id'))->num_rows();
            $config['per_page'] = 100;

            $this->pagination->initialize($config);

            $data['paging'] = $this->pagination->create_links();
            $page = $this->uri->segment(4);
            $page = $page == '' ? 0 : $page;

            $data['record'] = $this->company->list_by_keyword_paging($page, $config['per_page'], $keyword, $this->session->userdata('user_id'))->result();

            $this->template->load('templates/main_template', 'umkm/manage/index', $data);
        } else {
            // record of companies start
            $record_default = $this->company->list($this->session->userdata('user_id'));
            // record of companies end

            // pagination start
            $this->load->library('pagination');
            $config['base_url'] = base_url().'index.php/umkm/manage/index/';
            $config['total_rows'] = $record_default->num_rows();
            $config['per_page'] = 7;

            $this->pagination->initialize($config);

            $data['paging'] = $this->pagination->create_links();
            $page = $this->uri->segment(4);
            $page = $page == '' ? 0 : $page;
            // pagination end

            // record paging start
            $record_paging = $this->company->list_paging($page, $config['per_page'], $this->session->userdata('user_id'));
            // record paging end
            $data['record'] = $record_paging->result();
            $this->template->load('templates/main_template', 'umkm/manage/index', $data);
        }
    }

    public function list()
    {
        $company_id = $this->uri->segment(4);
        // Adding company id to the session
        $this->session->set_userdata('company_id', $company_id);

        $this->session->set_userdata('prev_page', $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4));

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
            $this->template->load('templates/main_template', 'umkm/manage/add_product', $data);
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
            $this->template->load('templates/main_template', 'umkm/manage/product', $data);
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
            $this->template->load('templates/main_template', 'umkm/manage/product', $data);
        }
    }

    public function delete()
    {
        $company_id = $this->uri->segment(4);
        $data = $this->db->get_where('companies', ['id'=>$company_id])->row_array();
        $company_name = $data['name'];
        $this->db->where('id', $company_id);
        $this->db->update('companies', ['is_deleted' => '1']);

        $this->session->set_flashdata('message', '<h4>UMKM '.$company_name.' TELAH BERHASIL DI HAPUS!!</h4>');
        redirect('umkm/manage');
    }
}
