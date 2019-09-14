<?php
class Auth_model extends CI_Model
{
    private $db;
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database("blog", true);
    }

    public function login($username, $password)
    {
        $this->db->select("system_user.id,system_user.`name`,system_user.username,system_user.type,system_user.token");
        $this->db->where(array("username" => $username, "password" => sha1(md5($password))));
        $result = $this->db->get("system_user");
        if ($result->num_rows() > 0) {
            $data = $result->row();
            $token = $this->make_token($data->username, $data->id);
            $data->token = $token;
            return $data;
        }
        return false;
    }

    public function make_token($username, $id)
    {
        $token = md5($username . date("ymdhis"));
        $data = array("token" => $token);
        $where = array("id" => $id);
        $this->db->where($where);
        $result = $this->db->update("system_user", $data);
        if ($result) {
            return $token;
        }
        return false;
    }

    public function check_valid_token($token)
    {
        $this->db->select("token");
        $this->db->where(array("token" => $token));
        $result = $this->db->get("system_user");
        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }



    public function get_userid_from_token($token)
    {
        $this->db->select("id");
        $this->db->where(array("token" => $token));
        $result = $this->db->get("system_user");
        if ($result->num_rows() > 0) {
            $data = $result->row();
            return $data->id;
        }
        return false;
    }
}
