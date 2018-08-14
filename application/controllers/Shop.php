<?php

class Shop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model', 'company');
        $this->load->model('Product_model', 'product');
        $this->load->model('Cart_detail_model', 'cart_detail');
    }

    public function index()
    {
        $data['record'] = $this->company->all();
        $this->template->load('templates/shop_template', 'shop/index', $data);
    }

    /**
     * Session:
     * - company_id
     * - active_url
     * - company_name
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
            'qty' => $this->input->post('qty'),
            'description' => $description,
            'is_cancelled' => '0'
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
}
