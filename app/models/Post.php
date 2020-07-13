<?php

namespace App\Models;

use App\Core\Model;

class Post extends Model{

    public function getPosts()
    {
        $query = "SELECT * FROM posts";

        $result = $this->db->row($query);
        return $result;
    }

    public function getPost($id)
    {
        $query = "SELECT * FROM posts WHERE id = :id";

        $params = [
            'id' => $id
        ];
        
        $result = $this->db->row($query, $params);
        return $result;
    }

    public function qwe()
    {
        return $this->select(['id', 'title'], 'posts');
    }

}