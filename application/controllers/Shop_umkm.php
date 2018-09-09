<?php

class Shop_umkm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model', 'company');
        $this->load->model('Product_model', 'product');
        $this->load->model('Cart_detail_model', 'cart_detail');
        $this->load->model('Cart_model', 'cart');
    }

    public function __generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function index()
    {
        // $this->session->sess_destroy();
        $data['record'] = $this->company->all();
        $this->template->load('templates/shop_umkm_template', 'shop_umkm/index', $data);
    }

    public function umkm()
    {
        $company_id = $this->uri->segment(3);
        // Adding company id to the session
        $this->session->set_userdata('company_id', $company_id);

        $this->session->set_userdata('active_url', $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3));

        $data['record'] = $this->company->detail($company_id)->row_array();

        $this->session->set_userdata('company_name', $data['record']['name']);

        $this->template->load('templates/shop_umkm_template', 'shop_umkm/umkm', $data);
    }

    public function product()
    {
        $this->session->set_userdata('active_url', $this->uri->segment(1).'/'.$this->uri->segment(2));
        $data['record'] = $this->product->all_by_company_id($this->session->userdata('company_id'));
        $this->template->load('templates/shop_umkm_template', 'shop_umkm/product', $data);
    }

    public function cart()
    {
        $cart_id = $this->uri->segment(3);
        $data['record'] = $this->cart_detail->get_with_product($cart_id);
        $this->template->load('templates/shop_umkm_template', 'shop_umkm/cart', $data);
    }

    public function qty_selection()
    {
        $data['record'] = $this->db->get_where('products', ['id' => $this->uri->segment(3)])->row_array();
        $this->template->load('templates/shop_umkm_template', 'shop_umkm/qty_selection', $data);
    }

    public function add_to_cart()
    {
        $product_id = $this->uri->segment(3);
        $qty = $this->input->post('qty');

        $product = $this->db->get_where('products', ['id' => $product_id])->row_array();
        if ($qty > $product['qty']) {
            $this->session->set_flashdata('message', 'MAAF, ANDA MELEBIHI STOK YANG KAMI SEDIAKAN UNTUK PRODUK TERSEBUT YAITU = '.$product['qty']);
            redirect('shop/qty_selection/'.$product_id);
        }

        $cart_session = $this->session->userdata('cart_id');

        // start
        if (empty($cart_session)) {
            // carting session for non-logged-in customer
            $data = [
                'description' => ''
            ];
            $this->db->insert('carts', $data);

            $cart_id = $this->db->insert_id();
            $this->session->set_userdata('cart_id', $cart_id);

            $data = [
                'description' => $cart_id
            ];

            $this->db->where('id', $cart_id);
            $this->db->update('carts', $data);
            // carting session end
        }
        // end

        $cart_id = $this->session->userdata('cart_id');
        $description = 'Cart = '.$cart_id.', Product = '.$product_id;
        $data = [
            'cart_id' => $cart_id,
            'product_id' => $product_id,
            'qty' => $qty,
            'description' => $description,
            'is_cancelled' => '0',
            'is_discount' => '1'
        ];

        $this->db->insert('carts_details', $data);
        redirect($this->session->userdata('active_url'));
    }

    public function process()
    {
        $email = $this->input->post('email');
        $transaction_code = strtoupper($this->__generateRandomString());
        $check_code = $this->db->get_where('carts', ['transaction_code'=>$transaction_code])->num_rows();
        if ($check_code > 0) {
            $this->process();
        }

        $cart_id = $this->session->userdata('cart_id');
        $company_id = $this->session->userdata('company_id');
        $data = $this->db->get_where('users_companies', ['company_id' => $company_id])->row_array();
        $data = $this->db->get_where('users', ['id' => $data['user_id']])->row_array();

        $this->db->where('id', $cart_id);
        $this->db->update('carts', ['status' => '1', 'transaction_code' => $transaction_code]);

        $scheduled_day = $this->cart->get_scheduled_day($cart_id)->row_array();

        $this->session->set_flashdata('above_message', '<h3>KODE TRANSAKSI (KAPITAL): <br><b>'.$transaction_code.'</b></h3>');
        $this->session->set_flashdata('message', '<h3>TRANSFER KE REKENING <br><b>('.$data['bank_name'].') -- '.$data['bank_account_number'].' -- A/N: '.$data['bank_account_owner'].'</b></h3>
                                      <br/>
                                      <h3>MOHON LUNASI PEMBAYARAN ANDA SEBELUM '.$scheduled_day['scheduled_day']);

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

        $this->email->from('arezkyameliap@gmail.com', 'arezkyameliap');
        $this->email->to($email);

        $this->email->subject('NOTIFIKASI UMKMAPP');
        $this->email->message("Kode Transaksi = ".$transaction_code."\nMohon lakukan pembayaran dengan transfer ke rekening :\r\n\n(".$data['bank_name'].") -- ".$data['bank_account_number']." -- A/N = ".$data['bank_account_owner']);
        $this->email->send();
        // email algorithm end

        redirect('shop_umkm');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('shop');
    }
}
