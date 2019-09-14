<?php
class Authentication
{
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("v1/auth_model", "auth");
    }

    public function login($username, $password)
    {
        $result = $this->ci->auth->login($username, $password);
        if ($result) {
            return array("status" => true, "data" => $result);
        }
        return array("status" => false, "message" => "Username or Password is wrong!");
    }

    // Check valid token return true or false
    public function check_valid_token($token)
    {
        $result = $this->ci->auth->check_valid_token($token);
        if ($result) {
            return true;
        }
        redirect("v1/expires");
    }

    public function get_userid_from_token($token)
    {
        $result = $this->ci->auth->get_userid_from_token($token);
        return $result;
    }
}
