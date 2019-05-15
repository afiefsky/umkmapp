<?php

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['active_page'] = '';
        $this->template->load('templates/main_template', 'customer/index');
    }
}
