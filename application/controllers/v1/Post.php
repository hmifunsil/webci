<?php

/**
 * Created by PhpStorm.
 * User: Rifki Mubarok
 * Date: 17/03/2019
 * Time: 20:18
 */

require APPPATH . '/libraries/REST_Controller.php';

class Post extends REST_Controller
{
    private $dir_model = "v1/blog/";
    private $error_param = array("error" => "unexpected parameter");
    public function __construct()
    {
        parent::__construct();
        $this->load->model($this->dir_model . "post_model", "posting");
        $this->load->library("authentication");
    }

    // Fungsi untuk mengambil komentar di suatu posting
    function comments_get($postId = null)
    {
        if ($postId != null) {
            $result = $this->posting->get_comments(null, 0, $postId);
            if (!$result) {
                $result = array();
            }
        } else {
            $result = $this->error_param;
        }
        $this->response($result, self::HTTP_OK);
    }

    public function comments_post()
    {
        $postId = $this->post("postId", true);
        $parrentId = $this->post("parrentId", true);
        $userId = $this->authentication->get_userid_from_token($this->head("X-API-KEY", true));
        $content = $this->post("content", true);

        if (($postId != null) && ($parrentId != null) && ($userId != null)) {
            $data = array("postId" => $postId, "parrentId" => $parrentId, "userId" => $userId, "content" => $content);
            $result = $this->posting->save_comments($data);
            if ($result) {
                $output = array("status" => true, "message" => "Post has been saved", "commentId" => $result);
                $this->response($output, self::HTTP_OK);
            } else {
                $output = array("status" => false, "message" => "Unable to save data");
                $this->response($output, self::HTTP_OK);
            }
        } else {
            $this->response($this->error_param, self::HTTP_OK);
        }
    }

    public function comments_put($commentId = null)
    {
        if ($commentId == null) {
            $this->response($this->error_param, self::HTTP_OK);
            return false;
        }

        $data = $this->put(null, true);
        $userId = $this->authentication->get_userid_from_token($this->head("X-API-KEY", true));
        $where = array("id" => $commentId, "userId" => $userId);

        $result = $this->posting->update_comment($data, $where);
        if ($result) {
            $output = array("status" => true, "message" => "comment was updated");
        } else {
            $output = array("status" => 501, "message" => "Something wrong.");
        }
        $this->response($output, self::HTTP_OK);
    }

    // Fungsi untuk mengambil posting
    function index_get($postId = null)
    {
        $where = array();
        $search = array();
        if ($postId != null) $where = array("id" => $postId);
        $keyword = $this->get("keyword");
        if ($keyword != null) $search = array("title" => $keyword, "content" => $keyword, "tag" => $keyword);
        $limit = $this->get("limit");
        $offset = $this->get("offset");

        $result = $this->posting->get_posting($where, $limit, $offset, $search);
        if (!$result) {
            $result = array();
        }
        $this->response($result, self::HTTP_OK);
    }

    function index_post()
    {
        //validasi token

        //logik
        $post = array();
        $post['title'] = $this->post("title", true);
        $post['content'] = $this->post("content", true);
        $post['tag'] = $this->post("tag", true);
        $post['category'] = $this->post("category", true);
        $post['imageUrl'] = $this->post("imageUrl", true);
        $post['creatorId'] = $this->authentication->get_userid_from_token($this->head("X-API-KEY"));
        $postId_save = $this->posting->save_posting($post);
        if ($postId_save) {
            $result = array("status" => true, "message" => "Post has been saved", "postId" => $postId_save);
            $this->response($result, self::HTTP_OK);
        } else {
            $result = array("status" => false, "message" => "Unable to save data");
            $this->response($result, self::HTTP_OK);
        }
    }

    public function index_put($postId = null)
    {
        if ($postId == null) {
            $this->response($this->error_param, self::HTTP_OK);
            return false;
        }
        //Update Posting
        $data = $this->put(null, true);
        $userId = $this->authentication->get_userid_from_token($this->head("X-API-KEY", true));
        $where = array("id" => $postId, "creatorId" => $userId);
        $result = $this->posting->update_posting($data, $where);
        if ($result) {
            $output = array("status" => true, "message" => "Post was updated");
        } else {
            $output = array("status" => 501, "message" => "Something wrong.");
        }
        $this->response($output, self::HTTP_OK);
    }

    public function citation_post()
    {
        //validasi token
        $cit_arr = array();
        $cit_arr['postId'] = $this->post("postId", true);
        $cit_arr['type'] = $this->post("type", true);
        $cit_arr['year'] = $this->post("year", true);
        $cit_arr['title'] = $this->post("title", true);
        $cit_arr['author'] = $this->post("author", true);
        $cit_arr['publisher'] = $this->post("publisher", true);
        $cit_arr['city'] = $this->post("city", true);
        $cit_arr['page'] = $this->post("page", true);
        $result_citation = $this->posting->save_citation($cit_arr);
        if ($result_citation) {
            $result = array("status" => true, "message" => "Citation has been saved", "citationId" => $result_citation);
            $this->response($result, self::HTTP_OK);
        } else {
            $result = array("status" => false, "message" => "something wrong");
            $this->response($result, self::HTTP_OK);
        }
    }

    public function citation_put($citationId = null, $postId = null)
    {

        if ($citationId == null || $postId == null) {
            $this->response($this->error_param, self::HTTP_OK);
            return false;
        }

        $data = $this->put();

        $where = array("id" => $citationId, "postId" => $postId);

        $result = $this->posting->update_citation($data, $where);
        if ($result) {
            $output = array("status" => true, "message" => "Citation was updated");
        } else {
            $output = array("status" => 500, "message" => "Something wrong.");
        }
        $this->response($output, self::HTTP_OK);
    }
}
