<?php

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model', 'product');
    }

    public function delete()
    {

        $id = $this->uri->segment(3);
        $this->product->delete($id);
        redirect('umkm/manage/product');
    }

    public function edit()
    {
        if (isset($_POST['submit'])) {

        } elseif (isset($_POST['picture'])) {
            $id = $this->uri->segment(3);
            $data['picture'] = 'active';
            $data['record'] = $this->db->get_where('products', ['id' => $id])->row_array();
            $data['active_page'] = 'umkm/manage';
            $data['message'] = '';
            $this->template->load('templates/main_template', 'umkm/manage/edit_product', $data);
        } else {
            $id = $this->uri->segment(3);
            $this->session->set_userdata('product_id', $id);
            $data['picture'] = 'inactive';
            $data['record'] = $this->db->get_where('products', ['id' => $id])->row_array();
            $data['active_page'] = 'umkm/manage';
            $data['message'] = '';
            $this->template->load('templates/main_template', 'umkm/manage/edit_product', $data);
        }
    }
}