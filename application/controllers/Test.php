<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Document_model','doc');
    }
    //测试专用
    public function show()
    {
        wrong(site_url(''));
    }
    
}
