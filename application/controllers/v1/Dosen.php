<?php

require APPPATH . '/libraries/REST_Controller.php';

class Dosen extends REST_Controller
{
    private $dir_model = "v1/blog/";
    private $error_param = array("error" => "unexpected parameter");

    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->dir_model . "dosen_model", "dosen");
    }

    function index_get()
    {
        $where = array();
        $search = array();
        $dosenId = $this->get("dosenId");
        if ($dosenId != null) $where = array("id" => $dosenId);
        $keyword = $this->get("keyword");
        if ($keyword != null) $search = array("nidn" => $keyword, "nama" => $keyword);
        $limit = $this->get("limit");
        $offset = $this->get("offset");

        $result = $this->dosen->get_dosen($where, $limit, $offset, $search);
        if (!$result) {
            $result = array();
        }
        $this->response($result, self::HTTP_OK);
    }

    public function index_post()
    {
        $nidn = $this->post("nidn", true);
        $nama = $this->post("nama", true);

        if ($nidn == null || $nama == null) {
            $this->response($this->error_param, self::HTTP_OK);
            return false;
        }
        $data = array("nidn" => $nidn, "nama" => $nama);

        $dosenId = $this->dosen->save_dosen($data);
        if ($dosenId) {
            $result = array("status" => true, "message" => "Data has been saved.");
        } else {
            $result = array("status" => 500, "message" => "something is wrong");
        }
        $this->response($result, self::HTTP_OK);
    }

    public function index_put($dosenId = null)
    {
        if ($dosenId == null) {
            $this->response($this->error_param, self::HTTP_OK);
            return false;
        }

        $data = $this->put(null, true);
        $where = array("id" => $dosenId);

        $result = $this->dosen->update_dosen($data, $where);
        if ($result) {
            $output = array("status" => true, "message" => "Data was updated.");
        } else {
            $output = array("status" => 500, "message" => "Something is wrong.");
        }
        $this->response($output, self::HTTP_OK);
    }
}
