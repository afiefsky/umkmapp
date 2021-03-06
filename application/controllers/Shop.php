<?php

class Shop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model', 'company');
        $this->load->model('Product_model', 'product');
        $this->load->model('Cart_detail_model', 'cart_detail');
        $this->load->model('Cart_model', 'cart');
    }

    public function index()
    {
        $this->session->sess_destroy();
        $data['record'] = $this->company->all();
        $this->template->load('templates/shop_template', 'shop/index', $data);
    }

    /**
     * Session:
     * - company_id
     * - active_url
     * - company_name.
     */
    public function umkm()
    {
        $company_id = $this->uri->segment(3);
        // Adding company id to the session
        $this->session->set_userdata('company_id', $company_id);

        $this->session->set_userdata('active_url', $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3));

        $data['record'] = $this->company->detail($company_id)->row_array();

        $this->session->set_userdata('company_name', $data['record']['name']);

        $this->template->load('templates/shop_template', 'shop/umkm', $data);
    }

    public function product()
    {
        $this->session->set_userdata('active_url', $this->uri->segment(1).'/'.$this->uri->segment(2));
        $data['record'] = $this->product->all_by_company_id($this->session->userdata('company_id'));
        $this->template->load('templates/shop_template', 'shop/product', $data);
    }

    public function qty_selection()
    {
        $data['record'] = $this->db->get_where('products', ['id' => $this->uri->segment(3)])->row_array();
        $this->template->load('templates/shop_template', 'shop/qty_selection', $data);
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
                'description' => '',
            ];
            $this->db->insert('carts', $data);

            $cart_id = $this->db->insert_id();
            $this->session->set_userdata('cart_id', $cart_id);

            $data = [
                'description' => $cart_id,
            ];

            $this->db->where('id', $cart_id);
            $this->db->update('carts', $data);
            // carting session end
        }
        // end

        $cart_id = $this->session->userdata('cart_id');
        $description = 'Cart = '.$cart_id.', Product = '.$product_id;
        $data = [
            'cart_id'      => $cart_id,
            'product_id'   => $product_id,
            'qty'          => $qty,
            'description'  => $description,
            'is_cancelled' => '0',
        ];

        $this->db->insert('carts_details', $data);
        redirect($this->session->userdata('active_url'));
    }

    public function cart()
    {
        $cart_id = $this->uri->segment(3);
        $data['record'] = $this->cart_detail->get_with_product($cart_id);
        $this->template->load('templates/shop_template', 'shop/cart', $data);
    }

    public function cancel_product()
    {
        $detail_id = $this->uri->segment(3);

        $this->db->where('id', $detail_id);
        $this->db->update('carts_details', ['is_cancelled' => '1']);
        redirect('shop/cart/'.$this->session->userdata('cart_id'));
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('shop');
    }

    public function activity()
    {
        $company_id = $this->session->userdata('company_id');
        $data['record'] = $this->db->get_where('activities', ['company_id' => $company_id]);
        $this->template->load('templates/shop_template', 'shop/activity', $data);
    }

    public function detail_activity()
    {
        $id = $this->uri->segment(3);
        $this->session->set_userdata('active_page', $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3));
        $data['record'] = $this->db->get_where('activities', ['id' => $id])->row_array();
        $this->session->set_userdata('company_id', $data['record']['company_id']);
        $this->session->set_userdata('company_name', $data['record']['name']);
        $this->template->load('templates/shop_template', 'shop/detail_activity', $data);
    }

    public function __generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
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
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => '465',
            'smtp_user' => 'arezkyameliap@gmail.com',
            'smtp_pass' => 'poldamku',
        ];
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from('arezkyameliap@gmail.com', 'arezkyameliap');
        $this->email->to($email);

        $this->email->subject('NOTIFIKASI UMKMAPP');
        $this->email->message('Kode Transaksi = '.$transaction_code."\nMohon lakukan pembayaran dengan transfer ke rekening :\r\n\n(".$data['bank_name'].') -- '.$data['bank_account_number'].' -- A/N = '.$data['bank_account_owner']);
        $this->email->send();
        // email algorithm end

        redirect('shop');
    }

    public function check_transfer()
    {
        if (isset($_POST['submit'])) {
            $transaction_code = $this->input->post('transaction_code');
            $data = $this->db->get_where('carts', ['transaction_code' => $transaction_code]);
            $cart_id = $data->row_array()['id'];
            $scheduled_day = $this->cart->get_scheduled_day($cart_id)->row_array();

            if ($data->num_rows() > 0) {
                if ($data->row_array()['status'] == '2') {
                    $this->session->set_flashdata('message', 'MAAF, TRANSAKSI TERSEBUT TELAH DIKIRIMKAN SEBELUMNYA!!!');
                    redirect('shop/check_transfer');
                } elseif (date('Y-m-d H:i:s') > $scheduled_day['scheduled_day']) {
                    $this->session->set_flashdata('message', 'MAAF, ANDA TELAH MELEWATI WAKTU YANG SUDAH DITENTUKAN!! SILAHKAN TRANSAKSI KEMBALI!!');
                    redirect('shop/check_transfer');
                }
                $this->session->set_userdata('transaction_code', $transaction_code);
                redirect('shop/submit_transfer_proof');
            } else {
                $this->session->set_flashdata('message', 'MAAF KODE TRANSAKSI TIDAK DITEMUKAN!');
                redirect('shop/check_transfer');
            }
        } else {
            $this->template->load('templates/shop_template', 'shop/check_transfer');
        }
    }

    public function submit_transfer_proof()
    {
        if (isset($_POST['submit'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);

            $this->upload->do_upload('file_name');

            $data = $this->upload->data();

            $cart_id = $this->session->userdata('cart_id');

            $data = [
                'status'    => '2',
                'file_name' => $data['file_name'],
                'name'      => $this->input->post('name'),
                'address'   => $this->input->post('address'),
                'email'     => $this->input->post('email'),
                'phone'     => $this->input->post('phone'),
            ];

            $this->db->where('id', $cart_id);
            $this->db->update('carts', $data);

            // Decreasing the product qty
            $data = '';
            $cart_detail = $this->db->get_where('carts_details', ['cart_id'=>$cart_id])->result();
            foreach ($cart_detail as $c) {
                $product_id = $c->product_id;
                $qty = $c->qty;

                $query = "UPDATE products SET qty = qty - $qty WHERE id = $product_id";
                $this->db->query($query);
            }

            $this->session->set_flashdata('message', '<h3>BARANG AKAN SEGERA DIKIRIMKAN OLEH PIHAK UMKM TERKAIT</h3>');
            $this->session->set_flashdata('above_message', '<h3>BUKTI UNTUK TRANSAKSI DENGAN KODE: ['.$this->session->userdata('transaction_code').'] TELAH BERHASIL DIKIRIMKAN!!</h3><br><h3>TERIMA KASIH TELAH BERBELANJA MENGGUNAKAN UMKM APP');

            // email algorithm start
            $config = [
                'protocol'  => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => '465',
                'smtp_user' => 'arezkyameliap@gmail.com',
                'smtp_pass' => 'poldamku',
            ];
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");

            $this->email->from('arezkyameliap@gmail.com', 'UMKM APP');
            $this->email->to($this->input->post('email'));

            $this->email->subject('NOTIFIKASI UMKMAPP');
            $this->email->message("BARANG AKAN SEGERA DIKIRIMKAN OLEH PIHAK UMKM TERKAIT\r\nBUKTI UNTUK TRANSAKSI DENGAN KODE: ".$this->session->userdata('transaction_code')." TELAH BERHASIL DIKIRIMKAN!!\rTERIMA KASIH TELAH BERBELANJA MENGGUNAKAN UMKM APP");
            $this->email->send();
            // email algorithm end

            redirect('shop');
        } else {
            $transaction_code = $this->session->userdata('transaction_code');
            $data['record'] = $this->db->get_where('carts', ['transaction_code' => $transaction_code])->row_array();

            $cart_id = $data['record']['id'];
            $this->session->set_userdata('cart_id', $cart_id);
            $data['record_detail'] = $this->cart_detail->get_with_product($cart_id)->result();

            $this->template->load('templates/shop_template', 'shop/submit_transfer_proof', $data);
        }
    }
}
