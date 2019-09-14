<?php
require APPPATH . '/libraries/REST_Controller.php';

class Expires extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index_get()
    {
        $this->response(array("status" => false, "message" => "Token was Expired, Please login again."), self::HTTP_UNAUTHORIZED);
    }
}
