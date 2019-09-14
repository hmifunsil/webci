<?php

/**
 * Created by PhpStorm.
 * User: Rifki Mubarok
 * Date: 17/03/2019
 * Time: 20:54
 */

class Post_model extends CI_Model
{

    private $db;
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database("blog", true);
    }

    function get_posting($where = null, $limit = null, $offset = null, $search = null)
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
        $hasil = $this->db->get("post")->result();
        $data = array();
        foreach ($hasil as $item) {
            $row = new myObject();
            $row = $item;
            $row->citations = $this->get_citition(array("postId" => $item->id));
            array_push($data, $row);
        }
        $output = new myObject();
        $output->posting = $data;
        $output->total = $this->count_posting($where, $search);
        return $output;
    }

    function count_posting($where = null, $search = null)
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
        $hasil = $this->db->get("post")->row();
        return $hasil->total;
    }

    function get_citition($where = null)
    {
        if ($where != null) {
            $this->db->where($where);
        }
        $hasil = $this->db->get("citations");
        return $hasil->result();
    }

    function get_comments($comment_id = null, $parrent_id = null, $post_id = null)
    {
        if (!is_null($comment_id)) {
            $this->db->where(array("id" => $comment_id));
        }

        if (!is_null($parrent_id)) {
            $this->db->where(array("parrentId" => $parrent_id));
        }

        if (!is_null($post_id)) {
            $this->db->where(array("postId" => $post_id));
        }


        $hasil = $this->db->get("comments");
        if ($hasil->num_rows() > 0) {
            $result = array();
            foreach ($hasil->result() as $field) {
                $comment = new myObject();
                $comment = $field;
                $comment->reply = $this->get_comments(null, $field->id, $post_id);
                $result[] = $comment;
            }
            return $result;
        } else {
            return false;
        }
    }

    function get_comments_child($parrent_id)
    {
        $this->db->where(array("parrentId" => $parrent_id));
        $hasil = $this->db->get("comments");
        if ($hasil->num_rows() > 0) {
            $result = array();
            foreach ($hasil->result() as $item) {
                $comment = new myObject();
                $comment = $item;
                $comment->reply = $this->get_comments_child($item->id);
                $result[] = $comment;
            }
            return $result;
        }
        return false;
    }

    public function save_comments($data)
    {
        $this->db->insert("comments", $data);
        if ($this->db->affected_rows()) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function update_comment($data, $where)
    {
        $this->db->where($where);
        $result = $this->db->update("comments", $data);
        return $result;
    }

    public function save_posting($data)
    {
        $this->db->insert("post", $data);
        if ($this->db->affected_rows()) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function update_posting($data, $where)
    {
        $this->db->where($where);
        $result = $this->db->update("post", $data);
        return $result;
    }

    public function save_citation_batch($data)
    {
        $result = $this->db->insert_batch("citations", $data);
        return $result;
    }

    public function save_citation($data)
    {
        $this->db->insert("citations", $data);
        if ($this->db->affected_rows()) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function update_citation($data, $where)
    {
        $this->db->where($where);
        $result = $this->db->update("citations", $data);
        return $result;
    }
}
