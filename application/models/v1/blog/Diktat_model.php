<?php
class Diktat_model extends CI_Model
{
    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database("blog", true);
    }

    function get_diktat($where = null, $limit = null, $offset = null, $search = null)
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
        $this->db->select("a.id,a.nama as nama_diktat,a.matkul_id,a.dosen_id,a.url,a.dateCreated,b.nama,c.nama_matkul");
        $this->db->from("diktat AS a");
        $this->db->join("dosen AS b ", "ON a.dosen_id = b.id", "LEFT");
        $this->db->join("mata_kuliah AS c ", "ON a.matkul_id = c.id", "LEFT");
        $hasil = $this->db->get()->result();
        $output = new myObject();
        $output->total = $this->count_diktat($where, $search);
        $output->komunitas = $hasil;
        return $output;
    }

    function count_diktat($where = null, $search = null)
    {
        if ($where != null) {
            $this->db->where($where);
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
        $this->db->select("count(*) as total");
        $this->db->from("diktat AS a");
        $this->db->join("dosen AS b ", "ON a.dosen_id = b.id", "LEFT");
        $this->db->join("mata_kuliah AS c ", "ON a.matkul_id = c.id", "LEFT");
        $hasil = $this->db->get()->row();
        return $hasil->total;
    }
}
