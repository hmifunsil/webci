<?php
require APPPATH . '/libraries/REST_Controller.php';

class Komunitas extends REST_Controller
{
    private $dir_model = "v1/blog/";
    private $error_param = array("error" => "unexpected parameter");

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->dir_model . "komunitas_model", "komunitas");
    }

    function index_get()
    {
        $where = array();
        $search = array();
        $dosenId = $this->get("dosenId");
        if ($dosenId != null) $where = array("id" => $dosenId);
        $keyword = $this->get("keyword");
        if ($keyword != null) $search = array("nama_komunitas" => $keyword, "deskripsi" => $keyword);
        $limit = $this->get("limit");
        $offset = $this->get("offset");

        $result = $this->komunitas->get_komunitas($where, $limit, $offset, $search);
        if (!$result) {
            $result = array();
        }
        $this->response($result, self::HTTP_OK);
    }
}
