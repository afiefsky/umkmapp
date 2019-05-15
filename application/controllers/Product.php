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
            $product_id = $this->uri->segment(3);

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $image = $this->upload->data();
            $selected_product = $this->db->get_where('products', ['id'=>$product_id])->row_array();
            if ($image['file_name'] == '') {
                $image['file_name'] = $selected_product['file_name'];
            } else {
            }

            $name = $this->input->post('name');
            $qty = $this->input->post('qty');
            $data = [
                'name'       => $name,
                'qty'        => $qty,
                'company_id' => $this->session->userdata('company_id'),
                'file_name'  => $image['file_name'],
            ];

            $this->db->where('id', $product_id);
            $this->db->update('products', $data);
            $this->session->set_flashdata('message', 'Barang '.$name.' telah berhasil diubah!');
            redirect('umkm/manage/product');
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
