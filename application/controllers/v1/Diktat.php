<?php
require APPPATH . '/libraries/REST_Controller.php';

class Diktat extends REST_Controller
{
    private $dir_model = "v1/blog/";
    private $error_param = array("error" => "unexpected parameter");

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->dir_model . "diktat_model", "diktat");
    }

    public function index_get()
    {
        $where = array();
        $search = array();
        $dosenId = $this->get("dosenId");
        if ($dosenId != null) $where = array("id" => $dosenId);
        $keyword = $this->get("keyword");
        if ($keyword != null) $search = array("a.nama" => $keyword, "nama_matkul" => $keyword, "nama_matkul" => $keyword, "b.nama" => $keyword,);
        $limit = $this->get("limit");
        $offset = $this->get("offset");

        $result = $this->diktat->get_diktat($where, $limit, $offset, $search);
        if (!$result) {
            $result = array();
        }
        $this->response($result, self::HTTP_OK);
    }
}
