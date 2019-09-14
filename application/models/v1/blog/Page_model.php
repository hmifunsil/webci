<?php


class Page_model extends CI_Model
{
    private $db;
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database("blog",true);
    }

    function get_pages($page_id){
        $this->db->where(array("page_id"=>$page_id));
        $result = $this->db->get("pages");
        return $result->row();
    }
}