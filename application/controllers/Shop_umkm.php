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

    public function index()
    {
        // $this->session->sess_destroy();
        $data['record'] = $this->company->all();
        $this->template->load('templates/shop_umkm_template', 'shop_umkm/index', $data);
    }
}
