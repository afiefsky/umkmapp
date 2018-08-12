<?php

class Activity extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $company_id = $this->session->userdata('company_id');
        $data['record'] = $this->db->get_where('activities', ['company_id' => $company_id]);
        $this->template->load('templates/main_template', 'activity/index', $data);
    }

    public function add()
    {
        if (isset($_POST['submit'])) {
            $name = $this->input->post('name');
            $date = $this->input->post('date');
            $description = $this->input->post('description');

            // uploading start
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $this->upload->do_upload('file_name');
            $image_data = $this->upload->data();

            $data = [
                'name' => $name,
                'date' => $date,
                'company_id' => $this->session->userdata('company_id'),
                'file_name' => $image_data['file_name'],
                'description' => $description
            ];

            $this->db->insert('activities', $data);
            redirect('Activity');
            // uploading end

        } else {
            $this->template->load('templates/main_template', 'activity/add');
        }
    }

    public function detail()
    {
        $id = $this->uri->segment(3);
        $data['record'] = $this->db->get_where('activities', ['id' => $id])->row_array();
        $this->template->load('templates/main_template', 'activity/detail', $data);
    }

    public function delete()
    {
        $id = $this->uri->segment(3);
        $this->db->where('id', $id);
        $this->db->delete('activities');
        $this->session->set_flashdata('message', 'Kegiatan telah berhasil dihapus!!');
        redirect('activity');
    }

    public function edit()
    {
        if (isset($_POST['submit'])) {
            $name = $this->input->post('name');
            $date = $this->input->post('date');
            $description = $this->input->post('description');

            // uploading start
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $this->upload->do_upload('file_name');
            $image_data = $this->upload->data();
            $current_image = $this->db->get_where('activities', ['id' => $this->uri->segment(3)])->row_array();
            $image = '';
            if ($image_data['file_name']=='') {
                $image = $current_image['file_name'];
            } else {
                $image = $image_data['file_name'];
            }
            $data = [
                'name' => $name,
                'date' => $date,
                'company_id' => $this->session->userdata('company_id'),
                'file_name' => $image,
                'description' => $description
            ];
            $this->db->where('id', $this->uri->segment(3));
            $this->db->update('activities', $data);
            redirect('Activity');
            // uploading end

        } elseif (isset($_POST['request_pic_edit'])) {
            $id = $this->uri->segment(3);
            $data['edit_pic'] = 1;
            $data['record'] = $this->db->get_where('activities', ['id' => $id])->row_array();
            $this->template->load('templates/main_template', 'activity/edit', $data);
        }
        else {
            $id = $this->uri->segment(3);
            $data['edit_pic'] = 0;
            $data['record'] = $this->db->get_where('activities', ['id' => $id])->row_array();
            $this->template->load('templates/main_template', 'activity/edit', $data);
        }
    }
}
