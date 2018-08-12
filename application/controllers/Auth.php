<?php

class Auth extends CI_Controller
{
    /**
     * -- Public means it's usable for any class and subclasses
     * -- Protected means it's usable for current class and its subclasses
     * -- Private means it's usable for current class only
     * -- Variables List should be declared
     * var data;
     * var result;
     */
    protected $data;
    protected $result;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user', TRUE);
    }

    public function index()
    {
        if (isset($_POST['submit'])) {
            $data['username'] = $this->input->post('username');
            $data['password'] = $this->input->post('password');

            $result = $this->user->validate($data);

            if ($result == 1) {
                // Session start
                $this->session->set_userdata('username', strtolower($data['username']));
                // End session

                $user_roles = $this->db->get_where('users_roles', ['user_id' => $this->session->userdata('user_id')]);
                $role_count = $user_roles->num_rows();
                if ($this->session->userdata('username')=='admin') {
                    redirect('admin');
                } else {
                    $data['user_roles'] = $user_roles->result();
                    redirect('dashboard');
                }
            } else {
                // Error handling using session flashdata, a one time usage session
                $this->session->set_flashdata('error', 'Username dan password salah!!!<br /><br />');
                redirect('auth');
            }
        } else {
            $data['error'] = $this->session->userdata('error');
            $this->template->load('templates/login_template', 'login/index', $data);
        }
    }

    public function destroy()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
