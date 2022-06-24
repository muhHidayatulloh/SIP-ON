<?php

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
        $this->load->model('user_model');
    }

    public function index()
    {
        $data['user'] = $this->user_model->get();
        $this->template->load('template', 'welcome', $data);
    }
}
