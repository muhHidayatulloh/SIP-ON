<?php

class Jadwal extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_model');
    }

    public function index()
    {
        $data['jadwal'] = $this->Jadwal_model->get();


        $this->template->load('template', 'jadwal/view', $data);
    }
}
