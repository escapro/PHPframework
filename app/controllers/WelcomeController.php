<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Core\Security;
use App\Core\Cookie;
use App\Core\Session;
use App\Core\Input;
use App\Models\Post;

class WelcomeController extends Controller
{
    protected $data = [];
    protected $postModel;

    public function __construct()
    {
        $this->homeModel = new Post();
    }

    public function index()
    {   
        View::render('main', $this->data);
    }

    public function qwe()
    {   
        echo "hello";
    }

}