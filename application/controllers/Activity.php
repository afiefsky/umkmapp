<?php

class Activity extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->template->load('templates/main_template', 'activity/index');
    }
}