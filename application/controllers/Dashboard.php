<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('Activity_model', 'activity');
        $this->load->model('Cart_detail_model', 'cart_detail');
    }

    public function index()
    {
        $this->session->set_userdata('active_url', $this->uri->segment(1));
        // check if user is confirmed or not
        $user_data = $this->db->get_where('users', ['id' => $this->session->userdata('user_id')])->row_array();

        // $this->load->view('dashboard/index');
        $user_id = $this->session->userdata('user_id');
        $num_rows_companies = $this->user->check($user_id);
        $this->session->set_userdata([
        	'num_rows_companies' => $num_rows_companies
        ]);

        // Status checking wether umkm management have request of transfer proof to confirm or not
        $check = $this->db->get_where('carts', ['status' => '2'])->num_rows();
        if ($check>0) {
            $this->session->set_flashdata('message', 'ANDA MENDAPATKAN REQUEST KONFIRMASI BUKTI TRANSFER, MOHON SEGERA KONFIRMASI DI HALAMAN KONFIRMASI!!!');
        }

        $data['record'] = $this->activity->list($user_id);
        $this->template->load('templates/main_template', 'dashboard/index', $data);
    }
}
