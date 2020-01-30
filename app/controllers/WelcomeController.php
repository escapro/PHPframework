<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\Post;

class WelcomeController extends Controller
{
    protected $data = [];
    protected $postModel;

    public function __construct()
    {
        $this->postModel = new Post();
    }

    public function index()
    { 
        $posts = $this->postModel->getPosts();

        $this->data['page_title'] = "Главная страница";
        $this->data['posts'] = $posts;
        
        View::render('main', $this->data);
    }

}