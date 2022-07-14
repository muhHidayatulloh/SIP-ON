<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Error extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
         $this->template->load('template', 'errors/page_not_found');
    }
}

/* End of file Error.php and path \application\controllers\Error.php */
