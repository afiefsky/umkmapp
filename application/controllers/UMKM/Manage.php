<?php

class Manage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model', 'company');
        $this->load->model('Cart_detail_model', 'cart_detail');
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

    public function transfer_confirmation()
    {
        $user_id = $this->session->userdata('user_id');
        $data['record'] = $this->cart_detail->get_cart_product($user_id)->result();
        $this->template->load('templates/main_template', 'umkm/manage/transfer_confirmation', $data);
    }

    public function transfer_detail()
    {
        $cart_id = $this->uri->segment(4);
        $this->session->set_userdata('cart_id', $cart_id);
        $data['record'] = $this->cart_detail->get_with_product($cart_id);
        $data['cart'] = $this->db->get_where('carts', ['id'=>$cart_id])->row_array();

        // 1. Session
        $this->session->set_flashdata('email', $data['cart']['email']);

        $this->template->load('templates/main_template', 'umkm/manage/transfer_detail', $data);
    }

    public function admin_confirmation()
    {
        $cart_id = $this->uri->segment(4);
        // 1. Changing status to '3' (Aproved by Admin)
        // 2. User email from session above
        $customer_email = $this->session->flashdata('email');
        $data = [
            'status' => '3'
        ];

        $this->db->where('id', $cart_id);
        $this->db->update('carts', $data);

        $this->session->set_flashdata('message', '<h3>BUKTI TRANSAKSI TELAH DIKONFIRMASI</h3>');
        $this->session->set_flashdata('above_message', '<h3>RINCIAN KONFIRMASI DAN PEMBELIAN TELAH DIKIRIMKAN KEPADA EMAIL '.$customer_email);

        // email algorithm start
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => '465',
            'smtp_user' => 'arezkyameliap@gmail.com',
            'smtp_pass' => 'poldamku'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from('arezkyameliap@gmail.com', 'UMKM APP');
        $this->email->to($customer_email);

        $this->email->subject('NOTIFIKASI UMKMAPP');
        $this->email->message("TRANSFER ANDA TELAH DIKONFIRMASI, SAAT INI BARANG ANDA SEDANG DIKIRIMKAN KE LOKASI ANDA");
        $this->email->send();
        // email algorithm end

        redirect('umkm/manage/transfer_confirmation');
    }

    public function transfer_history()
    {
        $user_id = $this->session->userdata('user_id');
        $data['record'] = $this->cart_detail->get_cart_by_user_id($user_id)->result();
        $this->template->load('templates/main_template', 'umkm/manage/transfer_history', $data);
    }

    public function history_detail()
    {
        $cart_id = $this->uri->segment(4);
        $this->session->set_userdata('cart_id', $cart_id);
        $data['record'] = $this->cart_detail->get_with_product($cart_id);
        $data['cart'] = $this->db->get_where('carts', ['id'=>$cart_id])->row_array();

        // 1. Session
        $this->session->set_flashdata('email', $data['cart']['email']);

        $this->template->load('templates/main_template', 'umkm/manage/history_detail', $data);
    }
}
