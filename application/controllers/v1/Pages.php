<?php

require APPPATH . '/libraries/REST_Controller.php';

class Pages extends REST_Controller
{
    private $dir_model = "v1/blog/";
    private $error_param = array("error" => "unexpected parameter");

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->dir_model . "page_model", "page");
    }

    function index_get($page_id = null)
    {
        if ($page_id != null) {
            $result = $this->page->get_pages($page_id);
            if (!$result) {
                $result = array();
            }
        } else {
            $result = $this->error_param;
        }
        $this->response($result, self::HTTP_OK);
    }

    public function post(Type $var = null)
    {
        # code...
    }
}
