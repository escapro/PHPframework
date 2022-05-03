<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\Post;

class PostController extends Controller
{
    protected $data = [];
    protected $postModel;

    public function __construct()
    {
        $this->postModel = new Post();
    }

    // Get all posts
    public function all($qwe)
    {
        $posts = $this->postModel->select_all();
        $this->data['posts'] = $posts;

        View::render('post', $this->data);
    }

    // Get post by id
    public function get($post_id)
    {
        $post = $this->postModel->where('id', '=', $post_id);
        $this->data['post'] = $post;

        View::render('post', $this->data);
    }

    // Add new post
    public function create($title, $body)
    {
        $new_post = $this->postModel->insert([
            'title' => $title,
            'body' => $body
        ]);

        return json_encode($new_post);
    }

    // Delete post
    public function delete($post_id)
    {
        $post = $this->postModel->delete($post_id);

        return json_encode($post);
    }
}
