<?php
require APPPATH . '/libraries/REST_Controller.php';

class Login extends REST_Controller
{
    private $error_param = array("error" => "unexpected parameter");
    public function __construct()
    {
        parent::__construct();
    }

    public function index_post()
    {
        $username = $this->post("username", true);
        $password = $this->post("password", true);
        if (($username != NULL) && ($password != NULL)) {
            $this->load->library("authentication");
            $result = $this->authentication->login($username, $password);
        } else {
            $result = $this->error_param;
        }
        $this->response($result, self::HTTP_OK);
    }
}
