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
        $this->session->unset_userdata('company_name');
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
                    $this->session->unset_userdata('username');
                    $this->session->set_flashdata('error', 'Username dan password salah!!!<br /><br />');
                    redirect('auth');
                } else {
                    $data['user_roles'] = $user_roles->result();
                    $this->db->where('id', $this->session->userdata('user_id'));
                    $this->db->update('users', ['last_logged_in' => date('Y-m-d H:i:s')]);
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
            $this->session->sess_destroy();
        }
    }

    public function admin()
    {
        $this->session->unset_userdata('company_name');
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
                if ($this->session->userdata('username')=='admin' || $this->session->userdata('username')=='superadmin') {
                    $this->db->where('id', $this->session->userdata('user_id'));
                    $this->db->update('users', ['last_logged_in' => date('Y-m-d H:i:s')]);
                    redirect('admin');
                } else {
                    $this->session->unset_userdata('username');
                    $this->session->set_flashdata('error', 'Username dan password salah!!!<br /><br />');
                    redirect('auth/admin');
                }
            } else {
                // Error handling using session flashdata, a one time usage session
                $this->session->set_flashdata('error', 'Username dan password salah!!!<br /><br />');
                redirect('auth');
            }
        } else {
            $data['error'] = $this->session->userdata('error');
            $this->template->load('templates/login_admin_template', 'login/admin_index', $data);
            $this->session->sess_destroy();
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
