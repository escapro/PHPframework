<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Core\Db;
use App\Models\Post;

class WelcomeController extends Controller
{
    protected $data = [];
    protected $postModel;

    public function __construct()
    {
        $this->postModel = new Post();
    }

    public function index($qwe)
    {   
        // $users = $this->postModel->select_all('users');
        // print_r($users);
        var_dump(($this->postModel->qwe()));
        // View::render('main', $this->data);
    }

    public function qwe()
    {   
        echo "hello";
    }

}