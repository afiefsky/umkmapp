<?php

class Selection extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['active_page'] = 'selection';
        $this->template->load('templates/selection_template', 'selection/index', $data);
    }
}