<?php

class Jadwal extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Jadwal_model');
        $this->load->model('user_model');
    }

    public function index()
    {
        $data['user'] = $this->user_model->get();
        $data['jadwal'] = $this->Jadwal_model->get();


        $this->template->load('template', 'jadwal/view', $data);
    }
}
