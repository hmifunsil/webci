<?php


class Dosen_model extends CI_Model
{
    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database("blog",true);
    }

    function get_dosen($where = null, $limit = null, $offset = null, $search = null)
    {
        if ($where != null) {
            $this->db->where($where);
        }
        if ($limit != null && $offset != null) {
            $this->db->limit($limit, ($offset - 1) * $limit);
        } else if ($limit != null) {
            $this->db->limit($limit);
        }
        if ($search != null) {
            $no = 0;
            $this->db->group_start();
            foreach ($search as $key => $value) {
                if ($no == 0) {
                    $this->db->like(array($key => $value));
                } else {
                    $this->db->or_like(array($key => $value));
                }
                $no++;
            }
            $this->db->group_end();
        }
        $hasil = $this->db->get("dosen")->result();

        $output = new myObject();
        $output->total = $this->count_dosen($where,$search);
        $output->dosen = $hasil;
        return $output;
    }

    function count_dosen($where=null,$search=null){
        if($where != null){
            $this->db->where($where);
        }
        if($search != null){
            $no = 0;
            $this->db->group_start();
            foreach ($search as $key=>$value){
                if ($no == 0){
                    $this->db->like(array($key=>$value));
                }else{
                    $this->db->or_like(array($key=>$value));
                }
                $no++;
            }
            $this->db->group_end();
        }
        $this->db->select("count(*) as total");
        $hasil = $this->db->get("dosen")->row();
        return $hasil->total;
    }
}